( function( $ ) {

	/**
	 * Table handler Function.
	 *
	 */
	var WidgetUAELTableHandler = function( $scope, $ ) {
		if ( 'undefined' == typeof $scope ) {
			return;
		}
		// Define variables.
		var $this                = $scope.find( '.uael-table-wrapper' );
		var node_id              = $scope.data( 'id' );
		var uael_table           = $scope.find( '.uael-table' );
		var uael_table_id        = $scope.find( '#uael-table-id-' + node_id );
		var searchable 			 = false;
		var showentries 		 = false;
		var sortable 			 = false;

		if ( 0 == uael_table_id.length )
			return;

		//Search entries
		var search_entry = $( '.elementor-element-' + node_id + ' #' + uael_table_id[0].id ).data( 'searchable' );

		if ( 'yes' == search_entry ) {
			searchable = true;
		}

		//Show entries select
		var show_entry = $( '.elementor-element-' + node_id + ' #' + uael_table_id[0].id ).data( 'show-entry' );

		if ( 'yes' == show_entry ) {
			showentries = true;
		}

		//Sort entries
		var sort_table = $( '.elementor-element-' + node_id + ' #' + uael_table_id[0].id ).data( 'sort-table' );

		if ( 'yes' == sort_table ) {
			$( '.elementor-element-' + node_id + ' #' + uael_table_id[0].id + ' th' ).css({'cursor': 'pointer'});

			sortable = true;
		}

		var search_string = uael_script.search_str;
		var length_string = uael_script.table_length_string;
		var no_record_found_string = uael_script.table_not_found_str;

		if( searchable || showentries || sortable ) {
			$( '#' + uael_table_id[0].id ).DataTable( {
				"paging": showentries, 
				"searching": searchable, 
				"ordering": sortable,
				"info": false,
				"oLanguage": {
					"sSearch": search_string,
					"sLengthMenu": length_string,
					"sZeroRecords" :no_record_found_string, 
				},
			});

			var	div_entries = $scope.find('.dataTables_length');
			div_entries.addClass('uael-tbl-entry-wrapper uael-table-info');

			var	div_search = $scope.find('.dataTables_filter');
			div_search.addClass('uael-tbl-search-wrapper uael-table-info');

			$scope.find( '.uael-table-info').wrapAll( '<div class="uael-advance-heading"></div>' );

		}


		function coloumn_rules() {
			if($(window).width() > 767) {
				$(uael_table).addClass('uael-column-rules');
				$(uael_table).removeClass('uael-no-column-rules');
			}else{
				$(uael_table).removeClass('uael-column-rules');
				$(uael_table).addClass('uael-no-column-rules');
			}
		}

		// Listen for events.
		window.addEventListener("load", coloumn_rules);
		window.addEventListener("resize", coloumn_rules);
	};

	$( window ).on( 'elementor/frontend/init', function () {
		
		elementorFrontend.hooks.addAction( 'frontend/element_ready/uael-table.default', WidgetUAELTableHandler );
	});
} )( jQuery );
