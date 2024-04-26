<?php
// verwijder-record-page.php

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
    // Get the user to delete from the form data
    $userToDelete = $_POST["user"];

    // Delete the user from the database
    $deleteSql = "DELETE FROM Users WHERE user = '$userToDelete'";

    if ($conn->query($deleteSql) === TRUE) {
        echo "Record deleted successfully";

        // Add a button to go back to the overview
        echo "<br><br><a href='Medewerker-verwijderen.php'>Go back to overview</a>";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
