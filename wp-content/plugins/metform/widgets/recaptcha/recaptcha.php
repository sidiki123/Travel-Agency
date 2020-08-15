<?php
namespace Elementor;
defined( 'ABSPATH' ) || exit;

Class MetForm_Input_Recaptcha extends Widget_Base{
	use \MetForm\Widgets\Widget_Notice;

    public function get_name() {
		return 'mf-recaptcha';
    }
    
	public function get_title() {
		return esc_html__( 'reCAPTCHA', 'metform' );
    }

	public function show_in_panel() {
        return 'metform-form' == get_post_type();
	}

	public function get_categories() {
		return [ 'metform' ];
	}
	    
	public function get_keywords() {
        return ['metform', 'input', 'captcha', 'recaptcha', 'google'];
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
			'mf_recaptcha_notice_info',
			[
				'label' => esc_html__( 'reCAPTCHA configure: ', 'metform-pro' ),
				'type' => Controls_Manager::RAW_HTML,
				'raw' => \MetForm\Utils\Util::kses( 'Turn on recaptcha from form setting.<br>Then you have to must configure recaptcha site and secret key from MetForm -> Settings <a target="__blank" href="'.get_dashboard_url().'admin.php?page=metform-menu-settings'.'">from here.</a><br><a target="__blank" href="https://help.wpmet.com/docs/form-settings/#2-recaptcha-integration">See Documentation.</a>', 'metform-pro' ),
				'content_classes' => 'mf-input-map-api-notice',
			]
		);

		$this->add_control(
			'mf_recaptcha_class_name',
			[
				'label' => esc_html__( 'Add Extra Class Name : ', 'metform' ),
				'type' => Controls_Manager::TEXT,
			]
		);
		$this->end_controls_section();

        $this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Label', 'metform' ),
				'tab' => Controls_Manager::TAB_STYLE,
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
						'{{WRAPPER}} .mf-error-message' => 'color: {{VALUE}}',
						'.g-recaptcha[aria-invalid="true"] > div:before, .g-recaptcha[aria-invalid="true"] > div:after, .g-recaptcha[aria-invalid="true"] > div > div:before, .g-recaptcha[aria-invalid="true"] > div > div:after' => 'border-color: {{VALUE}}',
					],
				]
			);
		$this->end_controls_section();

		$this->insert_pro_message();
	}

    protected function render($instance = []){
        $settings = $this->get_settings_for_display();
		extract($settings);

		$render_on_editor = false;
		$is_edit_mode = 'metform-form' === get_post_type() && \Elementor\Plugin::$instance->editor->is_edit_mode();
		
		$configData = [
			'message' 		=> $errorMessage 	= isset($mf_input_validation_warning_message) ? !empty($mf_input_validation_warning_message) ? $mf_input_validation_warning_message : __("reCAPTCHA is required.", 'metform') : __("reCAPTCHA is required.", 'metform'),
			'required'		=> true,
		];

		$recaptcha_setting = \MetForm\Core\Admin\Base::instance()->get_settings_option();
		$recaptcha_key_v2 = $recaptcha_setting['mf_recaptcha_site_key'];
		$recaptcha_key_v3 = $recaptcha_setting['mf_recaptcha_site_key_v3'];

		$mf_recaptcha_type = ((isset($recaptcha_setting['mf_recaptcha_version']) && ($recaptcha_setting['mf_recaptcha_version'] != '')) ? $recaptcha_setting['mf_recaptcha_version'] : 'recaptcha-v2');
		?>
		<div class="mf-input-wrapper">
			<?php
				if($mf_recaptcha_type == 'recaptcha-v2') {
					?>

					<div
						class="g-recaptcha <?php echo esc_attr( $mf_recaptcha_class_name ); ?>"
						data-sitekey="<?php echo esc_attr( $recaptcha_key_v2 ); ?>"
						<?php if ( !$is_edit_mode ): ?>
							data-callback="handleReCAPTCHA"
							data-expired-callback="handleReCAPTCHA"
							data-error-callback="handleReCAPTCHA"
							aria-invalid=${validation.errors['g-recaptcha-response'] ? 'true' : 'false'}
						<?php endif; ?>
						></div>

					<?php if ( !$is_edit_mode ): ?>
						<input type="hidden"
							name="g-recaptcha-response"
							value=${parent.getValue('g-recaptcha-response')}
							ref=${el => parent.activateValidation(<?php echo json_encode($configData); ?>, el)}
							/>

						<${validation.ErrorMessage} errors=${validation.errors} name="g-recaptcha-response" as=${html`<span className="mf-error-message"></span>`} />
					<?php else: ?>
						<div class="attr-alert attr-alert-warning" style="display: none; margin-bottom: 0;">
							<?php esc_html_e('reCAPTCHA will be shown on preview.', 'metform'); ?>
						</div>
					<?php endif; ?>

					<?php
					wp_enqueue_script('recaptcha-v2');
				}

				if($mf_recaptcha_type == 'recaptcha-v3'){
					?>
					
					<div id="recaptcha_site_key_v3" class="recaptcha_site_key_v3 <?php echo esc_attr($mf_recaptcha_class_name); ?>">
						<input type="hidden" class="g-recaptcha-response-v3" name="g-recaptcha-response-v3" />
					</div>
					
					<?php
					if(('metform-form' == get_post_type() || 'page' == get_post_type()) && \Elementor\Plugin::$instance->editor->is_edit_mode()){
						echo "<div class='attr-alert attr-alert-warning' style='margin-bottom: 0;'>".esc_html__('reCAPTCHA will be shown on preview.', 'metform')."</div>";
					}
					wp_enqueue_script('recaptcha-v3');
				}
			?>
		</div>

		<?php
    }
    
}
