<?php
// update-record-page.php

// Establish connection to your MySQL database
$servername = "localhost";
$usernameDB = "root";
$passwordDB = "wachtwoord";
$dbname = "eindproject";

$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the values from the form
    $userToUpdate = $_POST["user"];
    $newUser = $_POST["newUser"];
    $isMedewerker = $_POST["isMedewerker"];
    $isLeiding = $_POST["isLeiding"];

    // Update the database with the submitted values
    $updateSql = "UPDATE Users 
                  SET user = '$newUser', isMedewerker = '$isMedewerker', isLeiding = '$isLeiding' 
                  WHERE user = '$userToUpdate'";

    if ($conn->query($updateSql) === TRUE) {
        echo "Record updated successfully";
        echo "<br><br><a href='Medewerker-verwijderen.php'>Ga terug</a>";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
