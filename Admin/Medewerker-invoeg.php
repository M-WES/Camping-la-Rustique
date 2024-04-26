<?php
session_start();

// Check if the user is logged in and is a Medewerker
if (!isset($_SESSION['loggedIn']) || !isset($_SESSION['isMedewerker']) || $_SESSION['isMedewerker'] != 1) {
    header("Location: login.php"); // Redirect to login page if not logged in as Medewerker
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform validation (you can add more validation as needed)

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

    // Hash the password before storing it in the database for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute a SQL query using a prepared statement to insert a new employee
    $sql = "INSERT INTO users (user, password, isMedewerker) VALUES (?, ?, 1)";
    $stmt = $conn->prepare($sql);

    // Check if the query was prepared successfully
    if (!$stmt) {
        die("Error in query preparation: " . $conn->error);
    }

    $stmt->bind_param("ss", $username, $hashedPassword);

    // Check if the query was executed successfully
    if ($stmt->execute()) {
        echo "Medewerker succesvol toegevoegd!";
        header("Location: Medewerker-overzicht.php");    
        echo "Er was eeb storing tijdens het toevoegen: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- HTML Form to collect employee information -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Rustique</title>
</head>
<body>
    <h2>Medewerker Toevoegen</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Gebruikersnaam:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Wachtwoord:</label>
        <input type="password" id="password" name="password" required><br>
        <br>

        <input type="submit" value="Add Employee">
        <br>
        <br>


        <a href="javascript:history.go(-1);" class="knop">Ga terug</a>
    </form>
</body>
</html>
