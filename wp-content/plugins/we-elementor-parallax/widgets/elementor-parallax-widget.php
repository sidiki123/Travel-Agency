
<?php
/**
 * Elementor Bttn Widget.
 *
 * Elementor widget that inserts a button.
 *
 * @since 1.0.0
 */
if(!defined('ABSPATH')) exit;
class ElementorMultiLayerParallaxWidget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'multi-layer-parallax';
	}

	public function get_title() {
		return __('Multi Layer Parallax', 'elementor-parallax');
	}

	public function get_icon() {
		return 'eicon-navigator';
	}

	public function get_categories() {
		return ['general'];
	}

	protected function _register_controls() {
		$is_pro = apply_filters('elementor_parallax_is_pro', false);

		$this->start_controls_section(
			'content_section',
			[
				'label' => __('General', 'elementor-parallax'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'wrapper_height',
			[
				'label' => __('Wrapper height', 'elementor-parallax'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', 'vh'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'vh' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 400,
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-parallax' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title',
			[
				'label' => __('Title', 'elementor-parallax'),
				'default' => __('Title', 'elementor-parallax'),
				'placeholder' => __('Title', 'elementor-parallax'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		do_action('elementor_parallax_after_title', $repeater);

		$repeater->add_control(
			'ratio',
			[
				'label' => __('Parallax Ratio', 'elementor-parallax'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'range' => [
					'px' => [
						'min' => -0.5,
						'max' => 1.5,
						'step' => 0.1,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 0.5,
				]
			]
		);

		$repeater->add_control( //Image
			'image',
			[
				'label' => __('Choose Image', 'elementor-parallax'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-parallax {{CURRENT_ITEM}}' => 'background-image: url("{{URL}}");',
				],
			]
		);

		do_action('elementor_parallax_repeater_end', $repeater);

		$this->add_control(
			'layers',
			[
				'label' => __('Layers', 'elementor-parallax'),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'title' => __('Layer #1', 'elementor-parallax')
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();


		if($is_pro != true) {
			$this->start_controls_section(
				'pro_section',
				[
					'label' => __('More options', 'elementor-parallax'),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);

			$pro_notice = apply_filters('elementor_parallax_pro_notice', '');
			$this->add_control(
				'pro_notice',
				[
					'label' => __('', 'elementor-parallax'),
					'type' => \Elementor\Controls_Manager::RAW_HTML,
					'raw' => __($pro_notice, 'elementor-parallax'),
					'content_classes' => 'elementor_parallax_pro_notice',
				]
			);

			$this->end_controls_section();
		}

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		echo '<div class="elementor-parallax">';
			foreach ($settings['layers'] as $layer) {
				$layer_attributes = 'data-enllax-ratio="'.$layer['ratio']['size'].'"';
				$layer_attributes = apply_filters('elementor_parallax_layer_attributes', $layer_attributes, $layer);
				echo '<div class="elementor-repeater-item-'.$layer['_id'].' layer" '.$layer_attributes.'></div>';
			}
			do_action('elementor_parallax_wrapper_end');
		echo "</div>";
	}

}