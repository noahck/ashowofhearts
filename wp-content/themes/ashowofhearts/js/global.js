jQuery(function($){

$(window).scroll(function(){
    $(".hero-unit").css("opacity", 1 - $(window).scrollTop() / 450);
  });

  $( document ).on('scroll', function(){

   	if ( $( document ).scrollTop() > 0 ){
      $( '.site-header' ).addClass( 'navbar-fixed-top' );

	}

    else {
      $( '.site-header' ).removeClass( 'navbar-fixed-top' );

    }

  });

});



