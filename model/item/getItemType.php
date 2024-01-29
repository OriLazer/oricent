<?php
	$vendorNamesSql = 'SELECT * FROM item_type';
	$vendorNamesStatement = $conn->prepare($vendorNamesSql);
	$vendorNamesStatement->execute();
	
	if($vendorNamesStatement->rowCount() > 0) {
		while($row = $vendorNamesStatement->fetch(PDO::FETCH_ASSOC)) {
			echo '<option value="' .$row['item_type_id'] . '">' . strtoupper($row['item_type']) . '</option>';
		}
	}
	$vendorNamesStatement->closeCursor();
?>