<?php

//Überprüft explizit ob ein User mit der Role "3" angemeldet ist umd ihm den Admin-Bereich freizuschalten
function AdminSessionCheck()
{
    if ($_SESSION['user_role'] != '3') {
        echo "Sie besitzen nicht die benötigten Rechte um auf diese Seite zuzugreifen";
        die();
    }
}

function AdminDeleteUser($email)
{
    require 'config.php';
    $files = glob($path . '/*');
    foreach ($files as $file) {
        is_dir($file) ? removeDirectory($file) : unlink($file);
    }
    rmdir($path);
    $sql = "DELETE FROM users WHERE email = '$email'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $sql = "DELETE FROM img_list WHERE img_creator = '$email'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    session_destroy();
    header("Location: ../index.php");
}

function AdminUserList()
{
    $conn = mysqli_connect("localhost", "root", "", "blurry");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $email = $_SESSION['email'];
    $sql = "SELECT * from users WHERE user_role = 2";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<form action="?user_delete=1" method="post"><tr><td><img name="img_path" src=' . $row["profile_img_path"] . '></td><td>' . $row["vorname"] . ' ' . $row["nachname"] . '</td><td name="email"><input readonly name="email" value="' . $row["email"] . '"></td><td>' . $row['created_at'] . '</td><td><input type="submit"  value="User Löschen"/></td></tr></form>';
        }
    } else {
        echo "<h1>Kein Eintrag gefunden</h1>";
    }

    $conn->close();
}



function AdminImageScroll()
{
    $conn = mysqli_connect("localhost", "root", "", "blurry");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $email = $_SESSION['email'];
    $sql = "SELECT * from img_list WHERE img_type = 'wallpaper'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<form action="?image_delete=1" method="post"><tr><td><img name="img_path" src=' . $row["img_path"] . '></td><td><input name="img_path" value="' . $row["img_path"] . '"></td><td>' . $row["img_name"] . '</td><td>' . $row["img_creator"] . '</td><td>' . $row['uploaded_at'] . '</td><td><input name="img_id" value="' . $row['img_id'] . '"></td><td><input type="submit" name="image_delete(' . $row['img_id'] . ')" value="Bild Löschen"/></td></tr></form>';
        }
    } else {
        echo "<h1>Kein Eintrag gefunden</h1>";
    }

    $conn->close();
}

function UserGenerator()
{
    require 'config.php';
    require 'html_prepare.php';
    $index = 1;
    while ($index <= 10) {
        $username = "Benutzer" . $index;
        $email = "test" . $index . "@blurry.de";
        $vorname = "Hans Günther";
        $nachname = "Herbert";
        $passwort = "admin";
        $user_role = '2';
        $profile_img_path = '../images/blurry/stock_userimage.jpg';
        $index++;
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
        $statement = $pdo->prepare("INSERT INTO users (email, passwort, vorname, nachname, user_role, profile_img_path) VALUES (:email, :passwort, :vorname, :nachname,:user_role, :profile_img_path)");
        $result = $statement->execute(array('email' => $email, 'passwort' => $passwort_hash, 'vorname' => $vorname, 'nachname' => $nachname, 'user_role' => $user_role, 'profile_img_path' => $profile_img_path));
    }
    $pdo = null;
}

function ImageGenerator()
{
    require 'config.php';
    require 'html_prepare.php';
    $index = 1;
    $img_name = 'Stock-Img';
    $img_type = 'wallpaper';
    $img_creator = 'Blurry';
    while ($index <= 10) {
        $img_path = '../images/blurry/stock/'.$index.'.jpg';
        $index++;
        $statement = $pdo->prepare("INSERT INTO img_list (img_path, img_name, img_creator, img_type) VALUES (:img_path, :img_name, :img_creator, :img_type)");
        $result = $statement->execute(array('img_path' => $img_path, 'img_name' => $img_name, 'img_creator' => $img_creator, 'img_type' => $img_type));
    }
    $pdo = null;
}


//Überprüft ob eine Session besteht, um zu entscheiden, welche Inhalte angezeigt werden.
function SessionCheck()
{
    require 'html_prepare.php';
    $url = (empty($_SERVER['HTTPS'])) ? 'http' : 'https';
    $url .= $_SERVER['HTTP_HOST'];
    $url .= $_SERVER['REQUEST_URI'];
    if ($url == 'httplocalhost/blurry/user/user_profile_page.php') {
        if (isset($_SESSION['vorname'])) {
        } else {
            echo '<div id="UserInfoHeader">Sie sind noch nicht eingelogt. <br>Hier geht es zum <a href="' . $link_user_login . '">Login</a></div>';
        }
    } else {
        if (isset($_SESSION['vorname'])) {
            echo '<div id="UserInfoHeader">
            <img src=' . $_SESSION["profile_img_path"] . '> 
            <div id="UserInfoHeader_Text"><h4>' . $_SESSION['vorname'] . ' ' . $_SESSION['nachname'] . '</h4>
            <ul>
            <li><a href="' . $link_user_profile_page . '">Mein Profil</a></li>
            <li><a href="' . $link_user_logout . '">Logout</a></li>
            </ul>
            </div></div>';
        } else {
            echo '<div id="UserInfoHeader">Sie sind noch nicht eingelogt.
            Hier geht es zum <a href="' . $link_user_login . '">Login</a></div>';
        }
    }
}

//Lädt sämtliche Bilder in die dafür vorgesehenen Verzeichnisse und trägt sie in die Datenbank ein
function ImageUpload()
{

    if ($_POST['img_type'] == 'wallpaper') {
        $upload_folder = '../images/users/' . $_SESSION['email'] . '/user_img/'; //Das Upload-Verzeichnis
    }
    if ($_POST['img_type'] == 'profile_picture') {
        $upload_folder = '../images/users/' . $_SESSION['email'] . '/user_profile_img/'; //Das Upload-Verzeichnis
    }

    $filename = pathinfo($_FILES['datei']['name'], PATHINFO_FILENAME);
    $extension = strtolower(pathinfo($_FILES['datei']['name'], PATHINFO_EXTENSION));


    //Überprüfung der Dateiendung
    $allowed_extensions = array('png', 'jpg', 'jpeg', 'gif');
    if (!in_array($extension, $allowed_extensions)) {
        return ("Ungültige Dateiendung. Nur png, jpg, jpeg und gif-Dateien sind erlaubt");
    }

    //Überprüfung der Dateigröße
    $max_size = 2560 * 1440;
    if ($_FILES['datei']['size'] > $max_size) {
        return ("Es werden vorerst nur 2k-Bilder unterstützt");
    }

    //Überprüfung dass das Bild keine Fehler enthält
    if (function_exists('exif_imagetype')) { //Die exif_imagetype-Funktion erfordert die exif-Erweiterung auf dem Server
        $allowed_types = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
        $detected_type = exif_imagetype($_FILES['datei']['tmp_name']);
        if (!in_array($detected_type, $allowed_types)) {
            return ("Nur der Upload von Bilddateien ist gestattet");
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
        echo 'Bild erfolgreich hochgeladen: <a href="' . $new_path . '">' . $new_path . '</a><br><button type="button" name="button"><a href="' . $link_user_img_scrollsearch . '">Zurück zum Menü</a></button>';
        move_uploaded_file($_FILES['datei']['tmp_name'], $new_path);
    }

    if ($_POST['img_type'] == 'profile_picture') {
        require 'config.php';
        require 'html_prepare.php';

        $email = $_SESSION['email'];
        $img_name = $email;
        $img_type = $_POST['img_type'];
        $sql = "INSERT INTO img_list (img_path , img_name , img_creator, img_type) VALUES ('$new_path', '$img_name' , '$email' , '$img_type' )";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $sql = "UPDATE users SET profile_img_path='$new_path' WHERE email ='$email';";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $pdo = null;
        move_uploaded_file($_FILES['datei']['tmp_name'], $new_path);
        $_SESSION['profile_img_path'] = $new_path;
        sleep(1);
        header("Location: '.$link_user_img_scrollsearch.'");
    }
}

//Zeigt alle Bilder in der Tabelle "img_list" an, welche das Attribut "wallpaper" haben
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



//Zeigt nur die Bilder, welcher der angemeldete User hochgeladen hat
function UserImageScroll()
{
    $conn = mysqli_connect("localhost", "root", "", "blurry");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $email = $_SESSION['email'];
    $sql = "SELECT * from img_list WHERE img_creator = '$email' AND img_type = 'wallpaper'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<form action="?image_delete=1" method="post"><tr><td><img name="img_path" src=' . $row["img_path"] . '></td><td><input name="img_path" value="' . $row["img_path"] . '"></td><td>' . $row["img_name"] . '</td><td>' . $row["img_creator"] . '</td><td>' . $row['uploaded_at'] . '</td><td><input name="img_id" value="' . $row['img_id'] . '"></td><td><input type="submit" name="image_delete(' . $row['img_id'] . ')" value="Bild Löschen"/></td></tr></form>';
        }
    } else {
        echo "<h1>Kein Eintrag gefunden</h1>";
    }

    $conn->close();
}



//Eine rekursive Funktion, welche es ermöglicht von überall die Dateien und das entsprechende Verzeichnis zu löschen
function removeDirectory($path)
{
    $files = glob($path . '/*');
    foreach ($files as $file) {
        is_dir($file) ? removeDirectory($file) : unlink($file);
    }
    rmdir($path);
    return;
}



//Eine Funktion, welche das Löschen einzelner Bilder ermöglicht
function removeImage()
{
    require 'config.php';
    require 'html_prepare.php';
    $img_path = $_POST['img_path'];
    $img_id = $_POST['img_id'];
    $email = $_SESSION['email'];
    $sql = "DELETE FROM img_list WHERE img_id = '$img_id'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $pdo = null;
    unlink($img_path);
}



//Eine Funktion, welche alle Bilder eines Nutzers löscht, ihn aus der DB löscht und anschließend seine Session zerstört
function removeProfile($path)
{
    require 'config.php';
    $files = glob($path . '/*');
    foreach ($files as $file) {
        is_dir($file) ? removeDirectory($file) : unlink($file);
    }
    rmdir($path);
    $email = $_SESSION['email'];
    $sql = "DELETE FROM users WHERE email = '$email'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $sql = "DELETE FROM img_list WHERE img_creator = '$email'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    session_destroy();
    header("Location: ../index.php");
}



//Registrierung
function UserRegister()
{
    require 'config.php';
    $error = false;
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];
    $vorname = $_POST['vorname'];
    $nachname = $_POST['nachname'];
    $_SESSION['email'] = $_POST['email'];
    $user_role = 2;
    $user_stock_img = '../images/blurry/stock_userimage.jpg';

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
        $error = true;
    }
    if (strlen($passwort) == 0) {
        echo 'Bitte ein Passwort angeben<br>';
        $error = true;
    }
    if ($passwort != $passwort2) {
        echo 'Die Passwörter müssen übereinstimmen<br>';
        $error = true;
    }

    //Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
    if (!$error) {
        $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $result = $statement->execute(array('email' => $email));
        $user = $statement->fetch();

        if ($user !== false) {
            echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
            $error = true;
        }
    }

    //Keine Fehler, wir können den Nutzer registrieren
    if (!$error) {
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);

        $statement = $pdo->prepare("INSERT INTO users (email, passwort, vorname, nachname, user_role, profile_img_path) VALUES (:email, :passwort, :vorname, :nachname,:user_role, :profile_img_path)");
        $result = $statement->execute(array('email' => $email, 'passwort' => $passwort_hash, 'vorname' => $vorname, 'nachname' => $nachname, 'user_role' => $user_role, 'profile_img_path' => $user_stock_img));

        if ($result) {
            mkdir('../images/users/' . $email);
            mkdir('../images/users/' . $email . '/user_img');
            mkdir('../images/users/' . $email . '/user_profile_img');
        } else {
            echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
        }
    }
}
