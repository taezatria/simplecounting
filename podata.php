<?php
	session_start();
	$con = mysqli_connect("localhost","root","","accounting");
	if(isset($_POST['show'])){
		$query = "SELECT purchases_order.id as id, tgl, id_sup, supplier.name as name, total, status FROM purchases_order JOIN supplier ON id_sup = supplier.id";
		$exe = mysqli_query($con, $query);
		$data = [];
		while($hasil = mysqli_fetch_assoc($exe)){
			$hasil['date'] = date_format(date_create($hasil['tgl']),"j-F-Y");
			$hasil['time'] = date_format(date_create($hasil['tgl']),"g:i:s A");
			array_push($data,$hasil);
		}
		echo json_encode($data);
	}
	if(isset($_POST['supplier'])) {
		$query = "SELECT * FROM supplier";
		$exe = mysqli_query($con, $query);
		$data = [];
		while($hasil = mysqli_fetch_assoc($exe)) {
			array_push($data, $hasil);
		}
		echo json_encode($data);
	}
	if(isset($_POST['item'])) {
		$query = "SELECT * FROM inventory";
		$exe = mysqli_query($con, $query);
		$data = [];
		while($hasil = mysqli_fetch_assoc($exe)) {
			array_push($data, $hasil);
		}
		echo json_encode($data);
	}
	if(isset($_POST['detail'])) {
		$id = $_POST['idpo'];
		$query = "SELECT det_purchases.id as id, id_po, id_invent, name, amount, received, subtotal FROM det_purchases JOIN inventory ON id_invent = inventory.id WHERE id_po = $id";
		$exe = mysqli_query($con, $query);
		$data = [];
		while($hasil = mysqli_fetch_assoc($exe)) {
			array_push($data, $hasil);
		}
		echo json_encode($data);
	}
	if(isset($_POST['insert'])) {
		$idsup = $_POST['idsup'];
		$total = $_POST['total'];
		$tgl = $_POST['tgl'];
		$iditems = $_POST['iditem'];
		$amount = $_POST['amount'];
		$subtotal = $_POST['subtotal'];
		$query = "INSERT INTO purchases_order VALUES(null, '$tgl','$idsup','$total','pending')";
		mysqli_query($con,$query);
		$get = "SELECT MAX(id) FROM purchases_order";
		$getid = mysqli_query($con,$get);
		$idpo = mysqli_fetch_row($getid);
		for($i=0; $i < sizeof($iditems); $i++) {
			mysqli_query($con, "INSERT INTO det_purchases VALUES(null,$amount[$i],$subtotal[$i],0,$idpo[0],$iditems[$i])");
		}
		echo "Berhasil";
	}
	if(isset($_POST['update'])) {
		$id = $_POST['iddet'];
		$amount = $_POST['amount'];
		$stat = $_POST['status'];
		$idpo = $_POST['idpo'];
		for($i=0; $i < sizeof($id); $i++) {
			mysqli_query($con, "UPDATE det_purchases SET received=$amount[$i] WHERE id=$id[$i]");
			mysqli_query($con, "UPDATE inventory SET stock=stock+$amount[$i] WHERE id=$id[$i]");
		}
		mysqli_query($con, "UPDATE purchases_order SET status='$stat' WHERE id=$idpo");
		echo "Update berhasil";
	}
	if(isset($_POST['bayar'])) {
		$id = $_POST['id'];
		$hasil = mysqli_query($con, "SELECT status,total FROM purchases_order WHERE id=$id");
		$get = mysqli_fetch_row($hasil);
		if($get[0] != 'payment') {
			echo "Must on state payment!";
			exit;
		}
		$hasil = mysqli_query($con, "SELECT ref FROM parameter WHERE id=5");
		$get1 = mysqli_fetch_row($hasil);
		$hasil = mysqli_query($con, "SELECT ref FROM parameter WHERE id=6");
		$get2 = mysqli_fetch_row($hasil);
		mysqli_query($con, "INSERT INTO journal VALUES(null,now(),$get1[0],'Pembayaran Pembelian',$get[1],0,null,$id,1)");
		mysqli_query($con, "INSERT INTO journal VALUES(null,now(),$get2[0],'Pembayaran Pembelian',0,$get[1],null,$id,1)");
		mysqli_query($con, "UPDATE purchases_order SET status='done' WHERE id=$id");
		echo "Berhasil";
	}
?>