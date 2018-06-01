<?php

	namespace WpSeoHide;

	class Hider {

		private $options = array();

		function __construct() {
			$this->loadSettings();
			$this->init();
		}

		private function loadSettings() {
			$this->options = get_option('wpsh_options');				
		}

		private function init() {
			/* Check if current url in exclude list  */
			if (!$this->isUrlExclude()) {
				if ($this->options['hide_in_widgets'] == 'on')
					add_filter('widget_text', array($this, 'hide_in_widgets'));
			}

			/* set filter to all nav menu link items */
			add_filter('nav_menu_link_attributes', array($this, 'hide_in_menu_items'), 10, 3);
			add_filter('wp_list_categories', array($this, 'hideCategories'), 10, 3);
		}

		public function hideCategories($output, $args) {

			return $this->searchLinks($output);
		}

		private function isUrlExclude() {
			$excludeUrls = explode(PHP_EOL, $this->options['hide_on_urls_exclude']);
			$currentUrl = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

			foreach ($excludeUrls as $url) {
				if (strpos($url, $currentUrl) !== false)
					return true;
			}
			return false;
		}

		public function isCurrentUrl($url) {
			
			// clean url
			$url = str_replace(array('http://','https://'), '', $url);
			$currentUrl =  $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];			

			if (strcasecmp($url, $currentUrl) == 0) {
				return true;
			} else {
				return false;
			}
		}

	
		private function isUrlExcludeFromHide() {
			$excludeUrls = explode(PHP_EOL, $this->options['exclude_on_urls']);
			$currentUrl = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

			foreach ($excludeUrls as $url) {
				/*
					check if set '*' in end of exclude url
					if set, check if url is sub string of current url
				 */
				if (substr($url, -1) == '*') {
					if (strpos($currentUrl, str_replace('*', '', $url)) !== false)
						return true;					
				} else {
					if (strpos($url, $currentUrl) !== false)
						return true;
				}

			}
			return false;			
		}

		public function hide_in_menus($items, $args) {
			$menu_ids = $this->options['hide_menu_list']; // array
			return $items;
		}

		public function hide_in_menu_items($atts, $item, $args) {
			$menu_ids = $this->options['hide_menu_list'];

			if ($this->isCurrentUrl($atts['href'])) {
			// if ($this->isMenuSetToHide($args->menu)) {
				$atts['data-sh'] = ($atts['href'] == '#') ? '#' : $this->encode($atts['href']);
				$atts['href'] = "#";
			}
			return $atts;
		}

		private function isMenuSetToHide($menu_id) {
			$hide_menu_list = $this->options['hide_menu_list'];
			$exclude_menu_list = $this->options['exclude_menu_list'];

			/**
			 * Check if menu id set to exclude of hide, if not then check if set to hide
			 */
			if ($this->isUrlExclude()) {
				return false;
			} elseif ($this->isUrlExcludeFromHide()) {
				if (in_array($menu_id, $exclude_menu_list))	
					return false;
				if (in_array($menu_id, $hide_menu_list))
					return true;
			} else {
				if (in_array($menu_id, $hide_menu_list))
					return true;
			}
		}

		function hide_in_menu($html) {
			$html = $this->searchLinks($html);
    		return $html;
		}

		public function hide_in_widgets($html) {
			$html = $this->searchLinks($html);
			return $html;
		}   

		private function searchLinks( $content, $target = false ) {

			/*debugToConsole($target); */

			$tmp = preg_replace_callback( '/<a (.+?)>/i', array($this, 'linksReplace'), $content );
			return $tmp;
		}

		public function linksReplace( $input, $isCheckUrl = false ) {

			// var_dump($input);
			preg_match( '~\s(?:href)=(?:[\"\'])?(.*?)(?:[\"\'])?(?:[\s\>])~i', $input[0], $matches );
			if ( preg_match( "/^(#[a-z0-9-]{1,128}|#)/i", $matches[1] ) ) {
				// var_dump($input[0]);
				return $input[0];
			}

			if ($this->isCurrentUrl($matches[1])) {
				$input[0] = str_replace( $matches[1], $this->encode( $matches[1] ), $input[0] );
				$input[0] = str_replace( 'href=', "href='#' data-sh=", $input[0] );	
			}

			return $input[0];
		}

		private function encode( $var ) {
			return base64_encode( $var );
		}
	}
?>