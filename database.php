<?php
// database.php

$servername = 'localhost';
$dbname = 'event_system';
$username = 'root'; // Change as per your setup
$password = ''; // Change as per your setup


// Ensure the database connection is established
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
