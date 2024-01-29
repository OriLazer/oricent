<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');
	
	$total = 0;
    $count = 1;
	
	if(isset($_POST['startDate'])){
		// $startDate = strtotime('2023-04-01');
		$startDate = htmlentities($_POST['startDate']);
		// echo $startDate;
		// $endDate = strtotime('2023-04-24');
		$endDate = htmlentities($_POST['endDate']);
		// echo $endDate;
		
		$saleFilteredReportSql = 'SELECT itemName, availableStock, totalStock, salesId, sum(quantity) as totquantity, sum(totalSales) as totsales FROM vw_general_sales WHERE DATE(salesDate) BETWEEN :startDate AND :endDate GROUP BY itemId';
		$saleFilteredReportStatement = $conn->prepare($saleFilteredReportSql);
		$saleFilteredReportStatement->execute(['startDate' => $startDate, 'endDate' => $endDate]);

		$output = '<table id="saleItemFilteredReportsTable" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
					<thead>
						<tr>
							<th>Sales ID</th>
							<th>Item Name</th>
							<th>Quantity</th>
							<th>Amount</th>
							<th>Available Stock</th>
							<th>Total Stock</th>
						</tr>
					</thead>
					<tbody>';
		
		// Create table rows from the selected data
		while($row = $saleFilteredReportStatement->fetch(PDO::FETCH_ASSOC)){
			$total += $row['totsales'];
		
			$output .= '<tr>' .
							'<td>' . $count . '</td>' .
							'<td>' . $row['itemName'] . '</td>' .
							'<td>' . $row['totquantity'] . '</td>' .
							'<td>' . $row['totsales'] . '</td>' .
							'<td>' . $row['availableStock'] . '</td>' .
							'<td>' . $row['totalStock'] . '</td>' .
						'</tr>';
            $count++;
        }
		
		$saleFilteredReportStatement->closeCursor();
		
		$output .= '</tbody>
						<tfoot>
							<tr>
								<th>TOTAL</th>
								<th></th>
								<th></th>
								<th>'.number_format($total, 2).'</th>
								<th></th>
								<th></th>
							</tr>
						</tfoot>
					</table>';
		echo $output;
	}
?>


