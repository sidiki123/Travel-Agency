<?php
/**
* Sets settings for general fields
*
* @since  Travelbiz 1.0.0
* @param  array $settings
* @return array Merged array
*/

function Travelbiz_Customizer_Frontpage_Settings( $settings ){
	$frontpage = array(
		# General
		'section_title_layout' => array(
			'label' => esc_html__( 'Section Title Layout', 'travelbiz' ),
			'section' => 'frontpage_general_options',
			'type'    => 'select',
			'choices' => array(
				'layout_one'  => esc_html__( 'Layout One', 'travelbiz' ),
			),
		),

		# Slider
		'slider_page' => array(
			'label'    => esc_html__( 'Slider Pages', 'travelbiz' ),
			'section'  => 'frontpage_slider_options',
			'type'     => 'text',
			'description' => esc_html__( 'Input page id. Separate with comma. for eg. 2, 9, 23...  Recommended size 1920x750 pixels.', 'travelbiz' )
		),
		'slider_posts_number' => array(
			'label'       => esc_html__( 'Slider Page View Number', 'travelbiz' ),
			'description' => esc_html__( 'Total number of slider to show.', 'travelbiz' ),
			'section'     => 'frontpage_slider_options',
			'type'        => 'number',
			'input_attrs' => array(
				'min' => 1,
				'max' => 3,
				'style' => 'width: 70px;'
			),
		),
		'slider_section_layout' => array(
			'label'   => esc_html__( 'Slider Section Layout', 'travelbiz' ),
			'description' => esc_html__( 'Select a layout. More layouts are coming soon.', 'travelbiz' ),
			'section' => 'frontpage_slider_options',
			'type'    => 'select',
			'choices' => array(
				'slider_section_layout_one' => esc_html__( 'Layout Style One', 'travelbiz' ),
			),
		),
		'slider_overlay_opacity' => array(
			'label'       => esc_html__( 'Slider Overlay Opacity', 'travelbiz' ),
			'description' => esc_html__( '1 equals to 10%', 'travelbiz' ),
			'section'     => 'frontpage_slider_options',
			'type'        => 'number',
			'input_attrs' => array(
				'min' => 0,
				'max' => 9,
				'style' => 'width: 70px;'
			),
		),
		'slider_content_alignment' => array(
			'label'   => esc_html__( 'Slider Content Alignment', 'travelbiz' ),
			'section' => 'frontpage_slider_options',
			'type'    => 'select',
			'choices' => array(
				'center' => esc_html__( 'Center', 'travelbiz' ),
			),
		),
		'disable_slider_title' => array(
			'label'   => esc_html__( 'Disable Slider Title', 'travelbiz' ),
			'section' => 'frontpage_slider_options',
			'type'    => 'checkbox',
		),
		'slider_excerpt_length' => array(
			'label'   => esc_html__( 'Slider Excerpt Length', 'travelbiz' ),
			'description' => esc_html__( 'Default 30 words', 'travelbiz' ),
			'section'     => 'frontpage_slider_options',
			'type'        => 'number',
			'input_attrs' => array(
				'min' => 10,
				'max' => 200,
				'style' => 'width: 70px;'
			),
		),
		'disable_slider_content' => array(
			'label'   => esc_html__( 'Disable Slider Content', 'travelbiz' ),
			'section' => 'frontpage_slider_options',
			'type'    => 'checkbox',
		),
		'slider_button_text' => array(
			'label'   => esc_html__( 'Slider Button Text', 'travelbiz' ),
			'section' => 'frontpage_slider_options',
			'type'    => 'text',
		),
		'disable_slider_button' => array(
			'label'   => esc_html__( 'Disable Slider Button', 'travelbiz' ),
			'section' => 'frontpage_slider_options',
			'type'    => 'checkbox',
		),
		'disable_slider_control' => array(
			'label'     => esc_html__( 'Disable Slider Control', 'travelbiz' ),
			'section'   => 'frontpage_slider_options',
			'type'      => 'checkbox'
		),
		'disable_slider_autoplay' => array(
			'label'   => esc_html__( 'Disable Slider Auto Play', 'travelbiz' ),
			'section' => 'frontpage_slider_options',
			'type'    => 'checkbox',
		),
		'slider_timeout' => array(
			'label'    => esc_html__( 'Slider Auto Play Timeout ( in sec )', 'travelbiz' ),
			'section'  => 'frontpage_slider_options',
			'type'     => 'number',
			'input_attrs' => array(
				'min' => 1,
				'max' => 60,
				'style' => 'width: 70px;'
			)
		),
		'disable_slider_shape' => array(
			'label'   => esc_html__( 'Disable Shape', 'travelbiz' ),
			'section' => 'frontpage_slider_options',
			'type'    => 'checkbox',
		),
		'disable_slider' => array(
			'label'   => esc_html__( 'Disable Slider Section', 'travelbiz' ),
			'section' => 'frontpage_slider_options',
			'type'    => 'checkbox',
		),

		# About
		'about_page' => array(
			'label'   => esc_html__( 'Select About Page', 'travelbiz' ),
			'description' => esc_html__( 'Feature image recommended size 580x580 pixels.', 'travelbiz' ),
			'section' => 'frontpage_about_options',
			'type'    => 'dropdown-pages',
		),
		'about_section_layout' => array(
			'label'   => esc_html__( 'About Section Layout', 'travelbiz' ),
			'description' => esc_html__( 'Select a layout. More layouts are coming soon.', 'travelbiz' ),
			'section' => 'frontpage_about_options',
			'type'    => 'select',
			'choices' => array(
				'about_section_layout_one' => esc_html__( 'Layout Style One', 'travelbiz' ),
			),
		),
		'about_excerpt_lenth' => array(
			'label'   => esc_html__( 'About Excerpt Lenth', 'travelbiz' ),
			'description' => esc_html__( 'Default 50 words', 'travelbiz' ),
			'section'     => 'frontpage_about_options',
			'type'        => 'number',
			'input_attrs' => array(
				'min' => 10,
				'max' => 200,
				'style' => 'width: 70px;'
			),
		),
		'disable_about_feature_image' => array(
			'label'   => esc_html__( 'Disable About Feature Image', 'travelbiz' ),
			'section' => 'frontpage_about_options',
			'type'    => 'checkbox',
		),
		'disable_about_title' => array(
			'label'   => esc_html__( 'Disable About Title', 'travelbiz' ),
			'section' => 'frontpage_about_options',
			'type'    => 'checkbox',
		),
		'disable_about_divider' => array(
			'label'   => esc_html__( 'Disable Divider', 'travelbiz' ),
			'section' => 'frontpage_about_options',
			'type'    => 'checkbox',
		),
		'disable_about_shape' => array(
			'label'   => esc_html__( 'Disable Shape', 'travelbiz' ),
			'section' => 'frontpage_about_options',
			'type'    => 'checkbox',
		),
		'disable_about_content' => array(
			'label'   => esc_html__( 'Disable About Content', 'travelbiz' ),
			'section' => 'frontpage_about_options',
			'type'    => 'checkbox',
		),
		'about_button_text' => array(
			'label'   => esc_html__( 'About Button Text', 'travelbiz' ),
			'section' => 'frontpage_about_options',
			'type'    => 'text',
		),
		'disable_about_button' => array(
			'label'   => esc_html__( 'Disable About Button', 'travelbiz' ),
			'section' => 'frontpage_about_options',
			'type'    => 'checkbox',
		),
		'disable_about' => array(
			'label'   => esc_html__( 'Disable About Section', 'travelbiz' ),
			'section' => 'frontpage_about_options',
			'type'    => 'checkbox',
		),

		# Services
		'service_section_title' => array(
			'label'   => esc_html__( 'Service Section Title', 'travelbiz' ),
			'section' => 'frontpage_service_options',
			'type'    => 'text',
		),
		'service_image'   => array(
			'label'       => esc_html__( 'Background Image', 'travelbiz' ),
			'description' => esc_html__( 'Recommended Size 960x1210 pixels', 'travelbiz' ),
			'section'     => 'frontpage_service_options',
			'type'        => 'cropped_image',
			'width'       => 960,
        	'height'      => 1210,
		),
		'service_image_overlay_opacity' => array(
			'label'       => esc_html__( ' Background Image Overlay Opacity', 'travelbiz' ),
			'description' => esc_html__( '1 equals to 10% ', 'travelbiz' ),
			'section'     => 'frontpage_service_options',
			'type'        => 'number',
			'input_attrs' => array(
				'min' => 1,
				'max' => 9,
				'style' => 'width: 70px;'
			),
		),
		'service_page' => array(
			'label'    => esc_html__( 'Service Pages', 'travelbiz' ),
			'section'  => 'frontpage_service_options',
			'type'     => 'text',
			'description' => esc_html__( 'Input page id. Separate with comma. for eg. 2, 9, 23...', 'travelbiz' )
		),
		'service_icons' => array(
			'label'    => esc_html__( 'Service Icons Pages', 'travelbiz' ),
			'section'  => 'frontpage_service_options',
			'type'     => 'text',
			'description' => esc_html__( 'Input Icon name eg: fas fa-shield-alt, far fa-life-ring, fas fa-medkit, fas fa-bullhorn. Separate with comma and will apply with respective service page. For more icons https://fontawesome.com/icons?d=gallery&m=free', 'travelbiz' )
		),
		'service_item_count' => array(
			'label'       => esc_html__( 'Total number items to show.', 'travelbiz' ),
			'section'     => 'frontpage_service_options',
			'type'        => 'number',
			'input_attrs' => array(
				'min' => 1,
				'max' => 4,
				'style' => 'width: 70px;'
			),
		),
		'service_excerpt_length' => array(
			'label'   => esc_html__( 'Service Excerpt Length', 'travelbiz' ),
			'description' => esc_html__( 'Default 10 words', 'travelbiz' ),
			'section'     => 'frontpage_service_options',
			'type'        => 'number',
			'input_attrs' => array(
				'min' => 10,
				'max' => 200,
				'style' => 'width: 70px;'
			),
		),
		'disable_service_title' => array(
			'label'   => esc_html__( 'Disable Service Title', 'travelbiz' ),
			'section' => 'frontpage_service_options',
			'type'    => 'checkbox',
		),
		'disable_service_divider' => array(
			'label'   => esc_html__( 'Disable Divider', 'travelbiz' ),
			'section' => 'frontpage_service_options',
			'type'    => 'checkbox',
		),
		'disable_service_shape' => array(
			'label'   => esc_html__( 'Disable Shape', 'travelbiz' ),
			'section' => 'frontpage_service_options',
			'type'    => 'checkbox',
		),
		'disable_service' => array(
			'label'   => esc_html__( 'Disable Service Section', 'travelbiz' ),
			'section' => 'frontpage_service_options',
			'type'    => 'checkbox',
		),

		# Callback
		'callback_page' => array(
			'label'   => esc_html__( 'Select Callback Page', 'travelbiz' ),
			'description' => esc_html__( 'Feature image recommended size 1920x650 pixels.', 'travelbiz' ),
			'section' => 'frontpage_callback_options',
			'type'    => 'dropdown-pages',
		),
		'callback_section_layout' => array(
			'label'   => esc_html__( 'Callback Section Layout', 'travelbiz' ),
			'description' => esc_html__( 'Select a layout. More layouts are coming soon.', 'travelbiz' ),
			'section' => 'frontpage_callback_options',
			'type'    => 'select',
			'choices' => array(
				'callback_section_layout_one' => esc_html__( 'Layout Style One', 'travelbiz' ),
			),
		),
		'callback_image_overlay_opacity' => array(
			'label'       => esc_html__( 'Callback Image Overlay Opacity', 'travelbiz' ),
			'description' => esc_html__( '1 equals to 10% ', 'travelbiz' ),
			'section'     => 'frontpage_callback_options',
			'type'        => 'number',
			'input_attrs' => array(
				'min' => 1,
				'max' => 9,
				'style' => 'width: 70px;'
			),
		),
		'callback_excerpt_lenth' => array(
			'label'   => esc_html__( 'Callback Excerpt Lenth', 'travelbiz' ),
			'description' => esc_html__( 'Default 25 words', 'travelbiz' ),
			'section'     => 'frontpage_callback_options',
			'type'        => 'number',
			'input_attrs' => array(
				'min' => 10,
				'max' => 200,
				'style' => 'width: 70px;'
			),
		),
		'disable_callback_title' => array(
			'label'   => esc_html__( 'Disable Callback Title', 'travelbiz' ),
			'section' => 'frontpage_callback_options',
			'type'    => 'checkbox',
		),
		'disable_callback_divider' => array(
			'label'   => esc_html__( 'Disable Divider', 'travelbiz' ),
			'section' => 'frontpage_callback_options',
			'type'    => 'checkbox',
		),
		'disable_callback_shape' => array(
			'label'   => esc_html__( 'Disable Shape', 'travelbiz' ),
			'section' => 'frontpage_callback_options',
			'type'    => 'checkbox',
		),
		'disable_callback_content' => array(
			'label'   => esc_html__( 'Disable Callback Content', 'travelbiz' ),
			'section' => 'frontpage_callback_options',
			'type'    => 'checkbox',
		),
		'callback_button_text' => array(
			'label'   => esc_html__( 'Callback Button Text', 'travelbiz' ),
			'section' => 'frontpage_callback_options',
			'type'    => 'text',
		),
		'disable_callback_button' => array(
			'label'   => esc_html__( 'Disable Callback Button', 'travelbiz' ),
			'section' => 'frontpage_callback_options',
			'type'    => 'checkbox',
		),
		'disable_callback' => array(
			'label'   => esc_html__( 'Disable Callback Section', 'travelbiz' ),
			'section' => 'frontpage_callback_options',
			'type'    => 'checkbox',
		),

		# Clients
		'clients_section_layout' => array(
			'label'   => esc_html__( 'Clients Section Layout', 'travelbiz' ),
			'description' => esc_html__( 'Select a layout. More layouts are coming soon.', 'travelbiz' ),
			'section' => 'frontpage_clients_options',
			'type'    => 'select',
			'choices' => array(
				'clients_section_layout_one' => esc_html__( 'Layout Style One', 'travelbiz' ),
			),
		),
		'clients_page' => array(
			'label'   => esc_html__( 'Clients Pages', 'travelbiz' ),
			'section' => 'frontpage_clients_options',
			'type'    => 'text',
			'description' => esc_html__( 'Input page id. Separate with comma. for eg. 2,9,23... Recommended size 150x150 pixels.', 'travelbiz' )
		),
		'clients_section_title' => array(
			'label'   => esc_html__( 'Clients Section Title', 'travelbiz' ),
			'section' => 'frontpage_clients_options',
			'type'    => 'text'
		),
		'clients_posts_number' => array(
			'label'       => esc_html__( 'Clients Page View Number', 'travelbiz' ),
			'description' => esc_html__( 'Total number of clients to show.', 'travelbiz' ),
			'section'     => 'frontpage_clients_options',
			'type'        => 'number',
			'input_attrs' => array(
				'min' => 1,
				'max' => 5,
				'style' => 'width: 70px;'
			)
		),
		'disable_clients_controls' => array(
			'label'   => esc_html__( 'Disable Clients Slider Controls', 'travelbiz' ),
			'section' => 'frontpage_clients_options',
			'type'    => 'checkbox',
		),
		'disable_clients_title' => array(
			'label'   => esc_html__( 'Disable Clients Section Title', 'travelbiz' ),
			'section' => 'frontpage_clients_options',
			'type'    => 'checkbox',
		),
		'disable_clients_divider' => array(
			'label'   => esc_html__( 'Disable Divider', 'travelbiz' ),
			'section' => 'frontpage_clients_options',
			'type'    => 'checkbox',
		),
		'disable_clients_name' => array(
			'label'   => esc_html__( 'Disable Clients Title', 'travelbiz' ),
			'section' => 'frontpage_clients_options',
			'type'    => 'checkbox',
		),
		'disable_clients' => array(
			'label'   => esc_html__( 'Disable Clients Section', 'travelbiz' ),
			'section' => 'frontpage_clients_options',
			'type'    => 'checkbox',
		),

		# Testimonials
		'testimonial_section_layout' => array(
			'label'   => esc_html__( 'Testimonial Section Layout', 'travelbiz' ),
			'description' => esc_html__( 'Select a layout. More layouts are coming soon.', 'travelbiz' ),
			'section' => 'frontpage_testimonial_options',
			'type'    => 'select',
			'choices' => array(
				'testimonial_section_layout_one' => esc_html__( 'Layout Style One', 'travelbiz' ),
			),
		),
		'testimonial_page' => array(
			'label'   => esc_html__( 'Testimonial Pages', 'travelbiz' ),
			'section' => 'frontpage_testimonial_options',
			'type'    => 'text',
			'description' => esc_html__( 'Input page id. Separate with comma. for eg. 2,9,23...', 'travelbiz' )
		),
		'testimonial_posts_number' => array(
			'label'       => esc_html__( 'Testimonial Page View Number', 'travelbiz' ),
			'description' => esc_html__( 'Total number of testimonial to show.', 'travelbiz' ),
			'section'     => 'frontpage_testimonial_options',
			'type'        => 'number',
			'input_attrs' => array(
				'min' => 1,
				'max' => 3,
				'style' => 'width: 70px;'
			),
		),
		'testimonial_section_title' => array(
			'label'   => esc_html__( 'Testimonial Section Title', 'travelbiz' ),
			'section' => 'frontpage_testimonial_options',
			'type'    => 'text',
		),
		'testimonial_background_image' => array(
			'label'   	  => esc_html__( 'Background Image', 'travelbiz' ),
			'description' => esc_html__( 'Recommended Size 1920x650 pixels', 'travelbiz' ),
			'section'     => 'frontpage_testimonial_options',
			'type'        => 'cropped_image',
			'width'       => 1920,
			'height'      => 650,
		),
		'testimonial_image_overlay_opacity' => array(
			'label'       => esc_html__( 'Background Overlay Opacity', 'travelbiz' ),
			'description' => esc_html__( '1 equals to 10%', 'travelbiz' ),
			'section'     => 'frontpage_testimonial_options',
			'type'        => 'number',
			'input_attrs' => array(
				'min' => 0,
				'max' => 9,
				'style' => 'width: 70px;'
			),
		),
		'disable_testimonial_title' => array(
			'label'   => esc_html__( 'Disable Testimonial Title', 'travelbiz' ),
			'section' => 'frontpage_testimonial_options',
			'type'    => 'checkbox',
		),
		'disable_testimonial_divider' => array(
			'label'   => esc_html__( 'Disable Divider', 'travelbiz' ),
			'section' => 'frontpage_testimonial_options',
			'type'    => 'checkbox',
		),
		'disable_testimonial' => array(
			'label'   => esc_html__( 'Disable Testimonial Section', 'travelbiz' ),
			'section' => 'frontpage_testimonial_options',
			'type'    => 'checkbox',
		),

		# Blog
		'blog_section_title' => array(
			'label'   => esc_html__( 'Blog Section Title', 'travelbiz' ),
			'section' => 'frontpage_blog_options',
			'type'    => 'text',
		),
		'blog_section_layout' => array(
			'label'   => esc_html__( 'Blog Section Layout', 'travelbiz' ),
			'description' => esc_html__( 'Select a layout. More layouts are coming soon.', 'travelbiz' ),
			'section' => 'frontpage_blog_options',
			'type'    => 'select',
			'choices' => array(
				'blog_section_layout_one' => esc_html__( 'Layout Style One', 'travelbiz' ),
			),
		),
		'blog_category' => array(
			'label'   => esc_html__( 'Choose Blog Category', 'travelbiz' ),
			'section' => 'frontpage_blog_options',
			'type'    => 'dropdown-categories',
		),
		'blog_posts_number' => array(
			'label'       => esc_html__( 'Blog Post View Number', 'travelbiz' ),
			'description' => esc_html__( 'Total number of blog post to show.', 'travelbiz' ),
			'section'     => 'frontpage_blog_options',
			'type'        => 'number',
			'input_attrs' => array(
				'min' => 1,
				'max' => 12,
				'style' => 'width: 70px;'
			),
		),
		'disable_blog_date' => array(
			'label'    => esc_html__( 'Disable Date', 'travelbiz' ),
			'section'  => 'frontpage_blog_options',
			'type'     => 'checkbox',
		),
		'disable_blog_author' => array(
			'label'    => esc_html__( 'Disable Author', 'travelbiz' ),
			'section'  => 'frontpage_blog_options',
			'type'     => 'checkbox',
		),
		'disable_blog_comment_link' => array(
			'label'    => esc_html__( 'Disable Comment', 'travelbiz' ),
			'section'  => 'frontpage_blog_options',
			'type'     => 'checkbox',
		),
		'disable_blog_category_title' => array(
			'label' => esc_html__( 'Disable Blog Category Title', 'travelbiz' ),
			'section' => 'frontpage_blog_options',
			'type' => 'checkbox',
		),
		'disable_blog_post_title' => array(
			'label' => esc_html__( 'Disable Blog Post Title', 'travelbiz' ),
			'section' => 'frontpage_blog_options',
			'type' => 'checkbox',
		),
		'disable_blog_title' => array(
			'label'   => esc_html__( 'Disable Blog Title', 'travelbiz' ),
			'section' => 'frontpage_blog_options',
			'type'    => 'checkbox',
		),
		'disable_blog_divider' => array(
			'label'   => esc_html__( 'Disable Divider', 'travelbiz' ),
			'section' => 'frontpage_blog_options',
			'type'    => 'checkbox',
		),
		'disable_blog' => array(
			'label'   => esc_html__( 'Disable Blog Section', 'travelbiz' ),
			'section' => 'frontpage_blog_options',
			'type'    => 'checkbox',
		),

		# Contact
		'contact_section_layout' => array(
			'label'   => esc_html__( 'Contact Section Layout', 'travelbiz' ),
			'description' => esc_html__( 'Select a layout. More layouts are coming soon.', 'travelbiz' ),
			'section' => 'frontpage_contact_options',
			'type'    => 'select',
			'choices' => array(
				'contact_section_layout_one' => esc_html__( 'Layout Style One', 'travelbiz' ),
			),
		),

		// Contact Info
		'contact_section_title' => array(
			'label'  => esc_html__( 'Contact Section Title', 'travelbiz' ),
			'section' => 'frontpage_contact_options',
			'type' => 'text',
		),

		// Contact Form
		'contact_shortcode' => array(
			'label'   => esc_html__( 'Contact Form Shortcode', 'travelbiz' ),
			'section' => 'frontpage_contact_options',
			'description' => esc_html__( 'Add a Contact Form Shortcode.', 'travelbiz' ),
			'type'    => 'text'
		),
		'disable_contact' => array(
			'label'   => esc_html__( 'Disable Contact Section', 'travelbiz' ),
			'section' => 'frontpage_contact_options',
			'type'    => 'checkbox',
		),

		// Contact Detail
		'contact_detail_title' => array(
			'label'             => esc_html__( 'Contact Detail Title', 'travelbiz' ),
			'section'           => 'frontpage_contact_options',
			'type'              => 'text',
		),
		'contact_mail_title' => array(
			'label'  => esc_html__( 'Primary Email Label', 'travelbiz' ),
			'description' => esc_html__( 'Primary Email Address is rendered from top header.', 'travelbiz' ),
			'section' => 'frontpage_contact_options',
			'type' => 'text',
		),
		'contact_phone_one_title' => array(
			'label'  => esc_html__( 'Phone Label', 'travelbiz' ),
			'description' => esc_html__( 'Phone Number is rendered from top header.', 'travelbiz' ),
			'section' => 'frontpage_contact_options',
			'type' => 'text',
		),
		'contact_address_title' => array(
			'label'  => esc_html__( 'Address Label', 'travelbiz' ),
			'section' => 'frontpage_contact_options',
			'type' => 'text',
		),
	);

	return array_merge( $settings, $frontpage );
}
add_filter( 'Travelbiz_Customizer_Fields', 'Travelbiz_Customizer_Frontpage_Settings' );