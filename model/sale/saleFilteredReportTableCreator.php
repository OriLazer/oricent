<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');
	
	$total = 0;
	
	if(isset($_POST['startDate'])){
		// $startDate = strtotime('2023-04-01');
		$startDate = htmlentities($_POST['startDate']);
		// echo $startDate;
		// $endDate = strtotime('2023-04-24');
		$endDate = htmlentities($_POST['endDate']);
		// echo $endDate;
		
		$saleFilteredReportSql = 'SELECT * FROM vw_general_sales WHERE DATE(salesDate) BETWEEN :startDate AND :endDate';
		$saleFilteredReportStatement = $conn->prepare($saleFilteredReportSql);
		$saleFilteredReportStatement->execute(['startDate' => $startDate, 'endDate' => $endDate]);

		$output = '<table id="saleFilteredReportsTable" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
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
		while($row = $saleFilteredReportStatement->fetch(PDO::FETCH_ASSOC)){
			$total += $row['totalSales'];
		
			$output .= '<tr>' .
							'<td>' . $row['salesId'] . '</td>' .
							'<td>' . $row['itemName'] . '</td>' .
							'<td>' . $row['quantity'] . '</td>' .
							'<td>' . $row['price'] . '</td>' .
							'<td>' . $row['totalSales'] . '</td>' .
							'<td>' . $row['salesDate'] . '</td>' .
						'</tr>';
		}
		
		$saleFilteredReportStatement->closeCursor();
		
		$output .= '</tbody>
						<tfoot>
							<tr>
								<th>TOTAL</th>
								<th></th>
								<th></th>
								<th></th>
								<th>'.$total.'</th>
								<th></th>
							</tr>
						</tfoot>
					</table>';
		echo $output;
	}
?>


