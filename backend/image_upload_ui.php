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
  <?php if(isset($_POST['message'])){
    echo $_POST['message'];
    }?>
  <form action="?imageupload=1" method="post" enctype="multipart/form-data">
    <table class="table_upload">
      <tr>
        <th>Datei</th>
        <th>Creator</th>
        <th>Bild-Name</th>
      </tr>
      <tr class="table_upload_leerzeile"></tr>
      <tr>
        <td><input type="file" name="datei"></td>
        <td><?php print $_SESSION['username'] ?></td>
        <td><input type="text" name="img_name"></td>
      </tr>
      <tr class="table_upload_leerzeile"></tr>
      <tr>
        <td><a href="<?php echo $link_index; ?>"><button>Zurück zur Hauptseite</button></a></td>
        <td class="table_upload_colspan" colspan="2"><input type="submit" value="Hochladen"></td>
      </tr>
    </table></form>

    <form action="?imageupload=1" method="post" enctype="multipart/form-data">
    <table class="table_upload_mobile">
      <tr>
        <th>Datei</th>
        <td><input type="file" name="datei"></td>
      </tr>
      <tr class="table_upload_leerzeile"></tr>
      <tr>
        <th>Creator</th>
        <td><?php print $_SESSION['vorname'] ?></td>
      </tr>
      <tr class="table_upload_leerzeile"></tr>
      <tr>
        <th>Bild-Name</th>
        <td><input type="text" name="img_name"></td>
      </tr>
      <tr class="table_upload_leerzeile"></tr>
      <tr>
        <td><a href="<?php echo $link_index; ?>"><button>Zurück zur Hauptseite</button></a></td>
        <td class="table_upload_colspan"><input type="submit" value="Hochladen"></td>
      </tr>
    </table>
  </form>

  <?php print $html_footer ?>
</body>

</html>