<?php
include_once '../config.php';
$upload_folder = '../images/uploaded/'; //Das Upload-Verzeichnis
$filename = pathinfo($_FILES['datei']['name'], PATHINFO_FILENAME);
$extension = strtolower(pathinfo($_FILES['datei']['name'], PATHINFO_EXTENSION));


//Überprüfung der Dateiendung
$allowed_extensions = array('png', 'jpg', 'jpeg', 'gif');
if(!in_array($extension, $allowed_extensions)) {
 die("Ungültige Dateiendung. Nur png, jpg, jpeg und gif-Dateien sind erlaubt");
}

//Überprüfung der Dateigröße
$max_size = 2560*1440;
if($_FILES['datei']['size'] > $max_size) {
 die("Es werden vorerst nur 2k-Bilder unterstützt");
}

//Überprüfung dass das Bild keine Fehler enthält
if(function_exists('exif_imagetype')) { //Die exif_imagetype-Funktion erfordert die exif-Erweiterung auf dem Server
 $allowed_types = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
 $detected_type = exif_imagetype($_FILES['datei']['tmp_name']);
 if(!in_array($detected_type, $allowed_types)) {
 die("Nur der Upload von Bilddateien ist gestattet");
 }
}

//Pfad zum Upload
$new_path = $upload_folder.$filename.'.'.$extension;

//Neuer Dateiname falls die Datei bereits existiert
if(file_exists($new_path)) { //Falls Datei existiert, hänge eine Zahl an den Dateinamen
 $id = 1;
 do {
 $new_path = $upload_folder.$filename.'_'.$id.'.'.$extension;
 $id++;
 } while(file_exists($new_path));
}

if(!isset($_SESSION['userid'])) {
    die('Bitte zuerst <a href="login.php">einloggen</a>');
}
$userid = $_SESSION['userid'];
$vorname = $_SESSION['vorname'];
$nachname = $_SESSION['nachname'];
$username = $vorname." ".$nachname;
$servername = "localhost";
$serverusername = "root";
$password = "";
$dbname = "blurry";
$creator = $username;
$img_name = $_POST['img_name'];

$conn = new mysqli($servername, $serverusername, $password, $dbname);
// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO img_list (img_path , img_name , img_creator)
VALUES ('$new_path', '$img_name' , '$creator' )";

if ($conn->query($sql) === TRUE) {
   echo "Das Bild <i>".$img_name."</i> von <b>".$creator."</b> wurde erfolgreich in die Datenbank eingetragen<br>";
} else {
  die("Es ist ein Fehler aufgetreten: " . $sql . "<br>" . $conn->error);
}


move_uploaded_file($_FILES['datei']['tmp_name'], $new_path);
echo 'Bild erfolgreich hochgeladen: <a href="'.$new_path.'">'.$new_path.'</a><br><button type="button" name="button"><a href="'.$link_user_main.'">Zurück zum Menü</a></button>';

$conn->close();
?>