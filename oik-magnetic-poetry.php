<?php
/**
 * Plugin Name: oik-magnetic-poetry
 * Plugin URI: https://www.oik-plugins.com/oik-plugins/oik-magnetic-poetry
 * Description: Magnetic poetry block
 * Author: Herb Miller
 * Author URI: https://herbmiller.me/author/herb
 * Version: 0.3.0
 * License: GPL3+
 * License URI: https://www.gnu.org/licenses/gpl-3.0.txt
 *
 * @package oik-magnetic-poetry
 *
(C) Copyright 2018-2023 Bobbing Wide (email : herb@bobbingwide.com )

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License version 2,
as published by the Free Software Foundation.

You may NOT assume that you can use any other version of the GPL.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

The license for this software can likely be found here:
http://www.gnu.org/licenses/gpl-2.0.html
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Function to invoke when the plugin's loaded.
 */
function oik_magnetic_poetry_loaded() {
	add_action( "init", "oikmp_register_dynamic_blocks" );
	add_action( "plugins_loaded", "oik_magnetic_poetry_plugins_loaded", 100 );
}

/**
 * Registers the Magnetic Poetry block.
 */
function oikmp_register_dynamic_blocks() {
	$args = [ 'render_callback' => 'oikmp_dynamic_block_poetry'];
	$registered = register_block_type_from_metadata( __DIR__ . '/src/oik-magnetic-poetry', $args );
	//bw_trace2( $registered, "registered", false );
	/**
	 * Localise the script by loading the required strings for the build/index.js file
	 * from the locale specific .json file in the languages folder.
	 */
	$ok = wp_set_script_translations( 'oik-mp-magnetic-poetry-editor-script', 'oik-magnetic-poetry' , __DIR__ .'/languages' );
	add_filter( 'load_script_textdomain_relative_path', 'oikmp_load_script_textdomain_relative_path', 10, 2);
}

/**
 * Filters $relative so that md5's match what's expected.
 *
 * Depending on how it was built the `build/index.js` may be preceded by `./` or `src/block-name/../../`.
 * In either of these situations we want the $relative value to be returned as `build/index.js`.
 * This then produces the correct md5 value and the .json file is found.
 *
 * @param $relative
 * @param $src
 *
 * @return mixed
 */
function oikmp_load_script_textdomain_relative_path( $relative, $src ) {
	if ( false !== strrpos( $relative, './build/index.js' )) {
		$relative = 'build/index.js';
	}
	//bw_trace2( $relative, "relative");
	return $relative;
}

/**
 * Server rendering dynamic Magnetic Poetry block.
 *
 * @param array $attributes
 * @return string generated HTML
 */
function oikmp_dynamic_block_poetry( $attributes ) {
	//bw_backtrace();
	wp_enqueue_style( 'oikmp-poetry' );
	$content = bw_array_get( $attributes, "content", null );
	//bw_trace2( $content, "Content" );
	oik_require( "includes/oik-magnetic-poetry.php", "oik-magnetic-poetry" );
	$html = oikmp_poetry( $attributes, $content );
	$html = oikmp_server_side_wrapper( $attributes, $html );
	//bw_trace2( $html, "html", false );
	return $html;
}

function oikmp_server_side_wrapper( $attributes, $html ) {
	$align_class_name=empty( $attributes['textAlign'] ) ? '' : "has-text-align-{$attributes['textAlign']}";
	$extra_attributes  =[ 'class'=>$align_class_name ];
	$wrapper_attributes = get_block_wrapper_attributes( $extra_attributes );

	$html=sprintf(
		'<div %1$s>%2$s</div>',
		$wrapper_attributes,
		$html
	);

	return $html;
}

/**
 * Implements 'plugins_loaded' action for oik-magnetic-poetry.
 *
 * Prepares the use of shared libraries if this has not already been done.
 */
function oik_magnetic_poetry_plugins_loaded() {
	oik_magnetic_poetry_boot_libs();
	oik_require_lib( "bwtrace" );
	oik_require_lib( "bobbfunc" );
	bw_load_plugin_textdomain( "oik-magnetic-poetry");
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
