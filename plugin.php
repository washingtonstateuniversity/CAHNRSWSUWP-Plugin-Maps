<?php
/*
Plugin Name: CAHNRS WSUWP Maps
Version: 0.0.1
Description: Plugin for generating and including accessible maps
Author: washingtonstateuniversity, Danial Bleile
Author URI: https://cahnrs.com/communications
Plugin URI: https://github.com/washingtonstateuniversity/CAHNRSWSUWP-Plugin-Maps
Text Domain: cahnrs-plugin-map
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// This plugin uses namespaces and requires PHP 5.3 or greater.
if ( version_compare( PHP_VERSION, '5.3', '<' ) ) {
	add_action( 'admin_notices', create_function( '', // phpcs:ignore WordPress.PHP.RestrictedPHPFunctions.create_function_create_function
	"echo '<div class=\"error\"><p>" . __( 'CAHNRS Maps requires PHP 5.3 to function properly. Please upgrade PHP or deactivate the plugin.', 'cahnrs-plugin-map' ) . "</p></div>';" ) );
	return;
} else {
	include_once __DIR__ . '/lib/includes/include-cahnrswsuwp-map.php';
}
