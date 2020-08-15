<?php
/**
 * Template part for displaying contact content
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @since Travelbiz 1.0.0
 */
?>

<?php
$class = '';

if( travelbiz_get_option( 'disable_contact_image' ) ){
	$class = 'no-image';
}else {
	$class = '';
}

if( !travelbiz_get_option( 'disable_contact' ) ): ?>
<section id="block-contact" class="section-contact <?php echo esc_attr( $class ); ?>">
	<div class="container">
		<div class="contact-detail-container">
			<div class="row align-items-center">
				<div class="col-md-7">
					<div class="contact-form-section">
						<?php if( travelbiz_get_option( 'contact_section_title' ) ): ?>
							<div class="section-title-group">
								<h2 class="section-title"><?php echo travelbiz_get_option( 'contact_section_title' ); ?></h2>
								<div class="divider"></div>
							</div>
						<?php endif; ?>
						<?php echo do_shortcode( travelbiz_get_option( 'contact_shortcode' ) ); ?>
					</div>
				</div>
				<div class="col-md-5">
					<div class="contact-detail-content">
						<div class="section-title-group">
							<?php if( travelbiz_get_option( 'contact_detail_title' ) && !travelbiz_get_option( 'disable_contact_detail_title' ) ): ?>
								<h3 class="section-title"><?php echo travelbiz_get_option( 'contact_detail_title' ); ?></h3>
							<?php endif; ?>
						</div>

						<?php if ( travelbiz_get_option( 'top_header_email') ): ?>
							<div class="contact-list contact-mail">
								<div class="icon-outer">
									<span class="kfi kfi-mail-alt"></span>
								</div>
								<div class="contact-content">
									<div class="contact-title">
										<?php echo travelbiz_get_option( 'contact_mail_title' ); ?>
									</div>
									<a href="mailto:<?php echo wp_kses_post(  travelbiz_get_option( 'top_header_email' ) ); ?>"><?php echo wp_kses_post( travelbiz_get_option( 'top_header_email' ) ); ?>
									</a>
								</div>
							</div>
						<?php endif; ?>

						<?php if ( travelbiz_get_option( 'top_header_phone') ): ?>
							<div class="contact-list contact-phone-one">
								<div class="icon-outer">
									<span class="kfi kfi-phone"></span>
								</div>
								<div class="contact-content"> 
									<div class="contact-title">
										<?php echo travelbiz_get_option( 'contact_phone_one_title' ); ?>
									</div>
									<a href="tel:<?php echo wp_kses_post(  travelbiz_get_option( 'top_header_phone' ) ); ?>"><?php echo wp_kses_post( travelbiz_get_option( 'top_header_phone' ) ); ?>
									</a>
								</div>
							</div>
						<?php endif; ?>

						<?php if ( travelbiz_get_option( 'top_header_address') ): ?>
							<div class="contact-list contact-address">
								<div class="icon-outer">
									<span class="kfi kfi-pin"></span>
								</div>
								<div class="contact-content">
									<div class="contact-title">
										<?php echo travelbiz_get_option( 'contact_address_title' ); ?>
									</div>
									<?php echo wp_kses_post( travelbiz_get_option( 'top_header_address' ) ); ?>
								</div>
							</div>
						<?php endif; ?>
						<div class="socialgroup">
							<?php echo travelbiz_get_menu( 'social' ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
endif;