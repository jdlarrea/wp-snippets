<?php
function render_svg($image_id) {
	$filename = basename( get_attached_file( $image_id ) );
	$pieces = explode('.', $filename);
	$extension = $pieces[1];

	if( $extension == 'svg' ) {
		$output = file_get_contents(wp_get_original_image_path($image_id));
	} else {
		$output = false;
	}

	return $output;
}
