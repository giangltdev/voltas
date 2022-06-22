<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Admin settings.
 *
 * Handle functions for admin settings page.
 *
 * @author		iThemelandco
 * @version		1.0.0
 */
class unique_Settings {


	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// Add WC settings tab
		add_filter( 'woocommerce_settings_tabs_array', array( $this, 'settings_tab' ), 60 );

		// Settings page contents
		add_action( 'woocommerce_settings_tabs_labels_pro', array( $this, 'settings_page' ) );

		// Save settings page
		add_action( 'woocommerce_update_options_labels_pro', array( $this, 'update_options' ) );

		// Table field type
		add_action( 'woocommerce_admin_field_product_labels_pro_table', array( $this, 'generate_table_field' ) );
		// title field type
		add_action( 'woocommerce_admin_field_product_labels_pro_title', array( $this, 'generate_title_field' ) );

	}


	/**
	 * Settings tab.
	 *
	 * Add a WooCommerce settings tab for the plugins settings page.
	 *
	 * @since 1.0.0
	 *
	 * @param  array $tabs Array Default tabs used in WC.
	 * @return array       All WC settings tabs including newly added.
	 */
	public function settings_tab( $tabs ) {

		$tabs['labels_pro'] = __( 'iThemeland Labels', 'it-woocommerce-advanced-product-labels-pro' );

		return $tabs;

	}


	/**
	 * Settings page array.
	 *
	 * Get settings page fields array.
	 *
	 * @since 1.0.0
	 */
	public function get_settings() {

		$settings = apply_filters( 'woocommerce_unique_settings', array(
            array(
                'title' => __( 'iThemeland Advanced Product Labels Pro', 'it-woocommerce-advanced-product-labels-pro' ),
                'type'  => 'product_labels_pro_title',
            ),

			array(
				'title' => '',
				'type'  => 'title',
			),

			array(
				'title'    => __( 'Enable/Disable', 'it-woocommerce-advanced-product-labels-pro' ),
				'desc'     => __( 'Enable to display labels on the front-end. When disabled you can still add/modify labels.', 'it-woocommerce-advanced-product-labels-pro' ),
				'id'       => 'enable_unique',
				'default'  => 'yes',
				'type'     => 'checkbox',
				'autoload' => false
			),

			array(
				'title'    => __( 'Show on the detail page', 'it-woocommerce-advanced-product-labels-pro' ),
				'desc'     => __( 'Show the product labels also on product detail pages.', 'it-woocommerce-advanced-product-labels-pro' ),
				'id'       => 'show_unique_on_detail_pages',
				'default'  => 'no',
				'type'     => 'checkbox',
				'autoload' => false
			),

            array(
                'title'    => __( 'Enable/Disable', 'it-woocommerce-advanced-product-labels-pro' ),
                'desc'     => __( 'Enable Upload SVG file format', 'it-woocommerce-advanced-product-labels-pro' ),
                'id'       => 'enable_unique_svg',
                'default'  => 'yes',
                'type'     => 'checkbox',
                'autoload' => false
            ),

            array(
                'title'    => __( 'Show the second mode', 'it-woocommerce-advanced-product-labels-pro' ),
                'desc'     => __( 'Select this option if the badge is not displayed', 'it-woocommerce-advanced-product-labels-pro' ),
                'id'       => 'enable_unique_second_mode',
                'default'  => 'no',
                'type'     => 'checkbox',
                'autoload' => false
            ),

            array(
				'title' => __( 'Product Labels', 'it-woocommerce-advanced-product-labels-pro' ),
				'type'  => 'product_labels_pro_table',
			),

			array(
				'type' => 'sectionend',
			),

		) );

		return $settings;

	}


	/**
	 * Settings page content.
	 *
	 * Output settings page content via WooCommerce output_fields() method.
	 *
	 * @since 1.0.0
	 */
	public function settings_page() {

		WC_Admin_Settings::output_fields( $this->get_settings() );

	}


	/**
	 * Save settings.
	 *
	 * Save settings based on WooCommerce save_fields() method.
	 *
	 * @since 1.0.0
	 */
	public function update_options() {

		WC_Admin_Settings::save_fields( $this->get_settings() );

	}


	/**
	 * Table field type.
	 *
	 * Load and render table as a field type.
	 *
	 * @return string
	 */
	public function generate_table_field() {

		ob_start();

		/**
		 * Load Cart URLs table view.
		 */
		require_once plugin_dir_path( __FILE__ ) . 'views/html-labels-table.php';

		echo ob_get_clean();

	}
	/**
	 * Title field type.
	 *
	 * @return string
	 */
	public function generate_title_field() {

		ob_start();
        echo '<h2 class="labels_pro_title">iThemeland Advanced Product Labels Pro</h2>';
		echo ob_get_clean();

	}


}
