<?php
	session_start();
	$con = mysqli_connect("localhost","root","","accounting");
	if(isset($_POST['show'])){
		$query = "SELECT * FROM journal";
		$exe = mysqli_query($con, $query);
		$data = [];
		while($hasil = mysqli_fetch_assoc($exe)){
			$hasil['date'] = date_format(date_create($hasil['tgl']),"j-F-Y");
			$hasil['time'] = date_format(date_create($hasil['tgl']),"g:i:s A");
			array_push($data,$hasil);
		}
		echo json_encode($data);
	}
	if(isset($_POST['search'])){
		$query = "SELECT * FROM journal";
		$exe = mysqli_query($con, $query);
		$data = [];
		while($hasil = mysqli_fetch_assoc($exe)){
			$hasil['date'] = date_format(date_create($hasil['tgl']),"j-F-Y");
			$hasil['time'] = date_format(date_create($hasil['tgl']),"g:i:s A");
			array_push($data,$hasil);
		}
		echo json_encode($data);
	}
	if(isset($_POST['type'])) {
		$query = "SELECT * FROM type";
		$exe = mysqli_query($con, $query);
		$data = [];
		while($hasil = mysqli_fetch_assoc($exe)){
			array_push($data,$hasil);
		}
		echo json_encode($data);
	}
	if(isset($_POST['add'])) {
		$ref = $_POST['ref'];
		$name = $_POST['name'];
		$norm = $_POST['norm'];
		$type = $_POST['type'];
		$query = "INSERT INTO coa VALUES('$ref','$name','$norm','$type')";
		$exe = mysqli_query($con, $query);
		echo "Berhasil";
	}
	if(isset($_POST['journal'])) {
		$ref = $_POST['ref'];
		$desc = $_POST['desc'];
		$val = $_POST['val'];
		$tgl = $_POST['tgl'];
		$norm = $_POST['norm'];
		for($i=0 ; $i < sizeof($ref); $i++){
			if($norm[$i] == 'debit') {
				mysqli_query($con,"INSERT INTO journal VALUES(null,'$tgl','$ref[$i]','$desc[$i]','$val[$i]',null,null,null,0)");
			}
			else {
				mysqli_query($con,"INSERT INTO journal VALUES(null,'$tgl','$ref[$i]','$desc[$i]',null,'$val[$i]',null,null,0)");
			}
		}
		echo "Berhasil";
	}
?>