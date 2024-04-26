<?php
session_start();

// Check if the user is logged in
$loggedIn = isset($_SESSION['loggedIn']) ? $_SESSION['loggedIn'] : false;

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php"); // Redirect to login page after logout
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Retrieve username, password, and isMedewerker from the login form
    $username = $_POST['username'];
    $password = $_POST['password'];

// Modify your SQL query
        $sql = "SELECT id, user, password, isMedewerker, isLeiding FROM users WHERE user=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // User found, fetch the password and isMedewerker from the result
        $stmt->bind_result($id, $dbUsername, $dbPassword, $dbIsMedewerker, $dbIsLeiding);
        $stmt->fetch();

        // Verify the entered password against the hashed password in the database
        if (password_verify($password, $dbPassword) || $password === $dbPassword) {
            // Login successful
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $dbUsername;
            $_SESSION['isMedewerker'] = $dbIsMedewerker; // Set isMedewerker value
            $_SESSION['isLeiding'] = $dbIsLeiding;


            $_SESSION['loggedIn'] = true;

            // Debugging statements
            echo "Login successful. isMedewerker value: " . $_SESSION['isMedewerker'] . "<br>";
            echo "isLeiding value: " . $_SESSION['isLeiding'] . "<br>";
            echo "Redirecting to Home.php...";

            header("Location: Home.php"); // Redirect to a welcome page after successful login
            exit();
        } else {
            // Invalid password
            echo "Invalid password. Please try again.";
        }
    } else {
        // User not found
        echo "User not found. Please check your username.";
    }

    $stmt->close();
    $conn->close();
} else {
    // Handle the case when the form is not submitted
}
?>
