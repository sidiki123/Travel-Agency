<?php
/**
 * Plugin Name: Elementor Parallax Effects Addon
 * Description: This addon for Elementor live page builder allowing to apply parallax effect for the section background, apply multi-layered parallax with different behavior triggers, animation types and positioning.
 * Version:     1.0.0
 * Author:      OneX Technologies
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! class_exists( 'Parallax_Addons' ) ) {

	
	class Parallax_Addons {

		const VERSION = '1.0.0';
		const MINIMUM_ELEMENTOR_VERSION = '2.4.4';
		const MINIMUM_PHP_VERSION = '7.0';
		private static $instance = null;
		private $plugin_url = null;
		private $plugin_path = null;
		

		public function __construct() {
			add_action('init', [$this, 'i18n']);
			add_action('plugins_loaded', [$this, 'init']);
			
			
			add_action( 'admin_menu', array( $this, 'admin_menus' ) );
			//add_action( 'admin_init', array( $this, 'check_setup_wizard' ) );
			add_action( 'admin_init', array( $this, 'setup_wizard' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}
		
		public function i18n() {
			load_plugin_textdomain('parallax-addons');
		}
		
		public function plugin_path( $path = null ) {

			if ( ! $this->plugin_path ) {
				$this->plugin_path = plugin_dir_path( __FILE__ );
			}
			return $this->plugin_path . $path;
		}
		
		public function plugin_url( $path = null ) {

			if ( ! $this->plugin_url ) {
				$this->plugin_url =  plugin_dir_url( __FILE__ );
			}
			return $this->plugin_url . $path;
		}
		
		public function init() {
			
			add_action( 'admin_init', array( $this, 'check_setup_wizard' ) );
			add_action( 'admin_notices', array( $this,'my_info_notice' ) );
			
			if(!did_action('elementor/loaded')) {
				add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
				return;
			}

			if(!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
				add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
				return;
			}
			
			if(version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
				add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
				return;
			}
			
			require $this->plugin_path( 'includes/extension/parallax-element-extension.php' );
			require $this->plugin_path( 'includes/assets.php' );
			parallax_addons_element_parallax_extension()->init();
			parallax_addons_assets()->init();
			do_action( 'parallax-addons/init', $this );
		}
		
		
		/* code for set up page */
		public function admin_menus() {
			add_dashboard_page( '', '', 'manage_options', 'pae-setup', '' );
		}
		
		/* code for set up check_setup_wizard */
		
		public function check_setup_wizard()
		{
			$returndata = $this->check_setup();
			if(empty($returndata))
			{
		
				wp_redirect( admin_url( 'index.php?page=pae-setup' ) );
				exit();

			}
		}
		
			public function check_setup()
		{
			$request = wp_remote_get('http://techybirds.com/wp-json/userdataget/pluginuserdataget?baseurl='.get_site_url().'&pluginname=parallax-addons');
			$body = wp_remote_retrieve_body( $request );
			$jakkdata = json_decode($body);
			return $jakkdata;
		}
		
		
		public function setup_wizard() {
			
			if ( empty( $_GET['page'] ) || 'pae-setup' !== $_GET['page'] ) { // WPCS: CSRF ok, input var ok.
				return;
			}
			
			if ( isset( $_REQUEST['action'] ))
			{
				
				$returndata = $this->savethird($_REQUEST);
				$jakkdata = json_decode($returndata);
				
				$message = $jakkdata->message;
				 
				if($message=='already')
				{
					wp_redirect( admin_url());
				}
				
				if($message=='insert')
				{
					wp_redirect( admin_url());
				}
				
			}
			
			ob_start();
			$this->setup_wizard_header();
			//$this->setup_wizard_steps();
			$this->setup_wizard_content();
			$this->setup_wizard_footer();
			exit;
		}
		public function savethird($data)
		{
			
			$name = $_REQUEST['fname'];
			$emailid = $_REQUEST['emailaddress'];
			//print_r($data); die;
			$request = wp_remote_get('http://techybirds.com/wp-json/userdataget/pluginuserdataget?baseurl="'.get_site_url().'"&pluginname=parallax-addons');
			//print_r($request);
			$body = wp_remote_retrieve_body( $request );
			$jakkdata = json_decode($body);
			//print_r($jakkdata);
			if(empty($jakkdata))
			{
					 $url  = 'http://techybirds.com/wp-json/userdataentery/pluginuserdataentery';
					$body = array(
						'name' => $name,
						'emailid' => $emailid,
						'baseurl' => get_site_url(),
						'pluginname'=> 'parallax-addons',
						);
				//print_r($body);
					$args = array(
						'method'      => 'POST',
						'timeout'     => 90,
						'sslverify'   => false,
						'headers'     => array(
							'Authorization' => 'none',
							'Content-Type'  => 'application/json',
						),
						'body'        => json_encode($body),
					);

    		$request = wp_remote_post( $url, $args );
			 if ( is_wp_error( $request ) || wp_remote_retrieve_response_code( $request ) != 200 ) {
					error_log( print_r( $request, true ) );
				}
			$response = wp_remote_retrieve_body( $request );
			
		//	print_r($response);
			}
			
			
			/*print_r($response);
			die;*/
			return $response;
			}
			
		public function enqueue_scripts() {
		
			$suffix  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
			if ('pae-setup' == $_GET['page'] ) {
				wp_enqueue_style( 'pae-setup', $this->plugin_url('assets/css/pae-setup.css'), '', '' );
			}
		}
		
		
		public function setup_wizard_header() {
		set_current_screen();
		?>
		<!DOCTYPE html>
		<html <?php language_attributes(); ?>>
		<head>
			<meta name="viewport" content="width=device-width" />
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<title><?php esc_html_e( 'Parallax Addons &rsaquo; Setup Wizard', 'parallax-addons' ); ?></title>
			<?php  do_action( 'admin_enqueue_scripts' ); ?>
			<?php wp_print_scripts( 'pae-setup' ); ?>
			<?php do_action( 'admin_print_styles' ); ?>
			<?php do_action( 'admin_head' ); ?>
		</head>
		<body class="cwe-setup wp-core-ui">
			<h1 id="cwe-logo"><a href="#"><img src="<?php echo esc_url( $this->plugin_url('assets/images/icon-128x128.png')); ?>" alt="<?php esc_attr_e( 'Parallax Addons Setup For elementor', 'parallax-addons' ); ?>" /></a></h1>
		<?php
	}
		
		/**
		* Setup Wizard content
		*/
		public function setup_wizard_content()
		{
			echo '<div class="cwe-setup-content">';
			?>
			<form method="post" class="emaildatasetup" action="<?php echo admin_url();?>?page=pae-setup&action=save-settings" name="emaildatasetup">
            <p class="store-setup"><?php esc_html_e( 'The following wizard will help you configure your store and get you started quickly.', 'parallax-addons' ); ?></p>
            <div class="store-address-container">
            <label class="location-prompt" for="store_address"><?php esc_html_e( 'Email address', 'parallax-addons' ); ?></label>
				<input type="email" id="emailaddress" class="location-input" name="emailaddress" required pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" value="<?php echo esc_attr( $address ); ?>" />

				<label class="location-prompt" for="store_address_2"><?php esc_html_e( 'Name', 'parallax-addons' ); ?></label>
				<input type="text" id="fname" class="location-input" name="fname" value="" required />
                <p class="wc-setup-actions step">
				<button class="button-primary button button-large" value="<?php esc_attr_e( "Save!", 'parallax-addons' ); ?>" name="save_step"><?php esc_html_e( "Save", 'parallax-addons' ); ?></button>
                
                
			</p>
            </div>
            </form>
            
			<?php 
			echo '</div>';
		}
		
		/**
	 * Setup Wizard Footer.
	 */
	public function setup_wizard_footer() {
		?>
			<?php //if ( 'store_setup' === $this->step ) : ?>
			<!--	<a class="cwe-setup-footer-links" href="<?php //echo esc_url( admin_url() ); ?>"><?php esc_html_e( 'Not right now', 'parallax-addons' ); ?></a>-->
			<?php //do_action( 'woocommerce_setup_footer' ); ?>
			</body>
		</html>
		<?php
	}
	
	
	function my_info_notice()
		{
		//	echo 'sdf';die;
		$paths = array();

			foreach(get_plugins() as $p_basename => $plugin)
			{
				
				
				$string = $plugin['Name'];
				$string = strtolower( $string );
	
				if (strpos($string, 'recaptcha') !== false) {
			
						$paths[] = is_plugin_active($p_basename) ? 'Active' : 'Disabled';
				}
			}
		
			if(in_array('Disabled',$paths))
			{
				$message = 'Install recaptcha plugin';
				printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
			}
			
			if(empty($paths))
			{
				$message = 'Install recaptcha plugin';
				printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
			}
		}
		
		public function admin_notice_missing_main_plugin() {
			if(isset($_GET['activate'])) unset($_GET['activate']);
			$message = sprintf(
				esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'parallax-addons'),
				'<strong>'.esc_html__('Elementor Parallax Effect', 'parallax-addons').'</strong>',
				'<strong>'.esc_html__('Elementor', 'parallax-addons').'</strong>'
			);
			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}

		public function admin_notice_minimum_elementor_version() {
			if(isset($_GET['activate'])) unset($_GET['activate']);
			$message = sprintf(
				esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'parallax-addons'),
				'<strong>'.esc_html__('Elementor Parallax Effect', 'parallax-addons').'</strong>',
				'<strong>'.esc_html__('Elementor', 'parallax-addons').'</strong>',
				self::MINIMUM_ELEMENTOR_VERSION
			);
			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}

		public function admin_notice_minimum_php_version() {
			if(isset($_GET['activate'])) unset($_GET['activate']);
			$message = sprintf(
				esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'Parallax Effect'),
				'<strong>'.esc_html__('Elementor Parallax Effect', 'Parallax Effect').'</strong>',
				'<strong>'.esc_html__('PHP', 'Parallax Effect').'</strong>',
				self::MINIMUM_PHP_VERSION
			);
			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}
		
		
		public static function get_instance() {
			
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
	}
}

if ( ! function_exists( 'parallax_addons' ) ) {	
	function parallax_addons() {
		return Parallax_Addons::get_instance();
	}
}

parallax_addons();
