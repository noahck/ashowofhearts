<?php
/**
 * This fila adds the masonry layout
 *
 * @package      A Show of Hearts
 *
 */

add_filter( 'body_class', 'show_body_class' );
/**
 *  Add landing page body class to the head.
 *
 *  @param array $classes the info uses to create the body class.
 */
function show_body_class( $classes ) {

	if ( is_home() || is_archive() || is_search() ) {
		$classes[] = 'masonry-page';
		return $classes;
	} else {

		return $classes;
	}

}



add_action( 'genesis_meta','show_masonry_layout' );
/**
 * Display masonry brick
 */
function show_masonry_layout() {

	if ( is_home() || is_archive() || is_category () || is_search() ) {
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

		remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
		remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
		remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
		remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

		remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
		remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

		remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
		remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
		remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

		add_action( 'genesis_entry_content', 'show_masonry_block_post_image', 8 );
		add_action( 'genesis_entry_content', 'show_masonry_title_content', 9 );

		remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
		add_action( 'genesis_before_content', 'genesis_do_breadcrumbs' );

		remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );
		add_action( 'genesis_before_content', 'genesis_do_taxonomy_title_description', 15 );

		remove_action( 'genesis_before_loop', 'genesis_do_author_title_description', 15 );
		add_action( 'genesis_before_content', 'genesis_do_author_title_description', 15 );

		remove_action( 'genesis_before_loop', 'genesis_do_author_box_archive', 15 );
		add_action( 'genesis_before_content', 'genesis_do_author_box_archive', 15 );

		remove_action( 'genesis_before_loop', 'genesis_do_cpt_archive_title_description' );
		add_action( 'genesis_before_content', 'genesis_do_cpt_archive_title_description' );

		remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );
		add_action( 'genesis_after_content', 'genesis_posts_nav' );

		remove_action( 'genesis_after_post_content', 'genesis_post_meta' );
		add_action ('genesis_after_content', 'show_load_more_button');
	}
}


/*
* Display the kind of post this is
*/

function show_content_post_type() {

	if ( 'post' == get_post_type() ) {
		$postType = 'Episode';
	}
	
	else if ( 'article' == get_post_type() ) {
		$postType = 'Article';
	}

	else { return; 

	}

	echo '<div class="post-type ' . $postType .'">' . $postType .'</div>';
}

/*
* Display the post title in masonry-brick
*/

function show_masonry_title_content() {

		echo '<div class="title-content">';
			show_content_post_type();
			genesis_do_post_title();
			if ( is_search() ) { the_content_limit(200, "Read more..."); }
			genesis_post_meta();
			echo '<div class="entry-footer">';
		echo '</div>';
		echo '</div>';

}


/**
 * Display featured image
 */
function show_masonry_block_post_image() {

		$img = genesis_get_image(
			array(
				'format' => 'html',
				'size'   => 'masonry-brick-image',
				'attr'   => array(
					'class' => 'post-image',
				),
			)
		);

		printf( '<a class="post-link" href="%s" title="%s"><i class="overlay"></i>%s</a>', esc_url( get_permalink() ), esc_attr( the_title_attribute( 'echo=0' ) ), $img );

}

/* 
* Load more button for infinite scroll
*/

//first checks to see there are multiple pages
function show_posts_nav() {
    global $wp_query;
    return ($wp_query->max_num_pages > 1);
}

function show_load_more_button() {
	if (show_posts_nav()) {
	echo '<button class="view-more-button">Load More</button>';
	}
}

