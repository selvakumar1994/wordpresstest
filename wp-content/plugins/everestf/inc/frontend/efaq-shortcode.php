<?php
defined('ABSPATH') or die('No script kiddies please');

$post_id = $atts['id'];

$faq_data = get_post_meta($post_id, 'efaq_data', true);
if ($faq_data != NULL) {
    $item = $faq_data['item'];
    $disp_settings = $faq_data['efaq_display_settings'];
    $selected_template = $disp_settings['template-selection'];
    $tab_settings = $disp_settings['tab-settings'];
    $title_styles = isset($disp_settings['title']) ? $disp_settings['title']: array();
    $desc_styles = isset($disp_settings['desc']) ? $disp_settings['desc'] : array();

//    echo "<pre>";
//     print_r($item) ;
//    echo "</pre>";
    ?>
    <div class="efaq-front-main-container efaq-template efaq-selected-template-<?php echo $selected_template; ?> efaq-item-<?php echo $post_id; ?> ">
        <div class="efaq-tab-settings efaq-<?php echo $tab_settings; ?>">
            <?php
            $count = 1;
            foreach ($item as $key => $faq_item) {
                ?>

                <div class="efaq-front-wrap-inner <?php if($count==1 && ($tab_settings == 'default-tab')){ echo "efaq-tab-active"; }else if($tab_settings =='open-all-tab'){ echo "efaq-tab-active"; } ?> ">
                    <div class = "efaq-front-title-wrap efaq-clearfix">

                        <div class = "efaq-front-title">
                            <?php
                            echo esc_attr($faq_item['title']['content']);
                            ?>
                        </div>
                        <span class="up-down-btn <?php if($count==1 && ($tab_settings == 'default-tab')){ echo "efaq-btn-active"; }else if($tab_settings =='open-all-tab'){ echo "efaq-btn-active"; } ?> "><i class="fa fa-caret-down"></i></span>
                    </div>

                    <div class = "efaq-front-content-wrap"  style="<?php if($count==1 && ($tab_settings == 'default-tab')){ echo 'display:block;'; }else if($tab_settings =='open-all-tab'){ echo 'display:block;'; }else { echo 'display:none;';  } ?>">
                        <div class = "efaq-front-content">
                            <?php echo ($faq_item['desc']['content']); ?>
                        </div>
                    </div>
                </div>
                <?php
                $count++;
            }
            ?>
        </div>
    </div>
    <?php  ?>
    <style type="text/css">
        .efaq-item-<?php echo $post_id; ?> .efaq-front-title {
            <?php if(isset($title_styles['text-color']) && $title_styles['text-color'] !=''){ ?>
            color: <?php echo $title_styles['text-color']; ?>;
            <?php }
            if(isset($title_styles['font-size']) && $title_styles['font-size'] !=''){ ?>
            font-size: <?php echo $title_styles['font-size']; ?>px;
            <?php } ?>
        }

        .efaq-item-<?php echo $post_id; ?> .efaq-front-content {
            <?php if(isset($desc_styles['text-color']) && $desc_styles['text-color'] !=''){ ?>
            color: <?php echo $desc_styles['text-color']; ?>;
            <?php }
            if(isset($desc_styles['font-size']) && $desc_styles['font-size'] !=''){ ?>
            font-size: <?php echo $desc_styles['font-size']; ?>px;
            <?php } ?>
        }
    </style>

    <?php

} else {
    _e("The shortcode id that you have provided doesnot return any data. Please check the shortcode id that you have used.", "everest-faq-manager-lite");
}