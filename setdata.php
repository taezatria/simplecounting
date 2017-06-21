<?php
	session_start();
	$con = mysqli_connect("localhost","root","","accounting");

	if(isset($_POST['setup'])) {
		$query = "SELECT * FROM coa";
		$exe = mysqli_query($con, $query);
		$exe2 = mysqli_query($con, "SELECT * FROM parameter ORDER BY id");
		$data[0] = [];
		while($hasil = mysqli_fetch_assoc($exe)) {
			array_push($data[0],$hasil);
		}
		$data[1] = [];
		while($hasil = mysqli_fetch_assoc($exe2)) {
			array_push($data[1],$hasil);
		}
		echo json_encode($data);
	}
	if(isset($_POST['save'])) {
		$ref = $_POST['dta'];
		for($i=0 ; $i<6 ; $i++) {
			mysqli_query($con, "UPDATE parameter SET ref=$ref[$i] WHERE id=$i+1");
		}
		echo "Berhasil";
	}
?>