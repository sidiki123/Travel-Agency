<?php
/**
 * The Patcher checker implementation.
 *
 * @package Fusion-Library
 * @subpackage Fusion-Patcher
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Direct script access denied.' );
}

/**
 * Periodically checks for patches and adds admin bubbles in menu.
 *
 * @since 1.0.0
 */
class Fusion_Patcher_Checker {

	/**
	 * How often to check for updates.
	 * (in seconds)
	 *
	 * @access private
	 * @since 1.0.0
	 * @var int
	 */
	private $period = DAY_IN_SECONDS;

	/**
	 * The transient name.
	 *
	 * @static
	 * @access public
	 * @since 1.0.0
	 * @var string
	 */
	public static $transient_name = 'fusion_patcher_check_num';

	/**
	 * An instance of the Fusion_Patcher class.
	 *
	 * @access private
	 * @since 1.0.0
	 * @var array
	 */
	private $patcher = [];

	/**
	 * The patches.
	 *
	 * @access protected
	 * @since 1.0.0
	 * @var array
	 */
	protected $patches = [];

	/**
	 * The patches that have already been applied.
	 *
	 * @access protected
	 * @since 1.0.0
	 * @var array
	 */
	protected $applied_patches = [];

	/**
	 * How many new patches do we have?
	 *
	 * @access protected
	 * @since 1.0.0
	 * @var int
	 */
	private $new_patches = 0;

	/**
	 * Have we already checked the number of patches?
	 *
	 * @access protected
	 * @since 1.0.0
	 * @var bool
	 */
	private $checked = false;

	/**
	 * Constructor.
	 *
	 * @access public
	 * @param object $patcher The Fusion_Patcher instance.
	 */
	public function __construct( $patcher ) {

		$this->patcher = $patcher;
		if ( $this->patcher->is_bundled() ) {
			return;
		}

		add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ] );

	}

	/**
	 * Adds a script to the admin footer so that counters are added in the menus.
	 *
	 * @access public
	 * @since 1.0.0
	 * @return void
	 */
	public function admin_scripts() {

		wp_enqueue_script(
			'fusion-patcher-checker',
			FUSION_WHITE_LABEL_BRANDING_PLUGIN_URL . '/assets/js/fusion-patcher-admin-menu-notices.js',
			[ 'jquery', 'underscore' ],
			FUSION_WHITE_LABEL_BRANDING_VERSION,
			true
		);
		$patcher_instances = $this->patcher->get_instance();
		$args              = [
			'patches' => $this->get_cache(),
			'args'    => [],
		];
		foreach ( $patcher_instances as $instance ) {
			$instance_args  = $instance->get_args();
			$args['args'][] = $instance_args;
		}
		wp_localize_script( 'fusion-patcher-checker', 'patcherVars', $args );

	}

	/**
	 * Get & Update the Cache.
	 *
	 * @access public
	 * @since 1.0.0
	 */
	public function get_cache() {
		$cache = get_site_transient( self::$transient_name );
		if ( ! is_array( $cache ) ) {
			$cache = [];
		}
		$context = $this->patcher->get_args( 'context' );
		if ( ! isset( $cache[ $context ] ) ) {
			$cache[ $context ] = $this->get_new_patches_num();
			set_site_transient( self::$transient_name, $cache, $this->period );
		}
		return $cache;
	}

	/**
	 * Check how many new patches exist.
	 *
	 * @access private
	 * @since 1.0.0
	 * @return int
	 */
	private function get_new_patches_num() {

		$args    = $this->patcher->get_args();
		$bundles = $this->patcher->get_args( 'bundled' );
		if ( ! $bundles ) {
			$bundles = [];
		}
		$contexts   = $bundles;
		$contexts[] = $this->patcher->get_args( 'context' );

		$this->patches = Fusion_Patcher_Client::get_patches( $this->patcher->get_args() );
		foreach ( $bundles as $bundle ) {
			$instance = $this->patcher->get_instance( $bundle );
			if ( is_object( $instance ) ) {
				$args = $instance->get_args();
				if ( isset( $args['classname'] ) && ! class_exists( $args['classname'] ) ) {
					continue;
				}
				$instance_patches = Fusion_Patcher_Client::get_patches( $args );
				foreach ( $instance_patches as $id => $patch ) {
					if ( ! isset( $this->patches[ $id ] ) ) {
						$this->patches[ $id ] = $patch;
					}
				}
			}
		}

		// Get an array of the already applied patches.
		$this->applied_patches = get_site_option( 'fusion_applied_patches', [] );

		if ( $this->checked ) {
			return (int) $this->new_patches;
		}

		foreach ( $this->patches as $patch_id => $patch ) {
			$valid_patch = false;
			if ( ! isset( $patch['patch'] ) || empty( $patch['patch'] ) ) {
				continue;
			}
			foreach ( $patch['patch'] as $file_patch ) {
				if ( $valid_patch ) {
					continue;
				}

				if ( in_array( $file_patch['context'], $contexts ) ) {
					$valid_patch = true;
				}
			}
			// @codingStandardsIgnoreLine
			if ( $valid_patch && ! in_array( $patch_id, $this->applied_patches ) ) {
				$this->new_patches++;
			}
		}
		$this->checked = true;
		return (int) $this->new_patches;
	}

	/**
	 * Resets the cache.
	 *
	 * @static
	 * @access public
	 * @since 1.0.0
	 */
	public static function reset_cache() {
		delete_site_transient( self::$transient_name );
	}
}
