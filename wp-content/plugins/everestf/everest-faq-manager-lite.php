<?php
defined('ABSPATH') or die('No script kiddies please');
/*
  Plugin name: Everest FAQ Manager Lite
  Plugin URI: https://accesspressthemes.com/wordpress-plugins/everest-faq-manager-lite/
  Description: A plugin to add FAQs to posts/pages content using shortcodes and widgets.
  version: 1.0.4
  Author: AccessPress Themes
  Author URI: https://accesspressthemes.com/
  Text Domain: everest-faq-manager-lite
  Domain Path: /languages/
  License: GPLv2 or later
*/
include_once( plugin_dir_path(__FILE__) . 'inc/backend/widget.php' );
if (!class_exists('EFAQM_lite')) {

    class EFAQM_lite {

        function __construct() {
            $this->define_constants();
            //  register_activation_hook(__FILE__, array($this, 'plugin_activation'));
            add_action('plugins_loaded', array($this, 'efaqm_loadTextDomain'));
            add_action('init', array($this, 'efaq_plugin_variables'));
            add_action('init', array($this, 'register_everest_faq_post_type_and_meta_boxes'));
            add_action('save_post', array($this, 'efaq_save_post_meta'));
            add_action('admin_enqueue_scripts', array($this, 'register_plugin_assets'));
            // backend ajax
            add_action('wp_ajax_efaq_backend_ajax', array($this, 'efaq_backend_ajax_manager'));
            add_action('wp_ajax_nopriv_efaq_backend_ajax', array($this, 'efaq_backend_ajax_manager'));
            // widget 

            add_action('wp_enqueue_scripts', array($this, 'register_frontend_assets'));
            add_action('widgets_init', array($this, 'register_efaq_widget'));
            //generate shortcodes
            add_shortcode('everest_faq', array($this, 'efaq_shortcode'));

            // add column in post type table
            add_filter('manage_everest-faq_posts_columns', array($this, 'efaq_table_head')); //adding custom row
            add_action('manage_everest-faq_posts_custom_column', array($this, 'efaq_columns_content'), 10, 2); //adding custom row content
            //register about us page
            add_action('admin_menu', array($this, 'efaq_register_about_page')); //add submenu page
        }

        /**
         * Function for the contant declaration of the plugins.
         * @return null
         */
        function define_constants() {
            defined('EFAQM_PLUGIN_URL') or define('EFAQM_PLUGIN_URL', plugin_dir_url(__FILE__));

            defined('EFAQML_PLUGIN_PATH') or define('EFAQML_PLUGIN_PATH', plugin_dir_path(__FILE__));

            defined('EFAQM_PLUGIN_VERSION') or define('EFAQM_PLUGIN_VERSION', '1.0.4');

            defined('EFAQM_IMAGE_DIR') or define('EFAQM_IMAGE_DIR', plugin_dir_url(__FILE__) . 'images');

           // defined('EFAQM_TEXT_DOMAIN') or define('EFAQM_TEXT_DOMAIN', 'everest-faq-manager-lite');

            defined('EFAQM_SETTINGS') or define('EFAQM_SETTINGS', 'efaqm_settings');

            defined('EFAQM_LANG_DIR') or define('EFAQM_LANG_DIR', basename(dirname(__FILE__)) . '/languages/');

            defined('EFAQM_JS_DIR') or define('EFAQM_JS_DIR', plugin_dir_url(__FILE__) . 'js');

            defined('EFAQM_CSS_DIR') or define('EFAQM_CSS_DIR', plugin_dir_url(__FILE__) . 'css');

            defined('EFAQM_ASSETS_DIR') or define('EFAQM_ASSETS_DIR', plugin_dir_url(__FILE__) . 'assets');
        }

        /**
         * loading and defining text domain
         * @since 1.0.0
         */
        function efaqm_loadTextDomain() {
            load_plugin_textdomain('everest-faq-manager-lite', FALSE, basename(dirname(__FILE__)) . '/languages');
        }

        /**
         * Regestering custom post type and meta box
         * @since 1.0.0
         */
        function register_everest_faq_post_type_and_meta_boxes() {
            include EFAQML_PLUGIN_PATH . 'inc/backend/reg_post_types.php';
            add_action('add_meta_boxes_everest-faq', array($this, 'e_faq_adding_custom_meta_boxes'));
        }

        /**
         * function to add meta boxes for the custom post type
         * @return Null
         */
        function e_faq_adding_custom_meta_boxes() {

            add_meta_box(
                    'faq-items', __('FAQ Items', 'everest-faq-manager-lite'), array($this, 'add_faq_items'), 'everest-faq', 'normal', 'default'
            );
            add_meta_box(
                    'faq-display', __('FAQ Display Settings', 'everest-faq-manager-lite'), array($this, 'render_display_settings'), 'everest-faq', 'normal', 'default'
            );
            add_meta_box(
                    'faq-shortcodes', __('Generated FAQ Shortcode', 'everest-faq-manager-lite'), array($this, 'faq_shortcode_generator'), 'everest-faq', 'side', 'high'
            );
//            add_meta_box(
//                    'faq-upgrade-section', __('Upgrade to PRO', 'everest-faq-manager-lite'), array($this, 'faq_upgrade_to_pro'), 'everest-faq', 'side', 'default'
//            );
        }

        /**
         * FAQ item add and manage section
         * 
         */
        function add_faq_items() {
            include EFAQML_PLUGIN_PATH . 'inc/backend/metaboxes/add_items.php';
        }

        /**
         * Display setting for Faq
         */
        function render_display_settings() {
            include(EFAQML_PLUGIN_PATH . 'inc/backend/metaboxes/display_settings.php');
        }

        function faq_shortcode_generator() {
            global $post;
            $post_id = $post->ID;
            ?>
            <label for='efaq-shortcode-display' style="width: 100%"><?php _e('Please copy the below shortcode to display FAQ', 'everest-faq-manager-lite'); ?></label>
            <input type='text' class="efaq-shortcode-value" readonly="" value="[everest_faq id='<?php echo $post_id; ?>']" style="width: 100%;"  />
            <span class="efaq-copied-info" style="display: none;"><?php _e('Shortcode copied to your clipboard.', 'everest-faq-manager-lite'); ?></span>
            <?php
        }

//        function faq_upgrade_to_pro() {
//            _e('upgrade section');
//        }

        function register_plugin_assets() {
            //register the styles
            // wp_register_style( 'custom-icon-picker', EFAQM_CSS_DIR.'/icon-picker.css', false, E_COUNTER_VERSION );
            wp_register_style('font-awesome-icons-v4.7.0', EFAQM_CSS_DIR . '/font-awesome/font-awesome.min.css', false, EFAQM_PLUGIN_VERSION);
            // wp_register_style('jquery-ui-css', EFAQM_CSS_DIR . '/jquery-ui.css', false, EFAQM_PLUGIN_VERSION);
            wp_register_style('efaq_admin_css', EFAQM_CSS_DIR . '/efaq-backend.css', false, EFAQM_PLUGIN_VERSION);

            //enqueue of the styles
            // wp_enqueue_style('custom-icon-picker');
            wp_enqueue_style('font-awesome-icons-v4.7.0');
            wp_enqueue_style('wp-color-picker');
            wp_enqueue_style('jquery-ui-css');
            wp_enqueue_style('efaq_admin_css');

            // registration of the js
            // wp_register_script('ec_icon_picker', E_COUNTER_JS_DIR.'/icon-picker.js', array('jquery'), E_COUNTER_VERSION, true );
            wp_enqueue_script('wp-color-picker-alpha', EFAQM_JS_DIR . '/wp-color-picker-alpha.js', array('jquery', 'wp-color-picker'), EFAQM_PLUGIN_VERSION);
            wp_register_script('efaq_admin_js', EFAQM_JS_DIR . '/efaq-backend.js', array('jquery', 'wp-color-picker', 'wp-color-picker-alpha', 'jquery-ui-sortable'), EFAQM_PLUGIN_VERSION, true);

            // enqueue of the js
            wp_enqueue_media();
            wp_enqueue_script('wp-color-picker');
            //wp_enqueue_script('ec_icon_picker');
            wp_enqueue_script('efaq_admin_js');
            wp_enqueue_script('jquery-ui-core');
            // wp_enqueue_script('jquery-ui-slider');

            //for the backend ajax call
            $ajax_nonce = wp_create_nonce('efaq-backend-ajax-nonce');
            wp_localize_script('efaq_admin_js', 'efaq_backend_ajax', array('ajax_url' => admin_url() . 'admin-ajax.php', 'ajax_nonce' => $ajax_nonce));
        }

        public static function generateRandomIndex($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        function efaq_plugin_variables() {
            global $efaq_variables;
            include_once( EFAQML_PLUGIN_PATH . 'inc/plugin_variables.php' );
        }

        function efaq_backend_ajax_manager() {

            $efaq_nonce = $_POST['efaq_nonce'];

            $efaq_created_nonce = 'efaq-backend-ajax-nonce';

            if (!wp_verify_nonce($efaq_nonce, $efaq_created_nonce)) {
                die(__('Securtity Check', 'everest-faq-manager-lite'));
            }
            if ($_POST['_action'] == 'add_new_item_action') {
                include EFAQML_PLUGIN_PATH . 'inc/backend/metaboxes/item.php';
                die();
            }
            wp_die();
        }

        function efaq_save_post_meta() {
            global $post;
            if (!empty($post)) {

                $post_id = $post->ID;

                $efaq_is_auto_save = wp_is_post_autosave($post_id);
                $efaq_is_revision = wp_is_post_revision($post_id);

                $efaq_is_valid_nonce = (isset($_POST['verify_nonce_name'])) && wp_verify_nonce($_POST['verify_nonce_name'], 'create-form-nonce');
                if ($efaq_is_auto_save || $efaq_is_revision || !$efaq_is_valid_nonce) {

                    return;
                }
                $merge_array = array();
                if (isset($_POST['item'])) {
                    $merge_array['item'] = (array) $_POST['item'];
                }
                if (isset($_POST['efaq_display_settings'])) {
                    //$this->pre_array($_POST['efaq_display_settings']);
                    $merge_array['efaq_display_settings'] = (array) $_POST['efaq_display_settings'];
                }
                $my_sanitized_array = EFAQM_lite:: sanitize_array($merge_array);
                // $this->pre_array($merge_array);
//                print_r($my_sanitized_array);
//                die();

                update_post_meta($post_id, 'efaq_data', $my_sanitized_array);
                return;
            }
        }

        /**
         * Sanitizes Multi-Dimensional Array
         * @param array $array
         * @param array $sanitize_rule
         * @return array
         *
         * @since 1.0.0
         */
        static function sanitize_array($array = array(), $sanitize_rule = array()) {
            if (!is_array($array) || count($array) == 0) {
                return array();
            }

            foreach ($array as $k => $v) {
                if (!is_array($v)) {
                    $default_sanitize_rule = (is_numeric($k)) ? 'html' : 'text';
                    $sanitize_type = isset($sanitize_rule[$k]) ? $sanitize_rule[$k] : $default_sanitize_rule;
                    $array[$k] = self:: sanitize_value($v, $sanitize_type);
                }

                if (is_array($v)) {
                    $array[$k] = self:: sanitize_array($v, $sanitize_rule);
                }
            }

            return $array;
        }

        /**
         * Sanitizes Value
         *
         * @param type $value
         * @param type $sanitize_type
         * @return string
         *
         * @since 1.0.0
         */
        static function sanitize_value($value = '', $sanitize_type = 'html') {
            switch ($sanitize_type) {
                case 'text':
                    $allowed_html = wp_kses_allowed_html('post');
                    // var_dump($allowed_html);
                    return wp_kses($value, $allowed_html);
                    break;
                default:
                    return sanitize_text_field($value);
                    break;
            }
        }

        /**
         * column head of post type
         *
         * @since 1.0.0
         */
        function efaq_table_head($columns) {
            $columns['shortcodes'] = __('Shortcode', 'everest-faq-manager-lite');
            $columns['template_selected'] = __('Template Include', 'everest-faq-manager-lite');
            return $columns;
        }

        // value of shortcode and templete in table
        function efaq_columns_content($column, $post_id) {
            if ($column == 'shortcodes') {
                ?>
                <textarea  class='efaq-shortcode-value' style="resize: none;" rows="2" cols="25" readonly="readonly">[everest_faq id='<?php echo $post_id; ?>']</textarea>
                <span class="efaq-copied-info" style="display: none;"><?php _e('Shortcode copied to your clipboard.', 'everest-faq-manager-lite'); ?></span>
                <?php
            }
            if ($column == 'template_selected') {
                ?>
                <textarea  class='efaq-shortcode-value' style="resize: none;" rows="2" cols="25" readonly="readonly">&lt;?php echo do_shortcode("[everest_faq id='<?php echo $post_id; ?>']"); ?&gt;</textarea>
                <span class="efaq-copied-info" style="display: none;"><?php _e('Template code copied to your clipboard.', 'everest-faq-manager-lite'); ?></span>
                <?php
            }
        }

        function efaq_shortcode($atts) {
            $args = array(
                'post_type' => 'everest-faq',
                'post_status' => 'public',
                'posts_per_page' => 1,
                'p' => $atts['id']
            );

            $efaq_get_row_post = new WP_Query($args);
            if ($efaq_get_row_post->have_posts()) {
                ob_start();
                include(EFAQML_PLUGIN_PATH . 'inc/frontend/efaq-shortcode.php');
                $return_data = ob_get_contents();
                ob_end_clean();
                wp_reset_query();
                if (isset($return_data)) {
                    return $return_data;
                } else {
                    return NULL;
                }
            } else {
                wp_reset_query();
                return null;
            }
        }

        function register_efaq_widget() {
            register_widget('EFAQ_Widget_Lite');
        }

        /*
         * Registering frontend assets
         * @since 1.0.0
         */

        function register_frontend_assets() {
            wp_enqueue_style('font-awesome-icons-v4.7.0', EFAQM_CSS_DIR . '/font-awesome/font-awesome.min.css', false, EFAQM_PLUGIN_VERSION);
            wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Raleway|ABeeZee|Aguafina+Script|Open+Sans|Roboto|Roboto+Slab|Lato|Titillium+Web|Source+Sans+Pro|Playfair+Display|Montserrat|Khand|Oswald|Ek+Mukta|Rubik|PT+Sans+Narrow|Poppins|Oxygen:300,400,600,700', array(), EFAQM_PLUGIN_VERSION);
            wp_enqueue_style('efaq_frontend_css', EFAQM_CSS_DIR . '/ecfaq-frontend.css', array(), EFAQM_PLUGIN_VERSION);

            //for counterup js


            wp_enqueue_script('efaq_frontend_js', EFAQM_JS_DIR . '/efaq-frontend.js', array('jquery'), EFAQM_PLUGIN_VERSION, true);
        }

        function efaq_register_about_page() {
            add_submenu_page('edit.php?post_type=everest-faq', __('More WordPress Stuffs', 'everest-faq-manager-lite'), __('More WordPress Stuffs', 'everest-faq-manager-lite'), 'manage_options', 'about-efaq-manager', array($this, 'efaq_about_us_submenu_page'));
        }

        function efaq_about_us_submenu_page() {
            include EFAQML_PLUGIN_PATH . 'inc/backend/about_us.php';
        }

        function pre_array($array) {
            echo "<pre>";
            print_r($array);
            echo "</pre>";
        }

    }

    new EFAQM_lite();
}