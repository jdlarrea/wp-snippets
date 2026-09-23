<?php
// Fields
$pull_data_from = $row['pull_data_from'];

if( $pull_data_from === 'global' ) {
	$global_testimonials = get_field( 'global_testimonials', 'option' );
	$section_button = Helpers\Templates::to_string( $global_testimonials['section_button'], 'framework_button' );
	$content_body = $global_testimonials['content_body'] ? '<div class="content-body">'. $global_testimonials['content_body'] .'</div>' : '';
	$items = $global_testimonials['items'];
}
else {
	$section_button = Helpers\Templates::to_string( $row['section_button'], 'framework_button' );
	$content_body = $row['content_body'] ? '<div class="content-body">'. $row['content_body'] .'</div>' : '';
	$items = $row['items'];
}

if( isset($items) && is_array($items) && count($items) > 0 ) {

?>

<section class="component testimonials">
	<div class="wrapper">
	<?php
		if( $content_body || $section_button ) {
			echo '<div class="section-header">';
			echo 	$content_body;
			echo 	$section_button;
			echo '</div>';
		}

		// Swiper - Testimonials: images
		echo '<div class="swiper swiper-testimonial-images">';
		echo '	<div class="swiper-wrapper">';
		foreach( $items as $item ) {
			echo '		<div class="swiper-slide">';
			echo '			<div class="inner-wrapper">';
			echo 				acme_post_thumbnail_manual( $item['image']['ID'], 'large', 'main-image' );
			echo 				acme_post_thumbnail_manual( $item['icon']['ID'], 'large', 'static logo-icon' );
			echo '			</div>'; // .inner-wrapper
			echo '		</div>'; // .swiper-slide
		}
		echo '	</div>';
		echo '</div>';

		// Swiper - Testimonials: contents
		echo '<div class="swiper swiper-testimonial-contents">';
		echo '	<div class="swiper-wrapper">';
		foreach( $items as $item ) {
			echo '		<div class="swiper-slide">';
			echo 			'<div class="content-body">'. $item['content_body'] .'</div>';
			echo '		</div>';
		}
		echo '	</div>';
		echo '</div>';
	?>
	</div>
</section>

<?php } ?>
