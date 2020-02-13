<?php session_start(); ?>
<?php include_once '../backend/config.php'; ?>
<?php include_once '../backend/html_prepare.php'; ?>

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

if (isset($_GET['registerext'])) {
    $error = false;
    $email = $_SESSION['email'];
    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];

    $sql = "UPDATE users SET vorname='$vorname', nachname='$nachname' WHERE email ='$email'";

    $stmt = $pdo->prepare($sql);

    $stmt->execute();

    echo $stmt->rowCount() . " Datensätze wurden geupdated<br>";

    if ($stmt->rowCount() > 0) {
        echo '<a href="user_register_stage3.php">Stufe 3</a>';
        
        header("Location: user_register_stage3.php");
    } else {
        echo "Fehler";
    }
}

    ?>
<div id="form_register">
<form action="?registerext=1" method="post">
<table>

</table>
<br>
<input type="submit" value="Abschicken">
</form>
</div>

</div>
<?php print $html_footer ?>
</body>
</html>
