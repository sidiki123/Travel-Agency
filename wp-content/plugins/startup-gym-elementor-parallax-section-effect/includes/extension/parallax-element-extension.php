<?php

if ( ! defined( 'ABSPATH' ) ) exit; 

if ( ! class_exists( 'Parallax_Addons_Element_Parallax_Extension' ) ) {

	class Parallax_Addons_Element_Parallax_Extension {

		public $elementor_parallax_sections = array();

		
		private static $instance = null;

		public function init() {
			add_action( 'elementor/element/section/section_layout/after_section_end', array( $this, 'register_section' ), 10, 2 );

			add_action( 'elementor/frontend/element/before_render', array( $this, 'render_section' ) );

			add_action( 'elementor/frontend/section/before_render', array( $this, 'render_section' ) );

			add_action( 'elementor/frontend/before_enqueue_scripts', array( $this, 'custom_scripts' ));
		}

		
		public function register_section( $element, $args ) {

			$element->start_controls_section(
				'parallax_addons_section_parallax_plugin',
				array(
					'label' => esc_html__( 'Parallax Effect', 'parallax-addons' ),
					'tab'   => Elementor\Controls_Manager::TAB_LAYOUT,
				)
			);

			$repeater = new Elementor\Repeater();

			$repeater->add_control(
				'parallax_addons_plugin_layout_image',
				array(
					'label'     => esc_html__( 'Image As Background', 'parallax-addons' ),
					'type'      => Elementor\Controls_Manager::MEDIA,
					'dynamic'   => array( 'active' => true ),
					'selectors' => array(
						'{{WRAPPER}} {{CURRENT_ITEM}}.parallax-addons-parallax-plugin-section__layout .parallax-addons-plugin-section__image' => 'background-image: url("{{URL}}") !important;',
					),
				)
			);

			$repeater->add_control(
				'parallax_addons_plugin_layout_speed',
				array(
					'label'      => esc_html__( 'Parallax Speed(%)', 'parallax-addons' ),
					'type'       => Elementor\Controls_Manager::SLIDER,
					'size_units' => array( '%' ),
					'range'      => array(
						'%' => array(
							'min'  => 1,
							'max'  => 100,
						),
					),
					'default' => array(
						'size' => 50,
						'unit' => '%',
					),
				)
			);

			$repeater->add_control(
				'parallax_addons_plugin_layout_type',
				array(
					'label'   => esc_html__( 'Parallax Type', 'parallax-addons' ),
					'type'    => Elementor\Controls_Manager::SELECT,
					'default' => 'scroll',
					'options' => array(
						'none'   => esc_html__( 'None', 'parallax-addons' ),
						'scroll' => esc_html__( 'Scroll', 'parallax-addons' ),
						'mouse'  => esc_html__( 'Mouse Move', 'parallax-addons' ),
					),
				)
			);

			$repeater->add_control(
				'parallax_addons_plugin_layout_z_index',
				array(
					'label'    => esc_html__( 'z-Index', 'parallax-addons' ),
					'type'     => Elementor\Controls_Manager::NUMBER,
					'min'      => 0,
					'max'      => 99,
					'step'     => 1,
					'default'  => 1,
				)
			);

			$repeater->add_control(
				'parallax_addons_plugin_layout_bg_x',
				array(
					'label'   => esc_html__( 'Background X Position(%)', 'parallax-addons' ),
					'type'    => Elementor\Controls_Manager::NUMBER,
					'min'     => -200,
					'max'     => 200,
					'step'    => 1,
					'default' => 50,
				)
			);

			$repeater->add_control(
				'parallax_addons_plugin_layout_bg_y',
				array(
					'label'   => esc_html__( 'Background Y Position(%)', 'parallax-addons' ),
					'type'    => Elementor\Controls_Manager::NUMBER,
					'min'     => -200,
					'max'     => 200,
					'step'    => 1,
					'default' => 50,
				)
			);

			$repeater->add_control(
				'parallax_addons_plugin_layout_bg_size',
				array(
					'label'   => esc_html__( 'Background Size', 'parallax-addons' ),
					'type'    => Elementor\Controls_Manager::SELECT,
					'default' => 'auto',
					'options' => array(
						'auto'    => esc_html__( 'Auto', 'parallax-addons' ),
						'cover'   => esc_html__( 'Cover', 'parallax-addons' ),
						'contain' => esc_html__( 'Contain', 'parallax-addons' ),
					),
				)
			);

			$repeater->add_control(
				'parallax_addons_plugin_layout_animation_prop',
				array(
					'label'   => esc_html__( 'Animation Property', 'parallax-addons' ),
					'type'    => Elementor\Controls_Manager::SELECT,
					'default' => 'transform',
					'options' => array(
						'bgposition'  => esc_html__( 'Background Position', 'parallax-addons' ),
						'transform'   => esc_html__( 'Transform', 'parallax-addons' ),
						'transform3d' => esc_html__( 'Transform 3D', 'parallax-addons' ),
					),
				)
			);

			$element->add_control(
				'parallax_addons_plugin_layout_list',
				array(
					'type'    => Elementor\Controls_Manager::REPEATER,
					'fields'  => array_values( $repeater->get_controls() ),
					'default' => array(
						array(
							'parallax_addons_plugin_layout_image' => array(
								'url' => '',
							),
						)
					),
				)
			);

			$element->end_controls_section();
		}

		public function render_section( $element ) {
			$data     = $element->get_data();
			$type     = isset( $data['elType'] ) ? $data['elType'] : 'section';
			$settings = $data['settings'];

			if ( 'section' === $type && isset( $settings['parallax_addons_plugin_layout_list'] ) ) {
				$this->elementor_parallax_sections[ $data['id'] ] = method_exists( $element, 'get_settings_for_display' ) ? $element->get_settings_for_display( 'parallax_addons_plugin_layout_list' ) : $settings['parallax_addons_plugin_layout_list'];
			}
		}

		public function custom_scripts() {
			if ( ! array_key_exists( 'ParallaxPluginSections', parallax_addons_assets()->localize_data ) ) {
				parallax_addons_assets()->localize_data['ParallaxPluginSections'] = $this->elementor_parallax_sections;
			}
		}

		
		public static function get_instance() {
			if ( null == self::$instance ) {
				self::$instance = new self;
			}
			return self::$instance;
		}
	}
}
function parallax_addons_element_parallax_extension() {
	return Parallax_Addons_Element_Parallax_Extension::get_instance();
}
