<?php

header( 'Content-Type: application/json' );

$markers = array(
	array(
		'icon'          => 'default',
		'title'         => 'this is the points title',
		'excerpt'       => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis rutrum tincidunt quam. Ut a nunc ut massa feugiat lacinia non quis enim. Vestibulum pharetra vitae metus at tempor.',
		'img'           => '',
		'location_url'  => false,
		'website_url'   => false,
		'latitude'      => 51.505,
		'longitude'     => -0.09,
		'taxonomies'    => array(
			'categories'      => array(),
			'tags'            => array(),
		),
		'settings' => array(
			'default_zoom'    => 13,
			'link_to_google'  => false,
		),
	),
	array(
		'icon'          => 'default',
		'title'         => 'this is the second points title',
		'excerpt'       => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis rutrum tincidunt quam. Ut a nunc ut massa feugiat lacinia non quis enim. Vestibulum pharetra vitae metus at tempor.',
		'img'           => '',
		'location_url'  => false,
		'website_url'   => false,
		'latitude'      => 51.497095,
		'longitude'     => -0.081882,
		'taxonomies'    => array(
			'categories'      => array(),
			'tags'            => array(),
		),
		'settings' => array(
			'default_zoom'    => 13,
			'link_to_google'  => false,
		),
	),
);

$markers_json = wp_json_encode( $markers );

echo $markers_json;

die();
