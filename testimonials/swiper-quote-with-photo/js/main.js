var $ = jQuery;
$window = $(window);

$(document).ready(function(){
	// Swiper - Featured Testimonials
	const featuredTestimonialswipers = document.querySelectorAll('.component.featured-testimonials .swiper');

    featuredTestimonialswipers.forEach(container => {
		const swiperInstance = new Swiper(container, {
            slidesPerView: 1, 
			spaceBetween: 30,
			loop: true,
			speed: 800,
			autoplay: {
				delay: 10000,
				disableOnInteraction: false
			},
            pagination: {
                el: '.swiper-pagination', 
                clickable: true,
            },   
        });
    });
});
