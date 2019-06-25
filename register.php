<?php

  require_once "registerValidation.php";

  $countries = [
    'ar' => 'Argentina',
		'br' => 'Brasil',
		'bo' => 'Bolivia',
		'co' => 'Colombia',
		'ch' => 'Chile',
		'ec' => 'Ecuador',
		'pe' => 'Perú',
    'pa' => 'Paraguay',
		've' => 'Venezuela'
  ];

  if ($_POST) {

    $fullNameInPost = trim( ucwords($_POST["fullName"]) );
    //ucwords hace mayúscula la primera letra de cada palabra.
    $userNameInPost = trim($_POST["userName"]);
    $emailInPost = trim($_POST["email"]);

    $errorsInRegister = validateRegister ();

  }

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
  </head>
  <body>

  <div class="container">

    <section class="header-home">
      <a class="logo-home" href="_home.php"><img src="docs/Logo70x70.png" alt="logo-de-vecinos-colaborativos"></a>
      <div class="login-register">
        <a href="login.php">Iniciar Sesión</a>
        <a href="register.php">Registrate</a>
      </div>
    </section>

    <div class="register-box">
      <section class="seccion-a">
        <div class="logo-container">
          <img class="register-logo"src="docs/Logo.png"alt="logo-de-vecinos-colaborativos">
        </div>
        <h1 class="register-vecino">Vecinos Colaborativos</h1>
      </section>
      <h3 class="crea-tu-cuenta">Creá tu Cuenta</h3>
      <div class="formulario">
        <form action="" method="post" enctype="multipart/form-data">
          <div class="form-element">
            <label for="fullName"><b>Nombre Completo:</b></label>
            <input class="form" type="text" name="fullName" id="fullName" value="<?= isset($fullNameInPost) ? $fullNameInPost : ""; ?>">
          </div>
          <?php if ( isset($errorsInRegister["inFullName"]) ) : ?>
            <div class="register-alert">
              <?= $errorsInRegister["inFullName"] ?>
            </div>
          <?php endif; ?>
          <!-- <div class="register-alert">
            <span>ALERTA!</span>
          </div> -->
          <div class="form-element">
            <label for="userName"><b>Nombre de Usuario:</b></label>
            <input class="form" type="text" name="userName" id="userName" value="<?= isset($userNameInPost) ? $userNameInPost : ""; ?>">
          </div>
          <?php if ( isset($errorsInRegister["inUserName"]) ) : ?>
            <div class="register-alert">
              <?= $errorsInRegister["inUserName"] ?>
            </div>
          <?php endif; ?>
          <div class="form-element">
            <label for="email"> <b>Correo Electrónico:</b> </label>
            <input class="form" type="email" name="email" id="email" value="<?= isset($emailInPost) ? $emailInPost : ""; ?>">
          </div>
          <?php if ( isset($errorsInRegister["inEmail"]) ) : ?>
            <div class="register-alert">
              <?= $errorsInRegister["inEmail"] ?>
            </div>
          <?php endif; ?>
          <div class="form-element">
            <label for="password"> <b>Contraseña:</b> </label>
            <input class="form" type="password" name="password" id="password">
          </div>
          <?php if ( isset($errorsInRegister["inPassword"]) ) : ?>
            <div class="register-alert">
              <?= $errorsInRegister["inPassword"] ?>
            </div>
          <?php endif; ?>
          <div class="form-element">
            <label for="rePassword"> <b>Repetir contraseña:</b> </label>
            <input class="form" type="password" name="rePassword" id="rePassword">
          </div>
          <?php if ( isset($errorsInRegister["inRePassword"]) ) : ?>
            <div class="register-alert">
              <?= $errorsInRegister["inRePassword"] ?>
            </div>
          <?php endif; ?>
          <div class="form-element">
            <label class="country-label" for="country">
              <b>País de Nacimiento:</b>
              <select class="countries" name="country">
                <option value="">Elegí un país</option>
                <?php foreach ($countries as $code => $country): ?>
                  <!-- no entiendo bien esto de selected, lo use como referencia del ejercicio de cookies y session pero no lo entiendo, seguro en la clase de hoy (25/6) lo veamos -->
                  <option <?= isset($_POST["country"]) && $_POST["country"] == $code ? "selected" : "" ; ?> value="<?= $code ?>"> <?= $country ?> </option>
                <?php endforeach; ?>
              </select>
            </label>
          </div>
          <div class="form-element">
            <label class="profile-pic-label-container" for="">
              <b>Imagen de perfil:</b>
              <label class="profile-pic-label" for="profilePic">
                <i class="fas fa-file-upload"></i>
                Mi Archivo
              </label>
              <input class"form" type="file" name="profilePic" id="profilPic" value="">
            </label>
          </div>
          <div class="form-element">
            <input class="boton" type="submit" name="register" value="Registrarme">
          </div>
        </form>
      </div>
      <p class="p-condiciones">Al registrarte, aceptas nuestras <a class="register-condiciones" href="tyc.html">Condiciones</a>, la <a class="register-condiciones" href="tyc.html">Política de datos </a> y
      la <a class="register-condiciones" href="tyc.html"> Política de cookies</a>.</p>
    </div>

    <section class="footer">
        <a href="faq.php">Preguntas Frecuentes</a>
        <a href="tyc.php">Términos y Condiciones</a>
    </section>

  </div>

  </body>
</html>
