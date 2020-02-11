<?php session_start() ?>
<?php include_once '../backend/config.php'; ?>
<?php include_once '../backend/html_prepare.php'; ?>
<?php include_once '../backend/functions.php'; ?>
<?php echo AdminSessionCheck() ?>

<?php
    if (isset($_GET['imageupload'])) {
      $_POST['img_type'] = 'wallpaper';
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
    <div class="verslog_added">
      <form action="?imageupload=1" method="post" enctype="multipart/form-data">
        <table class="table_upload">
          <tr>
            <th>Datei</th>
            <th>Creator</th>
            <th>Bild-Name</th>
          </tr>
          <tr>
            <td><input type="file" name="datei"></td>
            <td></td>
            <td><input type="text" name="img_name"></td>
          </tr>
          <br>
        </table>
        <input type="submit" value="Hochladen">
      </form>
    </div>
    <?php print $html_footer ?>
  </body>
</html>
