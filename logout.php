<?php
  session_start();
  unset($_SESSION["usuario"]);
  unset($_SESSION["success"]);
  session_destroy();
  //header("Location: http://upy3.com/");
  header("Location: index.php");
  exit;
?>