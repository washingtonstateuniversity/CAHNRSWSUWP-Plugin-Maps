<?php

header( 'Content-Type: application/json' );

$icons = array(
	'large_cougar' => array(
		'icon_url'       => 'large-cougar-pin.png',
		//'shadow_url'     => 'leaf-shadow.png',
		'icon_size'      => array( 38, 95 ), // size of the icon
		'shadow_size'    => array( 50, 64 ), // size of the shadow
		'icon_anchor'    => array( 22, 94 ), // point of the icon which will correspond to marker's location
		'shadow_anchor'  => array( 4, 62 ),  // the same for the shadow
		'popup_anchor'   => array( -3, -76 ), // point from which the popup should open relative to the iconAnchor
	),
);

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

$map = array(
	'icons'    => $icons,
	'markers'  => $markers,
);

$map_json = wp_json_encode( $map );

echo $map_json;

die();
