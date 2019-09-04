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
		<ul class= "navbar">
			<li><a href="index.html">Home</a></li>
			<li><a href="signup.php" class = "active">Sign Up!</a></li>
			<li><a href="login.php">Login</a></li>
		</ul>	
		<div class="container">
	<?php
	
	include("config.php");
	
	$email = $_POST["email"];
	$un = $_POST["un"];
	$pwd = $_POST["pwd"];
	$rpwd = $_POST["rpwd"];
	
	$sql = "SELECT * FROM clunkers WHERE username='$un'";
	$result = $conn->query($sql);
	
	$r = $result->num_rows;
	
	if ($result->num_rows > 0) {
		
		echo "Username is not unique!";
		
	}
	else if(!empty($un)){
		
		if(isset($_POST['pwd'])&&isset($_POST['rpwd']))
		{ 
			if($_POST['pwd'] != $_POST['rpwd']){
			echo "Your passwords do not match!";
			}
			else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				echo "Invalid email format"; 
			}
			else{
			
			//echo $email . " " . $un . " " . $pwd . " end ";
			
				$sql = "INSERT INTO clunkers (email, username, password) VALUES ('$email', '$un', '$pwd')";
				
				if ($conn->query($sql) === TRUE) {
					echo "New record created successfully <br>";
					header("Location: login.php");
				}
				else{
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
				
				$conn->close();			
			}
		}
	}
	
		
	
	?>
		
			<form action="signup.php" method="post">
				Email: <input required type="text" name="email"><br>
				Username: <input required type="text" name="un"><br>
				Password: <input required type="password" name="pwd"><br>
				Re-enter Password: <input required type="password" name="rpwd"><br>
				<input type="submit" value = "Register" class="btn">
			</form>
		</div>
	</body>
</html>