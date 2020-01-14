jQuery(document).ready(function ($) {

    var EDITOR = $('.hidden-editor-container').contents();

    $all_section = $('.efaq-add-item-wrap');

    $('.efaq-shortcode-value').click(function () {
        $(this).select();
        $(this).focus();
        document.execCommand('copy');
        $(this).siblings('.efaq-copied-info').show().delay(1000).fadeOut();

    });

    //functions declarations
    //// random number generator
    function randomString(len, charSet) {
        charSet = charSet || 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var randomString = '';
        for (var i = 0; i < len; i++) {
            var randomPoz = Math.floor(Math.random() * charSet.length);
            randomString += charSet.substring(randomPoz, randomPoz + 1);
        }
        return randomString;
    }
    // init color picker for first time
    $('.efaq-color-picker').wpColorPicker();


    //display settings
    $div_select = $('.efaq-display-settings-wrap');

    $div_select.on('change', '.appts-img-selector', function () {
        var selected_tmp_img = $(this).find('option:selected').data('img');
        $(this).closest('.efaq-display-settings-wrap').find('.appts-img-selector-media img').attr('src', selected_tmp_img);
    });

    if($('.efaq-item-wrap').length >6){
      $('.efaq-add-button').prop('disabled', true);
    }

    $all_section.on('click', '.efaq-add-button', function (e) {
        var $this = $(this);
        $parent = $(this).closest('.efaq-main-wrap').find('.efaq-add-item-wrap');
        $action = $(this).data('action');
        add_new_div = $parent.find('.efaq-add-new-item');
        var num_item_faq = $('.efaq-item-wrap').length;
        if ($parent.find('.efaq-item-wrap').length <= 6) {
            if ($action == 'add_item') {
                $('.efaq-loader-image').show();

                $.ajax({
                    url: efaq_backend_ajax.ajax_url,
                    type: 'post',
                    data: {
                        action: 'efaq_backend_ajax',
                        _action: 'add_new_item_action',
                        efaq_nonce: efaq_backend_ajax.ajax_nonce
                    },
                    beforeSend: function() {
                      $this.prop('disabled', true);
                    },
                    success: function (response) {
                        add_new_div.append(response);
                        $('.efaq-loader-image').hide();
                        $('.efaq-color-picker').wpColorPicker();

                        var response = $(response);
                        var key = response.find('.efaq_key_unique').val();
                        var key1 = "efaq-html-text";
                        var key21 = "efaq-desc-content_"+key;

                        tinymce.execCommand( 'mceRemoveEditor', false, key1 );
                        tinymce.execCommand( 'mceAddEditor', false, key21 );
                        quicktags({id : key21});
                       //init tinymce
                       tinymce.init({
                         selector: key21,
                         formats:{
                       alignleft: [
                           {selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li', styles: {textAlign:'left'}},
                           {selector: 'img,table,dl.wp-caption', classes: 'alignleft'}
                       ],
                       aligncenter: [
                           {selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li', styles: {textAlign:'center'}},
                           {selector: 'img,table,dl.wp-caption', classes: 'aligncenter'}
                       ],
                       alignright: [
                           {selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li', styles: {textAlign:'right'}},
                           {selector: 'img,table,dl.wp-caption', classes: 'alignright'}
                       ],
                       strikethrough: {inline: 'del'}
                   },
                   relative_urls:false,
                   remove_script_host:false,
                   convert_urls:false,
                   browser_spellcheck:true,
                   fix_list_elements:true,
                   entities:"38,amp,60,lt,62,gt",
                   entity_encoding:"raw",
                   keep_styles:false,
                   paste_webkit_styles:"font-weight font-style color",
                   preview_styles:"font-family font-size font-weight font-style text-decoration text-transform",
                   wpeditimage_disable_captions:false,
                   wpeditimage_html5_captions:true,
                   plugins:"charmap,hr,media,paste,tabfocus,textcolor,fullscreen,wordpress,wpeditimage,wpgallery,wplink,wpdialogs,wpview",
                   // selector:"#" + fullId,
                   resize:"vertical",
                   menubar:false,
                   wpautop:true,
                   indent:false,
                   toolbar1:"bold,italic,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,link,unlink,wp_more,spellchecker,fullscreen,wp_adv",toolbar2:"formatselect,underline,alignjustify,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help",
                   toolbar3:"",
                   toolbar4:"",
                   tabfocus_elements:":prev,:next",
                   body_class:"id post-type-post post-status-publish post-format-standard",

                        });
                    $this.prop('disabled', false);
                    }
                });
            }
            e.preventDefault();
        } else {
            alert('Maximum FAQ addition reached.');
        }

    });

    $all_section.on('click', '.item_delete', function (e) {

        if (confirm($(this).data('confirm'))) {
            $(this).closest('.efaq-item-wrap').remove();
            if($('.efaq-item-wrap').length <=6 ){
              $('.efaq-add-button').prop('disabled', false);
            }
            e.preventDefault();
        } else {
            e.preventDefault();
        }
    });


    //sortable
    /** Sortable initialization */
    $('.efaq-add-new-item').sortable({
        items: '.efaq-item-wrap',
        containment: 'parent',
        handle: '.item_sort',
        tolerance: 'pointer',
        cursor: "move",
        update: function () {
        }
    });


    $all_section.on('click', '.efaq-item-header', function (e) {
        $(this).closest('.efaq-item-wrap-inner').find('.efaq-item-body').slideToggle();
        $(this).closest('.efaq-item-wrap-inner').find('.efaq-item-hide-show').toggleClass('active-item-show-hide');
    });

    $all_section.on('click', '.efaq-item-inner-header', function (e) {
        $(this).closest('.efaq-item-section-wrap').find('.efaq-item-inner-body').slideToggle();
        $(this).closest('.efaq-item-section-wrap').find('.efaq-item-section-hide-show').toggleClass( "active-item-section-show-hide");
    });

    $all_section.on('keyup', '.efaq_title_text', function (e) {
        $(this).closest('.efaq-item-wrap-inner').find('.efaq_title_text_disp').text($(this).val());
    });

});
