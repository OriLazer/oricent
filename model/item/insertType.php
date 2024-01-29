<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');
	
	if(isset($_POST['itemDetailsItemName'])){
		
		$itemName = htmlentities($_POST['itemDetailsItemName']);
		
		// Check if mandatory fields are not empty
		if(!empty($itemName)){
			
				// Item does not exist, therefore, you can add it to DB as a new item
				// Start the insert process
				$insertItemSql = 'INSERT INTO item_type(item_type) VALUES(:itemName)';
				$insertItemStatement = $conn->prepare($insertItemSql);
				$insertItemStatement->execute(['itemName' => $itemName]);
				echo '<div id="typeid" class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Item Type added to database.</div>';
				exit();

		} else {
			// One or more mandatory fields are empty. Therefore, display a the error message
			echo '<div id="typeid" class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)</div>';
			exit();
		}
	}
?>