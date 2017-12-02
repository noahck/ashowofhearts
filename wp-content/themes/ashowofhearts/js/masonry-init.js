jQuery(function($) {
	var $container = $('.content');

	$container.imagesLoaded( function(){
		$container.masonry({
			itemSelector: '.entry',
			gutterWidth: 30
		});
	});
});