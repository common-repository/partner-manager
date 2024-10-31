<?php

/**
 *
 *
 * @package    Partner_Manager
 * @subpackage Partner_Manager/admin
 * @author     Erik Saulnier <info@eriksaulnier.com>
 */
class Partner_Manager_Admin_Metaboxes {
  /**
   * The ID of this plugin.
   *
   * @since 		1.0.0
   * @access 		private
   * @var 		string 			$plugin_name 		The ID of this plugin.
   */
  private $plugin_name;

  /**
   * The version of this plugin.
   *
   * @since 		1.0.0
   * @access 		private
   * @var 		string 			$version 			The current version of this plugin.
   */
  private $version;

  private $screens = array(
    'partner',
  );

  private $fields = array(
    array(
      'id' => 'description',
      'label' => 'Description',
      'type' => 'textarea',
    ),
    array(
      'id' => 'website',
      'label' => 'Website',
      'type' => 'url',
    ),
  );

  /**
   * Initialize the class and set its properties.
   *
   * @since 		1.0.0
   * @param 		string 			$plugin_name 		The name of this plugin.
   * @param 		string 			$version 			The version of this plugin.
   */
  public function __construct( $plugin_name, $version ) {
    $this->plugin_name = $plugin_name;
    $this->version = $version;
  }

  /**
   * Hooks into WordPress' add_meta_boxes function.
   * Goes through screens (post types) and adds the meta box.
   */
  public function add_meta_boxes() {
    foreach ( $this->screens as $screen ) {
      add_meta_box(
        'partner-information',
        __( 'Partner Information', $this->plugin_name ),
        array( $this, 'add_meta_box_callback' ),
        $screen,
        'normal',
        'high'
      );
    }
  }

  /**
   * Generates the HTML for the meta box
   *
   * @param object $post WordPress post object
   */
  public function add_meta_box_callback( $post ) {
    wp_nonce_field( 'partner_information_data', 'partner_information_nonce' );
    $this->generate_fields( $post );
  }

  /**
   * Generates the field's HTML for the meta box.
   */
  public function generate_fields( $post ) {
    $output = '';
    foreach ( $this->fields as $field ) {
      $label = '<label for="' . $field['id'] . '">' . $field['label'] . '</label>';
      $db_value = get_post_meta( $post->ID, 'partner_information_' . $field['id'], true );
      switch ( $field['type'] ) {
        case 'textarea':
          $input = sprintf(
            '<textarea class="large-text" id="%s" name="%s" rows="5">%s</textarea>',
            $field['id'],
            $field['id'],
            $db_value
          );
          break;
        default:
          $input = sprintf(
            '<input %s id="%s" name="%s" type="%s" value="%s">',
            $field['type'] !== 'color' ? 'class="regular-text"' : '',
            $field['id'],
            $field['id'],
            $field['type'],
            $db_value
          );
      }
      $output .= $this->row_format( $label, $input );
    }
    echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
  }

  /**
   * Generates the HTML for table rows.
   */
  public function row_format( $label, $input ) {
    return sprintf(
      '<tr><th scope="row">%s</th><td>%s</td></tr>',
      $label,
      $input
    );
  }
  /**
   * Hooks into WordPress' save_post function
   */
  public function save_post( $post_id ) {
    if ( ! isset( $_POST['partner_information_nonce'] ) )
      return $post_id;

    $nonce = $_POST['partner_information_nonce'];
    if ( !wp_verify_nonce( $nonce, 'partner_information_data' ) )
      return $post_id;

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return $post_id;

    foreach ( $this->fields as $field ) {
      if ( isset( $_POST[ $field['id'] ] ) ) {
        switch ( $field['type'] ) {
          case 'email':
            $_POST[ $field['id'] ] = sanitize_email( $_POST[ $field['id'] ] );
            break;
          case 'text':
            $_POST[ $field['id'] ] = sanitize_text_field( $_POST[ $field['id'] ] );
            break;
        }
        update_post_meta( $post_id, 'partner_information_' . $field['id'], $_POST[ $field['id'] ] );
      } else if ( $field['type'] === 'checkbox' ) {
        update_post_meta( $post_id, 'partner_information_' . $field['id'], '0' );
      }
    }
  }

}
