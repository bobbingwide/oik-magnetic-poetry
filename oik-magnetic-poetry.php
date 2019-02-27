<?php
/**
 * Plugin Name: oik-magnetic-poetry
 * Plugin URI: https://www.oik-plugins.com/oik-plugins/oik-magnetic-poetry
 * Description: Magnetic poetry block
 * Author: Herb Miller
 * Author URI: https://herbmiller.me/about/mick
 * Version: 0.0.0
 * License: GPL3+
 * License URI: https://www.gnu.org/licenses/gpl-3.0.txt
 *
 * @package oik-magnetic-poetry
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


function oik_magnetic_poetry_loaded() {
	add_action( "init", "oikmp_register_dynamic_blocks" );
	add_action( 'enqueue_block_assets', 'oikmp_enqueue_block_assets');
	add_action( 'enqueue_block_editor_assets', 'oikmp_enqueue_block_editor_assets' );
	add_action( "plugins_loaded", "oik_magnetic_poetry_plugins_loaded", 100 );
}

function oikmp_register_dynamic_blocks() {

	register_block_type( 'oik-block/magnetic-poetry',
		[ 'render_callback' => 'oikmp_dynamic_block_poetry'
		, 'editor_script' => 'oikmp-blocks-js'
		, 'editor_style'    => 'oikmp-poetry'
		, 'style'           => 'oikmp-poetry'
		, 'attributes' => [
				'content' => [ 'type' => 'string']
			]
		] );

}


/**
 * Register, but don't enqueue magnetic-poetry assets.
 *
 */

function oikmp_enqueue_block_assets() {
	bw_backtrace();
	$styles = array( 'oikmp-poetry'  => 'css/oik-magnetic-poetry.css' );

	foreach ( $styles as $name => $blockPath ) {

		wp_register_style( $name,
			plugins_url( $blockPath, __FILE__ ),
			[],
			//[ 'wp-blocks', 'wp-element', 'wp-components', 'wp-editor' ],
			filemtime( plugin_dir_path( __FILE__ ) . $blockPath )
		);
		//echo "$name $blockPath";
	}


}

function oikmp_enqueue_block_editor_assets() {

	oikmp_register_editor_scripts();
	oikmp_enqueue_block_assets();
}

/**
 * Registers the scripts we'll need	for the editor
 *
 * Not sure why we'll need Gutenberg scripts for the front-end.
 * But we might need Javascript stuff for some things, so these can be registered here.
 *
 * Dependencies were initially
                     * `[ 'wp-i18n', 'wp-element', 'wp-blocks', 'wp-components', 'wp-api' ]`
                     *
 * why do we need the dependencies?
 */
function oikmp_register_editor_scripts() {
	bw_trace2();
	bw_backtrace();


	$scripts = array( 'oikmp-blocks-js' => 'blocks/build/js/editor.blocks.js'
	);
	foreach ( $scripts as $name => $blockPath ) {
		wp_enqueue_script( $name,
			plugins_url( $blockPath, __FILE__ ),
			// [],
			[ 'wp-blocks', 'wp-element', 'wp-components', 'wp-editor' ],
			filemtime( plugin_dir_path(__FILE__) . $blockPath )
		);
		//echo "$name $blockPath";

	}

}

/**
 * Server rendering dynamic Magnetic Poetry block
 *
 * @param array $attributes
 * @return string generated HTML
 */
function oikmp_dynamic_block_poetry( $attributes ) {
	//bw_backtrace();
	wp_enqueue_style( 'oikmp-poetry' );
	$content = bw_array_get( $attributes, "content", null );
	bw_trace2( $content, "Content" );
	oik_require( "includes/oik-magnetic-poetry.php", "oik-magnetic-poetry" );
	$html = oikmp_poetry( $attributes, $content );
	bw_trace2( $html, "html", false );
	return $html;
}

/**
 * Implements 'plugins_loaded' action for oik-magnetic-poetry
 *
 * Prepares use of shared libraries if this has not already been done.
 */
function oik_magnetic_poetry_plugins_loaded() {
	oik_magnetic_poetry_boot_libs();
	oik_require_lib( "bwtrace" );
	oik_require_lib("bobbfunc");
}

/**
 * Boot up process for shared libraries
 *
 * ... if not already performed
 */
function oik_magnetic_poetry_boot_libs() {
	if ( !function_exists( "oik_require" ) ) {
		$oik_boot_file = __DIR__ . "/libs/oik_boot.php";
		$loaded = include_once( $oik_boot_file );
	}
	oik_lib_fallback( __DIR__ . "/libs" );
}

oik_magnetic_poetry_loaded();