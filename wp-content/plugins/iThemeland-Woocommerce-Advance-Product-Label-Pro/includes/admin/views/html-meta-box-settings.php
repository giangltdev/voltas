<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

wp_nonce_field('unique_global_label_meta_box', 'unique_global_label_meta_box_nonce');

global $post;
$label = get_post_meta($post->ID, '_unique_global_label', true);

$label = wp_parse_args($label, array(
    'id' => $post->ID,
    'advanced' => '',
    'text' => '',
    'show_icon' => '',
    'badge_icon'=>'',
    'shape' => '',
    'style' => '',
    'style_attr' => '',
    'type' => '',
    'align' => '',
    'image' => '',
    'class' => '',
    'show_desc'=>'',
    'show_desc_form'=>'',
    'font_size' => isset($label['font_size']) ? $label['font_size'] : '12',
    'line_height' => isset($label['line_height']) ? $label['line_height'] : '-1',
    'width' => isset($label['width']) ? $label['width'] : '80',
    'height' => isset($label['height']) ? $label['height'] : '30',
    'border_style' => '',
    'border_width_top' => isset($label['border_width_top']) ? $label['border_width_top'] : '3',
    'border_width_right' => isset($label['border_width_right']) ? $label['border_width_right'] : '3',
    'border_width_bottom' => isset($label['border_width_bottom']) ? $label['border_width_bottom'] : '3',
    'border_width_left' => isset($label['border_width_left']) ? $label['border_width_left'] : '3',
    'border_r_tl' => isset($label['border_r_tl']) ? $label['border_r_tl'] : '0',
    'border_r_tr' => isset($label['border_r_tr']) ? $label['border_r_tr'] : '0',
    'border_r_br' => isset($label['border_r_br']) ? $label['border_r_br'] : '0',
    'border_r_bl' => isset($label['border_r_bl']) ? $label['border_r_bl'] : '0',
    'padding_top' => isset($label['padding_top']) ? $label['padding_top'] : '0',
    'padding_right' => isset($label['padding_right']) ? $label['padding_right'] : '0',
    'padding_bottom' => isset($label['padding_bottom']) ? $label['padding_bottom'] : '0',
    'padding_left' => isset($label['padding_left']) ? $label['padding_left'] : '0',
    'opacity' => isset($label['opacity']) ? $label['opacity'] : '100',
    'rotation_x' => isset($label['rotation_x']) ? $label['rotation_x'] : '360',
    'rotation_y' => isset($label['rotation_y']) ? $label['rotation_y'] : '360',
    'rotation_z' => isset($label['rotation_z']) ? $label['rotation_z'] : '360',
    'flip_text_h' => '',
    'flip_text_v' => '',
    'pos_top' => isset($label['pos_top']) ? $label['pos_top'] : '154',
    'pos_right' => isset($label['pos_right']) ? $label['pos_right'] : 'auto',
    'pos_bottom' => isset($label['pos_bottom']) ? $label['pos_bottom'] : 'auto',
    'pos_left' => isset($label['pos_left']) ? $label['pos_left'] : '35',
    'time' => '',
    'start_date' => '',
    'end_date' => '',
    'custom_bg_color' => isset($label['label_custom_background_color']) ? $label['label_custom_background_color'] : '#D9534F',
    'custom_text_color' => isset($label['label_custom_text_color']) ? $label['label_custom_text_color'] : '#fff',
    'border_color' => isset($label['border_color']) ? $label['border_color'] : '#eeeeee',
    'tooltip_delay' => isset($label['tooltip_delay']) ? $label['tooltip_delay'] : '0',
    'tooltip_distance' => isset($label['tooltip_distance']) ? $label['tooltip_distance'] : '6',
    'tooltip_max_width' => isset($label['tooltip_max_width']) ? $label['tooltip_max_width'] : 'null',
    'animation_duration' => isset($label['animation_duration']) ? $label['animation_duration'] : '350',
    'tooltip_max_width' => isset($label['tooltip_max_width']) ? $label['tooltip_max_width'] : '300',

    'related_loop' => '',
    'related_auto' => '',
    'related_nav' => '',
    'show_related_title' => '',
    'show_related' => '',
    'tooltip_use_arrow' => '',
    'tooltip_position_bottom' => '',
    'tooltip_position_right' => '',
    'tooltip_position_left' => '',
    'tooltip_position_top' => '',
    'tooltip_animation' => '',
    'show_watermark' => '',
    'tooltip_open_on' => '',
    'tooltip_position' => isset($label['tooltip_position']) ? $label['tooltip_position'] : "'top'",
    'tooltip_theme' => '',
    'margin_carousel' => '',
    'number_related_carousel' => '',
    'number_related' => '',
    'related_title' => '',

));
$label['style_attr'] = isset($label['style']) && 'custom' == $label['style'] ? "style='background-color: {$label['custom_bg_color']}; color: {$label['custom_text_color']};'" : '';

?>
<div class='unique-meta-box'>

    <div class="it_column_setting">

        <?php
        /**
         * Tab Maintenace. Table will be come from [tabs] folder based on $tab_array
         * this $tab_arry will define, how much tab and tab content
         */
        echo '<nav class="it-unique-tab nav-tab-wrapper">';
        echo "<a href='general' data-tab='general' class='it_unique_nav_for_general nav-tab nav-tab-active'><span class=\"icon-nav dashicons dashicons-admin-generic\"></span>GENERAL</a>";
        echo "<a href='other' data-tab='customize' class='it_unique_nav_for_customize nav-tab'><span class=\"icon-nav dashicons dashicons-welcome-write-blog\"></span>CUSTOMIZE</a>";
        echo "<a href='schedule' data-tab='schedule' class='it_unique_nav_for_schedule nav-tab'><span class=\"icon-nav dashicons dashicons-clock\"></span>SCHEDULE</a>";
        echo "<a href='description' data-tab='description' class='it_unique_nav_for_description nav-tab'><span class=\"icon-nav dashicons dashicons-admin-comments\"></span>DESCRIPTION</a>";
        echo '</nav>';
        //////////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////GENERAL TAB HTML///////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////
        //Now start for Tab Content
        echo '<div class="tab-content tab-content-active" id="general">';
        echo '<div class="fieldwrap">';
        /*  content  */
        ?>
        <p class='unique-global-option'>
            <label for='unique_global_label_type'><?php _e('LABEL TYPE', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <select id='unique_global_label_type' name='_unique_global_label[type]' class="update-preview"><?php
                foreach (unique_get_label_types() as $key => $value) :
                    ?>
                    <option
                    value='<?php echo $key; ?>' <?php selected($label['type'], $key); ?>><?php echo $value; ?></option><?php
                endforeach;
                ?></select>

        </p>

        <div class="unique-alert unique-alert-notice it_hide">
            <span class="unique-closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>Notice!</strong> You need to set the time in the schedule tab.
        </div>


        <div class="unique-global-option">
            <label for='unique_global_label_shape'><?php _e('LABEL SHAPE', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <div class="itbd-label-shape-wrap" id="unique_global_label_shape">
                <div class="itbd-label-option-wrap">
                    <div class="itbd-label-field-wrap">
                        <?php
                        $t = 1;
                        foreach (unique_get_label_shapes() as $key => $value) :
                            ?>
                            <div class="itbd-hide-radio">
                                <input type="radio" id="<?php echo $t; ?>" name="_unique_global_label[shape]" class="itbd-text-design" value="<?php echo $key; ?>" <?php if ( isset( $label['shape'] ) && $label['shape'] == $key ) { ?>checked="checked"<?php } ?> <?php if ( ! isset( $label['shape'] ) ) { ?>checked="checked"<?php } ?> />
                                <label class="itbd-existing-images-demo" for="<?php echo $t; ?>">
                                    <img src="<?php echo UNIQUE_PLUGIN_IMG_DIR . 'predefine/' . $t . '.png' ?>">
                                </label>
                            </div>
                            <?php
                            $t ++;
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="unique-global-option">
            <label for='unique_global_label_style'><?php _e('COUNT DOWN STYLE', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <div class="itbd-label-shape-wrap" id="unique_global_label_style">
                <div class="itbd-label-option-wrap">
                    <div class="itbd-label-field-wrap">
                        <?php
                        $t = 100;
                        foreach (unique_get_label_style() as $key => $value) :
                            ?>
                            <div class="itbd-hide-radio">
                                <input type="radio" id="<?php echo $t; ?>" name="_unique_global_label[style]" class="itbd-text-design itbd-text-design-style" value="<?php echo $key; ?>" <?php if ( isset( $label['style'] ) && $label['style'] == $key ) { ?>checked="checked"<?php } ?> <?php if ( ! isset( $label['style'] ) ) { ?>checked="checked"<?php } ?> />
                                <label class="itbd-existing-images-demo" for="<?php echo $t; ?>">
                                    <img src="<?php echo UNIQUE_PLUGIN_IMG_DIR . 'countdown/' . $t . '.png' ?>">
                                </label>
                            </div>
                            <?php
                            $t ++;
                        endforeach;
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <p class='unique-global-option it_hide'>
            <label for='unique_global_label_advanced'><?php _e('USE INTELLIGENT LABEL', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <select id='unique_global_label_advanced' name='_unique_global_label[advanced]' class="update-preview"><?php
                foreach (unique_get_label_advanced() as $key => $value) :
                    ?>
                    <option
                    value='<?php echo $key; ?>' <?php selected($label['advanced'], $key); ?>><?php echo $value; ?></option><?php
                endforeach;
                ?></select>

        </p>


        <p class='unique-global-option custom-text it_hide'>

            <label for='unique_global_label_text'><?php _e('LABEL TEXT', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <input type='text' id='unique_global_label_text' contenteditable="true" name='_unique_global_label[text]'
                   value='<?php echo esc_attr($label['text']); ?>' size='25' class="update-preview"/>

        </p>

        <p class='unique-global-option it_hide'>
            <label for='unique_global_label_show_icon'><?php _e('SHOW ICON', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <input class="update-preview as-toggle-checkbox" type="checkbox" value='1'
                   name="_unique_global_label[show_icon]"
                   id="unique_global_label_show_icon" <?php checked($label['show_icon'], 1); ?>><label
                    class="as-toggle-span-label as-show-icon" for="unique_global_label_show_icon"></label>
        </p>

        <div class='unique-global-option custom-icon it_hide'>
            <label for='unique_global_label_badge_icon'><?php _e('CHOOSE ICON', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <div data-target="icon-picker" class="button icon-picker <?php
            if ( ! empty( $label[ 'badge_icon' ] ) ) {
                $value = $label[ 'badge_icon' ];
                $v = explode( '|', $value );
                if ( isset( $v[ 1 ] ) ) {
                    echo $v[ 0 ] . ' ' . $v[ 1 ];
                }
            } else {
                echo esc_attr( 'dashicons dashicons-plus' );
            }
            ?>"></div>
            <input class="icon-picker-input it-picker-icon" type="text" id='unique_global_label_badge_icon' name="_unique_global_label[badge_icon]"
                   value="<?php
                   if ( isset( $label[ 'badge_icon' ] ) ) {
                       echo esc_attr( $label[ 'badge_icon' ] );
                   } else {
                       echo esc_attr( 'dashicons dashicons-plus' );
                   }
                   ?>"/>

        </div>

        <div class='unique-global-option custom-colors it_hide'>
            <div class="custom_color_chose">
                <label for='unique-custom-background'><?php _e('BACKGROUND COLOR', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
                <input type='text' name='_unique_global_label[label_custom_background_color]'
                       value='<?php echo $label['custom_bg_color']; ?>' id='unique-custom-background'
                       class='color-picker background-picker' data-alpha-enabled="true"/>
            </div>
            <div class="custom_color_chose">
                <label for='unique-custom-text'><?php _e('TEXT COLOR', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
                <input type='text' name='_unique_global_label[label_custom_text_color]'
                       value='<?php echo $label['custom_text_color']; ?>' id='unique-custom-text'
                       class='color-picker text-picker' data-alpha-enabled="true"/>
            </div>
        </div>
        <p class='unique-global-option it_hide'>

            <label for='unique_global_label_align'><?php _e('LABEL TEXT ALIGN', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <select name='_unique_global_label[align]' class='unique-select' id='unique_global_label_align'><?php
                foreach (unique_get_label_align() as $key => $value) :
                    ?>
                    <option
                    value='<?php echo $key; ?>' <?php selected($label['align'], $key); ?>><?php echo $value; ?></option><?php
                endforeach;
                ?></select>

        </p>

        <div class='unique-global-option custom-image it_hide'>
            <label for='unique_global_label_image'><?php _e('LABEL IMAGE', 'it-woocommerce-advanced-product-labels-pro'); ?></label>

            <div class="form-field" style="min-width:210px;display:inline-block;">
                <div id="unique_thumbnail" style="float:left;margin-right:10px;">
                    <img src="<?php wp_enqueue_media();
                    echo(isset($label['image']) && $label['image'] != '' ? $label['image'] : UNIQUE_PLUGIN_URL . '/assets/admin/images/placeholder.png'); ?>"
                         width="60px" height="60px"/>
                </div>
                <div style="line-height:60px;">
                    <input type="hidden" id='unique_global_label_image' name='_unique_global_label[image]'
                           value='<?php $url_pic = isset($label['image']) ? $label['image'] : '';
                           echo $url_pic; ?>' class="update-preview"/>
                    <button type="button"
                            class="it_upload_image_button button"><?php _e('+', 'it-woocommerce-advanced-product-labels-pro'); ?></button>
                    <button type="button"
                            class="it_remove_image_button button"><?php _e('x', 'it-woocommerce-advanced-product-labels-pro'); ?></button>
                </div>

                <div class="clear"></div>
            </div>

            <script type="text/javascript">
                // Only show the "remove image" button when needed
                if (!jQuery('#unique_global_label_image').val()) {
                    jQuery('.it_remove_image_button').hide();
                    jQuery('#unique_global_label_image').val('<?php echo UNIQUE_PLUGIN_URL . '/assets/admin/images/placeholder.png'; ?>');
                    jQuery('.product-label img').css({"width": '50px'});
                }

                // Uploading files
                var file_frame;

                jQuery(document).on('click', '.it_upload_image_button', function (event) {


                    event.preventDefault();

                    // If the media frame already exists, reopen it.
                    if (file_frame) {
                        file_frame.open();
                        return;
                    }

                    // Create the media frame.
                    file_frame = wp.media.frames.downloadable_file = wp.media({
                        title: '<?php _e('Choose an image', 'it-woocommerce-advanced-product-labels-pro'); ?>',
                        button: {
                            text: '<?php _e('Use image', 'it-woocommerce-advanced-product-labels-pro'); ?>',
                        },
                        multiple: false
                    });

                    // When an image is selected, run a callback.
                    file_frame.on('select', function () {
                        attachment = file_frame.state().get('selection').first().toJSON();

                        jQuery('#unique_global_label_image').val(attachment.url);
                        jQuery('#unique_thumbnail img').attr('src', attachment.url);
                        jQuery('.it_remove_image_button').show();
                        if (jQuery('.custom_label_pic').length < 1) {
                            jQuery('.product-label').wrapInner("<img class='custom_label_pic' style='width: auto;' src='" + attachment.url + "'/>");
                        } else {
                            jQuery('.product-label img').attr('src', attachment.url);
                        }
                        jQuery('.product-label img').css({"width": 'auto'});


                    });

                    // Finally, open the modal.
                    file_frame.open();
                });

                jQuery(document).on('click', '.it_remove_image_button', function (event) {
                    jQuery('#unique_thumbnail img').attr('src', '<?php echo UNIQUE_PLUGIN_URL . '/assets/admin/images/placeholder.png'; ?>');
                    jQuery('.product-label img').attr('src', '<?php echo UNIQUE_PLUGIN_URL . '/assets/admin/images/placeholder.png'; ?>');
                    jQuery('.product-label img').css({"width": '50px'});
                    jQuery('#unique_global_label_image').val('');
                    jQuery('#unique_global_label_image').val('<?php echo UNIQUE_PLUGIN_URL . '/assets/admin/images/placeholder.png'; ?>');
                    jQuery('.it_remove_image_button').hide();
                    return false;
                });

            </script>
        </div>

        <p class='unique-global-option it_hide'>

            <label for='unique_global_label_class'><?php _e('LABEL CSS CLASS', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <input type='text' id='unique_global_label_class' name='_unique_global_label[class]'
                   value='<?php echo esc_attr($label['class']); ?>' size='25' class="update-preview"/>

        </p>



        <?php
        echo '</div>'; //End of .fieldwrap
        echo '</div>'; //End of Tab content div
        //////////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////CUSTOMIZE TAB HTML/////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////
        //Now start for Tab Content
        echo '<div class="tab-content" id="customize">';
        echo '<div class="fieldwrap">';
        /*  content  */
        ?>
        <div class='unique-global-option'>

            <label for='unique_global_label_font_size'><?php _e('FONT SIZE', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <input type='text' value='<?php echo esc_attr($label['font_size']); ?>'
                   name="_unique_global_label[font_size]" id="unique_global_label_font_size" size='25'
                   class="update-preview font_input">
            <small><?php _e('px', 'it-woocommerce-advanced-product-labels-pro'); ?></small>
            <label for='unique_global_label_line_height'><?php _e('LINE HEIGHT', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <input type='text' value='<?php echo esc_attr($label['line_height']); ?>'
                   name="_unique_global_label[line_height]" id="unique_global_label_line_height" size='25'
                   class="update-preview font_input">
            <small><?php _e('px', 'it-woocommerce-advanced-product-labels-pro'); ?></small>
            <label for='unique_global_label_desc_filed'></label>
            <small id="unique_global_label_desc_filed"><?php _e('( -1 To equalize the height of the LABEL )', 'it-woocommerce-advanced-product-labels-pro'); ?></small>
            <hr style="border: 0;height: 1px;background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));margin-right: 15px;">

        </div>
        <div class='unique-global-option'>
            <label for='unique_global_label_width'><?php _e('WIDTH', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <input type='text' value='<?php echo esc_attr($label['width']); ?>' name="_unique_global_label[width]"
                   id="unique_global_label_width" size='25' class="update-preview pos_input">
            <small><?php _e('px', 'it-woocommerce-advanced-product-labels-pro'); ?></small>
            <label for='unique_global_label_height'><?php _e('HEIGHT', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <input type='text' value='<?php echo esc_attr($label['height']); ?>' name="_unique_global_label[height]"
                   id="unique_global_label_height" size='25' class="update-preview pos_input">
            <small><?php _e('px', 'it-woocommerce-advanced-product-labels-pro'); ?></small>
            <hr style="border: 0;height: 1px;background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));margin-right: 15px;">
        </div>
        <div class='unique-global-option'>
            <label for='unique_global_label_border_style'><?php _e('BORDER STYLE', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <select name='_unique_global_label[border_style]' class='unique-select update-preview'
                    id='unique_global_label_border_style'><?php
                foreach (unique_get_label_border_style() as $key => $value) :
                    ?>
                    <option
                    value='<?php echo $key; ?>' <?php selected($label['border_style'], $key); ?>><?php echo $value; ?></option><?php
                endforeach;
                ?>
            </select>
        </div>
        <div class='unique-global-option'>
            <label for='unique_global_label_border_width'><?php _e('BORDER WIDTH <small>(px)</small>', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <input type='text' value='<?php echo esc_attr($label['border_width_top']); ?>'
                   name="_unique_global_label[border_width_top]" id="unique_global_label_border_width_top" size='25'
                   class="update-preview radius_input">
            <input type='text' value='<?php echo esc_attr($label['border_width_right']); ?>'
                   name="_unique_global_label[border_width_right]" id="unique_global_label_border_width_right" size='25'
                   class="update-preview radius_input">
            <input type='text' value='<?php echo esc_attr($label['border_width_bottom']); ?>'
                   name="_unique_global_label[border_width_bottom]" id="unique_global_label_border_width_bottom"
                   size='25' class="update-preview radius_input">
            <input type='text' value='<?php echo esc_attr($label['border_width_left']); ?>'
                   name="_unique_global_label[border_width_left]" id="unique_global_label_border_width_left" size='25'
                   class="update-preview radius_input">
            <label for='unique_global_label_desc_filed'></label>
            <small id="unique_global_label_desc_filed"
                   class="desc_filed_pt"><?php _e('Top', 'it-woocommerce-advanced-product-labels-pro'); ?></small>
            <small id="unique_global_label_desc_filed"
                   class="desc_filed_pr"><?php _e('Right', 'it-woocommerce-advanced-product-labels-pro'); ?></small>
            <small id="unique_global_label_desc_filed"
                   class="desc_filed_pb"><?php _e('Bottom', 'it-woocommerce-advanced-product-labels-pro'); ?></small>
            <small id="unique_global_label_desc_filed"
                   class="desc_filed_pl"><?php _e('Left', 'it-woocommerce-advanced-product-labels-pro'); ?></small>
        </div>
        <div class='unique-global-option'>
            <div class="custom_color_chose_b">
                <label for='unique_global_label_border_color'><?php _e('BORDER COLOR', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
                <input type='text' name='_unique_global_label[border_color]'
                       value='<?php echo $label['border_color']; ?>' id='unique_global_label_border_color'
                       class='color-picker' data-alpha-enabled="true"/>
            </div>
        </div>
        <div class='unique-global-option'>
            <label for='unique_global_label_border_radius'><?php _e('BORDER RADIUS <small>(px)</small>', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <input type='text' value='<?php echo esc_attr($label['border_r_tl']); ?>'
                   name="_unique_global_label[border_r_tl]" id="unique_global_label_border_r_tl" size='25'
                   class="update-preview radius_input">
            <input type='text' value='<?php echo esc_attr($label['border_r_tr']); ?>'
                   name="_unique_global_label[border_r_tr]" id="unique_global_label_border_r_tr" size='25'
                   class="update-preview radius_input">
            <input type='text' value='<?php echo esc_attr($label['border_r_br']); ?>'
                   name="_unique_global_label[border_r_br]" id="unique_global_label_border_r_br" size='25'
                   class="update-preview radius_input">
            <input type='text' value='<?php echo esc_attr($label['border_r_bl']); ?>'
                   name="_unique_global_label[border_r_bl]" id="unique_global_label_border_r_bl" size='25'
                   class="update-preview radius_input">
            <label for='unique_global_label_desc_filed'></label>
            <small id="unique_global_label_desc_filed"
                   class="desc_filed_tl"><?php _e('Top Left', 'it-woocommerce-advanced-product-labels-pro'); ?></small>
            <small id="unique_global_label_desc_filed"
                   class="desc_filed_tr"><?php _e('Top Right', 'it-woocommerce-advanced-product-labels-pro'); ?></small>
            <small id="unique_global_label_desc_filed"
                   class="desc_filed_br"><?php _e('Bottom Right', 'it-woocommerce-advanced-product-labels-pro'); ?></small>
            <small id="unique_global_label_desc_filed"
                   class="desc_filed_bl"><?php _e('Bottom Left', 'it-woocommerce-advanced-product-labels-pro'); ?></small>
        </div>
        <div class='unique-global-option'>
            <label for='unique_global_label_padding'><?php _e('PADDING <small>(px)</small>', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <input type='text' value='<?php echo esc_attr($label['padding_top']); ?>'
                   name="_unique_global_label[padding_top]" id="unique_global_label_padding_top" size='25'
                   class="update-preview radius_input">
            <input type='text' value='<?php echo esc_attr($label['padding_right']); ?>'
                   name="_unique_global_label[padding_right]" id="unique_global_label_padding_right" size='25'
                   class="update-preview radius_input">
            <input type='text' value='<?php echo esc_attr($label['padding_bottom']); ?>'
                   name="_unique_global_label[padding_bottom]" id="unique_global_label_padding_bottom" size='25'
                   class="update-preview radius_input">
            <input type='text' value='<?php echo esc_attr($label['padding_left']); ?>'
                   name="_unique_global_label[padding_left]" id="unique_global_label_padding_left" size='25'
                   class="update-preview radius_input">
            <label for='unique_global_label_desc_filed'></label>
            <small id="unique_global_label_desc_filed"
                   class="desc_filed_pt"><?php _e('Top', 'it-woocommerce-advanced-product-labels-pro'); ?></small>
            <small id="unique_global_label_desc_filed"
                   class="desc_filed_pr"><?php _e('Right', 'it-woocommerce-advanced-product-labels-pro'); ?></small>
            <small id="unique_global_label_desc_filed"
                   class="desc_filed_pb"><?php _e('Bottom', 'it-woocommerce-advanced-product-labels-pro'); ?></small>
            <small id="unique_global_label_desc_filed"
                   class="desc_filed_pl"><?php _e('Left', 'it-woocommerce-advanced-product-labels-pro'); ?></small>
            <hr style="border: 0;height: 1px;background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));margin-right: 15px;">
        </div>
        <p class='unique-global-option range-slider'>
            <label for='unique_global_label_opacity'><?php _e('OPACITY', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <input class="update-preview range-slider__range" type="range"
                   value='<?php echo esc_attr($label['opacity']); ?>' min="0" max="100"
                   name="_unique_global_label[opacity]" id="unique_global_label_opacity">
            <span class="range-slider__value">0</span>
        </p>
        <div class='unique-global-option'>

            <label for='unique_global_label_rotation'><?php _e('ROTATION', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <div class="range-slider rotation_range">
                <input class="update-preview range-slider__range" type="range"
                       value='<?php echo esc_attr($label['rotation_x']); ?>' min="0" max="360"
                       name="_unique_global_label[rotation_x]" id="unique_global_label_rotation_x">
                <span class="range-slider__value">0</span>
            </div>
            <div class="range-slider rotation_range">
                <input class="update-preview range-slider__range" type="range"
                       value='<?php echo esc_attr($label['rotation_y']); ?>' min="0" max="360"
                       name="_unique_global_label[rotation_y]" id="unique_global_label_rotation_y">
                <span class="range-slider__value">0</span>
            </div>
            <div class="range-slider rotation_range">
                <input class="update-preview range-slider__range" type="range"
                       value='<?php echo esc_attr($label['rotation_z']); ?>' min="0" max="360"
                       name="_unique_global_label[rotation_z]" id="unique_global_label_rotation_z">
                <span class="range-slider__value">0</span>
            </div>

            <label for='unique_global_label_desc_filed'></label>
            <small id="unique_global_label_desc_filed"
                   class="desc_filed_rx"><?php _e('X', 'it-woocommerce-advanced-product-labels-pro'); ?></small>
            <small id="unique_global_label_desc_filed"
                   class="desc_filed_ry"><?php _e('Y', 'it-woocommerce-advanced-product-labels-pro'); ?></small>
            <small id="unique_global_label_desc_filed"
                   class="desc_filed_rz"><?php _e('Z', 'it-woocommerce-advanced-product-labels-pro'); ?></small>
            <label for='unique_global_label_desc_filed'></label>
            <small id="unique_global_label_desc_filed"><?php _e('(Use the arrow keys to select the exact range)', 'it-woocommerce-advanced-product-labels-pro'); ?></small>

        </div>
        <p class='unique-global-option'>
            <label for='unique_global_label_flip_text'><?php _e('FLIP TEXT', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <input class="update-preview as-toggle-checkbox" type="checkbox" value='1'
                   name="_unique_global_label[flip_text_h]"
                   id="unique_global_label_flip_text_h" <?php checked($label['flip_text_h'], 1); ?>><label
                    class="as-toggle-span-label" for="unique_global_label_flip_text_h"></label>
            <span class="as-toggle-span"><?php _e('FLIP HORIZONTALLY', 'it-woocommerce-advanced-product-labels-pro'); ?></span>
            <input class="update-preview as-toggle-checkbox" type="checkbox" value='1'
                   name="_unique_global_label[flip_text_v]"
                   id="unique_global_label_flip_text_v" <?php checked($label['flip_text_v'], 1); ?>><label
                    class="as-toggle-span-label" for="unique_global_label_flip_text_v"></label>
            <span class="as-toggle-span"><?php _e('FLIP VERTICALLY', 'it-woocommerce-advanced-product-labels-pro'); ?></span>
        </p>

        <hr style="border: 0;height: 1px;background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));margin-right: 15px;">
        <p class='unique-global-option'>

            <label for='unique_global_label_pos_top'><?php _e('TOP', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <input type='text' value='<?php echo esc_attr($label['pos_top']); ?>' name="_unique_global_label[pos_top]"
                   id="unique_global_label_pos_top" size='25' class="update-preview pos_input">
            <small><?php _e('px or %', 'it-woocommerce-advanced-product-labels-pro'); ?></small>
            <label for='unique_global_label_pos_right'><?php _e('RIGHT', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <input type='text' value='<?php echo esc_attr($label['pos_right']); ?>'
                   name="_unique_global_label[pos_right]" id="unique_global_label_pos_right" size='25'
                   class="update-preview pos_input">
            <small><?php _e('px or %', 'it-woocommerce-advanced-product-labels-pro'); ?></small>
            <label for='unique_global_label_pos_bottom'><?php _e('BOTTOM', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <input type='text' value='<?php echo esc_attr($label['pos_bottom']); ?>'
                   name="_unique_global_label[pos_bottom]" id="unique_global_label_pos_bottom" size='25'
                   class="update-preview pos_input">
            <small><?php _e('px or %', 'it-woocommerce-advanced-product-labels-pro'); ?></small>
            <label for='unique_global_label_pos_left'><?php _e('LEFT', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <input type='text' value='<?php echo esc_attr($label['pos_left']); ?>' name="_unique_global_label[pos_left]"
                   id="unique_global_label_pos_left" size='25' class="update-preview pos_input">
            <small><?php _e('px or %', 'it-woocommerce-advanced-product-labels-pro'); ?></small>


        </p>
        <div class="unique-global-option custom-pos">

            <label for='unique-custom-position'><?php _e('Positioning', 'it-woocommerce-advanced-product-labels-pro'); ?></label>

            <table class="unique-table">
                <tr>
                    <td>
                        <img src='<?php echo UNIQUE_PLUGIN_URL.'/assets/admin/images/top-left.png' ?>'
                             id="unique-pos-top-left" width="40px"></td>
                    <td>
                        <img src='<?php echo UNIQUE_PLUGIN_URL.'/assets/admin/images/top-center.png' ?>'
                             id="unique-pos-top-center" width="40px"></td>
                    <td>
                        <img src='<?php echo UNIQUE_PLUGIN_URL.'/assets/admin/images/top-right.png' ?>'
                             id="unique-pos-top-right" width="40px"></td>
                </tr>
                <tr>
                    <td>
                        <img src='<?php echo UNIQUE_PLUGIN_URL.'/assets/admin/images/center-left.png' ?>'
                             id="unique-pos-center-left" width="40px"></td>
                    <td>
                        <img src='<?php echo UNIQUE_PLUGIN_URL.'/assets/admin/images/center.png' ?>'
                             id="unique-pos-center" width="40px"></td>
                    <td>
                        <img src='<?php echo UNIQUE_PLUGIN_URL.'/assets/admin/images/center-right.png' ?>'
                             id="unique-pos-center-right" width="40px"></td>
                </tr>
                <tr>
                    <td>
                        <img src='<?php echo UNIQUE_PLUGIN_URL.'/assets/admin/images/bottom-left.png' ?>'
                             id="unique-pos-bottom-left" width="40px"></td>
                    <td>
                        <img src='<?php echo UNIQUE_PLUGIN_URL.'/assets/admin/images/bottom-center.png' ?>'
                             id="unique-pos-bottom-center" width="40px"></td>
                    <td>
                        <img src='<?php echo UNIQUE_PLUGIN_URL.'/assets/admin/images/bottom-right.png' ?>'
                             id="unique-pos-bottom-right" width="40px"></td>
                </tr>
            </table>

        </div>

        <div class="unique-alert unique-alert-info">
            <span class="unique-closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <strong>PIVOT POINT:</strong> Used to drag and drop positioning.
        </div>


        <?php
        echo '</div>'; //End of .fieldwrap
        echo '</div>'; //End of Tab content div
        //////////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////SCHEDULE TAB HTML//////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////
        //Now start for Tab Content
        echo '<div class="tab-content" id="schedule">';
        echo '<div class="fieldwrap">';
        /*  content  */
        ?>
        <p class='unique-global-option'>
            <label for='unique_global_label_time'><?php _e('USE SCHEDULE', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <select id='unique_global_label_time' name='_unique_global_label[time]' class="update-preview"><?php
                foreach (unique_get_label_time() as $key => $value) :
                    ?>
                    <option
                    value='<?php echo $key; ?>' <?php selected($label['time'], $key); ?>><?php echo $value; ?></option><?php
                endforeach;
                ?></select>
        </p>


        <p class='unique-global-option it_hide'>

            <label for='unique_global_label_start_date'><?php _e('Start Date', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <?php

            $today = strtotime(current_time('y/m/d', $gmt = 0));
            $start_date = isset($label['start_date']) ? esc_attr($label['start_date']) : '';
            printf('<input class="regular-text schedule-datepicker update-preview" type="text" name="_unique_global_label[start_date]" id="unique_global_label_start_date" value="%s" readonly="readonly" />', $start_date);

            ?>

        </p>
        <p class='unique-global-option it_hide'>

            <label for='unique_global_label_end_date'><?php _e('End Date', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <?php

            $today = strtotime(current_time('y/m/d', $gmt = 0));
            $end_date = isset($label['end_date']) ? esc_attr($label['end_date']) : '';
            printf('<input class="regular-text schedule-datepicker update-preview" type="text" name="_unique_global_label[end_date]" id="unique_global_label_end_date" value="%s" readonly="readonly" />', $end_date);

            ?>

        </p>


        <?php
        echo '</div>'; //End of .fieldwrap
        echo '</div>'; //End of Tab content div
        //////////////////////////////////////////////////////////////////////////////////
        ///////////////////////////////DESCRIPTION TAB HTML//////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////
        //Now start for Tab Content
        echo '<div class="tab-content" id="description">';
        echo '<div class="fieldwrap">';
        /*  content  */
        ?>
        <p class='unique-global-option'>
            <label for='unique_global_label_show_desc'><?php _e('SHOW DESCRIPTION', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <input class="update-preview as-toggle-checkbox" type="checkbox" value='1'
                   name="_unique_global_label[show_desc]"
                   id="unique_global_label_show_desc" <?php checked($label['show_desc'], 1); ?>><label
                    class="as-toggle-span-label as-show-desc" for="unique_global_label_show_desc"></label>
        </p>
        <p class='unique-global-option it_hide'>

            <label for='unique_global_label_show_desc_form'><?php _e('DESCRIPTION FORM', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <select name='_unique_global_label[show_desc_form]' class='unique-select' id='unique_global_label_show_desc_form'><?php
                foreach (unique_get_label_show_desc_form() as $key => $value) :
                    ?>
                    <option
                    value='<?php echo $key; ?>' <?php selected($label['show_desc_form'], $key); ?>><?php echo $value; ?></option><?php
                endforeach;
                ?></select>

        </p>
        <p class='unique-global-option'>
            <label for='unique_global_label_show_watermark'><?php _e('SHOW WATERMARK', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <input class="update-preview as-toggle-checkbox" type="checkbox" value='1'
                   name="_unique_global_label[show_watermark]"
                   id="unique_global_label_show_watermark" <?php checked($label['show_watermark'], 1); ?>><label
                    class="as-toggle-span-label as-show-desc" for="unique_global_label_show_watermark"></label>
        </p>
        <!-- tooltip settings start -->
        <p class='unique-global-option'>
            <label for='unique_global_label_tooltip_theme'><?php _e('THEME', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <select name='_unique_global_label[tooltip_theme]' class='unique-select update-preview' id='unique_global_label_tooltip_theme'>
                <?php foreach (unique_get_label_tooltip_theme() as $key => $value) : ?>
                    <option value='<?php echo $key; ?>' <?php selected($label['tooltip_theme'], $key); ?>><?php echo $value; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p class='unique-global-option'>
            <label for='unique_global_label_tooltip_animation'><?php _e('ANIMATION', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <select name='_unique_global_label[tooltip_animation]' class='unique-select update-preview' id='unique_global_label_tooltip_animation'>
                <?php foreach (unique_get_label_tooltip_animation() as $key => $value) : ?>
                    <option value='<?php echo $key; ?>' <?php selected($label['tooltip_animation'], $key); ?>><?php echo $value; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p class='unique-global-option'>
            <label for='unique_global_label_animation_duration'><?php _e('ANIMATION DURATION', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <input type='number' id='unique_global_label_animation_duration' name='_unique_global_label[animation_duration]'
                   value='<?php echo esc_attr($label['animation_duration']); ?>' size='25' min='0' class="update-preview"/>
        </p>
        <p class='unique-global-option'>
            <label for='unique_global_label_tooltip_position'><?php _e('POSITION', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <input type='text' id='unique_global_label_tooltip_position' name='_unique_global_label[tooltip_position]'
                   value='<?php echo esc_attr($label['tooltip_position']); ?>' size='35' class="update-preview" placeholder="Default : Top" readonly/>
        <div class="table_setting_position" id="table_setting_position">
            <div class="divHTable">
                <?php _e('CLICK ON ARROW (SET PLACE PRIORITY TO SHOW TOOLTIP)', 'it-woocommerce-advanced-product-labels-pro'); ?>
            </div>
            <div class="divTable blueTable">
                <div class="divTableBody">
                    <div class="divTableRow">
                        <div class="divTableCell"></div>
                        <div class="divTableCell">
                            <input class="update-tooltip" style="width: 17px" type="checkbox" value='1'
                                   name="_unique_global_label[tooltip_position_top]"
                                   id="'top'" <?php checked($label['tooltip_position_top'], 1); ?>>
                            <label for="'top'"><img src='<?php echo UNIQUE_PLUGIN_URL.'/assets/admin/images/top.png' ?>'></label>
                        </div>
                        <div class="divTableCell"></div>
                    </div>
                    <div class="divTableRow">
                        <div class="divTableCell" style="text-align: right;padding-right: 5px;">
                            <input class="update-tooltip" style="width: 17px" type="checkbox" value='1'
                                   name="_unique_global_label[tooltip_position_left]"
                                   id="'left'" <?php checked($label['tooltip_position_left'], 1); ?>>
                            <label for="'left'"><img src='<?php echo UNIQUE_PLUGIN_URL.'/assets/admin/images/left.png' ?>'></label>
                        </div>
                        <div class="divTableCell" style="background: #eef1fd;"></div>
                        <div class="divTableCell" style="text-align: left;padding-left: 5px;">
                            <input class="update-tooltip" style="width: 17px" type="checkbox" value='1'
                                   name="_unique_global_label[tooltip_position_right]"
                                   id="'right'" <?php checked($label['tooltip_position_right'], 1); ?>>
                            <label for="'right'"><img src='<?php echo UNIQUE_PLUGIN_URL.'/assets/admin/images/right.png' ?>'></label>
                        </div>
                    </div>
                    <div class="divTableRow">
                        <div class="divTableCell"></div>
                        <div class="divTableCell">
                            <input class="update-tooltip" style="width: 17px" type="checkbox" value='1'
                                   name="_unique_global_label[tooltip_position_bottom]"
                                   id="'bottom'" <?php checked($label['tooltip_position_bottom'], 1); ?>>
                            <label for="'bottom'"><img src='<?php echo UNIQUE_PLUGIN_URL.'/assets/admin/images/bottom.png' ?>'></label>
                        </div>
                        <div class="divTableCell"></div>
                    </div>
                </div>
            </div>
        </div>
        </p>
        <p class='unique-global-option'>
            <label for='unique_global_label_tooltip_open_on'><?php _e('OPEN ON', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <select name='_unique_global_label[tooltip_open_on]' class='unique-select update-preview' id='unique_global_label_tooltip_open_on'>
                <?php foreach (unique_get_label_tooltip_open_on() as $key => $value) : ?>
                    <option value='<?php echo $key; ?>' <?php selected($label['tooltip_open_on'], $key); ?>><?php echo $value; ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <p class='unique-global-option'>
            <label for='unique_global_label_tooltip_delay'><?php _e('OPEN/CLOSE DELAY', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <input type='number' id='unique_global_label_tooltip_delay' name='_unique_global_label[tooltip_delay]'
                   value='<?php echo esc_attr($label['tooltip_delay']); ?>' size='25' min='0' class="update-preview"/>
        </p>
        <p class='unique-global-option'>
            <label for='unique_global_label_tooltip_distance'><?php _e('DISTANCE', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <input type='number' id='unique_global_label_tooltip_distance' name='_unique_global_label[tooltip_distance]'
                   value='<?php echo esc_attr($label['tooltip_distance']); ?>' size='25' min='0' class="update-preview"/>
        </p>
        <p class='unique-global-option'>
            <label for='unique_global_label_tooltip_max_width'><?php _e('MAX WIDTH', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <input type='number' id='unique_global_label_tooltip_max_width' name='_unique_global_label[tooltip_max_width]'
                   value='<?php echo esc_attr($label['tooltip_max_width']); ?>' size='25' min='0' class="update-preview"/>
        </p>
        <!--        <p class='unique-global-option'>
            <label for='unique_global_label_tooltip_close_on_click'><?php /*_e('CLOSE ON CLICK EVERYWHERE', 'it-woocommerce-advanced-product-labels-pro'); */?></label>
            <input class="update-preview as-toggle-checkbox" type="checkbox" value='1'
                   name="_unique_global_label[tooltip_close_on_click]"
                   id="unique_global_label_tooltip_close_on_click" <?php /*checked($label['tooltip_close_on_click'], 1); */?>><label
                    class="as-toggle-span-label as-show-desc" for="unique_global_label_tooltip_close_on_click"></label>
        </p>
-->        <p class='unique-global-option'>
            <label for='unique_global_label_tooltip_use_arrow'><?php _e('USE ARROW', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
            <input class="update-preview as-toggle-checkbox" type="checkbox" value='1'
                   name="_unique_global_label[tooltip_use_arrow]"
                   id="unique_global_label_tooltip_use_arrow" <?php checked($label['tooltip_use_arrow'], 1); ?>><label
                    class="as-toggle-span-label as-show-desc" for="unique_global_label_tooltip_use_arrow"></label>
        </p>
        <!-- tooltip settings end -->
        <p class='unique-global-option content-box-related'>
            <span class="span_content_box_related"><?php _e('RELATED PRODUCT', 'it-woocommerce-advanced-product-labels-pro'); ?></span>
            <span class='related-option'>
                <label for='unique_global_label_show_related'><?php _e('SHOW RELATED', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
                <input class="update-preview as-toggle-checkbox" type="checkbox" value='1'
                       name="_unique_global_label[show_related]"
                       id="unique_global_label_show_related" <?php checked($label['show_related'], 1); ?>><label
                        class="as-toggle-span-label as-show-desc" for="unique_global_label_show_related"></label>
            </span>
            <span class='related-option'>
                <label for='unique_global_label_show_related_title'><?php _e('SHOW TITLE', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
                <input class="update-preview as-toggle-checkbox" type="checkbox" value='1'
                       name="_unique_global_label[show_related_title]"
                       id="unique_global_label_show_related_title" <?php checked($label['show_related_title'], 1); ?>><label
                        class="as-toggle-span-label as-show-desc" for="unique_global_label_show_related_title"></label>
            </span>
            <span class='related-option'>
                <label for='unique_global_label_related_title'><?php _e('TITLE', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
                <input type='text' id='unique_global_label_related_title' name='_unique_global_label[related_title]'
                       value='<?php echo esc_attr($label['related_title']); ?>' size='25' class="update-preview"/>
            </span>
            <span class='related-option'>
                <label for='unique_global_label_number_related'><?php _e('COUNT RELATED', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
                <input type='number' id='unique_global_label_number_related' name='_unique_global_label[number_related]'
                       value='<?php echo esc_attr($label['number_related']); ?>' size='25' min='1' class="update-preview"/>
            </span>
            <span class='related-option'>
                <span class="span_content_carousel_set"><?php _e('CAROUSEL SETTING', 'it-woocommerce-advanced-product-labels-pro'); ?></span>
            </span>
            <span class='related-option'>
                <label for='unique_global_label_related_nav'><?php _e('SHOW NAVIGATION', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
                <input class="update-preview as-toggle-checkbox" type="checkbox" value='1'
                       name="_unique_global_label[related_nav]"
                       id="unique_global_label_related_nav" <?php checked($label['related_nav'], 1); ?>><label
                        class="as-toggle-span-label as-show-desc" for="unique_global_label_related_nav"></label>
            </span>
            <span class='related-option'>
                <label for='unique_global_label_related_auto'><?php _e('AUTO PLAY', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
                <input class="update-preview as-toggle-checkbox" type="checkbox" value='1'
                       name="_unique_global_label[related_auto]"
                       id="unique_global_label_related_auto" <?php checked($label['related_auto'], 1); ?>><label
                        class="as-toggle-span-label as-show-desc" for="unique_global_label_related_auto"></label>
            </span>
            <span class='related-option'>
                <label for='unique_global_label_related_loop'><?php _e('LOOP', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
                <input class="update-preview as-toggle-checkbox" type="checkbox" value='1'
                       name="_unique_global_label[related_loop]"
                       id="unique_global_label_related_loop" <?php checked($label['related_loop'], 1); ?>><label
                        class="as-toggle-span-label as-show-desc" for="unique_global_label_related_loop"></label>
            </span>
            <span class='related-option'>
                <label for='unique_global_label_number_related_carousel'><?php _e('COUNT SHOW', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
                <input type='number' id='unique_global_label_number_related_carousel' name='_unique_global_label[number_related_carousel]'
                       value='<?php echo esc_attr($label['number_related_carousel']); ?>' size='25' min='1' class="update-preview"/>
            </span>
            <span class='related-option'>
                <label for='unique_global_label_margin_carousel'><?php _e('ITEM MARGIN', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
                <input type='number' id='unique_global_label_margin_carousel' name='_unique_global_label[margin_carousel]'
                       value='<?php echo esc_attr($label['margin_carousel']); ?>' size='25' min='1' class="update-preview"/>
            </span>

        </p>
        <!--        <p class='unique-global-option it_hide'>

            <label for='unique_global_label_show_watermark_align'><?php /*_e('ALIGN WATERMARK', 'it-woocommerce-advanced-product-labels-pro'); */?></label>
            <select name='_unique_global_label[show_watermark_align]' class='unique-select' id='unique_global_label_show_watermark_align'><?php
        /*                foreach (unique_get_label_show_watermark_align() as $key => $value) :
                            */?>
                    <option
                    value='<?php /*echo $key; */?>' <?php /*selected($label['show_watermark_align'], $key); */?>><?php /*echo $value; */?></option><?php
        /*                endforeach;
                        */?></select>

        </p>
-->



        <?php
        echo '</div>'; //End of .fieldwrap
        echo '</div>'; //End of Tab content div

        ?>
    </div>

    <div class="it_column_preview">

        <div class='preview_titel' style=''>
            <h2 class='unique-preview'><?php _e('Preview Box<br><small>(Drag and drop to position the label)</small>', 'it-woocommerce-advanced-product-labels-pro'); ?></h2>
        </div>

        <div class='preview_image' style='top: 0px;'>

            <div id='unique-global-preview'>
                <img src='<?php echo UNIQUE_PLUGIN_URL.'/assets/admin/images/thumb.gif' ?>'/><?php

                echo unique_get_label_html($label);
                ?>
            </div>
            <div id="loading-label"></div>
        </div>

    </div>

    <style>
        .it_hide {
            display: none;
        }

        .tab-content {
            display: none;
        }

        .tab-content.tab-content-active {
            display: block;
        }

        .it_column_setting {
            width: 64%;
            margin-right: 2%;
            float: left;
            border-right: 1px dashed #ddd;
            display: inline-block;
            height: 100%;
            vertical-align: top;
        }

        .it_column_preview {
            display: inline-block;
            height: 100%;
            vertical-align: top;
            width: 33%;
            margin: 0 auto;
            text-align: center;
            height: 700px;
        }

        .preview_titel {
            display: block;
            margin-right: 0;
            background-color: #eef1fd;
            margin-bottom: 40px !important;
            height: 60px;
            box-shadow: inset 0 3px 0 #172b4d !important;
            margin-top: 9px;
        }

        .preview_image {
            display: block;
            position: relative;
            width: 150px;
            height: 150px;
            background: #ddd;
            box-sizing: border-box;
            z-index: 0;
            margin: 0 auto;
        }

        .label-wrap {
            position: absolute;
            box-sizing: border-box;
            text-align: center;
            z-index: 10;
            line-height: 0;
        }

        #unique_settings input, #unique_settings select {
            border: 1px solid rgba(34, 36, 38, .15);
            color: rgba(0, 0, 0, .87);
            border-radius: 5px;
            transition: box-shadow .1s ease, border-color .1s ease, -webkit-box-shadow .1s ease;
        }

        .unique-meta-box table tr td {
            padding: 5px 15px;
        }

        .custom-pos label {
            margin-top: -170px;
        }

        .radius_input {
            width: 75px !important;
        }

        small.desc_filed_tl {
            margin-left: 4% !important;
        }

        small.desc_filed_tr {
            margin-left: 6% !important;
        }

        small.desc_filed_br {
            margin-left: 5% !important;
        }

        small.desc_filed_bl {
            margin-left: 3% !important;
        }

        small.desc_filed_pt {
            margin-left: 6% !important;
        }

        small.desc_filed_pr {
            margin-left: 10% !important;
        }

        small.desc_filed_pb {
            margin-left: 9% !important;
        }

        small.desc_filed_pl {
            margin-left: 10% !important;
        }

        small.desc_filed_rz {
            margin-left: 18% !important;
        }

        small.desc_filed_ry {
            margin-left: 18% !important;
        }

        small.desc_filed_rx {
            margin-left: 6% !important;
        }

        small#unique_global_label_desc_filed {
            margin-left: 18px;
        }

        small {
            font-size: smaller;
        }

        /*custom range*/
        .range-slider__range {
            -webkit-appearance: none;
            width: calc(100% - (73px));
            height: 8px;
            border-radius: 5px;
            background: #d7dcdf;
            outline: none;
            padding: 0;
            margin: 0;
        }

        .range-slider__range::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #2c3e50;
            cursor: pointer;
            transition: background .15s ease-in-out;
        }

        .range-slider__range::-webkit-slider-thumb:hover {
            background: #1abc9c;
        }

        .range-slider__range:active::-webkit-slider-thumb {
            background: #1abc9c;
        }

        .range-slider__range::-moz-range-thumb {
            width: 16px;
            height: 16px;
            border: 0;
            border-radius: 50%;
            background: #2c3e50;
            cursor: pointer;
            transition: background .15s ease-in-out;
        }

        .range-slider__range::-moz-range-thumb:hover {
            background: #1abc9c;
        }

        .range-slider__range:active::-moz-range-thumb {
            background: #1abc9c;
        }

        .range-slider__range:focus::-webkit-slider-thumb {
            box-shadow: 0 0 0 3px #fff, 0 0 0 6px #1abc9c;
        }

        .range-slider__value {
            display: inline-block;
            position: relative;
            width: 18px;
            color: #fff;
            line-height: 13px;
            text-align: center;
            border-radius: 3px;
            background: #2c3e50;
            padding: 5px 8px;
            margin-left: 8px;
        }

        .range-slider__value:after {
            position: absolute;
            top: 8px;
            left: -7px;
            width: 0;
            height: 0;
            border-top: 5px solid transparent;
            border-right: 9px solid #2c3e50;
            border-bottom: 5px solid transparent;
            content: '';
        }

        ::-moz-range-track {
            background: #d7dcdf;
            border: 0;
        }

        input::-moz-focus-inner,
        input::-moz-focus-outer {
            border: 0;
        }

        .range-slider.rotation_range {
            display: inline-block;
            width: 100px;
        }

        .rotation_range .range-slider__range {
            -webkit-appearance: none;
            width: calc(100% - (73px));
            height: 6px;
            border-radius: 5px;
            background: #d7dcdf;
            outline: none;
            padding: 0;
            margin: 0;
        }

        .rotation_range .range-slider__range::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #2c3e50;
            cursor: pointer;
            transition: background .15s ease-in-out;
        }

        .rotation_range .range-slider__range::-webkit-slider-thumb:hover {
            background: #1abc9c;
        }

        .rotation_range .range-slider__range:active::-webkit-slider-thumb {
            background: #1abc9c;
        }

        .rotation_range .range-slider__range::-moz-range-thumb {
            width: 12px;
            height: 12px;
            border: 0;
            border-radius: 50%;
            background: #2c3e50;
            cursor: pointer;
            transition: background .15s ease-in-out;
        }

        .rotation_range .range-slider__range::-moz-range-thumb:hover {
            background: #1abc9c;
        }

        .rotation_range .range-slider__range:active::-moz-range-thumb {
            background: #1abc9c;
        }

        .rotation_range .range-slider__range:focus::-webkit-slider-thumb {
            box-shadow: 0 0 0 2px #fff, 0 0 0 4px #1abc9c;
        }

        .rotation_range .range-slider__range {
            width: 65%;
        }

        .rotation_range .range-slider__value {
            display: inline-block;
            position: relative;
            width: 23px;
            color: #fff;
            line-height: 10px;
            text-align: center;
            border-radius: 3px;
            background: #2c3e50;
            padding: 3px 2px;
            margin-left: 4px;
        }

        .rotation_range .range-slider__value:after {
            position: absolute;
            top: 4px;
            left: -7px;
            width: 0;
            height: 0;
            border-top: 5px solid transparent;
            border-right: 9px solid #2c3e50;
            border-bottom: 5px solid transparent;
            content: '';
        }

        /*end custom range*/
        .custom_color_chose .wp-picker-container, .custom_color_chose_b .wp-picker-container {
            display: inline-block;
        }

        .custom_color_chose .wp-picker-container label, .custom_color_chose_b .wp-picker-container label {
            width: 70px;
        }

        .custom_color_chose .wp-picker-container .wp-picker-clear, .custom_color_chose_b .wp-picker-container .wp-picker-clear {
            width: 70px;
        }

        /*------------------------------------------------------
                            toggle style
        ---------------------------------------------------------*/
        .as-toggle-checkbox {
            height: 0;
            width: 0;
            visibility: hidden;
        }

        .as-toggle-span-label {
            cursor: pointer;
            text-indent: -9999px;
            width: 25px;
            height: 10px;
            background: grey;
            display: inline-block;
            border-radius: 100px;
            position: relative;
            margin-bottom: 0px;
        }

        .as-toggle-span-label:after {
            content: '';
            position: absolute;
            top: 1px;
            left: 1px;
            width: 8px;
            height: 8px;
            background: #fff;
            border-radius: 90px;
            transition: 0.3s;
        }

        .as-toggle-span-label.as-show-desc {
            width: 35px!important;
            height: 15px;
        }

        .as-toggle-span-label.as-show-desc:after {
            width: 13px;
            height: 13px;
        }

        .as-toggle-checkbox:checked + .as-toggle-span-label {
            background: #2c3e50;
        }

        .as-toggle-checkbox:checked + .as-toggle-span-label:after {
            left: calc(100% - 1px);
            transform: translateX(-100%);
        }

        .as-toggle-checkbox:active:after {
            width: 8px;
        }

        /**/
        /* ----------------------- /checkbox-span widget ----------------------- */
        .as-toggle-checkbox {
            position: absolute;
            margin-top: 5px;
        }

        .as-toggle-span-label {
            width: 25px !important;
        }

        .as-toggle-span {
            margin-right: 10px;
        }

        /**/

    </style>

    <script>
        jQuery(document).ready(function () {
            //alert(window.location.hash.substr(1));
            /**************Admin Panel's Setting Tab Start Here For Tab****************/
            var selectLinkTab = jQuery(".nav-tab-wrapper a.nav-tab");
            var selectTabContent = jQuery(".tab-content");
            var tabName = window.location.hash.substr(1);
            if (tabName) {
                removingActiveClass();
                jQuery('#' + tabName).addClass('tab-content-active');
                jQuery('.nav-tab-wrapper a.it_unique_nav_for_' + tabName).addClass('nav-tab-active');
                //console.log(tabName);
            }

            selectLinkTab.click(function (e) {
                var targetTabContent = jQuery(this).data('tab');//getting data value from data-tab attribute
                //window.location.hash = targetTabContent; //Set hash keywork in Address Bar
                e.preventDefault(); //Than prevent for click action of hash keyword
                removingActiveClass();

                jQuery(this).addClass('nav-tab-active');
                jQuery('#' + targetTabContent).addClass('tab-content-active');
                //console.log(targetTabContent);
                //window.location.hash = targetTabContent;
            });

            /**
             * Removing current active nav_tab and tab_content element
             *
             * @returns {nothing}
             */
            function removingActiveClass() {
                selectLinkTab.removeClass('nav-tab-active');
                selectTabContent.removeClass('tab-content-active');
                return false;
            }

            /**************Admin Panel's Setting Tab End Here****************/
            /*custom range*/
            var rangeSlider = function () {
                var slider = jQuery('.range-slider'),
                    range = jQuery('.range-slider__range'),
                    value = jQuery('.range-slider__value');

                slider.each(function () {

                    value.each(function () {
                        var value = jQuery(this).prev().attr('value');
                        jQuery(this).html(value);
                    });

                    range.on('input', function () {
                        jQuery(this).next(value).html(this.value);
                    });
                });
            };

            rangeSlider();
            /*end custom range*/
            jQuery( ".color-picker" ).wpColorPicker();

        });
    </script>
    <div style="clear: both;"></div>

</div>
