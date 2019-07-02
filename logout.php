<?php
session_start();
session_destroy();

setcookie('userNameOrEmail', "", time() - 1);

header ('location: _home.php');
exit;

?>
