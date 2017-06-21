<?php
	session_start();
	$con = mysqli_connect("localhost","root","","accounting");
	if(isset($_POST['show'])){
		$query = "SELECT sales_order.id as id, tgl, id_cust, customer.name as name, total, status FROM sales_order JOIN customer ON id_cust = customer.id";
		$exe = mysqli_query($con, $query);
		$data = [];
		while($hasil = mysqli_fetch_assoc($exe)){
			$hasil['date'] = date_format(date_create($hasil['tgl']),"j-F-Y");
			$hasil['time'] = date_format(date_create($hasil['tgl']),"g:i:s A");
			array_push($data,$hasil);
		}
		echo json_encode($data);
	}
	if(isset($_POST['customer'])) {
		$query = "SELECT * FROM customer";
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
		$id = $_POST['idso'];
		$query = "SELECT det_sales.id as id, id_so, id_invent, name, amount, sent, subtotal FROM det_sales JOIN inventory ON id_invent = inventory.id WHERE id_so = $id";
		$exe = mysqli_query($con, $query);
		$data = [];
		while($hasil = mysqli_fetch_assoc($exe)) {
			array_push($data, $hasil);
		}
		echo json_encode($data);
	}
	if(isset($_POST['insert'])) {
		$idcust = $_POST['idcust'];
		$total = $_POST['total'];
		$tgl = $_POST['tgl'];
		$iditems = $_POST['iditem'];
		$amount = $_POST['amount'];
		$subtotal = $_POST['subtotal'];
		$query = "INSERT INTO sales_order VALUES(null, '$tgl','$idcust','$total','pending')";
		mysqli_query($con,$query);
		$get = "SELECT MAX(id) FROM sales_order";
		$getid = mysqli_query($con,$get);
		$idso = mysqli_fetch_row($getid);
		$total = 0;
		$mi = 0;
		for($i=0; $i < sizeof($iditems); $i++) {
			$total += ($amount[$i] * $subtotal[$i]);
			$ex = mysqli_query($con, "SELECT price FROM inventory WHERE id=$iditems[$i]");
			$hsl = mysqli_fetch_row($ex);
			$mi += ($amount[$i] * $hsl[0]);
			mysqli_query($con, "INSERT INTO det_sales VALUES(null,$amount[$i],$subtotal[$i],0,$idso[0],$iditems[$i])");
			mysqli_query($con, "UPDATE inventory SET stock=stock-$amount[$i] WHERE id=$iditems[$i]");
		}
		$hasil = mysqli_query($con, "SELECT ref FROM parameter WHERE id=1");
		$get1 = mysqli_fetch_row($hasil);
		$hasil = mysqli_query($con, "SELECT ref FROM parameter WHERE id=2");
		$get2 = mysqli_fetch_row($hasil);
		$hasil = mysqli_query($con, "SELECT ref FROM parameter WHERE id=3");
		$get3 = mysqli_fetch_row($hasil);
		$hasil = mysqli_query($con, "SELECT ref FROM parameter WHERE id=4");
		$get4 = mysqli_fetch_row($hasil);
		mysqli_query($con, "INSERT INTO journal VALUES(null,now(),$get2[0],'Penjualan',$total,0,$idso[0],null,1)");
		mysqli_query($con, "INSERT INTO journal VALUES(null,now(),$get1[0],'Penjualan',0,$total,$idso[0],null,1)");
		mysqli_query($con, "INSERT INTO journal VALUES(null,now(),$get4[0],'Pokok Penjualan',$mi,0,$idso[0],null,1)");
		mysqli_query($con, "INSERT INTO journal VALUES(null,now(),$get3[0],'Pokok Penjualan',0,$mi,$idso[0],null,1)");
		echo "Berhasil";
	}
	if(isset($_POST['update'])) {
		$id = $_POST['iddet'];
		$amount = $_POST['amount'];
		$stat = $_POST['status'];
		$idso = $_POST['idso'];
		for($i=0; $i < sizeof($id); $i++) {
			mysqli_query($con, "UPDATE det_sales SET sent=$amount[$i] WHERE id=$id[$i]");
		}
		mysqli_query($con, "UPDATE sales_order SET status='$stat' WHERE id=$idso");
		echo "Update berhasil";
	}
	if(isset($_POST['bayar'])) {
		$id = $_POST['id'];
		$hasil = mysqli_query($con, "SELECT status,total FROM sales_order WHERE id=$id");
		$get = mysqli_fetch_row($hasil);
		if($get[0] != 'payment') {
			echo "Must on state payment!";
			exit;
		}
		$hasil = mysqli_query($con, "SELECT ref FROM parameter WHERE id=6");
		$get1 = mysqli_fetch_row($hasil);
		$hasil = mysqli_query($con, "SELECT ref FROM parameter WHERE id=2");
		$get2 = mysqli_fetch_row($hasil);
		mysqli_query($con, "INSERT INTO journal VALUES(null,now(),$get1[0],'Pembayaran Penjualan',$get[1],0,$id,null,1)");
		mysqli_query($con, "INSERT INTO journal VALUES(null,now(),$get2[0],'Pembayaran Penjualan',0,$get[1],$id,null,1)");
		mysqli_query($con, "UPDATE sales_order SET status='done' WHERE id=$id");
		echo "Berhasil";
	}
?>