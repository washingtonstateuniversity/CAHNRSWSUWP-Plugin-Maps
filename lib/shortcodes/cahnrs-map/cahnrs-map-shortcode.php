<?php namespace CAHNRSWP\Plugin\Maps;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} // End if

/**
 * Adds cahnrs_map shortcode to WP
 * @since 0.0.1
 */
class CAHNRS_Map_Shortcode {

	// @var string $slug Shortcode slug
	protected $slug = 'cahnrs_map';

	public function __construct() {

		add_action( 'init', array( $this, 'register_shortcode' ) );

		if ( isset( $_GET['map'] ) ) {

			add_filter( 'template_include', array( $this, 'get_demo_template' ) );

		} // End if

		if ( isset( $_GET['map-json'] ) ) {

			add_filter( 'template_include', array( $this, 'get_json_template' ) );

		} // End if

	} // End __construct


	public function get_demo_template( $template ) {

		return cmap_get_plugin_path( 'demo.php' );

	} // End get_demo_template


	public function get_json_template( $template ) {

		return cmap_get_plugin_path( 'demo-markers.php' );

	} // End get_demo_template


	/**
	 * Register the shortcode off of the init action
	 * @since 0.0.1
	 */
	public function register_shortcode() {

		add_shortcode( $this->slug, array( $this, 'render_shortcode' ) );

	} // End register_shortcode


	/**
	 * Render the shortcode
	 * @since 0.0.1
	 *
	 * @param array $atts Shortcode attributes
	 * @param string|null $content Shortcode content
	 * @param string $tag Shortcode tag (slug)
	 *
	 * @return string Shortcode html
	 */
	public function render_shortcode( $atts, $content, $tag ) {

		$html = '<div id="mapid" style="height: 500px;"></div>';

		$html .= '<script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script><script>';

		ob_start();

		include cmap_get_plugin_path( 'lib/shortcodes/cahnrs-map/cahnrs-map.js' );

		$html .= ob_get_clean();

		$html .= '</script>';

		return $html;

	} // End render_shortcode

} // End CAHNRS_Map_Shortcode

$cahnrswsupw_map_shortcode = new CAHNRS_Map_Shortcode();
