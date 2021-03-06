<?php
/* Opdatere databasen med det nye kodeord */
require 'db.php';
session_start();

if ($_SERVER['HTTPS'] != "on") {
    $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    header("Location: $url");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Tjek om de 2 kodeord er ens
    if ( $_POST['newpassword'] == $_POST['confirmpassword'] ) {

        $new_password = crypt($_POST['newpassword']);

        
        $email = $mysqli->escape_string($_POST['email']);
        $hash = $mysqli->escape_string($_POST['hash']);

        $sql = "UPDATE users SET password='$new_password', hash='$hash' WHERE email='$email'";

        if ( $mysqli->query($sql) ) {

        $_SESSION['message'] = "Dit kodeord er blevet ændret!";
        header("location: success.php");

        }

    }
    else {
        $_SESSION['message'] = "De to kodeord du har skrevet er ikke ens, prøv igen!";
        header("location: error.php");
    }

}
?>
