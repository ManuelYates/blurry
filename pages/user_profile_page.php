<?php session_start() ?>
<?php include_once '../config.php'; ?>
<?php include_once 'html_prepare.php'; ?>
<?php include_once 'session_check.php'; ?>
<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <?php print $html_head ?>
  </head>
  <body>
    <?php print $html_header ?>
<div id="content_profile_page">

  <?php print $username ?>

</div>

    <?php print $html_footer ?>
  </body>
</html>
