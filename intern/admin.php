<?php session_start() ?>
<?php require_once '../backend/config.php'; ?>
<?php require_once '../backend/html_prepare.php'; ?>
<?php require_once '../backend/functions.php'; ?>
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

<body>
  <?php print $html_header ?>

  <table>
    <tr>
      <td><button>Versionslog hinzufügen</button></td>
      <td><button>Bilder löschen</button></td>
      <td><a href="<?php echo $link_sql_ini ?>"><button>DB Reset</button></a></td>
    </tr>
  </table>

  <div id="verslog_added">
    <form action="?versupload=1" method="post" enctype="multipart/form-data">
      <table>

        <tr>
          <th>Version's Titel</th>
          <td><input name="verslog_title" type="text"></td>
        </tr>
        <tr>
          <th>Version</th>
          <td><input name="verslog_num" type="int"></td>
        </tr>
        <tr>
          <th>Versionsbeschreibung</th>
          <td><input name="verslog_text" type="text"></td>
        </tr>
      </table>
      <input type="submit" value="Hochladen">
    </form>
    </div>

   <div id="content_img">
      <?php echo ImageScroll()?>
    
    <?php print $html_footer ?>
</body>

</html>