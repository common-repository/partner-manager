<?php

/**
 * Display a list of the site's partners
 *
 * @link       https://eriksaulnier.com
 * @since      1.0.0
 *
 * @package    Partner_Manager
 * @subpackage Partner_Manager/public/partials
 */

 $partners = new WP_Query( array(
   'post_type' => 'partner',
   'orderby' => 'menu_order title',
   'order' => 'ASC'
 ) );
?>

<?php if ( strpos( $atts['divider'], 'top' ) !== false ) : ?>
  <div class="partner-divider-top"></div>
<?php endif; ?>

<ul class="partner-list <?php echo $atts['alternate'] == 'true' ? 'alternate' : '' ?>">
  <?php while ( $partners->have_posts() ) : $partners->the_post(); ?>
    <?php
      $link = get_post_meta( get_the_ID(), 'partner_information_website', true );
      $description = get_post_meta( get_the_ID(), 'partner_information_description', true );
    ?>
    <li>
      <a class="logo" href="<?php echo esc_url( $link ); ?>">
        <img src="<?php the_post_thumbnail_url( 'medium' ); ?>" alt="<?php the_title(); ?>">
      </a>
      <div class="content">
        <h3><?php the_title(); ?></h3>
        <a class="website" href="<?php echo esc_url( $link ); ?>"><?php echo esc_url( $link ); ?></a>
        <?php echo $description; ?>
      </div>
    </li>
  <?php endwhile; ?>
</ul>

<?php if ( strpos( $atts['divider'], 'bottom' ) !== false ) : ?>
  <div class="partner-divider-bottom"></div>
<?php endif; ?>
