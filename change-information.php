<?php

require_once 'register-login-validation.php';

function validateChanges() {

  $newFullName = trim( ucwords($_POST["newFullName"]) );
  $password = $_POST["password"];
  $newPassword = $_POST["newPassword"];
  $reNewPassword = $_POST["reNewPassword"];
  $country = $_POST["country"];
  $profilePic = $_FILES["profilePic"];

  $errors = [];

  if (!empty($newFullName)) {
    if (!preg_match("/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]+$/", $newFullName)) {
      $errors["inFullName"] = "Completar con el formato apropiado";
    }
  }

  if (!empty($password)) {
    if (strlen($password) < 5) {
      $errors["inPassword"] = "La contraseña debe tener mínimo 5 caracteres.";
    } elseif ( preg_match("/ /", $password) ) { //retorna true si hay un espacio, entonces:
      $errors["inPassword"] = "La contraseña no puede contener espacios";
    } elseif ( !preg_match("/DH/", $password) ) { //retorna true si contiene "DH", pero como tiene "!" al principio:
      $errors["inPassword"] = "La contraseña debe incluir las letras 'DH'";
    } else {
      $allUsers = getAllUsers();
      foreach ($allUsers as $oneUser) {
        if (password_verify($oneUser['password'], $password)) {
          $errors["inPassword"] = "La contraseña es incorrecta";
        }
      }
    }
  }



  return $errors;
}

?>
