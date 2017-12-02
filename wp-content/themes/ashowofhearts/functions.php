<?php
/**
 * A Show of Hearts THEME
 *
 * @package      A Show of Hearts
 * @link         https://ashowofhearts.com
 * @author       Noah Kramer
 * 
 */

// Initialize Genesis.
include_once( get_template_directory() . '/lib/init.php' );

// Child theme (do not remove).
define( 'CHILD_THEME_NAME', 'A Show of Hearts' );
define( 'CHILD_THEME_URL', 'https://ashowofhearts/' );
define( 'CHILD_THEME_VERSION', '1.0' );


// Genesis.
require_once( CHILD_DIR . '/inc/genesis.php' );

// Structure.
require_once( CHILD_DIR . '/inc/structure/header.php' );
require_once( CHILD_DIR . '/inc/structure/masonry.php' );
require_once( CHILD_DIR . '/inc/structure/widgets.php' );
require_once( CHILD_DIR . '/inc/structure/footer.php' );

// Theme settings.
require_once( CHILD_DIR . '/inc/settings/customize.php' );
require_once( CHILD_DIR . '/inc/settings/coloroptions.php' );
require_once( CHILD_DIR . '/inc/settings/setlogo.php' );
