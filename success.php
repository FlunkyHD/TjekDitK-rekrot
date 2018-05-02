<?php
/* Hvises når det virker */
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
  <title>Succes</title>
  <?php include 'css/css.html'; ?>	
	<meta charset="UTF-8">
</head>
<body>
<div class="form">
    <h1><?= 'Succes'; ?></h1>
    <p>
    <?php
    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ):
        echo $_SESSION['message'];
    else:
        header( "location: index.php" );
    endif;
    ?>
    </p>
    <a href="index.php"><button class="button button-block"/>Hjem</button></a>
</div>
</body>
</html>
