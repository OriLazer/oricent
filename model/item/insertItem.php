<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');
	
	if(isset($_POST['itemName'])){
		
		$itemName = htmlentities($_POST['itemName']);
		$itemType = htmlentities($_POST['itemType']);
		$itemCategory = htmlentities($_POST['itemCategory']);
		$itemStatus = htmlentities($_POST['itemStatus']);
		$itemDescription = htmlentities($_POST['itemDescription']);
		$itemprice = htmlentities($_POST['itemprice']);
		$status = 1;

		// Check if mandatory fields are not empty
		if(!empty($itemName) && !empty($itemType) && isset($itemCategory) && isset($itemStatus) && isset($itemDescription)){
				$insertItemSql = 'INSERT INTO items(itemName,itemType,itemCategory,itemDesc,item_status) VALUES(:itemName, :itemType, :itemCategory, :itemDescription, :itemStatus)';
				$insertItemStatement = $conn->prepare($insertItemSql);
				$insertItemStatement->execute(['itemName' => $itemName, 'itemType' => $itemType, 'itemCategory' => $itemCategory, 'itemDescription' => $itemDescription, 'itemStatus' => $itemStatus]);
				
				$lastid = $conn->lastInsertId();
				$insertStockSql = 'INSERT INTO stock(itemId) VALUES(:itemId)';
				$insertStockStatement = $conn->prepare($insertStockSql);
				$insertStockStatement->execute(['itemId' => $lastid]);

				$insertPriceSql = 'INSERT INTO prices(itemId,price,price_status) VALUES(:itemId, :price, :price_status)';
				$insertPriceStatement = $conn->prepare($insertPriceSql);
				$insertPriceStatement->execute(['itemId' => $lastid, 'price' => $itemprice, 'price_status' => $status]);


				echo '<div id="iiid" class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Item added Successfully.</div>';
				exit();

		} else {
			// One or more mandatory fields are empty. Therefore, display a the error message
			echo '<div id="iiid" class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)</div>';
			exit();
		}
	}
?>