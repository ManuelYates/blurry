<?php session_start() ?>
<?php require_once 'backend/config.php'; ?>
<?php require_once 'backend/html_prepare.php';?>
<?php require_once 'backend/functions.php'; ?>

<?php echo SessionCheck();
?>

<!DOCTYPE html>
<html lang="de" dir="ltr">

<head>
  <?php print $html_head ?>
</head>

<body>
  <?php print $html_header ?>
  <div>
    <h1>Willkommen bei Blurry</h1>

  </div>
  
  <?php print $html_footer ?>
</body>

</html>