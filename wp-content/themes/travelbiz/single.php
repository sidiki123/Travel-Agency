<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 * @since Travelbiz 1.0.0
 */
get_header();

# Print banner with breadcrumb and post title.
travelbiz_inner_banner();
?>
<section class="wrap-detail-page" id="main-content">
	<div class="container">
		<div class="row">
			<?php if( travelbiz_get_option( 'single_layout' ) == 'left' ): ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
			<?php $class = ''; ?>
			<?php
				if( travelbiz_get_option( 'single_layout' ) == 'none' ) {
					$class = 'col-lg-12';
				}else {
					$class = 'col-lg-8';
				}
			?>
			<div id="primary" class="<?php echo esc_attr( $class ); ?>">
				<main id="main" class="post-main-content" role="main">
					<?php if( has_post_thumbnail() && !travelbiz_get_option( 'disable_single_feature_image' ) ): ?>
					    <div class="post-thumbnail">
					        <?php the_post_thumbnail( 'travelbiz-1200-710' ); ?>
					    </div>
					<?php endif; ?>
					<?php
						# Loop Start
						while( have_posts() ): the_post();

							# Print posts respect to the post format
							get_template_part( 'template-parts/single/content', get_post_format() );

							# Print the author details of this post
							if( 'post' == get_post_type() && !travelbiz_get_option( 'disable_single_author' ) ) {
								get_template_part( 'template-parts/single/content', 'author-detail' );
							}

							# If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;

							# Navigate the post. Next post and Previou post.
							$post_navigation_prev_text = travelbiz_get_option( 'single_post_nav_prev' );
							$post_navigation_next_text = travelbiz_get_option( 'single_post_nav_next' );

							if ( 'post' === get_post_type() ){
								the_post_navigation( array(
									'prev_text' => '<span class="nav-label">' . $post_navigation_prev_text . '</span><span class="nav-title">%title</span>',
									'next_text' => '<span class="nav-label">' . $post_navigation_next_text . '</span><span class="nav-title">%title</span>',
								) );
							}

						# Loop End
						endwhile; 
					?>
				</main>
				
			</div>
			<?php if( travelbiz_get_option( 'single_layout' ) == 'right' ): ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>
