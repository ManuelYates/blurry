<?php session_start() ?>
<?php require_once '../backend/config.php'; ?>
<?php require_once '../backend/html_prepare.php'; ?>
<?php require '../backend/functions.php'; ?>
<?php echo AdminSessionCheck() ?>

<?php
if (isset($_GET['versupload'])) {
  $error = null;
  if (!isset($_POST['verslog_title'])) {
    $error = +'Bitte geben Sie einen Titel ein';
  }
  if (!isset($_POST['verslog_num'])) {
    $error = +'Bitte geben Sie eine Versionsnummer ein';
  }
  if (!isset($_POST['verslog_text'])) {
    $error = +'Bitte geben Sie eine Beschreibung ein';
  }

  if (!isset($error)) {
    echo Verslog_add();
  }
}
?>

<!DOCTYPE html>
<html lang="de" dir="ltr">

<head>
  <?php print $html_head ?>
</head>

<script>
  function fshowUserList() {
    var viFrameUserList;
    viFrameUserList = ' <div id="AdminiFrame"><iframe src="admin_userlist.php" width="100%" height="100%"></iframe></div>';
    document.getElementById('idresult').innerHTML = viFrameUserList;
  }

  function fshowImageScroll() {
    var viFrameImageList;
    viFrameImageList = '<div id="AdminiFrame"><iframe src="admin_imglist.php" width="100%" height="100%"></iframe></div>';
    document.getElementById('idresult').innerHTML = viFrameImageList;
  }

  function fshowDBReset() {
    var viFrameDBReset;
    viFrameDBReset = '<div id="AdminiFrame"><iframe src="sql_ini.php" width="100%" height="100%"></iframe></div>';
    document.getElementById('idresult').innerHTML = viFrameDBReset;
  }
</script>

<body>
  <?php print $html_header ?>

  <table>
    <tr>
      <td><button onclick="fshowUserList();">User-Liste ansehen</button></td>
      <td><button onclick="fshowImageScroll();">Bilder löschen</button></td>
      <td><button onclick="fshowDBReset();">DB RESET!</button></td>
    </tr>
  </table>
  <div id="idresult"></div>
  <?php print $html_footer ?>
</body>

</html>