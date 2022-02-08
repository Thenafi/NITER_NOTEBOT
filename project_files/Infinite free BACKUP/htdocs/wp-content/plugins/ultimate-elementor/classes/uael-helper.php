<?php
/**
 * UAEL Helper.
 *
 * @package UAEL
 */

namespace UltimateElementor\Classes;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use UltimateElementor\Classes\UAEL_Config;

/**
 * Class UAEL_Helper.
 */
class UAEL_Helper {

	/**
	 * CSS files folder
	 *
	 * @var script_debug
	 */
	private static $script_debug = null;

	/**
	 * CSS files folder
	 *
	 * @var css_folder
	 */
	private static $css_folder = null;

	/**
	 * CSS Suffix
	 *
	 * @var css_suffix
	 */
	private static $css_suffix = null;

	/**
	 * RTL CSS Suffix
	 *
	 * @var rtl_css_suffix
	 */
	private static $rtl_css_suffix = null;

	/**
	 * JS files folder
	 *
	 * @var js_folder
	 */
	private static $js_folder = null;

	/**
	 * JS Suffix
	 *
	 * @var js_suffix
	 */
	private static $js_suffix = null;

	/**
	 * Widget Options
	 *
	 * @var widget_options
	 */
	private static $widget_options = null;

	/**
	 * Skins Options
	 *
	 * @var skins_options
	 */
	private static $skins_options = null;

	/**
	 * Widget List
	 *
	 * @var widget_list
	 */
	private static $widget_list = null;

	/**
	 * Google Map Language List
	 *
	 * @var google_map_languages
	 */
	private static $google_map_languages = null;

	/**
	 * WHite label data
	 *
	 * @var branding
	 */
	private static $branding = null;

	/**
	 * Post Skins List
	 *
	 * @var post_skins_list
	 */
	private static $post_skins_list = null;

	/**
	 * Elementor Saved page templates list
	 *
	 * @var page_templates
	 */
	private static $page_templates = null;

	/**
	 * Elementor saved section templates list
	 *
	 * @var section_templates
	 */
	private static $section_templates = null;

	/**
	 * Elementor saved widget templates list
	 *
	 * @var widget_templates
	 */
	private static $widget_templates = null;

	/**
	 * Provide General settings array().
	 *
	 * @return array()
	 * @since 0.0.1
	 */
	public static function get_widget_list() {

		if ( ! isset( self::$widget_list ) ) {
			self::$widget_list = UAEL_Config::get_widget_list();
		}

		return apply_filters( 'uael_widget_list', self::$widget_list );
	}

	/**
	 * Provide post skins array.
	 *
	 * @return array()
	 * @since 1.21.0
	 */
	public static function get_post_skin_list() {

		self::$post_skins_list = UAEL_Config::get_post_skin_list();

		return apply_filters( 'uael_post_skin_list', self::$post_skins_list );
	}

	/**
	 * Check is script debug enabled.
	 *
	 * @since 0.0.1
	 *
	 * @return string The CSS suffix.
	 */
	public static function is_script_debug() {

		if ( null === self::$script_debug ) {

			self::$script_debug = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG;
		}

		return self::$script_debug;
	}

	/**
	 * Get CSS Folder.
	 *
	 * @since 0.0.1
	 *
	 * @return string The CSS folder.
	 */
	public static function get_css_folder() {

		if ( null === self::$css_folder ) {

			self::$css_folder = self::is_script_debug() ? 'css' : 'min-css';
		}

		return self::$css_folder;
	}

	/**
	 * Get CSS suffix.
	 *
	 * @since 0.0.1
	 *
	 * @return string The CSS suffix.
	 */
	public static function get_css_suffix() {

		if ( null === self::$css_suffix ) {

			self::$css_suffix = self::is_script_debug() ? '' : '.min';
		}

		return self::$css_suffix;
	}

	/**
	 * Get JS Folder.
	 *
	 * @since 0.0.1
	 *
	 * @return string The JS folder.
	 */
	public static function get_js_folder() {

		if ( null === self::$js_folder ) {

			self::$js_folder = self::is_script_debug() ? 'js' : 'min-js';
		}

		return self::$js_folder;
	}

	/**
	 * Get JS Suffix.
	 *
	 * @since 0.0.1
	 *
	 * @return string The JS suffix.
	 */
	public static function get_js_suffix() {

		if ( null === self::$js_suffix ) {

			self::$js_suffix = self::is_script_debug() ? '' : '.min';
		}

		return self::$js_suffix;
	}

	/**
	 *  Get link rel attribute
	 *
	 *  @param string $target Target attribute to the link.
	 *  @param int    $is_nofollow No follow yes/no.
	 *  @param int    $echo Return or echo the output.
	 *  @since 0.0.1
	 *  @return string
	 */
	public static function get_link_rel( $target, $is_nofollow = 0, $echo = 0 ) {

		$attr = '';
		if ( '_blank' === $target ) {
			$attr .= 'noopener';
		}

		if ( 1 === $is_nofollow ) {
			$attr .= ' nofollow';
		}

		if ( '' === $attr ) {
			return;
		}

		$attr = trim( $attr );
		if ( ! $echo ) {
			return 'rel="' . $attr . '"';
		}
		echo 'rel="' . esc_attr( $attr ) . '"';
	}

	/**
	 * Returns an option from the database for
	 * the admin settings page.
	 *
	 * @param  string  $key     The option key.
	 * @param  mixed   $default Option default value if option is not available.
	 * @param  boolean $network_override Whether to allow the network admin setting to be overridden on subsites.
	 * @return string           Return the option value
	 */
	public static function get_admin_settings_option( $key, $default = false, $network_override = false ) {

		// Get the site-wide option if we're in the network admin.
		if ( $network_override && is_multisite() ) {
			$value = get_site_option( $key, $default );
		} else {
			$value = get_option( $key, $default );
		}

		return $value;
	}

	/**
	 * Updates an option from the admin settings page.
	 *
	 * @param string $key       The option key.
	 * @param mixed  $value     The value to update.
	 * @param bool   $network   Whether to allow the network admin setting to be overridden on subsites.
	 * @return mixed
	 */
	public static function update_admin_settings_option( $key, $value, $network = false ) {

		// Update the site-wide option since we're in the network admin.
		if ( $network && is_multisite() ) {
			update_site_option( $key, $value );
		} else {
			update_option( $key, $value );
		}

	}

	/**
	 * Provide White Label array().
	 *
	 * @return array()
	 * @since 0.0.1
	 */
	public static function get_white_labels() {

		if ( null === self::$branding ) {
			$branding_default = apply_filters(
				'uael_branding_options',
				array(
					'agency'                => array(
						'author'        => '',
						'author_url'    => '',
						'hide_branding' => false,
					),
					'plugin'                => array(
						'name'        => '',
						'short_name'  => '',
						'description' => '',
					),
					'replace_logo'          => 'disable',
					'enable_knowledgebase'  => 'enable',
					'knowledgebase_url'     => '',
					'enable_support'        => 'enable',
					'support_url'           => '',
					'enable_beta_box'       => 'enable',
					'enable_custom_tagline' => 'disable',
					'internal_help_links'   => 'enable',
				)
			);

			$branding       = self::get_admin_settings_option( '_uael_white_label', array(), true );
			self::$branding = wp_parse_args( $branding, $branding_default );

			if ( defined( 'UAEL_WL_AUTHOR' ) ) {
				self::$branding['agency']['author'] = UAEL_WL_AUTHOR;
			}

			if ( defined( 'UAEL_WL_AUTHOR_URL' ) ) {
				self::$branding['agency']['author_url'] = UAEL_WL_AUTHOR_URL;
			}

			if ( defined( 'UAEL_WL_PLUGIN_NAME' ) ) {
				self::$branding['plugin']['name'] = UAEL_WL_PLUGIN_NAME;
			}

			if ( defined( 'UAEL_WL_PLUGIN_SHORT_NAME' ) ) {
				self::$branding['plugin']['short_name'] = UAEL_WL_PLUGIN_SHORT_NAME;
			}

			if ( defined( 'UAEL_WL_PLUGIN_DESCRIPTION' ) ) {
				self::$branding['plugin']['description'] = UAEL_WL_PLUGIN_DESCRIPTION;
			}

			if ( defined( 'UAEL_WL_REPLACE_LOGO' ) ) {
				self::$branding['replace_logo'] = UAEL_WL_REPLACE_LOGO;
			}

			if ( defined( 'UAEL_WL_KNOWLEDGEBASE' ) ) {
				self::$branding['enable_knowledgebase'] = UAEL_WL_KNOWLEDGEBASE;
			}

			if ( defined( 'UAEL_WL_KNOWLEDGEBASE_URL' ) ) {
				self::$branding['knowledgebase_url'] = UAEL_WL_KNOWLEDGEBASE_URL;
			}

			if ( defined( 'UAEL_WL_SUPPORT' ) ) {
				self::$branding['enable_support'] = UAEL_WL_SUPPORT;
			}

			if ( defined( 'UAEL_WL_SUPPORT_URL' ) ) {
				self::$branding['support_url'] = UAEL_WL_SUPPORT_URL;
			}

			if ( defined( 'UAEL_WL_BETA_UPDATE_BOX' ) ) {
				self::$branding['enable_beta_box'] = UAEL_WL_BETA_UPDATE_BOX;
			}

			if ( defined( 'UAEL_WL_INTERNAL_HELP_LINKS' ) ) {
				self::$branding['internal_help_links'] = UAEL_WL_INTERNAL_HELP_LINKS;
			}

			if ( defined( 'UAEL_WL_CUSTOM_TAGLINE' ) ) {
				self::$branding['enable_custom_tagline'] = UAEL_WL_CUSTOM_TAGLINE;
			}
		}

		return self::$branding;
	}

	/**
	 * Is White Label.
	 *
	 * @return string
	 * @since 0.0.1
	 */
	public static function is_hide_branding() {

		$branding = self::get_white_labels();

		$hide = false;

		if ( defined( 'WP_UAEL_WL' ) && WP_UAEL_WL ) {

			$hide = true;
		} else {

			if ( isset( $branding['agency']['hide_branding'] ) && false === $branding['agency']['hide_branding'] ) {

				$hide = false;
			} else {
				$hide = true;
			}
		}

		return $hide;
	}

	/**
	 * Is replace_logo.
	 *
	 * @return string
	 * @since 0.0.1
	 */
	public static function is_replace_logo() {

		$branding = self::get_white_labels();

		if ( isset( $branding['replace_logo'] ) && 'disable' === $branding['replace_logo'] ) {

			return false;
		}

		return true;
	}

	/**
	 * Is hide_tagline.
	 *
	 * @return string
	 * @since 1.21.1
	 */
	public static function is_hide_tagline() {

		$branding = self::get_white_labels();

		if ( isset( $branding['enable_custom_tagline'] ) && 'disable' === $branding['enable_custom_tagline'] ) {

			return false;
		}

		return true;
	}


	/**
	 * Is Knowledgebase.
	 *
	 * @return string
	 * @since 0.0.1
	 */
	public static function knowledgebase_data() {

		$branding = self::get_white_labels();

		$knowledgebase = array(
			'enable_knowledgebase' => true,
			'knowledgebase_url'    => 'https://uaelementor.com/docs/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
		);

		if ( isset( $branding['enable_knowledgebase'] ) && 'disable' === $branding['enable_knowledgebase'] ) {

			$knowledgebase['enable_knowledgebase'] = false;
		}

		if ( isset( $branding['knowledgebase_url'] ) && '' !== $branding['knowledgebase_url'] ) {
			$knowledgebase['knowledgebase_url'] = $branding['knowledgebase_url'];
		}

		return $knowledgebase;
	}

	/**
	 * Is Knowledgebase.
	 *
	 * @return string
	 * @since 0.0.1
	 */
	public static function support_data() {

		$branding = self::get_white_labels();

		$support = array(
			'enable_support' => true,
			'support_url'    => 'https://uaelementor.com/support/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin',
		);

		if ( isset( $branding['enable_support'] ) && 'disable' === $branding['enable_support'] ) {

			$support['enable_support'] = false;
		}

		if ( isset( $branding['support_url'] ) && '' !== $branding['support_url'] ) {
			$support['support_url'] = $branding['support_url'];
		}

		return $support;
	}

	/**
	 * Is internal links enable.
	 *
	 * @return string
	 * @since 0.0.1
	 */
	public static function is_internal_links() {

		$branding = self::get_white_labels();

		if ( isset( $branding['internal_help_links'] ) && 'disable' === $branding['internal_help_links'] ) {

			return false;
		}

		return true;
	}

	/**
	 * Provide Widget Name
	 *
	 * @param string $slug Module slug.
	 * @return string
	 * @since 0.0.1
	 */
	public static function get_widget_slug( $slug = '' ) {

		if ( ! isset( self::$widget_list ) ) {
			self::$widget_list = self::get_widget_list();
		}

		$widget_slug = '';

		if ( isset( self::$widget_list[ $slug ] ) ) {
			$widget_slug = self::$widget_list[ $slug ]['slug'];
		}

		return apply_filters( 'uael_widget_slug', $widget_slug );
	}

	/**
	 * Provide Widget Name
	 *
	 * @param string $slug Module slug.
	 * @return string
	 * @since 0.0.1
	 */
	public static function get_widget_title( $slug = '' ) {

		if ( ! isset( self::$widget_list ) ) {
			self::$widget_list = self::get_widget_list();
		}

		$widget_name = '';

		if ( isset( self::$widget_list[ $slug ] ) ) {
			$widget_name = self::$widget_list[ $slug ]['title'];
		}

		return apply_filters( 'uael_widget_name', $widget_name );
	}

	/**
	 * Provide Widget Name
	 *
	 * @param string $slug Module slug.
	 * @return string
	 * @since 0.0.1
	 */
	public static function get_widget_icon( $slug = '' ) {

		if ( ! isset( self::$widget_list ) ) {
			self::$widget_list = self::get_widget_list();
		}

		$widget_icon = '';

		if ( isset( self::$widget_list[ $slug ] ) ) {
			$widget_icon = self::$widget_list[ $slug ]['icon'];
		}

		return apply_filters( 'uael_widget_icon', $widget_icon );
	}

	/**
	 * Provide Widget Keywords
	 *
	 * @param string $slug Module slug.
	 * @return string
	 * @since 1.5.1
	 */
	public static function get_widget_keywords( $slug = '' ) {

		if ( ! isset( self::$widget_list ) ) {
			self::$widget_list = self::get_widget_list();
		}

		$widget_keywords = '';

		if ( isset( self::$widget_list[ $slug ] ) && isset( self::$widget_list[ $slug ]['keywords'] ) ) {
			$widget_keywords = self::$widget_list[ $slug ]['keywords'];
		}

		return apply_filters( 'uael_widget_keywords', $widget_keywords );
	}

	/**
	 * Provide Integrations settings array().
	 *
	 * @param string $name Module slug.
	 * @return array()
	 * @since 0.0.1
	 */
	public static function get_integrations_options( $name = '' ) {

		$integrations_default = array(
			'google_api'             => '',
			'developer_mode'         => false,
			'language'               => '',
			'google_places_api'      => '',
			'yelp_api'               => '',
			'recaptcha_v3_key'       => '',
			'recaptcha_v3_secretkey' => '',
			'recaptcha_v3_score'     => '0.5',
			'google_client_id'       => '',
			'facebook_app_id'        => '',
			'facebook_app_secret'    => '',
		);

		$integrations = self::get_admin_settings_option( '_uael_integration', array(), true );
		$integrations = wp_parse_args( $integrations, $integrations_default );
		$integrations = apply_filters( 'uael_integration_options', $integrations );

		if ( '' !== $name && isset( $integrations[ $name ] ) && '' !== $integrations[ $name ] ) {
			return $integrations[ $name ];
		} else {
			return $integrations;
		}
	}

	/**
	 * Provide Widget settings.
	 *
	 * @return array()
	 * @since 0.0.1
	 */
	public static function get_widget_options() {

		if ( null === self::$widget_options ) {

			if ( ! isset( self::$widget_list ) ) {
				$widgets = self::get_widget_list();
			} else {
				$widgets = self::$widget_list;
			}

			$saved_widgets = self::get_admin_settings_option( '_uael_widgets' );

			if ( is_array( $widgets ) ) {

				foreach ( $widgets as $slug => $data ) {

					if ( isset( $saved_widgets[ $slug ] ) ) {

						if ( 'disabled' === $saved_widgets[ $slug ] ) {
							$widgets[ $slug ]['is_activate'] = false;
						} else {
							$widgets[ $slug ]['is_activate'] = true;
						}
					} else {
						$widgets[ $slug ]['is_activate'] = ( isset( $data['default'] ) ) ? $data['default'] : false;
					}
				}
			}

			if ( false === self::is_hide_branding() ) {
				$widgets['White_Label'] = array(
					'slug'        => 'uael-white-label',
					'title'       => __( 'White Label', 'uael' ),
					'icon'        => '',
					'title_url'   => '#',
					'is_activate' => true,
				);
			}

			self::$widget_options = $widgets;
		}
		return apply_filters( 'uael_enabled_widgets', self::$widget_options );
	}

	/**
	 * Widget Active.
	 *
	 * @param string $slug Module slug.
	 * @return string
	 * @since 0.0.1
	 */
	public static function is_widget_active( $slug = '' ) {

		$widgets     = self::get_widget_options();
		$is_activate = false;

		if ( isset( $widgets[ $slug ] ) ) {
			$is_activate = $widgets[ $slug ]['is_activate'];
		}

		return $is_activate;
	}

	/**
	 * Provide Post skin settings.
	 *
	 * @return array()
	 * @since 1.21.0
	 */
	public static function get_post_skin_options() {
		if ( null === self::$post_skins_list ) {

			$post_skins_list = self::get_post_skin_list();
			$saved_widgets   = self::get_admin_settings_option( '_uael_widgets' );

			if ( is_array( $post_skins_list ) ) {

				foreach ( $post_skins_list as $slug => $data ) {
					if ( isset( $saved_widgets[ $slug ] ) ) {

						if ( 'disabled' === $saved_widgets[ $slug ] ) {
							$post_skins_list[ $slug ]['is_activate'] = false;
						} else {
							$post_skins_list[ $slug ]['is_activate'] = true;
						}
					} else {
						$post_skins_list[ $slug ]['is_activate'] = ( isset( $data['default'] ) ) ? $data['default'] : false;
					}
				}
			}

			self::$skins_options = $post_skins_list;

		}

		return apply_filters( 'uael_enabled_skins', self::$skins_options );
	}

	/**
	 * Post skin Active.
	 *
	 * @param string $slug Module slug.
	 * @return string
	 * @since 1.21.0
	 */
	public static function is_post_skin_active( $slug = '' ) {

		$post_skins_list = self::get_post_skin_options();
		$is_activate     = false;

		if ( isset( $post_skins_list[ $slug ] ) ) {
			$is_activate = $post_skins_list[ $slug ]['is_activate'];
		}

		return $is_activate;
	}


	/**
	 * Returns Script array.
	 *
	 * @return array()
	 * @since 0.0.1
	 */
	public static function get_widget_script() {

		return UAEL_Config::get_widget_script();
	}

	/**
	 * Returns Style array.
	 *
	 * @return array()
	 * @since 0.0.1
	 */
	public static function get_widget_style() {

		return UAEL_Config::get_widget_style();
	}

	/**
	 * Returns Google Map languages List.
	 *
	 * @since 0.0.1
	 *
	 * @return array Google Map languages List.
	 */
	public static function get_google_map_languages() {

		if ( null === self::$google_map_languages ) {

			self::$google_map_languages = array(
				'ar'    => __( 'ARABIC', 'uael' ),
				'eu'    => __( 'BASQUE', 'uael' ),
				'bg'    => __( 'BULGARIAN', 'uael' ),
				'bn'    => __( 'BENGALI', 'uael' ),
				'ca'    => __( 'CATALAN', 'uael' ),
				'cs'    => __( 'CZECH', 'uael' ),
				'da'    => __( 'DANISH', 'uael' ),
				'de'    => __( 'GERMAN', 'uael' ),
				'el'    => __( 'GREEK', 'uael' ),
				'en'    => __( 'ENGLISH', 'uael' ),
				'en-AU' => __( 'ENGLISH (AUSTRALIAN)', 'uael' ),
				'en-GB' => __( 'ENGLISH (GREAT BRITAIN)', 'uael' ),
				'es'    => __( 'SPANISH', 'uael' ),
				'fa'    => __( 'FARSI', 'uael' ),
				'fi'    => __( 'FINNISH', 'uael' ),
				'fil'   => __( 'FILIPINO', 'uael' ),
				'fr'    => __( 'FRENCH', 'uael' ),
				'gl'    => __( 'GALICIAN', 'uael' ),
				'gu'    => __( 'GUJARATI', 'uael' ),
				'hi'    => __( 'HINDI', 'uael' ),
				'hr'    => __( 'CROATIAN', 'uael' ),
				'hu'    => __( 'HUNGARIAN', 'uael' ),
				'id'    => __( 'INDONESIAN', 'uael' ),
				'it'    => __( 'ITALIAN', 'uael' ),
				'iw'    => __( 'HEBREW', 'uael' ),
				'ja'    => __( 'JAPANESE', 'uael' ),
				'kn'    => __( 'KANNADA', 'uael' ),
				'ko'    => __( 'KOREAN', 'uael' ),
				'lt'    => __( 'LITHUANIAN', 'uael' ),
				'lv'    => __( 'LATVIAN', 'uael' ),
				'ml'    => __( 'MALAYALAM', 'uael' ),
				'mr'    => __( 'MARATHI', 'uael' ),
				'nl'    => __( 'DUTCH', 'uael' ),
				'no'    => __( 'NORWEGIAN', 'uael' ),
				'pl'    => __( 'POLISH', 'uael' ),
				'pt'    => __( 'PORTUGUESE', 'uael' ),
				'pt-BR' => __( 'PORTUGUESE (BRAZIL)', 'uael' ),
				'pt-PT' => __( 'PORTUGUESE (PORTUGAL)', 'uael' ),
				'ro'    => __( 'ROMANIAN', 'uael' ),
				'ru'    => __( 'RUSSIAN', 'uael' ),
				'sk'    => __( 'SLOVAK', 'uael' ),
				'sl'    => __( 'SLOVENIAN', 'uael' ),
				'sr'    => __( 'SERBIAN', 'uael' ),
				'sv'    => __( 'SWEDISH', 'uael' ),
				'tl'    => __( 'TAGALOG', 'uael' ),
				'ta'    => __( 'TAMIL', 'uael' ),
				'te'    => __( 'TELUGU', 'uael' ),
				'th'    => __( 'THAI', 'uael' ),
				'tr'    => __( 'TURKISH', 'uael' ),
				'uk'    => __( 'UKRAINIAN', 'uael' ),
				'vi'    => __( 'VIETNAMESE', 'uael' ),
				'zh-CN' => __( 'CHINESE (SIMPLIFIED)', 'uael' ),
				'zh-TW' => __( 'CHINESE (TRADITIONAL)', 'uael' ),
			);
		}

		return self::$google_map_languages;
	}

	/**
	 * Provide Image data based on id.
	 *
	 * @return array()
	 * @param int    $image_id Image ID.
	 * @param string $image_url Image URL.
	 * @param array  $image_size Image sizes array.
	 * @since 0.0.1
	 */
	public static function get_image_data( $image_id, $image_url, $image_size ) {

		if ( ! $image_id && ! $image_url ) {
			return false;
		}

		$data = array();

		$image_url = esc_url_raw( $image_url );

		if ( ! empty( $image_id ) ) { // Existing attachment.

			$attachment = get_post( $image_id );
			if ( is_object( $attachment ) ) {
				$data['id']          = $image_id;
				$data['url']         = $image_url;
				$data['image']       = wp_get_attachment_image( $attachment->ID, $image_size, true );
				$data['caption']     = $attachment->post_excerpt;
				$data['title']       = $attachment->post_title;
				$data['description'] = $attachment->post_content;

			}
		} else { // Placeholder image, most likely.

			if ( empty( $image_url ) ) {
				return;
			}

			$data['id']          = false;
			$data['url']         = $image_url;
			$data['image']       = '<img src="' . $image_url . '" alt="" title="" />';
			$data['caption']     = '';
			$data['title']       = '';
			$data['description'] = '';
		}

		return $data;
	}

	/**
	 * Authenticate Google & Yelp API keys
	 *
	 * @since 1.13.0
	 */
	public static function get_api_authentication() {

		$integration_settings = self::get_integrations_options();

		if ( '' !== $integration_settings['google_places_api'] ) {

			$api_key = $integration_settings['google_places_api'];

			$place_id = 'ChIJq6qqat2_wjsR4Rri4i22ap4';

			$parameters = "key=$api_key&placeid=$place_id";

			$url = "https://maps.googleapis.com/maps/api/place/details/json?$parameters";

			$result = wp_remote_post(
				$url,
				array(
					'method'      => 'POST',
					'timeout'     => 60,
					'httpversion' => '1.0',
				)
			);

			if ( ! is_wp_error( $result ) || wp_remote_retrieve_response_code( $result ) === 200 ) {
				$final_result  = json_decode( wp_remote_retrieve_body( $result ) );
				$result_status = $final_result->status;

				switch ( $result_status ) {
					case 'OVER_QUERY_LIMIT':
						update_option( 'uael_google_api_status', 'exceeded' );
						break;
					case 'OK':
						update_option( 'uael_google_api_status', 'yes' );
						break;
					case 'REQUEST_DENIED':
						update_option( 'uael_google_api_status', 'no' );
						break;
					default:
						update_option( 'uael_google_api_status', '' );
						break;
				}
			} else {
				update_option( 'uael_google_api_status', 'no' );
			}
		} else {
			delete_option( 'uael_google_api_status' );
		}

		if ( '' !== $integration_settings['yelp_api'] ) {
			$url = 'https://api.yelp.com/v3/businesses/search?term=pizza&location=boston';

			$result = wp_remote_get(
				$url,
				array(
					'method'      => 'GET',
					'timeout'     => 60,
					'httpversion' => '1.0',
					'user-agent'  => '',
					'headers'     => array(
						'Authorization' => 'Bearer ' . $integration_settings['yelp_api'],
					),
				)
			);

			if ( is_wp_error( $result ) ) {
				update_option( 'uael_yelp_api_status', 'no' );
				return;
			} else {
				$reviews = json_decode( $result['body'] );

				$response_code = wp_remote_retrieve_response_code( $result );

				if ( 200 !== $response_code ) {
					$error_message = $reviews->error->code;
					if ( 'VALIDATION_ERROR' === $error_message ) {
						update_option( 'uael_yelp_api_status', 'no' );
					}
				} else {
					update_option( 'uael_yelp_api_status', 'yes' );
				}
			}
		} else {
			delete_option( 'uael_yelp_api_status' );
		}

		global $wpdb;

		$param1     = '%\_transient\_%';
		$param2     = '%_uael_reviews_%';
		$param3     = '%\_transient\_timeout%';
		$transients = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$wpdb->options} WHERE option_name LIKE %s AND option_name LIKE %s AND option_name NOT LIKE %s", $param1, $param2, $param3 ) );

		foreach ( $transients as $transient ) {
			$transient_name = $transient->option_name;
			$transient_name = str_replace( '_transient_', '', $transient_name );
			delete_transient( $transient_name );
		}
	}

	/**
	 * Check if the Elementor is updated.
	 *
	 * @since 1.16.1
	 *
	 * @return boolean if Elementor updated.
	 */
	public static function is_elementor_updated() {
		if ( class_exists( 'Elementor\Icons_Manager' ) ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Return the new icon name.
	 *
	 * @since 1.16.1
	 *
	 * @param string $control_name name of the control.
	 * @return string of the updated control name.
	 */
	public static function get_new_icon_name( $control_name ) {
		if ( class_exists( 'Elementor\Icons_Manager' ) ) {
			return 'new_' . $control_name . '[value]';
		} else {
			return $control_name;
		}
	}

	/**
	 * Return the current client IP.
	 *
	 * @since 1.18.0
	 *
	 * @return string of the current IP address.
	 */
	public static function get_client_ip() {
		$server_ip_keys = array(
			'HTTP_CLIENT_IP',
			'HTTP_X_FORWARDED_FOR',
			'HTTP_X_FORWARDED',
			'HTTP_X_CLUSTER_CLIENT_IP',
			'HTTP_FORWARDED_FOR',
			'HTTP_FORWARDED',
			'REMOTE_ADDR',
		);

		foreach ( $server_ip_keys as $key ) {
			if ( isset( $_SERVER[ $key ] ) && filter_var( $_SERVER[ $key ], FILTER_VALIDATE_IP ) ) {
				return $_SERVER[ $key ];
			}
		}

		// Fallback local ip.
		return '127.0.0.1';
	}

	/**
	 *  Get Saved templates
	 *
	 *  @param string $type Type.
	 *  @since 1.22.0
	 *  @return array of templates
	 */
	public static function get_saved_data( $type = 'page' ) {

		$template_type = $type . '_templates';

		$templates_list = array();

		if ( ( null === self::$page_templates && 'page' === $type ) || ( null === self::$section_templates && 'section' === $type ) || ( null === self::$widget_templates && 'widget' === $type ) ) {

			$posts = get_posts(
				array(
					'post_type'      => 'elementor_library',
					'orderby'        => 'title',
					'order'          => 'ASC',
					'posts_per_page' => '-1',
					'tax_query'      => array(
						array(
							'taxonomy' => 'elementor_library_type',
							'field'    => 'slug',
							'terms'    => $type,
						),
					),
				)
			);

			foreach ( $posts as $post ) {

				$templates_list[] = array(
					'id'   => $post->ID,
					'name' => $post->post_title,
				);
			}

			self::${$template_type}[-1] = __( 'Select', 'uael' );

			if ( count( $templates_list ) ) {
				foreach ( $templates_list as $saved_row ) {

					$content_id                            = $saved_row['id'];
					$content_id                            = apply_filters( 'wpml_object_id', $content_id );
					self::${$template_type}[ $content_id ] = $saved_row['name'];

				}
			} else {
				self::${$template_type}['no_template'] = __( 'It seems that, you have not saved any template yet.', 'uael' );
			}
		}

		return self::${$template_type};
	}
}
