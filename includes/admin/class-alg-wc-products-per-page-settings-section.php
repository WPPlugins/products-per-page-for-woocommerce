<?php
/**
 * Products per Page for WooCommerce - Section Settings
 *
 * @version 1.1.0
 * @since   1.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_Products_Per_Page_Settings_Section' ) ) :

class Alg_WC_Products_Per_Page_Settings_Section {

	/**
	 * Constructor.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function __construct() {
		add_filter( 'woocommerce_get_sections_alg_wc_products_per_page',              array( $this, 'settings_section' ) );
		add_filter( 'woocommerce_get_settings_alg_wc_products_per_page_' . $this->id, array( $this, 'get_settings' ), PHP_INT_MAX );
		add_action( 'init', array( $this, 'add_settings_hook' ) );
	}

	/**
	 * add_settings_hook.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function add_settings_hook() {
		add_filter( 'alg_products_per_page_settings_' . $this->id, array( $this, 'add_settings' ) );
	}

	/**
	 * get_settings.
	 *
	 * @version 1.1.0
	 * @since   1.0.0
	 */
	function get_settings() {
		return apply_filters( 'alg_products_per_page_settings_' . $this->id, array(
			array(
				'title'     => __( 'Reset Section Settings', 'products-per-page-for-woocommerce' ),
				'type'      => 'title',
				'id'        => 'alg_wc_products_per_page_' . $this->id . '_reset_options',
			),
			array(
				'title'     => __( 'Reset Settings', 'products-per-page-for-woocommerce' ),
				'desc'      => '<strong>' . __( 'Reset', 'products-per-page-for-woocommerce' ) . '</strong>',
				'id'        => 'alg_wc_products_per_page_' . $this->id . '_reset',
				'default'   => 'no',
				'type'      => 'checkbox',
			),
			array(
				'type'      => 'sectionend',
				'id'        => 'alg_wc_products_per_page_' . $this->id . '_reset_options',
			),
		) );
	}

	/**
	 * settings_section.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function settings_section( $sections ) {
		$sections[ $this->id ] = $this->desc;
		return $sections;
	}

}

endif;
