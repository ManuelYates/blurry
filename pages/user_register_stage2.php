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

if(isset($_GET['registerstwo'])) {
    $error = false;
    $email = $_SESSION['email'];
    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];
/*
    $statement = $pdo->prepare("UPDATE users (vorname, nachname) SET (:vorname, :nachname) WHERE email = :email");
    $result = $statement->execute(array('vorname' => $vorname, 'nachname' => $nachname));
  */

    $sql = "UPDATE users SET vorname='$vorname', nachname='$nachname' WHERE email ='$email'";

    // Prepare statement
    $stmt = $pdo->prepare($sql);

    // execute the query
    $stmt->execute();

    // echo a message to say the UPDATE succeeded
    echo $stmt->rowCount() . " records UPDATED successfully";

    if ($stmt->rowCount() > 0) {
      echo 'Du wurdest erfolgreich registriert. <a href="user_register_stage2.php">Zum Login</a>';
      $_SESSION['register_stage'] = '2';
      $showFormular = false;
      session_destroy();
    }else {
      echo "Fehler";
    }


}

if($showFormular) {
?>
<div id="form_register">
<form action="?registerstwo=1" method="post">
<table>
  <tr>
    <th>Email:</th><td><?php echo $_SESSION['email']; ?></td>
  </tr>
  <tr>
    <th>Vorname:</th><td><input type="text" size="40" maxlength="250" name="vorname"></td>
  </tr>
  <tr>
    <th>Nachname:</th><td><input type="text" size="40" maxlength="250" name="nachname"></td>
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
