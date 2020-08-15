<?php
/**
 * Template part for displaying header layout
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @since Travelbiz 1.0.0
 */
?>

<header id="masthead" class="wrapper site-header header-primary" role="banner">
	<div class="top-header d-none d-lg-block">
		<div class="container">
			<div class="top-inner-wrap">
				<div class="row align-items-center">
					<?php
						$headerIconClass = '';
						$headerMenuClass = '';
						if (!travelbiz_get_option ( 'disable_top_header_phone' ) || !travelbiz_get_option ( 'disable_top_header_email' ) || !travelbiz_get_option ( 'disable_top_header_address' ) ? $headerIconClass = 'col-lg-4' : $headerIconClass = 'col-lg-12' );

						if ( has_nav_menu( 'social' ) || !travelbiz_get_option( 'disable_search_icon' ) || !travelbiz_get_option ( 'disable_hamburger_menu_icon' ) ? $headerMenuClass = 'col-lg-8' : $headerMenuClass = 'col-lg-12 text-center' );
					?>
					<?php if(!travelbiz_get_option ( 'disable_top_header_phone' ) || !travelbiz_get_option ( 'disable_top_header_email' ) || !travelbiz_get_option ( 'disable_top_header_address' )): ?>
						<div class="<?php echo esc_attr ( $headerMenuClass ); ?>">
							<div class="top-header-menu">
								<ul>
									<?php if ( travelbiz_get_option( 'top_header_phone')  && !travelbiz_get_option ( 'disable_top_header_phone' ) ): ?>
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
					<?php endif; ?>
					<?php if( has_nav_menu( 'social' ) || !travelbiz_get_option( 'disable_search_icon' ) || !travelbiz_get_option ( 'disable_hamburger_menu_icon' )): ?>
						<div class="<?php echo esc_attr ( $headerIconClass ); ?>">
							<div class="header-icons-wrap">
								<?php if( has_nav_menu( 'social' )): ?>
									<div class="socialgroup">
										<?php echo travelbiz_get_menu( 'social' ); ?>
									</div>
								<?php endif; ?>
								<?php
									get_template_part('template-parts/header/header', 'search');
								
									$hamburger_menu_class = '';
									if( travelbiz_get_option( 'disable_hamburger_menu_icon' ) ){
										$hamburger_menu_class = 'd-inline-block d-lg-none';
									}
								if( is_active_sidebar( 'header-sidebar' )  && !travelbiz_get_option ( 'disable_hamburger_menu_icon' )) {
								?>
									<div class="alt-menu-icon d-none d-lg-block <?php echo esc_attr( $hamburger_menu_class ); ?>">
										<button class="non-style-btn offcanvas-menu-toggler">
											<span class="icon-bar"></span>
										</button>
									</div>
								<?php } ?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<?php get_template_part( 'template-parts/header/offcanvas', 'menu' ); ?>
	<div class="header-group-wrap">
		<div class="main-navigation-wrap">
			<div class="container">
				<div class="main-navigation-inner">
					<div class="row align-items-center">
						<?php if( display_header_text() || has_custom_logo() ): ?>
							<div class="col-5 col-lg-3">
								<?php
									get_template_part( 'template-parts/header/site', 'branding' );
								?>
							</div>
						<?php endif; ?>
						<div class="col-lg-9 col-7" id="primary-nav-container">
							<div class="wrap-nav main-navigation">
								<div id="navigation" class="d-none d-lg-block">
									<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'travelbiz' ); ?>">
										<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
											<?php esc_html_e( 'Primary Menu', 'travelbiz' ); ?>
										</button>
										<?php echo travelbiz_get_menu( 'primary' ); ?>
									</nav>
								</div>
							</div>
							<?php if ( travelbiz_get_option( 'top_header_button') && !travelbiz_get_option ( 'disable_top_header_button' )  ): ?>
								<div class="header-btn">
									<a href="<?php echo wp_kses_post(  travelbiz_get_option( 'top_header_button_link' ) ); ?>" class="button-primary">
										<?php echo wp_kses_post(  travelbiz_get_option( 'top_header_button' ) ); ?>
									</a>
								</div>
							<?php endif; ?>
							<div class="alt-menu-icon d-block d-lg-none <?php echo esc_attr( $hamburger_menu_class ); ?>">
								<button class="non-style-btn offcanvas-menu-toggler">
									<span class="icon-bar"></span>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Search form structure -->
	<div class="header-search-wrap">
		<div id="header-search-form">
			<?php get_search_form(); ?>
		</div>
		<button class="header-search-close non-style-btn">
			<span class="kfi kfi-close-alt2"></span>
		</button>
	</div>

</header>