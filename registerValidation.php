<?php

function validateRegister() {

  $fullName = trim( ucwords($_POST["fullName"]) );
  $userName = $_POST["userName"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $rePassword = $_POST["rePassword"];
  $country = $_POST["country"];
  $profillePic = $_FILES["profilePic"];
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
  }

  if ( empty($email) ) {
    $errors["inEmail"] = "Por favor completá con tu correo electrónico.";
  } elseif ( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
    $errors["inEmail"] = "Completar con el formato apropiado";
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
    $errors["inRePassword"] = "Las contraseñas no coinciden";
  }

  

  return $errors;

}




?>
