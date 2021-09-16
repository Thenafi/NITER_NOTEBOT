( function( $ ) {

	var RegisterUAELQuickView = function( $scope, $ ) {

		var scope_id 		= $scope.data( 'id' );
		var quick_view_btn 	= $scope.find('.uael-quick-view-btn');
		var modal_wrap 		= $scope.find('.uael-quick-view-' + scope_id );

		modal_wrap.appendTo( document.body );

		var uael_quick_view_bg    	= modal_wrap.find( '.uael-quick-view-bg' ),
			uael_qv_modal    		= modal_wrap.find( '#uael-quick-view-modal' ),
			uael_qv_content  		= uael_qv_modal.find( '#uael-quick-view-content' ),
			uael_qv_close_btn 		= uael_qv_modal.find( '#uael-quick-view-close' ),
			uael_qv_wrapper  		= uael_qv_modal.find( '.uael-content-main-wrapper'),
			uael_qv_wrapper_w 		= uael_qv_wrapper.width(),
			uael_qv_wrapper_h 		= uael_qv_wrapper.height();

		$scope
			.off( 'click', '.uael-quick-view-btn' )
			.on( 'click', '.uael-quick-view-btn', function(e){
				e.preventDefault();

				var $this       = $(this);
				var	wrap 		= $this.closest('li.product');
				var product_id  = $this.data( 'product_id' );

				if( ! uael_qv_modal.hasClass( 'loading' ) ) {
					uael_qv_modal.addClass('loading');
				}

				if ( ! uael_quick_view_bg.hasClass( 'uael-quick-view-bg-ready' ) ) {
					uael_quick_view_bg.addClass( 'uael-quick-view-bg-ready' );
				}

				$(document).trigger( 'uael_quick_view_loading' );

				uael_qv_ajax_call( $this, product_id );
			});

		$scope
			.off( 'click', '.uael-quick-view-data' )
			.on( 'click', '.uael-quick-view-data', function(e){
				e.preventDefault();
				var $this       = $(this);
				var	wrap 		= $this.closest('li.product');
				var product_id  = $this.data( 'product_id' );

				if( ! uael_qv_modal.hasClass( 'loading' ) ) {
					uael_qv_modal.addClass('loading');
				}

				if ( ! uael_quick_view_bg.hasClass( 'uael-quick-view-bg-ready' ) ) {
					uael_quick_view_bg.addClass( 'uael-quick-view-bg-ready' );
				}

				$(document).trigger( 'uael_quick_view_loading' );

				uael_qv_ajax_call( $this, product_id );
			});

		var uael_qv_ajax_call = function( t, product_id ) {

			uael_qv_modal.css( 'opacity', 0 );

			$.ajax({
	            url: uael.ajax_url,
				data: {
					action: 'uael_woo_quick_view',
					product_id: product_id,
					nonce: uael_wc_script.quick_view_nonce,
				},				
				dataType: 'html',
				type: 'POST',
				success: function (data) {
					uael_qv_content.html(data);
					uael_qv_content_height();
				}
			});
		};

		var uael_qv_content_height = function() {

			// Variation Form
			var form_variation = uael_qv_content.find('.variations_form');

			form_variation.trigger( 'check_variations' );
			form_variation.trigger( 'reset_image' );

			if (!uael_qv_modal.hasClass('open')) {

				uael_qv_modal.removeClass('loading').addClass('open');

				var scrollbar_width = uael_get_scrollbar_width();
				var $html = $('html');

				$html.css( 'margin-right', scrollbar_width );
				$html.addClass('uael-quick-view-is-open');
			}

			var var_form = uael_qv_modal.find('.variations_form');
			if ( var_form.length > 0 && 'function' === typeof var_form.wc_variation_form) {
				var_form.wc_variation_form();
				var_form.find('select').change();
			}

			uael_qv_content.imagesLoaded( function(e) {

				var image_slider_wrap = uael_qv_modal.find('.uael-qv-image-slider');

				if ( image_slider_wrap.find('li').length > 1 ) {
					image_slider_wrap.flexslider({
						animation: "slide",
						start: function( slider ){
							setTimeout(function() {
								uael_update_summary_height( true );
							}, 300);
						},
					});
				}else{
					setTimeout(function() {
						uael_update_summary_height( true );
					}, 300);
				}
			});

			// stop loader
			$(document).trigger('uael_quick_view_loader_stop');
		};

		var uael_qv_close_modal = function() {

			// Close box by click overlay
			uael_qv_wrapper.on( 'click', function(e){

				if ( this === e.target ) {
					uael_qv_close();
				}
			});

			// Close box with esc key
			$(document).keyup(function(e){
				if( e.keyCode === 27 ) {
					uael_qv_close();
				}
			});

			// Close box by click close button
			uael_qv_close_btn.on( 'click', function(e) {
				e.preventDefault();
				uael_qv_close();
			});

			var uael_qv_close = function() {
				uael_quick_view_bg.removeClass( 'uael-quick-view-bg-ready' );
				uael_qv_modal.removeClass('open').removeClass('loading');
				$('html').removeClass('uael-quick-view-is-open');
				$('html').css( 'margin-right', '' );

				setTimeout(function () {
					uael_qv_content.html('');
				}, 600);
			}
		};


		/*var	ast_qv_center_modal = function() {

			ast_qv_wrapper.css({
				'width'     : '',
				'height'    : ''
			});

			ast_qv_wrapper_w 	= ast_qv_wrapper.width(),
			ast_qv_wrapper_h 	= ast_qv_wrapper.height();

			var window_w = $(window).width(),
				window_h = $(window).height(),
				width    = ( ( window_w - 60 ) > ast_qv_wrapper_w ) ? ast_qv_wrapper_w : ( window_w - 60 ),
				height   = ( ( window_h - 120 ) > ast_qv_wrapper_h ) ? ast_qv_wrapper_h : ( window_h - 120 );

			ast_qv_wrapper.css({
				'left' : (( window_w/2 ) - ( width/2 )),
				'top' : (( window_h/2 ) - ( height/2 )),
				'width'     : width + 'px',
				'height'    : height + 'px'
			});
		};

		*/
		var uael_update_summary_height = function( update_css ) {
			var quick_view = uael_qv_content,
				img_height = quick_view.find( '.product .uael-qv-image-slider' ).first().height(),
				summary    = quick_view.find('.product .summary.entry-summary'),
				content    = summary.css('content');

			if ( 'undefined' != typeof content && 544 == content.replace( /[^0-9]/g, '' ) && 0 != img_height && null !== img_height ) {
				summary.css('height', img_height );
			} else {
				summary.css('height', '' );
			}

			if ( true === update_css ) {
				uael_qv_modal.css( 'opacity', 1 );
			}
		};

		var uael_get_scrollbar_width = function () {

			var div = $('<div style="width:50px;height:50px;overflow:hidden;position:absolute;top:-200px;left:-200px;"><div style="height:100px;"></div>');
			// Append our div, do our calculation and then remove it
			$('body').append(div);
			var w1 = $('div', div).innerWidth();
			div.css('overflow-y', 'scroll');
			var w2 = $('div', div).innerWidth();
			$(div).remove();

			return (w1 - w2);
		}


		uael_qv_close_modal();
		//uael_update_summary_height();

		window.addEventListener("resize", function(event) {
			uael_update_summary_height();
		});

		/* Add to cart ajax */
		/**
		 * uael_add_to_cart_ajax class.
		 */
		var uael_add_to_cart_ajax = function() {

			modal_wrap
				.off( 'click', '#uael-quick-view-content .single_add_to_cart_button' )
				.off( 'uael_added_to_cart' )
				.on( 'click', '#uael-quick-view-content .single_add_to_cart_button', this.onAddToCart )
				.on( 'uael_added_to_cart', this.updateButton );
		};

		/**
		 * Handle the add to cart event.
		 */
		uael_add_to_cart_ajax.prototype.onAddToCart = function( e ) {

			e.preventDefault();
			
			var $form = $(this).closest('form');

			// If the form inputs are invalid
			if( ! $form[0].checkValidity() ) {
				$form[0].reportValidity();
				return false;
			}

			var $thisbutton = $( this ),
				product_id = $(this).val(),
				variation_id = $('input[name="variation_id"]').val() || '',
				quantity = $('input[name="quantity"]').val();

			if ( $thisbutton.is( '.single_add_to_cart_button' ) ) {

				$thisbutton.removeClass( 'added' );
				$thisbutton.addClass( 'loading' );

				// Ajax action.
				if ( variation_id != '') {
					jQuery.ajax ({
						url: uael.ajax_url,
						type:'POST',
						data: {
							action: 'uael_add_cart_single_product',
							product_id : product_id,
							variation_id: variation_id,
							quantity: quantity,
							nonce: uael_wc_script.add_cart_nonce,
						},
						success:function(results) {
							// Trigger event so themes can refresh other areas.
							$( document.body ).trigger( 'wc_fragment_refresh' );
							modal_wrap.trigger( 'uael_added_to_cart', [ $thisbutton ] );
						}
					});
				} else {
					jQuery.ajax ({
						url: uael.ajax_url,
						type:'POST',
						data: {
							action: 'uael_add_cart_single_product',
							product_id : product_id,
							quantity: quantity,
							nonce: uael_wc_script.add_cart_nonce,
						},
						success:function(results) {
							// Trigger event so themes can refresh other areas.
							$( document.body ).trigger( 'wc_fragment_refresh' );
							modal_wrap.trigger( 'uael_added_to_cart', [ $thisbutton ] );
						}
					});
				}
			}
		};

		/**
		 * Update cart page elements after add to cart events.
		 */
		uael_add_to_cart_ajax.prototype.updateButton = function( e, button ) {
			button = typeof button === 'undefined' ? false : button;

			if ( $(button) ) {
				$(button).removeClass( 'loading' );
				$(button).addClass( 'added' );

				// View cart text.
				if ( ! uael.is_cart && $(button).parent().find( '.added_to_cart' ).length === 0  && uael.is_single_product) {
					$(button).after( ' <a href="' + uael.cart_url + '" class="added_to_cart wc-forward" title="' +
						uael.view_cart + '">' + uael.view_cart + '</a>' );
				}


			}
		};

		/**
		 * Init uael_add_to_cart_ajax.
		 */
		new uael_add_to_cart_ajax();
	}

	var RegisterUAELAddCart = function( $scope, $ ) {

		//
		$layout = $scope.data('widget_type');

		if ( 'uael-woo-products.grid-franko' !== $layout && 'uael-woo-products-slider.slider-franko' !== $layout ) {
			return;
		}

		/* Add to cart for styles */
		var style_add_to_cart = function() {

			//fa-spinner

			$( document.body )
				.off( 'click', '.uael-product-actions .uael-add-to-cart-btn.product_type_simple' )
				.off( 'uael_product_actions_added_to_cart' )
				.on( 'click', '.uael-product-actions .uael-add-to-cart-btn.product_type_simple', this.onAddToCart )
				.on( 'uael_product_actions_added_to_cart', this.updateButton );
		};

		/**
		 * Handle the add to cart event.
		 */
		style_add_to_cart.prototype.onAddToCart = function( e ) {

			e.preventDefault();

			var $thisbutton = $(this),
				product_id 	= $thisbutton.data('product_id'),
				quantity 	= 1,
				cart_icon 	= $thisbutton.find('uael-action-item');

			$thisbutton.removeClass( 'added' );
			$thisbutton.addClass( 'loading' );

			jQuery.ajax ({
				url: uael.ajax_url,
				type:'POST',
				data: {
					action: 'uael_add_cart_single_product',
					product_id : product_id,
					quantity: quantity,
					nonce: uael_wc_script.add_cart_nonce,
				},

				success:function(results) {
					// Trigger event so themes can refresh other areas.
					$( document.body ).trigger( 'wc_fragment_refresh' );
					$( document.body ).trigger( 'uael_product_actions_added_to_cart', [ $thisbutton ] );
				}
			});
		};

		/**
		 * Update cart page elements after add to cart events.
		 */
		style_add_to_cart.prototype.updateButton = function( e, button ) {
			button = typeof button === 'undefined' ? false : button;

			if ( $(button) ) {
				$(button).removeClass( 'loading' );
				$(button).addClass( 'added' );

				// Show view cart notice.
				/*if ( ! uael.is_cart && $(button).parent().find( '.added_to_cart' ).length === 0  && uael.is_single_product) {
					$(button).after( ' <a href="' + uael.cart_url + '" class="added_to_cart wc-forward" title="' +
						uael.view_cart + '">' + uael.view_cart + '</a>' );
				}*/
			}
		};

		/**
		 * Init style_add_to_cart.
		 */
		new style_add_to_cart();
	}

	/**
	 * Function for Product Categories.
	 *
	 */
	var WidgetUAELWooCategories = function( $scope, $ ) {
		if ( 'undefined' == typeof $scope ) {
			return;
		}
		var cat_slider 	= $scope.find('.uael-woo-categories-slider');

		if ( cat_slider.length > 0 ) {
			var slider_selector = cat_slider.find('ul.products'),
				slider_options 	= JSON.parse( cat_slider.attr('data-cat_slider') );

			slider_selector.slick(slider_options);
		}
	}

	/**
	 * Function for Product Grid.
	 *
	 */
	var WidgetUAELWooProducts = function( $scope, $ ) {

		if ( 'undefined' == typeof $scope ) {
			return;
		}

		/* Slider */
		var slider_wrapper 	= $scope.find('.uael-woo-products-slider');

		if ( slider_wrapper.length > 0 ) {
			var slider_selector = slider_wrapper.find('ul.products'),
				slider_options 	= JSON.parse( slider_wrapper.attr('data-woo_slider') );

			slider_selector.slick(slider_options);
		}

		if ( ! elementorFrontend.isEditMode()  ) {
			/* Common */
			RegisterUAELQuickView( $scope, $ );
			/* Style specific cart button */
			RegisterUAELAddCart( $scope, $ );
		}

	}

	/**
	 * Function for Product Grid.
	 *
	 */
	var WidgetUAELWooAddToCart = function( $scope, $ ) {

		$('body').off('added_to_cart.uael_cart' ).on( 'added_to_cart.uael_cart', function(e, fragments, cart_hash, btn){

			if ( btn.closest('.elementor-widget-uael-woo-add-to-cart').length > 0 ) {

				if ( btn.hasClass('uael-redirect') ) {

					setTimeout(function() {
						// View cart text.
						if ( ! uael.is_cart && btn.hasClass( 'added' ) ) {
							window.location = uael.cart_url;
						}
					}, 200);
				}
			}
		});
	}

	$( document )
	.off( 'click', '.uael-woocommerce-pagination a.page-numbers' )
	.on( 'click', '.uael-woocommerce-pagination a.page-numbers', function( e ) {

		$scope = $( this ).closest( '.elementor-widget-uael-woo-products' );

		if ( $scope.find( '.uael-woocommerce' ).hasClass( 'uael-woo-query-main' ) ) {
			return;
		}

		e.preventDefault();

		$scope.find( 'ul.products' ).after( '<div class="uael-woo-loader"><div class="uael-loader"></div><div class="uael-loader-overlay"></div></div>' );

		var node =$scope.data( 'id' );

		var page_id = $scope.find( '.uael-woocommerce' ).data('page');
		var page_number = 1;
		var curr = parseInt( $scope.find( '.uael-woocommerce-pagination .page-numbers.current' ).html() );
		var skin = $scope.find( '.uael-woocommerce' ).data( 'skin' );

		if ( $( this ).hasClass( 'next' ) ) {
			page_number = curr + 1;
		} else if ( $( this ).hasClass( 'prev' ) ) {
			page_number = curr - 1;
		} else {
			page_number = $( this ).html();
		}

		$.ajax({
			url: uael.ajax_url,
			data: {
				action: 'uael_get_products',
				page_id : page_id,
				widget_id: $scope.data( 'id' ),
				category: '',
				skin: skin,
				page_number : page_number,
				nonce : uael_wc_script.get_product_nonce,
			},
			dataType: 'json',
			type: 'POST',
			success: function ( data ) {

				$scope.find( '.uael-woo-loader' ).remove();

				$('html, body').animate({
					scrollTop: ( ( $scope.find( '.uael-woocommerce' ).offset().top ) - 30 )
				}, 'slow');

				var sel = $scope.find( '.uael-woo-products-inner ul.products' );

				sel.replaceWith( data.data.html );
				$scope.find( '.uael-woocommerce-pagination' ).replaceWith( data.data.pagination );

				$( window ).trigger( 'uael_woocommerce_after_pagination', [ page_id, node ] );
			}
		});

	} );

	$( window ).on( 'elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction('frontend/element_ready/uael-woo-products.grid-default', WidgetUAELWooProducts);
		elementorFrontend.hooks.addAction('frontend/element_ready/uael-woo-products.grid-franko', WidgetUAELWooProducts);
		elementorFrontend.hooks.addAction('frontend/element_ready/uael-woo-add-to-cart.default', WidgetUAELWooAddToCart);
		elementorFrontend.hooks.addAction('frontend/element_ready/uael-woo-categories.default', WidgetUAELWooCategories);
	});


} )( jQuery );
