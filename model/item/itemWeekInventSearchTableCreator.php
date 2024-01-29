<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');
	
	$itemDetailsSearchSql = 'SELECT * FROM vw_week_inventory';
	$itemDetailsSearchStatement = $conn->prepare($itemDetailsSearchSql);
	$itemDetailsSearchStatement->execute();
	
	$output = '<table id="itemWeekInventTable" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
				<thead>
					<tr>
						<th>Item ID</th>
						<th>Item Name</th>
						<th>Inventory Quantity</th>
						<th>Inventory Date</th>
					</tr>
				</thead>
				<tbody>';
	
	// Create table rows from the selected data
	while($row = $itemDetailsSearchStatement->fetch(PDO::FETCH_ASSOC)){
		
		$output .= '<tr>' .
						'<td>' . $row['itemId'] . '</td>' .
						'<td>' . $row['itemName'] . '</td>' .
						'<td>' . $row['week_inv_quantity'] . '</td>' .
						'<td>' . $row['inventoryDate'] . '</td>' .
					'</tr>';
	}
	
	$itemDetailsSearchStatement->closeCursor();
	
	$output .= '</tbody>
					<tfoot>
						<tr>
                            <th>Item ID</th>
                            <th>Item Name</th>
                            <th>Inventory Quantity</th>
                            <th>Inventory Date</th>
						</tr>
					</tfoot>
				</table>';
	echo $output;
?>