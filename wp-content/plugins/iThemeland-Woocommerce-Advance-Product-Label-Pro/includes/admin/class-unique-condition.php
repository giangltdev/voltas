<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Condition class.
 *
 * Represents a single condition in a condition group.
 *
 * @author  iThemelandco
 * @version 1.0.0
 */
class unique_Condition {


	/**
	 * Condition ID.
	 *
	 * @since 1.0.0
	 * @var string $id Condition ID.
	 */
	public $id;

	/**
	 * Condition.
	 *
	 * @since 1.0.0
	 * @var string $condition Condition slug.
	 */
	public $condition;

	/**
	 * Operator.
	 *
	 * @since 1.0.0
	 * @var string $operator Operator slug.
	 */
	public $operator;

	/**
	 * Value.
	 *
	 * @since 1.0.0
	 * @var string $value Condition value.
	 */
	public $value;

	/**
	 * Group ID.
	 *
	 * @since 1.0.0
	 * @var string $group Condition group ID.
	 */
	public $group;


	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct( $id = null, $group = 0, $condition = 'in_sale', $operator = null, $value = null ) {

		$this->id        = $id;
		$this->group     = $group;
		$this->condition = $condition;
		$this->operator  = $operator;
		$this->value     = $value;

		if ( ! $id ) {
			$this->id = rand();
		}

	}


	/**
	 * Output condition row.
	 *
	 * Output the full condition row which includes: condition, operator, value, add/delete buttons and
	 * the description.
	 *
	 * @since 1.1.6
	 */
	public function output_condition_row() {

		$wp_condition = $this;
		require 'views/html-condition-row.php';

	}


	/**
	 * Get conditions.
	 *
	 * Get a list with the available conditions.
	 *
	 * @since 1.1.6
	 *
	 * @return array List of available conditions for a condition row.
	 */
	public function get_conditions() {

		$conditions = array(
			__( 'Conditions', 'it-woocommerce-advanced-product-labels-pro' ) => array(
				'in_sale'      => __( 'On sale', 'it-woocommerce-advanced-product-labels-pro' ),
				'category'     => __( 'Product category', 'it-woocommerce-advanced-product-labels-pro' ),
				'brand'     => __( 'Product brand', 'it-woocommerce-advanced-product-labels-pro' ),
				'product'      => __( 'Product', 'it-woocommerce-advanced-product-labels-pro' ),
				'product_type' => __( 'Product type', 'it-woocommerce-advanced-product-labels-pro' ),
				'bestseller'   => __( 'Bestsellers', 'it-woocommerce-advanced-product-labels-pro' ),
				'age'          => __( 'Product age', 'it-woocommerce-advanced-product-labels-pro' ),
			),
			__( 'Attributes', 'it-woocommerce-advanced-product-labels-pro' ) => array(
				'price'          => __( 'Price', 'it-woocommerce-advanced-product-labels-pro' ),
				'sale_price'     => __( 'Sale price', 'it-woocommerce-advanced-product-labels-pro' ),
				'stock_status'   => __( 'Stock status', 'it-woocommerce-advanced-product-labels-pro' ),
				'stock_quantity' => __( 'Stock quantity', 'it-woocommerce-advanced-product-labels-pro' ),
				'shipping_class' => __( 'Shipping class', 'it-woocommerce-advanced-product-labels-pro' ),
				'tag'            => __( 'Tag', 'it-woocommerce-advanced-product-labels-pro' ),
				'sales'          => __( 'Total sales', 'it-woocommerce-advanced-product-labels-pro' ),
				'featured'       => __( 'Featured product', 'it-woocommerce-advanced-product-labels-pro' ),
			),
		);
		$conditions = apply_filters( 'unique_conditions', $conditions );

		return $conditions;

	}


	/**
	 * Get available operators.
	 *
	 * Get a list with the available operators for the conditions.
	 *
	 * @since 1.1.6
	 *
	 * @return array List of available operators.
	 */
	public function get_operators() {
		$wpc_condition = wpc_get_condition( $this->condition );
		return apply_filters( 'unique_operators', $wpc_condition->get_available_operators() );
	}


	/**
	 * Get value field args.
	 *
	 * Get the value field args that are condition dependent. This usually includes
	 * type, class and placeholder.
	 *
	 * @since 1.1.6
	 *
	 * @return array
	 */
	public function get_value_field_args() {

		// Defaults
		$default_field_args = array(
			'name'        => 'conditions[' . absint( $this->group ) . '][' . absint( $this->id ) . '][value]',
			'placeholder' => '',
			'type'        => 'text',
			'class'       => array( 'wpc-value' ),
		);

		$field_args = $default_field_args;
		if ( $condition = wpc_get_condition( $this->condition ) ) {
			$field_args = wp_parse_args( $condition->get_value_field_args(), $field_args );
		}

		if ( $this->condition == 'product' && $product = wc_get_product( $this->value ) ) {
			$field_args['custom_attributes']['data-selected'] = $product->get_formatted_name(); // WC < 2.7
			$field_args['options'][ $this->value ]            = $product->get_formatted_name(); // WC >= 2.7
		}

		if ( $this->condition == 'bestseller' ) {
			$field_args['placeholder'] = __( 'Top # of bestsellers', 'it-woocommerce-advanced-product-labels-pro' );
		} elseif ( $this->condition == 'featured' ) {
			$field_args['type']    = 'select';
			$field_args['options'] = array(
				'1' => __( 'Yes', 'it-woocommerce-advanced-product-labels-pro' ),
				'0' => __( 'No', 'it-woocommerce-advanced-product-labels-pro' ),
			);
		}

		$field_args = apply_filters( 'unique_condition_values', $field_args, $this->condition );

		return $field_args;

	}


	/**
	 * Get description.
	 *
	 * Return the description related to this condition.
	 *
	 * @since 1.0.0
	 */
	public function get_description() {
		$descriptions = apply_filters( 'unique_descriptions', wpc_condition_descriptions() );
		return isset( $descriptions[ $this->condition ] ) ? $descriptions[ $this->condition ] : '';
	}


}
