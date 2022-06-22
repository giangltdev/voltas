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
    static $array_popup = array();
    static $array_tooltip=array();
    static $array_tab = array();
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
        if (get_option('enable_unique_second_mode', 'no') == 'no') {
            add_action('woocommerce_before_shop_loop_item_title', array($this, 'global_label_hook'), 15); // executing global label function
            //Add label on archive [flatsome theme]
            //add_action('flatsome_woocommerce_shop_loop_images', array($this, 'global_label_hook'), 15); // executing global label function

        }

        // Add labels Style on archive page [woodmart main page]
        //add_action('woocommerce_before_shop_loop_item_title', array($this, 'global_label_style_hook'), 15);
        //add_action('woocommerce_before_shop_loop_item_title', array($this, 'global_label_desc_hook'), 15);
        // Add in Flatsome theme
        //add_action('flatsome_woocommerce_shop_loop_images', array($this, 'global_label_style_hook'), 15);
        //add_action('flatsome_woocommerce_shop_loop_images', array($this, 'global_label_desc_hook'), 15);


        // Add labels Style on archive page
        add_action('woocommerce_after_shop_loop', array($this, 'global_label_style_hook'), 15);
        add_action('woocommerce_after_shop_loop', array($this, 'global_label_desc_hook'), 15);

        add_action('woocommerce_after_single_product', array($this, 'global_label_style_hook'), 5);
        add_action('woocommerce_after_single_product', array($this, 'global_label_desc_hook'), 5);

        // Add labels on product detail page
        if (get_option('enable_unique_second_mode', 'no') == 'no') {
            add_action('woocommerce_product_thumbnails', array($this, 'global_label_hook'), 9);
            // Add label on product detail in Flatsome theme
            //add_action('woocommerce_before_single_product_summary', array($this, 'global_label_hook'), 9);
        }
        add_action('woocommerce_product_thumbnails', array($this, 'global_label_style_hook'), 9);
        add_action('woocommerce_product_thumbnails', array($this, 'global_label_desc_hook'), 9);
        // load on Flatesome theme
        //add_action('woocommerce_after_single_product_summary', array($this, 'global_label_style_hook'), 9);
        //add_action('woocommerce_after_single_product_summary', array($this, 'global_label_desc_hook'), 9);

        // Ensure it only shows when setup on second mode
        if (get_option('enable_unique_second_mode', 'no') == 'yes') {
            //add filter for content label
            $this->label_filters = array(
                array('woocommerce_single_product_image_html', array($this, 'show_badge_on_product'), 99, 2),
                //array( 'woocommerce_single_product_image_thumbnail_html', array( $this, 'show_badge_on_product_thumbnail' ), 99, 2 ),
                array('post_thumbnail_html', array($this, 'show_badge_on_product'), 999, 2),
                array('woocommerce_product_get_image', array($this, 'show_badge_on_product'), 999, 2),
            );
            $this->add_label_filters();

        }


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
     * Display labels Popup.
     *
     * Hook into product loop to add the global product labels Popup.
     *
     * @since 1.0.0
     */
    function global_label_desc_hook()
    {
        /*popup*/
        foreach (self::$array_popup as $key => $value) {
            $label = get_post_meta($key, '_unique_global_label', true);
            $label['id'] = $key;
            //// description
            // Get metod of show description label
            $show_desc = (isset($label['show_desc']) && $label['show_desc'] == '1') ? '1' : '0';
            $show_desc_form = (isset($label['show_desc_form'])) ? $label['show_desc_form'] : 'after_meta';
            $content_label = get_post_field('post_content', $label['id']);
            $title_label = get_post_field('post_title', $label['id']);
            $id_label=$label['id'];
            $watermark=($label['show_watermark']=='1')? unique_get_label_html($label):'' ;
            /*            $watermark_align=(isset($label['show_watermark_align']))? $label['show_watermark_align']:'' ;*/

            if($show_desc=='1') {
                if ($show_desc_form == 'click') {
                    $content_div_popup = '';
                    $content_div_popup = '<div id="label_desc_popup_'.$label['id'].'" class="overlay_label_desc_popup">
                                            <div class="label_desc_popup_inner">
                                                <div class="label_popup_header">
                                                    <div class="label_popup_watermark">
                                                        '.$watermark.'
                                                    </div>
                                                    <h2 class="title_label_header">'.$title_label.'</h2>
                                                    <a class="label_popup_close">&times;</a>
                                                </div>
                                                <div class="label_popup_content">'.do_shortcode($content_label).'</div>
                                            </div>
                                        </div>';
                }
            }

            if($show_desc=='1') {
                if ($show_desc_form == 'click' && $content_label != '') {

                    echo $content_div_popup;
                    $unique_script_count = "jQuery(document).ready(
                                                                   function() {

                                                                         //var label_wrap = jQuery('label_popup_header' ).find('.label-wrap').attr('class');

                                                                         jQuery('.label_popup_close').click(function(){
                                                                                 jQuery('#label_desc_popup_".$id_label."').css({'visibility': 'hidden', 'opacity': '0'});
                                                                        });
                                                                        jQuery('.label-wrap').click(function(e){e.preventDefault();});
                                                                        jQuery('.unique-label-id-".$id_label."').click(function(e) {  
                                                                            jQuery('#label_desc_popup_".$id_label."').css({'visibility': 'visible', 'opacity': '1'});
                                                                        });
                                                                        jQuery( document ).on( 'keydown', function ( e ) {
                                                                            if ( e.keyCode === 27 ) { // ESC
                                                                                 jQuery('#label_desc_popup_".$id_label."').css({'visibility': 'hidden', 'opacity': '0'});
                                                                            }
                                                                        });

                                                                   }
                                                             );";
                    ///custom script for add inline
                    wp_enqueue_script('unique-jQuery-front-end-popup', plugins_url('assets/front-end/js/unique-jQuery-front-end-popup.js', __FILE__));
                    // Initialize custom_js
                    wp_add_inline_script('unique-jQuery-front-end-popup', $unique_script_count);

                }
            }
            /// end description
        }
        /*tooltip*/
        foreach (self::$array_tooltip as $key => $value) {
            $label = get_post_meta($key, '_unique_global_label', true);

            $label['id'] = $key;
            //// description
            // Get metod of show description label
            $show_desc = (isset($label['show_desc']) && $label['show_desc'] == '1') ? '1' : '0';
            $show_desc_form = (isset($label['show_desc_form'])) ? $label['show_desc_form'] : 'after_meta';
            $content_label = get_post_field('post_content', $label['id']);
            //$content_label = apply_filters('the_content', $content_label);
            $title_label = get_post_field('post_title', $label['id']);
            $id_label=$label['id'];
            $theme_tooltip=$label['tooltip_theme'];
            $tooltip_animation=$label['tooltip_animation'];
            $animation_duration=$label['animation_duration'];
            $tooltip_position=(isset($label['tooltip_position']) && $label['tooltip_position'] != '') ? $label['tooltip_position'] : "'top'";
            $tooltip_open_on=$label['tooltip_open_on'];
            $tooltip_open=($label['tooltip_open_on']=='click')? 'triggerOpen: {
                                                                        click: true,
                                                                        tap: true
                                                                    },
                                                                    triggerClose: {
                                                                        click: true,
                                                                        tap: true
                                                                    },':'triggerOpen: {
                                                                    mouseenter: true,
                                                                    touchstart: true
                                                                    },
                                                                    triggerClose: {
                                                                        mouseleave: true,
                                                                        originClick: true,
                                                                        touchleave: true
                                                                    },' ;
            $tooltip_delay=$label['tooltip_delay'];
            $tooltip_distance=$label['tooltip_distance'];
            $tooltip_max_width=$label['tooltip_max_width'];
            $tooltip_use_arrow = (isset($label['tooltip_use_arrow']) && $label['tooltip_use_arrow'] == '1') ? '1' : '0';
            //$watermark=($label['show_watermark']=='1')? unique_get_label_html($label):'' ;
            /*            $watermark_align=(isset($label['show_watermark_align']))? $label['show_watermark_align']:'' ;*/
            /*
             * start tooltip description
             */
            if($show_desc=='1') {
                if ($show_desc_form == 'tooltip') {
                    $content_div_popup = '';
                    $content_div_popup = '<div class="tooltip_templates"><span id="tooltip_content_'.$label['id'].'">
                                                <div class="label_tooltip_content">'.do_shortcode($content_label).'</div>
                                          </span></div>';
                }
            }

            if($show_desc=='1') {
                if ($show_desc_form == 'tooltip' && $content_label != '') {

                    echo $content_div_popup;
                    $unique_script_count = "jQuery(document).ready(
                                                                   function() {
                                                                        jQuery('.label-wrap').click(function(e){e.preventDefault();});
                                                                        jQuery('.tooltiptester.unique-label-id-".$label['id']."').tooltipster({
                                                                           contentAsHTML:true,
                                                                           multiple: true,
                                                                           contentCloning: true,
                                                                           animation: '".$tooltip_animation."',
                                                                           animationDuration: ".$animation_duration.",
                                                                           delay: ".$tooltip_delay.",
                                                                           arrow: ".$tooltip_use_arrow.",
                                                                           distance: ".$tooltip_distance.",
                                                                           maxWidth: ".$tooltip_max_width.",
                                                                           side:[".$tooltip_position."],
                                                                           theme: 'tooltipster-".$theme_tooltip."',
                                                                            trigger: 'custom',
                                                                            ".$tooltip_open."
                                                                        });
                                                                   }
                                                             );";
                    $unique_style_count =  ".tooltip_templates { display: none; }";
                    ///custom script for add inline
                    wp_enqueue_script('unique-jQuery-front-end-tooltip', plugins_url('assets/tooltip/tooltipster.bundle.js', __FILE__));
                    // Initialize custom_js
                    wp_add_inline_script('unique-jQuery-front-end-tooltip', $unique_script_count);

                    ///custom script for add inline
                    wp_enqueue_style('unique-Css-front-end-tooltip', plugins_url('assets/tooltip/tooltipster.bundle.css', __FILE__));
                    // Initialize custom_js
                    wp_add_inline_style('unique-Css-front-end-tooltip', $unique_style_count);


                }
            }

            /*
             * end tooltip description
             */
            /// end description
        }
        /*tab*/
        foreach (self::$array_tab as $key => $value) {
            $label = get_post_meta($key, '_unique_global_label', true);
            $label['id'] = $key;
            //// description
            // Get metod of show description label
            $show_desc = (isset($label['show_desc']) && $label['show_desc'] == '1') ? '1' : '0';
            $show_desc_form = (isset($label['show_desc_form'])) ? $label['show_desc_form'] : 'after_meta';
            $content_label = get_post_field('post_content', $label['id']);
            $title_label = get_post_field('post_title', $label['id']);
            $id_label=$label['id'];
            $watermark=($label['show_watermark']=='1')? unique_get_label_html($label):'' ;
            /*            $watermark_align=(isset($label['show_watermark_align']))? $label['show_watermark_align']:'' ;*/

            if($show_desc=='1') {
                if ($show_desc_form == 'tab' && $content_label != '') {

                    add_filter( 'woocommerce_product_tabs', array( $this, 'label_product_tab' ) );

                }
            }

            /// end description
        }
    }

    /**
     * Add the custom tab
     */
    function label_product_tab( $tabs ) {
        $tabs['label_tab'] = array(
            'title'    => __( 'Label Description', 'it-woocommerce-advanced-product-labels-pro' ),
            'callback' => array( $this, 'label_tab_content' ),
            'priority' => 50,
        );
        return $tabs;
    }
    /**
     * Function that displays output for the shipping tab.
     */
    function label_tab_content( $slug, $tab ) {
        foreach (self::$array_tab as $key => $value) {
            $label = get_post_meta($key, '_unique_global_label', true);
            $label['id'] = $key;
            //// description
            // Get metod of show description label
            $show_desc = (isset($label['show_desc']) && $label['show_desc'] == '1') ? '1' : '0';
            $show_desc_form = (isset($label['show_desc_form'])) ? $label['show_desc_form'] : 'after_meta';
            $content_label = get_post_field('post_content', $label['id']);
            $title_label = get_post_field('post_title', $label['id']);
            $watermark=($label['show_watermark']=='1')? unique_get_label_html($label):'' ;

            $id_label=$label['id'];

            if($show_desc=='1') {
                if ($show_desc_form == 'tab' && $content_label != '') {
                    $content_div_popup = '';
                    $content_div_popup = '<div class="label_tab_header">
                                            '.$watermark.'
                                            <h2>'.$title_label.'</h2>
                                        </div>
                                        <div class="label_popup_content">'.do_shortcode($content_label).'</div>';
                    echo $content_div_popup;
                }
            }
            /// end description
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

                $label['rnd'] = 'rnd_' . $rand_id;
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

                /*desc*/
                $show_desc = (isset($label['show_desc']) && $label['show_desc'] == '1') ? '1' : '0';
                $show_desc_form = (isset($label['show_desc_form'])) ? $label['show_desc_form'] : 'after_meta';
                $content_label=$global_label->post_content;

                if($show_desc=='1'&& $show_desc_form=='click'){
                    self::$array_popup[$global_label->ID] = 1;
                }elseif ($show_desc=='1'&& $show_desc_form=='tooltip'){
                    self::$array_tooltip[$global_label->ID] = 1;
                }elseif ($show_desc=='1'&& $show_desc_form=='tab'){
                    self::$array_tab[$global_label->ID] = 1;
                }elseif ($show_desc=='1'&& $show_desc_form!='click'){
                    $position = 41;
                    switch ($show_desc_form) {
                        case 'before_title':
                            $position = 4;
                            break;
                        case 'after_title':
                            $position = 6;
                            break;
                        case 'after_price':
                            $position = 11;
                            break;
                        case 'after_excerpt':
                            $position = 21;
                            break;
                        case 'after_add_to_cart':
                            $position = 31;
                            break;
                        case 'after_meta':
                            $position = 41;
                            break;
                        case 'after_sharing':
                            $position = 51;
                            break;
                    }
                    add_action('woocommerce_single_product_summary', function () use ($content_label) {
                        echo do_shortcode($content_label) . '</br>';
                    }, $position);
                }
                /*desc related product*/
                $show_related = (isset($label['show_related']) && $label['show_related'] == '1') ? '1' : '0';
                $show_related_title = (isset($label['show_related_title']) && $label['show_related_title'] == '1') ? '1' : '0';
                $related_title = (isset($label['related_title'])) ? $label['related_title'] : '';
                $number_related = (isset($label['number_related'])&& $label['number_related']!='') ? $label['number_related'] : '2';
                $related_nav = (isset($label['related_nav']) && $label['related_nav'] == '1') ? 'true' : 'false';
                $related_auto = (isset($label['related_auto']) && $label['related_auto'] == '1') ? 'true' : 'false';
                $related_loop = (isset($label['related_loop']) && $label['related_loop'] == '1') ? 'true' : 'false';
                $number_related_carousel = (isset($label['number_related_carousel'])&& $label['number_related_carousel']!='') ? $label['number_related_carousel'] : '2';
                $margin_carousel = (isset($label['margin_carousel'])&& $label['margin_carousel']!='') ? $label['margin_carousel'] : '10';

                if($show_related=='1'){
                    add_action('woocommerce_after_single_product_summary', function () use ($label,$show_related_title,$related_title,$number_related,$related_nav,$related_auto,$related_loop,$number_related_carousel,$margin_carousel) {
                        /** @var $product WC_Product */
                        //echo "alireza".$label['rnd'];
                        global $product;
                        $title=$related_title;
                        // The args for the loop
                        $args = array(
                            'posts_per_page' => -1,
                            'post__not_in' => array($product->get_id()),
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'product_visibility',
                                    'field'    => 'name',
                                    'terms'    => 'exclude-from-catalog',
                                    'operator' => 'NOT IN',
                                ),
                            ),
                            'post_type' => 'product',

                        );
                        $loop = new WP_Query($args); // The Loop
                        woocommerce_product_loop_start();
                        if ( $loop->have_posts() ) {
                            woocommerce_product_loop_start();
                            ?>
                            <div class="carousel_label_area">

                                <?php ( $show_related_title ? printf( '<h3 class="carousel_label_title">%s</h3>', esc_html( $title ) ) : '' ); ?>

                                <div class="owl-carousel owl_<?php echo $label['rnd']?> owl-theme">

                                    <?php
                                    $temp=1;
                                    while ( $loop->have_posts() ) : $loop->the_post(); ?>
                                        <?php
                                        $condition_groups = $label['conditions'];

                                        if (wpc_match_conditions($condition_groups, array('context' => 'unique'))) :
                                            global $woocommerce, $post, $product;

                                            if($temp<=$number_related) {
                                                ?>
                                                <div class="item">
                                                    <?php wc_get_template_part('content', 'product'); ?>
                                                </div>
                                                <?php
                                                $temp++;
                                            }
                                            wp_reset_postdata();
                                        endif;
                                    endwhile;
                                    ?>
                                </div>
                            </div>

                            <?php
                            woocommerce_product_loop_end();
                            wp_enqueue_script('carousel_desc_js');
                            wp_enqueue_style('carousel_desc_css');

                            $unique_script_count = "jQuery('.owl_".$label['rnd']."').owlCarousel({
                                                        loop:".$related_loop.",
                                                        margin:".$margin_carousel.",
                                                        nav:".$related_nav.",
                                                        autoplay:".$related_auto.",
                                                        responsive:{
                                                            0:{
                                                                items:1
                                                            },
                                                            600:{
                                                                items:2
                                                            },
                                                            1000:{
                                                                items:".$number_related_carousel."
                                                            }
                                                        }
                                                    })";
                            ///custom script for add inline
                            wp_enqueue_script('unique-jQuery-front-end-related', plugins_url('assets/front-end/js/unique-jQuery-front-end-related.js', __FILE__));
                            // Initialize custom_js
                            wp_add_inline_script('unique-jQuery-front-end-related', $unique_script_count);

                        } else {
                            echo __( 'No products found' );
                        }
                        wp_reset_postdata();
                    }, 15);

                }

                self::$array_style[$global_label->ID] = 1;


                switch ($date_mode) {
                    case 'none':
                        $label['advanced'] = isset($label['advanced']) ? $label['advanced'] : 'none';
                        $label['custom_bg_color'] = isset($label['label_custom_background_color']) ? $label['label_custom_background_color'] : '#D9534F';
                        $label['custom_text_color'] = isset($label['label_custom_text_color']) ? $label['label_custom_text_color'] : '#fff';
                        $label['id'] = $global_label->ID;

                        echo unique_get_label_html($label);

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
                                echo unique_get_label_html($label);

                            }
                        endif;

                        break;

                }
            endif;

        endforeach;
    }

}
