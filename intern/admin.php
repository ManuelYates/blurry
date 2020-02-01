<?php session_start() ?>
<?php include_once '../config.php'; ?>
<?php include_once '../pages/html_prepare.php'; ?>
<?php include_once '../pages/session_check.php'; ?>
<?php if ($_SESSION['user_role'] != '3') {
  echo "Sie besitzen nicht die benötigten Rechte um auf diese Seite zuzugreifen";
  die();
} ?>


<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
  <?php print $html_head ?>
  </head>
  <body>
    <?php print $html_header ?>
    <h1>Willkommen <?php print $_SESSION['vorname'] ?></h1>
    <div id="content_user_index">

    </div>
    <?php print $html_footer ?>
  </body>
</html>
