<?php
    session_start();
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');
	
	$itemDetailsSearchSql = "SELECT * FROM vw_general_sales_more";
	$itemDetailsSearchStatement = $conn->prepare($itemDetailsSearchSql);
	$itemDetailsSearchStatement->execute();
	
	$output = '<table id="itemReportsTable" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
				<thead>
					<tr>
						<th>Sales ID</th>
						<th>Item Name</th>
						<th>Quantity</th>
						<th>Unit Price</th>
						<th>Amount</th>
						<th>Sales Date</th>
						<th>User</th>
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
						'<td>' . $row['fullName'] . '</td>' .
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
							<th>User</th>
						</tr>
					</tfoot>
				</table>';
	echo $output;
?>


<?php
// 	require_once('../../inc/config/constants.php');
// 	require_once('../../inc/config/db.php');
	
// 	$itemDetailsSearchSql = 'SELECT * FROM item';
// 	$itemDetailsSearchStatement = $conn->prepare($itemDetailsSearchSql);
// 	$itemDetailsSearchStatement->execute();

// 	$output = '<table id="itemReportsTable" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
// 				<thead>
// 					<tr>
// 						<th>Product ID</th>
// 						<th>Item Number</th>
// 						<th>Item Name</th>
// 						<th>Discount %</th>
// 						<th>Stock</th>
// 						<th>Unit Price</th>
// 						<th>Status</th>
// 						<th>Description</th>
// 					</tr>
// 				</thead>
// 				<tbody>';
	
// 	// Create table rows from the selected data
// 	while($row = $itemDetailsSearchStatement->fetch(PDO::FETCH_ASSOC)){
// 		$output .= '<tr>' .
// 						'<td>' . $row['productID'] . '</td>' .
// 						'<td>' . $row['itemNumber'] . '</td>' .
// 						//'<td>' . $row['itemName'] . '</td>' .
// 						'<td><a href="#" class="itemDetailsHover" data-toggle="popover" id="' . $row['productID'] . '">' . $row['itemName'] . '</a></td>' .
// 						'<td>' . $row['discount'] . '</td>' .
// 						'<td>' . $row['stock'] . '</td>' .
// 						'<td>' . $row['unitPrice'] . '</td>' .
// 						'<td>' . $row['status'] . '</td>' .
// 						'<td>' . $row['description'] . '</td>' .
// 					'</tr>';
// 	}
	
// 	$itemDetailsSearchStatement->closeCursor();
	
// 	$output .= '</tbody>
// 					<tfoot>
// 						<tr>
// 							<th>Product ID</th>
// 							<th>Item Number</th>
// 							<th>Item Name</th>
// 							<th>Discount %</th>
// 							<th>Stock</th>
// 							<th>Unit Price</th>
// 							<th>Status</th>
// 							<th>Description</th>
// 						</tr>
// 					</tfoot>
// 				</table>';
// 	echo $output;
// ?>