<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class unique_Post_Type
 *
 * Initialize the unique post type
 *
 * @class       unique_Post_Type
 * @author     	iThemelandco
 * @package		iThemeland WooCommerce Advanced Product Labels Pro
 * @version		1.0.0
 */
class unique_Post_Type {


	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// Register post type
		add_action( 'init', array( $this, 'register_post_type' ) );

		// Edit user notices
		add_filter( 'post_updated_messages', array( $this, 'custom_post_type_messages' ) );

		// Add meta box
		add_action( 'add_meta_boxes', array( $this, 'post_type_meta_box' ) );
		// Save meta box
		add_action( 'save_post', array( $this, 'save_meta_boxes' ) );

		// Redirect after delete
		add_action( 'load-edit.php', array( $this, 'redirect_after_trash' ) );

	}


	/**
	 * Register post type.
	 *
	 * Register the WCAM post type.
	 *
	 * @since 1.0.0
	 */
	public function register_post_type() {

		$labels = array(
			'name'               => __( 'Global Labels', 'it-woocommerce-advanced-product-labels-pro' ),
			'singular_name'      => __( 'Global Label', 'it-woocommerce-advanced-product-labels-pro' ),
			'add_new'            => __( 'Add New', 'it-woocommerce-advanced-product-labels-pro' ),
			'add_new_item'       => __( 'Add New Global Label', 'it-woocommerce-advanced-product-labels-pro' ),
			'edit_item'          => __( 'Edit Global Label', 'it-woocommerce-advanced-product-labels-pro' ),
			'new_item'           => __( 'New Global Label', 'it-woocommerce-advanced-product-labels-pro' ),
			'view_item'          => __( 'View Global Label', 'it-woocommerce-advanced-product-labels-pro' ),
			'search_items'       => __( 'Search Global Labels', 'it-woocommerce-advanced-product-labels-pro' ),
			'not_found'          => __( 'No Global Labels', 'it-woocommerce-advanced-product-labels-pro' ),
			'not_found_in_trash' => __( 'No Global Labels found in Trash', 'it-woocommerce-advanced-product-labels-pro' ),
		);

		register_post_type( 'unique', array(
			'label'           => 'unique',
			'show_ui'         => true,
			'show_in_menu'    => false,
            'menu_icon'           => 'dashicons-awards',
            'capability_type' => 'post',
			'map_meta_cap'    => true,
			'rewrite'         => array( 'slug' => 'unique', 'with_front' => true ),
			'_builtin'        => false,
			'query_var'       => true,
			'supports'        => array( 'title','editor' ),
			'labels'          => $labels,
            'public'          => true,
		) );

	}


	/**
	 * Messages.
	 *
	 * Modify the notice messages text for the 'unique' post type.
	 *
	 * @since 1.0.0
	 *
	 * @param  array $messages Existing list of messages.
	 * @return array           Modified list of messages.
	 */
	function custom_post_type_messages( $messages ) {

		$post             = get_post();
		$post_type        = get_post_type( $post );
		$post_type_object = get_post_type_object( $post_type );

		$messages['unique'] = array(
			0  => '',
			1  => __( 'Global product label updated.', 'it-woocommerce-advanced-product-labels-pro' ),
			2  => __( 'Custom field updated.', 'it-woocommerce-advanced-product-labels-pro' ),
			3  => __( 'Custom field deleted.', 'it-woocommerce-advanced-product-labels-pro' ),
			4  => __( 'Global product label updated.', 'it-woocommerce-advanced-product-labels-pro' ),
			5  => isset( $_GET['revision'] ) ?
				sprintf( __( 'Product label restored to revision from %s', 'it-woocommerce-advanced-product-labels-pro' ), wp_post_revision_title( (int) $_GET['revision'], false ) )
				: false,
			6  => __( 'Global product label published.', 'it-woocommerce-advanced-product-labels-pro' ),
			7  => __( 'Global product label saved.', 'it-woocommerce-advanced-product-labels-pro' ),
			8  => __( 'Global product label submitted.', 'it-woocommerce-advanced-product-labels-pro' ),
			9  => sprintf(
				__( 'Global product label scheduled for: <strong>%1$s</strong>.', 'it-woocommerce-advanced-product-labels-pro' ),
				date_i18n( __( 'M j, Y @ G:i', 'it-woocommerce-advanced-product-labels-pro' ), strtotime( $post->post_date ) )
			),
			10 => __( 'Global product label draft updated.', 'it-woocommerce-advanced-product-labels-pro' )
		);

		$permalink = admin_url( 'admin.php?page=wc-settings&tab=labels_pro' );

		$view_link            = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'Return to overview.', 'it-woocommerce-advanced-product-labels-pro' ) );
		$messages['unique'][1] .= $view_link;
		$messages['unique'][6] .= $view_link;
		$messages['unique'][9] .= $view_link;

		$preview_link          = sprintf( ' <a href="%s">%s</a>', esc_url( $permalink ), __( 'Return to overview.', 'it-woocommerce-advanced-product-labels-pro' ) );
		$messages['unique'][8]  .= $preview_link;
		$messages['unique'][10] .= $preview_link;

		return $messages;

	}


	/**
	 * Add meta boxes.
	 *
	 * Add two meta boxes to the 'unique' posts.
	 *
	 * @since 1.0.0
	 */
	public function post_type_meta_box() {

		add_meta_box( 'unique_conditions', 'Global Label conditions', array( $this, 'render_conditions' ), 'unique', 'normal' );
		add_meta_box( 'unique_settings', 'Global Label settings', array( $this, 'render_settings' ), 'unique', 'normal' );
        add_meta_box( 'unique_energy', '♥', array( $this, 'dash_widget' ), 'unique', 'side' );

    }

    function dash_widget() {
        $url_for_share =urlencode('https://codecanyon.net/item/woocommerce-advance-product-label-pro/23089623');
        $output = '    <!-- Right Side start here-->
    <div class="unique_rightside">
        <div class="unique_right_side_in_wrapper" style="padding: 10px;">
            <div class="unique_social_title_wrapper">
                <h2 class="unique_social_title"><img src='.UNIQUE_PLUGIN_URL.'/assets/admin/images/social/social-network.png'.'> Share on Social Network</h2>
                <p>Your one share can be best GIFT for me.</p>
                <div class="unique_social_links">
                
                    <a href="http://www.facebook.com/sharer.php?u='. $url_for_share.'" title="Your Share, My best Gift" target="_blank">
                        <img src='.UNIQUE_PLUGIN_URL.'/assets/admin/images/social/facebook.png'.'>
                    </a>

                    <a href="http://twitter.com/share?text='. urlencode("Best #Highlight_Product Plugin for #WooCommerce #Advanced #Product #Label Pro - #iThemeland #pro | #" . rand(88,2934)).'&url='. $url_for_share.'&title="Your Share, My best Gift" target="_blank">
                        <img src='.UNIQUE_PLUGIN_URL.'/assets/admin/images/social/twitter.png'.'>
                    </a>

                    <a href="https://plus.google.com/share?url='. $url_for_share.'&t='. urlencode("Best Highlight Product Plugin for WooCommerce Advanced Product Label Pro").'" title="Your Share, My best Gift" target="_blank">
                        <img src='.UNIQUE_PLUGIN_URL.'/assets/admin/images/social/plus.google.png'.'>
                    </a>

                    <a href="http://www.linkedin.com/shareArticle?mini=true&url='. $url_for_share.'&title='. urlencode("Best Highlight Product Plugin for WooCommerce Advanced Product Label Pro").'" title="Your Share, My best Gift" target="_blank">
                        <img src='.UNIQUE_PLUGIN_URL.'/assets/admin/images/social/linkedin.png'.'>
                    </a>

                    <a href="http://www.reddit.com/submit?url='. $url_for_share.'&title='. urlencode("Best Highlight Product Plugin for WooCommerce Advanced Product Label Pro").'" title="Your Share, My best Gift" target="_blank">
                        <img src='.UNIQUE_PLUGIN_URL.'/assets/admin/images/social/reddit.png'.'>
                    </a>

                    <a href="https://mail.google.com/mail/u/0/?view=cm&fs=1&su='. urlencode("Best Highlight Product Plugin for WooCommerce Advanced Product Label Pro").'&body='. $url_for_share.'&ui=2&tf=1" title="Your Share, My best Gift" target="_blank">
                        <img src='.UNIQUE_PLUGIN_URL.'/assets/admin/images/social/mail.google.png'.'>
                    </a>


                </div>
                <small>Feel free to knock me Any time.</small>
            </div>
        </div>

        <div class="unique_right_side_in_wrapper" style="padding: 10px;">
            <div class="unique_help_wrapper">
                <h1>Need Help?</h1>
                <span>
                    <img src='.UNIQUE_PLUGIN_URL.'/assets/admin/images/social/support.png'.'>
                    <a href="https://support.ithemelandco.com/" target="_blank">Support Center <b>(support.ithemelandco.com)</b></a>
                </span>
                <span>
                    <img src='.UNIQUE_PLUGIN_URL.'/assets/admin/images/social/gmail.png'.'>
                    <a href="https://mail.google.com/mail/u/0/?view=cm&fs=1&su='. urlencode("Need help for " . site_url()).'&body='. urlencode("Hey iThemeland, I need help.\nNow I will explain my Issue.\n...________\n").'&ui=2&tf=1&to='. urlencode("iThemeland<ithemeland.sup724@gmail.com>").'" target="_top">Gmail Me <b>(ithemeland.sup724@gmail.com)</b></a>
                </span>
                <span>
                    <img src='.UNIQUE_PLUGIN_URL.'/assets/admin/images/social/youtube.png'.'>
                    <a href="https://www.youtube.com/playlist?list=PLo0x1Hax3Fusd7IRDzpa73uBG1lO1Z7mI" target="_blank">Youtube Playlist - Video Tutorial</a>
                </span>
            </div>
        </div>

    </div>
';

        echo $output;
    }

	/**
	 * Render meta box.
	 *
	 * Get conditions meta box contents.
	 *
	 * @since 1.0.0
	 */
	public function render_conditions() {
		require_once plugin_dir_path( __FILE__ ) . 'admin/views/html-meta-box-conditions.php';
	}


	/**
	 * Render meta box.
	 *
	 * Get settings meta box contents.
	 *
	 * @since 1.0.0
	 */
	public function render_settings() {
		require_once plugin_dir_path( __FILE__ ) . 'admin/views/html-meta-box-settings.php';
	}


	/**
	 * Save meta.
	 *
	 * Validate and save post meta. This value contains all
	 * the normal fee settings (no conditions).
	 *
	 * @since 1.0.0
	 *
	 * @param  int      $post_id ID of the post being saved.
	 * @return int|void          Post ID when failing, not returning otherwise.
	 */
	public function save_meta_boxes( $post_id ) {

		// verify nonce
		if ( ! isset( $_POST['unique_global_label_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['unique_global_label_meta_box_nonce'], 'unique_global_label_meta_box' ) ) {
			return $post_id;
		}

		// if autosave, don't save
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		// check capability
		if ( ! current_user_can( apply_filters( 'unique_global_label_capability', 'manage_woocommerce' ) ) ) {
			return $post_id;
		}

		// check if post_type is unique
		if ( $_POST['post_type'] != 'unique' ) {
			return $post_id;
		}

		$label               = $_POST['_unique_global_label'];
		$label['conditions'] = wpc_sanitize_conditions( $_POST['conditions'] );

		update_post_meta( $post_id, '_unique_global_label', $label );

	}


	/**
	 * Redirect trash.
	 *
	 * Redirect user after trashing a post.
	 *
	 * @since 1.0.0
	 */
	public function redirect_after_trash() {

		$screen = get_current_screen();

		if ( 'edit-unique' == $screen->id ) :
			if ( isset( $_GET['trashed'] ) &&  intval( $_GET['trashed'] ) > 0 ) :
				wp_redirect( admin_url( '/admin.php?page=wc-settings&tab=labels_pro' ) );
				exit();
			endif;
		endif;


	}


}

/**
 * Load condition object
 */
require_once plugin_dir_path( __FILE__ ) . 'admin/class-unique-condition.php';
