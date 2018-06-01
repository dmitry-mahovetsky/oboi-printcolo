<?php
include_once('tinmy-function.php');
//$img0 = $_POST['dat0'];
//$img0='https://foto-oboi/wp-content/uploads/';
$img0=$_SERVER['DOCUMENT_ROOT'].'/wp-content/uploads/pc_photobase/';
//@mkdir($img0, 0777);
//chmod($img0, 0644);
//$dir=str_replace('img/','',$img0);
//echo 'Путь к корневой папке: '.$_SERVER['DOCUMENT_ROOT'].'<br>';
//echo 'Полный путь к скрипту и его имя: '.$_SERVER['SCRIPT_FILENAME'].'<br>';
//echo 'Имя скрипта: '.$_SERVER['SCRIPT_NAME'];
$arrlist=getFileList($img0,true,true);
//print_r($arrlist);
sort($arrlist);
$list ='';
$nam='';
$n=0;
$n=1;
  foreach($arrlist as $file) { 
    $nam = str_replace($img0,'',$file['name']);
	$list.='<li><a hreff="'.$file['name'].'">'.$nam.'</li>';
	$n++;
}

$dir = dirname($_SERVER['SCRIPT_NAME']);
//$headpag = file_get_contents('pagelist.html');
$headpag = '<link rel="stylesheet" type="text/css" href="'.$dir.'/main.css" />
<h3>Выберите папку</h3>';
$close ='<img src="'.$dir.'/close.png" class="list_close" />';
$pag='<div id="windowlist">'.$close.'<div  id="loadlist">'.$headpag.'<ul>'.$list.'</ul></div></div>';
echo $pag;



 
?>