<?php include_once 'config-child.php'; ?>
<?php if(!isset($_SESSION['userid'])) {
  $_SESSION['userid'] = "";
  $_SESSION['vorname'] = "";
  $_SESSION['nachname'] ="";
}

?>
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
