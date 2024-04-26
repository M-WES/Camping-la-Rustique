<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Database connection details
    $host = "localhost";
    $username = "root";
    $password = "wachtwoord";
    $dbname = "eindproject";

    // Collect form data
    $aantalMensen = $_POST['aantal_mensen'];
    $waarvanKinderen = $_POST['waarvan_kinderen'];
    $waarvanOuderen = $_POST['waarvan_ouderen'];
    $stroom = $_POST['stroom'];
    $huisdieren = $_POST['huisdieren'];
    $aantalHuisdieren = $_POST['aantal_huisdieren'];
    $houseSelection = $_POST['Huisje'];
    $houseNumberTent = isset($_POST['houseNrTent']) ? $_POST['houseNrTent'] : '';
    $houseNumberCaravan = isset($_POST['houseNrCaravan']) ? $_POST['houseNrCaravan'] : '';
    $houseNumberCamper = isset($_POST['houseNrCamper']) ? $_POST['houseNrCamper'] : '';
    
    $surname = $_POST['Naam'];
    $fullName = $_POST['Achternaam'];
    $email = $_POST['Email'];
    $phoneNumber = $_POST['TelNummer'];
    $houseSelection = $_POST['Huisje'];
    $dateOfStay = $_POST['BeginDatum'];
    $dateOfLeave = $_POST['EindDatum'];

    // Calculate the cost based on the selected house type
    if ($houseSelection === "Tent") {
        $cost = 50.00;
    } elseif ($houseSelection === "Caravan") {
        $cost = 100.00;
    } elseif ($houseSelection === "Camper") {
        $cost = 75.00;
    } else {
        // Handle the case where the house type is not recognized
        $cost = 0.00;
    }

    // Format the dates for comparison
    $formattedDateOfStay = date('d-m-Y', strtotime($dateOfStay));
    $formattedDateOfLeave = date('d-m-Y', strtotime($dateOfLeave));

    // Create a new mysqli connection
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Format the dates for comparison
    $formattedDateOfStay = date('Y-m-d', strtotime($dateOfStay));
    $formattedDateOfLeave = date('Y-m-d', strtotime($dateOfLeave));

    // Fetch all booked dates from the database
    $fetchBookedDatesSql = "SELECT GROUP_CONCAT(GeboekteDatums) as GeboekteDatums FROM reserveringen WHERE GeboekteDatums IS NOT NULL";
    $fetchBookedDatesResult = $conn->query($fetchBookedDatesSql);

    // Check if there are booked dates
    if ($fetchBookedDatesResult->num_rows > 0) {
        $bookedDates = [];

        // Fetch booked dates and store them in an array
        while ($row = $fetchBookedDatesResult->fetch_assoc()) {
            $bookedDates[] = $row['GeboekteDatums'];
        }

        // Combine all booked dates into a single array
        $allBookedDates = implode(',', $bookedDates);

        // Pass the booked dates to JavaScript
        echo "<script> var allBookedDates = '$allBookedDates'; </script>";
    } else {
        // No booked dates, set an empty array
        echo "<script> var allBookedDates = ''; </script>";
    }


    $checkAvailabilitySql = "SELECT id, GeboekteDatums FROM reserveringen WHERE (GeboekteDatums IS NOT NULL AND FIND_IN_SET(?, GeboekteDatums) > 0) OR (BeginDatum <= ? AND EindDatum >= ?)";
    $checkAvailabilityStmt = $conn->prepare($checkAvailabilitySql);
    $checkAvailabilityStmt->bind_param("sss", $formattedBookedDates, $formattedDateOfLeave, $formattedDateOfStay);
    $checkAvailabilityStmt->execute();
    $checkAvailabilityStmt->store_result();

    // If rows are found, the dates are not available
    if ($checkAvailabilityStmt->num_rows > 0) {
        // Fetch the unavailable dates and store them in an array
        $unavailableDates = [];
        $checkAvailabilityStmt->bind_result($reservationId, $geboekteDatums);
        while ($checkAvailabilityStmt->fetch()) {
            $unavailableDates[] = $geboekteDatums;
        }

        // Convert the array of unavailable dates to a string
        $unavailableDatesString = implode('<br> ', $unavailableDates);

        // Display the error message along with the list of unavailable dates
        echo "Geselecteerde data is niet beschikbaar. De volgende data is al geboekt: <br> $unavailableDatesString";
        // Add a "Go Back" button to redirect to the reservation form
        echo '<br><br><button onclick="goBack()">Ga terug</button>';
        echo '<script> function goBack() { window.history.back(); } </script>';
    } else {
        // Prepare and execute the SQL query
        $sql = "INSERT INTO reserveringen (AantalMensen, WaarvanKinderen, WaarvanOuderen, Stroom, Huisdieren, Naam, Achternaam, Email, TelNummer, Huisje, BeginDatum, EindDatum, Huisnummer, kosten)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);

        // Check if the prepare statement was successful
        if (!$stmt) {
            die("Error in SQL query: " . $conn->error);
        }

        if ($houseSelection === "Tent") {
            $stmt->bind_param("sssssssssssssd", $aantalMensen, $waarvanKinderen, $waarvanOuderen, $stroom, $huisdieren, $surname, $fullName, $email, $phoneNumber, $houseSelection, $formattedDateOfStay, $formattedDateOfLeave, $houseNumberTent, $cost);
        } elseif ($houseSelection === "Caravan") {
            $stmt->bind_param("sssssssssssssd", $aantalMensen, $waarvanKinderen, $waarvanOuderen, $stroom, $huisdieren, $surname, $fullName, $email, $phoneNumber, $houseSelection, $formattedDateOfStay, $formattedDateOfLeave, $houseNumberCaravan, $cost);
        } elseif ($houseSelection === "Camper") {
            $stmt->bind_param("sssssssssssssd", $aantalMensen, $waarvanKinderen, $waarvanOuderen, $stroom, $huisdieren, $surname, $fullName, $email, $phoneNumber, $houseSelection, $formattedDateOfStay, $formattedDateOfLeave, $houseNumberCamper, $cost);
        }

        if ($stmt->execute()) {
            $reservationId = $conn->insert_id;

            // Format and concatenate the booked dates
            $formattedBookedDates = date('Y-m-d', strtotime($dateOfStay)) . ',' . date('Y-m-d', strtotime($dateOfLeave));

            // Update the booked dates in the database
            $updateSql = "UPDATE reserveringen SET GeboekteDatums = ? WHERE id = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("si", $formattedBookedDates, $reservationId);
            $updateStmt->execute();
            $updateStmt->close();

            header("Location: reservation_details.php?id=$reservationId");
        } else {
            echo "Error: " . $stmt->error;
            echo "<br>houseNumberTent: $houseNumberTent<br>";
            echo "houseNumberCaravan: $houseNumberCaravan<br>";
            echo "houseNumberCamper: $houseNumberCamper<br>";
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
}

?>
