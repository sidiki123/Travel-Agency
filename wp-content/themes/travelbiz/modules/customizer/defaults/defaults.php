<?php
/**
* Generates default options for customizer.
*
* @since  Travelbiz 1.0.0
* @access public
* @param  array $options 
* @return array
*/
	
function Travelbiz_Default_Options( $options ){

	$defaults = array(
		# Site Identity
		'site_title'         	              => esc_html__( 'Travelbiz', 'travelbiz' ),
		'site_tagline'       	              => esc_html__( 'Capture your sweet memories', 'travelbiz' ),
		'site_identity_options'               => 'site_identity_show_all',

		# Header Image
		'page_header_overlay_opacity'         => 3,
		'home_overlay_opacity'    	          => 3,
		'error_overlay_opacity'    	          => 3,

		# Color
		'site_title_color'   	              => '#383838',
		'site_tagline_color' 	              => '#4d4d4d',
		'site_body_text_color'   	          => '#313131',

		'site_primary_color' 	              => '#F9A032',
		'site_hover_color' 	                  => '#086abd',

		# Front page options
		# General
		'section_title_layout'                => 'layout_one',

		# Slider
		'slider_layout'    	 			      => 'slider_layout_one',
		'slider_posts_number'    	          => 2,
		'slider_section_layout'               => 'slider_section_layout_one',
		'slider_overlay_opacity'    	      => 3,
		'slider_content_alignment'    	      => 'center',
		'disable_slider_title'                => false,
		'slider_excerpt_length'                => 30,
		'disable_slider_content'              => true,
		'slider_button_text'    	          => esc_html__( 'Continue Reading', 'travelbiz' ),
		'disable_slider_shape'                => false,
		'disable_slider_button'               => true,
		'disable_slider_control'     	      => false,
		'disable_slider_autoplay'    	      => true,
		'slider_timeout'     	              => 5,
		'disable_slider'    	              => false,

		# Itinerary search
		'itinerary_search_enable'             => true,
		'disbale_search_shape'			      => false,

		# About
		'about_section_layout'                => 'about_section_layout_one',
		'disable_about_title'                 => false,
		'about_excerpt_lenth'                 => 50,
		'disable_about_content'               => false,
		'about_button_text'                   => esc_html__( 'Learn more', 'travelbiz' ),
		'disable_about_button'                => false,
		'disable_about_divider'			      => false, 
		'disable_about'                       => false,

		# Post Filter - Destination
		'post_filter_enable'             	  => true,
		'post_filter_section_title'			  => esc_html__( 'Popular Destination', 'travelbiz' ),
		'disable_destination_title'		      => false,
		'disable_destination_divider'		  => false,
		'post_filter_number_of_destination'   => 4,

		# Itinerary Post - Packages
		'itinerary_post_enable'               => true,
		'itinerary_post_section_title'        => esc_html__( 'Our Packages', 'travelbiz' ),
		'itinerary_section_number_of_post'	  => 6,
		'disable_package_title'				  => false,
		'disable_package_divider'			  => false,

		# Travellers Choice
		'travellers_choice_enable'			  => true,
		'traveller_choice_section_title'      => esc_html__( 'Traveler\'s Choice', 'travelbiz' ),
		'traveller_choice_section_dropdown'	  => '',
		'disable_traveller_choice_title'	  => false,
		'disable_traveller_choice_divider'	  => false,

		# Service 
		'service_section_title'                => esc_html__( 'Service', 'travelbiz' ),
		'service_item_count'                   => 4,
		'service_image_overlay_opacity'        => 3,
		'service_excerpt_length'               => 10,
		'disable_service_title'		           => false,
		'disable_service_divider'			   => false,
		'disable_service_shape'			       => false,
		'disable_service'					   =>  false,

		# Callback
		'callback_section_layout'             => 'callback_section_layout_one',
		'disable_callback_title'              => false,
		'disable_callback_divider'			  => false, 
		'disable_callback_shape'			  => false, 
		'callback_image_overlay_opacity'      => 4,
		'callback_excerpt_lenth'              => 25,
		'disable_callback_content'            => false,
		'callback_button_text'                => esc_html__( 'Learn more', 'travelbiz' ),
		'disable_callback_button'             => false,
		'disable_callback'                    => false,

		# Clients
		'clients_section_layout'                => 'clients_section_layout_one',
		'clients_section_title'                 => esc_html__( 'Clients', 'travelbiz' ),
		'clients_posts_number'    	            => 5,
		'disable_clients_title'                 => true,
		'disable_clients_controls'              => false,
		'disable_clients_title'                 => false, 
		'disable_clients_divider'			    => false, 
		'disable_clients_name'			        => false, 
		'disable_clients'                       => false,

		# Testimonial
		'testimonial_section_layout'          => 'testimonial_section_layout_one',
		'testimonial_section_title'           => esc_html__( 'Client Testimonials', 'travelbiz' ),
		'testimonial_posts_number'    	      => 2,
		'disable_testimonial_title'           => false, 
		'disable_testimonial_divider'		  => false, 
		'disable_testimonial'                 => false,
		'testimonial_image_overlay_opacity'   => 3,

		# Blog
		'blog_section_title'                  => esc_html__( 'Blog', 'travelbiz' ),
		'blog_section_layout'                 => 'blog_section_layout_one',
		'blog_posts_number'                   => 6,
		'disable_blog_date'                   => false,
		'disable_blog_author'                 => false,
		'disable_news_comment_link'           => false,
		'disable_blog_category_title'         => false,
		'disable_blog_post_title'             => false,
		'disable_blog_title'                  => false, 
		'disable_blog_divider'			      => false, 
		'disable_blog'    	                  => false,

		# Contact
		'contact_section_layout'              => 'contact_section_layout_one',

		// Contact info
		'contact_section_title'               => esc_html__( 'Contact Us', 'travelbiz' ),
		'disable_contact_divider'			  => false, 
		'contact_detail_title'				  => esc_html__( 'Get In Touch', 'travelbiz' ),
		'contact_mail_title'                  => esc_html__( 'Pre-Sale', 'travelbiz' ),
		'contact_phone_one_title'             => esc_html__( 'Phone', 'travelbiz' ),
		'contact_address_title'               => esc_html__( 'Address', 'travelbiz' ),

		// Contact Detail
		'disable_contact'                     => false,

		# Theme options
		# Header
		'header_layout'                       => 'header_one',
		'disable_search_icon'                 => false,
		'disable_hamburger_menu_icon'         => false,
		'enable_fixed_header'                 => true,
		'disable_top_header_button'		      => true,
		'disable_top_header_phone'			  => true,
		'disable_top_header_email'			  => true,
		'disable_top_header_address'		  => true,

		# Footer
		'footer_layout'                       => 'footer_one',
		'disable_footer_widget'               => false,
		'footer_text'                         => travelbiz_get_footer_text(),

		# Layout
		'site_layout'			              => 'site_layout_full',
		'archive_layout'			          => 'right',
		'archive_post_layout'                 => 'grid',
		'single_layout'			              => 'right',
		'page_layout'			              => 'none',

		# Archive
		'disable_archive_cat_link'            => false,
		'disable_archive_date'                => false,
		'disable_archive_author'              => false,
		'disable_archive_comment_link'        => false,
		'post_excerpt_length'                 => 10,
		'sticky_simple_post_excerpt_length'   => 25,
		'disable_pagination'                  => false,

		# Single
		'disable_single_date'                 => false,
		'disable_single_post_format'          => false,
		'disable_single_tag_links'            => false,
		'disable_single_cat_links'            => false,
		'disable_single_author'               => false,
		'disable_single_title_tag'            => false,
		'single_post_nav_prev'                => esc_html__( 'Previous Reading', 'travelbiz' ),
		'single_post_nav_next'                => esc_html__( 'Next Reading', 'travelbiz' ),

		# Page
		'disable_front_page_title'            => true,
		'disable_page_feature_image'          => false,

		# General
		'site_loader_options'                 => 'site_loader_one',
		'disable_site_loader'                 => false,
		'enable_scroll_top'                   => true,
		'page_header_layout'                  => 'header_layout_one',
		'breadcrumb_separator_layout'         => 'separator_layout_one',
		'enable_breadcrumb_home_icon'         => true,
		'disable_bradcrumb'                   => false,
		'disable_header_title'		          => false,
		'disable_header_description'		  => false,
	);

	return array_merge( $options, $defaults );
}
add_filter( 'Travelbiz_Customizer_Defaults', 'Travelbiz_Default_Options' );

if( !function_exists( 'travelbiz_get_footer_text' ) ):
/**
* Generate Default footer text
*
* @return string
* @since Travelbiz 1.0.0
*/

function travelbiz_get_footer_text(){
	$text = esc_html__( 'Copyright &copy; 2019.', 'travelbiz' );
							
	return $text;
}
endif;