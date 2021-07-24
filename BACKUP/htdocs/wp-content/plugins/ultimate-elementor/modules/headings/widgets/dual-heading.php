<?php
/**
 * UAEL Dual Color Heading.
 *
 * @package UAEL
 */

namespace UltimateElementor\Modules\Headings\Widgets;

// Elementor Classes.
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Background;

// UltimateElementor Classes.
use UltimateElementor\Base\Common_Widget;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

/**
 * Class Dual_Heading.
 */
class Dual_Heading extends Common_Widget {

	/**
	 * Retrieve Dual Color Heading Widget name.
	 *
	 * @since 0.0.1
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return parent::get_widget_slug( 'Dual_Heading' );
	}

	/**
	 * Retrieve Dual Color Heading Widget title.
	 *
	 * @since 0.0.1
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return parent::get_widget_title( 'Dual_Heading' );
	}

	/**
	 * Retrieve Dual Color Heading Widget icon.
	 *
	 * @since 0.0.1
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return parent::get_widget_icon( 'Dual_Heading' );
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
		return parent::get_widget_keywords( 'Dual_Heading' );
	}

	/**
	 * Register Dual Color Heading controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function _register_controls() { // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore 

		$this->register_heading_content_controls();
		$this->register_general_content_controls();
		$this->register_style_content_controls();
		$this->register_helpful_information();
	}

	/**
	 * Register Dual Color Heading Text Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_heading_content_controls() {
		$this->start_controls_section(
			'section_headings_field',
			array(
				'label' => __( 'Heading Text', 'uael' ),
			)
		);
		$this->add_control(
			'before_heading_text',
			array(

				'label'    => __( 'Before Text', 'uael' ),
				'type'     => Controls_Manager::TEXT,
				'selector' => '{{WRAPPER}} .uael-heading-text',
				'dynamic'  => array(
					'active' => true,
				),
				'default'  => __( 'I love', 'uael' ),
			)
		);
		$this->add_control(
			'second_heading_text',
			array(
				'label'    => __( 'Highlighted Text', 'uael' ),
				'type'     => Controls_Manager::TEXT,
				'selector' => '{{WRAPPER}} .uael-highlight-text',
				'dynamic'  => array(
					'active' => true,
				),
				'default'  => __( 'this website', 'uael' ),
			)
		);
		$this->add_control(
			'after_heading_text',
			array(
				'label'    => __( 'After Text', 'uael' ),
				'type'     => Controls_Manager::TEXT,
				'dynamic'  => array(
					'active' => true,
				),
				'selector' => '{{WRAPPER}} .uael-dual-heading-text',
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
		$this->end_controls_section();
	}

	/**
	 * Register Dual Color Heading General Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_general_content_controls() {

		$this->start_controls_section(
			'section_style_field',
			array(
				'label' => __( 'General', 'uael' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'dual_tag_selection',
			array(
				'label'   => __( 'Select Tag', 'uael' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'h1'   => __( 'H1', 'uael' ),
					'h2'   => __( 'H2', 'uael' ),
					'h3'   => __( 'H3', 'uael' ),
					'h4'   => __( 'H4', 'uael' ),
					'h5'   => __( 'H5', 'uael' ),
					'h6'   => __( 'H6', 'uael' ),
					'div'  => __( 'div', 'uael' ),
					'span' => __( 'span', 'uael' ),
					'p'    => __( 'p', 'uael' ),
				),
				'default' => 'h3',
			)
		);

		$this->add_responsive_control(
			'dual_color_alignment',
			array(
				'label'     => __( 'Alignment', 'uael' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
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
				'default'   => 'left',
				'selectors' => array(
					'{{WRAPPER}} .uael-dual-color-heading' => 'text-align: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'heading_layout',
			array(
				'label'        => __( 'Layout', 'uael' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Stack', 'uael' ),
				'label_off'    => __( 'Inline', 'uael' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'prefix_class' => 'uael-stack-desktop-',
			)
		);
		$this->add_control(
			'heading_stack_on',
			array(
				'label'        => __( 'Responsive Support', 'uael' ),
				'description'  => __( 'Choose on what breakpoint the heading will stack.', 'uael' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'none',
				'options'      => array(
					'none'   => __( 'No', 'uael' ),
					'tablet' => __( 'For Tablet & Mobile', 'uael' ),
					'mobile' => __( 'For Mobile Only', 'uael' ),
				),
				'condition'    => array(
					'heading_layout!' => 'yes',
				),
				'prefix_class' => 'uael-heading-stack-',
			)
		);

		$this->add_responsive_control(
			'heading_margin',
			array(
				'label'      => __( 'Spacing Between Headings', 'uael' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 200,
					),
				),
				'default'    => array(
					'size' => '0',
					'unit' => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .uael-before-heading' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .uael-after-heading'  => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.uael-stack-desktop-yes .uael-before-heading' => 'margin-bottom: {{SIZE}}{{UNIT}}; margin-right: 0px; display: inline-block;',
					'{{WRAPPER}}.uael-stack-desktop-yes .uael-after-heading' => 'margin-top: {{SIZE}}{{UNIT}}; margin-left: 0px; display: inline-block;',
					'(tablet){{WRAPPER}}.uael-heading-stack-tablet .uael-before-heading ' => 'margin-bottom: {{SIZE}}{{UNIT}}; margin-right: 0px; display: inline-block;',
					'(tablet){{WRAPPER}}.uael-heading-stack-tablet .uael-after-heading ' => 'margin-top: {{SIZE}}{{UNIT}}; margin-left: 0px; display: inline-block;',
					'(mobile){{WRAPPER}}.uael-heading-stack-mobile .uael-before-heading ' => 'margin-bottom: {{SIZE}}{{UNIT}}; margin-right: 0px; display: inline-block;',
					'(mobile){{WRAPPER}}.uael-heading-stack-mobile .uael-after-heading ' => 'margin-top: {{SIZE}}{{UNIT}}; margin-left: 0px; display: inline-block;',
				),
			)
		);
		$this->end_controls_section();

	}

	/**
	 * Register Dual Color Heading Style Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_style_content_controls() {
		$this->start_controls_section(
			'heading_style_fields',
			array(
				'label' => __( 'Heading Style', 'uael' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs( 'tabs_heading' );

		$this->start_controls_tab(
			'tab_heading',
			array(
				'label' => __( 'Normal', 'uael' ),
			)
		);

		$this->add_control(
			'first_heading_color',
			array(
				'label'     => __( 'Text Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_1,
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .uael-dual-heading-text' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'before_heading_text_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .uael-dual-heading-text',
			)
		);
		$this->add_control(
			'heading_adv_options',
			array(
				'label'        => __( 'Advanced', 'uael' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'uael' ),
				'label_off'    => __( 'No', 'uael' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'heading_bg_color',
				'label'     => __( 'Background Color', 'uael' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .uael-dual-heading-text',
				'condition' => array(
					'heading_adv_options' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'heading_padding',
			array(
				'label'      => __( 'Padding', 'uael' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .uael-dual-heading-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'default'    => array(
					'top'    => 0,
					'bottom' => 0,
					'left'   => 0,
					'right'  => 0,
					'unit'   => 'px',
				),
				'condition'  => array(
					'heading_adv_options' => 'yes',
				),

			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'heading_text_border',
				'label'       => __( 'Border', 'uael' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .uael-dual-heading-text',
				'condition'   => array(
					'heading_adv_options' => 'yes',
				),
			)
		);
		$this->add_control(
			'heading_border_radius',
			array(
				'label'      => __( 'Border Radius', 'uael' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .uael-dual-heading-text, {{WRAPPER}} .uael-dual-heading-text.uael-highlight-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'heading_adv_options' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'      => 'dual_text_shadow',
				'selector'  => '{{WRAPPER}} .uael-dual-heading-text',
				'condition' => array(
					'heading_adv_options' => 'yes',
				),
			)
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_highlight',
			array(
				'label' => __( 'Highlight', 'uael' ),
			)
		);

		$this->add_control(
			'second_heading_color',
			array(
				'label'     => __( 'Highlight Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'scheme'    => array(
					'type'  => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_2,
				),
				'selectors' => array(
					'{{WRAPPER}} .uael-dual-heading-text.uael-highlight-text' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'second_heading_text_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .uael-dual-heading-text.uael-highlight-text',
			)
		);
		$this->add_control(
			'highlight_adv_options',
			array(
				'label'        => __( 'Advanced', 'uael' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'uael' ),
				'label_off'    => __( 'No', 'uael' ),
				'return_value' => 'yes',
				'default'      => '',
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'highlight_bg_color',
				'label'     => __( 'Background Color', 'uael' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .uael-dual-heading-text.uael-highlight-text',
				'condition' => array(
					'highlight_adv_options' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'heading_highlight_padding',
			array(
				'label'      => __( 'Padding', 'uael' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'default'    => array(
					'top'    => 0,
					'bottom' => 0,
					'left'   => 0,
					'right'  => 0,
					'unit'   => 'px',
				),
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .uael-dual-heading-text.uael-highlight-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'highlight_adv_options' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'highlight_text_border',
				'label'       => __( 'Border', 'uael' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .uael-dual-heading-text.uael-highlight-text',
				'condition'   => array(
					'highlight_adv_options' => 'yes',
				),
			)
		);
		$this->add_control(
			'heading_highlight_radius',
			array(
				'label'      => __( 'Border Radius', 'uael' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .uael-dual-heading-text.uael-highlight-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'highlight_adv_options' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'      => 'dual_highlight_shadow',
				'selector'  => '{{WRAPPER}} .uael-dual-heading-text.uael-highlight-text',
				'condition' => array(
					'highlight_adv_options' => 'yes',
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
	 * @since 1.3.1
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
					'raw'             => sprintf( __( '%1$s Getting started video » %2$s', 'uael' ), '<a href="https://www.youtube.com/watch?v=WmrSMl5g3ac&list=PL1kzJGWGPrW_7HabOZHb6z88t_S8r-xAc&index=16" target="_blank" rel="noopener">', '</a>' ),
					'content_classes' => 'uael-editor-doc',
				)
			);

			$this->add_control(
				'help_doc_2',
				array(
					'type'            => Controls_Manager::RAW_HTML,
					/* translators: %1$s doc link */
					'raw'             => sprintf( __( '%1$s Getting started article » %2$s', 'uael' ), '<a href="https://uaelementor.com/docs/dual-color-heading-widget/?utm_source=uael-pro-dashboard&utm_medium=uael-editor-screen&utm_campaign=uael-pro-plugin" target="_blank" rel="noopener">', '</a>' ),
					'content_classes' => 'uael-editor-doc',
				)
			);

			$this->end_controls_section();
		}
	}

	/**
	 * Render Dual Color Heading output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function render() {
		$settings     = $this->get_settings_for_display();
		$first_title  = $settings['before_heading_text'];
		$second_title = $settings['second_heading_text'];
		$third_title  = $settings['after_heading_text'];
		ob_start();
		?>
		<?php
		$link = '';
		if ( ! empty( $settings['heading_link']['url'] ) ) {
			$this->add_render_attribute( 'url', 'href', $settings['heading_link']['url'] );

			if ( $settings['heading_link']['is_external'] ) {
				$this->add_render_attribute( 'url', 'target', '_blank' );
			}

			if ( ! empty( $settings['heading_link']['nofollow'] ) ) {
				$this->add_render_attribute( 'url', 'rel', 'nofollow' );
			}
			$link = $this->get_render_attribute_string( 'url' );
		}
		?>
		<div class="uael-module-content uael-dual-color-heading">
			<<?php echo esc_attr( $settings['dual_tag_selection'] ); ?>>
				<?php if ( ! empty( $settings['heading_link']['url'] ) ) { ?>
					<a <?php echo wp_kses_post( $link ); ?> >
				<?php } ?>
						<?php
						// Ignore the PHPCS warning about constant declaration.
						// @codingStandardsIgnoreStart
						?>
						<span class="uael-before-heading"><span class="elementor-inline-editing uael-dual-heading-text uael-first-text" data-elementor-setting-key="before_heading_text" data-elementor-inline-editing-toolbar="basic"><?php echo $this->get_settings_for_display( 'before_heading_text'); ?></span></span><span class="uael-adv-heading-stack"><span class="elementor-inline-editing uael-dual-heading-text uael-highlight-text" data-elementor-setting-key="second_heading_text" data-elementor-inline-editing-toolbar="basic"><?php echo $this->get_settings_for_display( 'second_heading_text'); ?></span></span><?php if ( ! empty( $settings['after_heading_text'] ) ) { ?><span class="uael-after-heading"><span class="elementor-inline-editing uael-dual-heading-text uael-third-text" data-elementor-setting-key="after_heading_text" data-elementor-inline-editing-toolbar="basic"><?php echo $this->get_settings_for_display( 'after_heading_text'); ?></span></span><?php } ?>
						<?php // @codingStandardsIgnoreEnd ?>
				<?php if ( ! empty( $settings['heading_link']['url'] ) ) { ?>
					</a>
				<?php } ?>
			</<?php echo esc_attr( $settings['dual_tag_selection'] ); ?>>
		</div>
		<?php
		$html = ob_get_clean();
		echo wp_kses_post( $html );
	}

	/**
	 * Render Dual Color Heading widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.22.1
	 * @access protected
	 */
	protected function content_template() {
		?>
		<div class="uael-module-content uael-dual-color-heading">
			<{{ settings.dual_tag_selection }}>
				<# if ( '' != settings.heading_link.url ) { #>
					<a href= {{ settings.heading_link.url }}>
				<# } #>
				<span class="uael-before-heading"><span class="elementor-inline-editing uael-dual-heading-text uael-first-text" data-elementor-setting-key="before_heading_text" data-elementor-inline-editing-toolbar="basic">{{ settings.before_heading_text }}</span></span><span class="uael-adv-heading-stack"><span class="elementor-inline-editing uael-dual-heading-text uael-highlight-text" data-elementor-setting-key="second_heading_text" data-elementor-inline-editing-toolbar="basic">{{ settings.second_heading_text }}</span></span><# if ( '' != settings.after_heading_text ) { #><span class="uael-after-heading"><span class="elementor-inline-editing uael-dual-heading-text uael-third-text" data-elementor-setting-key="after_heading_text" data-elementor-inline-editing-toolbar="basic">{{ settings.after_heading_text }}</span></span>
				<# } #>
				<# if ( '' !== settings.heading_link.url ) { #>
					</a>
				<# } #>
			</{{ settings.dual_tag_selection }}>
		</div>
		<?php
	}

	/**
	 * Render Dual Color Heading widget output in the editor.
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

