<?php
/**
 * UAEL Advanced Heading.
 *
 * @package UAEL
 */

namespace UltimateElementor\Modules\Headings\Widgets;

// Elementor Classes.
use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Utils;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Background;

// UltimateElementor Classes.
use UltimateElementor\Base\Common_Widget;
use UltimateElementor\Classes\UAEL_Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

/**
 * Class Advanced_Heading.
 */
class Advanced_Heading extends Common_Widget {

	/**
	 * Retrieve Advanced Heading Widget name.
	 *
	 * @since 0.0.1
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return parent::get_widget_slug( 'Advanced_Heading' );
	}

	/**
	 * Retrieve Advanced Heading Widget title.
	 *
	 * @since 0.0.1
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return parent::get_widget_title( 'Advanced_Heading' );
	}

	/**
	 * Retrieve Advanced Heading Widget icon.
	 *
	 * @since 0.0.1
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return parent::get_widget_icon( 'Advanced_Heading' );
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
		return parent::get_widget_keywords( 'Advanced_Heading' );
	}

	/**
	 * Register Advanced Heading controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function _register_controls() { // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore 

		$this->register_general_content_controls();
		$this->register_separator_content_controls();
		$this->register_style_content_controls();
		$this->register_heading_typo_content_controls();
		$this->register_sub_typo_content_controls();
		$this->register_desc_typo_content_controls();
		$this->register_imgicon_content_controls();
		$this->register_helpful_information();
	}

	/**
	 * Register Advanced Heading General Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_general_content_controls() {

		$this->start_controls_section(
			'section_general_fields',
			array(
				'label' => __( 'General', 'uael' ),
			)
		);
		$this->add_control(
			'heading_title',
			array(
				'label'   => __( 'Heading', 'uael' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => '2',
				'dynamic' => array(
					'active' => true,
				),
				'default' => __( 'Design is a funny word', 'uael' ),
			)
		);
		$this->add_control(
			'sub_heading',
			array(
				'label'   => __( 'Sub Heading', 'uael' ),
				'type'    => Controls_Manager::TEXTAREA,
				'rows'    => '1',
				'dynamic' => array(
					'active' => true,
				),
			)
		);
		$this->add_control(
			'heading_link',
			array(
				'label'       => __( 'Link', 'uael' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'uael' ),
				'dynamic'     => array(
					'active' => true,
				),
				'default'     => array(
					'url' => '',
				),
			)
		);
		$this->add_control(
			'heading_description',
			array(
				'label'   => __( 'Description', 'uael' ),
				'type'    => Controls_Manager::TEXTAREA,
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'size',
			array(
				'label'   => __( 'Size', 'uael' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => array(
					'default' => __( 'Default', 'uael' ),
					'small'   => __( 'Small', 'uael' ),
					'medium'  => __( 'Medium', 'uael' ),
					'large'   => __( 'Large', 'uael' ),
					'xl'      => __( 'XL', 'uael' ),
					'xxl'     => __( 'XXL', 'uael' ),
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register Advanced Heading Separator Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_separator_content_controls() {
		$this->start_controls_section(
			'section_separator_field',
			array(
				'label' => __( 'Separator', 'uael' ),
			)
		);
		$this->add_control(
			'heading_separator_style',
			array(
				'label'       => __( 'Style', 'uael' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'none',
				'label_block' => false,
				'options'     => array(
					'none'       => __( 'None', 'uael' ),
					'line'       => __( 'Line', 'uael' ),
					'line_icon'  => __( 'Line With Icon', 'uael' ),
					'line_image' => __( 'Line With Image', 'uael' ),
					'line_text'  => __( 'Line With Text', 'uael' ),
				),
			)
		);
		$this->add_control(
			'heading_separator_position',
			array(
				'label'       => __( 'Separator Position', 'uael' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'center',
				'label_block' => false,
				'options'     => array(
					'center' => __( 'Between Heading & Description', 'uael' ),
					'top'    => __( 'Top', 'uael' ),
					'bottom' => __( 'Bottom', 'uael' ),
				),
				'condition'   => array(
					'heading_separator_style!' => 'none',
				),
			)
		);

		if ( UAEL_Helper::is_elementor_updated() ) {
			/* Separator line with Icon */
			$this->add_control(
				'new_heading_icon',
				array(
					'label'            => __( 'Select Icon', 'uael' ),
					'type'             => Controls_Manager::ICONS,
					'fa4compatibility' => 'heading_icon',
					'default'          => array(
						'value'   => 'fa fa-star',
						'library' => 'fa-solid',
					),
					'condition'        => array(
						'heading_separator_style' => 'line_icon',
					),
					'render_type'      => 'template',
				)
			);
		} else {
			$this->add_control(
				'heading_icon',
				array(
					'label'     => __( 'Select Icon', 'uael' ),
					'type'      => Controls_Manager::ICON,
					'default'   => 'fa fa-star',
					'condition' => array(
						'heading_separator_style' => 'line_icon',
					),
				)
			);
		}

		/* Separator line with Image */
		$this->add_control(
			'heading_image_type',
			array(
				'label'       => __( 'Photo Source', 'uael' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'media',
				'label_block' => false,
				'options'     => array(
					'media' => __( 'Media Library', 'uael' ),
					'url'   => __( 'URL', 'uael' ),
				),
				'condition'   => array(
					'heading_separator_style' => 'line_image',
				),
			)
		);
		$this->add_control(
			'heading_image',
			array(
				'label'     => __( 'Photo', 'uael' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'heading_separator_style' => 'line_image',
					'heading_image_type'      => 'media',
				),
			)
		);
		$this->add_control(
			'heading_image_link',
			array(
				'label'         => __( 'Photo URL', 'uael' ),
				'type'          => Controls_Manager::URL,
				'default'       => array(
					'url' => '',
				),
				'show_external' => false, // Show the 'open in new tab' button.
				'condition'     => array(
					'heading_separator_style' => 'line_image',
					'heading_image_type'      => 'url',
				),
			)
		);

		/* Separator line with text */
		$this->add_control(
			'heading_line_text',
			array(
				'label'     => __( 'Enter Text', 'uael' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Ultimate', 'uael' ),
				'condition' => array(
					'heading_separator_style' => 'line_text',
				),
				'dynamic'   => array(
					'active' => true,
				),
				'selector'  => '{{WRAPPER}} .uael-divider-text',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register Advanced Heading Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_style_content_controls() {
		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'General', 'uael' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'heading_text_align',
			array(
				'label'        => __( 'Overall Alignment', 'uael' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => array(
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
				'selectors'    => array(
					'{{WRAPPER}} .uael-heading,{{WRAPPER}} .uael-sub-heading, {{WRAPPER}} .uael-sub-heading *,{{WRAPPER}} .uael-subheading, {{WRAPPER}} .uael-subheading *, {{WRAPPER}} .uael-separator-parent' => 'text-align: {{VALUE}};',
				),
				'prefix_class' => 'uael%s-heading-align-',
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register Advanced Heading Typography Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_heading_typo_content_controls() {
		$this->start_controls_section(
			'section_heading_typography',
			array(
				'label' => __( 'Heading', 'uael' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'heading_tag',
			array(
				'label'   => __( 'HTML Tag', 'uael' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'h1' => __( 'H1', 'uael' ),
					'h2' => __( 'H2', 'uael' ),
					'h3' => __( 'H3', 'uael' ),
					'h4' => __( 'H4', 'uael' ),
					'h5' => __( 'H5', 'uael' ),
					'h6' => __( 'H6', 'uael' ),
				),
				'default' => 'h2',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'heading_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .uael-heading, {{WRAPPER}} .uael-heading a',
			)
		);
		$this->add_control(
			'heading_color_type',
			array(
				'label'        => __( 'Fill', 'uael' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => array(
					'color'    => __( 'Color', 'uael' ),
					'gradient' => __( 'Background', 'uael' ),
				),
				'default'      => 'color',
				'prefix_class' => 'uael-heading-fill-',
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
					'{{WRAPPER}} .uael-heading-text' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'heading_color_type' => 'color',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'           => 'heading_color_gradient',
				'types'          => array( 'gradient', 'classic' ),
				'selector'       => '{{WRAPPER}} .uael-heading-text',
				'fields_options' => array(
					'background' => array(
						'scheme' => array(
							'type'  => Scheme_Color::get_type(),
							'value' => Scheme_Color::COLOR_1,
						),
					),
				),
				'condition'      => array(
					'heading_color_type' => 'gradient',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'heading_shadow',
				'selector' => '{{WRAPPER}} .uael-heading-text',
			)
		);
		$this->add_responsive_control(
			'heading_margin',
			array(
				'label'      => __( 'Heading Margin', 'uael' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'default'    => array(
					'top'      => '0',
					'bottom'   => '15',
					'left'     => '0',
					'right'    => '0',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .uael-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'blend_mode',
			array(
				'label'     => __( 'Blend Mode', 'uael' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					''            => __( 'Normal', 'uael' ),
					'multiply'    => 'Multiply',
					'screen'      => 'Screen',
					'overlay'     => 'Overlay',
					'darken'      => 'Darken',
					'lighten'     => 'Lighten',
					'color-dodge' => 'Color Dodge',
					'saturation'  => 'Saturation',
					'color'       => 'Color',
					'difference'  => 'Difference',
					'exclusion'   => 'Exclusion',
					'hue'         => 'Hue',
					'luminosity'  => 'Luminosity',
				),
				'selectors' => array(
					'{{WRAPPER}} .uael-heading-text' => 'mix-blend-mode: {{VALUE}}',
				),
				'separator' => 'none',
			)
		);
		$this->end_controls_section();
	}

	/**
	 * Register Advanced Heading sub heading Typography Controls.
	 *
	 * @since 1.19.0
	 * @access protected
	 */
	protected function register_sub_typo_content_controls() {

		$this->start_controls_section(
			'section_sub_typography',
			array(
				'label'     => __( 'Sub Heading', 'uael' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'sub_heading!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'heading_sub_typography',
				'scheme'    => Scheme_Typography::TYPOGRAPHY_2,
				'selector'  => '{{WRAPPER}} .uael-sub-heading',
				'condition' => array(
					'sub_heading!' => '',
				),
			)
		);
		$this->add_control(
			'heading_sub_color',
			array(
				'label'     => __( 'Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				),
				'default'   => '',
				'condition' => array(
					'sub_heading!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .uael-sub-heading' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'heading_sub_margin',
			array(
				'label'      => __( 'Sub Heading Margin', 'uael' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'default'    => array(
					'top'      => '15',
					'bottom'   => '0',
					'left'     => '0',
					'right'    => '0',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'condition'  => array(
					'sub_heading!' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .uael-sub-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();
	}

	/**
	 * Register Advanced Heading description Typography Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_desc_typo_content_controls() {

		$this->start_controls_section(
			'section_desc_typography',
			array(
				'label'     => __( 'Description', 'uael' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'heading_description!' => '',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'heading_desc_typography',
				'scheme'    => Scheme_Typography::TYPOGRAPHY_3,
				'selector'  => '{{WRAPPER}} .uael-subheading',
				'condition' => array(
					'heading_description!' => '',
				),
			)
		);
		$this->add_control(
			'heading_desc_color',
			array(
				'label'     => __( 'Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_3,
				),
				'default'   => '',
				'condition' => array(
					'heading_description!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .uael-subheading' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'heading_desc_margin',
			array(
				'label'      => __( 'Description Margin', 'uael' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'default'    => array(
					'top'      => '15',
					'bottom'   => '0',
					'left'     => '0',
					'right'    => '0',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'condition'  => array(
					'heading_description!' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .uael-subheading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),

			)
		);
		$this->end_controls_section();
	}


	/**
	 * Register Advanced Heading Image/Icon Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_imgicon_content_controls() {

		$this->start_controls_section(
			'section_separator_line_style',
			array(
				'label'     => __( 'Separator - Line', 'uael' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'heading_separator_style!' => 'none',
				),
			)
		);

		$this->add_control(
			'heading_line_style',
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
					'heading_separator_style!' => 'none',
				),
				'selectors'   => array(
					'{{WRAPPER}} .uael-separator, {{WRAPPER}} .uael-separator-line > span' => 'border-top-style: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'heading_line_color',
			array(
				'label'     => __( 'Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				),
				'condition' => array(
					'heading_separator_style!' => 'none',
				),
				'selectors' => array(
					'{{WRAPPER}} .uael-separator, {{WRAPPER}} .uael-separator-line > span, {{WRAPPER}} .uael-divider-text' => 'border-top-color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'heading_line_thickness',
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
					'heading_separator_style!' => 'none',
				),
				'selectors'  => array(
					'{{WRAPPER}} .uael-separator, {{WRAPPER}} .uael-separator-line > span ' => 'border-top-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'heading_line_width',
			array(
				'label'          => __( 'Width', 'uael' ),
				'type'           => Controls_Manager::SLIDER,
				'size_units'     => array( '%', 'px' ),
				'range'          => array(
					'px' => array(
						'max' => 1000,
					),
				),
				'default'        => array(
					'size' => 20,
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
					'heading_separator_style!' => 'none',
				),
				'selectors'      => array(
					'{{WRAPPER}} .uael-separator, {{WRAPPER}} .uael-separator-wrap' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_imgicon_style',
			array(
				'label'     => __( 'Separator - Icon / Image / Text', 'uael' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'heading_separator_style' => array( 'line_icon', 'line_image', 'line_text' ),
				),
			)
		);

			$this->add_control(
				'heading_line_text_color',
				array(
					'label'     => __( 'Text Color', 'uael' ),
					'type'      => Controls_Manager::COLOR,
					'scheme'    => array(
						'type'  => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_3,
					),
					'condition' => array(
						'heading_separator_style' => 'line_text',
					),
					'selectors' => array(
						'{{WRAPPER}} .uael-divider-text' => 'color: {{VALUE}};',
					),
				)
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				array(
					'name'      => 'heading_separator_typography',
					'scheme'    => Scheme_Typography::TYPOGRAPHY_2,
					'condition' => array(
						'heading_separator_style' => 'line_text',
					),
					'selector'  => '{{WRAPPER}} .uael-divider-text',
				)
			);

		$this->add_responsive_control(
			'heading_icon_size',
			array(
				'label'      => __( 'Icon Size', 'uael' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'default'    => array(
					'size' => 30,
					'unit' => 'px',
				),
				'condition'  => array(
					'heading_separator_style' => 'line_icon',
				),
				'selectors'  => array(
					'{{WRAPPER}} .uael-icon-wrap .uael-icon i' => 'font-size: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}}; text-align: center;',
					'{{WRAPPER}} .uael-icon-wrap .uael-icon, {{WRAPPER}} .uael-icon-wrap .uael-icon svg' => ' height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'heading_image_size',
			array(
				'label'      => __( 'Image Size', 'uael' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', 'em', 'rem' ),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 500,
					),
				),
				'default'    => array(
					'size' => 50,
					'unit' => 'px',
				),
				'condition'  => array(
					'heading_separator_style' => 'line_image',
				),
				'selectors'  => array(
					'{{WRAPPER}} .uael-image .uael-photo-img'   => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'heading_icon_position',
			array(
				'label'          => __( 'Position', 'uael' ),
				'type'           => Controls_Manager::SLIDER,
				'size_units'     => array( '%' ),
				'range'          => array(
					'%' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'        => array(
					'size' => 50,
					'unit' => '%',
				),
				'tablet_default' => array(
					'unit' => '%',
				),
				'mobile_default' => array(
					'unit' => '%',
				),
				'condition'      => array(
					'heading_separator_style' => array( 'line_icon', 'line_image', 'line_text' ),
				),
				'selectors'      => array(
					'{{WRAPPER}} .uael-side-left'  => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .uael-side-right' => 'width: calc( 100% - {{SIZE}}{{UNIT}} );',
				),
			)
		);

		$this->add_responsive_control(
			'heading_icon_padding',
			array(
				'label'      => __( 'Padding', 'uael' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'default'    => array(
					'top'      => '0',
					'bottom'   => '0',
					'left'     => '10',
					'right'    => '10',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'condition'  => array(
					'heading_separator_style' => array( 'line_icon', 'line_image', 'line_text' ),
				),
				'selectors'  => array(
					'{{WRAPPER}} .uael-divider-content' => 'Padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),

			)
		);

		$this->add_control(
			'heading_icon_fields',
			array(
				'label'     => __( 'Style', 'uael' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'heading_separator_style!' => array( 'none', 'line_text' ),
				),
			)
		);

		$this->add_control(
			'heading_imgicon_style_options',
			array(
				'label'       => __( 'Select Style', 'uael' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'simple',
				'label_block' => false,
				'options'     => array(
					'simple' => __( 'Simple', 'uael' ),
					'custom' => __( 'Design your own', 'uael' ),
				),
				'condition'   => array(
					'heading_separator_style!' => array( 'none', 'line_text' ),
				),
			)
		);
		$this->add_control(
			'headings_icon_color',
			array(
				'label'     => __( 'Icon Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'condition' => array(
					'heading_imgicon_style_options' => 'simple',
					'heading_separator_style'       => 'line_icon',
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .uael-icon-wrap .uael-icon i'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .uael-icon-wrap .uael-icon svg'  => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'headings_icon_hover_color',
			array(
				'label'     => __( 'Icon Hover Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'heading_imgicon_style_options' => 'simple',
					'heading_separator_style'       => 'line_icon',
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .uael-icon-wrap .uael-icon:hover i'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .uael-icon-wrap .uael-icon:hover svg'  => 'fill: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'headings_icon_animation',
			array(
				'label'     => __( 'Hover Animation', 'uael' ),
				'type'      => Controls_Manager::HOVER_ANIMATION,
				'condition' => array(
					'heading_imgicon_style_options' => 'simple',
					'heading_separator_style!'      => array( 'none', 'line_text' ),
				),
			)
		);

		$this->start_controls_tabs( 'heading_imgicon_style' );

			$this->start_controls_tab(
				'heading_imgicon_normal',
				array(
					'label'     => __( 'Normal', 'uael' ),
					'condition' => array(
						'heading_imgicon_style_options' => 'custom',
						'heading_separator_style!'      => array( 'none', 'line_text' ),
					),
				)
			);

			$this->add_control(
				'heading_icon_color',
				array(
					'label'     => __( 'Icon Color', 'uael' ),
					'type'      => Controls_Manager::COLOR,
					'scheme'    => array(
						'type'  => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_1,
					),
					'condition' => array(
						'heading_imgicon_style_options' => 'custom',
						'heading_separator_style'       => 'line_icon',
					),
					'default'   => '',
					'selectors' => array(
						'{{WRAPPER}} .uael-icon-wrap .uael-icon i'  => 'color: {{VALUE}};',
						'{{WRAPPER}} .uael-icon-wrap .uael-icon svg'  => 'fill: {{VALUE}};',
					),
				)
			);
			$this->add_control(
				'heading_icon_bgcolor',
				array(
					'label'     => __( 'Background Color', 'uael' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'condition' => array(
						'heading_imgicon_style_options' => 'custom',
						'heading_separator_style!'      => array( 'none', 'line_text' ),
					),
					'selectors' => array(
						'{{WRAPPER}} .uael-icon-wrap .uael-icon, {{WRAPPER}} .uael-image .uael-image-content' => 'background-color: {{VALUE}};',
					),
				)
			);
			$this->add_responsive_control(
				'heading_icon_bg_size',
				array(
					'label'      => __( 'Background Size', 'uael' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => array( 'px' ),
					'range'      => array(
						'px' => array(
							'min' => 0,
							'max' => 100,
						),
					),
					'default'    => array(
						'size' => '0',
						'unit' => 'px',
					),
					'condition'  => array(
						'heading_imgicon_style_options' => 'custom',
						'heading_separator_style!'      => array( 'none', 'line_text' ),
					),
					'selectors'  => array(
						'{{WRAPPER}} .uael-icon-wrap .uael-icon, {{WRAPPER}} .uael-image .uael-image-content' => 'padding: {{SIZE}}{{UNIT}}; display:inline-block; box-sizing:content-box;',
					),
				)
			);

			$this->add_control(
				'heading_icon_border',
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
						'heading_imgicon_style_options' => 'custom',
						'heading_separator_style!'      => array( 'none', 'line_text' ),
					),
					'selectors'   => array(
						'{{WRAPPER}} .uael-icon-wrap .uael-icon, {{WRAPPER}} .uael-image .uael-image-content' => 'border-style: {{VALUE}};',
					),
				)
			);
			$this->add_control(
				'heading_icon_border_color',
				array(
					'label'     => __( 'Border Color', 'uael' ),
					'type'      => Controls_Manager::COLOR,
					'scheme'    => array(
						'type'  => Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_1,
					),
					'condition' => array(
						'heading_imgicon_style_options' => 'custom',
						'heading_separator_style!'      => array( 'none', 'line_text' ),
						'heading_icon_border!'          => 'none',
					),
					'default'   => '',
					'selectors' => array(
						'{{WRAPPER}} .uael-icon-wrap .uael-icon, {{WRAPPER}} .uael-image .uael-image-content' => 'border-color: {{VALUE}};',
					),
				)
			);
			$this->add_control(
				'heading_icon_border_size',
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
						'heading_imgicon_style_options' => 'custom',
						'heading_separator_style!'      => array( 'none', 'line_text' ),
						'heading_icon_border!'          => 'none',
					),
					'selectors'  => array(
						'{{WRAPPER}} .uael-icon-wrap .uael-icon, {{WRAPPER}} .uael-image .uael-image-content' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; box-sizing:content-box;',
					),
				)
			);
			$this->add_control(
				'heading_icon_border_radius',
				array(
					'label'      => __( 'Rounded Corners', 'uael' ),
					'type'       => Controls_Manager::SLIDER,
					'size_units' => array( 'px' ),
					'range'      => array(
						'px' => array(
							'min' => 0,
							'max' => 1000,
						),
					),
					'default'    => array(
						'size' => 20,
						'unit' => 'px',
					),
					'selectors'  => array(
						'{{WRAPPER}} .uael-icon-wrap .uael-icon, {{WRAPPER}} .uael-image .uael-image-content'   => 'border-radius: {{SIZE}}{{UNIT}};',
					),
					'condition'  => array(
						'heading_imgicon_style_options' => 'custom',
						'heading_separator_style!'      => array( 'none', 'line_text' ),
					),
				)
			);
			$this->end_controls_tab();

			$this->start_controls_tab(
				'heading_imgicon_hover',
				array(
					'label'     => __( 'Hover', 'uael' ),
					'condition' => array(
						'heading_imgicon_style_options' => 'custom',
						'heading_separator_style!'      => array( 'none', 'line_text' ),
					),
				)
			);
			$this->add_control(
				'heading_icon_hover_color',
				array(
					'label'     => __( 'Icon Hover Color', 'uael' ),
					'type'      => Controls_Manager::COLOR,
					'condition' => array(
						'heading_imgicon_style_options' => 'custom',
						'heading_separator_style'       => 'line_icon',
					),
					'default'   => '',
					'selectors' => array(
						'{{WRAPPER}} .uael-icon-wrap .uael-icon:hover i'  => 'color: {{VALUE}};',
						'{{WRAPPER}} .uael-icon-wrap .uael-icon:hover svg'  => 'fill: {{VALUE}};',
					),
				)
			);
			$this->add_control(
				'infobox_icon_hover_bgcolor',
				array(
					'label'     => __( 'Background Hover Color', 'uael' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'condition' => array(
						'heading_imgicon_style_options' => 'custom',
						'heading_separator_style!'      => array( 'none', 'line_text' ),
					),
					'selectors' => array(
						'{{WRAPPER}} .uael-icon-wrap .uael-icon:hover, {{WRAPPER}} .uael-image-content:hover' => 'background-color: {{VALUE}};',

					),
				)
			);
			$this->add_control(
				'heading_icon_hover_border',
				array(
					'label'     => __( 'Border Hover Color', 'uael' ),
					'type'      => Controls_Manager::COLOR,
					'condition' => array(
						'heading_imgicon_style_options' => 'custom',
						'heading_separator_style!'      => array( 'none', 'line_text' ),
						'heading_icon_border!'          => 'none',
					),
					'default'   => '',
					'selectors' => array(
						'{{WRAPPER}} .uael-icon-wrap .uael-icon:hover, {{WRAPPER}} .uael-image-content:hover ' => 'border-color: {{VALUE}};',
					),
				)
			);
			$this->add_control(
				'heading_icon_animation',
				array(
					'label'     => __( 'Hover Animation', 'uael' ),
					'type'      => Controls_Manager::HOVER_ANIMATION,
					'condition' => array(
						'heading_imgicon_style_options' => 'custom',
						'heading_separator_style!'      => array( 'none', 'line_text' ),
					),
				)
			);

			$this->end_controls_tab();

		$this->end_controls_tabs();

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
					'raw'             => sprintf( __( '%1$s Getting started article » %2$s', 'uael' ), '<a href="https://uaelementor.com/docs/advanced-heading-widget/?utm_source=uael-pro-dashboard&utm_medium=uael-editor-screen&utm_campaign=uael-pro-plugin" target="_blank" rel="noopener">', '</a>' ),
					'content_classes' => 'uael-editor-doc',
				)
			);

			$this->end_controls_section();
		}
	}

	/**
	 * Display Separator.
	 *
	 * @since 0.0.1
	 * @access public
	 * @param object $pos for position of separator.
	 * @param object $settings for settings.
	 */
	public function render_separator( $pos, $settings ) {
		if ( 'none' !== $settings['heading_separator_style'] && $pos === $settings['heading_separator_position'] ) {
			?>
			<div class="uael-module-content uael-separator-parent">
				<?php if ( 'line_icon' === $settings['heading_separator_style'] || 'line_image' === $settings['heading_separator_style'] || 'line_text' === $settings['heading_separator_style'] ) { ?>
				<div class="uael-separator-wrap">
					<div class="uael-separator-line uael-side-left">
						<span></span>
					</div>
					<div class="uael-divider-content">
						<?php $this->render_image(); ?>
						<?php
						if ( 'line_text' === $settings['heading_separator_style'] ) {
								echo '<span class="uael-divider-text elementor-inline-editing" data-elementor-setting-key="heading_line_text" data-elementor-inline-editing-toolbar="basic">' . wp_kses_post( $this->get_settings_for_display( 'heading_line_text' ) ) . '</span>';
						}
						?>

					</div>
					<div class="uael-separator-line uael-side-right">
						<span></span>
					</div>
				</div>
			<?php } ?>
				<?php if ( 'line' === $settings['heading_separator_style'] ) { ?>
					<div class="uael-separator"></div>
				<?php } ?>
			</div>
			<?php
		}
	}

	/**
	 * Display Separator image/icon.
	 *
	 * @since 0.0.1
	 * @access public
	 */
	public function render_image() {
		$settings = $this->get_settings_for_display();

		if ( 'line_icon' === $settings['heading_separator_style'] || 'line_image' === $settings['heading_separator_style'] ) {
			$anim_class = '';
			if ( 'simple' === $settings['heading_imgicon_style_options'] ) {
				$anim_class = $settings['headings_icon_animation'];
			} elseif ( 'custom' === $settings['heading_imgicon_style_options'] ) {
				$anim_class = $settings['heading_icon_animation'];
			}

			?>
			<div class="uael-module-content uael-imgicon-wrap elementor-animation-<?php echo esc_attr( $anim_class ); ?>"><?php /* Module Wrap */ ?>
				<?php /*Icon Html */ ?>
				<?php
				if ( 'line_icon' === $settings['heading_separator_style'] ) {
					if ( UAEL_Helper::is_elementor_updated() ) {
						if ( ! isset( $settings['heading_icon'] ) && ! \Elementor\Icons_Manager::is_migration_allowed() ) {
							// add old default.
							$settings['heading_icon'] = 'fa fa-star';
						}

						$has_icon = ! empty( $settings['heading_icon'] );

						if ( ! $has_icon && ! empty( $settings['new_heading_icon']['value'] ) ) {
							$has_icon = true;
						}

						$migrated = isset( $settings['__fa4_migrated']['new_heading_icon'] );
						$is_new   = ! isset( $settings['heading_icon'] ) && \Elementor\Icons_Manager::is_migration_allowed();
						if ( $has_icon ) {
							?>
							<div class="uael-icon-wrap">
								<span class="uael-icon">
									<?php
									if ( $is_new || $migrated ) {
										\Elementor\Icons_Manager::render_icon( $settings['new_heading_icon'], array( 'aria-hidden' => 'true' ) );
									} elseif ( ! empty( $settings['heading_icon'] ) ) {
										?>
										<i class="<?php echo esc_attr( $settings['heading_icon'] ); ?>" aria-hidden="true"></i>
									<?php } ?>

								</span>
							</div>
							<?php
						}
					} else {
						?>
						<div class="uael-icon-wrap">
							<span class="uael-icon">
								<i class="<?php echo esc_attr( $settings['heading_icon'] ); ?>"></i>
							</span>
						</div>
						<?php
					}
				}
				// Icon Html End.
				?>

				<?php /* Photo Html */ ?>
				<?php
				if ( 'line_image' === $settings['heading_separator_style'] ) {
					if ( 'media' === $settings['heading_image_type'] ) {
						if ( ! empty( $settings['heading_image']['url'] ) ) {
							$this->add_render_attribute( 'heading_image', 'src', $settings['heading_image']['url'] );
							$this->add_render_attribute( 'heading_image', 'alt', Control_Media::get_image_alt( $settings['heading_image'] ) );

							$image_html = '<img class="uael-photo-img" ' . $this->get_render_attribute_string( 'heading_image' ) . '>';
						}
					}
					if ( 'url' === $settings['heading_image_type'] ) {
						if ( ! empty( $settings['heading_image_link'] ) ) {

							$this->add_render_attribute( 'heading_image_link', 'src', $settings['heading_image_link']['url'] );

							$image_html = '<img class="uael-photo-img" ' . $this->get_render_attribute_string( 'heading_image_link' ) . '>';
						}
					}
					?>
					<div class="uael-image" itemscope itemtype="http://schema.org/ImageObject">
						<div class="uael-image-content">
							<?php echo wp_kses_post( $image_html ); ?>
						</div>
					</div>
				<?php } // Photo Html End. ?>
			</div>
			<?php
		}
	}

	/**
	 * Render Heading output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function render() {

		$html             = '';
		$settings         = $this->get_settings();
		$dynamic_settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes( 'heading_title', 'basic' );
		$this->add_inline_editing_attributes( 'sub_heading', 'advanced' );
		$this->add_inline_editing_attributes( 'heading_description', 'advanced' );

		if ( empty( $dynamic_settings['heading_title'] ) ) {
			return;
		}

		if ( ! empty( $dynamic_settings['heading_link']['url'] ) ) {
			$this->add_render_attribute( 'url', 'href', $dynamic_settings['heading_link']['url'] );

			if ( $dynamic_settings['heading_link']['is_external'] ) {
				$this->add_render_attribute( 'url', 'target', '_blank' );
			}

			if ( ! empty( $dynamic_settings['heading_link']['nofollow'] ) ) {
				$this->add_render_attribute( 'url', 'rel', 'nofollow' );
			}
			$link = $this->get_render_attribute_string( 'url' );
		}
		?>

		<div class="uael-module-content uael-heading-wrapper">
			<?php $this->render_separator( 'top', $settings ); ?>

			<<?php echo esc_attr( $settings['heading_tag'] ); ?> class="uael-heading">
				<?php if ( ! empty( $dynamic_settings['heading_link']['url'] ) ) { ?>
					<a <?php echo wp_kses_post( $link ); ?> >
				<?php } ?>
						<span class="uael-heading-text elementor-inline-editing uael-size--<?php echo esc_attr( $settings['size'] ); ?>" data-elementor-setting-key="heading_title" data-elementor-inline-editing-toolbar="basic" ><?php echo wp_kses_post( $this->get_settings_for_display( 'heading_title' ) ); ?></span>
				<?php if ( ! empty( $dynamic_settings['heading_link']['url'] ) ) { ?>
					</a>
				<?php } ?>
			</<?php echo esc_attr( $settings['heading_tag'] ); ?>>

			<?php if ( '' !== $dynamic_settings['sub_heading'] ) { ?>
				<div class="uael-sub-heading elementor-inline-editing" data-elementor-setting-key="sub_heading" data-elementor-inline-editing-toolbar="advanced" ><?php echo wp_kses_post( $this->get_settings_for_display( 'sub_heading' ) ); ?></div>
				<?php } ?>

			<?php $this->render_separator( 'center', $settings ); ?>

			<?php if ( '' !== $dynamic_settings['heading_description'] ) { ?>
				<div class="uael-subheading elementor-inline-editing" data-elementor-setting-key="heading_description" data-elementor-inline-editing-toolbar="advanced" >
					<?php echo wp_kses_post( $this->get_settings_for_display( 'heading_description' ) ); ?>
				</div>
				<?php } ?>

				<?php $this->render_separator( 'bottom', $settings ); ?>
		</div>
		<?php
	}

	/**
	 * Render Heading widgets output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.22.1
	 * @access protected
	 */
	protected function content_template() {
		?>
		<#
		function render_separator( pos ) {
			if ( 'none' != settings.heading_separator_style && pos == settings.heading_separator_position ) {
			#>
				<div class="uael-module-content uael-separator-parent">
					<# if ( 'line_icon' == settings.heading_separator_style || 'line_image' == settings.heading_separator_style || 'line_text' == settings.heading_separator_style ) { #>
						<div class="uael-separator-wrap">
							<div class="uael-separator-line uael-side-left">
								<span></span>
							</div>
							<div class="uael-divider-content">
								<#
								render_image();
								if ( 'line_text' == settings.heading_separator_style ) { #>
									<span class="uael-divider-text elementor-inline-editing" data-elementor-setting-key="heading_line_text" data-elementor-inline-editing-toolbar="basic">{{{ settings.heading_line_text }}}</span>
								<# } #>
							</div>
							<div class="uael-separator-line uael-side-right">
									<span></span>
							</div>
						</div>
					<# } #>
					<# if ( 'line' == settings.heading_separator_style ) { #>
						<div class="uael-separator"></div>
					<# } #>
				</div>
			<#
			}
		}
		#>


		<#
		function render_image() {
			if ( 'line_icon' == settings.heading_separator_style || 'line_image' == settings.heading_separator_style ) {

				view.addRenderAttribute( 'anim_class', 'class', 'uael-module-content uael-imgicon-wrap' );

				if ( 'simple' == settings.heading_imgicon_style_options ) {
					view.addRenderAttribute( 'anim_class', 'class', 'elementor-animation-' + settings.headings_icon_animation );
				}
				else if ( 'custom' == settings.heading_imgicon_style_options ) {
					view.addRenderAttribute( 'anim_class', 'class', 'elementor-animation-' + settings.heading_icon_animation );
				}

				#>
				<div {{{ view.getRenderAttributeString( 'anim_class' ) }}} >
					<# if ( 'line_icon' == settings.heading_separator_style ) { #>
						<div class="uael-icon-wrap">
							<span class="uael-icon">
								<?php if ( UAEL_Helper::is_elementor_updated() ) { ?>
									<# var iconHTML = elementor.helpers.renderIcon( view, settings.new_heading_icon, { 'aria-hidden': true }, 'i' , 'object' );

									var migrated = elementor.helpers.isIconMigrated( settings, 'new_heading_icon' );

									if ( iconHTML && iconHTML.rendered && ( ! settings.heading_icon || migrated ) ) {
									#>
										{{{ iconHTML.value }}}
									<# } else { #>
										<i class="{{ settings.heading_icon }}" aria-hidden="true"></i>
									<# } #>
								<?php } else { ?>
									<i class="{{ settings.heading_icon }}" aria-hidden="true"></i>
								<?php } ?>
							</span>
						</div>
					<# } #>
					<# if ( 'line_image' == settings.heading_separator_style ) { #>
						<div class="uael-image" itemscope itemtype="http://schema.org/ImageObject">
							<div class="uael-image-content">
								<#
								if ( 'media' == settings.heading_image_type ) {
									if ( '' != settings.heading_image.url ) {
										view.addRenderAttribute( 'heading_image', 'src', settings.heading_image.url );
										#>
										<img class="uael-photo-img" {{{ view.getRenderAttributeString( 'heading_image' ) }}}>
										<#
									}
								}
								if ( 'url' == settings.heading_image_type ) {
									if ( '' != settings.heading_image_link ) {
										view.addRenderAttribute( 'heading_image_link', 'src', settings.heading_image_link.url );
										#>
										<img class="uael-photo-img" {{{ view.getRenderAttributeString( 'heading_image_link' ) }}}>
										<#
									}
								} #>
							</div>
						</div>
					<# } #>
				</div>
			<#
			}
		}
		#>

		<#
		if ( '' == settings.heading_title ) {
			return;
		}
		if ( '' == settings.size ){
			return;
		}
		if ( '' != settings.heading_link.url ) {
			view.addRenderAttribute( 'url', 'href', settings.heading_link.url );
		}
		#>
		<div class="uael-module-content uael-heading-wrapper">
			<# render_separator( 'top' ); #>
			<{{{ settings.heading_tag }}} class="uael-heading">
				<# if ( '' != settings.heading_link.url ) { #>
					<a {{{ view.getRenderAttributeString( 'url' ) }}} >
				<# } #>
				<span class="uael-heading-text elementor-inline-editing uael-size--{{{ settings.size }}}" data-elementor-setting-key="heading_title" data-elementor-inline-editing-toolbar="basic" >{{{ settings.heading_title }}}</span>
				<# if ( '' != settings.heading_link.url ) { #>
					</a>
				<# } #>
			</{{{ settings.heading_tag }}}>

			<# if ( '' != settings.sub_heading ) { #>
				<div class="uael-sub-heading elementor-inline-editing" data-elementor-setting-key="sub_heading" data-elementor-inline-editing-toolbar="advanced" >{{{ settings.sub_heading }}}</div>
				<# } #>

			<# render_separator( 'center' ); #>

			<# if ( '' != settings.heading_description ) { #>
				<div class="uael-subheading elementor-inline-editing" data-elementor-setting-key="heading_description" data-elementor-inline-editing-toolbar="basic" >
					{{{ settings.heading_description }}}
				</div>
			<# } #>
			<# render_separator( 'bottom' ); #>
		</div>
		<?php
	}

	/**
	 * Render Heading widgets output in the editor.
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
