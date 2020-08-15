<?php
/**
 * Template part for displaying trip Search content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @since Travelbiz 1.0.0
 */
$disable_shape_class = '';
if( !travelbiz_get_option ('disbale_search_shape') ) {
	$disable_shape_class = 'search-has-shape';
}
if (class_exists('WP_Travel')) { 
?>
	<?php
	if ( travelbiz_get_option('itinerary_search_enable') ) : ?>
		<?php ob_start(); ?>
		<section class="section-trip-search <?php echo esc_attr( $disable_shape_class ); ?>">
			<div class="container">
				<div class="trip-search-wrap">
					<form name="wp-travel_search" action="<?php echo esc_url(home_url('/')); ?>" method="get">
						<div class="row no-gutters">
							<div class="col-sm-6 col-lg-3">
								<div class="input-group">
									<label><span class="kfi kfi-pin"></span><?php esc_html_e('Search Trip', 'travelbiz'); ?></label>
									<?php $placeholder = __('Ex: Trekking', 'travelbiz'); ?>
									<input type="text" name="s" id="" value="<?php echo (isset($_GET['s'])) ? esc_textarea($_GET['s']) : ''; ?>" placeholder="<?php echo esc_attr(apply_filters('wp_travel_search_placeholder', $placeholder)); ?>">
									<input type="hidden" name="post_type" value="itineraries">
								</div>
							</div>
							<div class="col-sm-6 col-lg-3">
								<div class="input-group">
									<label><span class="kfi kfi-compass"></span><?php esc_html_e('Select Trip Type', 'travelbiz'); ?></label>
									<?php
										$tb_taxonomy = 'itinerary_types';
										$args     = array(
											'show_option_all' => __( 'All' , 'travelbiz'  ),
											'hide_empty'      => 0,
											'selected'        => 1,
											'hierarchical'    => 1,
											'name'            => $tb_taxonomy,
											'class'           => 'wp-travel-taxonomy',
											'taxonomy'        => $tb_taxonomy,
											'selected'        => (isset($_GET[$tb_taxonomy])) ? esc_textarea($_GET[$tb_taxonomy]) : 0,
											'value_field'     => 'slug',
										);

										wp_dropdown_categories($args);
									?>
								</div>
							</div>
							<div class="col-sm-6 col-lg-3">
								<div class="input-group">
									<label><span class="kfi kfi-map"></span><?php esc_html_e('Select Location Trip', 'travelbiz'); ?></label>
									<?php
										$tb_taxonomy = 'travel_locations';
										$args     = array(
											'show_option_all' => __( 'All', 'travelbiz' ),
											'hide_empty'      => 0,
											'selected'        => 1,
											'hierarchical'    => 1,
											'name'            => $tb_taxonomy,
											'class'           => 'wp-travel-taxonomy',
											'taxonomy'        => $tb_taxonomy,
											'selected'        => (isset($_GET[$tb_taxonomy])) ? esc_textarea($_GET[$tb_taxonomy]) : 0,
											'value_field'     => 'slug',
										);

										wp_dropdown_categories($args, $tb_taxonomy);
									?>
								</div>
							</div>
							<div class="col-sm-6 col-lg-3">
								<div class="input-group">
									<label class="screen-reader-text"><?php esc_html_e( 'Select Trip Duration', 'travelbiz'); ?></label>
									<input type="submit" name="wp-travel-search" id="wp-travel-search" class="button button-primary" value="<?php esc_html_e('Search', 'travelbiz'); ?>">
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<?php if( !travelbiz_get_option ('disbale_search_shape') ): ?>
				<div class="search-shape">
					<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1920 214">
					<path fill="#FFFFFF" d="M0.5,183.087c0,0,344.621-182.991,619.108-116.994s575.971,173.991,880.456,67.497
						S1790.964,31.595,1921.5,15.095V215H0.5V183.087z"/>
					</svg>
				</div>
			<?php endif; ?>
		</section>
		<?php
			$content = apply_filters('wp_travel_search_form', ob_get_clean());
			echo $content;
		?>
	<?php endif; 
} ?>