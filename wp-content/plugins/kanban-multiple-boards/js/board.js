jQuery( function ( $ ) {

	//Add tabs switching.
	$( '#tabs-boards a' ).on(
		'show.bs.tab',
		function ( e ) {
			var $tab = $( e.target );
			var board_selector = $tab.attr( 'href' );
			var $board = $( board_selector );
			var board_title = $board.attr( 'data-title' );
			var board_id = $board.attr( 'data-id' );
			var board = boards[board_id];

			current_board_id = board_id;

			board.apply_filters();

			$( '#tabs-boards' ).attr( 'data-current-board-title', board_title );

			kanban.url_params['board_id'] = board_id;
			update_url();
		}
	);



	// Add boards modal switching.
	$( '#modal-boards' ).on(
		'click',
		'.list-group-item',
		function () {
			var $a = $( this );
			var board_id = $a.attr( 'href' );
			$( '#tabs-boards [href="{0}"]'.sprintf( board_id ) ).tab( 'show' );
			current_board_id = parseInt( board_id.replace( /\D/g, '' ) );
		}
	);



	// Add keyboard shortcut.
	$( "body" ).on(
		'keydown',
		function ( e ) {
			var $any_input = $( 'input:focus, textarea:focus, [contenteditable]:focus' );

			var board = boards[current_board_id];



			// shift + b: rotate boards
			if ( e.keyCode == 66 && $any_input.length === 0 ) {
				if ( e.shiftKey ) {
					$( '#modal-boards' ).modal( 'toggle' );
					return false;
				}
			}


			// shift + [1-9]: rotate boards
			if ( e.keyCode > 48 && e.keyCode < 58 && $any_input.length === 0 ) {
				if ( e.shiftKey ) {
					// get zero-based index 
					var index = e.keyCode - 49;

					$( '#tabs-boards li:eq({0}) a'.sprintf( index ) ).tab( 'show' );
					return false;
				}
			}


		}
	);



	$( 'body' ).on(
		'change',
		'.move-task-select-board',
		function () {
			var $select = $(this);
			var $body = $select.closest('.modal-body');

			var board_id = $select.val();

			var $to_show = $('.task-move-list-board-statuses-' + board_id, $body);

			$('.task-move-list-board-statuses', $body).not($to_show).hide();
			$to_show.show();
		}
	);

} );




