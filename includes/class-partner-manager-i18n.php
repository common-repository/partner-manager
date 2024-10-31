<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://eriksaulnier.com
 * @since      1.0.0
 *
 * @package    Partner_Manager
 * @subpackage Partner_Manager/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Partner_Manager
 * @subpackage Partner_Manager/includes
 * @author     Erik Saulnier <info@eriksaulnier.com>
 */
class Partner_Manager_i18n {


  /**
   * Load the plugin text domain for translation.
   *
   * @since    1.0.0
   */
  public function load_plugin_textdomain() {
    load_plugin_textdomain(
      'partner-manager',
      false,
      dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
    );
  }

}
