<?php
// require_once($_SERVER['DOCUMENT_ROOT'].'/prosto_oboi/wp-load.php');
// require_once('/home/printcol/oboi-printcolor.com/www/wp-load.php');
//require_once('/home/prosto_oboi/www/wp-load.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="main.css" />
<script type="text/javascript" src="../js/jquery-2.0.0.min.js"></script>
<script type="text/javascript" src="ajax.js"></script>
</head>
<body>
<img src="<?php echo get_template_directory_uri(); ?>/img/preloader.gif" alt="" id="preload" />
<form method="post" >
<p class="w90">
<input type="hidden" name="send" id="datsend" value="1" />
<label>Папка</label>
<span id="catname"></span>
<input type="button" value="Сгенерировать записи" id="send" />
<input type="button" value="Выбрать папку" id="vibor" />
<p>
</form>
</body>
</html>