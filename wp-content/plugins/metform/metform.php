<?php
defined( 'ABSPATH' ) || exit;

/**
 * Plugin Name: MetForm
 * Plugin URI:  http://products.wpmet.com/metform/
 * Description: Most flexible and design friendly form builder for Elementor
 * Version: 1.3.2
 * Author: Wpmet
 * Author URI:  https://wpmet.com
 * Text Domain: metform
 * License:  GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

require 'autoloader.php';
require 'plugin.php';

register_activation_hook( __FILE__, [ MetForm\Plugin::instance(), 'flush_rewrites'] );

add_action( 'plugins_loaded', function(){
    do_action('metform/before_load');
    MetForm\Plugin::instance()->init();
    do_action('metform/after_load');
}, 111);
