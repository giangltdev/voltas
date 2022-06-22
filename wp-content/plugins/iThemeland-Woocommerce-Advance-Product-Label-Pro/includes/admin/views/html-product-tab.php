<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly
?>
<div id='it-woocommerce-advanced-product-labels-pro' class='panel woocommerce_options_panel hidden'>

    <div class='options_group'>
        <?php

            woocommerce_wp_checkbox(array(
                'id' => '_unique_label_exclude',
                'label' => __('Exclude Global Labels', 'it-woocommerce-advanced-product-labels-pro'),
                'description' => __('When checked, global labels will be excluded', 'it-woocommerce-advanced-product-labels-pro'),
            ));

        ?>
    </div>
    <div class='options_group'>
        <!--		<div class='unique-column' style='width: 50%;'>-->
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
                echo '</nav>';

                //////////////////////////////////////////////////////////////////////////////////
                ///////////////////////////////GENERAL TAB HTML///////////////////////////////////
                //////////////////////////////////////////////////////////////////////////////////
                //Now start for Tab Content
                echo '<div class="tab-content tab-content-active" id="general">';
                echo '<div class="fieldwrap">';
                /*  content  */
                woocommerce_wp_select(array(
                    'id' => '_unique_label_type',
                    'class' => 'update-preview',
                    'label' => __('LABEL TYPE', 'it-woocommerce-advanced-product-labels-pro'),
                    'desc_tip' => true,
                    'description' => '',
                    'options' => unique_get_label_types(),
                ));
            ?>
            <div class="unique-alert unique-alert-notice it_hide">
                <span class="unique-closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <strong>Notice!</strong> You need to set the time in the schedule tab.
            </div>

            <div class="unique-global-option" style="padding: 5px 20px 5px 162px!important;">
                <label for='_unique_label_shape'><?php _e('LABEL SHAPE', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
                <div class="itbd-label-shape-wrap" id="_unique_label_shape">
                    <div class="itbd-label-option-wrap" style="padding-left: 0px;">
                        <div class="itbd-label-field-wrap">
                            <?php
                                $t = 1;
                                foreach (unique_get_label_shapes() as $key => $value) :
                            ?>
                                    <div class="itbd-hide-radio">
                                        <input type="radio" id="<?php echo $t; ?>" name="_unique_label_shape" class="itbd-text-design update-preview" value="<?php echo $key; ?>" <?php if ( isset( $label['shape'] ) && $label['shape'] == $key ) { ?>checked="checked"<?php } ?> <?php if ( ! isset( $label['shape'] ) ) { ?>checked="checked"<?php } ?> />
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

            <div class="unique-global-option" style="padding: 5px 20px 5px 162px!important;">
                <label for='_unique_label_style'><?php _e('COUNT DOWN STYLE', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
                <div class="itbd-label-shape-wrap" id="_unique_label_style">
                    <div class="itbd-label-option-wrap" style="padding-left: 0px;">
                        <div class="itbd-label-field-wrap">
                            <?php
                                $t = 100;
                                foreach (unique_get_label_style() as $key => $value) :
                            ?>
                                    <div class="itbd-hide-radio">
                                        <input type="radio" id="<?php echo $t; ?>" name="_unique_label_style" class="itbd-text-design itbd-text-design-style" value="<?php echo $key; ?>" <?php if ( isset( $label['style'] ) && $label['style'] == $key ) { ?>checked="checked"<?php } ?> <?php if ( ! isset( $label['style'] ) ) { ?>checked="checked"<?php } ?> />
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
            <?php
                woocommerce_wp_select(array(
                    'id' => '_unique_label_advanced',
                    'class' => 'update-preview',
                    'label' => __('USE INTELLIGENT LABEL', 'it-woocommerce-advanced-product-labels-pro'),
                    'desc_tip' => true,
                    'description' => '',
                    'options' => unique_get_label_advanced(),
                ));
                woocommerce_wp_text_input(array(
                    'id' => '_unique_label_text',
                    'class' => 'update-preview',
                    'label' => __('LABEL TEXT', 'it-woocommerce-advanced-product-labels-pro'),
                    'desc_tip' => true,
                    'description' => '',
                ));
            ?>
            <p class='form-field unique-global-option'>
                <label for='_unique_label_show_icon'><?php _e('SHOW ICON', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
                <input class="update-preview as-toggle-checkbox" type="checkbox" value='1' name="_unique_label_show_icon" id="_unique_label_show_icon" <?php checked($label['show_icon'], 1); ?>>
                <label class="as-toggle-span-label as-show-icon" for="_unique_label_show_icon"></label>
            </p>

            <div class='unique-global-option custom-icon' style="padding: 5px 20px 5px 162px!important;">
                <label for='_unique_label_badge_icon'><?php _e('CHOOSE ICON', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
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
                <input class="icon-picker-input it-picker-icon" type="text" id='_unique_label_badge_icon' name="_unique_label_badge_icon"
                       value="<?php
                       if ( isset( $label[ 'badge_icon' ] ) ) {
                           echo esc_attr( $label[ 'badge_icon' ] );
                       } else {
                           echo esc_attr( 'dashicons dashicons-plus' );
                       }
                       ?>"/>

            </div>

            <?php
            $label_custom_bg_color = isset($label['custom_bg_color']) ? $label['custom_bg_color'] : '#D9534F';
            $label_custom_text_color = isset($label['custom_text_color']) ? $label['custom_text_color'] : '#fff';

            ?><p class='form-field custom-colors it_hide'>
                    <span class="custom_color_chose">
                        <label for='_unique-custom-background'><?php _e('BACKGROUND COLOR', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
                        <input type='text' name='_unique-custom-background' value='<?php echo $label_custom_bg_color; ?>'
                               id='_unique-custom-background' class='color-picker background-picker' data-alpha-enabled="true"/>
                    </span>
                <span class="custom_color_chose">
                        <label for='_unique-custom-text'><?php _e('TEXT COLOR', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
                        <input type='text' name='_unique-custom-text' value='<?php echo $label_custom_text_color; ?>'
                               id='_unique-custom-text' class='color-picker text-picker' data-alpha-enabled="true"/>
                    </span>
            </p><?php
            woocommerce_wp_select(array(
                'id' => '_unique_label_align',
                'class' => 'unique-select',
                'label' => __('LABEL TEXT ALIGN', 'it-woocommerce-advanced-product-labels-pro'),
                'desc_tip' => true,
                'description' => '',
                'options' => unique_get_label_align(),
            ));

            ?>
            <p class='form-field unique-global-option custom-image it_hide'>
                <label for='_unique_label_image'><?php _e('LABEL IMAGE', 'it-woocommerce-advanced-product-labels-pro'); ?></label>

                <span class="form-field" style="min-width:210px;display:inline-block;">
                        <span id="unique_thumbnail" style="float:left;margin-right:10px;">
                            <img src="<?php wp_enqueue_media();
                            echo(isset($label['image']) && $label['image'] != '' ? $label['image'] : UNIQUE_PLUGIN_URL . '/assets/admin/images/placeholder.png'); ?>"
                                 width="60px" height="60px"/>
                        </span>
                        <span style="line-height:60px;">
                            <input type="hidden" id='_unique_label_image' name='_unique_label_image'
                                   value='<?php $url_pic = isset($label['image']) ? $label['image'] : '';
                                   echo $url_pic; ?>' class="update-preview"/>
                            <button type="button"
                                    class="it_upload_image_button button"><?php _e('+', 'it-woocommerce-advanced-product-labels-pro'); ?></button>
                            <button type="button"
                                    class="it_remove_image_button button"><?php _e('x', 'it-woocommerce-advanced-product-labels-pro'); ?></button>
                        </span>

                        <span class="clear"></span>
                    </span>

                <script type="text/javascript">
                    // Only show the "remove image" button when needed
                    if (!jQuery('#_unique_label_image').val()) {
                        jQuery('.it_remove_image_button').hide();
                        jQuery('#_unique_label_image').val('<?php echo UNIQUE_PLUGIN_URL . '/assets/admin/images/placeholder.png'; ?>');
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

                            jQuery('#_unique_label_image').val(attachment.url);
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
                        jQuery('#_unique_label_image').val('');
                        jQuery('#_unique_label_image').val('<?php echo UNIQUE_PLUGIN_URL . '/assets/admin/images/placeholder.png'; ?>');
                        jQuery('.it_remove_image_button').hide();
                        return false;
                    });

                </script>
            </p>
            <?php
            woocommerce_wp_text_input(array(
                'id' => '_unique_label_class',
                'class' => 'update-preview',
                'label' => __('LABEL CSS CLASS', 'it-woocommerce-advanced-product-labels-pro'),
                'desc_tip' => true,
                'description' => '',
            ));


            echo '</div>'; //End of .fieldwrap
            echo '</div>'; //End of Tab content div
            //////////////////////////////////////////////////////////////////////////////////
            ///////////////////////////////CUSTOMIZE TAB HTML/////////////////////////////////
            //////////////////////////////////////////////////////////////////////////////////
            //Now start for Tab Content
            echo '<div class="tab-content" id="customize">';
            echo '<div class="fieldwrap">';
            /*  content  */
            woocommerce_wp_text_input(array(
                'id' => '_unique_label_font_size',
                'label' => __('FONT SIZE', 'it-woocommerce-advanced-product-labels-pro'),
                'desc_tip' => true,
                'description' => __('px', 'it-woocommerce-advanced-product-labels-pro'),
                'value' => $label['font_size'],
            ));
            woocommerce_wp_text_input(array(
                'id' => '_unique_label_line_height',
                'label' => __('LINE HEIGHT', 'it-woocommerce-advanced-product-labels-pro'),
                'desc_tip' => true,
                'description' => __('( -1 To equalize the height of the LABEL )', 'it-woocommerce-advanced-product-labels-pro'),
                'value' => $label['line_height'],

            ));
            ?>
            <hr class="hr-under-line-height"
                style="border: 0;height: 1px;background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));margin-right: 15px;">
            <?php
            woocommerce_wp_text_input(array(
                'id' => '_unique_label_width',
                'label' => __('WIDTH', 'it-woocommerce-advanced-product-labels-pro'),
                'desc_tip' => true,
                'description' => __('px', 'it-woocommerce-advanced-product-labels-pro'),
                'value' => $label['width'],
            ));
            woocommerce_wp_text_input(array(
                'id' => '_unique_label_height',
                'label' => __('HEIGHT', 'it-woocommerce-advanced-product-labels-pro'),
                'desc_tip' => true,
                'description' => __('px', 'it-woocommerce-advanced-product-labels-pro'),
                'value' => $label['height'],
            ));
            ?>
            <hr class="hr-under-height"
                style="border: 0;height: 1px;background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));margin-right: 15px;">
            <?php
            woocommerce_wp_select(array(
                'id' => '_unique_label_border_style',
                'label' => __('BORDER STYLE', 'it-woocommerce-advanced-product-labels-pro'),
                'options' => unique_get_label_border_style()
            ));

            ?>
            <p class='form-field'>
                <label for='_unique_label_border_width'><?php _e('BORDER WIDTH <small>(px)</small>', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
                <input type='text' value='<?php echo esc_attr($label['border_width_top']); ?>'
                       name="_unique_label_border_width_top" id="_unique_label_border_width_top" size='25'
                       class="update-preview radius_input"
                       placeholder="<?php echo esc_html(_x('Top', 'placeholder', 'it-woocommerce-advanced-product-labels-pro')) ?>">
                <input type='text' value='<?php echo esc_attr($label['border_width_right']); ?>'
                       name="_unique_label_border_width_right" id="_unique_label_border_width_right"
                       size='25' class="update-preview radius_input"
                       placeholder="<?php echo esc_html(_x('Right', 'placeholder', 'it-woocommerce-advanced-product-labels-pro')) ?>">
                <input type='text' value='<?php echo esc_attr($label['border_width_bottom']); ?>'
                       name="_unique_label_border_width_bottom" id="_unique_label_border_width_bottom"
                       size='25' class="update-preview radius_input"
                       placeholder="<?php echo esc_html(_x('Bottom', 'placeholder', 'it-woocommerce-advanced-product-labels-pro')) ?>">
                <input type='text' value='<?php echo esc_attr($label['border_width_left']); ?>'
                       name="_unique_label_border_width_left" id="_unique_label_border_width_left" size='25'
                       class="update-preview radius_input"
                       placeholder="<?php echo esc_html(_x('Left', 'placeholder', 'it-woocommerce-advanced-product-labels-pro')) ?>">
            </p>

            <p class='form-field custom_color_chose_b'>
                <label for='_unique_label_border_color'><?php _e('BORDER COLOR', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
                <input type='text' name='_unique_label_border_color' value='<?php echo $label['border_color']; ?>'
                       id='_unique_label_border_color' class='color-picker' data-alpha-enabled="true"/>
            </p>
            <p class='form-field'>
                <label for='_unique_label_border_radius'><?php _e('BORDER RADIUS <small>(px)</small>', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
                <input type='text' value='<?php echo esc_attr($label['border_r_tl']); ?>'
                       name="_unique_label_border_r_tl" id="_unique_label_border_r_tl" size='25'
                       class="update-preview radius_input"
                       placeholder="<?php echo esc_html(_x('Top Left', 'placeholder', 'it-woocommerce-advanced-product-labels-pro')) ?>">
                <input type='text' value='<?php echo esc_attr($label['border_r_tr']); ?>'
                       name="_unique_label_border_r_tr" id="_unique_label_border_r_tr" size='25'
                       class="update-preview radius_input"
                       placeholder="<?php echo esc_html(_x('Top Right', 'placeholder', 'it-woocommerce-advanced-product-labels-pro')) ?>">
                <input type='text' value='<?php echo esc_attr($label['border_r_br']); ?>'
                       name="_unique_label_border_r_br" id="_unique_label_border_r_br" size='25'
                       class="update-preview radius_input"
                       placeholder="<?php echo esc_html(_x('Bottom Right', 'placeholder', 'it-woocommerce-advanced-product-labels-pro')) ?>">
                <input type='text' value='<?php echo esc_attr($label['border_r_bl']); ?>'
                       name="_unique_label_border_r_bl" id="_unique_label_border_r_bl" size='25'
                       class="update-preview radius_input"
                       placeholder="<?php echo esc_html(_x('Bottom Left', 'placeholder', 'it-woocommerce-advanced-product-labels-pro')) ?>">
            </p>
            <p class='form-field'>
                <label for='_unique_label_padding'><?php _e('PADDING <small>(px)</small>', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
                <input type='text' value='<?php echo esc_attr($label['padding_top']); ?>'
                       name="_unique_label_padding_top" id="_unique_label_padding_top" size='25'
                       class="update-preview radius_input"
                       placeholder="<?php echo esc_html(_x('Top', 'placeholder', 'it-woocommerce-advanced-product-labels-pro')) ?>">
                <input type='text' value='<?php echo esc_attr($label['padding_right']); ?>'
                       name="_unique_label_padding_right" id="_unique_label_padding_right" size='25'
                       class="update-preview radius_input"
                       placeholder="<?php echo esc_html(_x('Right', 'placeholder', 'it-woocommerce-advanced-product-labels-pro')) ?>">
                <input type='text' value='<?php echo esc_attr($label['padding_bottom']); ?>'
                       name="_unique_label_padding_bottom" id="_unique_label_padding_bottom" size='25'
                       class="update-preview radius_input"
                       placeholder="<?php echo esc_html(_x('Bottom', 'placeholder', 'it-woocommerce-advanced-product-labels-pro')) ?>">
                <input type='text' value='<?php echo esc_attr($label['padding_left']); ?>'
                       name="_unique_label_padding_left" id="_unique_label_padding_left" size='25'
                       class="update-preview radius_input"
                       placeholder="<?php echo esc_html(_x('Left', 'placeholder', 'it-woocommerce-advanced-product-labels-pro')) ?>">
            </p>
            <hr class="hr-under-padding"
                style="border: 0;height: 1px;background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));margin-right: 15px;">
            <p class='form-field range-slider'>
                <label for='_unique_label_opacity'><?php _e('OPACITY', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
                <input class="update-preview range-slider__range" type="range"
                       value='<?php echo esc_attr($label['opacity']); ?>' min="0" max="100"
                       name="_unique_label_opacity" id="_unique_label_opacity">
                <span class="range-slider__value">0</span>
            </p>
            <p class='form-field range-slider rotation_range'>
                <label for='_unique_label_rotation'><?php _e('ROTATION', 'it-woocommerce-advanced-product-labels-pro'); ?></label>

                <input class="update-preview range-slider__range" type="range"
                       value='<?php echo esc_attr($label['rotation_x']); ?>' min="0" max="360"
                       name="_unique_label_rotation_x" id="_unique_label_rotation_x">
                <span class="range-slider__value">0</span>
                <?php echo wc_help_tip(__('ROTATION X', 'it-woocommerce-advanced-product-labels-pro')); ?>

                <input class="update-preview range-slider__range" type="range"
                       value='<?php echo esc_attr($label['rotation_y']); ?>' min="0" max="360"
                       name="_unique_label_rotation_y" id="_unique_label_rotation_y">
                <span class="range-slider__value">0</span>
                <?php echo wc_help_tip(__('ROTATION Y', 'it-woocommerce-advanced-product-labels-pro')); ?>


                <input class="update-preview range-slider__range" type="range"
                       value='<?php echo esc_attr($label['rotation_z']); ?>' min="0" max="360"
                       name="_unique_label_rotation_z" id="_unique_label_rotation_z">
                <span class="range-slider__value">0</span>
                <?php echo wc_help_tip(__('ROTATION Z', 'it-woocommerce-advanced-product-labels-pro')); ?>

            </p>
            <p class='form-field'>
                <label for='_unique_label_flip_text'><?php _e('FLIP TEXT', 'it-woocommerce-advanced-product-labels-pro'); ?></label>
                <input class="update-preview as-toggle-checkbox" type="checkbox" value='1'
                       name="_unique_label_flip_text_h"
                       id="_unique_label_flip_text_h" <?php checked($label['flip_text_h'], 1); ?>><label
                        class="as-toggle-span-label" for="_unique_label_flip_text_h"></label>
                <span class="as-toggle-span"><?php _e('FLIP HORIZONTALLY', 'it-woocommerce-advanced-product-labels-pro'); ?></span>
                <input class="update-preview as-toggle-checkbox" type="checkbox" value='1'
                       name="_unique_label_flip_text_v"
                       id="_unique_label_flip_text_v" <?php checked($label['flip_text_v'], 1); ?>><label
                        class="as-toggle-span-label" for="_unique_label_flip_text_v"></label>
                <span class="as-toggle-span"><?php _e('FLIP VERTICALLY', 'it-woocommerce-advanced-product-labels-pro'); ?></span>
            </p>
            <hr style="border: 0;height: 1px;background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));margin-right: 15px;">
            <?php
            woocommerce_wp_text_input(array(
                'id' => '_unique_label_pos_top',
                'label' => __('TOP', 'it-woocommerce-advanced-product-labels-pro'),
                'desc_tip' => true,
                'description' => __('px or %', 'it-woocommerce-advanced-product-labels-pro'),
                'value' => $label['pos_top'],
            ));
            woocommerce_wp_text_input(array(
                'id' => '_unique_label_pos_right',
                'label' => __('RIGHT', 'it-woocommerce-advanced-product-labels-pro'),
                'desc_tip' => true,
                'description' => __('px or %', 'it-woocommerce-advanced-product-labels-pro'),
                'value' => $label['pos_right'],
            ));
            woocommerce_wp_text_input(array(
                'id' => '_unique_label_pos_bottom',
                'label' => __('BOTTOM', 'it-woocommerce-advanced-product-labels-pro'),
                'desc_tip' => true,
                'description' => __('px or %', 'it-woocommerce-advanced-product-labels-pro'),
                'value' => $label['pos_bottom'],
            ));
            woocommerce_wp_text_input(array(
                'id' => '_unique_label_pos_left',
                'label' => __('LEFT', 'it-woocommerce-advanced-product-labels-pro'),
                'desc_tip' => true,
                'description' => __('px or %', 'it-woocommerce-advanced-product-labels-pro'),
                'value' => $label['pos_left'],
            ));

            ?>
            <p class='form-field custom-pos'>
                <label for='unique-custom-position'><?php _e('Positioning', 'it-woocommerce-advanced-product-labels-pro'); ?></label>

                <span class="unique-table">
                            <span class="unique-table-row">
                                <span class="unique-table-col"><img
                                            src='<?php echo UNIQUE_PLUGIN_URL.'/assets/admin/images/top-left.png' ?>'
                                            id="unique-pos-top-left" width="40px"></span>
                                <span class="unique-table-col"><img
                                            src='<?php echo UNIQUE_PLUGIN_URL.'/assets/admin/images/top-center.png' ?>'
                                            id="unique-pos-top-center" width="40px"></span>
                                <span class="unique-table-col"><img
                                            src='<?php echo UNIQUE_PLUGIN_URL.'/assets/admin/images/top-right.png' ?>'
                                            id="unique-pos-top-right" width="40px"></span>
                            </span>
                            <span class="unique-table-row">
                                <span class="unique-table-col"><img
                                            src='<?php echo UNIQUE_PLUGIN_URL.'/assets/admin/images/center-left.png' ?>'
                                            id="unique-pos-center-left" width="40px"></span>
                                <span class="unique-table-col"><img
                                            src='<?php echo UNIQUE_PLUGIN_URL.'/assets/admin/images/center.png' ?>'
                                            id="unique-pos-center" width="40px"></span>
                                <span class="unique-table-col"><img
                                            src='<?php echo UNIQUE_PLUGIN_URL.'/assets/admin/images/center-right.png' ?>'
                                            id="unique-pos-center-right" width="40px"></span>
                            </span>
                            <span class="unique-table-row">
                                <span class="unique-table-col"><img
                                            src='<?php echo UNIQUE_PLUGIN_URL.'/assets/admin/images/bottom-left.png' ?>'
                                            id="unique-pos-bottom-left" width="40px"></span>
                                <span class="unique-table-col"><img
                                            src='<?php echo UNIQUE_PLUGIN_URL.'/assets/admin/images/bottom-center.png' ?>'
                                            id="unique-pos-bottom-center" width="40px"></span>
                                <span class="unique-table-col"><img
                                            src='<?php echo UNIQUE_PLUGIN_URL.'/assets/admin/images/bottom-right.png' ?>'
                                            id="unique-pos-bottom-right" width="40px"></span>
                            </span>
                        </span>
            </p>

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
            woocommerce_wp_select(array(
                'id' => '_unique_label_time',
                'class' => 'update-preview',
                'label' => __('USE SCHEDULE', 'it-woocommerce-advanced-product-labels-pro'),
                'options' => unique_get_label_time()
            ));

            $start_date = isset($label['start_date']) ? esc_attr($label['start_date']) : '';
            $end_date = isset($label['end_date']) ? esc_attr($label['end_date']) : '';

            echo '<p class="form-field">
				<label for="_unique_label_start_date">' . esc_html__('LABEL DATE', 'it-woocommerce-advanced-product-labels-pro') . '</label>
				<input type="text" class="short regular-text schedule-datepicker update-preview" name="_unique_label_start_date" id="_unique_label_start_date" value="' . esc_attr($start_date) . '" placeholder="' . esc_html(_x('From&hellip;', 'placeholder', 'it-woocommerce-advanced-product-labels-pro')) . ' YYYY-MM-DD" maxlength="10" pattern="' . esc_attr(apply_filters('woocommerce_date_input_html_pattern', '[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])')) . '" />
				<input type="text" class="short regular-text schedule-datepicker update-preview" name="_unique_label_end_date" id="_unique_label_end_date" value="' . esc_attr($end_date) . '" placeholder="' . esc_html(_x('To&hellip;', 'placeholder', 'it-woocommerce-advanced-product-labels-pro')) . '  YYYY-MM-DD" maxlength="10" pattern="' . esc_attr(apply_filters('woocommerce_date_input_html_pattern', '[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])')) . '" />
				' . wc_help_tip(__('The label will end at the beginning of the set date.', 'it-woocommerce-advanced-product-labels-pro')) . '
			</p>';


            ?>

            <?php

            /*                woocommerce_wp_select( array(
                            'id'      => '_unique_label_align',
                            'label'   => __( 'Label align', 'it-woocommerce-advanced-product-labels-pro' ),
                            'options' => array(
                                'none'   => __( 'None', 'it-woocommerce-advanced-product-labels-pro' ),
                                'left'   => __( 'Left', 'it-woocommerce-advanced-product-labels-pro' ),
                                'right'  => __( 'Right', 'it-woocommerce-advanced-product-labels-pro' ),
                                'center' => __( 'Center', 'it-woocommerce-advanced-product-labels-pro' ),
                            ),
                        ) );*/

            echo '</div>'; //End of .fieldwrap
            echo '</div>'; //End of Tab content div


            ?>
        </div>

        <!--		<div class='unique-column' style='width: 20%; margin-top: 20px; padding-left: 40px; border-left: 1px solid #ddd;'>-->


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

        <!--			<div id='unique-label-preview'>
                            <img width='150' height='150' title='' alt='' src='<?php /*echo apply_filters( 'unique_preview_image_src', 'data:image/gif;base64,R0lGODdhlgCWAOMAAMzMzJaWlr6+vpycnLGxsaOjo8XFxbe3t6qqqgAAAAAAAAAAAAAAAAAAAAAAAAAAACwAAAAAlgCWAAAE/hDISau9OOvNu/9gKI5kaZ5oqq5s675wLM90bd94ru987//AoHBILBqPyKRyyWw6n9CodEqtWq/YrHbL7Xq/4LB4TC6bz+i0es1uu9/wuHxOr9vv+Lx+z+/7/4CBgoOEhYaHiImKi4yNjo+QkZKTlJWWl5iZmpucnZ6foHcCAwMTAaenBxMCBQEFBiajpRKoqautr2cEp7MApwjAAhIGA64BvSK7x6YBwAjCAMTGyGK7rb3LFbsEAAgBqsnTptQA293fZQaq2b7krbACzSPq7eMW7wDxCGjsxwTPE4oNc2XhlIB4ATT0G/APGgCB0Qie6VcL2kIL3oDJy0ARlUVsz+TEsEPw6sDGi/dIFdgwsuRJkPxCZkNZAaFDDOwozIQ5MSREiAYkVggaAJZCnwkfJg26sucEcEol4NN3QRm3o08DJp260Uw2k9yYSjDnDarOAgVC6pwFNmJTsujKoD3VtFjauNKuXWh1wGSBffdaSbRbDFzenGNqLb12VcIoV0YrnKI1uWCtYYwpPM4VqrPnz6BDix5NurTp06hTq17NurXr17Bjy55Nu7bt27hz697Nu7fv38CDCx9OvLjx48iTK1/OvLnz59CjS59OvfqLCAA7' ); */ ?>' /><?php
        /*
                        echo unique_get_label_html( $label );

                        */ ?><p><strong>Product name</strong></p>
                        </div>
            -->
        <!--        </div>-->
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
            /*height: 100%;*/
            vertical-align: top;
            overflow: auto;
            height: 500px;
        }

        .it_column_preview {
            display: inline-block;
            height: 100%;
            vertical-align: top;
            width: 33%;
            margin: 0 auto;
            text-align: center;
            height: 500px;
        }

        .preview_titel {
            display: block;
            margin-right: 0;
            background-color: #eef1fd;
            margin-bottom: 40px !important;
            height: 60px;
            box-shadow: inset 0 3px 0 #172b4d!important;
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
            margin-top: 54px;
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
            /*width: 100px;*/
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
        .custom_color_chose {
            display: block;
        }

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
            margin: 0 !important;
            float: none !important;
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
            font-size: 8px;
        }

        /**/
        .unique-table-row {
            display: block;
        }
    </style>

    <script>
        jQuery(document).ready(function () {
            //console.log("test");
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

</div>
