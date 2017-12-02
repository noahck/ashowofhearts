<?php
/**
 *
 * This file adds the default theme settings.
 *
 * @package      A Show of Hearts
 * 
 */

add_filter( 'simple_social_default_styles', 'show_default_style' );
/**
 * Default Simple Social Icon Styles
 *
 * @param array $defaults default settings.
 */
function show_default_style( $defaults ) {

	$args = array(

		'size'                   => 32,
		'border_radius'          => 0,
		'border_width'           => 0,
		'icon_color'             => '#8a959e',
		'icon_color_hover'       => '#8a959e',
		'background_color'       => '#ffffff',
		'background_color_hover' => '#ffffff',
		'alignment'              => 'alignleft',
		'new_window'             => 1,

	);

	$args = wp_parse_args( $args, $defaults );

	return $args;

}

add_action( 'after_switch_theme', 'show_theme_setting_defaults' );
/**
 * Updates theme settings on activation.
 */
function show_theme_setting_defaults() {

	if ( function_exists( 'genesis_update_settings' ) ) {

		genesis_update_settings( array(
			'blog_cat_num'              => 6,
			'content_archive_limit'     => 'full',
			'content_archive_limit'     => 200,
			'content_archive_thumbnail' => 0,
			'image_alignment'           => 'alignleft',
			'image_size'                => 'entry-image',
			'posts_nav'                 => 'prev-next',
		) );

	} else {

		_genesis_update_settings( array(
			'blog_cat_num'              => 6,
			'content_archive_limit'     => 'full',
			'content_archive_limit'     => 200,
			'content_archive_thumbnail' => 0,
			'image_alignment'           => 'alignleft',
			'image_size'                => 'entry-image',
			'posts_nav'                 => 'prev-next',
		) );

	}

	update_option( 'posts_per_page', 6 );

}
