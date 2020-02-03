<?php

if (isset($_SESSION['vorname'])) {
    echo "Session besteht ".$_SESSION['vorname']." ".$_SESSION['nachname']."<br>";
} else {
    echo 'Sie sind noch nicht eingelogt. <br>Hier geht es zum <a href="'.$link_user_login.'">Login</a><br>';
}
  ?>
