<?php
/**
* Sets sections for Travelbiz_Customizer
*
* @since  Travelbiz 1.0.0
* @param  array $sections
* @return array Merged array
*/
function Travelbiz_Customizer_Sections( $sections ){

	$travelbiz_sections = array(
		# Section for Font panel
		'font_family' => array(
			'title' => esc_html__( 'Font Family', 'travelbiz' ),
			'panel' => 'fonts'
		),
		'font_size' => array(
			'title' => esc_html__( 'Font Size', 'travelbiz' ),
			'panel' => 'fonts'
		),

		# Section for Front Page Options panel
		'frontpage_general_options' => array(
			'title' => esc_html__( 'General Options', 'travelbiz' ),
			'panel' => 'frontpage_options'
		),
		'frontpage_slider_options' => array(
			'title' => esc_html__( 'Slider Options', 'travelbiz' ),
			'panel' => 'frontpage_options'
		),
		'homepage_itinerary_search_section' => array(
			'title' => esc_html__( 'Trips Search Options', 'travelbiz' ),
			'panel' => 'frontpage_options'
		),
		'frontpage_about_options' => array(
			'title' => esc_html__( 'About Options', 'travelbiz' ),
			'panel' => 'frontpage_options'
		),
		'post_filter_section' => array(
			'title' => esc_html__( 'Destination Options', 'travelbiz' ),
			'panel' => 'frontpage_options'
		),
		'itinerary_post_section' => array(
			'title' => esc_html__( 'Packages Options', 'travelbiz' ),
			'panel' => 'frontpage_options'
		),
		'traveller_choice_section' => array(
			'title' => esc_html__( "Traveler's Choice Options", 'travelbiz' ),
			'panel' => 'frontpage_options'
		),
		'frontpage_service_options' => array(
			'title' => esc_html__( 'Service Options', 'travelbiz' ),
			'panel' => 'frontpage_options'
		),
		'frontpage_clients_options' => array(
			'title' => esc_html__( 'Clients Options', 'travelbiz' ),
			'panel' => 'frontpage_options'
		),
		'frontpage_callback_options' => array(
			'title' => esc_html__( 'Callback Options', 'travelbiz' ),
			'panel' => 'frontpage_options'
		),
		'frontpage_blog_options' => array(
			'title' => esc_html__( 'Blog Options', 'travelbiz' ),
			'panel' => 'frontpage_options'
		),
		'frontpage_testimonial_options' => array(
			'title' => esc_html__( 'Testimonial Options', 'travelbiz' ),
			'panel' => 'frontpage_options'
		),
		'frontpage_contact_options' => array(
			'title' => esc_html__( 'Contact Options', 'travelbiz' ),
			'panel' => 'frontpage_options'
		),

		# Section for Theme Options panel
		'header_options' => array(
			'title' => esc_html__( 'Header Options', 'travelbiz' ),
			'panel' => 'theme_options'
		),
		'footer_options' => array(
			'title' => esc_html__( 'Footer Options', 'travelbiz' ),
			'panel' => 'theme_options'
		),
		'layout_options' => array(
			'title' => esc_html__( 'Layout Options', 'travelbiz' ),
			'panel' => 'theme_options'
		),
		'archive_options' => array(
			'title' => esc_html__( 'Archive Page Options', 'travelbiz' ),
			'panel' => 'theme_options'
		),
		'single_options' => array(
			'title' => esc_html__( 'Single Post Page Options', 'travelbiz' ),
			'panel' => 'theme_options'
		),
		'page_options' => array(
			'title' => esc_html__( 'Page Options', 'travelbiz' ),
			'panel' => 'theme_options'
		),
		'general_options' => array(
			'title' => esc_html__( 'General Options', 'travelbiz' ),
			'panel' => 'theme_options'
		)
	);

	return array_merge( $travelbiz_sections, $sections );
}
add_filter( 'Travelbiz_Customizer_Sections', 'Travelbiz_Customizer_Sections' );