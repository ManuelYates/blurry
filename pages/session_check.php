<?php

if (isset($_SESSION['vorname'])) {
   echo "<br>Session besteht ".$_SESSION['vorname']." ".$_SESSION['nachname'];
} else {
   echo '<br>Sie sind noch nicht eingelogt. Hier geht es zum <a href="'.$link_user_login.'">Login</a>';
}
?>
