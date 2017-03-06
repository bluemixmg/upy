<?php
  session_start();
  unset($_SESSION["usuario"]);
  unset($_SESSION["success"]);
  session_destroy();
  header("Location: index.php");
  exit;
?>