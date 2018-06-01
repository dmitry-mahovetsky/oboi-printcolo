<?php

	namespace WpSeoHide;

	class Menu {

		public function __construct() {
			add_action('admin_menu', array($this, 'create'));
		}

		public function create() {
			add_menu_page(__('Wp SeoHide page', 'wp-seohide'),
						  __('SeoHide', 'wp-seohide'),
						  'manage_options',
						  'wpsh',
						  array( $this, 'pluginPage' ),
						  WpShUrl . 'images/wp-seohide.png');
		}
	}
?>

