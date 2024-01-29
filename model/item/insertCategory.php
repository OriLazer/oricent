<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');
	
	if(isset($_POST['itemCategory'])){
		
		$itemName = htmlentities($_POST['itemCategory']);
		
		// Check if mandatory fields are not empty
		if(!empty($itemName)){
			
				// Item does not exist, therefore, you can add it to DB as a new item
				// Start the insert process
				$insertItemSql = 'INSERT INTO item_category(item_category) VALUES(:itemName)';
				$insertItemStatement = $conn->prepare($insertItemSql);
				$insertItemStatement->execute(['itemName' => $itemName]);
				echo '<div id="catoid" class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Item Category added Successfully.</div>';
				exit();

		} else {
			// One or more mandatory fields are empty. Therefore, display a the error message
			echo '<div id="catoid" class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)</div>';
			exit();
		}
	}else{
        echo 'No Category supplied';
    }
?>