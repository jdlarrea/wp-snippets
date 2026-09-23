<?php
// Fields
$header = $row['header'] ? '<h2 class="header h1">'. $row['header'] .'</h2>' : ''; 
$items = $row['items'];

if( isset($items) && is_array($items) && count($items) > 0 ) {

?>

<section class="component featured-testimonials">
	<div class="swiper">
		<div class="swiper-pagination"></div>
		<div class="swiper-wrapper">
			<?php foreach($items as $item) { 
				$review = $item['review'] ? '<div class="review">'.$item['review'].'</div>' : '';
				$name = $item['name'] ? '<div class="name h5">'.$item['name'].'</div>' : '';
				$title = $item['title'] ? '<div class="title">'.$item['title'].'</div>' : ''; ?>
				<div class="swiper-slide">
					<div class="wrapper">
						<aside class="content">
							<?= $header ?>
							<?= $review ?>
							<?= $name ?>
							<?= $title ?>
						</aside>
						<div class="image-container">
							<?php acme_post_thumbnail_manual($item['image']['ID'], 'extra-large'); ?>
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 315.2 311.3"><defs><radialGradient id="a" cx="1.063" cy="1.076" r="1.057" gradientTransform="matrix(1 0 0 1.049 0 -.053)" gradientUnits="objectBoundingBox"><stop offset="0" stop-color="#8bd3e6"/><stop offset="1" stop-color="#003a70"/></radialGradient><clipPath id="b"><path data-name="Rectangle 93" fill="url(#a)" d="M0 0h315.151v311.312H0z"/></clipPath></defs><g data-name="Group 203" transform="rotate(180 157.576 155.656)" clip-path="url(#b)" fill="url(#a)"><path data-name="Path 78" d="m48.36 158.929 252.088 139.653-139.29-251.455a334.81 334.81 0 0 0-112.8 111.8"/><path data-name="Path 79" d="M0 311.314h295.8L41.594 170.442A331.055 331.055 0 0 0 0 311.314"/><path data-name="Path 80" d="m172.707 40.439 142.444 257.048V.002a331.334 331.334 0 0 0-142.444 40.437"/></g></svg>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</section>

<?php } ?>
