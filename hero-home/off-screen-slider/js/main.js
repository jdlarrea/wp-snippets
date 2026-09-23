var $ = jQuery;
$window = $(window);

$(document).ready(function(){
	// ********************
	// SLICK.JS CALLS
	// Slider - Hero Home
	if($('.homepage-hero').length > 0) {
		$('.homepage-hero').each(function(){
			const slider = $(this).find('.slider-content-inner');
			const sliderImgs = $(this).find('.slider-image-wrapper');

			//count how many images are in the slider
			if(sliderImgs.find('.background-image').length > 1)
			{
				var self = $(this);
				slider.slick({
					arrows: false,
					asNavFor: sliderImgs,
					dots: true,
					appendDots: self.find(".slick-dots-wrapper"),
					customPaging: function() {
						return '<button class="slick-custom-dot"></button>';
					},
					autoplay: true,
					autoplaySpeed: 6000,
					rows: 0,
					slidesToShow: 1,
					slidesToScroll: 1,
					fade: true,
					cssEase: 'linear',
					adaptiveHeight: false,
					infinite: true,
				});
				sliderImgs.slick({
					arrows: false,
					asNavFor: slider,
					rows: 0,
					centerMode: true,
					focusOnSelect: true,
					slidesToShow: 1,
					slidesToScroll: 1,
				}).on('afterChange', function(event, slick, currentSlide, nextSlide){
					//blazy.revalidate();
				});
			}

			
		});
	}
});
