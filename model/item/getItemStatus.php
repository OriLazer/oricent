<?php
	$vendorNamesSql = 'SELECT * FROM item_status';
	$vendorNamesStatement = $conn->prepare($vendorNamesSql);
	$vendorNamesStatement->execute();
	
	if($vendorNamesStatement->rowCount() > 0) {
		while($row = $vendorNamesStatement->fetch(PDO::FETCH_ASSOC)) {
			echo '<option value="' .$row['item_status_id'] . '">' . strtoupper($row['item_status']) . '</option>';
		}
	}
	$vendorNamesStatement->closeCursor();
?>