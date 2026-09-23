var $ = jQuery;
$window = $(window);

$(document).ready(function() {

	// ****************************************
	// ****************************************
	// SWIPER.JS - start
	// Swiper - Hero Home
	const ele_componentHeroHome = document.querySelectorAll('.component.hero-home');

	ele_componentHeroHome.forEach(function(swiperContainer) {
		new Swiper( swiperContainer.querySelector('.swiper-hero-home'), {
			autoplay: {
				delay: 5000,
				disableOnInteraction: false
			},
			effect: 'fade',
			fadeEffect: {
				crossFade: true
			},
			loop: true,
			pagination: {
				el: swiperContainer.querySelector('.acme-swiper-pagination'),
				clickable: true,
			},
			slidesPerView: 1,
			spaceBetween: 20
		});
	});

	// ----------------------------------------
	// SWIPER.JS - end
	// ****************************************
});
