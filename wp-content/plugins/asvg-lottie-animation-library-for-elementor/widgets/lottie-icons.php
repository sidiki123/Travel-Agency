<?php

namespace ASVGLottie\Widgets;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;

// Prevent direct access to files
if ( ! defined( 'ABSPATH' ) ) exit;


class LottieIcons extends \Elementor\Widget_Base {
  public function __construct( $data = array(), $args = null ) {
    parent::__construct( $data, $args );

    // Register scripts
    wp_register_script(
      'lottie',
      \ASVGLottie\PLUGIN_URL . 'assets/js/lottie.min.js',
      array(), // dependencies
      '5.6.4'
    );

    wp_register_script(
      'asvg-frontend',
      \ASVGLottie\PLUGIN_URL . 'assets/js/frontend.js',
      array( 'jquery', 'lottie' ), // dependencies
      '1.0.0'
    );
	
	wp_enqueue_style(
      'lottie',
      \ASVGLottie\PLUGIN_URL . 'assets/css/lottie.css'
    );
  }

  public function get_script_depends() {
    return array( 'lottie', 'asvg-frontend' );
  }

  public function get_style_depends() {
    return array( 'asvg-lottie-widget' );
  }

  public function get_name() {
    return 'lottie';
  }

  public function get_title() {
    return __( 'Lottie Icon Library', 'asvg-lottie' );
  }

  public function get_icon() {
    return 'eicon-theme-style asvglottie';
  }

  public function get_categories() {
    return array( 'general' );
  }

  private function add_animation_section() {
    $this->start_controls_section(
      'animation_section',
      array(
        'label' => __( 'Lottie Animations', 'asvg-lottie' ),
        'tab'   => \Elementor\Controls_Manager::TAB_CONTENT
      )
    );
	$this->add_control(
			'info',
			[
				
				'label' => __( '<span style="font-style: normal; line-height: 16px;">To upload your own or cutomized animations select "Upload animation" from the drop-down.</span>', 'asvg-lottie' ),
				'type' => Controls_Manager::RAW_HTML,				
				
			]
		);	
	$this->add_control(
			'select_option',
			[
				'label' => __( 'Select option', 'asvg-lottie' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'lottiearchive',
				'options' => [
					'data_file'  => __( 'Upload animation', 'asvg-lottie' ),
					'asvg_lottie_blob_icons'  => __( 'Blob icons', 'asvg-lottie' ),
					'asvg_lottie_filled_icons'  => __( 'Filled icon/graphic', 'asvg-lottie' ),
					'asvg_lottie_line_icons'  => __( 'Line icon/graphic', 'asvg-lottie' ),
					'lottiearchive'  => __( 'From lottiefiles.com', 'asvg-lottie' ),
				],
			]
		);
	  

	$this->add_control(
			'asvg_lottie_blob_icons',
			[
				'label' => __( 'Select animation', 'asvg-lottie' ),
				'type' => Controls_Manager::SELECT,
				'default' => '8.lottiefiles.com/private_files/lf30_qjc7Z0.json',
				'options' => asvg_blob_icons_list(),
				'condition' => [
					'select_option' => 'asvg_lottie_blob_icons',					
				],
			]
		);	
	
	$this->add_control(
			'asvg_lottie_filled_icons',
			[
				'label' => __( 'Select animation', 'asvg-lottie' ),
				'type' => Controls_Manager::SELECT,
				'default' => '10.lottiefiles.com/packages/lf20_N8fxnG.json',
				'options' => asvg_filled_basic_icons_list(),
				'condition' => [
					'select_option' => 'asvg_lottie_filled_icons',					
				],
			]
		);
		
		
	$this->add_control(
			'asvg_lottie_line_icons',
			[
				'label' => __( 'Select animation', 'asvg-lottie' ),
				'type' => Controls_Manager::SELECT,
				'default' => '8.lottiefiles.com/private_files/lf30_Qe4WLa.json',
				'options' => asvg_line_icons_list(),
				'condition' => [
					'select_option' => 'asvg_lottie_line_icons',					
				],
			]
		);

	$this->add_control(
			'lottiefiles',
			[
				'label' => __( 'Select category', 'asvg-lottie' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'animals',
				'options' => [
				'animals'  => __( 'Animals', 'asvg-lottie' ),
				'hero_section'  => __( 'Hero section graphics', 'asvg-lottie' ),
				'icon'  => __( 'Icons', 'asvg-lottie' ),
				'object'  => __( 'Objects', 'asvg-lottie' ),
				'people'  => __( 'People', 'asvg-lottie' ),
				'smiley'  => __( 'Smilies', 'asvg-lottie' ),

				],
				'condition' => [
					'select_option' => 'lottiearchive',			
				],
			]
		);
	
	$this->add_control(
			'animals',
			[
				'label' => __( 'Select animation', 'asvg-lottie' ),
				'type' => Controls_Manager::SELECT,
				'default' => '6.lottiefiles.com/packages/lf20_534x8Y.json',
				'options' => animals_list(),
				'condition' => [
					'lottiefiles' => 'animals',
					'select_option' => 'lottiearchive',	
					
				],
			]
		);
	
		
	$this->add_control(
			'hero_section',
			[
				'label' => __( 'Select animation', 'asvg-lottie' ),
				'type' => Controls_Manager::SELECT,
				'default' => '10.lottiefiles.com/packages/lf20_PVodGv.json',
				'options' => hero_section_list(),
				'condition' => [
					'lottiefiles' => 'hero_section',
					'select_option' => 'lottiearchive',	
					
				],
			]
		);	
			
	$this->add_control(
			'icon',
			[
				'label' => __( 'Select animation', 'asvg-lottie' ),
				'type' => Controls_Manager::SELECT,
				'default' => '10.lottiefiles.com/packages/lf20_xoz6Xj.json',
				'options' => icons_section_list(),
				'condition' => [
					'lottiefiles' => 'icon',
					'select_option' => 'lottiearchive',	
					
				],
			]
		);	

	$this->add_control(
			'object',
			[
				'label' => __( 'Select animation', 'asvg-lottie' ),
				'type' => Controls_Manager::SELECT,
				'default' => '1.lottiefiles.com/packages/lf20_eyo6u7.json',
				'options' => object_section_list(),
				'condition' => [
					'lottiefiles' => 'object',
					'select_option' => 'lottiearchive',	
					
				],
			]
		);	
	  
	$this->add_control(
			'people',
			[
				'label' => __( 'Select animation', 'asvg-lottie' ),
				'type' => Controls_Manager::SELECT,
				'default' => '2.lottiefiles.com/packages/lf20_9ohIYM.json',
				'options' => people_list(),
				'condition' => [
					'lottiefiles' => 'people',
					'select_option' => 'lottiearchive',	
					
				],
			]
		);
		
	$this->add_control(
			'smiley',
			[
				'label' => __( 'Select animation', 'asvg-lottie' ),
				'type' => Controls_Manager::SELECT,
				'default' => '9.lottiefiles.com/packages/lf20_oMfXqv.json',
				'options' => smiley_list(),
				'condition' => [
					'lottiefiles' => 'smiley',
					'select_option' => 'lottiearchive',	
					
				],
			]
		);

	$this->add_control(
			'customize_url',
			[
				'label' => __( 'Customize Lottie?', 'asvg-lottie' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'asvg-lottie' ),
				'label_off' => __( 'No', 'asvg-lottie' ),
				'return_value' => 'yes',
				'default' => 'no',
				'condition' => [
					'select_option' => [ 'asvg_lottie_blob_icons', 'asvg_lottie_filled_icons', 'asvg_lottie_line_icons', 'lottiearchive' ]
				]
			]
			
          );
	  
	  $this->add_control(
			'customize',
			[
				'label' => __( '<span style="font-size: 12px; line-height: 1.4">Open page in preview and click on <b>link below animation</b> to customize image. Watch short instructional <a href="https://youtu.be/SYDKoKi8j3I" target="_blank">video</a>.<br></span>', 'animatesvg' ),
				'type' => Controls_Manager::RAW_HTML,
				'condition' => [
					'customize_url' => 'yes',
					'select_option' => [ 'asvg_lottie_blob_icons', 'asvg_lottie_filled_icons', 'asvg_lottie_line_icons', 'lottiearchive' ]
			]
			]
		);
	  
	 $this->add_control(
      'data_file',
      array(
        'label'       => __( 'Upload your json file', 'asvg-lottie' ),
						'condition'   => array(
					'select_option' => 'data_file',
				),
        'type'        => \Elementor\Controls_Manager::MEDIA,
        'media_type'  => 'application/json',
      )
    );		

    
    $this->add_control(
      'link_enabled',
      array(
        'label'     => __( 'Link', 'asvg-lottie' ),
		'separator' => 'before',	
        'type'      => \Elementor\Controls_Manager::SWITCHER,
        'label_on'  => __( 'Yes', 'asvg-lottie' ),
        'label_off' => __( 'No', 'asvg-lottie' )
      )
    );

		$this->add_control(
			'link',
			array(
				'label'       => __( 'Link', 'asvg-lottie' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => __( 'https://your-link.com', 'asvg-lottie' ),
				'condition'   => array(
					'link_enabled' => 'yes',
				),
				'show_label'  => false,
			)
		);


	$this->add_control(
			'options',
			[
				'label' => __( '<b>Animations Options</b>' ),
				'type' => Controls_Manager::RAW_HTML,
				'separator' => 'before',				
				
			]
		);	

    $this->add_control(
      'speed',
      array(
        'label'       => __( 'Speed (default speed is 1)', 'asvg-lottie' ),

        'type'        => \Elementor\Controls_Manager::NUMBER,
        'step'        => '0.1',
        'placeholder' => '1',
        'default'     => '1'
      )
    );
	
	    $this->add_control(
      'delay',
      array(
        'label'   => __( 'Delay (in ms)', 'asvg-lottie' ),
        'type'    => \Elementor\Controls_Manager::NUMBER,
        'step'    => '500',
        'min'     => '0',
        'default' => '1000',
        'condition' => array(
          'autoplay' => 'yes',
        ),
      )
    );


    $this->add_control(
      'autoplay',
      array(
        'label'       => __( 'Autoplay', 'asvg-lottie' ),
        'type'        => \Elementor\Controls_Manager::SWITCHER,
        'label_on'    => __( 'Yes', 'asvg-lottie' ),
        'label_off'   => __( 'No', 'asvg-lottie' ),
        'default'     => 'yes'
      )
    );

    $this->add_control(
      'loop',
      array(
        'label'     => __( 'Loop', 'asvg-lottie' ),
        'type'      => \Elementor\Controls_Manager::SWITCHER,
        'label_on'  => __( 'Yes', 'asvg-lottie' ),
        'label_off' => __( 'No', 'asvg-lottie' ),
		'default'     => 'yes'
      )
    );

    $this->add_control(
      'reversed',
      array(
        'label'     => __( 'Reverse', 'asvg-lottie' ),
        'type'      => \Elementor\Controls_Manager::SWITCHER,
        'label_on'  => __( 'Yes', 'asvg-lottie' ),
        'label_off' => __( 'No', 'asvg-lottie' )
      )
    );

    $this->add_control(
      'onmouseover',
      array(
        'label'     => __( 'Play on mouse over', 'asvg-lottie' ),
		
        'type'      => \Elementor\Controls_Manager::SWITCHER,
        'label_on'  => __( 'Yes', 'asvg-lottie' ),
        'label_off' => __( 'No', 'asvg-lottie' )
      )
    );

    $this->add_control(
      'onmouseout',
      array(
        'label'   => __( 'On mouse out', 'asvg-lottie' ),
        'type'    => \Elementor\Controls_Manager::SELECT,
        'options' => array(
          'stop'    => __( 'Stop', 'asvg-lottie' ),
          'pause'   => __( 'Pause', 'asvg-lottie' ),
          'reverse' => __( 'Reverse', 'asvg-lottie' ),
		  'replay' => __( 'Replay', 'asvg-lottie' )
        ),
        'default' => 'replay',
        'condition' => array(
          'onmouseover' => 'yes',
        ),
      )
    );


	$this->add_control(
         'infomore',
              [
                 'label'   => __( '<b>Get more free & premium animations: <a href="https://lottiefiles.com/asvg" target="_blank">here</a>.</b>' ),
                 'type' => Controls_Manager::RAW_HTML,
				 'separator' => 'before',	
				 

              ]
            );
    $this->end_controls_section();
  }
  
  private function add_styles_section() {
    $this->start_controls_section(
			'style_section',
			array(
				'label' => __( 'Lottie Style', 'asvg-lottie' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
      )
    );

    // Dimensions
    $this->add_responsive_control(
			'width',
			array(
				'label' => __( 'Width', 'asvg-lottie' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => array(
					'unit' => '%',
				),
				'tablet_default' => array(
					'unit' => '%',
				),
				'mobile_default' => array(
					'unit' => '%',
				),
				'size_units' => array( '%', 'px', 'vw' ),
				'range' => array(
					'%' => array(
						'min' => 1,
						'max' => 100,
					),
					'px' => array(
						'min' => 1,
						'max' => 1000,
					),
					'vw' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .asvg-lottie-widget' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
    );
    
    $this->add_responsive_control(
			'space',
			array(
				'label' => __( 'Max Width', 'asvg-lottie' ) . ' (%)',
				'type' => \Elementor\Controls_Manager::SLIDER,
				'default' => array(
					'unit' => '%',
				),
				'tablet_default' => array(
					'unit' => '%',
				),
				'mobile_default' => array(
					'unit' => '%',
				),
				'size_units' => array( '%' ),
				'range' => array(
					'%' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .asvg-lottie-widget' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
    );
	
    $this->add_responsive_control(
			'align',
			array(
				'label' => __( 'Alignment', 'asvg-lottie' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => array(
					'flex-start' => array(
						'title' => __( 'Left', 'asvg-lottie' ),
						'icon' => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'asvg-lottie' ),
						'icon' => 'eicon-text-align-center',
					),
					'flex-end' => array(
						'title' => __( 'Right', 'asvg-lottie' ),
						'icon' => 'eicon-text-align-right',
					),
				),
				'selectors' => array(
          '{{WRAPPER}} .elementor-widget-container'   => 'display: flex; justify-content: {{VALUE}};',
          '{{WRAPPER}} .elementor-widget-container a' => 'display: flex; justify-content: {{VALUE}};'
				),
			)
    );	
    
    $this->add_control(
			'separator_panel_style',
			array(
				'type'  => \Elementor\Controls_Manager::DIVIDER,
				'style' => 'thick',
      )
    );
    
    // Opacity and CSS filters
    $this->start_controls_tabs( 'image_effects' );

		$this->start_controls_tab( 'normal',
			array(
				'label' => __( 'Normal', 'asvg-lottie' ),
			)
		);
		
		
		$this->add_control(
			'rotate',
			[
				'label' => __( 'Rotatation', 'asvg-lottie' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'selectors' => [
					'{{WRAPPER}} .asvg-lottie-widget' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);
		
		
		$this->add_control(
			'opacity',
			array(
				'label' => __( 'Opacity', 'asvg-lottie' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => array(
					'px'  => array(
						'max'   => 1,
						'min'   => 0.10,
						'step'  => 0.01,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .asvg-lottie-widget' => 'opacity: {{SIZE}};',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			array(
				'name' => 'css_filters',
				'selector' => '{{WRAPPER}} .asvg-lottie-widget',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'hover',
			array(
				'label' => __( 'Hover', 'asvg-lottie' ),
			)
		);

		$this->add_control(
			'rotate_hover',
			[
				'label' => __( 'Rotatation', 'asvg-lottie' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0,
					'unit' => 'deg',
				],
				'selectors' => [
					'{{WRAPPER}} .asvg-lottie-widget:hover' => 'transform: rotate({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_control(
			'opacity_hover',
			array(
				'label' => __( 'Opacity', 'asvg-lottie' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => array(
					'px'  => array(
						'max'   => 1,
						'min'   => 0.10,
						'step'  => 0.01,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .asvg-lottie-widget:hover' => 'opacity: {{SIZE}};',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			array(
				'name' => 'css_filters_hover',
				'selector' => '{{WRAPPER}} .asvg-lottie-widget:hover',
			)
		);

		$this->add_control(
			'background_hover_transition',
			array(
				'label' => __( 'Transition Duration', 'asvg-lottie' ),
				'type'  => \Elementor\Controls_Manager::SLIDER,
				'range' => array(
					'px'  => array(
						'max'   => 3,
						'step'  => 0.1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .asvg-lottie-widget' => 'transition-duration: {{SIZE}}s',
				),
			)
		);

		$this->add_control(
			'hover_animation',
			[	
				'label' => __( 'Hover animation', 'asvg-lottie' ),
				'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
				'prefix_class' => 'elementor-animation-',
			]
		);			

		$this->end_controls_tab();

		$this->end_controls_tabs();

    // Border and box shadow
    $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			array(
				'name'      => 'lottie_border',
				'selector'  => '{{WRAPPER}} .asvg-lottie-widget',
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'lottie_border_radius',
			array(
				'label'       => __( 'Border Radius', 'asvg-lottie' ),
				'type'        => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units'  => array( 'px', '%' ),
				'selectors'   => array(
					'{{WRAPPER}} .asvg-lottie-widget' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'lottie_box_shadow',
				'exclude'   => array( 'box_shadow_position' ),
				'selector'  => '{{WRAPPER}} .asvg-lottie-widget',
			)
		);
			

		$this->add_control(
         'infoasvg',
              [
                 'label'   => __( '<b>Get 200 SVG icons FREE, download <a href="https://animated-svg.com/" target="_blank">Animated SVG Icons</a> for Elementor page builder.</b>' ),
                 'type' => Controls_Manager::RAW_HTML,
				 'separator' => 'before',	
				 

              ]
            );	
			
		$this->end_controls_section();

		$this->end_controls_section();
  }

  /**
   * Register ASVGLottie Lottie widget controls
   *
   * Adds different input fields to allow the user
   * to change and customize the widget settings
   */
  protected function _register_controls() {
    $this->add_animation_section();
    $this->add_styles_section();
  }

  /**
   * Return either the on or the off value based on the given setting
   *
   * @param string $setting   The setting to check
   * @param string $on_val    The on value (if setting is 'yes')
   * @param string $off_val   The off value (if setting is not 'yes')
   * @return string           Either the on or the off value
   */
  private function switcher_value( $setting, $on_val, $off_val ) {
    return $setting === 'yes' ? $on_val : $off_val;
  }

  /**
   * Retrieve widget link URL
   *
   * @param array $settings
   * @return array|string|false An array/string containing the link URL, or false if no link
   */
  private function get_link_url( $settings ) {
    if ( 'yes' !== $settings['link_enabled'] || empty( $settings['link']['url'] ) ) {
      return false;
    }

    return $settings['link'];
  }

  /**
   * Render ASVGLottie Lottie widget output on the frontend
   * Generates the final HTML
   */
  protected function render() {
    $widget_id = $this->get_id();
    $settings = $this->get_settings_for_display();
    
/*    // If animation data
    if ( ! isset( $settings['data_file']['url'] ) || empty( $settings['data_file']['url'] ) ) {
      return;
    }

    // Get the url pointing to the animation data JSON file
	
	 if ( ! isset( $settings['data_file']['url'] ) || empty( $settings['data_file']['url'] ) ) {
      return;
    }
*/
    // Get the url pointing to the animation data JSON file
	

    $data_file_url = $settings['data_file']['url'];
	
	if($settings['select_option'] == 'asvg_lottie_blob_icons'){
	$data_file_url  = 'https://assets'.esc_attr($settings["asvg_lottie_blob_icons"]);}

	if($settings['select_option'] == 'asvg_lottie_filled_icons'){
	$data_file_url  = 'https://assets'.esc_attr($settings["asvg_lottie_filled_icons"]);}
	
	if($settings['select_option'] == 'asvg_lottie_line_icons'){
	$data_file_url  = 'https://assets'.esc_attr($settings["asvg_lottie_line_icons"]);}
	
	if($settings['lottiefiles'] == 'animals'){
	$data_file_url  = 'https://assets'.esc_attr($settings["animals"]);}	
	
	if($settings['lottiefiles'] == 'hero_section'){
	$data_file_url  = 'https://assets'.esc_attr($settings["hero_section"]);}
	
	if($settings['lottiefiles'] == 'icon'){
	$data_file_url  = 'https://assets'.esc_attr($settings["icon"]);}
	
	if($settings['lottiefiles'] == 'object'){
	$data_file_url  = 'https://assets'.esc_attr($settings["object"]);}
	
	if($settings['lottiefiles'] == 'people'){
	$data_file_url  = 'https://assets'.esc_attr($settings["people"]);}
	
	if($settings['lottiefiles'] == 'smiley'){
	$data_file_url  = 'https://assets'.esc_attr($settings["smiley"]);}
	

	


    // Make sure animation data is a JSON
    $ext = strtolower( substr( $data_file_url, -5 ) );
    if ( '.json' !== $ext ) {
      return;
    }

    // Parse settings
    $link = $this->get_link_url( $settings );
    $loop = $this->switcher_value( $settings['loop'], 'true', 'false' );
    $speed = $settings['speed'];
    $direction = $this->switcher_value( $settings['reversed'], '-1', '1' );
    $autoplay = $this->switcher_value( $settings['autoplay'], 'true', 'false' );
    $delay = $settings['delay'];
    $mouseover = $this->switcher_value( $settings['onmouseover'], 'true', 'false' );
    $mouseout = $settings['onmouseout'];

    // Animation name should include the widget id
    $animation_name = 'asvg-lottie-ani-' . $widget_id;

    // Handle link
    if ( $link ) {
      $this->add_link_attributes( 'link', $link );

      if ( \Elementor\Plugin::$instance->editor->is_edit_mode() ) {
				$this->add_render_attribute( 'link', array(
					'class' => 'elementor-clickable',
        ) );
			}
    }

    // Print the HTML
    if ( $link ) {
      printf( '<a %s style="color: inherit;">', $this->get_render_attribute_string( 'link' ) );
    }

    printf(
      '<div class="asvg-lottie-widget" '
      . 'data-animation-path="%1$s" data-anim-loop="%2$s" data-speed="%3$s" data-direction="%4$s" '
      . 'data-autoplay="%5$s" data-delay="%6$s" '
      . 'data-mouseover="%7$s" data-mouseout="%8$s" '
      . 'data-name="%9$s">'
      . '</div>',
      $data_file_url,     // path to the animation object
      $loop,              // loop (true, false, or number)
      $speed,             // speed (1 is normal speed)
      $direction,         // direction (1 is normal, -1 is reversed)
      $autoplay,          // start playing the animation on page load
      $delay,             // delay in ms (only if autoplay is enabled)
      $mouseover,         // start playing the animation on mouse over
      $mouseout,          // on mouse out we should stop, pause, or reverse
      $animation_name     // animation name to refer to a specific animation
    );

    if ( $link ) {
      echo '</a>, ';
    }
	 if($settings['customize_url'] == 'yes')
		{
		echo'<br><div class="asvg-lottie-widget" align="center" style="padding-left:15%; padding-right:15%; "><a href=https://edit.lottiefiles.com/?src='.esc_url($data_file_url).'><span style="font-size: 14px; cursor:pointer font-family: sans-serif;" >Click here to customize Lottie (in preview window).</a></span><br><br></div>';

		}
  }
}

