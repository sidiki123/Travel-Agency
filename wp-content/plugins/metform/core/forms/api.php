<?php

namespace MetForm\Core\Forms;

use MetForm\Core\Entries\Map_El;

defined('ABSPATH') || exit;

class Api extends \MetForm\Base\Api
{

    public function config()
    {
        $this->prefix = 'forms';
        $this->param = "/(?P<id>\w+)";
    }

    public function post_update()
    {
        $form_id = $this->request['id'];

        $form_setting = $this->request->get_params();


        /**
         * Hubspot form settings save
         */

        if (class_exists('\MetForm_Pro\Core\Integrations\Crm\Hubspot\Hubspot')) {


            if(isset($form_setting['mf_hubspot_form_guid'])){
                $fields = [];

                // return $form_setting['mf_hubspot_form_field_name_firstname'];
                foreach ($form_setting as $key => $value) {
                    // if ($key == 'mf_hubspot_form_field_name_firstname') {
                    //     return $value;
                    // }
    
                    if (strpos($key, 'mf_hubspot_form_field_name_') !== false) {
                        array_push($fields, [$key => $value]);
                    }
                }
    
                update_option('mf_hubspot_form_guid_' . $form_id, $form_setting['mf_hubspot_form_guid']);
                update_option('mf_hubspot_form_portalId_' . $form_id, $form_setting['mf_hubspot_form_portalId']);
                update_option('mf_hubspot_form_data_' . $form_id, $fields);
            }

            

        }

        /**
         * Auth / Registration settings save
         */


        if(class_exists('\MetForm_Pro\Core\Integrations\Auth\Register\Register')){

            if(isset($form_setting['mf_auth_reg_user_name'])){

                $data = [

                    'mf_auth_reg_user_name' => $form_setting['mf_auth_reg_user_name'],
                    'mf_auth_reg_user_email' => $form_setting['mf_auth_reg_user_email'],
                    'mf_auth_reg_role' => $form_setting['mf_auth_reg_role']
    
                ];
    
                update_option('mf_auth_reg_settings_'.$form_id , $data);
            }

            

        }

        if(class_exists('\MetForm_Pro\Core\Integrations\Auth\Login\Login')){


            if(isset($form_setting['mf_auth_login_user_name'])){
                $data = [

                    'mf_auth_login_user_name' => $form_setting['mf_auth_login_user_name'],
                    'mf_auth_login_user_password' => $form_setting['mf_auth_login_user_password']
    
                ];
    
                update_option('mf_auth_login_settings_'.$form_id , $data);
            }

            

        }





        return Action::instance()->store($form_id, $form_setting);
    }

    public function get_get()
    {
        $form_id = $this->request['id'];

        return Action::instance()->get_all_data($form_id);
    }

    public function get_builder()
    {
        $form_id = $this->request['id'];
        return Builder::instance()->get_editor($form_id);
    }

    public function get_form_content(){
        $form_id = $this->request['id'];
        return Builder::instance()->get_form_content($form_id);
    }

    public function get_builder_form_id(){
        $title = $this->request['title'];
        $template_id = $this->request['id'];
        return Builder::instance()->create_form($title, $template_id);
    }

    public function get_templates()
    {
        $form_id = $this->request['id'];
        $args = array(
            'post_type' => Base::instance()->form->get_name(),
            'post_status' => 'publish',
            'posts_per_page' => -1,
        );

        $forms = get_posts($args);

        foreach ($forms as $form) {
            echo '<option value="' . $form->ID . '" ' . selected($form_id, $form->ID, false) . '>' . $form->post_title . '</option>';
        }

        exit();
    }

    public function post_views()
    {
        $form_id = $this->request['id'];
        return Action::instance()->count_views($form_id);
    }

    /**
     * Store hubspot forms
     */

    public function get_hubspot_forms()
    {

        $form_id = $this->request['id'];

        $key = 'hubsopt_forms_' . $form_id . '_';

        $data = \MetForm\Core\Forms\Action::instance()->get_all_data($form_id);

        $token = $data['mf_hubsopt_token'];

        $forms = json_decode(file_get_contents('https://api.hubapi.com/forms/v2/forms?hapikey=' . $token));

        $save_forms = [];
        foreach ($forms as $form) {
            array_push($save_forms, [
                'portalId' => $form->portalId,
                'guid' => $form->guid,
                'name' => $form->name,
            ]);
        }

        update_option('mf_hubspot_saved_forms', $save_forms);

        update_option($key, $forms);
        return get_option($key);
    }

    public function get_get_hubspot_forms()
    {
        $key = $form_id = $this->request['id'];

        $key = 'hubsopt_forms_' . $form_id . '_';

        return get_option($key);
    }

    public function post_hubspot_form_fields()
    {
        $form_id = $this->request['id'];

        $form_guid = $this->request['guid'];

        $data = \MetForm\Core\Forms\Action::instance()->get_all_data($form_id);

        $token = $data['mf_hubsopt_token'];

        $fields = json_decode(file_get_contents('https://api.hubapi.com/forms/v2/fields/' . $form_guid . '?hapikey=' . $token));
        return $fields;

    }

    public function get_get_fields_data()
    {

        $form_id = $this->request['id'];
        $input_widgets = \Metform\Widgets\Manifest::instance()->get_input_widgets();

        $widget_input_data = get_post_meta($form_id, '_elementor_data', true);
        $widget_input_data = json_decode($widget_input_data);

        return Map_El::data($widget_input_data, $input_widgets)->get_el();
    }

}
