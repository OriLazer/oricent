<?php
	$vendorNamesSql = 'SELECT * FROM item_category';
	$vendorNamesStatement = $conn->prepare($vendorNamesSql);
	$vendorNamesStatement->execute();
	
	if($vendorNamesStatement->rowCount() > 0) {
		while($row = $vendorNamesStatement->fetch(PDO::FETCH_ASSOC)) {
			echo '<option value="' .$row['item_category_id'] . '">' . strtoupper($row['item_category']) . '</option>';
		}
	}
	$vendorNamesStatement->closeCursor();
?>