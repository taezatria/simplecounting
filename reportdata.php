<?php
	session_start();
	$con = mysqli_connect("localhost","root","","accounting");
	if(isset($_POST['balance'])) {

	}
	if(isset($_POST['income'])) {
		$hasil2 = mysqli_query($con, "SELECT * FROM coa WHERE type=4");
		$hasil1 = mysqli_query($con, "SELECT * FROM coa WHERE type=5");
		$data['credit'] = [];
		while($row = mysqli_fetch_row($hasil1)){
			$temp = mysqli_query($con, "SELECT * FROM journal WHERE ref=$row[0]");
			$total = 0;
			while($temprow = mysqli_fetch_assoc($temp)){
				$total += $temprow['credit'];
			}
			if($total != 0){
				$arr['ref'] = $row[0];
				$arr['name'] = $row[1];
				$arr['total'] = $total;
				array_push($data['credit'], $arr);
			}
		}
		$data['debit'] = [];
		while($row = mysqli_fetch_row($hasil2)){
			$temp = mysqli_query($con, "SELECT * FROM journal WHERE ref=$row[0]");
			$total = 0;
			while($temprow = mysqli_fetch_assoc($temp)){
				$total += $temprow['debit'];
			}
			if($total != 0){
				$arr['ref'] = $row[0];
				$arr['name'] = $row[1];
				$arr['total'] = $total;
				array_push($data['debit'], $arr);
			}
		}
		echo json_encode($data);
	}
	if(isset($_POST['owner'])) {
		
	}
?>