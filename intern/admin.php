<?php session_start() ?>
<?php include_once '../backend/config.php'; ?>
<?php include_once '../backend/html_prepare.php'; ?>
<?php include_once '../backend/functions.php'; ?>
<?php echo AdminSessionCheck() ?>


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
