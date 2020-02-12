<?php session_start(); 
 require_once '../backend/config.php'; 
 require_once '../backend/html_prepare.php'; 
 require_once '../backend/functions.php';

echo SessionCheck();
$pdo = new PDO('mysql:host=localhost;dbname=blurry', 'root', '');
$statement = 'DROP DATABASE blurry';
$pdo->exec($statement);
echo "Die alte DB wurde gelöscht<br>";

removeDirectory('../images/users');
echo "Das Bilder-Verzeichnis wurde gelöscht";

$statement = 'CREATE DATABASE blurry';
$pdo->exec($statement);
echo "Die neue DB wurde erstellt<br>";

$pdo = null;
$pdo = new PDO('mysql:host=localhost;dbname=blurry', 'root', '');

$statement = "CREATE TABLE users (
id INT NOT NULL AUTO_INCREMENT,
email VARCHAR(255),
passwort varchar(255),
vorname varchar(255),
nachname varchar(255),
created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
updated_at timestamp on update CURRENT_TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
user_role int(1),
profile_img_path varchar(255),
PRIMARY KEY (`id`), UNIQUE (`email`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
$pdo->exec($statement);
echo "Die neue Tabelle users wurde erstellt<br>";

$admin_email = 'admin@blurry.de';
$admin_passwort = 'root';
$admin_vorname = 'Admin';
$admin_nachname = 'Admin';
$admin_user_role = 3;
$passwort_hash = password_hash($admin_passwort, PASSWORD_DEFAULT);
$statement = $pdo->prepare("INSERT INTO users (email, passwort, vorname, nachname, user_role) VALUES (:email, :passwort, :vorname, :nachname, :user_role)");
$result = $statement->execute(array('email' => $admin_email, 'passwort' => $passwort_hash, 'vorname' => $admin_vorname, 'nachname' => $admin_nachname, 'user_role' => $admin_user_role));
echo "Das Administratorkonto wurde erstellt<br>";

mkdir('../images/users', 0777);
echo 'Das benötigte Verzeichnis wurde erstellt.';

$statement = 'CREATE TABLE img_list (
img_id INT NOT NULL AUTO_INCREMENT,
img_path VARCHAR(255),
img_name VARCHAR(255),
img_creator VARCHAR(255),
img_type VARCHAR(255),
uploaded_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`img_id`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;';
$pdo->exec($statement);
echo "Die neue Tabelle img_list wurde erstellt<br>";

$statement = 'CREATE TABLE verslog (
verslog_id INT NOT NULL AUTO_INCREMENT,
verslog_title VARCHAR(255),
verslog_text TEXT(255),
verslog_num INT NOT NULL,
uploaded_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`verslog_id`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;';
$pdo->exec($statement);
$statement = null;
echo "Die neue Tabelle verslog wurde erstellt<br>";

echo "Die benötigten Tabellen wurden erstellt!<br>";
$pdo = null;
echo "Die Verbindung zu DB wurde geschlossen";
session_destroy();
echo "Sie wurden ausgeloggt";
echo "<br> <a href=" . $link_user_img_scrollsearch . ">Hier gelangen Sie zurück zur Hauptseite</a>";
?>
