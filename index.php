<?php session_start() ?>
<?php include_once 'backend/config.php'; ?>
<?php include_once 'backend/html_prepare.php'; ?>
<?php include_once 'backend/session_check.php'; ?>


<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <?php print $html_head ?>
  </head>
  <body>
<?php print $html_header ?>
<div style="height:600px;">
</div>
<?php print $html_footer ?>
  </body>
</html>
