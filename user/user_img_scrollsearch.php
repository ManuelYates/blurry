<?php session_start() ?>
<?php include_once '../backend/config.php'; ?>
<?php include_once '../backend/html_prepare.php'; ?>
<?php include_once '../backend/session_check.php'; ?>

<!DOCTYPE html>
<html lang="de" dir="ltr">

<head>
<?php print $html_head ?>
</head>

<body>
<?php print $html_header ?>

<?php if (isset($_SESSION['vorname'])) {
    print "<h1>Willkommen ".$_SESSION['vorname']."</h1>";
} else {
    print "Sie sind nicht eingeloggt. <a href=".$link_user_login.">Login</a>";
}

?>


<div id="content_img">
    <?php

  $conn = mysqli_connect("localhost", "root", "", "blurry");
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $sql = "SELECT * from img_list WHERE img_type = 'wallpaper'";
  $result = $conn-> query($sql);

  if ($result-> num_rows > 0) {
      while ($row = $result-> fetch_assoc()) {
          echo "<div class= img_main><div class='image_inner'><img src=".$row['img_path']."><br>
      <table class='img_info'>
      <tr><th>Name:</th><th>Ersteller:</th><th>Upload-Datum:</th></tr>
      <tr><td>".$row['img_name']."</td><td>".$row['img_creator']."</td><td>".$row['uploaded_at']."</td></tr></table></div>
      <div class='image_outer' style='background-image: url(".$row['img_path'].");background-size: cover;'></div></div>";
      }
  } else {
      echo "<h1>Kein Eintrag gefunden</h1>";
  }

  $conn-> close();
   ?>

<?php print $html_footer ?>
</body>

</html>
