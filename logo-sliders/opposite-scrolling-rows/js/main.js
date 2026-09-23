var $ = jQuery;
$window = $(window);

$(document).ready(function(){
	// Logo Carousel
	const logo_swiper = document.querySelectorAll('.logo-slider .carousel-first.swiper');
	const logo_swiper_options = {
		spaceBetween: 80,
		centeredSlides: false,
		speed:5000,
		direction: 'horizontal',
		autoplay: {
			delay: 0,
			disableOnInteraction: false
		},
		loop: true,
		slidesPerView: 3,
		allowTouchMove: false,
		breakpoints: {
			375: {
				slidesPerView: 3,
			},
			768: {
				slidesPerView: 5,
			},
			1440: {
				slidesPerView: 6,
			},
		}
	};

	logo_swiper.forEach(function(swiperContainer) {
		new Swiper(swiperContainer, logo_swiper_options );
	});

	const logo_swiper_right = document.querySelectorAll('.logo-slider .carousel-second.swiper');
	const logo_swiper_right_options = {
		spaceBetween: 80,
		centeredSlides: false,
		speed:5000,
		direction: 'horizontal',
		autoplay: {
			delay: 0,
			disableOnInteraction: false
		},
		loop: true,
		slidesPerView: 3,
		allowTouchMove: false,
		breakpoints: {
			375: {
				slidesPerView: 3,
			},
			768: {
				slidesPerView: 5,
			},
			1440: {
				slidesPerView: 6,
			},
		}
	};

	logo_swiper_right.forEach(function(swiperContainer) {
		new Swiper(swiperContainer, logo_swiper_right_options );
	});
});
