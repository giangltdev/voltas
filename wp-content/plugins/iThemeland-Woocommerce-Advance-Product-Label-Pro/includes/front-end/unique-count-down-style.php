<?php
$flip_text = '';
$flip_text .= (isset($label['flip_text_h']) && $label['flip_text_h'] == '1') ? 'scaleX(-1)' : '';
$flip_text .= (isset($label['flip_text_v']) && $label['flip_text_v'] == '1') ? 'scaleY(-1)' : '';

// Initialize custom_style
wp_enqueue_style('unique-style-front-end', plugins_url('unique-style-front-end.css', __FILE__));
// Initialize custom_style
$custom_css = "
.unique-label-id-{$label['id']}.label-wrap{
        position: absolute;        
        top:" . (($label['pos_top'] == 'auto' || strpos($label['pos_top'], 'calc') !== false) ? $label['pos_top'] : $label['pos_top'] . 'px') . ";
        right:" . (($label['pos_right'] == 'auto' || strpos($label['pos_right'], 'calc') !== false) ? $label['pos_right'] : $label['pos_right'] . 'px') . ";
        bottom:" . (($label['pos_bottom'] == 'auto' || strpos($label['pos_bottom'], 'calc') !== false) ? $label['pos_bottom'] : $label['pos_bottom'] . 'px') . ";
        left:" . (($label['pos_left'] == 'auto' || strpos($label['pos_left'], 'calc') !== false) ? $label['pos_left'] : $label['pos_left'] . 'px') . ";
        opacity:" . $label['opacity'] / 100 . ";
        transform: rotateX(" . $label['rotation_x'] . "deg) rotateY(" . $label['rotation_y'] . "deg) rotateZ(" . $label['rotation_z'] . "deg);
        -ms-transform: rotateX(" . $label['rotation_x'] . "deg) rotateY(" . $label['rotation_y'] . "deg) rotateZ(" . $label['rotation_z'] . "deg);
        -webkit-transform: rotateX(" . $label['rotation_x'] . "deg) rotateY(" . $label['rotation_y'] . "deg) rotateZ(" . $label['rotation_z'] . "deg);
}
.unique-label-id-{$label['id']}.label-wrap .product-label{
        color:{$label['custom_text_color']} ;
}
";
if ($flip_text != '') {
    $custom_css .= "
        .unique-label-id-{$label['id']}.label-wrap .unique-label-text{
            transform:{$flip_text};
            -ms-transform:{$flip_text};
            -webkit-transform:{$flip_text};
        }";
}
switch ($label['style']) {
    case 'style-1':
        $custom_css .= "
        .unique-label-id-{$label['id']}.label-wrap .product-label .unique-count-1{
            background:linear-gradient(to bottom right, #00000000 0%, {$label['custom_bg_color']} 100%) ;
        }
        ";
        break;
    case 'style-2':
        $custom_css .= "
        .unique-label-id-{$label['id']}.label-wrap .product-label .unique-count-2{
            background:linear-gradient(to bottom, #00000000 0%, {$label['custom_bg_color']} 85%) ;
        }
        .unique-label-id-{$label['id']}.label-wrap .product-label .unique-count-2:after{
            border-top-color:{$label['custom_bg_color']} ;
        }
        ";
        break;
    case 'style-3':
        $custom_css .= "
        .unique-label-id-{$label['id']}.label-wrap .product-label{
            background-color:{$label['custom_bg_color']} ;
        }
        ";
        break;
    case 'style-4':
        $custom_css .= "
        .unique-label-id-{$label['id']}.label-wrap .product-label .unique-pin{
            background:linear-gradient(to bottom, #00000000 5%, {$label['custom_bg_color']} 85%) ;
        }
        .unique-label-id-{$label['id']}.label-wrap .product-label .unique-pin:after{
            border-top-color:{$label['custom_bg_color']} ;
        }
        ";
        break;
    case 'style-5':
        $custom_css .= "
        .unique-label-id-{$label['id']}.label-wrap .product-label .unique-circle-label{
            background:linear-gradient(to bottom, #00000000 5%, {$label['custom_bg_color']} 85%) ;
        }
        ";
        break;
    case 'style-6':
        $custom_css .= "
        .unique-label-id-{$label['id']}.label-wrap .product-label{
            background-color:{$label['custom_bg_color']} ;
        }
        ";
        break;
    case 'style-7':
        $custom_css .= "
        .unique-label-id-{$label['id']}.label-wrap .product-label{
            background-color:{$label['custom_bg_color']} ;
        }
        ";
        break;
    case 'style-8':
        $custom_css .= "
        .unique-label-id-{$label['id']}.label-wrap .product-label .unique-day-background{
            border-color:{$label['custom_bg_color']} ;
        }
        ";
        break;
}

wp_add_inline_style('unique-style-front-end', $custom_css);