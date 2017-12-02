<?php
/**
 * This file adds the widget areas.
 *
 * @package      A Show of Hearts
 * 
 */


// Social menu widget.
genesis_register_sidebar( array(
	'id'          => 'nav-social-menu',
	'name'        => __( 'Social Menu', 'ashowofhearts' ),
	'description' => __( 'This is the nav social menu section.', 'plastic-pro' ),
) );

// Above footer widget.
genesis_register_sidebar( array(
	'id'          => 'above_footer',
	'name'        => __( 'Before Footer', 'ashowofhearts' ),
	'description' => __( 'This is the section abvoe the footer.', 'plastic-pro' ),
) );

// Home Latest Articles
genesis_register_sidebar( array(
	'id'          => 'home-latest-articles',
	'name'        => __( 'Home Latest Articles', 'ashowofhearts' ),
	'description' => __( 'This is the Front Page articles area.', 'ashowofhearts' ),
) );