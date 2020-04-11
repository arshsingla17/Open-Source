<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="home.css">
		 <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700%7CPT+Serif:400,700,400italic' rel='stylesheet'>
		  <link href="https://fonts.googleapis.com/css?family=Montserrat|Open+Sans" rel="stylesheet">
</head>

<?php

$result_str = $result = '';
if (isset($_POST['unit-submit'])) {
    $units = $_POST['units'];
    if (!empty($units)) {
        $result = calculate_bill($units);
        $result_str = 'Total Bill Amount of ' . $units . ' Units is - Rs ' . $result;
        
    }
}

function calculate_bill($units) {
    $c1 = 9;
    $c2 = 12;
    $c3 = 15;
 
    if($units <= 50) {
        $bill = $units * $c1;
    }
    else if($units > 50 && $units <= 100) {
        $temp = 50 * $c1;
        $remaining_units = $units - 50;
        $bill = $temp + ($remaining_units * $c2);
    }
    else {
        $temp = (50 * $c1) + (50 * $c2);
        $remaining_units = $units - 100;
        $bill = $temp + ($remaining_units * $c3);
    }
    
    return number_format((float)$bill, 2, '.', '');
}

$host="localhost";
$user="root";
$password="";
$dbname="customer";

	
	$conn = new mysqli($host, $user, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

if (isset($_POST['unit-submit'])){


	
$fname = isset($_POST['firstname']) ? $_POST['firstname'] : null;
$lname = isset($_POST['lastname']) ? $_POST['lastname'] : null;
$address = isset($_POST['address']) ? $_POST['address'] : null;
$units = isset($_POST['units']) ? $_POST['units'] : null;



$sql = "insert into customerdetails (FirstName, LastName, CustomerAddress, UnitsUsed, BillAmount)
values ('$fname','$lname','$address', $units, $result) " ;
  
if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
  

    $conn->close();


}

?>

<body>

	<div class="bgimage">
		<div class="menu">
			
			<div class="topnav">
				<a class="active" >Home</a>
  <div class="topnav-right">
    <a href="index.php">Logout</a>
  </div>
</div>
		</div>
		<div class="text">
			<h1> Punjab Electricity board </h1>
			<h2> Bill Calculator </h2>
		</div>
		
		<div class="container">
  <form method="POST">

    <label for="fname">First Name</label>
    <input type="text" id="fname" name="firstname" placeholder="Your first name.." required>

    <label for="lname">Last Name</label>
    <input type="text" id="lname" name="lastname" placeholder="Your last name.." required>
	
	 <label for="address">Address</label>
    <input type="text" id="address" name="address" placeholder="Your Address.." required>
	
	
	<label for="unit">No of Units Used</label>
    <input type="number" id="units" name="units" placeholder="Enter Units Used.." min= "1" required>

    

<input type="submit" name="unit-submit" id="unit-submit" value="Submit" />

  </form>
  <p> <?php echo $result_str; ?></p>

</div>

</div>

</body>
</html>