<?php
// Fields - Standard
$header = $row['header'];
$text = $row['text'];
$logo_items = $row['logo_items'];

// Generate HTML - Logo Items
$html_logo_items = '';

foreach( $logo_items as $item ) {
	$image_url = $item['image']['sizes']['medium'];
	$image_alt = ($item['image']['alt']) ?: 'Logo Image';

	if( isset($item['url']) && !empty($item['url']) ) {
		$new_tab = ($item['new_tab']) ? 'target="_blank"' : '';

		$html_logo_items .= '<a href="'. $item['url'] .'" class="logo-slide" '. $new_tab .'><img class="b-lazy" data-src="'. $image_url .'" alt="'. $image_alt .'" /></a>';
	}
	else {
		$html_logo_items .= '<div class="logo-slide"><img class="b-lazy" data-src="'. $image_url .'" alt="'. $image_alt .'" /></div>';
	}
}

?>

<section class="component-logo-slider-container">
	<div class="component-logo-slider-wrapper wrapper">
		<div class="header-wrapper">
		<?php
			if($header) {
				echo '<div class="header add-inline-logo">'. $header .'</div>';
			}

			echo '<div class="slick-dots-wrapper"></div>';

			if($text) {
				echo '<div class="text">'. $text .'</div>';
			}
		?>
		</div>

		<div class="slider-logos">
			<?= $html_logo_items ?>
		</div>
	</div>
</section>