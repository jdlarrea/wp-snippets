var $ = jQuery;
$window = $(window);

$(document).ready(function() {
	// ****************************************
	// ****************************************
	// SELECTORS - start
	const ele_Timelines = document.querySelectorAll('.component.timeline');

	// SELECTORS - end
	// ****************************************


	// ****************************************
	// ****************************************
	// GSAP - start
	gsap.registerPlugin(ScrollTrigger);

	// Timelines
	const scrollTriggers_timelines = [];
	const mm = gsap.matchMedia();

	const setScrollTriggersTimelinesDesktop = () => {
		ele_Timelines.forEach((timeline) => {
			const timeYears = timeline.querySelector('.time-years');
			const spinnerYears = timeline.querySelectorAll('.spinner-year');
			const timeImgs = timeline.querySelectorAll('.time-images .image-wrapper');
			const timeContents = timeline.querySelectorAll('.time-contents .content-wrapper');

			if (spinnerYears.length > 1) {
				const slideHeight = spinnerYears[0].offsetHeight;
				const totalMove = slideHeight * (spinnerYears.length - 1);

				gsap.set(timeYears, { x: 0, y: 0 });

				const scrollTrigger = gsap.to(timeYears, {
					y: -totalMove,
					ease: "none",
					scrollTrigger: {
						trigger: timeline,
						start: `top top+=59px`,
						end: `+=${totalMove}`,
						pin: true,
						scrub: true,
						snap: {
							snapTo: 1 / (spinnerYears.length - 1),
							duration: { min: 0.1, max: 0.2 },
							ease: "power2.inOut",
							onComplete: (self) => {
								const snappedIndex = Math.round(self.progress * (spinnerYears.length - 1));
								spinnerYears.forEach((spinner, index) => {
									if (index === snappedIndex) {
										spinner.classList.add('active');
									} else {
										spinner.classList.remove('active');
									}
								});
								timeImgs.forEach((img, index) => {
									if (index === snappedIndex) {
										img.classList.add('active');
									} else {
										img.classList.remove('active');
									}
								});
								timeContents.forEach((content, index) => {
									if (index === snappedIndex) {
										content.classList.add('active');
									} else {
										content.classList.remove('active');
									}
								});
							}
						},
						onUpdate: (self) => {
							const snappedIndex = Math.round(self.progress * (spinnerYears.length - 1));
							spinnerYears.forEach((spinner, index) => {
								if (index === snappedIndex) {
									spinner.classList.add('active');
								} else {
									spinner.classList.remove('active');
								}
							});
							timeImgs.forEach((img, index) => {
								if (index === snappedIndex) {
									img.classList.add('active');
								} else {
									img.classList.remove('active');
								}
							});
							timeContents.forEach((content, index) => {
								if (index === snappedIndex) {
									content.classList.add('active');
								} else {
									content.classList.remove('active');
								}
							});
						}
					}
				});

				scrollTriggers_timelines.push(scrollTrigger.scrollTrigger);
			}
		});
	};

	const setScrollTriggersTimelinesMobile = () => {
		ele_Timelines.forEach((timeline) => {
			const timeYears = timeline.querySelector('.time-years');
			const spinnerYears = timeline.querySelectorAll('.spinner-year');
			const timeImgs = timeline.querySelectorAll('.time-images .image-wrapper');
			const timeContents = timeline.querySelectorAll('.time-contents .content-wrapper');

			if (spinnerYears.length > 1) {
				const slideWidth = spinnerYears[0].offsetWidth;
				const totalMove = slideWidth * (spinnerYears.length - 1);

				gsap.set(timeYears, { x: 0, y: 0 });

				const scrollTrigger = gsap.to(timeYears, {
					x: -totalMove,
					ease: "none",
					scrollTrigger: {
						trigger: timeline,
						start: `top top+=59px`,
						end: `+=${totalMove}`,
						pin: true,
						scrub: true,
						snap: {
							snapTo: 1 / (spinnerYears.length - 1),
							duration: { min: 0.1, max: 0.2 },
							ease: "power2.inOut",
							onComplete: (self) => {
								const snappedIndex = Math.round(self.progress * (spinnerYears.length - 1));
								spinnerYears.forEach((spinner, index) => {
									if (index === snappedIndex) {
										spinner.classList.add('active');
									} else {
										spinner.classList.remove('active');
									}
								});
								timeImgs.forEach((img, index) => {
									if (index === snappedIndex) {
										img.classList.add('active');
									} else {
										img.classList.remove('active');
									}
								});
								timeContents.forEach((content, index) => {
									if (index === snappedIndex) {
										content.classList.add('active');
									} else {
										content.classList.remove('active');
									}
								});
							}
						},
						onUpdate: (self) => {
							const snappedIndex = Math.round(self.progress * (spinnerYears.length - 1));
							spinnerYears.forEach((spinner, index) => {
								if (index === snappedIndex) {
									spinner.classList.add('active');
								} else {
									spinner.classList.remove('active');
								}
							});
							timeImgs.forEach((img, index) => {
								if (index === snappedIndex) {
									img.classList.add('active');
								} else {
									img.classList.remove('active');
								}
							});
							timeContents.forEach((content, index) => {
								if (index === snappedIndex) {
									content.classList.add('active');
								} else {
									content.classList.remove('active');
								}
							});
						}
					}
				});

				scrollTriggers_timelines.push(scrollTrigger.scrollTrigger);
			}
		});
	};

	const setScrollTriggersTimelines = () => {
		// Kill existing ScrollTriggers
		scrollTriggers_timelines.forEach(trigger => trigger.kill());
		scrollTriggers_timelines.length = 0;

		mm.add("(min-width: 768px)", setScrollTriggersTimelinesDesktop);
		mm.add("(max-width: 767px)", setScrollTriggersTimelinesMobile);
	};

	setScrollTriggersTimelines();

	// GSAP - end
	// ****************************************


	// ****************************************
	// ****************************************
	// RESIZE - start
	let resizeTimer_ScrollTriggerTimelines;

	window.addEventListener('resize', () => {
		// Timeline - Recalculate scrollTriggers
		clearTimeout(resizeTimer_ScrollTriggerTimelines);
		resizeTimer_ScrollTriggerTimelines = setTimeout(() => {
			setScrollTriggersTimelines();
			ScrollTrigger.refresh();
		}, 300);
	});

	// RESIZE - end
	// ****************************************
});
