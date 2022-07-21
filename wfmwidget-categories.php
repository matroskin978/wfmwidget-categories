<?php

/*
Plugin Name: WFM Categories Widget
Plugin URI: https://webformyself.com
Description: Categories Widget description...
Version: 1.0
Author: Andrey Kudlay
Author URI: https://webformyself.com
Text Domain: wfmcats
Domain Path: /languages
*/

// https://developer.wordpress.org/block-editor/how-to-guides/block-tutorial/creating-dynamic-blocks/
// http://www.designchemical.com/lab/jquery-vertical-accordion-menu-plugin/getting-started/

defined( 'ABSPATH' ) or die;

define( 'WFMCATS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

add_action( 'init', 'wfmwidget_block' );
function wfmwidget_block() {
	if ( ! function_exists( 'register_block_type' ) ) {
		return;
	}

	wp_register_script( 'wfmwidget-block', plugins_url( 'block/block.js', __FILE__ ), array(
		'wp-blocks',
		'wp-element',
		'wp-editor'
	) );
	wp_register_script( 'wfmwidget-cookie', plugins_url( 'block/jquery.cookie.js', __FILE__ ) );
	wp_register_script( 'wfmwidget-hoverIntent', plugins_url( 'block/jquery.hoverIntent.minified.js', __FILE__ ) );
	wp_register_script( 'wfmwidget-accordion', plugins_url( 'block/jquery.accordion.js', __FILE__ ) );
	wp_register_script( 'wfmwidget-main', plugins_url( 'block/wfmwidget-main.js', __FILE__ ), array(
		'jquery',
		'wfmwidget-cookie',
		'wfmwidget-hoverIntent',
		'wfmwidget-accordion'
	) );

	wp_register_style( 'wfmwidget-block-editor', plugins_url( 'block/editor.css', __FILE__ ) );
	wp_register_style( 'wfmwidget-block-style', plugins_url( 'block/style.css', __FILE__ ) );

	register_block_type( 'wfmwidget-block/block', array(
		'editor_script'   => 'wfmwidget-block',
		'editor_style'    => 'wfmwidget-block-editor',
		'style'           => 'wfmwidget-block-style',
		'script'          => 'wfmwidget-main',
		'render_callback' => 'wfmwidget_block_cb',
	) );
}

function wfmwidget_block_cb( $block_attributes, $content ) {
	$class = empty( $block_attributes['className'] ) ? '' : esc_html( $block_attributes['className'] );
	$categories = wp_list_categories( array(
		'echo'     => false,
		'title_li' => '',
	) );
	$html       = '<ul class="wfmcats-accordion ' . $class . '">';
	$html       .= $categories;
	$html       .= '</ul>';

	return $html;
}

/*add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_script( 'wfmwidget-block-front', plugins_url( 'block/test.js', __FILE__ ) );
} );*/
