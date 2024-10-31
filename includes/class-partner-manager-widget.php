<?php

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    Partner_Manager
 * @subpackage Partner_Manager/includes
 * @author     Erik Saulnier <info@eriksaulnier.com>
 */
class Partner_Manager_Widget extends WP_Widget {
  /**
  * Constructor for the widget
  */
  public function __construct() {
    parent::__construct(
      'partner-manager-widget',
      'Partner Carousel',
      array(
        'description' => __( 'Rotates through the site\'s partners', 'partner-manager' )
      )
    );
  }

  /**
  * Admin form in the widget area
  */
  public function form( $instance ) {
    $title = ( !empty($instance) ? strip_tags($instance['title']) : '' );
    ?>

    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    </p>

    <?php
  }

  /**
  * Update function for the widget
  */
  public function update( $new_instance, $old_instance ) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    return $instance;
  }

  /**
  * Outputs the widget with the selected settings
  */
  public function widget( $args, $instance ) {
    extract($args);

    $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
    $partners = new WP_Query( array(
      'post_type' => 'partner',
      'orderby' => 'rand'
    ) );

    echo $before_widget;
    ?>
      <?php echo $before_title . $title . $after_title ?>

      <ul class="partner-slider">
        <?php while ( $partners->have_posts() ) : $partners->the_post(); ?>
          <li>
            <a href="<?php echo esc_url( get_post_meta( get_the_ID(), 'partner_information_website', true ) ); ?>">
              <img src="<?php the_post_thumbnail_url( 'medium' ); ?>" alt="<?php the_title(); ?>">
            </a>
          </li>
        <?php endwhile; ?>
      </ul>
    <?php
    echo $after_widget;
  }

}
