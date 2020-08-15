<?php
/**
* Travelbiz Social Widget
* 
* @since Travelbiz 1.0
*/
if ( ! class_exists( 'Travelbiz_Social_Widget' ) ) :

class Travelbiz_Social_Widget extends Travelbiz_Base_Widget{

	/**
	 * Sets up a new Custom Menu widget instance.
	 *
	 * @since Travelbiz 1.0
	 * @access public
	 */
	public function __construct() {
		$widget_ops = array(
			'description' => esc_html__( 'Add a custom menu to your sidebar.', 'travelbiz' ),
			'customize_selective_refresh' => true,
		);

		parent::__construct( 'tbp_social_widget', esc_html__( 'Travelbiz Social Menu', 'travelbiz' ), $widget_ops );
	}

	/**
	 * Outputs the content for the current Custom Menu widget instance.
	 *
	 * @since Travelbiz 1.0
	 * @access public
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance Settings for the current Custom Menu widget instance.
	 */
	public function widget( $args, $instance ) {
		# Get menu
		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

		if ( !$nav_menu )
			return;

		echo $args['before_widget'];

		if ( !empty($instance['title']) )
			echo $args['before_title'] . esc_html( $instance['title'] ) . $args['after_title'];

		$nav_menu_args = apply_filters( 'tbp_social_widget_nav_menu', array(
							'fallback_cb' => '',
							'menu'        => $nav_menu
						), $instance );
		?>
		<section class="wrapper wrap-social-widget">
			<div class="widget-content socialgroup">
				<div class="widget-content-inner">
					<?php wp_nav_menu( $nav_menu_args ); ?>
				</div>
			</div>
		</section>
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Handles updating settings for the current Custom Menu widget instance.
	 *
	 * @since Travelbiz 1.0
	 * @access public
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 * @return array Updated settings to save.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		if ( ! empty( $new_instance['title'] ) ) {
			$instance['title'] = sanitize_text_field( $new_instance['title'] );
		}
		if ( ! empty( $new_instance['nav_menu'] ) ) {
			$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		}
		return $instance;
	}

	/**
	 * Outputs the settings form for the Custom Menu widget.
	 *
	 * @since Travelbiz 1.0
	 * @access public
	 *
	 * @param array $instance Current settings.
	 * @global WP_Customize_Manager $wp_customize
	 */
	public function form( $instance ) {
		global $wp_customize;
		$title = isset( $instance['title'] ) ? $instance['title'] : esc_html__( 'Connect Us', 'travelbiz' );
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

		// Get menus
		$menus = wp_get_nav_menus();

		// If no menus exists, direct the user to go and create some.
		?>
		<p class="nav-menu-widget-no-menus-message" <?php if ( ! empty( $menus ) ) { echo ' style="display:none" '; } ?>>
			<?php

			$url = $wp_customize instanceof WP_Customize_Manager ? 'javascript: wp.customize.panel( "nav_menus" ).focus();' : admin_url( 'nav-menus.php' );
			?>
			<?php echo esc_html__( 'No menus have been created yet.', 'travelbiz' ) ?>
			<a href="<?php echo esc_attr( $url ); ?>">
				<?php echo esc_html__( 'Create some', 'travelbiz' ); ?>
			</a>
		</p>
		<div class="nav-menu-widget-form-controls" <?php if ( empty( $menus ) ) { echo ' style="display:none" '; } ?>>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html__( 'Title:', 'travelbiz' ) ?></label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>"/>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'nav_menu ' ) ); ?>"><?php echo esc_html__( 'Select Menu:', 'travelbiz' ); ?></label>
				<select id="<?php echo esc_attr( $this->get_field_id( 'nav_menu ' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'nav_menu' ) ); ?>">
					<option value="0"><?php echo esc_html__( '&mdash; Select &mdash;', 'travelbiz' ); ?></option>
					<?php foreach ( $menus as $menu ) : ?>
						<option value="<?php echo esc_attr( $menu->term_id ); ?>" <?php selected( $nav_menu, $menu->term_id ); ?>>
							<?php echo esc_html( $menu->name ); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>
		</div>
		<?php
	}
}

endif;