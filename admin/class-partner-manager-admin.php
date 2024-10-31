<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://eriksaulnier.com
 * @since      1.0.0
 *
 * @package    Partner_Manager
 * @subpackage Partner_Manager/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Partner_Manager
 * @subpackage Partner_Manager/admin
 * @author     Erik Saulnier <info@eriksaulnier.com>
 */
class Partner_Manager_Admin {

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
   * @param      string    $plugin_name       The name of this plugin.
   * @param      string    $version    The version of this plugin.
   */
  public function __construct( $plugin_name, $version ) {
    $this->plugin_name = $plugin_name;
    $this->version = $version;
  }

  /**
   * Registers custom post types for the plugin.
   *
   * @since   1.0.0
   */
  public function register_post_types() {
    $labels = array(
      'name'                  => _x( 'Partners', 'Post Type General Name', 'partner-manager' ),
      'singular_name'         => _x( 'Partner', 'Post Type Singular Name', 'partner-manager' ),
      'menu_name'             => __( 'Partners', 'partner-manager' ),
      'name_admin_bar'        => __( 'Partner', 'partner-manager' ),
      'archives'              => __( '', 'partner-manager' ),
      'attributes'            => __( 'Partner Attributes', 'partner-manager' ),
      'all_items'             => __( 'All Partners', 'partner-manager' ),
      'add_new_item'          => __( 'Add New Partner', 'partner-manager' ),
      'add_new'               => __( 'Add New', 'partner-manager' ),
      'new_item'              => __( 'New Partner', 'partner-manager' ),
      'edit_item'             => __( 'Edit Partner', 'partner-manager' ),
      'update_item'           => __( 'Update Partner', 'partner-manager' ),
      'view_item'             => __( 'View Partner', 'partner-manager' ),
      'view_items'            => __( 'View Partners', 'partner-manager' ),
      'search_items'          => __( 'Search Partner', 'partner-manager' ),
      'not_found'             => __( 'Not found', 'partner-manager' ),
      'not_found_in_trash'    => __( 'Not found in Trash', 'partner-manager' ),
      'featured_image'        => __( 'Partner Image', 'partner-manager' ),
      'set_featured_image'    => __( 'Set partner image', 'partner-manager' ),
      'remove_featured_image' => __( 'Remove partner image', 'partner-manager' ),
      'use_featured_image'    => __( 'Use as partner image', 'partner-manager' ),
      'insert_into_item'      => __( 'Insert into partner', 'partner-manager' ),
      'uploaded_to_this_item' => __( 'Uploaded to this partner', 'partner-manager' ),
      'items_list'            => __( 'Partner list', 'partner-manager' ),
      'items_list_navigation' => __( 'Partner list navigation', 'partner-manager' ),
      'filter_items_list'     => __( 'Filter partner list', 'partner-manager' ),
    );
    $args = array(
      'label'                 => __( 'Partner', 'partner-manager' ),
      'description'           => __( 'Post Type Description', 'partner-manager' ),
      'labels'                => $labels,
      'supports'              => array( 'title', 'thumbnail', 'revisions' ),
      'hierarchical'          => false,
      'public'                => true,
      'show_ui'               => true,
      'show_in_menu'          => true,
      'menu_position'         => 20,
      'menu_icon'             => 'dashicons-groups',
      'show_in_admin_bar'     => true,
      'show_in_nav_menus'     => false,
      'can_export'            => true,
      'has_archive'           => false,
      'exclude_from_search'   => true,
      'publicly_queryable'    => true,
      'capability_type'       => 'page',
    );
    register_post_type( 'partner', $args );
  }

}
