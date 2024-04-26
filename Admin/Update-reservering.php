<?php
$servername = "localhost";
$usernameDB = "root";
$passwordDB = "wachtwoord";
$dbname = "eindproject";

$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the existing data based on the provided ID
    $sql = "SELECT * FROM reserveringen WHERE Id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Display a form with existing data for editing
        echo "<form action='Update-reservering2.php' method='POST'>
                <input type='hidden' name='id' value='" . $row["Id"] . "'>
                <label for='naam'>Naam:</label>
                <input type='text' name='naam' value='" . $row["Naam"] . "' required><br>
                <label for='achternaam'>Achternaam:</label>
                <input type='text' name='achternaam' value='" . $row["Achternaam"] . "' required><br>
                <label for='email'>Email:</label>
                <input type='email' name='email' value='" . $row["Email"] . "' required><br>
                <label for='telnummer'>TelNummer:</label>
                <input type='text' name='telnummer' value='" . $row["TelNummer"] . "' required><br>
                <label for='huisje'>Huisje:</label>
                <input type='text' name='huisje' value='" . $row["Huisje"] . "' required><br>
                <label for='beginDatum'>BeginDatum:</label>
                <input type='date' name='beginDatum' value='" . $row["BeginDatum"] . "' required><br>
                <label for='eindDatum'>EindDatum:</label>
                <input type='date' name='eindDatum' value='" . $row["EindDatum"] . "' required><br>
                <label for='geboekteDatums'>GeboekteDatums:</label>
                <input type='text' name='geboekteDatums' value='" . $row["GeboekteDatums"] . "' required><br>
                <button type='submit'>Opslaan</button>
              </form>";
    } else {
        echo "Record not found";
    }
}

$conn->close();
?>
