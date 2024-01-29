<?php
//require database
	require_once('inc/config/constants.php');
	require_once('inc/config/db.php');

$sql = "select * from user";
if(!$conn->query($sql)){
	echo "Error in connecting";
}else{
	$result = $conn->query($sql);
	if($result->num_rows > 0){
		$return_arr['masterlist'] = array();
		while($row = $result->fetch_array()){
			array_push($return_arr['masterlist'], array(
				'user'=>$row['userID'],
				'name' =>$row['fullName'],
				'username' =>$row['username'],
				'password' =>$row['password'],
				'status' =>$row['status']

			));
		}
		echo json_encode($return_arr);
	}
}