<?php
include_once('tinmy-function.php');
$img0=$_POST['dat0'];
$arrlist=getFileList($img0);
sort($arrlist);
$list ='';
$nam='';

  foreach($arrlist as $file) {   
    $nam = str_replace($_SERVER['DOCUMENT_ROOT'],'',$file['name']);
	$list.='<div class="imgblock"><img src="'.$nam.'" alt="" /><p>'.basename($nam).'</p></div>';
}

$dir = dirname($_SERVER['SCRIPT_NAME']);
$headpag = '<link rel="stylesheet" type="text/css" href="'.$dir.'/main.css" />
<h3>Выберите изображение</h3>';
$close ='<img src="'.$dir.'/close.png" class="list_close" />';
$pag='<div id="windowlist">'.$close.'<div  id="imglist">'.$headpag.$list.'</div></div>';
echo $pag;
?>