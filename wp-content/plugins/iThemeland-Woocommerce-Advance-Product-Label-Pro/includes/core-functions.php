<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly


/**
 * Get Product Label posts.
 *
 * Get a list of all the labels that are set.
 *
 * @since 1.0.8
 *
 * @param  array $args List of arguments to merge with the default args.
 * @return array       List of 'unique' posts.
 */
function unique_get_advanced_product_labels($args = array())
{

    $query_args = wp_parse_args($args, array(
        'post_type' => 'unique',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'update_post_term_cache' => false
    ));
    $post_query = new WP_Query($query_args);
    $posts = $post_query->posts;

    return apply_filters('woocommerce_advanced_product_labels_get_labels', $posts);

}


/**
 * Get label types.
 *
 * Get the different label types. Extensible by users.
 *
 * @since 1.0.0
 * @since 1.0.8 - Add $type param
 *
 * @param  string $type Slug of the type to get.
 * @return array|string       Returns pretty name when $type is set, otherwise a list of available types.
 */
function unique_get_label_types($type = '')
{

    $types = apply_filters('unique_label_types', array(
        'none' => __('Choose One', 'it-woocommerce-advanced-product-labels-pro'),
        'label' => __('Label', 'it-woocommerce-advanced-product-labels-pro'),
        'flash' => __('Pre Define Shape', 'it-woocommerce-advanced-product-labels-pro'),
        'count-down' => __('Count Down', 'it-woocommerce-advanced-product-labels-pro'),
        'image' => __('Image', 'it-woocommerce-advanced-product-labels-pro'),
    ));

    if (!empty($type) && isset($types[$type])) {
        return $types[$type];
    }

    return $types;

}

/**
 * Get label shape.
 *
 * Get the different label shape. Extensible by users.
 *
 * @since 1.0.0
 * @since 1.0.8 - Add $shape param
 *
 * @param  string $shape Slug of the type to get.
 * @return array|string       Returns pretty name when $shape is set, otherwise a list of available shapes.
 */
function unique_get_label_shapes($shape = '')
{

    $shapes = apply_filters('unique_label_shapes', array(
        'cut-diamond' => __('Cut Diamond', 'it-woocommerce-advanced-product-labels-pro'),
        'round-star' => __('Round Star', 'it-woocommerce-advanced-product-labels-pro'),
        'ribbon' => __('Ribbon', 'it-woocommerce-advanced-product-labels-pro'),
        'circle-ribbon' => __('Circle Ribbon', 'it-woocommerce-advanced-product-labels-pro'),
        'diamond' => __('Diamond', 'it-woocommerce-advanced-product-labels-pro'),
        'triangle-topleft' => __('Triangle Topleft', 'it-woocommerce-advanced-product-labels-pro'),
        'triangle-topright' => __('Triangle Topright', 'it-woocommerce-advanced-product-labels-pro'),
        'heart' => __('Heart', 'it-woocommerce-advanced-product-labels-pro'),
        'loophole-1' => __('Loophole 1', 'it-woocommerce-advanced-product-labels-pro'),
        'loophole-2' => __('Loophole 2', 'it-woocommerce-advanced-product-labels-pro'),
        'loophole-3' => __('Loophole 3', 'it-woocommerce-advanced-product-labels-pro'),
        'loophole-4' => __('Loophole 4', 'it-woocommerce-advanced-product-labels-pro'),
        'loophole-5' => __('Loophole 5', 'it-woocommerce-advanced-product-labels-pro'),
        'corner-ribbons' => __('Corner Ribbons', 'it-woocommerce-advanced-product-labels-pro'),
        'corner-ribbons-two' => __('Corner Ribbons 2', 'it-woocommerce-advanced-product-labels-pro'),

    ));

    if (!empty($shape) && isset($shapes[$shape])) {
        return $shapes[$shape];
    }

    return $shapes;

}

/**
 * Get label style.
 *
 * Get the different label style. Extensible by users.
 *
 * @since 1.0.0
 * @since 1.0.8 - Add $style param
 *
 * @param  string $style Slug of the type to get.
 * @return array|string       Returns pretty name when $style is set, otherwise a list of available shapes.
 */
function unique_get_label_style($style = '')
{

    $styles = apply_filters('unique_label_style', array(
        'style-1' => __('Style 1', 'it-woocommerce-advanced-product-labels-pro'),
        'style-2' => __('Style 2', 'it-woocommerce-advanced-product-labels-pro'),
        'style-3' => __('Style 3', 'it-woocommerce-advanced-product-labels-pro'),
        'style-4' => __('Style 4', 'it-woocommerce-advanced-product-labels-pro'),
        'style-5' => __('Style 5', 'it-woocommerce-advanced-product-labels-pro'),
        'style-6' => __('Style 6', 'it-woocommerce-advanced-product-labels-pro'),
        'style-7' => __('Style 7', 'it-woocommerce-advanced-product-labels-pro'),
        'style-8' => __('Style 8', 'it-woocommerce-advanced-product-labels-pro'),

    ));

    if (!empty($style) && isset($styles[$style])) {
        return $styles[$style];
    }

    return $styles;

}

function unique_get_label_align($align = '')
{

    $aligns = apply_filters('unique_label_align', array(
        'center' => __('Center', 'it-woocommerce-advanced-product-labels-pro'),
        'left' => __('Left', 'it-woocommerce-advanced-product-labels-pro'),
        'right' => __('Right', 'it-woocommerce-advanced-product-labels-pro'),
    ));

    if (!empty($align) && isset($aligns[$align])) {
        return $aligns[$align];
    }

    return $aligns;

}

function unique_get_label_show_desc_form($show_desc_form = '')
{

    $show_desc_forms = apply_filters('unique_label_show_desc_form', array(
        'before_title' => __('Show Before title', 'it-woocommerce-advanced-product-labels-pro'),
        'after_title' => __('Show After title', 'it-woocommerce-advanced-product-labels-pro'),
        'after_price' => __('Show After price', 'it-woocommerce-advanced-product-labels-pro'),
        'after_excerpt' => __('Show After excerpt', 'it-woocommerce-advanced-product-labels-pro'),
        'after_add_to_cart' => __('Show After add to cart', 'it-woocommerce-advanced-product-labels-pro'),
        'after_meta' => __('Show After meta', 'it-woocommerce-advanced-product-labels-pro'),
        'after_sharing' => __('Show After sharing', 'it-woocommerce-advanced-product-labels-pro'),
        'click' => __('Click on label and show in the popup', 'it-woocommerce-advanced-product-labels-pro'),
        'tab' => __('Show in the Tab to Product Page', 'it-woocommerce-advanced-product-labels-pro'),
        'tooltip' => __('Show in the Tooltip', 'it-woocommerce-advanced-product-labels-pro'),
        /*        'load'   => __( 'On load page ,show in the popup', 'it-woocommerce-advanced-product-labels-pro' ),*/

    ));

    if (!empty($show_desc_form) && isset($show_desc_forms[$show_desc_form])) {
        return $show_desc_forms[$show_desc_form];
    }

    return $show_desc_forms;

}

function unique_get_label_tooltip_theme($tooltip_theme = '')
{

    $tooltip_themes = apply_filters('unique_label_tooltip_theme', array(
        'default' => __('Default', 'it-woocommerce-advanced-product-labels-pro'),
        'light' => __('Light', 'it-woocommerce-advanced-product-labels-pro'),
        'borderless' => __('Borderless', 'it-woocommerce-advanced-product-labels-pro'),
        'punk' => __('Punk', 'it-woocommerce-advanced-product-labels-pro'),
        'noir' => __('Noir', 'it-woocommerce-advanced-product-labels-pro'),
        'shadow' => __('Shadow', 'it-woocommerce-advanced-product-labels-pro'),
    ));

    if (!empty($tooltip_theme) && isset($tooltip_themes[$tooltip_theme])) {
        return $tooltip_themes[$tooltip_theme];
    }

    return $tooltip_themes;

}
function unique_get_label_tooltip_animation($tooltip_animation = '')
{

    $tooltip_animations = apply_filters('unique_label_tooltip_animation', array(
        'fade' => __('Fade', 'it-woocommerce-advanced-product-labels-pro'),
        'grow' => __('Grow', 'it-woocommerce-advanced-product-labels-pro'),
        'swing' => __('Swing', 'it-woocommerce-advanced-product-labels-pro'),
        'slide' => __('Slide', 'it-woocommerce-advanced-product-labels-pro'),
        'fall' => __('Fall', 'it-woocommerce-advanced-product-labels-pro'),
    ));

    if (!empty($tooltip_animation) && isset($tooltip_animations[$tooltip_animation])) {
        return $tooltip_animations[$tooltip_animation];
    }

    return $tooltip_animations;

}

function unique_get_label_tooltip_position($tooltip_position = '')
{

    $tooltip_positions = apply_filters('unique_label_tooltip_position', array(
        'top' => __('Top', 'it-woocommerce-advanced-product-labels-pro'),
        'right' => __('Right', 'it-woocommerce-advanced-product-labels-pro'),
        'bottom' => __('Bottom', 'it-woocommerce-advanced-product-labels-pro'),
        'left' => __('Left', 'it-woocommerce-advanced-product-labels-pro'),
    ));

    if (!empty($tooltip_position) && isset($tooltip_positions[$tooltip_position])) {
        return $tooltip_positions[$tooltip_position];
    }

    return $tooltip_positions;

}

function unique_get_label_tooltip_open_on($tooltip_open_on = '')
{

    $tooltip_open_ons = apply_filters('unique_label_tooltip_open_on', array(
        'click' => __('Click', 'it-woocommerce-advanced-product-labels-pro'),
        'mouseenter' => __('Hover', 'it-woocommerce-advanced-product-labels-pro'),
    ));

    if (!empty($tooltip_open_on) && isset($tooltip_open_ons[$tooltip_open_on])) {
        return $tooltip_open_ons[$tooltip_open_on];
    }

    return $tooltip_open_ons;

}


function unique_get_label_border_style($border_style = '')
{

    $border_styles = apply_filters('unique_label_border_style', array(
        'none' => __('None', 'it-woocommerce-advanced-product-labels-pro'),
        'dotted' => __('Dotted', 'it-woocommerce-advanced-product-labels-pro'),
        'dashed' => __('Dashed', 'it-woocommerce-advanced-product-labels-pro'),
        'solid' => __('Solid', 'it-woocommerce-advanced-product-labels-pro'),
        'double' => __('Double', 'it-woocommerce-advanced-product-labels-pro'),
        'groove' => __('Groove', 'it-woocommerce-advanced-product-labels-pro'),
        'ridge' => __('Ridge', 'it-woocommerce-advanced-product-labels-pro'),
        'inset' => __('Inset', 'it-woocommerce-advanced-product-labels-pro'),
        'outset' => __('Outset', 'it-woocommerce-advanced-product-labels-pro'),

    ));

    if (!empty($border_style) && isset($border_styles[$border_style])) {
        return $border_styles[$border_style];
    }

    return $border_styles;

}

/**
 * Label advanced.
 *
 * Set the available label advanced.
 *
 * @since 1.0.0
 */
function unique_get_label_advanced()
{

    return apply_filters('unique_label_advanced', array(
        'none' => __('None', 'it-woocommerce-advanced-product-labels-pro'),
        'percentage' => __('Percentage', 'it-woocommerce-advanced-product-labels-pro'),
        'discount' => __('Discount', 'it-woocommerce-advanced-product-labels-pro'),
        'price' => __('Regular Price', 'it-woocommerce-advanced-product-labels-pro'),
        'saleprice' => __('Sale Price', 'it-woocommerce-advanced-product-labels-pro'),
        'delprice' => __('Delete Price', 'it-woocommerce-advanced-product-labels-pro'),
    ));

}

/**
 * Label time.
 *
 * Set the available label time.
 *
 * @since 1.0.0
 */
function unique_get_label_time($time = '')
{

    $times = apply_filters('unique_label_time', array(
        'none' => __('None', 'it-woocommerce-advanced-product-labels-pro'),
        'product' => __('Set From Sale Product Schedule', 'it-woocommerce-advanced-product-labels-pro'),
        'global' => __('Set in Here ', 'it-woocommerce-advanced-product-labels-pro'),
    ));

    if (!empty($time) && isset($times[$time])) {
        return $times[$time];
    }

    return $times;

}


/**
 * Label styles.
 *
 * Set the available label styles.
 *
 * @since 1.0.0
 */
function unique_get_label_styles()
{

    return apply_filters('unique_label_styles', array(
        'red' => __('Red', 'it-woocommerce-advanced-product-labels-pro'),
        'blue' => __('Blue', 'it-woocommerce-advanced-product-labels-pro'),
        'green' => __('Green', 'it-woocommerce-advanced-product-labels-pro'),
        'yellow' => __('Yellow', 'it-woocommerce-advanced-product-labels-pro'),
        'orange' => __('Orange', 'it-woocommerce-advanced-product-labels-pro'),
        'gray' => __('Gray', 'it-woocommerce-advanced-product-labels-pro'),
        'black' => __('Black', 'it-woocommerce-advanced-product-labels-pro'),
        'white' => __('White', 'it-woocommerce-advanced-product-labels-pro'),
        'custom' => __('Custom', 'it-woocommerce-advanced-product-labels-pro'),
    ));

}


/**
 * Get the label HTML.
 *
 * Get the formatted HTML of a label based on the passed arguments.
 * This is a replacement of the unique_Label object.
 *
 * @since 1.1.0
 *
 * @param             $args
 * @return mixed|void
 */
function unique_get_label_html($args)
{

    $label = wp_parse_args($args, array(
        'id' => '',
        'rnd' => '',
        'text' => '',
        'show_icon' => '',
        'badge_icon'=>'',
        'style' => '',
        'style_attr' => '',
        'type' => '',
        'advanced' => '',
        'image' => '',
        'align' => '',
        'start_date' => '',
        'end_date' => '',
        'custom_bg_color' => '',
        'custom_text_color' => '',
        'show_desc_form' => '',
    ));

    ob_start();
    $icon_html='';
    if ( ! empty( $label[ 'badge_icon' ] ) ) {
        $value = $label[ 'badge_icon' ];
        $v = explode( '|', $value );
        if ( isset( $v[ 1 ] ) ) {
            $label[ 'badge_icon' ]= $v[ 0 ] . ' ' . $v[ 1 ];
        }
    }
    $icon_html=(isset($label['show_icon']) && $label['show_icon'] == '1') ? '<i class="' . esc_attr($label['badge_icon']) . '" aria-hidden="true"></i>' : '';
    if(isset($label['show_icon']) && $label['show_icon']=='1'){
        wp_enqueue_style('elegant_icons_it_css', plugins_url('/assets/css/elegant-icons.css', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array(), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);
        wp_enqueue_style('linear_style_it_css', plugins_url('/assets/css/linear-style.css', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array(), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);
        wp_enqueue_style('fontawesome_style_it_css', plugins_url('/assets/css/font-awesome.min.css', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array(), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);
        wp_enqueue_style('fontawesome1_style_it_css', plugins_url('/assets/css/fontawesome.css', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array(), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);
        wp_enqueue_style('fa_brands_style_it_css', plugins_url('/assets/css/fa-brands.css', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array(), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);
        wp_enqueue_style('fa_regular_style_it_css', plugins_url('/assets/css/fa-regular.css', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array(), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);
        wp_enqueue_style('fa_solid_style_it_css', plugins_url('/assets/css/fa-solid.css', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array(), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);
    }
    $unique_style = '';
    $unique_shape = '';
    $unique_align = '';
    if ($label['type'] == 'count-down') {
        $unique_style = 'unique-' . $label['style'];
        $unique_time = $label['start_date'];
    } elseif ($label['type'] == 'flash') {
        $unique_shape = 'unique-shape-' . $label['shape'];
    } elseif ($label['type'] == 'label') {
        $unique_align = 'unique-align' . $label['align'];
    }
    ?>
<div
        class="<?php echo ($label['show_desc_form'] == 'tooltip') ? 'tooltiptester' : 'tooltiptester-no'; ?> <?php echo esc_attr($label['rnd']); ?> unique-label-id-<?php echo esc_attr($label['id']); ?> label-wrap unique-<?php echo sanitize_html_class($label['type']); ?> <?php echo ($label['type'] == 'count-down') ? $unique_style : '';
        echo ($label['type'] == 'flash') ? $unique_shape : ''; ?> <?php echo ($label['type'] == 'label') ? $unique_align : ''; ?> <?php echo($label['class']); ?>" <?php echo ($label['show_desc_form'] == 'tooltip') ? 'data-tooltip-content="#tooltip_content_' . $label['id'] . '"' : ''; ?>>
    <div class="woocommerce-advanced-product-label product-label" <?php echo($label['style_attr']); ?>>
        <?php
        if ($label['type'] == 'image') {
            echo '<img class="custom_label_pic" style="width:auto;" src="' . $label['image'] . '"/>';
            echo '<script type="text/javascript">
					 if ( jQuery("#unique_global_label_image").val() ){
						 jQuery("#unique_thumbnail img").attr("src", "' . $label['image'] . '" );	
					 }
                  </script>';

        } elseif ($label['type'] == 'label') {
            echo '<div class="unique-label-text">'.$icon_html . __(wp_kses_post($label['text']), 'it-woocommerce-advanced-product-labels-pro') . '</div>';
        } elseif ($label['type'] == 'flash') {
            echo '<div class="unique-label-text">'.$icon_html . wp_kses_post($label['text']) . '</div>';
        } elseif ($label['type'] == 'count-down') {
            echo '<div class="unique-label-text">'.$icon_html . wp_kses_post($label['text']) . '</div>
                    <div id="clock" class="ribbon-clock "></div>';
            switch ($label['style']) {
                case 'style-1':
                    echo '<div class="unique-count-1"><div class="circle"></div></div>';
                    break;
                case 'style-2':
                    echo '<div class="unique-count-2"></div>';
                    break;
                case 'style-4':
                    echo '<div class="unique-pin"></div>';
                    break;
                case 'style-5':
                    echo '<div class="unique-circle-label"></div>';
                    break;
                case 'style-6':
                    echo '<div class="unique-clear-background"></div>';
                    break;
                case 'style-7':
                    echo '<div class="unique-clock-background"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="50px" height="50px" x="0px" y="0px"viewBox="0 0 612 612" style="enable-background:new 0 0 612 612;" xml:space="preserve"><g><path d="M306,0.006C137,0.006,0,137,0,306s137,305.994,306,305.994C474.994,611.994,612,475,612,306S474.994,0.006,306,0.006zM306,550.795C171.02,550.795,61.205,440.98,61.205,306S171.02,61.205,306,61.205S550.795,171.02,550.795,306S440.98,550.795,306,550.795z"/><path d="M471.524,186.754c-3.898-5.532-11.536-6.848-17.068-2.95l-134.594,94.95c-4.168-2.13-8.868-3.348-13.862-3.348c-2.313,0-4.553,0.282-6.72,0.765l-96.345-81.982c-5.147-4.388-12.864-3.764-17.258,1.389l-7.925,9.314c-4.388,5.147-3.764,12.87,1.383,17.258l96.357,82c-0.037,0.618-0.092,1.23-0.092,1.854c0,15.483,11.573,28.292,26.524,30.293V510h8.164V336.293c14.945-2.007,26.517-14.81,26.517-30.293c0-1.328-0.116-2.625-0.282-3.911l134.601-94.95c5.526-3.898,6.848-11.536,2.95-17.062L471.524,186.754z"/></g></svg></div>';
                    break;
                case 'style-8':
                    echo '<div class="unique-day-background"></div>';
                    break;

            }
        }
        ?>

    </div>
    </div><?php
    $type_advanced = $label['advanced'];
    $label = ob_get_clean();

    return apply_filters('unique_product_label', $label, $type_advanced);

}


/**
 * SMART labels.
 *
 * Add filter to convert SMART labels.
 *
 * @since 1.0.0
 *
 * @param  string $label Label text value.
 * @return string        Modified label text value.
 */
function unique_smart_product_label_filter($label, $type_advanced)
{

    global $product;

    // This in here for the admin preview to select one random product
    if (!$product) :
        $product_posts = get_posts(array('post_type' => 'product', 'posts_per_page' => 1));
        $product = reset($product_posts);
    endif;

    $product = wc_get_product($product);
    $highest_percentage = 0;

    if (!$product) { // Check to be sure the global $product is set properly
        trigger_error('The global $product is not a valid variable type: ' . gettype($product));
        return $label;
    }

    if ($product->is_type('composite')) :

        $regular_price = $product->get_composite_regular_price();
        $sale_price = $product->get_composite_price();
        $highest_percentage = ($sale_price !== '' && $regular_price != 0) ? (($regular_price - $sale_price) / $regular_price * 100) : $highest_percentage;

    elseif (!$product->is_type('variable')) :

        $regular_price = $product->get_regular_price();
        $sale_price = $product->get_sale_price();
        $highest_percentage = ($sale_price !== '' && $regular_price != 0) ? (($regular_price - $sale_price) / $regular_price * 100) : $highest_percentage;

    else : // Get the right variable percentage

        $var_prices = $product->get_variation_prices();
        foreach ($product->get_children() as $child_id) :
            $price = $var_prices['regular_price'][$child_id];
            $sale = $var_prices['sale_price'][$child_id];

            $percentage = $price != 0 && !empty($sale) ? (($price - $sale) / $price * 100) : $highest_percentage;

            if ($percentage >= $highest_percentage) :
                $highest_percentage = $percentage;
                $regular_price = $product->get_variation_regular_price('min');
                $sale_price = $product->get_variation_sale_price('min');
            endif;
        endforeach;

    endif;
    if ($type_advanced != 'none') {
        $label = str_replace('50%', round($highest_percentage, apply_filters('unique_filter_discount_round', 1)) . '%', $label);
        $label = str_replace('$15', wc_price((float)$regular_price - (float)$sale_price), $label);
        $label = str_replace('$12', wc_price($regular_price), $label);
        $label = str_replace('$10', wc_price($sale_price), $label);
        $label = str_replace('<del>$50</del>', '<del>' . wc_price($regular_price) . '</del>', $label);
    }
    return $label;

}

add_filter('unique_product_label', 'unique_smart_product_label_filter', 10, 2);

/**
 * Gallery fix JS line.
 *
 * Add a line of JS that changes the positioning of the HTML for galleries
 * as the styles are not applied as wished there.
 *
 * @since 1.2.0
 */
function unique_add_js_gallery_fix()
{
    wc_enqueue_js("
    jQuery('.label-wrap', jQuery('.woocommerce-product-gallery')).each(function () {
                var label_wrap = jQuery(this).attr('class');
                //console.log(label_wrap);
                if(label_wrap.indexOf('rnd')!='-1') {
                    jQuery(this).appendTo('.woocommerce-product-gallery');
                }
            })
            jQuery('.overlay_label_desc_popup', jQuery('.woocommerce-product-gallery')).each(function () {
                    jQuery(this).appendTo('.woocommerce-product-gallery');
            })");
}
if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) :
    if (!is_plugin_active_for_network('woocommerce/woocommerce.php')) :
        function general_admin_notice(){
            global $pagenow;
            if ( $pagenow == 'plugins.php' ) {
                echo '<div class="error">
             <p>iThemeland WooCommerce Advanced Product Labels Pro requires WooCommerce version 3.0.0 or higher. Please <a href="http://localhost/wordpress/wp-admin/update-core.php">update WooCommerce</a> to the latest version, or <a href="https://downloads.wordpress.org/plugin/woocommerce.3.0.0.zip">download the minimum required version »</a></p>
         </div>';
            }
        }
        add_action('admin_notices', 'general_admin_notice');
        return;
    endif;
endif;
add_action('init', 'unique_add_js_gallery_fix');


/**************************************************************
 * Backwards compatibility for WP Conditions
 *************************************************************/
function unique_add_bc_filter_condition_values($condition)
{

    if (has_filter('woocommerce_advanced_product_labels_condition_values')) {
        $condition = apply_filters('woocommerce_advanced_product_labels_condition_values', $condition);
    }

    return $condition;

}

add_action('wp-conditions\condition', 'unique_add_bc_filter_condition_values');

/**
 * Add the filters required for backwards-compatibility for the matching functionality.
 *
 * @since 1.1.0
 */
function unique_add_bc_filter_condition_match($match, $condition, $operator, $value, $args = array())
{

    if (!isset($args['context']) || $args['context'] != 'unique') {
        return $match;
    }

    if (has_filter('unique_match_conditions_' . $condition)) {
        $match = apply_filters('unique_match_conditions_' . $condition, $match = false, $operator, $value);
    }

    if (has_filter('woocommerce_advanced_product_labels_match_condition_' . $condition)) {
        $match = apply_filters('woocommerce_advanced_product_labels_match_condition_' . $condition, $match = false, $operator, $value);
    }

    return $match;

}

add_action('wp-conditions\condition\match', 'unique_add_bc_filter_condition_match', 10, 5);


/**
 * Add condition descriptions of custom conditions.
 *
 * @since 1.1.0
 */
function unique_add_bc_filter_condition_descriptions($descriptions)
{
    return apply_filters('unique_descriptions', $descriptions);
}

add_filter('wp-conditions\condition_descriptions', 'unique_add_bc_filter_condition_descriptions');


/**
 * Add custom field BC.
 *
 * @since 1.1.0
 */
function unique_add_bc_action_custom_fields($type, $args)
{
    if (has_action('wpc_html_field_type_' . $type)) {
        do_action('wpc_html_field_type_' . $args['type'], $args);
    }
}

add_action('wp-conditions\html_field_hook', 'unique_add_bc_action_custom_fields', 10, 2);


/**
 * Map conditions to the proper class names.
 */
function unique_add_bc_condition_class_names($class_name, $condition)
{

    switch ($condition) {
        case 'age' :
            $class_name = 'WPC_Product_Age_Condition';
            break;
        case 'in_sale' :
            $class_name = 'WPC_Product_On_Sale_Condition';
            break;
        case 'shipping_class' :
            $class_name = 'WPC_Product_Shipping_Class_Condition';
            break;
        case 'category' :
            $class_name = 'WPC_Product_Category_Condition';
            break;
        case 'brand' :
            $class_name = 'WPC_Product_Brand_Condition';
            break;
        case 'tag' :
            $class_name = 'WPC_Product_Tag_Condition';
            break;
    }

    return $class_name;

}

add_filter('wpc_get_condition_class_name', 'unique_add_bc_condition_class_names', 10, 2);


/**************************************************************
 * Deprecated
 *************************************************************/

/**
 * @deprecated 1.1.0 - See wpc_match_conditions() for replacement.
 */
function unique_match_conditions($condition_groups = array())
{
    _deprecated_function(__FUNCTION__, '1.1.0', 'wpc_match_conditions');
    return wpc_match_conditions($condition_groups);
}
