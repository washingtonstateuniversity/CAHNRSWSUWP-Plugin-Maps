<?php namespace CAHNRSWP\Plugin\Maps;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} // End if

/*
* @desc Class to post types
* @sicne 0.0.1
*/
class Post_Types {


	public function __construct() {

		$this->add_post_types();

	} // End __construct


	/**
	 * Add post types to maps plugin
	 * @since 0.0.1
	 */
	protected function add_post_types() {

		include_once cmap_get_plugin_path( 'lib/classes/class-post-type.php' );

		include_once cmap_get_plugin_path( 'lib/post-types/map-locations/map-locations-post-type.php' );

	} // End add_post_types


} // End Post_Types

$cahnrswsuwp_map_post_types = new Post_Types();
