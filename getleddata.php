<?php
//Creates new record as per request
//Connect to database
$hostname = "localhost";		//example = localhost or 192.168.0.0
$username = "root";		//example = root
$password = "";	
$dbname = "led";
// Create connection
$conn = mysqli_connect($hostname, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed !!!");
} 

header('Content-Type: application/json');

require_once('conn.php');

$sqlQuery = "SELECT status FROM led_stat WHERE id = 1";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>