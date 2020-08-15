<?php
/**
 * Itinerary Archive Template
 *
 * @since Travelbiz 1.0.0
 */

get_header( 'itinerary' ); ?>
	<?php
	$current_theme = wp_get_theme();
	if( 'twentyseventeen' === $current_theme->get( 'TextDomain' ) ) { ?>
		<div class="wrap">
	<?php } ?>
		<?php do_action( 'wp_travel_before_main_content' ); ?>
			<div class="container">
				<?php wp_travel_archive_toolbar(); ?>
				<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
				<?php wp_travel_get_template_part( 'content', 'archive-itineraries' ); ?>
				<?php endwhile; // end of the loop. ?>
				<?php else : ?>
				<?php wp_travel_get_template_part( 'content', 'archive-itineraries-none' ); ?>
				<?php endif; ?>
				<?php do_action( 'wp_travel_after_main_content' ); ?>
				<?php do_action( 'wp_travel_archive_listing_sidebar' ); ?>
			</div>
			<?php
			if( 'twentyseventeen' === $current_theme->get( 'TextDomain' ) ) {?>
		</div>
			<?php } ?>
<?php get_footer( 'itinerary' ); ?>