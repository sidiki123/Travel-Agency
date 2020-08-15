<?php
/**
 * Template part for displaying about content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @since Travelbiz 1.0.0
 */
?>

<?php
$layout_class = '';
if( travelbiz_get_option( 'about_section_layout' ) == 'about_section_layout_one' ){
	$layout_class = 'about-layout-one';
}

if( !travelbiz_get_option( 'disable_about' ) && travelbiz_get_option( 'about_page' ) ): ?>
	<section id="block-about" class="section-about <?php echo esc_attr( $layout_class ); ?>">
		<div class="container">
			<div class="thumb-block-outer">
				<div class="row align-items-center">
					<?php
						$about_id = travelbiz_get_option( 'about_page' );
						if( $about_id ):
							$query = new WP_Query( apply_filters( 'travelbiz_about_page_args',  array(
								'post_type'  => 'page',
								'p'          => $about_id,
						)));
						while( $query->have_posts() ):
							$query->the_post();
							$image = travelbiz_get_thumbnail_url( array(
								'size' => 'travelbiz-580-580'
							));
						if( travelbiz_get_option( 'about_section_layout' ) == 'about_section_layout_one' ):
					?>

						<?php
							$content_column_class = '';
							if( !travelbiz_get_option( 'disable_about_feature_image' ) && (has_post_thumbnail() ) ){
								$content_column_class = 'col-12 col-md-6';
							}else {
								$content_column_class = 'col-md-12 text-center about-no-thumbnail';
							}

							if( !travelbiz_get_option( 'disable_about_feature_image' ) && ( has_post_thumbnail() ) ):
						?>
							<div class="col-12 col-md-6">
								<div class="thumb-outer">
									<div class="thumb-inner">
										<img src="<?php echo esc_url( $image );?>">
									</div>
									<?php if (!travelbiz_get_option( 'disable_about_shape' )){?>
										<div class="about-shape">
											<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 585 585" preserveAspectRatio="none">
												<path fill="#FFFFFF" d="M539.237,585L0,585.078V0h539.454l-0.217,217.589l-3.644-12.092l-13.6-33.109
													c0,0-41.972-151.641-246.497-124.379S57.266,238.835,92.287,347.879s178.148,199.345,246.667,202.754
													c68.519,3.408,159.62-32.178,200.284-154.224v5.38L539.237,585L539.237,585L539.237,585L539.237,585z"/>
												<path fill="#FFFFFF" d="M539.237,217.589c8.41,26.921,14.208,56.674,14.208,87.493c0,32.145-5.038,62.769-14.148,90.622L506.094,585
													H585V0h-86.813l-16.871,105.859l35.895,53.72L539.237,217.589z"/>
												<path fill="#F6F5F5" d="M317.471,10.66C83.008,10.66,12.855,146.233,22.11,291.943c5.445,85.734,49.734,169.373,119.769,200.856
													c78.567,35.321,113.858,70.584,175.593,80.426c119.147,18.996,190.141-76.591,221.765-176.547
													c-28.69,74.883-84.113,134.847-175.43,119.936c-50.636-8.268-79.581-37.891-144.02-67.562
													c-57.441-26.449-93.767-82.589-98.234-154.611c-7.59-122.402,49.95-222.172,242.254-222.172
													c98.783,0,150.052,71.644,175.647,145.925C517.718,129.594,445.725,10.66,317.471,10.66z"/>
												<path fill="#FFFFFF" d="M509.641,159.579"/>
											</svg>
										</div>
									<?php } ?>
								</div>
							</div>
						<?php endif; ?>
						<div class="<?php echo esc_attr( $content_column_class ); ?>">
							<div class="about-content">
								<?php if( !travelbiz_get_option( 'disable_about_title' ) || !travelbiz_get_option( 'disable_about_divider' )): ?>
									<div class="section-title-group">
										<?php if( !travelbiz_get_option( 'disable_about_title' ) ): ?>
											<h2 class="section-title">
												<?php the_title(); ?>
											</h2>
										<?php endif;
										 if( !travelbiz_get_option( 'disable_about_divider' ) ): ?>
										<div class="divider"></div>
										<?php endif; ?>
									</div>
								<?php endif; ?>
								<?php $excerpt_length = travelbiz_get_option( 'about_excerpt_lenth' );
								if( !travelbiz_get_option( 'disable_about_content' ) ){
									travelbiz_excerpt( $excerpt_length , true );
								}
								
									if( !travelbiz_get_option( 'disable_about_button' ) ):
								?>

								<div class="button-container">
									<a href="<?php the_permalink(); ?>" class="button-outline">
										<?php
											echo travelbiz_get_option( 'about_button_text' );
										?>
									</a>
								</div>
							<?php endif; ?>
							</div>
						</div>
					<?php 
						endif;
						endwhile;
						wp_reset_postdata();
						endif;
					?>
				</div>
			</div>
		</div>	
	</section>
<?php
endif;