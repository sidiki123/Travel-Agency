<?php
/**
 * Template part for displaying callback content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @since Travelbiz 1.0.0
 */
?>

<?php
if( !travelbiz_get_option( 'disable_callback' ) && travelbiz_get_option( 'callback_page' ) ):
	$callback_id = travelbiz_get_option( 'callback_page' );
	if( $callback_id ):
		$query = new WP_Query( apply_filters( 'travelbiz_callback_page_args',  array(
			'post_type'  => 'page',
			'p'          => $callback_id,
	)));
	while( $query->have_posts() ):
		$query->the_post();
		$image = travelbiz_get_thumbnail_url( array(
			'size' => 'travelbiz-1920-650'
		));
	?>
	<section id="block-callback" class="section-callback">
		<?php if( !travelbiz_get_option( 'disable_callback_shape' ) ){ ?>
			<div class="callback-shape-top">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1920 90" preserveAspectRatio="none">
				<polygon fill="#FFFFFF" points="0,18 661.689,79 1252.103,30.21 1497.424,57.749 1922,18 1922,0 0,0 "/>
				</svg>
			</div>
		<?php } ?>
		<div class="callback-container" style="background-image: url(<?php echo esc_url( $image ); ?>)">
			<div class="overlay"></div>
			<div class="container">
				<div class="row align-items-center">
					<div class="col-12 col-lg-6 offset-lg-3">
						<div class="callback-content">
							<div class="section-title-group">
								<?php if( !travelbiz_get_option( 'disable_callback_title' ) ): ?>
									<h2 class="section-title">
										<?php the_title(); ?>
									</h2>
								<?php endif; ?>
								<?php if( !travelbiz_get_option( 'disable_callback_divider' ) ): ?>
									<div class="divider"></div>
								<?php endif; ?>
							</div>
							<?php $excerpt_length = travelbiz_get_option( 'callback_excerpt_lenth' );
								if( !travelbiz_get_option( 'disable_callback_content' ) ){
									travelbiz_excerpt( $excerpt_length , true );
								}
								
								if( !travelbiz_get_option( 'disable_callback_button' ) ): ?>

								<div class="button-container">
									<a href="<?php the_permalink(); ?>" class="button-outline">
										<?php
											echo travelbiz_get_option( 'callback_button_text' );
										?>
									</a>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php if( !travelbiz_get_option( 'disable_callback_shape' ) ){ ?>
		<div class="callback-shape-bottom">
			<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1920 90" preserveAspectRatio="none">
				<polygon fill="#FFFFFF" points="1920,73 1259,13 669.2,60.79 424.134,33.251 0,73 0,92 1920,92 "/>
			</svg>
		</div>
		<?php } ?>
	</section>
	<?php 
		endwhile;
		wp_reset_postdata();
		endif;
endif;