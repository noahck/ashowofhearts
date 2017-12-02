<?php
/**
 * This file adds the Customizer additions.
 *
 * @package      A Show of Hearts
 *
 */

add_action( 'customize_register', 'wps_customizer_register' );
/**
 * Register settings and controls with the Customizer.
 *
 * @since 1.0.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function wps_customizer_register( WP_Customize_Manager $wp_customize ) {

	$wp_customize->add_section( 'plastic-pro-image', array(
		'title'             => __( 'Default Header Image', 'plastic-pro' ),
		'description'       => __( '<p>Use the default image or personalize your site by uploading your own header image.</p><p>The default image is <strong>1600 x 900 pixels</strong>.</p>', 'plastic-pro' ),
		'priority'          => 30,
	) );

	$wp_customize->add_setting( 'plastic-pro-front-image', array(
		'default'           => sprintf( '%s/images/default-bg.jpg', get_stylesheet_directory_uri() ),
		'type'              => 'option',
	) );

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'front-background-image',
			array(
				'label'      => __( 'Front Image Upload', 'plastic-pro' ),
				'section'    => 'plastic-pro-image',
				'settings'   => 'plastic-pro-front-image',
			)
		)
	);

	$wp_customize->add_section( 'wps_theme_colors', array(
		'title'             => 'Accent colors',
		'description'       => 'Change the default accent color.',
		'priority'          => 35,
	) );

	$wp_customize->add_setting( 'accent_color', array(
		'default'           => '#f42156',
	) );

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'link_color',
			array(
				'label'     => 'Accent Color',
				'section'   => 'wps_theme_colors',
				'settings'  => 'accent_color',
			)
		)
	);

}
