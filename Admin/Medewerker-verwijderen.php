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

// SQL query to retrieve data for the "Users" table where isMedewerker is true
$sql = "SELECT user, isMedewerker, isLeiding FROM Users WHERE isMedewerker = 1";
$result = $conn->query($sql);

// Check if there is any data
if ($result->num_rows > 0) {
    // Output table header
    echo "<table border='1'><tr><th>User</th><th>isMedewerker</th><th>isLeiding</th><th>Actions</th></tr>";

    // Output data from each row with a form for updates
   
while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>" . $row["user"] . "</td>
        <td>" . $row["isMedewerker"] . "</td>
        <td>" . $row["isLeiding"] . "</td>
        <td>
            <form method='post' action='Medewerker-verander-form.php'>
                <input type='hidden' name='user' value='" . $row["user"] . "'>
                <button type='submit' name='verander'>Verander</button>
            </form>
            <form method='post' action='verwijder-record-page.php'>
                <input type='hidden' name='user' value='" . $row["user"] . "'>
                <button type='submit' name='verwijder'>Verwijder</button>
            </form>
        </td>
    </tr>";

    
}

    // Close table tag
    echo "</table>";
    echo "<br><br><a href='Medewerker-instellingen.php'>Ga terug</a>";
} else {
    echo "No records found";
}

// Close the connection
$conn->close();
?>
