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
	include("config.php");
	
	$un = $_POST["un"];
	$sql = "SELECT * FROM clunkers WHERE username='$un'";
	$result = $conn->query($sql);
	$getName;
	
	if (($result->num_rows > 0)) {
		//echo "your username is " . $un;
		while($row = $result->fetch_assoc()) {
			
			$_SESSION["email"] = $row["email"];
			$_SESSION["username"] = $row["username"];
			$_SESSION["password"] = $row["password"];
			
			
		}
		
		header("Location: check.php");
	}
	else{
		echo "User was not found! <br><br>";
		
		echo '<a href="index.html" class="button">Home</a><br>';
	}
	
	$conn->close();
	/*
	if($result->num_rows > 0) {
		
		while($row = $result->fetch_assoc()) {
			$_SESSION["name"] = $row["name"];
			$_SESSION["username"] = $row["username"];
			$_SESSION["password"] = $row["password"];
			$_SESSION["answer"] = $row["answer"];
			$_SESSION["question"] = $row["question"];
			$_SESSION["topics"] = $row["topics"];
			

			header("Location: check.php");
		}
	}
	else{
		echo "User was not found! <br><br>";
		
		echo '<a href="home.html" class="button">Home</a><br>';
	}
	
	
	$conn->close();
	*/
?>
</div>
</body>
</html>