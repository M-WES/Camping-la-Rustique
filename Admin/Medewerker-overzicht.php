<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Paneel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url(../Images/admin.jpg);
            background-repeat: no-repeat;
            background-size: cover;
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
            <h1>Welkom bij het admin scherm</h1>
        </div>

        <a href="OverzichtUsers.php" class="knop">Overzicht gebruikers</a>
        <a href="Overzicht-Reserveringen.php" class="knop">Overzicht reserveringen</a>
        
        <?php
        require '../Login.php';
        
        if (!$loggedIn) :
            ?>
            <center>
                <a href="login.html" class="login-button"><h1>Login</h1></a>
            </center>
            <?php
        elseif ($_SESSION['isLeiding']) :
            ?>
            <!-- This part will be displayed only if isLeiding is true -->
            
            <a href="../Admin/Overzicht-inkomsten.php" class="knop">Overzicht inkomsten</a>
            <a href="Medewerker-instellingen.php" class="knop">Medewerker Instellingen</a>
        <?php
        endif;
        ?>

        <br>
        <br>

        <center>
        <a href="../Home.php" class="knop">Terug</a>



    </center>
    </div>

   
</body>
</html>
