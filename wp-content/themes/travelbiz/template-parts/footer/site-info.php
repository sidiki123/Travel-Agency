<?php
/**
 * Template part for displaying footer copyright
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @since Travelbiz 1.0.0
 */
?>

<div class="copyright">
	<?php echo wp_kses_post( html_entity_decode( travelbiz_get_option( 'footer_text' ) ) ); ?> <?php esc_html_e( 'Travelbiz Theme by', 'travelbiz' ); ?> <a href="<?php echo esc_url( '//keonthemes.com' ); ?>" target="_blank"> <?php esc_html_e( 'Keon Themes', 'travelbiz' ); ?> </a>
</div>