<?php

$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASS = "Francisanacta.2121";
$DB_NAME = "hotelreservationms";

$conn = @new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($conn->connect_errno) {
  die("DB connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function esc($s){ return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }
?>
