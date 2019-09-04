<?php
session_start();
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
			<li><a href="inventory.php">Inventory</a></li>
			<li><a href="checkout.php" class = "active">Check Out</a></li>
		</ul>	
		<div class="container">
		<?php
		
		include("config.php");
	
		$email = $_POST['email'];
		$ccnum = $_POST['cardnumber'];
		$cvv = $_POST['cvv'];
		
		if(isset($_POST['cardnumber'])&&isset($_POST['cvv'])){
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				echo "Invalid email format"; 
			}
			else if(strlen($ccnum) != 19){
				echo "Invalid Credit Card" . strlen($ccnum) ; 
			}
			else if(strlen($cvv) != 3){
				echo "Invalid CVV"; 
			}
			else{
				header("Location: order.php");
			}
		}
		?>
			<div class="row">
				<div class="col-75">
					<div class="container">
						<form action="checkout.php" method="post">

							<div class="row">
								<div class="col-50">
									<h3>Billing Address</h3>
									<label for="fname"><i class="fa fa-user"></i> Full Name</label>
									<input required type="text" id="fname" name="firstname" onkeydown="return alphaOnly(event);">
									<label for="email"><i class="fa fa-envelope"></i> Email</label>
									<input required type="text" id="email" name="email" value="<?php echo $_SESSION["email"]; ?>">
									<label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
									<input required type="text" id="adr" name="address">
									<label for="city"><i class="fa fa-institution"></i> City</label>
									<input required type="text" id="city" name="city" onkeydown="return alphaOnly(event);">

									<div class="row">
										<div class="col-50">
											<label for="state">State</label>
											<select id="state" name="state">
												<option value="AL">AL</option>
												<option value="AK">AK</option>
												<option value="AR">AR</option>
												<option value="AZ">AZ</option>
												<option value="CA">CA</option>
												<option value="CO">CO</option>
												<option value="CT">CT</option>
												<option value="DC">DC</option>
												<option value="DE">DE</option>
												<option value="FL">FL</option>
												<option value="GA">GA</option>
												<option value="HI">HI</option>
												<option value="IA">IA</option>
												<option value="ID">ID</option>
												<option value="IL">IL</option>
												<option value="IN">IN</option>
												<option value="KS">KS</option>
												<option value="KY">KY</option>
												<option value="LA">LA</option>
												<option value="MA">MA</option>
												<option value="MD">MD</option>
												<option value="ME">ME</option>
												<option value="MI">MI</option>
												<option value="MN">MN</option>
												<option value="MO">MO</option>
												<option value="MS">MS</option>
												<option value="MT">MT</option>
												<option value="NC">NC</option>
												<option value="NE">NE</option>
												<option value="NH">NH</option>
												<option value="NJ">NJ</option>
												<option value="NM">NM</option>
												<option value="NV">NV</option>
												<option value="NY">NY</option>
												<option value="ND">ND</option>
												<option value="OH">OH</option>
												<option value="OK">OK</option>
												<option value="OR">OR</option>
												<option value="PA">PA</option>
												<option value="RI">RI</option>
												<option value="SC">SC</option>
												<option value="SD">SD</option>
												<option value="TN">TN</option>
												<option value="TX">TX</option>
												<option value="UT">UT</option>
												<option value="VT">VT</option>
												<option value="VA">VA</option>
												<option value="WA">WA</option>
												<option value="WI">WI</option>
												<option value="WV">WV</option>
												<option value="WY">WY</option>
											</select>
										</div>
										<div class="col-50">
											<label for="zip" >Zip</label>
											<input required type="text" id="zip" name="zip" maxlength="5" onkeydown="return numOnly(event);">
										</div>
									</div>
								</div>

								<div class="col-50">
									<h3>Payment</h3>
									<label for="cname">Name on Card</label>
									<input required type="text" id="cname" name="cardname" onkeydown="return alphaOnly(event);">
									<label for="ccnum">Credit card number</label>
									<p id= "type" ></p>
									<input required type="text" id="ccnum" name="cardnumber" maxlength="19" onkeydown="return numOnly(event);">
									<label for="expmonth">Exp Month</label>
									<select id="expmonth" name="expmonth">
										<option value='1'>Janaury</option>
										<option value='2'>February</option>
										<option value='3'>March</option>
										<option value='4'>April</option>
										<option value='5'>May</option>
										<option value='6'>June</option>
										<option value='7'>July</option>
										<option value='8'>August</option>
										<option value='9'>September</option>
										<option value='10'>October</option>
										<option value='11'>November</option>
										<option value='12'>December</option>
									</select> 
									<div class="row">
										<div class="col-50">
											<label for="expyear">Exp Year</label>
											<select name="expyear">
												<?php 
												for ($i = date('Y') +1; $i <= date('Y')+10; $i++) {
													echo '<option value="'.$i.'">'.$i.'</option>';
												} ?>
											</select> 
										</div>
										<div class="col-50">
											<label for="cvv">CVV</label>
											<input required type="text" id="cvv" name="cvv" maxlength="3" onkeydown="return numOnly(event);">
										</div>
									</div>
								</div>

							</div>
							<input type="submit" value="Continue to checkout" class="btn">
						</form>
					</div>
				</div>

				<div class="col-25">
					<div class="container">
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
															?>
												</td>
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
					</div>
				</div>
			</div>
		</div>
	</body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="script.js"></script>
	
</html>