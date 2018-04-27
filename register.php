<?php
/* Registration process, inserts user info into the database
   and sends account confirmation email message
 */
 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;

 require 'PHPMailer/src/Exception.php';
 require 'PHPMailer/src/PHPMailer.php';
 require 'PHPMailer/src/SMTP.php';

 if ($_SERVER['HTTPS'] != "on") {
     $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
     header("Location: $url");
     exit;
 }
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
        Hej '.$first_name.',

        Tak for at tilmelde dig vores hjemmeside!

        Klik på nedenstående link for at aktivere din bruger:

        https://kajkager.dk/verify.php?email='.$email.'&hash='.$hash;

        $message = wordwrap($message, 70);

        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 2;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'asmtp.curanet.dk';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = 'service@kajkager.dk';                 // SMTP username
            $mail->Password = 'Admin123';                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 8080;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('service@kajkager.dk', 'Digital Kørekort');
            $mail->addAddress($to);     // Add a recipient

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;
            $mail->AltBody = $message;

            $mail->send();


        header("location: profile.php");

          }
      }
}

?>
