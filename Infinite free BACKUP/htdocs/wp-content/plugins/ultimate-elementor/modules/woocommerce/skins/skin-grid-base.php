<?php
/**
 * UAEL WooCommerce Skin Grid - Default.
 *
 * @package UAEL
 */

namespace UltimateElementor\Modules\Woocommerce\Skins;

use Elementor\Controls_Manager;
use Elementor\Skin_Base;
use Elementor\Widget_Base;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class Skin_Grid_Base
 *
 * @property Products $parent
 */
abstract class Skin_Grid_Base extends Skin_Base {

	/**
	 * Register control actions.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function _register_controls_actions() { // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore

		add_action( 'elementor/element/uael-woo-products/section_filter_field/after_section_end', array( $this, 'register_quick_view_controls' ), 20 );
		add_action( 'elementor/element/uael-woo-products/section_design_image/after_section_end', array( $this, 'register_quick_view_style_controls' ), 20 );
	}

	/**
	 * Register Quick View Controls.
	 *
	 * @since 0.0.1
	 * @param Widget_Base $widget widget object.
	 * @access public
	 */
	public function register_quick_view_controls( Widget_Base $widget ) {

		$this->parent = $widget;

		$this->start_controls_section(
			'section_content_quick_view',
			array(
				'label' => __( 'Quick View', 'uael' ),
			)
		);

			$this->add_control(
				'quick_view_type',
				array(
					'label'   => __( 'Quick View', 'uael' ),
					'type'    => Controls_Manager::SELECT,
					'default' => '',
					'options' => array(
						''      => __( 'None', 'uael' ),
						'show'  => __( 'On Button Click', 'uael' ),
						'image' => __( 'On Image Click', 'uael' ),
					),
				)
			);

			$this->add_control(
				'image_quick_view_note',
				array(
					'type'            => Controls_Manager::RAW_HTML,
					'raw'             => __( 'Note: Enable the Show Image switch to display the quick view option on image hover.', 'uael' ),
					'condition'       => array(
						$this->get_control_id( 'quick_view_type' ) => 'image',
						$this->get_control_id( 'show_image' ) . '!' => 'yes',
					),
					'content_classes' => 'uael-editor-doc',
				)
			);

		$this->end_controls_section();
	}

	/**
	 * Register Quick View Style Controls.
	 *
	 * @since 0.0.1
	 * @param Widget_Base $widget widget object.
	 * @access public
	 */
	public function register_quick_view_style_controls( Widget_Base $widget ) {

		$this->start_controls_section(
			'section_content_quick_view_style',
			array(
				'label'     => __( 'Quick View', 'uael' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					$this->get_control_id( 'quick_view_type' ) => 'show',
				),
			)
		);

			$this->add_control(
				'quick_view_color',
				array(
					'label'     => __( 'Color', 'uael' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .uael-woocommerce .uael-quick-view-btn span' => 'color: {{VALUE}};',
					),
					'condition' => array(
						$this->get_control_id( 'quick_view_type' ) => 'show',
					),
				)
			);

			$this->add_control(
				'quick_view_bg_color',
				array(
					'label'     => __( 'Background Color', 'uael' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => array(
						'{{WRAPPER}} .uael-woocommerce .uael-quick-view-btn' => 'background-color: {{VALUE}};',
					),
					'condition' => array(
						$this->get_control_id( 'quick_view_type' ) => 'show',
					),
				)
			);

		$this->end_controls_section();
	}
}
