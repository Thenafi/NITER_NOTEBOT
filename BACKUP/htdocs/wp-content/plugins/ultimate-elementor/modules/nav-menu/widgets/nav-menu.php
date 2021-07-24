<?php
/**
 * UAEL Navigation Menu.
 *
 * @package UAEL
 */

namespace UltimateElementor\Modules\NavMenu\Widgets;

// Elementor Classes.
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;

// UltimateElementor Classes.
use UltimateElementor\Base\Common_Widget;
use UltimateElementor\Modules\NavMenu\Widgets\Menu_Walker;
use UltimateElementor\Classes\UAEL_Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

/**
 * Class Nav Menu.
 */
class Nav_Menu extends Common_Widget {

	/**
	 * Menu index.
	 *
	 * @access protected
	 * @var $nav_menu_index
	 */
	protected $nav_menu_index = 1;

	/**
	 * Retrieve Nav Menu Widget name.
	 *
	 * @since 1.21.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return parent::get_widget_slug( 'Nav_Menu' );
	}

	/**
	 * Retrieve Nav Menu Widget title.
	 *
	 * @since 1.21.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return parent::get_widget_title( 'Nav_Menu' );
	}

	/**
	 * Retrieve Nav Menu Widget icon.
	 *
	 * @since 1.21.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return parent::get_widget_icon( 'Nav_Menu' );
	}

	/**
	 * Retrieve Widget Keywords.
	 *
	 * @since 1.21.1
	 * @access public
	 *
	 * @return string Widget keywords.
	 */
	public function get_keywords() {
		return parent::get_widget_keywords( 'Nav_Menu' );
	}

	/**
	 * Retrieve the list of scripts the image carousel widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.21.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_script_depends() {
		return array( 'uael-nav-menu', 'uael-element-resize', 'uael-cookie-lib' );
	}

	/**
	 * Retrieve the menu index.
	 *
	 * Used to get index of nav menu.
	 *
	 * @since 1.21.0
	 * @access protected
	 *
	 * @return string nav index.
	 */
	protected function get_nav_menu_index() {
		return $this->nav_menu_index++;
	}

	/**
	 * Retrieve the list of available menus.
	 *
	 * Used to get the list of available menus.
	 *
	 * @since 1.21.0
	 * @access private
	 *
	 * @return array get WordPress menus list.
	 */
	private function get_available_menus() {

		$menus = wp_get_nav_menus();

		$options = array();

		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}

		return $options;
	}


	/**
	 * Register Nav Menu controls.
	 *
	 * @since 1.21.0
	 * @access protected
	 */
	protected function _register_controls() { // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore

		$this->register_general_content_controls();
		$this->register_style_content_controls();
		$this->register_dropdown_content_controls();
		$this->register_helpful_information();
	}

	/**
	 * Register Nav Menu General Controls.
	 *
	 * @since 1.21.0
	 * @access protected
	 */
	protected function register_general_content_controls() {

		$this->start_controls_section(
			'section_menu',
			array(
				'label' => __( 'Menu', 'uael' ),
			)
		);

		$this->add_control(
			'menu_type',
			array(
				'label'   => __( 'Type', 'uael' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'wordpress_menu',
				'options' => array(
					'wordpress_menu' => __( 'WordPress Menu', 'uael' ),
					'custom'         => __( 'Custom', 'uael' ),
				),
			)
		);

		$menus = $this->get_available_menus();

		if ( ! empty( $menus ) ) {
			$this->add_control(
				'menu',
				array(
					'label'        => __( 'Menu', 'uael' ),
					'type'         => Controls_Manager::SELECT,
					'options'      => $menus,
					'default'      => array_keys( $menus )[0],
					'save_default' => true,
					'separator'    => 'after',
					/* translators: %s Nav menu URL */
					'description'  => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'uael' ), admin_url( 'nav-menus.php' ) ),
					'condition'    => array(
						'menu_type' => 'wordpress_menu',
					),
				)
			);
		} else {
			$this->add_control(
				'menu',
				array(
					'type'            => Controls_Manager::RAW_HTML,
					/* translators: %s Nav menu URL */
					'raw'             => sprintf( __( '<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'uael' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'separator'       => 'after',
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
					'condition'       => array(
						'menu_type' => 'wordpress_menu',
					),
				)
			);
		}

		$repeater = new Repeater();

		$repeater->add_control(
			'item_type',
			array(
				'label'   => __( 'Item Type', 'uael' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'item_menu',
				'options' => array(
					'item_menu'    => __( 'Menu', 'uael' ),
					'item_submenu' => __( 'Sub Menu', 'uael' ),
				),
			)
		);

		$repeater->add_control(
			'menu_content_type',
			array(
				'label'     => __( 'Content Type', 'uael' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->get_content_type(),
				'default'   => 'sub_menu',
				'condition' => array(
					'item_type' => 'item_submenu',
				),
			)
		);

		$repeater->add_control(
			'text',
			array(
				'label'       => __( 'Text', 'uael' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Item', 'uael' ),
				'placeholder' => __( 'Item', 'uael' ),
				'dynamic'     => array(
					'active' => true,
				),
				'conditions'  => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'item_type',
							'operator' => '==',
							'value'    => array(
								'item_menu',
							),
						),
						array(
							'name'     => 'menu_content_type',
							'operator' => '==',
							'value'    => array(
								'sub_menu',
							),
						),
					),
				),
			)
		);

		$repeater->add_control(
			'link',
			array(
				'label'      => __( 'Link', 'uael' ),
				'type'       => Controls_Manager::URL,
				'default'    => array(
					'url'         => '#',
					'is_external' => '',
				),
				'dynamic'    => array(
					'active' => true,
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'item_type',
							'operator' => '==',
							'value'    => array(
								'item_menu',
							),
						),
						array(
							'name'     => 'menu_content_type',
							'operator' => '==',
							'value'    => array(
								'sub_menu',
							),
						),
					),
				),
			)
		);

		$repeater->add_control(
			'content_saved_widgets',
			array(
				'label'     => __( 'Select Widget', 'uael' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => UAEL_Helper::get_saved_data( 'widget' ),
				'default'   => '-1',
				'condition' => array(
					'menu_content_type' => 'saved_modules',
					'item_type'         => 'item_submenu',
				),
			)
		);

		$repeater->add_control(
			'content_saved_rows',
			array(
				'label'     => __( 'Select Section', 'uael' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => UAEL_Helper::get_saved_data( 'section' ),
				'default'   => '-1',
				'condition' => array(
					'menu_content_type' => 'saved_rows',
					'item_type'         => 'item_submenu',
				),
			)
		);

		$repeater->add_control(
			'dropdown_width',
			array(
				'label'     => __( 'Dropdown Width', 'uael' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => array(
					'default'   => __( 'Default', 'uael' ),
					'custom'    => __( 'Custom', 'uael' ),
					'section'   => __( 'Equal to 	Section', 'uael' ),
					'container' => __( 'Equal to Container', 'uael' ),
					'column'    => __( 'Equal to 	Column', 'uael' ),
					'widget'    => __( 'Equal to 	Widget', 'uael' ),
				),
				'condition' => array(
					'item_type' => 'item_menu',
				),
			)
		);

		$repeater->add_control(
			'section_width',
			array(
				'label'     => __( 'Width (px)', 'uael' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 1500,
					),
				),
				'default'   => array(
					'size' => '220',
					'unit' => 'px',
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} ul.sub-menu' => 'width: {{SIZE}}{{UNIT}}',
				),
				'condition' => array(
					'dropdown_width' => 'custom',
					'item_type'      => 'item_menu',
				),
			)
		);

		$repeater->add_control(
			'dropdown_position',
			array(
				'label'     => __( 'Dropdown Position', 'uael' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => array(
					'left'   => __( 'Left', 'uael' ),
					'center' => __( 'Center', 'uael' ),
					'right'  => __( 'Right', 'uael' ),
				),
				'condition' => array(
					'item_type'      => 'item_menu',
					'dropdown_width' => array( 'custom', 'default' ),
				),
			)
		);

		$this->add_control(
			'menu_items',
			array(
				'label'       => __( 'Menu Items', 'uael' ),
				'type'        => Controls_Manager::REPEATER,
				'show_label'  => true,
				'fields'      => array_values( $repeater->get_controls() ),
				'default'     => array(
					array(
						'item_type' => 'item_menu',
						'text'      => __( 'Menu Item 1', 'uael' ),
					),
					array(
						'item_type' => 'item_submenu',
						'text'      => __( 'Sub Menu', 'uael' ),
					),
					array(
						'item_type' => 'item_menu',
						'text'      => __( 'Menu Item 2', 'uael' ),
					),
					array(
						'item_type' => 'item_submenu',
						'text'      => __( 'Sub Menu', 'uael' ),
					),
				),
				'title_field' => '{{{ text }}}',
				'separator'   => 'before',
				'condition'   => array(
					'menu_type' => 'custom',
				),
			)
		);

		$this->end_controls_section();

			$this->start_controls_section(
				'section_layout',
				array(
					'label' => __( 'Layout', 'uael' ),
				)
			);

			$this->add_control(
				'layout',
				array(
					'label'   => __( 'Layout', 'uael' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'horizontal',
					'options' => array(
						'horizontal' => __( 'Horizontal', 'uael' ),
						'vertical'   => __( 'Vertical', 'uael' ),
						'expandible' => __( 'Expanded', 'uael' ),
						'flyout'     => __( 'Flyout', 'uael' ),
					),
				)
			);

			$this->add_control(
				'navmenu_align',
				array(
					'label'        => __( 'Alignment', 'uael' ),
					'type'         => Controls_Manager::CHOOSE,
					'options'      => array(
						'left'    => array(
							'title' => __( 'Left', 'uael' ),
							'icon'  => 'eicon-h-align-left',
						),
						'center'  => array(
							'title' => __( 'Center', 'uael' ),
							'icon'  => 'eicon-h-align-center',
						),
						'right'   => array(
							'title' => __( 'Right', 'uael' ),
							'icon'  => 'eicon-h-align-right',
						),
						'justify' => array(
							'title' => __( 'Justify', 'uael' ),
							'icon'  => 'eicon-h-align-stretch',
						),
					),
					'default'      => 'left',
					'condition'    => array(
						'layout' => array( 'horizontal', 'vertical' ),
					),
					'prefix_class' => 'uael-nav-menu__align-',
					'render_type'  => 'template',
				)
			);

			$this->add_control(
				'flyout_layout',
				array(
					'label'     => __( 'Flyout Orientation', 'uael' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'left',
					'options'   => array(
						'left'  => __( 'Left', 'uael' ),
						'right' => __( 'Right', 'uael' ),
					),
					'condition' => array(
						'layout' => 'flyout',
					),
				)
			);

			$this->add_control(
				'flyout_type',
				array(
					'label'       => __( 'Appear Effect', 'uael' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'normal',
					'label_block' => false,
					'options'     => array(
						'normal' => __( 'Slide', 'uael' ),
						'push'   => __( 'Push', 'uael' ),
					),
					'render_type' => 'template',
					'condition'   => array(
						'layout' => 'flyout',
					),
				)
			);

			$this->add_responsive_control(
				'hamburger_align',
				array(
					'label'                => __( 'Hamburger Align', 'uael' ),
					'type'                 => Controls_Manager::CHOOSE,
					'default'              => 'center',
					'options'              => array(
						'left'   => array(
							'title' => __( 'Left', 'uael' ),
							'icon'  => 'eicon-h-align-left',
						),
						'center' => array(
							'title' => __( 'Center', 'uael' ),
							'icon'  => 'eicon-h-align-center',
						),
						'right'  => array(
							'title' => __( 'Right', 'uael' ),
							'icon'  => 'eicon-h-align-right',
						),
					),
					'selectors_dictionary' => array(
						'left'   => 'margin-right: auto',
						'center' => 'margin: 0 auto',
						'right'  => 'margin-left: auto',
					),
					'selectors'            => array(
						'{{WRAPPER}} .uael-nav-menu__toggle' => '{{VALUE}}',
					),
					'default'              => 'center',
					'condition'            => array(
						'layout' => array( 'expandible', 'flyout' ),
					),
					'label_block'          => false,
				)
			);

			$this->add_responsive_control(
				'hamburger_menu_align',
				array(
					'label'        => __( 'Menu Items Align', 'uael' ),
					'type'         => Controls_Manager::CHOOSE,
					'options'      => array(
						'flex-start'    => array(
							'title' => __( 'Left', 'uael' ),
							'icon'  => 'eicon-h-align-left',
						),
						'center'        => array(
							'title' => __( 'Center', 'uael' ),
							'icon'  => 'eicon-h-align-center',
						),
						'flex-end'      => array(
							'title' => __( 'Right', 'uael' ),
							'icon'  => 'eicon-h-align-right',
						),
						'space-between' => array(
							'title' => __( 'Justify', 'uael' ),
							'icon'  => 'eicon-h-align-stretch',
						),
					),
					'default'      => 'space-between',
					'condition'    => array(
						'layout' => array( 'expandible', 'flyout' ),
					),
					'selectors'    => array(
						'{{WRAPPER}} li.menu-item a' => 'justify-content: {{VALUE}};',
					),
					'prefix_class' => 'uael-menu-item-',
				)
			);

			$this->add_control(
				'submenu_icon',
				array(
					'label'        => __( 'Submenu Icon', 'uael' ),
					'type'         => Controls_Manager::SELECT,
					'default'      => 'arrow',
					'options'      => array(
						'arrow'   => __( 'Arrows', 'uael' ),
						'plus'    => __( 'Plus Sign', 'uael' ),
						'classic' => __( 'Classic', 'uael' ),
					),
					'condition'    => array(
						'menu_type' => array( 'custom', 'wordpress_menu' ),
					),
					'prefix_class' => 'uael-submenu-icon-',
				)
			);

			$this->add_control(
				'submenu_animation',
				array(
					'label'        => __( 'Submenu Animation', 'uael' ),
					'type'         => Controls_Manager::SELECT,
					'default'      => 'none',
					'options'      => array(
						'none'     => __( 'Default', 'uael' ),
						'slide_up' => __( 'Slide Up', 'uael' ),
					),
					'condition'    => array(
						'menu_type' => array( 'custom', 'wordpress_menu' ),
					),
					'prefix_class' => 'uael-submenu-animation-',
					'condition'    => array(
						'layout' => 'horizontal',
					),
				)
			);

			$this->add_control(
				'heading_responsive',
				array(
					'type'      => Controls_Manager::HEADING,
					'label'     => __( 'Responsive', 'uael' ),
					'separator' => 'before',
					'condition' => array(
						'layout' => array( 'horizontal', 'vertical' ),
					),
				)
			);

		$this->add_control(
			'dropdown',
			array(
				'label'        => __( 'Breakpoint', 'uael' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'tablet',
				'options'      => array(
					'mobile' => __( 'Mobile (768px >)', 'uael' ),
					'tablet' => __( 'Tablet (1025px >)', 'uael' ),
					'none'   => __( 'None', 'uael' ),
				),
				'prefix_class' => 'uael-nav-menu__breakpoint-',
				'condition'    => array(
					'layout' => array( 'horizontal', 'vertical' ),
				),
				'render_type'  => 'template',
			)
		);

		$this->add_control(
			'resp_align',
			array(
				'label'       => __( 'Alignment', 'uael' ),
				'type'        => Controls_Manager::CHOOSE,
				'options'     => array(
					'left'   => array(
						'title' => __( 'Left', 'uael' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'uael' ),
						'icon'  => 'eicon-h-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'uael' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'default'     => 'center',
				'description' => __( 'This is the alignement of menu icon on selected responsive breakpoints.', 'uael' ),
				'condition'   => array(
					'layout'    => array( 'horizontal', 'vertical' ),
					'dropdown!' => 'none',
				),
				'selectors'   => array(
					'{{WRAPPER}} .uael-nav-menu__toggle' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'full_width_dropdown',
			array(
				'label'        => __( 'Full Width', 'uael' ),
				'description'  => __( 'Enable this option to stretch the Sub Menu to Full Width.', 'uael' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'uael' ),
				'label_off'    => __( 'No', 'uael' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'layout!'   => 'flyout',
					'dropdown!' => 'none',
				),
				'render_type'  => 'template',
			)
		);

		if ( UAEL_Helper::is_elementor_updated() ) {
			$this->add_control(
				'dropdown_icon',
				array(
					'label'       => __( 'Menu Icon', 'uael' ),
					'type'        => Controls_Manager::ICONS,
					'label_block' => 'true',
					'default'     => array(
						'value'   => 'fas fa-align-justify',
						'library' => 'fa-solid',
					),
					'condition'   => array(
						'dropdown!' => 'none',
					),
				)
			);
		} else {
			$this->add_control(
				'dropdown_icon',
				array(
					'label'       => __( 'Icon', 'uael' ),
					'type'        => Controls_Manager::ICON,
					'label_block' => 'true',
					'default'     => 'fa fa-align-justify',
					'condition'   => array(
						'dropdown!' => 'none',
					),
				)
			);
		}

		if ( UAEL_Helper::is_elementor_updated() ) {
			$this->add_control(
				'dropdown_close_icon',
				array(
					'label'       => __( 'Close Icon', 'uael' ),
					'type'        => Controls_Manager::ICONS,
					'label_block' => 'true',
					'default'     => array(
						'value'   => 'far fa-window-close',
						'library' => 'fa-regular',
					),
					'condition'   => array(
						'dropdown!' => 'none',
					),
				)
			);
		} else {
			$this->add_control(
				'dropdown_close_icon',
				array(
					'label'       => __( 'Close Icon', 'uael' ),
					'type'        => Controls_Manager::ICON,
					'label_block' => 'true',
					'default'     => 'fa fa-close',
					'condition'   => array(
						'dropdown!' => 'none',
					),
				)
			);
		}

		$this->end_controls_section();
	}

	/**
	 * Register Nav Menu General Controls.
	 *
	 * @since 1.21.0
	 * @access protected
	 */
	protected function register_style_content_controls() {

		$this->start_controls_section(
			'section_style_main-menu',
			array(
				'label'     => __( 'Main Menu', 'uael' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'layout!' => 'expandible',
				),
			)
		);

			$this->add_responsive_control(
				'width_flyout_menu_item',
				array(
					'label'       => __( 'Flyout Box Width', 'uael' ),
					'type'        => Controls_Manager::SLIDER,
					'range'       => array(
						'px' => array(
							'max' => 500,
							'min' => 100,
						),
					),
					'default'     => array(
						'size' => 300,
						'unit' => 'px',
					),
					'selectors'   => array(
						'{{WRAPPER}} .uael-flyout-wrapper .uael-side' => 'width: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .uael-flyout-open.left'     => 'left: -{{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .uael-flyout-open.right'    => 'right: -{{SIZE}}{{UNIT}}',
					),
					'condition'   => array(
						'layout' => 'flyout',
					),
					'render_type' => 'template',
				)
			);

			$this->add_responsive_control(
				'padding_flyout_menu_item',
				array(
					'label'     => __( 'Flyout Box Padding', 'uael' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array(
							'max' => 50,
						),
					),
					'default'   => array(
						'size' => 30,
						'unit' => 'px',
					),
					'selectors' => array(
						'{{WRAPPER}} .uael-flyout-content' => 'padding: {{SIZE}}{{UNIT}}',
					),
					'condition' => array(
						'layout' => 'flyout',
					),
				)
			);

			$this->add_responsive_control(
				'padding_horizontal_menu_item',
				array(
					'label'       => __( 'Horizontal Padding', 'uael' ),
					'type'        => Controls_Manager::SLIDER,
					'size_units'  => array( 'px' ),
					'range'       => array(
						'px' => array(
							'max' => 50,
						),
					),
					'default'     => array(
						'size' => 15,
						'unit' => 'px',
					),
					'selectors'   => array(
						'{{WRAPPER}} .menu-item a.uael-menu-item,{{WRAPPER}} .menu-item a.uael-sub-menu-item' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
					),
					'render_type' => 'template',
				)
			);

			$this->add_responsive_control(
				'padding_vertical_menu_item',
				array(
					'label'       => __( 'Vertical Padding', 'uael' ),
					'type'        => Controls_Manager::SLIDER,
					'size_units'  => array( 'px' ),
					'range'       => array(
						'px' => array(
							'max' => 50,
						),
					),
					'default'     => array(
						'size' => 15,
						'unit' => 'px',
					),
					'selectors'   => array(
						'{{WRAPPER}} .menu-item a.uael-menu-item, {{WRAPPER}} .menu-item a.uael-sub-menu-item' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};',
					),
					'render_type' => 'template',
				)
			);

			$this->add_responsive_control(
				'menu_space_between',
				array(
					'label'       => __( 'Space Between', 'uael' ),
					'type'        => Controls_Manager::SLIDER,
					'size_units'  => array( 'px' ),
					'range'       => array(
						'px' => array(
							'max' => 100,
						),
					),
					'selectors'   => array(
						'body:not(.rtl) {{WRAPPER}} .uael-nav-menu__layout-horizontal .uael-nav-menu > li.menu-item:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}}',
						'body.rtl {{WRAPPER}} .uael-nav-menu__layout-horizontal .uael-nav-menu > li.menu-item:not(:last-child)' => 'margin-left: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} nav:not(.uael-nav-menu__layout-horizontal) .uael-nav-menu > li.menu-item:not(:last-child)' => 'margin-bottom: 0',
						'(tablet)body:not(.rtl) {{WRAPPER}}.uael-nav-menu__breakpoint-tablet .uael-nav-menu__layout-horizontal .uael-nav-menu > li.menu-item:not(:last-child)' => 'margin-right: 0px',
						'(mobile)body:not(.rtl) {{WRAPPER}}.uael-nav-menu__breakpoint-mobile .uael-nav-menu__layout-horizontal .uael-nav-menu > li.menu-item:not(:last-child)' => 'margin-right: 0px',
					),
					'render_type' => 'template',
					'condition'   => array(
						'layout' => 'horizontal',
					),
				)
			);

			$this->add_responsive_control(
				'menu_row_space',
				array(
					'label'       => __( 'Row Spacing', 'uael' ),
					'type'        => Controls_Manager::SLIDER,
					'size_units'  => array( 'px' ),
					'range'       => array(
						'px' => array(
							'max' => 100,
						),
					),
					'selectors'   => array(
						'body:not(.rtl) {{WRAPPER}} .uael-nav-menu__layout-horizontal .uael-nav-menu > li.menu-item' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					),
					'condition'   => array(
						'layout' => 'horizontal',
					),
					'render_type' => 'template',
				)
			);

			$this->add_responsive_control(
				'menu_top_space',
				array(
					'label'       => __( 'Menu Item Top Spacing', 'uael' ),
					'type'        => Controls_Manager::SLIDER,
					'size_units'  => array( 'px', '%' ),
					'range'       => array(
						'px' => array(
							'max' => 100,
						),
					),
					'selectors'   => array(
						'{{WRAPPER}} .uael-flyout-wrapper .uael-nav-menu > li.menu-item:first-child' => 'margin-top: {{SIZE}}{{UNIT}}',
					),
					'condition'   => array(
						'layout' => 'flyout',
					),
					'render_type' => 'template',
				)
			);

			$this->add_control(
				'bg_color_flyout',
				array(
					'label'     => __( 'Background Color', 'uael' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#FFFFFF',
					'selectors' => array(
						'{{WRAPPER}} .menu-item a.uael-menu-item' => 'background-color: {{VALUE}}',
						'{{WRAPPER}} .uael-flyout-content' => 'background-color: {{VALUE}}',
					),
					'condition' => array(
						'layout' => 'flyout',
					),
				)
			);

			$this->add_control(
				'pointer',
				array(
					'label'     => __( 'Link Hover Effect', 'uael' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'none',
					'options'   => array(
						'none'        => __( 'None', 'uael' ),
						'underline'   => __( 'Underline', 'uael' ),
						'overline'    => __( 'Overline', 'uael' ),
						'double-line' => __( 'Double Line', 'uael' ),
						'framed'      => __( 'Framed', 'uael' ),
						'text'        => __( 'Text', 'uael' ),
					),
					'condition' => array(
						'layout' => array( 'horizontal' ),
					),
				)
			);

		$this->add_control(
			'animation_line',
			array(
				'label'     => __( 'Animation', 'uael' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'fade',
				'options'   => array(
					'fade'     => 'Fade',
					'slide'    => 'Slide',
					'grow'     => 'Grow',
					'drop-in'  => 'Drop In',
					'drop-out' => 'Drop Out',
					'none'     => 'None',
				),
				'condition' => array(
					'layout'  => array( 'horizontal' ),
					'pointer' => array( 'underline', 'overline', 'double-line' ),
				),
			)
		);

		$this->add_control(
			'animation_framed',
			array(
				'label'     => __( 'Frame Animation', 'uael' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'fade',
				'options'   => array(
					'fade'    => 'Fade',
					'grow'    => 'Grow',
					'shrink'  => 'Shrink',
					'draw'    => 'Draw',
					'corners' => 'Corners',
					'none'    => 'None',
				),
				'condition' => array(
					'layout'  => array( 'horizontal' ),
					'pointer' => 'framed',
				),
			)
		);

		$this->add_control(
			'animation_text',
			array(
				'label'     => __( 'Animation', 'uael' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'grow',
				'options'   => array(
					'grow'   => 'Grow',
					'shrink' => 'Shrink',
					'sink'   => 'Sink',
					'float'  => 'Float',
					'skew'   => 'Skew',
					'rotate' => 'Rotate',
					'none'   => 'None',
				),
				'condition' => array(
					'layout'  => array( 'horizontal' ),
					'pointer' => 'text',
				),
			)
		);

		$this->add_control(
			'style_divider',
			array(
				'type' => Controls_Manager::DIVIDER,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'menu_typography',
				'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} .menu-item a.uael-menu-item',
			)
		);

		$this->start_controls_tabs( 'tabs_menu_item_style' );

				$this->start_controls_tab(
					'tab_menu_item_normal',
					array(
						'label' => __( 'Normal', 'uael' ),
					)
				);

					$this->add_control(
						'color_menu_item',
						array(
							'label'     => __( 'Text Color', 'uael' ),
							'type'      => Controls_Manager::COLOR,
							'scheme'    => array(
								'type'  => Scheme_Color::get_type(),
								'value' => Scheme_Color::COLOR_3,
							),
							'default'   => '',
							'selectors' => array(
								'{{WRAPPER}} .menu-item a.uael-menu-item, {{WRAPPER}} .sub-menu a.uael-sub-menu-item' => 'color: {{VALUE}}',
							),
						)
					);

					$this->add_control(
						'bg_color_menu_item',
						array(
							'label'     => __( 'Background Color', 'uael' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => array(
								'{{WRAPPER}} .menu-item a.uael-menu-item, {{WRAPPER}} .sub-menu, {{WRAPPER}} nav.uael-dropdown, {{WRAPPER}} .uael-dropdown-expandible' => 'background-color: {{VALUE}}',
							),
							'condition' => array(
								'layout!' => 'flyout',
							),
						)
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_menu_item_hover',
					array(
						'label' => __( 'Hover', 'uael' ),
					)
				);

					$this->add_control(
						'color_menu_item_hover',
						array(
							'label'     => __( 'Text Color', 'uael' ),
							'type'      => Controls_Manager::COLOR,
							'scheme'    => array(
								'type'  => Scheme_Color::get_type(),
								'value' => Scheme_Color::COLOR_4,
							),
							'selectors' => array(
								'{{WRAPPER}} .menu-item a.uael-menu-item:hover,
								{{WRAPPER}} .sub-menu a.uael-sub-menu-item:hover,
								{{WRAPPER}} .menu-item.current-menu-item a.uael-menu-item,
								{{WRAPPER}} .menu-item a.uael-menu-item.highlighted,
								{{WRAPPER}} .menu-item a.uael-menu-item:focus' => 'color: {{VALUE}}',
							),
						)
					);

					$this->add_control(
						'bg_color_menu_item_hover',
						array(
							'label'     => __( 'Background Color', 'uael' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => array(
								'{{WRAPPER}} .menu-item a.uael-menu-item:hover,
								{{WRAPPER}} .sub-menu a.uael-sub-menu-item:hover,
								{{WRAPPER}} .menu-item.current-menu-item a.uael-menu-item,
								{{WRAPPER}} .menu-item a.uael-menu-item.highlighted,
								{{WRAPPER}} .menu-item a.uael-menu-item:focus' => 'background-color: {{VALUE}}',
							),
							'condition' => array(
								'layout!' => 'flyout',
							),
						)
					);

					$this->add_control(
						'pointer_color_menu_item_hover',
						array(
							'label'     => __( 'Link Hover Effect Color', 'uael' ),
							'type'      => Controls_Manager::COLOR,
							'scheme'    => array(
								'type'  => Scheme_Color::get_type(),
								'value' => Scheme_Color::COLOR_4,
							),
							'default'   => '',
							'selectors' => array(
								'{{WRAPPER}} .uael-nav-menu-layout:not(.uael-pointer__framed) .menu-item.parent a.uael-menu-item:before,
								{{WRAPPER}} .uael-nav-menu-layout:not(.uael-pointer__framed) .menu-item.parent a.uael-menu-item:after' => 'background-color: {{VALUE}}',
								'{{WRAPPER}} .uael-nav-menu-layout:not(.uael-pointer__framed) .menu-item.parent .sub-menu .uael-has-submenu-container a:after' => 'background-color: unset',
								'{{WRAPPER}} .uael-pointer__framed .menu-item.parent a.uael-menu-item:before,
								{{WRAPPER}} .uael-pointer__framed .menu-item.parent a.uael-menu-item:after' => 'border-color: {{VALUE}}',
							),
							'condition' => array(
								'pointer!' => array( 'none', 'text' ),
								'layout!'  => 'flyout',
							),
						)
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_menu_item_active',
					array(
						'label'     => __( 'Active', 'uael' ),
						'condition' => array(
							'menu_type' => 'wordpress_menu',
						),
					)
				);

					$this->add_control(
						'color_menu_item_active',
						array(
							'label'     => __( 'Text Color', 'uael' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => array(
								'{{WRAPPER}} .menu-item.current-menu-item a.uael-menu-item,
								{{WRAPPER}} .menu-item.current-menu-ancestor a.uael-menu-item' => 'color: {{VALUE}}',
							),
						)
					);

					$this->add_control(
						'bg_color_menu_item_active',
						array(
							'label'     => __( 'Background Color', 'uael' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => array(
								'{{WRAPPER}} .menu-item.current-menu-item a.uael-menu-item,
								{{WRAPPER}} .menu-item.current-menu-ancestor a.uael-menu-item' => 'background-color: {{VALUE}}',
							),
							'condition' => array(
								'layout!' => 'flyout',
							),
						)
					);

					$this->add_control(
						'pointer_color_menu_item_active',
						array(
							'label'     => __( 'Link Hover Effect Color', 'uael' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => array(
								'{{WRAPPER}} .uael-nav-menu:not(.uael-pointer__framed) .menu-item.parent.current-menu-item a.uael-menu-item:before,
								{{WRAPPER}} .uael-nav-menu:not(.uael-pointer__framed) .menu-item.parent.current-menu-item a.uael-menu-item:after' => 'background-color: {{VALUE}}',
								'{{WRAPPER}} .uael-nav-menu:not(.uael-pointer__framed) .menu-item.parent .sub-menu .uael-has-submenu-container a.current-menu-item:after' => 'background-color: unset',
								'{{WRAPPER}} .uael-pointer__framed .menu-item.parent.current-menu-item a.uael-menu-item:before,
								{{WRAPPER}} .uael-pointer__framed .menu-item.parent.current-menu-item a.uael-menu-item:after' => 'border-color: {{VALUE}}',
							),
							'condition' => array(
								'pointer!' => array( 'none', 'text' ),
								'layout!'  => 'flyout',
							),
						)
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Register Nav Menu General Controls.
	 *
	 * @since 1.21.0
	 * @access protected
	 */
	protected function register_dropdown_content_controls() {

		$this->start_controls_section(
			'section_style_dropdown',
			array(
				'label' => __( 'Dropdown', 'uael' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

			$this->add_control(
				'dropdown_description',
				array(
					'raw'             => __( '<b>Note:</b> On desktop, below style options will apply to the submenu. On mobile, this will apply to the entire menu.', 'uael' ),
					'type'            => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-descriptor',
					'condition'       => array(
						'layout!' => array(
							'expandible',
							'flyout',
						),
					),
				)
			);

			$this->start_controls_tabs( 'tabs_dropdown_item_style' );

				$this->start_controls_tab(
					'tab_dropdown_item_normal',
					array(
						'label' => __( 'Normal', 'uael' ),
					)
				);

					$this->add_control(
						'color_dropdown_item',
						array(
							'label'     => __( 'Text Color', 'uael' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => array(
								'{{WRAPPER}} .sub-menu a.uael-sub-menu-item, 
								{{WRAPPER}} .elementor-menu-toggle,
								{{WRAPPER}} nav.uael-dropdown li a.uael-menu-item,
								{{WRAPPER}} nav.uael-dropdown li a.uael-sub-menu-item,
								{{WRAPPER}} nav.uael-dropdown-expandible li a.uael-menu-item,
								{{WRAPPER}} nav.uael-dropdown-expandible li a.uael-sub-menu-item' => 'color: {{VALUE}}',
							),
						)
					);

					$this->add_control(
						'background_color_dropdown_item',
						array(
							'label'     => __( 'Background Color', 'uael' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '#fff',
							'selectors' => array(
								'{{WRAPPER}} .sub-menu,
								{{WRAPPER}} nav.uael-dropdown,
								{{WRAPPER}} nav.uael-dropdown-expandible,
								{{WRAPPER}} nav.uael-dropdown .menu-item a.uael-menu-item,
								{{WRAPPER}} nav.uael-dropdown .menu-item a.uael-sub-menu-item' => 'background-color: {{VALUE}}',
							),
							'separator' => 'none',
						)
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_dropdown_item_hover',
					array(
						'label' => __( 'Hover', 'uael' ),
					)
				);

					$this->add_control(
						'color_dropdown_item_hover',
						array(
							'label'     => __( 'Text Color', 'uael' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => array(
								'{{WRAPPER}} .sub-menu a.uael-sub-menu-item:hover, 
								{{WRAPPER}} .elementor-menu-toggle:hover,
								{{WRAPPER}} nav.uael-dropdown li a.uael-menu-item:hover,
								{{WRAPPER}} nav.uael-dropdown li a.uael-sub-menu-item:hover,
								{{WRAPPER}} nav.uael-dropdown-expandible li a.uael-menu-item:hover,
								{{WRAPPER}} nav.uael-dropdown-expandible li a.uael-sub-menu-item:hover' => 'color: {{VALUE}}',
							),
						)
					);

					$this->add_control(
						'background_color_dropdown_item_hover',
						array(
							'label'     => __( 'Background Color', 'uael' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => array(
								'{{WRAPPER}} .sub-menu a.uael-sub-menu-item:hover,
								{{WRAPPER}} nav.uael-dropdown li a.uael-menu-item:hover,
								{{WRAPPER}} nav.uael-dropdown li a.uael-sub-menu-item:hover,
								{{WRAPPER}} nav.uael-dropdown-expandible li a.uael-menu-item:hover,
								{{WRAPPER}} nav.uael-dropdown-expandible li a.uael-sub-menu-item:hover' => 'background-color: {{VALUE}}',
							),
							'separator' => 'none',
						)
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_dropdown_item_active',
					array(
						'label'     => __( 'Active', 'uael' ),
						'condition' => array(
							'menu_type!' => 'custom',
						),
					)
				);

				$this->add_control(
					'color_dropdown_item_active',
					array(
						'label'     => __( 'Text Color', 'uael' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => array(
							'{{WRAPPER}} .sub-menu .menu-item.current-menu-item a.uael-sub-menu-item.uael-sub-menu-item-active,	
						{{WRAPPER}} nav.uael-dropdown .menu-item.current-menu-item a.uael-menu-item,
						{{WRAPPER}} nav.uael-dropdown .menu-item.current-menu-ancestor a.uael-menu-item,
						{{WRAPPER}} nav.uael-dropdown .sub-menu .menu-item.current-menu-item a.uael-sub-menu-item.uael-sub-menu-item-active' => 'color: {{VALUE}}',
						),
					)
				);

				$this->add_control(
					'background_color_dropdown_item_active',
					array(
						'label'     => __( 'Background Color', 'uael' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => array(
							'{{WRAPPER}} .sub-menu .menu-item.current-menu-item a.uael-sub-menu-item.uael-sub-menu-item-active,	
							{{WRAPPER}} nav.uael-dropdown .menu-item.current-menu-item a.uael-menu-item,
							{{WRAPPER}} nav.uael-dropdown .menu-item.current-menu-ancestor a.uael-menu-item,
							{{WRAPPER}} nav.uael-dropdown .sub-menu .menu-item.current-menu-item a.uael-sub-menu-item.uael-sub-menu-item-active' => 'background-color: {{VALUE}}',
						),
						'separator' => 'after',
					)
				);

				$this->end_controls_tabs();

			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				array(
					'name'      => 'dropdown_typography',
					'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
					'separator' => 'before',
					'exclude'   => array( 'line_height' ),
					'selector'  => '{{WRAPPER}} .sub-menu li a.uael-sub-menu-item,
							{{WRAPPER}} nav.uael-dropdown li a.uael-menu-item,
							{{WRAPPER}} nav.uael-dropdown li a.uael-sub-menu-item,
							{{WRAPPER}} nav.uael-dropdown-expandible li a.uael-menu-item',
					'{{WRAPPER}} nav.uael-dropdown-expandible li a.uael-sub-menu-item',

				)
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				array(
					'name'     => 'dropdown_border',
					'selector' => '{{WRAPPER}} nav.uael-nav-menu__layout-horizontal .sub-menu, 
							{{WRAPPER}} nav:not(.uael-nav-menu__layout-horizontal) .sub-menu.sub-menu-open,
							{{WRAPPER}} nav.uael-dropdown,
						 	{{WRAPPER}} nav.uael-dropdown-expandible',
				)
			);

			$this->add_responsive_control(
				'dropdown_border_radius',
				array(
					'label'      => __( 'Border Radius', 'uael' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => array( 'px', '%' ),
					'selectors'  => array(
						'{{WRAPPER}} .sub-menu'         => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .sub-menu li.menu-item:first-child' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}};overflow:hidden;',
						'{{WRAPPER}} .sub-menu li.menu-item:last-child' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};overflow:hidden',
						'{{WRAPPER}} nav.uael-dropdown' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} nav.uael-dropdown li.menu-item:first-child' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}};overflow:hidden',
						'{{WRAPPER}} nav.uael-dropdown li.menu-item:last-child' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};overflow:hidden',
						'{{WRAPPER}} nav.uael-dropdown-expandible' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} nav.uael-dropdown-expandible li.menu-item:first-child' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}};overflow:hidden',
						'{{WRAPPER}} nav.uael-dropdown-expandible li.menu-item:last-child' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};overflow:hidden',
					),
				)
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				array(
					'name'      => 'dropdown_box_shadow',
					'exclude'   => array(
						'box_shadow_position',
					),
					'selector'  => '{{WRAPPER}} .uael-nav-menu .sub-menu,
								{{WRAPPER}} nav.uael-dropdown,
						 		{{WRAPPER}} nav.uael-dropdown-expandible',
					'separator' => 'after',
				)
			);

			$this->add_responsive_control(
				'width_dropdown_item',
				array(
					'label'       => __( 'Dropdown Width (px)', 'uael' ),
					'type'        => Controls_Manager::SLIDER,
					'range'       => array(
						'px' => array(
							'min' => 0,
							'max' => 500,
						),
					),
					'default'     => array(
						'size' => '220',
						'unit' => 'px',
					),
					'selectors'   => array(
						'{{WRAPPER}} ul.sub-menu' => 'width: {{SIZE}}{{UNIT}}',
					),
					'condition'   => array(
						'layout' => 'horizontal',
					),
					'render_type' => 'template',
				)
			);

			$this->add_responsive_control(
				'padding_horizontal_dropdown_item',
				array(
					'label'       => __( 'Horizontal Padding', 'uael' ),
					'type'        => Controls_Manager::SLIDER,
					'size_units'  => array( 'px' ),
					'default'     => array(
						'size' => 15,
						'unit' => 'px',
					),
					'selectors'   => array(
						'{{WRAPPER}} .sub-menu li a.uael-sub-menu-item,
						{{WRAPPER}} nav.uael-dropdown li a.uael-menu-item,
						{{WRAPPER}} nav.uael-dropdown li a.uael-sub-menu-item,
						{{WRAPPER}} nav.uael-dropdown-expandible li a.uael-menu-item,
						{{WRAPPER}} nav.uael-dropdown-expandible li a.uael-sub-menu-item' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
					),
					'render_type' => 'template',
				)
			);

			$this->add_responsive_control(
				'padding_vertical_dropdown_item',
				array(
					'label'       => __( 'Vertical Padding', 'uael' ),
					'type'        => Controls_Manager::SLIDER,
					'size_units'  => array( 'px' ),
					'default'     => array(
						'size' => 15,
						'unit' => 'px',
					),
					'range'       => array(
						'px' => array(
							'max' => 50,
						),
					),
					'selectors'   => array(
						'{{WRAPPER}} .sub-menu a.uael-sub-menu-item,
						 {{WRAPPER}} nav.uael-dropdown li a.uael-menu-item,
						 {{WRAPPER}} nav.uael-dropdown li a.uael-sub-menu-item,
						 {{WRAPPER}} nav.uael-dropdown-expandible li a.uael-menu-item,
						 {{WRAPPER}} nav.uael-dropdown-expandible li a.uael-sub-menu-item' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
					),
					'render_type' => 'template',
				)
			);

			$this->add_responsive_control(
				'distance_from_menu',
				array(
					'label'       => __( 'Top Distance', 'uael' ),
					'type'        => Controls_Manager::SLIDER,
					'range'       => array(
						'px' => array(
							'min' => -100,
							'max' => 100,
						),
					),
					'selectors'   => array(
						'{{WRAPPER}} nav.uael-nav-menu__layout-horizontal ul.sub-menu, {{WRAPPER}} nav.uael-nav-menu__layout-expandible.menu-is-active,
						{{WRAPPER}} .uael-dropdown.menu-is-active' => 'margin-top: {{SIZE}}px;',
						'(tablet){{WRAPPER}}.uael-nav-menu__breakpoint-tablet nav.uael-nav-menu__layout-horizontal ul.sub-menu' => 'margin-top: 0px',
						'(mobile){{WRAPPER}}.uael-nav-menu__breakpoint-mobile nav.uael-nav-menu__layout-horizontal ul.sub-menu' => 'margin-top: 0px',
					),
					'condition'   => array(
						'layout' => array( 'horizontal', 'expandible' ),
					),
					'render_type' => 'template',
				)
			);

			$this->add_control(
				'heading_dropdown_divider',
				array(
					'label'     => __( 'Divider', 'uael' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				)
			);

			$this->add_control(
				'dropdown_divider_border',
				array(
					'label'       => __( 'Border Style', 'uael' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'solid',
					'label_block' => false,
					'options'     => array(
						'none'   => __( 'None', 'uael' ),
						'solid'  => __( 'Solid', 'uael' ),
						'double' => __( 'Double', 'uael' ),
						'dotted' => __( 'Dotted', 'uael' ),
						'dashed' => __( 'Dashed', 'uael' ),
					),
					'selectors'   => array(
						'{{WRAPPER}} .sub-menu li.menu-item:not(:last-child), 
						{{WRAPPER}} nav.uael-dropdown li.menu-item:not(:last-child),
						{{WRAPPER}} nav.uael-dropdown-expandible li.menu-item:not(:last-child)' => 'border-bottom-style: {{VALUE}};',
					),
				)
			);
			$this->add_control(
				'divider_border_color',
				array(
					'label'     => __( 'Border Color', 'uael' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#c4c4c4',
					'selectors' => array(
						'{{WRAPPER}} .sub-menu li.menu-item:not(:last-child), 
						{{WRAPPER}} nav.uael-dropdown li.menu-item:not(:last-child),
						{{WRAPPER}} nav.uael-dropdown-expandible li.menu-item:not(:last-child)' => 'border-bottom-color: {{VALUE}};',
					),
					'condition' => array(
						'dropdown_divider_border!' => 'none',
					),
				)
			);

			$this->add_control(
				'dropdown_divider_width',
				array(
					'label'     => __( 'Border Width', 'uael' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => array(
						'px' => array(
							'max' => 50,
						),
					),
					'default'   => array(
						'size' => '1',
						'unit' => 'px',
					),
					'selectors' => array(
						'{{WRAPPER}} .sub-menu li.menu-item:not(:last-child), 
						{{WRAPPER}} nav.uael-dropdown li.menu-item:not(:last-child),
						{{WRAPPER}} nav.uael-dropdown-expandible li.menu-item:not(:last-child)' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
					),
					'condition' => array(
						'dropdown_divider_border!' => 'none',
					),
				)
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_toggle',
			array(
				'label' => __( 'Menu Trigger & Close Icon', 'uael' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs( 'tabs_toggle_style' );

		$this->start_controls_tab(
			'toggle_style_normal',
			array(
				'label' => __( 'Normal', 'uael' ),
			)
		);

		$this->add_control(
			'toggle_color',
			array(
				'label'     => __( 'Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} div.uael-nav-menu-icon' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'toggle_background_color',
			array(
				'label'     => __( 'Background Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .uael-nav-menu-icon' => 'background-color: {{VALUE}}; padding: 0.35em;',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'toggle_hover',
			array(
				'label' => __( 'Hover', 'uael' ),
			)
		);

		$this->add_control(
			'toggle_hover_color',
			array(
				'label'     => __( 'Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} div.uael-nav-menu-icon:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'toggle_hover_background_color',
			array(
				'label'     => __( 'Background Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .uael-nav-menu-icon:hover' => 'background-color: {{VALUE}}; padding: 0.35em;',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'toggle_size',
			array(
				'label'     => __( 'Icon Size', 'uael' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 15,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .uael-nav-menu-icon' => 'font-size: {{SIZE}}{{UNIT}}',
				),
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'toggle_border_width',
			array(
				'label'     => __( 'Border Width', 'uael' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 10,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .uael-nav-menu-icon' => 'border-width: {{SIZE}}{{UNIT}}; padding: 0.35em;',
				),
			)
		);

		$this->add_responsive_control(
			'toggle_border_radius',
			array(
				'label'      => __( 'Border Radius', 'uael' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .uael-nav-menu-icon' => 'border-radius: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_control(
			'close_color_flyout',
			array(
				'label'     => __( 'Close Icon Color', 'uael' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#7A7A7A',
				'selectors' => array(
					'{{WRAPPER}} .uael-flyout-close' => 'color: {{VALUE}}',
				),
				'condition' => array(
					'layout' => 'flyout',
				),
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'close_flyout_size',
			array(
				'label'     => __( 'Close Icon Size', 'uael' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 15,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .uael-flyout-close' => 'height: {{SIZE}}px; width: {{SIZE}}px; font-size: {{SIZE}}px; line-height: {{SIZE}}px;',
				),
				'condition' => array(
					'layout' => 'flyout',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register Nav Menu docs link.
	 *
	 * @since 1.21.0
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
						'raw'             => sprintf( __( '%1$s Getting started article » %2$s', 'uael' ), '<a href="https://uaelementor.com/docs/navigation-menu/?utm_source=uael-pro-dashboard&utm_medium=uael-editor-screen&utm_campaign=uael-pro-plugin" target="_blank" rel="noopener">', '</a>' ),
						'content_classes' => 'uael-editor-doc',
					)
				);

				$this->add_control(
					'help_doc_2',
					array(
						'type'            => Controls_Manager::RAW_HTML,
						/* translators: %1$s doc link */
						'raw'             => sprintf( __( '%1$s How to design a custom menu? » %2$s', 'uael' ), '<a href="https://uaelementor.com/docs/design-custom-menu-using-navigation-menu/?utm_source=uael-pro-dashboard&utm_medium=uael-editor-screen&utm_campaign=uael-pro-plugin" target="_blank" rel="noopener">', '</a>' ),
						'content_classes' => 'uael-editor-doc',
					)
				);

				$this->add_control(
					'help_doc_3',
					array(
						'type'            => Controls_Manager::RAW_HTML,
						/* translators: %1$s doc link */
						'raw'             => sprintf( __( '%1$s Types of dropdown width and position options » %2$s', 'uael' ), '<a href="https://uaelementor.com/docs/dropdown-width-and-position/?utm_source=uael-pro-dashboard&utm_medium=uael-editor-screen&utm_campaign=uael-pro-plugin" target="_blank" rel="noopener">', '</a>' ),
						'content_classes' => 'uael-editor-doc',
					)
				);

			$this->end_controls_section();
		}
	}

	/**
	 * Render content type list.
	 *
	 * @since 1.21.0
	 * @return array Array of content type
	 * @access public
	 */
	public function get_content_type() {

		$content_type = array(
			'sub_menu'   => __( 'Text', 'uael' ),
			'saved_rows' => __( 'Saved Section', 'uael' ),
		);

		if ( defined( 'ELEMENTOR_PRO_VERSION' ) ) {
			$content_type['saved_modules'] = __( 'Saved Widget', 'uael' );
		}

		return $content_type;
	}

	/**
	 * Render custom style.
	 *
	 * @since 1.21.0
	 * @access public
	 */
	public function get_custom_style() {
		$settings = $this->get_settings_for_display();
		$i        = 0;
		$output   = ' ';
		$in_if    = false;

		$this->add_render_attribute(
			'uael-nav-menu-custom',
			'class',
			'uael-nav-menu uael-nav-menu-custom uael-custom-wrapper'
		);

		?>
		<nav <?php echo wp_kses_post( $this->get_render_attribute_string( 'uael-nav-menu' ) ); ?>>
			<?php
			$output      .= '<ul ' . $this->get_render_attribute_string( 'uael-nav-menu-custom' ) . '>';
				$i        = 0;
				$is_child = false;
			foreach ( $settings['menu_items'] as $menu => $item ) {
				$repeater_sub_menu_item = $this->get_repeater_setting_key( 'text', 'menu_items', $menu );
				$repeater_link          = $this->get_repeater_setting_key( 'link', 'menu_items', $menu );

				if ( ! empty( $item['link']['url'] ) ) {

					$this->add_render_attribute( $repeater_link, 'href', $item['link']['url'] );
					if ( $item['link']['is_external'] ) {

						$this->add_render_attribute( $repeater_link, 'target', '_blank' );
					}
					if ( $item['link']['nofollow'] ) {

						$this->add_render_attribute( $repeater_link, 'rel', 'nofollow' );
					}
				}

				if ( 'item_submenu' === $item['item_type'] ) {
					if ( false === $is_child ) {
						$output .= "<ul class='sub-menu parent-do-not-have-template'>";
					}
					if ( 'sub_menu' === $item['menu_content_type'] ) {

							$this->add_render_attribute(
								'menu-sub-item' . $item['_id'],
								'class',
								'menu-item child menu-item-has-children elementor-repeater elementor-repeater-item-' . $item['_id']
							);

							$output .= '<li ' . $this->get_render_attribute_string( 'menu-sub-item' . $item['_id'] ) . '>';
							$output .= '<a ' . $this->get_render_attribute_string( $repeater_link ) . "class='uael-sub-menu-item'>" . $this->get_render_attribute_string( $repeater_sub_menu_item ) . $item['text'] . '</a>';
							$output .= '</li>';
					} else {
							$this->add_render_attribute(
								'menu-content-item' . $item['_id'],
								'class',
								'menu-item saved-content child elementor-repeater elementor-repeater-item-' . $item['_id']
							);

							$output .= '<div ' . $this->get_render_attribute_string( 'menu-content-item' . $item['_id'] ) . '>';

						if ( 'saved_rows' === $item['menu_content_type'] ) {
							$saved_section_shortcode = \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $item['content_saved_rows'] );
							$output                 .= do_shortcode( $saved_section_shortcode );
						} elseif ( 'saved_modules' === $item['menu_content_type'] ) {
							$saved_widget_shortcode = \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $item['content_saved_widgets'] );
							$output                .= do_shortcode( $saved_widget_shortcode );
						}
							$output .= '</div>';
					}

					$is_child = true;
					$in_if    = true;
				} else {

						$this->add_render_attribute( 'menu-item' . $item['_id'], 'class', 'menu-item menu-item-has-children parent parent-has-no-child elementor-repeater-item-' . $item['_id'] );
						$this->add_render_attribute( 'menu-item' . $item['_id'], 'data-dropdown-width', $item['dropdown_width'] );
						$this->add_render_attribute( 'menu-item' . $item['_id'], 'data-dropdown-pos', $item['dropdown_position'] );

						$is_child = false;
					if ( true === $in_if ) {

						$in_if   = false;
						$output .= '</ul></li>';
					}

						$i++;
						$repeater_main_link = $this->get_repeater_setting_key( 'link', 'menu_items', $menu );

					if ( ! empty( $item['link']['url'] ) && $i === $i++ ) {

						$this->add_render_attribute( $repeater_main_link, 'href', $item['link']['url'] );
						if ( $item['link']['is_external'] ) {

							$this->add_render_attribute( $repeater_main_link, 'target', '_blank' );
						}
						if ( $item['link']['nofollow'] ) {

							$this->add_render_attribute( $repeater_main_link, 'rel', 'nofollow' );
						}
					}

						$output .= '<li ' . $this->get_render_attribute_string( 'menu-item' . $item['_id'] ) . '>';

					if ( array_key_exists( $menu + 1, $settings['menu_items'] ) ) {
						if ( 'item_submenu' === $settings['menu_items'][ $menu + 1 ]['item_type'] ) {
							$output .= "<div class='uael-has-submenu-container'>";
						}
					}

							$output .= '<a ' . $this->get_render_attribute_string( $repeater_main_link ) . "class='uael-menu-item'>";

								$output .= $this->get_render_attribute_string( $repeater_sub_menu_item ) . $item['text'];
								$output .= "<span class='uael-menu-toggle sub-arrow parent-item'><i class='fa'></i></span>";
							$output     .= '</a>';
					if ( array_key_exists( $menu + 1, $settings['menu_items'] ) ) {
						if ( 'item_submenu' === $settings['menu_items'][ $menu + 1 ]['item_type'] ) {
							$output .= '</div>';
						}
					}
				}
			}
			$output .= '</ul>';

			echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			?>
		</nav>
		<?php
	}

	/**
	 * Render Nav Menu output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.21.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		if ( 'wordpress_menu' === $settings['menu_type'] ) {
			$args = array(
				'echo'        => false,
				'menu'        => $settings['menu'],
				'menu_class'  => 'uael-nav-menu',
				'menu_id'     => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
				'fallback_cb' => '__return_empty_string',
				'container'   => '',
				'walker'      => new Menu_Walker(),
			);

			$menu_html = wp_nav_menu( $args );
		}

		if ( 'flyout' === $settings['layout'] ) {

			if ( 'flyout' === $settings['layout'] ) {

				$this->add_render_attribute( 'uael-flyout', 'class', 'uael-flyout-wrapper' );
			}
			?>
			<div class="uael-nav-menu__toggle elementor-clickable uael-flyout-trigger" tabindex="0">
					<div class="uael-nav-menu-icon">
						<?php if ( UAEL_Helper::is_elementor_updated() ) { ?>
							<i class="<?php echo esc_attr( $settings['dropdown_icon']['value'] ); ?>" aria-hidden="true" tabindex="0"></i>
						<?php } else { ?>
							<i class="<?php echo esc_attr( $settings['dropdown_icon'] ); ?>" aria-hidden="true" tabindex="0"></i>
						<?php } ?>
					</div>
				</div>
		<div <?php echo wp_kses_post( $this->get_render_attribute_string( 'uael-flyout' ) ); ?> >
			<div class="uael-flyout-overlay elementor-clickable"></div>
			<div class="uael-flyout-container">
				<div id="uael-flyout-content-id-<?php echo esc_attr( $this->get_id() ); ?>" class="uael-side uael-flyout-<?php echo esc_attr( $settings['flyout_layout'] ); ?> uael-flyout-open" data-width="<?php echo esc_attr( $settings['width_flyout_menu_item']['size'] ); ?>" data-layout="<?php echo wp_kses_post( $settings['flyout_layout'] ); ?>" data-flyout-type="<?php echo wp_kses_post( $settings['flyout_type'] ); ?>">
					<div class="uael-flyout-content push">
						<?php if ( 'wordpress_menu' === $settings['menu_type'] ) { ?>
							<nav <?php echo wp_kses_post( $this->get_render_attribute_string( 'uael-nav-menu' ) ); ?>><?php echo $menu_html; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></nav>
							<?php
						} else {
							$this->get_custom_style();
						}
						?>
						<div class="elementor-clickable uael-flyout-close" tabindex="0">
							<?php if ( UAEL_Helper::is_elementor_updated() ) { ?>
								<i class="<?php echo esc_attr( $settings['dropdown_close_icon']['value'] ); ?>" aria-hidden="true"></i>
							<?php } else { ?>
								<i class="<?php echo esc_attr( $settings['dropdown_close_icon'] ); ?>" aria-hidden="true"></i>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>				
			<?php
		} else {
			$this->add_render_attribute(
				'uael-main-menu',
				'class',
				array(
					'uael-nav-menu',
					'uael-layout-' . $settings['layout'],
				)
			);

			$this->add_render_attribute( 'uael-main-menu', 'class', 'uael-nav-menu-layout' );

			$this->add_render_attribute( 'uael-main-menu', 'class', $settings['layout'] );

			$this->add_render_attribute( 'uael-main-menu', 'data-layout', $settings['layout'] );

			if ( $settings['pointer'] ) {

				if ( 'horizontal' === $settings['layout'] || 'vertical' === $settings['layout'] ) {
					$this->add_render_attribute( 'uael-main-menu', 'class', 'uael-pointer__' . $settings['pointer'] );

					if ( in_array( $settings['pointer'], array( 'double-line', 'underline', 'overline' ), true ) ) {

						$key = 'animation_line';
						$this->add_render_attribute( 'uael-main-menu', 'class', 'uael-animation__' . $settings[ $key ] );
					} elseif ( 'framed' === $settings['pointer'] || 'text' === $settings['pointer'] ) {

						$key = 'animation_' . $settings['pointer'];
						$this->add_render_attribute( 'uael-main-menu', 'class', 'uael-animation__' . $settings[ $key ] );
					}
				}
			}

			if ( 'expandible' === $settings['layout'] ) {

				$this->add_render_attribute( 'uael-nav-menu', 'class', 'uael-dropdown-expandible' );
			}

			$this->add_render_attribute(
				'uael-nav-menu',
				'class',
				array(
					'uael-nav-menu__layout-' . $settings['layout'],
					'uael-nav-menu__submenu-' . $settings['submenu_icon'],
				)
			);

			$this->add_render_attribute( 'uael-nav-menu', 'data-toggle-icon', $settings['dropdown_icon'] );

			$this->add_render_attribute( 'uael-nav-menu', 'data-close-icon', $settings['dropdown_close_icon'] );

			$this->add_render_attribute( 'uael-nav-menu', 'data-full-width', $settings['full_width_dropdown'] );

			?>
		<div <?php echo wp_kses_post( $this->get_render_attribute_string( 'uael-main-menu' ) ); ?>>
				<div class="uael-nav-menu__toggle elementor-clickable">
					<div class="uael-nav-menu-icon">
						<?php if ( UAEL_Helper::is_elementor_updated() ) { ?>
							<i class="<?php echo esc_attr( $settings['dropdown_icon']['value'] ); ?>" aria-hidden="true" tabindex="0"></i>
						<?php } else { ?>
							<i class="<?php echo esc_attr( $settings['dropdown_icon'] ); ?>" aria-hidden="true" tabindex="0"></i>
						<?php } ?>
					</div>
				</div>
			<?php if ( 'wordpress_menu' === $settings['menu_type'] ) { ?>
				<nav <?php echo wp_kses_post( $this->get_render_attribute_string( 'uael-nav-menu' ) ); ?>><?php echo $menu_html; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></nav>
			<?php } else { ?>
					<?php $this->get_custom_style(); ?>
			<?php } ?>			
		</div>
			<?php
		}
	}
}

