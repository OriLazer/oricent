<?php
	session_start();
	// Redirect the user to login page if the user is not logged in.
	if(!isset($_SESSION['loggedIn'])){
		header('Location: login.php');
		exit();
	}
	
	require_once('inc/config/constants.php');
	require_once('inc/config/db.php');
	require_once('inc/header.html');
?>
  <body>
<?php
	require 'inc/navigation.php';
?>
    <!-- Page Content -->
    <div class="container-fluid">
	  <div class="row">
		<div class="col-lg-2">
		<h4 class="my-4"><?php echo $_SESSION['role_name']; ?></h4>
		<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
			  <a class="nav-link active" id="v-pills-sale-tab" data-toggle="pill" href="#v-pills-sale" role="tab" aria-controls="v-pills-sale" aria-selected="false">Daily Sales</a>
			  <a class="nav-link" id="v-pills-purchase-tab" data-toggle="pill" href="#v-pills-purchase" role="tab" aria-controls="v-pills-purchase" aria-selected="false">Add Sold Item</a>
		<?php if ($_SESSION['role']== 2) { ?>
			  <a class="nav-link" id="v-pills-search-tab" data-toggle="pill" href="#v-pills-search" role="tab" aria-controls="v-pills-search" aria-selected="false">Search</a>
			  <a class="nav-link" id="v-pills-item-tab" data-toggle="pill" href="#v-pills-type" role="tab" aria-controls="v-pills-item" aria-selected="true"> Item Type Entry</a>
			  <a class="nav-link" id="v-pills-item-tab" data-toggle="pill" href="#v-pills-category" role="tab" aria-controls="v-pills-item" aria-selected="true">Item Category Entry</a>
			  <a class="nav-link" id="v-pills-item-tab" data-toggle="pill" href="#v-pills-item" role="tab" aria-controls="v-pills-item" aria-selected="true">Inventory (Item) Entry</a>
			  <a class="nav-link" id="v-pills-sales-tab" data-toggle="pill" href="#v-pills-inventory" role="tab" aria-controls="v-pills-sales" aria-selected="false">Weekly Inventory Entry</a>
			  <a class="nav-link" id="v-pills-customer-tab" data-toggle="pill" href="#v-pills-customer" role="tab" aria-controls="v-pills-customer" aria-selected="false">Customer Entry</a>
		<?php }elseif ($_SESSION['role']== 1) { ?>
			
		<?php } ?>
			<a class="nav-link" id="v-pills-item-tab" data-toggle="pill" href="#v-pills-prices" role="tab" aria-controls="v-pills-item" aria-selected="true">Item Prices <?php if ($_SESSION['role']== 2) { echo 'Update'; }?></a>
			<a class="nav-link" id="v-pills-sales-tab" data-toggle="pill" href="#v-pills-stock" role="tab" aria-controls="v-pills-sales" aria-selected="false">Stock <?php if ($_SESSION['role']== 2) { echo 'Entry'; } ?></a>
			<a class="nav-link" id="v-pills-reports-tab" data-toggle="pill" href="#v-pills-reports" role="tab" aria-controls="v-pills-reports" aria-selected="false">Reports</a>

		</div>

		</div>
		 <div class="col-lg-10">
			<div class="tab-content" id="v-pills-tabContent">
			<div class="tab-pane fade" id="v-pills-type" role="tabpanel" aria-labelledby="v-pills-item-tab">
				<div class="card card-outline-secondary my-4">
				
				<div class="card-header">Item Type<button id="itemTypeTablesRefresh" name="itemTypeTablesRefresh" class="btn btn-warning float-right btn-sm">Refresh</button></div>
				  <!-- <div class="card-header">Item Type</div> -->
				  <div class="card-body">
					<div class="tab-content">
						<div id="itemDetailsTab" class="container-fluid tab-pane active">
							<br>
							<!-- Div to show the ajax message from validations/db submission -->
							<div id="itemTypeMessage"></div>
							<form id="typeform">
							  <div class="form-row">
								  <div class="form-group col-md-6">
									<label for="itemName">Item Type<span class="requiredIcon">*</span></label>
									<input type="text" class="form-control" name="itemType" id="itemType" autocomplete="off">
								  </div>
							  </div>
							  <button type="button" id="addType" class="btn btn-success">Add Type</button>
							  <button type="reset" class="btn" id="itemClear">Clear</button>
							</form>
						</div>
					</div>
					<div id="itemType" class="container-fluid tab-pane active">
						  <br>
						  <p>Use the grid below to search all details of items</p>
						  <!-- <a href="#" class="itemDetailsHover" data-toggle="popover" id="10">wwwee</a> -->
							<div class="table-responsive" id="itemTypeTableDiv"></div>
					</div>
				  </div> 
				</div>
			  </div>

			  <div class="tab-pane fade" id="v-pills-category" role="tabpanel" aria-labelledby="v-pills-item-tab">
				<div class="card card-outline-secondary my-4">
				<div class="card-header">Item Category<button id="itemCategoryTablesRefresh" name="itemCategoryTablesRefresh" class="btn btn-warning float-right btn-sm">Refresh</button></div>
				  <!-- <div class="card-header">Item Category</div> -->
				  <div class="card-body">
					<div class="tab-content">
						<div id="itemDetailsTab" class="container-fluid tab-pane active">
							<br>
							<!-- Div to show the ajax message from validations/db submission -->
							<div id="itemCategoryMessage"></div>
							<form id="categoryform">
							  <div class="form-row">
								  <div class="form-group col-md-6">
									<label for="itemCategory">Item Category<span class="requiredIcon">*</span></label>
									<input type="text" class="form-control" name="itemCategory" id="itemCategory" autocomplete="off">
								  </div>
							  </div>
							  <button type="button" id="addCategory" class="btn btn-success">Add Category</button>
							  <button type="reset" class="btn" id="itemClear">Clear</button>
							</form>
						</div>
					</div>
					<div id="itemCategory" class="container-fluid tab-pane active">
						  <br>
						  <p>Use the grid below to search all details of items</p>
						  <!-- <a href="#" class="itemDetailsHover" data-toggle="popover" id="10">wwwee</a> -->
							<div class="table-responsive" id="itemCategoryTableDiv"></div>
					</div>
				  </div> 
				</div>
			  </div>
			  <div class="tab-pane fade" id="v-pills-item" role="tabpanel" aria-labelledby="v-pills-item-tab">
				<div class="card card-outline-secondary my-4">
				<div class="card-header">Item Details<button id="itemDetailsTablesRefresh" name="itemDetailsTablesRefresh" class="btn btn-warning float-right btn-sm">Refresh</button></div>
				  <!-- <div class="card-header">Item Details</div> -->
				  <div class="card-body">
					<!-- <ul class="nav nav-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#itemDetailsTab">Item</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#itemImageTab">Upload Image</a>
						</li>
					</ul> -->
					
					<!-- Tab panes for item details and image sections -->
					<div class="tab-content">
						<div id="itemDetailsTab" class="container-fluid tab-pane active">
							<br>
							<!-- Div to show the ajax message from validations/db submission -->
							<div id="itemDetailsMessage"></div>
							<form id="itemform">
							  <div class="form-row">
								  <div class="form-group col-md-6">
									<label for="itemName">Item Name<span class="requiredIcon">*</span></label>
									<input type="text" class="form-control" name="itemName" id="itemName" autocomplete="off">
								  </div>
							  </div>
							  <div class="form-row">
								<div class="form-group col-md-6" style="display:inline-block">
								  <!-- <label for="itemDetailsDescription">Description</label> -->
								  <textarea rows="4" class="form-control" placeholder="Description" name="itemDescription" id="itemDescription"></textarea>
								</div>
							  </div>
							  <div class="form-row">
							  <div class="form-group col-md-2">
								<label for="itemeType">Item Type</label>
								<select id="itemeType" name="itemeType" class="form-control chosenSelect">
									<option disabled selected value>Select an Item Type</option>
									<?php require('model/item/getItemType.php'); ?>
								</select>
								</div>
								<div class="form-group col-md-2">
								<label for="itemeCategory">Item Category</label>
								<select id="itemeCategory" name="itemeCategory" class="form-control chosenSelect">
								<option disabled selected value>Select an Item Category</option>
									<?php require('model/item/getItemCategory.php'); ?>
								</select>
								</div>
								<div class="form-group col-md-2">
									<label for="itemStatus">Status</label>
									<select id="itemStatus" name="itemStatus" class="form-control chosenSelect">
									<option disabled selected value>Select Item Status</option>
										<?php require('model/item/getItemStatus.php'); ?>
									</select>
								</div>
							  </div>

							  <div class="form-row">
								<div class="form-group col-md-2">
									<label for="itemprice">Price</label>
									<input type="number" class="form-control" value="0" name="itemprice" id="itemprice" autocomplete="off">
								</div>

							  </div>
							  <button type="button" id="addItem" class="btn btn-success">Add Item</button>
							  <button type="reset" class="btn">Clear</button>
							</form>
						</div>
					</div>
					<div id="itemDetails" class="container-fluid tab-pane active">
						  <br>
						  <p>Use the grid below to search all details of items</p>
						  <!-- <a href="#" class="itemDetailsHover" data-toggle="popover" id="10">wwwee</a> -->
							<div class="table-responsive" id="itemDetailsTableDiv"></div>
					</div>
				  </div> 
				</div>
			  </div>

			  <div class="tab-pane fade" id="v-pills-prices" role="tabpanel" aria-labelledby="v-pills-item-tab">
				<div class="card card-outline-secondary my-4">
				<div class="card-header">Item Prices<button id="itemPriceTablesRefresh" name="itemPriceTablesRefresh" class="btn btn-warning float-right btn-sm">Refresh</button></div>
				  <!-- <div class="card-header">Item Details</div> -->
				  <div class="card-body">
					<!-- Tab panes for item details and image sections -->
					<?php if ($_SESSION['role']== 2) { ?>
					<div class="tab-content">
						<div id="itemDetailsTab" class="container-fluid tab-pane active">
							<br>
							<!-- Div to show the ajax message from validations/db submission -->
							<div id="itemPriceMessage"></div>
							<form id="priceform">
							  <div class="form-row">
								 <div class="form-group col-md-4">
									<label for="itempriceid">Item</label>
									<select id="itempriceid" name="itempriceid" class="form-control chosenSelect">
										<option disabled selected value>Select an Item</option>
										<?php require('model/item/getItems.php'); ?>
									</select>
									</div>
							  </div>
							  <div class="form-row">
								  <div class="form-group col-md-2">
									<label for="itemePrice">Item Price<span class="requiredIcon">*</span></label>
									<input type="number" class="form-control" name="itemePrice" id="itemePrice" autocomplete="off">
								  </div>
							  </div>
							  <button type="button" id="addPrice" class="btn btn-success">Add Price</button>
							  <button type="reset" class="btn" id="itemClear">Clear</button>
							</form>
						</div>
					</div>
					<?php } ?>
					<div id="itemPrices" class="container-fluid tab-pane active">
						  <br>
						  <p>Use the grid below to search all details of items</p>
						  <!-- <a href="#" class="itemDetailsHover" data-toggle="popover" id="10">wwwee</a> -->
							<div class="table-responsive" id="itemPriceTableDiv"></div>
					</div>
				  </div> 
				</div>
			  </div>

			  <div class="tab-pane fade" id="v-pills-stock" role="tabpanel" aria-labelledby="v-pills-item-tab">
				<div class="card card-outline-secondary my-4">
				<div class="card-header">Stock Inventory<button id="stockInventoryTablesRefresh" name="stockInventoryTablesRefresh" class="btn btn-warning float-right btn-sm">Refresh</button></div>
				  <!-- <div class="card-header">Stock Inventory</div> -->
				  <div class="card-body">
					<!-- Tab panes for item details and image sections -->

				<?php if ($_SESSION['role']== 2) { ?>
					<div class="tab-content">
						<div id="itemDetailsTab" class="container-fluid tab-pane active">
							<br>
							<!-- Div to show the ajax message from validations/db submission -->
							<div id="itemStockMessage"></div>
							<form id="stockform">
							  <div class="form-row">
								 <div class="form-group col-md-4">
									<label for="itemstockid">Item</label>
									<select id="itemstockid" name="itemstockid" class="form-control chosenSelect">
										<option disabled selected value>Select an Item</option>
										<?php require('model/item/getItems.php'); ?>
									</select>
									</div>
								  <div class="form-group col-md-2">
									<label for="threshold">Threshold<span class="requiredIcon">*</span></label>
									<input type="number" value="10" class="form-control" name="threshold" id="threshold" autocomplete="off">
								  </div>
							  </div>
							  <div class="form-row">
								  <div class="form-group col-md-3">
									<label for="packQuantity">Pack<span class="requiredIcon">*</span></label>
									<input type="number" value="1" class="form-control" name="packQuantity" id="packQuantity" autocomplete="off">
								  </div>
								  <div class="form-group col-md-3">
									<label for="stockQuantity">Pieces (Quantity)<span class="requiredIcon">*</span></label>
									<input type="number" class="form-control" value="1" name="stockQuantity" id="stockQuantity" autocomplete="off">
								  </div>
							  </div>
							  <button type="button" id="addStock" class="btn btn-success">Add To Stock</button>
							  <button type="reset" class="btn" id="itemClear">Clear</button>
							</form>
						</div>
					</div>
					<?php } ?>
					<div id="stockInventory" class="container-fluid tab-pane active">
						  <br>
						  <p>Use the grid below to search all details of items</p>
						  <!-- <a href="#" class="itemDetailsHover" data-toggle="popover" id="10">wwwee</a> -->
							<div class="table-responsive" id="itemInventoryTableDiv"></div>
					</div>
				  </div> 
				</div>
			  </div>

			  <div class="tab-pane fade" id="v-pills-inventory" role="tabpanel" aria-labelledby="v-pills-item-tab">
				<div class="card card-outline-secondary my-4">
				<div class="card-header">Weekly Inventory<button id="weekInventoryTablesRefresh" name="weekInventoryTablesRefresh" class="btn btn-warning float-right btn-sm">Refresh</button></div>
				  <!-- <div class="card-header">Weekly Inventory</div> -->
				  <div class="card-body">
					<!-- Tab panes for item details and image sections -->
					<div class="tab-content">
						<div id="itemDetailsTab" class="container-fluid tab-pane active">
							<br>
							<!-- Div to show the ajax message from validations/db submission -->
							<div id="itemInventorykMessage"></div>
							<form id="inventform">
							  <div class="form-row">
								 <div class="form-group col-md-4">
									<label for="itemInventid">Item</label>
									<select id="itemInventid" name="itemInventid" class="form-control chosenSelect">
										<option disabled selected value>Select an Item</option>
										<?php require('model/item/getItems.php'); ?>
									</select>
									</div>
							  </div>
							  <div class="form-row">
								  <div class="form-group col-md-2">
									<label for="InventQuantity">Stock Quantity<span class="requiredIcon">*</span></label>
									<input type="number" class="form-control" name="InventQuantity" id="InventQuantity" autocomplete="off">
								  </div>
							  </div>
							  <button type="button" id="addInvent" name="addInvent" class="btn btn-success">Add To Inventory</button>
							  <button type="reset" class="btn" id="itemClear">Clear</button>
							</form>
						</div>
					</div>
					<div id="itemInventory" class="container-fluid tab-pane active">
						  <br>
						  <p>Use the grid below to search all details of items</p>
						  <!-- <a href="#" class="itemDetailsHover" data-toggle="popover" id="10">wwwee</a> -->
							<div class="table-responsive" id="itemWeekInventTableDiv"></div>
					</div>
				  </div> 
				</div>
			  </div>

			  <div class="tab-pane fade" id="v-pills-purchase" role="tabpanel" aria-labelledby="v-pills-purchase-tab">
				<div class="card card-outline-secondary my-4">
				<div class="card-header">Sales Details<button id="salesDetailTablesRefresh" name="salesDetailTablesRefresh" class="btn btn-warning float-right btn-sm">Refresh</button></div>
				  <!-- <div class="card-header">Sales Details</div> -->
				  <div class="card-body">
					<div id="purchaseDetailsMessage"></div>
					<form id='purchase-form'>
					  <div class="form-row"> 
						  <div class="form-group col-md-4 offset-2">
							<label for="purchasedItemDetail">Store Items<span class="requiredIcon">*</span></label>
							<select id="purchasedItemDetail" name="purchasedItemDetail" class="form-control chosenSelect">
								<option default value>Select an Item</option>
								<?php 
									require('model/item/getItems.php');
								?>
							</select>
						  </div>
						  <div class="form-group col-md-2">
							  <label for="purchaseDetailsCurrentStock">Current Stock</label>
							  <input type="text" class="form-control" id="purchaseDetailsCurrentStock" name="purchaseDetailsCurrentStock" readonly>
						  </div>
					  </div>
					  <div class="form-row">
						<div class="form-group col-md-2 offset-2">
						  <label for="purchaseDetailsQuantity">Quantity<span class="requiredIcon">*</span></label>
						  <input type="number" class="form-control" id="purchaseDetailsQuantity" name="purchaseDetailsQuantity" value="0">
						</div>
						<div class="form-group col-md-2">
						  <label for="purchaseDetailsUnitPrice">Unit Price<span class="requiredIcon">*</span></label>
						  <input type="text" class="form-control" id="purchaseDetailsUnitPrice" name="purchaseDetailsUnitPrice" value="0" readonly>
						  
						</div>
						<div class="form-group col-md-2">
						  <label for="purchaseDetailsTotal">Total Cost</label>
						  <input type="text" class="form-control" id="purchaseDetailsTotal" name="purchaseDetailsTotal" readonly>
						</div>
					  </div>
					  <div class="form-group col-md-3 offset-6">
							<button type="button" id="addPurchase" class="btn btn-success">Add to Sales</button>
							<button type="reset" class="btn">Clear</button>
					  </div>

					</form>
				  </div>
				</div>

				<div id="itemPurchase" class="container-fluid tab-pane active">
						  <br>
						  <p>Use the grid below to search all details of items</p>
						  <!-- <a href="#" class="itemDetailsHover" data-toggle="popover" id="10">wwwee</a> -->
						<div class="table-responsive" id="itemPurchaseTableDiv"></div>
					</div>
			  </div>
			    
			  <div class="tab-pane fade show active" id="v-pills-sale" role="tabpanel" aria-labelledby="v-pills-sale-tab">
				<div class="card card-outline-secondary my-4">
				<div class="card-header">Sales Details<button id="salesSummaryTablesRefresh" name="salesSummaryTablesRefresh" class="btn btn-warning float-right btn-sm">Refresh</button></div>
				  <!-- <div class="card-header">Sale Details</div> -->
				  <div class="card-body">
				  <!-- Div to show the ajax message from validations/db submission -->
				  <div id="customerDetailsMessage"></div>
					 <form>
						<h1>Daily Sales Summaries</h1><hr/>
					  <div class="form-row">
						<?php 	
								$itemDetailsSearchSql = 'select `oricent_db`.`item_category`.`item_category` AS `item_category`,sum(`oricent_db`.`general_sales`.`totalSales`) AS `amount` from (((`oricent_db`.`items` join `oricent_db`.`stock` on(`oricent_db`.`items`.`itemId` = `oricent_db`.`stock`.`itemId`)) join `oricent_db`.`general_sales` on(`oricent_db`.`items`.`itemId` = `oricent_db`.`general_sales`.`itemId`)) join `oricent_db`.`item_category` on(`oricent_db`.`items`.`itemCategory` = `oricent_db`.`item_category`.`item_category_id`)) where cast(`oricent_db`.`general_sales`.`salesDate` as date) = curdate() and userId ='.$_SESSION['user'].' group by `oricent_db`.`item_category`.`item_category`';
								$itemDetailsSearchStatement = $conn->prepare($itemDetailsSearchSql);
								$itemDetailsSearchStatement->execute();
								?>
						<?php $total=0; while ($row = $itemDetailsSearchStatement->fetch(PDO::FETCH_ASSOC)) {  $total += $row['amount'];?>
						  <div class="form-group col-md-6">
							<label for="customerDetailsCustomerMobile"><h4><?php echo $row['item_category'] ?></h4></label>
							<input type="text" class="form-control text-center"  value="GHC <?php echo number_format($row['amount'], 2, ".", ","); ?>" readonly>
						  </div>
						<?php } ?>
					  </div>
					  <div class="form-row">
						<div class="form-group col-md-4 offset-4">
						  <label for="customerDetailsCustomerFullName"><h4>TOTAL</h4></label>
						  <input type="text" class="form-control text-center" id="customerDetailsCustomerFullName" value="GHC <?php echo number_format($total, 2, ".", ","); ?>" name="customerDetailsCustomerFullName" readonly>
						</div>
					  </div>
					 </form><hr/>
				  </div> 
				  <div class="card-body">
					<div id="saleDetailsMessage"></div>
					<div id="itemSales" class="container-fluid tab-pane">
						  <h2>Daily Sales Details ( <?php echo Date('Y-m-d'); ?> ) </h2>
						  <!-- <a href="#" class="itemDetailsHover" data-toggle="popover" id="10">wwwee</a> -->
							<div class="table-responsive" id="itemSalesTableDiv"></div>
					</div>
				  </div> 
				</div>
			  </div>
			  <div class="tab-pane fade" id="v-pills-customer" role="tabpanel" aria-labelledby="v-pills-customer-tab">
				<div class="card card-outline-secondary my-4">
				<div class="card-header">Customer Details<button id="customerTablesRefresh" name="customerTablesRefresh" class="btn btn-warning float-right btn-sm">Refresh</button></div>
				  <!-- <div class="card-header">Customer Details</div> -->
				  <div class="card-body">
				  <!-- Div to show the ajax message from validations/db submission -->
				  <div id="customerMessage"></div>
					 <form id="customerform"> 
					  <div class="form-row">
						<div class="form-group col-md-6">
						  <label for="customerFullName">Full Name<span class="requiredIcon">*</span></label>
						  <input type="text" class="form-control" id="customerFullName" name="customerFullName">
						</div>
						<div class="form-group col-md-2">
							<label for="customerDetailsStatus">Status</label>
							<select id="customerDetailsStatus" name="customerDetailsStatus" class="form-control chosenSelect">
								<?php include('inc/statusList.html'); ?>
							</select>
						</div>
					  </div>
					  <div class="form-row">
						  <div class="form-group col-md-3">
							<label for="customerDetailsCustomerMobile">Phone (mobile)<span class="requiredIcon">*</span></label>
							<input type="text" class="form-control invTooltip" id="customerDetailsCustomerMobile" name="customerDetailsCustomerMobile" title="Do not enter leading 0">
						  </div>

						<div class="form-group col-md-3">
						  <label for="customerDetailsCustomerCity">City</label>
						  <input type="text" class="form-control" id="customerDetailsCustomerCity" name="customerDetailsCustomerCity">
						</div>
					  </div>					  
					  <button type="button" id="addCustomer" name="addCustomer" class="btn btn-success">Add Customer</button>
					  <button type="reset" class="btn">Clear</button>
					 </form>
					 <div id="itemCustomers" class="container-fluid tab-pane active">
						  <br>
							<div class="table-responsive" id="itemCustomerTableDiv"></div>
					</div>
				  </div> 
				</div>
			  </div>
			  
			  <div class="tab-pane fade" id="v-pills-search" role="tabpanel" aria-labelledby="v-pills-search-tab">
				<div class="card card-outline-secondary my-4">
				  <div class="card-header">Search Inventory<button id="searchTablesRefresh" name="searchTablesRefresh" class="btn btn-warning float-right btn-sm">Refresh</button></div>
				  <div class="card-body">										
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#itemSearchTab">Item</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#customerSearchTab">Customer</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#saleSearchTab">Sale</a>
						</li>
					</ul>
  
					<!-- Tab panes -->
					<div class="tab-content">
						<div id="itemSearchTab" class="container-fluid tab-pane ">
						  <br>
							<div class="table-responsive" id="itemDetailsTableDiv"></div>
						</div>
						<div id="customerSearchTab" class="container-fluid tab-pane active">
						  <br>
							<div class="table-responsive" id="customerDetailsTableDiv"></div>
						</div>
						<div id="saleSearchTab" class="container-fluid tab-pane fade">
							<br>
							<div class="table-responsive" id="saleDetailsTableDiv"></div>
						</div>
					</div>
				  </div> 
				</div>
			  </div>
			  
			  <div class="tab-pane fade" id="v-pills-reports" role="tabpanel" aria-labelledby="v-pills-reports-tab">
				<div class="card card-outline-secondary my-4">
				  <div class="card-header">Reports<button id="reportsTablesRefresh" name="reportsTablesRefresh" class="btn btn-warning float-right btn-sm">Refresh</button></div>
				  <div class="card-body">										
					<ul class="nav nav-tabs" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#itemReportsTab">Item</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#saleItemReportsTab">Sale Item Records</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#saleReportsTab">Sale Details</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#saleSumReportsTab">Sale Summary</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#lowStockReportsTab">Low Stock</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#customerReportsTab">Customer</a>
						</li>
					</ul>
  
					<!-- Tab panes for reports sections -->
					<div class="tab-content">
						<div id="itemReportsTab" class="container-fluid tab-pane active">
							<br>
							<div class="table-responsive" id="itemReportsTableDiv"></div>
						</div>
						<div id="saleItemReportsTab" class="container-fluid tab-pane fade">
							<br>
							<form> 
							  <div class="form-row">
								  <div class="form-group col-md-3">
									<label for="saleItemReportStartDate">Start Date</label>
									<input type="text" class="form-control datepicker" id="saleItemReportStartDate" name="saleItemReportStartDate">
								  </div>
								  <div class="form-group col-md-3">
									<label for="saleItemReportEndDate">End Date</label>
									<input type="text" class="form-control datepicker" id="saleItemReportEndDate" name="saleItemReportEndDate">
								  </div>
							  </div>
							  <button type="button" id="showItemSaleReport" class="btn btn-dark">Show Report</button>
							  <button type="reset" id="saleFilterClear" class="btn">Clear</button>
							</form>
							<br><br>
							<div class="table-responsive" id="saleItemReportsTableDiv"></div>
						</div>
						<div id="saleReportsTab" class="container-fluid tab-pane fade">
							<br>
							<form> 
							  <div class="form-row">
								  <div class="form-group col-md-3">
									<label for="saleReportStartDate">Start Date</label>
									<input type="text" class="form-control datepicker" id="saleReportStartDate" name="saleReportStartDate">
								  </div>
								  <div class="form-group col-md-3">
									<label for="saleReportEndDate">End Date</label>
									<input type="text" class="form-control datepicker" id="saleReportEndDate" name="saleReportEndDate">
								  </div>
							  </div>
							  <button type="button" id="showSaleReport" class="btn btn-dark">Show Report</button>
							  <button type="reset" id="saleFilterClear" class="btn">Clear</button>
							</form>
							<br><br>
							<div class="table-responsive" id="saleReportsTableDiv"></div>
						</div>
						<div id="saleSumReportsTab" class="container-fluid tab-pane fade">
							<br>
							<form> 
							  <div class="form-row">
								  <div class="form-group col-md-3">
									<label for="saleSumReportStartDate">Start Date</label>
									<input type="text" class="form-control datepicker" id="saleSumReportStartDate" name="saleSumReportStartDate">
								  </div>
								  <div class="form-group col-md-3">
									<label for="saleSumReportEndDate">End Date</label>
									<input type="text" class="form-control datepicker" id="saleSumReportEndDate" name="saleSumReportEndDate">
								  </div>
							  </div>
							  <button type="button" id="showSumSaleReport" class="btn btn-dark">Show Summary Report</button>
							  <button type="reset" id="saleFilterClear" class="btn">Clear</button>
							</form>
							<br><br>
							<div class="table-responsive" id="saleSumReportsTableDiv"></div>
						</div>
						<div id="lowStockReportsTab" class="container-fluid tab-pane fade">
							<br>
							<div class="table-responsive" id="lowStockReportsTableDiv"></div>
						</div>
						<div id="customerReportsTab" class="container-fluid tab-pane fade">
							<br>
							<div class="table-responsive" id="customerReportsTableDiv"></div>
						</div>
					</div>
				  </div> 
				</div>
			  </div>
			</div>
		 </div>
	  </div>
    </div>
<?php
	require 'inc/footer.php';
?>
  </body>
</html>
