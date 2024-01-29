<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');
	
	if(isset($_POST['customerFullName'])){
		
		$fullName = htmlentities($_POST['customerFullName']);
		$mobile = htmlentities($_POST['customerDetailsCustomerMobile']);
		$city = htmlentities($_POST['customerDetailsCustomerCity']);
		$status = htmlentities($_POST['customerDetailsStatus']);

		
		if(isset($fullName) && isset($mobile)) {
			
			
			// Check if Full name is empty or not
			if($fullName == ''){
				// Full Name is empty
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter Full Name.</div>';
				exit();
			}
			
			// Start the insert process
			$sql = 'INSERT INTO customer(fullName, mobile, city, status) VALUES(:fullName, :mobile, :city, :status)';
			$stmt = $conn->prepare($sql);
			$stmt->execute(['fullName' => $fullName, 'mobile' => $mobile, 'city' => $city, 'status' => $status]);
			echo '<div id="customerid" class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Customer added Successfully</div>';
		} else {
			// One or more fields are empty
			echo '<div id="customerid" class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)</div>';
			exit();
		}
	}
?>