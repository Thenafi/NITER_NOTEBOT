( function( $ ) {
	var device_mode;


	OffCanvas = {

		/**
		* Invoke Show Off-Canvas 
		*/
		_show: function( canvas_id ) {

			var $canvas_element = $( '#offcanvas-' + canvas_id );

			var wrap_width = $canvas_element.width() + 'px';

			/* If Off-Canvas at Left position */
			if( $canvas_element.hasClass( 'position-at-left' ) ) {

				$( 'body' ).css( 'margin-left' , '0' );
				$canvas_element.css( 'left', '0' );

				/* If Push Transition is enabled */
				if( $canvas_element.hasClass( 'uael-offcanvas-type-push' ) ) {

					$( 'body' ).addClass( 'uael-offcanvas-animating' ).css({ 
						position: 'absolute',
						width: '100%',
						'margin-left' : wrap_width,
						'margin-right' : 'auto'
					});

				}

				$canvas_element.addClass( 'uael-offcanvas-show' );

			} else {

				$( 'body' ).css( 'margin-right', '0' );
				$canvas_element.css( 'right', '0' );

				/* If Push Transition is enabled */
				if( $canvas_element.hasClass( 'uael-offcanvas-type-push' ) ) {

					$( 'body' ).addClass( 'uael-offcanvas-animating' ).css({ 
						position: 'absolute',
						width: '100%',
						'margin-left' : '-' + wrap_width,
						'margin-right' : 'auto',
					});
				}

				$canvas_element.addClass( 'uael-offcanvas-show' ); 
			}

			if( $canvas_element.hasClass( 'uael-offcanvas-scroll-disable' ) ) {
				$( 'html' ).addClass( 'uael-offcanvas-enabled' );
			}

			device_mode = $( 'body' ).data( 'elementor-device-mode' );
			if( 'mobile' == device_mode ){
			    $( 'html' ).addClass( 'uael-off-canvas-overlay' );
			} 
		},

		/**
		 * Invoke Close Off-Canvas
		 */
		_close: function( canvas_id ) {
			var $canvas_element = $( '#offcanvas-' + canvas_id );

			var wrap_width = $canvas_element.width() + 'px';

			/* If Off-Canvas at Left position */
			if( $canvas_element.hasClass( 'position-at-left' ) ) {

				$canvas_element.css( 'left', '-' + wrap_width );

				/* If Push Transition  is enabled*/
				if( $canvas_element.hasClass( 'uael-offcanvas-type-push' ) ) {

					$( 'body' ).css({ 
						position: '',
						'margin-left' : '',
						'margin-right' : '',
					});

					setTimeout( function() {
						$( 'body' ).removeClass( 'uael-offcanvas-animating' ).css({ 
							width: '',
						});
					}, 300 );
				}

				$canvas_element.removeClass( 'uael-offcanvas-show' );

			} else {
				$canvas_element.css( 'right', '-' + wrap_width );

				/* If Push Transition is enabled */
				if( $canvas_element.hasClass( 'uael-offcanvas-type-push' ) ) {

					$( 'body' ).css({
						position: '',
						'margin-right' : '',
						'margin-left' : '',
					});

					setTimeout( function() {
						$( 'body' ).removeClass( 'uael-offcanvas-animating' ).css({ 
							width: '',
						});
					}, 300 );
				}

				$canvas_element.removeClass( 'uael-offcanvas-show' );
			}

			$( 'html' ).removeClass( 'uael-offcanvas-enabled' );

			device_mode = $( 'body' ).data( 'elementor-device-mode' );
			if( 'mobile' == device_mode ){
			    $( 'html' ).removeClass( 'uael-off-canvas-overlay' );
			}
		},
	}

		/**
		* Trigger open Off Canvas On Click Button/Icon
		*/
		$( document ).off( 'click.opentrigger' ).on( 'click.opentrigger', '.uael-offcanvas-trigger', function() {
			var canvas_id = $( this ).closest( '.elementor-element' ).data( 'id' );
			var selector = $( '.uaoffcanvas-' + canvas_id );
			var trigger_on = selector.data( 'trigger-on' );
			if( 'icon' == trigger_on || 'button' == trigger_on ) {
				OffCanvas._show( canvas_id );
			}
		} );

		/*
		* uael_offcanvas_init trigger
		*/
		$( document ).on( 'uael_offcanvas_init', function( e, node_id ) {

			/*
			* Close on ESC 
			*/
			$( document).on( 'keyup', function(e) {
				if ( e.keyCode == 27 ) 
				{ 	 
					$( '.uael-offcanvas-parent-wrapper' ).each( function() {
						var $this = $( this );
						var canvas_id = $this.closest( '.elementor-element' ).data( 'id' );
						var close_on_esc = $this.data( 'close-on-esc' );	

						if( 'yes' == close_on_esc ) {  
							OffCanvas._close( canvas_id );  
						}
					});				
				}
				  	
			});

			/**
			* Close on Icon
			*/
			$( '.uael-offcanvas-close' ).click(function () {
					var canvas_id = $( this ).closest( '.elementor-element' ).data( 'id' );
					OffCanvas._close( canvas_id ); 
						
			});

			/**
			* Close On Overlay Click
			*/
			$( '.uael-offcanvas-overlay' ).off('click.overlaytrigger').on( 'click.overlaytrigger', function( e ) {

				$( '.uael-offcanvas-parent-wrapper' ).each( function() {
					var $this = $( this );
					var canvas_id = $this.closest( '.elementor-element' ).data( 'id' );
					var close_on_overlay = $this.data( 'close-on-overlay' );	

					if( 'yes' == close_on_overlay ) {
						OffCanvas._close( canvas_id ); 
					}
				});		
			});

			/**
			* If Preview-Mode is ON
			*/
			if( $( '#offcanvas-' + node_id ).hasClass( 'uael-show-preview' ) ) {
				setTimeout( function() {
						OffCanvas._show( node_id );
				}, 400 );
			} else {
				setTimeout( function() {
						OffCanvas._close( node_id );
				}, 400 );
			}

		} );

		/* On Load page event */
		$( document ).ready( function( e ) {

			$( '.uael-offcanvas-parent-wrapper' ).each( function() {
				
				var $this = $( this );
				var tmp_id = $this.attr( 'id' );
				var canvas_id = tmp_id.replace( '-overlay', '' );
				var trigger_on = $this.data( 'trigger-on' );
				var custom = $this.data( 'custom' );
				var custom_id = $this.data( 'custom-id' );

				// Custom Class click event
				if( 'custom' == trigger_on ) {
					if( 'undefined' != typeof custom && '' != custom ) {
						var custom_selectors = custom.split( ',' );
						if( custom_selectors.length > 0 ) {
							for( var i = 0; i < custom_selectors.length; i++ ) {
								if( 'undefined' != typeof custom_selectors[i] && '' != custom_selectors[i] ) {
									$( '.' + custom_selectors[i] ).css( "cursor", "pointer" );
									$( document ).on( 'click', '.' + custom_selectors[i], function() {
										OffCanvas._show( canvas_id );
									} );
								}
							}
						}
					}
				}

				// Custom ID click event
				if( 'custom_id' == trigger_on ) {
					if( 'undefined' != typeof custom_id && '' != custom_id ) {
						var custom_selectors = custom_id.split( ',' );
						if( custom_selectors.length > 0 ) {
							for( var i = 0; i < custom_selectors.length; i++ ) {
								if( 'undefined' != typeof custom_selectors[i] && '' != custom_selectors[i] ) {
									$( '#' + custom_selectors[i] ).css( "cursor", "pointer" );
									$( document ).on( 'click', '#' + custom_selectors[i], function() {
										OffCanvas._show( canvas_id );
									} );
								}
							}
						}
					}
				}
			} );

		} );

		/**
		 * Off-Canvas handler Function.
		 *
		 */
		var WidgetOffCanvasHandler = function( $scope, $ ) {

			if ( 'undefined' == typeof $scope )
				return;
			
			if ( $scope.hasClass('elementor-hidden-desktop') ) {
	        	$scope.find( '.uael-offcanvas-parent-wrapper' ).addClass( 'uael-offcanvas-hide-desktop' );
			}

			if ( $scope.hasClass('elementor-hidden-tablet') ) {
	        	$scope.find( '.uael-offcanvas-parent-wrapper' ).addClass( 'uael-offcanvas-hide-tablet' );
			}

			if ( $scope.hasClass('elementor-hidden-phone') ) {
	        	$scope.find( '.uael-offcanvas-parent-wrapper' ).addClass( 'uael-offcanvas-hide-phone' );
			}

			$( document ).trigger( 'uael_offcanvas_init', [ $scope.data( 'id' ) ] );
		};

		$( window ).on( 'elementor/frontend/init', function () {

			elementorFrontend.hooks.addAction( 'frontend/element_ready/uael-offcanvas.default', WidgetOffCanvasHandler );

		});

} )( jQuery );
