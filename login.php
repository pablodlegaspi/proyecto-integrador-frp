<?php

  require_once "register-login-validation.php";

  if (alreadyLoggedIn()) {
    header("location: timeline.php");
  }

  if ($_POST) {

  $userNameOrEmail = $_POST["userNameOrEmail"];

    $errorsInRegister = validateLogin ();

    if (!$errorsInRegister) {

      $userToLogin = getUserByUserNameOrEmail($userNameOrEmail);

      login($userToLogin);

      if ( isset($_POST["rememberUser"]) ) {
        setcookie('userNameOrEmail', $_POST['userNameOrEmail'], time() + 30);
      }

      header('location: profile.php');
      exit;
    }

  }


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
  </head>
  <body>

    <div class="container">
      <section class="header-home">
        <a class="logo-home" href="_home.php"><img src="deposito-de-archivos/Logo70x70.png" alt="logo-de-vecinos-colaborativos"></a>
        <div class="login-register">
          <?php if (!alreadyLoggedIn()) : ?>
            <a href="login.php">Iniciar Sesión</a>
            <a href="register.php">Registrate</a>
          <?php endif; ?>
          <?php if (alreadyLoggedIn()) : ?>
            <a href="timeline.php">Timeline</a>
            <a href="profile.php">Mi Perfil</a>
          <?php endif; ?>
        </div>
      </section>

      <div class="register-box">
        <section class="seccion-a">
          <div class="logo-container">
            <img class="register-logo"src="deposito-de-archivos/Logo.png"alt="logo-de-vecinos-colaborativos">
          </div>
          <h1 class="register-vecino">Vecinos Colaborativos</h1>
        </section>
        <h3 class="login-title">Iniciar Sesión</h3>
        <div class="formulario">
          <form action="" method="post">
            <div class="form-element">
              <label for="userNameOrEmail"
                <?php if (isset($errorsInRegister["inUserNameOrEmail"])) : ?>
                  style="color:red;">
                <?php endif; ?>
                <b>Nombre de Usuario / Correo Electrónico:</b>
              </label>
              <input class="form" type="text" type="email" name="userNameOrEmail" id="userNameOrEmail" value="<?= isset($userNameOrEmail) ? $userNameOrEmail : ""; ?>">
            </div>
            <?php if ( isset($errorsInRegister["inUserNameOrEmail"]) ) : ?>
              <div class="register-alert">
                <?= $errorsInRegister["inUserNameOrEmail"] ?>
              </div>
            <?php endif; ?>
            <div class="form-element">
              <label for="password"
                <?php if (isset($errorsInRegister["inPassword"])) : ?>
                  style="color:red;">
                <?php endif; ?>
                <b>Contraseña:</b>
              </label>
              <input class="form" type="password" name="password" id="password">
            </div>
            <?php if ( isset($errorsInRegister["inPassword"]) ) : ?>
              <div class="register-alert">
                <?= $errorsInRegister["inPassword"] ?>
              </div>
            <?php endif; ?>
            <div class="form-element">
              <label for="rememberUser">
                <input type="checkbox" name="rememberUser" class="rememberUser" id="rememberUser" value="">
                Recordarme
              </label>
            </div>
            <div class="form-element">
              <input class="boton" type="submit" value="Ingresar">
            </div>
          </form>
        </div>
        <p class="p-condiciones">Al registrarte, aceptas nuestras <a class="register-condiciones" href="tyc.html">Condiciones</a>, la <a class="register-condiciones" href="tyc.html">Política de datos </a> y
        la <a class="register-condiciones" href="tyc.html"> Política de cookies</a>.</p>
      </div>

      </div>

      <section class="footer">
          <a href="faq.php">Preguntas Frecuentes</a>
          <a href="tyc.php">Términos y Condiciones</a>
      </section>
    </div>


  </body>
</html>
