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
  function fshowVerslog() {
    var vVerslog;
    vVerslog = '<form action="?versupload=1" method="post" enctype="multipart/form-data">'
    vVerslog += '<table>';
    vVerslog += '<tr><th>Version Titel</th><td><input name="verslog_title" type="text"></td></tr>';
    vVerslog += '<tr><th>Version</th><td><input name="verslog_num" type="int"></td></tr>';
    vVerslog += '<tr><th>Versionsbeschreibung</th><td><input name="verslog_text" type="text"></td></tr>';
    vVerslog += '</table><input type="submit" value="Hochladen"></form>';
    document.getElementById('idresult').innerHTML = vVerslog;
  }

  function fshowImageScroll() {
    var vImageScroll;
    vImageScroll = '<div id="content_img"><?php echo ImageScroll() ?>';
    document.getElementById('idresult').innerHTML = vImageScroll;
  }
</script>

<body>
  <?php print $html_header ?>

  <table>
    <tr>
      <td><button onclick="fshowVerslog();">Versionslog hinzufügen</button></td>
      <td><button onclick="fshowImageScroll();">Bilder löschen</button></td>
      <td><a href="<?php echo $link_sql_ini ?>"><button>DB Reset</button></a></td>
    </tr>
  </table>

  <div id="verslog_added">

  </div>




  <div id="idresult"></div>
  <?php print $html_footer ?>
</body>

</html>