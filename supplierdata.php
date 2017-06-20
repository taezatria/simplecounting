<?php
	session_start();
	$con = mysqli_connect("localhost","root","","accounting");
	if(isset($_POST['show'])){
		$query = "SELECT * FROM supplier";
		$exe = mysqli_query($con, $query);
		$data = [];
		while($hasil = mysqli_fetch_assoc($exe)){
			array_push($data,$hasil);
		}
		echo json_encode($data);
	}
	if(isset($_POST['insert'])) {
		$nama = $_POST['nama'];
		$alamat = $_POST['alamat'];
		$phone = $_POST['telp'];
		$email = $_POST['email'];
		$query = "INSERT INTO supplier VALUES(null,'$nama','$alamat','$phone','$email')";
		$exe = mysqli_query($con, $query);
		echo "Success";
	}
	if(isset($_POST['detail'])) {
		$id = $_POST['idsupp'];
		$query = "SELECT * FROM purchases_order WHERE id_sup=$id ORDER BY tgl DESC";
		$exe = mysqli_query($con, $query);
		$data = [];
		while($hasil = mysqli_fetch_assoc($exe)){
			array_push($data, $hasil);
		}
		echo json_encode($data);
	}
?>