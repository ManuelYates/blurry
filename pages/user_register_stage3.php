<?php session_start() ?>
<?php include_once '../config.php'; ?>
<?php include_once 'html_prepare.php'; ?>

<!DOCTYPE html>

<html lang="de" dir="ltr">

<head>
<?php print $html_head ?>
</head>

<body>
<?php print $html_header ?>
  <form action="user_image_upload.php" method="post" enctype="multipart/form-data">
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
