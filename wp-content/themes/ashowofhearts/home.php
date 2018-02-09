<?php
/**
 * Episode Archive.
 *
 *
 * @package      A Show of Hearts
 * @author       Noah Kramer
 */

remove_action ( 'genesis_header', 'show_post_header' );
remove_action( 'genesis_before_header', 'show_featured_header', 5 );
add_action( 'genesis_before_header', 'episodes_featured_header' ,5 );
/**
 * Featured image background hero unit
 */
function episodes_featured_header() {

	$args = array(
	    'post_type' =>'post',
	    'posts_per_page' => 1,
	    'orderby'=>'post_date',
	    'order' => 'DESC',
	     );

	// The Query
	$query1 = new WP_Query( $args );

	if ( $query1->have_posts() ) {
		// The Loop
		while ( $query1->have_posts() ) {
			$query1->the_post();
			$image = wp_get_attachment_url( get_post_thumbnail_id() );
			echo '<div class="hero-wrap" style="background-image: url(' . esc_url( $image ) . ')">';
		}
	}
		
	wp_reset_postdata();
}
	
add_action( 'show_post_header', 'show_episode_latest' , 15);
function show_episode_latest() {


	$args = array(
	    'post_type' =>'post',
	    'posts_per_page' => 1,
	    'orderby'=>'post_date',
	    'order' => 'DESC',
	     );

	$query2 = new WP_Query( $args );

	if ( $query2->have_posts() ) {
	// The Loop
	while ( $query2->have_posts() ) {
		$query2->the_post();
		$title = get_the_title( ); 
	?>
		<div class="entry-header">
			<p class="entry-meta">- Latest Episode - </p> 

			<h1 class="entry-title" itemprop="headline"><?php echo esc_html($title);?></h1> 
				<div class="listen"><a class="button" href="<?php the_permalink()?>">Listen</a></div>
		</div> 
	<?php 
	}
}
	wp_reset_postdata();
}



// Run genesis.
genesis();