<?php
// Fields
$align_content = $row['align_content'];
$theme = ($row['theme'] === 'dark') ? 'dark invert' : 'light';
$select_offers = $row['select_offers'];

if (isset($select_offers) && is_array($select_offers) && count($select_offers) > 0) {
    $offers = new WP_Query([
        'post_status'    => 'publish',
        'posts_per_page' => -1,
        'post_type'      => 'offer',
        'post__in'       => $select_offers,
        'orderby'        => 'post__in',
    ]);


    if ($offers->have_posts()) {
?>

<section class="component offer-slider align-<?= $align_content ?> theme-<?= $theme ?>">
	<div class="swiper swiper-offer-images">
		<div class="swiper-wrapper">
			<?php
				$html_slides_contents = '';

				while ($offers->have_posts()) { $offers->the_post();
					$eyebrow 		= get_field('eyebrow');
					$header 		= get_field('header');
					$description 	= get_field('description');
					$link 			= get_field('link');
					$video_url 		= get_field('video_url');

					// SWIPER: Images
					echo '<div class="swiper-slide image-slide">';
							acme_post_thumbnail('extra_large', 'absolute');
					if( $video_url ) {
							echo '<a href="'. esc_url( $video_url ) .'" class="play-link" data-fancybox><i class="icon-play"></i></a>';
					}
					echo '</div>';

					// SWIPER: Contents - Generate in the 'while' loop, render later
					$html_slides_contents .= '<div class="swiper-slide">';
					$html_slides_contents .= '	<div class="eyebrow hdr-accent">'. $eyebrow .'</div>';
					$html_slides_contents .= '	<div class="header h2">'. $header .'</div>';
					$html_slides_contents .= '	<div class="description">'. $description .'</div>';
					$html_slides_contents .= 	Helpers\Templates::to_string( $link, 'framework_button', ['style'=> 'primary white'] );
					$html_slides_contents .= '</div>';
				}
			?>
		</div>
	</div>

	<div class="wrapper">
		<div class="swiper-container-contents <?= ($theme === 'light') ? 'theme-dark' : '' ?>">
			<div class="acme-swiper-pagination"></div>

			<div class="swiper swiper-offer-contents">
				<div class="swiper-wrapper">
					<?= $html_slides_contents // Slides generated in Images loop ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
        // Reset post data after looping
        wp_reset_postdata();
    }
}
?>
