<?php
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

// Retrieve data from the users table
$sql = "SELECT id, user, isMedewerker FROM users";
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Output table header
    echo "Overzicht van gebruikers <br>";
    "<br>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>User</th><th>isMedewerker</th></tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["user"] . "</td>";
        echo "<td>" . $row["isMedewerker"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";

    echo "<br><br><a href='Medewerker-overzicht.php'>Ga terug</a>";
} else {
    echo "0 results";
}

// Close the database connection
$conn->close();
?>
