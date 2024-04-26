<?php
// Medewerker-verander-form.php

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
    // Get the user to update from the form data
    $userToUpdate = $_POST["user"];

    // Retrieve data for the selected user
    $sql = "SELECT user, isMedewerker, isLeiding FROM Users WHERE user = '$userToUpdate'";
    $result = $conn->query($sql);

    // Check if there is any data
    if ($result->num_rows > 0) {
        // Output the form with the user details
        $row = $result->fetch_assoc();
        echo "<form method='post' action='update-record-page.php'>
                <input type='hidden' name='user' value='" . $row["user"] . "'>
                <label>User:</label> <input type='text' name='newUser' value='" . $row["user"] . "'><br>
                <label>isMedewerker:</label> <input type='text' name='isMedewerker' value='" . $row["isMedewerker"] . "'><br>
                <label>isLeiding:</label> <input type='text' name='isLeiding' value='" . $row["isLeiding"] . "'><br>
                <button type='submit' name='Update-record-page.php'>Update User</button>
              </form>";
    } else {
        echo "No records found for the selected user";
    }
}

// Close the connection
$conn->close();
?>
