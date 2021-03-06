<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'WPC_Contains_Brand_Condition' ) ) {

	class WPC_Contains_Brand_Condition extends WPC_Condition {

		public function __construct() {
			$this->name        = __( 'Contains Brand', 'wpc-conditions' );
			$this->slug        = __( 'contains_brand', 'wpc-conditions' );
			$this->group       = __( 'Cart', 'wpc-conditions' );
			$this->description = __( 'Cart must contain at least one product with the selected brand', 'wpc-conditions' );

			parent::__construct();
		}

		public function match( $match, $operator, $value ) {

			$value = $this->get_value( $value );

			if ( '==' == $operator ) :

				foreach ( WC()->cart->get_cart() as $product ) :

					if ( has_term( $value, 'as-brand', $product['product_id'] ) ) :
						return true;
					endif;

				endforeach;

			elseif ( '!=' == $operator ) :

				$match = true;
				foreach ( WC()->cart->get_cart() as $product ) :

					if ( has_term( $value, 'as-brand', $product['product_id'] ) ) :
						return false;
					endif;

				endforeach;

			endif;

			return $match;

		}

		public function get_available_operators() {

			$operators = parent::get_available_operators();

			unset( $operators['>='] );
			unset( $operators['<='] );

			return $operators;

		}

		public function get_value_field_args() {

			$categories = get_terms( 'as-brand', array( 'hide_empty' => false ) );
			$field_args = array(
				'type' => 'select',
				'class' => array( 'wpc-value', 'wc-enhanced-select' ),
				'options' => wp_list_pluck( $categories, 'name', 'slug' ),
			);

			return $field_args;

		}

	}

}