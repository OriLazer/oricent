<?php
	session_start();
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');
	
	if(isset($_POST['purchasedItemDetail'])){

		$purchasedItemDetail = htmlentities($_POST['purchasedItemDetail']);
		$purchaseDetailsQuantity = htmlentities($_POST['purchaseDetailsQuantity']);
		$purchaseDetailsUnitPrice = htmlentities($_POST['purchaseDetailsUnitPrice']);
		$purchaseDetailsTotal = $purchaseDetailsQuantity * $purchaseDetailsUnitPrice;

		// Check if mandatory fields are not empty
		if(isset($purchasedItemDetail) && isset($purchaseDetailsQuantity) && isset($purchaseDetailsUnitPrice) && isset($purchaseDetailsTotal)){
			
			// Check if itemNumber is empty
			if($purchasedItemDetail == ''){ 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please Select Item.</div>';
				exit();
			}
			
			// Check if itemName is empty
			if($purchaseDetailsQuantity == ''){ 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter Quantity.</div>';
				exit();
			}
			
			// Check if quantity is empty
			if($purchaseDetailsUnitPrice == ''){ 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter Unit Price.</div>';
				exit();
			}
			
			// Check if unit price is empty
			if($purchaseDetailsTotal == ''){ 
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter Total Cost.</div>';
				exit();
			}
			
			
			// Validate item quantity. It has to be an integer
			if(filter_var($purchaseDetailsQuantity, FILTER_VALIDATE_INT) === 0 || filter_var($purchaseDetailsQuantity, FILTER_VALIDATE_INT)){
				// Valid quantity
			} else {
				// Quantity is not a valid number
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for quantity.</div>';
				exit();
			}
			
			// Validate unit price. It has to be an integer or floating point value
			if(filter_var($purchaseDetailsUnitPrice, FILTER_VALIDATE_FLOAT) === 0.0 || filter_var($purchaseDetailsUnitPrice, FILTER_VALIDATE_FLOAT)){
				// Valid unit price
			} else {
				// Unit price is not a valid number
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter a valid number for unit price.</div>';
				exit();
			}
			
			// Check if the item exists in item table and 
			// calculate the stock values and update to match the new purchase quantity
			$stockSql = 'SELECT * FROM vw_rates WHERE itemId=:itemId';
			$stockStatement = $conn->prepare($stockSql);
			$stockStatement->execute(['itemId' => $purchasedItemDetail]);
			if($stockStatement->rowCount() > 0){
				$row = $stockStatement->fetch(PDO::FETCH_ASSOC);
				$purchaseDetailsItemName = $row['itemName'];
				$stock = $row['availableStock'];
				
				
				// Item exits in the item table, therefore, start the inserting data to purchase table
				$insertPurchaseSql = 'INSERT INTO general_sales(itemId, itemName, quantity, price, totalSales, userID) VALUES(:itemId, :itemName, :quantity, :price, :totalSales, :user)';
				$insertPurchaseStatement = $conn->prepare($insertPurchaseSql);
				$insertPurchaseStatement->execute(['itemId' => $purchasedItemDetail, 'itemName' => $purchaseDetailsItemName, 'quantity' => $purchaseDetailsQuantity, 'price' => $purchaseDetailsUnitPrice, 'totalSales' => $purchaseDetailsTotal, 'user' => $_SESSION['user']]);
				
				$newavailableStock = $stock - $purchaseDetailsQuantity;
				
				// Update the new stock value in item table
				$updateStockSql = 'UPDATE stock SET availableStock = :stock WHERE itemId = :itemId';
				$updateStockStatement = $conn->prepare($updateStockSql);
				$updateStockStatement->execute(['stock' => $newavailableStock, 'itemId' => $purchasedItemDetail]);
				
				echo '<div id="purchid" class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button>Purchase details added to database and stock values updated.</div>';
				exit();
				
			} else {
				// Item does not exist in item table, therefore, you can't make a purchase from it 
				// to add it to DB as a new purchase
				echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Item does not exist in DB. Therefore, first enter this item to DB using the <strong>Item</strong> tab.</div>';
				exit();
			}

		} else {
			// One or more mandatory fields are empty. Therefore, display a the error message
			echo '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button>Please enter all fields marked with a (*)</div>';
			exit();
		}
	}
?>