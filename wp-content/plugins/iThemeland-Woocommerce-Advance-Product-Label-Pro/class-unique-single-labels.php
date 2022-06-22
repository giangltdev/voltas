<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Class unique_Single_label
 *
 * unique single label class, load single label config.
 *
 * @class       unique_Single_label
 * @version     1.0.0
 * @author      iThemelandco
 */
class unique_Single_Labels
{


    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {

        // Add the product tabs
        add_filter('woocommerce_product_data_tabs', array($this, 'add_product_label_tab'));
        add_action('woocommerce_product_data_panels', array($this, 'product_label_tab_settings'));

        // Update meta from the above settings
        add_action('woocommerce_process_product_meta', array($this, 'update_product_tab_settings'));

        // Hook in on te product title
        add_action('woocommerce_before_shop_loop_item_title', array($this, 'product_label_template_hook'), 15);

        // Add labels on product detail page
        add_action('woocommerce_product_thumbnails', array($this, 'product_label_template_hook'), 9);

    }

    /**
     * Label products tab.
     *
     * Display 'iThemeland labels' tab on edit product page.
     *
     * @since 1.0.0
     *
     * @param  array $tabs Existing tabs.
     * @return array       Modified settings tabs, containing 'Product label'.
     */
    public function add_product_label_tab($tabs)
    {

        $tabs['labels_pro'] = array(
            'label' => __('iThemeland label', 'it-woocommerce-advanced-product-labels-pro'),
            'target' => 'it-woocommerce-advanced-product-labels-pro',
            'class' => array('it-woocommerce-advanced-product-labels-pro'),
        );

        return $tabs;

    }


    /**
     * Settings in 'Product label' tab.
     *
     * Configure and display the settings in the 'Product data' meta box
     *
     * @since 1.0.0
     */
    public function product_label_tab_settings()
    {

        $label = $this->get_label_data();

        require 'includes/admin/views/html-product-tab.php';

    }


    /**
     * Update single product label
     *
     * @since 1.0.0
     */
    public function update_product_tab_settings()
    {

        global $post;

        // Save each field in separate post meta, needed for WC
        $meta_keys = array(
            '_unique_label_type',
            '_unique_label_shape',
            '_unique_label_style',
            '_unique_label_advanced',
            '_unique_label_text',
            '_unique_label_show_icon',
            '_unique_label_badge_icon',
            '_unique-custom-background',
            '_unique-custom-text',
            '_unique_label_align',
            '_unique_label_image',
            '_unique_label_class',
            '_unique_label_font_size',
            '_unique_label_line_height',
            '_unique_label_width',
            '_unique_label_height',
            '_unique_label_border_style',
            '_unique_label_border_width_top',
            '_unique_label_border_width_right',
            '_unique_label_border_width_bottom',
            '_unique_label_border_width_left',
            '_unique_label_border_color',
            '_unique_label_border_r_tl',
            '_unique_label_border_r_tr',
            '_unique_label_border_r_br',
            '_unique_label_border_r_bl',
            '_unique_label_padding_top',
            '_unique_label_padding_right',
            '_unique_label_padding_bottom',
            '_unique_label_padding_left',
            '_unique_label_opacity',
            '_unique_label_rotation_x',
            '_unique_label_rotation_y',
            '_unique_label_rotation_z',
            '_unique_label_pos_top',
            '_unique_label_pos_right',
            '_unique_label_pos_bottom',
            '_unique_label_pos_left',
            '_unique_label_time',
            '_unique_label_start_date',
            '_unique_label_end_date',
        );

        foreach ($meta_keys as $meta) :
            if (isset($_POST[$meta])) :
                update_post_meta($post->ID, $meta, sanitize_text_field($_POST[$meta]));
            endif;

        endforeach;

        if (isset($_POST['_unique_label_exclude'])) :
            update_post_meta($post->ID, '_unique_label_exclude', 'yes');
        else :
            update_post_meta($post->ID, '_unique_label_exclude', 'no');
        endif;

        if (isset($_POST['_unique_label_flip_text_h'])) :
            update_post_meta($post->ID, '_unique_label_flip_text_h', '1');
        else :
            update_post_meta($post->ID, '_unique_label_flip_text_h', '0');
        endif;
        if (isset($_POST['_unique_label_flip_text_v'])) :
            update_post_meta($post->ID, '_unique_label_flip_text_v', '1');
        else :
            update_post_meta($post->ID, '_unique_label_flip_text_v', '0');
        endif;

    }


    /**
     * Hook label in product loop.
     *
     * Echo's the product label @hook 'woocommerce_before_shop_loop_item_title'.
     *
     * @since 1.0.0
     */
    public function product_label_template_hook()
    {

        global $post;
        if (get_option('show_unique_on_detail_pages', 'no') == 'no' && is_singular('product')) {
            return;
        }
        $label = $this->get_label_data();

        if (!empty($label['text'])) {
            if ($label['type'] == 'label') {
                include plugin_dir_path(__FILE__) . 'includes/front-end/unique-label-style.php';
            }
            if ($label['type'] == 'flash') {
                include plugin_dir_path(__FILE__) . 'includes/front-end/unique-shape-style.php';
            }
            if ($label['type'] == 'count-down') {
                include plugin_dir_path(__FILE__) . 'includes/front-end/unique-count-down-style.php';
            }
            if ($label['type'] == 'image') {
                include plugin_dir_path(__FILE__) . 'includes/front-end/unique-image-style.php';
            }

            $sales_price_from = get_post_meta($post->ID, '_sale_price_dates_from', true);
            $sales_price_to = get_post_meta($post->ID, '_sale_price_dates_to', true);

            $date_mode = (isset($label['time'])) ? esc_attr($label['time']) : '';
            $global_mode = (isset($label['time']) && $label['time'] == 'global') ? 'global' : '';
            $product_mode = (isset($label['time']) && $label['time'] == 'product') ? 'product' : '';

            $today = strtotime(current_time('Y-m-d', $gmt = 0));
            $start_date = (isset($label['start_date'])) ? esc_attr(strtotime($label['start_date'])) : $today;
            $end_date = (isset($label['end_date'])) ? esc_attr(strtotime($label['end_date'])) : '';

            if ($sales_price_from == '') {
                $sales_price_from = $today;
            }
            $rand_id = rand(1000, 99999);
            $label['rnd'] = 'rnd_' . $rand_id;
            switch ($date_mode) {
                case 'none':
                    $label['advanced'] = isset($label['advanced']) ? $label['advanced'] : 'none';
                    $label['custom_bg_color'] = isset($label['label_custom_background_color']) ? $label['label_custom_background_color'] : '#D9534F';
                    $label['custom_text_color'] = isset($label['label_custom_text_color']) ? $label['label_custom_text_color'] : '#fff';

                    echo unique_get_label_html($label);

                    break;
                case 'product':
                    if (isset($product_mode, $sales_price_from, $sales_price_to) && !empty($product_mode) && !empty($sales_price_from) && !empty($sales_price_to)):
                        if ($today >= $sales_price_from && $today < $sales_price_to) {
                            $label['advanced'] = isset($label['advanced']) ? $label['advanced'] : 'none';
                            $label['custom_bg_color'] = isset($label['label_custom_background_color']) ? $label['label_custom_background_color'] : '#D9534F';
                            $label['custom_text_color'] = isset($label['label_custom_text_color']) ? $label['label_custom_text_color'] : '#fff';
                            $bet_date = date('Y/m/d', $sales_price_to);
                            $seconds = $sales_price_to - $today;
                            if ($label['type'] == 'count-down') {
                                if ($label['style'] == 'style-6' || $label['style'] == 'style-7' || $label['style'] == 'style-8') {
                                    $unique_script_count = "// Flip Clock
                                                            var clock;
                                                            jQuery(document).ready(function() {
                                                                var clock;
                                                                clock = jQuery('.rnd_" . $rand_id . ".unique-label-id-" . $label['id'] . " .ribbon-clock').FlipClock({
                                                                    clockFace: 'DailyCounter',
                                                                    autoStart: false,
                                                                });
                                                                clock.setTime(" . $seconds . ");
                                                                clock.setCountdown(true);
                                                                clock.start();
                                                            });";

                                } else {
                                    $unique_script_count = "//clock
                                                             jQuery('.rnd_" . $rand_id . ".unique-label-id-" . $label['id'] . " .ribbon-clock').countdown('" . $bet_date . "', function(event) {
                                                                jQuery(this).html(event.strftime('%D days %H:%M:%S'));
                                                             });";
                                }
                                wp_enqueue_script('unique-jQuery-front-end', plugins_url('assets/front-end/js/unique-jQuery-front-end.js', __FILE__));
                                wp_add_inline_script('unique-jQuery-front-end', $unique_script_count);

                            }
                            echo unique_get_label_html($label);
                        }
                    endif;
                    break;
                case 'global':
                    if (isset($global_mode, $start_date, $end_date) && !empty($global_mode) && !empty($start_date) && !empty($end_date)):
                        if ($today >= $start_date && $today < $end_date) {
                            $label['advanced'] = isset($label['advanced']) ? $label['advanced'] : 'none';
                            $label['custom_bg_color'] = isset($label['label_custom_background_color']) ? $label['label_custom_background_color'] : '#D9534F';
                            $label['custom_text_color'] = isset($label['label_custom_text_color']) ? $label['label_custom_text_color'] : '#fff';
                            $bet_date = date('Y/m/d', $end_date);
                            $seconds = $end_date - $today;
                            if ($label['type'] == 'count-down') {
                                if ($label['style'] == 'style-6' || $label['style'] == 'style-7' || $label['style'] == 'style-8') {
                                    $unique_script_count = "// Flip Clock
                                                            var clock;
                                                            jQuery(document).ready(function() {
                                                                var clock;       
                                                                clock = jQuery('.rnd_" . $rand_id . ".unique-label-id-" . $label['id'] . " .ribbon-clock').FlipClock({
                                                                    clockFace: 'DailyCounter',
                                                                    autoStart: false,
                                                                });
                                                                clock.setTime(" . $seconds . ");
                                                                clock.setCountdown(true);
                                                                clock.start();
                                                            });";
                                } else {
                                    $unique_script_count = "//clock
                                                             jQuery('.rnd_" . $rand_id . ".unique-label-id-" . $label['id'] . " .ribbon-clock').countdown('" . $bet_date . "', function(event) {
                                                                jQuery(this).html(event.strftime('%D days %H:%M:%S'));
                                                             });";

                                }
                                ///custom script for add inline
                                wp_enqueue_script('unique-jQuery-front-end', plugins_url('assets/front-end/js/unique-jQuery-front-end.js', __FILE__));
                                // Initialize custom_js
                                wp_add_inline_script('unique-jQuery-front-end', $unique_script_count);

                            }
                            echo unique_get_label_html($label);

                        }
                    endif;

                    break;

            }
        }

    }


    /**
     * Return label data.
     *
     * @since 1.0.0
     *
     * @param  int $product_id
     * @return array
     */
    public function get_label_data($product_id = null)
    {

        if (!$product_id) :
            global $post;
            $product_id = $post->ID;
        endif;

        $data = array(
            'id' => $product_id,
            'exclude' => get_post_meta($product_id, '_unique_label_exclude', true),
            'type' => get_post_meta($product_id, '_unique_label_type', true),
            'shape' => get_post_meta($product_id, '_unique_label_shape', true),
            'style' => get_post_meta($product_id, '_unique_label_style', true),
            'advanced' => get_post_meta($product_id, '_unique_label_advanced', true),
            'text' => get_post_meta($product_id, '_unique_label_text', true),
            'show_icon' => get_post_meta($product_id, '_unique_label_show_icon', true),
            'badge_icon' => get_post_meta($product_id, '_unique_label_badge_icon', true),
            'custom_bg_color' => get_post_meta($product_id, '_unique-custom-background', true),
            'custom_text_color' => get_post_meta($product_id, '_unique-custom-text', true),
            'align' => get_post_meta($product_id, '_unique_label_align', true),
            'image' => get_post_meta($product_id, '_unique_label_image', true),
            'class' => get_post_meta($product_id, '_unique_label_class', true),
            'font_size' => get_post_meta($product_id, '_unique_label_font_size', true),
            'line_height' => get_post_meta($product_id, '_unique_label_line_height', true),
            'width' => get_post_meta($product_id, '_unique_label_width', true),
            'height' => get_post_meta($product_id, '_unique_label_height', true),
            'border_style' => get_post_meta($product_id, '_unique_label_border_style', true),
            'border_width_top' => get_post_meta($product_id, '_unique_label_border_width_top', true),
            'border_width_right' => get_post_meta($product_id, '_unique_label_border_width_right', true),
            'border_width_bottom' => get_post_meta($product_id, '_unique_label_border_width_bottom', true),
            'border_width_left' => get_post_meta($product_id, '_unique_label_border_width_left', true),
            'border_color' => get_post_meta($product_id, '_unique_label_border_color', true),
            'border_r_tl' => get_post_meta($product_id, '_unique_label_border_r_tl', true),
            'border_r_tr' => get_post_meta($product_id, '_unique_label_border_r_tr', true),
            'border_r_br' => get_post_meta($product_id, '_unique_label_border_r_br', true),
            'border_r_bl' => get_post_meta($product_id, '_unique_label_border_r_bl', true),
            'padding_top' => get_post_meta($product_id, '_unique_label_padding_top', true),
            'padding_right' => get_post_meta($product_id, '_unique_label_padding_right', true),
            'padding_bottom' => get_post_meta($product_id, '_unique_label_padding_bottom', true),
            'padding_left' => get_post_meta($product_id, '_unique_label_padding_left', true),
            'opacity' => get_post_meta($product_id, '_unique_label_opacity', true),
            'rotation_x' => get_post_meta($product_id, '_unique_label_rotation_x', true),
            'rotation_y' => get_post_meta($product_id, '_unique_label_rotation_y', true),
            'rotation_z' => get_post_meta($product_id, '_unique_label_rotation_z', true),
            'flip_text_h' => get_post_meta($product_id, '_unique_label_flip_text_h', true),
            'flip_text_v' => get_post_meta($product_id, '_unique_label_flip_text_v', true),
            'pos_top' => get_post_meta($product_id, '_unique_label_pos_top', true),
            'pos_right' => get_post_meta($product_id, '_unique_label_pos_right', true),
            'pos_bottom' => get_post_meta($product_id, '_unique_label_pos_bottom', true),
            'pos_left' => get_post_meta($product_id, '_unique_label_pos_left', true),
            'time' => get_post_meta($product_id, '_unique_label_time', true),
            'start_date' => get_post_meta($product_id, '_unique_label_start_date', true),
            'end_date' => get_post_meta($product_id, '_unique_label_end_date', true),
            'style_attr' => '',
        );
        if (empty($data['font_size'])) {
            $data['font_size'] = '12';
        }
        if (empty($data['line_height'])) {
            $data['line_height'] = '-1';
        }
        if (empty($data['width'])) {
            $data['width'] = '80';
        }
        if (empty($data['height'])) {
            $data['height'] = '30';
        }
        if (empty($data['opacity'])&& $data['opacity']!='0') {
            $data['opacity'] = '100';
        }
        if (empty($data['rotation_x'])&& $data['rotation_x']!='0') {
            $data['rotation_x'] = '360';
        }
        if (empty($data['rotation_y'])&& $data['rotation_y']!='0') {
            $data['rotation_y'] = '360';
        }
        if (empty($data['rotation_z'])&& $data['rotation_z']!='0') {
            $data['rotation_z'] = '360';
        }

        if (empty($data['pos_top'])&& $data['pos_top']!='0') {
            $data['pos_top'] = '154';
        }
        if (empty($data['pos_right'])&& $data['pos_right']!='0') {
            $data['pos_right'] = 'auto';
        }
        if (empty($data['pos_bottom'])&& $data['pos_bottom']!='0') {
            $data['pos_bottom'] = 'auto';
        }
        if (empty($data['pos_left'])&& $data['pos_left']!='0') {
            $data['pos_left'] = '35';
        }
        if (empty($data['border_color'])) {
            $data['border_color'] = '#D9534F';
        }

        if (empty($data['custom_bg_color'])) {
            $data['custom_bg_color'] = '#D9534F';
        }
        if (empty($data['custom_text_color'])) {
            $data['custom_text_color'] = '#fff';
        }

        return $data;

    }


}
