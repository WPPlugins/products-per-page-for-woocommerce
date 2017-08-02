<?php
/**
 * Products per Page for WooCommerce - General Section Settings
 *
 * @version 1.0.0
 * @since   1.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists( 'Alg_WC_Products_Per_Page_Settings_General' ) ) :

class Alg_WC_Products_Per_Page_Settings_General extends Alg_WC_Products_Per_Page_Settings_Section {

	/**
	 * Constructor.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function __construct() {
		$this->id   = '';
		$this->desc = __( 'General', 'products-per-page-for-woocommerce' );
		parent::__construct();
	}

	/**
	 * add_settings.
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 */
	function add_settings( $settings ) {
		$settings = array_merge(
			array(
				array(
					'title'     => __( 'Products per Page Options', 'products-per-page-for-woocommerce' ),
					'type'      => 'title',
					'id'        => 'alg_wc_products_per_page_options',
				),
				array(
					'title'     => __( 'WooCommerce Products per Page', 'products-per-page-for-woocommerce' ),
					'desc'      => '<strong>' . __( 'Enable', 'products-per-page-for-woocommerce' ) . '</strong>',
					'desc_tip'  => __( 'Products per Page for WooCommerce.', 'products-per-page-for-woocommerce' ),
					'id'        => 'alg_wc_products_per_page_enabled',
					'default'   => 'yes',
					'type'      => 'checkbox',
				),
				array(
					'title'    => __( 'Select Options', 'products-per-page-for-woocommerce' ),
					'desc'     => __( 'Name|Number; one per line; -1 for all products.', 'products-per-page-for-woocommerce' ) . apply_filters( 'alg_products_per_page', '<br>' . sprintf( __( 'You will need <a href="%s">Products per Page for WooCommerce Pro plugin</a> to change this option.', 'products-per-page-for-woocommerce' ), 'http://coder.fm/item/products-per-page-for-woocommerce/' ), 'settings' ),
					'id'       => 'alg_products_per_page_select_options',
					'default'  => '10|10' . PHP_EOL . '25|25' . PHP_EOL . '50|50' . PHP_EOL . '100|100' . PHP_EOL . 'All|-1',
					'type'     => 'textarea',
					'css'      => 'height:200px;',
					'custom_attributes' => apply_filters( 'alg_products_per_page', array ( 'readonly' => 'readonly' ), 'settings' ),
				),
				array(
					'title'    => __( 'Default', 'products-per-page-for-woocommerce' ),
					'id'       => 'alg_products_per_page_default',
					'default'  => 10,
					'type'     => 'number',
					'custom_attributes' => array( 'min' => -1 ),
				),
				array(
					'title'    => __( 'Position', 'products-per-page-for-woocommerce' ),
					'id'       => 'alg_products_per_page_position',
					'default'  => array( 'woocommerce_before_shop_loop' ),
					'type'     => 'multiselect',
					'class'    => 'chosen_select',
					'options'  => array(
						'woocommerce_before_shop_loop' => __( 'Before shop loop', 'products-per-page-for-woocommerce' ),
						'woocommerce_after_shop_loop'  => __( 'After shop loop', 'products-per-page-for-woocommerce' ),
					),
				),
				array(
					'title'    => __( 'Position Priority', 'products-per-page-for-woocommerce' ),
					'id'       => 'alg_products_per_page_position_priority',
					'default'  => 40,
					'type'     => 'number',
					'custom_attributes' => array( 'min' => 0 ),
				),
				array(
					'title'    => __( 'Text', 'products-per-page-for-woocommerce' ),
					'id'       => 'alg_products_per_page_text',
					'default'  => __( 'Products <strong>%from% - %to%</strong> from <strong>%total%</strong>. Products on page %select_form%', 'products-per-page-for-woocommerce' ),
					'type'     => 'textarea',
					'css'      => 'width:66%;min-width:300px;',
				),
				array(
					'type'      => 'sectionend',
					'id'        => 'alg_wc_products_per_page_options',
				),
			),
			$settings
		);
		return $settings;
	}

}

endif;

return new Alg_WC_Products_Per_Page_Settings_General();
