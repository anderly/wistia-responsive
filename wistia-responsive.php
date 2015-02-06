<?php
/*
Plugin Name: Wistia Responsive
Plugin URI: http://anderly.com/wistia-responsive
Description: A simple plugin to make all Wistia embeds automatically responsive.
Version: 1.1.1
Author: Adam Anderly
Author URI: http://anderly.com

	Copyright: © 2015 Adam Anderly
	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html

	Wistia: http://wistia.com/
*/
include_once( 'classes/class-ss-wistia-responsive.php' );

add_action( 'plugins_loaded', array ( SS_Wistia_Responsive::get_instance(), 'plugin_setup' ) );

?>