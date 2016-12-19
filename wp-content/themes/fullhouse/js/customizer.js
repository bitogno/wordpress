/**
 * PrestaBase Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Customizer preview reload changes asynchronously.
 */
( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title,  .site-description' ).css( {
					'clip': 'auto',
					'position': 'static'
				} );

				$( '.site-title a' ).css( {
					'color': to
				} );
			}
		} );
	} );


	//Update site link color in real time...
	wp.customize( 'page_bg', function( value ) {
		value.bind( function( newval ) {  
			$('#page').css('background-color', newval );
		} );
	} );


	//Update site link color in real time...
	wp.customize( 'body_text_color', function( value ) {
		value.bind( function( newval ) {  
			$('body').css('color', newval );
		} );
	} );

	//Update site link color in real time...
	wp.customize( 'theme_color', function( value ) {
		
		var selectors = "#pbr-masthead.header-absolute, #pbr-masthead, .search-properies-form , .opalestate-rows article .property-meta-list";
		selectors += ".pbr-footer, .bg-navy,.search-properies-form #opalestate-search-form > .row:first-child, .search-properies-form .opalestate-search-form > .row:first-child";
	 
		value.bind( function( newval ) {  
			$( selectors ).css('background-color', newval );
		} );
	} );

	//Update site link color in real time...
	wp.customize( 'sencondary_color', function( value ) {

		var selectors = ".team-header .agent-levels, .scrollup,   .search-properies-form ul.list-property-status li.active , .noUi-connect, .bg-primary,";
		selectors += ".comment-form .form-submit .btn, button.btn-danger, button.btn-primary ,";
		selectors += "#property-filter-status .list-property-status li.active, #property-filter-status .list-property-status li:hover";

		value.bind( function( newval ) {  
			$(selectors).css('background-color', newval );
		} );
	} );


	//Update site link color in real time...
	wp.customize( 'topnav_bg', function( value ) {
		value.bind( function( newval ) {  
			$('#pbr-masthead.header-absolute, #pbr-masthead').css('background-color', newval );
		} );
	} );

	//Update site link color in real time...
	wp.customize( 'topnav_color', function( value ) {
		value.bind( function( newval ) {  
			$('.navbar-mega .navbar-nav li > a, .navbar-mega .navbar-nav li.active > a').css('color', newval );
		} );
	} );



	//Update site link color in real time...
	wp.customize( 'footer_bg', function( value ) {
		value.bind( function( newval ) {  
			$('#pbr-footer').css('background-color', newval );
		} );
	} );

	//Update site link color in real time...
	wp.customize( 'footer_color', function( value ) {
		value.bind( function( newval ) {  
			$('#pbr-footer, #pbr-footer a').css('color', newval );
		} );
	} );



	//Update site link color in real time...
	wp.customize( 'footer_heading_color', function( value ) {
		value.bind( function( newval ) {  
			$('#pbr-footer h2, #pbr-footer h3, #pbr-footer h4').css('color', newval );
		} );
	} );

	//Update site link color in real time...
	wp.customize( 'copyright_bg', function( value ) {
		value.bind( function( newval ) {  
			$('.pbr-copyright').css('background-color', newval );
		} );
	} );

	//Update site link color in real time...
	wp.customize( 'copyright_color', function( value ) {
		value.bind( function( newval ) {  
			$('.pbr-copyright a, .pbr-copyright').css('color', newval );
		} );
	} );
} )( jQuery );