<?php
function SessionCheck()
{
    if (isset($_SESSION['vorname'])) {
        echo "Session besteht ".$_SESSION['vorname']." ".$_SESSION['nachname']."<br>";
    } else {
        echo 'Sie sind noch nicht eingelogt. <br>Hier geht es zum <a href="'.$link_user_login.'">Login</a><br>';
    }
}

function AdminSessionCheck()
{
    if ($_SESSION['user_role'] != '3') {
        echo "Sie besitzen nicht die benötigten Rechte um auf diese Seite zuzugreifen";
        die();
    }
}

function Verslog_add{
  

}


function ImageUpload()
{

    if ($_POST['img_type'] == 'wallpaper') {
    $upload_folder = '../images/users/user_xxx/user_img/'; //Das Upload-Verzeichnis
    }
    if ($_POST['img_type'] == 'profile_picture') {
    $upload_folder = '../images/users/user_xxx/user_profile_img/'; //Das Upload-Verzeichnis
    }

    $filename = pathinfo($_FILES['datei']['name'], PATHINFO_FILENAME);
    $extension = strtolower(pathinfo($_FILES['datei']['name'], PATHINFO_EXTENSION));


    //Überprüfung der Dateiendung
    $allowed_extensions = array('png', 'jpg', 'jpeg', 'gif');
    if (!in_array($extension, $allowed_extensions)) {
        die("Ungültige Dateiendung. Nur png, jpg, jpeg und gif-Dateien sind erlaubt");
    }

    //Überprüfung der Dateigröße
    $max_size = 2560*1440;
    if ($_FILES['datei']['size'] > $max_size) {
        die("Es werden vorerst nur 2k-Bilder unterstützt");
    }

    //Überprüfung dass das Bild keine Fehler enthält
  if (function_exists('exif_imagetype')) { //Die exif_imagetype-Funktion erfordert die exif-Erweiterung auf dem Server
   $allowed_types = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
      $detected_type = exif_imagetype($_FILES['datei']['tmp_name']);
      if (!in_array($detected_type, $allowed_types)) {
          die("Nur der Upload von Bilddateien ist gestattet");
      }
  }

    //Pfad zum Upload

    $new_path = $upload_folder.$filename.'.'.$extension;

    //Neuer Dateiname falls die Datei bereits existiert
  if (file_exists($new_path)) { //Falls Datei existiert, hänge eine Zahl an den Dateinamen
   $id = 1;
      do {
          $new_path = $upload_folder.$filename.'_'.$id.'.'.$extension;
          $id++;
      } while (file_exists($new_path));
  };

  if ($_POST['img_type'] == 'wallpaper') {
    include_once 'config.php';
    include_once 'html_prepare.php';
    $pdo = new PDO('mysql:host=localhost;dbname=blurry', 'root', '');
    $img_name = $_POST['img_name'];
    $email = $_SESSION['email'];
    $img_type = $_POST['img_type'];
    $sql = "INSERT INTO img_list (img_path , img_name , img_creator, img_type) VALUES ('$new_path', '$img_name' , '$email' , '$img_type' )";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
  }

  if ($_POST['img_type'] == 'profile_picture') {
    include_once 'config.php';
    include_once 'html_prepare.php';
    $pdo = new PDO('mysql:host=localhost;dbname=blurry', 'root', '');
    $email = $_SESSION['email'];
    $img_name ='PB_'.$email;
    $img_type = $_POST['img_type'];
    $sql = "INSERT INTO img_list (img_path , img_name , img_creator, img_type) VALUES ('$new_path', '$img_name' , '$email' , '$img_type' )";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $sql = "UPDATE users SET profile_img_path='$new_path' WHERE email ='$email';";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    session_destroy();
  }
    move_uploaded_file($_FILES['datei']['tmp_name'], $new_path);
    echo 'Bild erfolgreich hochgeladen: <a href="'.$new_path.'">'.$new_path.'</a><br><button type="button" name="button"><a href="../index.php">Zurück zum Menü</a></button>';
}
