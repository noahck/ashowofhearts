<?php
/**
 * Plugin Name: Core Functionality
 * Description: This contains all your site's core functionality so that it is theme independent. It is based on Bill Erickson's core functionality plugin: https://github.com/billerickson/Core-Functionality
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

// Plugin Directory 
define( 'BE_DIR', dirname( __FILE__ ) );

require_once( BE_DIR . '/inc/general.php'              ); // General
require_once( BE_DIR . '/inc/cpt-episode.php'      ); // Testimonial CPT
//require_once( BE_DIR . '/inc/widget-sample.php'      ); // Sample Widget
