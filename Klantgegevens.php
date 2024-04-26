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

        .wrapper-form {
            max-width: 50%;
            margin: 0 auto;
        }

        .blurry-background {
            /* Add your blurry-background styles here */
        }

        .form-container {
            border: #45a049;
            backdrop-filter: blur;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input,
        select {
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

        .reservation-button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .reservation-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <center>
        <div class="wrapper-form">

            <form action="Reserveren_form.php" method="post" class="form-container" id="reservation-form">
                            </form>

        </div>
    </center>

    <div class="blurry-background">
        <div class="form-container">
            <!-- Other content of blurry-background div -->
        </div>
    </div>

    
</body>

</html>
