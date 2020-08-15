<?php
/**
 * Template part for displaying Off-canvas Menu
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @since Travelbiz 1.0.0
 */
?>

<div id="offcanvas-menu">
	<div class="offcanvas-menu-wrap">
		<?php if(!travelbiz_get_option( 'disable_search_icon' )): ?>
			<div class="offcanvas-search-wrap  d-block d-lg-none">
				<?php get_search_form(); ?>
			</div>
		<?php endif; ?>
		<div id="primary-nav-offcanvas" class="offcanvas-navigation d-block d-lg-none">
			<?php echo travelbiz_get_menu( 'primary' ); ?>
		</div>
		<?php if ( is_active_sidebar( 'header-sidebar' ) ): ?>
			<div class="col-12">
				<sidebar class="sidebar clearfix" id="primary-sidebar">
					<?php dynamic_sidebar( 'header-sidebar' ); ?>
				</sidebar>
			</div>
		<?php endif; ?>
		<div  class="offcanvas-contact-details d-block d-lg-none">
			<div class="top-header-menu">
				<ul>
					<?php if ( travelbiz_get_option( 'top_header_phone') && !travelbiz_get_option ( 'disable_top_header_phone' ) ): ?>
						<li>
							<a href="tel:<?php echo wp_kses_post(  travelbiz_get_option( 'top_header_phone' ) ); ?>">
								<span class="kfi kfi-phone"></span>
								<?php echo wp_kses_post( travelbiz_get_option( 'top_header_phone' ) ); ?></a>
						</li>
					<?php endif; ?>

					<?php if ( travelbiz_get_option( 'top_header_email') && !travelbiz_get_option ( 'disable_top_header_email' ) ): ?>
						<li>
							<a href="mailto:<?php echo wp_kses_post(  travelbiz_get_option( 'top_header_email' ) ); ?>">
								<span class="kfi kfi-mail-alt"></span>
								<?php echo wp_kses_post( travelbiz_get_option( 'top_header_email' ) ); ?></a>
						</li>
					<?php endif; ?>

					<?php if ( travelbiz_get_option( 'top_header_address') && !travelbiz_get_option ( 'disable_top_header_address' ) ): ?>
						<li>
							<span class="kfi kfi-pin-alt"></span>
							<?php echo wp_kses_post( travelbiz_get_option( 'top_header_address' ) ); ?>
						</li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
		<div class="close-offcanvas-menu">
			<button class="non-style-btn">
				<span class="kfi kfi-close-alt2"></span>
			</button>
		</div>
	</div>
</div>