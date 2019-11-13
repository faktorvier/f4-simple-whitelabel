<?php

namespace F4\SWL\WhiteLabel;

use F4\SWL\Core\Helpers as Core;

/**
 * WhiteLabel hooks
 *
 * Hooks for the WhiteLabel module
 *
 * @since 1.0.0
 * @package F4\SWL\WhiteLabel
 */
class Hooks {
	/**
	 * Initialize the hooks
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 */
	public static function init() {
		add_action('F4/SWL/Core/set_constants', __NAMESPACE__ . '\\Hooks::set_default_constants', 99);
		add_action('F4/SWL/Core/loaded', __NAMESPACE__ . '\\Hooks::loaded');
	}

	/**
	 * Sets the module default constants
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 */
	public static function set_default_constants() {

	}

	/**
	 * Fires once the module is loaded
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 */
	public static function loaded() {
		// Login logo
		add_action('login_head', __NAMESPACE__ . '\\Hooks::login_head_styles', 99);
		add_filter('login_headertext', __NAMESPACE__ . '\\Hooks::login_head_image');
		add_filter('login_headerurl', __NAMESPACE__ . '\\Hooks::login_head_url');

		// Favicons
		add_action('login_head', __NAMESPACE__ . '\\Hooks::admin_head_favicon');
		add_action('admin_head', __NAMESPACE__ . '\\Hooks::admin_head_favicon');

		// Admin bar
		// @todo

		// Backend footer
		add_filter('admin_footer_text', __NAMESPACE__ . '\\Hooks::admin_footer_text', 99);
		add_filter('update_footer', __NAMESPACE__ . '\\Hooks::admin_footer_update_text', 99);
	}

	/**
	 * Add custom styles to login page
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 */
	public static function login_head_styles() {
		if(has_filter('F4/SWL/WhiteLabel/login_logo')) {
			echo '<style type="text/css">
				.login h1 a {
					position: relative;
					background: none;
					height: auto;
					width: 100%;
					font-size: 0;
					line-height: 0;
					text-indent: 0;
				}

				.login h1 a img {
					max-width: 100%;
				}

				.login h1 a span {
					position: absolute;
					top: -100%;
					left: -100%;
					overflow: hidden;
					font-size: 20px;
					line-height: 1.3em;
				}
			</style>';
		}
	}

	/**
	 * Change login head logo
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 */
	public static function login_head_image($text) {
		$image_src = apply_filters('F4/SWL/WhiteLabel/login_logo', false);

		if($image_src) {
			$image_alt = apply_filters('F4/SWL/WhiteLabel/login_logo_alt', $text);
			$image_style = apply_filters('F4/SWL/WhiteLabel/login_logo_style', '');

			$text = '<img src="' . $image_src . '" style="' . $image_style . '" alt="' . $image_alt . '" /><span>' . $text . '</span>';
		}

		return $text;
	}

	/**
	 * Change login head url
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 */
	public static function login_head_url($url) {
		return apply_filters('F4/SWL/WhiteLabel/login_logo_href', $url);
	}

	/**
	 * Add favicon to admin head
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 */
	public static function admin_head_favicon() {
		$favicon_src = apply_filters('F4/SWL/WhiteLabel/admin_favicon', false);

		if($favicon_src) {
			echo '<link rel="shortcut icon" href="' . $favicon_src . '" />';
		}
	}

	/**
	 * Change admin footer text
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 */
	public static function admin_footer_text($text) {
		return apply_filters('F4/SWL/WhiteLabel/admin_footer_text', $text);
	}

	/**
	 * Change admin footer text
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 */
	public static function admin_footer_update_text($text) {
		return apply_filters('F4/SWL/WhiteLabel/admin_footer_update_text', $text);
	}
}

?>
