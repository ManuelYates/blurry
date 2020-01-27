<?php
session_start();


if (isset($_SESSION['username'])) {
   echo "Session besteht ".$_SESSION['username'];
} else {
   echo '<br>Sie sind noch nicht eingelogt. Hier geht es zum <a href="'.$link_user_login.'">Login</a>';
}
?>
