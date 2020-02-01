
<?php
session_start();
include_once '../backend/config.php';
include_once '../backend/html_prepare.php';
session_destroy();
header("Location: ../index.php")
?>
