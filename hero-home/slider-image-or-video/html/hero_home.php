<?php
// Fields
$items = $row['items'];

if( isset($items) && is_array($items) && count($items) > 0 ) {

?>

<section class="component hero-home">
	<div class="swiper swiper-hero-home">
		<div class="swiper-wrapper">
			<?php
			$counter_slides = 1;

			foreach( $items as $item ) {
				$type = $item['type'];
				$slide_eyebrow = ( $item['eyebrow'] ) ? '<div class="eyebrow with-line"><div class="eyebrow-text">'. $item['eyebrow'] .'</div></div>' : '';
				if( $counter_slides == 1 ) {
					$slide_header = ( $item['header'] ) ? '<h1 class="slide-header h1">'. $item['header'] .'</h1>' : '';
				}
				else {
					$slide_header = ( $item['header'] ) ? '<div class="slide-header h1">'. $item['header'] .'</div>' : '';
				}
				$slide_button = Helpers\Templates::to_string( $item['button'], 'framework_button', [ 'style' => 'primary alt' ] );

				// Background Layers
				echo '	<div class="swiper-slide">';
				echo '		<div class="bg-wrapper">';

					if( $type === 'image' ) {
						echo Helpers\Templates::to_string( $item['image_group'], 'framework_bg_image' );
					}
					else {
						echo Helpers\Templates::to_string( $item['video_group'], 'framework_bg_video' );
					}

					echo Helpers\Templates::to_string( $item['overlay'], 'overlay' );
				echo '		</div>';

				// Content
				echo '		<div class="wrapper">';
				echo '			<div class="inner-wrapper">';
				echo '				<div class="slide-content">';
				echo 					$slide_eyebrow;
				echo 					$slide_header;
				echo 					$slide_button;
				echo '				</div>';
				echo '			</div>'; // .inner-wrapper
				echo '		</div>'; // .wrapper
				echo '	</div>'; // .swiper-slide

				$counter_slides++;
			}
			?>
		</div>

		<div class="acme-swiper-pagination"></div>
	</div>
</section>

<?php } ?>
