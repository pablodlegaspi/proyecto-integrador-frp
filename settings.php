<?php
require_once 'register-login-validation.php';
require_once 'change-information.php';


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

if (!alreadyLoggedIn()) {
  header("location: login.php");
}

$loggedUser = $_SESSION['loggedUser'];

if ($_POST) {

  $errorsInNewInfo = validateChanges ();

}

?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
  </head>
  <body>
    <div class="container">
      <section class="header-timeline">
        <div class="sub-header-timeline">

          <a class="logo" href="_home.php"><img src="deposito-de-archivos/Logo50x50.png" alt="logo-de-vecinos-colaborativos"></a>

          <div class="buscador-area">
            <input class="buscador" type="text" name="buscador" value="" placeholder="Buscar...">
            <a href="#"><i class="fas fa-search"></i></a>
          </div>

          <div class="buscador-lupa">
            <a href="#"><i class="fas fa-search"></i></a>
          </div>

          <div class="timeline-anchor">
            <a href="timeline.php"><i class="fas fa-home"></i></a>
          </div>

          <div class="menu-timeline">
            <a href="timeline.php"><i class="fas fa-home"></i></a>
            <div class="separador">
              <span>|</span>
            </div>
            <a href="contactos.php"><i class="fas fa-user-friends"></i></a>
            <div class="separador">
              <span>|</span>
            </div>
            <a href="#"><i class="fas fa-user-plus"></i></a>
            <div class="separador">
              <span>|</span>
            </div>
            <a href="#"><i class="fas fa-plus"></i></a>
            <div class="separador">
              <span>|</span>
            </div>
            <a href="#"><i class="fas fa-exclamation"></i></a>
          </div>

          <div class="menu-hamburguesa">
            <a href="#"><i class="fas fa-bars"></i></a>
            <div class="dropdown-content">
              <a href="contactos.php">Mis Contactos</a>
              <a href="#">Agregar Contactos</a>
              <a href="#">Crear</a>
              <a href="#">Notificaciones</a>
            </div>
          </div>

          <div class="perfil-timeline">
            <a href="profile.php"> <span><?= $loggedUser['fullName'] ?></span>
              <div class="profile-pic-in-navbar" style="
              height: 34px;
              width: 34px;
              background-image: url('<?= $loggedUser['profilePicRoute'] ?>');
              background-size: cover;
              background-position: center;
              border-radius: 100%;">
              </div>
            </a>
          </div>

          <div class="logout">
            <a href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
          </div>

        </div>

      </section>

      <section class="perfil-container">
        <div class="perfil-contenido">
          <div class="foto-nombre-y-redes">
            <a href="profile.php">
              <div class="foto-en-perfil" style="
                width: 180px;
                height: 180px;
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                align-items: center;
                border: 5px black;
                background-image: url('<?= $loggedUser['profilePicRoute'] ?>');
                background-size: cover;
                background-position: center;
                border-radius: 100%;">
              </div>
            </a>

            <div class="datos-en-perfil">
              <a href="profile.php"><?= $loggedUser['fullName'] ?></a>
              <ul>
                <li class="fb"><a href="#"><i class="fab fa-facebook-f"></a></i></li>
                <li class="tw"><a href="#"><i class="fab fa-twitter"></i></a></li>
                <li class="ig"><a href="#"><i class="fab fa-instagram"></a></i></li>
                <li class="li"><a href="#"><i class="fab fa-linkedin-in"></a></i></li>
              </ul>
            </div>
            <div class="descripcion-perfil">
              <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt. </span>
            </div>
          </div>
          <div class="menu-perfil">
            <ul>
              <li><a href="contactos.php">Contactos</a></li>
              <li><a href="#">Grupos</a></li>
              <li><a href="#">Proyectos</a></li>
              <li><a href="#">Intereses</a></li>
              <li><a href="#">Configuración</a></li>
            </ul>
          </div>
        </div>
      </section>

      <div class="timeline-container">

        <section class="timeline-left">
          <div class="contenido-usuario">
            <div class="tus-proyectos">
              <h6>Tu proyectos:</h6>
              <hr>
              <div class="proyecto">
                <div class="proyecto-izq">
                  <a href="#"> <img src="deposito-de-archivos/img-02-80x80.jpg" alt="foto-cohousing-exterior"> </a>
                </div>
                <div class="proyecto-der">
                  <a href="#">Nombre del proyecto</a>
                  <p>Creado el 4 de junio de 2018</p>
                </div>
              </div>
            </div>
          </div>

          <div class="contenido-usuario">
            <div class="tus-grupos">
              <h6>Tus grupos:</h6>
              <hr>
              <div class="proyecto">
                <div class="proyecto-izq">
                  <a href="#"> <img src="deposito-de-archivos/img-02-80x80.jpg" alt="foto-cohousing-exterior"> </a>
                </div>
                <div class="proyecto-der">
                  <a href="#">Nombre del grupo</a>
                  <p>Creado el 4 de junio de 2018</p>
                </div>
              </div>
              <hr>
              <div class="proyecto">
                <div class="proyecto-izq">
                  <a href="#"> <img src="deposito-de-archivos/img-02-80x80.jpg" alt="foto-cohousing-exterior"> </a>
                </div>
                <div class="proyecto-der">
                  <a href="#">Nombre del grupo</a>
                  <p>Creado el 4 de junio de 2018</p>
                </div>
              </div>
              <hr>
              <div class="proyecto">
                <div class="proyecto-izq">
                  <a href="#"> <img src="deposito-de-archivos/img-02-80x80.jpg" alt="foto-cohousing-exterior"> </a>
                </div>
                <div class="proyecto-der">
                  <a href="#">Nombre del grupo</a>
                <p>Creado el 4 de junio de 2018</p>
                </div>
              </div>
              <hr>
              <div class="proyecto">
                <div class="proyecto-izq">
                  <a href="#"> <img src="deposito-de-archivos/img-02-80x80.jpg" alt="foto-cohousing-exterior"> </a>
                </div>
                <div class="proyecto-der">
                  <a href="#">Nombre del grupo</a>
                  <p>Creado el 4 de junio de 2018</p>
                </div>
              </div>
            </div>
          </div>
        </section>

      <section class="settings">
        <h3>Configuración</h4>
        <div class="user-information">
          <ul>
            <li>Nombre Completo: <b><?= $loggedUser["fullName"] ?></b></li>
            <li>Nombre de Usuario: <b><?= $loggedUser["userName"] ?></b></li>
            <li>Correo Electrónico: <b><?= $loggedUser["email"] ?></b> </li>
            <li>País de Nacimiento: <b>
              <?php foreach ($countries as $code => $country) :
                if ($code == $loggedUser["country"]) : echo $country;?></li>
              <?php endif;?>
              <?php endforeach;?></b>
          </ul>
        </div>
        <h3>Cambiar datos personales:</h3>
        <form class="change-information" action="" method="post" enctype="multipart/form-data">

          <div class="form-element">
            <label for="fullName">
              <b>Nombre Completo:</b> <?= $loggedUser["fullName"] ?>
            </label>
            <input class="form" type="text" name="newFullName" id="fullName" placeholder="Ingresa tu nuevo nombre...">
                <?php if ( isset($errorsInNewInfo["inNewFullName"]) ) : ?>
                  <div class="register-alert">
                <?= $errorsInNewInfo["inNewFullName"] ?>
                  </div>
                <?php endif; ?>
          </div>

          <div class="form-element">
            <label for="password">
              <b>Contraseña:</b>
            </label>
            <input class="form" type="password" name="password" id="password" placeholder="Ingresa tu contraseña...">
              <?php if ( isset($errorsInNewInfo["inPassword"]) ) : ?>
                <div class="register-alert">
              <?= $errorsInNewInfo["inPassword"] ?>
                </div>
              <?php endif; ?>
            <input class="form" type="password" name="newPassword" id="password" placeholder="Ingresa tu contraseña nueva...">
            <input class="form" type="password" name="reNewPassword" id="password" placeholder="Repite tu contraseña nueva...">
          </div>

          <div class="form-element">
            <label for="country">
              <b>Nuevo País de Nacimiento:</b>
              <select class="countries" name="country">
                <option value="">Elegí un país</option>
                  <?php foreach ($countries as $code => $country): ?>
                  <option value="<?= $code ?>"> <?= $country ?> </option>
                <?php endforeach; ?>
              </select>
            </label>
          </div>

          <div class="form-element">
            <label for="profilePic" class="profile-pic-label-container">
              <b>Nueva Imagen de perfil:</b>
              <label class="profile-pic-label" for="profilePic">
                <i class="fas fa-file-upload"></i>
                Mi Archivo
              </label>
              <input class"form" type="file" name="profilePic" id="profilePic" value="" style="display: none;">
            </label>
          </div>

          <div class="form-element">
            <input class="boton" type="submit" value="Guardar Cambios">
          </div>

        </form>

      </section>

      <section class="timeline-right">
        <div class="sugerencias">
          <div class="crear-nuevo">
            <a href="#"><i class="fas fa-plus"></i></a>
            <a href="#">Crear un nuevo proyecto</a>
          </div>
        </div>
        <div class="sugerencias">
          <div class="crear-nuevo">
            <a href="#"><i class="fas fa-plus"></i></a>
            <a href="#">Crear un nuevo grupo</a>
          </div>
        </div>

        <div class="sugerencias">
          <h6>Proyectos que podrían interesarte:</h6>
          <hr>
          <div class="proyecto">
            <div class="proyecto-izq">
              <a href="#"> <img src="deposito-de-archivos/img-02-80x80.jpg" alt="foto-cohousing-exterior"> </a>
            </div>
            <div class="proyecto-der">
              <a href="#">Nombre del proyecto</a>
              <p>Creado el 4 de junio de 2018</p>
            </div>
          </div>
          <hr>
          <div class="proyecto">
            <div class="proyecto-izq">
              <a href="#"> <img src="deposito-de-archivos/img-02-80x80.jpg" alt="foto-cohousing-exterior"> </a>
            </div>
            <div class="proyecto-der">
              <a href="#">Nombre del proyecto</a>
              <p>Creado el 4 de junio de 2018</p>
            </div>
          </div>
        </div>

        <div class="sugerencias">
          <h6>Grupos que podrían interesarte:</h6>
          <hr>
          <div class="proyecto">
            <div class="proyecto-izq">
              <a href="#"> <img src="deposito-de-archivos/img-02-80x80.jpg" alt="foto-cohousing-exterior"> </a>
            </div>
            <div class="proyecto-der">
              <a href="#">Nombre del grupo</a>
              <p>Creado el 4 de junio de 2018</p>
            </div>
          </div>
          <hr>
          <div class="proyecto">
            <div class="proyecto-izq">
              <a href="#"> <img src="deposito-de-archivos/img-02-80x80.jpg" alt="foto-cohousing-exterior"> </a>
            </div>
            <div class="proyecto-der">
              <a href="#">Nombre del grupo</a>
              <p>Creado el 4 de junio de 2018</p>
            </div>
          </div>
        </div>

        <div class="sugerencias">
          <h6>Sugerencias de contactos:</h6>
          <hr>
          <div class="sugerencia-contacto">
            <div class="foto-contacto-sugerido">
              <a href="#"> <img src="deposito-de-archivos/user-50x50.png" alt="foto-de-contacto-sugerido"> </a>
            </div>
            <div class="nombre-contacto-sugerido">
              <a href="#">Nombre del contacto</a>
            </div>
          </div>
          <hr>
          <div class="sugerencia-contacto">
            <div class="foto-contacto-sugerido">
              <a href="#"> <img src="deposito-de-archivos/user-50x50.png" alt="foto-de-contacto-sugerido"> </a>
            </div>
            <div class="nombre-contacto-sugerido">
              <a href="#">Nombre del contacto</a>
            </div>
          </div>
          <hr>
          <div class="sugerencia-contacto">
            <div class="foto-contacto-sugerido">
              <a href="#"> <img src="deposito-de-archivos/user-50x50.png" alt="foto-de-contacto-sugerido"> </a>
            </div>
            <div class="nombre-contacto-sugerido">
              <a href="#">Nombre del contacto</a>
            </div>
          </div>
          <hr>
          <div class="sugerencia-contacto">
            <div class="foto-contacto-sugerido">
              <a href="#"> <img src="deposito-de-archivos/user-50x50.png" alt="foto-de-contacto-sugerido"> </a>
            </div>
            <div class="nombre-contacto-sugerido">
              <a href="#">Nombre del contacto</a>
            </div>
          </div>
        </div>
      </section>

      </div>

    </div>
  </body>
</html>
