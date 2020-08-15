<?php

if ( ! class_exists('WP_Travel') ) {
    return;
}

/**
 * Template part for displaying packages content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @since Travelbiz 1.0.0
 */
?>
<!-- Trips List -->
<?php
if (travelbiz_get_option('post_filter_enable')) : ?>

	<?php
		$post_section_title = wp_kses_post(travelbiz_get_option('post_filter_section_title'));
		?>
	<section class="section-trip-category">
		<div class="container">
			<?php if( !travelbiz_get_option('disable_destination_title') || !travelbiz_get_option('disable_destination_divider') ): ?>
				<div class="section-title-group">
					<?php if( !travelbiz_get_option('disable_destination_title') ): ?>
						<div class="title-wrap">
							<h2 class="section-title"><?php echo esc_html($post_section_title); ?></h2>
						</div>
					<?php endif; 
					if( !travelbiz_get_option('disable_destination_divider') ): ?>
						<div class="divider"></div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<div class="category-content-wrap">
				<div class="row">
					<?php
						$thumbnail_url = plugins_url( '/wp-travel/assets/images/wp-travel-placeholder.png' );
						$destinations = get_terms(array(
							'taxonomy'   => 'travel_locations',
							'hide_empty' => true,
						));

						$number_of_destinations = travelbiz_get_option('post_filter_number_of_destination');
						$count = 0;
						if (!empty($destinations)) {
							foreach ($destinations as $destination) {

								$term_id         = isset($destination->term_id) && !empty($destination->term_id) ? $destination->term_id  : '';
								$term_name       = isset($destination->name) && !empty($destination->name) ? $destination->name  : '';
								$post_count      = !empty($destination->count) ? $destination->count : '';
								$image_id        = get_term_meta($term_id, 'wp_travel_trip_type_image_id', true);
								$image_url       = !empty($image_id) ? wp_get_attachment_url($image_id) : '';
								$destination_url = !empty( $term_id ) ? get_term_link($term_id) : '';
								if ($count < $number_of_destinations) {
									?>
								<div class="col-lg-3 col-sm-6">
									<article class="category-post">
										<a href="<?php echo esc_url($destination_url); ?>">
											<figure class="feature-image">
												<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo $term_name; ?>" onerror=this.src="<?php echo $thumbnail_url ?>">
											</figure>
											<div class="post-content">
												<span class="sub-title"><?php echo esc_html($post_count); ?> <?php echo esc_html_e('Tour Package', 'travelbiz'); ?></span>
												<h3 class="entry-title"><?php echo esc_html($term_name); ?></h3>
											</div>
										</a>
									</article>
								</div>
					<?php
								}
								$count++;
							}
						}
						?>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>
<!-- Trips List -->