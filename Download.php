<?php
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
    $sql = "SELECT Naam, Achternaam, Email, TelNummer, Huisje, BeginDatum, EindDatum,
                   AantalMensen, WaarvanKinderen, WaarvanOuderen, Stroom, Huisdieren, Huisdieren
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
                       $aantalMensen, $waarvanKinderen, $waarvanOuderen, $stroom, $huisdieren, $Huisdieren);

    // Fetch the results
    $stmt->fetch();

    // Close the statement and connection
    $stmt->close();
    $conn->close();

    // Combine the data into a string
    $data = "Voornaam: $surname\n";
    $data .= "Achternaam: $fullName\n";
    $data .= "Email: $email\n";
    $data .= "Telefoon nummer: $phoneNumber\n";
    $data .= "Gekozen verblijf: $houseSelection\n";
    $formattedDateOfStay = date('d-m-Y', strtotime($dateOfStay));
    $formattedDateOfLeave = date('d-m-Y', strtotime($dateOfLeave));
    $data .= "Verblijfdata: $formattedDateOfStay tot $formattedDateOfLeave\n";

    // Additional details
    $data .= "Aantal mensen: $aantalMensen\n";
    $data .= "Waarvan kinderen: $waarvanKinderen\n";
    $data .= "Waarvan ouderen: $waarvanOuderen\n";
    $data .= "Stroom: " . ($stroom == 0 ? 'Ja' : 'Nee') . "\n";
    $data .= "Huisdieren: " . ($huisdieren == 0 ? 'Ja' : 'Nee') . "\n";
    if ($huisdieren == 0) {
        $data .= "Aantal huisdieren: $Huisdieren\n";
    }

    // Set the appropriate headers for text file download
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="reservering_details.txt"');

    // Output the data to the browser
    echo $data;

    // Exit to prevent further output
    exit();
} else {
    echo "Reservation ID not provided.";
}
?>
