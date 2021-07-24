( function ( $ ) {

  var countdownInterval = [];
  var resetInterval = [];
  var countdown_animation;

 /*
  * Countdown handler Function.
  *
  */  
  UAELCountdown = {
      /**
      * Calculate the time remaining.
      *
      */
      _calculateTime: function( wrapper, scope_id ) {

          var currentTime = ( new Date ).getTime();
          var time_run = Cookies.get( 'uael-time-to-run-' + scope_id );
          var distance = time_run - currentTime;
          var countdown_animation_miliseconds = countdown_animation * 60000;

          Cookies.set( 'uael-timer-distance-' + scope_id, distance, { path: '/' } );

          if ( distance <= countdown_animation_miliseconds ) {
              wrapper.addClass( 'flash-animation' );
          }

          if( distance > 0 ) {
              UAELCountdown._countdownTime( distance, wrapper, scope_id );
          } else {
              var action = wrapper.data( 'expire-action' ); 

              clearInterval( countdownInterval[ scope_id ] );
              if ( elementorFrontend.isEditMode() ) {
                  UAELCountdown._countdownTime( distance, wrapper, scope_id );
              }
              UAELCountdown._expireAction( action, wrapper, scope_id );
          }

      },
      /**
      * Calculate the time remaining and display.
      *
      */
      _countdownTime: function( distance, wrapper, scope_id ) {
          
          var days = Math.floor( distance / ( 1000 * 60 * 60 * 24 ) );
              hours = Math.floor( ( distance % ( 1000 * 60 * 60 * 24 ) ) / ( 1000 * 60 * 60 ) );
              minutes = Math.floor( ( distance % ( 1000 * 60 * 60 ) ) / ( 1000 * 60 ) );
              seconds = Math.floor( ( distance % ( 1000 * 60 ) ) / 1000 );

          Cookies.set( 'uael-timer-days-' + scope_id, days, { path: '/' } );
          Cookies.set( 'uael-timer-hours-' + scope_id, hours, { path: '/' } );
          Cookies.set( 'uael-timer-minutes-' + scope_id, minutes, { path: '/' } );
          Cookies.set( 'uael-timer-seconds-' + scope_id, seconds, { path: '/' } );

          UAELCountdown._countDisplay( 
              Cookies.get( 'uael-timer-days-' + scope_id ), 
              Cookies.get( 'uael-timer-hours-' + scope_id ), 
              Cookies.get( 'uael-timer-minutes-' + scope_id ), 
              Cookies.get( 'uael-timer-seconds-' + scope_id ), 
          wrapper, scope_id );

          $( '.elementor-element-' + scope_id ).find( '.uael-item' ).css( 'display', 'flex' );
          $( '.elementor-element-' + scope_id ).find( '.uael-countdown-separator' ).css( 'display', 'flex' );

          $( '.elementor-element-' + scope_id + ' .uael-countdown-show-seconds-no' ).find( '.uael-countdown-seconds' ).css( 'display', 'none' );
          $( '.elementor-element-' + scope_id + ' .uael-countdown-show-seconds-no' ).find( '.uael-countdown-minutes-separator' ).css( 'display', 'none' );

          $( '.elementor-element-' + scope_id + ' .uael-countdown-show-minutes-no' ).find( '.uael-countdown-minutes' ).css( 'display', 'none' );
          $( '.elementor-element-' + scope_id + ' .uael-countdown-show-minutes-no' ).find( '.uael-countdown-hours-separator' ).css( 'display', 'none' );

          $( '.elementor-element-' + scope_id + ' .uael-countdown-show-hours-no' ).find( '.uael-countdown-hours' ).css( 'display', 'none' );
          $( '.elementor-element-' + scope_id + ' .uael-countdown-show-hours-no' ).find( '.uael-countdown-days-separator' ).css( 'display', 'none' );

          $( '.elementor-element-' + scope_id + ' .uael-countdown-show-days-no' ).find( '.uael-countdown-days' ).css( 'display', 'none' );
          $( '.elementor-element-' + scope_id + ' .uael-countdown-show-days-no' ).find( '.uael-countdown-days-separator' ).css( 'display', 'none' );
      },
      /**
       * Display the timer.
       *
       */
      _countDisplay: function( days, hours, minutes, seconds, wrapper, scope_id ) {

          var items = [ days, hours, minutes, seconds ];
              items_classes = [ 'days', 'hours', 'minutes', 'seconds' ];
              wrapper_class = '-wrapper-' + scope_id;
              label_wrapper_class = '-label-wrapper-' + scope_id;
              label_wrapper_classes = [];
              wrapper_classes = [];
              custom_labels = [];


          for( var i = 0; i < items.length; i++ ) {
              if( items[i] < 0 || items[i] == '' ){
                  items[i] = 0;
              }
          }

          for( var i = 0; i < items.length; i++ ) {
              if( items[i] < 10 ){
                  items[i] = '0' + items[i];
              }
          }

          for( var j = 0; j < items.length; j++ ) {
              wrapper_classes[j] = items_classes[j] + wrapper_class;
              label_wrapper_classes[j] = items_classes[j] + label_wrapper_class ;

          }

          if( document.getElementById( wrapper_classes[0] ) ){
              for( var k = 0; k < items.length; k++) {
                  $( '#' + wrapper_classes[k] ).text( items[k] );
                  if( 'none' != wrapper.data( 'timer-labels' ) ){
                      if( 'custom' == wrapper.data( 'timer-labels' ) ){
                        items_classes[k] = wrapper.data( 'timer-' + items_classes[k] );
                      }

                      if( items[k] == 1 ){
                        items_classes[k] =  items_classes[k].slice( 0, -1 );
                      }

                      $( '#' + label_wrapper_classes[k] ).text( items_classes[k].charAt(0).toUpperCase() + items_classes[k].slice(1) );
                  }
              }
          }
      },
      /**
       * Actions after countdown expires.
       *
       */
      _expireAction: function( action, wrapper, scope_id ) {

          switch ( action ) {
              case 'hide':

                  if ( elementorFrontend.isEditMode() && wrapper.hasClass( 'flash-animation' ) ){
                      wrapper.removeClass( 'flash-animation' );
                  }else{
                    wrapper.css('display', 'none');
                  }    

                  break;

              case 'show_message':

                  if ( elementorFrontend.isEditMode() ){
                      UAELCountdown._countdownTime( 0, wrapper, scope_id );
                      $( '.elementor-element-' + scope_id + ' .uael-preview-message' ).find( '.uael-item' ).css( 'display', 'none' );
                      $( '.elementor-element-' + scope_id + ' .uael-preview-message' ).find( '.uael-countdown-separator' ).css( 'display', 'none' );                      
                  }
                  else {
                      wrapper.find( '.uael-item' ).css( 'display', 'none' );
                      wrapper.find( '.uael-countdown-separator' ).css( 'display', 'none' );
                      wrapper.find( '.uael-expire-message-wrapper' ).css( 'display', 'block' );
                      wrapper.find( '.uael-countdown-items-wrapper' ).css( 'max-width', '100%' );
                  } 

                  break;

              case 'redirect':
                  if ( ! elementorFrontend.isEditMode() ) {
                      var redirect_url = wrapper.data( 'redirect-url' );
                      window.location.href = redirect_url;
                  }

                  break;

              case 'none': 
                  UAELCountdown._countdownTime( 0, wrapper, scope_id );

                  if ( elementorFrontend.isEditMode() && wrapper.hasClass( 'flash-animation' ) ){
                      wrapper.removeClass( 'flash-animation' );
                  }

                  if ( !elementorFrontend.isEditMode() && wrapper.hasClass( 'flash-animation' ) ){
                      wrapper.removeClass( 'flash-animation' );
                  }

                  break;

              case 'reset': 
                  UAELCountdown._initEvergreen( wrapper, scope_id );
                  UAELCountdown._evergreenTimer( wrapper, scope_id );

                  countdownInterval[ scope_id ] = setInterval( function() { 
                      UAELCountdown._calculateTime( wrapper, scope_id );           
                  }, 1000);


                  break;

              default:

                  break;
          }
      },
      /**
       * Initialize the evergreen timer.
       *
       */
      _initEvergreen : function( wrapper, scope_id ) {

          var interval = wrapper.data( 'evg-interval' );
          var cd_date = ( new Date);
          var evg_now = ( new Date ).getTime(); // First time on page
          var time = wrapper.data( 'evg-interval' ) / 1000;
          var cd_time = cd_date.setSeconds( cd_date.getSeconds() + time );

          Cookies.set( 'uael-timer-cdTime-' + scope_id, cd_time, { path: '/' } );  
          Cookies.set( 'uael-timer-evgInt-' + scope_id, interval, { path: '/' } ); 
          Cookies.set( 'uael-timer-firstTime-' + scope_id, evg_now, { path: '/' } );

          return Cookies.get( 'uael-timer-cdTime-' + scope_id ); 
      },
      /**
       * Function for Evergreen timer.
       *
       */
      _evergreen: function( wrapper, scope_id ) {

          var interval = wrapper.data( 'evg-interval' );

          // Check the cookies set and update them accordingly.
          if ( !Cookies.get( 'uael-timer-cdTime-' + scope_id ) && !Cookies.get( 'uael-timer-evgInt-' + scope_id ) ) {
              return UAELCountdown._initEvergreen( wrapper, scope_id );
          }

          if ( Cookies.get( 'uael-timer-cdTime-' + scope_id ) && Cookies.get( 'uael-timer-evgInt-' + scope_id ) != interval ) {
              return UAELCountdown._initEvergreen( wrapper, scope_id );
          }

          if ( Cookies.get( 'uael-timer-cdTime-' + scope_id ) && Cookies.get( 'uael-timer-evgInt-' + scope_id ) == interval) {
              return Cookies.get( 'uael-timer-cdTime-' + scope_id );
          }
      },
      /**
       * Function for Evergreen timer.
       *
       */
      _evergreenTimer: function( wrapper, scope_id ) {

          var currentTime = ( new Date ).getTime();
          var usedTime = currentTime - Cookies.get( 'uael-timer-firstTime-' + scope_id ); 
          var cntTime =  UAELCountdown._evergreen( wrapper, scope_id );;
          var runTimer = cntTime - usedTime;
          
          clearInterval( countdownInterval[ scope_id ] );
          Cookies.set( 'uael-time-to-run-' + scope_id, runTimer, { path: '/' } );
      },
      /**
       * Function for fixed timer.
       *
       */
      _fixedTimer :function( wrapper, scope_id ) {

          var cd_date = wrapper.data( 'due-date' );
        
          // Find the distance between now an the count down date
          clearInterval( countdownInterval[ scope_id ] );
          var time_to_run = cd_date * 1000;

          Cookies.set( 'uael-time-to-run-' + scope_id, time_to_run, { path: '/' } );
      },
      /**
       * Function for recurring timer.
       *
       */
      _recurringTimer :function( wrapper, scope_id ) {

          UAELCountdown._evergreenTimer( wrapper, scope_id );

          // Set the interval to check the remaining time between current time and start time.
          clearInterval( resetInterval[ scope_id ] );          
          resetInterval[ scope_id ] = setInterval( function() {

              var reset_days = wrapper.data( 'reset-days' ); 
              var reset_time = wrapper.data( 'start-date' ) * 1000;
              var rem_time_to_reset = reset_time - new Date().getTime();
              var rem_minutes = Math.floor( ( rem_time_to_reset % ( 1000 * 60 * 60 ) ) / ( 1000 * 60 ) );
              var rem_seconds = Math.floor( ( rem_time_to_reset % ( 1000 * 60 ) ) / 1000 );

              if ( reset_time > new Date().getTime()  && ! elementorFrontend.isEditMode() ) {
                  wrapper.css( 'display', 'none' );
              }

              if ( reset_time > new Date().getTime()  && elementorFrontend.isEditMode() ) {
                  UAELCountdown._countdownTime( 0, wrapper, scope_id );
              }
              // Initiate the timer when the remaining time hits 0.
              if( 0 == rem_minutes && 0 == rem_seconds){
                  wrapper.removeClass( 'uael-countdown-hide' );
                  UAELCountdown._initEvergreen( wrapper, scope_id );
                  UAELCountdown._evergreenTimer( wrapper, scope_id );
              }
              // Count until the start date and time and restart the timer after hits 0.
              if( reset_time <= new Date().getTime() ){
                  new Date().setSeconds( new Date().getSeconds() + 1 );

                  var timePassed = new Date().getTime() - reset_time;
                  var secondsSinceStart = Math.floor( timePassed / 1000 );
                  var minutesSinceStart = Math.floor( secondsSinceStart / 60 );
                  var hoursSinceStart = Math.floor( minutesSinceStart / 60 );
                  var daysSinceStart = Math.floor( hoursSinceStart / 24 );

                  var dailySecondsElapsed = secondsSinceStart % 60;
                  var dailyMinutesElapsed = minutesSinceStart % 60;
                  var dailyHoursElapsed = hoursSinceStart % 24;
                  var daysElapsed = daysSinceStart % reset_days;                 

                  var remainingSeconds = 59 - dailySecondsElapsed;
                  var remainingMinutes = 59 - dailyMinutesElapsed;
                  var remainingHoursDaily = 23 - dailyHoursElapsed;
                  var remainingDays = ( reset_days - 1 ) - daysElapsed;

                  if ( 0 == remainingSeconds && 0 == remainingMinutes && 0 == remainingHoursDaily && 0 == remainingDays ){
                      UAELCountdown._initEvergreen( wrapper, scope_id );
                      UAELCountdown._evergreenTimer( wrapper, scope_id );
                  }
                  UAELCountdown._calculateTime( wrapper, scope_id ); 
              }               
          }, 1000);
      }
  }

  var WidgetUAELCountdown = function( $scope, $ ) {

      if ( 'undefined' == typeof $scope ) {
        return;
      }

      var scope_id = $scope.data( 'id' );
      var wrapper = $scope.find( '.uael-countdown-wrapper' );
      var type = wrapper.data( 'countdown-type' );
      var expire_message = wrapper.data( 'countdown-expire-message' );
      var start_animation = wrapper.data( 'animation' );

      if( elementorFrontend.isEditMode() && expire_message == 'yes' ) {
          wrapper.removeClass( 'countdown-active' );
      }

      // Set the cookies if the timer is of type Evergreen or Evergreen.
      if( !Cookies.get( 'uael-timer-firstTime-' + scope_id ) && !Cookies.get( 'uael-timer-cdTime-' + scope_id ) ){
          if( 'evergreen' == type || 'recurring' == type ){
              UAELCountdown._initEvergreen( wrapper, scope_id );
          }           
      }

      countdown_animation = start_animation;

      // Check the timer type and call the function accordingly.
      if( 'evergreen' == type ){
          clearInterval( countdownInterval[ scope_id ] );
          UAELCountdown._evergreenTimer( wrapper, scope_id );
      }
      else if( 'fixed' == type ){
          clearInterval( countdownInterval[ scope_id ] );
          UAELCountdown._fixedTimer( wrapper, scope_id );
      }else{
          clearInterval( countdownInterval[ scope_id ] );
          UAELCountdown._recurringTimer( wrapper, scope_id );
      }

      if ( 'evergreen' == type || 'fixed' == type || wrapper.data ( 'start-date' ) * 1000 <= new Date().getTime() ) {
        clearInterval( resetInterval[ scope_id ] );          
        clearInterval( countdownInterval[ scope_id ] );

        countdownInterval[ scope_id ] = setInterval( function() { 
            UAELCountdown._calculateTime( wrapper, scope_id );           
        }, 1000);

      }
      
      if( Cookies.get( 'uael-timer-days-' + scope_id ) && Cookies.get( 'uael-timer-hours-' + scope_id ) && Cookies.get( 'uael-timer-minutes-' + scope_id ) && Cookies.get( 'uael-timer-seconds-' + scope_id )){
          UAELCountdown._countDisplay( Cookies.get( 'uael-timer-days-' + scope_id ), Cookies.get( 'uael-timer-hours-' + scope_id ), Cookies.get( 'uael-timer-minutes-' + scope_id ), Cookies.get( 'uael-timer-seconds-' + scope_id ), wrapper, scope_id );
      }
  };

  $( window ).on( 'elementor/frontend/init', function () {
      elementorFrontend.hooks.addAction( 'frontend/element_ready/uael-countdown.default', WidgetUAELCountdown );
  });

} )( jQuery );  