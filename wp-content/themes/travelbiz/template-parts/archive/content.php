<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @since Travelbiz 1.0.0
 */
?>

<?php
	$class = '';
	if( travelbiz_get_option( 'archive_post_layout' ) == 'grid' ){
		$class = 'col-lg-6 col-md-6 col-12 grid-post';
	}else {
		$class = 'col-12';
	}
	if( travelbiz_get_option( 'archive_post_layout' ) == 'grid' && travelbiz_get_option( 'archive_layout' ) == 'none' || travelbiz_is_search() ){
		$class = 'col-lg-4 col-md-6 col-12 grid-post';
	}
	if( travelbiz_is_search() ){
		$class = 'col-lg-3 col-md-4 col-12 grid-post';
	}
	if( is_sticky() ){
		$class = 'col-lg-12 col-md-12 col-12 grid-post';
	}
?>
<div class="<?php echo esc_attr( $class ); ?>">
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>
		<?php
			$size = 'travelbiz-380-250';
			$args = array(
				'size' => $size,
				);

			# Disabling dummy thumbnails when its in search page, also support for jetpack's infinite scroll
			if( 'post' != get_post_type() && travelbiz_is_search() ){
				$args[ 'dummy' ] = false;
			}
		?>
		<?php 
			if( travelbiz_get_option( 'archive_post_layout' ) == 'list' && has_post_thumbnail() ){
		?>
			<div class="row">
			<?php
				if( is_sticky() ){
					?>
						<div class="col-lg-12">
					<?php
				}else {
					?>
						<div class="col-lg-6">
					<?php
				}
			}
		?>
		<?php
			if( has_post_thumbnail() ):
		?>
			<?php travelbiz_post_thumbnail( $args ); ?>
		<?php
			endif;
		?>
		<?php 
			if( travelbiz_get_option( 'archive_post_layout' ) == 'list' && has_post_thumbnail() ){
		?>
			</div> <!-- end col-lg-6 -->
			<?php
				if( is_sticky() ){
					?>
						<div class="col-lg-12">
					<?php
				}else {
					?>
						<div class="col-lg-6">
					<?php
				}
			}
		?>
		<div class="post-content">
			<header class="entry-header">
				<?php if('post' == get_post_type() && !travelbiz_get_option( 'disable_archive_cat_link' ) ){ ?>
				<?php
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
				?>
				<?php } ?>
				<h3 class="entry-title">
					<a href="<?php the_permalink(); ?>">
						<?php echo get_the_title(); ?>
					</a>
				</h3>
			</header>
			<div class="post-text">
				<?php
					$excerpt_length = travelbiz_get_option( 'post_excerpt_length' );
					$sticky_simple_excerpt_length = travelbiz_get_option( 'sticky_simple_post_excerpt_length' );
					if( is_sticky() || travelbiz_get_option( 'archive_post_layout' ) == 'simple' ){
						travelbiz_excerpt( $sticky_simple_excerpt_length , true );
					}else {
						travelbiz_excerpt( $excerpt_length , true );
					}
				?>
			</div>
			<?php 
				if('post' == get_post_type() && !travelbiz_get_option( 'disable_archive_date') || !travelbiz_get_option( 'disable_archive_author' ) || !travelbiz_get_option( 'disable_archive_comment_link' ) ){ 
				?>
					<div class="meta-tag">
						<?php if( !travelbiz_get_option( 'disable_archive_date' ) ): ?>
							<div class="meta-time">
								<a href="<?php echo esc_url( travelbiz_get_day_link() ); ?>" >
									<?php echo esc_html(get_the_date('M j, Y')); ?>
								</a>
							</div>
						<?php endif; ?>
						<?php if( !travelbiz_get_option( 'disable_archive_author' ) ): ?>
							<div class="meta-author">
								<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
									<?php echo get_the_author(); ?>
								</a>
							</div>
						<?php endif; ?>
						<?php if( !travelbiz_get_option( 'disable_archive_comment_link' ) ): ?>
							<div class="meta-comment">
								<a href="<?php comments_link(); ?>">
									<?php echo absint( wp_count_comments( get_the_ID() )->approved ); ?>
								</a>
							</div>
						<?php endif; ?>
					</div>
				<?php } 
			?>
		</div>
		<?php 
			if( travelbiz_get_option( 'archive_post_layout' ) == 'list' && has_post_thumbnail() ){
				?>
					</div> <!-- end col-lg-6 -->
				</div> <!-- end row -->
				<?php
			}
		?>
	</article>
</div>