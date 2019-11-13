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
		// Login page
		add_action('login_head', __NAMESPACE__ . '\\Hooks::login_head_styles');
		add_filter('login_headertext', __NAMESPACE__ . '\\Hooks::login_head_image');
		add_filter('login_headerurl', __NAMESPACE__ . '\\Hooks::login_head_url');

		// Favicons
		add_action('login_head', __NAMESPACE__ . '\\Hooks::admin_head_favicon');
		add_action('admin_head', __NAMESPACE__ . '\\Hooks::admin_head_favicon');

		// Admin bar
		add_action('admin_bar_menu', __NAMESPACE__ . '\\Hooks::admin_bar_logo', 1);
		add_action('admin_bar_menu', __NAMESPACE__ . '\\Hooks::admin_bar_remove_wp_logo', 99);

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
		if(has_filter('F4/SWL/login_image')) {
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
		$image_src = apply_filters('F4/SWL/login_image', false);

		if($image_src) {
			$link_text = apply_filters('F4/SWL/login_image_link_text', get_bloginfo('name'));
			$image_alt = apply_filters('F4/SWL/login_image_alt', $link_text);
			$image_style = apply_filters('F4/SWL/login_image_style', '');

			$text = '<img src="' . $image_src . '" alt="' . $image_alt . '" style="' . $image_style . '" /><span>' . $link_text . '</span>';
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
		return apply_filters('F4/SWL/login_image_href', $url);
	}

	/**
	 * Add favicon to admin head
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 */
	public static function admin_head_favicon() {
		$favicon_src = apply_filters('F4/SWL/admin_favicon', false);

		if($favicon_src) {
			echo '<link rel="shortcut icon" href="' . $favicon_src . '" />';
		}
	}

	/**
	 * Add logo to admin bar
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 */
	public static function admin_bar_logo($admin_bar) {
		$image_src = apply_filters('F4/SWL/admin_bar_logo', false);

		if($image_src) {
			// Use light image if defined and light theme is active
			$image_light_src = apply_filters('F4/SWL/admin_bar_logo_light', false);

			if($image_light_src  && get_user_option('admin_color') === 'light') {
				$image_src = $image_light_src;
			}

			// Add menu item with image tag
			$image_alt = apply_filters('F4/SWL/admin_bar_logo_alt', '');
			$image_style = apply_filters('F4/SWL/admin_bar_logo_style', 'height:20px;margin:6px 0;');

			$menu_args = [
				'id' => 'whitelabel-logo',
				'title' => '<img src="' . $image_src . '" alt="' . $image_alt . '" style="' . $image_style . '" />',
			];

			// Add href if defined
			$image_href = apply_filters('F4/SWL/admin_bar_logo_href', false);

			if($image_href) {
				$menu_args['href'] = $image_href;
				$menu_args['meta'] = [
					'target' => '_blank'
				];
			}

			// Add logo to admin bar
			$admin_bar->add_menu(
				apply_filters('F4/SWL/admin_bar_logo_args', $menu_args)
			);
		}
	}

	/**
	 * Remove WordPress logo from admin bar if custom logo is defined
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 */
	public static function admin_bar_remove_wp_logo($admin_bar) {
		if($admin_bar->get_node('whitelabel-logo')) {
			$admin_bar->remove_node('wp-logo');
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
		return apply_filters('F4/SWL/admin_footer_text', $text);
	}

	/**
	 * Change admin footer text
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 */
	public static function admin_footer_update_text($text) {
		return apply_filters('F4/SWL/admin_footer_update_text', $text);
	}
}

?>
