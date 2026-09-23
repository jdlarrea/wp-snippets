var $ = jQuery;
$window = $(window);

$(document).ready(function(){
	// STATS: counter up
	var counterUp = window.counterUp["default"];
	var $counters = $(".stat-value");

	$counters.each(function (ignore, counter) {
		var waypoint = new Waypoint( {
			element: $(this),
			handler: function() {
				counterUp(counter, {
					duration: 1000,
					delay: 16
				});
				this.destroy();
			},
			offset: 'bottom-in-view',
		} );
	});
});
