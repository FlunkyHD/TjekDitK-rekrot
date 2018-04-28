<?php
/* Reset your password form, sends reset.php password link */
require 'db.php';
require 'PHPMailer/PHPMailerAutoload.php';
session_start();

if ($_SERVER['HTTPS'] != "on") {
    $url = "https://". $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    header("Location: $url");
    exit;
}

// Check if form submitted with method="post"
if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
    $email = $mysqli->escape_string($_POST['email']);
    $result = $mysqli->query("SELECT * FROM users WHERE email='$email'");

    if ( $result->num_rows == 0 ) // User doesn't exist
    {
        $_SESSION['message'] = "Bruger med denne email findes ikke";
        header("location: error.php");
    }
    else { // User exists (num_rows != 0)

        $user = $result->fetch_assoc(); // $user becomes array with user data

        $email = $user['email'];
        $hash = $user['hash'];
        $first_name = $user['first_name'];

        // Session message to display on success.php
        $_SESSION['message'] = "<p>Tjek din E-mail <span>$email</span>"
        . " for at finde linket til at reset dit kodeord </p>";

        // Send registration confirmation link (reset.php)
        $to      = $email;
        $subject = 'Reset dit kodeord!';
        $message = '
        Hello '.$first_name.',

       Du har efterspurt et af dit kodeord!

        Klik på linket nedenunder for at reset dit kodeord:

        https://kajkager.dk/reset.php?email='.$email.'&hash='.$hash;

         $mail = new PHPMailer;

          $mail->SMTPDebug = 0;                               // Enable verbose debug output

          $mail->isSMTP();                                      // Set mailer to use SMTP
          $mail->Host = 'asmtp.curanet.dk';  // Specify main and backup SMTP servers
          $mail->SMTPAuth = true;                               // Enable SMTP authentication
          $mail->Username = 'service@kajkager.dk';                 // SMTP username
          $mail->Password = 'Admin123';                           // SMTP password
          $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
          $mail->Port = 8080;                                    // TCP port to connect to

          $mail->setFrom('service@kajkager.dk');
          $mail->addAddress($to);     // Add a recipient

          $mail->isHTML(true);                                  // Set email format to HTML

          $mail->Subject = $subject;
          $mail->Body    = $message;
          $mail->AltBody = $message;

          $mail->send();;

        header("location: success.php");
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Reset dit kodeord</title>
  <?php include 'css/css.html'; ?>
</head>

<body>

  <div class="form">

    <h1>Reset dit kodeord</h1>

    <form action="forgot.php" method="post">
     <div class="field-wrap">
      <label>
        E-mail<span class="req">*</span>
      </label>
      <input type="email"required autocomplete="off" name="email"/>
    </div>
    <button class="button button-block"/>Reset</button>
    </form>
  </div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>
</body>

</html>
