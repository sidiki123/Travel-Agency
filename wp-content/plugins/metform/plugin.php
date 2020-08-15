<?php
namespace MetForm;
defined( 'ABSPATH' ) || exit;

final class Plugin{

    private static $instance;

    private $entries;
    private $global_settings;

    public function __construct(){
        Autoloader::run();
    }
    
    public function version(){
        return '1.3.2';
    }

    public function package_type(){
        return 'free';
    }

    public function plugin_url(){
        return trailingslashit(plugin_dir_url( __FILE__ ));
    }

    public function plugin_dir(){
        return trailingslashit(plugin_dir_path( __FILE__ ));
    }

    public function core_url(){
        return $this->plugin_url() . 'core/';
    }

    public function core_dir(){
        return $this->plugin_dir() . 'core/';
    }

    public function base_url(){
        return $this->plugin_url() . 'base/';
    }

    public function base_dir(){
        return $this->plugin_dir() . 'base/';
    }

    public function utils_url(){
        return $this->plugin_url() . 'utils/';
    }

    public function utils_dir(){
        return $this->plugin_dir() . 'utils/';
    }

    public function widgets_url(){
        return $this->plugin_url() . 'widgets/';
    }

    public function widgets_dir(){
        return $this->plugin_dir() . 'widgets/';
    }

    public function public_url(){
        return $this->plugin_url() . 'public/';
    }

    public function public_dir(){
        return $this->plugin_dir() . 'public/';
    }
    
	public function i18n() {
		load_plugin_textdomain( 'metform', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
    }
    
    public function init(){

        new Utils\Notice();

        // Check if Elementor installed and activated.
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'missing_elementor' ) );
			return;
		}
		// Check for required Elementor version.
		if ( ! version_compare( ELEMENTOR_VERSION, '2.6.0', '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'failed_elementor_version' ) );
			return;
        }

        // pro available notice 
        if( !file_exists( WP_PLUGIN_DIR . '/metform-pro/metform-pro.php' ) ){
            add_action( 'admin_notices', [ $this, 'available_metform_pro'] );
        }
        
        if(current_user_can('manage_options')){
            add_action( 'admin_menu',[$this,'admin_menu']);
        }

        add_action( 'elementor/editor/before_enqueue_scripts', [$this, 'edit_view_scripts'] );

        add_action( 'init', array( $this, 'i18n' ) );
        
        add_action('admin_enqueue_scripts', [$this,'js_css_admin']);
        add_action('wp_enqueue_scripts', [$this,'js_css_public']);
        add_action( 'elementor/frontend/before_enqueue_scripts', [$this, 'elementor_js'] );

        add_action( 'elementor/editor/before_enqueue_styles', [ $this, 'elementor_css' ] );

        add_action('admin_footer', [$this, 'footer_data']);
        
        Core\Forms\Base::instance()->init();
        Controls\Base::instance()->init();
        $this->entries = Core\Entries\Base::instance();

        Widgets\Manifest::instance()->init();

        // Add banner class
        include $this->utils_dir() . 'banner.php';

        // settings page
        Core\Admin\Base::instance()->init();

        add_action('admin_notices', function(){
            \WpMet_Banner::run();
        });
    }

    function js_css_public(){
        $is_edit_mode = 'metform-form' === get_post_type() && \Elementor\Plugin::$instance->preview->is_preview_mode();

        wp_enqueue_style('metform-ui', $this->public_url().'assets/css/metform-ui.css', false, $this->version());
        wp_enqueue_style('metform-style', $this->public_url().'assets/css/style.css', false, $this->version());
        
        wp_register_style('asRange', $this->public_url().'assets/css/asRange.min.css', false, $this->version());
        wp_register_script('asRange', $this->public_url().'assets/js/jquery-asRange.min.js', array(), $this->version(), true);

        wp_register_style('mf-select2', $this->public_url().'assets/css/select2.min.css', false, $this->version());
        wp_register_script('mf-select2', $this->public_url().'assets/js/select2.min.js', array(), $this->version(), true);

        wp_register_script('recaptcha-v2', 'https://google.com/recaptcha/api.js', array(), null, true);

        $this->global_settings = \MetForm\Core\Admin\Base::instance()->get_settings_option();

        if(isset($this->global_settings['mf_recaptcha_version']) && ( $this->global_settings['mf_recaptcha_version'] == 'recaptcha-v3' ) && isset($this->global_settings['mf_recaptcha_site_key_v3']) && ( $this->global_settings['mf_recaptcha_site_key_v3'] != '' ) ){
            wp_register_script('recaptcha-v3', 'https://www.google.com/recaptcha/api.js?render='. $this->global_settings['mf_recaptcha_site_key_v3'], array(), $this->version(), false);
        }

        if(isset($this->global_settings['mf_google_map_api_key']) && ( $this->global_settings['mf_google_map_api_key'] != '' ) ){
            wp_register_script( 'maps-api', 'https://maps.googleapis.com/maps/api/js?key='.$this->global_settings['mf_google_map_api_key'].'&libraries=places&&callback=mfMapLocation', array(), '', true );
        }

        wp_deregister_style('flatpickr'); // flatpickr stylesheet
        wp_register_style('flatpickr', $this->public_url().'assets/css/flatpickr.min.css', false, $this->version()); // flatpickr stylesheet
        
        wp_enqueue_script('htm', $this->public_url().'assets/js/htm.js', null, $this->version(), true);

        wp_enqueue_script('metform-app', $this->public_url().'assets/js/app.js', array('htm', 'jquery'), $this->version(), true);
        wp_localize_script('metform-app', 'mf', array(
            'postType' => get_post_type(),
            'restURI' => get_rest_url( null, 'metform/v1/forms/views/')
        ));
        
        do_action('metform/onload/enqueue_scripts');
    }

    public function edit_view_scripts(){
        wp_enqueue_style('metform-ui', $this->public_url().'assets/css/metform-ui.css', false, $this->version());
        wp_enqueue_style('metform-admin-style', $this->public_url().'assets/css/admin-style.css', false, null);
       
        
        wp_enqueue_script('metform-ui', $this->public_url().'assets/js/ui.min.js', array(), $this->version(), true);
        wp_enqueue_script('metform-admin-script', $this->public_url().'assets/js/admin-script.js', array(), null, true);

        wp_add_inline_script('metform-admin-script', "
            var metform_api = {
                resturl: '". get_rest_url() ."'
            }
        ");
    }

    public function elementor_js() {
    }

    public function elementor_css(){
        if('metform-form' == get_post_type()){
            wp_enqueue_style('metform-category-top', $this->public_url().'assets/css/category-top.css', false, $this->version());
        }
    }

    function js_css_admin(){

        $screen = get_current_screen();
        
        if(in_array($screen->id, ['edit-metform-form','metform_page_mt-form-settings', 'metform-entry', 'metform_page_metform-menu-settings'])){
            wp_enqueue_style('metform-admin-fonts', $this->public_url().'assets/admin-fonts.css', false, $this->version());
            wp_enqueue_style('metform-ui', $this->public_url().'assets/css/metform-ui.css', false, $this->version());
            wp_enqueue_style('metform-admin-style', $this->public_url().'assets/css/admin-style.css', false, null);
            
            wp_enqueue_script('metform-ui', $this->public_url().'assets/js/ui.min.js', array(), $this->version(), true);
            wp_enqueue_script('metform-admin-script', $this->public_url().'assets/js/admin-script.js', array(), null, true);
            wp_localize_script('metform-admin-script', 'metform_api', array('resturl' => get_rest_url(), 'admin_url' => get_admin_url()));
        }
        
        if($screen->id == 'edit-metform-entry' || $screen->id == 'metform-entry'){
            wp_enqueue_style('metform-ui', $this->public_url().'assets/css/metform-ui.css', false, $this->version());
            wp_enqueue_script('metform-entry-script', $this->public_url().'assets/js/admin-entry-script.js', array(), $this->version(), true);
        }
    
    }

    public function footer_data(){
        
        $screen = get_current_screen();

        if($screen->id == 'edit-metform-entry'){
            $args = array(
                'post_type'   => 'metform-form',
                'post_status' => 'publish',
            );
            
            $forms = get_posts( $args );

            $get_form_id = isset($_GET['form_id']) ? sanitize_key($_GET['form_id']) : '';
            ?>
            <div id='metform-formlist' style='display:none;'><select name='form_id' id='metform-form_id'>
            <option value='all' <?php echo esc_attr(((($get_form_id == 'all') || ($get_form_id == '')) ? 'selected=selected' : '')); ?>>All</option>
            <?php

            foreach($forms as $form){
                $form_list[$form->ID] = $form->post_title;
            ?>
            <option value="<?php echo esc_attr($form->ID); ?>" <?php echo esc_attr(($get_form_id == $form->ID) ? 'selected=selected' : ''); ?> ><?php echo esc_html($form->post_title); ?></option>
            <?php
            }
            echo "</select></div>";
        }
    }

    function admin_menu() {
        add_menu_page(
            esc_html__('MetForm'),
            esc_html__('MetForm'),
            'read',
            'metform-menu',
            '',
            'dashicons-feedback',
            5
        );
    }

	public function missing_elementor() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		if ( file_exists( WP_PLUGIN_DIR . '/elementor/elementor.php' ) ) {
			$btn['label'] = esc_html__('Activate Elementor', 'metform');
			$btn['url'] = wp_nonce_url( 'plugins.php?action=activate&plugin=elementor/elementor.php&plugin_status=all&paged=1', 'activate-plugin_elementor/elementor.php' );
		} else {
			$btn['label'] = esc_html__('Install Elementor', 'metform');
			$btn['url'] = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
		}

		Utils\Notice::push(
			[
				'id'          => 'unsupported-elementor-version',
				'type'        => 'error',
				'dismissible' => true,
				'btn'		  => $btn,
				'message'     => sprintf( esc_html__( 'MetForm requires Elementor version %1$s+, which is currently NOT RUNNING.', 'metform' ), '2.6.0' ),
			]
		);
    }

    public function available_metform_pro() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$btn['label'] = esc_html__('MetForm Pro', 'metform');
		$btn['url'] = esc_url( 'https://products.wpmet.com/metform/');

		Utils\Notice::push(
			[
                'id'          => 'unsupported-metform-pro-version',
				'type'        => 'success',
				'dismissible' => true,
				'btn'		  => $btn,
				'message'     => sprintf( esc_html__( 'We have MetForm Pro version. Check out our pro feature.', 'metform' ), '2.6.0' ),
			]
		);
    }

    public function failed_elementor_version(){
        
        $btn['label'] = esc_html__('Update Elementor', 'metform');
        $btn['url'] = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=elementor' ), 'upgrade-plugin_elementor' );
        
        Utils\Notice::push(
			[
				'id'          => 'unsupported-elementor-version',
				'type'        => 'error',
				'dismissible' => true,
				'btn'		  => $btn,
				'message'     => sprintf( esc_html__( 'MetForm requires Elementor version %1$s+, which is currently NOT RUNNING.', 'metform' ), '2.6.0' ),
			]
		);
    }
    
	public function flush_rewrites(){
        $form_cpt = new Core\Forms\Cpt();
        $form_cpt->flush_rewrites();
	}

    public static function instance(){
        if (!self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }

}
