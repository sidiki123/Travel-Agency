<?php
namespace Elementor;
defined( 'ABSPATH' ) || exit;

Class MetForm_Input_Gdpr_Consent extends Widget_Base{

	use \MetForm\Traits\Common_Controls;
	use \MetForm\Traits\Conditional_Controls;
	use \MetForm\Widgets\Widget_Notice;

    public function get_name() {
		return 'mf-gdpr-consent';
    }
    
	public function get_title() {
		return esc_html__( 'GDPR Consent', 'metform' );
	}
	
	public function show_in_panel() {
        return 'metform-form' == get_post_type();
	}

	public function get_categories() {
		return [ 'metform' ];
	}

	public function get_keywords() {
        return ['metform', 'input', 'GDPR', 'gdpr', 'consent'];
	}
	
    protected function _register_controls() {
        
        $this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'metform' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'mf_input_label_status',
			[
				'label' => esc_html__( 'Show Label', 'metform' ),
				'type' => Controls_Manager::SWITCHER,
				'on' => esc_html__( 'Show', 'metform' ),
				'off' => esc_html__( 'Hide', 'metform' ),
				'return_value' => 'yes',
				'default' => 'yes',
				'description' => esc_html__('for adding label on input turn it on. Don\'t want to use label? turn it off.', 'metform'),
			]
		);

		$this->add_control(
			'mf_gdpr_consent_label_display_property',
			[
				'label' => esc_html__( 'Position', 'metform' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'block',
				'options' => [
					'block' => esc_html__( 'Top', 'metform' ),
					'inline-block' => esc_html__( 'Left', 'metform' ),
                ],
                'selectors' => [
					'{{WRAPPER}} .mf-checkbox-label' => 'display: {{VALUE}}; vertical-align: top',
					'{{WRAPPER}} .mf-checkbox' => 'display: inline-block',
				],
				'condition'    => [
                    'mf_input_label_status' => 'yes',
				],
				'description' => esc_html__('Select label position. where you want to see it. top of the input or left of the input.', 'metform'),

			]
		);

        $this->add_control(
			'mf_input_label',
			[
				'label' => esc_html__( 'Input Label : ', 'metform' ),
				'type' => Controls_Manager::TEXT,
				'default' => $this->get_title(),
				'title' => esc_html__( 'Enter here label of input', 'metform' ),
				'condition'    => [
                    'mf_input_label_status' => 'yes',
                ],
			]
		);

		$this->add_control(
			'mf_input_name',
			[
				'label' => esc_html__( 'Name : ', 'metform' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => $this->get_name(),
				'frontend_available'	=> true
			]
		);

		$this->add_control(
			'mf_gdpr_consent_display_option',
			[
				'label' => esc_html__( 'Option Display : ', 'metform' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => [
					'inline-block'  => esc_html__( 'Horizontal', 'metform' ),
					'block' => esc_html__( 'Vertical', 'metform' ),
                ],
                'default' => 'inline-block',
                'selectors' => [
                    '{{WRAPPER}} .mf-checkbox-option' => 'display: {{VALUE}};',
				],
				'description' => esc_html__('Checkbox option display style. ', 'metform'),
			]
        );

        $this->add_control(
			'mf_gdpr_consent_option_text_position',
			[
				'label' => esc_html__( 'Option Text Position : ', 'metform' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'after'  => esc_html__( 'After Checkbox', 'metform' ),
					'before' => esc_html__( 'Before Checkbox', 'metform' ),
                ],
				'default' => 'after',
				'description' => esc_html__('Where do you want to label?', 'metform'),
			]
        );

        $this->add_control(
            'mf_gdpr_consent_option_text', [
                'label' => esc_html__( 'Checkbox Option Text', 'metform' ),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => \MetForm\Utils\Util::kses( 'Agree on our <a href="#">terms and condition</a> for using your submitted data?' , 'metform' ),
				'label_block' => true,
				'description' => esc_html__('Select option name that will be show to user.', 'metform'),
            ]
        );
		
		$this->add_control(
			'mf_input_help_text',
			[
				'label' => esc_html__( 'Help Text : ', 'metform' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 3,
				'placeholder' => esc_html__( 'Type your help text here', 'metform' ),
			]
		);

        $this->end_controls_section();

		if(class_exists('\MetForm_Pro\Base\Package')){
			$this->input_conditional_control();
		}

        $this->start_controls_section(
			'label_section',
			[
				'label' => esc_html__( 'Input Label', 'metform' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition'    => [
					'mf_input_label_status' => 'yes',
				],
			]
		);

		$this->add_control(
			'mf_gdpr_consent__label_color',
			[
                'label' => esc_html__( 'Color', 'metform' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .mf-checkbox-label, {{WRAPPER}} .mf-checkbox-option input[type="checkbox"] + span:before' => 'color: {{VALUE}}',
				],
				'default' => '#000000',
				'condition'    => [
                    'mf_input_label_status' => 'yes',
                ],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'mf_gdpr_consent__label_typography',
				'label' => esc_html__( 'Typography', 'metform' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .mf-checkbox-label',
				'condition'    => [
                    'mf_input_label_status' => 'yes',
                ],
			]
		);
		$this->add_responsive_control(
			'mf_gdpr_consent__label_padding',
			[
				'label' => esc_html__( 'Padding', 'metform' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .mf-checkbox-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'    => [
                    'mf_input_label_status' => 'yes',
                ],
			]
		);
		$this->add_responsive_control(
			'mf_gdpr_consent__label_margin',
			[
				'label' => esc_html__( 'Margin', 'metform' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .mf-checkbox-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'    => [
                    'mf_input_label_status' => 'yes',
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'mf_gdpr_consent__label_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'metform' ),
				'selector' => '{{WRAPPER}} .mf-checkbox-label',
				'condition'    => [
                    'mf_input_label_status' => 'yes',
                ],
			]
		);

		$this->add_control(
			'mf_input_required_indicator_color',
			[
				'label' => esc_html__( 'Required Indicator Color:', 'metform' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'default' => '#f00',
				'selectors' => [
					'{{WRAPPER}} .mf-input-required-indicator, {{WRAPPER}} .mf-error-message' => 'color: {{VALUE}}',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'gdpr_consentoption_section',
            [
                'label' => esc_html__('Checkbox', 'metform'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
			'mf_gdpr_consent_option_padding',
			[
				'label' => esc_html__( 'Padding', 'metform' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .mf-checkbox-option' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_responsive_control(
			'mf_gdpr_consent_option_margin',
			[
				'label' => esc_html__( 'Margin', 'metform' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .mf-checkbox-option' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'mf_gdpr_consent_option_color',
			[
				'label' => esc_html__( 'Text Color', 'metform' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .mf-checkbox-option' => 'color: {{VALUE}}',
					'{{WRAPPER}} .mf-checkbox-option input[type="checkbox"] + span:before' => 'color: {{VALUE}}',
				],
				'default' => '#000000',
			]
		);

		$this->start_controls_tabs('mf_gdpr_consent_option_icon_color_control');

		$this->start_controls_tab(
			'mf_gdpr_consent_option_icon_color_tabnormal',
			[
				'label' => esc_html__( 'Normal', 'metform' ),
			]
		);

		$this->add_control(
			'mf_gdpr_consent_option_icon_color',
			[
				'label' => esc_html__( 'Checkbox Color', 'metform' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .mf-checkbox-option input[type="checkbox"] + span:before' => 'color: {{VALUE}}'
				],
				'default' => '#747474',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'mf_gdpr_consent_option_icon_color_tabchecked',
			[
				'label' => esc_html__( 'Checked', 'metform' ),
			]
		);

		$this->add_control(
			'mf_gdpr_consent_option_icon_color_checked',
			[
				'label' => esc_html__( 'Checkbox Color', 'metform' ),
				'type' => Controls_Manager::COLOR,
				'scheme' => [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				],
				'selectors' => [
					'{{WRAPPER}} .mf-checkbox-option input[type="checkbox"]:checked + span:before' => 'color: {{VALUE}}'
				],
				'default' => '#4285F4',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'mf_input_option_icon_horizontal_position',
			[
				'label' => esc_html__( 'Horizontal position of icon', 'metform' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => -50,
						'max' => 50,
						'step' => 1,
					],
				],
				'default' => [
                    'unit' => 'px',
                    'size' => 2,
                ],
				'selectors' => [
					'{{WRAPPER}} .mf-checkbox-option input[type="checkbox"] + span:before' => 'top: {{SIZE}}{{UNIT}}',
				]
			]
		);

		$this->add_control(
			'mf_gdpr_consent_option_space_after_icon',
			[
				'label' => esc_html__( 'Add space after checkbox', 'metform' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
                    'unit' => 'px',
                    'size' => 25,
                ],
				'selectors' => [
					'{{WRAPPER}} .mf-checkbox-option input[type="checkbox"] + span:before' => 'width: {{SIZE}}{{UNIT}}',
				]
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'mf_gdpr_consent_typgraphy',
				'label' => esc_html__( 'Typography for icon', 'metform' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'exclude' => [ 'font_family', 'text_transform', 'font_style', 'text_decoration', 'letter_spacing' ],
				'selector' => '{{WRAPPER}} .mf-checkbox, {{WRAPPER}} .mf-checkbox-option input[type="checkbox"] + span:before',
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'mf_gdpr_consent_typgraphy_text',
				'label' => esc_html__( 'Typography for text', 'metform' ),
				'scheme' => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .mf-checkbox, {{WRAPPER}} .mf-checkbox-option input[type="checkbox"] + span',
			]
        );

        $this->end_controls_section();
		
        $this->start_controls_section(
			'help_text_section',
			[
				'label' => esc_html__( 'Help Text', 'metform' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'mf_input_help_text!' => ''
				]
			]
		);
		
		$this->input_help_text_controls();

        $this->end_controls_section();

        $this->insert_pro_message();
	}

    protected function render($instance = []){
		$settings = $this->get_settings_for_display();
        extract($settings);

		$render_on_editor = false;
		$is_edit_mode = 'metform-form' === get_post_type() && \Elementor\Plugin::$instance->editor->is_edit_mode();

		$class = (isset($settings['mf_conditional_logic_form_list']) ? 'mf-conditional-input' : '');

		$configData = [
			'message' 		=> $errorMessage 	= isset($mf_input_validation_warning_message) ? !empty($mf_input_validation_warning_message) ? $mf_input_validation_warning_message : esc_html__('This field is required.', 'metform') : esc_html__('This field is required.', 'metform'),
			'required'		=> true,
		];
		?>

		<div class="mf-input-wrapper">
			<?php if ( 'yes' == $mf_input_label_status ): ?>
				<label class="mf-input-label" for="mf-input-gdpr-<?php echo esc_attr( $this->get_id() ); ?>">
					<?php echo \MetForm\Utils\Util::react_entity_support( esc_html($mf_input_label), $render_on_editor ); ?>
					<span class="mf-input-required-indicator"><?php echo esc_html( '*', 'metform' );?></span>
				</label>
			<?php endif; ?>

			<div class="mf-checkbox" id="mf-input-gdpr-<?php echo esc_attr($this->get_id()); ?>">
				<div class="mf-checkbox-option">
					<label>
						<?php
							if ( $mf_gdpr_consent_option_text_position == 'before' ):
								echo str_replace('`', '\`', \MetForm\Utils\Util::kses( $mf_gdpr_consent_option_text ));
							endif;
						?>
						<input
							type="checkbox"
							class="mf-input mf-checkbox-input <?php echo $class; ?>"
							name="<?php echo esc_attr($mf_input_name); ?>"
							<?php if ( !$is_edit_mode ): ?>
								onInput=${ parent.handleOptin }
								aria-invalid=${validation.errors['<?php echo esc_attr($mf_input_name); ?>'] ? 'true' : 'false'}
								ref=${ el => parent.activateValidation(<?php echo json_encode($configData); ?>, el) }
							<?php endif; ?>
							/>
						<span>
							<?php
								if ( $mf_gdpr_consent_option_text_position == 'after' ):
									echo str_replace('`', '\`', \MetForm\Utils\Util::kses( $mf_gdpr_consent_option_text ));
								endif;
							?>
						</span>
					</label>
				</div>
			</div>

			<?php if ( !$is_edit_mode ): ?>
				<${validation.ErrorMessage}
					errors=${validation.errors}
					name="<?php echo esc_attr( $mf_input_name ); ?>"
					as=${html`<span className="mf-error-message"></span>`}
					/>
			<?php endif; ?>

			<?php echo '' != $mf_input_help_text ? '<span class="mf-input-help">'. \MetForm\Utils\Util::react_entity_support( esc_html($mf_input_help_text), $render_on_editor ) .'</span>' : ''; ?>
		</div>

		<?php
    }
    
}
