<?php
/* Profil med bruger information */
session_start();

if ($_SERVER['HTTPS'] != "on") {
    $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    header("Location: $url");
    exit;
}

// Ser om brugeren er logget ordenligt ind
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "Du skal logge ind for at se din profil!";
  header("location: error.php");
      $first_name = $_SESSION['first_name'];
}
else {
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $cpr = $_SESSION['cpr_number'];
    $expire = $_SESSION['expire_date'];
    $active = $_SESSION['active'];
}
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Velkommen <?= $first_name.' '.$last_name ?></title>
  <?php include 'css/css.html'; ?>
</head>

<body>
  <div class="form">

          <h1>Velkommen <?= $first_name.' '.$last_name ?></h1>

          <p>
          <?php
         
          if ( isset($_SESSION['message']) )
          {
              echo $_SESSION['message'];

              
              unset( $_SESSION['message'] );
          }

          ?>
          </p>

          <?php

          // Hvis brugeren ikke er aktiveret, så sig det til brugeren
          if ( !$active ){
              echo
              '<div class="info">
              Brugeren er ikke aktiveret, du kan aktivere den ved at klikke på linket i emailen!
              </div>';
          }

          ?>

          <h2>Kørekort Info</h2>
          <p>Navn: <strong> <?= '  '.$first_name.' '.$last_name ?> </strong> <br> CPR-Nummer: <strong> <?= $cpr ?> </strong> <br> Udløbsdato: <strong> <?= $expire ?> </strong> </p>

          <a href="logout.php"><button class="button button-block" name="logout"/>Log Out</button></a>

    </div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

</body>
</html>