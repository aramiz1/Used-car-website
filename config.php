<!DOCTYPE html>
<html>
	<head>
	
		
	</head>
	<body>
		<?php
			$servername = "localhost";
			$username = "aramiz1";
			$password = "aramiz1";
			$dbname = "aramiz1";

			$conn = new mysqli($servername, $username, $password, $dbname);

			if($conn->connect_error){
				die("Connection failed: " . $conn->connect_error);
			}
			//echo "Connected successfully";
		?>

	</body>
</html>
