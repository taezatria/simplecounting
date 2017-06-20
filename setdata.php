<?php
	session_start();
	$con = mysqli_connect("localhost","root","","accounting");

	if(isset($_POST['setup'])) {
		$query = "SELECT * FROM coa";
		$exe = mysqli_query($con, $query);
		$data = [];
		while($hasil = mysqli_fetch_assoc($exe)) {
			array_push($data,$hasil);
		}
		echo json_encode($data);
	}
?>