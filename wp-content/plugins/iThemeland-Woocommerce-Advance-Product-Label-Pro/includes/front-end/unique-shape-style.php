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
switch ($label['shape']) {
    case 'cut-diamond':
        $custom_css .= "
        .unique-label-id-{$label['id']}.label-wrap .product-label{
            border-bottom-color:{$label['custom_bg_color']} ;
        }
        .unique-label-id-{$label['id']}.label-wrap .product-label:after{
            border-top-color:{$label['custom_bg_color']} ;
        }
        ";
        break;
    case 'round-star':
        $custom_css .= "
        .unique-label-id-{$label['id']}.label-wrap .product-label{
            background-color:{$label['custom_bg_color']} ;
        }
        .unique-label-id-{$label['id']}.label-wrap .product-label:before,.unique-label-id-{$label['id']}.label-wrap .product-label:after{
            background-color:{$label['custom_bg_color']} ;
        }
        ";
        break;
    case 'ribbon':
        $custom_css .= "
        .unique-label-id-{$label['id']}.label-wrap .product-label{
            border-color:{$label['custom_bg_color']} ;
            border-bottom-color:rgba(0,0,0,0);
        }
        ";
        break;
    case 'circle-ribbon':
        $custom_css .= "
        .unique-label-id-{$label['id']}.label-wrap .product-label{
            background-color:{$label['custom_bg_color']} ;
        }
        .unique-label-id-{$label['id']}.label-wrap .product-label::before,.unique-label-id-{$label['id']}.label-wrap .product-label::after{
            border-bottom-color:{$label['custom_bg_color']} ;
        }

        ";
        break;
    case 'diamond':
        $custom_css .= "
        .unique-label-id-{$label['id']}.label-wrap .product-label{
            background-color:{$label['custom_bg_color']} ;
        }
        ";
        break;
    case 'triangle-topleft':
        $custom_css .= "
        .unique-label-id-{$label['id']}.label-wrap .product-label{
            border-top-color:{$label['custom_bg_color']} ;
        }
        ";
        break;
    case 'triangle-topright':
        $custom_css .= "
        .unique-label-id-{$label['id']}.label-wrap .product-label{
            border-top-color:{$label['custom_bg_color']} ;
        }
        ";
        break;
    case 'loophole-1':
        $custom_css .= "
        .unique-label-id-{$label['id']}.label-wrap .product-label{
            background-color:{$label['custom_bg_color']} ;
        }
        .unique-label-id-{$label['id']}.label-wrap .product-label:before,.unique-label-id-{$label['id']}.label-wrap .product-label:after{
            background-color:{$label['custom_bg_color']} ;
            border-right-color:{$label['custom_bg_color']} ;
        }

        ";
        break;
    case 'loophole-2':
        $custom_css .= "
        .unique-label-id-{$label['id']}.label-wrap .product-label{
            background-color:{$label['custom_bg_color']} ;
        }
        .unique-label-id-{$label['id']}.label-wrap .product-label:before,.unique-label-id-{$label['id']}.label-wrap .product-label:after{
            background-color:{$label['custom_bg_color']} ;
            border-right-color:{$label['custom_bg_color']} ;
        }
        ";
        break;
    case 'loophole-3':
        $custom_css .= "
        .unique-label-id-{$label['id']}.label-wrap .product-label{
            background-color:{$label['custom_bg_color']} ;
        }
        .unique-label-id-{$label['id']}.label-wrap .product-label:before{
            border-right-color:{$label['custom_bg_color']} ;
        }
        ";
        break;
    case 'loophole-4':
        $custom_css .= "
        .unique-label-id-{$label['id']}.label-wrap .product-label{
            background-color:{$label['custom_bg_color']} ;
        }
        .unique-label-id-{$label['id']}.label-wrap .product-label:before{
            border-right-color:{$label['custom_bg_color']} ;
        }
        ";
        break;
    case 'heart':
        $custom_css .= "
        .unique-label-id-{$label['id']}.label-wrap .product-label:before,.unique-label-id-{$label['id']}.label-wrap .product-label:after{
            background-color:{$label['custom_bg_color']} ;
        }
        ";
        break;
    case 'loophole-5':
        $custom_css .= "
        .unique-label-id-{$label['id']}.label-wrap .product-label{
            background-color:{$label['custom_bg_color']} ;
        }
        .unique-label-id-{$label['id']}.label-wrap .product-label:before{
            border-right-color:{$label['custom_bg_color']} ;
        }
        ";
        break;
    case 'corner-ribbons':
        $custom_css .= "
        .unique-label-id-{$label['id']}.label-wrap .product-label{
            background-color:{$label['custom_bg_color']} ;
        }
        .unique-label-id-{$label['id']}.label-wrap .product-label:before{
            border-right-color:{$label['custom_bg_color']} ;
        }
        ";
        break;
    case 'corner-ribbons-two':
        $custom_css .= "
        .unique-label-id-{$label['id']}.label-wrap .product-label{
            background-color:{$label['custom_bg_color']} ;
        }
        ";
        break;
}

wp_add_inline_style('unique-style-front-end', $custom_css);