<?php
/**
 * Welcome Admin page.
 *
 * @author     ThemeFusion
 * @copyright  (c) Copyright by ThemeFusion
 * @link       https://theme-fusion.com
 * @package    Avada
 * @subpackage Core
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

?>
<?php self::get_admin_screens_header( 'welcome' ); ?>
	<?php
	ob_start();
	Avada()->registration->the_form();
	$reg_form = ob_get_clean();
	?>

	<div class="avada-db-welcome-wrapper">
		<?php
		$completed_reg = Avada()->registration->is_registered() ? ' avada-db-completed avada-db-onload-completed' : '';

		$completed_import = '';
		$imported_data    = get_option( 'fusion_import_data', [] );
		foreach ( $imported_data as $part ) {
			if ( ! empty( $part ) ) {
				$completed_import = ' avada-db-completed';
				break;
			}
		}

		$frontend_builder_loaded = get_option( 'avada_builder_frontend_loaded' );
		$completed_customization = $frontend_builder_loaded ? ' avada-db-completed' : '';

		$setup_completed = '';
		if ( $completed_reg && $imported_data && $completed_customization ) {
			$setup_completed = ' avada-db-welcome-setup-completed';
		}
		?>
		<section id="avada-db-registration" class="avada-db-card avada-db-registration<?php echo esc_attr( $completed_reg ); ?>">
			<?php echo $reg_form; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</section>

		<section class="avada-db-card avada-db-welcome-setup<?php echo esc_attr( $setup_completed ); ?>">
			<button class="avada-db-more-info avada-db-tooltip">
				<span class="avada-db-tooltip-text"><?php esc_html_e( 'Show Setup Steps', 'Avada' ); ?></span>
			</button>
			<button class="notice-dismiss"></button>

			<div class="avada-db-welcome-container">
				<div class="avada-db-welcome-intro">
					<h1 class="avada-db-welcome-heading"><?php echo esc_html( apply_filters( 'avada_admin_welcome_title', __( 'Welcome To Avada!', 'Avada ' ) ) ); ?></h1>
					<p class="avada-db-welcome-text"><?php echo esc_html( apply_filters( 'avada_admin_welcome_text', __( 'Avada is now installed and ready to use! Get ready to build something beautiful. We hope you enjoy it!' ) ) ); ?></p>

					<a class="avada-db-welcome-video" href="#">
						<span class="avada-db-welcome-video-icon">
							<span class="avada-db-triangle"></span>
						</span>
						<span class="avada-db-welcome-video-text"><?php esc_html_e( 'Watch Avada Website Builder In Action.', 'Avada ' ); ?><span>
					</a>
				</div>
				<?php $welcome_video = Avada_Admin::get_dashboard_screen_video_url( Avada()->registration->is_registered() && ! empty( $previous_versions ) ); ?>
				<div class="avada-db-welcome-video-container">
					<img class="avada-db-welcome-image" src="<?php echo esc_url( get_template_directory_uri() . '/assets/admin/images/dashboard-welcome.jpg' ); ?>" alt="<?php esc_html_e( 'WPEngine Logo', 'Avada' ); ?>" width="1200" height="712" />
					<iframe class="avada-db-welcome-video-iframe" src="<?php echo esc_url( $welcome_video ); ?>" width="100%" height="100%" frameborder="0"></iframe>
				</div>
			</div>

			<div class="avada-db-setup">
				<h2 class="avada-db-setup-heading"><?php esc_html_e( 'Setup Your Website', 'Avada' ); ?></h2>
				<p class="avada-db-setup-text"><?php esc_html_e( 'Easily setup your website with 3 little steps.' ); ?></p>

				<a class="avada-db-setup-step avada-db-step-one<?php echo esc_attr( $completed_reg ); ?>" href="#avada-db-registration" aria-label="<?php esc_attr_e( 'Link to product registration', 'Avada' ); ?>">
					<div class="avada-db-setup-step-info">
						<h3 class="avada-db-setup-step-heading"><?php esc_html_e( 'Register Your Product', 'Avada' ); ?></h3>
						<p class="avada-db-setup-step-text avada-db-card-text-small"><?php esc_html_e( 'Enter your Envato token in the form below to register this copy of Avada.' ); ?></p>
					</div>
					<i class="avada-db-setup-step-icon fusiona-unlock"></i>
				</a>

				<a class="avada-db-setup-step avada-db-step-two<?php echo esc_attr( $completed_import ); ?>" href="<?php echo esc_url( admin_url( 'admin.php?page=avada-prebuilt-websites' ) ); ?>" aria-label="<?php esc_attr_e( 'Link to prebuilt websites', 'Avada' ); ?>">
					<div class="avada-db-setup-step-info">
						<h3 class="avada-db-setup-step-heading"><?php esc_html_e( 'Select A Prebuilt Website', 'Avada' ); ?></h3>
						<p class="avada-db-setup-step-text avada-db-card-text-small"><?php esc_html_e( 'One-click import one of our professionally designed, prebuilt websites.' ); ?></p>
					</div>
					<i class="avada-db-setup-step-icon fusiona-demos"></i>
				</a>

				<a class="avada-db-setup-step avada-db-step-three<?php echo esc_attr( $completed_customization ); ?>" href="<?php echo esc_url( add_query_arg( 'fb-edit', '1', get_site_url() ) ); ?>" aria-label="<?php esc_attr_e( 'Live edit website', 'Avada' ); ?>">
					<div class="avada-db-setup-step-info">
						<h3 class="avada-db-setup-step-heading"><?php esc_html_e( 'Customize Your Website', 'Avada' ); ?></h3>
						<p class="avada-db-setup-step-text avada-db-card-text-small"><?php esc_html_e( 'Edit your website live, directly on the front-end, with Avada\'s amazing design tools.' ); ?></p>
					</div>
					<i class="avada-db-setup-step-icon fusiona-arrow-forward"></i>
				</a>
			</div>
		</section>


		<section class="avada-db-card avada-db-welcome-resources">
			<h2 class="avada-db-card-heading-with-badge avada-db-welcome-resources-heading">
				<span class="avada-db-card-heading-text avada-db-welcome-resources-heading-text"><?php esc_html_e( 'Avada Resources', 'Avada' ); ?></span>
				<span class="avada-db-card-heading-badge avada-db-welcome-resources-heading-badge">
					<i class="fusiona-star"></i>
					<span class="avada-db-card-heading-badge-text"><?php esc_html_e( 'Recommended', 'Avada' ); ?></span>
				</span>
			</h2>

			<div class="avada-db-card-grid">
				<div class="avada-db-card-notice avada-db-welcome-resources-license">
					<p class="avada-db-card-notice-heading-image">
						<a href="<?php echo esc_url( 'https://1.envato.market/nYa3RN' ); ?>" class="avada-db-imgae-link" target="_blank" rel="noopener noreferrer">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/admin/images/buy-avada.png' ); ?>" alt="<?php esc_html_e( 'Avada Logo', 'Avada' ); ?>" width="800" height="315" />
						</a>
					</p>
					<div class="avada-db-card-notice-heading">
						<h3><?php esc_html_e( 'Get Another License', 'Avada' ); ?></h3>
					</div>
					<p class="avada-db-card-notice-content">
						<?php esc_html_e( 'Get another license of the Avada Website Builder for your next project. Streamline your work and save time for the more important things.', 'Avada' ); ?>
					</p>
					<p class="avada-db-card-notice-content">
						<a href="<?php echo esc_url( 'https://1.envato.market/nYa3R' ); ?>" class="button button-primary" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Get Another License', 'Avada' ); ?></a>
					</p>
				</div>

				<div class="avada-db-card-notice avada-db-welcome-resources-hosting">
					<p class="avada-db-card-notice-heading-image">
						<a href="<?php echo esc_url( 'https://bit.ly/2UuDId0' ); ?>" class="avada-db-imgae-link" target="_blank" rel="noopener noreferrer">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/admin/images/avada-hosting-wpengine.png' ); ?>" alt="<?php esc_html_e( 'WPEngine Logo', 'Avada' ); ?>" width="400" height="315" />
						</a>

						<a href="<?php echo esc_url( 'https://bit.ly/3hfXQZN' ); ?>" class="avada-db-imgae-link" target="_blank" rel="noopener noreferrer">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/admin/images/avada-hosting-bluehost.png' ); ?>" alt="<?php esc_html_e( 'Bluehost Logo', 'Avada' ); ?>" width="400" height="315" />
						</a>
					</p>
					<div class="avada-db-card-notice-heading">
						<h3><?php esc_html_e( 'Avada Hosting', 'Avada' ); ?></h3>
					</div>
					<p class="avada-db-card-notice-content">
						<?php esc_html_e( 'We recommend you use a host trusted by WordPress that provides high quality service, such as our partners at WPEngine and Bluehost.', 'Avada' ); ?>
					</p>
					<p class="avada-db-card-notice-content">
						<a href="<?php echo esc_url( self::$theme_fusion_url ) . 'wordpress-hosting/'; ?>" class="button button-primary" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Learn More', 'Avada' ); ?></a>
					</p>
				</div>

				<div class="avada-db-card-notice avada-db-welcome-resources-customization">
					<p class="avada-db-card-notice-heading-image">
						<a href="<?php echo esc_url( 'https://codeable.io/?ref=jMHpp' ); ?>" class="avada-db-imgae-link" target="_blank" rel="noopener noreferrer">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/admin/images/avada-codeable.png' ); ?>" alt="<?php esc_html_e( 'Codeable Logo', 'Avada' ); ?>" width="800" height="315" />
						</a>
					</p>
					<div class="avada-db-card-notice-heading">
						<h3><?php esc_html_e( 'Avada Customization', 'Avada' ); ?></h3>
					</div>
					<p class="avada-db-card-notice-content">
						<?php esc_html_e( 'We work with Codeable who offers amazing customization services. They are equipped to handle both large and small customization jobs.', 'Avada' ); ?>
					</p>
					<p class="avada-db-card-notice-content">
						<a href="<?php echo esc_url( 'https://app.codeable.io/tasks/new?ref=jMHpp' ); ?>" class="button button-primary" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Get Free Quote', 'Avada' ); ?></a>
					</p>
				</div>
			</div>
		</section>

		<section class="avada-db-card avada-db-welcome-partners">
			<h2 class="avada-db-card-heading-with-badge avada-db-welcome-partners-heading">
				<span class="avada-db-card-heading-text avada-db-welcome-partners-heading-text"><?php esc_html_e( 'Avada Integrations', 'Avada' ); ?></span>
				<span class="avada-db-card-heading-badge avada-db-welcome-partners-heading-badge">
					<i class="fusiona-tag"></i>
					<span class="avada-db-card-heading-badge-text"><?php esc_html_e( 'Premium Additions', 'Avada' ); ?></span>
				</span>
			</h2>			

			<div class="avada-db-card-grid">
				<div class="avada-db-card-notice avada-db-welcome-partners-hubspot">
					<p class="avada-db-card-notice-heading-image">
						<a href="<?php echo esc_url( 'https://hubs.to/CJmsD' ); ?>" class="avada-db-imgae-link" target="_blank" rel="noopener noreferrer">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/admin/images/avada-hubspot.png' ); ?>" alt="<?php esc_html_e( 'HubSpot Logo', 'Avada' ); ?>" width="800" height="315" />
						</a>
					</p>
					<div class="avada-db-card-notice-heading">
						<h3><?php esc_html_e( 'CRM, Marketing & Sales', 'Avada' ); ?></h3>
					</div>
					<p class="avada-db-card-notice-content">
						<?php esc_html_e( 'HubSpot offers a full stack of software for marketing, sales, and also customer service, with a completely free CRM at its core. Grow now!', 'Avada' ); ?>
					</p>
					<p class="avada-db-card-notice-content">
						<a href="<?php echo esc_url( 'https://hubs.to/CJmsD' ); ?>" class="button button-primary" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'WP Marketing', 'Avada' ); ?></a>
					</p>
				</div>

				<div class="avada-db-card-notice avada-db-welcome-partners-wpml">
					<p class="avada-db-card-notice-heading-image">
						<a href="<?php echo esc_url( 'https://wpml.org/?aid=38405&affiliate_key=DYLA9bEPLvPY' ); ?>" class="avada-db-imgae-link" target="_blank" rel="noopener noreferrer">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/admin/images/avada-wpml.png' ); ?>" alt="<?php esc_html_e( 'WPML Logo', 'Avada' ); ?>" width="400" height="315" />
						</a>
					</p>
					<div class="avada-db-card-notice-heading">
						<h3><?php esc_html_e( 'Multilingual Sites', 'Avada' ); ?></h3>
					</div>
					<p class="avada-db-card-notice-content">
						<?php esc_html_e( 'WPML makes it easy to build multilingual sites and run them. It\'s powerful enough for corporate sites, yet simple for blogs.', 'Avada' ); ?>
					</p>
					<p class="avada-db-card-notice-content">
						<a href="<?php echo esc_url( 'https://wpml.org/?aid=38405&affiliate_key=DYLA9bEPLvPY' ); ?>" class="button button-primary" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'WP Multilingual', 'Avada' ); ?></a>
					</p>
				</div>

				<div class="avada-db-card-notice avada-db-welcome-partners-ec">
					<p class="avada-db-card-notice-heading-image">
						<a href="<?php echo esc_url( 'https://mbsy.co/cLHpG' ); ?>" class="avada-db-imgae-link" target="_blank" rel="noopener noreferrer">
							<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/admin/images/avada-events-calendar.png' ); ?>" alt="<?php esc_html_e( 'EC Logo', 'Avada' ); ?>" width="800" height="315" />
						</a>
					</p>
					<div class="avada-db-card-notice-heading">
						<h3><?php esc_html_e( 'Events Calendar', 'Avada' ); ?></h3>
					</div>
					<p class="avada-db-card-notice-content">
						<?php esc_html_e( 'Power your events for free with The Events Calendar, or upgrade to Pro to unlock recurring events, views, premium support, and more.', 'Avada' ); ?>
					</p>
					<p class="avada-db-card-notice-content">
						<a href="<?php echo esc_url( 'https://mbsy.co/cLHpG' ); ?>" class="button button-primary" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'WP Events Calendar', 'Avada' ); ?></a>
					</p>
				</div>
			</div>
		</section>	
	</div>

	<?php
	$previous_versions = get_option( 'avada_previous_version', [] );
	/**
	 * WIP
	echo apply_filters( 'avada_admin_welcome_screen_content', $welcome_html ); // phpcs:ignore WordPress.Security.EscapeOutput
	 */
	?>
	<?php $this->get_admin_screens_footer(); ?>
