<?php
include_once('tinmy-function.php');
$img0=$_POST['dat0'];
$arrlist=getFileList($img0);
sort($arrlist);
$numrow=0;

$arr=genertable($arrlist,$img0);
$table=$arr[0];


$dir = dirname($_SERVER['SCRIPT_NAME']);
$close ='<img src="'.$dir.'/close.png" class="list_close" />';

$table.= '</table>';
echo '<p class="w90">категория - <span id="catnam">'.basename($img0).'</span></p>'.$table;
?>