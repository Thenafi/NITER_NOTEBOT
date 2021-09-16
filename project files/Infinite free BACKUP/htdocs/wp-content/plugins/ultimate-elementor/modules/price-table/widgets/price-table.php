<?php
/**
 * UAEL Price Table.
 *
 * @package UAEL
 */

namespace UltimateElementor\Modules\PriceTable\Widgets;

// Elementor Classes.
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;

// UltimateElementor Classes.
use UltimateElementor\Base\Common_Widget;
use UltimateElementor\Classes\UAEL_Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

/**
 * Class PriceTable.
 */
class Price_Table extends Common_Widget {

	/**
	 * Retrieve Price Table Widget name.
	 *
	 * @since 0.0.1
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return parent::get_widget_slug( 'Price_Table' );
	}

	/**
	 * Retrieve Price Table Widget title.
	 *
	 * @since 0.0.1
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return parent::get_widget_title( 'Price_Table' );
	}

	/**
	 * Retrieve Price Table Widget icon.
	 *
	 * @since 0.0.1
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return parent::get_widget_icon( 'Price_Table' );
	}

	/**
	 * Retrieve Widget Keywords.
	 *
	 * @since 1.5.1
	 * @access public
	 *
	 * @return string Widget keywords.
	 */
	public function get_keywords() {
		return parent::get_widget_keywords( 'Price_Table' );
	}

	/**
	 * Register Price Table controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function _register_controls() { // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore 

		$this->register_general_controls();
		$this->register_heading_controls();
		$this->register_pricing_controls();
		$this->register_sub_heading_controls();
		$this->register_content_controls();
		$this->register_cta_controls();
		$this->register_separator_controls();
		$this->register_ribbon_controls();

		$this->register_heading_style_controls();
		$this->register_pricing_style_controls();
		$this->register_sub_heading_style_controls();
		$this->register_content_style_controls();
		$this->register_cta_style_controls();
		$this->register_separator_style_controls();
		$this->register_ribbon_style_controls();
		$this->register_helpful_information();
	}

	/**
	 * Register Price Table General Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_general_controls() {
		$this->start_controls_section(
			'section_general_field',
			array(
				'label' => __( 'General', 'uael' ),
			)
		);

		$this->add_control(
			'pricetable_style',
			array(
				'label'       => __( 'Style', 'uael' ),
				'type'        => Controls_Manager::SELECT,
				'label_block' => false,
				'default'     => '1',
				'options'     => array(
					'1' => 'Normal',
					'2' => 'Features at Bottom',
					'3' => 'Circular Background for Price',
				),
			)
		);

		$this->add_control(
			'box_hover_animation',
			array(
				'label'        => __( 'Hover Animation', 'uael' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => '',
				'options'      => array(
					''                => 'None',
					'float'           => 'Float',
					'sink'            => 'Sink',
					'wobble-vertical' => 'Wobble Vertical',
				),
				'prefix_class' => 'elementor-animation-',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register Price Table Heading Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_heading_controls() {

		$this->start_controls_section(
			'section_header_field',
			array(
				'label' => __( 'Heading', 'uael' ),
			)
		);

		$this->add_control(
			'heading',
			array(
				'label'   => __( 'Title', 'uael' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array(
					'active' => true,
				),
				'default' => __( 'Unlimited', 'uael' ),
			)
		);

		$this->add_control(
			'sub_heading',
			array(
				'label'     => __( 'Description', 'uael' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => array(
					'active' => true,
				),
				'default'   => __( 'Free trial 30 days.', 'uael' ),
				'condition' => array(
					'pricetable_style!' => '2',
				),
			)
		);
		$this->end_controls_section();
	}

	/**
	 * Register Price Table Heading Controls for Style 3.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_sub_heading_controls() {

		$this->start_controls_section(
			'section_sub_heading_field',
			array(
				'label'     => __( 'Description', 'uael' ),
				'condition' => array(
					'pricetable_style' => '2',
				),
			)
		);

		$this->add_control(
			'sub_heading_style2',
			array(
				'label'     => __( 'Description', 'uael' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => array(
					'active' => true,
				),
				'default'   => __( 'Free trial 30 days.', 'uael' ),
				'condition' => array(
					'pricetable_style' => '2',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register Price Table Pricing Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_pricing_controls() {

		$this->start_controls_section(
			'section_pricing_fields',
			array(
				'label' => __( 'Pricing', 'uael' ),
			)
		);
		$this->add_control(
			'price',
			array(
				'label'   => __( 'Price', 'uael' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array(
					'active' => true,
				),
				'default' => __( '49.99', 'uael' ),
			)
		);
		$this->add_control(
			'sale',
			array(
				'label'        => __( 'Offering Discount?', 'uael' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'uael' ),
				'label_off'    => __( 'No', 'uael' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);
		$this->add_control(
			'original_price',
			array(
				'label'     => __( 'Original Price', 'uael' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => '59.99',
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'sale' => 'yes',
				),
			)
		);

		$this->add_control(
			'currency_symbol',
			array(
				'label'   => __( 'Currency Symbol', 'uael' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					''             => __( 'None', 'uael' ),
					'dollar'       => '&#36; ' . _x( 'Dollar', 'Currency Symbol', 'uael' ),
					'euro'         => '&#128; ' . _x( 'Euro', 'Currency Symbol', 'uael' ),
					'baht'         => '&#3647; ' . _x( 'Baht', 'Currency Symbol', 'uael' ),
					'franc'        => '&#8355; ' . _x( 'Franc', 'Currency Symbol', 'uael' ),
					'guilder'      => '&fnof; ' . _x( 'Guilder', 'Currency Symbol', 'uael' ),
					'krona'        => 'kr ' . _x( 'Krona', 'Currency Symbol', 'uael' ),
					'lira'         => '&#8356; ' . _x( 'Lira', 'Currency Symbol', 'uael' ),
					'indian_rupee' => '&#8377; ' . _x( 'Rupee (Indian)', 'Currency Symbol', 'uael' ),
					'peseta'       => '&#8359 ' . _x( 'Peseta', 'Currency Symbol', 'uael' ),
					'peso'         => '&#8369; ' . _x( 'Peso', 'Currency Symbol', 'uael' ),
					'pound'        => '&#163; ' . _x( 'Pound Sterling', 'Currency Symbol', 'uael' ),
					'real'         => 'R$ ' . _x( 'Real', 'Currency Symbol', 'uael' ),
					'ruble'        => '&#8381; ' . _x( 'Ruble', 'Currency Symbol', 'uael' ),
					'rupee'        => '&#8360; ' . _x( 'Rupee', 'Currency Symbol', 'uael' ),
					'shekel'       => '&#8362; ' . _x( 'Shekel', 'Currency Symbol', 'uael' ),
					'yen'          => '&#165; ' . _x( 'Yen/Yuan', 'Currency Symbol', 'uael' ),
					'won'          => '&#8361; ' . _x( 'Won', 'Currency Symbol', 'uael' ),
					'custom'       => __( 'Custom', 'uael' ),
				),
				'default' => 'dollar',
			)
		);

		$this->add_control(
			'currency_symbol_custom',
			array(
				'label'     => __( 'Currency Symbol', 'uael' ),
				'type'      => Controls_Manager::TEXT,
				'condition' => array(
					'currency_symbol' => 'custom',
				),
			)
		);
		$this->add_control(
			'currency_format',
			array(
				'label'   => __( 'Currency Format', 'uael' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					''  => 'Raised',
					',' => 'Normal',
				),
			)
		);
		if ( parent::is_internal_links() ) {

			$this->add_control(
				'help_doc_pricing',
				array(
					'type'            => Controls_Manager::RAW_HTML,
					/* translators: %s admin link */
					'raw'             => __( 'The raised option will add a Subscript / Superscript design to the fractional part of the Price.', 'uael' ),
					'content_classes' => 'uael-editor-doc',
					'condition'       => array(
						'currency_format' => '',
					),
					'separator'       => 'none',
				)
			);
		}

		$this->add_control(
			'duration',
			array(
				'label'   => __( 'Duration', 'uael' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Monthly', 'uael' ),
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'duration_position',
			array(
				'label'       => __( 'Duration Position', 'uael' ),
				'type'        => Controls_Manager::SELECT,
				'label_block' => false,
				'options'     => array(
					'below'  => 'Below',
					'beside' => 'Beside',
				),
				'default'     => 'below',
				'condition'   => array(
					'duration!'         => '',
					'pricetable_style!' => '3',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register Price Table separator Controls for Style 3.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_separator_controls() {

		$this->start_controls_section(
			'section_separator',
			array(
				'label'     => __( 'Separator', 'uael' ),
				'condition' => array(
					'pricetable_style' => '2',
				),
			)
		);

			$this->add_control(
				'pricetable_separator',
				array(
					'label'        => __( 'Separator', 'uael' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __( 'Yes', 'uael' ),
					'label_off'    => __( 'No', 'uael' ),
					'return_value' => 'yes',
					'default'      => 'yes',
					'condition'    => array(
						'pricetable_style' => '2',
					),
				)
			);

			$this->end_controls_section();
	}

	/**
	 * Register Price Table Content Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_content_controls() {

		$this->start_controls_section(
			'section_features',
			array(
				'label' => __( 'Content', 'uael' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'item_text',
			array(
				'label'   => __( 'Text', 'uael' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Feature', 'uael' ),
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		if ( UAEL_Helper::is_elementor_updated() ) {

			$repeater->add_control(
				'new_item_icon',
				array(
					'label'            => __( 'Icon', 'uael' ),
					'type'             => Controls_Manager::ICONS,
					'fa4compatibility' => 'item_icon',
					'default'          => array(
						'value'   => 'fa fa-arrow-circle-right',
						'library' => 'fa-solid',
					),
					'render_type'      => 'template',
				)
			);
		} else {
			$repeater->add_control(
				'item_icon',
				array(
					'label'   => __( 'Icon', 'uael' ),
					'type'    => Controls_Manager::ICON,
					'default' => 'fa fa-arrow-circle-right',
				)
			);
		}

		$repeater->add_control(
			'item_advanced_settings',
			array(
				'label'        => __( 'Override Global Settings', 'uael' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'uael' ),
				'label_off'    => __( 'No', 'uael' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);

		$repeater->add_control(
			'item_icon_color',
			array(
				'label'      => __( 'Icon Color', 'uael' ),
				'type'       => Controls_Manager::COLOR,
				'scheme'     => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				),
				'conditions' => array(
					'relation' => 'and',
					'terms'    => array(
						array(
							'name'     => UAEL_Helper::get_new_icon_name( 'item_icon' ),
							'operator' => '!=',
							'value'    => '',
						),
						array(
							'name'     => 'item_advanced_settings',
							'operator' => '==',
							'value'    => 'yes',
						),
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .uael-price-table-features-list {{CURRENT_ITEM}} i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .uael-price-table-features-list {{CURRENT_ITEM}} svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$repeater->add_control(
			'item_text_color',
			array(
				'label'     => __( 'Text Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'item_advanced_settings' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}};',
				),
			)
		);

		$repeater->add_control(
			'item_bg_color',
			array(
				'label'     => __( 'Background Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'item_advanced_settings' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'background-color: {{VALUE}} !important;',
				),
			)
		);

		$this->add_control(
			'features_list',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => array_values( $repeater->get_controls() ),
				'default'     => array(
					array(
						'item_text'     => __( 'List of Features', 'uael' ),
						'new_item_icon' => array(
							'value'   => 'fa fa-arrow-circle-right',
							'library' => 'fa-solid',
						),
					),
					array(
						'item_text'     => __( 'List of Features', 'uael' ),
						'new_item_icon' => array(
							'value'   => 'fa fa-arrow-circle-right',
							'library' => 'fa-solid',
						),
					),
					array(
						'item_text'     => __( 'List of Features', 'uael' ),
						'new_item_icon' => array(
							'value'   => 'fa fa-arrow-circle-right',
							'library' => 'fa-solid',
						),
					),
				),
				'title_field' => '{{{ item_text }}}',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register Price Table Call to Action Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_cta_controls() {

		$this->start_controls_section(
			'section_button',
			array(
				'label' => __( 'Call To Action', 'uael' ),
			)
		);

		$this->add_control(
			'price_cta_type',
			array(
				'label'       => __( 'Type', 'uael' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'button',
				'label_block' => false,
				'options'     => array(
					'none'   => __( 'None', 'uael' ),
					'link'   => __( 'Text', 'uael' ),
					'button' => __( 'Button', 'uael' ),
				),
			)
		);

		$this->add_control(
			'cta_text',
			array(
				'label'     => __( 'Text', 'uael' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Select Plan', 'uael' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'price_cta_type!' => 'none',
				),
			)
		);

		if ( UAEL_Helper::is_elementor_updated() ) {

			$this->add_control(
				'new_cta_icon',
				array(
					'label'            => __( 'Select Icon', 'uael' ),
					'type'             => Controls_Manager::ICONS,
					'fa4compatibility' => 'cta_icon',
					'condition'        => array(
						'price_cta_type' => array( 'button', 'link' ),
					),
					'render_type'      => 'template',
				)
			);
		} else {
			$this->add_control(
				'cta_icon',
				array(
					'label'     => __( 'Select Icon', 'uael' ),
					'type'      => Controls_Manager::ICON,
					'condition' => array(
						'price_cta_type' => array( 'button', 'link' ),
					),
				)
			);
		}

		$this->add_control(
			'cta_icon_position',
			array(
				'label'       => __( 'Icon Position', 'uael' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'right',
				'label_block' => false,
				'options'     => array(
					'right' => __( 'After Text', 'uael' ),
					'left'  => __( 'Before Text', 'uael' ),
				),
				'condition'   => array(
					'price_cta_type' => array( 'button', 'link' ),
				),
			)
		);

		$this->add_control(
			'link',
			array(
				'label'       => __( 'Link', 'uael' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'http://your-link.com',
				'default'     => array(
					'url' => '#',
				),
				'dynamic'     => array(
					'active' => true,
				),
				'condition'   => array(
					'price_cta_type!' => 'none',
				),
			)
		);

		$this->add_control(
			'footer_additional_info',
			array(
				'label'   => __( 'Disclaimer Text', 'uael' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => 2,
				'dynamic' => array(
					'active' => true,
				),
			)
		);
		$this->end_controls_section();
	}

	/**
	 * Register Price Table Ribbon Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_ribbon_controls() {

		$this->start_controls_section(
			'section_ribbon',
			array(
				'label' => __( 'Ribbon', 'uael' ),
			)
		);

		$this->add_control(
			'show_ribbon',
			array(
				'label'       => __( 'Style', 'uael' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'none',
				'label_block' => false,
				'options'     => array(
					'none' => __( 'None', 'uael' ),
					'1'    => __( 'Corner Ribbon', 'uael' ),
					'2'    => __( 'Circular Ribbon', 'uael' ),
					'3'    => __( 'Flag Ribbon', 'uael' ),
				),
			)
		);

		$this->add_control(
			'ribbon_title',
			array(
				'label'     => __( 'Title', 'uael' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'NEW', 'uael' ),
				'condition' => array(
					'show_ribbon!' => 'none',
				),
			)
		);

		$this->add_control(
			'ribbon_horizontal_position',
			array(
				'label'       => __( 'Horizontal Position', 'uael' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'toggle'      => false,
				'options'     => array(
					'left'  => array(
						'title' => __( 'Left', 'uael' ),
						'icon'  => 'eicon-h-align-left',
					),
					'right' => array(
						'title' => __( 'Right', 'uael' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'default'     => 'right',
				'condition'   => array(
					'show_ribbon!' => array( 'none', '3' ),
				),
			)
		);

		$ribbon_distance_transform = is_rtl() ? 'translateY(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg)' : 'translateY(-50%) translateX(-50%) translateX({{SIZE}}{{UNIT}}) rotate(-45deg)';

		$this->add_responsive_control(
			'ribbon_distance',
			array(
				'label'     => __( 'Distance', 'uael' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 10,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .uael-price-table-ribbon-1 .uael-price-table-ribbon-content' => 'margin-top: {{SIZE}}{{UNIT}}; transform: ' . $ribbon_distance_transform,
				),
				'condition' => array(
					'show_ribbon' => '1',
				),
			)
		);

		$this->add_responsive_control(
			'ribbon_size',
			array(
				'label'     => __( 'Size', 'uael' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'em' => array(
						'min' => 1,
						'max' => 20,
					),
				),
				'default'   => array(
					'size' => '4',
					'unit' => 'em',
				),
				'selectors' => array(
					'{{WRAPPER}} .uael-price-table-ribbon-2 .uael-price-table-ribbon-content' => 'min-height: {{SIZE}}em; min-width: {{SIZE}}em; line-height: {{SIZE}}em; z-index: 1;',
				),
				'condition' => array(
					'show_ribbon' => '2',
				),
			)
		);

		$this->add_responsive_control(
			'ribbon_top_distance',
			array(
				'label'     => __( 'Top Distance', 'uael' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'%' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .uael-price-table-ribbon-3 .uael-price-table-ribbon-content' => 'top: {{SIZE}}%;',
				),
				'condition' => array(
					'show_ribbon' => '3',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register Price Table Heading Style Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_heading_style_controls() {

		$this->start_controls_section(
			'section_header_style',
			array(
				'label'      => __( 'Heading', 'uael' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);
		$this->add_control(
			'header_bg_color',
			array(
				'label'     => __( 'Background Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				),
				'selectors' => array(
					'{{WRAPPER}} .uael-price-table-header' => 'background-color: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'header_padding',
			array(
				'label'      => __( 'Padding', 'uael' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .uael-pricing-style-3 .uael-pricing-heading-wrap, {{WRAPPER}} .uael-pricing-style-2 .uael-price-table-header, {{WRAPPER}} .uael-pricing-style-1 .uael-price-table-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'heading_style',
			array(
				'label'     => __( 'Title', 'uael' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);
		$this->add_control(
			'heading_tag',
			array(
				'label'   => __( 'Title Tag', 'uael' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'h1'  => __( 'H1', 'uael' ),
					'h2'  => __( 'H2', 'uael' ),
					'h3'  => __( 'H3', 'uael' ),
					'h4'  => __( 'H4', 'uael' ),
					'h5'  => __( 'H5', 'uael' ),
					'h6'  => __( 'H6', 'uael' ),
					'div' => __( 'div', 'uael' ),
					'p'   => __( 'p', 'uael' ),
				),
				'default' => 'h3',
			)
		);
		$this->add_control(
			'heading_color',
			array(
				'label'     => __( 'Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'selectors' => array(
					'{{WRAPPER}} .uael-price-table-heading' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'heading_typography',
				'selector' => '{{WRAPPER}} .uael-price-table-heading',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			)
		);

		$this->add_control(
			'sub_heading_style',
			array(
				'label'     => __( 'Description', 'uael' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'pricetable_style!' => '2',
				),
			)
		);
		$this->add_control(
			'sub_heading_tag',
			array(
				'label'     => __( 'Description Tag', 'uael' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'h1'  => __( 'H1', 'uael' ),
					'h2'  => __( 'H2', 'uael' ),
					'h3'  => __( 'H3', 'uael' ),
					'h4'  => __( 'H4', 'uael' ),
					'h5'  => __( 'H5', 'uael' ),
					'h6'  => __( 'H6', 'uael' ),
					'div' => __( 'div', 'uael' ),
					'p'   => __( 'p', 'uael' ),
				),
				'condition' => array(
					'pricetable_style!' => '2',
				),
				'default'   => 'p',
			)
		);
		$this->add_control(
			'sub_heading_color',
			array(
				'label'     => __( 'Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				),
				'condition' => array(
					'pricetable_style!' => '2',
				),
				'selectors' => array(
					'{{WRAPPER}} .uael-price-table-subheading' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'sub_heading_typography',
				'selector'  => '{{WRAPPER}} .uael-price-table-subheading',
				'scheme'    => Scheme_Typography::TYPOGRAPHY_2,
				'condition' => array(
					'pricetable_style!' => '2',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register Price Table Description Style Controls for Style 3.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_sub_heading_style_controls() {

		$this->start_controls_section(
			'section_sub_heading_style2',
			array(
				'label'      => __( 'Description', 'uael' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
				'condition'  => array(
					'pricetable_style' => '2',
				),
			)
		);

		$this->add_control(
			'sub_heading_tag_style2',
			array(
				'label'     => __( 'Description Tag', 'uael' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'h1'  => __( 'H1', 'uael' ),
					'h2'  => __( 'H2', 'uael' ),
					'h3'  => __( 'H3', 'uael' ),
					'h4'  => __( 'H4', 'uael' ),
					'h5'  => __( 'H5', 'uael' ),
					'h6'  => __( 'H6', 'uael' ),
					'div' => __( 'div', 'uael' ),
					'p'   => __( 'p', 'uael' ),
				),
				'condition' => array(
					'pricetable_style' => '2',
				),
				'default'   => 'p',
			)
		);
		$this->add_control(
			'sub_heading_color_style2',
			array(
				'label'     => __( 'Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				),
				'condition' => array(
					'pricetable_style' => '2',
				),
				'selectors' => array(
					'{{WRAPPER}} .uael-price-table-subheading' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'sub_heading_typography_style2',
				'selector'  => '{{WRAPPER}} .uael-price-table-subheading',
				'scheme'    => Scheme_Typography::TYPOGRAPHY_2,
				'condition' => array(
					'pricetable_style' => '2',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register Price Table Pricing Style Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_pricing_style_controls() {

		$this->start_controls_section(
			'section_pricing_element_style',
			array(
				'label'      => __( 'Pricing', 'uael' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);

		$this->add_control(
			'pricing_element_bg_color',
			array(
				'label'     => __( 'Background Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .uael-pricing-style-3 .uael-price-table-pricing, {{WRAPPER}} .uael-pricing-style-2 .uael-price-table-price-wrap, {{WRAPPER}} .uael-pricing-style-1 .uael-price-table-price-wrap' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'price_bg_size',
			array(
				'label'      => __( 'Background Size', 'uael' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em' ),
				'range'      => array(
					'px' => array(
						'min' => 100,
						'max' => 300,
					),
					'em' => array(
						'min' => 5,
						'max' => 20,
					),
				),
				'default'    => array(
					'size' => '9',
					'unit' => 'em',
				),
				'selectors'  => array(
					'{{WRAPPER}} .uael-pricing-style-3 .uael-price-table-pricing' => 'min-height: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}; margin-top: calc( -{{SIZE}}{{UNIT}} / 2 ); box-sizing: content-box;',
					'{{WRAPPER}} .uael-pricing-style-3 .uael-price-table-header' => 'padding-bottom: calc( {{SIZE}}{{UNIT}} / 2 );',
				),
				'condition'  => array(
					'pricetable_style' => '3',
				),
			)
		);

		$this->add_responsive_control(
			'pricing_element_padding',
			array(
				'label'      => __( 'Padding', 'uael' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'condition'  => array(
					'pricetable_style!' => '3',
				),
				'selectors'  => array(
					'{{WRAPPER}} .uael-price-table-price-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'           => 'price_border_style3',
				'label'          => __( 'Border', 'uael' ),
				'fields_options' => array(
					'border' => array(
						'default' => 'solid',
					),
					'width'  => array(
						'default' => array(
							'top'    => '3',
							'right'  => '3',
							'bottom' => '3',
							'left'   => '3',
						),
					),
				),
				'condition'      => array(
					'pricetable_style' => '3',
				),
				'selector'       => '{{WRAPPER}} .uael-pricing-style-3 .uael-price-table-pricing',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'section_price_shadow',
				'condition' => array(
					'pricetable_style' => '3',
				),
				'selector'  => '{{WRAPPER}} .uael-price-table-pricing',
			)
		);

		$this->add_control(
			'main_price_style',
			array(
				'label'     => __( 'Price', 'uael' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'price_color',
			array(
				'label'     => __( 'Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .uael-price-table-currency, {{WRAPPER}} .uael-price-table-integer-part, {{WRAPPER}} .uael-price-table-fractional-part, {{WRAPPER}} .uael-price-currency-normal' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'price_typography',
				'selector' => '{{WRAPPER}} .uael-pricing-value',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
			)
		);

		$this->add_control(
			'heading_currency_style',
			array(
				'label'     => __( 'Currency Symbol', 'uael' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'currency_symbol!' => '',
					'currency_format!' => ',',
				),
			)
		);

		$this->add_responsive_control(
			'currency_size',
			array(
				'label'     => __( 'Size', 'uael' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .uael-price-table-currency' => 'font-size: calc({{SIZE}}em/100)',
				),
				'condition' => array(
					'currency_symbol!' => '',
					'currency_format!' => ',',
				),
			)
		);

		$this->add_control(
			'currency_vertical_position',
			array(
				'label'                => __( 'Vertical Position', 'uael' ),
				'type'                 => Controls_Manager::CHOOSE,
				'label_block'          => false,
				'options'              => array(
					'top'    => array(
						'title' => __( 'Top', 'uael' ),
						'icon'  => 'eicon-v-align-top',
					),
					'middle' => array(
						'title' => __( 'Middle', 'uael' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'bottom' => array(
						'title' => __( 'Bottom', 'uael' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'condition'            => array(
					'currency_symbol!' => '',
					'currency_format!' => ',',
				),
				'default'              => 'top',
				'selectors_dictionary' => array(
					'top'    => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				),
				'selectors'            => array(
					'{{WRAPPER}} .uael-price-table-currency' => 'align-self: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'fractional_part_style',
			array(
				'label'     => __( 'Fractional Part', 'uael' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'currency_format!' => ',',
				),
			)
		);

		$this->add_responsive_control(
			'fractional_part_size',
			array(
				'label'     => __( 'Size', 'uael' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'condition' => array(
					'currency_format!' => ',',
				),
				'selectors' => array(
					'{{WRAPPER}} .uael-price-table-fractional-part' => 'font-size: calc({{SIZE}}em/100)',
				),
			)
		);

		$this->add_control(
			'fractional_part_position',
			array(
				'label'                => __( 'Vertical Position', 'uael' ),
				'type'                 => Controls_Manager::CHOOSE,
				'label_block'          => false,
				'options'              => array(
					'top'    => array(
						'title' => __( 'Top', 'uael' ),
						'icon'  => 'eicon-v-align-top',
					),
					'middle' => array(
						'title' => __( 'Middle', 'uael' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'bottom' => array(
						'title' => __( 'Bottom', 'uael' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'default'              => 'top',
				'selectors_dictionary' => array(
					'top'    => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				),
				'condition'            => array(
					'currency_format!' => ',',
				),
				'selectors'            => array(
					'{{WRAPPER}} .uael-price-table-beside-price' => 'align-self: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'heading_original_price_style',
			array(
				'label'     => __( 'Original Price', 'uael' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'sale'            => 'yes',
					'original_price!' => '',
				),
			)
		);

		$this->add_control(
			'original_price_color',
			array(
				'label'     => __( 'Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				),
				'selectors' => array(
					'{{WRAPPER}} .uael-price-table-original-price' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'sale'            => 'yes',
					'original_price!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'original_price_typography',
				'selector'  => '{{WRAPPER}} .uael-price-table-original-price',
				'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
				'condition' => array(
					'sale'            => 'yes',
					'original_price!' => '',
				),
			)
		);

		$this->add_control(
			'original_price_vertical_position',
			array(
				'label'                => __( 'Vertical Position', 'uael' ),
				'type'                 => Controls_Manager::CHOOSE,
				'label_block'          => false,
				'options'              => array(
					'top'    => array(
						'title' => __( 'Top', 'uael' ),
						'icon'  => 'eicon-v-align-top',
					),
					'middle' => array(
						'title' => __( 'Middle', 'uael' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'bottom' => array(
						'title' => __( 'Bottom', 'uael' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'selectors_dictionary' => array(
					'top'    => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				),
				'default'              => 'middle',
				'selectors'            => array(
					'{{WRAPPER}} .uael-price-table-original-price' => 'align-self: {{VALUE}}',
				),
				'condition'            => array(
					'sale'            => 'yes',
					'original_price!' => '',
				),
			)
		);

		$this->add_control(
			'heading_duration_style',
			array(
				'label'     => __( 'Duration', 'uael' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'duration!' => '',
				),
			)
		);

		$this->add_control(
			'duration_color',
			array(
				'label'     => __( 'Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				),
				'selectors' => array(
					'{{WRAPPER}} .uael-price-table-duration' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'duration!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'duration_typography',
				'selector'  => '{{WRAPPER}} .uael-price-table-duration',
				'scheme'    => Scheme_Typography::TYPOGRAPHY_2,
				'condition' => array(
					'duration!' => '',
				),
			)
		);

		$this->add_control(
			'duration_part_position',
			array(
				'label'                => __( 'Vertical Position', 'uael' ),
				'type'                 => Controls_Manager::CHOOSE,
				'label_block'          => false,
				'options'              => array(
					'top'    => array(
						'title' => __( 'Top', 'uael' ),
						'icon'  => 'eicon-v-align-top',
					),
					'middle' => array(
						'title' => __( 'Middle', 'uael' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'bottom' => array(
						'title' => __( 'Bottom', 'uael' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'default'              => 'bottom',
				'selectors_dictionary' => array(
					'top'    => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				),
				'condition'            => array(
					'duration_position' => 'beside',
					'currency_format'   => ',',
					'pricetable_style!' => '2',
				),
				'selectors'            => array(
					'{{WRAPPER}} .uael-price-table-beside-price' => 'align-self: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register Price Table Content Style Controls for Style 3.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_separator_style_controls() {

		$this->start_controls_section(
			'section_separator_style',
			array(
				'label'      => __( 'Separator', 'uael' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
				'condition'  => array(
					'pricetable_style' => '2',
				),
			)
		);

		$this->add_control(
			'pricetable_separator_style',
			array(
				'label'       => __( 'Style', 'uael' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'solid',
				'label_block' => false,
				'options'     => array(
					'solid'  => __( 'Solid', 'uael' ),
					'dashed' => __( 'Dashed', 'uael' ),
					'dotted' => __( 'Dotted', 'uael' ),
					'double' => __( 'Double', 'uael' ),
				),
				'condition'   => array(
					'pricetable_separator' => 'yes',
					'pricetable_style'     => '2',
				),
				'selectors'   => array(
					'{{WRAPPER}} .uael-separator' => 'border-top-style: {{VALUE}}; display: inline-block;',
				),
			)
		);

		$this->add_control(
			'pricetable_separator_color',
			array(
				'label'     => __( 'Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#eaeaea',
				'condition' => array(
					'pricetable_separator' => 'yes',
					'pricetable_style'     => '2',
				),
				'selectors' => array(
					'{{WRAPPER}} .uael-separator' => 'border-top-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'pricetable_separator_thickness',
			array(
				'label'      => __( 'Thickness', 'uael' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 200,
					),
				),
				'default'    => array(
					'size' => 2,
					'unit' => 'px',
				),
				'condition'  => array(
					'pricetable_separator' => 'yes',
					'pricetable_style'     => '2',
				),
				'selectors'  => array(
					'{{WRAPPER}} .uael-separator' => 'border-top-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'pricetable_separator_width',
			array(
				'label'          => __( 'Width', 'uael' ),
				'type'           => Controls_Manager::SLIDER,
				'size_units'     => array( '%', 'px' ),
				'range'          => array(
					'px' => array(
						'max' => 1200,
					),
				),
				'default'        => array(
					'size' => 70,
					'unit' => '%',
				),
				'tablet_default' => array(
					'unit' => '%',
				),
				'mobile_default' => array(
					'unit' => '%',
				),
				'label_block'    => true,
				'condition'      => array(
					'pricetable_separator' => 'yes',
					'pricetable_style'     => '2',
				),
				'selectors'      => array(
					'{{WRAPPER}} .uael-separator' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register Price Table Content Style Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_content_style_controls() {

		$this->start_controls_section(
			'section_features_list_style',
			array(
				'label'      => __( 'Content', 'uael' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);

		$this->add_control(
			'price_features_layout',
			array(
				'label'        => __( 'Layout', 'uael' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'simple',
				'label_block'  => false,
				'options'      => array(
					'simple'    => __( 'Simple', 'uael' ),
					'divider'   => __( 'Divider between fields', 'uael' ),
					'borderbox' => __( 'Box Layout', 'uael' ),
					'strips'    => __( 'Stripped Layout', 'uael' ),
				),
				'prefix_class' => 'uael-price-features-',
			)
		);

		$this->add_control(
			'features_list_bg_color',
			array(
				'label'     => __( 'Background Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'price_features_layout!' => 'strips',
				),
				'selectors' => array(
					'{{WRAPPER}} .uael-price-table-features-list, {{WRAPPER}} .uael-pricing-style-3 .uael-price-table-price-wrap' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'features_list_padding',
			array(
				'label'      => __( 'Box Padding', 'uael' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .uael-price-table-features-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'features_list_style_fields',
			array(
				'label'     => __( 'Features List', 'uael' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'features_icon_spacing',
			array(
				'label'     => __( 'Icon Spacing', 'uael' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 5,
					'unit' => 'px',
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 20,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .uael-price-table-features-list i,
					{{WRAPPER}} .uael-price-table-features-list svg' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'features_icon_color',
			array(
				'label'     => __( 'Icon Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .uael-price-table-features-list i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .uael-price-table-features-list svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'features_list_color',
			array(
				'label'     => __( 'Text Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				),
				'selectors' => array(
					'{{WRAPPER}} .uael-price-table-features-list' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'features_list_typography',
				'selector' => '{{WRAPPER}} .uael-price-table-features-list li',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
			)
		);

		$this->add_responsive_control(
			'features_rows_padding',
			array(
				'label'      => __( 'Item Padding', 'uael' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .uael-price-table-feature-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'features_list_alignment',
			array(
				'label'       => __( 'Alignment', 'uael' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => array(
					'left'   => array(
						'title' => __( 'Left', 'uael' ),
						'icon'  => 'fa fa-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'uael' ),
						'icon'  => 'fa fa-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'uael' ),
						'icon'  => 'fa fa-align-right',
					),
				),
				'selectors'   => array(
					'{{WRAPPER}} .uael-price-table-features-list' => 'text-align: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'features_list_divider_heading',
			array(
				'label'     => __( 'Divider', 'uael' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'price_features_layout' => 'divider',
				),
			)
		);

		$this->add_control(
			'features_list_borderbox',
			array(
				'label'     => __( 'Box Layout', 'uael' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'price_features_layout' => 'borderbox',
				),
			)
		);

		$this->add_control(
			'divider_style',
			array(
				'label'     => __( 'Style', 'uael' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'solid'  => __( 'Solid', 'uael' ),
					'double' => __( 'Double', 'uael' ),
					'dotted' => __( 'Dotted', 'uael' ),
					'dashed' => __( 'Dashed', 'uael' ),
				),
				'condition' => array(
					'price_features_layout' => array( 'divider', 'borderbox' ),
				),
				'default'   => 'solid',
				'selectors' => array(
					'{{WRAPPER}}.uael-price-features-divider .uael-price-table-features-list li:before, {{WRAPPER}}.uael-price-features-borderbox .uael-price-table-features-list li:before, {{WRAPPER}}.uael-price-features-borderbox .uael-price-table-features-list li:after' => 'border-top-style: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'divider_color',
			array(
				'label'     => __( 'Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ddd',
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				),
				'condition' => array(
					'price_features_layout' => array( 'divider', 'borderbox' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .uael-price-table-features-list li:before, {{WRAPPER}}.uael-price-features-borderbox .uael-price-table-features-list li:after' => 'border-top-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'divider_weight',
			array(
				'label'     => __( 'Weight', 'uael' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 1,
					'unit' => 'px',
				),
				'range'     => array(
					'px' => array(
						'min' => 1,
						'max' => 20,
					),
				),
				'condition' => array(
					'price_features_layout' => array( 'divider', 'borderbox' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .uael-price-table-features-list li:before, {{WRAPPER}}.uael-price-features-borderbox .uael-price-table-features-list li:after' => 'border-top-width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'divider_width',
			array(
				'label'     => __( 'Width', 'uael' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => '60',
					'unit' => 'px',
				),
				'condition' => array(
					'price_features_layout' => 'divider',
				),
				'selectors' => array(
					'{{WRAPPER}}.uael-price-features-divider .uael-price-table-features-list li:before' => 'margin-left: calc((100% - {{SIZE}}%)/2); margin-right: calc((100% - {{SIZE}}%)/2)',
				),
			)
		);

		$this->add_control(
			'features_even_odd_fields',
			array(
				'label'     => __( 'Stripped Layout', 'uael' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'price_features_layout' => 'strips',
				),
			)
		);

		$this->start_controls_tabs( 'features_list_style' );

		$this->start_controls_tab(
			'features_even',
			array(
				'label'     => __( 'Even', 'uael' ),
				'condition' => array(
					'price_features_layout' => 'strips',
				),
			)
		);

		$this->add_control(
			'features_bg_color_even',
			array(
				'label'     => __( 'Background Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => array(
					'{{WRAPPER}} .uael-price-table .uael-price-table-features-list li:nth-child(even)' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'price_features_layout' => 'strips',
				),
			)
		);

		$this->add_control(
			'features_text_color_even',
			array(
				'label'     => __( 'Text Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .uael-price-table .uael-price-table-features-list li:nth-child(even)' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'price_features_layout' => 'strips',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_features_odd',
			array(
				'label'     => __( 'Odd', 'uael' ),
				'condition' => array(
					'price_features_layout' => 'strips',
				),
			)
		);

		$this->add_control(
			'table_features_bg_color_odd',
			array(
				'label'     => __( 'Background Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#eaeaea',
				'selectors' => array(
					'{{WRAPPER}} .uael-price-table .uael-price-table-features-list li:nth-child(odd)' => 'background-color: {{VALUE}}',
				),
				'condition' => array(
					'price_features_layout' => 'strips',
				),
			)
		);

		$this->add_control(
			'table_features_text_color_odd',
			array(
				'label'     => __( 'Text Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .uael-price-table .uael-price-table-features-list li:nth-child(odd)' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'price_features_layout' => 'strips',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'features_spacing',
			array(
				'label'     => __( 'Item Spacing', 'uael' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 50,
					),
				),
				'default'   => array(
					'size' => '0',
					'unit' => 'px',
				),
				'selectors' => array(
					'{{WRAPPER}} .uael-price-table .uael-price-table-features-list li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'price_features_layout' => 'strips',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register Price Table CTA style Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_cta_style_controls() {

		$this->start_controls_section(
			'section_footer_style',
			array(
				'label'      => __( 'Call To Action', 'uael' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);

		$this->add_control(
			'footer_bg_color',
			array(
				'label'     => __( 'Background Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .uael-price-table-cta' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'footer_padding',
			array(
				'label'      => __( 'Padding', 'uael' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .uael-price-table-cta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'heading_footer_link',
			array(
				'label'     => __( 'Link', 'uael' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'price_cta_type' => 'link',
				),
			)
		);

		$this->add_control(
			'link_text_color',
			array(
				'label'     => __( 'Text Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				),
				'selectors' => array(
					'{{WRAPPER}} a.uael-pricebox-cta-link' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'price_cta_type' => 'link',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'link_typography',
				'selector'  => '{{WRAPPER}} a.uael-pricebox-cta-link',
				'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
				'condition' => array(
					'price_cta_type' => 'link',
				),
			)
		);

		$this->add_control(
			'heading_footer_button',
			array(
				'label'     => __( 'Button', 'uael' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'price_cta_type' => 'button',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'button_typography',
				'selector'  => '{{WRAPPER}} .elementor-button, {{WRAPPER}} a.elementor-button',
				'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
				'condition' => array(
					'price_cta_type' => 'button',
				),
			)
		);

		$this->add_control(
			'button_size',
			array(
				'label'     => __( 'Size', 'uael' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'md',
				'options'   => array(
					'xs' => __( 'Extra Small', 'uael' ),
					'sm' => __( 'Small', 'uael' ),
					'md' => __( 'Medium', 'uael' ),
					'lg' => __( 'Large', 'uael' ),
					'xl' => __( 'Extra Large', 'uael' ),
				),
				'condition' => array(
					'price_cta_type' => 'button',
				),
			)
		);
		$this->add_responsive_control(
			'button_custom_padding',
			array(
				'label'      => __( 'Padding', 'uael' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'price_cta_type' => 'button',
				),
				'separator'  => 'after',
			)
		);

		$this->start_controls_tabs( 'tabs_button_style' );

			$this->start_controls_tab(
				'tab_button_normal',
				array(
					'label'     => __( 'Normal', 'uael' ),
					'condition' => array(
						'price_cta_type' => 'button',
					),
				)
			);

			$this->add_control(
				'cta_text_color',
				array(
					'label'     => __( 'Text Color', 'uael' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => array(
						'{{WRAPPER}} a.elementor-button, {{WRAPPER}} .elementor-button' => 'color: {{VALUE}};',
						'{{WRAPPER}} .elementor-button' => 'border-color: {{VALUE}};',
					),
					'condition' => array(
						'price_cta_type' => 'button',
					),
				)
			);

			$this->add_control(
				'button_background_color',
				array(
					'label'     => __( 'Background Color', 'uael' ),
					'type'      => Controls_Manager::COLOR,
					'scheme'    => array(
						'type'  => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_4,
					),
					'selectors' => array(
						'{{WRAPPER}} .elementor-button' => 'background-color: {{VALUE}};',
					),
					'condition' => array(
						'price_cta_type' => 'button',
					),
				)
			);

			$this->add_control(
				'button_border',
				array(
					'label'       => __( 'Border Style', 'uael' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'none',
					'label_block' => false,
					'options'     => array(
						'none'   => __( 'None', 'uael' ),
						'solid'  => __( 'Solid', 'uael' ),
						'double' => __( 'Double', 'uael' ),
						'dotted' => __( 'Dotted', 'uael' ),
						'dashed' => __( 'Dashed', 'uael' ),
					),
					'condition'   => array(
						'price_cta_type' => 'button',
					),
					'selectors'   => array(
						'{{WRAPPER}} .elementor-button' => 'border-style: {{VALUE}};',
					),
				)
			);

			$this->add_control(
				'button_border_size',
				array(
					'label'      => __( 'Border Width', 'uael' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px' ),
					'default'    => array(
						'top'    => '1',
						'bottom' => '1',
						'left'   => '1',
						'right'  => '1',
						'unit'   => 'px',
					),
					'condition'  => array(
						'price_cta_type' => 'button',
						'button_border!' => 'none',
					),
					'selectors'  => array(
						'{{WRAPPER}} .uael-price-table .elementor-button' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);

			$this->add_control(
				'button_border_color',
				array(
					'label'     => __( 'Border Color', 'uael' ),
					'type'      => Controls_Manager::COLOR,
					'condition' => array(
						'price_cta_type' => 'button',
						'button_border!' => 'none',
					),
					'default'   => '',
					'selectors' => array(
						'{{WRAPPER}} .uael-price-table .elementor-button' => 'border-color: {{VALUE}};',
					),
				)
			);

			$this->add_responsive_control(
				'button_border_radius',
				array(
					'label'      => __( 'Border Radius', 'uael' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
					'condition'  => array(
						'price_cta_type' => 'button',
					),
				)
			);
			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'      => 'button_box_shadow',
					'label'     => __( 'Button Shadow', 'uael' ),
					'condition' => array(
						'price_cta_type' => 'button',
					),
					'selector'  => '{{WRAPPER}} .elementor-button',
				)
			);

			$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label'     => __( 'Hover', 'uael' ),
				'condition' => array(
					'price_cta_type' => 'button',
				),
			)
		);

		$this->add_control(
			'button_hover_color',
			array(
				'label'     => __( 'Text Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} a.elementor-button:hover, {{WRAPPER}} .elementor-button:hover' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'price_cta_type' => 'button',
				),
			)
		);

		$this->add_control(
			'button_background_hover_color',
			array(
				'label'     => __( 'Background Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .elementor-button:hover' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'price_cta_type' => 'button',
				),
			)
		);

		$this->add_control(
			'button_hover_border_color',
			array(
				'label'     => __( 'Border Hover Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .elementor-button:hover' => 'border-color: {{VALUE}};',
				),
				'condition' => array(
					'price_cta_type' => 'button',
					'button_border!' => 'none',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'button_hover_box_shadow',
				'label'     => __( 'Hover Shadow', 'uael' ),
				'selector'  => '{{WRAPPER}} .elementor-button:hover',
				'separator' => 'before',
				'condition' => array(
					'price_cta_type' => 'button',
				),
			)
		);

		$this->add_control(
			'button_hover_animation',
			array(
				'label'     => __( 'Animation', 'uael' ),
				'type'      => Controls_Manager::HOVER_ANIMATION,
				'condition' => array(
					'price_cta_type' => 'button',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'heading_additional_info',
			array(
				'label'     => __( 'Disclaimer Text', 'uael' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'footer_additional_info!' => '',
				),
			)
		);
		$this->add_control(
			'additional_info_color',
			array(
				'label'     => __( 'Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				),
				'selectors' => array(
					'{{WRAPPER}} .uael-price-table-disclaimer' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'footer_additional_info!' => '',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'additional_info_typography',
				'selector'  => '{{WRAPPER}} .uael-price-table-disclaimer',
				'scheme'    => Scheme_Typography::TYPOGRAPHY_3,
				'condition' => array(
					'footer_additional_info!' => '',
				),
			)
		);

		$this->add_control(
			'additional_info_margin',
			array(
				'label'      => __( 'Margin', 'uael' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'default'    => array(
					'top'    => 20,
					'right'  => 20,
					'bottom' => 20,
					'left'   => 20,
					'unit'   => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .uael-price-table-disclaimer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				),
				'condition'  => array(
					'footer_additional_info!' => '',
				),
			)
		);
		$this->end_controls_section();
	}

	/**
	 * Register Price Table Ribbon Style Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_ribbon_style_controls() {

		$this->start_controls_section(
			'section_ribbon_style',
			array(
				'label'      => __( 'Ribbon', 'uael' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
				'condition'  => array(
					'show_ribbon!' => 'none',
				),
			)
		);
		$this->add_control(
			'ribbon_bg_color',
			array(
				'label'     => __( 'Background Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				),
				'selectors' => array(
					'{{WRAPPER}} .uael-price-table-ribbon-content' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .uael-price-table-ribbon-3 .uael-price-table-ribbon-content:before' => 'border-left: 8px solid {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'ribbon_padding',
			array(
				'label'      => __( 'Padding', 'uael' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .uael-price-table-ribbon-3 .uael-price-table-ribbon-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
				'condition'  => array(
					'show_ribbon' => '3',
				),
			)
		);

		$this->add_control(
			'ribbon_text_color',
			array(
				'label'     => __( 'Text Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => array(
					'{{WRAPPER}} .uael-price-table-ribbon-content' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'ribbon_typography',
				'selector' => '{{WRAPPER}} .uael-price-table-ribbon-content',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_shadow',
				'selector' => '{{WRAPPER}} .uael-price-table-ribbon-content',
			)
		);
		$this->end_controls_section();
	}

	/**
	 * Helpful Information.
	 *
	 * @since 1.1.0
	 * @access protected
	 */
	protected function register_helpful_information() {

		if ( parent::is_internal_links() ) {
			$this->start_controls_section(
				'section_helpful_info',
				array(
					'label' => __( 'Helpful Information', 'uael' ),
				)
			);

			$this->add_control(
				'help_doc_1',
				array(
					'type'            => Controls_Manager::RAW_HTML,
					/* translators: %1$s doc link */
					'raw'             => sprintf( __( '%1$s Getting started article » %2$s', 'uael' ), '<a href="https://uaelementor.com/docs/price-box-widget/?utm_source=uael-pro-dashboard&utm_medium=uael-editor-screen&utm_campaign=uael-pro-plugin" target="_blank" rel="noopener">', '</a>' ),
					'content_classes' => 'uael-editor-doc',
				)
			);

			$this->add_control(
				'help_doc_7',
				array(
					'type'            => Controls_Manager::RAW_HTML,
					/* translators: %1$s doc link */
					'raw'             => sprintf( __( '%1$s Getting started video » %2$s', 'uael' ), '<a href="https://www.youtube.com/watch?v=TJmcPWToHU0&list=PL1kzJGWGPrW_7HabOZHb6z88t_S8r-xAc&index=10" target="_blank" rel="noopener">', '</a>' ),
					'content_classes' => 'uael-editor-doc',
				)
			);

			$this->add_control(
				'help_doc_2',
				array(
					'type'            => Controls_Manager::RAW_HTML,
					/* translators: %1$s doc link */
					'raw'             => sprintf( __( '%1$s Price Box styles » %2$s', 'uael' ), '<a href="https://uaelementor.com/docs/what-are-different-style-options-for-price-box/?utm_source=uael-pro-dashboard&utm_medium=uael-editor-screen&utm_campaign=uael-pro-plugin" target="_blank" rel="noopener">', '</a>' ),
					'content_classes' => 'uael-editor-doc',
				)
			);

			$this->add_control(
				'help_doc_3',
				array(
					'type'            => Controls_Manager::RAW_HTML,
					/* translators: %1$s doc link */
					'raw'             => sprintf( __( '%1$s Price value & Currency styling » %2$s', 'uael' ), '<a href="https://uaelementor.com/docs/normal-and-raised-format-for-price/?utm_source=uael-pro-dashboard&utm_medium=uael-editor-screen&utm_campaign=uael-pro-plugin" target="_blank" rel="noopener">', '</a>' ),
					'content_classes' => 'uael-editor-doc',
				)
			);

			$this->add_control(
				'help_doc_4',
				array(
					'type'            => Controls_Manager::RAW_HTML,
					/* translators: %1$s doc link */
					'raw'             => sprintf( __( '%1$s Content / Features area styling » %2$s', 'uael' ), '<a href="https://uaelementor.com/docs/box-and-stripped-layouts-for-content-in-price-box/?utm_source=uael-pro-dashboard&utm_medium=uael-editor-screen&utm_campaign=uael-pro-plugin" target="_blank" rel="noopener">', '</a>' ),
					'content_classes' => 'uael-editor-doc',
				)
			);

			$this->add_control(
				'help_doc_5',
				array(
					'type'            => Controls_Manager::RAW_HTML,
					/* translators: %1$s doc link */
					'raw'             => sprintf( __( '%1$s Ribbon styles » %2$s', 'uael' ), '<a href="https://uaelementor.com/docs/different-ribbon-styles-for-price-box/?utm_source=uael-pro-dashboard&utm_medium=uael-editor-screen&utm_campaign=uael-pro-plugin" target="_blank" rel="noopener">', '</a>' ),
					'content_classes' => 'uael-editor-doc',
				)
			);

			$this->add_control(
				'help_doc_6',
				array(
					'type'            => Controls_Manager::RAW_HTML,
					/* translators: %1$s doc link */
					'raw'             => sprintf( __( '%1$s Hover Animation effects » %2$s', 'uael' ), '<a href="https://uaelementor.com/docs/hover-animation-effects-for-price-box/?utm_source=uael-pro-dashboard&utm_medium=uael-editor-screen&utm_campaign=uael-pro-plugin" target="_blank" rel="noopener">', '</a>' ),
					'content_classes' => 'uael-editor-doc',
				)
			);

			$this->end_controls_section();
		}
	}

	/**
	 * Method render_button_icon
	 *
	 * @since 1.16.1
	 * @access public
	 * @param object $settings for settings.
	 * @param string $position for before/after icon.
	 */
	public function render_button_icon( $settings, $position ) {
		$this->add_render_attribute( 'button_icon', 'class', 'uael-cta-link-icon uael-cta-link-icon-' . $position );
		if ( UAEL_Helper::is_elementor_updated() ) {
			$cta_migrated = isset( $settings['__fa4_migrated']['new_cta_icon'] );
			$cta_is_new   = empty( $settings['cta_icon'] );
			if ( ! empty( $settings['cta_icon'] ) || ! empty( $settings['new_cta_icon'] ) ) {
				?>
				<span <?php echo wp_kses_post( $this->get_render_attribute_string( 'button_icon' ) ); ?>>
					<?php
					if ( $cta_is_new || $cta_migrated ) {
						\Elementor\Icons_Manager::render_icon( $settings['new_cta_icon'], array( 'aria-hidden' => 'true' ) );
					} else {
						?>
						<i class="<?php echo esc_attr( $settings['cta_icon'] ); ?>" aria-hidden="true"></i>
						<?php
					}
					?>
				</span>
			<?php } ?>
		<?php } elseif ( ! empty( $settings['cta_icon'] ) ) { ?>
			<span <?php echo wp_kses_post( $this->get_render_attribute_string( 'button_icon' ) ); ?>>
				<i class="<?php echo esc_attr( $settings['cta_icon'] ); ?>" aria-hidden="true"></i>
			</span>
			<?php
		}
	}

	/**
	 * Method render_button
	 *
	 * @since 0.0.1
	 * @access public
	 * @param object $settings for settings.
	 */
	public function render_button( $settings ) {
		if ( 'link' === $settings['price_cta_type'] ) {

			$_nofollow = ( 'on' === $settings['link']['nofollow'] ) ? 'nofollow' : '';
			$_target   = ( 'on' === $settings['link']['is_external'] ) ? '_blank' : '';
			$_link     = ( isset( $settings['link']['url'] ) ) ? $settings['link']['url'] : '';

			if ( ! empty( $settings['link']['url'] ) ) {

				$this->add_render_attribute( 'cta_link', 'href', $settings['link']['url'] );
				$this->add_render_attribute( 'cta_link', 'class', 'uael-pricebox-cta-link' );

				if ( $settings['link']['is_external'] ) {
					$this->add_render_attribute( 'cta_link', 'target', '_blank' );
				}
				if ( $settings['link']['nofollow'] ) {
					$this->add_render_attribute( 'cta_link', 'rel', 'nofollow' );
				}
			}

			?>
			<a <?php echo wp_kses_post( $this->get_render_attribute_string( 'cta_link' ) ); ?>>
				<?php if ( 'left' === $settings['cta_icon_position'] ) { ?>
					<?php $this->render_button_icon( $settings, 'before' ); ?>
				<?php } ?>
				<?php
				if ( ! empty( $settings['cta_text'] ) ) {
					?>
					<span class="elementor-inline-editing" data-elementor-setting-key="cta_text" data-elementor-inline-editing-toolbar="basic"><?php echo wp_kses_post( $settings['cta_text'] ); ?></span>
				<?php } ?>
				<?php
				if ( 'right' === $settings['cta_icon_position'] ) {
					$this->render_button_icon( $settings, 'after' );
				}
				?>
			</a>
			<?php
		} elseif ( 'button' === $settings['price_cta_type'] ) {

			$this->add_render_attribute( 'wrapper', 'class', 'uael-button-wrapper elementor-button-wrapper' );
			if ( ! empty( $settings['link']['url'] ) ) {
				$this->add_render_attribute( 'button', 'href', $settings['link']['url'] );
				$this->add_render_attribute( 'button', 'class', 'elementor-button-link' );

				if ( $settings['link']['is_external'] ) {
					$this->add_render_attribute( 'button', 'target', '_blank' );
				}
				if ( $settings['link']['nofollow'] ) {
					$this->add_render_attribute( 'button', 'rel', 'nofollow' );
				}
			}
			$this->add_render_attribute( 'button', 'class', ' elementor-button' );
			if ( ! empty( $settings['button_size'] ) ) {
				$this->add_render_attribute( 'button', 'class', 'elementor-size-' . $settings['button_size'] );
			}
			if ( ! empty( $settings['button_hover_animation'] ) ) {
				$this->add_render_attribute( 'button', 'class', 'elementor-animation-' . $settings['button_hover_animation'] );
			}

			?>
			<div <?php echo wp_kses_post( $this->get_render_attribute_string( 'wrapper' ) ); ?>>
				<a <?php echo wp_kses_post( $this->get_render_attribute_string( 'button' ) ); ?>>
					<?php
						$this->add_render_attribute( 'text', 'class', 'elementor-button-text' );
						$this->add_render_attribute( 'text', 'class', 'elementor-inline-editing' );
					?>
					<?php
					if ( 'left' === $settings['cta_icon_position'] ) {
						$this->render_button_icon( $settings, 'before' );
						?>
					<?php } ?>
					<?php
					if ( ! empty( $settings['cta_text'] ) ) {
						?>
						<span <?php echo wp_kses_post( $this->get_render_attribute_string( 'text' ) ); ?>  data-elementor-setting-key="cta_text" data-elementor-inline-editing-toolbar="none"><?php echo wp_kses_post( $settings['cta_text'] ); ?></span>
					<?php } ?>
					<?php
					if ( 'right' === $settings['cta_icon_position'] ) {
						$this->render_button_icon( $settings, 'after' );
						?>
				<?php } ?>
				</a>
			</div>
			<?php
		}
	}

	/**
	 * Method get_currency_symbol.
	 *
	 * @since 0.0.1
	 * @access public
	 * @param object $symbol_name for currency symbol.
	 */
	private function get_currency_symbol( $symbol_name ) {
		$symbols = array(
			'dollar'       => '&#36;',
			'franc'        => '&#8355;',
			'euro'         => '&#128;',
			'ruble'        => '&#8381;',
			'pound'        => '&#163;',
			'indian_rupee' => '&#8377;',
			'baht'         => '&#3647;',
			'shekel'       => '&#8362;',
			'yen'          => '&#165;',
			'guilder'      => '&fnof;',
			'won'          => '&#8361;',
			'peso'         => '&#8369;',
			'lira'         => '&#8356;',
			'peseta'       => '&#8359',
			'rupee'        => '&#8360;',
			'real'         => 'R$',
			'krona'        => 'kr',
		);
		return isset( $symbols[ $symbol_name ] ) ? $symbols[ $symbol_name ] : '';
	}

	/**
	 * Method render_heading_text
	 *
	 * @since 0.0.1
	 * @access public
	 * @param object $settings for settings.
	 */
	public function render_heading_text( $settings ) {
		if ( $settings['heading'] ) :
			if ( ! empty( $settings['heading'] ) ) :
				?>
				<div class="uael-price-heading-text">
					<<?php echo esc_attr( $settings['heading_tag'] ); ?> class="uael-price-table-heading elementor-inline-editing" data-elementor-setting-key="heading" data-elementor-inline-editing-toolbar="basic"><?php echo wp_kses_post( $settings['heading'] ); ?>
					</<?php echo esc_attr( $settings['heading_tag'] ); ?>>
				</div>
				<?php
			endif;
		endif;
	}

	/**
	 * Method render_subheading_text
	 *
	 * @since 0.0.1
	 * @access public
	 * @param object $settings for settings.
	 */
	public function render_subheading_text( $settings ) {

		if ( ! empty( $settings['sub_heading'] ) || ! empty( $settings['sub_heading_style2'] ) ) :
			?>
			<div class="uael-price-subheading-text">
				<?php if ( '2' === $settings['pricetable_style'] ) { ?>
					<<?php echo esc_attr( $settings['sub_heading_tag_style2'] ); ?> class="uael-price-table-subheading elementor-inline-editing" data-elementor-setting-key="sub_heading_style2" data-elementor-inline-editing-toolbar="basic">
						<?php echo wp_kses_post( $settings['sub_heading_style2'] ); ?>
					</<?php echo esc_attr( $settings['sub_heading_tag_style2'] ); ?>>
				<?php } else { ?>
					<<?php echo esc_attr( $settings['sub_heading_tag'] ); ?> class="uael-price-table-subheading elementor-inline-editing" data-elementor-setting-key="sub_heading" data-elementor-inline-editing-toolbar="basic">
						<?php echo wp_kses_post( $settings['sub_heading'] ); ?>
					</<?php echo esc_attr( $settings['sub_heading_tag'] ); ?>>
				<?php } ?>
			</div>
			<?php
		endif;
	}

	/**
	 * Method render_header
	 *
	 * @since 0.0.1
	 * @access public
	 * @param object $settings for settings.
	 */
	public function render_style_header( $settings ) {

		if ( '2' === $settings['pricetable_style'] ) {
			if ( $settings['heading'] ) :
				?>
				<div class="uael-price-table-header">
					<?php $this->render_heading_text( $settings ); ?>
				</div>
				<?php
			endif;
		} else {
			if ( $settings['heading'] || $settings['sub_heading'] ) :
				?>
				<div class="uael-price-table-header">
					<div class="uael-pricing-heading-wrap">
						<?php $this->render_heading_text( $settings ); ?>
						<?php $this->render_subheading_text( $settings ); ?>
					</div>
				</div>
				<?php
			endif;
		}
	}

	/**
	 * Method render_price
	 *
	 * @since 0.0.1
	 * @access public
	 * @param object $settings for settings.
	 */
	public function render_price( $settings ) {
		$symbols = '';

		if ( ! empty( $settings['currency_symbol'] ) ) {
			if ( 'custom' !== $settings['currency_symbol'] ) {
				$symbol = $this->get_currency_symbol( $settings['currency_symbol'] );
			} else {
				$symbol = $settings['currency_symbol_custom'];
			}
		}

		$currency_format = empty( $settings['currency_format'] ) ? '.' : $settings['currency_format'];
		$price           = explode( $currency_format, $settings['price'] );
		$intvalue        = $price[0];
		$fraction        = '';
		if ( 2 === count( $price ) ) {
			$fraction = $price[1];
		}

		$duration_position = $settings['duration_position'];
		$duration_element  = '<span class="uael-price-table-duration uael-price-typo-excluded elementor-inline-editing" data-elementor-setting-key="duration" data-elementor-inline-editing-toolbar="basic">' . wp_kses_post( $settings['duration'] ) . '</span>';
		?>
		<div class="uael-price-table-price-wrap">
			<div class="uael-price-table-pricing">
				<div class="uael-pricing-container">
					<div class="uael-pricing-value">
						<?php if ( 'yes' === $settings['sale'] && ! empty( $settings['original_price'] ) ) : ?>
							<span class="uael-price-table-original-price uael-price-typo-excluded"><?php echo esc_attr( $symbol ) . wp_kses_post( $settings['original_price'] ); ?></span>
						<?php endif; ?>

						<?php if ( ! empty( $symbol ) && ',' !== $settings['currency_format'] ) : ?>
							<span class="uael-price-table-currency"><?php echo esc_attr( $symbol ); ?></span>
						<?php endif; ?>

						<?php if ( ! empty( $intvalue ) || 0 <= $intvalue ) : ?>
							<?php if ( ! empty( $symbol ) && ',' === $settings['currency_format'] ) : ?>
									<span class="uael-price-currency-normal"><?php echo esc_attr( $symbol ); ?></span>
								<?php endif; ?>
							<span class="uael-price-table-integer-part"><?php echo wp_kses_post( $intvalue ); ?></span>
						<?php endif; ?>

						<?php if ( '' !== $fraction || ( ! empty( $settings['duration'] ) && 'beside' === $duration_position ) ) : ?>
							<span class="uael-price-table-beside-price">
								<span class="uael-price-table-fractional-part"><?php echo wp_kses_post( $fraction ); ?></span>
								<?php if ( ! empty( $settings['duration'] ) && 'beside' === $duration_position && '3' !== $settings['pricetable_style'] ) : ?>
									<?php echo wp_kses_post( $duration_element ); ?>
								<?php endif; ?>
							</span>
						<?php endif; ?>
					</div>
					<?php if ( ! empty( $settings['duration'] ) ) : ?>
						<?php if ( '3' === $settings['pricetable_style'] || 'below' === $settings['duration_position'] ) : ?>
							<div class="uael-pricing-duration">
								<?php echo wp_kses_post( $duration_element ); ?>
							</div>
						<?php endif; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Method render_features
	 *
	 * @since 0.0.1
	 * @access public
	 * @param object $settings for settings.
	 */
	public function render_features( $settings ) {

		if ( ! empty( $settings['features_list'] ) ) :
			?>
			<ul class="uael-price-table-features-list">
				<?php foreach ( $settings['features_list'] as  $index => $item ) : ?>
					<?php
					$title_key = $this->get_repeater_setting_key( 'item_text', 'features_list', $index );
					$this->add_inline_editing_attributes( $title_key, 'basic' );
					?>
					<li class="elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
						<div class="uael-price-table-feature-content">
							<?php
							if ( UAEL_Helper::is_elementor_updated() ) {

								$migration_allowed = \Elementor\Icons_Manager::is_migration_allowed();

								if ( ! isset( $item['item_icon'] ) && ! $migration_allowed ) {
									// add old default.
									$item['item_icon'] = 'fa fa-arrow-circle-right';
								}
								$has_icon = ! empty( $item['item_icon'] );

								if ( ! $has_icon && ! empty( $item['new_item_icon']['value'] ) ) {
									$has_icon = true;
								}

								if ( $has_icon ) :
									$features_marker_migrated = isset( $item['__fa4_migrated']['new_item_icon'] );
									$features_marker_is_new   = ! isset( $item['item_icon'] ) && $migration_allowed;

									if ( $features_marker_migrated || $features_marker_is_new ) {
										\Elementor\Icons_Manager::render_icon( $item['new_item_icon'], array( 'aria-hidden' => 'true' ) );
									} elseif ( ! empty( $item['item_icon'] ) ) {
										?>
											<i class="<?php echo esc_attr( $item['item_icon'] ); ?>" aria-hidden="true"></i>
										<?php } ?>

									<?php endif; ?>
								<?php } elseif ( ! empty( $item['item_icon'] ) ) { ?>
									<i class="<?php echo esc_attr( $item['item_icon'] ); ?>" aria-hidden="true"></i>
								<?php } ?>
							<?php

							if ( ! empty( $item['item_text'] ) ) :
								?>
							<span <?php echo wp_kses_post( $this->get_render_attribute_string( $title_key ) ); ?>><?php echo wp_kses_post( $item['item_text'] ); ?></span>
								<?php
							else :
								echo '&nbsp;';
							endif;
							?>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>
			<?php
		endif;
	}

	/**
	 * Method render_cta
	 *
	 * @since 0.0.1
	 * @access public
	 * @param object $settings for settings.
	 */
	public function render_cta( $settings ) {
		if ( 'none' !== $settings['price_cta_type'] || ! empty( $settings['footer_additional_info'] ) ) :
			if ( ! empty( $settings['cta_text'] ) || ! empty( $settings['footer_additional_info'] ) || ! empty( $settings['cta_icon'] ) || ! empty( $settings['new_cta_icon'] ) ) :
				?>
				<div class="uael-price-table-cta">
					<?php if ( 'none' !== $settings['price_cta_type'] ) : ?>
							<?php $this->render_button( $settings ); ?>
					<?php endif; ?>

					<?php if ( ! empty( $settings['footer_additional_info'] ) ) : ?>
						<div class="uael-price-table-disclaimer elementor-inline-editing" data-elementor-setting-key="footer_additional_info" data-elementor-inline-editing-toolbar="basic"><?php echo wp_kses_post( $settings['footer_additional_info'] ); ?></div>
					<?php endif; ?>
				</div>
				<?php
			endif;
		endif;
	}

	/**
	 * Method render_separator
	 *
	 * @since 0.0.1
	 * @access public
	 * @param object $settings for settings.
	 */
	public function render_separator( $settings ) {
		if ( ! empty( $settings['features_list'] ) ) :
			if ( 'yes' === $settings['pricetable_separator'] && '2' === $settings['pricetable_style'] ) :
				?>
				<div class="uael-separator-parent">
					<div class="uael-separator"></div>
				</div>
			<?php endif; ?>
			<?php
		endif;
	}

	/**
	 * Method render_ribbon
	 *
	 * @since 0.0.1
	 * @access public
	 * @param object $settings for settings.
	 */
	public function render_ribbon( $settings ) {
		$ribbon_style = '';

		if ( ! empty( $settings['ribbon_title'] ) ) :
			if ( 'none' !== $settings['show_ribbon'] ) :
				if ( '1' === $settings['show_ribbon'] ) {
					$ribbon_style = '1';
				} elseif ( '2' === $settings['show_ribbon'] ) {
					$ribbon_style = '2';
				} elseif ( '3' === $settings['show_ribbon'] ) {
					$ribbon_style = '3';
				}

				$this->add_render_attribute( 'ribbon-wrapper', 'class', 'uael-price-table-ribbon-' . $ribbon_style );

				if ( ! empty( $settings['ribbon_horizontal_position'] ) ) :
					$this->add_render_attribute( 'ribbon-wrapper', 'class', 'uael-ribbon-' . $settings['ribbon_horizontal_position'] );
				endif;

				?>
				<div <?php echo wp_kses_post( $this->get_render_attribute_string( 'ribbon-wrapper' ) ); ?>>
					<div class="uael-price-table-ribbon-content elementor-inline-editing" data-elementor-setting-key="ribbon_title" data-elementor-inline-editing-toolbar="none"><?php echo wp_kses_post( $settings['ribbon_title'] ); ?></div>
				</div>
				<?php
			endif;
		endif;
	}

	/**
	 * Render Price Table output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		ob_start();
		include 'template.php';
		$html = ob_get_clean();
		echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Render Price Table widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.22.1
	 * @access protected
	 */
	protected function content_template() {
		?>
		<#
		function render_heading_text() {
			if ( settings.heading ) {
				if ( '' != settings.heading ) {
					#>
					<div class="uael-price-heading-text">
						<{{ settings.heading_tag }} class="uael-price-table-heading elementor-inline-editing" data-elementor-setting-key="heading" data-elementor-inline-editing-toolbar="basic"> {{{ settings.heading }}}
						</{{ settings.heading_tag }}>
					</div>
					<#
				}
			}
		}
		function render_subheading_text() {
			if ( settings.sub_heading ) {
				if ( '' != settings.sub_heading || '' != settings.sub_heading_style2 ) {
				#>
					<div class="uael-price-subheading-text">

						<# if ( '2' == settings.pricetable_style ) { #>
							<{{ settings.sub_heading_tag_style2 }} class="uael-price-table-subheading elementor-inline-editing" data-elementor-setting-key="sub_heading_style2" data-elementor-inline-editing-toolbar="basic">
								{{{ settings.sub_heading_style2 }}}
							</{{ settings.sub_heading_tag_style2 }}>
						<# } else { #>
							<{{ settings.sub_heading_tag }} class="uael-price-table-subheading elementor-inline-editing" data-elementor-setting-key="sub_heading" data-elementor-inline-editing-toolbar="basic">
								{{{ settings.sub_heading }}}
							</{{ settings.sub_heading_tag }}>
						<# } #>
					</div>
				<#
				}
			}
		}

		function render_style_header() {

			if ( '2' == settings.pricetable_style ) {
				if ( settings.heading ) {
					#>
					<div class="uael-price-table-header">
						<{{{ settings.heading_tag }}} class="uael-price-table-heading elementor-inline-editing" data-elementor-setting-key="heading" data-elementor-inline-editing-toolbar="basic">{{{ settings.heading }}}</{{{ settings.heading_tag }}}>
					</div>
					<#
				}
			} else {
				if ( settings.heading || settings.sub_heading ) {
					#>
					<div class="uael-price-table-header">
						<div class="uael-pricing-heading-wrap">
							<# render_heading_text(); #>
							<# render_subheading_text(); #>
						</div>
					</div>
					<#
				}
			}
		}

		function render_price() {
			var symbol = '';

			var symbols = {
				dollar: '&#36;',
				euro: '&#128;',
				franc: '&#8355;',
				pound: '&#163;',
				ruble: '&#8381;',
				shekel: '&#8362;',
				baht: '&#3647;',
				yen: '&#165;',
				won: '&#8361;',
				guilder: '&fnof;',
				peso: '&#8369;',
				peseta: '&#8359;',
				lira: '&#8356;',
				rupee: '&#8360;',
				indian_rupee: '&#8377;',
				real: 'R$',
				krona: 'kr'
			};

			if ( settings.currency_symbol ) {
				if ( 'custom' !== settings.currency_symbol ) {
					symbol = symbols[ settings.currency_symbol ] || '';
				} else {
					symbol = settings.currency_symbol_custom;
				}
			}

			var currencyFormat = settings.currency_format || '.',
				table_price = settings.price.toString(),
				price = table_price.split( currencyFormat ),
				intvalue = price[0],
				fraction = price[1];

			var	durationText = '<span class="uael-price-table-duration uael-price-typo-excluded elementor-inline-editing" data-elementor-setting-key="duration" data-elementor-inline-editing-toolbar="basic">' + settings.duration + '</span>';
			#>
			<div class="uael-price-table-price-wrap">
				<div class="uael-price-table-pricing">
					<div class="uael-pricing-container">
						<div class="uael-pricing-value">
							<# if ( settings.sale && settings.original_price ) { #>
								<div class="uael-price-table-original-price uael-price-typo-excluded">{{{ symbol + settings.original_price }}}</div>
							<# } #>

							<# if ( '' != symbol && ',' != settings.currency_format) { #>
								<span class="uael-price-table-currency">{{{ symbol }}}</span>
							<# } #>

							<# if ( '' != intvalue ) { #>
								<# if ( '' != symbol && ',' == settings.currency_format) { #>
									<span class="uael-price-currency-normal">{{{ symbol }}}</span>
								<# } #>
								<span class="uael-price-table-integer-part">{{{ intvalue }}}</span>
							<# } #>

							<span class="uael-price-table-beside-price">
								<# if ( '' != fraction ) { #>
									<span class="uael-price-table-fractional-part">{{{ fraction }}}</span>
								<# } #>
								<# if ( settings.duration && 'beside' === settings.duration_position && '3' != settings.pricetable_style ) { #>
									{{{ durationText }}}
								<# } #>
							</span>
						</div>
						<# if ( settings.duration ) { #>
							<# if ( '3' === settings.pricetable_style || 'below' === settings.duration_position ) { #>
								<div class="uael-pricing-duration">
									{{{ durationText }}}
								</div>
							<# } #>
						<# } #>
					</div>
				</div>
			</div>
			<#
		}

		function render_features() {
			var iconsHTML = {};
			if ( settings.features_list ) { #>
				<ul class="uael-price-table-features-list">
					<# _.each( settings.features_list, function( item, index ) { #>
						<li class="elementor-repeater-item-{{ item._id }}">
							<div class="uael-price-table-feature-content">
								<?php if ( UAEL_Helper::is_elementor_updated() ) { ?>
									<# if ( item.item_icon || item.new_item_icon ) { #>
										<# 
										iconsHTML[ index ] = elementor.helpers.renderIcon( view, item.new_item_icon, { 'aria-hidden': true }, 'i' , 'object' );
										migrated = elementor.helpers.isIconMigrated( item, 'new_item_icon' ); #>

										<# if ( ( ! item.item_icon || migrated ) && iconsHTML[ index ] && iconsHTML[ index ].rendered ) { #>
											{{{ iconsHTML[ index ].value }}}
										<# } else if( '' !== item.item_icon ) { #>
											<i class="{{ item.item_icon }}" aria-hidden="true"></i>
										<# } #>
									<# } #>
								<?php } else { ?>
									<i class="{{ item.item_icon }}" aria-hidden="true"></i>
								<?php } ?>

								<# if ( ! _.isEmpty( item.item_text.trim() ) ) { #>
									<span>{{{ item.item_text }}}</span>
								<# } else { #>
									&nbsp;
								<# } #>
							</div>
						</li>
					<# } ); #>
				</ul>
			<# }
		}

		function render_cta_icon( position ) {
			view.addRenderAttribute( 'button_icon', 'class', 'uael-cta-link-icon uael-cta-link-icon-' + position ); #>
			<?php if ( UAEL_Helper::is_elementor_updated() ) { ?>
				<# if ( settings.cta_icon || settings.new_cta_icon ) {  #>	
				<# 
				var cta_iconHTML = elementor.helpers.renderIcon( view, settings.new_cta_icon, { 'aria-hidden': true }, 'i' , 'object' );
				var cta_migrated = elementor.helpers.isIconMigrated( settings, 'new_cta_icon' ); 
				#>
					<span {{{ view.getRenderAttributeString( 'button_icon' ) }}}>
						<# if ( cta_iconHTML && cta_iconHTML.rendered && ( ! settings.cta_icon || cta_migrated ) ) {
						#>
							{{{ cta_iconHTML.value }}}
						<# } else { #>
							<i class="{{ settings.cta_icon }}" aria-hidden="true"></i>
						<# } #>
					</span>
				<# } #>
			<?php } else { ?>
				<span {{{ view.getRenderAttributeString( 'button_icon' ) }}}>
					<i class="{{ settings.cta_icon }}" aria-hidden="true"></i>
				</span>
			<?php } ?>
		<# }

		function render_cta() {
			if ( 'none' != settings.price_cta_type || '' != settings.footer_additional_info ) {
				if ( settings.cta_text || settings.cta_icon || settings.new_cta_icon || settings.footer_additional_info ) { #>
					<div class="uael-price-table-cta">
						<#
						if( 'none' != settings.price_cta_type ) {
							if( 'link' == settings.price_cta_type ) {
								if ( '' != settings.link.url ) {
									view.addRenderAttribute( 'cta_link', 'href', settings.link.url );
									view.addRenderAttribute( 'cta_link', 'class', 'uael-pricebox-cta-link' );
								}

								#>
								<a {{{ view.getRenderAttributeString( 'cta_link' ) }}}>
									<#
									if ( 'left' == settings.cta_icon_position ) {
									#>	
										<# render_cta_icon( 'before' ); #>
									<# } #>
									<#
									if ( '' != settings.cta_text ) {
									#>
										<span class="elementor-inline-editing" data-elementor-setting-key="cta_text" data-elementor-inline-editing-toolbar="basic">{{ settings.cta_text }}</span>
									<# } #>
									<#
									if ( 'right' == settings.cta_icon_position ) {
									#>
										<# render_cta_icon( 'after' ); #>
									<# } #>
								</a>
								<#
							}

							if( 'button' == settings.price_cta_type ) {
								view.addRenderAttribute( 'wrapper', 'class', 'uael-button-wrapper elementor-button-wrapper' );

								if ( '' != settings.link.url ) {
									view.addRenderAttribute( 'button', 'href', settings.link.url );
									view.addRenderAttribute( 'button', 'class', 'elementor-button-link' );
								}

								view.addRenderAttribute( 'button', 'class', 'elementor-button' );

								if ( '' != settings.button_size ) {
									view.addRenderAttribute( 'button', 'class', 'elementor-size-' + settings.button_size );
								}

								if ( settings.button_hover_animation ) {
									view.addRenderAttribute( 'button', 'class', 'elementor-animation-' + settings.button_hover_animation );
								}

								#>
								<div {{{ view.getRenderAttributeString( 'wrapper' ) }}}>
									<a {{{ view.getRenderAttributeString( 'button' ) }}}>
										<#
										view.addRenderAttribute( 'text', 'class', 'elementor-button-text' );

										view.addRenderAttribute( 'text', 'class', 'elementor-inline-editing' );
										#>
										<#
										if ( 'left' == settings.cta_icon_position ) {
										#>
											<# render_cta_icon( 'before' ); #>
										<# } #>
										<#
											if ( '' != settings.cta_text ) {
										#>
										<span {{{ view.getRenderAttributeString( 'text' ) }}} data-elementor-setting-key="cta_text" data-elementor-inline-editing-toolbar="none">{{{ settings.cta_text }}}</span>
										<# } #>
										<#
										if ( 'right' == settings.cta_icon_position ) {
										#>
											<# render_cta_icon( 'after' ); #>
										<# } #>
									</a>
								</div>
							<# } #>
						<# } #>
						<# if ( settings.footer_additional_info ) { #>
							<div class="uael-price-table-disclaimer elementor-inline-editing" data-elementor-setting-key="footer_additional_info" data-elementor-inline-editing-toolbar="basic">{{{ settings.footer_additional_info }}}</div>
						<# } #>
					</div>
				<# }
			}
		}

		function render_separator() {
			if ( settings.features_list ) {
				if ( 'yes' == settings.pricetable_separator && '2' == settings.pricetable_style ) {
				#>
					<div class="uael-separator-parent">
						<div class="uael-separator"></div>
					</div>
				<# }
			}
		}

		function render_ribbon() {
		var ribbon_style = '';
		if ( '' != settings.ribbon_title ) {
			if ( 'none' != settings.show_ribbon ) {

				if ( '1' == settings.show_ribbon ) {
					ribbon_style = '1';
				} else if ( '2' == settings.show_ribbon ) {
					ribbon_style = '2';
				} else if ( '3' == settings.show_ribbon ) {
					ribbon_style = '3';
				}
				var ribbonClass = '';

				if ( settings.ribbon_horizontal_position ) {
					ribbonClass = 'uael-ribbon-' + settings.ribbon_horizontal_position;
				} #>
				<div class="uael-price-table-ribbon-{{ ribbon_style }} {{ ribbonClass }}">
					<div class="uael-price-table-ribbon-content elementor-inline-editing" data-elementor-setting-key="ribbon_title" data-elementor-inline-editing-toolbar="none">{{{ settings.ribbon_title }}}</div>
				</div>
			<# }
			}
		}
		#>

		<#
		if ( '1' == settings.pricetable_style ) { #>
			<div class="uael-module-content uael-price-table-container uael-pricing-style-{{ settings.pricetable_style }}">
				<div class="uael-price-table">
					<# render_style_header(); #>
					<# render_price(); #>
					<# render_features(); #>
					<# render_cta(); #>
				</div>
				<# render_ribbon(); #>
			</div>
		<# } else if ( '2' == settings.pricetable_style ) { #>
			<div class="uael-module-content uael-price-table-container uael-pricing-style-{{ settings.pricetable_style }}">
				<div class="uael-price-table">
					<# render_style_header(); #>
					<# render_price(); #>
					<# render_subheading_text(); #>
					<# render_cta(); #>
					<# render_separator(); #>
					<# render_features(); #>
				</div>
				<# render_ribbon(); #>
			</div>
		<# } else if ( '3' == settings.pricetable_style ) { #>
			<div class="uael-module-content uael-price-table-container uael-pricing-style-{{ settings.pricetable_style }}">
				<div class="uael-price-table">
					<# render_style_header(); #>
					<# render_price(); #>
					<# render_features(); #>
					<# render_cta(); #>
				</div>
				<# render_ribbon(); #>
			</div>
		<# }

		#>
		<?php
	}

	/**
	 * Render Price Table widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * Remove this after Elementor v3.3.0
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function _content_template() { // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore 
		$this->content_template();
	}
}

