<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://eriksaulnier.com/
 * @since             1.0.0
 * @package           Partner_Manager
 *
 * @wordpress-plugin
 * Plugin Name:       Partner Manager
 * Description:       Allows site administrators to manage the site's partners and
 * display them in the form of a image slider or a list (using a shortcode).
 * Version:           1.0.0
 * Author:            Erik Saulnier
 * Author URI:        https://eriksaulnier.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       partner-manager
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}

define( 'PARTNER_MANAGER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-partner-manager-activator.php
 */
function activate_partner_manager() {
  require_once plugin_dir_path( __FILE__ ) . 'includes/class-partner-manager-activator.php';
  Partner_Manager_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-partner-manager-deactivator.php
 */
function deactivate_partner_manager() {
  require_once plugin_dir_path( __FILE__ ) . 'includes/class-partner-manager-deactivator.php';
  Partner_Manager_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_partner_manager' );
register_deactivation_hook( __FILE__, 'deactivate_partner_manager' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-partner-manager.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_partner_manager() {
  $plugin = new Partner_Manager();
  $plugin->run();
}
run_partner_manager();
