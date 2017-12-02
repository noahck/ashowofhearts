<?php
/**
 *
 * This file adds the default theme settings.
 *
 * @package      A Show of Hearts
 *
 */

// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

// Add Accessibility support.
add_theme_support( 'genesis-accessibility', array( 'headings', 'drop-down-menu', 'search-form', 'skip-links', 'rems' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom background.
add_theme_support( 'custom-background' );

// Add support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 2 );

// Image size masonry.
add_image_size( 'masonry-brick-image', 360, 270, true );
add_image_size( 'home-latest-episode', 560, 450, true);

// Remove the header right widget area.
unregister_sidebar( 'header-right' );

// Unregister secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Remove the site description.
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );

// Remove content/sidebar/sidebar layout.
genesis_unregister_layout( 'content-sidebar-sidebar' );

// Remove sidebar/sidebar/content layout.
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Remove sidebar/content/sidebar layout.
genesis_unregister_layout( 'sidebar-content-sidebar' );

// Position primary navigation.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 9 );

// Unregister secondary navigation menu.
add_theme_support( 'genesis-menus',
	array(
		'primary' => __( 'Primary Navigation Menu', 'genesis' ),
	)
);

// Reposition the breadcrumbs.
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'show_post_header', 'genesis_do_breadcrumbs', 50 );

// Remove entry footer.
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );



add_filter( 'genesis_post_meta', 'show_post_meta_filter' );
/**
 * Customize the post meta function depending on template type
 *
 * @param [type] $post_meta genesis post meta.
 * @return $post_meta
 */
function show_post_meta_filter( $post_meta ) {

	if ( is_archive () || is_home() ) {

	$post_meta = '[post_date] [post_categories before=""]';
	
	} else {
		
	$post_meta = '[post_comments zero="" one="1 Comment" more="% Comments"]';
	
	}	
	
	return $post_meta;


}


add_filter( 'genesis_post_info', 'show_post_info_filter' );

/**
 * Customize the post info function
 *
 * @param string $post_info post date, author, comments, edit.
 * @return $post_info
 */
function show_post_info_filter( $post_info ) {

	$post_info = '[post_date]';
	return $post_info;

}

add_action( 'genesis_header', 'show_hero_unit', 16 );
/**
 * Adds the Hero Unit
 *
 * @return void
 */
function show_hero_unit() {

	echo '<div class="hero-unit">';
	echo '<div class="wrap">';

	if ( is_page('home') ) {

		echo get_field( 'home_top_heading');
	
	} else {
		do_action( 'show_post_header' );
	}

	echo '</div></div></div>';

	if ( is_home() ) {
		genesis_widget_area( 'home_widget_3', array(
			'before' => '<div class="optin">',
			'after'  => '</div>',
		) );
	}

}

// Reposition header posts.
remove_action( 'genesis_entry_header', 'genesis_do_post_title', 10 );
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

add_action( 'show_post_header', 'genesis_do_post_title', 10 );
add_action( 'show_post_header', 'genesis_post_info', 5 );
add_action( 'show_post_header', 'genesis_entry_header_markup_open', 5 );
add_action( 'show_post_header', 'genesis_entry_header_markup_close', 15 );
add_action( 'show_post_header', 'genesis_post_meta', 12 );

add_action( 'genesis_before' , 'show_fix_search_results' );
function show_fix_search_results() {
if ( is_search() ) {
	add_action ( 'show_post_header', 'genesis_do_search_title' );
	remove_action( 'genesis_before_loop', 'genesis_do_search_title' );
	remove_action( 'show_post_header', 'genesis_do_post_title', 10 );
	remove_action( 'show_post_header', 'genesis_post_info', 5 );
	remove_action( 'show_post_header', 'genesis_entry_header_markup_open', 5 );
	remove_action( 'show_post_header', 'genesis_entry_header_markup_close', 15 );
	remove_action( 'show_post_header', 'genesis_post_meta', 12 );
}
}

// Filter read more link.
add_filter( 'get_the_content_more_link', 'show_more_link' );
add_filter( 'the_content_more_link', 'show_more_link' );
/**
 * Remove read more link if post type is quote.
 *
 * @return read more link
 */
function show_more_link() {

	if ( has_post_format( 'quote' ) ) {

		return'';

	} else {

		return '... <a class="more" href="' . get_permalink() . '" title="' . the_title_attribute( 'echo=0' ) . '" class="more-link">More ›</a>';
	}

}

add_action( 'genesis_before_header', 'show_featured_header', 5 );
/**
 * Featured image background hero unit
 */
function show_featured_header() {

	if ( is_singular( '' ) ) {

		if ( has_post_thumbnail() ) {

			global $post;
			$image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
			echo '<div class="hero-wrap" style="background-image: url(' . esc_url( $image ) . ')">';
		
		} else {
			
			$image = get_option( 'plastic-pro-front-image' );
			echo '<div class="hero-wrap" style="background-image: url(' . esc_url( $image ) . ')">';
		}
	
	} else {
		$image = get_option( 'plastic-pro-front-image' );
		echo '<div class="hero-wrap" style="background-image: url(' . esc_url( $image ) . ')">';
	}

}

add_action( 'show_post_header', 'show_entry_gravatar', 30 );
/**
 * Add gravatar to post header
 */
function show_entry_gravatar() {

	if ( is_singular( 'post' ) ) {
		
		echo '<div class="entry-avatar">';
		global $post;
		$author_id = $post->post_author;
		echo get_avatar( $author_id, 60 );
		echo '<a href="' . esc_attr( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename', $author_id ) ) ) . '">';
		echo '<span itemprop="author">by ' . esc_attr( get_the_author_meta( 'nickname', $author_id ) ) . '</span>';
		echo '</a></div>';
	}

}

add_filter( 'theme_page_templates', 'show_remove_genesis_page_templates' );
/**
 * Removes Archive Description & Title from Blog Page
 *
 * @param string $page_templates page templates.
 *
 * @return $page_templates
 */
function show_remove_genesis_page_templates( $page_templates ) {

	unset( $page_templates['page_blog.php'] );
	return $page_templates;

}

add_action( 'genesis_before', 'show_reposition_archive_description', 5 );
/**
 * Clear header and add archive description
 */
function show_reposition_archive_description() {

	if ( is_archive() || is_home () ) {
		remove_action( 'show_post_header', 'genesis_do_post_title', 10 );
		remove_action( 'show_post_header', 'genesis_post_info', 5 );
		remove_action( 'genesis_before_content', 'genesis_do_taxonomy_title_description', 15 );
		remove_action( 'show_post_header', 'genesis_entry_header_markup_open', 5 );
		remove_action( 'show_post_header', 'genesis_entry_header_markup_close', 15 );
		remove_action( 'show_post_header', 'genesis_post_meta', 12 );
		add_action( 'show_post_header', 'genesis_do_taxonomy_title_description', 15 );
	}

	if ( is_author() ) {
		remove_action( 'genesis_before_content', 'genesis_do_cpt_archive_title_description', 10 );
		remove_action( 'genesis_before_content', 'genesis_do_author_title_description', 15 );
		add_action( 'show_post_header', 'genesis_do_author_title_description', 10 );
	}

}

add_filter( 'genesis_nav_items', 'show_social_icons', 10, 2 );
add_filter( 'wp_nav_menu_items', 'show_social_icons', 10, 2 );

/**
 * Add social icons to nav.
 *
 * @param string $menu markup navigation.
 * @param object $args navigation.
 * @return $menu + $social
 */
function show_social_icons( $menu, $args ) {

	$args = (array) $args;
	if ( 'primary' !== $args['theme_location'] ) {

		return $menu;

	} else {

		ob_start();
		genesis_widget_area( 'nav-social-menu' );
		$social = ob_get_clean();
		return $menu . $social;

	}

}

add_action( 'genesis_before_footer', 'show_widget_above_footer', 5 );
/**
 * Add widget area above footer
 */
function show_widget_above_footer() {

	genesis_widget_area( 'above_footer', array(
		'before' => '<div class="pre-footer"><div class="wrap">',
		'after'  => '</div></div>',
	) );

}

add_shortcode( 'btn', 'show_shortcode_btn' );
/**
 * Shortcode for color button.
 *
 * @param array  $link link value.
 *
 * @param string $content button text.
 */
function show_shortcode_btn( $link, $content = null ) {

		return '<a class="button" href="' . esc_url( $link['link'] ) . '"><span>' . do_shortcode( $content ) . '</span></a>';

}

add_shortcode( 'btn-light', 'show_shortcode_btn_light' );
/**
 * Shortcode for color button light.
 *
 * @param array  $link link value.
 *
 * @param string $content button text.
 */
function show_shortcode_btn_light( $link, $content = null ) {

		return '<a class="button-light" href="' . esc_url( $link['link'] ) . '"><span>' . do_shortcode( $content ) . '</span></a>';

}

add_shortcode( 'btn-dark', 'show_shortcode_btn_dark' );
/**
 * Shortcode for color button dark.
 *
 * @param array  $link link value.
 *
 * @param string $content button text.
 */
function show_shortcode_btn_dark( $link, $content = null ) {

		return '<a class="button-dark" href="' . esc_url( $link['link'] ) . '"><span>' . do_shortcode( $content ) . '</span></a>';

}



/**
 *
 * Offset the main query on episode and blog archives to display first post in header
 *
 */
function show_query_offset(&$query) {

    if ( ( $query->is_post_type_archive('episode') || $query->is_home() ) && $query->is_main_query() && ! is_admin() ) {

        // First, define your desired offset...
        $offset = 1;

        // Next, determine how many posts per page you want (we'll use WordPress's settings)
        $ppp = get_option('posts_per_page');

        // Next, detect and handle pagination...
        if ( $query->is_paged ) {

            // Manually determine page query offset (offset + current page (minus one) x posts per page)
            $page_offset = $offset + ( ($query->query_vars['paged']-1) * $ppp );

            // Apply adjust page offset
            $query->set('offset', $page_offset );

        }
        else {

            // This is the first page. Just use the offset...
            $query->set('offset',$offset);

        }

    } else {

        return;

    }
}

add_action('pre_get_posts', 'show_query_offset', 1 );

/**
 *
 * Adjust the found_posts according to our offset.
 * Used for our pagination calculation.
 *
 */
function show_adjust_offset_pagination($found_posts, $query) {

    // Define our offset again...
    $offset = 1;

    // Ensure we're modifying the right query object...
    if ( ( $query->is_post_type_archive('episode') || $query->is_home() )  && $query->is_main_query() && !is_admin() ) {
        // Reduce WordPress's found_posts count by the offset... 
        return $found_posts - $offset;
    }
    return $found_posts;
}
add_filter('found_posts', 'show_adjust_offset_pagination', 1, 2 );


/*
 * Set up about submenu for about pages
 */


// first create function to check if we are on a child page of a parent ID
function show_is_child($pageid) { 
    global $post; 
    if( is_page() && ($post->post_parent == $pageid) ) {
       return true; // is child
    } else { 
       return false; // not child
    }
}

// add section menu for about pages
add_action( 'genesis_before_entry' , 'show_section_menu');
function show_section_menu() {
	if ( is_page( 'about' ) || show_is_child(2) ) {
		echo '<div class="wrap about-menu">';
		wp_nav_menu( array( 'menu'   => 'About') );
		echo '</div>';
	}
}

/*
 * Include Episodes in Category Archives
 */

add_filter( 'pre_get_posts', 'show_add_custom_types' );

function show_add_custom_types( $query ) {
  if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
    $query->set( 'post_type', array(
     'post', 'nav_menu_item', 'episode'
		));
	  return $query;
	}
}

/*
 * Add Filter by category links and search to top of archive pages
 */

add_action( 'genesis_after_header' , 'show_category_filter', 10 );
function show_category_filter() {

	if ( is_archive()|| is_home() || is_search() ) {

	global $post;
	$terms = get_terms( 'category' );
		if ( $terms ) { ?>
			<div class="topics" class="filter clearfix">
				<div class="wrap">
					<div class="filter-topics three-fourths first">
						Topics: <?php foreach ( $terms as $term ) : $term_link = get_term_link( $term );?> <a href='<?php echo esc_url( $term_link )?>'><?php echo esc_html( $term->name ); ?></a><?php endforeach; ?>
					 <?php
					if ( is_category() || is_search() ) { ?>
					<span class="all-topics">View all: <a href="/episodes">Episodes</a> <a href="/blog">Articles</a></span> <?php } ?>
					</div>
					<div class="one-fourth">
						<form id="searchform" itemprop="potentialAction" itemscope="" itemtype="https://schema.org/SearchAction" method="get" action="<?php echo home_url('/'); ?>">
					    <input type="text" class="search-field" name="s" placeholder="Search" value="<?php the_search_query(); ?>">
					    <input type="submit" class="search-button" value="›">
						</form>
					</div>
				</div>
			</div>
			<?php 
		}	
	} else {
		return;
	}
}

/*
 *  Add post Subtitles
 */ 

add_action ( 'genesis_entry_header' , 'show_post_subtitle' );
function show_post_subtitle() {

	if ( !is_singular() ) { return; }
	if ( is_singular() && get_field ('show_content_subtitle') !== '' ) {
		echo '<span class="subtitle">'. get_field( 'show_content_subtitle' ) . '</span>';
	}
}

/*
 * Modify Search Paramaters
 */

if (!is_admin()) {
	function show_search_filter($query) {
	if ($query->is_search) {
		$query->set('post_type', array( 'post', 'episode' ));
		}
	return $query;
	}
	add_filter('pre_get_posts','show_search_filter');
}

/* 
 * Modify comments title output
 */

add_filter( 'genesis_title_comments', 'sp_genesis_title_comments' );
function sp_genesis_title_comments() {
	$title = '<div class="comments-title"><h3>Comments</h3><a class="respond" href="#respond">Leave a comment</a></div>';
	return $title;
}

/**
	 * Disable ACF on Frontend
	 *
	 */
	function ea_disable_acf_on_frontend( $plugins ) {
	
		if( is_admin() )
			return $plugins;
	
		foreach( $plugins as $i => $plugin )
			if( 'advanced-custom-fields-pro/acf.php' == $plugin )
				unset( $plugins[$i] );
		return $plugins;
	}
	add_filter( 'option_active_plugins', 'ea_disable_acf_on_frontend' );
