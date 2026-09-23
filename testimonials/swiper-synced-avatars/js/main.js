var $ = jQuery;
$window = $(window);

$(document).ready(function(){
	// Swiper - Testimonials
	const ele_swiperTestimonails = document.querySelectorAll('.component.testimonials');

	ele_swiperTestimonails.forEach(function(swiperContainer) {
		const containerImgs = swiperContainer.querySelector('.swiper-testimonial-images');
		const containerContents = swiperContainer.querySelector('.swiper-testimonial-contents');

		const swiperImgs = new Swiper(containerImgs, {
			spaceBetween: 10,
			slidesPerView: 1,
			watchSlidesProgress: true,
			breakpoints: {
				1024: {
					slidesPerView: 3,
					spaceBetween: 25
				},
				768: {
					slidesPerView: 3,
					spaceBetween: 15,
				},
				576: {
					slidesPerView: 2,
					spaceBetween: 10,
				}
			}
		});
		swiperImgs.on('slideChange', function() {
            const activeIndex = swiperImgs.activeIndex;
            swiperContents.slideTo(activeIndex);
        });

		const swiperContents = new Swiper(containerContents, {
			autoHeight: true,
			autoplay: {
				delay: 5000,
				disableOnInteraction: false
			},
			effect: 'fade',
			fadeEffect: {
				crossFade: true
			},
			thumbs: {
				swiper: swiperImgs,
			},
		});
	});
});
