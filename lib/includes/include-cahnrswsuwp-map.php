<?php namespace CAHNRSWP\Plugin\Maps;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} // End if

/*
* @desc Class to handle init of the plugin
* @sicne 0.0.1
*/
class CAHNRSWSUWP_Maps {


	public function __construct() {

		$base_dir = dirname( dirname( __DIR__ ) );

		// Set plugin path constant
		\define( 'CAHNRSMAPSBASEPATH', $base_dir );

		// Set plugin url constant
		\define( 'CAHNRSMAPSBASEURL', \plugin_dir_url( $base_dir ) );

		// Set plugin version constant
		\define( 'CAHNRSMAPSBASEVERSION', '0.0.1' );

		include_once $base_dir . '/lib/functions/public.php';

		$this->init_plugin();

	} // End __construct


	/**
	 * Init the plugin. Include Post types, CSS, JS, etc....
	 */
	protected function init_plugin() {

		$this->add_post_types();

		$this->add_shortcodes();

	} // End init_plugin


	/**
	 * Add post types to plugin
	 */
	protected function add_post_types() {

		include_once cmap_get_plugin_path( 'lib/includes/include-post-types.php' );

	} // End add_post_types


	/**
	 * Add shortcodes to plugin
	 * @since 0.0.1
	 */
	protected function add_shortcodes() {

		include_once cmap_get_plugin_path( 'lib/includes/include-shortcodes.php' );

	} // End add_shortcodes

} // End CAHNRSWSUWP_Maps

$cahnrswsupw_maps = new CAHNRSWSUWP_Maps();
