var $ = jQuery;
$window = $(window);

$(document).ready(function(){
	// ********************
	// SLICK.JS CALLS
	// Slider - Hero Home Contents
	$('.component-hero-home .slider-herohome-contents').slick({
		asNavFor: '.component-hero-home .slider-herohome-images',
		autoplay: true,
		autoplaySpeed: 5000,
		pauseOnHover: false,
		fade: true,
		infinite: true,
		rows: 0,
		nextArrow: '.component-hero-home .slick-arrows .slick-next',
		prevArrow: '.component-hero-home .slick-arrows .slick-prev',
	});
	// Slider - Hero Home Images
	$('.component-hero-home .slider-herohome-images').slick({
		arrows: false,
		asNavFor: '.component-hero-home .slider-herohome-contents',
		fade: true,
		infinite: true,
		rows: 0,
	});

});
