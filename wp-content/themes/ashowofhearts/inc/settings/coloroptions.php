<?php
/**
 * This file adds the color functions.
 *
 * @package      Plastic Pro
 * @link         https://www.showtud.io/themes
 * @author       Frank Schrijvers || showtudio
 * @copyright    Copyright (c) 2017, showtudio
 * @license      GPL-2.0+
 */

add_action( 'customize_register', 'show_colors' );
/**
 * Add customizer color options.
 *
 * @param object $wp_customize WP_Customize_Manager.
 *
 * @return void
 */
function show_colors( $wp_customize ) {

	$wp_customize->add_section(
		'showtudio_theme_colors',
		array(
			'title' => 'Accent colors',
			'description' => 'Change the default accent color.',
			'priority' => 35,
		)
	);

	// add color picker setting.
	$wp_customize->add_setting( 'accent_color',
		array(
			'default' => '#f42156',
		)
	);

	// add color picker control.
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'link_color',
			array(
				'label'     => 'Accent Color',
				'section'   => 'showtudio_theme_colors',
				'settings'  => 'accent_color',
			)
		)
	);

}

add_action( 'wp_head', 'show_customizer_head_styles' );
/**
 * Add inline CSS
 *
 * @return void
 */
function show_customizer_head_styles() {

	$accent_color = get_theme_mod( 'accent_color' );

	if ( '#f42156' !== $accent_color ) :
	?>
					<style type="text/css">
				a,
				.entry-title a:hover, .entry-title a:focus,
				.genesis-nav-menu a:focus, .genesis-nav-menu a:hover,
				.genesis-nav-menu .current-menu-item > a,
				.genesis-nav-menu .sub-menu .current-menu-item > a,
				.genesis-nav-menu a:focus, .genesis-nav-menu a:hover,
				.genesis-nav-menu .current-menu-item:not(.highlight) > a,
				.genesis-nav-menu .sub-menu a:hover,
				.menu-toggle:hover, .menu-toggle:focus  {
					color: <?php echo esc_attr( $accent_color ); ?>;
				}
				.masonry-page .content .more-link:hover	{
					border-color: <?php echo esc_attr( $accent_color ); ?>;
				}
				.genesis-nav-menu .highlight a,
				.masonry-page .content .more-link:hover,
				.pre-footer .enews input[type="submit"],
				.optin .widget-title:after,
				.archive-title:after,
				.sharrre:hover {
					background: <?php echo esc_attr( $accent_color ); ?>;
				}

				button:hover, input:hover[type="button"],
				input:hover[type="reset"], input:hover[type="submit"],
				.button:hover, button:focus,
				input:focus[type="button"], input:focus[type="reset"],
				input:focus[type="submit"], .button:focus,
				.enews-widget input[type="submit"] {
					background-color: <?php echo esc_attr( $accent_color ); ?>;
				}
				button, input[type="button"],
				input[type="reset"], input[type="submit"], .button {
					background-color: <?php echo esc_attr( $accent_color ); ?>;
				}


			</style>
	<?php
	endif;

}
