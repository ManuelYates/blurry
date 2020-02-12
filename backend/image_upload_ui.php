<?php session_start() ?>
<?php require_once '../backend/config.php'; ?>
<?php require_once '../backend/html_prepare.php'; ?>
<?php require_once '../backend/functions.php'; ?>
<?php echo SessionCheck(); ?>

<?php
if (isset($_GET['imageupload'])) {
  $_POST['img_type'] = 'wallpaper';
  echo ImageUpload();
}
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <?php print $html_head ?>
</head>

<body>
  <?php print $html_header ?>
  <form action="?imageupload=1" method="post" enctype="multipart/form-data">
    <table class="table_upload">
      <tr>
        <th>Datei</th>
        <th>Creator</th>
        <th>Bild-Name</th>
      </tr>
      <tr>
        <td><input type="file" name="datei"></td>
        <td><?php print $_SESSION['vorname'] ?></td>
        <td><input type="text" name="img_name"></td>
      </tr>
      <br>
    </table>
    <input type="submit" value="Hochladen">
  </form>
  <a href="<?php echo $link_index; ?>">Zurück zur Hauptseite</a>
  <?php print $html_footer ?>
</body>

</html>