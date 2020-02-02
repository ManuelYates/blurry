<?php session_start() ?>
<?php include_once '../backend/config.php'; ?>
<?php include_once '../backend/html_prepare.php'; ?>
<?php include_once '../backend/functions.php'; ?>

<?php
    if (isset($_GET['imageupload'])) {
      $_POST['img_type'] = 'profile_picture';
        echo ImageUpload();
    }
 ?>

<!DOCTYPE html>

<html lang="de" dir="ltr">

<head>
<?php print $html_head ?>
</head>

<body>
<?php print $html_header ?>
  <form action="?imageupload=1" method="post" enctype="multipart/form-data">
    <table .class="table_upload">
      <tr>
        <th>Profilbild von <?php print $_SESSION['vorname'] ?></th>
      </tr>
      <tr>
        <td><input type="file" name="datei"></td>
      </tr>
    </table>
    <input type="submit" value="Hochladen">
  </form>
<?php print $html_footer ?>
</body>

</html>
