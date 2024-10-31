(function( $ ) {
	'use strict';
	
	var $container = $('.masonry-wrap').masonry({
    	itemSelector: '.portfolio-block-item',
    	columnWidth: '.portfolio-block-item',
        transitionDuration: '0.8s'
	});

	$container.imagesLoaded().progress( function() {
	  	$container.masonry();
	});

})( jQuery );