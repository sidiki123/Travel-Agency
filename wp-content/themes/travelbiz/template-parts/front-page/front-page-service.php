<?php
/**
 * Template part for displaying services section
 *
 * @since Travelbiz 1.0.0
 */

$service_icon_ids = explode( ',', travelbiz_get_option( 'service_icons' ) );
$service_page_id = travelbiz_get_ids( 'service_page' );

if( !empty( $service_page_id ) && is_array( $service_page_id ) && count( $service_page_id ) > 0 && !travelbiz_get_option( 'disable_service' ) ):
		
?>
<!-- Service Section -->
<section id="block-service" class="section-service">
	<div class="container">
		<div class="service-inner-wrap">
			<div class="service-content-outer">
				<div class="row align-items-center">
					<div class="col-lg-4 order-1">
						<?php if( !travelbiz_get_option( 'disable_service_title' ) || !travelbiz_get_option( 'disable_service_divider' )): ?>
							<div class="section-title-group">
								<?php if( !travelbiz_get_option( 'disable_service_title' ) ):  ?>
									<h2 class="section-title"><?php echo wp_kses_post( travelbiz_get_option( 'service_section_title' ) ); ?></h2>
								<?php endif;
								if( !travelbiz_get_option( 'disable_service_divider' ) ): ?>
									<div class="divider"></div>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
					<div class="col-lg-8">
						<div class="service-content-inner">
							<div class="row">
								<?php
									$item_count = travelbiz_get_option( 'service_item_count' );  
									$query = new WP_Query( apply_filters( 'travelbiz_services_args',  array( 
									'post_type'      => 'page',
									'post__in'       => $service_page_id, 
									'posts_per_page' => $item_count,
									'orderby'        => 'post__in'
								)));
									$i = 0;
									while ( $query->have_posts() ) : $query->the_post();
									$icon = isset ( $service_icon_ids[$i] ) ? $service_icon_ids[$i] : '' ;

									$count = $query->post_count;
						    			if( 1 == $count ){
						    				$class = 'col-md-12';
						    			}else{
						    				$class = 'col-12 col-md-6';
						    			}
								?>
						    	<div class="<?php echo esc_attr( $class ); ?>">
									<div class="service-post">
										<?php if ($icon){ ?>
											<figure class="sevice-icon">
												<span class="icon"><i class="<?php echo $icon; ?>"></i></span>
											</figure>
										<?php } ?>
										<div class="service-content">
				    						<h3>
				    							<a href="<?php the_permalink(); ?>">
				    								<?php the_title(); ?>
				    							</a>
				    						</h3>
				    						<p>
				    							<?php
													$excerpt_length = travelbiz_get_option( 'service_excerpt_length' );
													travelbiz_excerpt( $excerpt_length , true );
												?>
											</p>
										</div>
									</div>
						    	</div>
						    	<?php
									$i++;
								 	endwhile;
								 	wp_reset_postdata();
								 ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="overlay"></div>
	<?php if ( !travelbiz_get_option( 'disable_service_shape' ) ){ ?>
		<div class="service-shape">
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 257 900" preserveAspectRatio="none">
				<path fill="#3398D4" d="M8,449.75C8,222.521,133.617,34.007,252.359-1.5H0V901h257C138.258,865.493,8,676.979,8,449.75z"/>
			</svg>
		</div>
	<?php } ?>
</section> <!-- End Service Section -->
<?php
endif; 