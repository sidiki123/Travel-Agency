<?php
/**
 * Template part for displaying blog items
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @since Travelbiz 1.0.0
 */
?>

<?php
$posts_per_page_count = travelbiz_get_option( 'blog_posts_number' );
$blog_category_id = travelbiz_get_option( 'blog_category' );

$args = array(
	'posts_per_page'      => $posts_per_page_count,
	'offset'              => 0,
	'category'            => $blog_category_id,
	'ignore_sticky_posts' => 1
	);
$posts_array = get_posts( $args );

if( count( $posts_array ) > 0 && !travelbiz_get_option( 'disable_blog' ) ):
	?>
	<section id="block-blog" class="section-blog">
		<div class="container">
			<?php if(!travelbiz_get_option( 'disable_blog_title' ) || !travelbiz_get_option( 'disable_blog_divider' ) ): ?>
				<div class="section-title-group">
					<?php if( !travelbiz_get_option( 'disable_blog_title' ) ):  ?>
						<h2 class="section-title"><?php echo wp_kses_post( travelbiz_get_option( 'blog_section_title' ) ); ?></h2>
					<?php endif; 
					 if( !travelbiz_get_option( 'disable_blog_divider' ) ): ?>
						<div class="divider"></div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<div class="block-blog-inner">
				<div class="row masonry-wrapper grid-post-wrap">
					<?php
						foreach ( $posts_array as $post ) : setup_postdata( $post );
						$image = travelbiz_get_thumbnail_url( array(
							'size' => 'travelbiz-380-250'
						));
						$class = '';
						if(!has_post_thumbnail()){
							$class = 'no-thumbnail';
						}
					?>
					<div class="col-lg-4 col-sm-6 col-12 grid-post">
						<article class="post">
							<figure class="feature-image <?php echo esc_attr( $class ); ?>">
								<?php if( has_post_thumbnail() ): ?>
									<a href="<?php the_permalink(); ?>">
										<img src="<?php echo esc_url( $image );?>">
									</a>
								<?php endif; ?>
								<div class="entry-header">
									<?php
										if( 'post' == get_post_type() && !travelbiz_get_option( 'disable_blog_category_title' ) ):
											$cat = travelbiz_get_the_category();
											if( $cat ):
												?>
											<div class="entry-meta-cat">
												<?php
													$term_link = get_category_link( $cat[ 0 ]->term_id );
												?>
												<a href="<?php echo esc_url( $term_link ); ?>">
													<?php echo esc_html( $cat[0]->name ); ?>
												</a>
											</div>
											<?php
											endif;
										endif;
									?>
								</div>
							</figure>
							<div class="post-content">
								<h3 class="entry-title">
									<?php if( !travelbiz_get_option( 'disable_blog_post_title' ) ): ?>
										<a href="<?php the_permalink(); ?>">
											<?php the_title(); ?>
										</a>
									<?php endif ?>
								</h3>
								<?php if( !travelbiz_get_option ('disable_blog_date') || !travelbiz_get_option ('disable_blog_author') || !travelbiz_get_option ('disable_blog_comment_link') ) : ?>
									<div class="meta-tag">
										<?php if( !travelbiz_get_option( 'disable_blog_date' ) ): ?>
											<div class="meta-time">
												<a href="<?php echo esc_url( travelbiz_get_day_link() ); ?>" >
													<?php echo esc_html(get_the_date('M j, Y')); ?>
												</a>
											</div>
										<?php endif; ?>
										<?php if( !travelbiz_get_option( 'disable_blog_author' ) ): ?>
											<div class="meta-author">
												<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
													<?php echo get_the_author(); ?>
												</a>
											</div>
										<?php endif; ?>
										<?php if( !travelbiz_get_option( 'disable_blog_comment_link' ) ): ?>
											<div class="meta-comment">
												<a href="<?php comments_link(); ?>">
													<?php echo absint( wp_count_comments( get_the_ID() )->approved ); ?>
												</a>
											</div>
										<?php endif; ?>
									</div>
								<?php endif; ?>
							</div>
						</article>
					</div>
					<?php
						endforeach;
						wp_reset_postdata(); 	
					?>
				</div>
			</div>
		</div>
	</section>
<?php endif;