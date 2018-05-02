<?php
/* Logger bruger ind, hvis loginoplysninger passer */

// Beskyttelse mod SQL injections
$email = $mysqli->escape_string($_POST['email']);
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");

if ($_SERVER['HTTPS'] != "on") {
    $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    header("Location: $url");
    exit;
}

if ( $result->num_rows == 0 ){ 
    $_SESSION['message'] = "En bruger med denne E-mai findes ikke!";
    header("location: error.php");
}
else { 
    $user = $result->fetch_assoc();

    if ( crypt($_POST['password'], $user['password']) ) {

        $_SESSION['email'] = $user['email'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
        $_SESSION['cpr_number'] = $user['cpr_number'];
        $_SESSION['expire_date'] = $user['expire_date'];
        $_SESSION['active'] = $user['active'];

        
        $_SESSION['logged_in'] = true;

        header("location: profile.php");
    }
    else {
        $_SESSION['message'] = "Du har indtastet et forkert kodeord, prøv igen!";
        header("location: error.php");
    }
}
