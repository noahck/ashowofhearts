<?php
/**
 * This file loads the css and js files
 *
 * @package      A Show of Hearts
 * 
 */

add_action( 'wp_enqueue_scripts', 'show_load_stylesheets' );
/**
 * Enqueue Fonts.
 */
function show_load_stylesheets() {

	wp_enqueue_style( 'google-fonts','//fonts.googleapis.com/css?family=Dancing+Script:400,700|Playfair+Display:400,400i,700|Montserrat:400,400i,500,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'fontawesome', '//maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css', array(), '4.4.0' );

}

add_action( 'wp_enqueue_scripts', 'show_load_scripts', 15 );
/**
 * Enqueue Scripts.
 */
function show_load_scripts() {

	if ( is_home() || is_archive() || is_search() ) {

		// Masonry.
		wp_enqueue_script( 'jquery-masonry' );
		wp_enqueue_script( 'masonry-init', get_stylesheet_directory_uri() . '/js/masonry-init.js' , array( 'jquery-masonry' ), '1.0', true );

		// Infinite Scroll.
		wp_enqueue_script( 'infinite-scroll', get_stylesheet_directory_uri() . '/js/jquery.infinitescroll.min.js' , array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'infinite-scroll-init', get_stylesheet_directory_uri() . '/js/infinitescroll-init.js' , array( 'jquery' ), '1.0', true );

	}

	wp_enqueue_script( 'global', get_stylesheet_directory_uri() . '/js/global.js' , array( 'jquery' ), '1.0', true );

	// Responsive Navigation.
	wp_enqueue_script( 'show-responsive-menu', CHILD_URL . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );
	$output = array();
	wp_localize_script( 'show-responsive-menu', 'plasticProL10n', $output );

}
