<?php
/**
 * The Archive Post Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @since Travelbiz 1.0.0
 */

get_header();
travelbiz_inner_banner();

if( have_posts() ):
?>
	<section class="block-grid" id="main-content">
		<div class="container">
			<div class="row">
				<?php if( travelbiz_get_option( 'archive_layout' ) == 'left' ): ?>
					<?php get_sidebar(); ?>
				<?php endif; ?>
				<?php
					$class = '';
					$layout_class = '';
					$masonry_class = '';
					travelbiz_get_option( 'archive_layout' ) == 'none' ? $class = 'col-12' : $class = 'col-md-8';
					if( travelbiz_get_option( 'archive_post_layout' ) == 'grid'){
						$masonry_class = 'masonry-wrapper';
					}
					if( travelbiz_get_option( 'archive_post_layout' ) == 'grid' ){
						$layout_class = 'grid-post';
					}elseif( travelbiz_get_option( 'archive_post_layout' ) == 'list' ){
						$layout_class = 'list-post';
					}elseif( travelbiz_get_option( 'archive_post_layout' ) == 'simple' ){
						$layout_class = 'simple-post';
					}
				?>
				<div id="primary" class="<?php echo esc_attr( $class ); ?>" id="main-wrap">
					<div class="post-section">	
						<div class="content-wrap">
							<div class="row">
								<?php
									$the_query = new WP_Query( array( 'post__in' => get_option( 'sticky_posts' ), 'paged' => $paged ) );
									if ( $the_query->have_posts() ) :
										while ( $the_query->have_posts() ) : $the_query->the_post();
											if( is_home() && is_sticky() ){
												get_template_part( 'template-parts/archive/content', '' );
											}
										endwhile;
										wp_reset_postdata();
									endif;
								?>
							</div>
							<div class="row <?php echo esc_attr( $layout_class ), ' ', esc_attr( $masonry_class ); ?>">
								<?php
									while ( have_posts() ) : the_post();

										get_template_part( 'template-parts/archive/content', '' );

										# If comments are open or we have at least one comment, load up the comment template.
										if ( comments_open() || get_comments_number() ) :
											comments_template();
										endif;

									endwhile; # End of the loop.
								?>
							</div>
						</div>
					</div>
					<?php
						if( !travelbiz_get_option( 'disable_pagination' ) ):
							the_posts_pagination( array(
								'next_text' => '<span>'.esc_html__( 'Next', 'travelbiz' ) .'</span><span class="screen-reader-text">' . esc_html__( 'Next page', 'travelbiz' ) . '</span>',
								'prev_text' => '<span>'.esc_html__( 'Prev', 'travelbiz' ) .'</span><span class="screen-reader-text">' . esc_html__( 'Previous page', 'travelbiz' ) . '</span>',
								'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'travelbiz' ) . ' </span>',
							));
						endif;
					?>
				</div>
				<?php if( travelbiz_get_option( 'archive_layout' ) == 'right' ): ?>
					<?php get_sidebar(); ?>
				<?php endif; ?>
			</div>
		</div>
	</section>
<?php 
else: 
	get_template_part( 'template-parts/page/content', 'none' );
endif;

get_footer();