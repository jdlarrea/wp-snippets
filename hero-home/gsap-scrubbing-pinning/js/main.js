var $ = jQuery;
$window = $(window);

$(document).ready(function() {
	// ****************************************
	// ****************************************
	// SELECTORS - start
	const ele_HeroFulls = document.querySelectorAll('.component.hero-full');

	// SELECTORS - end
	// ****************************************


	// ****************************************
	// ****************************************
	// GSAP - start
	gsap.registerPlugin(ScrollTrigger);

	// Hero Full
	const setScrollTriggersHeroFull = () => {
		ele_HeroFulls.forEach((heroFull) => {
			const sliderMain = heroFull.querySelector('.slider-hero-full');
			const slidesHidden = sliderMain.querySelectorAll('.full-slide.slide-hidden');
			const slides = sliderMain.querySelectorAll('.full-slide');
			const slideCount = slides.length;

			if (slideCount > 1) {
				const slideHeight = heroFull.offsetHeight;
				const endValue = `+=${slideHeight * slideCount}`;

				gsap.to(sliderMain, {
					top: `-${(slideCount - 1) * 100}%`,
					scrollTrigger: {
						trigger: heroFull,
						start: "top top",
						end: endValue,
						pin: true,
						scrub: true,
					}
				});

				slidesHidden.forEach((slide) => {
					gsap.fromTo(slide, { opacity: 0 }, {
						opacity: 1,
						scrollTrigger: {
							trigger: slide,
							start: "top 50%",
							end: "50% 65%",
							scrub: true,
						}
					});
				});

				slides.forEach((slide) => {
					if (slide.classList.contains('multi-stat-slide')) {
						const statItems = slide.querySelectorAll('.stat-item .inner-wrapper');
			
						// Set individual scroll trigger for each multi-stat slide
						gsap.fromTo(slide, { opacity: 0 }, {
							opacity: 1,
							scrollTrigger: {
								trigger: slide,
								start: "top 75%",
								end: "bottom top",
								onEnter: () => {
									statItems.forEach((statItem) => {
										const numberElement = statItem.querySelector('.number');
										if (numberElement) {
											counterUp(numberElement, {
												duration: 1000,
												delay: 16,
											});
										}
									});
								},
							}
						});
					}
				});
			}
		});
	};

	setScrollTriggersHeroFull();

	var counterUp = window.counterUp["default"];

	// GSAP - end
	// ****************************************


	// ****************************************
	// ****************************************
	// COMPONENT FUNCTIONS - start
	// Video - Autoplay
	if($('.hero-full video').length > 0) {
		$window.on('load', function() {
			if(window.innerWidth >= 1080) {
				var videos = document.querySelectorAll('.hero-full video');

				for (var i = 0; i < videos.length; i++) {
					var videoElement = videos[i];
					var sourceElement = videoElement.querySelector('source');
					var videoSource = sourceElement.getAttribute('data-src');

					if (videoSource) {
						sourceElement.setAttribute('src', videoSource);
						videoElement.load(); // Load the video file
						videoElement.play(); // Play the video if autoplay is desired
					}
				}
			}
		});
	}

	// COMPONENT FUNCTIONS - end
	// ****************************************
});
