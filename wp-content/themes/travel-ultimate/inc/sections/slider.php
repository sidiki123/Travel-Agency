<?php
/**
 * Slider section
 *
 * This is the template for the content of slider section
 *
 * @package Theme Palace
 * @subpackage Travel Ultimate
 * @since Travel Ultimate 1.0.0
 */
if ( ! function_exists( 'travel_ultimate_add_slider_section' ) ) :
    /**
    * Add slider section
    *
    *@since Travel Ultimate 1.0.0
    */
    function travel_ultimate_add_slider_section() {
    	$options = travel_ultimate_get_theme_options();
        // Check if slider is enabled on frontpage
        $slider_enable = apply_filters( 'travel_ultimate_section_status', true, 'slider_section_enable' );

        if ( true !== $slider_enable ) {
            return false;
        }
        // Get slider section details
        $section_details = array();
        $section_details = apply_filters( 'travel_ultimate_filter_slider_section_details', $section_details );

        if ( empty( $section_details ) ) {
            return;
        }

        // Render slider section now.
        travel_ultimate_render_slider_section( $section_details );
    }
endif;

if ( ! function_exists( 'travel_ultimate_get_slider_section_details' ) ) :
    /**
    * slider section details.
    *
    * @since Travel Ultimate 1.0.0
    * @param array $input slider section details.
    */
    function travel_ultimate_get_slider_section_details( $input ) {
        $options = travel_ultimate_get_theme_options();

        // Content type.
        $slider_content_type  = $options['slider_content_type'];
        
        $content = array();
        switch ( $slider_content_type ) {
        	
            case 'page':
                $page_ids = array();

                for ( $i = 1; $i <= 3; $i++ ) {
                    if ( ! empty( $options['slider_content_page_' . $i] ) )
                        $page_ids[] = $options['slider_content_page_' . $i];
                }
                
                $args = array(
                    'post_type'         => 'page',
                    'post__in'          => ( array ) $page_ids,
                    'posts_per_page'    => 3,
                    'orderby'           => 'post__in',
                    );                    
            break;

            case 'trip':
                $trip_ids = array();

                for ( $i = 1; $i <= 3; $i++ ) {
                    if ( ! empty( $options['slider_content_trip_' . $i] ) )
                        $trip_ids[] = $options['slider_content_trip_' . $i];
                }
                
                $args = array(
                    'post_type'         => 'itineraries',
                    'post__in'          => ( array ) $trip_ids,
                    'posts_per_page'    => 3,
                    'orderby'           => 'post__in',
                    'ignore_sticky_posts'   => true,
                    );                    
            break;

            default:
            break;
        }


            // Run The Loop.
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) : 
                while ( $query->have_posts() ) : $query->the_post();
                    $page_post['id']        = get_the_id();
                    $page_post['title']     = get_the_title();
                    $page_post['url']       = get_the_permalink();
                    $page_post['image']  	= has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'full' ) : '';

                    // Push to the main array.
                    array_push( $content, $page_post );
                endwhile;
            endif;
            wp_reset_postdata();

            
        if ( ! empty( $content ) ) {
            $input = $content;
        }
        return $input;
    }
endif;
// slider section content details.
add_filter( 'travel_ultimate_filter_slider_section_details', 'travel_ultimate_get_slider_section_details' );


if ( ! function_exists( 'travel_ultimate_render_slider_section' ) ) :
  /**
   * Start slider section
   *
   * @return string slider content
   * @since Travel Ultimate 1.0.0
   *
   */
   function travel_ultimate_render_slider_section( $content_details = array() ) {
        $options = travel_ultimate_get_theme_options();

        if ( empty( $content_details ) ) {
            return;
        } 

        ?>
            <div id="featured-slider" data-slick='{"slidesToShow": 1, "slidesToScroll": 1, "infinite": true, "speed": 1000, "dots": true, "arrows":true, "autoplay": true, "draggable": true, "fade": true }'>
                <?php 
                $i = 1;
                foreach ( $content_details as $content ) : ?>
                    <article data-title="<?php echo esc_attr( $content['title'] ); ?>" style="background-image:url('<?php echo esc_url( $content['image'] ); ?>');">
                        <div class="overlay"></div>
                        <div class="featured-content-wrapper wrapper">
                            <header class="entry-header">
                                <h2 class="entry-title"><?php echo esc_html( $content['title'] ); ?></h2>
                            </header>
                        </div><!-- .featured-content-wrapper -->
                    </article>
                <?php 
                $i++;
                endforeach; ?>
            </div><!-- .project-slider -->

    <?php }
endif;