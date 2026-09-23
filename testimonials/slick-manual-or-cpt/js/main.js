var $ = jQuery;
$window = $(window);

$(document).ready(function(){
	if($('.testimonial-carousel .carousel').length > 0) {
		$('.testimonial-carousel .carousel').each(function(){
			var self = $(this);
			self.slick({
				arrows: false,
				dots: true,
				rows: 0,
				slidesToShow: 1,
				slidesToScroll: 1,
				autoplay: true,
				autoplaySpeed: 5000,
				infinite: true,
				adaptiveHeight: true,

			}).on('afterChange', function(event, slick, currentSlide, nextSlide){
				blazy.revalidate();
			});
		});
	}
});
