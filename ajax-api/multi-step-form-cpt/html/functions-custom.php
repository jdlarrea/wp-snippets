<?php
// ****************************************
// Functions - Custom
function custom_shortcode_assessment_form() {
	ob_start();

	get_template_part('template-parts/assessment-form');

	return ob_get_clean();
}
add_shortcode('custom_assessment_form', 'custom_shortcode_assessment_form');

// ... other shortcodes and helpers
