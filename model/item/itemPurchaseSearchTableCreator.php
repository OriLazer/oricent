<?php
    session_start();
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');
	
	$itemDetailsSearchSql = "SELECT * FROM vw_general_sales WHERE DATE(salesDate)=CURDATE() and userId = '".$_SESSION['user']."'";
	$itemDetailsSearchStatement = $conn->prepare($itemDetailsSearchSql);
	$itemDetailsSearchStatement->execute();
	
	$output = '<table id="itemPurchaseTable" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
				<thead>
					<tr>
						<th>Sales ID</th>
						<th>Item Name</th>
						<th>Quantity</th>
						<th>Unit Price</th>
						<th>Amount</th>
						<th>Sales Date</th>
					</tr>
				</thead>
				<tbody>';
	
	// Create table rows from the selected data
	while($row = $itemDetailsSearchStatement->fetch(PDO::FETCH_ASSOC)){
		
		$output .= '<tr>' .
						'<td>' . $row['salesId'] . '</td>' .
						'<td>' . $row['itemName'] . '</td>' .
						'<td>' . $row['quantity'] . '</td>' .
						'<td>' . $row['price'] . '</td>' .
						'<td>' . $row['totalSales'] . '</td>' .
						'<td>' . $row['salesDate'] . '</td>' .
					'</tr>';
	}
	
	$itemDetailsSearchStatement->closeCursor();
	
	$output .= '</tbody>
					<tfoot>
						<tr>
							<th>Sales ID</th>
							<th>Item Name</th>
							<th>Quantity</th>
							<th>Unit Price</th>
							<th>Amount</th>
							<th>Sales Date</th>
						</tr>
					</tfoot>
				</table>';
	echo $output;
?>