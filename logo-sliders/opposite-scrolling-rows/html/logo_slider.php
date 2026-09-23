<?php
	$header = $row['header'];
	$logos = $row['logos'];
?>

<section class="logo-slider">
	<div class="wrapper">
		<header>
			<?php if($header) { ?>
				<div class="h2"><?= $header ?></div>
			<?php } ?>
		</header>
	</div>
	<?php if($logos) { ?>
		<?php if ($logos && count($logos) > 14) {
			$half_count = ceil(count($logos) / 2);
			// Split the array into two parts
			$first_slider = array_slice($logos, 0, $half_count);
			$second_slider = array_slice($logos, $half_count);
		} else {
			// If less than 15 images, show them in the first slider only
			$first_slider = $logos;
			$second_slider = [];
		} ?>

		<div class="carousel-first swiper">
			<div class="swiper-wrapper">
				<?php foreach($first_slider as $logo) { 
					?>
					<div class="swiper-slide item">
						<?= wp_get_attachment_image($logo, 'full'); ?>
					</div>
				<?php } ?>
			</div>
		</div>

		<?php if (!empty($second_slider)): ?>
			<div class="carousel-second swiper" dir="rtl">
				<div class="swiper-wrapper">
					<?php foreach($second_slider as $logo) { 
						?>
						<div class="swiper-slide item">
							<?= wp_get_attachment_image($logo, 'full'); ?>
						</div>
					<?php } ?>
				</div>
			</div>
		<?php endif; ?>

	<?php } ?>

</section>