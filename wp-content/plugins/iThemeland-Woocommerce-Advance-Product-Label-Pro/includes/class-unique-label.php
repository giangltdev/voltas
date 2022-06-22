<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class unique_Label
 *
 * Create product label object
 *
 * @class		unique_Label
 * @author		iThemelandco
 * @package		iThemeland WooCommerce Advanced Product Labels Pro
 * @version		1.0.0
 */
class unique_Label {


	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 * @deprecated 1.1.0
	 */
	public function __construct( $type = 'label',$advanced = '', $text = '', $style = '', $align = '', $style_attr = '' ) {
		_deprecated_function( 'class new unique_Label()', '1.1.0', 'unique_get_label_html()' );
		return unique_get_label_html( compact( 'type','advanced', 'text', 'style', 'align', 'style_attr' ) );
	}


}
