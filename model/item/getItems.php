<?php
	$vendorNamesSql = 'SELECT * FROM items';
	$vendorNamesStatement = $conn->prepare($vendorNamesSql);
	$vendorNamesStatement->execute();
	
	if($vendorNamesStatement->rowCount() > 0) {
		while($row = $vendorNamesStatement->fetch(PDO::FETCH_ASSOC)) {
			echo '<option value="' .$row['itemId'] . '">' . strtoupper($row['itemName']) . '</option>';
		}
	}
	$vendorNamesStatement->closeCursor();
?>