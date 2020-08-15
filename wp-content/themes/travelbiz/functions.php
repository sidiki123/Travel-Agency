<?php
/**
 * Travelbiz functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @since Travelbiz 1.0.0
 */

/**
 * Travelbiz works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

function travelbiz_scripts(){
	
	$style = array(
		'handler'  => 'travelbiz-style',
		'style'    => get_stylesheet_uri(),
		'absolute' => true,
	);

	$kf_icons =  array(
		'handler' => 'kfi-icons',
		'style'   => 'kf-icons/css/style.min.css',
		'version' => '1.0.0'
	);

	$bootstrap_rtl = '';
	if ( is_rtl() ) {
		$bootstrap_rtl = array(
			'handler' => 'bootstrap-rtl',
			'style'   => 'bootstrap/css/rtl/bootstrap.min.css',
			'version' => '4.1.3'
		);
	}

	# Enqueue Vendor's Script & Style
	$scripts = array(
		array(
			'handler'  => 'travelbiz-google-fonts',
			'style'    => esc_url( '//fonts.googleapis.com/css?family=Hind:300,400,400i,500,600,700,800,900|Quicksand:300,400,500,600,700'),
			'absolute' => true
		),
		array(
			'handler' => 'bootstrap',
			'style'   => 'bootstrap/css/bootstrap.min.css',
			'script'  => 'bootstrap/js/bootstrap.min.js', 
			'version' => '4.1.3'
		),
		$bootstrap_rtl,
		$kf_icons,
		array(
			'handler' => 'fontawesome',
			'style'   => 'font-awesome/css/all.min.css',
			'version' => '5.6.3'
		),
		array(
			'handler' => 'theiastickysidebar',
			'script'  => 'theiastickysidebar/theia-sticky-sidebar.min.js',
			'version' => '1.7.0'
		),
		array(
			'handler' => 'owlcarousel',
			'style'   => 'OwlCarousel2-2.2.1/assets/owl.carousel.min.css',
			'script'  => 'OwlCarousel2-2.2.1/owl.carousel.min.js',
			'version' => '2.2.1'
		),
		array(
			'handler' => 'owlcarousel-theme',
			'style'   => 'OwlCarousel2-2.2.1/assets/owl.theme.default.min.css',
			'version' => '2.2.1'
		),
		array(
			'handler'  => 'travelbiz-blocks',
			'style'    => get_theme_file_uri( '/assets/css/blocks.min.css' ),
			'absolute' => true,
		),
		array(
			'handler'  => 'travelbiz-skip-link-focus-fix',
			'script'   => get_theme_file_uri( '/assets/js/skip-link-focus-fix.min.js' ),
			'absolute' => true,
		),
		array(
			'handler'  => 'travelbiz-navigation',
			'script'   => get_theme_file_uri( '/assets/js/navigation.min.js' ),
			'absolute' => true,
		),
		array(
			'handler'    => 'travelbiz-script',
			'script'     => get_theme_file_uri( '/assets/js/main.min.js' ),
			'absolute'   => true,
			'prefix'     => '',
			'dependency' => array( 'jquery', 'masonry' )
		),
		$style
	);

	travelbiz_enqueue( apply_filters( 'travelbiz_scripts_styles', $scripts ) );

	$locale = apply_filters( 'travelbiz_localize_var', array(
		'is_admin_bar_showing'       => is_admin_bar_showing() ? true : false,
		'enable_scroll_top'          => travelbiz_get_option( 'enable_scroll_top' ) ? 1 : 0,
		'is_rtl'                     => is_rtl(),
		'search_placeholder'         => esc_html__( 'hit enter for search.', 'travelbiz' ),
		'search_default_placeholder' => esc_html__( 'search...', 'travelbiz' ),
		'home_slider' => array(
			'autoplay' => absint( !travelbiz_get_option( 'disable_slider_autoplay' ) ),
			'timeout'  => absint( travelbiz_get_option( 'slider_timeout' ) ) * 1000,
		),
		'fixed_nav' => travelbiz_get_option( 'enable_fixed_header' ) ? true : false,
	));

	wp_localize_script( 'travelbiz-script', 'TRAVELBIZ', $locale );

	if ( is_singular() && comments_open() ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'travelbiz_scripts' );

/**
* Enqueue editor styles for Gutenberg
* 
* @since Travelbiz 1.0.0
*/

function travelbiz_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'travelbiz-block-editor-style', get_theme_file_uri( '/assets/css/editor-blocks.min.css' ) );
	// Google Font
	wp_enqueue_style( 'travelbiz-google-font', 'https://fonts.googleapis.com/css?family=Poppins:300,400,400i,500,600,700,700i', false );
}
add_action( 'enqueue_block_editor_assets', 'travelbiz_block_editor_styles' );

/**
* Adds a submit button in search form
* 
* @since Travelbiz 1.0.0
* @param string $form
* @return string
*/
function travelbiz_modify_search_form( $form ){
	return str_replace( '</form>', '<button type="submit" class="search-button"><span class="kfi kfi-search"></span></button></form>', $form );
}
add_filter( 'get_search_form', 'travelbiz_modify_search_form' );

/**
* Modify some markup for comment section
*
* @since Travelbiz 1.0.0
* @param array $defaults
* @return array $defaults
*/
function travelbiz_modify_comment_form_defaults( $defaults ){

	$user = wp_get_current_user();
	$user_identity = $user->exists() ? $user->display_name : '';

	$defaults[ 'logged_in_as' ] = '<p class="logged-in-as">' . sprintf(
          /* translators: 1: edit user link, 2: accessibility text, 3: user name, 4: logout URL */
          __( '<a href="%1$s" aria-label="%2$s">Logged in as %3$s</a> <a href="%4$s">Log out?</a>', 'travelbiz' ),
          get_edit_user_link(),
          /* translators: %s: user name */
          esc_attr( sprintf( __( 'Logged in as %s. Edit your profile.', 'travelbiz' ), $user_identity ) ),
          $user_identity,
          wp_logout_url( apply_filters( 'the_permalink', get_permalink( get_the_ID() ) ) )
      ) . '</p>';
	return $defaults;
}
add_filter( 'comment_form_defaults', 'travelbiz_modify_comment_form_defaults',99 );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 *
 * @since Travelbiz 1.0.0
 * @return void
 */
function travelbiz_pingback_header(){
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'travelbiz_pingback_header' );

/**
* Add a class in body when previewing customizer
*
* @since Travelbiz 1.0.0
* @param array $class
* @return array $class
*/
function travelbiz_body_class_modification( $class ){
	if( is_customize_preview() ){
		$class[] = 'keon-customizer-preview';
	}
	
	if( is_404() || ! have_posts() ){
 		$class[] = 'content-none-page';
	}

	if( travelbiz_get_option( 'site_layout' ) == 'site_layout_full' ){

		$class[] = 'site-layout-full';
	}

	return $class;
}
add_filter( 'body_class', 'travelbiz_body_class_modification' );

if( ! function_exists( 'travelbiz_get_ids' ) ):
/**
* Fetches setting from customizer and converts it to an array
*
* @uses travelbiz_explode_string_to_int()
* @return array | false
* @since Travelbiz 1.0.0
*/
function travelbiz_get_ids( $setting ){

    $str = travelbiz_get_option( $setting );
    if( empty( $str ) )
    	return;

    return travelbiz_explode_string_to_int( $str );

}
endif;

if( ! function_exists( 'travelbiz_inner_banner' ) ):
/**
* Includes the template for inner banner
*
* @return void
* @since Travelbiz 1.0.0
*/
function travelbiz_inner_banner(){

	$description = false;
	$image = false;
	$title = false;
	if( class_exists( 'WooCommerce' ) && is_shop() ){

		# For woocommerce shop Page.
		$title       = woocommerce_page_title( false );
		$description = '';
		$image       = travelbiz_home_image_url();	

	}else if( is_archive() ){

		# For all the archive Pages.
		$title       = get_the_archive_title();
		$description = get_the_archive_description();
	}else if( !is_front_page() && is_home() ){

		# For Blog Pages.
		$title = single_post_title( '', false );
		$image = travelbiz_home_image_url();	
	}else if( is_search() ){

		# For search Page.
		$title = esc_html__( 'Search Results for: ', 'travelbiz' ) . get_search_query();
	}else if( is_front_page() && is_home() ){

		# If Latest posts page
		$title = travelbiz_get_option( 'archive_page_title' );
		$image = travelbiz_home_image_url();	
	}else if( is_front_page() ){

		# If static Page
		$title = get_the_title();
		$image = travelbiz_home_image_url();	

	}else if( is_404() ){
		# If 404 error Page
		$image = travelbiz_error_image_url();	
	}else{
		
		# For all the single Pages.
		$title = get_the_title();
	}

	$args = array(
		'title'       => $title,
		'description' => $description,
		'image'		  => $image	
	);

	set_query_var( 'args', $args );
	get_template_part( 'template-parts/inner', 'banner' );
}
endif;

if( !function_exists( 'travelbiz_get_icon_by_post_format' ) ):
/**
* Gives a css class for post format icon
*
* @return string
* @since Travelbiz 1.0.0
*/
function travelbiz_get_icon_by_post_format(){
	$icons = array(
		'standard' => 'kfi-pushpin-alt',
		'sticky'   => 'kfi-pushpin-alt',
		'aside'    => 'kfi-documents-alt',
		'image'    => 'kfi-image',
		'video'    => 'kfi-arrow-triangle-right-alt2',
		'quote'    => 'kfi-quotations-alt2',
		'link'     => 'kfi-link-alt',
		'gallery'  => 'kfi-images',
		'status'   => 'kfi-comment-alt',
		'audio'    => 'kfi-volume-high-alt',
		'chat'     => 'kfi-chat-alt',
	);

	$format = get_post_format();
	if( empty( $format ) ){
		$format = 'standard';
	}

	return apply_filters( 'travelbiz_post_format_icon', $icons[ $format ] );
}
endif;

if( !function_exists( 'travelbiz_has_sidebar' ) ):

/**
* Check whether the page has sidebar or not.
*
* @see https://codex.wordpress.org/Conditional_Tags
* @since Travelbiz 1.0.0
* @return bool Whether the page has sidebar or not.
*/
function travelbiz_has_sidebar(){

	if( is_page() || is_search() || is_single() ){
		return false;
	}

	return true;
}
endif;

/**
* Check whether the sidebar is active or not.
*
* @see https://codex.wordpress.org/Conditional_Tags
* @since Travelbiz 1.0.0
* @return bool whether the sidebar is active or not.
*/
function travelbiz_is_active_footer_sidebar(){

	for( $i = 1; $i <= 4; $i++ ){
		if ( is_active_sidebar( 'travelbiz-footer-sidebar-'.$i ) ) : 
			return true;
		endif;
	}
	return false;
}

if( !function_exists( 'travelbiz_is_search' ) ):
/**
* Conditional function for search page / jet pack supported
* @since Travelbiz 1.0.0
* @return Bool 
*/

function travelbiz_is_search(){

	if( ( is_search() || ( isset( $_POST[ 'action' ] ) && $_POST[ 'action' ] == 'infinite_scroll'  && isset( $_POST[ 'query_args' ][ 's' ] ))) ){
		return true;
	}

	return false;
}
endif;

function travelbiz_post_class_modification( $classes ){

	# Add no thumbnail class when its search page
	if( travelbiz_is_search() && ( 'post' !== get_post_type() && !has_post_thumbnail() ) ){
		$classes[] = 'no-thumbnail';
	}
	return $classes;
}
add_filter( 'post_class', 'travelbiz_post_class_modification' );

require_once get_parent_theme_file_path( '/inc/setup.php' );
require_once get_parent_theme_file_path( '/inc/template-tags.php' );
require_once get_parent_theme_file_path( '/modules/loader.php' );
require_once get_parent_theme_file_path( '/trt-customize-pro/doc-link/class-customize.php' );
require_once get_parent_theme_file_path( '/modules/tgm-plugin-activation/loader.php' );
require_once get_parent_theme_file_path( '/theme-info/theme-info.php' );

if( !function_exists( 'travelbiz_get_homepage_sections' ) ):
/**
* Returns the section name of homepage
* @since Travelbiz 1.0.0
* @return array 
*/
function travelbiz_get_homepage_sections(){

	$arr = array(
		'slider',
		'trip-search',
		'about',
		'trip-category',
		'package',
		'trip-choice',
		'service',
		'clients',
		'callback',
		'blog',
		'testimonials',
		'contact',
	);

	return apply_filters( 'travelbiz_homepage_sections', $arr );
}
endif;

/**
* Change number or products per row to 3
* @since Travelbiz 1.0.0
*/

if (!function_exists( 'loop_columns' )) {
	function loop_columns() {
		return 3; // 3 products per row
	}
}
add_filter( 'loop_shop_columns', 'loop_columns' );

/**
* Allow skype protocols for social menu
* @since Travelbiz 1.0.0
*/

function travelbiz_ss_allow_skype_protocol( $protocols ){
    $protocols[] = 'skype';
    return $protocols;
}
add_filter( 'kses_allowed_protocols' , 'travelbiz_ss_allow_skype_protocol' );

/**
* Add a wrapper div to Woocommerce product
* @since Travelbiz 1.0.0
*/

function travelbiz_before_shop_loop_item(){
	echo '<div class="product-inner">';
}

add_action( 'woocommerce_before_shop_loop_item', 'travelbiz_before_shop_loop_item', 9 );

function travelbiz_after_shop_loop_item(){
	echo '</div>';
}

add_action( 'woocommerce_after_shop_loop_item', 'travelbiz_after_shop_loop_item', 11 );

/**
 * To remove kfi-icon from breadcrumb.
 *
 * @param array $items Breadcrumb items.
 * @param array $args Breadcrumb args.
 *
 * @since Travelbiz 1.0.0
 * @return array
 */

function travelbiz_breadcrumb_items( $items, $args ) {
	end($items);   
	$key = key($items);
	$last_item = $items[$key];
	$last_item = explode( '|', $last_item );
	$last_item = isset( $last_item[0] ) ? $last_item[0] : '';
	$items[ $key ] = $last_item;
	return $items;
}
add_filter( 'breadcrumb_trail_items', 'travelbiz_breadcrumb_items', 10, 2 );

/**
* Change menu, front page display as in demo after completing demo import
* @link https://wordpress.org/plugins/one-click-demo-import/
* @since Travelbiz 1.0.0
* @return null
*/
function travelbiz_ocdi_after_import_setup() {
    // Assign menus to their locations.
	$primary_menu = get_term_by('name', 'Primary Menu', 'nav_menu');
	$social_menu = get_term_by('name', 'Social Menu', 'nav_menu');
	$footer_menu = get_term_by('name', 'Footer Menu', 'nav_menu');
	set_theme_mod( 'nav_menu_locations' , array( 
	      'primary'    	  => $primary_menu->term_id,
	      'social'     	  => $social_menu->term_id,
	      'footer'     	  => $footer_menu->term_id
	     ) 
	);
    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Front' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

}
add_action( 'pt-ocdi/after_import', 'travelbiz_ocdi_after_import_setup' );

/**
* Disable branding of One Click Demo Import
* @link https://wordpress.org/plugins/one-click-demo-import/
* @since Travelbiz 1.0.0
* @return Bool
*/
function travelbiz_ocdi_branding(){
	return true;
}
add_filter( 'pt-ocdi/disable_pt_branding', 'travelbiz_ocdi_branding' );

/**
 * Remove archive prefix title.
 * @since Travelbiz 1.0.0
 */

function travelbiz_modify_archive_title( $title ) {
	if( is_category() ) {
		$title = single_cat_title( '', false );
	} elseif ( is_tag() ) {
		$title = single_tag_title( '', false );
    } elseif ( is_author() ) {
		$title = '<span class="vcard">' . get_the_author() . '</span>' ;
    } elseif ( is_year() ) {
        $title = get_the_date( _x( 'Y', 'yearly archives date format', 'travelbiz' ) );
    } elseif ( is_month() ) {
        $title = get_the_date( _x( 'F Y', 'monthly archives date format', 'travelbiz' ) );
    } elseif ( is_day() ) {
        $title = get_the_date( _x( 'F j, Y', 'daily archives date format', 'travelbiz' ) );
     } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }

	return $title;
}
add_filter( 'get_the_archive_title', 'travelbiz_modify_archive_title' );

/**
* Remove WooCommerce Shop Description
*
* @since Travelbiz 1.0.0
*/
function travelbiz_remove_woocommerce_shop_description( $args ) {
	$args['description'] = '';
	return $args;
}
add_filter( 'woocommerce_register_post_type_product', 'travelbiz_remove_woocommerce_shop_description' );

/**
* Show WooCommerce Shop Page Title
*
* @since Travelbiz 1.0.0
*/
function travelbiz_woo_show_page_title(){
	return false;
}
add_filter( 'woocommerce_show_page_title', 'travelbiz_woo_show_page_title' );

/**
* Adding P tag in content
*
* @since Travelbiz 1.0.0
*/
add_filter( 'the_content', 'wpautop' );

/**
* WP Travel Itinerary Thumbnail Size Modification
*
* @since Travelbiz 1.0.0
*/
function travelbiz_wp_travel_itinerary_thumbnail_size() {
	return array( 1200, 720 );
}
add_filter( 'wp_travel_itinerary_thumbnail_size', 'travelbiz_wp_travel_itinerary_thumbnail_size' );

/**
* WP Travel Itinerary Default Mode Modification
*
* @since Travelbiz 1.0.0
*/
function travelbiz_default_grid_mode(){
    return 'grid';
}
add_filter( 'wp_travel_default_view_mode', 'travelbiz_default_grid_mode' );

/**
* Header Banner adding in WP Travel Inner pages
*
* @since Travelbiz 1.0.0
*/
function travelbiz_show_header_banner(){
	travelbiz_inner_banner();
}
add_action('wp_travel_before_main_content', 'travelbiz_show_header_banner', 9 );

/**
* Remove Components before main content to WP Travel Inner pages
*
* @since Travelbiz 1.0.0
*/
remove_action( 'wp_travel_before_main_content', 'wp_travel_archive_toolbar' );