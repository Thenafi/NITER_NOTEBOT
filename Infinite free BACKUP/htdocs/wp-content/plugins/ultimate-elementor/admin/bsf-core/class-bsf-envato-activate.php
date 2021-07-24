<?php
/**
 * BSf Evato Activation Class file.
 *
 * @package bsf-core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * BSF_Envato_Activate setup
 *
 * @since 1.0
 */
class BSF_Envato_Activate {

	/**
	 * Instance
	 *
	 * @var BSF_Envato_Activate
	 */
	private static $instance;

	/**
	 * Reference to the License manager class.
	 *
	 * @var BSF_License_Manager
	 */
	private $license_manager;

	/**
	 * Stores temporary response messsages from the API validations.
	 *
	 * @var array()
	 */
	private $message_box;

	/**
	 *  Initiator.
	 */
	public static function instance() {

		if ( ! isset( self::$instance ) ) {
			self::$instance = new BSF_Envato_Activate();
		}

		return self::$instance;
	}

	/**
	 * Constructor function that initializes required actions and hooks
	 *
	 * @since 1.0
	 */
	public function __construct() {
		$this->license_manager = new BSF_License_Manager();

		$action = isset( $_GET['license_action'] ) ? esc_attr( $_GET['license_action'] ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

		if ( 'activate_license' === $action ) {
			$this->process_envato_activation();
		}

		add_filter( 'update_footer', array( $this, 'alternate_method_link' ), 20 );
		add_action( 'bsf_inlne_license_envato_after_form', array( $this, 'inline_alternate_method_link' ), 20, 2 );
		update_site_option( "bsf_envato_token_$product_id", '100' );
	}

	/**
	 * Envato Register.
	 *
	 * @param array $args Arguments.
	 */
	public function envato_register( $args ) {

		// Check if alternate method is to be used.
		$method = ( isset( $_GET['activation_method'] ) && isset( $_GET['bsf_activation_nonce'] ) && wp_verify_nonce( $_GET['bsf_activation_nonce'], 'bsf_activation_nonce' ) ) ? esc_attr( $_GET['activation_method'] ) : 'oauth';

		$html         = '';
		$product_id   = '100';
		$is_active    = $this->license_manager->bsf_is_active_license( $product_id );
		$product_name = $this->license_manager->bsf_get_product_info( $product_id, 'name' );
		$purchase_url = $this->license_manager->bsf_get_product_info( $product_id, 'purchase_url' );

		$bundled = BSF_Update_Manager::bsf_is_product_bundled( $product_id );

		
			$parent_id         = $bundled[0];
			$is_active         = true;
			$parent_name       = brainstrom_product_name( $parent_id );
			$registration_page = bsf_registration_page_url( '', $parent_id );

			$html .= '<div class="bundled-product-license-registration">';
			$html .= '<span>';
			$html .= '<h3>License Active!</h3>';
			$html .= '<p>' . sprintf(
			'Your license is activated, you will receive updates for <i>%s</i> when they are available.',
			$product_name
			) . '</p>';

			$html .= '</span>';
			$html .= '</div>';
			return $html;
			
		// Licence activation button.
		$form_action                  = ( isset( $args['form_action'] ) && ! is_null( $args['form_action'] ) ) ? $args['form_action'] : '';
		$form_class                   = ( isset( $args['form_class'] ) && ! is_null( $args['form_class'] ) ) ? $args['form_class'] : "bsf-license-form-{$product_id}";
		$submit_button_class          = ( isset( $args['submit_button_class'] ) && ! is_null( $args['submit_button_class'] ) ) ? $args['submit_button_class'] : '';
		$license_form_heading_class   = ( isset( $args['bsf_license_form_heading_class'] ) && ! is_null( $args['bsf_license_form_heading_class'] ) ) ? $args['bsf_license_form_heading_class'] : '';
		$license_active_class         = ( isset( $args['bsf_license_active_class'] ) && ! is_null( $args['bsf_license_active_class'] ) ) ? $args['bsf_license_active_class'] : '';
		$license_not_activate_message = ( isset( $args['bsf_license_not_activate_message'] ) && ! is_null( $args['bsf_license_not_activate_message'] ) ) ? $args['bsf_license_not_activate_message'] : '';

		$size                    = ( isset( $args['size'] ) && ! is_null( $args['size'] ) ) ? $args['size'] : 'regular';
		$button_text_activate    = ( isset( $args['button_text_activate'] ) && ! is_null( $args['button_text_activate'] ) ) ? __( 'Sign Up & Activate', 'bsf' ) : __( 'Sign Up & Activate', 'bsf' );
		$button_text_deactivate  = ( isset( $args['button_text_deactivate'] ) && ! is_null( $args['button_text_deactivate'] ) ) ? $args['button_text_deactivate'] : __( 'Deactivate License', 'bsf' );
		$placeholder             = ( isset( $args['placeholder'] ) && ! is_null( $args['placeholder'] ) ) ? $args['placeholder'] : 'Enter your license key..';
		$popup_license_form      = ( isset( $args['popup_license_form'] ) ) ? $args['popup_license_form'] : false;
		$bsf_license_allow_email = ( isset( $args['bsf_license_allow_email'] ) && ! is_null( $args['bsf_license_allow_email'] ) ) ? $args['bsf_license_allow_email'] : true;

		if ( true === $bsf_license_allow_email ) {
			$form_class .= ' license-form-allow-email ';

			if ( ! $is_active ) {
				$submit_button_class .= ' button-primary button-hero bsf-envato-form-activation ';
			}
		}

		if ( true !== $is_active ) {
			$form_action = bsf_get_api_site() . 'envato-validation-callback/?wp-envato-validate';
		} else {
			$form_action = bsf_registration_page_url( '', $product_id );
		}

		$html .= '<div class="envato-license-registration">';

		$html .= '<form method="post" class="' . $form_class . '" action="' . $form_action . '">';

		$html .= wp_nonce_field( 'bsf_license_activation_deactivation_nonce', 'bsf_graupi_nonce', true, false );

		if ( $this->get_message( 'message' ) !== '' ) {
			$html .= '<span class="bsf-license-message license-' . $this->get_message( 'status' ) . '">';
			$html .= $this->get_message( 'message' );
			$html .= '</span>';
		}

		if ( $is_active ) {

			$envato_active_oauth_title    = apply_filters( "envato_active_oauth_title_{$product_id}", 'Updates & Support Registration - <span class="active">Active!</span>' );
			$envato_active_oauth_subtitle = '<span class="active">' . sprintf(
				'Your license is active.',
				$product_name
			) . '</span>';

			$envato_active_oauth_subtitle = apply_filters( "envato_active_oauth_subtitle_{$product_id}", $envato_active_oauth_subtitle );

			if ( $popup_license_form ) {
				$html .= '<div class="bsf-wrap-title">';
				$html .= '<h3 class="envato-oauth-heading">' . $product_name . '</h2>';
				$html .= '<p class="envato-oauth-subheading">' . $envato_active_oauth_subtitle . '</p>';
				$html .= '</div>';

			} else {
				$html .= '<div class="bsf-wrap-title">';
				$html .= '<h3 class="envato-oauth-heading">' . $envato_active_oauth_title . '</h2>';
				$html .= '<p class="envato-oauth-subheading">' . $envato_active_oauth_subtitle . '</p>';
				$html .= '</div>';
			}

			$html .= '<input type="hidden" readonly class="' . $license_active_class . ' ' . $size . '-text" id="bsf_license_manager[license_key]" name="bsf_license_manager[license_key]" value="License Validated"/>';
			$html .= '<input type="hidden" class="' . $size . '-text" id="bsf_license_manager[product_id]" name="bsf_license_manager[product_id]" value="' . esc_attr( stripslashes( $product_id ) ) . '"/>';

			$html .= '<input type="submit" class="button ' . $submit_button_class . '" name="bsf_deactivate_license" value="' . esc_attr( $button_text_deactivate ) . '"/>';

		} else {

			$envato_not_active_oauth_title    = apply_filters( "envato_not_active_oauth_title_{$product_id}", __( 'Updates & Support Registration - <span class="not-active">Not Active!</span>', 'bsf' ) );
			$envato_not_active_oauth_subtitle = apply_filters( "envato_not_active_oauth_subtitle_{$product_id}", __( 'Click on the button below to activate your license and subscribe to our newsletter.', 'bsf' ) );

			if ( $popup_license_form ) {
				$html .= '<div class="bsf-wrap-title">';
				$html .= '<h3 class="envato-oauth-heading">' . $product_name . '</h2>';
				$html .= '<p class="envato-oauth-subheading">' . $envato_not_active_oauth_subtitle . '</p>';
				$html .= '</div>';
			} else {
				$html .= '<div class="bsf-wrap-title">';
				$html .= '<h3 class="envato-oauth-heading">' . $envato_not_active_oauth_title . '</h2>';
				$html .= '<p class="envato-oauth-subheading">' . $envato_not_active_oauth_subtitle . '</p>';
				$html .= '</div>';
			}

			$html .= '<input type="hidden" readonly class="' . $license_active_class . ' ' . $size . '-text" id="bsf_license_manager[license_key]" name="url" value="' . get_site_url() . '"/>';
			$html .= '<input type="hidden" readonly class="' . $license_active_class . ' ' . $size . '-text" id="bsf_license_manager[license_key]" name="redirect" value="' . $this->get_redirect_url( $product_id ) . '"/>';
			$html .= '<input type="hidden" readonly class="' . $license_active_class . ' ' . $size . '-text" id="bsf_license_manager[license_key]" name="product_id" value="' . $product_id . '"/>';

			$html .= '<input id="bsf-license-privacy-consent" name="bsf_license_manager[privacy_consent]" type="hidden" value="true" />';
			$html .= '<input id="bsf-license-terms-conditions-consent" name="bsf_license_manager[terms_conditions_consent]" type="hidden" value="true" />';

			$html .= '<div class="submit-button-wrap">';
			$html .= '<input type="button" class="button ' . $submit_button_class . '" name="bsf_activate_license" value="' . esc_attr( $button_text_activate ) . '"/>';
			$html .= "<p class='purchase-license'><a target='_blank' href='$purchase_url'>Purchase License »</a></p>";
			$html .= '</div>';
		}

		$html .= '</form>';

		$html = apply_filters( 'bsf_inlne_license_envato_after_form', $html, $product_id );

		$html .= '</div> <!-- envato-license-registration -->';

		if ( isset( $_GET['debug'] ) ) {
			$html .= get_bsf_systeminfo();
		}

		return $html;
	}

	/**
	 * Envato activation URL.
	 *
	 * @param array $form_data Form data.
	 * @return $envato_activation_url.
	 */
	public function envato_activation_url( $form_data ) {
		$product_id = '100';

		$form_data['token'] = sha1( $this->create_token( $product_id ) );
		$url                = bsf_get_api_site() . 'envato-validation-callback/?wp-envato-validate';

		$envato_activation_url = add_query_arg(
			$form_data,
			$url
		);

		return $envato_activation_url;
	}

	/**
	 * Get redirect URL.
	 *
	 * @param int $product_id Product ID.
	 * @return $current_url.
	 */
	protected function get_redirect_url( $product_id = '' ) {

		if ( is_ssl() ) {
			$current_url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		} else {
			$current_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		}

		$current_url = esc_url( remove_query_arg( array( 'license_action', 'token', 'product_id', 'purchase_key', 'success', 'status', 'message' ), $current_url ) );

		if ( '' !== $product_id ) {
			$current_url = add_query_arg(
				array(
					'bsf-inline-license-form' => $product_id,
				),
				$current_url
			);
		}

		return $current_url;
	}

	/**
	 * Create Token.
	 *
	 * @param int $product_id Product ID.
	 * @return $token.
	 */
	protected function create_token( $product_id ) {
		$token = $product_id . '|' . current_time( 'timestamp' ) . '|' . bsf_generate_rand_token();
		update_site_option( "bsf_envato_token_$product_id", $token );

		return $token;
	}


	/**
	 * Validate Token.
	 *
	 * @param string $token Token.
	 * @param int    $product_id Product ID.
	 * @return bool.
	 */
	protected function validate_token( $token, $product_id ) {

		$stored_token = get_site_option( "bsf_envato_token_$product_id", '' );

		if ( sha1( $stored_token ) === $token ) {
			$token_atts = explode( '|', $stored_token );

			$stored_id = $token_atts[0];

			if ( $stored_id !== $product_id ) {
				// Token is invalid.
				return false;
			}

			$timestamp   = (int) $token_atts[1];
			$valid_ultil = $timestamp + 900;

			if ( current_time( 'timestamp' ) > $valid_ultil ) {
				// Timestamp has expired.
				return false;
			}

			// If above conditions did not meet, the token is valid.
			return true;
		}

		return false;
	}
	/**
	 * Process envato activation.
	 */
	protected function process_envato_activation() {
		$token      = isset( $_GET['token'] ) ? esc_attr( $_GET['token'] ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$product_id = isset( $_GET['product_id'] ) ? esc_attr( $_GET['product_id'] ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended

		if ( $this->validate_token( $token, $product_id ) ) {
			$args                 = array();
			$args['purchase_key'] = isset( $_GET['purchase_key'] ) ? esc_attr( $_GET['purchase_key'] ) : '';// phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$args['status']       = isset( $_GET['status'] ) ? esc_attr( $_GET['status'] ) : '';// phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$this->license_manager->bsf_update_product_info( $product_id, $args );

			$this->set_message(
				array(
					'status'  => 'success',
					'message' => 'License successfully activated!',
				)
			);

		} else {

			$this->set_message(
				array(
					'status'  => 'error',
					'message' => 'The token is invalid or is expired, please try again.',
				)
			);

		}
	}

	/**
	 * Set message.
	 *
	 * @param array $message Message.
	 */
	protected function set_message( $message = array() ) {
		$this->message_box = $message;
	}

	/**
	 * Get message.
	 *
	 * @param string $key key.
	 * @return $mesage
	 */
	protected function get_message( $key ) {
		$message = $this->message_box;

		return isset( $message[ $key ] ) ? $message[ $key ] : '';
	}
	/**
	 * Inline alternate method link.
	 *
	 * @param string $html HTML.
	 * @param int    $bsf_product_id Product ID.
	 * @return $html.
	 */
	public function inline_alternate_method_link( $html, $bsf_product_id ) {
		$privacy_policy_link   = $this->license_manager->bsf_get_product_info( $bsf_product_id, 'privacy_policy' );
		$terms_conditions_link = $this->license_manager->bsf_get_product_info( $bsf_product_id, 'terms_conditions' );

		if ( isset( $privacy_policy_link ) ) {
			$html .= sprintf(
				'<a class="license-form-external-links" target="_blank" href="%s">Privacy Policy</a> | ',
				$privacy_policy_link
			);
		}

		if ( isset( $terms_conditions_link ) ) {
			$html .= sprintf(
				'<a class="license-form-external-links" target="_blank" href="%s">Terms & Conditions</a>',
				$terms_conditions_link
			);
		}

		return $html;
	}
	/**
	 *  ALternate method link.
	 *
	 * @param string $content Content.
	 * @return $content.
	 */
	public function alternate_method_link( $content ) {

			$bsf_activation_nonce = wp_create_nonce( 'bsf_activation_nonce' );
			$content              = sprintf(
				'<a href="%s">Activate license using purchase key</a>',
				add_query_arg(
					array(
						'activation_method'    => 'license-key',
						'bsf_activation_nonce' => $bsf_activation_nonce,
					)
				)
			);

			return $content;
	}
}

/**
 *  BSF envato register.
 *
 * @param string $args Arguments..
 * @return envato_register().
 */
function bsf_envato_register( $args ) {
	$bsf_envato_activate = BSF_Envato_Activate::instance();

	return $bsf_envato_activate->envato_register( $args );
}
