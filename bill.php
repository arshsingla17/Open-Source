<?php

$result_str = $result = '';
if (isset($_POST['unit-submit'])) {
    $units = $_POST['units'];
    if (!empty($units)) {
        $result = calculate_bill($units);
        $result_str = 'Total Bill Amount of ' . $units . ' Units is - Rs ' . $result;
        echo $result_str;
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

$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$address = $_POST['address'];
$units = $_POST['units'];




$host="localhost";
$user="root";
$password="";
$dbname="customer";
	
	$conn = new mysqli($host, $user, $password, $dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}


$sql = "INSERT INTO customerdetails (FirstName, LastName,CustomerAddress, UnitsUsed, BillAmount)
VALUES ('$fname','$lname','$address',$units,$result)";
  
  

    
    $conn->close();




?>