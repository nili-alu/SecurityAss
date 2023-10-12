<?php
$server= "localhost";
$username= "root";
$password= "";
$db= "security";
// Create connection
$conn = new mysqli($server, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// else{
//     echo("Successful");
// }
?>