<?php include_once 'config.php'; ?>

<!DOCTYPE html>
<html lang="de" dir="ltr">

<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="master-css.css">
  <?php echo $font_import; ?>
</head>

<body>
<div id="header">
<div id="logo">
  <img src="Blurry.png" alt="">
</div>
<hr>
<div id="navi">
  <ul>
    <li><a href="index2.php">!Testgelände!</a></li>
    <li><a href="addpic.php">Upload</a></li>
    <li><a href="user_register.php">Registrierung</a></li>
    <li><a href="user_login.php">Login</a></li>
    <li><a href="user_profile.php">Mein Profil</a></li>
  </ul>
</div>
</div>

<div id="content_img">
    <?php
  $conn = mysqli_connect("localhost", "root", "", "blurry");
  if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
  }
  $sql = "SELECT * from img_list";
  $result = $conn-> query($sql);

  if($result-> num_rows > 0){



    while ($row = $result-> fetch_assoc()){
      echo "<div class='image_main'><img src=".$row['img_path']."><br>
      <table class='img_info'>
      <tr><th>Name:</th><th>Ersteller:</th><th>Upload-Datum:</th></tr>
      <tr><td>".$row['img_name']."</td><td>".$row['img_creator']."</td><td>".$row['img_uploaddate']."</td></tr></table></div>";
    }
  }else {
    echo "<h1>Kein Eintrag</h1>";
  }

  $conn-> close();
   ?>

</div>
  <div id="footer">
    <table class="footer_menu_button" ><tr>
      <th><button type="button" name="button">Taste</button></th>
      <th><button type="button" name="button">Taste</button></th>
      <th><button type="button" name="button"><a href="user_profile.php">Mein Profil</a></button></th>
    </tr></table>

  </div>

</body>

</html>
