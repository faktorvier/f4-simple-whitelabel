<?php

/*
Plugin Name: F4 Simple White Label
Plugin URI: https://github.com/faktorvier/f4-simple-whitelabel
Description: Allows you to to change the login image, admin bar logo and admin footer text.
Version: 1.0.4
Author: FAKTOR VIER
Author URI: https://www.faktorvier.ch
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: f4-simple-whitelabel
Domain Path: /languages/

This plugin is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

This plugin is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this plugin. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

if(!defined('ABSPATH')) exit;

define('F4_SWL_VERSION', '1.0.4');

define('F4_SWL_SLUG', 'f4-simple-whitelabel');
define('F4_SWL_MAIN_FILE', __FILE__);
define('F4_SWL_BASENAME', plugin_basename(F4_SWL_MAIN_FILE));
define('F4_SWL_PATH', dirname(F4_SWL_MAIN_FILE) . DIRECTORY_SEPARATOR);
define('F4_SWL_URL', plugins_url('/', F4_SWL_MAIN_FILE));
define('F4_SWL_PLUGIN_FILE', basename(F4_SWL_BASENAME));
define('F4_SWL_PLUGIN_FILE_PATH', F4_SWL_PATH . F4_SWL_PLUGIN_FILE);

// Add autoloader
spl_autoload_register(function($class) {
	$class = ltrim($class, '\\');
	$ns_prefix = 'F4\\SWL\\';

	if(strpos($class, $ns_prefix) !== 0) {
		return;
	}

	$class_name = str_replace($ns_prefix, '', $class);
	$class_path = str_replace('\\', DIRECTORY_SEPARATOR, $class_name);
	$class_file = F4_SWL_PATH . 'modules' . DIRECTORY_SEPARATOR . $class_path . '.php';

	if(file_exists($class_file)) {
		require_once $class_file;
	}
});

// Init core modules
F4\SWL\Core\Hooks::init();

// Init modules
F4\SWL\WhiteLabel\Hooks::init();

?>
