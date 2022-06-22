jQuery( function ( $ ) {
    var clonedBadgeContainer   = $( '.container-image-and-label' );

    $(document).ready(function () {
        $(clonedBadgeContainer).each(function () {
            var current_badge=$(this);
            $('.label-wrap', $(this).parent()).each(function () {
                //var label_wrap = $($(this)).attr('class');
                //console.log(label_wrap);
                //if(label_wrap.indexOf("rnd")!='-1') {
                    $($(this).detach()).appendTo(current_badge);
                //}
            });
        });
        /*flickity-slider remove badge*/
        /*var flickityBadgeContainer   = $( '.flickity-slider' );
        $(flickityBadgeContainer).find('.label-wrap').each(function () {
           $(this).remove();
        });*/
        /*woodmart owl-carousel*/
        /*if( $('body.single-product').length){
            var owlItem   = $( '.owl-item' );
            var contentWrapper =$('.woocommerce-product-gallery__wrapper.owl-carousel');
            setTimeout(function(){
                $(contentWrapper).find('.owl-item').each(function () {
                    if($(this).children('div').hasClass('label-wrap')) {
                        $(this).addClass('remove-item');
                    }
                    $('.label-wrap', $(this)).each(function () {
                        $($(this).detach()).appendTo(contentWrapper);

                    });
                });
                $(contentWrapper).find('.remove-item').remove();
            }, 700);
        }*/
    });
} );