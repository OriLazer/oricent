<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');
	
	$itemDetailsSearchSql = 'SELECT * FROM vw_rates';
	$itemDetailsSearchStatement = $conn->prepare($itemDetailsSearchSql);
	$itemDetailsSearchStatement->execute();
	
	$output = '<table id="itemDetailsTable" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
				<thead>
					<tr>
						<th>Item ID</th>
						<th>Item Name</th>
						<th>Item Description</th>
						<th>Item Type</th>
						<th>Item Category</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>';
	
	// Create table rows from the selected data
	while($row = $itemDetailsSearchStatement->fetch(PDO::FETCH_ASSOC)){
		
		$output .= '<tr>' .
						'<td>' . $row['itemId'] . '</td>' .
						'<td>' . $row['itemName'] . '</td>' .
						'<td>' . $row['itemDesc'] . '</td>' .
						'<td>' . $row['item_type'] . '</td>' .
						'<td>' . $row['item_category'] . '</td>' .
						'<td>' . $row['item_status'] . '</td>' .
					'</tr>';
	}
	
	$itemDetailsSearchStatement->closeCursor();
	
	$output .= '</tbody>
					<tfoot>
						<tr>
							<th>Item ID</th>
							<th>Item Name</th>
							<th>Item Description</th>
							<th>Item Type</th>
							<th>Item Category</th>
							<th>Status</th>
						</tr>
					</tfoot>
				</table>';
	echo $output;
?>