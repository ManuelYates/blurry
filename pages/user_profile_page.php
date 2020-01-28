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
  <div class="profile_pic">
    <img src="<?php print $_SESSION['profile_img_path'] ?>" alt="">
  </div>

  <table>
    <tr>
      <th>E-Mail:</th><td><?php print $_SESSION['email'] ?></td>
    </tr>
    <tr>
      <th>Vorname:</th><td><?php print $_SESSION['vorname'] ?></td>
    </tr>
    <tr>
      <th>Nachname:</th><td><?php print $_SESSION['nachname'] ?></td>
    </tr>
  </table>

</div>

    <?php print $html_footer ?>
  </body>
</html>
