<?php
/* Registration process, inserts user info into the database
   and sends account confirmation email message
 */

// Set session variables to be used on profile.php page
$_SESSION['email'] = $_POST['email'];
$_SESSION['first_name'] = $_POST['firstname'];
$_SESSION['last_name'] = $_POST['lastname'];
$_SESSION['cpr_number'] = $_POST['cpr_number'];
$_SESSION['expire_date'] = $_POST['expire_date'];

// Escape all $_POST variables to protect against SQL injections
$first_name = $mysqli->escape_string($_POST['firstname']);
$last_name = $mysqli->escape_string($_POST['lastname']);
$email = $mysqli->escape_string($_POST['email']);
$cpr = $mysqli->escape_string($_POST['cpr_number']);
$expire = $mysqli->escape_string($_POST['expire_date']);
$password = $mysqli->escape_string(crypt($_POST['password']));
$hash = $mysqli->escape_string( md5( rand(0,1000) ) );

// Check if user with that email already exists
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'") or die($mysqli->error());

// We know user email exists if the rows returned are more than 0
if ( $result->num_rows > 0 ) {

    $_SESSION['message'] = 'Bruger med denne E-mail findes allerede';
    header("location: error.php");

}
else { // Email doesn't already exist in a database, proceed...

    // active is 0 by DEFAULT (no need to include it here)
    $sql = "INSERT INTO users (first_name, last_name, email, cpr_number, expire_date, password, hash) "
            . "VALUES ('$first_name','$last_name','$email','$cpr','$expire','$password','$hash')";

    // Add user to the database
    if ( $mysqli->query($sql) ){

        $_SESSION['active'] = 0; //0 until user activates their account with verify.php
        $_SESSION['logged_in'] = true; // So we know the user has logged in
        $_SESSION['message'] =

                 "Confirmation link has been sent to $email, please verify
                 your account by clicking on the link in the message!";

        // Send registration confirmation link (verify.php)

        $to      = $email;
        $subject = 'Aktivering af Bruger ( Digitalt Kørekort )';
        $message = '
        Hello '.$first_name.',

        Tak for at tilmelde dig vores hjemmeside!

        Klik på nedenstående link for at aktivere din bruger:

        https://http://kajkager.dk.web81.curanetserver.dk/login/verify.php?email='.$email.'&hash='.$hash;

        $message = wordwrap($message, 70);

        mail( 'mortenj2@hotmail.dk', $subject, $message );


        mail($email,"Success","Send mail from localhost using PHP");

        header("location: profile.php");

    }

    else {
        $_SESSION['message'] = 'Registration failed!';
        header("location: error.php");
    }

}
