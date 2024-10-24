

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

    // quicknav functionality
    $('select.quick-nav').on( 'change', function(){
    	if ( $(this).val() != '' ) {
    		location.href = $(this).val();
    	}
    });


    // handle sidebar menu toggling
    // handle sidebar menu toggling
    var left_menu = $('.sidebar-menu ul.menu');
    left_menu.find( 'a' ).click(function(){
        var parent_li = $( this ).parent( 'li' );
        var submenu = $( this ).next( 'ul' );
        if ( !submenu.is( ':visible' ) && parent_li.hasClass( 'menu-item-has-children' ) ) {
            event.preventDefault();
            parent_li.addClass( 'open' );
            submenu.show();
        }
    });

    // auto open a menu if it or one of its children is the current page
	left_menu.find( 'li' ).each(function(){
		var item = $(this);
		if ( item.hasClass( 'current_page_parent' ) || item.hasClass( 'current-menu-item' ) || item.hasClass( 'current-menu-ancestor' ) ) {
			item.addClass( 'open' );
			item.find( 'ul.sub-menu' ).addClass( 'open' );
		}
	});


	// the category select quick-nav
	$('.category-select').on( 'change', function(){
		location.href = '/category/' + $(this).val();
	});


	// sidebar menu toggling
	$('.sidebar-menu-toggle').on( 'click', function(){
		$(this).toggleClass('open');
		$(this).next('.sidebar-menu').toggle();
	});

});

