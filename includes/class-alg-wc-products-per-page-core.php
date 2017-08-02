<?php
/**
 * Products per Page for WooCommerce - Core Class
 *
 * @version 1.0.0
 * @since   1.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_Products_Per_Page_Core' ) ) :

class Alg_WC_Products_Per_Page_Core {

	/**
	 * Constructor.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @todo    position priority for every hook
	 * @todo    post or get
	 */
	function __construct() {
		if ( 'yes' === get_option( 'alg_wc_products_per_page_enabled', 'yes' ) ) {
			add_filter( 'loop_shop_per_page', array( $this, 'set_products_per_page_number' ), PHP_INT_MAX );
			$position_hooks = get_option( 'alg_products_per_page_position', array( 'woocommerce_before_shop_loop' ) );
			foreach ( $position_hooks as $position_hook ) {
				add_action( $position_hook, array( $this, 'add_products_per_page_form' ), get_option( 'alg_products_per_page_position_priority', 40 ) );
			}
		}
	}

	/**
	 * add_products_per_page_form.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function add_products_per_page_form() {

		global $wp_query;

		if ( isset( $_POST['alg_products_per_page'] ) ) {
			$products_per_page = $_POST['alg_products_per_page'];
		} elseif ( isset( $_COOKIE['alg_products_per_page'] ) ) {
			$products_per_page = $_COOKIE['alg_products_per_page'];
		} else {
			$products_per_page = get_option( 'alg_products_per_page_default', 10 ); // default
		}

		$paged = get_query_var( 'paged' );
		if ( 0 == $paged ) {
			$paged = 1;
		}

		$products_from  = ( $paged - 1 ) * $products_per_page + 1;
		$products_to    = ( $paged - 1 ) * $products_per_page + $wp_query->post_count;
		$products_total = $wp_query->found_posts;

		$html = '';
		$html .= '<div class="clearfix"></div>';
		$html .= '<div>';
		$html .= '<form action="' . remove_query_arg( 'paged' ) . '" method="POST">';
		$the_text = get_option( 'alg_products_per_page_text', __( 'Products <strong>%from% - %to%</strong> from <strong>%total%</strong>. Products on page %select_form%', 'products-per-page-for-woocommerce' ) );
		$select_form = '<select name="alg_products_per_page" id="alg_products_per_page" class="sortby rounded_corners_class" onchange="this.form.submit()">';
		$html .= str_replace( array( '%from%', '%to%', '%total%', '%select_form%' ), array( $products_from, $products_to, $products_total, $select_form ), $the_text );
		$products_per_page_select_options = apply_filters( 'alg_products_per_page', '10|10' . PHP_EOL . '25|25' . PHP_EOL . '50|50' . PHP_EOL . '100|100' . PHP_EOL . 'All|-1', 'value' );
		$products_per_page_select_options = explode( PHP_EOL, $products_per_page_select_options );
		foreach ( $products_per_page_select_options as $products_per_page_select_option ) {
			$the_option = explode( '|', $products_per_page_select_option );
			if ( 2 === count( $the_option ) ) {
				$sort_id   = $the_option[1];
				$sort_name = $the_option[0];
				$sort_id = str_replace( "\n", '', $sort_id );
				$sort_id = str_replace( "\r", '', $sort_id );
				$sort_name = str_replace( "\n", '', $sort_name );
				$sort_name = str_replace( "\r", '', $sort_name );
				$html .= '<option value="' . $sort_id . '" ' . selected( $products_per_page, $sort_id, false ) . ' >' . $sort_name . '</option>';
			}
		}
		$html .= '</select>';
		$html .= '</form>';
		$html .= '</div>';

		echo $html;
	}

	/**
	 * set_products_per_page_number.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function set_products_per_page_number( $the_number ) {
		if ( isset( $_POST['alg_products_per_page'] ) ) {
			$the_number = $_POST['alg_products_per_page'];
			setcookie( 'alg_products_per_page', $the_number, ( time() + 1209600 ), '/', $_SERVER['SERVER_NAME'], false );
		} elseif ( isset( $_COOKIE['alg_products_per_page'] ) ) {
			$the_number = $_COOKIE['alg_products_per_page'];
		} else {
			$the_number = get_option( 'alg_products_per_page_default', 10 );
		}
		return $the_number;
	}

}

endif;

return new Alg_WC_Products_Per_Page_Core();
