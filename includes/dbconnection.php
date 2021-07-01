<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "times_intnl";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

?>