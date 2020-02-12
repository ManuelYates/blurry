<?php
function SessionCheck()
{
    if (isset($_SESSION['vorname'])) {
        echo "Session besteht " . $_SESSION['vorname'] . " " . $_SESSION['nachname'] . "<br>";
    } else {
        echo 'Sie sind noch nicht eingelogt. <br>Hier geht es zum <a href="../user/user_login.php">Login</a><br>';
    }
}

function AdminSessionCheck()
{
    if ($_SESSION['user_role'] != '3') {
        echo "Sie besitzen nicht die benötigten Rechte um auf diese Seite zuzugreifen";
        die();
    }
}

function Verslog_add()
{
    require 'config.php';
    $verslog_title = $_POST['verslog_title'];
    $verslog_num = $_POST['verslog_num'];
    $verslog_text = $_POST['verslog_text'];
    $sql = "INSERT INTO verslog (verslog_title , verslog_num , verslog_text) VALUES ('$verslog_title', '$verslog_num' , '$verslog_text')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
}


function ImageUpload()
{

    if ($_POST['img_type'] == 'wallpaper') {
        $upload_folder = '../images/users/'.$_SESSION['email'].'/user_img/'; //Das Upload-Verzeichnis
    }
    if ($_POST['img_type'] == 'profile_picture') {
        $upload_folder = '../images/users/'.$_SESSION['email'].'/user_profile_img/'; //Das Upload-Verzeichnis
    }

    $filename = pathinfo($_FILES['datei']['name'], PATHINFO_FILENAME);
    $extension = strtolower(pathinfo($_FILES['datei']['name'], PATHINFO_EXTENSION));


    //Überprüfung der Dateiendung
    $allowed_extensions = array('png', 'jpg', 'jpeg', 'gif');
    if (!in_array($extension, $allowed_extensions)) {
        die("Ungültige Dateiendung. Nur png, jpg, jpeg und gif-Dateien sind erlaubt");
    }

    //Überprüfung der Dateigröße
    $max_size = 2560 * 1440;
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

    $new_path = $upload_folder . $filename . '.' . $extension;

    //Neuer Dateiname falls die Datei bereits existiert
    if (file_exists($new_path)) { //Falls Datei existiert, hänge eine Zahl an den Dateinamen
        $id = 1;
        do {
            $new_path = $upload_folder . $filename . '_' . $id . '.' . $extension;
            $id++;
        } while (file_exists($new_path));
    };

    if ($_POST['img_type'] == 'wallpaper') {
        require 'config.php';
        require 'html_prepare.php';

        $img_name = $_POST['img_name'];
        $email = $_SESSION['email'];
        $img_type = $_POST['img_type'];
        $sql = "INSERT INTO img_list (img_path , img_name , img_creator, img_type) VALUES ('$new_path', '$img_name' , '$email' , '$img_type' )";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $pdo = null;
    }

    if ($_POST['img_type'] == 'profile_picture') {
        require 'config.php';
        require 'html_prepare.php';

        $email = $_SESSION['email'];
        $img_name = 'PB_' . $email;
        $img_type = $_POST['img_type'];
        $sql = "INSERT INTO img_list (img_path , img_name , img_creator, img_type) VALUES ('$new_path', '$img_name' , '$email' , '$img_type' )";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $sql = "UPDATE users SET profile_img_path='$new_path' WHERE email ='$email';";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $pdo = null;
        session_destroy();
    }

    move_uploaded_file($_FILES['datei']['tmp_name'], $new_path);
    echo 'Bild erfolgreich hochgeladen: <a href="' . $new_path . '">' . $new_path . '</a><br><button type="button" name="button"><a href="../index.php">Zurück zum Menü</a></button>';
}

function ImageScroll()
{

    $conn = mysqli_connect("localhost", "root", "", "blurry");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * from img_list WHERE img_type = 'wallpaper'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class= img_main><div class='image_inner'><img src=" . $row['img_path'] . "><br>
      <table class='img_info'>
      <tr><th>Name:</th><th>Ersteller:</th><th>Upload-Datum:</th></tr>
      <tr><td>" . $row['img_name'] . "</td><td>" . $row['img_creator'] . "</td><td>" . $row['uploaded_at'] . "</td></tr></table></div>
      <div class='image_outer' style='background-image: url(" . $row['img_path'] . ");background-size: cover;'></div></div>";
        }
    } else {
        echo "<h1>Kein Eintrag gefunden</h1>";
    }

    $conn->close();
}

function removeDirectory($path)
{
    $files = glob($path . '/*');
    foreach ($files as $file) {
        is_dir($file) ? removeDirectory($file) : unlink($file);
    }
    rmdir($path);
    return;
}

function removeImage(){

}

function removeProfile($path){
    $files = glob($path . '/*');
    foreach ($files as $file) {
        is_dir($file) ? removeDirectory($file) : unlink($file);
    }
    rmdir($path);
    return; 
}