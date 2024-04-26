<?php
// Check if the reservation ID is provided in the URL
if (isset($_GET['id'])) {
    $reservationId = $_GET['id'];

    // Database connection details
    $servername = "localhost";
    $username = "root";
    $password = "wachtwoord";
    $database = "eindproject";

    // Create a new mysqli connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query to fetch reservation details
    $sql = "SELECT Naam, Achternaam, Email, TelNummer, Huisje, Huisnummer, BeginDatum, EindDatum,
    AantalMensen, WaarvanKinderen, WaarvanOuderen, Stroom, Huisdieren
FROM reserveringen
WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error in SQL query: " . $conn->error);
    }

    $stmt->bind_param("i", $reservationId);
    $stmt->execute();

    if ($stmt->error) {
        die("Error executing statement: " . $stmt->error);
    }

    $stmt->bind_result($surname, $fullName, $email, $phoneNumber, $houseSelection, $dateOfStay, $dateOfLeave,
                       $aantalMensen, $waarvanKinderen, $waarvanOuderen, $stroom, $huisdieren, $aantalHuisdieren);

    // Fetch the results
    $stmt->fetch();

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    // Display the reservation details
    if ($surname) {
        echo "<h1>Reservering Details</h1>";
        echo "<p><strong>Voornaam:</strong> $surname</p>";
        echo "<p><strong>Achternaam:</strong> $fullName</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Telefoon nummer:</strong> $phoneNumber</p>";
        echo "<p><strong>Gekozen verblijf:</strong> $houseSelection</p>";

        // Format the date using the date function
        $formattedDateOfStay = date('d-m-Y', strtotime($dateOfStay));
        $formattedDateOfLeave = date('d-m-Y', strtotime($dateOfLeave));
        echo "<p><strong>Verblijfdata:</strong> $formattedDateOfStay tot $formattedDateOfLeave</p>";

        // Additional details
        echo "<p><strong>Aantal mensen:</strong> $aantalMensen</p>";
        echo "<p><strong>Waarvan kinderen:</strong> $waarvanKinderen</p>";
        echo "<p><strong>Waarvan ouderen:</strong> $waarvanOuderen</p>";
        echo "<p><strong>Stroom:</strong> " . ($stroom == 0 ? 'Ja' : 'Nee') . "</p>";
        echo "<p><strong>Huisdieren:</strong> " . ($huisdieren == 0 ? 'Ja' : 'Nee') . "</p>";
        
        if ($huisdieren == 0) {
            echo "<p><strong>Aantal huisdieren:</strong> $aantalHuisdieren</p>";
        }

        // Add a link to download the data
        echo '<p><a href="Download.php?id=' . $reservationId . '">Download Reservering Details</a></p>';

        // Add a button to redirect back to the previous page
        echo '<form method="post">';
        echo '<input type="hidden" name="submit_button" value="1">';
        echo '<button type="submit">Ga Terug</button>';
        echo '</form>';
    } else {
        echo "Reservation not found.";
    }
} else {
    echo "Reservation ID not provided.";
}

// Check if the form is submitted
if (isset($_POST['submit_button'])) {
    // Redirect to a different page
    header("Location: Home.php");
    exit();
}
?>
