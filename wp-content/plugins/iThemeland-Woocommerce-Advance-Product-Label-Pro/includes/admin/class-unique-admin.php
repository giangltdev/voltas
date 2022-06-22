<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Admin class.
 *
 * Handle all admin related functions.
 *
 * @author        iThemelandco
 * @version        1.0.0
 */
class unique_Admin
{


    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {

        // Initialize class
        add_action('admin_init', array($this, 'init'));

    }


    /**
     * Initialise hooks.
     *
     * @since 1.1.6
     */
    public function init()
    {

        // Add to WC Screen IDs to load scripts.
        add_filter('woocommerce_screen_ids', array($this, 'add_screen_ids'));

        // Enqueue scripts
        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'), 10, 1);

        // Keep WC menu open while in WAS edit screen
        add_action('admin_head', array($this, 'menu_highlight'));

        global $pagenow;
        if ('plugins.php' == $pagenow) :
            add_filter('plugin_action_links_' . plugin_basename(iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array($this, 'add_plugin_action_links'), 10, 2);
        endif;

    }


    /**
     * Screen IDs.
     *
     * Add CPT to the screen IDs so the WooCommerce scripts are loaded.
     *
     * @since 1.0.0
     *
     * @param  array $screen_ids List of existing screen IDs.
     * @return array             List of modified screen IDs.
     */
    public function add_screen_ids($screen_ids)
    {

        $screen_ids[] = 'unique';

        return $screen_ids;

    }

    /**
     * Admin scripts.
     *
     * Enqueue admin javascript and stylesheets.
     *
     * @since 1.0.0
     */
    public function admin_enqueue_scripts($hook)
    {
        global $post;

        $suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

        /*script for wp*/

        /*script for labels pro*/
        wp_register_script('wpcolorpicker-alpha', plugins_url('/assets/admin/js/wpcolorpicker-alpha/wp-color-picker-alpha.min.js', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array('jquery'), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);
        wp_register_script('countdown-1-js', plugins_url('/assets/jquery-countdown/jquery.countdown.min.js', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array('jquery'), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);
        wp_register_script('countdown-2-js', plugins_url('/assets/FlipClock/flipclock.min.js', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array('jquery'), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);
        wp_register_script('tooltipster_it_js', plugins_url('/assets/tooltip/tooltipster.bundle.js', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array('jquery'), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);

        wp_register_script('icon_it_js', plugins_url('/assets/js/icon-picker.js', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array('jquery'), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);

        wp_register_script( 'it-customscrollbar-js', plugins_url( '/assets/admin/js/jquery.mCustomScrollbar.concat.min.js', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file ), array( 'jquery'), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version );

        if ($hook == 'post-new.php' || $hook == 'post.php') {
            if ('unique' === $post->post_type) {
                wp_register_script('global-label-js', plugins_url('/assets/admin/js/global-label-option.js', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array('jquery', 'it-customscrollbar-js'), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);
            } else {
                wp_register_script('single-label-js', plugins_url('/assets/admin/js/single-label-option.js', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array('jquery', 'it-customscrollbar-js'), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);
            }
        }
        wp_register_script( 'it-woocommerce-advanced-product-labels-pro-js', plugins_url( '/assets/admin/js/woocommerce-advanced-product-labels.js', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file ), array( 'jquery', 'jquery-ui-sortable', 'wp-color-picker' ), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version );

        /*style for wp*/
        wp_enqueue_style('wp-color-picker');

        /*style for labels pro*/
        wp_register_style('it-woocommerce-advanced-product-labels-pro-front-end-css', plugins_url('/assets/front-end/css/it-woocommerce-advanced-product-labels-pro.css', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array(), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);
        //wp_register_style('it-woocommerce-advanced-product-labels-pro-css', plugins_url('/assets/admin/css/it-woocommerce-advanced-product-labels-pro.min.css', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array(), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);
        /*remove and edit after change*/
        wp_register_style('it-woocommerce-advanced-product-labels-pro-css', plugins_url('/assets/admin/css/it-woocommerce-advanced-product-labels-pro.css', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array(), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);

        wp_register_style('datepicker-it-css', plugins_url('/assets/admin/css/datepicker.css', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array(), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);
        wp_register_style('countdown-2-css', plugins_url('/assets/FlipClock/flipclock.min.css', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array(), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);
        wp_register_style('tooltipster_it_css', plugins_url('/assets/tooltip/tooltipster.bundle.css', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array(), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);
        wp_register_style('tab-style', plugins_url('/assets/admin/css/tab/style_tab.min.css', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array(), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);

        wp_register_style('icon_it_css', plugins_url('/assets/css/icon-picker.css', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array(), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);
        wp_register_style('elegant_icons_it_css', plugins_url('/assets/css/elegant-icons.css', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array(), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);
        wp_register_style('linear_style_it_css', plugins_url('/assets/css/linear-style.css', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array(), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);
        wp_register_style('fontawesome_style_it_css', plugins_url('/assets/css/font-awesome.min.css', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array(), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);
        wp_register_style('fontawesome1_style_it_css', plugins_url('/assets/css/fontawesome.css', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array(), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);
        wp_register_style('fa_brands_style_it_css', plugins_url('/assets/css/fa-brands.css', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array(), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);
        wp_register_style('fa_regular_style_it_css', plugins_url('/assets/css/fa-regular.css', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array(), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);
        wp_register_style('fa_solid_style_it_css', plugins_url('/assets/css/fa-solid.css', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array(), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);

        wp_register_style('it-customscrollbar-css', plugins_url('/assets/admin/css/jquery.mCustomScrollbar.css', iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file), array(), iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->version);

        // Only load scripts on relevant pages
        if (
            (isset($_REQUEST['post']) && in_array(get_post_type($_REQUEST['post']), array('unique', 'product'))) ||
            (isset($_REQUEST['post_type']) && 'unique' == $_REQUEST['post_type']) ||
            (isset($_REQUEST['post_type']) && 'product' == $_REQUEST['post_type']) ||
            (isset($_REQUEST['tab']) && in_array($_REQUEST['tab'], array('labels_pro')))
        ) {

            wp_localize_script('wp-conditions', 'wpc2', array(
                'action_prefix' => 'unique_',
            ));
            wp_enqueue_script('tooltipster_it_js');

            wp_enqueue_style('it-woocommerce-advanced-product-labels-pro-front-end-css');
            wp_enqueue_style('it-woocommerce-advanced-product-labels-pro-css');
            wp_enqueue_script( 'it-woocommerce-advanced-product-labels-pro-js' );

            wp_enqueue_script('wp-conditions');
            wp_enqueue_style( 'datepicker-it-css' );
            wp_enqueue_script('jquery-ui-datepicker', array('jquery'));

            wp_enqueue_script('global-label-js');
            wp_enqueue_script('single-label-js');

            wp_enqueue_script('countdown-1-js');
            wp_enqueue_script('countdown-2-js');
            wp_enqueue_style('countdown-2-css');


            wp_enqueue_style('tab-style');

            wp_enqueue_script('wpcolorpicker-alpha');
            wp_enqueue_style('tooltipster_it_css');

            wp_enqueue_script('icon_it_js');
            wp_enqueue_style('icon_it_css');
            wp_enqueue_style('elegant_icons_it_css');
            wp_enqueue_style('linear_style_it_css');
            wp_enqueue_style('fontawesome_style_it_css');
            wp_enqueue_style('fontawesome1_style_it_css');
            wp_enqueue_style('fa_brands_style_it_css');
            wp_enqueue_style('fa_regular_style_it_css');
            wp_enqueue_style('fa_solid_style_it_css');

            wp_enqueue_style('it-customscrollbar-css');


        }

    }


    /**
     * Keep menu open.
     *
     * Highlights the correct top level admin menu item for post type add screens.
     *
     * @since 1.0.4
     */
    public function menu_highlight()
    {

        global $parent_file, $submenu_file, $post_type;

        if ('unique' == $post_type) :

            $parent_file = 'woocommerce';
            $submenu_file = 'wc-settings';

        endif;

    }


    /**
     * Plugin action links.
     *
     * Add links to the plugins.php page below the plugin name
     * and besides the 'activate', 'edit', 'delete' action links.
     *
     * @since 1.1.8
     *
     * @param  array $links List of existing links.
     * @param  string $file Name of the current plugin being looped.
     * @return array         List of modified links.
     */
    public function add_plugin_action_links($links, $file)
    {

        if ($file == plugin_basename(iThemeland_WooCommerce_Advanced_Product_Labels_Pro()->file)) :
            $links = array_merge(array(
                '<a href="' . esc_url(admin_url('/admin.php?page=wc-settings&tab=labels_pro')) . '">' . __('Settings', 'it-woocommerce-advanced-product-labels-pro') . '</a>'
            ), $links);
        endif;

        return $links;

    }


}
