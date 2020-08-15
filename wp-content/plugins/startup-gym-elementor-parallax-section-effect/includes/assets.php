<?php

if ( ! defined( 'ABSPATH' ) ) exit; 

if ( ! class_exists( 'Parallax_Addons_Assets' ) ) {

	class Parallax_Addons_Assets {

		public $localize_data = array();

		private static $instance = null;


		public function init() {
			add_action( 'elementor/frontend/after_enqueue_styles', array( $this, 'custom_styles' ) );
			add_action( 'elementor/frontend/before_enqueue_scripts', array( $this, 'custom_scripts' ), 10 );
		}

		
		public function custom_styles() {

			wp_enqueue_style(
				'parallax-addons-parallax-frontend',
				parallax_addons()->plugin_url( 'assets/css/parallax-addons-parallax-frontend.css' ),
				false
			);
		}

		public function custom_scripts() {
		
			wp_enqueue_script(
				'parallax-addons-parallax-frontend',
				parallax_addons()->plugin_url( 'assets/js/parallax-addons-parallax-frontend.js' ),
				array( 'jquery', 'elementor-frontend' ),
				true
			);

			wp_localize_script(
				'parallax-addons-parallax-frontend',
				'parallaxSection',
				apply_filters( 'parallax-addons-parallax/frontend/localize-data', $this->localize_data )
			);
		}

		public static function get_instance() {
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
	}

}

function parallax_addons_assets() {
	return Parallax_Addons_Assets::get_instance();
}
