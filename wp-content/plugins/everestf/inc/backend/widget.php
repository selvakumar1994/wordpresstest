<?php

defined('ABSPATH') or die('NO script kiddies please');

if (!class_exists('EFAQ_Widget_Lite')) {

    Class EFAQ_Widget_Lite extends WP_Widget {

        /**
         * Sets up the widgets name etc
         */
        function __construct() {
            parent::__construct(
                    'efaq_widget', // Base ID
                    __('Everest FAQ', 'everest-faq-manager-lite'), // Name
                    array('description' => __('Everest FAQ Widget', 'everest-faq-manager-lite')) // Args
            );
        }

        public function form($instance) {
            if (isset($instance['title'])) {
                $title = $instance['title'];
            } else {
                $title = '';
            }
            if (isset($instance['shortcode_id'])) {
                $shortcode_id = $instance['shortcode_id'];
            } else {
                $shortcode_id = '';
            }
?> 
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'FAQ Title: ', 'everest-faq-manager-lite' ); ?></label>
            <input  id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
            
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('shortcode_id'); ?>"><?php _e( 'shortcode ID: ', 'everest-faq-manager-lite'); ?></label>
            <input id="<?php echo $this->get_field_id('shortcode_id'); ?>" name="<?php echo $this->get_field_name('shortcode_id'); ?>" type="text" value="<?php echo esc_attr($shortcode_id); ?>">
        </p>
            <?php

        }

        /**
         * Outputs the content of the widget
         *
         * @param array $args
         * @param array $instance
         */
        public function widget($args, $instance) {
            echo $args['before_widget'];
            if (!empty($instance['title'])) {
                echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
                echo "<div class='apsl-widget'>";
                echo do_shortcode("[everest_faq id='{$instance['shortcode_id']}']");
                echo "</div>";
                echo $args['after_widget'];
            }
        }

        public function update($new_instance, $old_instance) {
            $instance = array();
            $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
            $instance['shortcode_id'] = (!empty($new_instance['shortcode_id']) ) ? strip_tags($new_instance['shortcode_id']) : '';
            return $instance;
        }

    }

}
