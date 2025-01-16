

jQuery( document ).ready( function( $ ) {

    var pageHeaderBottom = $('.page-header-bottom');
    if ( pageHeaderBottom.length ) {
        var ctaScrollTarget = parseInt( $('.page-header-bottom').offset().top );
        var menuHeight = parseInt( $('.content').css( 'margin-top' ) );
        console.log( menuHeight );

        $(window).scroll(function(){
            var scrollPosition = $(window).scrollTop();
            if ( scrollPosition >= ( ctaScrollTarget - menuHeight ) ) {
                $( '.cta-float' ).addClass( 'visible' );
            } else {
                $( '.cta-float' ).removeClass( 'visible' );
            }

        });
    }

});

