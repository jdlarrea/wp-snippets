<?php
// Fields - Standard
$header = $row['header'];
$sub_header = $row['sub_header'];
$hero_buttons = $row['hero_buttons'];
$hero_image_group = $row['hero_image'];
$hero_video_group = $row['hero_video'];

// HTML - Generate Background Image
$bg_position = $hero_image_group['position'];
$image_src = $hero_image_group['image']['url'];
$html_image_background_style = 'style="background-image: url('. $image_src .');"';

if( $bg_position != 'default' ) {
	if( $bg_position == 'custom' ) {
		$html_image_background_style = 'style="background-image: url('. $image_src .'); background-position: '. $row['hero_image']['custom_position'] .';"';
	}
	else {
		$html_image_background_style = 'style="background-image: url('. $image_src .'); background-position: '. $bg_position .';"';
	}
} 

// HTML - Generate Background Video
$html_background_video = '';
$video_src = $hero_video_group['video'];

if( $video_src ) {
	$poster_url = $row['hero_video']['poster']['url'];
	$poster_attr = $poster_url ? 'poster="'. $poster_url .'"' : '';
	
	$html_background_video .= '<video class="hero-video" playsinline="playsinline" autoplay="autoplay" loop muted="muted" '. $poster_attr .'>';
	$html_background_video .= '	<source src="'. $video_src .'" type="video/mp4">';
	$html_background_video .= '</video>';
}

// HTML - Generate Buttons
$html_buttons = '';

if( $hero_buttons ) {
	foreach( $hero_buttons as $btn ) {
		$btn_class = 'btn-hero button ' . $btn['button_style'];
		$new_tab = ($btn['new_tab']) ? 'target="_blank"' : '';

		$html_buttons .= '<a href="'. $btn['link'] .'" class="'. $btn_class .'" '. $new_tab .'>'. $btn['text'] .'</a>';
	}
}

?>

<div class="component component-hero-home">
	<div class="hero-image <?= ($video_src) ? '' : ' show-desktop' ?>" <?= $html_image_background_style ?> ></div>

	<div class="component-hero-home-wrapper wrapper">
		<div class="hero-content">
			<?= ($header) ? '<h1 class="header">'. $header .'</h1>' : '' ?>
			<?= ($sub_header) ? '<div class="sub-header">'. $sub_header .'</div>' : '' ?>
			<?= $html_buttons ?>
		</div>

		<div class="hero-video-box">
			<div class="video-box-container">
				<div class="video-box-wrapper">
					<?= $html_background_video ?>
				</div>
			</div>

			<div class="design-circle circle-1"></div>
			<div class="design-circle circle-2"></div>
		</div>
	</div>
</div>