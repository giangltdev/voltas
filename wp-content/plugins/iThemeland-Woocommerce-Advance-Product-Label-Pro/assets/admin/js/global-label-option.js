jQuery(function ($) {
    var type = $('#unique_global_label_type'),
        preview_bg = $(".preview_image"),
        preview_bg_top = preview_bg.offset().top - 60,
        input_type = $("#unique_global_label_type"),
        input_shape = $('.itbd-text-design:checked'),
        input_style = $('.itbd-text-design-style:checked'),
        input_image_url = $("#unique_global_label_image"),
        anchor_point = 'top-left',
        half_left = $(".it_column_setting"),
        half_right = $(".it_column_preview"),
        preview_bg_content_bottom = half_right.offset().top + half_right.outerHeight(),
        input_txt_color = $("#unique-custom-text"),
        input_text = $("#unique_global_label_text"),
        show_icon= $('#unique_global_label_show_icon'),
        badge_icon = $("#unique_global_label_badge_icon"),
        input_bg_color = $("#unique-custom-background"),
        input_width = $("#unique_global_label_width"),
        input_height = $("#unique_global_label_height"),
        input_border_style = $("#unique_global_label_border_style"),
        input_border_width_t = $("#unique_global_label_border_width_top"),
        input_border_width_l = $("#unique_global_label_border_width_left"),
        input_border_width_b = $("#unique_global_label_border_width_bottom"),
        input_border_width_r = $("#unique_global_label_border_width_right"),
        input_border_color = $("#unique_global_label_border_color"),
        input_border_tl = $("#unique_global_label_border_r_tl"),
        input_border_tr = $("#unique_global_label_border_r_tr"),
        input_border_br = $("#unique_global_label_border_r_br"),
        input_border_bl = $("#unique_global_label_border_r_bl"),
        input_padding_t = $("#unique_global_label_padding_top"),
        input_padding_l = $("#unique_global_label_padding_left"),
        input_padding_b = $("#unique_global_label_padding_bottom"),
        input_padding_r = $("#unique_global_label_padding_right"),
        input_font_size = $("#unique_global_label_font_size"),
        input_line_height = $("#unique_global_label_line_height"),
        input_opacity = $("#unique_global_label_opacity"),
        input_rotation_x = $("#unique_global_label_rotation_x"),
        input_rotation_y = $("#unique_global_label_rotation_y"),
        input_rotation_z = $("#unique_global_label_rotation_z"),
        pos_top = $("#unique_global_label_pos_top"),
        pos_bottom = $("#unique_global_label_pos_bottom"),
        pos_left = $("#unique_global_label_pos_left"),
        pos_right = $("#unique_global_label_pos_right"),
        pos_top_left = $('#unique-pos-top-left'),
        pos_top_center = $('#unique-pos-top-center'),
        pos_top_right = $('#unique-pos-top-right'),
        pos_bottom_left = $('#unique-pos-bottom-left'),
        pos_bottom_center = $('#unique-pos-bottom-center'),
        pos_bottom_right = $('#unique-pos-bottom-right'),
        pos_left_center = $('#unique-pos-center-left'),
        pos_right_center = $('#unique-pos-center-right'),
        pos_center = $('#unique-pos-center'),
        flip_text_horizontally = $('#unique_global_label_flip_text_h'),
        flip_text_vertically = $('#unique_global_label_flip_text_v'),
        show_desc= $('#unique_global_label_show_desc'),
        show_desc_form= $('#unique_global_label_show_desc_form'),
        show_watermark= $('#unique_global_label_show_watermark'),
/*
        show_watermark_align= $('#unique_global_label_show_watermark_align'),
*/
        tooltip_theme= $('#unique_global_label_tooltip_theme'),
        tooltip_animation= $('#unique_global_label_tooltip_animation'),
        animation_duration= $('#unique_global_label_animation_duration'),
        tooltip_position= $('#unique_global_label_tooltip_position'),
        tooltip_table_position= $('#table_setting_position'),
        tooltip_delay= $('#unique_global_label_tooltip_delay'),
        tooltip_distance= $('#unique_global_label_tooltip_distance'),
        tooltip_max_width= $('#unique_global_label_tooltip_max_width'),
        tooltip_open_on= $('#unique_global_label_tooltip_open_on'),
/*
        tooltip_close_on_click= $('#unique_global_label_tooltip_close_on_click'),
*/
        tooltip_use_arrow= $('#unique_global_label_tooltip_use_arrow'),

        preview_badge = $('.label-wrap'),
        preview_badge_label = $('.label-wrap .product-label'),
        positioning_render = function () {
            var p_top = ( $.isNumeric(pos_top.val()) ) ? pos_top.val() + 'px' : pos_top.val(),
                p_bottom = ( $.isNumeric(pos_bottom.val()) ) ? pos_bottom.val() + 'px' : pos_bottom.val(),
                p_left = ( $.isNumeric(pos_left.val()) ) ? pos_left.val() + 'px' : pos_left.val(),
                p_right = ( $.isNumeric(pos_right.val()) ) ? pos_right.val() + 'px' : pos_right.val();

            if (p_top.substr(0, 8) == 'calc(50%') {
                p_top = 'calc(50% - ' + preview_badge.outerHeight() / 2 + 'px)';
                pos_top.val(p_top);
            }

            if (p_left.substr(0, 8) == 'calc(50%') {
                p_left = 'calc(50% - ' + preview_badge.outerWidth() / 2 + 'px)';
                pos_left.val(p_left);
            }

            preview_badge.css({
                'top': p_top,
                'bottom': p_bottom,
                'left': p_left,
                'right': p_right,
                'opacity': input_opacity.val() / 100
            });


            var rotation = 'rotateX(' + parseInt(input_rotation_x.val()) + 'deg) ' + 'rotateY(' + parseInt(input_rotation_y.val()) + 'deg) ' + 'rotateZ(' + parseInt(input_rotation_z.val()) + 'deg)';
            preview_badge.css({'transform': rotation, '-ms-transform': rotation, '-webkit-transform': rotation});


            var flip_text = '';
            flip_text += flip_text_horizontally.is(':checked') ? ' scaleX(-1)' : '';
            flip_text += flip_text_vertically.is(':checked') ? ' scaleY(-1)' : '';

            if(show_desc.is(':checked')){
                show_desc_form.parent().slideDown('fast');
            }else{
                show_desc_form.parent().slideUp('fast');
            }
            if(show_desc.is(':checked') && (show_desc_form.val()=='click' || show_desc_form.val()=='tab') ) {
                show_watermark.parent().slideDown('fast');
            }else{
                show_watermark.parent().slideUp('fast');
            }
            if(show_desc.is(':checked') && show_desc_form.val()=='tooltip' ) {
                tooltip_theme.parent().slideDown('fast');
                tooltip_animation.parent().slideDown('fast');
                tooltip_position.parent().slideDown('fast');
                tooltip_table_position.slideDown('fast');
                tooltip_delay.parent().slideDown('fast');
                tooltip_distance.parent().slideDown('fast');
                tooltip_max_width.parent().slideDown('fast');
                animation_duration.parent().slideDown('fast');
                tooltip_open_on.parent().slideDown('fast');
/*
                tooltip_close_on_click.parent().slideDown('fast');
*/
                tooltip_use_arrow.parent().slideDown('fast');
                /*
                 * Checked button to enable tooltip
                 */
                preview_badge.addClass('ittooltipster');
                preview_badge.attr("onmouseover", "title='';");
/*
                $('.ittooltipster').tooltipster({
                    animation: 'fade',
                    theme: 'tooltipster-noir',
                    contentCloning: true,
/!*
                    contentAsHTML:true,
*!/
/!*
                    trackTooltip:true,
                    trackOrigin:false,
*!/

                });
*/

                //confirm($('#content').val());
                var content = $('#content').val();
                // $(".ittooltipster").attr('title', content);
                // $('.ittooltipster').tooltipster({
                // });
                //$('.ittooltipster').tooltipster("destroy");
                var open_click=(tooltip_open_on.val() == 'click') ? 'click':'hover';
                var mouse_enter=(tooltip_open_on.val() == 'mouseenter') ? 'hover':'false';

                    console.log(open_click+"side:"+open_click+"["+tooltip_open_on.val()+"]"+","+"arrow:"+tooltip_use_arrow.prop('checked')+","+"theme:"+tooltip_theme.val()+",");
                $('.ittooltipster').attr("title", content).tooltipster({
                    contentAsHTML:true,
                    interactive:true,
                    animation:tooltip_animation.val(),
                    animationDuration:parseInt(animation_duration.val()),
                    theme:'tooltipster-'+tooltip_theme.val(),
                    delay:parseInt(tooltip_delay.val()),
                    arrow:tooltip_use_arrow.prop('checked'),
                    distance:parseInt(tooltip_distance.val()),
                    maxWidth: parseInt(tooltip_max_width.val()),
/*
                    side:"["+tooltip_position.val()+"]",
*/
                    contentCloning: true,
                    trigger: open_click,
/*
                    triggerOpen: {
                        click: open_click,
                        tap: open_click,


                        //mouse
                        mouseenter: mouse_enter,
                        touchstart: mouse_enter,
                    },
                    triggerClose: {
                        click: open_click,
                        tap: open_click,
                        //mouse
                        mouseleave: mouse_enter,
                        originClick: mouse_enter,
                        touchleave: mouse_enter,
                    },
*/
                });
                //$('.ittooltipster').tooltipster("reposition");
                //$('.ittooltipster').tooltipster("geometry");

/*
                $(".content").keyup(function() {
                    $('.ittooltipster').tooltipster("destroy");
                    $('.ittooltipster').attr("title", $(this).val()).tooltipster({
                    });
                });
*/

            }else{
                tooltip_theme.parent().slideUp('fast');
                tooltip_animation.parent().slideUp('fast');
                tooltip_position.parent().slideUp('fast');
                tooltip_table_position.slideUp('fast');
                tooltip_delay.parent().slideUp('fast');
                tooltip_distance.parent().slideUp('fast');
                tooltip_max_width.parent().slideUp('fast');
                animation_duration.parent().slideUp('fast');
                tooltip_open_on.parent().slideUp('fast');
/*
                tooltip_close_on_click.parent().slideUp('fast');
*/
                tooltip_use_arrow.parent().slideUp('fast');
            }
/*
            if(show_desc.is(':checked') && show_desc_form.val()=='click' && show_watermark.is(':checked') ) {
                show_watermark_align.parent().slideDown('fast');
            }else{
                show_watermark_align.parent().slideUp('fast');
            }
*/

            //show_watermark.is(':checked') ? show_watermark_align.parent().slideDown('fast') : show_watermark_align.parent().slideUp('fast');

            preview_badge.find('.unique-label-text').css({
                'transform': flip_text,
                '-ms-transform': flip_text,
                '-webkit-transform': flip_text
            });

            if(show_icon.is(':checked')){
                badge_icon.parent().slideDown('fast');
            }else{
                badge_icon.parent().slideUp('fast');
            }

        },
        preview_render = function () {

            var content = $('#content').val();
            var open_click=(tooltip_open_on.val() == 'click') ? 'click':'hover';
            var mouse_enter=(tooltip_open_on.val() == 'mouseenter') ? 'true':'false';
            $('.ittooltipster').tooltipster("destroy");
            $('.ittooltipster').attr("title", content).tooltipster({
                contentAsHTML:true,
                interactive:true,
                animation:tooltip_animation.val(),
                animationDuration:parseInt(animation_duration.val()),
                theme:'tooltipster-'+tooltip_theme.val(),
                delay:parseInt(tooltip_delay.val()),
                arrow:tooltip_use_arrow.prop('checked'),
                distance:parseInt(tooltip_distance.val()),
                maxWidth: parseInt(tooltip_max_width.val()),
                /*
                                    side:"["+tooltip_position.val()+"]",
                */
                contentCloning: true,
                trigger: open_click,
/*
                triggerOpen: {
                    click: open_click,
                    tap: open_click,
                    //mouse
/!*
                    mouseenter: mouse_enter,
                    touchstart: mouse_enter,
*!/
                },
                triggerClose: {
                    click: open_click,
                    tap: open_click,
                    //mouse
/!*
                    mouseleave: mouse_enter,
                    originClick: mouse_enter,
                    touchleave: mouse_enter,
*!/
                },
*/

            });

            switch (input_type.val()) {
                case 'label':
                    preview_badge_label.removeAttr("style");
                    if(show_icon.is(':checked')){
                        it_icon_badge_preview();
                    }else{
                        $('.unique-label-text').html(input_text.val());
                    }


                    var _width = input_width.val() != 'auto' ? input_width.val() + 'px' : 'auto';
                    var _height = input_height.val() != 'auto' ? input_height.val() + 'px' : 'auto';
                    preview_badge.css({

                        "color": input_txt_color.val(),
                        "background-color": input_bg_color.val(),
                        "width": _width,
                        "height": _height,
                        "border-style": input_border_style.val(),
                        "border-top-width": input_border_width_t.val() + "px",
                        "border-right-width": input_border_width_r.val() + "px",
                        "border-bottom-width": input_border_width_b.val() + "px",
                        "border-left-width": input_border_width_l.val() + "px",
                        "border-color": input_border_color.val(),
                        "border-top-left-radius": input_border_tl.val() + "px",
                        "border-top-right-radius": input_border_tr.val() + "px",
                        "border-bottom-right-radius": input_border_br.val() + "px",
                        "border-bottom-left-radius": input_border_bl.val() + "px",
                        "padding-top": input_padding_t.val() + "px",
                        "padding-left": input_padding_l.val() + "px",
                        "padding-bottom": input_padding_b.val() + "px",
                        "padding-right": input_padding_r.val() + "px",
                        "font-size": input_font_size.val() + "px"

                    });

                    var line_height = input_line_height.val();
                    if (line_height != -1) {
                        preview_badge.css("line-height", line_height + "px");
                    } else {
                        if ('auto' === _height) {
                            preview_badge.css("line-height", input_font_size.val() + "px");
                        } else {
                            preview_badge.css("line-height", _height);
                        }
                    }
                    positioning_render();
                    break;
                case 'flash':
                    preview_badge.removeAttr("style");
                    preview_badge_label.removeAttr("style");

                    if(show_icon.is(':checked')){
                        it_icon_badge_preview();
                    }else{
                        $('.unique-label-text').html(input_text.val());
                    }
                    preview_badge_label.css({

                        "color": input_txt_color.val(),

                    });

                    switch ($('.itbd-text-design:checked').val()) {
                        case 'cut-diamond':
                            preview_badge_label.css({
                                "border-bottom-color": input_bg_color.val(),
                            });
                            if ($('#myStyle').length > 0) {
                                // it exists
                                $('#myStyle').remove();
                            }
                            $("<style id='myStyle' type='text/css'> .label-wrap .product-label:after{  border-top-color:" + input_bg_color.val() + "!important} </style>").appendTo("head");

                            break;
                        case 'round-star':
                            preview_badge_label.css({
                                "background-color": input_bg_color.val(),
                            });
                            if ($('#myStyle').length > 0) {
                                // it exists
                                $('#myStyle').remove();
                            }
                            $("<style id='myStyle' type='text/css'> .label-wrap .product-label:after,.label-wrap .product-label:before{  background-color:" + input_bg_color.val() + "} </style>").appendTo("head");

                            break;
                        case 'ribbon':
                            preview_badge_label.css({
                                "border-color": input_bg_color.val(),
                                "border-bottom-color": "rgba(0,0,0,0)"
                            });
                            break;
                        case 'circle-ribbon':
                            preview_badge_label.css({
                                "background-color": input_bg_color.val(),
                            });
                            if ($('#myStyle').length > 0) {
                                // it exists
                                $('#myStyle').remove();
                            }
                            $("<style id='myStyle' type='text/css'> .label-wrap .product-label::after,.label-wrap .product-label::before{  border-bottom-color:" + input_bg_color.val() + "!important;} </style>").appendTo("head");

                            break;
                        case 'diamond':
                            preview_badge_label.css({
                                "background-color": input_bg_color.val(),
                            });
                            break;
                        case 'triangle-topleft':
                            preview_badge_label.css({
                                "border-top-color": input_bg_color.val(),
                            });
                            break;
                        case 'triangle-topright':
                            preview_badge_label.css({
                                "border-top-color": input_bg_color.val(),
                            });
                            break;
                        case 'loophole-1':
                            preview_badge_label.css({
                                "background-color": input_bg_color.val(),
                            });
                            if ($('#myStyle').length > 0) {
                                // it exists
                                $('#myStyle').remove();
                            }
                            $("<style id='myStyle' type='text/css'> .label-wrap .product-label:after,.label-wrap .product-label:before{  background-color:" + input_bg_color.val() + ";border-right-color:" + input_bg_color.val() + "} </style>").appendTo("head");

                            break;
                        case 'loophole-2':
                            preview_badge_label.css({
                                "background-color": input_bg_color.val(),
                            });
                            if ($('#myStyle').length > 0) {
                                // it exists
                                $('#myStyle').remove();
                            }
                            $("<style id='myStyle' type='text/css'> .label-wrap .product-label:after,.label-wrap .product-label:before{  background-color:" + input_bg_color.val() + ";border-right-color:" + input_bg_color.val() + "} </style>").appendTo("head");

                            break;
                        case 'loophole-3':
                            preview_badge_label.css({
                                "background-color": input_bg_color.val(),
                            });
                            if ($('#myStyle').length > 0) {
                                // it exists
                                $('#myStyle').remove();
                            }
                            $("<style id='myStyle' type='text/css'> .label-wrap .product-label:before{  border-right-color:" + input_bg_color.val() + "!important} </style>").appendTo("head");

                            break;
                        case 'loophole-4':
                            preview_badge_label.css({
                                "background-color": input_bg_color.val(),
                            });
                            if ($('#myStyle').length > 0) {
                                // it exists
                                $('#myStyle').remove();
                            }
                            $("<style id='myStyle' type='text/css'> .label-wrap .product-label:before{  border-right-color:" + input_bg_color.val() + "!important} </style>").appendTo("head");

                            break;
                        case 'heart':
                            if ($('#myStyle').length > 0) {
                                // it exists
                                $('#myStyle').remove();
                            }
                            $("<style id='myStyle' type='text/css'> .label-wrap .product-label:after,.label-wrap .product-label:before{  background-color:" + input_bg_color.val() + "} </style>").appendTo("head");

                            break;
                        case 'loophole-5':
                            preview_badge_label.css({
                                "background-color": input_bg_color.val(),
                            });
                            if ($('#myStyle').length > 0) {
                                // it exists
                                $('#myStyle').remove();
                            }
                            $("<style id='myStyle' type='text/css'> .label-wrap .product-label:before{  border-right-color:" + input_bg_color.val() + "!important} </style>").appendTo("head");

                            break;
                        case 'corner-ribbons':
                            preview_badge_label.css({
                                "background-color": input_bg_color.val(),
                            });
                            if ($('#myStyle').length > 0) {
                                // it exists
                                $('#myStyle').remove();
                            }
                            $("<style id='myStyle' type='text/css'> .label-wrap .product-label:before{  border-right-color:" + input_bg_color.val() + "!important} </style>").appendTo("head");

                            break;
                            case 'corner-ribbons-two':
                            preview_badge_label.css({
                                "background-color": input_bg_color.val(),
                            });
                            if ($('#myStyle').length > 0) {
                                // it exists
                                $('#myStyle').remove();
                            }

                            break;
                    }
                    positioning_render();
                    break;
                case 'image':
                    preview_badge_label.removeAttr("style");
                    $(".product-label").html('');
                    $(".product-label").wrapInner('<img class="custom_label_pic" style="width: auto;" src="' + input_image_url.val() + '"/>');
                    positioning_render();
                    break;
                case 'count-down':
                    preview_badge_label.removeAttr("style");
                    preview_badge.removeAttr("style");

                    if(show_icon.is(':checked')){
                        it_icon_badge_preview();
                    }else{
                        $('.unique-label-text').html(input_text.val());
                    }
                    /*for append clock after save label*/
                    var fullDate = new Date();
                    var timeToSeconds = fullDate.getTime() / 1000;
                    fullDate.setDate(fullDate.getDate() + 31);
                    var twoDigitMonth = (fullDate.getMonth() + 1) + "";
                    if (twoDigitMonth.length == 1) twoDigitMonth = "0" + twoDigitMonth;
                    var twoDigitDate = fullDate.getDate() + "";
                    if (twoDigitDate.length == 1) twoDigitDate = "0" + twoDigitDate;
                    var currentDate = fullDate.getFullYear() + "/" + twoDigitMonth + "/" + twoDigitDate;
                    timeToSeconds = (fullDate.getTime() / 1000) - timeToSeconds;
                    if ($('.itbd-text-design-style:checked').val() == 'style-6' || $('.itbd-text-design-style:checked').val() == 'style-7' || $('.itbd-text-design-style:checked').val() == 'style-8') {
                        // Flip Clock
                        var clock;
                        $(document).ready(function () {
                            var clock;

                            clock = $('.unique-label-id-' + $('#post_ID').val() + ' #clock').FlipClock({
                                clockFace: 'DailyCounter',
                                autoStart: false,
                            });

                            clock.setTime(timeToSeconds);
                            clock.setCountdown(true);
                            clock.start();

                        });

                    } else {
                        //clock
                        jQuery(".unique-label-id-" + $('#post_ID').val() + " #clock").countdown(currentDate, function (event) {
                            jQuery(this).html(event.strftime('%D days %H:%M:%S'));
                        });

                    }
                    /*end after save label*/

/*
                    console.log($('#post_ID').val());
*/
                    preview_badge_label.css({

                        "color": input_txt_color.val(),

                    });
                    switch ($('.itbd-text-design-style:checked').val()) {
                        case 'style-1':
                            $('.unique-count-1').css({
                                "background": "linear-gradient(to bottom right, #00000000 0%, " + input_bg_color.val() + " 100%)",
                            });
                            break;
                        case 'style-2':
                            $('.unique-count-2').css({
                                "background": "linear-gradient(to bottom, #00000000 0%, " + input_bg_color.val() + " 85%)",
                            });

                            if ($('#myStyle').length > 0) {
                                // it exists
                                $('#myStyle').remove();
                            }
                            $("<style id='myStyle' type='text/css'> .label-wrap .product-label .unique-count-2:after{  border-top-color:" + input_bg_color.val() + "!important} </style>").appendTo("head");

                            break;
                        case 'style-3':
                            preview_badge_label.css({
                                "background-color": input_bg_color.val(),
                            });
                            break;
                        case 'style-4':
                            $('.unique-pin').css({
                                "background": "linear-gradient(to bottom, #00000000 5%, " + input_bg_color.val() + " 85%)",
                            });
                            if ($('#myStyle').length > 0) {
                                // it exists
                                $('#myStyle').remove();
                            }
                            $("<style id='myStyle' type='text/css'> .label-wrap .product-label .unique-pin:after{  border-top-color:" + input_bg_color.val() + "!important} </style>").appendTo("head");

                            break;
                        case 'style-5':
                            $('.unique-circle-label').css({
                                "background": "linear-gradient(to bottom, #00000000 5%, " + input_bg_color.val() + " 85%)",
                            });

                            break;
                        case 'style-6':
                            preview_badge_label.css({
                                "background-color": input_bg_color.val(),
                            });
                            break;
                        case 'style-7':
                            preview_badge_label.css({
                                "background-color": input_bg_color.val(),
                            });
                            break;
                        case 'style-8':
                            $('.unique-day-background').css({
                                "border-color": input_bg_color.val(),
                            });
                            break;
                    }

                    positioning_render();
                    break;

                default:
                    // TEXT
                    positioning_render();
            }
        };

    preview_render();

    $(document).on('change paste keyup input focus', '#unique_global_label_rotation_x, #unique_global_label_rotation_y, #unique_global_label_rotation_z, #unique_global_label_flip_text_h, #unique_global_label_flip_text_v', function () {
        positioning_render();
    });

    $("input.update-preview").on("change paste keyup input focus", function () {
        preview_render();
    });

    $("select.update-preview").on("change paste keyup input focus", function () {
        preview_render();
    });

    $('.iris-palette').on('click', function () {
        setTimeout(preview_render, 1);
    });

    $('.wp-color-result').on('click focus', function () {
        setTimeout(preview_render, 1);
    });


    $('.iris-square-value').on('focus focusout mousedown mouseup', function () {
        setTimeout(preview_render, 1);
    });

    $('.wp-picker-clear').on('click', function () {
        setTimeout(preview_render, 1);
    });

    //scrolling Preview
    $(window).scroll(function () {
        if ($(window).scrollTop() > preview_bg_top) {
            //console.log($( window ).scrollTop());
            //console.log(preview_bg_content_bottom);
            var temp_offset_bg = preview_bg.offset().top + preview_bg.outerHeight();
            if (preview_bg_content_bottom > ($(window).scrollTop() - 60) && (temp_offset_bg) < preview_bg_content_bottom) {
                var top_bg = $(window).scrollTop() - preview_bg_top;
                preview_bg.stop().animate({
                    top: top_bg + 'px'
                }, 0);
            }
        } else {
            preview_bg.stop().animate({
                top: '0'
            }, 0);
        }
    });


    preview_badge.draggable({
        containment: ".it_column_preview",
        stop: function () {
            var offset = $(this).position(),
                _x = parseInt(offset.left),
                _y = parseInt(offset.top),
                width = preview_badge.outerWidth(),
                height = preview_badge.outerHeight();

            if (anchor_point == 'top-left') {
                pos_top.val(_y);
                pos_bottom.val('auto');
                pos_left.val(_x);
                pos_right.val('auto');
            } else if (anchor_point == 'top-right') {
                pos_top.val(_y);
                pos_bottom.val('auto');
                pos_left.val('auto');
                pos_right.val(150 - _x - width);
            } else if (anchor_point == 'bottom-left') {
                pos_top.val('auto');
                pos_bottom.val(150 - _y - height);
                pos_left.val(_x);
                pos_right.val('auto');
            } else if (anchor_point == 'bottom-right') {
                pos_top.val('auto');
                pos_bottom.val(150 - _y - height);
                pos_left.val('auto');
                pos_right.val(150 - _x - width);
            }
        },
        grid: [1, 1],

        drag: function () {
            var offset = $(this).position(),
                _x = parseInt(offset.left),
                _y = parseInt(offset.top),
                width = preview_badge.outerWidth(),
                height = preview_badge.outerHeight();
            if (anchor_point == 'top-left') {
                pos_top.val(_y);
                pos_bottom.val('auto');
                pos_left.val(_x);
                pos_right.val('auto');
            } else if (anchor_point == 'top-right') {
                pos_top.val(_y);
                pos_bottom.val('auto');
                pos_left.val('auto');
                pos_right.val(150 - _x - width);
            } else if (anchor_point == 'bottom-left') {
                pos_top.val('auto');
                pos_bottom.val(150 - _y - height);
                pos_left.val(_x);
                pos_right.val('auto');
            } else if (anchor_point == 'bottom-right') {
                pos_top.val('auto');
                pos_bottom.val(150 - _y - height);
                pos_left.val('auto');
                pos_right.val(150 - _x - width);
            }

        }
    });


    // Positioning Buttons Actions
    pos_top_center.on('click', function () {
        pos_top.val('0');
        pos_bottom.val('auto');
        pos_left.val('calc(50% - ' + preview_badge.outerWidth() / 2 + 'px)');
        pos_right.val('auto');
        preview_render();
    });
    pos_bottom_center.on('click', function () {
        pos_top.val('auto');
        pos_bottom.val('0');
        pos_left.val('calc(50% - ' + preview_badge.outerWidth() / 2 + 'px)');
        pos_right.val('auto');
        preview_render();
    });
    pos_left_center.on('click', function () {
        pos_top.val('calc(50% - ' + preview_badge.outerHeight() / 2 + 'px)');
        pos_bottom.val('auto');
        pos_left.val('0');
        pos_right.val('auto');
        preview_render();
    });
    pos_right_center.on('click', function () {
        pos_top.val('calc(50% - ' + preview_badge.outerHeight() / 2 + 'px)');
        pos_bottom.val('auto');
        pos_left.val('auto');
        pos_right.val('0');
        preview_render();
    });
    pos_center.on('click', function () {
        pos_top.val('calc(50% - ' + preview_badge.outerHeight() / 2 + 'px)');
        pos_bottom.val('auto');
        pos_left.val('calc(50% - ' + preview_badge.outerWidth() / 2 + 'px)');
        pos_right.val('auto');
        preview_render();
    });
    pos_top_left.on('click', function () {
        pos_top.val(0);
        pos_bottom.val('auto');
        pos_left.val(0);
        pos_right.val('auto');
        anchor_point = 'top-left';
        preview_render();
    });
    pos_top_right.on('click', function () {
        pos_top.val(0);
        pos_bottom.val('auto');
        pos_left.val('auto');
        pos_right.val(0);
        anchor_point = 'top-right';
        preview_render();
    });
    pos_bottom_left.on('click', function () {
        pos_top.val('auto');
        pos_bottom.val(0);
        pos_left.val(0);
        pos_right.val('auto');
        anchor_point = 'bottom-left';
        preview_render();
    });
    pos_bottom_right.on('click', function () {
        pos_top.val('auto');
        pos_bottom.val(0);
        pos_left.val('auto');
        pos_right.val(0);
        anchor_point = 'bottom-right';
        preview_render();
    });

    // Datepicker fields
    $('.schedule-datepicker').datepicker({
        defaultDate: '',
        dateFormat: 'yy-mm-dd',
        numberOfMonths: 1,
        showButtonPanel: true,
    });


    // Background color picker
    $('#unique-custom-background.color-picker').wpColorPicker({
        palettes: ['#D9534F', '#3498db', '#39A539', '#ffe312', '#ffA608', '#999', '#444', '#fff'],
        color: '#D9534F',
        //palettes: false,
        change: function (event, ui) {
            if ($('#unique_global_label_type').val() == 'label') {
                $('.label-wrap .product-label').css({'background-color': ui.color.toString()});
                //jQuery( '.label-wrap' ).prev( 'style' ).html( '.label-wrap .product-label:after { border-color: ' + ui.color.toString() + '; }' );
            }
            if ($('#unique_global_label_type').val() == 'flash' && $('.itbd-text-design:checked').val() == 'cut-diamond') {
                $('.label-wrap .product-label').css({'border-bottom-color': ui.color.toString()});
                jQuery('.label-wrap').prev('style').html('.label-wrap .product-label:after { border-top-color: ' + ui.color.toString() + '; }');
            }
        },
    });
    $('#unique-custom-text.color-picker').wpColorPicker({
        palettes: ['#D9534F', '#3498db', '#39A539', '#ffe312', '#ffA608', '#999', '#444', '#fff'],
        color: '#fff',
        //palettes: false,
        change: function (event, ui) {
            $('.label-wrap .product-label').css({'color': ui.color.toString() + "!important"});
        },
    });


    /***********import code from it-woocommerce-advanced-product-labels-pro****************/

    // Update preview Global
    jQuery('#unique_settings').on('change keyup', 'input, select', function () {

        var data = {
            type: jQuery('#unique_global_label_type').val(),
            shape: jQuery('.itbd-text-design:checked').val(),
            style: jQuery('.itbd-text-design-style:checked').val(),
            text: jQuery('#unique_global_label_text').val(),
            align: jQuery('#unique_global_label_align').val(),
            image: jQuery('#unique_global_label_image').val(),
            class: jQuery('#unique_global_label_class').val(),
        };

        if (data.type == 'flash') {
            $('.label-wrap').removeClass().addClass('unique-label-id-' + $('#post_ID').val() + ' label-wrap unique-' + data.type + ' unique-shape-' + data.shape + " " + data.class);
            $('.product-label').html($('<div/>').addClass('unique-label-text').html(data.text));
        }
        if (data.type == 'label') {
            $('.label-wrap').removeClass().addClass('unique-label-id-' + $('#post_ID').val() + ' label-wrap unique-' + data.type + ' label-' + data.style + ' unique-align' + data.align + " " + data.class);
            $('.product-label').html($('<div/>').addClass('unique-label-text').html(data.text));
        }
        if ('count-down' == data.type) {
            $('.label-wrap').removeClass().addClass('unique-label-id-' + $('#post_ID').val() + ' label-wrap unique-' + data.type + ' unique-' + data.style + " " + data.class);
            $('.product-label').html($('<div/>').addClass('unique-label-text').html(data.text));
            $('.product-label').append("<div id='clock' class='ribbon-clock'></div>");

            if (data.style == 'style-1') {
                /*style 1*/
                $('.product-label').append('<div class="unique-count-1"><div class="circle"></div></div>');
            }
            if (data.style == 'style-2') {
                /*style 2*/
                $('.product-label').append('<div class="unique-count-2"></div>');
            }
            if (data.style == 'style-4') {
                /*style 2*/
                $('.product-label').append('<div class="unique-pin"></div>');
            }
            if (data.style == 'style-5') {
                /*style 2*/
                $('.product-label').append('<div class="unique-circle-label"></div>');
            }
            if (data.style == 'style-6') {
                /*style 2*/
                $('.product-label').append('<div class="unique-clear-background"></div>');
            }
            if (data.style == 'style-7') {
                /*style 2*/
                $('.product-label').append('<div class="unique-clock-background"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="50px" height="50px" x="0px" y="0px"viewBox="0 0 612 612" style="enable-background:new 0 0 612 612;" xml:space="preserve"><g><path d="M306,0.006C137,0.006,0,137,0,306s137,305.994,306,305.994C474.994,611.994,612,475,612,306S474.994,0.006,306,0.006zM306,550.795C171.02,550.795,61.205,440.98,61.205,306S171.02,61.205,306,61.205S550.795,171.02,550.795,306S440.98,550.795,306,550.795z"/><path d="M471.524,186.754c-3.898-5.532-11.536-6.848-17.068-2.95l-134.594,94.95c-4.168-2.13-8.868-3.348-13.862-3.348c-2.313,0-4.553,0.282-6.72,0.765l-96.345-81.982c-5.147-4.388-12.864-3.764-17.258,1.389l-7.925,9.314c-4.388,5.147-3.764,12.87,1.383,17.258l96.357,82c-0.037,0.618-0.092,1.23-0.092,1.854c0,15.483,11.573,28.292,26.524,30.293V510h8.164V336.293c14.945-2.007,26.517-14.81,26.517-30.293c0-1.328-0.116-2.625-0.282-3.911l134.601-94.95c5.526-3.898,6.848-11.536,2.95-17.062L471.524,186.754z"/></g></svg></div>');
            }
            if (data.style == 'style-8') {
                /*style 2*/
                $('.product-label').append('<div class="unique-day-background"></div>');
            }


            var fullDate = new Date();
            var timeToSeconds = fullDate.getTime() / 1000;
            fullDate.setDate(fullDate.getDate() + 31);
            var twoDigitMonth = (fullDate.getMonth() + 1) + "";
            if (twoDigitMonth.length == 1) twoDigitMonth = "0" + twoDigitMonth;
            var twoDigitDate = fullDate.getDate() + "";
            if (twoDigitDate.length == 1) twoDigitDate = "0" + twoDigitDate;
            var currentDate = fullDate.getFullYear() + "/" + twoDigitMonth + "/" + twoDigitDate;
            timeToSeconds = (fullDate.getTime() / 1000) - timeToSeconds;
            if (data.style == 'style-6' || data.style == 'style-7' || data.style == 'style-8') {
                // Flip Clock
                var clock;
                $(document).ready(function () {
                    var clock;

                    clock = $('.unique-label-id-' + $('#post_ID').val() + ' #clock').FlipClock({
                        clockFace: 'DailyCounter',
                        autoStart: false,
                    });

                    clock.setTime(timeToSeconds);
                    clock.setCountdown(true);
                    clock.start();

                });

            } else {
                //clock
                jQuery('.unique-label-id-' + $('#post_ID').val() + '#clock').countdown(currentDate, function (event) {
                    jQuery(this).html(event.strftime('%D days %H:%M:%S'));
                });

            }


        }
        else if ('image' == data.type) {
            $('.label-wrap').removeClass().addClass('unique-label-id-' + $('#post_ID').val() + ' label-wrap unique-' + data.type + " " + data.class);

            jQuery('#unique_thumbnail img').attr('src', data.image);
            if (jQuery('.custom_label_pic').length < 1) {
                jQuery('.product-label').wrapInner("<img class='custom_label_pic' style='width: auto;' src='" + data.image + "'/>");
            } else {
                jQuery('.product-label img').attr('src', data.image);
            }
        }
        preview_render();
    });

    //advanced label on change global
    $('#unique_settings').on('change', '#unique_global_label_advanced', function () {
        switch ($(this).val()) {
            case 'none':
                $('#unique_global_label_text').val('').trigger('change');
                break;
            case 'percentage':
                $('#unique_global_label_text').val('50%').trigger('change');
                break;
            case 'discount':
                $('#unique_global_label_text').val('$15').trigger('change');
                break;
            case 'price':
                $('#unique_global_label_text').val('$12').trigger('change');
                break;
            case 'saleprice':
                $('#unique_global_label_text').val('$10').trigger('change');
                break;
            case 'delprice':
                $('#unique_global_label_text').val('<del>$50</del>').trigger('change');
                break;

            default:
        }

    });

    //schedule label on change global
    $('#unique_settings').on('change', '#unique_global_label_time', function () {
        switch ($(this).val()) {
            case 'none':
                $('#unique_settings #unique_global_label_start_date').parent().slideUp('fast');
                $('#unique_settings #unique_global_label_end_date').parent().slideUp('fast');
                break;
            case 'product':
                $('#unique_settings #unique_global_label_start_date').parent().slideUp('fast');
                $('#unique_settings #unique_global_label_end_date').parent().slideUp('fast');
                break;
            case 'global':
                $('#unique_settings #unique_global_label_start_date').parent().slideDown('fast');
                $('#unique_settings #unique_global_label_end_date').parent().slideDown('fast');
                break;

            default:
        }

    });

    // Display/hide the Elements label/shape/image/count down on global
    $('#unique_settings').on('change', '#unique_global_label_type', function () {
        switch ($(this).val()) {
            case 'label':
                //preview_render();
                $('#unique_settings #unique_global_label_advanced').parent().slideDown('fast');
                $('#unique_settings #unique_global_label_text').parent().slideDown('fast');
                $('#unique_settings #unique_global_label_show_icon').parent().slideDown('fast');
                $('#unique_settings .custom_color_chose').parent().slideDown('fast');
                $('#unique_settings #unique_global_label_align').parent().slideDown('fast');
                $('#unique_settings #unique_global_label_class').parent().slideDown('fast');
                $('#unique_settings .unique-alert-notice').hide();
                $('#unique_settings #unique_global_label_shape').parent().slideUp('fast');
                $('#unique_settings #unique_global_label_style').parent().slideUp('fast');
                $('#unique_settings .form-field').parent().slideUp('fast');
                $('#unique_settings .custom_label_pic').hide();
                /*tab customize*/
                $('#unique_settings #unique_global_label_font_size').parent().slideDown('fast');
                $('#unique_settings #unique_global_label_width').parent().slideDown('fast');
                $('#unique_settings #unique_global_label_border_style').parent().slideDown('fast');
                $('#unique_settings #unique_global_label_border_width_top').parent().slideDown('fast');
                $('#unique_settings .custom_color_chose_b').parent().slideDown('fast');
                $('#unique_settings #unique_global_label_border_r_tl').parent().slideDown('fast');
                $('#unique_settings #unique_global_label_padding_top').parent().slideDown('fast');
                $('#unique_settings #unique_global_label_flip_text_h').parent().slideDown('fast');
                break;
            case 'flash':
                //preview_render();
                $('#unique_settings #unique_global_label_advanced').parent().slideDown('fast');
                $('#unique_settings #unique_global_label_text').parent().slideDown('fast');
                $('#unique_settings #unique_global_label_show_icon').parent().slideDown('fast');
                $('#unique_settings #unique_global_label_shape').parent().slideDown('fast');
                $('#unique_settings .custom_color_chose').parent().slideDown('fast');
                $('#unique_settings #unique_global_label_class').parent().slideDown('fast');
                $('#unique_settings .unique-alert-notice').hide();
                $('#unique_settings #unique_global_label_style').parent().slideUp('fast');
                $('#unique_settings .form-field').parent().slideUp('fast');
                $('#unique_settings .custom_label_pic').hide();
                $('#unique_settings #unique_global_label_align').parent().slideUp('fast');

                /*tab customize*/
                $('#unique_settings #unique_global_label_font_size').parent().slideUp('fast');
                $('#unique_settings #unique_global_label_width').parent().slideUp('fast');
                $('#unique_settings #unique_global_label_border_style').parent().slideUp('fast');
                $('#unique_settings #unique_global_label_border_width_top').parent().slideUp('fast');
                $('#unique_settings .custom_color_chose_b').parent().slideUp('fast');
                $('#unique_settings #unique_global_label_border_r_tl').parent().slideUp('fast');
                $('#unique_settings #unique_global_label_padding_top').parent().slideUp('fast');

                $('#unique_settings #unique_global_label_flip_text_h').parent().slideDown('fast');

                break;
            case 'count-down':
                //preview_render();
                $('#unique_settings .unique-alert-notice').show();
                $('#unique_settings #unique_global_label_advanced').parent().slideDown('fast');
                $('#unique_settings #unique_global_label_text').parent().slideDown('fast');
                $('#unique_settings #unique_global_label_show_icon').parent().slideDown('fast');
                $('#unique_settings #unique_global_label_style').parent().slideDown('fast');
                $('#unique_settings .custom_color_chose').parent().slideDown('fast');
                $('#unique_settings #unique_global_label_class').parent().slideDown('fast');
                $('#unique_settings #unique_global_label_shape').parent().slideUp('fast');
                $('#unique_settings .form-field').parent().slideUp('fast');
                $('#unique_settings .custom_label_pic').hide();
                $('#unique_settings #unique_global_label_align').parent().slideUp('fast');

                /*tab customize*/
                $('#unique_settings #unique_global_label_font_size').parent().slideUp('fast');
                $('#unique_settings #unique_global_label_width').parent().slideUp('fast');
                $('#unique_settings #unique_global_label_border_style').parent().slideUp('fast');
                $('#unique_settings #unique_global_label_border_width_top').parent().slideUp('fast');
                $('#unique_settings .custom_color_chose_b').parent().slideUp('fast');
                $('#unique_settings #unique_global_label_border_r_tl').parent().slideUp('fast');
                $('#unique_settings #unique_global_label_padding_top').parent().slideUp('fast');

                $('#unique_settings #unique_global_label_flip_text_h').parent().slideDown('fast');

                break;
            case 'image':
                preview_badge.removeAttr("style");
                //preview_render();
                $('#unique_settings .form-field').parent().slideDown('fast');
                $('#unique_settings .custom_label_pic').show();
                $('#unique_settings #unique_global_label_class').parent().slideDown('fast');
                $('#unique_settings .unique-alert-notice').hide();
                $('#unique_settings #unique_global_label_advanced').parent().slideUp('fast');
                $('#unique_settings #unique_global_label_text').parent().slideUp('fast');
                $('#unique_settings #unique_global_label_show_icon').parent().slideUp('fast');
                $('#unique_settings #unique_global_label_badge_icon').parent().slideUp('fast');
                $('#unique_settings #unique_global_label_shape').parent().slideUp('fast');
                $('#unique_settings #unique_global_label_style').parent().slideUp('fast');
                $('#unique_settings .custom_color_chose').parent().slideUp('fast');
                $('#unique_settings #unique_global_label_align').parent().slideUp('fast');
                /*tab customize*/
                $('#unique_settings #unique_global_label_font_size').parent().slideUp('fast');
                $('#unique_settings #unique_global_label_width').parent().slideUp('fast');
                $('#unique_settings #unique_global_label_border_style').parent().slideUp('fast');
                $('#unique_settings #unique_global_label_border_width_top').parent().slideUp('fast');
                $('#unique_settings .custom_color_chose_b').parent().slideUp('fast');
                $('#unique_settings #unique_global_label_border_r_tl').parent().slideUp('fast');
                $('#unique_settings #unique_global_label_padding_top').parent().slideUp('fast');
                $('#unique_settings #unique_global_label_flip_text_h').parent().slideUp('fast');


                break;
            default:
                $('#unique_settings .unique-alert-notice').hide();
                $('#unique_settings #unique_global_label_advanced').parent().slideUp('fast');
                $('#unique_settings #unique_global_label_text').parent().slideUp('fast');
                $('#unique_settings #unique_global_label_show_icon').parent().slideUp('fast');
                $('#unique_settings #unique_global_label_badge_icon').parent().slideUp('fast');
                $('#unique_settings #unique_global_label_shape').parent().slideUp('fast');
                $('#unique_settings #unique_global_label_style').parent().slideUp('fast');
                $('#unique_settings .custom_color_chose').parent().slideUp('fast');
                $('#unique_settings #unique_global_label_align').parent().slideUp('fast');
                $('#unique_settings #unique_global_label_class').parent().slideUp('fast');
                $('#unique_settings .form-field').parent().slideUp('fast');
                $('#unique_settings .custom_label_pic').hide();

        }
    });


    $(document).ready(function () {
        /****label type****/
        var temp = $('#unique_global_label_type').val();
        if (temp == 'none') {
            //on global
            //hide
            $('#unique_settings #unique_global_label_advanced').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_text').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_show_icon').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_badge_icon').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_shape').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_style').parent().slideUp('fast');
            $('#unique_settings .custom_color_chose').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_align').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_class').parent().slideUp('fast');
            $('#unique_settings .form-field').parent().slideUp('fast');

            //show

        }
        if (temp == 'label') {
            //on global
            //hide
            $('#unique_settings #unique_global_label_shape').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_style').parent().slideUp('fast');
            $('#unique_settings .form-field').parent().slideUp('fast');

            //show
            $('#unique_settings #unique_global_label_advanced').parent().slideDown('fast');
            $('#unique_settings #unique_global_label_text').parent().slideDown('fast');
            $('#unique_settings #unique_global_label_show_icon').parent().slideDown('fast');
            $('#unique_settings .custom_color_chose').parent().slideDown('fast');
            $('#unique_settings #unique_global_label_align').parent().slideDown('fast');
            $('#unique_settings #unique_global_label_class').parent().slideDown('fast');


        }
        if (temp == 'flash') {
            //on global
            //hide
            $('#unique_settings .form-field').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_style').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_align').parent().slideUp('fast');


            $('#unique_settings #unique_global_label_font_size').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_width').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_border_style').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_border_width_top').parent().slideUp('fast');
            $('#unique_settings .custom_color_chose_b').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_border_r_tl').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_padding_top').parent().slideUp('fast');


            //show
            $('#unique_settings #unique_global_label_advanced').parent().slideDown('fast');
            $('#unique_settings #unique_global_label_text').parent().slideDown('fast');
            $('#unique_settings #unique_global_label_show_icon').parent().slideDown('fast');
            $('#unique_settings #unique_global_label_shape').parent().slideDown('fast');
            $('#unique_settings .custom_color_chose').parent().slideDown('fast');
            $('#unique_settings #unique_global_label_class').parent().slideDown('fast');

        }
        if (temp == 'count-down') {
            //on global
            //hide

            $('#unique_settings #unique_global_label_shape').parent().slideUp('fast');
            $('#unique_settings .form-field').parent().slideUp('fast');
            $('#unique_settings .custom_label_pic').hide();
            $('#unique_settings #unique_global_label_align').parent().slideUp('fast');

            /*tab customize*/
            $('#unique_settings #unique_global_label_font_size').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_width').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_border_style').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_border_width_top').parent().slideUp('fast');
            $('#unique_settings .custom_color_chose_b').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_border_r_tl').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_padding_top').parent().slideUp('fast');

            //show
            $('#unique_settings #unique_global_label_advanced').parent().slideDown('fast');
            $('#unique_settings #unique_global_label_text').parent().slideDown('fast');
            $('#unique_settings #unique_global_label_show_icon').parent().slideDown('fast');
            $('#unique_settings #unique_global_label_style').parent().slideDown('fast');
            $('#unique_settings .custom_color_chose').parent().slideDown('fast');
            $('#unique_settings #unique_global_label_class').parent().slideDown('fast');
            $('#unique_settings #unique_global_label_flip_text_h').parent().slideDown('fast');

        }
        if (temp == 'image') {
            //on global
            //hide
            $('#unique_settings #unique_global_label_advanced').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_text').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_show_icon').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_badge_icon').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_shape').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_style').parent().slideUp('fast');
            $('#unique_settings .custom_color_chose').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_align').parent().slideUp('fast');
            //show
            $('#unique_settings #unique_global_label_class').parent().slideDown('fast');
            $('#unique_settings .form-field').parent().slideDown('fast');
            /*tab customize*/
            $('#unique_settings #unique_global_label_font_size').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_width').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_border_style').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_border_width_top').parent().slideUp('fast');
            $('#unique_settings .custom_color_chose_b').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_border_r_tl').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_padding_top').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_flip_text_h').parent().slideUp('fast');

        }
        /****label time****/
        var temp = $('#unique_global_label_time').val();
        if (temp == 'none') {
            //on global
            //hide
            $('#unique_settings #unique_global_label_start_date').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_end_date').parent().slideUp('fast');
            //show

        }
        if (temp == 'product') {
            //on global
            //hide
            $('#unique_settings #unique_global_label_start_date').parent().slideUp('fast');
            $('#unique_settings #unique_global_label_end_date').parent().slideUp('fast');
            //show

        }
        if (temp == 'global') {
            //on global
            //hide
            $('#unique_settings #unique_global_label_start_date').parent().slideDown('fast');
            $('#unique_settings #unique_global_label_end_date').parent().slideDown('fast');
            //show

        }
        /*update radio button*/
/*
        $('.itbd-label-field-wrap .itbd-hide-radio').click(function() {
            $('.itbd-text-design').prop('checked',true);
        });
*/

    });

    //update position tooltip
    var CountSelectedCB = [];
    $("input.update-tooltip").on("change", function () {

        var selectedCB = [];
        var notSelectedCB = [];

        selectedCB =$("#unique_global_label_tooltip_position").val();

        if($("#unique_global_label_tooltip_position").val()!=""){
            CountSelectedCB = $("#unique_global_label_tooltip_position").val().split(","); // this returns an array
        }

        //CountSelectedCB =$("#unique_global_label_tooltip_position").val();
        console.log(selectedCB);

        if ($(this).is(":checked")) {
            if(selectedCB.indexOf($(this).attr("id")) != -1){
                console.log($(this).attr("id") + " found");
            }else{
                console.log("is NOT in array");
                CountSelectedCB.push($(this).attr("id"));
            }
/*
            if(jQuery.inArray($(this).attr("id"), selectedCB) != -1) {
                console.log("is in array");


            } else {
                console.log("is NOT in array");
                CountSelectedCB.push($(this).attr("id"));
            }
*/
        }else {
            console.log("is DEL in array");
            CountSelectedCB.splice( $.inArray($(this).attr("id"),CountSelectedCB) ,1 );
            console.log(CountSelectedCB);

        }



        //CountSelectedCB.length = 0; // clear selected cb count
/*
        $("input.update-tooltip").each(function() {
            if ($(this).is(":checked")) {
                CountSelectedCB.push($(this).attr("id"));
            }
        });
*/
            console.log($.isEmptyObject(CountSelectedCB));
            $("#unique_global_label_tooltip_position").val(CountSelectedCB);
    });

    /*
    * icon picker
    */
    $('.icon-picker-input').iconPicker();
    /*
    * Icon Badge preview
    */
    function it_icon_badge_preview() {

            var font = $('.icon-picker-input').val().split('|');
            var icon = font[ 0 ] + ' ' + font[ 1 ];
            $('.unique-label-text').html('<i class="' + icon + '" aria-hidden="true"></i>' + input_text.val());
    }

    $(show_icon).change(function () {
        if(show_icon.is(':checked')){
            it_icon_badge_preview();
        }else{

        }
    });
    $(document).on("click", ".icon-picker-list > li > a", function() {
        it_icon_badge_preview();
    });

    $('.itbd-label-shape-wrap').mCustomScrollbar({
        theme: 'dark-3',
        mouseWheel: {enable: true},
        axis: 'y'

    });
});