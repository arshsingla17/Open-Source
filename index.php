<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="index.css" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">
</head>

<?php
	$host="localhost";
	$user="root";
	$password="";
	$dbname="login";
	
	$conn = new mysqli($host, $user, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
  }
  $error = " ";

  
  if (isset($_POST['submit'])){
  
  $uname = isset($_POST['username']) ? $_POST['username'] : null;
  $pass = isset($_POST['password']) ? $_POST['password'] : null;
  
	
	$sql="select * from loginform where user='".$uname."' AND Pass= '".$pass."' limit 1";
	$result = $conn->query($sql);
	
	

		
		
		if($result->num_rows ==1){
				$error= " ";
				header("location: home.php");
			}
			else{
				$error= "Invalid Password!!!";
				
			}
		
				
    $conn->close();
    
    }
	
?>

<body>
   <div class="signin">

<form method="POST" >
<h2 style="color:#fff;">Log In</h2>

<input type="text" name="username" placeholder="Username" required autocomplete="off " /><br /><br />
<input type="password" name="password" placeholder="Password" required /><br /><br />
<input type="submit" name="submit" value="Log In"  /><br /><br />

</form>
<p><?php echo $error; ?></P>
  </div>

</body>
</html>
