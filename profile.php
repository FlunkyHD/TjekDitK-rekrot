<?php
/* Displays user information and some useful messages */
session_start();

// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing your profile page!";
  header("location: error.php");
      $first_name = $_SESSION['first_name'];
}
else {
    // Makes it easier to read
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
          // Display message about account verification link only once
          if ( isset($_SESSION['message']) )
          {
              echo $_SESSION['message'];

              // Don't annoy the user with more messages upon page refresh
              unset( $_SESSION['message'] );
          }

          ?>
          </p>

          <?php

          // Keep reminding the user this account is not active, until they activate
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

<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>

</body>
</html>
