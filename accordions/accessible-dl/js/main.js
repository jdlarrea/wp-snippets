var $ = jQuery;
$window = $(window);

$(document).on('click keydown', '.accordion dl > dt', function(event) {
	// Only activate on Enter (13) or Space (32) for keydown events
	if (event.type === 'keydown' && event.keyCode !== 13 && event.keyCode !== 32) {
		return;
	}

	var $accordion = $(this).closest('dl');
	var $accordionContent = $(this).next('dd');
	var isOpen = $(this).hasClass('on');

	$(this)
		.toggleClass('on', !isOpen)
		.attr('aria-expanded', !isOpen);

	$accordionContent
		.slideToggle()
		.attr('aria-hidden', isOpen);

	$('dt.on', $accordion)
		.not(this)
		.removeClass('on')
		.attr('aria-expanded', false)
		.next('dd')
		.slideUp()
		.attr('aria-hidden', true);

	event.preventDefault();
});
