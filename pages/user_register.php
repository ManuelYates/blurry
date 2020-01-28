<?php session_start(); ?>
<?php include_once '../config.php'; ?>
<?php include_once 'html_prepare.php'; ?>


<!DOCTYPE html>
<html>
<head>
<?php print $html_head ?>
</head>
<body>
<?php print $html_header ?>

<div id="form_register">
<?php
$showFormular = true; //Variable ob das Registrierungsformular anezeigt werden soll

if(isset($_GET['register'])) {
    $error = false;
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];
    $_SESSION['email'] = $_POST['email'];
    $user_role = 2;

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
        $error = true;
    }
    if(strlen($passwort) == 0) {
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }
    if($passwort != $passwort2) {
        echo 'Die Passwörter müssen übereinstimmen<br>';
        $error = true;
    }

    //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
    if(!$error) {
        $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $result = $statement->execute(array('email' => $email));
        $user = $statement->fetch();

        if($user !== false) {
            echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
            $error = true;
        }
    }

    //Keine Fehler, wir können den Nutzer registrieren
    if(!$error) {
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);

        $statement = $pdo->prepare("INSERT INTO users (email, passwort, user_role) VALUES (:email, :passwort, :user_role)");
        $result = $statement->execute(array('email' => $email, 'passwort' => $passwort_hash, 'user_role' => $user_role));

        if($result) {
            echo 'Du wurdest erfolgreich registriert. <a href="user_register_stage2.php">Zum Login</a>';
            $_SESSION['register_stage'] = '1';
            $showFormular = false;
        } else {
            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
        }
    }
}

if($showFormular) {
?>
<div id="form_register">
<form action="?register=1" method="post">
<table>
  <tr>
    <th>Email:</th><td><input type="email" size="40" maxlength="250" name="email"></td>
  </tr>
  <tr>
    <th>Passwort:</th><td><input type="password" size="40"  maxlength="250" name="passwort"></td>
  </tr>
  <tr>
    <th>Passwort wiederholen:</th><td><input type="password" size="40" maxlength="250" name="passwort2"></td>
  </tr>
</table>
<br>
<input type="submit" value="Abschicken">
</form>
</div>
<?php
} //Ende von if($showFormular)
?>
</div>
<?php print $html_footer ?>
</body>
</html>
