<?php
$servername = "localhost";
$usernameDB = "root";
$passwordDB = "wachtwoord";
$dbname = "eindproject";

$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input
function sanitize($input) {
    return htmlspecialchars(strip_tags($input));
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = sanitize($_GET['id']);

    // Fetch the record to confirm deletion
    $sql = "SELECT * FROM reserveringen WHERE Id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Display confirmation message and form
        echo "<p>Weet je zeker dat je deze reservering wilt verwijderen?</p>";
        echo "<p>Naam: " . $row["Naam"] . "</p>";
        echo "<p>Achternaam: " . $row["Achternaam"] . "</p>";
        // Add other fields as needed

        echo "<form action='Verwijder-reservering.php' method='POST'>
                <input type='hidden' name='id' value='" . $row["Id"] . "'>
                <button type='submit' name='confirmDelete'>Ja, verwijder    </button>
                <a href='javascript:history.back()'>Nee, ga terug</a>
              </form>";
    } else {
        echo "Record not found";
    }
}

// Handle the confirmed deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && isset($_POST['confirmDelete'])) {
    $id = sanitize($_POST['id']);

    // Delete the record from the database
    $sql = "DELETE FROM reserveringen WHERE Id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
        echo " <br> <br> <a href = 'Overzicht-reserveringen.php'> Ga terug";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
