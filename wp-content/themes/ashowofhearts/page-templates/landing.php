<?php
/**
 * This file adds the Landing template to the Plastic Pro theme.
 *
 * @package      Plastic Pro
 * @link         https://www.wpstud.io/themes
 * @author       Frank Schrijvers || WPStudio
 * @copyright    Copyright (c) 2017, WPStudio
 * @license      GPL-2.0+
 */

/*
Template Name: Landing
*/

add_filter( 'body_class', 'wps_add_body_class' );
/**
 *  Add landing page body class to the head.
 *
 *  @param array $classes the info uses to create the body class.
 */
function wps_add_body_class( $classes ) {

	$classes[] = 'plastic-landing';
	return $classes;

}

// Force full width layout setting.
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// Remove site header elements.
remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );
remove_action( 'genesis_header', 'genesis_do_nav', 12 );

// Remove custom page header.
remove_action( 'wps_post_header', 'genesis_do_post_title', 10 );
remove_action( 'wps_post_header', 'genesis_post_info', 12 );
remove_action( 'wps_post_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'wps_post_header', 'genesis_entry_header_markup_close', 15 );
remove_action( 'wps_post_header', 'genesis_post_meta', 5 );

// Add default entry header elements.
add_action( 'genesis_entry_header', 'genesis_do_post_title', 10 );
add_action( 'genesis_entry_header', 'genesis_post_info', 12 );
add_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
add_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

remove_action( 'genesis_after_header', 'wps_hero_unit' );
remove_action( 'genesis_before_header', 'wps_featured_header', 5 );
remove_action( 'genesis_before_footer', 'wps_widget_above_footer', 5 );
remove_action( 'wps_post_header', 'genesis_do_breadcrumbs', 50 );
remove_action( 'wps_post_header', 'wps_entry_gravatar', 30 );

// Remove breadcrumbs.
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

// Remove site footer widgets.
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );

// Remove site footer elements.
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

// Run the Genesis loop.
genesis();
