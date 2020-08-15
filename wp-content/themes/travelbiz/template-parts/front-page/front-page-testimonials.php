<?php
/**
 * Template part for displaying testimonial content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @since Travelbiz 1.0.0
 */
$posts_per_page_count = travelbiz_get_option( 'testimonial_posts_number' );
?>



<?php if( !travelbiz_get_option( 'disable_testimonial' ) ):
	$testimonial_ids = travelbiz_get_ids( 'testimonial_page' );
	if( !empty( $testimonial_ids ) && is_array( $testimonial_ids ) && count( $testimonial_ids ) > 0 ):

		$query = new WP_Query( apply_filters( 'travelbiz_testimonial_args', array( 
			'post_type'      => 'page',
			'post__in'       => $testimonial_ids,
			'posts_per_page' => $posts_per_page_count,
			'orderby'        => 'post__in'
		)));

		if( $query->have_posts() ):
		$image = travelbiz_testimonial_image_url();
		?>
			<section id="block-testimonial" class="section-testimonial" style="background-image: url(<?php echo esc_url( $image ); ?>)">
				<div class="overlay"></div>
				<div class="container">
					<div class="row">
						<div class="col-md-4">
							<div class="section-title-group">
								<?php if( !travelbiz_get_option( 'disable_testimonial_title' ) ):  ?>
									<h2 class="section-title"><?php echo wp_kses_post( travelbiz_get_option( 'testimonial_section_title' ) ); ?></h2>
								<?php endif;
								if( !travelbiz_get_option( 'disable_testimonial_divider' ) ): ?>
									<div class="divider"></div>
								<?php endif; ?>
							</div>
							<div class="controls"></div>
						</div>
						<div class="col-md-8">
							<div class="content-inner">
								<div class="owl-carousel testimonial-carousel">
									<?php 
										while ( $query->have_posts() ):
											$query->the_post(); 
											$image = travelbiz_get_thumbnail_url( array(
												'size' => 'thumbnail'
											));
									?>
										    <div class="slide-item">
										    	<article class="testi-content">
										    		<div class="author-content">
									    				<div class="text">
									    					<?php the_content(); 	
									    					?>
									    				</div>
													</div>
										    		<div class="header-content">
										    			<figure class="author">
										    				<img src="<?php echo esc_url( $image ); ?>">
										    			</figure>
										    			<div class="testi-title-wrap">
										    				<h3 class="author-name"><?php the_title(); ?></h3>
										    			</div>
										    		</div>
										    	</article>
											</div>
									<?php
										endwhile; 
										wp_reset_postdata();
									?>
								</div>
								<div id="slide-pager" class="owl-pager"></div>
							</div>
						</div>
					</div>
				</div>
			</section>
		<?php
		endif;
	endif;
endif; ?>