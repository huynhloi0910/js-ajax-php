<?php 
	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "banhang";
	
	// Create connection
	// Example (MySQLi Object-Oriented)
	$con = new mysqli($servername, $username, $password, $database);
	// mysql_query($con, 'SET NAMES UTF8');//xét tiếng việt

	// Check connection
	if ($con->connect_error) {
	    die("Connection failed: " . $con->connect_error);
	} else {
		//echo "Connected successfully";
	}
	
?>
