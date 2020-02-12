<!DOCTYPE html>
<?php session_start(); ?>
<?php  require_once '../backend/config.php'; ?>
<?php  require_once '../backend/html_prepare.php'; ?>
<?php  require_once '../backend/session_check.php'; ?>
<?php
if (isset($_SESSION['user_role'])) {
  if ($_SESSION['user_role'] != '3') {
      echo "Sie besitzen nicht die benötigten Rechte um auf diese Seite zuzugreifen";
      die();
    }
}else {
  echo "Sie haben keine Zugriffrechte";
  die();
}

 ?>


<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form action="sql_ini.php" method="post" enctype="multipart/form-data">
      <table .class="table_upload">
        <tr>
          <th>Sind Sie sicher, dass Sie die Tabellen initalisieren möchten?</th>
        </tr>
        <tr>
          <td>Stellen Sie sicher, dass MySQL und Apache im Hintergrund aktiv sind und Sie die richtigen Benutzerdaten eingegeben haben!</td>
        </tr>
        <br>
      </table>
      <input type="submit" value="DB RESET">
  </body>
</html>
