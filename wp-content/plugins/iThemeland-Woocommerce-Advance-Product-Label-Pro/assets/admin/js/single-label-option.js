jQuery(function ($) {
    var type = $('#_unique_label_type'),
        preview_bg = $(".preview_image"),
        preview_bg_top = preview_bg.offset().top - 60,
        input_type = $("#_unique_label_type"),
        input_shape = $('.itbd-text-design:checked'),
        input_style = $(".itbd-text-design-style:checked"),
        input_image_url = $("#_unique_label_image"),
        anchor_point = 'top-left',
        half_left = $(".it_column_setting"),
        half_right = $(".it_column_preview"),
        preview_bg_content_bottom = half_right.offset().top + half_right.outerHeight(),
        show_icon= $('#_unique_label_show_icon'),
        badge_icon = $("#_unique_label_badge_icon"),
        input_txt_color = $("#_unique-custom-text"),
        input_text = $("#_unique_label_text"),
        input_bg_color = $("#_unique-custom-background"),
        input_width = $("#_unique_label_width"),
        input_height = $("#_unique_label_height"),
        input_border_style = $("#_unique_label_border_style"),
        input_border_width_t = $("#_unique_label_border_width_top"),
        input_border_width_l = $("#_unique_label_border_width_left"),
        input_border_width_b = $("#_unique_label_border_width_bottom"),
        input_border_width_r = $("#_unique_label_border_width_right"),
        input_border_color = $("#_unique_label_border_color"),
        input_border_tl = $("#_unique_label_border_r_tl"),
        input_border_tr = $("#_unique_label_border_r_tr"),
        input_border_br = $("#_unique_label_border_r_br"),
        input_border_bl = $("#_unique_label_border_r_bl"),
        input_padding_t = $("#_unique_label_padding_top"),
        input_padding_l = $("#_unique_label_padding_left"),
        input_padding_b = $("#_unique_label_padding_bottom"),
        input_padding_r = $("#_unique_label_padding_right"),
        input_font_size = $("#_unique_label_font_size"),
        input_line_height = $("#_unique_label_line_height"),
        input_opacity = $("#_unique_label_opacity"),
        input_rotation_x = $("#_unique_label_rotation_x"),
        input_rotation_y = $("#_unique_label_rotation_y"),
        input_rotation_z = $("#_unique_label_rotation_z"),
        pos_top = $("#_unique_label_pos_top"),
        pos_bottom = $("#_unique_label_pos_bottom"),
        pos_left = $("#_unique_label_pos_left"),
        pos_right = $("#_unique_label_pos_right"),
        pos_top_left = $('#unique-pos-top-left'),
        pos_top_center = $('#unique-pos-top-center'),
        pos_top_right = $('#unique-pos-top-right'),
        pos_bottom_left = $('#unique-pos-bottom-left'),
        pos_bottom_center = $('#unique-pos-bottom-center'),
        pos_bottom_right = $('#unique-pos-bottom-right'),
        pos_left_center = $('#unique-pos-center-left'),
        pos_right_center = $('#unique-pos-center-right'),
        pos_center = $('#unique-pos-center'),
        flip_text_horizontally = $('#_unique_label_flip_text_h'),
        flip_text_vertically = $('#_unique_label_flip_text_v'),

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
            switch (input_type.val()) {
                case 'label':
                    preview_badge_label.removeAttr("style");
                    if(show_icon.is(':checked')){
                        it_icon_badge_preview();
                    }else{
                        $('.unique-label-text').html(input_text.val());
                    }
/*
                    $('.unique-label-text').html(input_text.val());
*/

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
                    /*$('.unique-label-text').html(input_text.val());*/
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
/*
                    $('.unique-label-text').html(input_text.val());
*/
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
                    if ($(".itbd-text-design-style:checked").val() == 'style-6' || $(".itbd-text-design-style:checked").val() == 'style-7' || $(".itbd-text-design-style:checked").val() == 'style-8') {
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

                    preview_badge_label.css({

                        "color": input_txt_color.val(),

                    });
                    switch ($(".itbd-text-design-style:checked").val()) {
                        case 'style-1':
                            preview_badge.css({
                                'width': '100px',
                                'height': '85px',
                            });
                            $('.unique-count-1').css({
                                "background": "linear-gradient(to bottom right, #00000000 0%, " + input_bg_color.val() + " 100%)",
                            });
                            break;
                        case 'style-2':
                            preview_badge.css({
                                'width': '60px',
                                'height': '50px',
                            });
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
                            preview_badge.css({
                                'width': '105px',
                                'height': '60px',
                            });
                            preview_badge_label.css({
                                "background-color": input_bg_color.val(),
                            });
                            break;
                        case 'style-4':
                            preview_badge.css({
                                'width': '100px',
                                'height': '87px',
                            });
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
                            preview_badge.css({
                                'width': '110px',
                                'height': '87px',
                            });
                            $('.unique-circle-label').css({
                                "background": "linear-gradient(to bottom, #00000000 5%, " + input_bg_color.val() + " 85%)",
                            });

                            break;
                        case 'style-6':
                            preview_badge.css({
                                'width': '150px',
                                'height': '70px',
                            });
                            preview_badge_label.css({
                                "background-color": input_bg_color.val(),
                            });
                            break;
                        case 'style-7':
                            preview_badge.css({
                                'width': '156px',
                                'height': '50px',
                            });
                            preview_badge_label.css({
                                "background-color": input_bg_color.val(),
                            });
                            break;
                        case 'style-8':
                            preview_badge.css({
                                'width': '122px',
                                'height': '37px',
                            });
                            $('.unique-day-background').css({
                                "border-color": input_bg_color.val(),
                            });
                            break;
                    }
                    positioning_render();
                    break;

                default:
                    positioning_render();
            }
        };

    preview_render();

    $(document).on('change paste keyup input focus', '#_unique_label_rotation_x, #_unique_label_rotation_y, #_unique_label_rotation_z, #_unique_label_flip_text_h, #_unique_label_flip_text_v', function () {
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

    preview_badge.draggable({
        containment: ".half-right",
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
    $('#_unique-custom-background.color-picker').wpColorPicker({
        palettes: ['#D9534F', '#3498db', '#39A539', '#ffe312', '#ffA608', '#999', '#444', '#fff'],
        color: '#D9534F',
        //palettes: false,
        change: function (event, ui) {

            if ($('#_unique_label_type').val() == 'label') {
                $('.label-wrap .product-label').css({'background-color': ui.color.toString()+ "!important"});
            }
            if ($('#_unique_label_type').val() == 'flash' && $('#_unique_label_shape').val() == 'cut-diamond') {
                $('.label-wrap .product-label').css({'border-bottom-color': ui.color.toString()});
                jQuery('.label-wrap').prev('style').html('.label-wrap .product-label:after { border-top-color: ' + ui.color.toString() + '; }');
            }
        },
    });
    $('#_unique-custom-text.color-picker').wpColorPicker({
        palettes: ['#D9534F', '#3498db', '#39A539', '#ffe312', '#ffA608', '#999', '#444', '#fff'],
        color: '#fff',
        //palettes: false,
        change: function (event, ui) {
            $('.label-wrap .product-label').css({'color': ui.color.toString() + "!important"});
        },
    });


    /***********import code from it-woocommerce-advanced-product-labels-pro****************/

    // Update preview on change Single
    $('#it-woocommerce-advanced-product-labels-pro').on('change keyup click', 'input, select', function () {
        var data = {
            type: jQuery('#_unique_label_type').val(),
            shape: jQuery('.itbd-text-design:checked').val(),
            style: jQuery('.itbd-text-design-style:checked').val(),
            text: jQuery('#_unique_label_text').val(),
            align: jQuery('#_unique_label_align').val(),
            image: jQuery('#_unique_label_image').val(),
            class: jQuery('#_unique_label_class').val(),

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
                jQuery('.unique-label-id-' + $('#post_ID').val() + ' #clock').countdown(currentDate, function (event) {
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

    //advanced label on change single
    $('#it-woocommerce-advanced-product-labels-pro').on('change', '#_unique_label_advanced', function () {
        switch ($(this).val()) {
            case 'none':
                $('#_unique_label_text').val('').trigger('change');
                break;
            case 'percentage':
                $('#_unique_label_text').val('50%').trigger('change');
                break;
            case 'discount':
                $('#_unique_label_text').val('$15').trigger('change');
                break;
            case 'price':
                $('#_unique_label_text').val('$12').trigger('change');
                break;
            case 'saleprice':
                $('#_unique_label_text').val('$10').trigger('change');
                break;
            case 'delprice':
                $('#_unique_label_text').val('<del>$50</del>').trigger('change');
                break;
            default:
        }

    });

    //schedule label on change single
    $('#it-woocommerce-advanced-product-labels-pro').on('change', '#_unique_label_time', function () {
        switch ($(this).val()) {
            case 'none':
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_start_date').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_end_date').parent().slideUp('fast');
                break;
            case 'product':
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_start_date').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_end_date').parent().slideUp('fast');
                break;
            case 'global':
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_start_date').parent().slideDown('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_end_date').parent().slideDown('fast');
                break;

            default:
        }

    });

    // Display/hide the Elements label/shape/image/count down on single
    $('#it-woocommerce-advanced-product-labels-pro').on('change', '#_unique_label_type', function () {
        switch ($(this).val()) {
            case 'label':
                preview_render();
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_advanced').parent().slideDown('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_text').parent().slideDown('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_show_icon').parent().slideDown('fast');
                $('#it-woocommerce-advanced-product-labels-pro .custom_color_chose').parent().slideDown('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_align').parent().slideDown('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_class').parent().slideDown('fast');
                $('#it-woocommerce-advanced-product-labels-pro .unique-alert-notice').hide();
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_shape').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_style').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro .custom-image').slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro .custom_label_pic').hide();
                /*tab customize*/
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_font_size').parent().slideDown('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_line_height').parent().slideDown('fast');
                $('#it-woocommerce-advanced-product-labels-pro .hr-under-line-height').slideDown('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_width').parent().slideDown('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_height').parent().slideDown('fast');
                $('#it-woocommerce-advanced-product-labels-pro .hr-under-height').slideDown('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_border_style').parent().slideDown('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_border_width_top').parent().slideDown('fast');
                $('#it-woocommerce-advanced-product-labels-pro .custom_color_chose_b').slideDown('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_border_r_tl').parent().slideDown('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_padding_top').parent().slideDown('fast');
                $('#it-woocommerce-advanced-product-labels-pro .hr-under-padding').slideDown('fast');

                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_flip_text_h').parent().slideDown('fast');
                break;
            case 'flash':
                preview_render();
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_advanced').parent().slideDown('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_text').parent().slideDown('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_show_icon').parent().slideDown('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_shape').parent().slideDown('fast');
                $('#it-woocommerce-advanced-product-labels-pro .custom_color_chose').parent().slideDown('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_class').parent().slideDown('fast');
                $('#it-woocommerce-advanced-product-labels-pro .unique-alert-notice').hide();
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_style').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro .custom-image').slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro .custom_label_pic').hide();
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_align').parent().slideUp('fast');

                /*tab customize*/
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_font_size').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_line_height').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro .hr-under-line-height').slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_width').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_height').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro .hr-under-height').slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_border_style').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_border_width_top').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro .custom_color_chose_b').slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_border_r_tl').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_padding_top').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro .hr-under-padding').slideUp('fast');

                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_flip_text_h').parent().slideDown('fast');

                break;
            case 'count-down':
                preview_render();
                $('#it-woocommerce-advanced-product-labels-pro .unique-alert-notice').show();
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_advanced').parent().slideDown('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_text').parent().slideDown('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_show_icon').parent().slideDown('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_style').parent().slideDown('fast');
                $('#it-woocommerce-advanced-product-labels-pro .custom_color_chose').parent().slideDown('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_class').parent().slideDown('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_shape').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro .custom-image').slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro .custom_label_pic').hide();
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_align').parent().slideUp('fast');

                /*tab customize*/
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_font_size').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_line_height').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro .hr-under-line-height').slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_width').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_height').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro .hr-under-height').slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_border_style').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_border_width_top').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro .custom_color_chose_b').slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_border_r_tl').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_padding_top').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro .hr-under-padding').slideUp('fast');

                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_flip_text_h').parent().slideDown('fast');

                break;
            case 'image':
                preview_badge.removeAttr("style");
                preview_render();
                $('#it-woocommerce-advanced-product-labels-pro .custom-image').slideDown('fast');
                $('#it-woocommerce-advanced-product-labels-pro .custom_label_pic').show();
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_class').parent().slideDown('fast');
                $('#it-woocommerce-advanced-product-labels-pro .unique-alert-notice').hide();
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_advanced').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_text').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_show_icon').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_badge_icon').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_shape').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_style').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro .custom_color_chose').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_align').parent().slideUp('fast');
                /*tab customize*/
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_font_size').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_line_height').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro .hr-under-line-height').slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_width').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_height').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro .hr-under-height').slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_border_style').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_border_width_top').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro .custom_color_chose_b').slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_border_r_tl').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_padding_top').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro .hr-under-padding').slideUp('fast');

                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_flip_text_h').parent().slideUp('fast');


                break;
            default:
                $('#it-woocommerce-advanced-product-labels-pro .unique-alert-notice').hide();
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_advanced').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_text').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_show_icon').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_badge_icon').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_shape').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_style').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro .custom_color_chose').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_align').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro #_unique_label_class').parent().slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro .custom-image').slideUp('fast');
                $('#it-woocommerce-advanced-product-labels-pro .custom_label_pic').hide();

        }
    });

    $(document).ready(function () {
        /****label type****/
        var temp = $('#_unique_label_type').val();
        if (temp == 'none') {
            //on single
            //hide
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_advanced').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_text').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_show_icon').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_badge_icon').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_shape').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_style').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro .custom_color_chose').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_align').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_class').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro .custom-image').slideUp('fast');

            //show

        }
        if (temp == 'label') {
            //on single
            //hide
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_shape').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_style').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro .custom-image').slideUp('fast');

            //show
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_advanced').parent().slideDown('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_text').parent().slideDown('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_show_icon').parent().slideDown('fast');
            $('#it-woocommerce-advanced-product-labels-pro .custom_color_chose').parent().slideDown('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_align').parent().slideDown('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_class').parent().slideDown('fast');

        }
        if (temp == 'flash') {
            //on single
            //hide
            $('#it-woocommerce-advanced-product-labels-pro .custom-image').slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_style').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_align').parent().slideUp('fast');

            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_font_size').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_line_height').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro .hr-under-line-height').slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_width').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_height').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro .hr-under-height').slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_border_style').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_border_width_top').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro .custom_color_chose_b').slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_border_r_tl').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_padding_top').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro .hr-under-padding').slideUp('fast');


            //show
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_advanced').parent().slideDown('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_text').parent().slideDown('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_show_icon').parent().slideDown('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_shape').parent().slideDown('fast');
            $('#it-woocommerce-advanced-product-labels-pro .custom_color_chose').parent().slideDown('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_class').parent().slideDown('fast');

        }
        if (temp == 'count-down') {
            //on single
            //hide
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_shape').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro .custom-image').slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro .custom_label_pic').hide();
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_align').parent().slideUp('fast');

            /*tab customize*/
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_font_size').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_line_height').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro .hr-under-line-height').slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_width').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_height').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro .hr-under-height').slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_border_style').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_border_width_top').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro .custom_color_chose_b').slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_border_r_tl').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_padding_top').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro .hr-under-padding').slideUp('fast');


            //show
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_advanced').parent().slideDown('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_text').parent().slideDown('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_show_icon').parent().slideDown('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_style').parent().slideDown('fast');
            $('#it-woocommerce-advanced-product-labels-pro .custom_color_chose').parent().slideDown('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_class').parent().slideDown('fast');

            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_flip_text_h').parent().slideDown('fast');
        }
        if (temp == 'image') {
            //on single
            //hide
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_advanced').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_text').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_show_icon').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_badge_icon').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_shape').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_style').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro .custom_color_chose').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_align').parent().slideUp('fast');
            //show
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_class').parent().slideDown('fast');
            $('#it-woocommerce-advanced-product-labels-pro .custom-image').slideDown('fast');
            /*tab customize*/
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_font_size').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_line_height').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro .hr-under-line-height').slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_width').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_height').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro .hr-under-height').slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_border_style').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_border_width_top').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro .custom_color_chose_b').slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_border_r_tl').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_padding_top').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro .hr-under-padding').slideUp('fast');

            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_flip_text_h').parent().slideUp('fast');

        }
        /****label time****/
        var temp = $('#_unique_label_time').val();
        if (temp == 'none') {
            //on single
            //hide
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_start_date').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_end_date').parent().slideUp('fast');
            //show

        }
        if (temp == 'product') {
            //on single
            //hide
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_start_date').parent().slideUp('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_end_date').parent().slideUp('fast');
            //show

        }
        if (temp == 'global') {
            //on single
            //hide
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_start_date').parent().slideDown('fast');
            $('#it-woocommerce-advanced-product-labels-pro #_unique_label_end_date').parent().slideDown('fast');
            //show

        }

    });

    /*check for last relase*/

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