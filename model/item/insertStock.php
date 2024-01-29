<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');
	
	if(isset($_POST['itemstockid'])){
		$itemId = htmlentities($_POST['itemstockid']);
		$item = htmlentities($_POST['stockquantity']);  //new stock quantity
		$packQuantity = htmlentities($_POST['packQuantity']);  //new stock quantity
		$threshold = htmlentities($_POST['threshold']);  //new stock quantity
		$itemStock = $packQuantity * $item;
		
		// Check if mandatory fields are not empty
		if(!empty($itemId) && !empty($itemStock)){

			$checkUserSql = 'SELECT * FROM stock WHERE itemId = :itemId';
			$checkUserStatement = $conn->prepare($checkUserSql);
			$checkUserStatement->execute(['itemId' => $itemId]);
			// Check if Stock exists or not
			if($checkUserStatement->rowCount() > 0){
                $row = $checkUserStatement->fetch(PDO::FETCH_ASSOC);
                $newStock = $itemStock;
                $availableStock = $row['availableStock'] + $newStock;
                $totalStock = $row['totalStock'] + $newStock;
                $updateStockSql = 'UPDATE stock SET availableStock = :availableStock, newStock = :newStock, totalStock = :totalStock, pack = :pack, threshold = :threshold WHERE itemId = :itemId';
			    $checkUser32Statement = $conn->prepare($updateStockSql);
			    $checkUser32Statement->execute(['itemId' => $itemId, 'availableStock' => $availableStock, 'newStock'=> $newStock, 'totalStock'=> $totalStock, 'pack'=> $packQuantity, 'threshold'=> $threshold]);
                // echo 'some records';
				
				echo '<div id="stockid" class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Stock Saved Successfully</div>';
				exit();
			}

		} else {
			// One or more mandatory fields are empty. Therefore, display a the error message
			echo '<div id="stockid" class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)</div>';
			exit();
		}
	}else{
        echo 'No Category supplied';
    }
?>