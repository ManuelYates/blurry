<?php require_once '../config.php'; ?>
<?php  if(!isset($_SESSION['userid'])) {
  die('Bitte zuerst <a href="'.$link_user_login.'">einloggen</a>');

}?>

<!DOCTYPE html>
<html lang="de" dir="ltr">

<head>
<?php print $html_head ?>
</head>

<body>
<?php print $html_header ?>
<h1>Willkommen <?php print $username ?></h1>
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
    echo "<h1>Kein Eintrag gefunden</h1>";
  }

  $conn-> close();
   ?>


<?php print $html_footer ?>
</body>

</html>
