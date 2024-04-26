<?php
$servername = "localhost";
$usernameDB = "root";
$passwordDB = "wachtwoord";
$dbname = "eindproject";

$conn = new mysqli($servername, $usernameDB, $passwordDB, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $naam = $_POST['naam'];
    $achternaam = $_POST['achternaam'];
    $email = $_POST['email'];
    $telnummer = $_POST['telnummer'];
    $huisje = $_POST['huisje'];
    $beginDatum = $_POST['beginDatum'];
    $eindDatum = $_POST['eindDatum'];
    $geboekteDatums = $_POST['geboekteDatums'];

    // Update the record in the database
    $sql = "UPDATE reserveringen 
            SET Naam='$naam', Achternaam='$achternaam', Email='$email', TelNummer='$telnummer',
                Huisje='$huisje', BeginDatum='$beginDatum', EindDatum='$eindDatum', GeboekteDatums='$geboekteDatums'
            WHERE Id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
        echo " <br> <br> <a href = 'Overzicht-reserveringen.php'> Ga terug";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
