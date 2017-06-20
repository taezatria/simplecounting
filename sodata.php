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
		$id = 1;//$_POST['idso'];
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
		for($i=0; $i < sizeof($iditems); $i++) {
			mysqli_query($con, "INSERT INTO det_sales VALUES(null,$amount[$i],$subtotal[$i],0,$idso[0],$iditems[$i])");
			mysqli_query($con, "UPDATE inventory SET stock=stock-$amount[$i] WHERE id=$iditems[$i]");
		}
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
?>