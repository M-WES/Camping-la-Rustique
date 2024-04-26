<?php
$servername = "localhost";  // Vervang dit met de naam van je MySQL-server (meestal "localhost" als het lokaal is)
$username = "root";  // Vervang dit met je MySQL-gebruikersnaam
$password = "wachtwoord";  // Vervang dit met je MySQL-wachtwoord
$database = "eindproject";  // Vervang dit met de naam van je MySQL-database

// Maak een verbinding met de database
$conn = new mysqli($servername, $username, $password, $database);

// Controleer de verbinding
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";

