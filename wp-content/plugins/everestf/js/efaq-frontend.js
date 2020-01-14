jQuery(document).ready(function ($) {
    var $main_container = $('.efaq-front-main-container');
    $main_container.on('click', '.efaq-front-title-wrap', function (e) {
        $(this).closest('.efaq-front-wrap-inner').find('.efaq-front-content-wrap').slideToggle();
        if ($(this).parent().hasClass('efaq-tab-active'))
        {
            $(this).parent().removeClass('efaq-tab-active');
            $(this).find('.up-down-btn').removeClass('efaq-btn-active');
        } else
        {
            $(this).parent().addClass('efaq-tab-active');
            $(this).find('.up-down-btn').addClass('efaq-btn-active');
        }
 });

});