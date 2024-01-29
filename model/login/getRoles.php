<?php
	$vendorNamesSql = 'SELECT * FROM roles';
	$vendorNamesStatement = $conn->prepare($vendorNamesSql);
	$vendorNamesStatement->execute();
	
	if($vendorNamesStatement->rowCount() > 0) {
		while($row = $vendorNamesStatement->fetch(PDO::FETCH_ASSOC)) {
            
			echo '<option value="'.$row['role_id'] .'">'.$row['role'].'</option>';
		}
	}
	$vendorNamesStatement->closeCursor();
?>