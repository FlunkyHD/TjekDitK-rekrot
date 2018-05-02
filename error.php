<?php
/* Visning af fejlbeskeder */
session_start();

if ($_SERVER['HTTPS'] != "on") {
    $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    header("Location: $url");
    exit;
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Fejl</title>
  <?php include 'css/css.html'; ?>
</head>
<body>
<div class="form">
    <h1>Fejl</h1>
    <p>
    <?php
    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ):
        echo $_SESSION['message'];
    else:
        header( "location: index.php" );
    endif;
    ?>
    </p>
    <a href="index.php"><button class="button button-block"/>Home</button></a>
</div>
</body>
</html>
