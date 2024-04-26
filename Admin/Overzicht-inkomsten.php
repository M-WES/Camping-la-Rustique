<?php
// Database connection details
$servername = "localhost";
$usernameDB = "root";
$passwordDB = "wachtwoord";
$dbname = "eindproject";

// Create connection
$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT * FROM reserveringen";
$result = $conn->query($sql);

$totalKosten = 0;

echo "Overzicht van Inkomsten <br>";
echo "<br>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Inkomsten</th></tr>";

// Output data of each row
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["Id"] . "</td>";
    echo "<td>" . $row["Kosten"] . "</td>";
    echo "</tr>";

    // Summing up the Kosten
    $totalKosten += $row["Kosten"];
}

echo "</table>";

// Display the total Kosten
echo "<br>";
echo "Totaal Inkomsten: € " . $totalKosten;

echo "<br><br><a href='Medewerker-overzicht.php'>Ga terug</a>";

$conn->close();
?>
