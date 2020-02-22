<?php session_start() ?>
<?php require_once '../backend/config.php'; ?>
<?php require_once '../backend/html_prepare.php'; ?>
<?php require '../backend/functions.php'; ?>
<?php echo AdminSessionCheck() ?>

<!DOCTYPE html>
<html lang="de" dir="ltr">

<head>
  <?php print $html_head ?>
</head>

<?php
if (isset($_GET['user_delete'])) {
  $email = $_POST['email'];
 echo $email;
 
  //echo AdminDeleteUser($email);
}
?>

<body>
<div>
    <table class='user_list'>
      <tr>
        <th>Profilbild:</th>
        <th>Name:</th>
        <th>E-Mail:</th>
        <th>Registrierungsdatum:</th>
      </tr>
      <?php echo AdminUserList();?>
    </table>
  </div>

</body>

</html>