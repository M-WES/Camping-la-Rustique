<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
      

    
    <title>Campsite Reservation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-image: url(Images/reserveren%20image.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;

        
        }
        form {
            max-width: 500px;
            margin: 0 auto;
            border: #45a049;
            backdrop-filter: blur;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }

          /* Add your styles here */
          .goback-button {
            background-color: rgb(189, 18, 18);
            color: white;
            padding: 13px 20px 15px 20px;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .goback-button:hover {
            background-color: darkred;
        }

        .map-button {
    background-color: #0074cc; /* Blue background color */
    color: white;
    padding: 13px 20px 15px 20px;
    text-decoration: none;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.map-button:hover {
    background-color: #005a99; /* Darker shade of blue on hover */
}

    </style>
</head>
<body>

    <center>
    <table>
    <tr>
        <td>
            <form action="Reserveren.php" method="post">
                <div class="wrapper-form">
                    <label for="aantal_mensen">Aantal mensen:</label>
                    <input name="aantal_mensen" id="aantal_mensen" onchange="updateWaarvanOptions()" required>
                        <br>
                    <label for="waarvan_kinderen">Waarvan kinderen (3-14):</label>
                    <select name="waarvan_kinderen" id="waarvan_kinderen" disabled>
                    <!-- Options will be dynamically updated using JavaScript -->
                    </select>
                        <br>
                    <label for="waarvan_ouderen">Waarvan ouderen (65+):</label>
                    <select name="waarvan_ouderen" id="waarvan_ouderen" disabled>
                    <!-- Options will be dynamically updated using JavaScript -->
                    </select>
                        <br>
                    <label for="stroom">Stroom toevoer:</label>
                    <select name="stroom" id="stroom">
                        <option value="ja">Ja</option>
                        <option value="nee">Nee</option>
                    </select>
                    <br>
                    <label for="huisdieren">Huisdieren:</label>
                    <select name="huisdieren" id="huisdieren" onchange="showPetDropdown()">
                    <option value="nee">Nee</option>
                    <option value="ja">Ja</option>
                    </select>
                <!-- Dropdown for number of pets, initially hidden -->
                    <div id="petDropdownContainer" style="display: none;">
                        <label for="aantal_huisdieren">Aantal huisdieren:</label>
                        <select name="aantal_huisdieren" id="aantal_huisdieren">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <label for="house">Verblijf:</label>
                    <select id="house" name="Huisje" required>
                    <option value="Tent">Tent</option>
                    <option value="Caravan">Sta caravan</option>
                    <option value="Camper">Camper</option>
                    </select>

                    <label class="houseNrLabel" for="houseNrTent">Huisnummer tent:</label>
                    <select id="houseNrTent" name="houseNrTent" required style="display: none;">



                        <option value="Tent-1A">Tent 1A</option>
                        <option value="Tent-1B">Tent 1B</option>
                        <option value="Tent-2A">Tent 2A</option>
                        <option value="Tent-2B">Tent 2B</option>
                        <option value="Tent-3A">Tent 3A</option>
                        <option value="Tent-3B">Tent 3B</option>
                        <option value="Tent-4A">Tent 4A</option>
                        <option value="Tent-4B">Tent 4B</option>
                    </select>

                    <label class="houseNrLabel" for="houseNrCaravan">Huisnummer caravan:</label>
                    <select id="houseNrCaravan" name="houseNrCaravan" required style="display: none;">


                        <option value="Caravan-1A">Caravan 1A</option>
                        <option value="Caravan-1B">Caravan 1B</option>
                        <option value="Caravan-2A">Caravan 2A</option>
                        <option value="Caravan-2B">Caravan 2B</option>
                        <option value="Caravan-3A">Caravan 3A</option>
                        <option value="Caravan-3B">Caravan 3B</option>
                        <option value="Caravan-4A">Caravan 4A</option>
                        <option value="Caravan-4B">Caravan 4B</option>
                    </select>

                    <label class="houseNrLabel" for="houseNrCamper">Huisnummer camper:</label>
                    <select id="houseNrCamper" name="houseNrCamper" required style="display: none;">


                        <option value="Camper-1A">Camper 1A</option>
                        <option value="Camper-1B">Camper 1B</option>
                        <option value="Camper-2A">Camper 2A</option>
                        <option value="Camper-2B">Camper 2B</option>
                        <option value="Camper-3A">Camper 3A</option>
                        <option value="Camper-3B">Camper 3B</option>
                        <option value="Camper-4A">Camper 4A</option>
                        <option value="Camper-4B">Camper 4B</option>
                    </select>
                    
                    <br>
                    <a href="Kaart.html" class="map-button">Kaart</a>



                </div>
        </td>
        <td>
            
                <div class="wrapper-form">  
                    <label for="surname">Voornaam:</label>
                    <input type="text" id="Naam" name="Naam" required>
                    <label for="fullName">Achternaam:</label>
                    <input type="text" id="Achternaam" name="Achternaam" required>
                    <label for="email">Email:</label>
                    <input type="email" id="Email" name="Email" required>
                    <label for="phoneNumber">Telefoonnummer:</label>
                    <input type="tel" id="TelNummer" name="TelNummer" required>
                
                    <label for="dateOfStay">Aankomst datum:</label>
                    <input type="date" id="BeginDatum" name="BeginDatum" required min="<?= $unavailableDates[0] ?>" max="<?= $unavailableDates[count($unavailableDates) - 1] ?>">
                    <label for="dateOfStay">Vertrekdatum:</label>
                    <input type="date" id="EindDatum" name="EindDatum" required min="<?= $unavailableDates[0] ?>" max="<?= $unavailableDates[count($unavailableDates) - 1] ?>">
                    <a href="javascript:history.go(-1);" class="goback-button">Ga terug</a>
                    <button type="submit">Reserveer</button>
                </div>
            </form>
        </td>
    </tr>
</table>


    </div>
</center>
<script>
        function updateWaarvanOptions() {
            var aantalMensenInput = document.getElementById("aantal_mensen");
            var waarvanKinderenSelect = document.getElementById("waarvan_kinderen");
            var waarvanOuderenSelect = document.getElementById("waarvan_ouderen");

            // Clear existing options
            waarvanKinderenSelect.innerHTML = '';
            waarvanOuderenSelect.innerHTML = '';

            // Enable or disable waarvan dropdowns based on the presence of a value in aantal_mensen
            var enableDropdowns = aantalMensenInput.value.trim() !== '';

            waarvanKinderenSelect.disabled = !enableDropdowns;
            waarvanOuderenSelect.disabled = !enableDropdowns;

            // Create new options based on the selected number of people
            for (var i = 0; i <= aantalMensenInput.value; i++) {
                var option = document.createElement("option");
                option.text = i;
                option.value = i;
                waarvanKinderenSelect.add(option.cloneNode(true));
                waarvanOuderenSelect.add(option.cloneNode(true));
            }

            // Add event listeners to limit the sum of selected options to the total number of people
            waarvanKinderenSelect.addEventListener('change', function () {
                updateSumLimit();
            });

            waarvanOuderenSelect.addEventListener('change', function () {
                updateSumLimit();
            });

            // Initial call to set the sum limit based on the current selections
            updateSumLimit();
        }

        function updateSumLimit() {
            var aantalMensenInput = document.getElementById("aantal_mensen");
            var waarvanKinderenSelect = document.getElementById("waarvan_kinderen");
            var waarvanOuderenSelect = document.getElementById("waarvan_ouderen");

            var totalSelected = parseInt(waarvanKinderenSelect.value) + parseInt(waarvanOuderenSelect.value);

            // Disable options that exceed the total number of people
            for (var i = 0; i <= aantalMensenInput.value; i++) {
                waarvanKinderenSelect.options[i].disabled = i + totalSelected > aantalMensenInput.value;
                waarvanOuderenSelect.options[i].disabled = i + totalSelected > aantalMensenInput.value;
            }
        }

        function showPetDropdown() {
            var huisdierenSelect = document.getElementById("huisdieren");
            var petDropdownContainer = document.getElementById("petDropdownContainer");

            // Show or hide the pet dropdown based on the selection of huisdieren
            petDropdownContainer.style.display = huisdierenSelect.value === "ja" ? "block" : "none";
        }

        // Call updateWaarvanOptions on page load to initialize options
        window.onload = function () {
            updateWaarvanOptions();
        };

        document.getElementById("house").addEventListener('change', function () {
        var houseDropdown = document.getElementById("house");
        var selectedHouse = houseDropdown.value;

        // Hide all houseNr dropdowns and labels by default
        hideAllHouseNrElements();

        // If a house is selected, show the corresponding houseNr dropdown and label
        if (selectedHouse !== "") {
            var houseNrDropdownId = getHouseNrDropdownId(selectedHouse);
            var houseNrDropdown = document.getElementById(houseNrDropdownId);
            var houseNrLabel = document.querySelector('.houseNrLabel[for="' + houseNrDropdownId + '"]');

            if (houseNrDropdown && houseNrLabel) {
                houseNrDropdown.style.display = "block";
                houseNrLabel.style.display = "block";
            }
        }
    });

    function hideAllHouseNrElements() {
        // Get all houseNr dropdowns and labels, and hide them
        var houseNrDropdowns = document.querySelectorAll('[id^="houseNr"]');
        var houseNrLabels = document.querySelectorAll('.houseNrLabel');

        houseNrDropdowns.forEach(function (dropdown) {
            dropdown.style.display = "none";
        });

        houseNrLabels.forEach(function (label) {
            label.style.display = "none";
        });
    }

    function getHouseNrDropdownId(selectedHouse) {
        // Map selectedHouse to the corresponding houseNr dropdown id
        var houseNrDropdownIds = {
            "Tent": "houseNrTent",
            "Camper": "houseNrCamper",
            "Caravan": "houseNrCaravan"
            // Add more houses as needed
        };

        return houseNrDropdownIds[selectedHouse] || "";
    }

        


        
    </script>


    <div class="blurry-background">
        <div class="form-container">


</body>
</html>
