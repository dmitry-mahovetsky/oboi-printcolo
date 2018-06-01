<?php
// require_once($_SERVER['DOCUMENT_ROOT'].'./wp-load.php');
// require_once('/home/printcol/oboi-printcolor.com/www/wp-load.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
include_once('tinmy-function.php');
$val=$_POST['dat0'];
$dat1=$_POST['dat1'];
$dat2=$_POST['dat2'];
$datcat=$_POST['dat3'];
$dat4=$_POST['dat4'];
$dat5=$_POST['dat5'];
$dat6=$_POST['dat6'];
$catid=get_category_by_slug($datcat)->term_id;
echo 'catname= '.$datcat.' catid= '.$catid;
if(get_category_by_slug($datcat)->term_id==false){
echo 'нет такой категории!!!<script type="text/javascript">
alert("нужно сначала создать категорию с ярлыком: '.$datcat.'");
</script>';
} else {
echo ' посты добавлены все ок!<script type="text/javascript">
alert("посты добавлены в категорию: '.$datcat.' все ок!");
</script>';

$numid=explode("-nid-",$dat1);
$nam=explode("-nam-",$dat2);
$srcimgar=explode("-src-",$dat4);
$colorar=explode("-color-",$dat5);
$contentar=explode("-content-",$dat6);
if(isset($val)) { 
for($i=0;$i<$val;$i++){
	$pos = strpos($nam[$i], '-');
	if($pos !== false){ 
	$mini = dirname($srcimgar[0]).'/'.$nam[$i];
	continue;
	} else {
	$nid=$numid[$i];
	$newname=$nam[$i];//.'-'.$numid[$i] добавляет к имени айди. по умолчанию нумерует автоматом
	$srcimg=$srcimgar[$i];
	$color=$colorar[$i];
	$content=$contentar[$i];
	}
	echo "<br> id= ".$nid;
	echo "<br> mini= ".$mini;
	echo "<br> newnam= ".$newname;
	echo "<br> color= ".$color;
	echo "<br> srcimg= ".$srcimg;

// Создаём объект записи
  $my_post = array(
     'post_title' => $newname,
     'post_content' => '<img src="'.$srcimg.'" alt="'.$nam[$i].'" /> '.$content,
     'post_status' => 'publish',
     'post_author' => 1,
     'post_category' => array($catid)
  );
  

// Вставляем запись в базу данных
 $post_id = wp_insert_post( $my_post,true );
 update_post_meta($post_id, 'номер картинки ID', $nid);
 if($mini){update_post_meta($post_id, 'фото_для_карточки', $mini);}
 if($color){update_post_meta($post_id, 'Основной цвет', $color);}
 
 $post = get_post($post_id);
}
}
}
?>