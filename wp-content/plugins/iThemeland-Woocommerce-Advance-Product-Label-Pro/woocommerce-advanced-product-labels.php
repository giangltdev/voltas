<?php
/**
 * Plugin Name:    iThemeland WooCommerce Advanced Product Labels Pro
 * Plugin URI:        http://ithemelandco.com/Plugins/iThemeland-Woocommerce-Advance-Product-Labels-Pro/
 * Description:    Create product labels to increase visibility of your products, add information and increase conversion rate with just a few clicks!
 * Version:        1.8.6
 * Author:            iThemelandco
 * Author URI:        http://www.ithemelandco.com/
 * Text Domain:    it-woocommerce-advanced-product-labels-pro
 * WC requires at least: 3.0.0
 * WC tested up to:      4.9.1
 */
/*
 * version: 1.2.0
 * Compatible With iThemeland Brand Plugin
 * Fix Bug : Preview Label in Variation Product
 * Fix CSS : Network Sharing Meta Box
 *
 * version: 1.3.0
 * Add Tutorial video link section
 *
 * version: 1.4.0
 * Add description for label with variety type of show
 *  * Click on the badge and appear in popup
 *  * Display in product tab on single page
 *  * Show Before title
 *  * Show After title
 *  * Show After price
 *  * Show After excerpt
 *  * Show After add to cart
 *  * Show After meta
 *  * Show After sharing
 * Add disable/enable/delete label
 * Add priority label to show
 * Add Related product show in Carousel Based on Label
 *
 * version: 1.5.0
 * Add Support SVG file format for image type label
 * Improve coding
 *
 * V 1.6.0:
 * [Fix] - Coupon condition possibly giving warning when no coupon is applied
 * [Improvement] - Allow for 'Coupon' - equal - {empty} - for a 'no coupon applied' condition
 * [Add] - Value field input validation for order amount / weight conditions
 * [Fix] - 'No shipping class' in shipping class condition not always working as expected
 * [Fix] - Possible notice from 'Page' condition on non-pages
 * [Fix] - Duplicating condition groups with conditions using Select2 now continue to work
 * [Improvement] - Shipping method condition matches only against chosen methods of available shipping packages
 * wp-conditions update
 *
 * V 1.7.0:
 * [Add] - Multiple language capability
 * [Add] - Compatibility with Polylang
 * [Improvement] - CSS Code
 *
 * V 1.8.0:
 * [Add] - Set icons on badges
 * [Add] - Badges tooltips
 * [Add] - Predefine badge
 * [Improvement] - Settings fields
 * [Improvement] - CSS Code
 *
 * V 1.8.1:
 * [Update] - Color Picker
 * [Improvement] - CSS Code
 * [Improvement] - JS Code
 *
 * V 1.8.2:
 * [Fix] - Possible error
 * [Update] - Custom Scrollbar
 * [Add] - iThemelandco Support Center Link
 *
 * V 1.8.3:
 * Tested on WooCommerce 4.9.1
 * [Fix] - Issue related to icon picker
 * [Fix] - CSS Code
 *
 * V 1.8.4:
 * Tested on WooCommerce 5.0.0
 * [Add] - Define the second mode of display
 * [Improvement] - Ensure styles are loaded on non-WooCommerce pages when labels are displayed
 * [Fix] -  Issue related to icon picker
 * [Fix] -  Stock status condition
 *
 * V 1.8.5:
 * Tested on WordPress 5.7.
 * Tested on WooCommerce 5.1.0
 *
 * V 1.8.6:
 * Tested on WooCommerce 5.3.0
 * [Improvement] - CSS Code
 * [Improvement] - Some Issue


-----------

 */

if (!defined('ABSPATH')) exit; // Exit if accessed directly


/**
 * Class iThemeland_Woocommerce_Advanced_Product_Labels_Pro
 *
 * Main unique class, add filters and handling all other files
 *
 * @class       iThemeland_Woocommerce_Advanced_Product_Labels_Pro
 * @version     1.0.0
 * @author      iThemelandco
 */
/*set url me*/
define('UNIQUE_PLUGIN_URL', plugins_url('', __FILE__));
defined( 'UNIQUE_PLUGIN_IMG_DIR' ) or define( 'UNIQUE_PLUGIN_IMG_DIR', plugin_dir_url( __FILE__ ) . 'images/' );

class iThemeland_Woocommerce_Advanced_Product_Labels_Pro
{


    /**
     * Plugin version.
     *
     * @since 1.0.0
     * @var string $version Plugin version number.
     */
    public $version = '1.8.6';


    /**
     * Plugin file.
     *
     * @since 1.0.0
     * @var string $file Plugin file path.
     */
    public $file = __FILE__;


    /**
     * Instance of iThemeland_WooCommerce_Advanced_Product_Labels_Pro.
     *
     * @since 1.0.0
     * @access private
     * @var object $instance The instance of unique.
     */
    private static $instance;


    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {

        // Check if WooCommerce is active
        if (!function_exists('is_plugin_active_for_network')) :
            require_once(ABSPATH . '/wp-admin/includes/plugin.php');
        endif;

        if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) :
            if (!is_plugin_active_for_network('woocommerce/woocommerce.php')) :
                return;
            endif;
        endif;

        // Load style script / admin style script
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));

    }


    /**
     * Instance.
     *
     * An global instance of the class. Used to retrieve the instance
     * to use on other files/plugins/themes.
     *
     * @since 1.0.0
     * @return object Instance of the class.
     */
    public static function instance()
    {

        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;

    }


    /**
     * init.
     *
     * Initialize plugin parts.
     *
     * @since 1.0.0
     */
    public function init()
    {

        if (version_compare(PHP_VERSION, '5.3', 'lt')) {
            return add_action('admin_notices', array($this, 'php_version_notice'));
        }

        require_once plugin_dir_path(__FILE__) . '/libraries/wp-conditions/functions.php';
        require_once plugin_dir_path(__FILE__) . 'includes/core-functions.php';

        if (is_admin()) {

            // Stop if svg upload are disabled
            if ('yes' == get_option('enable_unique_svg', 'no')) :
                require_once plugin_dir_path(__FILE__) . '/libraries/safe-svg/safe-svg.php';
            endif;

            require_once plugin_dir_path(__FILE__) . 'includes/admin/class-unique-admin.php';
            $this->admin = new unique_Admin();

            require_once plugin_dir_path(__FILE__) . 'includes/admin/class-unique-settings.php';
            $this->settings = new unique_Settings();

        }

        // AJAX
        if (defined('DOING_AJAX') && DOING_AJAX) {
            require_once plugin_dir_path(__FILE__) . '/includes/class-unique-ajax.php';
            $this->ajax = new unique_Ajax();
        }

        /**
         * Post Type class
         */
        require_once plugin_dir_path(__FILE__) . 'includes/class-unique-post-type.php';
        $this->post_type = new unique_Post_Type();

        /**
         * Load single label class.
         */
        require_once plugin_dir_path(__FILE__) . 'class-unique-single-labels.php';
        $this->single_labels = new unique_Single_Labels();

        /**
         * Load global label class.
         */
        require_once plugin_dir_path(__FILE__) . 'class-unique-global-labels.php';
        $this->global_labels = new  unique_Global_Labels();

        /**
         * Load conditions handler class.
         */
        require_once plugin_dir_path(__FILE__) . 'includes/class-unique-match-conditions.php';
        $this->matcher = new unique_Match_Conditions();

        // Load textdomain
        $this->load_textdomain();

    }


    /**
     * Enqueue scripts.
     *
     * Enqueue javascript and stylesheets.
     *
     * @since 1.0.o
     */
    public function enqueue_scripts()
    {

        wp_register_style('it-woocommerce-advanced-product-labels-pro', plugins_url('/assets/front-end/css/it-woocommerce-advanced-product-labels-pro.min.css', __FILE__), array(), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);

        /*register script for countdown*/
        wp_register_script('countdown-1-js', plugins_url('/assets/jquery-countdown/jquery.countdown.min.js', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array('jquery'), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);
        /*layout 2 count down*/
        wp_register_script('countdown-2-js', plugins_url('/assets/FlipClock/flipclock.min.js', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array('jquery'), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);
        wp_register_style('countdown-2-css', plugins_url('/assets/FlipClock/flipclock.min.css', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array(), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);
        /*positioning-label*/
        wp_register_script('positioning-label', plugins_url('/assets/front-end/js/positioning-label.min.js', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array('jquery'), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);
        /*carousel desc*/
        wp_register_script('carousel_desc_js', plugins_url('/assets/owlcarousel/owl.carousel.min.js', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array('jquery'));
        wp_register_style('carousel_desc_css', plugins_url('/assets/owlcarousel/assets/owl.carousel.min.css', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array());

        if ( is_woocommerce() || is_post_type_archive( 'product' ) || is_shop() || is_product() || is_home() || is_front_page() ) {
            wp_enqueue_style('it-woocommerce-advanced-product-labels-pro');
            /*enqueue script for countdown*/
            wp_enqueue_script('countdown-1-js');
            /*layout 2 countdown*/
            wp_enqueue_script('countdown-2-js');
            wp_enqueue_style('countdown-2-css');
            /*positioning-label*/
            wp_enqueue_script('positioning-label');
        }


    }


    /**
     * Textdomain.
     *
     * Load the textdomain based on WP language.
     *
     * @since 1.0.0
     */
    public function load_textdomain()
    {

        load_plugin_textdomain('it-woocommerce-advanced-product-labels-pro', false, plugin_basename(dirname(__FILE__)) . '/languages');

    }


    /**
     * Display PHP 5.3 required notice.
     *
     * Display a notice when the required PHP version is not met.
     *
     * @since 1.0.6
     */
    public function php_version_notice()
    {

        ?>
        <div class='updated'>
        <p><?php echo sprintf(__('Advanced Product Labels Pro requires PHP 5.3 or higher and your current PHP version is %s. Please (contact your host to) update your PHP version.', 'woocommerce-advanced-messages'), PHP_VERSION); ?></p>
        </div><?php

    }


}


/**
 * Load label object class.
 */
require_once plugin_dir_path(__FILE__) . 'includes/class-unique-label.php';


/**
 * The main function responsible for returning the iThemeland_Woocommerce_Advanced_Product_Labels_Pro object.
 *
 * Use this function like you would a global variable, except without needing to declare the global.
 *
 * Example: <?php iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->method_name(); ?>
 *
 * @since 1.0.0
 *
 * @return object iThemeland_Woocommerce_Advanced_Product_Labels_Pro class object.
 */
if (!function_exists('iThemeland_WooCommerce_Advanced_Product_Labels_Pro')) :

    function iThemeland_WooCommerce_Advanced_Product_Labels_Pro()
    {
        return iThemeland_Woocommerce_Advanced_Product_Labels_Pro::instance();
    }

endif;

iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->init();
