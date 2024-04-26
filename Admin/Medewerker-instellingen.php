<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }



        .container {
            text-align: center;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            margin: 20px auto;
            max-width: 800px;
        }

        .header {
            color: #000;
            padding: 20px;
            border-radius: 5px 5px 0 0;
        }

        .knop {
            display: inline-block;
            margin: 10px;
            padding: 15px 30px;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border-radius: 5px;
            font-size: 16px;
        }

        .knop:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <h1>Medewerkers aanpassen </h1>
        </div>

        <a href="Medewerker-invoeg.php" class="knop">Medewerker toevoegen</a>
        <a href="Medewerker-verwijderen.php" class="knop">Medewerker aanpassen</a>
 
        <br>
        <br>

        <center>
        <a href="Medewerker-overzicht.php" class="knop">Ga terug</a>



    </center>
    </div>

   
</body>
</html>
