<?php
	require_once('../../inc/config/constants.php');
	require_once('../../inc/config/db.php');
	
	$total = 0;
	
	if(isset($_POST['startDate'])){
		$startDate = strtotime('2023-04-01');
		// $startDate = htmlentities($_POST['startDate']);
		// echo $startDate;
		$endDate = strtotime('2023-04-24');
		// $endDate = htmlentities($_POST['endDate']);
		// echo $endDate;
		
		$saleFilteredReportSql = 'SELECT itemCategory, SUM(totalSales) as amount, itemCategoryName FROM vw_general_sales WHERE DATE(salesDate) BETWEEN :startDate AND :endDate GROUP BY itemCategory';
		$saleFilteredReportStatement = $conn->prepare($saleFilteredReportSql);
		$saleFilteredReportStatement->execute(['startDate' => $startDate, 'endDate' => $endDate]);

		$output = '<table id="saleSumFilteredReportsTable" class="table table-sm table-striped table-bordered table-hover" style="width:100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Item Category</th>
							<th>Amount</th>
						</tr>
					</thead>
					<tbody>';
		
		// Create table rows from the selected data
		while($row = $saleFilteredReportStatement->fetch(PDO::FETCH_ASSOC)){
			$total += $row['amount'];
		
			$output .= '<tr>' .
							'<td>' . $row['itemCategory'] . '</td>' .
							'<td>' . $row['itemCategoryName'] . '</td>' .
							'<td>' .  number_format($row['amount'], 2, '.') . '</td>' .
						'</tr>';
		}
		
		$saleFilteredReportStatement->closeCursor();
		
		$output .= '</tbody>
						<tfoot>
							<tr>
								<th>TOTAL</th>
								<th></th>
								<th>'.number_format($total, 2, '.').'</th>
							</tr>
						</tfoot>
					</table>';
		echo $output;
	}
?>


