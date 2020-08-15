<?php
/**
* Load widget components
*
* @since Travelbiz 1.0.0
*/
require_once get_parent_theme_file_path( '/modules/widgets/class-base-widget.php' );
require_once get_parent_theme_file_path( '/modules/widgets/author.php' );
require_once get_parent_theme_file_path( '/modules/widgets/social.php' );
/**
 * Register widgets
 *
 * @since Travelbiz 1.0.0
 */
/**
* Load all the widgets
* @since Travelbiz 1.0.0
*/
function travelbiz_register_widget() {

	$widgets = array(
		'Travelbiz_Author_Widget',
		'Travelbiz_Social_Widget',
	);

	foreach ( $widgets as $key => $value) {
    	register_widget( $value );
	}
}
add_action( 'widgets_init', 'travelbiz_register_widget' );

