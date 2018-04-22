<?php
/* Main page with two forms: sign up and log in */
require 'db.php';
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Digitalt Kørekort</title>
  <?php include 'css/css.html'; ?>
</head>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (isset($_POST['login'])) { //user logging in

        require 'login.php';

    }

    elseif (isset($_POST['register'])) { //user registering

        require 'register.php';

    }
}
?>
<body>
  <div class="form">

      <ul class="tab-group">
        <li class="tab"><a href="#signup">Lav Bruger</a></li>
        <li class="tab active"><a href="#login">Log Ind</a></li>
      </ul>

      <div class="tab-content">

         <div id="login">
          <h1>Velkommen til dit digitale kørekort</h1>

          <form action="index.php" method="post" autocomplete="off">

            <div class="field-wrap">
            <label>
              E-mail <span class="req">*</span>
            </label>
            <input type="email" required autocomplete="off" name="email"/>
          </div>

          <div class="field-wrap">
            <label>
              Kodeord <span class="req">*</span>
            </label>
            <input type="password" required autocomplete="off" name="password"/>
          </div>

          <p class="forgot"><a href="forgot.php">Glemt dit kodeord?</a></p>

          <button class="button button-block" name="login" />Log Ind</button>

          </form>

        </div>

        <div id="signup">
          <h1>Lav en bruger gratis</h1>

          <form action="index.php" method="post" autocomplete="off">

          <div class="top-row">
            <div class="field-wrap">
              <label>
                Navn<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name='firstname' />
            </div>

            <div class="field-wrap">
              <label>
                Efternavn<span class="req">*</span>
              </label>
              <input type="text"required autocomplete="off" name='lastname' />
            </div>
          </div>

          <div class="field-wrap">
            <label>
              E-mail<span class="req">*</span>
            </label>
            <input type="email"required autocomplete="off" name='email' />
          </div>

          <div class="field-wrap">
            <label>
              Kodeord<span class="req">*</span>
            </label>
            <input type="password"required autocomplete="off" name='password'/>
          </div>

          <div class="field-wrap">
            <label>
              CPR-Nummer<span class="req">*</span>
            </label>
            <input type="text"required autocomplete="off" name='cpr_number'/>
          </div>

          <div class="field-wrap">
            <label>
              Kørekort Udløbsdato<span class="req">*</span>
            </label>
            <input type="text"required autocomplete="off" name='expire_date'/>
          </div>

          <button type="submit" class="button button-block" name="register" />Lav bruger</button>

          </form>

        </div>

      </div><!-- tab-content -->

</div> <!-- /form -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js?ver=<?php echo rand(111,999)?>'></script>

    <script src="js/index.js"></script>

</body>
</html>
