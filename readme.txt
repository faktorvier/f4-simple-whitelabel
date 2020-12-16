=== F4 Simple White Label ===
Contributors: faktorvier
Donate link: https://www.faktorvier.ch/donate/
Tags: white label, whitelabel, login, login page, favicon, admin bar, admin menu, footer text, custom admin, customize admin, customize login, customize admin bar
Requires at least: 5.2
Tested up to: 5.6
Requires PHP: 7.0
Stable tag: 1.0.4
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Allows you to to change the login image, admin bar logo and admin footer text.

== Description ==

With this plugin you can change the **login image**, add a **custom logo to the admin bar** and change the **admin footer texts**.

Currently this is only possible with a few easy to use hooks. We plan to add an options page to the WordPress backend, so you can change all the above mentioned without using a single line of code.

= Usage =

You can add the following hooks to the functions.php of your theme.

**Add favicon to login page and backend:**

	add_filter('F4/SWL/admin_favicon', function() {
		return 'url-to-your-favicon.ico';
	});


**Change the login page image:**

	add_filter('F4/SWL/login_image', function() {
		return 'url-to-your-login-image.png';
	});

You can also change the **href**, **link text**, **image alt text** like this:

	add_filter('F4/SWL/login_image_href', function() {
		return 'https://www.faktorvier.ch';
	});

	add_filter('F4/SWL/login_image_link_text', function() {
		return 'This WordPress is powered by FAKTOR VIER';
	});

	add_filter('F4/SWL/login_image_alt', function() {
		return 'FAKTOR VIER logo';
	});

If needed you can add custom **inline styles** to the image:

	add_filter('F4/SWL/login_image_style', function() {
		return 'width:50px; height:50px;';
	});

**Add a custom logo to the admin bar:**

	add_filter('F4/SWL/admin_bar_logo', function() {
		return 'url-to-your-admin-bar-logo.png';
	});

You can also change the **href**, **logo alt text** like this:

	add_filter('F4/SWL/admin_bar_logo_href', function() {
		return 'https://www.faktorvier.ch';
	});

	add_filter('F4/SWL/admin_bar_logo_alt', function() {
		return 'FAKTOR VIER logo';
	});

If needed you can add custom **inline styles** to the logo:

	add_filter('F4/SWL/admin_bar_logo_style', function() {
		return 'height:20px; margin:8px 0;';
	});

If you have users that like to use the **light color theme**, you can define a different logo for that. If you dont use this hook, the **admin_bar_logo** logo us used for all themes:

	add_filter('F4/SWL/admin_bar_logo_light', function() {
		return 'url-to-your-admin-bar-logo-light.png';
	});

**Change the backend footer texts:**

	add_filter('F4/SWL/admin_footer_text', function() {
		return '<span id="footer-thankyou">Thank you for creating with WordPress.Get</span>';
	});

	add_filter('F4/SWL/admin_footer_update_text', function() {
		return 'Version 5.3';
	});

= Features overview =

* Add favicon to login page and backend
* Change the login page image
* Add a custom logo to the admin bar
* Change the backend footer texts
* Easy to use
* Lightweight and optimized
* 100% free!

= Planned features =

* Everything configurable in the backend without a single line of code

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/f4-simple-whitelabel` directory, or install the plugin through the WordPress plugins screen directly
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the hooks explained in the usage section above

== Screenshots ==

1. Login page image
2. Admin bar logo
3. Admin footer texts

== Changelog ==

= 1.0.4 =
* Support WordPress 5.6

= 1.0.3 =
* Support WordPress 5.5

= 1.0.2 =
* Support WordPress 5.4

= 1.0.1 =
* Update namespaces

= 1.0.0 =
* Initial stable release
