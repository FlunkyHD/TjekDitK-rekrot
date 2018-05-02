<?php
/* Registrering af bruger
 */
require 'PHPMailer/PHPMailerAutoload.php';

 if ($_SERVER['HTTPS'] != "on") {
     $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
     header("Location: $url");
     exit;
 }
// Set sesstion variabler, som skal bruges på profilen
$_SESSION['email'] = $_POST['email'];
$_SESSION['first_name'] = $_POST['firstname'];
$_SESSION['last_name'] = $_POST['lastname'];
$_SESSION['cpr_number'] = $_POST['cpr_number'];
$_SESSION['expire_date'] = $_POST['expire_date'];

// Beskyt mod SQL injections
$first_name = $mysqli->escape_string($_POST['firstname']);
$last_name = $mysqli->escape_string($_POST['lastname']);
$email = $mysqli->escape_string($_POST['email']);
$cpr = $mysqli->escape_string($_POST['cpr_number']);
$expire = $mysqli->escape_string($_POST['expire_date']);
$password = $mysqli->escape_string(crypt($_POST['password']));
$hash = $mysqli->escape_string( md5( rand(0,1000) ) );

// Tjekker om der allerde findes en bruger med en email
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'") or die($mysqli->error());


if ( $result->num_rows > 0 ) {

    $_SESSION['message'] = 'Bruger med denne E-mail findes allerede';
    header("location: error.php");

}
else { // Hvis emailen ikke allerde findes, indsæt data i database


    $sql = "INSERT INTO users (first_name, last_name, email, cpr_number, expire_date, password, hash) "
            . "VALUES ('$first_name','$last_name','$email','$cpr','$expire','$password','$hash')";

    // Tilføj bruger til database
    if ( $mysqli->query($sql) ){

        $_SESSION['active'] = 0; // Er 0 indtil bruger har aktiveret sin bruger
        $_SESSION['logged_in'] = true; // Så man ved at brugeren er logget ind
        $_SESSION['message'] =

                 "Et bekræftelses link er blev sendt til denne email: $email, aktivere
                  brugeren ved at klikke på linket i emailen";

        // Send aktiverings link til bruger (verify.php)

        $to      = $email;
        $subject = 'Aktivering af Bruger (Digitalt Kørekort)';
        $message = '
        Hej '.$first_name.',

        Tak for at tilmelde dig vores hjemmeside!

        Brug nedenstående link for at aktivere din bruger: <br>

        https://kajkager.dk/verify.php?email='.$email.'&hash='.$hash;

        $message = wordwrap($message, 70);

        $mail = new PHPMailer;

          $mail->SMTPDebug = 0;                               // Enable verbose debug output

          $mail->isSMTP();                                      // Set mailer to use SMTP
          $mail->Host = 'asmtp.curanet.dk';  // Specify main and backup SMTP servers
          $mail->SMTPAuth = true;                               // Enable SMTP authentication
          $mail->Username = 'aktivering@kajkager.dk';                 // SMTP username
          $mail->Password = 'Admin321';                           // SMTP password
          $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
          $mail->Port = 8080;                                    // TCP port to connect to

          $mail->setFrom('aktivering@kajkager.dk');
          $mail->addAddress($to);     // Add a recipient

          $mail->isHTML(true);                                  // Set email format to HTML

          $mail->Subject = $subject;
          $mail->Body    = $message;
          $mail->AltBody = $message;

          $mail->send();

          /* if(!$mail->send()) {
              echo 'Message could not be sent.';
              echo 'Mailer Error: ' . $mail->ErrorInfo;
          } else {
              echo 'Message has been sent';
          } */

        header("location: profile.php");

          } else {
            $_SESSION['message'] = 'Registrering af bruger fejlede!';
            header("location: error.php");
              }
    }

?>
</html>
