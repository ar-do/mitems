<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Mitems - Login</title>
    <link href="../css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="../css/components/signin.css" rel="stylesheet">
    
 
  </head>
  <body class="text-center">
    
<main class="form-signin w-100 m-auto">

  <form method="post" action="helper/helper_login.php">
    <img class="mb-4 logo_img" src="../Assets/logo/logo_name.png" alt="Mitems Logo" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">Bitte Anmelden</h1>

    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" name="username" placeholder="name@example.com">
      <label for="floatingInput">Email Adresse</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
      <label for="floatingPassword">Passwort</label>
    </div>
    <button class="w-100 btn btn-lg bg-dark" name="form_submit" style="color:white;" type="submit">Anmelden</button>
  </form>
  <?php
      session_start();
      if((isset($_SESSION['login_fail'])) && $_SESSION['login_fail'] == true) {
        echo  "<div class='alert alert-danger' style='margin-top:5px;' role='alert'>
        Anmeldung fehlgeschlagen: Benutzername oder Passwort ist falsch!
        </div>";
      }
   
  ?>

</main>  
  </body>
</html>
