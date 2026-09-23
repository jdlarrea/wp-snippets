<?php
use Helpers\Templates;

// Fields
$component_data = $row['component_data'];
$html_slides_contents = '';
$html_slides_images = '';

if( $component_data['slides'] ) {
	foreach( $component_data['slides'] as $slide ) {
		$left_side = $slide['left_side'];
		$background_design = $left_side['background_design'];
		$eyebrow_text = $left_side['eyebrow_text'];
		$header = $left_side['header'];
		$button = $left_side['button'];

		$right_side = $slide['right_side'];
		$select_type = $right_side['select_type'];

		// Populate Slides - Left
		$html_slides_contents .= '<div class="content-slide">';
		$html_slides_contents .= 	Helpers\Templates::to_string( $background_design, 'framework_bg_image', ['size' => 'extra_large'] );
		$html_slides_contents .= 	'<div class="content-wrapper">';
		if( $eyebrow_text ) {
			$html_slides_contents .= 	'<div class="eyebrow-text">'. $eyebrow_text .'</div>';
		}
		if( $header ) {
			$html_slides_contents .= 	'<div class="header">'. $header .'</div>';
		}
		$html_slides_contents .= 	Helpers\Templates::to_string( $button, 'framework_button', ['style' => 'secondary hero-button'] );

		$html_slides_contents .= 	'</div>';
		$html_slides_contents .= '</div>';

		// Populate Slides - Right
		if( $select_type == 'video' ) {
			$html_slides_images .= '<div class="hero-video-slide">';
			$html_slides_images .= 		Helpers\Templates::to_string( $right_side['slide_video'], 'framework_bg_video' );
			$html_slides_images .= '</div>';
		}
		else {
			$html_slides_images .= Helpers\Templates::to_string( $right_side['slide_image'], 'framework_bg_image', ['style' => 'hero-image-slide', 'size' => 'extra_large'] );
		}
	}
}

?>

<div class="component component-hero-home">
	<div class="slider-herohome-contents">
		<?= $html_slides_contents ?>
	</div>

	<div class="slider-herohome-images">
		<?= $html_slides_images ?>
	</div>

	<div class="slick-arrows">
		<i class="icon-circle-arrow-left slick-arrow slick-prev"></i>
		<i class="icon-circle-arrow-right slick-arrow slick-next"></i>
	</div>
</div>
