<?php
defined('ABSPATH') or die('No Scirpt Kiddies Please');
global $efaq_variables;

if (isset($key)) {
    $key = $key;
} else {
    $key = EFAQM_lite:: generateRandomIndex();
}
?>
<div class='efaq-item-wrap'>
    <input type="hidden" class='efaq_key_unique' name="efaq-unique-key" value="<?php echo $key; ?>" />
    <div class='efaq-item-wrap-inner' >
        <div class="efaq-item-header efaq-clearfix">
            <div class='efaq-item-header-title'> <span class="efaq_title_text_disp"><?php
                    if (isset($item['title']['content']) && $item['title']['content'] != '') {
                        echo esc_attr($item['title']['content']);
                    } else {
                        _e('Your Title Here', 'everest-faq-manager-lite');
                    }
                    ?></span>
            </div>
            <div class="item function">
                <span class="item_sort" style="cursor:move"> <i class="fa fa-arrows-alt"></i></span>
                <span data-confirm="return confirm('Do you really want to delete ?')" class="item_delete"><i class="fa fa-trash"></i></span>
                <span class='efaq-item-hide-show'><i class="fa fa-caret-down"></i></span>
            </div>
        </div>
        <div class='efaq-item-body efaq-clearfix' style='display:none; '>

            <div class='efaq-item-block-title efaq-item-section-wrap'>
                <div class="efaq-item-inner-header efaq-clearfix">
                    <span class="efaq-item-title"><?php _e('Title Settings', 'everest-faq-manager-lite'); ?></span>
                    <span class="efaq-item-section-hide-show"><i class="fa fa-caret-up"></i></span>
                </div>
                <div class="efaq-item-inner-body">
                    <div class='efaq-item'>
                        <label for="efaq-title-content_<?php echo $key; ?>"><?php _e('Title ', 'everest-faq-manager-lite'); ?></label>
                        <input type="text" class="efaq_title_text" id='efaq-title-content_<?php echo $key; ?>' name='item[<?php echo $key; ?>][title][content]' value='<?php
                        if (isset($item['title']['content']) && $item['title']['content'] != '') {
                            echo esc_attr($item['title']['content']);
                        }
                        ?>' />
                    </div>
                </div>
            </div>
            <div class='efaq-item-block-desc efaq-item-section-wrap'>
                <div class="efaq-item-inner-header efaq-clearfix">
                    <span class="efaq-item-desc"><?php _e('Content Settings', 'everest-faq-manager-lite'); ?></span>
                    <span class="efaq-item-section-hide-show"><i class="fa fa-caret-up"></i></span>
                </div>
                <div class="efaq-item-inner-body">
                    <div class='efaq-item'>
                        <?php
                        $content_editor = '';
                        if (isset($item['desc']['content']) && $item['desc']['content'] != '') {
                            $content_editor = ( $item['desc']['content'] );
                        }
                        ?>
                        <?php
                        $settings = array('media_buttons' => false, 'textarea_name' => 'item[' . $key . '][desc][content]', 'quicktags' => array('buttons' => 'strong,em,link,block,del,ins,img,ul,ol,li,code,close'), 'editor_class' => 'efaq-desc-content_' . $key);

                        $editor_name_id = 'efaq-desc-content_' . $key;
                        wp_editor($content_editor, $editor_name_id, $settings);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

