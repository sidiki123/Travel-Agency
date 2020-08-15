<?php
/**
 * Plugin Name: ASVG Lottie Animation Library for Elementor
 * Description: Elementor Lottie widget with animated graphics library
 * Version: 1.4.0
 * Author: animatedsvg
 * Author URI: https://animated-svg.com/lottie-animation/
 * Text Domain: asvg-lottie
 */

// Prevent direct access to files
if ( ! defined( 'ABSPATH' ) ) exit;

final class Plugin {
  /**
   * Plugin version
   *
   * @var string The plugin version
   */
  const VERSION = '1.4.0';

  /**
   * Minimum Elementor version
   *
   * @var string Minimum Elementor version required to run the plugin
   */
  const MINIMUM_ELEMENTOR_VERSION = '2.9.14';

  /**
   * Minimum PHP version
   *
   * @var string Minimum PHP version required to run the plugin
   */
  const MINIMUM_PHP_VERSION = '5.6.20';

  /**
   * Instance
   *
   * @var Plugin The single instance of the class
   */
  private static $_instance = null;

	
  /**
   * Instance
   *
   * Ensures only one instance of the class is loaded or can be loaded
   * 
   * @return Plugin An instance of the class
   */
  public static function instance() {
    if ( is_null( self::$_instance ) ) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }

  /**
   * Plugin constructor
   */
  public function __construct() {
    add_action( 'init', array( $this, 'load_textdomain' ) );
    add_action( 'plugins_loaded', array( $this, 'init' ) );
	add_action( 'elementor/elements/categories_registered', [ $this, 'widget_categories' ], 99 );

	$this->setup_constants();
  }

	
	
  /**
   * Load plugin localization files
   */
  public function load_textdomain() {
    load_plugin_textdomain( 'asvg-lottie',
      false, // this parameter is deprecated
      dirname( plugin_basename( __FILE__ ) ) . '/languages' );
  }

  /**
   * Add an admin notice to warn about Elementor not being installed/activated
   */
  public function admin_notice_missing_main_plugin() {
    if ( isset( $_GET['activate'] ) ) {
      unset( $_GET['activate'] );
    }

    $message = sprintf(
      /* translators: 1: Plugin name 2: Elementor */
      esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'asvg-lottie' ),
      '<strong>' . esc_html__( 'ASVG Lottie', 'asvg-lottie' ) . '</strong>',
      '<strong>' . esc_html__( 'Elementor', 'asvg-lottie' ) . '</strong>'
    );
    
    printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
  }

  /**
   * Add an admin notice to warn about old version of Elementor
   */
  public function admin_notice_minimum_elementor_version() {
    if ( isset( $_GET['activate'] ) ) {
      unset( $_GET['activate'] );
    }

    $message = sprintf(
      /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
      esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-extension' ),
      '<strong>' . esc_html__( 'ASVG Lottie', 'elementor-test-extension' ) . '</strong>',
      '<strong>' . esc_html__( 'Elementor', 'elementor-test-extension' ) . '</strong>',
      self::MINIMUM_ELEMENTOR_VERSION
    );

    printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
  }

  /**
   * Add an admin notice to warn about old version of PHP
   */
  public function admin_notice_minimum_php_version() {
    if ( isset( $_GET['activate'] ) ) {
      unset( $_GET['activate'] );
    }

    $message = sprintf(
      /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
      esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'asvg-lottie' ),
      '<strong>' . esc_html__( 'ASVG Lottie', 'asvg-lottie' ) . '</strong>',
      '<strong>' . esc_html__( 'PHP', 'asvg-lottie' ) . '</strong>',
      self::MINIMUM_PHP_VERSION
    );

    printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
  }
  
  /**
   * Initialize widgets
   * Include widget files and register them
   */
  public function init_widgets() {
    // Include widget files
    require_once( __DIR__ . '/widgets/lottie-icons.php' );

    // Register widget
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \ASVGLottie\Widgets\LottieIcons() );
  }

  /**
   * Initialize the plugin
   * Fire once all activated plugins have loaded
   */
  public function init() {
    // Check if Elementor is installed and activated
    if ( ! did_action( 'elementor/loaded' ) ) {
      add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
      return;
    }

    // Check for required Elementor version
    if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
      add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
      return;
    }

    // Check for required PHP version
    if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
      add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
      return;
    }

    // Include files
	require_once( __DIR__ . '/inc/helper-function.php' );
	require_once( __DIR__ . '/inc/options.php' ); 


    // Add plugin actions
    add_action( 'elementor/widgets/widgets_registered', array( $this, 'init_widgets' ) );
  }
	 public function widget_categories( $elements_manager )
        {
            $elements_manager->add_category( 'lottie-icons', [
                'title' => __( 'ASVG Lottie Animations', 'animatesvg' ),
                'icon'  => 'fa fa-icons',
            ] );
        }
		


  /**
   * Setup plugin constants
   */
  private function setup_constants() {
    if ( ! defined( 'ASVGLottie\VERSION' ) ) {
      define( 'ASVGLottie\VERSION', self::VERSION );
    }

    if ( ! defined( 'ASVGLottie\PLUGIN_DIR' ) ) {
      define( 'ASVGLottie\PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
    }

    if ( ! defined( 'ASVGLottie\PLUGIN_URL' ) ) {
      define( 'ASVGLottie\PLUGIN_URL', plugin_dir_url( __FILE__ ) );
    }

    if ( ! defined( 'ASVGLottie\PLUGIN_FILE' ) ) {
      define( 'ASVGLottie\PLUGIN_FILE', __FILE__ );
    }
	define( 'ASVGLottie_PLUGIN_MENU', 'asvg-menu-lottie' );	  
  }
  
}

register_activation_hook(__FILE__, 'asvg_lottie_activate');
add_action('admin_init', 'asvg_lottie_redirect');

function asvg_lottie_activate() {
add_option('asvg_lottie_do_activation_redirect', true);
}

function asvg_lottie_redirect() {
if (get_option('asvg_lottie_do_activation_redirect', false)) {
    delete_option('asvg_lottie_do_activation_redirect');
    if(!isset($_GET['activate-multi']))
    {
        wp_redirect("admin.php?page=asvg_menu_lottie");
    }
 }
}

// add menu links to the plugin entry in the plugins menu
function asvg_lottie_plugin_action_links($links, $file) {
    static $this_plugin;
 
    if (!$this_plugin) {
        $this_plugin = plugin_basename(__FILE__);
    }
 
    // check to make sure we are on the correct plugin
    if ($file == $this_plugin) {
 
		// link to what ever you want
		$plugin_links[] = '<a title="Free & premium animations by ASVG." href="https://lottiefiles.com/asvg" target="_blank"><b>Get more animations...</b></a>';
		
 
        // add the links to the list of links already there
		foreach($plugin_links as $link) {
			array_unshift($links, $link);
		}
    }

    return $links;
}
add_filter('plugin_action_links', 'asvg_lottie_plugin_action_links', 100, 110);

// Initialize the plugin
Plugin::instance();
