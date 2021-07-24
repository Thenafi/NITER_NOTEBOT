( function( $ ) {

	/**
	 * Nav Menu handler Function.
	 *
	 */
	var WidgetUAELNavMenuHandler = function( $scope, $ ) {

		if ( 'undefined' == typeof $scope )
			return;

		var id = $scope.data( 'id' );
		var wrapper = $scope.find('.elementor-widget-uael-nav-menu ');		
		var layout = $( '.elementor-element-' + id + ' .uael-nav-menu' ).data( 'layout' );
		var flyout_data = $( '.uael-flyout-wrapper' ).data( 'flyout-class' );

		var saved_content = $scope.find( '.saved-content' );

		$( 'div.uael-has-submenu-container' ).removeClass( 'sub-menu-active' );

		_sizeCal( id ); 

		_toggleClick( id );

		if( 'horizontal' !== layout ){

			_eventClick( id );
		}else if ( 'horizontal' === layout && window.matchMedia( "( max-width: 767px )" ).matches ) {

			_eventClick( id );
		}else if ( 'horizontal' === layout && window.matchMedia( "( max-width: 1024px )" ).matches ) {

			_eventClick( id );
		}
		
		_borderClass( id );		

		$( '.elementor-element-' + id + ' .uael-nav-menu-icon' ).off( 'click keyup' ).on( 'click keyup', function() {

			_openMenu( id );
		} );

		$( '.elementor-element-' + id + ' .uael-flyout-close' ).off( 'click keyup' ).on( 'click keyup', function() {

			_closeMenu( id );
		} );

		$( '.elementor-element-' + id + ' .uael-flyout-overlay' ).off( 'click' ).on( 'click', function() {

			_closeMenu( id );
		} );


		$scope.find( '.sub-menu' ).each( function() {

			var parent = $( this ).closest( '.menu-item' );

			$scope.find( parent ).addClass( 'parent-has-child' );
			$scope.find( parent ).removeClass( 'parent-has-no-child' );
		});

		saved_content.each( function() {

			var parent_content = $( this ).closest( '.sub-menu' );

			$scope.find( parent_content ).addClass( 'parent-has-template' );
			$scope.find( parent_content ).removeClass( 'parent-do-not-have-template' );
		});

		if( 'horizontal' == $( '.uael-nav-menu' ).data( 'menu-layout' ) ) {

			saved_content.each( function() {

				var parent_css = $( this ).data( 'left-pos' );

				$( this ).closest( '.sub-menu' ).css( 'left',  parent_css + '%' );
			});
		}	

		$( window ).resize(function(){

			_sizeCal( id ); 

			if( 'horizontal' !== layout ) {

				_eventClick( id );
			}else if ( 'horizontal' === layout && window.matchMedia( "( max-width: 767px )" ).matches ) {

				_eventClick( id );
			}else if ( 'horizontal' === layout && window.matchMedia( "( max-width: 1024px )" ).matches ) {

				_eventClick( id );
			}

			if( 'horizontal' == layout && window.matchMedia( "( min-width: 977px )" ).matches){

				$( '.elementor-element-' + id + ' div.uael-has-submenu-container' ).next().css( 'position', 'absolute');	
			}

			if( 'expandible' == layout || 'flyout' == layout ){

				_toggleClick( id );
			}else if ( 'vertical' == layout || 'horizontal' == layout ) {
				if( window.matchMedia( "( max-width: 767px )" ).matches && ($( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-tablet') || $( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-mobile'))){

					_toggleClick( id );					
				}else if ( window.matchMedia( "( max-width: 1024px )" ).matches && $( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-tablet') ) {
					
					_toggleClick( id );
				}
			}

			_borderClass( id );	

		});


		$scope.find( '.sub-menu.parent-has-template' ).css( 'box-shadow', 'none' );
		$scope.find( '.sub-menu.parent-has-template' ).css( 'border', 'none' );
		$scope.find( '.sub-menu.parent-has-template' ).css( 'border-radius', '0' );

		var padd = $( '.elementor-element-' + id + ' ul.sub-menu li a' ).css( 'paddingLeft' );
		    padd = parseFloat( padd );
            padd = padd + 20;

        $( '.elementor-element-' + id + ' ul.sub-menu li a.uael-sub-menu-item' ).css( 'paddingLeft', padd + 'px' );

        // Acessibility functions

  		$scope.find( '.parent-has-child .uael-has-submenu-container a').attr( 'aria-haspopup', 'true' );
  		$scope.find( '.parent-has-child .uael-has-submenu-container a').attr( 'aria-expanded', 'false' );

  		$scope.find( '.uael-nav-menu__toggle').attr( 'aria-haspopup', 'true' );
  		$scope.find( '.uael-nav-menu__toggle').attr( 'aria-expanded', 'false' );

  		// End of accessibility functions

		$( document ).trigger( 'uael_nav_menu_init', id );

		$( '.elementor-element-' + id + ' div.uael-has-submenu-container' ).on( 'keyup', function(e){

			var $this = $( this );

		  	if( $this.parent().hasClass( 'menu-active' ) ) {

		  		$this.parent().removeClass( 'menu-active' );

		  		$this.parent().next().find('ul').css( { 'visibility': 'hidden', 'opacity': '0', 'height': '0' } );
		  		$this.parent().prev().find('ul').css( { 'visibility': 'hidden', 'opacity': '0', 'height': '0' } );

		  		$this.parent().next().find( 'div.uael-has-submenu-container' ).removeClass( 'sub-menu-active' );
		  		$this.parent().prev().find( 'div.uael-has-submenu-container' ).removeClass( 'sub-menu-active' );
			}else { 

				$this.parent().next().find('ul').css( { 'visibility': 'hidden', 'opacity': '0', 'height': '0' } );
		  		$this.parent().prev().find('ul').css( { 'visibility': 'hidden', 'opacity': '0', 'height': '0' } );

		  		$this.parent().next().find( 'div.uael-has-submenu-container' ).removeClass( 'sub-menu-active' );
		  		$this.parent().prev().find( 'div.uael-has-submenu-container' ).removeClass( 'sub-menu-active' );

				$this.parent().siblings().find( '.uael-has-submenu-container a' ).attr( 'aria-expanded', 'false' );

				$this.parent().next().removeClass( 'menu-active' );
		  		$this.parent().prev().removeClass( 'menu-active' );

				event.preventDefault();

				$this.parent().addClass( 'menu-active' );

				if( 'horizontal' !== layout ){
					$this.addClass( 'sub-menu-active' );	
				}
				
				$this.find( 'a' ).attr( 'aria-expanded', 'true' );

				$this.next().css( { 'visibility': 'visible', 'opacity': '1', 'height': 'auto' } );

				if ( 'horizontal' !== layout ) {
						
		  			$this.next().css( 'position', 'relative');			
				} else if ( 'horizontal' === layout && window.matchMedia( "( max-width: 767px )" ).matches && ($( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-tablet') || $( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-mobile'))) {
										
  					$this.next().css( 'position', 'relative');		  					
				} else if ( 'horizontal' === layout && window.matchMedia( "( max-width: 1024px )" ).matches ) {
					
  					if ( $( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-tablet') ) {

  						$this.next().css( 'position', 'relative');	
  					} else if ( $( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-mobile') || $( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-none') ) {
  						
  						$this.next().css( 'position', 'absolute');	
  					}
  				}		
			}
		});

		$( '.elementor-element-' + id + ' li.menu-item' ).on( 'keyup', function(e){
			var $this = $( this );

	 		$this.next().find( 'a' ).attr( 'aria-expanded', 'false' );
	 		$this.prev().find( 'a' ).attr( 'aria-expanded', 'false' );
	  		
	  		$this.next().find('ul').css( { 'visibility': 'hidden', 'opacity': '0', 'height': '0' } );
	  		$this.prev().find('ul').css( { 'visibility': 'hidden', 'opacity': '0', 'height': '0' } );
	  		
	  		$this.siblings().removeClass( 'menu-active' );
	  		$this.next().find( 'div.uael-has-submenu-container' ).removeClass( 'sub-menu-active' );
		  	$this.prev().find( 'div.uael-has-submenu-container' ).removeClass( 'sub-menu-active' );
		  		
		});
	};


	function _openMenu( id ) {

		var layout = $( '#uael-flyout-content-id-' + id ).data( 'layout' );
		var layout_type = $( '#uael-flyout-content-id-' + id ).data( 'flyout-type' );
		var wrap_width = $( '#uael-flyout-content-id-' + id ).data( 'width' ) + 'px';
		var container = $( '.elementor-element-' + id + ' .uael-flyout-container .uael-side.uael-flyout-' + layout );

		$( '.elementor-element-' + id + ' .uael-flyout-overlay' ).fadeIn( 100 );

		if( 'left' == layout ) {

			$( 'body' ).css( 'margin-left' , '0' );
			container.css( 'left', '0' );

			if( 'push' == layout_type ) {

				$( 'body' ).addClass( 'uael-flyout-animating' ).css({ 
					position: 'absolute',
					width: '100%',
					'margin-left' : wrap_width,
					'margin-right' : 'auto'
				});
			}		
		} else {

			$( 'body' ).css( 'margin-right', '0' );
			container.css( 'right', '0' );

			if( 'push' == layout_type ) {

				$( 'body' ).addClass( 'uael-flyout-animating' ).css({ 
					position: 'absolute',
					width: '100%',
					'margin-left' : '-' + wrap_width,
					'margin-right' : 'auto',
				});
			}
		}		
	}

	function _closeMenu( id ) {

		var layout    = $( '#uael-flyout-content-id-' + id ).data( 'layout' );
		var wrap_width = $( '#uael-flyout-content-id-' + id ).data( 'width' ) + 'px';
		var layout_type = $( '#uael-flyout-content-id-' + id ).data( 'flyout-type' );
		var container = $( '.elementor-element-' + id + ' .uael-flyout-container .uael-side.uael-flyout-' + layout );

		$( '.elementor-element-' + id + ' .uael-flyout-overlay' ).fadeOut( 100 );	

		if( 'left' == layout ) {

			container.css( 'left', '-' + wrap_width );

			if( 'push' == layout_type ) {

				$( 'body' ).css({ 
					position: '',
					'margin-left' : '',
					'margin-right' : '',
				});

				setTimeout( function() {
					$( 'body' ).removeClass( 'uael-flyout-animating' ).css({ 
						width: '',
					});
				});
			}			
		} else {
			container.css( 'right', '-' + wrap_width );
			
			if( 'push' == layout_type ) {

				$( 'body' ).css({
					position: '',
					'margin-right' : '',
					'margin-left' : '',
				});

				setTimeout( function() {
					$( 'body' ).removeClass( 'uael-flyout-animating' ).css({ 
						width: '',
					});
				});
			}
		}	


	}

	function _eventClick( id ){

		var layout = $( '.elementor-element-' + id + ' .uael-nav-menu' ).data( 'layout' );

		$( '.elementor-element-' + id + ' div.uael-has-submenu-container' ).off( 'click' ).on( 'click', function( event ) {

			var $this = $( this );
			
		  	if( $this.hasClass( 'sub-menu-active' ) ) {

		  		if( ! $this.next().hasClass( 'sub-menu-open' ) ) {

		  			$this.find( 'a' ).attr( 'aria-expanded', 'false' );

		  			if( 'horizontal' !== layout ){

						event.preventDefault();

		  				$this.next().css( 'position', 'relative' );	
					}else if ( 'horizontal' === layout && window.matchMedia( "( max-width: 767px )" ).matches && ($( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-tablet') || $( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-mobile'))) {
						
						event.preventDefault();

		  				$this.next().css( 'position', 'relative' );	
					}else if ( 'horizontal' === layout && window.matchMedia( "( max-width: 1024px )" ).matches && ( $( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-tablet') || $( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-mobile'))) {
						
						event.preventDefault();	

		  				$this.next().css( 'position', 'relative' );	
					}	
	  			
					$this.removeClass( 'sub-menu-active' );
					$this.next().removeClass( 'sub-menu-open' );
					$this.next().css( { 'visibility': 'hidden', 'opacity': '0', 'height': '0' } );
					$this.next().css( { 'transition': 'none'} );										
		  		}else{

		  			$this.find( 'a' ).attr( 'aria-expanded', 'false' );
		  			
		  			$this.removeClass( 'sub-menu-active' );
					$this.next().removeClass( 'sub-menu-open' );
					$this.next().css( { 'visibility': 'hidden', 'opacity': '0', 'height': '0' } );
					$this.next().css( { 'transition': 'none'} );	
						  			  			
					if ( 'horizontal' !== layout ){

						$this.next().css( 'position', 'relative' );
					} else if ( 'horizontal' === layout && window.matchMedia( "( max-width: 767px )" ).matches && ($( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-tablet') || $( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-mobile'))) {
						
						$this.next().css( 'position', 'relative' );	
						
					} else if ( 'horizontal' === layout && window.matchMedia( "( max-width: 1024px )" ).matches && ( $( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-tablet') || $( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-mobile'))) {
						
						$this.next().css( 'position', 'absolute' );				
					}	  								
		  		}		  											
			}else {

					$this.find( 'a' ).attr( 'aria-expanded', 'true' );
					if ( 'horizontal' !== layout ) {
						
						event.preventDefault();
			  			$this.next().css( 'position', 'relative');			
					} else if ( 'horizontal' === layout && window.matchMedia( "( max-width: 767px )" ).matches && ($( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-tablet') || $( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-mobile'))) {
						
						event.preventDefault();
	  					$this.next().css( 'position', 'relative');		  					
					} else if ( 'horizontal' === layout && window.matchMedia( "( max-width: 1024px )" ).matches ) {
						event.preventDefault();

	  					if ( $( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-tablet') ) {

	  						$this.next().css( 'position', 'relative');	
	  					} else if ( $( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-mobile') || $( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-none') ) {
	  						
	  						$this.next().css( 'position', 'absolute');	
	  					}
	  				}	
	  					
				$this.addClass( 'sub-menu-active' );
				$this.next().addClass( 'sub-menu-open' );	
				$this.next().css( { 'visibility': 'visible', 'opacity': '1', 'height': 'auto' } );
				$this.next().css( { 'transition': '0.3s ease'} );								
			}
		});

		$( '.elementor-element-' + id + ' .uael-menu-toggle' ).off( 'click keyup' ).on( 'click keyup',function( event ) {

			var $this = $( this );

		  	if( $this.parent().parent().hasClass( 'menu-active' ) ) {

	  			event.preventDefault();

				$this.parent().parent().removeClass( 'menu-active' );
				$this.parent().parent().next().css( { 'visibility': 'hidden', 'opacity': '0', 'height': '0' } );

				if ( 'horizontal' !== layout ) {
						
		  			$this.parent().parent().next().css( 'position', 'relative');			
				} else if ( 'horizontal' === layout && window.matchMedia( "( max-width: 767px )" ).matches && ($( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-tablet') || $( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-mobile'))) {
										
  					$this.parent().parent().next().css( 'position', 'relative');		  					
				} else if ( 'horizontal' === layout && window.matchMedia( "( max-width: 1024px )" ).matches ) {
					
  					if ( $( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-tablet') ) {

  						$this.parent().parent().next().css( 'position', 'relative');	
  					} else if ( $( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-mobile') || $( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-none') ) {
  						
  						$this.parent().parent().next().css( 'position', 'absolute');	
  					}
  				}
			}else { 

				event.preventDefault();

				$this.parent().parent().addClass( 'menu-active' );

				$this.parent().parent().next().css( { 'visibility': 'visible', 'opacity': '1', 'height': 'auto' } );

				if ( 'horizontal' !== layout ) {
						
		  			$this.parent().parent().next().css( 'position', 'relative');			
				} else if ( 'horizontal' === layout && window.matchMedia( "( max-width: 767px )" ).matches && ($( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-tablet') || $( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-mobile'))) {
										
  					$this.parent().parent().next().css( 'position', 'relative');		  					
				} else if ( 'horizontal' === layout && window.matchMedia( "( max-width: 1024px )" ).matches ) {
					
  					if ( $( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-tablet') ) {

  						$this.parent().parent().next().css( 'position', 'relative');	
  					} else if ( $( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-mobile') || $( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-none') ) {
  						
  						$this.parent().parent().next().css( 'position', 'absolute');	
  					}
  				}		
			}
		});
	}

	function _sizeCal( id ){

		$( '.elementor-element-' + id + ' li.menu-item' ).each( function() {

			var $this = $( this );

			var dropdown_width = $this.data('dropdown-width');
			var dropdown_pos = $this.data('dropdown-pos');
			var win_width = $( window ).width();

			if ( 'column' == dropdown_width ){

				var width = $( '.elementor-element-' + id).closest('.elementor-column').outerWidth();
				var closeset_column = $( '.elementor-element-' + id).closest('.elementor-column');

				if( $( 'body' ).hasClass( 'rtl' ) ) {
					var column_right = ( win_width - ( closeset_column.offset().left + closeset_column.outerWidth() ) );
					var template_right = ( win_width - ( $this.offset().left + $this.outerWidth() ) );
					var col_pos =  column_right - template_right;	
					$this.find( 'ul.sub-menu' ).css( 'right', col_pos + 'px' );
				} else {

					var col_pos = closeset_column.offset().left - $this.offset().left;	
					$this.find('ul.sub-menu').css('left', col_pos + 'px' );				
				}				

				$this.find('ul.sub-menu').css('width', width + 'px' );
			}else if ('section' == dropdown_width) {

				var closest_section = $( '.elementor-element-' + id).closest('.elementor-section');
				var width = closest_section.outerWidth();

				$this.find('ul.sub-menu').css('width', width + 'px' );

				if( $( 'body' ).hasClass( 'rtl' ) ) {

					var sec_right = ( win_width - ( closest_section.offset().left + closest_section.outerWidth() ) );
					var template_right = ( win_width - ( $this.offset().left + $this.outerWidth() ) );
					var sec_pos = sec_right - template_right;
					$this.find( 'ul.sub-menu' ).css( 'right', sec_pos + 'px' );
				}else {

					var sec_pos = closest_section.offset().left - $this.offset().left;
					$this.find( 'ul.sub-menu' ).css( 'left', sec_pos + 'px' );
				}
			}else if ( 'widget' == dropdown_width ){

				var nav_widget = $('.elementor-element-' + id + '.elementor-widget-uael-nav-menu');
				var width = nav_widget.outerWidth();

				if( $( 'body' ).hasClass( 'rtl' ) ) {

					var widget_right = ( win_width - ( nav_widget.offset().left + nav_widget.outerWidth() ) );
					var template_right = ( win_width - ( $this.offset().left + $this.outerWidth() ) );
					var widget_pos = widget_right - template_right;
					$this.find( 'ul.sub-menu' ).css( 'right', widget_pos + 'px' );
				} else {
	
					var widget_pos = nav_widget.offset().left - $this.offset().left;
					$this.find( 'ul.sub-menu' ).css( 'left', widget_pos + 'px' );				
				}

				$this.find('ul.sub-menu').css('width', width + 'px' );				
			}else if ('container' == dropdown_width) {

				var container = $( '.elementor-element-' + id).closest('.elementor-container');
				var width = container.outerWidth();

				if( $( 'body' ).hasClass( 'rtl' ) ) {

					var container_right = ( win_width - ( container.offset().left + container.outerWidth() ) );
					var template_right = ( win_width - ( $this.offset().left + $this.outerWidth() ) );
					var widget_pos = container_right - template_right;
					$this.find( 'ul.sub-menu' ).css( 'right', widget_pos + 'px' );
				} else {

					var cont_pos = container.offset().left - $this.offset().left;
					$this.find( 'ul.sub-menu' ).css( 'left', cont_pos + 'px' );
				}

				$this.find('ul.sub-menu').css('width', width + 'px' );
			}

			if('center' == dropdown_pos && ( 'default' == dropdown_width || 'custom' == dropdown_width) ) {

				var parent = $this.find('.uael-has-submenu-container').outerWidth();
				var parent_finder = $this.find('.uael-has-submenu-container');
				var inner_parent = $( parent_finder ).find('a').css('paddingRight');
				var section_width = $this.find('ul.sub-menu').outerWidth();
				var left_pos = ( section_width - parent );

				left_pos = left_pos / 2;	

				if( $( 'body' ).hasClass( 'rtl' ) ) {

					$this.find('ul.sub-menu').css('right', '-' + left_pos + 'px');	
				} else {
					$this.find('ul.sub-menu').css('left', '-' + left_pos + 'px');
				}
			}else if ('right' == dropdown_pos && ( 'default' == dropdown_width || 'custom' == dropdown_width) ) {

				$this.find('ul.sub-menu').css('left', 'auto');
				$this.find('ul.sub-menu').css('right', '0');	
			}
			else if ('left' == dropdown_pos && ( 'default' == dropdown_width || 'custom' == dropdown_width) && $( 'body' ).hasClass( 'rtl' ) ) {

				$this.find('ul.sub-menu').css('right', 'auto');
				$this.find('ul.sub-menu').css('left', '0');	
			}
		});
	}

	function _borderClass( id ){

		$( '.elementor-element-' + id + ' nav').removeClass('uael-dropdown');

		if ( window.matchMedia( "( max-width: 767px )" ).matches ) {

			if( $( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-mobile') || $( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-tablet')){
				
				$( '.elementor-element-' + id + ' nav').addClass('uael-dropdown');
			}else{
				
				$( '.elementor-element-' + id + ' nav').removeClass('uael-dropdown');
			}
		}else if ( window.matchMedia( "( max-width: 1024px )" ).matches ) {

			if( $( '.elementor-element-' + id ).hasClass('uael-nav-menu__breakpoint-tablet') ) {
				
				$( '.elementor-element-' + id + ' nav').addClass('uael-dropdown');
			}else{
				
				$( '.elementor-element-' + id + ' nav').removeClass('uael-dropdown');
			}
		}
	}

	function _toggleClick( id ){

		if ( $( '.elementor-element-' + id + ' .uael-nav-menu__toggle i' ).parent().parent().hasClass( 'uael-active-menu-full-width' ) ){

			$( '.elementor-element-' + id + ' .uael-nav-menu__toggle i' ).parent().parent().next().css( 'left', '0' );

			var width = $( '.elementor-element-' + id ).closest('.elementor-section').outerWidth();
			var sec_pos = $( '.elementor-element-' + id ).closest('.elementor-section').offset().left - $( '.elementor-element-' + id + ' .uael-nav-menu__toggle i' ).parent().parent().next().offset().left;
		
			$( '.elementor-element-' + id + ' .uael-nav-menu__toggle i' ).parent().parent().next().css( 'width', width + 'px' );
			$( '.elementor-element-' + id + ' .uael-nav-menu__toggle i' ).parent().parent().next().css( 'left', sec_pos + 'px' );
		}

		$( '.elementor-element-' + id + ' .uael-nav-menu__toggle' ).off( 'click keyup' ).on( 'click keyup', function( event ) {

			var $this = $( this ).find( 'i' );

			if ( $this.parent().parent().hasClass( 'uael-active-menu' ) ) {

				var layout = $( '.elementor-element-' + id + ' .uael-nav-menu' ).data( 'layout' );
				var full_width = $this.parent().parent().next().data( 'full-width' );
				var toggle_icon = $( '.elementor-element-' + id + ' nav' ).data( 'toggle-icon' );

				$( '.elementor-element-' + id).find( '.uael-nav-menu-icon i' ).attr( 'class', toggle_icon );

				$this.parent().parent().removeClass( 'uael-active-menu' );
				$this.parent().parent().attr( 'aria-expanded', 'false' );
				
				if ( 'yes' == full_width ){

					$this.parent().parent().removeClass( 'uael-active-menu-full-width' );
				
					$this.parent().parent().next().css( 'width', 'auto' );
					$this.parent().parent().next().css( 'left', '0' );
					$this.parent().parent().next().css( 'z-index', '0' );
				}				
			} else {

				var layout = $( '.elementor-element-' + id + ' .uael-nav-menu' ).data( 'layout' );
				var full_width = $this.parent().parent().next().data( 'full-width' );
				var close_icon = $( '.elementor-element-' + id + ' nav' ).data( 'close-icon' );

				$( '.elementor-element-' + id).find( '.uael-nav-menu-icon i' ).attr( 'class', close_icon );
				
				$this.parent().parent().addClass( 'uael-active-menu' );
				$this.parent().parent().attr( 'aria-expanded', 'true' );

				if ( 'yes' == full_width ){

					$this.parent().parent().addClass( 'uael-active-menu-full-width' );

					var width = $( '.elementor-element-' + id ).closest('.elementor-section').outerWidth();
					var sec_pos = $( '.elementor-element-' + id ).closest('.elementor-section').offset().left - $this.parent().parent().next().offset().left;
				
					$this.parent().parent().next().css( 'width', width + 'px' );
					$this.parent().parent().next().css( 'left', sec_pos + 'px' );
					$this.parent().parent().next().css( 'z-index', '9999' );
				}
			}

			if( $( '.elementor-element-' + id + ' nav' ).hasClass( 'menu-is-active' ) ) {

				$( '.elementor-element-' + id + ' nav' ).removeClass( 'menu-is-active' );
			}else {

				$( '.elementor-element-' + id + ' nav' ).addClass( 'menu-is-active' );
			}				
		} );
	}

	$( document ).on( 'uael_nav_menu_init', function( e, id ){

		_sizeCal( id );
	});

	$( window ).on( 'elementor/frontend/init', function () {

		elementorFrontend.hooks.addAction( 'frontend/element_ready/uael-nav-menu.default', WidgetUAELNavMenuHandler );

	});

} )( jQuery );
