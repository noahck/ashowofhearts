<?php
/**
 *
 * This file adds the logo functions.
 *
 * @package      A Show of Hearts
 * 
 */

add_theme_support( 'custom-logo', array(
	'height'      => 100,
	'width'       => 480,
	'flex-height' => true,
	'flex-width'  => true,
) );

add_filter( 'genesis_seo_title','show_custom_logo', 10, 3 );
/**
 * Replace title for logo
 *
 * @param string $title Site title.
 * @param string $inside Page URL.
 * @param string $wrap wrapper.
 * @return $title.
 */
function show_custom_logo( $title, $inside, $wrap ) {

	if ( function_exists( 'has_custom_logo' ) && has_custom_logo() ) :
		$logo   = the_custom_logo();
	else :
		$logo   = get_bloginfo( 'name' );
	endif;
	 $inside    = sprintf( '<a href="%s" title="%s">%s</a>', trailingslashit( home_url() ), esc_attr( get_bloginfo( 'name' ) ), $logo );
	 $wrap      = is_front_page() && 'title' === genesis_get_seo_option( 'home_h1_on' ) ? 'h1' : 'p';
	 $wrap      = is_front_page() && ! genesis_get_seo_option( 'home_h1_on' ) ? 'h1' : $wrap;
	 $wrap      = genesis_html5() && genesis_get_seo_option( 'semantic_headings' ) ? 'h1' : $wrap;
	 $title     = sprintf( '<%1$s %2$s>%3$s</%1$s>', $wrap, genesis_attr( 'site-title' ), $inside );
	 return $title;

}

/**
 * Wrap the logo markup and add an itemtyp
 */
add_filter( 'get_custom_logo', function( $html ) {
	return sprintf(
		'<div itemscope itemtype="%1$s">%2$s</div>',
		esc_url( 'https://schema.org/Brand' ),
		$html
	);
});

add_action( 'genesis_theme_settings_metaboxes', 'show_remove_metaboxes' );
/**
 * Removing custom title/logo metabox from Genesis theme options page.
 *
 * @param mixed $_genesis_admin_settings genesis admin settings.
 */
function show_remove_metaboxes( $_genesis_admin_settings ) {

	remove_meta_box( 'genesis-theme-settings-header', $_genesis_admin_settings, 'main' );

}

add_action( 'customize_register', 'show_theme_customize_register', 99 );
/**
 * Removing blog title from customizer.
 *
 * @param mixed $wp_customize customizer settings.
 */
function show_theme_customize_register( $wp_customize ) {

	$wp_customize->remove_control( 'blog_title' );

}
