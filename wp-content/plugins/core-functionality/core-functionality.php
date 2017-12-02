<?php
/**
 * Plugin Name: Core Functionality
 * Description: This contains all your site's core functionality so that it is theme independent. It is based on Bill Erickson's core functionality plugin: https://github.com/billerickson/Core-Functionality
 *
 * 
 *
 */

// Plugin Directory 
define( 'BE_DIR', dirname( __FILE__ ) );

require_once( BE_DIR . '/inc/general.php'              ); // General
require_once( BE_DIR . '/inc/cpt-episode.php'      ); // Testimonial CPT
