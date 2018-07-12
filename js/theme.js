( function( $ ) {
    
    /**/
    $('#nav-header').slicknav({
	label: $('header .site-title').text(),
	duration: 200,
        duplicate: true,
        closeOnClick: true,
        appendTo:'#header',
//        brand: ' aaa '
    });
    
    
    
} )( jQuery );