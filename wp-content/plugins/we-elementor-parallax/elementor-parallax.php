<?php

/**
 * Plugin Name: Elementor Parallax
 * Plugin URI: https://webevasion.net/elementor-addons/
 * Description: Multi-layer parallax addon for Elementor !
 * Author: Webévasion
 * Version: 1.0.2
 * Author URI: https://webevasion.net/
 *
 * Text Domain: elementor-parallax
 */

	if(!defined('ABSPATH')) exit;

	class ElementorMultiLayerParallax {
		const VERSION = '1.0.0';
		const MINIMUM_ELEMENTOR_VERSION = '2.4.4';
		const MINIMUM_PHP_VERSION = '7.0';
		private static $_instance = null;

		public static function instance() {
			if(is_null(self::$_instance)) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		public function __construct() {
			add_action('init', [$this, 'i18n']);
			add_action('plugins_loaded', [$this, 'init']);

			add_action('elementor/widgets/widgets_registered', [$this, 'init_widgets']);
			add_action('elementor/editor/before_enqueue_scripts', [$this, 'before_enqueue_scripts'], 10);
			add_action('elementor/frontend/before_enqueue_scripts', [$this, 'before_enqueue_scripts'], 10);
			add_action('elementor/frontend/after_enqueue_styles', [$this, 'after_enqueue_styles'], 10);

			add_action('elementor_parallax_pro_notice', [$this, 'pro_notice'], 10);
		}

		public function i18n() {
			load_plugin_textdomain('elementor-parallax');
		}

		public function init() {
			//Check Elementor installation & activation
			if(!did_action('elementor/loaded')) {
				add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
				return;
			}
			//Check Elementor Version
			if(!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
				add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
				return;
			}
			//Check PHP Version
			if(version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
				add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
				return;
			}
		}

		/*
		*	Admin notices
		*/

		public function admin_notice_missing_main_plugin() {
			if(isset($_GET['activate'])) unset($_GET['activate']);
			$message = sprintf(
				esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'elementor-parallax'),
				'<strong>'.esc_html__('Elementor Multi-layer Parallax', 'elementor-parallax').'</strong>',
				'<strong>'.esc_html__('Elementor', 'elementor-parallax').'</strong>'
			);
			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}

		public function admin_notice_minimum_elementor_version() {
			if(isset($_GET['activate'])) unset($_GET['activate']);
			$message = sprintf(
				esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-parallax'),
				'<strong>'.esc_html__('Elementor Multi-layer Parallax', 'elementor-parallax').'</strong>',
				'<strong>'.esc_html__('Elementor', 'elementor-parallax').'</strong>',
				self::MINIMUM_ELEMENTOR_VERSION
			);
			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}

		public function admin_notice_minimum_php_version() {
			if(isset($_GET['activate'])) unset($_GET['activate']);
			$message = sprintf(
				esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-parallax'),
				'<strong>'.esc_html__('Elementor Multi-layer Parallax', 'elementor-parallax').'</strong>',
				'<strong>'.esc_html__('PHP', 'elementor-parallax').'</strong>',
				self::MINIMUM_PHP_VERSION
			);
			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}


		/*
		*	Init widgets
		*/
		public function init_widgets() {
			require_once(__DIR__.'/widgets/elementor-parallax-widget.php');
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \ElementorMultiLayerParallaxWidget());
		}

		/*
		*	Enqueue scripts
		*/
		public function before_enqueue_scripts() {
			wp_enqueue_script('elementor-parallax-js', plugins_url('/assets/js/elementor-parallax.js', __FILE__), ['jquery'], '1.0.0', true);
		}

		/*
		*	Enqueue styles
		*/
		public function after_enqueue_styles() {
			wp_enqueue_style('elementor-parallax', plugins_url('/assets/css/elementor-parallax.css', __FILE__), [], '1.0.0');
		}

		/*
		*	Pro notice
		*/
		public function pro_notice() {
			return 'Need more options ?<br>Elementor Parallax Pro is coming soon !';
		}
	}
	ElementorMultiLayerParallax::instance();

?>