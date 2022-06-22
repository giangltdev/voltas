<?php

$flip_text = '';
$flip_text .= (isset($label['flip_text_h']) && $label['flip_text_h'] == '1') ? 'scaleX(-1)' : '';
$flip_text .= (isset($label['flip_text_v']) && $label['flip_text_v'] == '1') ? 'scaleY(-1)' : '';
$label['border_width_top']=($label['border_width_top']=='')? '3' : $label['border_width_top'];
$label['border_width_right']=($label['border_width_right']=='')? '3' : $label['border_width_right'];
$label['border_width_bottom']=($label['border_width_bottom']=='')? '3' : $label['border_width_bottom'];
$label['border_width_left']=($label['border_width_left']=='')? '3' : $label['border_width_left'];
$label['border_r_tl']=($label['border_r_tl']=='')? '0' : $label['border_r_tl'];
$label['border_r_tr']=($label['border_r_tr']=='')? '0' : $label['border_r_tr'];
$label['border_r_br']=($label['border_r_br']=='')? '0' : $label['border_r_br'];
$label['border_r_bl']=($label['border_r_bl']=='')? '0' : $label['border_r_bl'];
$label['padding_top']=($label['padding_top']=='')? '0' : $label['padding_top'];
$label['padding_left']=($label['padding_left']=='')? '0' : $label['padding_left'];
$label['padding_bottom']=($label['padding_bottom']=='')? '0' : $label['padding_bottom'];
$label['padding_right']=($label['padding_right']=='')? '0' : $label['padding_right'];



// Initialize custom_style
wp_enqueue_style( 'unique-style-front-end', plugins_url( 'unique-style-front-end.css', __FILE__ ));
// Initialize custom_style
$custom_css="
.unique-label-id-{$label['id']}.label-wrap{
        position: absolute;
        color:{$label['custom_text_color']} ;
        background-color:{$label['custom_bg_color']} ;
        width:{$label['width']}px ;
        height:{$label['height']}px ;
        border-style: {$label['border_style']};
        border-top-width: {$label['border_width_top']}px ;
        border-right-width: {$label['border_width_right']}px ;
        border-bottom-width: {$label['border_width_bottom']}px ;
        border-left-width: {$label['border_width_left']}px ;
        border-color: {$label['border_color']};
        border-top-left-radius:{$label['border_r_tl']}px ;
        border-top-right-radius:{$label['border_r_tr']}px ;
        border-bottom-right-radius:{$label['border_r_br']}px ;
        border-bottom-left-radius:{$label['border_r_bl']}px ;
        padding-top:{$label['padding_top']}px ;
        padding-left:{$label['padding_left']}px ;
        padding-bottom:{$label['padding_bottom']}px ;
        padding-right:{$label['padding_right']}px ;
        font-size:{$label['font_size']}px ;
        line-height:".(($label['line_height']=='-1')? $label['height'] : $label['line_height'])."px ;
        top:".(($label['pos_top']=='auto' || strpos($label['pos_top'], 'calc') !== false)? $label['pos_top'] : $label['pos_top'].'px').";
        right:".(($label['pos_right']=='auto' || strpos($label['pos_right'], 'calc') !== false)? $label['pos_right'] : $label['pos_right'].'px').";
        bottom:".(($label['pos_bottom']=='auto' || strpos($label['pos_bottom'], 'calc') !== false)? $label['pos_bottom'] : $label['pos_bottom'].'px').";
        left:".(($label['pos_left']=='auto' || strpos($label['pos_left'], 'calc') !== false)? $label['pos_left'] : $label['pos_left'].'px').";
        opacity:".$label['opacity']/ 100 .";
        transform: rotateX(".$label['rotation_x']."deg) rotateY(".$label['rotation_y']."deg) rotateZ(".$label['rotation_z']."deg);
        -ms-transform: rotateX(".$label['rotation_x']."deg) rotateY(".$label['rotation_y']."deg) rotateZ(".$label['rotation_z']."deg);
        -webkit-transform: rotateX(".$label['rotation_x']."deg) rotateY(".$label['rotation_y']."deg) rotateZ(".$label['rotation_z']."deg);
}
.unique-label-id-{$label['id']}.label-wrap .unique-label-text{
        text-align:{$label['align']};
}";
if($flip_text!='') {
    $custom_css.="
        .unique-label-id-{$label['id']}.label-wrap .unique-label-text{
            transform:{$flip_text};
            -ms-transform:{$flip_text};
            -webkit-transform:{$flip_text};
        }";
}

wp_add_inline_style( 'unique-style-front-end', $custom_css );