<?php
/**
 * General Setting Form
 *
 * @package UAEL
 */

use UltimateElementor\Classes\UAEL_Helper;

$settings = UAEL_Helper::get_integrations_options();

$languages = UAEL_Helper::get_google_map_languages();

if ( isset( $_REQUEST['uael_admin_nonce'] ) && wp_verify_nonce( $_REQUEST['uael_admin_nonce'], 'uael_admin_nonce' ) ) {
	$is_saved = ( isset( $_REQUEST['message'] ) && 'saved' === $_REQUEST['message'] ) ? true : false;
}

$google_status = '';
$yelp_status   = '';

// Action when settings saved.
if ( $is_saved ) {
	UAEL_Helper::get_api_authentication();
}

if ( isset( $settings['google_places_api'] ) && ! empty( $settings['google_places_api'] ) ) {
	$google_status = get_option( 'uael_google_api_status' );
}
if ( isset( $settings['yelp_api'] ) && ! empty( $settings['yelp_api'] ) ) {
	$yelp_status = get_option( 'uael_yelp_api_status' );
}
?>
<div class="uael-container uael-integration-wrapper">
	<form method="post" class="wrap clear" action="" >
		<div class="wrap uael-addon-wrap clear">
			<h1 class="screen-reader-text"><?php esc_attr_e( 'Integrations', 'uael' ); ?></h1>
			<div id="poststuff">
				<div id="post-body" class="columns-1">
					<div id="post-body-content">
						<div class="uael-integration-form-wrap">
							<div class="widgets postbox">
								<div class="inside">
									<div class="form-wrap">
										<div class="form-field">
											<label for="uael-integration-google-api-key" class="uael-integration-heading"><?php esc_attr_e( 'Google Map API Key', 'uael' ); ?></label>
											<p class="install-help uael-p"><strong><?php esc_attr_e( 'Note:', 'uael' ); ?></strong>
											<?php
												$a_tag_open  = '<a target="_blank" rel="noopener" href="' . esc_url( 'https://uaelementor.com/docs/create-google-map-api-key/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin' ) . '">';
												$a_tag_close = '</a>';

												printf(
													/* translators: %1$s: a tag open. */
													esc_attr__( 'This setting is required if you wish to use Google Map in your website. Need help to get Google map API key? Read %1$s this article %2$s.', 'uael' ),
													wp_kses_post( $a_tag_open ),
													wp_kses_post( $a_tag_close )
												);
												?>
											</p>
											<input type="text" name="uael_integration[google_api]" id="uael-integration-google-api-key" class="placeholder placeholder-active" value="<?php echo esc_attr( $settings['google_api'] ); ?>">
										</div>
									</div>
								</div>
							</div>
							<div class="widgets postbox">
								<div class="inside">
									<div class="form-wrap">
										<div class="form-field">
											<label for="uael-integration-google-language" class="uael-integration-heading"><?php esc_attr_e( 'Google Map Localization Language', 'uael' ); ?></label>
											<p class="install-help uael-p"><strong><?php esc_attr_e( 'Note:', 'uael' ); ?></strong>  <?php esc_attr_e( 'This setting sets localization language to google map. The language affects the names of controls, copyright notices, driving directions, and control labels.', 'uael' ); ?></p>
											<p class="uael-p">
											<?php
												$a_tag_open  = '<a href="' . esc_url( 'https://uaelementor.com/docs/how-to-display-uaels-google-maps-widget-in-your-local-language/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin' ) . '" target="_blank" rel="noopener">';
												$a_tag_close = '</a>';
												printf(
													/* translators: %1$s: a tag open. */
													esc_attr__( 'Need help to understand this feature? Read %1$s this article %2$s.', 'uael' ),
													wp_kses_post( $a_tag_open ),
													wp_kses_post( $a_tag_close )
												);
												?>
											</p>
											<select name="uael_integration[language]" id="uael-integration-google-language" class="placeholder placeholder-active">
												<option value=""><?php esc_attr_e( 'Default', 'uael' ); ?></option>
											<?php foreach ( $languages as $key => $value ) { ?>
												<?php
												$selected = '';
												if ( $key === $settings['language'] ) {
													$selected = 'selected="selected" ';
												}
												?>
												<option value="<?php echo esc_attr( $key ); ?>" <?php echo esc_attr( $selected ); ?>><?php echo esc_attr( $value ); ?></option>
											<?php } ?>
											</select>
										</div>
									</div>
								</div>
							</div>

							<div class="widgets postbox">
								<div class="inside">
									<div class="form-wrap">
										<div class="form-field">
											<label for="uael-integration-google-places-key" class="uael-integration-heading"><?php esc_attr_e( 'Business Reviews - Google Places API Key', 'uael' ); ?></label>
											<p class="install-help uael-p"><strong><?php esc_attr_e( 'Note:', 'uael' ); ?></strong>
											<?php
												$a_tag_open  = '<a target="_blank" rel="noopener" href="' . esc_url( 'https://uaelementor.com/docs/get-google-places-api-key/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin' ) . '">';
												$a_tag_close = '</a>';

												printf(
													/* translators: %1$s: a tag open. */
													esc_attr__( 'This setting is required if you wish to use Google Places Reviews in your website. Need help to get Google Places API key? Read %1$s this article %2$s.', 'uael' ),
													wp_kses_post( $a_tag_open ),
													wp_kses_post( $a_tag_close )
												);
												?>
											</p>
											<input type="text" name="uael_integration[google_places_api]" id="uael-integration-google-places-key" class="placeholder placeholder-active" value="<?php echo esc_attr( $settings['google_places_api'] ); ?>">
											<?php if ( 'yes' === $google_status && $is_saved ) { ?>
												<span class="uael-response-success"><?php esc_attr_e( 'Your API key authenticated successfully!', 'uael' ); ?></span>
											<?php } elseif ( 'no' === $google_status ) { ?>
													<span class="uael-response-warning"><?php esc_attr_e( 'Entered API key is invalid', 'uael' ); ?></span>
											<?php } elseif ( 'exceeded' === $google_status && $is_saved ) { ?>
													<span class="uael-google-error-response">
														<span class="uael-response-warning">
														<?php
														printf(
															/* translators: 1: <b> 2: </b> */
															esc_html__( '%1$sGoogle Error Message:%2$s', 'uael' ),
															'<b>',
															'</b>'
														);
														?>
														</span>
														<?php
														$a_tag_open  = '<a href="http://g.co/dev/maps-no-account" target="_blank" rel="noopener">';
														$a_tag_close = '</a>';

															printf(
																/* translators: %1$s command. */
																esc_attr__( 'You have exceeded your daily request quota for this API. If you did not set a custom daily request quota, verify your project has an active billing account.</br>Click %1$s here %2$s to enable billing.', 'uael' ),
																wp_kses_post( $a_tag_open ),
																wp_kses_post( $a_tag_close )
															);
														?>
													</span>
											<?php } ?>

										</div>
									</div>
								</div>
							</div>

							<div class="widgets postbox">
								<div class="inside">
									<div class="form-wrap">
										<div class="form-field">
											<label for="uael-integration-yelp-api-key" class="uael-integration-heading"><?php esc_attr_e( 'Business Reviews - Yelp API Key', 'uael' ); ?></label>
											<p class="install-help uael-p"><strong><?php esc_attr_e( 'Note:', 'uael' ); ?></strong>
											<?php
												$a_tag_open  = '<a target="_blank" rel="noopener" href="' . esc_url( 'https://uaelementor.com/docs/get-yelp-api-key/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin' ) . '">';
												$a_tag_close = '</a>';

												printf(
													/* translators: %1$s: a tag open. */
													esc_attr__( 'This setting is required if you wish to use Yelp Reviews in your website. Need help to get Yelp API key? Read %1$s this article %2$s.', 'uael' ),
													wp_kses_post( $a_tag_open ),
													wp_kses_post( $a_tag_close )
												);
												?>
											</p>
											<input type="text" name="uael_integration[yelp_api]" id="uael-integration-yelp-api-key" class="placeholder placeholder-active" value="<?php echo esc_attr( $settings['yelp_api'] ); ?>">
											<?php if ( 'yes' === $yelp_status && $is_saved ) { ?>
												<div class="uael-response-success"><?php esc_attr_e( 'Your API key authenticated successfully!', 'uael' ); ?></div>
											<?php } elseif ( 'no' === $yelp_status ) { ?>
													<div class="uael-response-warning"><?php esc_attr_e( 'Entered API key is invalid', 'uael' ); ?></div>
											<?php } ?>

										</div>
									</div>
								</div>
							</div>

							<div class="widgets postbox">
								<div class="inside">
									<div class="form-wrap">
										<div class="form-field">
											<label class="uael-integration-heading"><?php esc_attr_e( 'Setup reCAPTCHA v3', 'uael' ); ?></label>
											<p class="install-help uael-p"><strong><?php esc_attr_e( 'Note:', 'uael' ); ?></strong>
											<?php
												$a_tag_open  = '<a target="_blank" rel="noopener" href="' . esc_url( 'https://www.google.com/recaptcha/intro/v3.html' ) . '">';
												$a_tag_close = '</a>';

												printf(
													/* translators: %1$s: a tag open. */
													esc_attr__( '%1$s reCAPTCHA v3 %2$s is a free service by Google that protects your website from spam and abuse. It does this while letting your valid users pass through with ease.', 'uael' ),
													wp_kses_post( $a_tag_open ),
													wp_kses_post( $a_tag_close )
												);
												?>
											</p>
											<p class="install-help uael-p">
											<?php
												$a_tag_open  = '<a target="_blank" rel="noopener" href="' . esc_url( 'https://uaelementor.com/docs/user-registration-form-with-recaptcha/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin' ) . '">';
												$a_tag_close = '</a>';

												printf(
													/* translators: %1$s: a tag open. */
													esc_attr__( 'Read %1$s this article %2$s to learn more.', 'uael' ),
													wp_kses_post( $a_tag_open ),
													wp_kses_post( $a_tag_close )
												);
												?>
											</p>
											<label for="uael-recaptcha-v3-key" class="uael-integration-heading"><?php esc_attr_e( 'Site key', 'uael' ); ?></label>
											<input type="text" name="uael_integration[recaptcha_v3_key]" id="uael-recaptcha-v3-key" class="placeholder placeholder-active" value="<?php echo esc_attr( $settings['recaptcha_v3_key'] ); ?>">
											<br/>
											<br/>
											<label for="uael-recaptcha-v3-secretkey" class="uael-integration-heading"><?php esc_attr_e( 'Secret key', 'uael' ); ?></label>
											<input type="text" name="uael_integration[recaptcha_v3_secretkey]" id="uael-recaptcha-v3-secretkey" class="placeholder placeholder-active" value="<?php echo esc_attr( $settings['recaptcha_v3_secretkey'] ); ?>">
											<br/>
											<br/>
											<label for="uael-recaptcha-v3-score" class="uael-integration-heading"><?php esc_attr_e( 'Score Threshold', 'uael' ); ?></label>
											<input type="text" name="uael_integration[recaptcha_v3_score]" id="uael-recaptcha-v3-score" class="placeholder placeholder-active" value="<?php echo esc_attr( $settings['recaptcha_v3_score'] ); ?>">
											<?php
												echo esc_attr_e( 'Score threshold should be a value between 0 and 1, default: 0.5', 'uael' );
											?>
										</div>
									</div>
								</div>
							</div>

							<div class="widgets postbox">
								<div class="inside">
									<div class="form-wrap">
										<div class="form-field">
											<label class="uael-integration-heading"><?php esc_attr_e( 'Login Form - Google Client ID', 'uael' ); ?></label>
											<p class="install-help uael-p"><strong><?php esc_attr_e( 'Note:', 'uael' ); ?></strong>
											<?php
												$a_tag_open  = '<a target="_blank" rel="noopener" href="' . esc_url( 'https://uaelementor.com/docs/create-google-client-id-for-login-form-widget/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin' ) . '">';
												$a_tag_close = '</a>';

												printf(
													/* translators: %1$s: a tag open. */
													esc_attr__( 'This setting is required if you wish to use Login with Google in your website. Need help to get Google Client ID? Read %1$s this article %2$s.', 'uael' ),
													wp_kses_post( $a_tag_open ),
													wp_kses_post( $a_tag_close )
												);
												?>
											</p>
											<label for="uael-google-client-id" class="uael-integration-heading"><?php esc_attr_e( 'Google Client ID', 'uael' ); ?></label>
											<input type="text" name="uael_integration[google_client_id]" id="uael-google-client-id" class="placeholder placeholder-active" value="<?php echo esc_attr( $settings['google_client_id'] ); ?>">
										</div>
									</div>
								</div>
							</div>

							<div class="widgets postbox">
								<div class="inside">
									<div class="form-wrap">
										<div class="form-field">
											<label class="uael-integration-heading"><?php esc_attr_e( 'Login Form - Facebook App Details', 'uael' ); ?></label>
											<p class="install-help uael-p"><strong><?php esc_attr_e( 'Note:', 'uael' ); ?></strong>
											<?php
												$a_tag_open  = '<a target="_blank" rel="noopener" href="' . esc_url( 'https://uaelementor.com/docs/create-facebook-app-id-for-login-form-widget/?utm_source=uael-pro-dashboard&utm_medium=uael-menu-page&utm_campaign=uael-pro-plugin' ) . '">';
												$a_tag_close = '</a>';

												printf(
													/* translators: %1$s: a tag open. */
													esc_attr__( 'This setting is required if you wish to use Login with Facebook in your website. Need help to get Facebook App Details? Read %1$s this article %2$s.', 'uael' ),
													wp_kses_post( $a_tag_open ),
													wp_kses_post( $a_tag_close )
												);
												?>
											</p>
											<label for="uael-facebook-app-id" class="uael-integration-heading"><?php esc_attr_e( 'Facebook App ID', 'uael' ); ?></label>
											<input type="text" name="uael_integration[facebook_app_id]" id="uael-facebook-app-id" class="placeholder placeholder-active" value="<?php echo esc_attr( $settings['facebook_app_id'] ); ?>">
											<br/>
											<br/>
											<label for="uael-facebook-secret-key" class="uael-integration-heading"><?php esc_attr_e( 'Facebook App Secret', 'uael' ); ?></label>
											<input type="text" name="uael_integration[facebook_app_secret]" id="uael-facebook-secret-key" class="placeholder placeholder-active" value="<?php echo esc_attr( $settings['facebook_app_secret'] ); ?>">
										</div>
									</div>
								</div>
							</div>
						</div>
						<?php submit_button( __( 'Save Changes', 'uael' ), 'uael-save-integration-options button-primary button button-hero' ); ?>
						<?php wp_nonce_field( 'uael-integration', 'uael-integration-nonce' ); ?>
					</div>
				</div>
				<!-- /post-body -->
				<br class="clear">
			</div>
		</div>
	</form>
</div>
