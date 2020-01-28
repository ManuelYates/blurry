
<?php
session_start();
include_once '../config.php';
include_once '../html_prepare';
session_destroy();
header("Location: ../index.php")
?>
