<?php
/**
 * Template part for displaying slider content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @since Travelbiz 1.0.0
 */

$layout_class = '';
if( travelbiz_get_option( 'slider_section_layout' ) == 'slider_section_layout_one' ){
	$layout_class = 'slider-layout-one';
}
$disable_class = '';
if ( !travelbiz_get_option( 'disable_slider_shape' ) && !travelbiz_get_option('itinerary_search_enable' )) {
	$disable_class = 'slider-shape-bg';
}elseif ( !travelbiz_get_option('itinerary_search_enable')){
	$disable_class = 'slider-mb';
}

$posts_per_page_count = travelbiz_get_option( 'slider_posts_number' );
$slider_page_id = travelbiz_get_ids( 'slider_page' );

if( !empty( $slider_page_id ) && is_array( $slider_page_id ) && count( $slider_page_id ) > 0 && !travelbiz_get_option( 'disable_slider' ) ){ ?>
	<section id="block-slider" class="section-slider <?php echo esc_attr( $layout_class . ' ' . $disable_class ); ?>">
		<?php
		if( !travelbiz_get_option( 'disable_slider_control' ) ): ?>
			<div class="owl-pager" id="slide-pager"></div>
			<div class="controls"></div>
		<?php endif; ?>
		<div class="home-slider owl-carousel">
			<?php
				$query = new WP_Query( apply_filters( 'travelbiz_slider_args', array(
					'posts_per_page' => $posts_per_page_count,
					'post_type'      => 'page',
					'orderby'        => 'post__in',
					'post__in'       => $slider_page_id,
				)));
				$i = 0;
				while ( $query->have_posts() ) : $query->the_post();
				$image = travelbiz_get_thumbnail_url( array( 'size' => 'travelbiz-1920-750' ) );
			?>
				<div class="slide-item" style="background-image: url( <?php echo esc_url( $image ); ?> );">
					<?php
						$class = '';
						if( travelbiz_get_option( 'slider_content_alignment' ) == 'center' ){
							$class = 'text-center';
						}
					?>
					<div class="banner-overlay">
						<div class="container">
					    	<div class="slide-inner <?php echo esc_attr( $class ); ?>">
								<div class="slider-content">
										<?php if( !travelbiz_get_option( 'disable_slider_title' ) ): ?>
											<h2 class="section-title">
												<a href="<?php the_permalink(); ?>">
													<?php the_title(); ?>
												</a>
											</h2>
										<?php endif;
										
										$excerpt_length = travelbiz_get_option( 'slider_excerpt_length' );
										if( !travelbiz_get_option( 'disable_slider_content' ) ){
											travelbiz_excerpt( $excerpt_length , true );
										}
										if( !travelbiz_get_option( 'disable_slider_button' ) ): ?>
										<div class="button-container">
											<a href="<?php the_permalink(); ?>" class="button-outline">
												<?php
													echo travelbiz_get_option( 'slider_button_text' );
												?>
											</a>
										</div>
									<?php endif; ?>
								</div>
					    	</div>
						</div>
					</div>
				</div>
			<?php
				$i++;
				endwhile; 
				wp_reset_postdata(); 	
			?>
		</div>	
		<?php  if( !travelbiz_get_option( 'disable_slider_shape' ) ){?>
			<div class="slider-shape">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1920 330" preserveAspectRatio="none">
				<path opacity="0.3" fill="#FFFFFF" enable-background="new    " d="M0.063,270.722c0,0,144.512,30.45,260.282-39.132
					c155.53-93.478,331.915-76.61,446.198-48.162c221.089,55.034,358.208,36.458,464.287-26.088
					c236.592-140.144,420.069-164.554,758.738-86.291v261.982H0.063"/>
				<path opacity="0.2" fill="#FFFFFF" enable-background="new    " d="M0.063,274.736c0,0,144.512,35.466,260.282-34.115
					c155.53-93.478,331.915-65.573,446.198-37.125c221.089,55.034,358.208,40.471,464.287-22.074
					c236.592-140.144,420.069-164.554,758.738-86.291v207.7H0.063"/>
				<path fill="#F9F9F9" d="M-2,278.848c0,0,144.512,39.48,260.282-30.101c155.53-93.478,331.915-50.522,446.198-22.074
					c221.089,55.034,358.208,46.492,464.287-16.054c236.591-140.144,420.069-164.554,758.738-86.291v207.7H-2V278.848L-2,278.848z"/>
				</svg>
			</div>
		<?php } ?>
		<div id="after-slider"></div>
	</section>
<?php
} else {
		/**
		* Prints Title and breadcrumbs for archive pages
		* @since Travelbiz 1.0.0
		*/
	travelbiz_inner_banner();
}