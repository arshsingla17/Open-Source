<?php
	$host="localhost";
	$user="root";
	$password="";
	$dbname="login";
	
	$conn = new mysqli($host, $user, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	$uname = $_POST['username'];
	$pass = $_POST['password'];
	
	$sql="select * from loginform where user='".$uname."' AND Pass= '".$pass."' limit 1";
	$result = $conn->query($sql);
	
	
    $error = "";

		
		
		if($result->num_rows ==1){
				$error="";
				header("location: home.html");
			}
			else{
				$error= "Invalid Password!!!";
				echo $error;
			}
		
				
		$conn->close();
	
?>