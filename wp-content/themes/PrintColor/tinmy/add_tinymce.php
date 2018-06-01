<?php
// для активации пагина вставте в файл functions.php
// вашей темы include_once('tinmy/add_tinymce.php');
add_action('init', 'myreaddir_buttonhooks');
function myreaddir_buttonhooks() {
	if ( ! get_user_option('rich_editing') ) return;

	add_filter( 'mce_external_plugins', 'myreaddir_mce_plugin' );
	add_filter( 'mce_buttons', 'myreaddir_register_buttons' );
	//echo '<div id=#new-load-img><div></div></div>';
}
function myreaddir_register_buttons( $buttons ){
	$temp = & $buttons['temp'];
	$i = 0;
	foreach( $buttons as $button ){
		if( ++$i == 15 ){
			$temp[] = "myreaddir_block";
		}
		$temp[] = $button;
	}

	return $temp;
}
function myreaddir_mce_plugin( $plugin_array ) {
	$plugin_array['myreaddir'] = get_template_directory_uri().'/tinmy/tinymce.js';
	return $plugin_array;
}

?>