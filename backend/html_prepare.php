<?php
$filename = 'index.php';
if (file_exists($filename)) {
    
    //print 'Hauptverzeichnis wird verwendet<br>';
    $link = '';
} else {
    
   //print 'Unterverzeichnis wird verwendet<br>';
    $link ='../';
}

$font_import = '<link href="https://fonts.googleapis.com/css?family=Heebo:300&display=swap" rel="stylesheet"> ';
$style_import = '<link rel="stylesheet" href="'.$link.'backend/master.css">';
$html_head = '<meta charset="utf-8"><title>BLURRY</title>'.$font_import.$style_import;



/* Dateien verlinken*/


$folder_backend = 'backend/';
$folder_user = 'user/';
$folder_intern = 'intern/';

$link_index = $link.'index.php';

$link_image_upload_ui = $link.$folder_backend.'image_upload_ui.php';

$link_user_img_scrollsearch = $link.$folder_user.'user_img_scrollsearch.php';
$link_user_login = $link.$folder_user.'user_login.php';
$link_user_register = $link.$folder_user.'user_register.php';

$link_user_profile_page = $link.$folder_user.'user_profile_page.php';
$link_user_logout = $link.$folder_user.'user_logout.php';
$link_user_index = $link.$folder_user.'user_index.php';

$link_admin = $link.$folder_intern.'admin.php';
$link_sql_ini = $link.$folder_intern.'sql_ini_ui.php';
$link_testing_area = $link.'testing_area.php';


//HTML LI Erstellung
$html_li_user_img_scrollsearch =  '<li><a href="'.$link_user_img_scrollsearch.'">Main</a></li>';
$html_li_image_upload_ui  = '<li><a href="'.$link_image_upload_ui.'">Upload</a></li>';
$html_li_index = '<li><a href  ="'.$link_index.'">Index</a></li>';
$html_li_user_register = '<li><a href  ="'.$link_user_register.'">Registrierung</a></li>';
$html_li_user_login = '<li><a href  ="'.$link_user_login.'">Login</a></li>';

$html_li_testing_area = '<li><a href  ="'.$link_testing_area.'">Beta</a></li>';
$html_li_user_logout = '<li><a href  ="'.$link_user_logout.'">Logout</a></li>';
$html_li_admin = '<li><a href  ="'.$link_admin.'">Admin</a></li>';

//HTML BUTTON ERSTELLUNG
$html_btn_user_img_scrollsearch =  '<a href="'.$link_user_img_scrollsearch.'"><button>Main</button></a>';
$html_btn_image_upload_ui  = '<a href="'.$link_image_upload_ui.'"><button>Upload</button></a>';
$html_btn_index = '<a href  ="'.$link_index.'"><button>Index</button></a>';
$html_btn_user_register = '<a href  ="'.$link_user_register.'"><button>Registrierung</button></a>';
$html_btn_user_login = '<a href  ="'.$link_user_login.'"><button>Login</button></a>';

$html_btn_testing_area = '<a href  ="'.$link_testing_area.'"><button>Beta</button></a>';
$html_btn_user_logout = '<a href  ="'.$link_user_logout.'"><button>Logout</button></a>';
$html_btn_admin = '<a href  ="'.$link_admin.'"><button>Admin</button></a>';


if (isset($_SESSION['user_role'])) {
    if ($_SESSION['user_role'] == '2') {
        $html_navi = '
    <div id="navi">
    <ul>'.
    $html_btn_user_img_scrollsearch.
    $html_btn_image_upload_ui.
    $html_btn_index.
    $html_btn_user_logout
    .'</ul></div>';
    } elseif ($_SESSION['user_role'] == '3') {
        $html_navi = '
    <div id="navi">
    <ul>'.
    $html_btn_user_img_scrollsearch.
    $html_btn_image_upload_ui.
    $html_btn_index.
    $html_btn_testing_area.
    $html_btn_user_logout.
    $html_btn_admin
    .'</ul></div>';
    }
} else {
    $html_navi = '
  <div id="navi">
  <ul>'.
  $html_btn_user_img_scrollsearch.
  $html_btn_user_register.
  $html_btn_user_login.
  '</ul></div>';
}


$html_logo = '<div id="logo"><img src="'.$link.'images/blurry/blurry_logo.png" alt=""></div>';

$html_header = '<div id="header">'.$html_logo.$html_navi.'</div>';

if (isset($_SESSION['user_role'])) {
    $html_footer = '</div>
    <div id="footer">
      <table class="footer_menu_button" ><tr>
        <th><button type="button" name="button">Taste</button></th>
        <th><button type="button" name="button">Taste</button></th>
        <th><button type="button" name="button"><a href="'.$link_user_profile_page.'">Mein Profil</a></button></th>
      </tr></table>
    </div>';
} else {
    $html_footer = ' ';
}
