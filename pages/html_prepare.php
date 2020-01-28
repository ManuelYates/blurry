<?php
$filename = 'master.css';
if (file_exists($filename)) {
  /*Code für Hauptverzeichnis*/
print 'Hauptverzeichnis wird verwendet';
$link = '';
}else {
  /*Code für Pages Verzeichnis*/
print 'Unterverzeichnis wird verwendet';
$link ='../';
}

$font_import = '<link href="https://fonts.googleapis.com/css?family=Heebo:300&display=swap" rel="stylesheet"> ';
$style_import = '<link rel="stylesheet" href="'.$link.'master.css">';
$html_head = '<meta charset="utf-8"><title>BLURRY</title>'.$font_import.$style_import;



/* Dateien verlinken*/
$stock_user_profile_img =$link.'stock_userimage.jpg';
$folder_pages = 'pages/';
$link_user_main = $link.$folder_pages.'main.php';
$link_user_login = $link.$folder_pages.'user_login.php';
$link_user_register = $link.$folder_pages.'user_register.php';
$link_testing_area = $link.'testing_area.php';
$link_image_upload_ui = $link.$folder_pages.'image_upload_ui.php';
$link_index = $link.'index.php';
$link_user_profile_page = $link.$folder_pages.'user_profile_page.php';
$link_user_logout = $link.$folder_pages.'user_logout.php';
$link_user_index = $link.$folder_pages.'user_index.php';

$html_li_user_main =  '<li><a href="'.$link_user_main.'">Main</a></li>';
$html_li_image_upload_ui  = '<li><a href="'.$link_image_upload_ui.'">Upload</a></li>';
$html_li_index = '<li><a href  ="'.$link_index.'">Index</a></li>';
$html_li_user_register = '<li><a href  ="'.$link_user_register.'">Registrierung</a></li>';
$html_li_user_login = '<li><a href  ="'.$link_user_login.'">Login</a></li>';
$html_li_testing_area = '<li><a href  ="'.$link_testing_area.'">Beta</a></li>';
$html_li_user_logout = '<li><a href  ="'.$link_user_logout.'">Logout</a></li>';

$html_navi = '
<div id="navi">
<ul>'.
$html_li_user_main.
$html_li_image_upload_ui.
$html_li_index.
$html_li_user_register.
$html_li_user_login.
$html_li_testing_area.
$html_li_user_logout
.'</ul></div>';

$html_logo = '<div id="logo"><img src="'.$link.'Blurry.png" alt=""></div>';

$html_header = '<div id="header">'.$html_logo.$html_navi.'</div>';

$html_footer = '</div>
  <div id="footer">
    <table class="footer_menu_button" ><tr>
      <th><button type="button" name="button">Taste</button></th>
      <th><button type="button" name="button">Taste</button></th>
      <th><button type="button" name="button"><a href="'.$link_user_profile_page.'">Mein Profil</a></button></th>
    </tr></table>
  </div>';
?>
