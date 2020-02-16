<?php session_start() ?>
<?php require '../backend/config.php'; ?>
<?php require '../backend/html_prepare.php'; ?>
<?php require '../backend/functions.php'; ?>
<!DOCTYPE html>
<?php echo SessionCheck(); ?>
<html lang="de" dir="ltr">

<?php
if (isset($_GET['profile_remove'])) {
  echo removeProfile('../images/users/' . $_SESSION['email']);
}
?>

<?php
if (isset($_GET['image_delete($img_id)'])) {
  echo removeImage('../images/users/' . $_SESSION['email']);
}
?>

<head>
  <?php print $html_head ?>
</head>

<body>
  <?php print $html_header ?>
  
  <div id="content_profile_page">
    <div class="profile_pic">
      <img src="<?php print $_SESSION['profile_img_path'] ?>" alt="">
      <a href="<?php print $link_user_profile_pic_edit?>"><button>Profilbild ändern</button></a>
    </div>
      
    <table>
      <tr>
        <th>E-Mail:</th>
        <td><?php print $_SESSION['email'] ?></td>
      </tr>
      <tr>
        <th>Vorname:</th>
        <td><?php print $_SESSION['vorname'] ?></td>
      </tr>
      <tr>
        <th>Nachname:</th>
        <td><?php print $_SESSION['nachname'] ?></td>
      </tr>
    </table>
  </div>
  <div>
    <table class='img_list'>
      <tr>
        <th>Bild:</th>
        <th>Name:</th>
        <th>Ersteller:</th>
        <th>Upload-Datum:</th>
      </tr>
      <?php echo UserImageScroll() ?>
    </table>
  </div>

  <form action="?profile_remove=1" method="post" enctype="multipart/form-data">
    <button type="submit">Profile Löschen</button>
  </form>


  <?php print $html_footer ?>
</body>

</html>