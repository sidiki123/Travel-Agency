<?php
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Travelbiz 1.0.0
 */
function travelbiz_setup() {

	/*
 	 * Make theme available for translation.
 	*/
	load_theme_textdomain( 'travelbiz', get_template_directory() . '/languages' );

	# Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	# Set the default content width.
	$GLOBALS['content_width'] = apply_filters( 'travelbiz_content_width', 1050 );

	# Register menu locations.
	register_nav_menus( array(
		'primary'    => esc_html__( 'Primary Menu', 'travelbiz' ),
		'social'     => esc_html__( 'Social Menu', 'travelbiz' ),
		'footer'     => esc_html__( 'Footer Menu', 'travelbiz' )
	));

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-list',
		'gallery',
		'caption',
	) );

	add_theme_support( 'custom-header', array(
		'default-image'    => get_parent_theme_file_uri( '/assets/images/travelbiz-banner-1920-380.jpg' ),
		'width'            => 1920,
		'height'           => 380,
		'flex-height'      => true,
	));


	register_default_headers( array(
		'default-image' => array(
			'url'           => '%s/assets/images/travelbiz-banner-1920-380.jpg',
			'thumbnail_url' => '%s/assets/images/travelbiz-banner-1920-380.jpg',
			'description'   => esc_html__( 'Default Header Image', 'travelbiz' ),
		),
	) );

	# Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff',
	));

	# Enable support for selective refresh of widgets in Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );

	# Enable support for custom logo.
	add_theme_support( 'custom-logo', array(
		'width'       => 370,
		'height'      => 115,
		'flex-height' => true,
		'flex-width'  => true,
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
		'gallery',
		'status',
		'audio',
		'chat',
	) );

	add_theme_support( 'infinite-scroll', array(
	    'container' 	 => '#main-wrap',
	    'footer_widgets' => true,
	    'render'         => 'travelbiz_infinite_scroll_render',
	));

	add_theme_support( 'woocommerce' );

	/*
	* This theme styles the visual editor to resemble the theme style,
	* specifically font, colors, icons, and column width.
	*/
	
	add_editor_style( array( '/assets/css/editor-style.min.css') );

	// Gutenberg support
	add_theme_support( 'editor-color-palette', array(
       	array(
			'name' => esc_html__( 'Tan', 'travelbiz' ),
			'slug' => 'tan',
			'color' => '#D2B48C',
       	),
       	array(
           	'name' => esc_html__( 'Yellow', 'travelbiz' ),
           	'slug' => 'yellow',
           	'color' => '#FDE64B',
       	),
       	array(
           	'name' => esc_html__( 'Orange', 'travelbiz' ),
           	'slug' => 'orange',
           	'color' => '#ED7014',
       	),
       	array(
           	'name' => esc_html__( 'Red', 'travelbiz' ),
           	'slug' => 'red',
           	'color' => '#D0312D',
       	),
       	array(
           	'name' => esc_html__( 'Pink', 'travelbiz' ),
           	'slug' => 'pink',
           	'color' => '#b565a7',
       	),
       	array(
           	'name' => esc_html__( 'Purple', 'travelbiz' ),
           	'slug' => 'purple',
           	'color' => '#A32CC4',
       	),
       	array(
           	'name' => esc_html__( 'Blue', 'travelbiz' ),
           	'slug' => 'blue',
           	'color' => '#4E97D8',
       	),
       	array(
           	'name' => esc_html__( 'Green', 'travelbiz' ),
           	'slug' => 'green',
           	'color' => '#00B294',
       	),
       	array(
           	'name' => esc_html__( 'Brown', 'travelbiz' ),
           	'slug' => 'brown',
           	'color' => '#231709',
       	),
       	array(
           	'name' => esc_html__( 'Grey', 'travelbiz' ),
           	'slug' => 'grey',
           	'color' => '#7D7D7D',
       	),
       	array(
           	'name' => esc_html__( 'Black', 'travelbiz' ),
           	'slug' => 'black',
           	'color' => '#000000',
       	),
   	));

	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-font-sizes', array(
	   	array(
	       	'name' => esc_html__( 'small', 'travelbiz' ),
	       	'shortName' => esc_html__( 'S', 'travelbiz' ),
	       	'size' => 12,
	       	'slug' => 'small'
	   	),
	   	array(
	       	'name' => esc_html__( 'regular', 'travelbiz' ),
	       	'shortName' => esc_html__( 'M', 'travelbiz' ),
	       	'size' => 16,
	       	'slug' => 'regular'
	   	),
	   	array(
	       	'name' => esc_html__( 'larger', 'travelbiz' ),
	       	'shortName' => esc_html__( 'L', 'travelbiz' ),
	       	'size' => 36,
	       	'slug' => 'larger'
	   	),
	   	array(
	       	'name' => esc_html__( 'huge', 'travelbiz' ),
	       	'shortName' => esc_html__( 'XL', 'travelbiz' ),
	       	'size' => 48,
	       	'slug' => 'huge'
	   	)
	));
	add_theme_support( 'editor-styles' );
	add_theme_support( 'wp-block-styles' );

	add_image_size( 'travelbiz-1920-750', 1920, 750, true );
	add_image_size( 'travelbiz-1920-650', 1920, 650, true );
	add_image_size( 'travelbiz-1200-710', 1200, 710, true );
	add_image_size( 'travelbiz-580-580', 580, 580, true );
	add_image_size( 'travelbiz-380-250', 380, 250, true );
}
add_action( 'after_setup_theme', 'travelbiz_setup' );

if( ! function_exists( 'travelbiz_infinite_scroll_render' ) ):
/**
 * Set the code to be rendered on for calling posts,
 * hooked to template parts when possible.
 *
 * Note: must define a loop.
 */
function travelbiz_infinite_scroll_render(){
	while ( have_posts() ) : the_post();
		get_template_part( 'template-parts/archive/content', '' );
	endwhile;
	wp_reset_postdata();
}
endif;

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 * @since Travelbiz 1.0.0
 */
function travelbiz_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Right Sidebar', 'travelbiz' ),
		'id'            => 'right-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'travelbiz' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Header Sidebar', 'travelbiz' ),
		'id'            => 'header-sidebar',
		'description'   => esc_html__( 'Add widgets here. It will show in header alternative shift menu area.', 'travelbiz' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	for( $i = 1; $i <= 4; $i++ ){
		register_sidebar( array(
			'name'          => esc_html__( 'Footer', 'travelbiz' ) . $i,
			'id'            => 'travelbiz-footer-sidebar-' . $i,
			'description'   => esc_html__( 'Add widgets here.', 'travelbiz' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="footer-item">',
			'after_widget'  => '</div></div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}
	

}
add_action( 'widgets_init', 'travelbiz_widgets_init' );