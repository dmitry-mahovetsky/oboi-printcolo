<?php
/*
Plugin Name: WpSeoHide
Description: Plugin for hiding external links
Version: 1.3.0
Author: Lisovoy Igor
Author URI: http://stellio.org.ua
Text Domain: wp-seohide
Domain Path: /languages
*/


define('WpShDir', plugin_dir_path(__FILE__));
define('WpShUrl', plugin_dir_url(__FILE__));

require_once (WpShDir . 'includes/Hider.php');
require_once (WpShDir . 'includes/tools/Debug.php');


function wpsh_menu() {
	add_menu_page(	__('Wp SeoHide | Options', 'wp-seohide'),
					__('SeoHide', 'wp-seohide'),
					'manage_options',
					'wpsh',
					'wpsh_page',
					WpShUrl . 'images/wp-seohide.png');

	add_action('admin_init', 'wpsh_register_settings');

}
add_action('admin_menu', 'wpsh_menu');


function wpsh_page() {
	?>
		<div class="wrap">
			<h2><?php echo __('SeoHide Options', 'wp-seohide');?></h2>
			<form method="post" action="options.php">
				<?php settings_fields( 'wpsh-settings-group');?>
				<?php $options = get_option('wpsh_options');?>

				<div id="poststuff">
		            <div class="postbox">
		                <h3 class="hndle"><?php echo __('Hide', 'wp-seohide'); ?></h3>
		                <div class="inside">
							<table class="form-table">
								<tr>
									<th scope="row"><?php echo __('In Menus:', 'wp-seohide'); ?></th>
									<td>
										<select name="wpsh_options[hide_menu_list][]" multiple="multiple" size="10">
										<option value='0'>Нет</option>
										<?php
											/*
												Generate option list of nav_menus
											 */
											$menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
											foreach ( $menus as $menu ) { ?>
											  	<option value="<?=$menu->term_id;?>" <?php echo (in_array($menu->term_id, $options['hide_menu_list'])) ? 'selected="selected"' : '' ;?> ><?php echo $menu->name; ?></option>
											<?php } ?>
										</select>
										<p class="description"><?php echo __('Specify menu items in which need to hide urls', 'wp-seohide'); ?></p>
									</td>
								</tr>
								<tr>
									<th scope="row"><?php echo __('In Widgets', 'wp-seohide'); ?></th>
									<td>
										<input <?php echo checked($options['hide_in_widgets'], 'on', false); ?> type="checkbox" name="wpsh_options[hide_in_widgets]"/>
										<p class="description"><?php echo __('Switch On, if need hide urls in widgets', 'wp-seohide'); ?></p>
									</td>
									
								</tr>

								<tr>
									<th scope="row"><?php echo __('Exclude Url\'s', 'wp-seohide'); ?></th>
									<td>
										<textarea cols="50" name="wpsh_options[hide_on_urls_exclude]"><?php echo esc_attr($options['hide_on_urls_exclude']);?></textarea>
										<p class="description"><?php echo __('If need to disable hiding, on custom site urls, just enter them in new line. Like: site.com/exclude_url', 'wp-seohide'); ?></p>
									</td>
								</tr>
							</table>
		                </div>
		            </div>
		            <div class="postbox">
		                <h3 class="hndle"><?php echo __('Hide Exclude', 'wp-seohide'); ?></h3>
		                <div class="inside">
							<table class="form-table">
								
								<tr>
									<th scope="row"><?php echo __('Url\'s', 'wp-seohide'); ?></th>
									<td>
										<textarea cols="50" name="wpsh_options[exclude_on_urls]"><?php echo esc_attr($options['exclude_on_urls']);?></textarea>
										<p class="description"><?php echo __('List of urls, on which will exclude menu items from hiding', 'wp-seohide'); ?></p>
									</td>
								</tr>
							</table>
		                </div>
		            </div>
       			</div>
				<p class="submit">
					<input type="submit" class="button-primary" value="<?php echo __('Save', 'wp-seohide'); ?>" />
				</p>
			</form>
		</div>
	<?php
}

function wpsh_register_settings() {
	register_setting('wpsh-settings-group', 'wpsh_options', 'wpsh_sanitize_options');
}


function wpsh_sanitize_options($input) {
	$input['hide_in_widgets'] 	= ( $input['hide_in_widgets'] == 'on' ) ? 'on' : '';
 
	$replace = '';
	$pattern = '/htt(p|ps):\/\//';

	$input['hide_on_urls_exclude'] = preg_replace($pattern, $replace, $input['hide_on_urls_exclude']);
    $input['exclude_on_urls']   = preg_replace($pattern, $replace, $input['exclude_on_urls']);
	return $input;
}

function wpsh_load_js() {
	wp_register_script(
		'wpsh', 
		WpShUrl . 'js/wpsh.js', 
		array( 'jquery' ), '1.0', false );
	
	wp_enqueue_script( 'wpsh' );
}
add_action( 'wp_enqueue_scripts', 'wpsh_load_js' );


function wpsh_init() {
	load_plugin_textdomain('wp-seohide', false, plugin_basename(dirname(__FILE__) . '/lang'));
}
add_action('init', 'wpsh_init');


/**
 * Start our SeoHider 
 */
new \WpSeoHide\Hider();