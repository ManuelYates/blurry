
<?php
require_once '../config.php';
unset($_SESSION['userid']);
unset($_SESSION['vorname']);
unset($_SESSION['nachname']);

session_destroy();
header('location: '.$link_index);
?>
