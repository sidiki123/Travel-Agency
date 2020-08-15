<?php
/**
 * Template part for displaying header site branding
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @since Travelbiz 1.0.0
 */
?>

<?php if( !travelbiz_get_option( 'site_identity_options' ) == 'site_identity_hide_all' || travelbiz_get_option( 'site_identity_options' ) == 'site_identity_show_all' || travelbiz_get_option( 'site_identity_options' ) == 'site_identity_title_only' || travelbiz_get_option( 'site_identity_options' ) == 'site_identity_tagline_only' || travelbiz_get_option( 'site_identity_options' ) == 'site_identity_logo_title' || travelbiz_get_option( 'site_identity_options' ) == 'site_identity_logo_tagline' ): ?>
	<div class="site-branding-outer">
		<div class="site-branding">
		<?php
			if( !travelbiz_get_option( 'site_identity_options' ) == 'site_identity_hide_all' || travelbiz_get_option( 'site_identity_options' ) == 'site_identity_show_all' || !travelbiz_get_option( 'site_identity_options' ) == 'site_identity_title_only' || !travelbiz_get_option( 'site_identity_options' ) == 'site_identity_tagline_only' || travelbiz_get_option( 'site_identity_options' ) == 'site_identity_logo_title' || travelbiz_get_option( 'site_identity_options' ) == 'site_identity_logo_tagline' ){
				the_custom_logo();
			}

			if( display_header_text() ){
				
				if ( is_front_page() && !is_home() ){
					if( get_bloginfo( 'name' ) && ( !travelbiz_get_option( 'site_identity_options' ) == 'site_identity_hide_all' || travelbiz_get_option( 'site_identity_options' ) == 'site_identity_show_all' || travelbiz_get_option( 'site_identity_options' ) == 'site_identity_title_only' || !travelbiz_get_option( 'site_identity_options' ) == 'site_identity_tagline_only' || travelbiz_get_option( 'site_identity_options' ) == 'site_identity_logo_title' || !travelbiz_get_option( 'site_identity_options' ) == 'site_identity_logo_tagline' ) ){
						?>
							<h1 class="site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<?php bloginfo( 'name' ); ?>
								</a>
							</h1>
						<?php
					}

				}else {
					if( get_bloginfo( 'name' ) && ( !travelbiz_get_option( 'site_identity_options' ) == 'site_identity_hide_all' || travelbiz_get_option( 'site_identity_options' ) == 'site_identity_show_all' || travelbiz_get_option( 'site_identity_options' ) == 'site_identity_title_only' || !travelbiz_get_option( 'site_identity_options' ) == 'site_identity_tagline_only' || travelbiz_get_option( 'site_identity_options' ) == 'site_identity_logo_title' || !travelbiz_get_option( 'site_identity_options' ) == 'site_identity_logo_tagline' ) ){
						?>
							<p class="site-title">
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
									<?php bloginfo( 'name' ); ?>
								</a>
							</p>
						<?php
					}
				}
				
				if( get_bloginfo( 'description' ) && ( !travelbiz_get_option( 'site_identity_options' ) == 'site_identity_hide_all' || travelbiz_get_option( 'site_identity_options' ) == 'site_identity_show_all' || !travelbiz_get_option( 'site_identity_options' ) == 'site_identity_title_only' || travelbiz_get_option( 'site_identity_options' ) == 'site_identity_tagline_only' || !travelbiz_get_option( 'site_identity_options' ) == 'site_identity_logo_title' || travelbiz_get_option( 'site_identity_options' ) == 'site_identity_logo_tagline' ) ){
					?>
						<p class="site-description">
							<?php echo get_bloginfo( 'description', 'display' ); ?>
						</p>
					<?php
				}
			}
		?>
		</div><!-- .site-branding -->
	</div>
<?php endif; ?>