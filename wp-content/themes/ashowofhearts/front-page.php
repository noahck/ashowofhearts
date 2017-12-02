<?php
/**
 *
 * This file adds the front page to the theme.
 *
 * @package A Show of Hearts
 * @author  Noah Kramer
 * 
 */

// Force full-width-content layout.


// Remove 'site-inner' from structural wrap
add_theme_support( 'genesis-structural-wraps', array( 'header', 'footer-widgets', 'footer' ) );

function be_site_inner_attr( $attributes ) {
	
	// Add a class of 'full' for styling this .site-inner differently
	$attributes['class'] .= ' full';
	
	// Add an id of 'genesis-content' for accessible skip links
	$attributes['id'] = 'genesis-content';
	
	// Add the attributes from .entry, since this replaces the main entry
	$attributes = wp_parse_args( $attributes, genesis_attributes_entry( array() ) );
	
	return $attributes;
}

add_filter( 'genesis_attr_site-inner', 'be_site_inner_attr' );

add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//add_action( 'genesis_after_header' , 'show_pink_arrow' );
	function show_pink_arrow() {
		echo '<i class="fa fa-caret-down" aria-hidden="true"></i>';
	}


// Do the custom home page stuff
add_action( 'show_home_content_area', 'showofhearts_front_page' );
function showofhearts_front_page() {

		// Featured Episodes Section -- Latest Episode
		
		echo '<div class="podcast"><div class="wrap"><div class="one-half first latest">HIHIHI';
		$latesteEpisode = new WP_Query( 'post_type=episode&posts_per_page=1' );
 		while($latesteEpisode->have_posts()) : $latesteEpisode->the_post(); ?>
 			 <a style="display: block;" href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'ashowofhearts' ), the_title_attribute() ) ); ?>" rel="bookmark">
                    <?php if(has_post_thumbnail()) : the_post_thumbnail( 'home-latest-episode' ); endif;
                    echo '<div class ="info"><p>- Latest Episode -</p>';
                    the_title( '<h4>', '</h4>'); ?>
                    <span class="button" href="<?php the_permalink() ?>" rel="bookmark">Listen</span>
                </a>
            </div>
		<?php endwhile;
    	wp_reset_postdata();

    	// Featured Episodes Section -- Recent Episodes

    	echo '</div><div class="one-half recent">';
    	$recentEpisodes = new WP_Query( 'post_type=episode&posts_per_page=2&offset=1' );
 		while($recentEpisodes->have_posts()) {
		 $recentEpisodes->the_post(); ?>
 			<article><a href="<?php the_permalink() ?>" rel="bookmark">
 				<?php if(has_post_thumbnail()) : the_post_thumbnail( 'thumbnail', array( 'class' => 'alignleft' ) ); endif; ?></a>
 				<?php echo '<span class="date">'. get_the_date() .'</span>';?>
 				<h4><?php the_title(); ?></h4>
			    <a href="<?php the_permalink() ?>" rel="bookmark">Listen &rsaquo;</a>
 			</article>
 		<?php }
 		echo '<a class="more" title="Episode Archive" href="/episodes">More Episodes &rarr;</a></div>';
    	wp_reset_postdata();
		echo '</div></div>';

		// Bio Section

		echo '<div class="bio"><div class="wrap"><div class="two-thirds first">';
		the_field ('home_host_bio_text');
		echo '</div><div class="one-third">';
		$image = get_field('home_host_image');
		$size = 'large'; // (thumbnail, medium, large, full or custom size)
		if( $image ) {
			echo wp_get_attachment_image( $image, $size );
		}
		echo '</div></div></div>';

		// Recent Blog Posts Section

		genesis_widget_area( 'home-latest-articles', array(
			'before' => '<div class="latest-articles"><div class="wrap">',
			'after'  => '</div></div>',
		) );

	}



// Output
get_header();
do_action( 'show_home_content_area' );
get_footer();
