<?php namespace CAHNRSWP\Plugin\Maps;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} // End if

/**
 * Handle shortcodes for the plugin
 * @since 0.0.1
 */
class Include_Shortcodes {


	public function __construct() {

		$this->add_shortcodes();

	} // End __construct


	/**
	 * Add post types to maps plugin
	 * @since 0.0.1
	 */
	protected function add_shortcodes() {

		include_once cmap_get_plugin_path( 'lib/shortcodes/cahnrs-map/cahnrs-map-shortcode.php' );

	} // End add_post_types


} // End Include_Shortcodes

$cahnrswsuwp_map_include_shortcodes = new Include_Shortcodes();
