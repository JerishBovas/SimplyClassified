<?php
$servername = "f0t36.gblearn.com";
$username = "f0t36";
$password = "JerishSanjay";
$dbname = "f0t36_SimplyClassified";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$result = $conn->query($sql);

$conn->close();

