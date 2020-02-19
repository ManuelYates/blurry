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
  echo DeleteUser();
}
?>

<body>
<div>
    <table class='user_list'>
      <tr>
        <th>Bild:</th>
        <th>Name:</th>
        <th>Ersteller:</th>
        <th>Upload-Datum:</th>
      </tr>
      <?php echo AdminUserList();?>
    </table>
  </div>

</body>

</html>