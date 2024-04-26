<?php
// Database connection parameters
$servername = "your_database_server";
$username = "your_database_username";
$password = "your_database_password";
$dbname = "your_database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the selected house from the request
$selectedHouse = $_POST['selectedHouse'];
$tableName = getTableName($selectedHouse);

// Generate random boolean values for the selected house
$booleanValues = generateRandomBooleanValues($tableName);

// Update the database with the new boolean values
updateDatabase($conn, $tableName, $booleanValues);

// Close the database connection
$conn->close();

function generateRandomBooleanValues($tableName) {
    // Replace this with your actual logic to generate random boolean values for the specified table
    // For simplicity, I'll provide an example with static data
    $booleanValues = [];

    // Example logic, adjust as per your needs
    if ($tableName === "caravan") {
        $booleanValues = [
            'Caravan 1A' => rand(0, 1),
            'Caravan 1B' => rand(0, 1),
            'Caravan 2A' => rand(0, 1),
            'Caravan 2B' => rand(0, 1),
            // ... Repeat for other caravans
        ];
    } elseif ($tableName === "tent") {
        $booleanValues = [
            'Tent 1A' => rand(0, 1),
            'Tent 1B' => rand(0, 1),
            'Tent 2A' => rand(0, 1),
            'Tent 2B' => rand(0, 1),
            // ... Repeat for other tents
        ];
    } elseif ($tableName === "camper") {
        $booleanValues = [
            'Camper 1A' => rand(0, 1),
            'Camper 1B' => rand(0, 1),
            'Camper 2A' => rand(0, 1),
            'Camper 2B' => rand(0, 1),
            // ... Repeat for other campers
        ];
    }

    return $booleanValues;
}

function updateDatabase($conn, $tableName, $booleanValues) {
    // Replace this with your actual logic to update boolean values in the database
    // For simplicity, I'll provide an example with prepared statements

    $updateStatement = $conn->prepare("UPDATE $tableName SET status = ? WHERE id = ?");
    
    foreach ($booleanValues as $key => $value) {
        // Adjust the column names based on your actual database structure
        $updateStatement->bind_param("ii", $value, $key);
        $updateStatement->execute();
    }

    $updateStatement->close();
}

function getTableName($selectedHouse) {
    // Convert selected house to the corresponding table name
    return strtolower(str_replace(" ", "_", $selectedHouse));
}
?>
