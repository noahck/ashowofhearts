<?php
/**
 * This file adds the footer credits.
 *
 * @package      A Show of Hearts
 * 
 */

add_filter( 'genesis_footer_creds_text', 'show_footer_creds_text' );
/**
 * Customize the credits
 */
function show_footer_creds_text() {

	$creds = '[footer_copyright] &middot; <a href="https://ashowofhearts.com" title="A Show of Hearts">A Show of Hearts</a>';
	return $creds;

}
