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
			<li><a href="signup.php">Sign Up!</a></li>
			<li><a href="login.php" class = "active">Login</a></li>
		</ul>
		<div class="container">
		<?php
		include("config.php");
		//echo "connection successful <br>";
		
		$un = $_POST["un"];
		$pwd = $_POST["pwd"];
		$email;
		$sql = "SELECT * FROM clunkers WHERE username='$un' AND password='$pwd'";
		$result = $conn->query($sql);
		$getName;
				
		
		if($result->num_rows > 0) {
			
			
			
			while($row = $result->fetch_assoc()) {
				$_SESSION["username"] = $row["username"];
				$_SESSION["password"] = $row["password"];
				$_SESSION["email"] = $row["email"];
				
				//if(isset($_POST['un'])&&isset($_POST['pwd']))
				//{ 
				header("Location: inventory.php");
				//}
			}
		}
		else{
			if(isset($_POST['un']) || isset($_POST['pwd']))
			{ 
			echo "Username/password incorrect";
			}
		}
		
		//echo $getName;
		$conn->close();
		
		//header("Location: inventory.php");
		?>
		
			<form action="login.php" method="post">
				Username: <input required type="text" name="un"><br>
				Password: <input required type="password" name="pwd"><br>
				
				<a href="signup.php" class="button">Register</a><br>
				<a href="forgot.php" class="button">Forgot my password</a><br>
					
				<input type="submit" value="Login" class="btn">
			</form>
			</div>
	</body>
</html>