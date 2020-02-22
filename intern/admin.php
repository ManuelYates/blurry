<?php session_start() ?>
<?php require_once '../backend/config.php'; ?>
<?php require_once '../backend/html_prepare.php'; ?>
<?php require '../backend/functions.php'; ?>
<?php echo AdminSessionCheck() ?>

<?php 
if(isset($_GET['UserGen'])){
  echo UserGenerator();
}

if(isset($_GET['ImgGen'])){
echo ImageGenerator();
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
      <td><form action="?UserGen=1" method="post"><input type="submit" value="User Generieren"></form></td>
      <td><form action="?ImgGen=1" method="post"><input type="submit" value="Bilder Generieren"></form></td>
    </tr>
  </table>
  <div id="idresult"></div>
  <?php print $html_footer ?>
</body>

</html>