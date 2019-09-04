<?php

session_start();



?>
<html>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<head>
		<link rel = stylesheet href = "style.css">
	</head>
	<div class = "heading">
		<img src="Logo.png" class="logo">
		<h3>Hello Guest!</h3>
	</div>
	<body>	
		<div class="container">
			<?php
				$email = $_POST["email"];
				
				
				if(!empty($email)){ 

					
					if($email == $_SESSION["email"]){
						echo "Your password is: " .  $_SESSION["password"];
						
						echo '<br><br><a href="index.html" class="button">Home</a><br>';
						
									
						?>
						<style type="text/css">#checker{
						display:none;
						}</style>
						<?php
						

						
					}
					else{
						echo "Invalid email! <br><br>";
					}
				}
			?>
			<div id="checker">
			<form action="check.php"  method="post">
			
				Enter your email: <input type="text" name="email"><br><br>
				
				<input type="submit" value="Retrieve" class="btn">
				
			</form>
		</div>
	</body>


</html>