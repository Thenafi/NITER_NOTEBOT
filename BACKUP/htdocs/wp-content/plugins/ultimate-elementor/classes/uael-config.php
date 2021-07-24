<?php
/**
 * UAEL Config.
 *
 * @package UAEL
 */

namespace UltimateElementor\Classes;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use UltimateElementor\Classes\UAEL_Helper;

/**
 * Class UAEL_Config.
 */
class UAEL_Config {


	/**
	 * Widget List
	 *
	 * @var widget_list
	 */
	public static $widget_list = null;

	/**
	 * Post skins List
	 *
	 * @var post_skins_list
	 */
	public static $post_skins_list = null;

	/**
	 * Get Widget List.
	 *
	 * @since 0.0.1
	 *
	 * @return array The Widget List.
	 */
	public static function get_widget_list() {
		if ( null === self::$widget_list ) {
			$options_url       = admin_url( 'options-general.php' );
			$integration_url   = add_query_arg(
				array(
					'page'   => UAEL_SLUG,
					'action' => 'integration',
				),
				$options_url
			);
			$post_url          = add_query_arg(
				array(
					'page'   => UAEL_SLUG,
					'action' => 'post',
				),
				$options_url
			);
			self::$widget_list = array(
				'Advanced_Heading'  => array(
					'slug'      => 'uael-advanced-heading',
					'title'     => __( 'Advanced Heading', 'uael' ),
					'keywords'  => array( 'uael', 'heading', 'advanced' ),
					'icon'      => 'uael-icon-adv-heading',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/advanced-heading/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'BaSlider'          => array(
					'slug'      => 'uael-ba-slider',
					'title'     => __( 'Before After Slider', 'uael' ),
					'keywords'  => array( 'uael', 'slider', 'before', 'after' ),
					'icon'      => 'uael-icon-before-after',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/before-after-slider/?utm_source=uael-pro-dashboard&utm_medium=uael-editor-screen&utm_campaign=uael-pro-plugin',
				),
				'Business_Hours'    => array(
					'slug'      => 'uael-business-hours',
					'title'     => __( 'Business Hours', 'uael' ),
					'keywords'  => array( 'uael', 'business', 'hours', 'schedule' ),
					'icon'      => 'uael-icon-business-hours',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/business-hours/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'CfStyler'          => array(
					'slug'      => 'uael-cf7-styler',
					'title'     => __( 'Contact Form 7 Styler', 'uael' ),
					'keywords'  => array( 'uael', 'form', 'cf7', 'contact', 'styler' ),
					'icon'      => 'uael-icon-cf7-form',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/contact-form-7-styler/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'ContentToggle'     => array(
					'slug'      => 'uael-content-toggle',
					'title'     => __( 'Content Toggle', 'uael' ),
					'keywords'  => array( 'uael', 'toggle', 'content', 'show', 'hide' ),
					'icon'      => 'uael-icon-content-toggle',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/content-toggle/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'Dual_Heading'      => array(
					'slug'      => 'uael-dual-color-heading',
					'title'     => __( 'Dual Color Heading', 'uael' ),
					'keywords'  => array( 'uael', 'dual', 'heading', 'color' ),
					'icon'      => 'uael-icon-dual-col',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/dual-color-heading/?utm_source=uael-pro-dashboard&utm_medium=uael-editor-screen&utm_campaign=uael-pro-plugin',
				),
				'Fancy_Heading'     => array(
					'slug'      => 'uael-fancy-heading',
					'title'     => __( 'Fancy Heading', 'uael' ),
					'keywords'  => array( 'uael', 'fancy', 'heading', 'ticking', 'animate' ),
					'icon'      => 'uael-icon-fancy-text',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/fancy-heading/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'GoogleMap'         => array(
					'slug'         => 'uael-google-map',
					'title'        => __( 'Google Map', 'uael' ),
					'keywords'     => array( 'uael', 'google', 'map', 'location', 'address' ),
					'icon'         => 'uael-icon-google-map',
					'title_url'    => '#',
					'default'      => true,
					'setting_url'  => $integration_url,
					'setting_text' => __( 'Settings', 'uael' ),
					'doc_url'      => 'https://uaelementor.com/docs-category/widgets/google-maps/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'GfStyler'          => array(
					'slug'      => 'uael-gf-styler',
					'title'     => __( 'Gravity Form Styler', 'uael' ),
					'keywords'  => array( 'uael', 'form', 'gravity', 'gf', 'styler' ),
					'icon'      => 'uael-icon-gravity-form',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/gravity-form-styler/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'Image_Gallery'     => array(
					'slug'      => 'uael-image-gallery',
					'title'     => __( 'Image Gallery', 'uael' ),
					'keywords'  => array( 'uael', 'image', 'gallery', 'carousel', 'slider', 'layout' ),
					'icon'      => 'uael-icon-img-gallery',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/image-gallery/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'Retina_Image'      => array(
					'slug'      => 'uael-retina-image',
					'title'     => __( 'Retina Image', 'uael' ),
					'keywords'  => array( 'uael', 'retina', 'image', '2ximage' ),
					'icon'      => 'uael-icon-retina-image-1',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/retina-image/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'Infobox'           => array(
					'slug'      => 'uael-infobox',
					'title'     => __( 'Info Box', 'uael' ),
					'keywords'  => array( 'uael', 'info', 'box', 'bar' ),
					'icon'      => 'uael-icon-info-box',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/info-box/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'Modal_Popup'       => array(
					'slug'      => 'uael-modal-popup',
					'title'     => __( 'Modal Popup', 'uael' ),
					'keywords'  => array( 'uael', 'modal', 'popup', 'lighbox' ),
					'icon'      => 'uael-icon-popup',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/modal-popup/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'CafStyler'         => array(
					'slug'      => 'uael-caf-styler',
					'title'     => __( 'Caldera Form Styler', 'uael' ),
					'keywords'  => array( 'uael', 'caldera', 'form', 'styler' ),
					'icon'      => 'uael-icon-caldera-form',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/caldera-form-styler/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'Buttons'           => array(
					'slug'      => 'uael-buttons',
					'title'     => __( 'Multi Buttons', 'uael' ),
					'keywords'  => array( 'uael', 'buttons', 'multi', 'call to action', 'cta' ),
					'icon'      => 'uael-icon-button',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/multi-buttons/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'Price_Table'       => array(
					'slug'      => 'uael-price-table',
					'title'     => __( 'Price Box', 'uael' ),
					'keywords'  => array( 'uael', 'price', 'table', 'box', 'pricing' ),
					'icon'      => 'uael-icon-price-table',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/price-box/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'Price_List'        => array(
					'slug'      => 'uael-price-list',
					'title'     => __( 'Price List', 'uael' ),
					'keywords'  => array( 'uael', 'price', 'list', 'pricing' ),
					'icon'      => 'uael-icon-price-list',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/price-list/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'Table'             => array(
					'slug'      => 'uael-table',
					'title'     => __( 'Table', 'uael' ),
					'keywords'  => array( 'uael', 'table', 'sort', 'search' ),
					'icon'      => 'uael-icon-table',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/table/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'Table_of_Contents' => array(
					'slug'      => 'uael-table-of-contents',
					'title'     => __( 'Table of Contents', 'uael' ),
					'keywords'  => array( 'uael', 'table of contents', 'content', 'list', 'toc', 'index' ),
					'icon'      => 'uael-icon-toc-2',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/table-of-contents/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'Woo_Add_To_Cart'   => array(
					'slug'      => 'uael-woo-add-to-cart',
					'title'     => __( 'Woo - Add To Cart', 'uael' ),
					'keywords'  => array( 'uael', 'woo', 'cart', 'add to cart', 'products' ),
					'icon'      => 'uael-icon-woo-cart',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/woo-add-to-cart/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'Woo_Categories'    => array(
					'slug'      => 'uael-woo-categories',
					'title'     => __( 'Woo - Categories', 'uael' ),
					'keywords'  => array( 'uael', 'woo', 'categories', 'taxomonies', 'products' ),
					'icon'      => 'uael-icon-woo-cat',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/woo-categories/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'Woo_Products'      => array(
					'slug'      => 'uael-woo-products',
					'title'     => __( 'Woo - Products', 'uael' ),
					'keywords'  => array( 'uael', 'woo', 'products' ),
					'icon'      => 'uael-icon-woo-grid',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/woo-products/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'Hotspot'           => array(
					'slug'      => 'uael-hotspot',
					'title'     => __( 'Hotspot', 'uael' ),
					'keywords'  => array( 'uael', 'hotspot', 'tour' ),
					'icon'      => 'uael-icon-hotspot',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/hotspot/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'Posts'             => array(
					'slug'         => 'uael-posts',
					'title'        => __( 'Posts', 'uael' ),
					'keywords'     => array( 'uael', 'post', 'grid', 'masonry', 'carousel', 'content grid', 'content' ),
					'icon'         => 'uael-icon-post-grid',
					'title_url'    => '#',
					'default'      => true,
					'setting_url'  => $post_url,
					'setting_text' => __( 'Settings', 'uael' ),
					'doc_url'      => 'https://uaelementor.com/docs-category/widgets/posts/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'Timeline'          => array(
					'slug'      => 'uael-timeline',
					'title'     => __( 'Timeline', 'uael' ),
					'keywords'  => array( 'uael', 'timeline', 'history', 'scroll', 'post', 'content timeline' ),
					'icon'      => 'uael-icon-timeline',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/timeline/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'Video_Gallery'     => array(
					'slug'      => 'uael-video-gallery',
					'title'     => __( 'Video Gallery', 'uael' ),
					'keywords'  => array( 'uael', 'video', 'youtube', 'wistia', 'gallery', 'vimeo' ),
					'icon'      => 'uael-icon-video-gallery',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/video-gallery/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'Video'             => array(
					'slug'      => 'uael-video',
					'title'     => __( 'Video', 'uael' ),
					'keywords'  => array( 'uael', 'video', 'youtube', 'vimeo', 'wistia', 'sticky', 'drag', 'float', 'subscribe' ),
					'icon'      => 'uael-icon-video',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/video/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'WpfStyler'         => array(
					'slug'      => 'uael-wpf-styler',
					'title'     => __( 'WPForms Styler', 'uael' ),
					'keywords'  => array( 'uael', 'form', 'wp', 'wpform', 'styler' ),
					'icon'      => 'uael-icon-cf7-form',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/wpforms-styler/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'Countdown'         => array(
					'slug'      => 'uael-countdown',
					'title'     => __( 'Countdown Timer', 'uael' ),
					'keywords'  => array( 'uael', 'count', 'timer', 'countdown' ),
					'icon'      => 'uael-icon-timer',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/countdown-timer/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'Business_Reviews'  => array(
					'slug'         => 'uael-business-reviews',
					'keywords'     => array( 'uael', 'reviews', 'wp reviews', 'business', 'wp business', 'google', 'rating', 'social', 'yelp' ),
					'title'        => __( 'Business Reviews', 'uael' ),
					'icon'         => 'uael-icon-business-reviews',
					'title_url'    => '#',
					'default'      => true,
					'doc_url'      => 'https://uaelementor.com/docs-category/widgets/business-reviews/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
					'setting_url'  => $integration_url,
					'setting_text' => __( 'Settings', 'uael' ),
				),
				'Offcanvas'         => array(
					'slug'      => 'uael-offcanvas',
					'title'     => __( 'Off - Canvas', 'uael' ),
					'keywords'  => array( 'uael', 'off', 'offcanvas', 'off-canvas', 'canvas', 'template', 'floating' ),
					'icon'      => 'uael-icon-off-canvas',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/off-canvas/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'Marketing_Button'  => array(
					'slug'      => 'uael-marketing-button',
					'title'     => __( 'Marketing Button', 'uael' ),
					'keywords'  => array( 'uael', 'button', 'marketing', 'call to action', 'cta' ),
					'icon'      => 'uael-icon-marketing-button',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/marketing-button/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'Team_Member'       => array(
					'slug'      => 'uael-team-member',
					'title'     => __( 'Team Member', 'uael' ),
					'keywords'  => array( 'uael', 'team', 'member' ),
					'icon'      => 'uael-icon-team-member',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/team-member/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'Particles'         => array(
					'slug'      => 'uael-particles',
					'title'     => __( 'Particle Backgrounds', 'uael' ),
					'keywords'  => array(),
					'icon'      => '',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/particles-background-extension/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'RegistrationForm'  => array(
					'slug'         => 'uael-registration-form',
					'title'        => __( 'User Registration Form', 'uael' ),
					'keywords'     => array( 'uael', 'form', 'register', 'registration', 'user' ),
					'icon'         => 'uael-icon-registration-form',
					'title_url'    => '#',
					'default'      => true,
					'setting_url'  => $integration_url,
					'setting_text' => __( 'Settings', 'uael' ),
					'doc_url'      => 'https://uaelementor.com/docs-category/widgets/user-registration-form/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'Nav_Menu'          => array(
					'slug'      => 'uael-nav-menu',
					'title'     => __( 'Navigation Menu', 'uael' ),
					'keywords'  => array( 'uael', 'menu', 'nav', 'navigation', 'mega' ),
					'icon'      => 'uael-icon-navigation-menu-4',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/navigation-menu/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'LoginForm'         => array(
					'slug'         => 'uael-login-form',
					'title'        => __( 'Login Form', 'uael' ),
					'keywords'     => array( 'uael', 'form', 'login', 'facebook', 'google', 'user', 'fblogin' ),
					'icon'         => 'uael-icon-uae-login-form-01',
					'title_url'    => '#',
					'default'      => true,
					'setting_text' => __( 'Settings', 'uael' ),
					'setting_url'  => $integration_url,
					'doc_url'      => 'https://uaelementor.com/docs-category/widgets/login-form/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'HowTo'             => array(
					'slug'      => 'uael-how-to',
					'title'     => __( 'How-to Schema', 'uael' ),
					'keywords'  => array( 'uael', 'how-to', 'howto', 'schema', 'steps', 'supply', 'tools', 'steps', 'cost' ),
					'icon'      => 'uael-icon-how-to-schema',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/how-to-schema/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'FAQ'               => array(
					'slug'      => 'uael-faq',
					'title'     => __( 'FAQ', 'uael' ),
					'keywords'  => array( 'uael', 'faq', 'schema', 'question', 'answer', 'accordion', 'toggle' ),
					'icon'      => 'uael-icon-faq-2',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/widgets/faq/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
				'Cross_Domain'      => array(
					'slug'      => 'uael-cross-domain-copy-paste',
					'title'     => __( 'Cross-Site Copy Paste', 'uael' ),
					'keywords'  => array(),
					'icon'      => '',
					'title_url' => '#',
					'default'   => true,
					'doc_url'   => 'https://uaelementor.com/docs-category/features/cross-site-copy-paste/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
				),
			);
		}

		return self::$widget_list;
	}

	/**
	 * Get Post skins.
	 *
	 * @since 1.21.0
	 *
	 * @return array Post skins.
	 */
	public static function get_post_skin_list() {

		if ( null === self::$post_skins_list ) {
			self::$post_skins_list = array(
				'Skin_Card'     => array(
					'slug'    => 'uael-skin-card',
					'title'   => __( 'Card Skin', 'uael' ),
					'default' => true,
					'image'   => UAEL_URL . 'assets/img/uae-post-skin-card.png',
				),
				'Skin_Feed'     => array(
					'slug'    => 'uael-skin-feed',
					'title'   => __( 'Creative Feed Skin', 'uael' ),
					'default' => true,
					'image'   => UAEL_URL . 'assets/img/uae-post-skin-feed.png',
				),
				'Skin_News'     => array(
					'slug'    => 'uael-skin-news',
					'title'   => __( 'News Skin', 'uael' ),
					'default' => true,
					'image'   => UAEL_URL . 'assets/img/uae-post-skin-news.png',
				),
				'Skin_Business' => array(
					'slug'    => 'uael-skin-business',
					'title'   => __( 'Business Skin', 'uael' ),
					'default' => true,
					'image'   => UAEL_URL . 'assets/img/uae-post-skin-business.png',
				),
			);
		}

		return self::$post_skins_list;
	}

	/**
	 * Returns Script array.
	 *
	 * @return array()
	 * @since 0.0.1
	 */
	public static function get_widget_script() {
		$folder = UAEL_Helper::get_js_folder();
		$suffix = UAEL_Helper::get_js_suffix();

		$js_files = array(
			'uael-frontend-script'   => array(
				'path'      => 'assets/' . $folder . '/uael-frontend' . $suffix . '.js',
				'dep'       => array( 'jquery' ),
				'in_footer' => true,
			),
			'uael-cookie-lib'        => array(
				'path'      => 'assets/' . $folder . '/js_cookie' . $suffix . '.js',
				'dep'       => array( 'jquery' ),
				'in_footer' => true,
			),
			'uael-modal-popup'       => array(
				'path'      => 'assets/' . $folder . '/uael-modal-popup' . $suffix . '.js',
				'dep'       => array( 'jquery', 'uael-cookie-lib' ),
				'in_footer' => true,
			),
			'uael-offcanvas'         => array(
				'path'      => 'assets/' . $folder . '/uael-offcanvas' . $suffix . '.js',
				'dep'       => array( 'jquery' ),
				'in_footer' => true,
			),
			'uael-twenty-twenty'     => array(
				'path'      => 'assets/' . $folder . '/jquery_twentytwenty' . $suffix . '.js',
				'dep'       => array( 'jquery' ),
				'in_footer' => true,
			),
			'uael-move'              => array(
				'path'      => 'assets/' . $folder . '/jquery_event_move' . $suffix . '.js',
				'dep'       => array( 'jquery' ),
				'in_footer' => true,
			),
			'uael-fancytext-typed'   => array(
				'path'      => 'assets/' . $folder . '/typed' . $suffix . '.js',
				'dep'       => array( 'jquery' ),
				'in_footer' => true,
			),
			'uael-fancytext-slidev'  => array(
				'path'      => 'assets/' . $folder . '/rvticker' . $suffix . '.js',
				'dep'       => array( 'jquery' ),
				'in_footer' => true,
			),
			'uael-google-maps'       => array(
				'path'      => 'assets/' . $folder . '/uael-google-map' . $suffix . '.js',
				'dep'       => array( 'jquery' ),
				'in_footer' => true,
			),
			'uael-hotspot'           => array(
				'path'      => 'assets/' . $folder . '/tooltipster' . $suffix . '.js',
				'dep'       => array( 'jquery' ),
				'in_footer' => true,
			),
			'uael-posts'             => array(
				'path'      => 'assets/' . $folder . '/uael-posts' . $suffix . '.js',
				'dep'       => array( 'jquery', 'imagesloaded' ),
				'in_footer' => true,
			),
			'uael-business-reviews'  => array(
				'path'      => 'assets/' . $folder . '/uael-business-reviews' . $suffix . '.js',
				'dep'       => array( 'jquery', 'imagesloaded' ),
				'in_footer' => true,
			),
			'uael-isotope'           => array(
				'path'      => 'assets/js/isotope.pkgd.js',
				'dep'       => array( 'jquery' ),
				'in_footer' => true,
			),
			'uael-woocommerce'       => array(
				'path'      => 'assets/' . $folder . '/uael-woocommerce' . $suffix . '.js',
				'dep'       => array( 'jquery' ),
				'in_footer' => true,
			),
			'uael-datatable'         => array(
				'path'      => 'assets/js/jquery.datatables.min.js',
				'dep'       => array( 'jquery' ),
				'in_footer' => true,
			),
			'uael-table'             => array(
				'path'      => 'assets/' . $folder . '/uael-table' . $suffix . '.js',
				'dep'       => array( 'jquery' ),
				'in_footer' => true,
			),
			'uael-table-of-contents' => array(
				'path'      => 'assets/' . $folder . '/uael-table-of-contents' . $suffix . '.js',
				'dep'       => array( 'jquery' ),
				'in_footer' => true,
			),
			'uael-particles'         => array(
				'path'      => 'assets/' . $folder . '/uael-particles' . $suffix . '.js',
				'dep'       => array( 'jquery' ),
				'in_footer' => true,
			),
			'uael-registration'      => array(
				'path'      => 'assets/' . $folder . '/uael-registration' . $suffix . '.js',
				'dep'       => array( 'jquery' ),
				'in_footer' => true,
			),
			/* Libraries */
			'uael-element-resize'    => array(
				'path'      => 'assets/lib/jquery-element-resize/jquery_resize.min.js',
				'dep'       => array( 'jquery' ),
				'in_footer' => true,
			),
			'uael-isotope'           => array(
				'path'      => 'assets/lib/isotope/isotope.min.js',
				'dep'       => array( 'jquery' ),
				'in_footer' => true,
			),
			'uael-infinitescroll'    => array(
				'path'      => 'assets/lib/infinitescroll/jquery.infinitescroll.min.js',
				'dep'       => array( 'jquery' ),
				'in_footer' => true,
			),
			'uael-fancybox'          => array(
				'path'      => 'assets/lib/fancybox/jquery_fancybox.min.js',
				'dep'       => array( 'jquery' ),
				'in_footer' => true,
			),
			'uael-justified'         => array(
				'path'      => 'assets/lib/justifiedgallery/justifiedgallery.min.js',
				'dep'       => array( 'jquery', 'uael-frontend-script' ),
				'in_footer' => true,
			),
			'uael-countdown'         => array(
				'path'      => 'assets/' . $folder . '/uael-countdown' . $suffix . '.js',
				'dep'       => array( 'jquery' ),
				'in_footer' => true,
			),
			'uael-nav-menu'          => array(
				'path'      => 'assets/' . $folder . '/uael-nav-menu' . $suffix . '.js',
				'dep'       => array( 'jquery' ),
				'in_footer' => true,
			),
			'uael-faq'               => array(
				'path'      => 'assets/' . $folder . '/uael-faq' . $suffix . '.js',
				'dep'       => array( 'jquery' ),
				'in_footer' => true,
			),
		);

		return $js_files;
	}

	/**
	 * Returns Style array.
	 *
	 * @return array()
	 * @since 0.0.1
	 */
	public static function get_widget_style() {
		$folder = UAEL_Helper::get_css_folder();
		$suffix = UAEL_Helper::get_css_suffix();

		if ( UAEL_Helper::is_script_debug() ) {
			$css_files = array(
				'uael-info-box'          => array(
					'path' => 'assets/css/modules/info-box.css',
					'dep'  => array(),
				),
				'uael-heading'           => array(
					'path' => 'assets/css/modules/heading.css',
					'dep'  => array(),
				),
				'uael-ba-slider'         => array(
					'path' => 'assets/css/modules/ba-slider.css',
					'dep'  => array(),
				),
				'uael-buttons'           => array(
					'path' => 'assets/css/modules/buttons.css',
					'dep'  => array(),
				),
				'uael-modal-popup'       => array(
					'path' => 'assets/css/modules/modal-popup.css',
					'dep'  => array(),
				),
				'uael-offcanvas'         => array(
					'path' => 'assets/css/modules/offcanvas.css',
					'dep'  => array(),
				),
				'uael-content-toggle'    => array(
					'path' => 'assets/css/modules/content-toggle.css',
					'dep'  => array(),
				),
				'uael-caf-styler'        => array(
					'path' => 'assets/css/modules/caf-styler.css',
					'dep'  => array(),
				),
				'uael-business-hours'    => array(
					'path' => 'assets/css/modules/business-hours.css',
					'dep'  => array(),
				),
				'uael-cf7-styler'        => array(
					'path' => 'assets/css/modules/cf-styler.css',
					'dep'  => array(),
				),
				'uael-gf-styler'         => array(
					'path' => 'assets/css/modules/gform-styler.css',
					'dep'  => array(),
				),
				'uael-hotspot'           => array(
					'path' => 'assets/css/modules/hotspot.css',
					'dep'  => array(),
				),
				'uael-post'              => array(
					'path' => 'assets/css/modules/post.css',
					'dep'  => array(),
				),
				'uael-post-card'         => array(
					'path' => 'assets/css/modules/post-card.css',
					'dep'  => array(),
				),
				'uael-post-event'        => array(
					'path' => 'assets/css/modules/post-event.css',
					'dep'  => array(),
				),
				'uael-post-feed'         => array(
					'path' => 'assets/css/modules/post-feed.css',
					'dep'  => array(),
				),
				'uael-post-news'         => array(
					'path' => 'assets/css/modules/post-news.css',
					'dep'  => array(),
				),
				'uael-post-carousel'     => array(
					'path' => 'assets/css/modules/post-carousel.css',
					'dep'  => array(),
				),
				'uael-post-business'     => array(
					'path' => 'assets/css/modules/post-business.css',
					'dep'  => array(),
				),
				'uael-video-gallery'     => array(
					'path' => 'assets/css/modules/video-gallery.css',
					'dep'  => array(),
				),
				'uael-fancybox'          => array(
					'path' => 'assets/css/modules/jquery.fancybox.min.css',
					'dep'  => array(),
				),
				'uael-price-list'        => array(
					'path' => 'assets/css/modules/price-list.css',
					'dep'  => array(),
				),
				'uael-price-table'       => array(
					'path' => 'assets/css/modules/price-table.css',
					'dep'  => array(),
				),
				'uael-table'             => array(
					'path' => 'assets/css/modules/table.css',
					'dep'  => array(),
				),
				'uael-table-of-contents' => array(
					'path' => 'assets/css/modules/table-of-contents.css',
					'dep'  => array(),
				),
				'uael-image-gallery'     => array(
					'path' => 'assets/css/modules/image-gallery.css',
					'dep'  => array(),
				),
				'uael-common'            => array(
					'path' => 'assets/css/modules/common.css',
					'dep'  => array(),
				),
				'uael-timeline'          => array(
					'path' => 'assets/css/modules/timeline.css',
					'dep'  => array(),
				),
				'uael-video'             => array(
					'path' => 'assets/css/modules/video.css',
					'dep'  => array(),
				),
				'uael-team-member'       => array(
					'path' => 'assets/css/modules/team-member.css',
					'dep'  => array(),
				),
				'uael-wpf-styler'        => array(
					'path' => 'assets/css/modules/wpf-styler.css',
					'dep'  => array(),
				),
				'uael-countdown'         => array(
					'path' => 'assets/css/modules/countdown.css',
					'dep'  => array(),
				),
				'uael-business-reviews'  => array(
					'path' => 'assets/css/modules/business-reviews.css',
					'dep'  => array(),
				),
				'uael-particles'         => array(
					'path' => 'assets/css/modules/particles.css',
					'dep'  => array(),
				),
				'uael-registration-form' => array(
					'path' => 'assets/css/modules/registration-form.css',
					'dep'  => array(),
				),
				'uael-google-maps'       => array(
					'path' => 'assets/css/modules/google-map.css',
					'dep'  => array(),
				),
				'uael-login-form'        => array(
					'path' => 'assets/css/modules/login-form.css',
					'dep'  => array(),
				),
				'uael-how-to'            => array(
					'path' => 'assets/css/modules/how-to.css',
					'dep'  => array(),
				),
				'uael-nav-menu'          => array(
					'path' => 'assets/css/modules/nav-menu.css',
					'dep'  => array(),
				),
				'uael-faq'               => array(
					'path' => 'assets/css/modules/uael-faq.css',
					'dep'  => array(),
				),
			);
		} else {
			$css_files = array(
				'uael-frontend' => array(
					'path' => 'assets/min-css/uael-frontend.min.css',
					'dep'  => array(),
				),
			);
		}

		if ( is_rtl() ) {
			$css_files = array(
				'uael-frontend' => array(
					// This is autogenerated rtl file.
					'path' => 'assets/min-css/uael-frontend-rtl.min.css',
					'dep'  => array(),
				),
			);
		}

		if ( class_exists( 'WooCommerce' ) ) {
			$css_files['uael-woocommerce'] = array(
				'path' => 'assets/' . $folder . '/uael-woocommerce' . $suffix . '.css',
				'dep'  => array(),
			);
		}

		return $css_files;
	}
}
