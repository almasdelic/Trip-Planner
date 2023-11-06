<?php

# SPAJANJE NA BAZU PODATAKA

$servername = "localhost"; // Povežeš na svoju bazu podataka i svoje podatke
$username = "root";
$password = "1234";
$dbname = "putovanja";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
