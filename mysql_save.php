<?php
$servername = "192.168.214.80";
$username = "root";
$password = "";
$dbname = "line";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO linebot (UserID, Text, Timestamp)
VALUES ('ICE', 'PAT', 'mySql')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
