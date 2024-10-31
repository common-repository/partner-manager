<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://eriksaulnier.com
 * @since      1.0.0
 *
 * @package    Partner_Manager
 * @subpackage Partner_Manager/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Partner_Manager
 * @subpackage Partner_Manager/public
 * @author     Erik Saulnier <info@eriksaulnier.com>
 */
class Partner_Manager_Public {

  /**
   * The ID of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $plugin_name    The ID of this plugin.
   */
  private $plugin_name;

  /**
   * The version of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $version    The current version of this plugin.
   */
  private $version;

  /**
   * Initialize the class and set its properties.
   *
   * @since    1.0.0
   * @param      string    $plugin_name       The name of the plugin.
   * @param      string    $version    The version of this plugin.
   */
  public function __construct( $plugin_name, $version ) {
    $this->plugin_name = $plugin_name;
    $this->version = $version;
  }

  /**
   * Register the stylesheets for the public-facing side of the site.
   *
   * @since    1.0.0
   */
  public function enqueue_styles() {
    wp_enqueue_style( 'slick', plugin_dir_url( __FILE__ ) . 'css/slick.css', array(), $this->version, 'all' );
    wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/partner-manager-public.css', array( 'slick' ), $this->version, 'all' );
  }

  /**
   * Register the JavaScript for the public-facing side of the site.
   *
   * @since    1.0.0
   */
  public function enqueue_scripts() {
    wp_enqueue_script( 'slick', plugin_dir_url( __FILE__ ) . 'js/slick.min.js', array( 'jquery' ), $this->version, false );
    wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/partner-manager-public.js', array( 'jquery', 'slick' ), $this->version, false );
  }

  public function display_list_shortcode($shortcode_atts = [], $content = null, $tag = '') {
    $shortcode_atts = array_change_key_case((array)$shortcode_atts, CASE_LOWER);
    $atts = shortcode_atts([
      'alternate' => 'false',
      'divider' => 'none'
    ], $shortcode_atts, $tag);

    ob_start();
    include_once 'partials/partner-manager-shortcode-list.php';
    $r = ob_get_contents();
    ob_end_clean();
    return $r;
  }

}
