<?php
/*
Plugin Name: WP Screenpartner Author Box Widget
Plugin URI: http://screenpartner.no/
Description: Adds a widget that detects Post author and displays bio in widget.
Version: 0.1
Author: Screenpartner AS
Author URI: http://screenpartner.no/
*/


class author_box_widget extends WP_Widget {

  /** constructor -- name this the same as the class above */
  function author_box_widget() {
    parent::WP_Widget(false, $name = 'SP Author Box');
  }

  /** @see WP_Widget::widget -- do not rename this */
  function widget($args, $instance) {
    extract( $args );
    ?>
      <?php echo $before_widget; ?>

      <?php
      // Get Author Data
      $author             = get_the_author();
      $author_id          = get_the_author_meta('ID');
      $author_description = get_the_author_meta( 'description' );
      $author_url         = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
      $author_avatar      = get_cupp_meta($author_id, 'medium');
      ?>

      <div class="author-info">
        <div class="author-info-inner">

          <?php if ( $author_avatar ) { ?>
            <div class="author-avatar">
              <a href="<?php echo esc_url( $author_url ); ?>" rel="author">
                <?php echo '<img src="' . $author_avatar . '">'; ?>
              </a>
            </div><!-- .author-avatar -->
          <?php } ?>

          <div class="author-description">
            <h4><?php echo $author; ?></h4>
            <p><?php echo wp_kses_post( $author_description ); ?></p>
          </div><!-- .author-description -->

        </div><!-- .author-info-inner -->
      </div><!-- .author-info -->

      <?php echo $after_widget; ?>
    <?php
  }

  /** @see WP_Widget::update -- do not rename this */
  function update($new_instance, $old_instance) {
		$instance = $old_instance;
    return $instance;
  }

  /** @see WP_Widget::form -- do not rename this */
  function form($instance) {
    ?>
    <p>Adds an author box to the sidebar, with information about the post/page author.</p>
    <p>To update your author information, navigate to the "Users" section.</p>
    <?php
  }


} // end class example_widget
add_action('widgets_init', create_function('', 'return register_widget("author_box_widget");'));
?>
