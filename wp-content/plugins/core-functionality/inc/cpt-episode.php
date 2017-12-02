<?php
/**
 * Core Functionality Plugin
 * 
 * @package    CoreFunctionality
 * 
 */

/**
 * Podcast Episodes
 *
 * This file registers the episode custom post type
 * and setups the various functions and items it uses.
 *
 * @since 2.0.0
 */
class show_Episodes {

	/**
	 * Initialize all the things
	 *
	 * @since 2.0.0
	 */
	function __construct() {
		
		// Actions
		add_action( 'init',              array( $this, 'register_cpt'      )    );
		add_action( 'gettext',           array( $this, 'title_placeholder' )    );
		add_action( 'pre_get_posts',     array( $this, 'Episode_query' )    );
		add_action( 'template_redirect', array( $this, 'redirect_single'   )    );

		// Column Filters
		add_filter( 'manage_edit-episode_columns',        array( $this, 'episode_columns' )        );

		// Column Actions
		add_action( 'manage_episode_pages_custom_column', array( $this, 'custom_columns'      ), 10, 2 );
		add_action( 'manage_episode_posts_custom_column', array( $this, 'custom_columns'      ), 10, 2 );
	}


	/**
	 * Register the custom post type
	 *
	 * @since 2.0.0
	 */
	function register_cpt() {

		$labels = array( 
			'name'               => 'Episodes',
			'singular_name'      => 'Episode',
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New Episode',
			'edit_item'          => 'Edit Episode',
			'new_item'           => 'New Episode',
			'view_item'          => 'View Episode',
			'search_items'       => 'Search Episodes',
			'not_found'          => 'No Episodes found',
			'not_found_in_trash' => 'No Episodes found in Trash',
			'parent_item_colon'  => 'Parent Episode:',
			'menu_name'          => 'Episodes',
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
			'has_archive'         => true,
			'query_var'           => true,
			'can_export'          => true,
			'rewrite'             => array( 'slug' => 'episodes', 'with_front' => true ),
			'menu_icon'           => 'dashicons-microphone',
			'taxonomies'          => array( 'category', ),
			'menu_position'       => 2,
			'has_archive'		  => true,

		);

		register_post_type( 'Episode', $args );

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
		if ( isset( $post ) && 'Episode' == $post->post_type && 'Enter title here' == $translation ) {
			$translation = 'Enter Name Here';
		}
		return $translation;

	}
	
	/**
	 * Customize the Episodes Query
	 *
	 * @since 2.0.0
	 * @param object $query
	 */
	function Episode_query( $query ) {
		if( $query->is_main_query() && !is_admin() && $query->is_post_type_archive( 'Episode' ) ) {
			$query->set( 'posts_per_page', 20 );
		}
	}
	
	/**
	 * Redirect Single Episodes
	 *
	 * @since 2.0.0
	 */
	function redirect_single() {
		if( is_singular( 'Episode' ) ) {
			wp_redirect( get_post_type_archive_link( 'Episode' ) );
			exit;
		}
	}

	/**
	 * Episodes custom columns
	 *
	 * @since 2.0.0
	 * @param array $columns
	 */
	function Episode_columns( $columns ) {

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
new show_Episodes();