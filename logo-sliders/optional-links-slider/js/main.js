var $ = jQuery;
$window = $(window);

$(document).ready(function(){
	// Slider - Logo
	$('.component-logo-slider-container .slider-logos').slick({
		arrows: false,
		dots: true,
		appendDots: ".component-logo-slider-container .slick-dots-wrapper",
		customPaging: function() {
			return '<button class="slick-custom-dot"></button>';
		},
		autoplay: true,
		autoplaySpeed: 3000,
		rows: 0,
		slidesToShow: 5,
		slidesToScroll: 5,
		responsive: [
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2
				}
			}
		]
	}).on('afterChange', function(event, slick, currentSlide, nextSlide){
		blazy.revalidate();
	});
});
