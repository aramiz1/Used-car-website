<?php
session_start();
	foreach ($_SESSION["cart_item"] as $item){
			
		if(!empty($item["windowname"])){
		
			$_SESSION["windowSelected"] = $item["windowname"]; 
		}
		else if(!empty($item["name"])){
			$_SESSION["carSelected"] = $item["name"]; 
		}
		else if(!empty($item["wheelname"])){
			$_SESSION["wheelSelected"] = $item["wheelname"]; 
		}
		else if(!empty($item["colorname"])){
			$_SESSION["colorSelected"] = $item["colorname"]; 
		}
	}
	//echo " TEST " . $_SESSION["windowSelected"] . "  " . $_SESSION["carSelected"] . " " . $_SESSION["wheelSelected"] . " " . $_SESSION["colorSelected"];

?>
<html>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<head>
		<link rel="stylesheet" href="carStyles.css">
		<link href="style.css" type="text/css" rel="stylesheet" />
	

	</head>
	<div class = "heading">
		<img src="Logo.png" class="logo">
		<h3>Hello <?php echo $_SESSION["username"]; ?>!</h3>
	</div>
	
	<body>
		<ul class= "navbar">		
			<li><a href="logout.php">Log Out</a></li>
			<li><a href="inventory.php">Inventory</a></li>
			<li><a href="checkout.php" class = "active">Check Out</a></li>
		</ul>		
		
		<div class="container">
		
			<div class="Car-display">
				<div class="car-container" align="center" id="<?php echo $_SESSION["carSelected"]; ?>">
					<div class="car-top1" <?php if(empty($_SESSION["carSelected"])){echo "hidden";}?> style="background-color:<?php echo $_SESSION["colorSelected"]; ?>" id="<?php echo $_SESSION["carSelected"]; ?>">
						<div class="window1" style="background-color:<?php echo $_SESSION["windowSelected"]; ?>" id="window1"></div>
						<div class="window2" style="background-color:<?php echo $_SESSION["windowSelected"]; ?>" id="window2"></div>

					</div>
					<div class="car-top2" <?php if(empty($_SESSION["carSelected"])){echo "hidden";}?> style="background-color:<?php echo $_SESSION["colorSelected"]; ?>" id="<?php echo $_SESSION["carSelected"]; ?>">
						<div class="door" id="<?php echo $_SESSION["carSelected"]; ?>">
							<div class="door-knob"></div>
						</div>
						<div class="door2" id="<?php echo $_SESSION["carSelected"]; ?>">
							<div class="door-knob2"></div>
						</div>
					</div>
					<div class="car-bottom">
						<div class="wheel1-top"></div>
						<div class="wheel1" <?php if(empty($_SESSION["wheelSelected"])){echo "hidden";}?> id="<?php echo $_SESSION["wheelSelected"]; ?>">
							<div class="wheel-dot1" id="<?php echo $_SESSION["wheelSelected"]; ?>"></div>
							<div class="wheel-dot2" id="<?php echo $_SESSION["wheelSelected"]; ?>"></div>
							<div class="wheel-dot3" id="<?php echo $_SESSION["wheelSelected"]; ?>"></div>
							<div class="wheel-dot4" id="<?php echo $_SESSION["wheelSelected"]; ?>"></div>

						</div>

						<div class="wheel2-top"></div>
						<div class="wheel2" <?php if(empty($_SESSION["wheelSelected"])){echo "hidden";}?> id="<?php echo $_SESSION["wheelSelected"]; ?>">
							<div class="wheel-dot1" id="<?php echo $_SESSION["wheelSelected"]; ?>"></div>
							<div class="wheel-dot2" id="<?php echo $_SESSION["wheelSelected"]; ?>"></div>
							<div class="wheel-dot3" id="<?php echo $_SESSION["wheelSelected"]; ?>"></div>
							<div class="wheel-dot4" id="<?php echo $_SESSION["wheelSelected"]; ?>"></div>
						</div>
					</div>
					

				</div>
			</div>
			
			
			
			<div class="col-25">
					<table class="tbl-cart" cellpadding="10" cellspacing="1">
						<tbody>
							<tr>
								<th style="text-align:left;" colspan="2">Name</th>
								<th style="text-align:right;" width="5%">Quantity</th>
								<th style="text-align:right;" width="10%">Unit Price</th>
								<th style="text-align:right;" width="10%">Price</th>
							</tr>	
							<?php		
								foreach ($_SESSION["cart_item"] as $item){
									$item_price = $item["quantity"]*$item["price"];
									?>
											<tr>
											<td colspan="2"><?php 
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
															?></td>
											<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
											<td style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
											<td style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
											</tr>
											<?php
											$total_quantity += $item["quantity"];
									}
									?>

							<tr>
								<td colspan="2" align="right">Total:</td>
								<td align="right"><?php echo $total_quantity; ?></td>
								<td align="right" colspan="2"><strong><?php echo "$ ".number_format($_SESSION["total_price"], 2); ?></strong></td>
							</tr>
						</tbody>
					</table>
					<h1 class="txt-heading">Congratulations!</h1>
					<h2>Order Number: <?php echo rand(100000,999999);?><h2>
					<h2>Estimated Delivery: When it gets there<h2>		
			
			</div>		
		</div>		
	</body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
</html>