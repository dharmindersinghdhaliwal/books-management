<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              #
 * @since             1.0.0
 * @package           BKMT
 *
 * @wordpress-plugin
 * Plugin Name:       WP Books Management
 * Plugin URI:        #
 * Description:       Custom plugin to manage the books 
 * Version:           1.0.0
 * Author:            Dharminder Singh
 * Author URI:        https://www.dharmindersinghdhaliwal.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bkmt
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define('BKMT_PLUGIN_DIR_PATH',plugin_dir_path(__FILE__));
define("BKMT_PLUGIN_DIR_URL",plugin_dir_url(__FILE__));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-bkmt-activator.php
 */
function activate_BKMT() {

	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bkmt-activator.php';
	BKMT_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-bkmt-deactivator.php
 */
function deactivate_BKMT() {

	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bkmt-deactivator.php';
	BKMT_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_BKMT' );
register_deactivation_hook( __FILE__, 'deactivate_BKMT' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-bkmt.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_BKMT() {

	$plugin = new BKMT();
	$plugin->run();
}
run_BKMT();