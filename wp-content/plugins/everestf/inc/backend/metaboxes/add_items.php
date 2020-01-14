<?php
defined('ABSPATH') or die('No script kiddies Please');
global $post;
$post_id = $post->ID;
$efaq_data = get_post_meta($post_id, 'efaq_data', true);
//print_r($efaq_data);
//wp_nonce_field(basename(__FILE__), 'efaq_add_items_nonce');
wp_nonce_field( 'create-form-nonce', 'verify_nonce_name' );
//_e($post_id);
?>

<div  class="efaq-main-wrap">
    <div class="efaq-add-item-wrap">
        <input type="button" class="button-secondary efaq-add-button" value="<?php _e( 'Add FAQ Item', 'everest-faq-manager-lite' ); ?>" data-action='add_item'>
        <span class="efaq-loader-image" style="display: none;"><img src='<?php echo EFAQM_IMAGE_DIR.'/efaq-preloader.gif'; ?>' alt='Loading...'/></span>
        <div class="efaq-add-new-item">
          
            <?php 
                if(isset($efaq_data['item'])){
                    $item_count = count($efaq_data['item']);
                    if($item_count!=0)
                    {
                        $counter = 1;
                        $faq_item = $efaq_data['item'];
                        foreach( $faq_item as $key=>$item ) {
                        include EFAQML_PLUGIN_PATH.'inc/backend/metaboxes/item.php';
                    }
                    }
                }
                else
                {
                    $column_index   = EFAQM_lite :: generateRandomIndex();
                    $key          = $column_index;
                     $counter = 1;
                    include EFAQML_PLUGIN_PATH.'inc/backend/metaboxes/item.php'; 
                }
            ?>
        </div>
    </div>
</div>


