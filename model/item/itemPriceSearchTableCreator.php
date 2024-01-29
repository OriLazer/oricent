<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');
	
	$itemDetailsSearchSql = 'SELECT * FROM vw_rates';
	$itemDetailsSearchStatement = $conn->prepare($itemDetailsSearchSql);
	$itemDetailsSearchStatement->execute();
	
	$output = '<table id="itemPriceTable" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
				<thead>
					<tr>
						<th>Item ID</th>
						<th>Item Name</th>
						<th>Item Description</th>
						<th>Item Price</th>
					</tr>
				</thead>
				<tbody>';
	
	// Create table rows from the selected data
	while($row = $itemDetailsSearchStatement->fetch(PDO::FETCH_ASSOC)){
		
		$output .= '<tr>' .
						'<td>' . $row['itemId'] . '</td>' .
						'<td>' . $row['itemName'] . '</td>' .
						'<td>' . $row['itemDesc'] . '</td>' .
						'<td>' . $row['price'] . '</td>' .
					'</tr>';
	}
	
	$itemDetailsSearchStatement->closeCursor();
	
	$output .= '</tbody>
					<tfoot>
						<tr>
							<th>Item ID</th>
							<th>Item Name</th>
							<th>Item Description</th>
							<th>Item Price</th>
						</tr>
					</tfoot>
				</table>';
	echo $output;
?>