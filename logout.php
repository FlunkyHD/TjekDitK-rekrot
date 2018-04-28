<?php
/* Log out process, unsets and destroys session variables */

if ($_SERVER['HTTPS'] != "on") {
    $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    header("Location: $url");
    exit;
}

session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Log ud</title>
  <?php include 'css/css.html'; ?>
</head>

<body>
    <div class="form">
          <h1>Tak fordi at du bruge vores hjemmeside</h1>

          <p><?= 'Du er blevet logget ud!'; ?></p>

          <a href="index.php"><button class="button button-block"/>Home</button></a>

    </div>
</body>
</html>
