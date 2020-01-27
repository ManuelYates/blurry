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


 ?>
