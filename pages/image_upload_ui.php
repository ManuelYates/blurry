<?php include_once '../config.php'; ?>

<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Bilder hinzufügen</title>
  <link rel="stylesheet" href="master-css.css">
</head>

<body>

  <form action="image_upload.php" method="post" enctype="multipart/form-data">
    <table .class="table_upload">
      <tr>
        <th>Datei</th>
        <th>Creator</th>
        <th>Bild-Name</th>
      </tr>
      <tr>
        <td><input type="file" name="datei"></td>
        <td><?php print $username ?></td>
        <td><input type="text" name="img_name"></td>
      </tr>
      <br>
    </table>
    <input type="submit" value="Hochladen">
  </form>

</body>

</html>