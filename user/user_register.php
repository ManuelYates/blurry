<?php session_start(); ?>
<?php require '../backend/config.php'; ?>
<?php require '../backend/html_prepare.php'; ?>
<?php require '../backend/functions.php'; ?>
<!DOCTYPE html>
<html>

<?php

if (isset($_GET['register'])) {
    echo UserRegister();
    $_POST['register'] = 'true';
    header("Location: ../index.php");
}

?>

<head>
    <?php print $html_head ?>
</head>


<body>
    <?php print $html_header ?>

    <div id="form_register">
        <form action="?register=1" method="post">
            <table>
                <tr>
                    <th>Email:</th>
                    <td><input type="email" size="40" maxlength="250" name="email"></td>
                </tr>
                <tr>
                    <th>Passwort:</th>
                    <td><input type="password" size="40" maxlength="250" name="passwort"></td>
                </tr>
                <tr>
                    <th>Passwort wiederholen:</th>
                    <td><input type="password" size="40" maxlength="250" name="passwort2"></td>
                </tr>
                <tr>
                    <th>Vorname:</th>
                    <td><input type="text" size="40" maxlength="250" name="vorname"></td>
                </tr>
                <tr>
                    <th>Nachname:</th>
                    <td><input type="text" size="40" maxlength="250" name="nachname"></td>
                </tr>
            </table>
            <br>
            <input type="submit" value="Abschicken">
        </form>
    </div>

    <div id="idOutput"></div>
    <?php print $html_footer ?>
</body>

</html>