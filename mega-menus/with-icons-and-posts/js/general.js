var $ = jQuery;
$window = $(window);

$(document).ready(function() {
	// ****************************************
	// ****************************************
	// SELECTORS - start
	const ele_Body = document.querySelector('body');
	const ele_Header = document.querySelector('.site-header');
	let headerHeight = ele_Header.offsetHeight;
	let scrollTrigger_header;

	// SELECTORS - end
	// ****************************************


	// ****************************************
	// ****************************************
	// GSAP - start
	gsap.registerPlugin(ScrollTrigger);

	// Header
	const setScrollTriggerHeader = () => {
		// Kill existing scroll triggers
		if (scrollTrigger_header) {
			scrollTrigger_header.kill();
		}

		scrollTrigger_header = ScrollTrigger.create({
			trigger: ele_Body,
			start: `top+=${headerHeight} top`,
			onEnter: () => ele_Header.classList.add('scrolled'),
			onLeaveBack: () => ele_Header.classList.remove('scrolled'),
		});
	};
	setScrollTriggerHeader();

	// GSAP - end
	// ****************************************


	// ****************************************
	// ****************************************
	// RESIZE - start
	let resizeTimer_Animations;
	let resizeTimer_ScrollTriggerHeader;

	window.addEventListener('resize', () => {
		// GENERAL - fire every time
		document.body.classList.add("resize-animation-stopper");
		handleAlertBar();

		// Header - remove animation freeze once resize done
		clearTimeout(resizeTimer_Animations);
		resizeTimer_Animations = setTimeout(() => {
			document.body.classList.remove("resize-animation-stopper");
		}, 200);

		// Header - Recalculate scrollTriggers
		clearTimeout(resizeTimer_ScrollTriggerHeader);
		resizeTimer_ScrollTriggerHeader = setTimeout(() => {
			headerHeight = ele_Header.offsetHeight;
			setScrollTriggerHeader();
			ScrollTrigger.refresh();
		}, 300);
	});
	window.dispatchEvent(new Event('resize'));

	// RESIZE - end
	// ****************************************


	// ****************************************
	// ****************************************
	// FUNCTIONS - nested inside DOM ready in order to reference other functions

	// Alert Bar
	document.addEventListener('click', (e) => {
		if (e.target.matches('.alert-bar-close')) {
			e.preventDefault();
			handleAlertBar('close');
		}
	});

	function handleAlertBar(action = 'open') {
		console.log('alert-bar firing');

		if (sessionStorage.getItem('acme-alert-bar') === 'closed') return;

		const alertBar = document.querySelector('.alert-bar');
		const header = document.querySelector('.site-header');
		const site = document.querySelector('.site');

		if (!alertBar) return;

		const alertBarHeight = alertBar.offsetHeight;

		if (action === 'close') {
			sessionStorage.setItem('acme-alert-bar', 'closed');
			alertBar.classList.remove('active');
			site.style.paddingTop = '0';
			header.style.top = '0';

			recalculateMobileNavigation();
			ScrollTrigger.refresh();
		} else {
			alertBar.classList.add('active');
			site.style.paddingTop = `${alertBarHeight}px`;
			header.style.top = `${alertBarHeight}px`;

			recalculateMobileNavigation();
		}
	}

	function recalculateMobileNavigation() {
		const alertBar = document.querySelector('.alert-bar');
		const alertBarHeight = alertBar && alertBar.classList.contains('active') ? alertBar.offsetHeight : 0;

		if (window.innerWidth < 1200) {
			const mainNavigation = document.querySelector('.main-navigation');
			const megaParentBody = document.querySelectorAll('.menu-header-main .mega-parent-body');

			if (mainNavigation) {
				mainNavigation.style.top = `calc(${alertBarHeight}px + 60px)`;
				mainNavigation.style.height = `calc(100vh - ${alertBarHeight}px - 60px)`;
			}

			megaParentBody.forEach(megaParent => {
				megaParent.style.top = `calc(${alertBarHeight}px + 60px)`;
				megaParent.style.height = `calc(100vh - ${alertBarHeight}px - 60px)`;
			});
		}
	}



}).on('click', '.site-header .header-search .search-button', function(e) {
	$el = $(this);
	$parent = $el.parent();

	$el.toggleClass('open');
	$parent.toggleClass('search-active');
}).on('click', '.site-header .nav-toggle', function(e) { // ---------- NAV TOGGLE
	const $el = $(this);
	const $parent = $el.parent();

	$('html').toggleClass('nav-on');

	if( $('.main-navigation', $parent).hasClass('mobile-menu-active') ) {
		$el.removeClass('mobile-nav-active');
		$('.main-navigation', $parent).removeClass('mobile-menu-active');

		const $subMenuMain = $('.main-navigation .sub-menu-main.sub-active-mobile');
		const $mainNavigation = $('.main-navigation.sub-menu-active');

		if( $subMenuMain.length ) {
			gsap.to($subMenuMain, {
				x: '105%',
				duration: 0.5,
				onComplete: function() {
					$subMenuMain.removeClass('.sub-active-mobile');
					$mainNavigation.removeClass('sub-menu-active');
				}
			});
		}
	}
	else {
		$el.addClass('mobile-nav-active');
		$('.main-navigation', $parent).addClass('mobile-menu-active');
	}
}).on('click', '.main-navigation .menu-header-main .icon-mobile', function(e) { // ---------- MOBILE MENU
	e.preventDefault();

 	// Mobile
	const $el = $(this);
	const $grandParent = $el.parent().parent(); // <li class="menu-item">
	const $greatGrandParent = $grandParent.parent().parent(); // .main-navigation
	const $subMenuMain = $('.sub-menu-main', $grandParent);

	$greatGrandParent.addClass('sub-menu-active');

	if( $subMenuMain.length ) {
		gsap.to($subMenuMain, {
			x: '0',
			duration: 0.5,
			onComplete: function() {
				$subMenuMain.addClass('sub-active-mobile');
			}
		});
	}
}).on('click', '.main-navigation .sub-menu-back', function(e) { // ---------- MOBILE MENU SUB
	const $subMenuMain = $('.main-navigation .sub-menu-main.sub-active-mobile');
	const $mainNavigation = $('.main-navigation.sub-menu-active');

	gsap.to($subMenuMain, {
		x: '105%',
		duration: 0.5,
		onComplete: function() {
			$subMenuMain.removeClass('.sub-active-mobile');
			$mainNavigation.removeClass('sub-menu-active');
		}
	});
});
