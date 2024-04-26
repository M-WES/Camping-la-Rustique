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

// Retrieve data from the reserveringen table
$sql = "SELECT * FROM reserveringen";
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Output table header
  
    echo "Overzicht van reserveringen <br>";
echo "<br>";
echo "<table border='1'>";
echo "<tr><th>Id</th><th>Naam</th><th>Achternaam</th><th>Email</th><th>TelNummer</th><th>Huisje</th><th>BeginDatum</th><th>EindDatum</th><th>GeboekteDatums</th><th>Acties</th></tr>";

// Output data of each row
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["Id"] . "</td>";
    echo "<td>" . $row["Naam"] . "</td>";
    echo "<td>" . $row["Achternaam"] . "</td>";
    echo "<td>" . $row["Email"] . "</td>";
    echo "<td>" . $row["TelNummer"] . "</td>";
    echo "<td>" . $row["Huisje"] . "</td>";
    echo "<td>" . $row["BeginDatum"] . "</td>";
    echo "<td>" . $row["EindDatum"] . "</td>";
    echo "<td>" . $row["GeboekteDatums"] . "</td>";

    // Add form with buttons for 'verander' and 'verwijder'
    echo "<td>
            <form action='Update-reservering.php' method='GET' style='display:inline;'>
                <input type='hidden' name='id' value='" . $row["Id"] . "'>
                <button type='submit'>Verander</button>
            </form>
            <form action='Verwijder-reservering.php' method='GET' style='display:inline;'>
                <input type='hidden' name='id' value='" . $row["Id"] . "'>
                <button type='submit'>Verwijder</button>
            </form>
          </td>";

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
