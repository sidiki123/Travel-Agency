<?php
/**
 * Template part for displaying Client section
 *
 * @since Travelbiz 1.0.0
 */

$posts_per_page_count = travelbiz_get_option( 'clients_posts_number' );
$clients_ids = travelbiz_get_ids( 'clients_page' );
?>

<?php if( !travelbiz_get_option( 'disable_clients' ) ){ 
	if( !empty( $clients_ids ) && is_array( $clients_ids ) && count( $clients_ids ) > 0 ):
		$query = new WP_Query( apply_filters( 'travelbiz_clients_args', array( 
			'post_type'      => 'page',
			'post__in'       => $clients_ids,
			'posts_per_page' => $posts_per_page_count,
			'orderby'        => 'post__in'
	)));?>
	<section id="block-clients" class="section-clients">
		<div class="container">
			<?php if( !travelbiz_get_option('disable_clients_title') || !travelbiz_get_option('disable_clients_divider')): ?>
				<div class="section-title-group">
					<?php if( !travelbiz_get_option('disable_clients_title') ): ?>
						<h2 class="section-title"><?php echo wp_kses_post( travelbiz_get_option( 'clients_section_title' ) ); ?></h2>
					<?php endif; 
					if( !travelbiz_get_option('disable_clients_divider') ): ?>
						<div class="divider"></div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<div class="content-inner">
				<div class="owl-carousel clients-carousel">
					<?php 
						while ( $query->have_posts() ):
							$query->the_post(); 
							$image = travelbiz_get_thumbnail_url( array(
								'size' => 'thumbnail'
						));
					?>
					<?php if( !travelbiz_get_option( 'disable_clients_name' ) || has_post_thumbnail() ){ ?>
						<div class="slide-item">
							<a href="<?php the_permalink(); ?>">
								<?php if( has_post_thumbnail() ){ ?>
									<figure class="client-image">
										<img src="<?php echo esc_url( $image ); ?>"/>
									</figure>
								<?php } ?>
								<?php if( !travelbiz_get_option( 'disable_clients_name' ) ): ?>
									<div class="client-content">
										<h3>
											<?php the_title(); ?>
										</h3>
									</div>
								<?php endif; ?>
							</a>
						</div>
					<?php } ?>
				<?php
					endwhile;
					wp_reset_postdata();
				?>
				</div>
				<?php if( !travelbiz_get_option( 'disable_clients_controls' ) ): ?>
					<div class="controls"></div>
				<?php endif;
				?>
			</div>
		</div>
	</section>
<?php endif; } ?>
	

