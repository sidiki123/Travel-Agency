<?php
/**
 * Template part for displaying top footer
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @since Travelbiz 1.0.0
 */
?>

<div class="top-footer">
	<div class="container">
		<?php if( !travelbiz_get_option( 'disable_footer_widget' ) ):
		
		if( travelbiz_is_active_footer_sidebar() ):
		?>
			<div class="footer-widget-wrap">
				<div class="row">
				<?php
					$count = 0;
					for( $i = 1; $i <= 4; $i++ ){
						?>
							<?php if ( is_active_sidebar( 'travelbiz-footer-sidebar-'.$i ) ) : ?>
								<div class="col-lg-3 col-md-6 col-12 footer-widget-item">
								<?php dynamic_sidebar( 'travelbiz-footer-sidebar-'.$i ); ?>
								</div>
							<?php endif; ?>
						<?php
					}
					if( $count > 0 ){
						$return = true;
					}else{
						$return = false;
					}
				?>
				</div>
			</div>
		<?php
			endif;
		endif
		?>
	</div>
</div>