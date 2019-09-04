<?php
session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
	switch($_GET["action"]) {
		case "add":
			
			if(!empty($_SESSION["cart_item"])) {
				foreach($_SESSION["cart_item"] as $k => $v) {
					
						if(!empty($_SESSION["cart_item"][$k]["windowname"])){
							unset($_SESSION["cart_item"][$k]);
						}
						if(empty($_SESSION["cart_item"]))
							unset($_SESSION["cart_item"]);
						
				}
			}
			
			
			
			$_POST["quantity"] = 1;
			
			if(!empty($_POST["quantity"])) {
				$productByCode = $db_handle->runQuery("SELECT * FROM finaltable WHERE windowcode='" . $_GET["windowcode"] . "'");
				$itemArray = array($productByCode[0]["windowcode"]=>array('windowname'=>$productByCode[0]["windowname"], 'windowcode'=>$productByCode[0]["windowcode"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["windowprice"], ));
				
				
				$_SESSION["windowSelected"] = $productByCode[0]["windowname"];
				//echo " TEST " . $_SESSION["windowSelected"];
				
				if(!empty($_SESSION["cart_item"])) {
					if(in_array($productByCode[0]["windowcode"],array_keys($_SESSION["cart_item"]))) {
						foreach($_SESSION["cart_item"] as $k => $v) {
								if($productByCode[0]["windowcode"] == $k) {
									if(empty($_SESSION["cart_item"][$k]["quantity"])) {
										$_SESSION["cart_item"][$k]["quantity"] = 0;
									}
									//$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
									$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
								}
						}
					} else {
						$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
					}
				} else {
					$_SESSION["cart_item"] = $itemArray;
				}
			}
		break;
		case "remove":
		
			$_SESSION["windowSelected"] = "";
			//echo $_SERVER['REQUEST_URI'];
			
			$urlString = $_SERVER['REQUEST_URI'];
			
			if (strpos($urlString, 'Cartype') !== false) {
				
				$_SESSION["carSelected"] = "";
				
				if(!empty($_SESSION["cart_item"])) {
					
					foreach($_SESSION["cart_item"] as $k => $v) {
						
							if(!empty($_SESSION["cart_item"][$k]["name"])){
								//echo $_SESSION["cart_item"][$k]["name"];
								unset($_SESSION["cart_item"][$k]);
							}
							
					}
					//echo "car ";
				}	
			}
			else if (strpos($urlString, 'Wheeltype') !== false) {
				$_SESSION["wheelSelected"] = "";
				
				if(!empty($_SESSION["cart_item"])) {
					
					foreach($_SESSION["cart_item"] as $k => $v) {
						
							if(!empty($_SESSION["cart_item"][$k]["wheelname"])){
								//echo $_SESSION["cart_item"][$k]["name"];
								unset($_SESSION["cart_item"][$k]);
							}
							
					}
					//echo "car ";
				}	
			}			
			else if (strpos($urlString, 'Windowtype') !== false) {
				
				$_SESSION["windowSelected"] = "";
				
				if(!empty($_SESSION["cart_item"])) {
					
					foreach($_SESSION["cart_item"] as $k => $v) {
						
							if(!empty($_SESSION["cart_item"][$k]["windowname"])){
								//echo $_SESSION["cart_item"][$k]["name"];
								unset($_SESSION["cart_item"][$k]);
							}
							
					}
					//echo "car ";
				}	
			}
			else if (strpos($urlString, 'Colortype') !== false) {
				
				$_SESSION["colorSelected"] = "";
				
				if(!empty($_SESSION["cart_item"])) {
					
					foreach($_SESSION["cart_item"] as $k => $v) {
						
							if(!empty($_SESSION["cart_item"][$k]["colorname"])){
								//echo $_SESSION["cart_item"][$k]["name"];
								unset($_SESSION["cart_item"][$k]);
							}
							
					}
					//echo "car ";
				}	
			}
			
			/*
			if(!empty($_SESSION["cart_item"])) {
				foreach($_SESSION["cart_item"] as $k => $v) {
						if($_GET["wheelcode"] == $k)
							unset($_SESSION["cart_item"][$k]);				
						if(empty($_SESSION["cart_item"]))
							unset($_SESSION["cart_item"]);
				}
			}*/
			
		break;
		case "empty":
		
			$_SESSION["windowSelected"] = "";
			
			unset($_SESSION["cart_item"]);
		break;	
	}
}
?>
<html>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<head>
		<link href="style.css" type="text/css" rel="stylesheet" />
	</head>
	<div class = "heading">
		<img src="Logo.png" class="logo">
		<h3>Hello <?php echo $_SESSION["username"]; ?>!</h3>
	</div>
	<body>
		<ul class= "navbar">
			<li><a href="logout.php">Log Out</a></li>
			<li><a href="inventory.php" class = "active">Inventory</a></li>
			<li><a href="checkout.php">Check Out</a></li>
		</ul>	
		<div class="container">
			<div id="shopping-cart">
				<div class="txt-heading">Shopping Cart</div>

				<a id="btnEmpty" href="windows.php?action=empty">Empty Cart</a>
				<?php
					if(isset($_SESSION["cart_item"])){
						$total_quantity = 0;
						$_SESSION["total_price"]= 0;
				?>	
				<table class="tbl-cart" cellpadding="10" cellspacing="1">
					<tbody>
						<tr>
							<th style="text-align:left;" >Name</th>
							<th style="text-align:right;" width="5%">Quantity</th>
							<th style="text-align:right;" width="10%">Unit Price</th>
							<th style="text-align:right;" width="10%">Price</th>
							<th style="text-align:center;" width="5%">Remove</th>
						</tr>	
						<?php		
							foreach ($_SESSION["cart_item"] as $item){
								$item_price = $item["price"];
								?>
										<tr>
											<td><?php 
															if(!empty($item["windowname"])){
																echo "Window type: " . $item["windowname"]; 
															}
															else if(!empty($item["name"])){
																echo "Car type: " . $item["name"]; 
															}
															else if(!empty($item["wheelname"])){
																echo "Wheel type: " . $item["wheelname"]; 
															}
															else if(!empty($item["colorname"])){
																echo "Color: " . $item["colorname"]; 
															}
													?>
											</td>
										<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
										<td style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
										<td style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
										<td style="text-align:center;"><a href="windows.php?action=remove&windowcode=<?php echo $item["windowcode"]; 
										
															if(!empty($item["windowname"])){
																echo "Windowtype: " . $item["windowname"]; 
															}
															else if(!empty($item["name"])){
																echo "Cartype: " . $item["name"]; 
															}
															else if(!empty($item["wheelname"])){
																echo "Wheeltype: " . $item["wheelname"]; 
															}
															else if(!empty($item["colorname"])){
																echo "Colortype: " . $item["colorname"]; 
															}
										
										
																													?>" class="btnRemoveAction">Remove Item</a></td>
										</tr>
										<?php
										$total_quantity += $item["quantity"];
										$_SESSION["total_price"] += ($item["price"]);
								}
								?>

						<tr>
							<td align="right">Total:</td>
							<td align="right"><?php echo $total_quantity; ?></td>
							<td align="right" colspan="2"><strong><?php echo "$ ".number_format($_SESSION["total_price"], 2); ?></strong></td>
							<td></td>
						</tr>
					</tbody>
				</table>		
				  <?php
				} else {
				?>
				<div class="no-records">Your Cart is Empty</div>
				<?php 
				}
				?>
			</div>

			<div id="product-grid">
			

				
				<div class="txt-heading">Products</div>
				
				<ul class= "navbar">
				<li><a href="inventory.php">Cars</a></li>
				<li><a href="wheels.php">Wheels</a></li>
				<li><a href="windows.php" class = "active">Windows</a></li>
				<li><a href="colors.php">Colors</a></li>
				</ul>
				
				<?php
				$product_array = $db_handle->runQuery("SELECT * FROM finaltable ORDER BY id ASC");
				if (!empty($product_array)) { 
					foreach($product_array as $key=>$value){
				?>
					<div class="product-item">
						<form method="post" action="windows.php?action=add&windowcode=<?php echo $product_array[$key]["windowcode"]; ?>">
						
						
										
						<div class="product-tile-footer">
						<img src="<?php echo  "wcode".$product_array[$key]["windowcode"].".PNG"; ?>" class="cart-item-image">
						<div class="product-title"><?php echo $product_array[$key]["windowname"]; ?></div>
						<div class="product-price"><?php echo "$".$product_array[$key]["windowprice"]; ?></div>
						<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" disabled/><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
						</div>
						</form>
					</div>
				<?php
					}
				}
				?>
			</div>
		</div>
	</body>
</html>