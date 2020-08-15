<?php
/**
 * Loads the child theme textdomain.
 */
function one_page_agency_child_theme_setup() {
    load_child_theme_textdomain('one-page-agency');
}
add_action( 'after_setup_theme', 'one_page_agency_child_theme_setup' );

function one_page_agency_child_enqueue_styles() {
    $parent_style = 'one-page-agency-parent';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	 wp_enqueue_style( 'one-page-agency-style',get_stylesheet_directory_uri() . '/onepageagency.css');
}
add_action( 'wp_enqueue_scripts', 'one_page_agency_child_enqueue_styles',99);
?>