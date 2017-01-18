

<html>
  <head>
    <title>Captcha</title>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <link rel="stylesheet" type="text/css" href="<?= CSS_URL . "style.css" ?>">
  </head>
  <body>
    <h1>Captcha preverjanje</h1>
    <form id="captcha_form" method="post">     
      <div class="g-recaptcha" data-sitekey="6LdZ6hEUAAAAAICrSYa0j1I1wtv0iLPF70MJYf6c"></div><br><br>
      <input type="submit" name="submit" value="Preveri"><br><br>
    </form>
  </body>
</html>

<?php
        $captcha = "";
        if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){ ?>
            <h2>Odkljukaj da nisi robot.</h2>
            <p>
                <a class="nav" href="<?= BASE_URL . "artikli" ?>">Domov</a>        
            </p>
                     
       <?php exit; }
        
        $secretKey = "6LdZ6hEUAAAAAOHJjNACnGz08fbOaE5aWmGhalRP";
        $ip = $_SERVER['REMOTE_ADDR'];
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
        $responseKeys = json_decode($response,true);
        
        if(intval($responseKeys["success"]) !== 1) {
            
          echo '<h2>Roboti se ne smejo registrirati...</h2>';
          
        } else {
          $_SESSION["ni_robot"]= "OK";
          ViewHelper::redirect(BASE_URL . "stranke/registracija");
        }
?>