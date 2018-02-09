<?php
/**
 * Core Functionality Plugin
 * 
 * @package    CoreFunctionality
 * 
 */

 
 /**
 * Dont Update the Plugin
 * If there is a plugin in the repo with the same name, this prevents WP from prompting an update.
 *
 * @since  1.0.0
 * @author Jon Brown
 * @param  array $r Existing request arguments
 * @param  string $url Request URL
 * @return array Amended request arguments
 */
function be_dont_update_core_func_plugin( $r, $url ) {
  if ( 0 !== strpos( $url, 'https://api.wordpress.org/plugins/update-check/1.1/' ) )
    return $r; // Not a plugin update request. Bail immediately.
    $plugins = json_decode( $r['body']['plugins'], true );
    unset( $plugins['plugins'][plugin_basename( __FILE__ )] );
    $r['body']['plugins'] = json_encode( $plugins );
    return $r;
 }
add_filter( 'http_request_args', 'be_dont_update_core_func_plugin', 5, 2 );

// Use shortcodes in widgets
add_filter( 'widget_text', 'do_shortcode' );

/**
 * Pretty Printing
 * 
 * @author Chris Bratlien
 *
 * @param mixed
 * @return null
 */
function be_pp( $obj, $label = '' ) {  

	$data = json_encode(print_r($obj,true));
    ?>
    <style type="text/css">
      #bsdLogger {
      position: absolute;
      top: 30px;
      right: 0px;
      border-left: 4px solid #bbb;
      padding: 6px;
      background: white;
      color: #444;
      z-index: 999;
      font-size: 1.25em;
      width: 400px;
      height: 800px;
      overflow: scroll;
      }
    </style>    
    <script type="text/javascript">
      var doStuff = function(){
        var obj = <?php echo $data; ?>;
        var logger = document.getElementById('bsdLogger');
        if (!logger) {
          logger = document.createElement('div');
          logger.id = 'bsdLogger';
          document.body.appendChild(logger);
        }
        ////console.log(obj);
        var pre = document.createElement('pre');
        var h2 = document.createElement('h2');
        pre.innerHTML = obj;
 
        h2.innerHTML = '<?php echo addslashes($label); ?>';
        logger.appendChild(h2);
        logger.appendChild(pre);      
      };
      window.addEventListener ("DOMContentLoaded", doStuff, false);
 
    </script>
    <?php
}

// Don't let WPSEO metabox be high priority
add_filter( 'wpseo_metabox_prio', function(){ return 'low'; } );

/**
 * Remove WPSEO Notifications
 *
 */
function ea_remove_wpseo_notifications() {

	if( ! class_exists( 'Yoast_Notification_Center' ) )
		return;
		
	remove_action( 'admin_notices', array( Yoast_Notification_Center::get(), 'display_notifications' ) );
	remove_action( 'all_admin_notices', array( Yoast_Notification_Center::get(), 'display_notifications' ) );
}
add_action( 'init', 'ea_remove_wpseo_notifications' );

/**
 * Gravity Forms Domain
 *
 * Adds a notice at the end of admin email notifications 
 * specifying the domain from which the email was sent.
 *
 * @param array $notification
 * @param object $form
 * @param object $entry
 * @return array $notification
 */
function ea_gravityforms_domain( $notification, $form, $entry ) {

	if( $notification['name'] == 'Admin Notification' ) {
		$notification['message'] .= 'Sent from ' . home_url();
	}

	return $notification;
}
add_filter( 'gform_notification', 'ea_gravityforms_domain', 10, 3 );

//Update Post Lables
function show_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Episodes';
    $submenu['edit.php'][5][0] = 'Episodes';
    $submenu['edit.php'][10][0] = 'Add Episode';
    $submenu['edit.php'][16][0] = 'Episode Tags';
}
function show_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Episodes';
    $labels->singular_name = 'Episode';
    $labels->add_new = 'Add Episode';
    $labels->add_new_item = 'Add Episode';
    $labels->edit_item = 'Edit Episode';
    $labels->new_item = 'Episode';
    $labels->view_item = 'View Episode';
    $labels->search_items = 'Search Episode';
    $labels->not_found = 'No Episodes found';
    $labels->not_found_in_trash = 'No Episodes found in Trash';
    $labels->all_items = 'All Episodes';
    $labels->menu_name = 'Episodes';
    $labels->name_admin_bar = 'Episodes';
}
 
add_action( 'admin_menu', 'show_change_post_label' );
add_action( 'init', 'show_change_post_object' );