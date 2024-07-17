<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="style.css">
  <title>Eindproject</title>
  <style>
    body {
      background-image: url(Images/Login%20image.jpg);
      background-size: cover;
      background-position: center;
    }

    table,
    th,
    td {
      border-collapse: collapse;
    }
  </style>
</head>

<body class="home-stijl" style="background-color: #E1D9D1;">
  <center>
    <div class="main-container">
      <header class="header">
        <h1>La Rustique</h1>
      </header>
    </div>
  </center>

  <div class="container">
  </div>

  <center>
    <table class="table" style="width:100%; padding: 25%; height: 40%;">
      <tr class="Table_whole">
        <tr class="Table_Whole2">
          <h1>
            <td class="table-top_left">
              <h2> <a href="Reserveren.html" class="Reserveren">
                  <br><br><br><br><br><br><br><br><br>
                  Reserveren</a>
              </h2>
            </td>

            <td class="table-top_right">
              <h2><a href="Kaart.html" class="Kaart">
                  <img src="images/PlattegrondLogo.png" alt="err" class="logo-image">
                  Kaart
                </a></h2>
            </td>
        </tr>

        <td class="table-bottom_left">
              <h2> <a href="Tarieven.php" class="Reserveren">
                  <br><br><br><br><br><br><br><br><br>
                  Tarieven</a>
              </h2>
            </td>

            <td class="table-bottom_right">
              <h2> <a href="Contact.html" class="Reserveren">
                  <br><br><br><br><br><br><br><br><br>
                  Contact</a>
              </h2>
            </td>
      </tr>
    </table>

    <br><br><br><br>
  </center>

  
  <center>

  <?php
  require 'Login.php';
  if (!$loggedIn) : 
  ?>
                <center>
                    <a href="index.html" class="login-button"><h1>Login</h1></a>
                </center>
s
                
            <?php 

         endif; 
         
         
         if (!$loggedIn == false) : ?>
          <center>
              <a href="logout.php" class="login-button"><h1>logout</h1></a>
          </center>

          
      <?php 

   endif; ?>
<br>  
<?php if ($loggedIn && $_SESSION['isMedewerker'] == 1): ?>
    <!-- Display Medewerker-only content here -->
    <br>
    <a href="Admin/Medewerker-overzicht.php" class="login-button"><h1>Admin overzicht</h1></a>

    
<?php endif; ?>




  </center>
  <br><br><br><br><br><br><br><br><br><br><br><br>

  <style>
    footer {
      box-sizing: border-box;
      background-color: navy;
      color: white;
      padding: 7px;
      position: fixed;
      bottom: 0;
      width: 100%;
      text-align: left;
    }
  </style>

  <footer class="footer">
    Mika Wesseling ©
  </footer>
</body>

</html>
