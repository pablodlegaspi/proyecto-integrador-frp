<?php
require_once 'register-login-validation.php';

?>
<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vecinos Colaborativos</title>
  </head>
  <body>
    <div class="container-home">
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
      <div class="main-l-r">
        <div class="main-left">
          <h1>Vecinos Colaborativos</h1>
          <h3 align= center>Cambiemos el mundo, un vecino colaborativo a la vez.</h3>
          <p>Vecinos Colaborativos es una red social dedicada a conectar buenos vecinos que quieren vivir colaborativamente y compartir bienes, servicios y experiencias con pares afines en valores, gustos e intereses. Aquí encontrarás publicaciones de proyectos de Cohousing y grupos que podrás crear o unirte según tus preferencias, ubicación e intereses y compartir material con otros miembros, antes de llevarlo a la acción.</p>
          <p>Un vecino colaborativo es más útil a tu vida que un pariente o amigo lejano.</p>
          <p align=center><i>¡Encuentra tus nuevos vecinos!</i></p>
        </div>
        <div class="main-right">
          <img src="deposito-de-archivos/img-01.jpg" alt="cohousing-img">
          <p><b>"Mucha gente pequeña, en lugares pequeños, haciendo cosas pequeñas, puede cambiar el mundo"</b></p>
          <span><b>Eduardo Galeano</b></span>
        </div>
      </div>
      <section class="footer">
          <a href="faq.php">Preguntas Frecuentes</a>
          <a href="tyc.php">Términos y Condiciones</a>
      </section>
    </div>
  </body>
</html>
