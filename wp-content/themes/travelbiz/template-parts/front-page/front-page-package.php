<?php

if (!class_exists('WP_Travel')) {
	return;
}
/**
 * Template part for displaying packages content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @since Travelbiz 1.0.0
 */
?>
<!-- Itinerary List -->
<?php
if (travelbiz_get_option('itinerary_post_enable')) : ?>
	<?php
		$itinerary_section_title = wp_kses_post(travelbiz_get_option('itinerary_post_section_title'));
		?>
	<section class="section-package">
		<div class="container">
			<?php if(!travelbiz_get_option('disable_package_title') || !travelbiz_get_option('disable_package_divider')): ?>
				<div class="section-title-group">
					<?php if( !travelbiz_get_option('disable_package_title') ): ?>
						<div class="title-wrap">
							<h2 class="section-title"><?php echo esc_html($itinerary_section_title); ?></h2>
						</div>
					<?php endif; 

					if( !travelbiz_get_option('disable_package_divider') ): ?>
						<div class="divider"></div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<div class="packages-content-wrap">
				<div class="row">
					<?php
						$itinerary_posts = array(
							'post_type'           => 'itineraries',
							'posts_per_page'   => travelbiz_get_option('itinerary_section_number_of_post'),
							'post_status'      => 'publish',
						);

						$itineraries_posts = get_posts($itinerary_posts);
						if (!empty($itineraries_posts)) {
							foreach ($itineraries_posts as $itineraries_post) {
								$tb_post_id = isset($itineraries_post->ID) && !empty($itineraries_post->ID) ? $itineraries_post->ID : '';
								if (empty($tb_post_id)) {
									return;
								}
								$post_title = isset($itineraries_post->post_title) && !empty($itineraries_post->post_title) ? $itineraries_post->post_title : '';
								$post_content   = isset($itineraries_post->post_content) && !empty($itineraries_post->post_content) ? $itineraries_post->post_content : '';
								$trip_start_date = get_post_meta($tb_post_id, 'wp_travel_start_date', true);
								$trip_end_date   = get_post_meta($tb_post_id, 'wp_travel_end_date', true);
								$trip_price      = !empty(wp_travel_get_price($tb_post_id)) ? wp_travel_get_price($tb_post_id) : '';
								$regular_price 	 = !empty(wp_travel_get_price($tb_post_id, true)) ? wp_travel_get_price($tb_post_id, true) : '';
								$enable_sale     = !empty(wp_travel_is_enable_sale_price($tb_post_id)) ? wp_travel_is_enable_sale_price($tb_post_id) : '';
								$min_pricing_id  = !empty(wp_travel_get_min_pricing_id($tb_post_id)) ? wp_travel_get_min_pricing_id($tb_post_id) : '';
								$min_pricing_id  = !empty(wp_travel_get_min_pricing_id($tb_post_id)) ? wp_travel_get_min_pricing_id($tb_post_id) : '';
								$min_pricing_id  = $min_pricing_id['pricing_id'];

								$fixed_departure = !empty($trip_start_date) && !empty($trip_end_date) ? $trip_start_date . ' - ' . $trip_end_date : '';

								$trip_duration       = get_post_meta($tb_post_id, 'wp_travel_trip_duration', true);
								$trip_duration       = ($trip_duration) ? $trip_duration : 0;
								$trip_duration_night = get_post_meta($tb_post_id, 'wp_travel_trip_duration_night', true);
								$trip_duration_night = ($trip_duration_night) ? $trip_duration_night : 0;
								$trip_duration       = $trip_duration . ' Day(s), ' . $trip_duration_night . ' Night(s) ';
								$duration 			 = !empty($fixed_departure) ? $fixed_departure : $trip_duration;

								$settings      = wp_travel_get_settings();
								$currency_code = (isset($settings['currency'])) ? $settings['currency'] : '';

								$currency_symbol = !empty(wp_travel_get_currency_symbol($currency_code)) ? wp_travel_get_currency_symbol($currency_code) : '';
								$price_per_text  = !empty(wp_travel_get_price_per_text($tb_post_id)) ? wp_travel_get_price_per_text($tb_post_id) : '';
								$sale_price      = !empty(wp_travel_get_trip_sale_price($tb_post_id)) ? wp_travel_get_trip_sale_price($tb_post_id) : '';

								$trip_permalink = !empty(get_post_permalink($tb_post_id)) ? get_post_permalink($tb_post_id) : '';
								$average_rating = wp_travel_get_average_rating($tb_post_id);
								$pricings       = !empty(wp_travel_get_trip_pricing_option($tb_post_id)) ? wp_travel_get_trip_pricing_option($tb_post_id) : '';
								$pricings       = !empty($pricings['pricing_data'][$min_pricing_id]) ? $pricings['pricing_data'][$min_pricing_id] : '';
								$categories     = !empty($pricings['categories']) ? $pricings['categories'] : '';
								$count 			= !empty((int) get_comments_number($tb_post_id)) ? (int) get_comments_number($tb_post_id) : '0';
								?>
							<div class="col-sm-6 col-lg-4">
								<article class="package-post">
									<figure class="feature-image">
										<a href="<?php echo esc_attr($trip_permalink); ?>">
											<?php echo wp_travel_get_post_thumbnail($tb_post_id); ?>
										</a>
										<?php if ($enable_sale) : ?>
											<div class="wp-travel-offer">
												<span><?php esc_html_e('Offer', 'travelbiz' ); ?></span>
											</div>
										<?php endif; ?>
									</figure>
									<div class="post-content">
										<h3 class="entry-title">
											<a href="<?php echo esc_attr($trip_permalink); ?>">
												<?php echo esc_attr($post_title); ?>
											</a>
										</h3>
										<div class="entry-meta">
											<div class="wp-travel-trip-time">
												<strong><?php echo esc_html('Duration:', 'travelbiz'); ?></strong> 
												<?php echo esc_attr($duration); ?>
											</div>
										</div>
										<div class="content-text">
											<p>
												<?php
													$trimmed = wp_trim_words($post_content, $num_words = 10, $tb_more = null);
													if (!empty($trimmed)) {
														echo $trimmed;
													}
												?>
											</p>
										</div>
										<div class="wp-travel-trip-detail">
											<div class="details-wrap">
												<div class="wp-travel-average-review">
													<div class="wp-travel-average-review" title="<?php printf(esc_attr__('Rated %s out of 5', 'travelbiz' ), $average_rating); ?>">
														<a>
															<span style="width:<?php echo esc_attr(($average_rating / 5) * 100); ?>%">
																<strong itemprop="ratingValue" class="rating"><?php echo esc_html($average_rating); ?></strong> <?php printf(esc_html__('out of %1$s5%2$s', 'travelbiz' ), '<span itemprop="bestRating">', '</span>'); ?>
															</span>
														</a>
													</div>
												</div>
												<span class="trip-review-text">
													<?php
														echo '<a href="javascript:void(0)" class="wp-travel-count-info">';
														printf(_n('( %s review )', '( %s reviews )', $count, 'travelbiz' ), $count);
														echo '</a>';
													?>
												</span>
											</div>
											<div class="trip-price">
											<?php	
												if ( ! empty ( $trip_price ) ) { ?>
														<span class="person-count">
															<?php if ($enable_sale) : ?>
																<del>
																	<span class="wp-travel-trip-price-figure"><?php echo wp_travel_get_formated_price_currency($regular_price, true); ?></span>
																</del>
															<?php endif; ?>
															<ins>
																<span>
																	<span class="wp-travel-trip-price-figure"><?php echo wp_travel_get_formated_price_currency( $trip_price, true, '', $tb_post_id ); ?></span>
																</span>
															</ins>
															<?php echo esc_html( '/', 'travelbiz'); ?>
															<?php
																if (!empty($categories)) {
																	foreach ($categories as $category_key => $category) {
																		echo $tb_type = $category['type'];
																	}
																}
															?>
														</span>
													<?php
													} else { ?>
														<span class="person-count">
															<?php echo esc_html( '*Price Not Available', 'travelbiz' ); ?>
														</span>
													<?php							
													}
													?>
											</div>
										</div>
									</div>
								</article>
							</div>
					<?php
							}
						}
						?>
					<?php
						wp_reset_postdata();
						?>
				</div>
			</div>
	</section>
<?php endif; ?>
<!-- Itinerary List -->