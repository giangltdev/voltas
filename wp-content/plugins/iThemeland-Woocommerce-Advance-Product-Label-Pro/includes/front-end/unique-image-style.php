<?php
// Initialize custom_style
wp_enqueue_style( 'unique-style-front-end', plugins_url( 'unique-style-front-end.css', __FILE__ ));
// Initialize custom_style
$custom_css = "
    .unique-label-id-{$label['id']}.unique-image{
        position: absolute;
        top:".(($label['pos_top']=='auto' || strpos($label['pos_top'], 'calc') !== false)? $label['pos_top'] : $label['pos_top'].'px').";
        right:".(($label['pos_right']=='auto' || strpos($label['pos_right'], 'calc') !== false)? $label['pos_right'] : $label['pos_right'].'px').";
        bottom:".(($label['pos_bottom']=='auto' || strpos($label['pos_bottom'], 'calc') !== false)? $label['pos_bottom'] : $label['pos_bottom'].'px').";
        left:".(($label['pos_left']=='auto' || strpos($label['pos_left'], 'calc') !== false)? $label['pos_left'] : $label['pos_left'].'px').";
        opacity:".$label['opacity']/ 100 .";
        transform: rotateX(".$label['rotation_x']."deg) rotateY(".$label['rotation_y']."deg) rotateZ(".$label['rotation_z']."deg);
        -ms-transform: rotateX(".$label['rotation_x']."deg) rotateY(".$label['rotation_y']."deg) rotateZ(".$label['rotation_z']."deg);
        -webkit-transform: rotateX(".$label['rotation_x']."deg) rotateY(".$label['rotation_y']."deg) rotateZ(".$label['rotation_z']."deg);
        
    }";

wp_add_inline_style( 'unique-style-front-end', $custom_css );