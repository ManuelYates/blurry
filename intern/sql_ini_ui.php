<!DOCTYPE html>
<?php session_start(); ?>
<?php include_once '../backend/config.php'; ?>
<?php include_once '../backend/html_prepare.php'; ?>
<?php include_once '../backend/session_check.php'; ?>
<?php if ($_SESSION['user_role'] != '3') {
    echo "Sie besitzen nicht die benötigten Rechte um auf diese Seite zuzugreifen";
    die();
} ?>
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
      <input type="submit" value="Hochladen">
  </body>
</html>
