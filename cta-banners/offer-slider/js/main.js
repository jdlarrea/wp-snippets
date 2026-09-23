var $ = jQuery;
$window = $(window);

$(document).ready(function(){
	// Swiper: Offer Slider
	const ele_componentOfferSlider = document.querySelectorAll('.component.offer-slider');

	if (ele_componentOfferSlider.length) {
		ele_componentOfferSlider.forEach(function(swiperContainer) {
			// Initialize image slider
			const offerImages = new Swiper(swiperContainer.querySelector('.swiper-offer-images'), {
				slidesPerView: 1,
				loop: true,
				effect: 'fade',
				fadeEffect: {
					crossFade: true
				},
				watchSlidesProgress: true,
			});

			// Initialize content slider
			const swiperContainerContents = swiperContainer.querySelector('.swiper-container-contents');
			const offerContents = new Swiper(swiperContainerContents.querySelector('.swiper-offer-contents'), {
				slidesPerView: 1,
				spaceBetween: 40,
				loop: true,
				pagination: {
					el: swiperContainerContents.querySelector('.acme-swiper-pagination'),
					clickable: true
				},
				watchSlidesProgress: true,
			});

			// Sync content slider with image slider
			offerContents.controller.control = offerImages;
			offerImages.controller.control = offerContents;
		});
	}
});
