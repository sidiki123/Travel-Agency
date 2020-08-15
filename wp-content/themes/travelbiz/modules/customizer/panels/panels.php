<?php
/**
* Sets the panels and returns to Travelbiz_Customizer
*
* @since  Travelbiz 1.0.0
* @param  array An array of the panels
* @return array
*/
function Travelbiz_Customizer_Panels( $panels ){

	$panels = array(
		'fonts' => array(
			'title' => esc_html__( 'Fonts', 'travelbiz' ),
			'priority' => 60
		),
		'frontpage_options' => array(
			'title' => esc_html__( 'Frontpage Options', 'travelbiz' ),
			'priority' => 90
		),
		'theme_options' => array(
			'title' => esc_html__( 'Theme Options', 'travelbiz' ),
			'priority' => 100
		)
	);

	return $panels;	
}
add_filter( 'Travelbiz_Customizer_Panels', 'Travelbiz_Customizer_Panels' );