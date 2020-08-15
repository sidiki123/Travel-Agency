<?php 
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @since Travelbiz 1.0.0
 */

get_header();
travelbiz_inner_banner();
?>
<section class="wrap-detail-page">
	<div class="container">
		<div class="row">
			<?php if( travelbiz_get_option( 'page_layout' ) == 'left' ): ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
			<?php $class = ''; ?>
			<?php
				if( travelbiz_get_option( 'page_layout' ) == 'none' ) {
					$class = 'col-lg-12';
				}else {
					$class = 'col-lg-8';
				}
			?>
				<div id="primary" class="<?php echo esc_attr( $class ); ?>">
					<?php if( has_post_thumbnail() && !travelbiz_get_option( 'disable_page_feature_image' ) ): ?>
					    <div class="post-thumbnail">
					        <?php the_post_thumbnail( 'travelbiz-1200-710' ); ?>
					    </div>
					<?php endif; ?>
					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/page/content', '' );

						# If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; # End of the loop.
					?>
				</div>
			<?php if( travelbiz_get_option( 'page_layout' ) == 'right' ): ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php
get_footer();