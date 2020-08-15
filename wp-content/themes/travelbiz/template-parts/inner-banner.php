<?php
/**
 * Template part for displaying Inner Banner Section for all the inner pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @since Travelbiz 1.0.0
 */
?>

<?php if( travelbiz_get_option( 'page_header_layout' ) == 'header_layout_one' ): ?>
	<section class="section-banner-wrap section-banner-one">
		<div class="wrap-outer-banner">
			<div class="overlay"></div>
			<div class="wrap-inner-banner" style="background-image: url('<?php if( is_front_page() || is_home() ){ echo wp_kses_post( $args[ 'image' ] ); } else if( is_404() ){ echo wp_kses_post( $args[ 'image' ] ); } else { header_image(); }  ?>')">
				<div class="container">
					<header class="page-header">
						<div class="inner-header-content">
							<?php 
								if( is_single() && !travelbiz_get_option( 'disable_single_date' ) ){
									travelbiz_time_link();
								}
							?>
							<?php if ( !travelbiz_get_option( 'disable_header_title' ) ){ ?>
								<h1 class="page-title"><?php echo wp_kses_post( $args[ 'title' ] ); ?></h1>
							<?php } ?>
							<?php if( $args[ 'description' ] ): 
								 if ( !travelbiz_get_option( 'disable_header_description' ) ){ ?>
									<div class="page-description">
										<?php echo wp_kses_post( $args[ 'description' ] ); ?>
									</div>
							<?php  } endif; ?>
						</div>
					</header>
				</div>
			</div>
			<?php if(!is_front_page() && !travelbiz_get_option( 'disable_bradcrumb' ) ): ?>
				<div class="breadcrumb-wrap">
					<div class="container">
						<?php 
							travelbiz_breadcrumb();
						?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</section>
<?php endif; ?>