var $ = jQuery;
$window = $(window);

$(document).ready(function(){
	if($('.timeline').length > 0) {
		$('.timeline').each(function() {
			var $carouselContainer = $(this).find('.timeline-carousel');
			var $carouselNav = $(this).find('.timeline-nav');

			// Initialize the main carousel for this instance
			$carouselContainer.slick({
				arrows: false,
				dots: false,
				infinite: false,
				rows: 0,
				slidesToShow: 1,
				slidesToScroll: 1,
				accessibility: true,
				asNavFor: $carouselNav, 
			})

			// Initialize the navigation carousel for this instance
			$carouselNav.slick({
				arrows: true,
				nextArrow: '<i class="icon-chevron-right"></i>',
  				prevArrow: '<i class="icon-chevron-left"></i>',
				dots: false,
				infinite: false,
				rows: 0,
				slidesToShow: 9,
				slidesToScroll: 1,
				asNavFor: $carouselContainer, 
				accessibility: true,
				responsive: [
					{
						breakpoint: 1480,
						settings: {
							slidesToShow: 8,
						}
					},
					
					{
						breakpoint: 1280,
						settings: {
							slidesToShow: 5,
						}
					},
					{
						breakpoint: 1080,
						settings: {
							slidesToShow: 4,
						}
					},
					{
						breakpoint: 768,
						settings: {
							slidesToShow: 3,
						}
					},
					{
						breakpoint: 576,
						settings: {
							slidesToShow: 2,
						}
					},
					{
						breakpoint: 375,
						settings: {
							slidesToShow: 1,
						}
					}
				]
			});

			$carouselNav.on('click', '.item', function() {
				var slideIndex = $(this).data('slick-index');
				$carouselContainer.slick('slickGoTo', slideIndex); 
			});
		});

		if($('.slides').length > 0) {
			$('.slides').each(function(){
				var self = $(this);
				self.slick({
					arrows: true,
					prevArrow: $('.slick-prev', self),
					nextArrow: $('.slick-next', self),
					dots: false,
					slidesToShow: 1,
					slidesToScroll: 1,
					infinite: true,
					rows: 0
				});
			});
		}
	}
});
