<?php

if ( ! class_exists('WP_Travel') ) {
    return;
}

/**
 * Sets settings for general fields
 *
 * @since  Travelbiz 1.0.0
 * @param  array $settings
 * @return array Merged array
 */
function Travelbiz_Customizer_Homepage_Settings($settings)
{
    $destinations = get_terms(array(
        'taxonomy'   => 'travel_locations',
        'hide_empty' => true,
    ));
    $count_destinations = !empty($destinations) ? count((array) $destinations) : 4;

    $args = array(
        'taxonomy'   => 'itinerary_types',
        'hide_empty' => false,
    );
    $posts_array = new WP_Term_Query($args);
    $posts_array = $posts_array->get_terms();
    if ( ! empty( $posts_array ) ){
        foreach ($posts_array as $post_array) {
            $term_id = isset($post_array->term_id) && ! empty( $post_array->term_id ) ? $post_array->term_id : '';
            $term_name[$term_id] = isset($post_array->name) && ! empty( $post_array->name ) ? $post_array->name : '';
            
        }
    }

    $homepage = array(
        // Itinerary search section
        'itinerary_search_enable' => array(
            'label'    => esc_html__('Enable Section', 'travelbiz'),
            'description' => esc_html__('Check to enable Itinerary Search section with multiple filters.', 'travelbiz'),
            'section' => 'homepage_itinerary_search_section',
            'type'  => 'checkbox',
            'priority'    => 21,
        ),

        'disbale_search_shape' => array(
            'label'    => esc_html__('Disable Shape', 'travelbiz'),
            'section' => 'homepage_itinerary_search_section',
            'type'  => 'checkbox',
            'priority'    => 22,
        ),


        // Post Filter - Destination Section
        'post_filter_enable' => array(
            'label'    => esc_html__('Enable Section', 'travelbiz'),
            'description' => esc_html__('Check to enable Destination section', 'travelbiz'),
            'section' => 'post_filter_section',
            'type'  => 'checkbox',
            'priority'    => 21,
        ),

        'post_filter_section_title' => array(
            'type' => 'text',
            'label' => esc_html__('Title', 'travelbiz'),
            'section'  => 'post_filter_section',
            'priority'    => 22,
            'active_callback' => function () {
                return travelbiz_get_option('post_filter_enable');
            },
        ),
        'post_filter_number_of_destination' => array(
            'type' => 'number',
            'label' => esc_html__('Number of Destinations', 'travelbiz'),
            'description' => esc_html__('(Tour must be assign to destination for display)', 'travelbiz'),
            'section'  => 'post_filter_section',
            'priority'    => 22,
            'active_callback' => function () {
                return travelbiz_get_option('post_filter_enable');
            },
            'input_attrs' => array(
                'min' => 1,
                'max' => $count_destinations,
                'style' => 'width: 70px;'
            ),
        ),
         'disable_destination_title' => array(
            'label'   => esc_html__( 'Disable Destinations Section Title', 'travelbiz' ),
            'section' => 'post_filter_section',
            'type'    => 'checkbox',
            'priority'    => 23,
             'active_callback' => function () {
                return travelbiz_get_option('post_filter_enable');
            },
        ),
        'disable_destination_divider' => array(
            'label'   => esc_html__( 'Disable Divider', 'travelbiz' ),
            'section' => 'post_filter_section',
            'type'    => 'checkbox',
            'priority'    => 23,
             'active_callback' => function () {
                return travelbiz_get_option('post_filter_enable');
            },
        ),

        // Itinerary Post - Destination Section
        'itinerary_post_enable' => array(
            'label'    => esc_html__('Enable Section', 'travelbiz'),
            'description' => esc_html__('Check to enable Itinerary Post section', 'travelbiz'),
            'section' => 'itinerary_post_section',
            'type'  => 'checkbox',
            'priority'    => 21,

        ),
        'itinerary_post_section_title' => array(
            'type' => 'text',
            'label' => esc_html__('Title', 'travelbiz'),
            'section'  => 'itinerary_post_section',
            'priority'    => 23,
            'active_callback' => function () {
                return travelbiz_get_option('itinerary_post_enable');
            },
        ),
        'itinerary_section_number_of_post' => array(
            'type' => 'number',
            'label' => esc_html__('Number of Itinerary Posts', 'travelbiz'),
            'section'  => 'itinerary_post_section',
            'priority'    => 23,
            'active_callback' => function () {
                return travelbiz_get_option('itinerary_post_enable');
            },
            'input_attrs' => array(
                'min' => 1,
                'max' => 6,
                'style' => 'width: 70px;'
            ),
        ),
         'disable_package_title' => array(
            'label'   => esc_html__( 'Disable Our Packages Section Title', 'travelbiz' ),
            'section' => 'itinerary_post_section',
            'type'    => 'checkbox',
            'priority'    => 23,
             'active_callback' => function () {
                return travelbiz_get_option('itinerary_post_enable');
            },
        ),
        'disable_package_divider' => array(
            'label'   => esc_html__( 'Disable Divider', 'travelbiz' ),
            'section' => 'itinerary_post_section',
            'type'    => 'checkbox',
            'priority'    => 23,
             'active_callback' => function () {
                return travelbiz_get_option('itinerary_post_enable');
            },
        ),

        // Travellers Choice Section
        'travellers_choice_enable' => array(
            'label'    => esc_html__('Enable Section', 'travelbiz'),
            'description' => esc_html__('Check to enable Travellers Choice section', 'travelbiz'),
            'section' => 'traveller_choice_section',
            'type'  => 'checkbox',
            'priority'    => 21,
        ),
        'traveller_choice_section_title' => array(
            'type' => 'text',
            'label' => esc_html__('Title', 'travelbiz'),
            'section'  => 'traveller_choice_section',
            'priority'    => 22,
            'active_callback' => function () {
                return travelbiz_get_option('travellers_choice_enable');
            },
        ),
        'traveller_choice_section_dropdown' => array(
            'type' => 'select',
            'label' => esc_html__('Select Trip Type To Show', 'travelbiz'),
            'section'  => 'traveller_choice_section',
            'priority'    => 22,
            'active_callback' => function () {
                return travelbiz_get_option('travellers_choice_enable');
            },
            'choices' => isset ($term_name) && ! empty($term_name) ? $term_name : '',
        ),
         'disable_traveller_choice_title' => array(
            'label'   => esc_html__( 'Disable Section Title', 'travelbiz' ),
            'section' => 'traveller_choice_section',
            'type'    => 'checkbox',
            'priority'    => 23,
             'active_callback' => function () {
                return travelbiz_get_option('travellers_choice_enable');
            },
        ),
        'disable_traveller_choice_divider' => array(
            'label'   => esc_html__( 'Disable Divider', 'travelbiz' ),
            'section' => 'traveller_choice_section',
            'type'    => 'checkbox',
            'priority'    => 23,
             'active_callback' => function () {
                return travelbiz_get_option('travellers_choice_enable');
            },
        )
    );
    return array_merge($settings, $homepage);
}
add_filter('Travelbiz_Customizer_Fields', 'Travelbiz_Customizer_Homepage_Settings');
