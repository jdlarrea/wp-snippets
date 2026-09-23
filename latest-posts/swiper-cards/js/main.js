var $ = jQuery;
$window = $(window);

$(document).ready(function(){
	// Swiper - Featured Post Cards
	const postCardsSwipers = document.querySelectorAll('.component.featured-post-cards .swiper');

    postCardsSwipers.forEach(container => {
		const swiperInstance = new Swiper(container, {
            slidesPerView: 1, 
			slidesPerGroup: 1,
			spaceBetween: 30,
			loop: true,
			speed: 800,
			autoplay: {
				delay: 7000,
				disableOnInteraction: false
			},
            pagination: {
                el: '.swiper-pagination', 
                clickable: true,
            },
			navigation: {
				nextEl: container.querySelector('.swiper-button-next'),
				prevEl: container.querySelector('.swiper-button-prev'),
			},
            breakpoints: {
				1080: {
					slidesPerView: 3,
					slidesPerGroup: 3,
					spaceBetween: 34,
				},
				575: {
					slidesPerView: 2,
					slidesPerGroup: 2,
					spaceBetween: 34,
				}
            },
        });
    });
});
