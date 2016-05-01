/************************************

	Filename: carousel-caption-fade.js effect

*************************************/

jQuery(document).ready(function($) {

	// Need to set a global class here that is Not editable in the backend!
	$('.tif-slider').bind('slide.bs.carousel', function (e) {
		var slideFrom = $(this).find('.active').index(),
			slideTo = $(e.relatedTarget).index();

		$('.slider-caption.cc-' + slideFrom).fadeOut('fast', function() {
			$('.slider-caption.cc-' + slideTo).fadeIn('slow');
		});
	});

});