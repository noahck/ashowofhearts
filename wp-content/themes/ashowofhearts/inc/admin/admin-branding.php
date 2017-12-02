<?php
/**
 *
 * This file adds the admin panel box.
 *
 * @package      Plastic Pro
 * @link         https://www.wpstud.io/themes
 * @author       Frank Schrijvers || WPStudio
 * @copyright    Copyright (c) 2017, WPStudio
 * @license      GPL-2.0+
 */

add_filter( 'admin_footer_text', 'wps_modify_footer_admin' );
/**
 * Modify the admin footer text
 */
function wps_modify_footer_admin() {

	echo '<span id="footer-thankyou">Theme Development by <a href="http://www.wpstud.io" target="_blank">WPStudio - Genesis Themes & Plugins</a></span>';

}

add_action( 'wp_dashboard_setup', 'wps_add_dashboard_widgets' );
/**
 * Add infomation box to admin screen
 */
function wps_add_dashboard_widgets() {

	add_meta_box( 'my_dashboard_widget', 'WPSTUDIO - Theme details', 'wps_dashboard_widget_function', 'dashboard', 'side', 'high' );

}
/**
 * Add dashboard widget.
 */
function wps_dashboard_widget_function() {

	echo '<style> .wpstudio-widget strong { display: inline-block; min-width: 150px; margin-left: 5px; } .wpstudio-widget li { margin-bottom: 10px; } </style>';
	echo '<div class="wpstudio-widget">';
	echo '<a href="http://www.wpstud.io"><img src="https://www.wpstud.io/wp-content/themes/wpstudio-stars-theme/images/logo-new.png"></a>';
	echo '<ul>';
	echo '<li><span class="dashicons dashicons-admin-site"></span><strong>Website</strong> <a href="http://www.wpstud.io">www.wpstud.io</a></li>';
	echo '<li><span class="dashicons dashicons-email"></span><strong>Contact</strong> <a href="mailto:info@wpstud.io">info@wpstud.io</a></li>';
	echo '<li><span class="dashicons dashicons-twitter"></span><strong>Twitter</strong> <a href="https://twitter.com/wpstudiowp">https://twitter.com/wpstudiowp</a></li>';
	echo '<li><span class="dashicons dashicons-facebook-alt"></span><strong>Facebook</strong> <a href="https://www.facebook.com/wpstudiowp">https://www.facebook.com/wpstudiowp</a></li>';
	echo '<li><span class="dashicons dashicons-editor-help"></span></span><strong>Support</strong> <a href="https://www.wpstud.io/setup-and-support/">https://www.wpstud.io/setup-and-support/</a></li>';
	echo'</ul>';
	echo '</div>';

}
