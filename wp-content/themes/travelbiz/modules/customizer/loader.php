<?php
/**
* Loads all the components related to customizer 
*
* @since Travelbiz 1.0.0
*/
require get_parent_theme_file_path( '/modules/customizer/framework/customizer.php' );
require get_parent_theme_file_path( '/modules/customizer/panels/panels.php' );
require get_parent_theme_file_path( '/modules/customizer/sections/sections.php' );
require get_parent_theme_file_path( '/modules/customizer/settings/general.php' );
require get_parent_theme_file_path( '/modules/customizer/settings/frontpage.php' );
require get_parent_theme_file_path( '/modules/customizer/defaults/defaults.php' );
require get_parent_theme_file_path( '/modules/customizer/settings/homepage.php' );

function travelbiz_modify_default_settings( $wp_customize ){

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_setting( 'background_color' )->transport = 'postMessage';
	$wp_customize->get_control( 'background_color' )->label = esc_html__( 'Background', 'travelbiz' );
	// remove defaults
	$wp_customize->remove_control( 'header_textcolor' );
}
add_action( 'travelbiz_customize_register', 'travelbiz_modify_default_settings' );

function travelbiz_default_styles(){
	
	# Color
	$site_title_color     = travelbiz_get_option( 'site_title_color' );
	$site_tagline_color   = travelbiz_get_option( 'site_tagline_color' );
	$site_body_text_color = travelbiz_get_option( 'site_body_text_color' );
	$primary_color        = travelbiz_get_option( 'site_primary_color' );
	$hover_color          = travelbiz_get_option( 'site_hover_color' );

	# Header Image
	$home_overlay_opacity = travelbiz_get_option( 'home_overlay_opacity' );
	$error_overlay_opacity = travelbiz_get_option( 'error_overlay_opacity' );

	# Page Header
	$page_header_overlay_opacity = travelbiz_get_option( 'page_header_overlay_opacity' );

	# Archive Slider
	$slider_overlay_opacity = travelbiz_get_option( 'slider_overlay_opacity' );

	# Front Page

	# Blog Section
	$blog_post_overlay_opacity = travelbiz_get_option( 'blog_post_overlay_opacity' );
	$blog_post_overlay_color = travelbiz_hex2rgba($primary_color, 0.6);

	# Callback Section
	$callback_image_overlay_opacity = travelbiz_get_option( 'callback_image_overlay_opacity' );

	# Testimonial Section
	$testimonial_image_overlay_opacity = travelbiz_get_option( 'testimonial_image_overlay_opacity' );

	# Service Section
	$service_image_overlay_opacity = travelbiz_get_option( 'service_image_overlay_opacity' );
	?>
	<style type="text/css">

		/*======================================*/
		/* Hamburger Menu Icon */
		/*======================================*/
		<?php if( travelbiz_get_option( 'disable_hamburger_menu_icon' ) ): ?>
			@media screen and ( min-width: 992px ){
				.alt-menu-icon {
					display: none;
				}
			}
		<?php endif; ?>

		/*======================================*/
		/* Page Header Overlay Opacity */
		/*======================================*/
		.section-banner-wrap .overlay {
			background-color: rgba(0, 0, 0, 0.<?php echo esc_attr( $page_header_overlay_opacity ); ?>);
		}

		/*======================================*/
		/* Header Image*/
		/*======================================*/
		/*Overlay Opacity*/
		body.home .section-banner-wrap .overlay {
			background-color: rgba(0, 0, 0, 0.<?php echo esc_attr( $home_overlay_opacity ); ?>);
		}
		body.error404 .section-banner-wrap .overlay {
			background-color: rgba(0, 0, 0, 0.<?php echo esc_attr( $error_overlay_opacity ); ?>);
		}

		/*======================================*/
		/* Archive Slider*/
		/*======================================*/
		/*Overlay Opacity*/
		.section-slider .banner-overlay {
			background-color: rgba(0, 0, 0, 0.<?php echo esc_attr( $slider_overlay_opacity ); ?>);
		}

		/*======================================*/
		/* Breadcrumb Separator Layout */
		/*======================================*/
		<?php if( travelbiz_get_option( 'breadcrumb_separator_layout' ) == 'separator_layout_one' ): ?>
			.breadcrumb-wrap .breadcrumbs .trail-items a:after {
			    height: 12px;
			    -webkit-transform: rotate(25deg);
			    -moz-transform: rotate(25deg);
			    -ms-transform: rotate(25deg);
			    -o-transform: rotate(25deg);
			    transform: rotate(25deg);
			    width: 1px;
			}
		<?php endif; ?>

		<?php if( travelbiz_get_option( 'breadcrumb_separator_layout' ) == 'separator_layout_two' ): ?>
			.breadcrumb-wrap .breadcrumbs .trail-items a:after {
			    height: 6px;
			    width: 6px;
			    -webkit-border-radius: 100%;
			    -moz-border-radius: 100%;
			    -ms-border-radius: 100%;
			    -o-border-radius: 100%;
			    border-radius: 100%;
			}
		<?php endif; ?>

		<?php if( travelbiz_get_option( 'breadcrumb_separator_layout' ) == 'separator_layout_three' ): ?>
			.breadcrumb-wrap .breadcrumbs .trail-items a:after {
			    height: 6px;
			    width: 6px;
			}
		<?php endif; ?>

		<?php if( travelbiz_get_option( 'enable_breadcrumb_home_icon' ) ): ?>
			.breadcrumb-wrap .breadcrumbs .trail-items a[rel="home"] span {
				font-size: 0;
			}
			.breadcrumb-wrap .breadcrumbs .trail-items a[rel="home"] span:before {
			    font-size: 16px;
			    content: "\e074";
			    font-family: "kf-icons";
			}
		<?php endif; ?>

		/*======================================*/
		/* Site Title Color */
		/*======================================*/
		.site-header .site-branding .site-title {
			color: <?php echo esc_attr( $site_title_color ); ?>;
		}

		/*======================================*/
		/* Tagline Color */
		.site-header .site-branding .site-description {
			color: <?php echo esc_attr( $site_tagline_color ); ?>;
		}

		/*======================================*/
		/* Site Body Text Color */
		/*======================================*/
		body, html {
			color: <?php echo esc_attr( $site_body_text_color ); ?>;
		}
		
		/*======================================*/
		/* Primary Color */
		/*======================================*/

		/* Background */
		figcaption, .wrap-detail-page .kt-contact-form-area .form-group input.form-control[type=submit], input[type=button], input[type=reset], input[type=submit], .button-primary, .button-round, .section-title-group .divider:before, .page-numbers.current, .page-numbers:hover.current, .page-numbers:focus.current, .page-numbers:active.current, .woocommerce ul.products li.product .onsale, .woocommerce ul.products li.product .button, .woocommerce ul.products li.product a.added_to_cart, body.woocommerce.single-product .product .onsale, .wp-travel.trip-headline-wrapper button, .wp-travel .button, .wp-travel-offer span, .wrap-detail-page .post-footer .post-format, .comments-area .comment-respond .comment-form .submit, .searchform .search-button, #go-top:hover span, #go-top:focus span, #go-top:active span, .widget.widget_product_search button, .section-slider .controls [class*=owl-]:not(.disabled):hover, .section-slider .controls [class*=owl-]:not(.disabled):focus, .section-slider .controls [class*=owl-]:not(.disabled):active, .section-slider #slide-pager .owl-dot.active span, .entry-meta-cat a, .package-post .wp-travel-offer span, .section-testimonial .controls [class*=owl-]:not(.disabled), .section-blog .post .entry-meta-cat a, .section-clients .controls [class*=owl-]:not(.disabled), .wp-travel.trip-headline-wrapper button,  .tab-list-content .panel-group .open-all-link, .wp-travel-toolbar .wp-travel-filter-button .btn-wp-travel-filter, .wp-travel-default-article .wp-travel-explore a, .wp-travel-toolbar .wp-travel-post-filter .wp-travel-filter-by-heading, .woocommerce #respond input#submit, .woocommerce input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce .cart .button, .woocommerce .cart input.button, .woocommerce button.button.alt, .woocommerce a.button.alt, .woocommerce input.button.alt {
			background-color: <?php echo esc_attr( $primary_color ); ?>
		}


		/* Border */
		.button-primary, .button-round, .page-numbers.current, .page-numbers:hover.current, .page-numbers:focus.current, .page-numbers:active.current, .woocommerce ul.products li.product a.added_to_cart, .comments-area .comment-respond .comment-form .submit, #go-top:hover span, #go-top:focus span, #go-top:active span, .main-navigation nav > ul ul {
			border-color: <?php echo esc_attr( $primary_color ); ?>
		}

		/* Text */
		.woocommerce ul.products li.product .price .amount, .inner-header-content .posted-on a, .widget.widget_rss li a, .section-contact .contact-form-section h3 {
			color: <?php echo esc_attr( $primary_color ); ?>
		}

		/*======================================*/
		/* Hover Color */
		/*======================================*/

		/* Background */
		.wrap-detail-page .kt-contact-form-area .form-group input.form-control[type=submit]:hover, .wrap-detail-page .kt-contact-form-area .form-group input.form-control[type=submit]:focus, .wrap-detail-page .kt-contact-form-area .form-group input.form-control[type=submit]:active, .comments-area .comment-list .reply a:hover, .wp-travel.trip-headline-wrapper button:hover, .button-outline:hover, .button-primary:hover, .button-round:hover, .button:hover, input[type=button]:hover, input[type=reset]:hover, input[type=submit]:hover, .comments-area .comment-list .reply a:focus, .wp-travel.trip-headline-wrapper button:focus, .button-outline:focus, .button-primary:focus, .button-round:focus, .button:focus, input[type=button]:focus, input[type=reset]:focus, input[type=submit]:focus, .comments-area .comment-list .reply a:active, .wp-travel.trip-headline-wrapper button:active, .button-outline:active, .button-primary:active, .button-round:active, .button:active, input[type=button]:active, input[type=reset]:active, input[type=submit]:active, .button-primary:hover, .button-primary:focus, .button-primary:active, .button-round:hover, .button-round:focus, .button-round:active, .page-numbers:hover, .page-numbers:focus, .page-numbers:active, .infinite-scroll #infinite-handle span:hover, .infinite-scroll #infinite-handle span:focus, .infinite-scroll #infinite-handle span:active, .woocommerce ul.products li.product .onsale:hover, .woocommerce ul.products li.product .onsale:focus, .woocommerce ul.products li.product .onsale:active, .woocommerce ul.products li.product .button:hover, .woocommerce ul.products li.product .button:active, .woocommerce ul.products li.product a.added_to_cart:hover, .woocommerce ul.products li.product a.added_to_cart:focus, .woocommerce ul.products li.product a.added_to_cart:active, .woocommerce #respond input#submit:hover, .woocommerce #respond input#submit:focus, .woocommerce #respond input#submit:active, .woocommerce input#submit:hover, .woocommerce input#submit:focus, .woocommerce input#submit:active, .woocommerce a.button:hover, .woocommerce a.button:focus, .woocommerce a.button:active, .woocommerce button.button:hover, .woocommerce button.button:focus, .woocommerce button.button:active, .woocommerce input.button:hover, .woocommerce input.button:focus, .woocommerce input.button:active, .woocommerce .cart .button:hover, .woocommerce .cart .button:focus, .woocommerce .cart .button:active, .woocommerce .cart input.button:hover, .woocommerce .cart input.button:focus, .woocommerce .cart input.button:active, .woocommerce button.button.alt:hover, .woocommerce button.button.alt:focus, .woocommerce button.button.alt:active, .woocommerce a.button.alt:hover, .woocommerce a.button.alt:focus, .woocommerce a.button.alt:active, .woocommerce input.button.alt:hover, .woocommerce input.button.alt:focus, .woocommerce input.button.alt:active, .wp-travel .button:hover, .post-content-inner .tag-links a:hover, .comments-area .comment-respond .comment-form .submit:hover, .comments-area .comment-respond .comment-form .submit:focus, .comments-area .comment-respond .comment-form .submit:active, .searchform .search-button:hover, .searchform .search-button:focus, .searchform .search-button:active, .widget.widget_calendar tbody a:hover, .widget.widget_calendar tbody a:focus, .widget.widget_calendar tbody a:active, .widget.widget_tag_cloud .tagcloud a:hover, .widget.widget_tag_cloud .tagcloud a:focus, .widget.widget_tag_cloud .tagcloud a:active, .widget.widget_product_search button:hover, .alt-menu-icon .offcanvas-menu-toggler:hover .icon-bar, .alt-menu-icon .offcanvas-menu-toggler:focus .icon-bar, .alt-menu-icon .offcanvas-menu-toggler:active .icon-bar, .alt-menu-icon .offcanvas-menu-toggler:hover .icon-bar:before, .alt-menu-icon .offcanvas-menu-toggler:hover .icon-bar:after, .alt-menu-icon .offcanvas-menu-toggler:focus .icon-bar:before, .alt-menu-icon .offcanvas-menu-toggler:focus .icon-bar:after, .alt-menu-icon .offcanvas-menu-toggler:active .icon-bar:before, .alt-menu-icon .offcanvas-menu-toggler:active .icon-bar:after, .section-slider #slide-pager .owl-dot span:hover, .section-slider #slide-pager .owl-dot span:focus, .section-slider #slide-pager .owl-dot span:active, .section-slider #slide-pager .owl-dot.active span:hover, .section-slider #slide-pager .owl-dot.active span:focus, .section-slider #slide-pager .owl-dot.active span:active, .top-footer .widget .search-button:hover, .top-footer .widget .search-button:focus, .top-footer .widget .search-button:active, .entry-meta-cat a:hover, .entry-meta-cat a:focus, .entry-meta-cat a:active, .section-testimonial .controls [class*=owl-]:not(.disabled):hover, .section-testimonial .controls [class*=owl-]:not(.disabled):focus, .section-testimonial .controls [class*=owl-]:not(.disabled):active, .section-blog .post .entry-meta-cat a:hover, .section-blog .post .entry-meta-cat a:focus, .section-blog .post .entry-meta-cat a:active, .section-clients .controls [class*=owl-]:not(.disabled):hover, .wp-travel-default-article .wp-travel-explore a:hover, .wp-travel-default-article .wp-travel-explore a:focus, .wp-travel-default-article .wp-travel-explore a:active, .wp-travel.trip-headline-wrapper button:hover, .wp-travel.trip-headline-wrapper button:active:hover, .wp-travel.trip-headline-wrapper button:focus:hover, .wp-travel.trip-headline-wrapper button:focus, .wp-travel.trip-headline-wrapper button:hover:focus, .wp-travel.trip-headline-wrapper button:active:focus, .wp-travel.trip-headline-wrapper button:active, .wp-travel.trip-headline-wrapper button:hover:active, .wp-travel.trip-headline-wrapper button:focus:active, .wp-travel .button:hover, .tab-list-content .panel-group .open-all-link:hover, .tab-list-content .panel-group .open-all-link:focus, .tab-list-content .panel-group .open-all-link:active, .wp-travel-toolbar .wp-travel-filter-button .btn-wp-travel-filter:hover, .wp-travel-toolbar .wp-travel-filter-button .btn-wp-travel-filter:focus, .wp-travel-toolbar .wp-travel-filter-button .btn-wp-travel-filter:active  {
		 	background-color: <?php echo esc_attr( $hover_color ); ?>
		}

		/* Border */
		.button-primary:hover, .button-primary:focus, .button-primary:active, .button-round:hover, .button-round:focus, .button-round:active, .button-outline:hover, .button-outline:focus, .button-outline:active, .page-numbers:hover, .page-numbers:focus, .page-numbers:active, .widget .bbp-login-links a:hover, .widget .bbp-login-links a:focus, .widget .bbp-login-links a:active, .woocommerce ul.products li.product a.added_to_cart:hover, .woocommerce ul.products li.product a.added_to_cart:focus, .woocommerce ul.products li.product a.added_to_cart:active, .woocommerce #respond input#submit:hover, .woocommerce #respond input#submit:focus, .woocommerce #respond input#submit:active, .woocommerce input#submit:hover, .woocommerce input#submit:focus, .woocommerce input#submit:active, .woocommerce a.button:hover, .woocommerce a.button:focus, .woocommerce a.button:active, .woocommerce button.button:hover, .woocommerce button.button:focus, .woocommerce button.button:active, .woocommerce input.button:hover, .woocommerce input.button:focus, .woocommerce input.button:active, .woocommerce .cart .button:hover, .woocommerce .cart .button:focus, .woocommerce .cart .button:active, .woocommerce .cart input.button:hover, .woocommerce .cart input.button:focus, .woocommerce .cart input.button:active, .woocommerce button.button.alt:hover, .woocommerce button.button.alt:focus, .woocommerce button.button.alt:active, .woocommerce a.button.alt:hover, .woocommerce a.button.alt:focus, .woocommerce a.button.alt:active, .woocommerce input.button.alt:hover, .woocommerce input.button.alt:focus, .woocommerce input.button.alt:active, .comments-area .comment-respond .comment-form .submit:hover, .comments-area .comment-respond .comment-form .submit:focus, .comments-area .comment-respond .comment-form .submit:active, .socialgroup a:hover, .socialgroup a:focus, .socialgroup a:active, .widget.widget_tag_cloud .tagcloud a:hover, .widget.widget_tag_cloud .tagcloud a:focus, .widget.widget_tag_cloud .tagcloud a:active, .section-slider .slider-content .button-container .button-outline:hover, .section-slider .slider-content .button-container .button-outline:focus, .section-slider .slider-content .button-container .button-outline:active, .section-slider #slide-pager .owl-dot span:hover, .section-slider #slide-pager .owl-dot span:focus, .section-slider #slide-pager .owl-dot span:active, .site-footer .socialgroup ul li a:hover, .site-footer .socialgroup ul li a:focus, .site-footer .socialgroup ul li a:active, .callback-content .button-container .button-outline:hover, .callback-content .button-container .button-outline:focus, .callback-content .button-container .button-outline:active, #faq .panel-heading [data-toggle=collapse], #faq .panel-heading [data-toggle=collapse].collapsed:hover, #faq .panel-heading [data-toggle=collapse].collapsed:focus, #faq .panel-heading [data-toggle=collapse].collapsed:active  {
			border-color: <?php echo esc_attr( $hover_color ); ?>
		}

		/* Text */
		.wrap-detail-page .kt-contact-form-area .form-group .cleaner:hover, .wrap-detail-page .kt-contact-form-area .form-group .cleaner:active, .wrap-detail-page .kt-contact-form-area .form-group .cleaner:focus, .wrap-detail-page .kt-contact-form-area .form-group .cleaner:hover span, .wrap-detail-page .kt-contact-form-area .form-group .cleaner:active span, .wrap-detail-page .kt-contact-form-area .form-group .cleaner:focus span, a.button-text:hover, a.button-text:focus, a.button-text:active, .button-text:hover, .button-text:focus, .button-text:active, a.button-text:hover:after, a.button-text:focus:after, a.button-text:active:after, .button-text:hover:after, .button-text:focus:after, .button-text:active:after, h1 a:hover, h1 a:focus, h1 a:active, h2 a:hover, h2 a:focus, h2 a:active, h3 a:hover, h3 a:focus, h3 a:active, h4 a:hover, h4 a:focus, h4 a:active, h5 a:hover, h5 a:focus, h5 a:active, h6 a:hover, h6 a:focus, h6 a:active, .comment-navigation .nav-previous a:hover .nav-label, .comment-navigation .nav-previous a:hover .nav-title, .comment-navigation .nav-previous a:hover:before, .comment-navigation .nav-previous a:focus .nav-label, .comment-navigation .nav-previous a:focus .nav-title, .comment-navigation .nav-previous a:focus:before, .comment-navigation .nav-previous a:active .nav-label, .comment-navigation .nav-previous a:active .nav-title, .comment-navigation .nav-previous a:active:before, .comment-navigation .nav-next a:hover .nav-label, .comment-navigation .nav-next a:hover .nav-title, .comment-navigation .nav-next a:hover:before, .comment-navigation .nav-next a:focus .nav-label, .comment-navigation .nav-next a:focus .nav-title, .comment-navigation .nav-next a:focus:before, .comment-navigation .nav-next a:active .nav-label, .comment-navigation .nav-next a:active .nav-title, .comment-navigation .nav-next a:active:before, .posts-navigation .nav-previous a:hover .nav-label, .posts-navigation .nav-previous a:hover .nav-title, .posts-navigation .nav-previous a:hover:before, .posts-navigation .nav-previous a:focus .nav-label, .posts-navigation .nav-previous a:focus .nav-title, .posts-navigation .nav-previous a:focus:before, .posts-navigation .nav-previous a:active .nav-label, .posts-navigation .nav-previous a:active .nav-title, .posts-navigation .nav-previous a:active:before, .posts-navigation .nav-next a:hover .nav-label, .posts-navigation .nav-next a:hover .nav-title, .posts-navigation .nav-next a:hover:before, .posts-navigation .nav-next a:focus .nav-label, .posts-navigation .nav-next a:focus .nav-title, .posts-navigation .nav-next a:focus:before, .posts-navigation .nav-next a:active .nav-label, .posts-navigation .nav-next a:active .nav-title, .posts-navigation .nav-next a:active:before, .post-navigation .nav-previous a:hover .nav-label, .post-navigation .nav-previous a:hover .nav-title, .post-navigation .nav-previous a:hover:before, .post-navigation .nav-previous a:focus .nav-label, .post-navigation .nav-previous a:focus .nav-title, .post-navigation .nav-previous a:focus:before, .post-navigation .nav-previous a:active .nav-label, .post-navigation .nav-previous a:active .nav-title, .post-navigation .nav-previous a:active:before, .post-navigation .nav-next a:hover .nav-label, .post-navigation .nav-next a:hover .nav-title, .post-navigation .nav-next a:hover:before, .post-navigation .nav-next a:focus .nav-label, .post-navigation .nav-next a:focus .nav-title, .post-navigation .nav-next a:focus:before, .post-navigation .nav-next a:active .nav-label, .post-navigation .nav-next a:active .nav-title, .post-navigation .nav-next a:active:before, body.bbpress article.hentry .post-text a:hover, body.bbpress article.hentry .post-text a:focus, body.bbpress article.hentry .post-text a:active, .woocommerce ul.products li.product h2:hover, .woocommerce ul.products li.product h2:focus, .woocommerce ul.products li.product h2:active, .woocommerce ul.products li.product .woocommerce-loop-product__title:hover, .woocommerce ul.products li.product .woocommerce-loop-product__title:focus, .woocommerce ul.products li.product .woocommerce-loop-product__title:active, .woocommerce ul.products li.product .price del .amount:hover, .woocommerce ul.products li.product .price ins .amount:hover, .woocommerce ul.products li.product .price del .amount:focus, .woocommerce ul.products li.product .price ins .amount:focus, .woocommerce ul.products li.product .price del .amount:active, .woocommerce ul.products li.product .price ins .amount:active, .inner-header-content .posted-on a:hover, .inner-header-content .posted-on a:focus, .inner-header-content .posted-on a:active, .post-content-inner .cat-links .categories-list a:hover, .comments-area .comment-list .comment-metadata a:hover, .comments-area .comment-list .comment-metadata a:focus, .comments-area .comment-list .comment-metadata a:active, .comments-area .comment-respond .logged-in-as a:hover, .comments-area .comment-respond .logged-in-as a:focus, .comments-area .comment-respond .logged-in-as a:active, .related-post .post h3 a:hover, .related-post .post h3 a:focus, .related-post .post h3 a:active, .socialgroup a:hover, .socialgroup a:focus, .socialgroup a:active, .wrap-inner-banner .inner-header-content .posted-on a:hover, .breadcrumb-wrap .breadcrumbs .trail-items a:hover, .breadcrumb-wrap .breadcrumbs .trail-items a:focus, .breadcrumb-wrap .breadcrumbs .trail-items a:active, .widget li a:hover, .widget li a:focus, .widget li a:active, .widget.widget_rss li a:focus, .widget.widget_rss li a:active, .widget.widget_rss .widget-title .rsswidget:hover, .widget.widget_rss .widget-title .rsswidget:focus, .widget.widget_rss .widget-title .rsswidget:active, .widget.widget_text .textwidget a:hover, .widget.widget_text .textwidget a:focus, .widget.widget_text .textwidget a:active, .author-widget .widget-content .profile .socialgroup ul li a:hover, .author-widget .widget-content .profile .socialgroup ul li a:focus, .author-widget .widget-content .profile .socialgroup ul li a:active, .top-header .socialgroup li a:hover, .top-header .socialgroup li a:focus, .top-header .socialgroup li a:active, .top-header-menu li a:hover, .top-header-menu li a:focus, .top-header-menu li a:active, .header-icons-wrap .header-search-icon:hover, .header-icons-wrap .header-search-icon:focus, .header-icons-wrap .header-search-icon:active, .site-header .site-branding .site-title a:hover, .site-header .site-branding .site-title a:focus, .site-header .site-branding .site-title a:active, .main-navigation nav > ul ul li a:hover, .main-navigation nav > ul ul li a:focus, .main-navigation nav > ul ul li a:active, .offcanvas-navigation a:hover, .offcanvas-navigation a:focus, .offcanvas-navigation a:active, .section-slider .slider-content .button-container .button-text:hover, .section-slider .slider-content .button-container .button-text:focus, .section-slider .slider-content .button-container .button-text:active, .section-slider .slider-content .button-container .button-text:hover:after, .section-slider .slider-content .button-container .button-text:focus:after, .section-slider .slider-content .button-container .button-text:active:after, .site-footer .socialgroup ul li a:hover, .site-footer .socialgroup ul li a:focus, .site-footer .socialgroup ul li a:active, .site-footer .copyright a:hover, .site-footer .copyright a:focus, .site-footer .copyright a:active, .site-footer .footer-menu ul li a:hover, .site-footer .footer-menu ul li a:focus, .site-footer .footer-menu ul li a:active, .top-footer .widget ul li a:hover, .top-footer .widget ul li a:focus, .top-footer .widget ul li a:active, .top-footer .widget ol li a:hover, .top-footer .widget ol li a:focus, .top-footer .widget ol li a:active, .top-footer .widget .textwidget a:hover, .top-footer .widget .textwidget a:focus, .top-footer .widget .textwidget a:active, .top-footer .widget .calendar_wrap table td a:hover, .top-footer .widget .calendar_wrap table td a:focus, .top-footer .widget .calendar_wrap table td a:active, .top-footer .widget .calendar_wrap table td#next a:hover, .top-footer .widget .calendar_wrap table td#prev a:hover, .top-footer .widget.widget_rss li a:hover, .top-footer .widget.widget_rss li a:focus, .top-footer .widget.widget_rss li a:active, .top-footer .widget .rsswidget:hover, .top-footer .widget .rsswidget:focus, .top-footer .widget .rsswidget:active, .top-footer .widget .sb-right-thumb-widget .widget-content .post-footer span a:hover, .top-footer .widget .sb-right-thumb-widget .widget-content .post-footer span a:focus, .top-footer .widget .sb-right-thumb-widget .widget-content .post-footer span a:active, .top-footer .widget .sb-right-thumb-widget .widget-content a:hover, .top-footer .widget .sb-right-thumb-widget .widget-content a:focus, .top-footer .widget .sb-right-thumb-widget .widget-content a:active, .post .meta-tag [class*=meta-] a:hover, .post .meta-tag [class*=meta-] a:focus, .post .meta-tag [class*=meta-] a:active, .post .meta-tag [class*=meta-] a:hover:before, .post .meta-tag [class*=meta-] a:focus:before, .post .meta-tag [class*=meta-] a:active:before, .section-trip-category .category-post a:hover .entry-title, .section-trip-category .category-post a:focus .entry-title, .section-trip-category .category-post a:active .entry-title, .section-trip-choice .trip-content .entry-meta-cat a:hover, .section-contact .contact-list .contact-content a:hover, .section-contact .contact-list .contact-content a:focus, .section-contact .contact-list .contact-content a:active, .contact-detail-content .socialgroup a:hover, .contact-detail-content .socialgroup a:focus, .contact-detail-content .socialgroup a:active, .section-clients .slide-item a:hover .client-content h3{
			color: <?php echo esc_attr( $hover_color ); ?>
		}
		.addtoany_content .addtoany_list a:hover svg path {
			fill: <?php echo esc_attr( $hover_color ); ?>
		}

		/*======================================*/
		/* Front Page Settings */
		/*======================================*/

		/*======================================*/
		/* Callback Section */
		/*======================================*/

		.section-callback .overlay {
			background-color: rgba(0, 0, 0, 0.<?php echo esc_attr( $callback_image_overlay_opacity ); ?>);
		}

		/*======================================*/
		/* Testimonial Section */
		/*======================================*/

		.section-testimonial .overlay {
			background-color: rgba(0, 0, 0, 0.<?php echo esc_attr( $testimonial_image_overlay_opacity ); ?>);
		}

		/*======================================*/
		/* Service Section */
		/*======================================*/

		.section-service .overlay {
			background-color: rgba(0, 0, 0, 0.<?php echo esc_attr( $service_image_overlay_opacity ); ?>);
		}

		.section-service:after {
			background-image: url(<?php echo travelbiz_service_image_url(); ?>) ;
		}

	</style>
	<?php
}
add_action( 'wp_head', 'travelbiz_default_styles' );

/**
* Load customizer preview js file
*/
function travelbiz_customize_preview_js() {
	wp_enqueue_script( 'travelbiz-customize-preview', get_theme_file_uri( '/assets/js/customizer/customize-preview.js' ), array( 'jquery', 'customize-preview'), '1.0', true );
}
add_action( 'customize_preview_init', 'travelbiz_customize_preview_js' );