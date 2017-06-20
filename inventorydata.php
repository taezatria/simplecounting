<?php
	session_start();
	$con = mysqli_connect("localhost","root","","accounting");
	if(isset($_POST['show'])){
		$query = "SELECT * FROM inventory";
		$exe = mysqli_query($con, $query);
		$data = [];
		while($hasil = mysqli_fetch_assoc($exe)){
			array_push($data,$hasil);
		}
		echo json_encode($data);
	}
	if(isset($_POST['detail'])) {
		$id = $_POST['idinvent'];
		$query1 = "SELECT tgl, purchases_order.id as id_po, det_purchases.id as id, amount, subtotal, received FROM det_purchases JOIN purchases_order ON id_po = purchases_order.id WHERE id_invent=$id ORDER BY tgl DESC";
		$query2 = "SELECT tgl, sales_order.id as id_so, det_sales.id as id, amount, subtotal, sent FROM det_sales JOIN sales_order ON id_so = sales_order.id WHERE id_invent=$id ORDER BY tgl DESC";
		$exe1 = mysqli_query($con, $query1);
		$exe2 = mysqli_query($con, $query2);
		$data[0] = [];
		while($hasil = mysqli_fetch_assoc($exe1)){
			array_push($data[0], $hasil);
		}
		$data[1] = [];
		while($hasil = mysqli_fetch_assoc($exe2)){
			array_push($data[1], $hasil);
		}
		echo json_encode($data);
	}
?>