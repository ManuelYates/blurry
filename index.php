<?php session_start() ?>
<?php require_once 'backend/config.php'; ?>
<?php require_once 'backend/html_prepare.php'; ?>
<?php require_once 'backend/session_check.php'; ?>


<!DOCTYPE html>
<html lang="de" dir="ltr">

<head>
  <?php print $html_head ?>
</head>

<body>
  <?php print $html_header ?>
  <?php

  $conn = mysqli_connect("localhost", "root", "", "blurry");
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $sql = "SELECT * from verslog";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo '
    <div class="verslog_main">
    <table>
    <tr><th>' . $row['verslog_num'] . '</th></tr>
    <tr><th>' . $row['verslog_title'] . '</th></tr>
    <tr><th>' . $row['verslog_text'] . '</th></tr>
    </table>
    </div>
      ';
    }
  } else {
    echo "<h1>Kein Eintrag gefunden</h1>";
  }

  $conn->close();
  ?>
  <?php print $html_footer ?>
</body>

</html>