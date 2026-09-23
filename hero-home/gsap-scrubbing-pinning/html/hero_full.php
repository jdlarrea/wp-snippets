<?php
// Fields
$background_type = $row['background_type'];
$items = $row['items'];

?>

<section class="component hero-full">
	<div class="component-arrow">
		SCROLL DOWN
		<div class="long-arrow"></div>
	</div>

	<div class="bg-wrapper <?= $background_type ?> ">
		<?php
			// Video or Image
			if( $background_type === 'video' ) {
				echo Helpers\Templates::to_string( $row['video_group'], 'framework_bg_video' );
			}
			else {
				echo acme_post_thumbnail_manual( $row['image_group']['image']['ID'], 'extra_large' );
			}

			// Overlay (optional)
			echo Helpers\Templates::to_string( $row['background_overlay'], 'overlay' );
		?>
	</div>

	<?php if( isset($items) && is_array($items) && count($items) > 0 ) {
		$counter_slides = 1;

		// Gsap class: add class if at least 1 slide has multiple stats
		$class_slider_main = '';
		foreach ($items as $item) {
			if ( isset($item['stats']) && is_array($item['stats']) && count($item['stats']) > 1) {
				$class_slider_main = 'has-multi-stat-slide';

				break;
			}
		}
	?>
		<div class="slider-hero-full <?= $class_slider_main ?>">

		<?php
			foreach( $items as $item ) {
				$header = $item['header'];
				$button = Helpers\Templates::to_string( $item['button'], 'framework_button' );
				$stats = $item['stats'];
				$class_slide = ( $counter_slides === 1 ) ? 'slide-initial' : 'slide-hidden';
				$logo_image = $item['logo_image'] ?: '';

				if ( isset($stats) && is_array($stats) && count($stats) > 0) {
					$class_slide .= ' multi-stat-slide';
				}
				if($logo_image) $class_slide .= ' has-logo';

				echo '<div class="full-slide wrapper '. $class_slide .'">';

				if( $header || $button ) {
					echo '<div class="content-wrapper">';

					if( $header ) {
						echo '<div class="heading">';
						echo '<div class="title">'.(( $counter_slides === 1 ) ? '<h1 class="slide-header">'. $header .'</h1>' : '<h2 class="slide-header">'. $header .'</h2>').'</div>';
						if($logo_image){
							echo '<div class="logo-wrapper">';
							echo '<img src="'. $logo_image .'" alt="" />';
							echo '</div>';
						}
						echo '</div>';
					}

					if( isset($stats) && is_array($stats) && count($stats) > 0 ) {
						echo '<div class="hero-stats">';
	
						foreach( $stats as $stat ) {
								$number = ( $stat['number'] ) ? '<div class="number">'. $stat['number'] .'</div>' : '';
								$unit = ( $stat['unit'] ) ? '<div class="unit">'. $stat['unit'] .'</div>' : '';
								$description = ( $stat['description'] ) ? '<div class="description">'. $stat['description'] .'</div>' : '';
	
								echo '<div class="stat-item">';
								echo 	'<div class="inner-wrapper">';
								echo 		$number;
								echo 		$unit;
								echo 	'</div>';
								echo 	$description;
								echo '</div>';
						}
	
						echo '</div>'; // .hero-stats
					}

					echo 	$button;

					echo '</div>'; // .content-wrapper
				}

				echo '</div>'; // .full-slide

				$counter_slides++;
			}
		?>

		</div> <!-- .slider-hero-full -->
	<?php } ?>
	<div class="hero-bg"></div>
</section>
