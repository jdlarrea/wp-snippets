var $ = jQuery;
$window = $(window);

$(document).ready(function(){
	var firstComponent = $('.site-content section').first();
	if(firstComponent.hasClass('hero-sub-light') || firstComponent.hasClass('hero-sub-light-simple') || firstComponent.hasClass('breadcrumbs')) {
		$('html').addClass('solid-header');
	}

	let resizeTimer;
	$window.on('resize', function() {
		handleAlertBar();

		document.body.classList.add("resize-animation-stopper");

		clearTimeout(resizeTimer);

		resizeTimer = setTimeout(() => {
			document.body.classList.remove("resize-animation-stopper");
		}, 400);
	});

}).on('scroll', $window, function() {
	var $nav = $('.site-header');

	if($window.scrollTop() > 50) {
		$nav.addClass('sticky');
	} else {
		$nav.removeClass('sticky');
	}
}).on('click', '.site-header .header-search .search-button', function(e) {
	e.preventDefault();

    var $el = $(this);
    var $formWrap = $el.siblings('.form-wrap');
    var $inputField = $formWrap.find('input');

    if ($el.hasClass('open')) {
        $formWrap.slideUp(300);
    } else {
        $formWrap.slideDown(300, function() {
            $inputField.focus();
        });
    }

    $el.toggleClass('open');
}).on('click', '.nav-on', function(e) {
	if(!$(e.target).closest('.menu-item').length && !$(e.target).closest('.site-header').length ) {
		if( $(this).hasClass('nav-on-desktop') ) {
			if( $('.sub-menu-main').hasClass('sub-active-desktop') ) {
				$('.sub-menu-main').slideUp(function() {
					$('.sub-menu-main').removeClass('sub-active-desktop');
				});

				$('.main-navigation .menu-header-main > .menu-item.menu-item-active').removeClass('menu-item-active');
				$('html').removeClass('nav-on-desktop');
			}
		}

		if( $(this).hasClass('nav-on-mobile') ) {
			$('.site-header .nav-toggle').removeClass('mobile-nav-active');
			$('.main-navigation').removeClass('mobile-menu-active');

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

			$('html').removeClass('nav-on nav-on-mobile');
		}
	}
}).on('click', '.main-navigation .menu-header-main > .menu-item-has-children > .menu-element', function(e) {
	e.preventDefault();

	if (window.innerWidth >= 1280) { // Desktop
		const $this = $(this);
		const $menuParent = $this.parent();
		const $menuSub = $menuParent.find('.sub-menu-main');

		if( $menuParent.hasClass('menu-item-active') ) {
			$menuParent.removeClass('menu-item-active');
		}
		else {
			$('.main-navigation .menu-header-main > .menu-item.menu-item-active').removeClass('menu-item-active');
			$menuParent.addClass('menu-item-active');
		}

		if( $menuSub.hasClass('sub-active-desktop') ) {
			$menuSub.slideUp(function() {
				$menuSub.removeClass('sub-active-desktop');
			});

			$('html').removeClass('nav-on-desktop');
		}
		else {
			$('.sub-menu-main').slideUp(function() {
				$('.sub-menu-main').removeClass('sub-active-desktop');
			});

			$menuSub.slideDown(function() {
				$menuSub.addClass('sub-active-desktop');
			});

			$('html').addClass('nav-on nav-on-desktop');
		}
	}
	else { // Mobile
		const $el = $(this);
		const $parent = $el.parent(); // <li class="menu-item">
		const $grandParent = $parent.parent().parent(); // <li class="menu-item">
		const $subMenuMain = $('.sub-menu-main', $parent);

		$grandParent.addClass('sub-menu-active');

		gsap.to($subMenuMain, {
			x: '0',
			duration: 0.5,
			onComplete: function() {
				$subMenuMain.addClass('sub-active-mobile');
			}
		});
	}
}).on('click', '.site-header .nav-toggle', function(e) {
	const $el = $(this);
	const $parent = $el.parent();

	$('html').toggleClass('nav-on nav-on-mobile');

	if( $('.main-navigation', $parent).hasClass('mobile-menu-active') ) {
		$el.removeClass('mobile-nav-active');
		$('.main-navigation', $parent).removeClass('mobile-menu-active');

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
	}
	else {
		$el.addClass('mobile-nav-active');
		$('.main-navigation', $parent).addClass('mobile-menu-active');
	}

}).on('click', '.main-navigation .sub-menu-back', function(e) {
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
}).on('click', '.mega-rows-see-more', function(e) {
	const $el = $(this);
	const $rowsParent = $(this).parent();
	const $rowsGrandParent = $(this).parent().parent();

	$el.slideUp();
	setTimeout(function() {
		$rowsParent.find('.link-wrapper').slideDown();
		$rowsGrandParent.find('.lvl-2.sub-menu .menu-item').slideDown();
	}, 500);

}).on('click', '.alert-bar-close', function(e) {
    e.preventDefault();
	handleAlertBar('close');
});

function handleAlertBar(action='open') {
    if (sessionStorage.getItem('acme-alert-bar') === 'closed') return;

    var alertBar = $('.alert-bar');
    var header = $('.site-header');
    var site = $('.site');

    if (alertBar.length === 0) return;

    var alertBarHeight = alertBar.outerHeight();

	if (action === 'close') {
		sessionStorage.setItem('acme-alert-bar', 'closed');
		alertBar.slideUp();
		site.css('padding-top', 0);
		header.css('top', 0);
	} else {
		alertBar.css('display', 'block');
		site.css('padding-top', alertBarHeight);
		header.css('top', alertBarHeight);
	}
}
