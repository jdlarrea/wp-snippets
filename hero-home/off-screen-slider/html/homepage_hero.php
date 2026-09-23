<?php
	$hero_slides = $row['hero_slides'];

	$slider_images = '';
	$slider_html = '';

	$has_multiple_slides = count($hero_slides) > 1;
	foreach($hero_slides as $slide) { 
		//create slider having on the left the text and on the right the images
		$button_html = Helpers\Templates::to_string($slide['button'], 'button');
		$background_image = Helpers\Templates::to_string($slide['background_image'], 'background_image');

		$slider_images .= $background_image ? $background_image : '';

		$slider_html .= '<div class="slide-text">
							<div class="heading">'.nl2br($slide['header']).'</div>
							<div class="content">'.$slide['content'].'</div>
							'.(!empty($button_html) ? '<div class="button-container">'.$button_html.'</div>' : '').' 
						</div>';
	}

?>
<?php if($hero_slides): ?>
	
	<section class="homepage-hero">
		<div class="carousel wrapper">

			<div class="slider-content-wrapper">
				<div class="slider-content">
					<div class="slider-content-inner">
						<?= $slider_html ?>
					</div>
					<?= $has_multiple_slides ? '<div class="slick-dots-wrapper"></div>' : '' ?>
				</div>
				
			</div>

			<div class="slider-image-wrapper<?= (!$has_multiple_slides ? ' one-slide' : '') ?>">
				<?= $slider_images ?>
			</div>

		</div>
	</section>

<?php endif; ?>