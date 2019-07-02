<?php

session_start();

if ( isset($_COOKIE['userNameOrEmail']) ) {
  $loggedUser = getUserByUserNameOrEmail($_COOKIE['userNameOrEmail']);
  $_SESSION['loggedUser'] = $loggedUser;
}

function validateRegister() {

  $fullName = trim( ucwords($_POST["fullName"]) );
  $userName = $_POST["userName"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $rePassword = $_POST["rePassword"];
  $country = $_POST["country"];
  $profilePic = $_FILES["profilePic"];

  $errors = [];

  if ( empty($fullName) ) {
    $errors["inFullName"] = "Por favor completá con tu nombre y apellido.";
  } //me maté buscando una expresión regular ideal que acepte mucha variedad de caracteres pero que tambien haga que cada nombre o apellido empiece con mayusculas, ésta que encontré acepta muchos tipos de caracteres pero no exige mayúsculas en el principio. https://stackoverflow.com/questions/2385701/regular-expression-for-first-and-last-name
  //otra opción a considerar fue esta pero aceptaba números https://andrewwoods.net/blog/2018/name-validation-regex/
  // tampoco logré exigir máximo un espacio entre cada palabra
  elseif (!preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/", $fullName)) {
    $errors["inFullName"] = "Completar con el formato apropiado";
  }

  if ( empty($userName) ) {
    $errors["inUserName"] = "Por favor completá con tu nombre de usuario.";
  } //uso la misma regex que en el nombre completo pero agrego los números del 0 al 9, justo despues de A-Z y elimino el espacio al final de la lista de los caracteres raros, justo antes de la ",".
  elseif (!preg_match("/^[a-zA-Z0-9àáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð,.'-]+$/", $userName)) {
    $errors["inUserName"] = "El nombre de usuario no puede contener espacios.";
  } elseif (userNameExist($userName) == true) {
    $errors["inUserName"] = "Ya existe un usuario con ese nombre.";
  }


  if ( empty($email) ) {
    $errors["inEmail"] = "Por favor completá con tu correo electrónico.";
  } elseif ( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
    $errors["inEmail"] = "Completar con el formato apropiado";
  } elseif (emailExist($email) == true) {
    $errors["inEmail"] = "Ya existe un usuario con ese correo electrónico.";
  }

  if ( empty($password) ) {
    $errors["inPassword"] = "Por favor completá con tu contraseña.";
  } elseif (strlen($password) < 5) {
    $errors["inPassword"] = "La contraseña debe tener mínimo 5 caracteres.";
  } elseif ( preg_match("/ /", $password) ) { //retorna true si hay un espacio, entonces:
    $errors["inPassword"] = "La contraseña no puede contener espacios";
  } elseif ( !preg_match("/DH/", $password) ) { //retorna true si contiene "DH", pero como tiene "!" al principio:
    $errors["inPassword"] = "La contraseña debe incluir las letras 'DH'";
  }

  if ( empty($rePassword) ) {
    $errors["inRePassword"] = "Por favor repetí tu contraseña.";
  } elseif ($rePassword != $password) {
    $errors["inRePassword"] = "Las contraseñas no coinciden.";
  }

  if ($profilePic["error"] != UPLOAD_ERR_OK) {
    $errors["inProfilePic"] = "Por favor elegí una imágen de perfil.";
  } else {
    $ext = pathinfo($profilePic["name"], PATHINFO_EXTENSION);

    if ($ext != "jpg" && $ext != "jpeg" && $ext != "png") {
      $errors["inProfilePic"] = "Por favor subí una imágen de tipo 'jpg', 'jpeg' o 'png'.";
    }
  }

  return $errors;

}

function validateLogin() {

  $userName_email = trim($_POST["userNameOrEmail"]);
  $password = trim($_POST["password"]);

  $errors = [];

  if (empty($userName_email)) {
      $errors["inUserNameOrEmail"] = "Por favor completá con tu nombre de usuario o correo electrónico";
    } elseif ( !userNameOremailExist($userName_email) ) {
      $errors["inUserNameOrEmail"] = "No existe un usuario registrado con ese nombre de usuario o correo electrónico.";
    }

  if ( empty($password) ) {
    $errors["inPassword"] = "Por favor completá con tu contraseña.";
  } else {

    $userToLogin = getUserByUserNameOrEmail($userName_email);

    if ( !password_verify($password, $userToLogin["password"]) ) {
      $errors["inPassword"] = "Las credenciales no coinciden.";
    }
  }

  return $errors;

}

function login($userToLogin) {

  unset($userToLogin["password"]);

  $_SESSION['loggedUser'] = $userToLogin;

}

function alreadyLoggedIn() {
  return isset($_SESSION['loggedUser']);
}

function userNameOremailExist($userNameOrEmail) {

  $users = getAllUsers();

  foreach ($users as $oneUser) {
    if ( $oneUser["email"] == $userNameOrEmail || $oneUser["userName"] == $userNameOrEmail ) {
      return true;
    }
  }
  return false;
}

function getAllUsers() {

  $usersArray = json_decode( file_get_contents("json/users.json"), true );

  return $usersArray;
}

function getUserByUserNameOrEmail($userNameOrEmail) {

  $users = getAllUsers();

  foreach ($users as $oneUser) {
    if ($oneUser["userName"] == $userNameOrEmail || $oneUser["email"] == $userNameOrEmail) {
      return $oneUser;
    }
  }
  return false;
}

function emailExist($email) {

  $users = getAllUsers();

  foreach ($users as $oneUser) {
    if ( $oneUser["email"] == $email ) {
      return true;
    }
  }
  return false;
}

function userNameExist($userName) {

  $users = getAllUsers();

  foreach ($users as $oneUser) {
    if ( $oneUser["userName"] == $userName ) {
      return true;
    }
  }
  return false;
}

function saveUser() {

  $usersList = getAllUsers();

  unset($_POST["rePassword"]);

  $_POST["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);

  $usersList[] = $_POST;

  return file_put_contents( "json/users.json", json_encode($usersList, JSON_PRETTY_PRINT) );
}

function saveImage($file) {

  $ext = pathinfo($file["name"], PATHINFO_EXTENSION);

  $destino = "archive/" . $_POST["userName"] . uniqid("-") . "." . $ext;

  move_uploaded_file($file["tmp_name"], $destino);

  return $destino;

}

?>
