<?php namespace CAHNRSWP\Plugin\Maps;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} // End if

/*
* @desc Class to post types
* @sicne 0.0.1
*/
class Map_Locations_Post_Type extends Post_Type {

	// @var string $slug Post type slug
	protected $slug = 'map_locations';

	// @var array $labe's Labels to use when registering the post type
	protected $register_labels = array(
		'name'               => 'Map Location',
		'singular_name'      => 'Map Location',
		'menu_name'          => 'Map Locations',
		'name_admin_bar'     => 'Map Location',
		'add_new'            => 'Add New',
		'add_new_item'       => 'Add New Map Location',
		'new_item'           => 'New Map Location',
		'edit_item'          => 'Edit Map Location',
		'view_item'          => 'View Map Location',
		'all_items'          => 'All Map Locations',
		'search_items'       => 'Search Map Locations',
		'parent_item_colon'  => 'Parent Map Location:',
		'not_found'          => 'No map locations found.',
		'not_found_in_trash' => 'No map locations found in Trash.',
	);

	// @var array $args Args to use when registering the post type
	protected $register_args = array(
		'description'        => 'Locations to use in map displays.',
		'public'             => true,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'locations' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
	);


} // End Post_Types

$cahnrswsuwp_map_locations_post_types = new Map_Locations_Post_Type();
