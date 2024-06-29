<?php
$servername = "localhost";
$username = "id22336086_morandi";
$password = "Cabeza_68";
$dbname = "id22336086_crud";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
