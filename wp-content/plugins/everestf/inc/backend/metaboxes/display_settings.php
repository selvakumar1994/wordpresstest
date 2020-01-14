<?php
defined('ABSPATH') or die("No script kiddies please!");
global $efaq_variables;
global $post;
$post_id = $post->ID;

$efaq_data = get_post_meta($post_id, 'efaq_data', true);
$display_settings = isset($efaq_data['efaq_display_settings']) ? $efaq_data['efaq_display_settings'] : array();
?>

<div class="efaq-display-settings-wrap efaq-clearfix">
    <div class="efaq-tabs-header">
        <div class="efaq-tab efaq-template-selection" id='efaq-template-selection'>
            <label for="efaq-template-selection" class="efaq-template-selection-label"><?php _e('Template Selection', 'everest-faq-manager-lite'); ?></label>
            <div class="efaq-template-select-wrap">
                <select id='efaq-template-selection' name='efaq_display_settings[template-selection]' class="appts-img-selector">
                    <?php
                    $img_url = EFAQM_IMAGE_DIR . "/templates/template1.jpg";

                    foreach ($efaq_variables['templates'] as $key => $value) {
                        ?>
                        <option value="<?php echo esc_attr($value['value']); ?>" <?php if (isset($display_settings['template-selection']) && $display_settings['template-selection'] == $value['value']) { ?> selected <?php
                            $img_url = $value['img'];
                        }
                        ?> data-img="<?php echo esc_url($value['img']); ?>"><?php echo esc_attr($value['name']); ?></option>
                                <?php
                            }
                            ?>
                </select>

            </div>
            <div class="appts-img-selector-media">
                <img src="<?php echo esc_url($img_url); ?>" alt='template image' />
            </div>


        </div>
        <div class="efaq-tab efaq-tab-settings" id="efaq-tab-settings">
            <label for="efaq-tab-settion-selection" class="efaq-tab-setting-label"><?php _e('Tab Settings', 'everest-faq-manager-lite'); ?></label>
            <div class="efaq-tab-settings-wrap">
                
                <select id='efaq-tab-settion-selection' name='efaq_display_settings[tab-settings]' class="efaq-tab-selection">
                   <?php 
                    foreach($efaq_variables['tab_settings_store'] as $set_name=> $value_set) {?>
                    <option value="<?php echo esc_attr($value_set);?>" <?php if(isset($display_settings['tab-settings']) && ( $display_settings['tab-settings']) == $value_set ) { ?> selected <?php  } ?> > <?php echo esc_attr($set_name); ?></option>
                    <?php } ?>
                </select>

            </div>   
        </div>

        <div class="efaq-tab efaq-style-settings ec-style-label" id='efaq-style-settings'>
            <div class='efaq-title-styles'>
            <p><?php _e('Title styles', 'everest-faq-manager-lite'); ?></p>
                <div class="efaq-item">
                    <label for="efaq-title-font-size_<?php echo $key; ?>"><?php _e('Font size(px)', 'everest-faq-manager-lite'); ?></label>
                    <input id="efaq-title-font-size_<?php echo $key; ?>" type="number" step='0.01' name="efaq_display_settings[title][font-size]" value="<?php
                    if (isset($display_settings['title']['font-size']) && $display_settings['title']['font-size'] != ' ') {
                        echo esc_attr($display_settings['title']['font-size']);
                    }
                    ?>">
                </div>

                <div class="efaq-item">
                    <label for="efaq-title-text-color_<?php echo $key; ?>"><?php _e('Text color', 'everest-faq-manager-lite'); ?></label>
                    <input id="efaq-title-text-color_<?php echo $key; ?>" type="text" name="efaq_display_settings[title][text-color]" class='efaq-color-picker' data-alpha="true" value='<?php
                    if (isset($display_settings['title']['text-color']) && $display_settings['title']['text-color'] != '') {
                        echo esc_attr($display_settings['title']['text-color']);
                    }
                    ?>'>
                </div>
            </div>

            <div class='efaq-title-styles'>
                <p><?php _e('Content Styles', 'everest-faq-manager-lite'); ?></p>
                <div class="efaq-item">
                    <label for="efaq-title-font-size_<?php echo $key; ?>"><?php _e('Font size(px)', 'everest-faq-manager-lite'); ?></label>
                    <input id="efaq-title-font-size_<?php echo $key; ?>" type="number" step='0.01' name="efaq_display_settings[desc][font-size]" value="<?php
                    if (isset($display_settings['desc']['font-size']) && $display_settings['desc']['font-size'] != ' ') {
                        echo esc_attr($display_settings['desc']['font-size']);
                    }
                    ?>">
                </div>

                <div class="efaq-item">
                    <label for="efaq-title-text-color_<?php echo $key; ?>"><?php _e('Text color', 'everest-faq-manager-lite'); ?></label>
                    <input id="efaq-title-text-color_<?php echo $key; ?>" type="text" name="efaq_display_settings[desc][text-color]" class='efaq-color-picker' data-alpha="true" value='<?php
                    if (isset($display_settings['desc']['text-color']) && $display_settings['desc']['text-color'] != '') {
                        echo esc_attr($display_settings['desc']['text-color']);
                    }
                    ?>'>
                </div>
            </div>
            
        </div>
    </div>
</div>