<?php session_start() ?>
<?php require '../backend/config.php'; ?>
<?php require '../backend/html_prepare.php'; ?>
<?php require '../backend/functions.php'; ?>
<?php echo SessionCheck() ?>


<!DOCTYPE html>
<html lang="de" dir="ltr">

<head>
    <?php print $html_head ?>
</head>

<body>
    <?php print $html_header ?>

    <?php if (isset($_SESSION['vorname'])) {
        print "<h1>Willkommen " . $_SESSION['vorname'] . "</h1>";
    }

    ?>


    <div id="content_img">
        <?php echo ImageScroll() ?>
        <?php print $html_footer ?>
</body>

</html>