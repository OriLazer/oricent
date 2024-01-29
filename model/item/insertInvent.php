<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');
	
	if(isset($_POST['itemInventid'])){
		$itemId = htmlentities($_POST['itemInventid']);
		$itemStock = htmlentities($_POST['InventQuantity']);  //new stock quantity
        $status = 1;

        // echo $itemId;
        // echo $itemPrice;
        // echo $status;
		
		// Check if mandatory fields are not empty
		if(!empty($itemId) && !empty($itemStock) && !empty($status)){

			$checkUserSql = 'SELECT * FROM inventory WHERE itemId = :itemId AND inventory_status = :pricestatus';
			$checkUserStatement = $conn->prepare($checkUserSql);
			$checkUserStatement->execute(['itemId' => $itemId, 'pricestatus' => $status]);
			
			// Check if user exists or not
			if($checkUserStatement->rowCount() > 0){
				// Valid credentials. Hence, start the session
                $newstatus = 0;
                $updateStockSql = 'UPDATE inventory SET inventory_status = :pricestatus WHERE itemId = :itemId';
			    $checkUser32Statement = $conn->prepare($updateStockSql);
			    $checkUser32Statement->execute(['itemId' => $itemId, 'pricestatus' => $newstatus]);
                // echo 'some records';


                $insertItemSql = 'INSERT INTO inventory(itemId,week_inv_quantity,inventory_status) VALUES(:itemId, :itemPrice, :pricestatus)';
				$insertItemStatement = $conn->prepare($insertItemSql);
				$insertItemStatement->execute(['itemId' => $itemId, 'itemPrice'=> $itemStock, 'pricestatus'=> $status]);
				
				echo '<div id="inventid" class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Inventory Saved Successfully</div>';
				exit();
			} else {
                // echo 'No records';
                $insertItemSql = 'INSERT INTO inventory(itemId,week_inv_quantity,inventory_status) VALUES(:itemId, :itemPrice, :pricestatus)';
				$insertItemStatement = $conn->prepare($insertItemSql);
				$insertItemStatement->execute(['itemId' => $itemId, 'itemPrice'=> $itemStock, 'pricestatus'=> $status]);
				echo '<div id="inventid" class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>New Item Inventory Saved Successfully</div>';
				exit();
			}

		} else {
			// One or more mandatory fields are empty. Therefore, display a the error message
			echo '<div id="inventid" class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)</div>';
			exit();
		}
	}else{
        echo 'No Category supplied';
    }
?>