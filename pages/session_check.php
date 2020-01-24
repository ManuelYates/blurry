<?php
session_start();

if(!isset($_SESSION['userid'])) {
  unset($_SESSION['userid']);
  unset($_SESSION['vorname']);
  unset($_SESSION['nachname']);
  die('Bitte zuerst <a href=".php">einloggen</a>');
}else {
  $userid = $_SESSION['userid'];
  $vorname = $_SESSION['vorname'];
  $nachname = $_SESSION['nachname'];
  $username = $vorname." ".$nachname;
}



 ?>
