<?php
/**
 * voltas functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package voltas
 */

// vardump log data
function dd($var)
    {
        echo '<pre>';
        var_dump($var);
        die;
}


/*
	Đưa về mặc định
*/

/* Widget default */
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );
add_filter( 'use_widgets_block_editor', '__return_false' );

/*
	Editor default 
*/
add_filter('use_block_editor_for_post', '__return_false');




if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function voltas_setup() {
	
	/*
		Kích hoạt tính năng woocommerce nếu cần
	*/
		add_theme_support('woocommerce');


	/** Xu ly link sidebar them widget**/

	$widget_1 = array(
		'id' => 'widget_1',
		'name' => __('Quick link','textdomain')
	);
	$widget_2 = array(
		'id' => 'widget_2',
		'name' => __('Social')
	);
	$widget_3 = array(
		'id' => 'widget_3',
		'name' => __('Bank')
	);
	$widget_4 = array(
		'id' => 'widget_4',
		'name' => __('Locaiton')
	);

	$widget_5 = array(
		'id' => 'widget_5',
		'name' => __('Copyrights')
	);


	register_sidebar($widget_1 );
	register_sidebar($widget_2 );
	register_sidebar($widget_3 );
	register_sidebar($widget_4 );
	register_sidebar($widget_5 );



	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on voltas, use a find and replace
		* to change 'voltas' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'voltas', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'voltas' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'voltas_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'voltas_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function voltas_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'voltas_content_width', 640 );
}
add_action( 'after_setup_theme', 'voltas_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function voltas_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'voltas' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'voltas' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'voltas_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function voltas_scripts() {
	wp_enqueue_style( 'voltas-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'voltas-style', 'rtl', 'replace' );

	wp_enqueue_script( 'voltas-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'voltas_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}



/** Xử lý add to card đếm số lượng sản phẩm trong giỏ hàng **/

add_shortcode ('woo_cart_but', 'woo_cart_but' );
/**
 * Create Shortcode for WooCommerce Cart Menu Item
 */
function woo_cart_but() {
	ob_start();
 
        $cart_count = WC()->cart->cart_contents_count; // Set variable for cart item count
        $cart_url = wc_get_cart_url();  // Set Cart URL
  
        ?>
        <a href="<?php echo $cart_url; ?>">
	    <?php
        if ( $cart_count > 0 ) {
       ?>
            <span class="cart-contents-count"><?php echo $cart_count; ?> Items</span>
        <?php
        }
        ?>
        </a>
        <?php
	        
    return ob_get_clean();
 
}

/** Thêm class cho nút add to card **/
function woocommerce_template_loop_add_to_cart( $args = array() ) {
	global $product;

	if ( $product ) {
		$defaults = array(
			'quantity'   => 1,
			'class'      => 'vol_btn vol_btn_bg',
			'attributes' => array(
				'data-product_id'  => $product->get_id(),
				'data-product_sku' => $product->get_sku(),
				'aria-label'       => $product->add_to_cart_description(),
				'rel'              => 'nofollow',
			),
		);

		$args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $args, $defaults ), $product );

		if ( isset( $args['attributes']['aria-label'] ) ) {
			$args['attributes']['aria-label'] = wp_strip_all_tags( $args['attributes']['aria-label'] );
		}

		wc_get_template( 'loop/add-to-cart.php', $args );
	}
}

/** Chỉnh sửa tiêu đề sản phẩm **/
function woocommerce_template_loop_product_title() {
	global $product;
	$link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
	echo '<h5> <a class="poppins" href="'. esc_url( $link ) .'">' . get_the_title() . '</a></h5>';
}

/** Lấy danh mục sản phẩm **/
function themdanhmuc() {
	global $product;
	$categories = wp_get_post_terms( $product->get_id(),'product_cat');

	foreach ($categories as $category) {
	echo ' <p class="cats">' . $category->name . '</p>';
	}	

}
add_action('woocommerce_shop_loop_item_title','themdanhmuc',20);



/** Xử lý nut giỏ hàng đã hết hàng hay chưa nếu hết đề hết hàng**/

function kiem_tra( $args = array() ) {
		global $product;
		if(!$product->is_in_stock()) {
			echo '<div class="productHover01"><a class="vol_btn vol_btn_bg">Hết hàng</a></div>';
		}
		elseif ( $product ) {
			$defaults = array(
				'quantity'   => 1,
				'class'      => 'vol_btn vol_btn_bg',
			);

			$args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $args, $defaults ), $product );

			if ( isset( $args['attributes']['aria-label'] ) ) {
				$args['attributes']['aria-label'] = wp_strip_all_tags( $args['attributes']['aria-label'] );
			}

			wc_get_template( 'loop/add-to-cart.php', $args );
		}
	}

	remove_action( 'woocommerce_after_shop_loop_item','woocommerce_template_loop_add_to_cart',10);
	add_action('woocommerce_after_shop_loop_item','kiem_tra',10)




?>









