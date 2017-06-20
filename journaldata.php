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
?>