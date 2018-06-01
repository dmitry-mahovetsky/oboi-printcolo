<?php
function genertable($x,$y){
$img0=$y;
$nam='';
$table='';
	$table= '<table class="tabresult" cellspacing="0" cellpadding="0">';
	$table.= '<tr align="left" valign="top">';
	    $table.= '<th style="width:10%">№ картинки</th>';
		$table.= '<th>имя картинки</th>';
		$table.= '<th>Основной цвет</th>';
		$table.= '<th>текст контент для поиска</th>';
		$table.= '<th>фото картинки</th>';
	$table.= '</tr>';
  foreach($x as $file) {
  $numcart=str_replace($img0,'',$file['name']);
 $var2=explode("_",$numcart); 
    $nam = str_replace($_SERVER['DOCUMENT_ROOT'],'',$file['name']);
	//$numid=explode("_",$nam);
	if($var2[1]==0){continue;}else{
	$table.= '<tr align="left" valign="top" class="count">';
	$table.= '<td class="numid">'.$var2[1].'</td>';
	$pos = strpos(str_replace($img0,'',$file['name']), '-');
	if ($pos === false) {
	$table.= '<td><input type="text" value="'.str_replace($img0,'',$file['name']).'" class="newnam"/></td>';
	$table.= '<td><input type="text" value="" class="color"/></td>';
	$table.= '<td><textarea class="content"></textarea></td>';
	} else {
$table.= '<td class="mini"><input type="text" value="'.str_replace($img0,'',$file['name']).'" class="newnam" readonly /><br>миниатюра</td>';
    $table.= '<td  class="color"></td>';
    $table.= '<td><textarea class="content" style="display:none;"></textarea></td>';	
	}
    $table.= '<td><img class="srcimg" src="'.$nam.'" alt="" /></td>';
	$table.= '</tr>';
	}
}
return array($table);
}

//
  function getFileList($dir, $recurse=false, $depth=false){
    // массив, хранящий возвращаемое значение
    $retval = array();

    // добавить конечный слеш, если его нет
    if(substr($dir, -1) != "/") $dir .= "/";

    // указание директории и считывание списка файлов
    $d = @dir($dir) or die("getFileList: Не удалось открыть каталог $dir для чтения");
    while(false !== ($entry = $d->read())) {

      // пропустить скрытые файлы
      if($entry[0] == ".") continue;
      if(is_dir("$dir$entry")) {
        $retval[] = array(
          "name" => "$dir$entry/",
        );
        if($recurse && is_readable("$dir$entry/")) {
          if($depth === false) {
            $retval = array_merge($retval, getFileList("$dir$entry/", true));
          } elseif($depth > 0) {
            $retval = array_merge($retval, getFileList("$dir$entry/", true, $depth-1));
          }
        }
      } elseif(is_readable("$dir$entry")) {
        $retval[] = array(
          "name" => "$dir$entry",
        );
      }
    }
    $d->close();

    return $retval;
  }



?>