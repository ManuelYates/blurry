<?php include_once '../config.php'; ?>
<?php
$pdo = new PDO('mysql:host=localhost;dbname=blurry', 'root', '');

if(isset($_GET['login'])) {
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];

    $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    $result = $statement->execute(array('email' => $email));
    $user = $statement->fetch();

    //Überprüfung des Passworts
    if ($user !== false && password_verify($passwort, $user['passwort'])) {
        $_SESSION['userid'] = $user['id'];
        $_SESSION['vorname'] = $user['vorname'];
        $_SESSION['nachname'] = $user['nachname'];
      die(header('location:'.$link_user_index));
    } else {
        $errorMessage = "E-Mail oder Passwort war ungültig<br>";
    }

} ?>
<!DOCTYPE html>
<html lang="de" dir="ltr">

<head>
  <?php print $html_head ?>
</head>

<body>
  <?php print $html_header ?>
  <div id="form_login">
    <?php
      if(isset($errorMessage)) {
          echo $errorMessage;
      }
      ?>
    <form action="?login=1" method="post">
      <table>
        <tr>
          <th>Email:</th>
          <td><input type="email" size="40" maxlength="250" name="email"></td>
        </tr>
        <tr>
          <th>Passwort:</th>
          <td><input type="password" size="40" maxlength="250" name="passwort"></td>
        </tr>
      </table>
      <br>
      <input type="submit" value="Abschicken">
    </form>

  </div>
  <?php print $html_footer ?>
</body>

</html>
