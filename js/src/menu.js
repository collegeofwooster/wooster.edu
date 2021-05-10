

// onload responsive footer and menu stuff
jQuery(document).ready(function($){

	// show/hide menus when they click the toggler
	var header = $( 'header' );
	var menu_show = header.find( '.menu-show' );
	var menu_overlay = $( '.menu-overlay' );
	var menu_hide = menu_overlay.find( '.close' );

	menu_show.click(function(){
		menu_overlay.fadeIn( 400 );
	});

	menu_hide.click(function(){
		menu_overlay.fadeOut( 400 );
	});

	// when user clicks a link in the menu, open submenu if it exists.
	menu_overlay.find( '.main-menu' ).find( 'a' ).click(function(){
		var parent_li = $( this ).parent( 'li' );
		var submenu = $( this ).next( 'ul' );
		if ( !submenu.is( ':visible' ) && parent_li.hasClass( 'menu-item-has-children' ) ) {
			event.preventDefault();
			parent_li.addClass( 'open' );
			submenu.show();
		}
	});

});

