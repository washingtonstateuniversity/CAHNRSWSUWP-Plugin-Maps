<?php namespace CAHNRSWP\Plugin\Maps;

/**
 * Get plugin path
 * @since 0.0.1
 *
 * @param string $path Optional path to append
 *
 * @return string Full path
 */
function cmap_get_plugin_path( $path = '' ) {

	$path = CAHNRSMAPSBASEPATH . '/' . $path;

	return $path;

} // End cmap_get_plugin_path
