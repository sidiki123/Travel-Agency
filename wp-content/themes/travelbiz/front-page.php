<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @since Travelbiz 1.0.0
 */

get_header();

if ( 'posts' == get_option( 'show_on_front' )  ) {
    //Show Static Blog Page
    get_template_part( 'index' );
} else {

$sections = travelbiz_get_homepage_sections();

do_action( 'travelbiz_before_homepage_sections' );

foreach( $sections as $section ){
	get_template_part( 'template-parts/front-page/front-page-' . $section, '' );
}

do_action( 'travelbiz_after_homepage_sections' );

get_footer();
}
