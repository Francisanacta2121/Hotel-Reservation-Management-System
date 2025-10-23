<?php
$host = "sql300.infinityfree.com"; // your MySQL Hostname
$user = "if0_40234453";    // your database username
$pass = "Francisanacta21";     // your database password
$db   = "if0_40234453_dbhrms"; // your database name

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("❌ Database connection failed: " . $conn->connect_error);
}
?>