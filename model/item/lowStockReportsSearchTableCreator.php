<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');
	
	$customerDetailsSearchSql = 'SELECT * FROM vw_rates';
	$customerDetailsSearchStatement = $conn->prepare($customerDetailsSearchSql);
	$customerDetailsSearchStatement->execute();

	$output = '<table id="lowStockReportsTable" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
				<thead>
					<tr>
						<th>Item ID</th>
						<th>Item Name</th>
						<th>Item Description</th>
						<th>Stock Price</th>
						<th>Available Stock</th>
						<th>Threshold</th>
					</tr>
				</thead>
				<tbody>';
	
	// Create table rows from the selected data
	while($row = $customerDetailsSearchStatement->fetch(PDO::FETCH_ASSOC)){

		$output .= '<tr>' .
						'<td>' . $row['itemId'] . '</td>' .
						'<td>' . $row['itemName'] . '</td>' .
						'<td>' . $row['itemDesc'] . '</td>' .
						'<td>' . $row['price'] . '</td>' .
						'<td>' . $row['availableStock'] . '</td>' .
						'<td>' . $row['threshold'] . '</td>' .
					'</tr>';
	}
	
	$customerDetailsSearchStatement->closeCursor();
	
	$output .= '</tbody>
					<tfoot>
						<tr>
                            <th>Item ID</th>
                            <th>Item Name</th>
                            <th>Item Description</th>
                            <th>Stock Price</th>
                            <th>Available Stock</th>
                            <th>threshold</th>
						</tr>
					</tfoot>
				</table>';
	echo $output;
?>