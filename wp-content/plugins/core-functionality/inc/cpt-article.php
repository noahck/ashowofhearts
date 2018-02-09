<?php
/**
 * Core Functionality Plugin
 * 
 * @package    CoreFunctionality
 * 
 */

/**
 * Podcast articles
 *
 * This file registers the article custom post type
 * and setups the various functions and items it uses.
 *
 * @since 2.0.0
 */
class show_articles {

	/**
	 * Initialize all the things
	 *
	 * @since 2.0.0
	 */
	function __construct() {
		
		// Actions
		add_action( 'init',              array( $this, 'register_cpt'      )    );
		add_action( 'gettext',           array( $this, 'title_placeholder' )    );
		add_action( 'pre_get_posts',     array( $this, 'article_query' )    );
		add_action( 'template_redirect', array( $this, 'redirect_single'   )    );

		// Column Filters
		add_filter( 'manage_edit-article_columns',        array( $this, 'article_columns' )        );

		// Column Actions
		add_action( 'manage_article_pages_custom_column', array( $this, 'custom_columns'      ), 10, 2 );
		add_action( 'manage_article_posts_custom_column', array( $this, 'custom_columns'      ), 10, 2 );
	}


	/**
	 * Register the custom post type
	 *
	 * @since 2.0.0
	 */
	function register_cpt() {

		$labels = array( 
			'name'               => 'Articles',
			'singular_name'      => 'Article',
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New article',
			'edit_item'          => 'Edit article',
			'new_item'           => 'New article',
			'view_item'          => 'View article',
			'search_items'       => 'Search articles',
			'not_found'          => 'No articles found',
			'not_found_in_trash' => 'No articles found in Trash',
			'parent_item_colon'  => 'Parent article:',
			'menu_name'          => 'Articles',
		);

		$args = array( 
			'labels'              => $labels,
			'hierarchical'        => false,
			'supports'            => array( 'title', 'editor', 'thumbnail','excerpt','comments'),   
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'query_var'           => true,
			'can_export'          => true,
			'rewrite'             => array( 'slug' => 'articles', 'with_front' => true ),
			'menu_icon'           => 'dashicons-microphone',
			'taxonomies'          => array( 'category', ),
			'menu_position'       => 5,
			'has_archive'		  => true,
		);

		register_post_type( 'article', $args );

	}

	/**
	 * Change the default title placeholder text
	 *
	 * @since 2.0.0
	 * @global array $post
	 * @param string $translation
	 * @return string Customized translation for title
	 */
	function title_placeholder( $translation ) {

		global $post;
		if ( isset( $post ) && 'article' == $post->post_type && 'Enter title here' == $translation ) {
			$translation = 'Enter Name Here';
		}
		return $translation;

	}
	
	/**
	 * Customize the articles Query
	 *
	 * @since 2.0.0
	 * @param object $query
	 */
	function article_query( $query ) {
		if( $query->is_main_query() && !is_admin() && $query->is_post_type_archive( 'article' ) ) {
			$query->set( 'posts_per_page', 20 );
		}
	}
	
	/**
	 * Redirect Single articles
	 *
	 * @since 2.0.0
	 */
	function redirect_single() {
		if( is_singular( 'article' ) ) {
			wp_redirect( get_post_type_archive_link( 'article' ) );
			exit;
		}
	}

	/**
	 * articles custom columns
	 *
	 * @since 2.0.0
	 * @param array $columns
	 */
	function article_columns( $columns ) {

		$columns = array(
			'cb'                  => '<input type="checkbox" />',
			'thumbnail'           => 'Thumbnail',
			'title'               => 'Name',
			'date'                => 'Date',
		);

		return $columns;
	}

	/**
	 * Cases for the custom columns
	 *
	 * @since 1.2.0
	 * @param array $column
	 * @param int $post_id
	 * @global array $post
	 */
	function custom_columns( $column, $post_id ) {

		global $post;

		switch ( $column ) {
			case 'thumbnail':
				the_post_thumbnail( 'thumbnail' );
				break;
		}
	}
	
}
new show_articles();

