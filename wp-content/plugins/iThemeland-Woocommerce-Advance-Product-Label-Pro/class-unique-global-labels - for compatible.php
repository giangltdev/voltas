<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Class iThemeland_Woocommerce_Advanced_Product_Labels_Pro_Globals
 *
 * Handle the global product labels
 *
 * @class        iThemeland_Woocommerce_Advanced_Product_Labels_Pro_Globals
 * @author        iThemelandco
 * @package    iThemeland WooCommerce Advanced Product Labels Pro
 * @version        1.0.0
 */
class unique_Global_Labels
{
    static $array_style = array();
    public $label_filters = array();

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {

        // Double insurance to not load on admin. Using shortcodes like [products ids] can cause fatals.
        if (is_admin()) return;

        // Add labels on archive page
        //add_action('woocommerce_before_shop_loop_item_title', array($this, 'global_label_hook'), 15); // executing global label function

        // Add labels Style on archive page
        add_action('woocommerce_after_shop_loop', array($this, 'global_label_style_hook'), 15);
        add_action('woocommerce_after_single_product', array($this, 'global_label_style_hook'), 5);

        // Add labels on product detail page
        //add_action('woocommerce_product_thumbnails', array($this, 'global_label_hook'), 9);
        add_action('woocommerce_product_thumbnails', array($this, 'global_label_style_hook'), 9);

        //add filter for content label
        $this->label_filters = array(
            array('woocommerce_single_product_image_html', array($this, 'show_badge_on_product'), 99, 2),
            //array( 'woocommerce_single_product_image_thumbnail_html', array( $this, 'show_badge_on_product_thumbnail' ), 99, 2 ),
            array('post_thumbnail_html', array($this, 'show_badge_on_product'), 999, 2),
            array('woocommerce_product_get_image', array($this, 'show_badge_on_product'), 999, 2),
        );
        $this->add_label_filters();

    }

    /**
     * Add label Filters
     *
     */
    public function add_label_filters()
    {
        foreach ($this->label_filters as $label_filter) {
            add_filter($label_filter[0], $label_filter[1], $label_filter[2], $label_filter[3]);
        }
    }

    /**
     * Edit image in products
     *
     * @access public
     * @param                     $val string product image
     * @param int|bool|WC_Product $product
     *
     * @return string
     */
    public function show_badge_on_product($val, $product = false)
    {

        // prevent multiple badge copies
        if (strpos($val, 'container-image-and-label') > 0)
            return $val;

        $val = "<div class='container-image-and-label'>" . $val .$this->global_label_hook(). "</div><!--container-image-and-label-->";
        return $val;

    }
    public function show_badge_on_product_thumbnail( $val, $thumb_id = 0 ) {
        global $product;
        if ( !did_action( 'woocommerce_product_thumbnails' ) && $product ) {

                $print_badges_directly = false;
                $div_close             = '</div>';
                if ( version_compare( WC()->version, '3.0', '>=' ) && get_theme_support( 'wc-product-gallery-slider' ) ) {
                    $_val = $val;
                    $_val = rtrim( $_val );
                    if ( strrpos( $_val, $div_close ) === strlen( $_val ) - strlen( $div_close ) ) {
                        $print_badges_directly = true;
                        $val                   = $_val;
                    }
                }

                if ( $print_badges_directly ) {
                    $val      = substr( $val, 0, -strlen( $div_close ) );
                    $val .=$this->global_label_hook();
                    $val .= $div_close;
                } else {
                    $val = $this->show_badge_on_product();
                }
        }

        return $val;
    }

    /**
     * Display labels Style.
     *
     * Hook into product loop to add the global product labels Style.
     *
     * @since 1.0.0
     */
    function global_label_style_hook()
    {

        foreach (self::$array_style as $key => $value) {
            $label = get_post_meta($key, '_unique_global_label', true);
            $label['custom_bg_color'] = isset($label['label_custom_background_color']) ? $label['label_custom_background_color'] : '#D9534F';
            $label['custom_text_color'] = isset($label['label_custom_text_color']) ? $label['label_custom_text_color'] : '#fff';
            $label['id'] = $key;
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
        }
    }

    /**
     * Display labels.
     *
     * Hook into product loop to add the global product labels.
     *
     * @since 1.0.0
     */
    public function global_label_hook()
    {

        /** @var $product WC_Product */
        global $product;
        $label_content='';
        // Stop if global labels are disabled
        if ('no' == get_option('enable_unique', 'yes')) :
            return;
        endif;

        // Ensure it only shows when setup on detail pages
        if (get_option('show_unique_on_detail_pages', 'no') == 'no' && is_singular('product')) {
            return;
        }

        // Check if product is excluded from Global Labels
        if ('yes' == get_post_meta($product->get_id(), '_unique_label_exclude', true)) {
            return;
        }
        $sales_price_from = get_post_meta($product->get_id(), '_sale_price_dates_from', true);
        $sales_price_to = get_post_meta($product->get_id(), '_sale_price_dates_to', true);

        // Get all global labels
        if (false === $global_labels = wp_cache_get('global_labels', 'it-woocommerce-advanced-product-labels-pro')) {
            $global_labels = unique_get_advanced_product_labels(array('suppress_filters' => false));
            wp_cache_set('global_labels', $global_labels, 'it-woocommerce-advanced-product-labels-pro');
        }

        // Loop through each global label
        foreach ($global_labels as $global_label) :
            $rand_id = rand(1000, 99999);
            // Retrieve label data and conditions
            $label = get_post_meta($global_label->ID, '_unique_global_label', true);
            $condition_groups = $label['conditions'];


            // if one of the condition groups match, echo the label
            if (wpc_match_conditions($condition_groups, array('context' => 'unique'))) :

                /* for schedule*/
                $date_mode = (isset($label['time'])) ? esc_attr($label['time']) : '';
                $global_mode = (isset($label['time']) && $label['time'] == 'global') ? 'global' : '';
                $product_mode = (isset($label['time']) && $label['time'] == 'product') ? 'product' : '';

                $today = strtotime(current_time('Y-m-d', $gmt = 0));
                $start_date = (isset($label['start_date'])) ? esc_attr(strtotime($label['start_date'])) : $today;
                $end_date = (isset($label['end_date'])) ? esc_attr(strtotime($label['end_date'])) : '';

                if ($sales_price_from == '') {
                    $sales_price_from = $today;
                }

                self::$array_style[$global_label->ID] = 1;

                $label['rnd'] = 'rnd_' . $rand_id;
                switch ($date_mode) {
                    case 'none':
                        $label['advanced'] = isset($label['advanced']) ? $label['advanced'] : 'none';
                        $label['custom_bg_color'] = isset($label['label_custom_background_color']) ? $label['label_custom_background_color'] : '#D9534F';
                        $label['custom_text_color'] = isset($label['label_custom_text_color']) ? $label['label_custom_text_color'] : '#fff';
                        $label['id'] = $global_label->ID;

                        //echo unique_get_label_html($label);
                        $label_content.= unique_get_label_html($label);

                        break;
                    case 'product':
                        if (isset($product_mode, $sales_price_from, $sales_price_to) && !empty($product_mode) && !empty($sales_price_from) && !empty($sales_price_to)):
                            if ($today >= $sales_price_from && $today < $sales_price_to) {
                                $label['advanced'] = isset($label['advanced']) ? $label['advanced'] : 'none';
                                $label['custom_bg_color'] = isset($label['label_custom_background_color']) ? $label['label_custom_background_color'] : '#D9534F';
                                $label['custom_text_color'] = isset($label['label_custom_text_color']) ? $label['label_custom_text_color'] : '#fff';
                                $label['id'] = $global_label->ID;
                                $bet_date = date('Y/m/d', $sales_price_to);
                                $seconds = $sales_price_to - $today;
                                /*count down script*/
                                if ($label['type'] == 'count-down') {
                                    if ($label['style'] == 'style-6' || $label['style'] == 'style-7' || $label['style'] == 'style-8') {
                                        $unique_script_count = "// Flip Clock
                                                                var clock;
                                                                jQuery(document).ready(function() {
                                                                    var clock;                                            
                                                                    clock = jQuery('.rnd_" . $rand_id . ".unique-label-id-" . $global_label->ID . " .ribbon-clock').FlipClock({
                                                                        clockFace: 'DailyCounter',
                                                                        autoStart: false,
                                                                    });
                                                                    clock.setTime(" . $seconds . ");
                                                                    clock.setCountdown(true);
                                                                    clock.start();
                                                                });";
                                    } else {
                                        $unique_script_count = "//clock
                                                                 jQuery('.rnd_" . $rand_id . ".unique-label-id-" . $global_label->ID . " .ribbon-clock').countdown('" . $bet_date . "', function(event) {
                                                                    jQuery(this).html(event.strftime('%D days %H:%M:%S'));
                                                                 });";
                                    }
                                    /*end after save label*/
                                    ///custom script for add inline
                                    wp_enqueue_script('unique-jQuery-front-end', plugins_url('assets/front-end/js/unique-jQuery-front-end.js', __FILE__));
                                    // Initialize custom_js
                                    wp_add_inline_script('unique-jQuery-front-end', $unique_script_count);

                                }
                                /*end script for count down*/
                                //echo unique_get_label_html($label);
                                $label_content.= unique_get_label_html($label);
                            }
                        endif;
                        break;
                    case 'global':
                        if (isset($global_mode, $start_date, $end_date) && !empty($global_mode) && !empty($start_date) && !empty($end_date)):
                            if ($today >= $start_date && $today < $end_date) {
                                $label['advanced'] = isset($label['advanced']) ? $label['advanced'] : 'none';
                                $label['custom_bg_color'] = isset($label['label_custom_background_color']) ? $label['label_custom_background_color'] : '#D9534F';
                                $label['custom_text_color'] = isset($label['label_custom_text_color']) ? $label['label_custom_text_color'] : '#fff';
                                $label['id'] = $global_label->ID;
                                $bet_date = date('Y/m/d', $end_date);
                                $seconds = $end_date - $today;
                                /*count down script*/
                                if ($label['type'] == 'count-down') {
                                    if ($label['style'] == 'style-6' || $label['style'] == 'style-7' || $label['style'] == 'style-8') {
                                        $unique_script_count = "// Flip Clock
                                                                var clock;
                                                                jQuery(document).ready(function() {
                                                                    var clock;                                            
                                                                    clock = jQuery('.rnd_" . $rand_id . ".unique-label-id-" . $global_label->ID . " .ribbon-clock').FlipClock({
                                                                        clockFace: 'DailyCounter',
                                                                        autoStart: false,
                                                                    });
                                                                    clock.setTime(" . $seconds . ");
                                                                    clock.setCountdown(true);
                                                                    clock.start();
                                                                });";
                                    } else {
                                        $unique_script_count = "//clock
                                                                 jQuery('.rnd_" . $rand_id . ".unique-label-id-" . $global_label->ID . " .ribbon-clock').countdown('" . $bet_date . "', function(event) {
                                                                    jQuery(this).html(event.strftime('%D days %H:%M:%S'));
                                                                 });";
                                    }
                                    /*end after save label*/
                                    ///custom script for add inline
                                    wp_enqueue_script('unique-jQuery-front-end', plugins_url('assets/front-end/js/unique-jQuery-front-end.js', __FILE__));
                                    // Initialize custom_js
                                    wp_add_inline_script('unique-jQuery-front-end', $unique_script_count);

                                }
                                /*end script for count down*/
                                //echo unique_get_label_html($label);
                                $label_content.= unique_get_label_html($label);
                            }
                        endif;

                        break;

                }
            endif;

        endforeach;
        return $label_content;
    }


}
