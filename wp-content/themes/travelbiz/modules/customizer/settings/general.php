<?php
/**
* Sets settings for general fields
*
* @since  Travelbiz 1.0.0
* @param  array $settings
* @return array Merged array
*/

function Travelbiz_Customizer_General_Settings( $settings ){

	$general = array(
		# Site Identity
		'site_identity_options' => array(
			'label'    => esc_html__( 'Site Identity Extra Options', 'travelbiz' ),
			'section'  => 'title_tagline',
			'priority' => 50,
			'type'     => 'radio',
			'choices'  => array(
				'site_identity_hide_all'     => esc_html__( 'Hide All', 'travelbiz' ),
				'site_identity_show_all'     => esc_html__( 'Show All', 'travelbiz' ),
				'site_identity_title_only'   => esc_html__( 'Title Only', 'travelbiz' ),
				'site_identity_tagline_only' => esc_html__( 'Tagline Only', 'travelbiz' ),
				'site_identity_logo_title'   => esc_html__( 'Logo + Title', 'travelbiz' ),
				'site_identity_logo_tagline' => esc_html__( 'Logo + Tagline', 'travelbiz' ),
			),
		),
		
		# Color
		'site_title_color' => array(
			'label'     => esc_html__( 'Site Title', 'travelbiz' ),
			'section'   => 'colors',
			'type'      => 'colors',
		),
		'site_tagline_color' => array(
			'label'     => esc_html__( 'Site Tagline', 'travelbiz' ),
			'section'   => 'colors',
			'type'      => 'colors',
		),
		'site_body_text_color' => array(
			'label'     => esc_html__( 'Body Text', 'travelbiz' ),
			'section'   => 'colors',
			'type'      => 'colors',
		),
		'site_primary_color' => array(
			'label'     => esc_html__( 'Primary', 'travelbiz' ),
			'section'   => 'colors',
			'type'      => 'colors',
		),
		'site_hover_color' => array(
			'label'     => esc_html__( 'Hover', 'travelbiz' ),
			'section'   => 'colors',
			'type'      => 'colors',
		), 

		# Header Image
		'page_header_overlay_opacity' => array(
			'label'       => esc_html__( 'Header Image Overlay Opacity', 'travelbiz' ),
			'description' => esc_html__( '1 equals to 10% & it will effect on Banner Image Layouts', 'travelbiz' ),
			'section'     => 'header_image',
			'type'        => 'number',
			'input_attrs' => array(
				'min' => 1,
				'max' => 9,
				'style' => 'width: 70px;'
			),
		),
		'home_page_image' => array(
			'label'   	  => esc_html__( 'Home Page Image', 'travelbiz' ),
			'description' => esc_html__( 'Recommended Size 1920x650 pixels', 'travelbiz' ),
			'section'     => 'header_image',
			'type'        => 'cropped_image',
			'width'       => 1920,
        	'height'      => 650,
		),
		'home_overlay_opacity' => array(
			'label'       => esc_html__( 'Home Page Image Overlay Opacity', 'travelbiz' ),
			'description' => esc_html__( '1 equals to 10%', 'travelbiz' ),
			'section'     => 'header_image',
			'type'        => 'number',
			'input_attrs' => array(
				'min' => 0,
				'max' => 9,
				'style' => 'width: 70px;'
			),
		),
		'error_page_image' => array(
			'label'        => esc_html__( '404 Error Page Image', 'travelbiz' ),
			'description'  => esc_html__( 'Recommended Size 1920x380 pixels', 'travelbiz' ),
			'section'      => 'header_image',
			'type'         => 'cropped_image',
			'width'        => 1920,
        	'height'       => 380,
		),
		'error_overlay_opacity' => array(
			'label'       => esc_html__( '404 Page Image Overlay Opacity', 'travelbiz' ),
			'description' => esc_html__( '1 equals to 10%', 'travelbiz' ),
			'section'     => 'header_image',
			'type'        => 'number',
			'input_attrs' => array(
				'min' => 0,
				'max' => 9,
				'style' => 'width: 70px;'
			),
		),


		# Theme Options
		
		# Header
		'header_layout' => array(
			'label'     => esc_html__( 'Select Header Layout', 'travelbiz' ),
			'section'   => 'header_options',
			'type'      => 'select',
			'choices'   => array(
				'header_one'   => esc_html__( 'Header Layout One', 'travelbiz' ),
			),
		),
		'disable_search_icon' => array(
			'label'     => esc_html__( 'Disable Header Search Icon', 'travelbiz' ),
			'section'   => 'header_options',
			'type'      => 'checkbox',
		),
		'disable_hamburger_menu_icon' => array(
			'label'       => esc_html__( 'Disable Hamburger Menu Icon', 'travelbiz' ),
			'description' => esc_html__( 'It will disable the icon from desktop view', 'travelbiz' ),
			'section'     => 'header_options',
			'type'        => 'checkbox',
		),
		'enable_fixed_header' => array(
			'label'     => esc_html__( 'Enable Fixed Header', 'travelbiz' ),
			'section'   => 'header_options',
			'type'      => 'checkbox',
		),
		'top_header_button' => array(
			'label'   => esc_html__( 'Enter Header Button Text', 'travelbiz' ),
			'section' => 'header_options',
			'type'    => 'text',
		),
		'top_header_button_link' => array(
			'label'   => esc_html__( 'Enter Header Button Link', 'travelbiz' ),
			'section' => 'header_options',
			'type'    => 'text'
		),
		'disable_top_header_button' => array(
			'label'   => esc_html__( 'Disable Header Button', 'travelbiz' ),
			'section' => 'header_options',
			'type'    => 'checkbox',
		),
		'top_header_email' => array(
			'label'   => esc_html__( 'Enter Email', 'travelbiz' ),
			'section' => 'header_options',
			'type'    => 'text',
		),
		'top_header_phone' => array(
			'label'   => esc_html__( 'Enter Phone', 'travelbiz' ),
			'section' => 'header_options',
			'type'    => 'text',
		),
		'top_header_address' => array(
			'label'   => esc_html__( 'Enter Address', 'travelbiz' ),
			'section' => 'header_options',
			'type'    => 'text',
		),
		'disable_top_header_phone' => array(
			'label'   => esc_html__( 'Disable Top Header Phone', 'travelbiz' ),
			'section' => 'header_options',
			'type'    => 'checkbox',
		),
		'disable_top_header_email' => array(
			'label'   => esc_html__( 'Disable Top Header Email', 'travelbiz' ),
			'section' => 'header_options',
			'type'    => 'checkbox',
		),
		'disable_top_header_address' => array(
			'label'   => esc_html__( 'Disable Top Header Address', 'travelbiz' ),
			'section' => 'header_options',
			'type'    => 'checkbox',
		),

		# Footer
		'footer_layout' => array(
			'label'     => esc_html__( 'Select Footer Layout', 'travelbiz' ),
			'section'   => 'footer_options',
			'type'      => 'select',
			'choices'   => array(
				'footer_one'   => esc_html__( 'Footer Layout One', 'travelbiz' ),
			),
		),
		// Widgets
		'disable_footer_widget' => array(
			'label'   => esc_html__( 'Disable Footer Widget Area', 'travelbiz' ),
			'section' => 'footer_options',
			'type'    => 'checkbox',
		),
		// Copyright
		'footer_text' =>  array(
			'label'   => esc_html__( 'Footer Text', 'travelbiz' ),
			'section' => 'footer_options',
			'type'    => 'textarea',
		),

		# Layout
		'site_layout' => array(
			'label'   => esc_html__( 'Site Layout', 'travelbiz' ),
			'section' => 'layout_options',
			'type'    => 'radio-image',
			'choices' => array(
				'site_layout_full' => array(
					'label' => esc_html__( 'Full Width', 'travelbiz' ),
					'url'   => '/assets/images/full-width.png'
				),
			),
		),
		'archive_layout' => array(
			'label'     => esc_html__( 'Archive Page Layout', 'travelbiz' ),
			'section'   => 'layout_options',
			'type'      => 'radio-image',
			'choices'   => array(
				'right' => array(
					'label' => esc_html__( 'Right Sidebar', 'travelbiz' ),
					'url'   => '/assets/images/right-sidebar.png'
				),
				'left' => array(
					'label' => esc_html__( 'Left Sidebar', 'travelbiz' ),
					'url'   => '/assets/images/left-sidebar.png'
				),
				'none' => array(
					'label' => esc_html__( 'No Sidebar', 'travelbiz' ),
					'url'   => '/assets/images/no-sidebar.png'
				)
			),
		),
		'archive_post_layout' => array(
			'label'     => esc_html__( 'Archive Post Layout', 'travelbiz' ),
			'section'   => 'layout_options',
			'type'      => 'radio-image',
			'choices'   => array(
				'grid' => array(
					'label' => esc_html__( 'Grid', 'travelbiz' ),
					'url'   => '/assets/images/grid-layout.png'
				),
				'list' => array(
					'label' => esc_html__( 'List', 'travelbiz' ),
					'url'   => '/assets/images/list-layout.png'
				),
				'simple' => array(
					'label' => esc_html__( 'Simple', 'travelbiz' ),
					'url'   => '/assets/images/single-layout.png'
				)
			),
		),
		'single_layout' => array(
			'label'     => esc_html__( 'Single Post Page Layout', 'travelbiz' ),
			'section'   => 'layout_options',
			'type'      => 'radio-image',
			'choices'   => array(
				'right' => array(
					'label' => esc_html__( 'Right Sidebar', 'travelbiz' ),
					'url'   => '/assets/images/right-sidebar.png'
				),
				'left' => array(
					'label' => esc_html__( 'Left Sidebar', 'travelbiz' ),
					'url'   => '/assets/images/left-sidebar.png'
				),
				'none' => array(
					'label' => esc_html__( 'No Sidebar', 'travelbiz' ),
					'url'   => '/assets/images/no-sidebar.png'
				)
			),
		),
		'page_layout' => array(
			'label'     => esc_html__( 'Pages Layout', 'travelbiz' ),
			'section'   => 'layout_options',
			'type'      => 'radio-image',
			'choices'   => array(
				'none' => array(
					'label' => esc_html__( 'No Sidebar', 'travelbiz' ),
					'url'   => '/assets/images/no-sidebar.png'
				),
				'left' => array(
					'label' => esc_html__( 'Left Sidebar', 'travelbiz' ),
					'url'   => '/assets/images/left-sidebar.png'
				),
				'right' => array(
					'label' => esc_html__( 'Right Sidebar', 'travelbiz' ),
					'url'   => '/assets/images/right-sidebar.png'
				)
			),
		),

		# Archive
		'archive_page_title' => array(
			'label'   => esc_html__( 'Blog Page Title', 'travelbiz' ),
			'description' => esc_html__( 'This title will appear when the slider is disabled.', 'travelbiz' ),
			'section' => 'archive_options',
			'type'    => 'text',
		),
		'disable_archive_cat_link' => array(
			'label'    => esc_html__( 'Disable Category link', 'travelbiz' ),
			'section'  => 'archive_options',
			'type'     => 'checkbox',
		),
		'disable_archive_date' => array(
			'label'    => esc_html__( 'Disable Post Date', 'travelbiz' ),
			'section'  => 'archive_options',
			'type'     => 'checkbox',
		),
		'disable_archive_author' => array(
			'label'    => esc_html__( 'Disable Author', 'travelbiz' ),
			'section'  => 'archive_options',
			'type'     => 'checkbox',
		),
		'disable_archive_comment_link' => array(
			'label'    => esc_html__( 'Disable Comment link', 'travelbiz' ),
			'section'  => 'archive_options',
			'type'     => 'checkbox',
		),
		'post_excerpt_length' => array(
			'label'       => esc_html__( 'Global Excerpt Length', 'travelbiz' ),
			'description' => esc_html__( 'in words', 'travelbiz' ),
			'section'     => 'archive_options',
			'type'        => 'number',
			'input_attrs' => array(
				'min' => 10,
				'max' => 200,
				'style' => 'width: 70px;'
			),
		),
		'sticky_simple_post_excerpt_length' => array(
			'label'       => esc_html__( 'Sticky & Simple Post Excerpt Length', 'travelbiz' ),
			'description' => esc_html__( 'in words', 'travelbiz' ),
			'section'     => 'archive_options',
			'type'        => 'number',
			'input_attrs' => array(
				'min' => 10,
				'max' => 200,
				'style' => 'width: 70px;'
			),
		),
  		'disable_pagination' => array(
  			'label'   => esc_html__( 'Disable Pagination', 'travelbiz' ),
  			'section' => 'archive_options',
  			'type'    => 'checkbox'
  		),

		# Single
		'disable_single_date' => array(
			'label'    => esc_html__( 'Disable Post Date', 'travelbiz' ),
			'section'  => 'single_options',
			'type'     => 'checkbox',
		),
		'disable_single_feature_image' => array(
			'label'   => esc_html__( 'Disable Feauture Image', 'travelbiz' ),
			'section' => 'single_options',
			'type'    => 'checkbox'
		),
		'disable_single_post_format' => array(
			'label'    => esc_html__( 'Disable Post Format', 'travelbiz' ),
			'section'  => 'single_options',
			'type'     => 'checkbox',
		),
		'disable_single_tag_links' => array(
			'label'    => esc_html__( 'Disable Tag links', 'travelbiz' ),
			'section'  => 'single_options',
			'type'     => 'checkbox',
		),
		'disable_single_cat_links' => array(
			'label'    => esc_html__( 'Disable Category links', 'travelbiz' ),
			'section'  => 'single_options',
			'type'     => 'checkbox',
		),
		'disable_single_author' => array(
			'label'    => esc_html__( 'Disable Author detail', 'travelbiz' ),
			'section'  => 'single_options',
			'type'     => 'checkbox',
		),
		'single_post_nav_prev' => array(
			'label'   => esc_html__( 'Previous Reading Text', 'travelbiz' ),
			'description' => esc_html__( 'Post Navigation Previous Reading Text', 'travelbiz' ),
			'section' => 'single_options',
			'type'    => 'text',
		),
		'single_post_nav_next' => array(
			'label'   => esc_html__( 'Next Reading Text', 'travelbiz' ),
			'description' => esc_html__( 'Post Navigation Next Reading Text', 'travelbiz' ),
			'section' => 'single_options',
			'type'    => 'text',
		),

		# Page
		'disable_page_feature_image' => array(
			'label'   => esc_html( 'Disable Page Feature Image' ),
			'section' => 'page_options',
			'type'    => 'checkbox',
		),

		# General
		// Site Loader
		'site_loader_options' => array(
			'label'   => esc_html__( 'Site Loader Options', 'travelbiz' ),
			'section' => 'general_options',
			'type'    => 'select',
			'choices' => array(
				'site_loader_one'   => esc_html__( 'Site Loader One', 'travelbiz' ),
			),
		),
		'disable_site_loader' => array(
			'label'   => esc_html__( 'Disable Site Loader', 'travelbiz' ),
			'section' => 'general_options',
			'type'    => 'checkbox',
		),
		
		// Scroll Top
		'enable_scroll_top' => array(
			'label'     => esc_html__( 'Enable Scroll Top', 'travelbiz' ),
			'section'   => 'general_options',
			'type'      => 'checkbox',
		),

		// Page Header Layout
		'page_header_layout' => array(
			'label'    => esc_html__( 'Page Header Title Layouts', 'travelbiz' ),
			'section'  => 'general_options',
			'type'     => 'radio-image',
			'choices'  => array(
				'header_layout_one' => array(
					'label' => esc_html__( 'Layout One', 'travelbiz' ),
					'url'   => '/assets/images/noimage-breadcrumb.png'
				),
			), 
		),
		'disable_header_title' => array(
			'label'     => esc_html__( 'Disable Header Title', 'travelbiz' ),
			'section'   => 'general_options',
			'type'      => 'checkbox',
		),
		'disable_header_description' => array(
			'label'		=> esc_html__( 'Disable Description', 'travelbiz' ),
			'section'   => 'general_options',
			'type'		=> 'checkbox'
		),

		// Breadcrumb
		'breadcrumb_separator_layout' => array(
			'label'   => esc_html__( 'Breadcrumb Separator Layouts', 'travelbiz' ),
			'section' => 'general_options',
			'type'    => 'select',
			'choices' => array(
				'separator_layout_one'   => esc_html__( 'Separator Layout One', 'travelbiz' ),
				'separator_layout_two'   => esc_html__( 'Separator Layout Two', 'travelbiz' ),
				'separator_layout_three' => esc_html__( 'Separator Layout Three', 'travelbiz' ),
			),
		),
		'enable_breadcrumb_home_icon' => array(
			'label'   => esc_html__( 'Enable Breadcrumb Home Icon', 'travelbiz' ),
			'section' => 'general_options',
			'type'    => 'checkbox'
		),
		'disable_bradcrumb' => array(
			'label'   => esc_html__( 'Disable Breadcrumb', 'travelbiz' ),
			'section' => 'general_options',
			'type'    => 'checkbox'
		),
	);

	return array_merge( $settings, $general );
}
add_filter( 'Travelbiz_Customizer_Fields', 'Travelbiz_Customizer_General_Settings' );