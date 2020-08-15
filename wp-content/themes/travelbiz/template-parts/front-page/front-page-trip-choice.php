<?php

if ( ! class_exists('WP_Travel') ) {
    return;
}

/**
 * Template part for displaying blog items
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @since Travelbiz 1.0.0
 */
?>
<!-- Travellers Choice -->
<?php
if (travelbiz_get_option('travellers_choice_enable')) : ?>
    <?php
        $traveller_choice_section_title = wp_kses_post(travelbiz_get_option('traveller_choice_section_title'));
        $selected_term_id = travelbiz_get_option('traveller_choice_section_dropdown');

        $custom_terms = get_terms('itinerary_types');
        $terms = wp_get_post_terms($post->ID, 'travel_locations');
        if (!empty($custom_terms)) {
            foreach ($custom_terms as $custom_term) {
                $term_id = $custom_term->term_id;
                $args = array(
                    'post_type'        => 'itineraries',
                    'posts_per_page'   => travelbiz_get_option('itinerary_section_number_of_post'),
                    'post_status'      => 'publish',
                    'tax_query'           => array(
                        array(
                            'taxonomy' => 'itinerary_types',
                            'field' => 'term_taxonomy_id',
                            'terms' => $selected_term_id,
                        ),
                    ),
                );
            }
        }
        ?>
    <section class="section-trip-choice">
        <div class="container">
            <?php if(!travelbiz_get_option('disable_traveller_choice_title') || !travelbiz_get_option('disable_traveller_choice_divider')): ?>
                <div class="section-title-group">
                    <?php if( !travelbiz_get_option('disable_traveller_choice_title') ): ?>
                        <div class="title-wrap">
                            <h2 class="section-title"><?php echo esc_html($traveller_choice_section_title); ?></h2>
                        </div>
                    <?php endif; 

                    if( !travelbiz_get_option('disable_traveller_choice_divider') ): ?>
                        <div class="divider"></div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <div class="trip-content-inner">
                    <?php
                        $thumbnail_url = plugins_url( '/wp-travel/assets/images/wp-travel-placeholder.png' );
                        $posts_array = new WP_Query($args);
                        if ($posts_array->have_posts()) {
                            $posts_array->the_post();
                                $destinations     = ! empty( get_the_ID() ) ? wp_get_post_terms( get_the_ID(), 'travel_locations' ) : '';
                                $destination_ID   = isset( $destinations[0] ) && ! empty( $destinations[0]->term_id ) ? $destinations[0]->term_id : '';
                                $destination_name = isset( $destinations[0] ) && ! empty($destinations[0]->name) ? $destinations[0]->name : '';
                                $destination_link = isset( $destinations[0] ) && ! empty( $destination_ID ) ? get_term_link( $destination_ID ) : '';
                                if ( ! empty( $destination_link ) ) {
                                    ?>
                                        <div data-destination-name="<?php echo esc_attr($destination_name); ?>" class="trip-inner-item" id="destination-<?php echo esc_attr($destination_ID); ?>">
                                            <div class="row align-items-center">
                                                <div class="col-md-7 order-1">
                                                    <figure class="featured-img">
                                                        <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt="<?php echo $destination_name; ?>" onerror=this.src="<?php echo $thumbnail_url; ?>">
                                                    </figure>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="trip-content">
                                                        <h3 class="entry-title"><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
                                                        <div class="entry-meta-cat">
                                                            <a href="<?php echo esc_url( $destination_link ); ?>"><?php echo esc_html($destination_name); ?></a>
                                                        </div>
                                                        <div class="content-text">
                                                            <p>
                                                                <?php the_excerpt(); ?>
                                                            </p>
                                                        </div>
                                                        <div class="button-wrap">
                                                            <a href="<?php echo get_permalink(); ?>" class="button-text"><?php echo esc_html_e('View Details', 'travelbiz'); ?></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                }
                        }
                        wp_reset_postdata();
                    ?>
            </div>
        </div>
    </section>
<?php endif; ?>
<!-- Travellers Choice -->