<?php
    $pdo = new PDO('mysql:host=localhost;dbname=test', 'root', '');
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
        username varchar(255),
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
    $admin_username = 'BigBoss';
    $admin_user_role = 3;
    $passwort_hash = password_hash($admin_passwort, PASSWORD_DEFAULT);
    $statement = $pdo->prepare("INSERT INTO users (email, passwort, vorname, nachname, username, user_role) VALUES (:email, :passwort, :vorname, :nachname, :username, :user_role)");
    $result = $statement->execute(array('email' => $admin_email, 'passwort' => $passwort_hash, 'vorname' => $admin_vorname, 'nachname' => $admin_nachname, 'username' => $admin_username, 'user_role' => $admin_user_role));
    echo "Das Administratorkonto " . $admin_email . " wurde erstellt<br>";

    $admin_email = 'manuel_yates@icloud.com';
    $admin_passwort = 'natascha';
    $admin_vorname = 'Manuel';
    $admin_nachname = 'Yates';
    $admin_username = 'BigDaddy';
    $admin_user_role = 3;
    $admin_profile_img = '../images/blurry/MYPB.png';
    $passwort_hash = password_hash($admin_passwort, PASSWORD_DEFAULT);
    $statement = $pdo->prepare("INSERT INTO users (email, passwort, vorname, nachname, username, user_role) VALUES (:email, :passwort, :vorname, :nachname, :username, :user_role)");
    $result = $statement->execute(array('email' => $admin_email, 'passwort' => $passwort_hash, 'vorname' => $admin_vorname, 'nachname' => $admin_nachname, 'username' => $admin_username, 'user_role' => $admin_user_role));
    echo "Das Administratorkonto " . $admin_email . " wurde erstellt<br>";

    $admin_email = 'senska4@gmail.com';
    $admin_passwort = 'vanessa';
    $admin_vorname = 'Dominik';
    $admin_nachname = 'Senska';
    $admin_username = 'Lappen';
    $admin_user_role = 3;
    $admin_profile_img = '../images/blurry/AevaPB.png';
    $passwort_hash = password_hash($admin_passwort, PASSWORD_DEFAULT);
    $statement = $pdo->prepare("INSERT INTO users (email, passwort, vorname, nachname, username, user_role) VALUES (:email, :passwort, :vorname, :nachname, :username, :user_role)");
    $result = $statement->execute(array('email' => $admin_email, 'passwort' => $passwort_hash, 'vorname' => $admin_vorname, 'nachname' => $admin_nachname, 'username' => $admin_username, 'user_role' => $admin_user_role));
    echo "Das Administratorkonto " . $admin_email . " wurde erstellt<br>";

    mkdir('images/users', 0777);
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

    echo "Die benötigten Tabellen wurden erstellt!<br>";
    $pdo = null;
    echo "Die Verbindung zu DB wurde geschlossen";
    ?>