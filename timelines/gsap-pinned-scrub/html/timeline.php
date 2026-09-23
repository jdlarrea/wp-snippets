<?php
// Fields
$select_history = $row['select_history'];

if( isset($select_history) && is_array($select_history) && count($select_history) > 0  ) {

?>

<section class="component contained timeline">
	<?php
		$counter_imgs = 1;
		$counter_years = 1;
		$counter_contents = 1;

		// Images
		echo '<div class="time-images">';
		foreach( $select_history as $history_id ) {
			$html_overlay = Helpers\Templates::to_string( get_field( 'image_overlay', $history_id ), 'overlay' );

			if( $counter_imgs == 1 ) {
				$class_img = 'active img-' . $counter_imgs;
			}
			else {
				$class_img = 'img-' . $counter_imgs;
			}

			echo '<div class="image-wrapper '. $class_img .'">';
			echo 	$html_overlay;
			echo 	acme_post_thumbnail_manual( get_post_thumbnail_id( $history_id ), 'extra_large' );
			echo '</div>';

			$counter_imgs++;
		}
		echo '</div>'; // .time-images

		// Content Area (years + contents)
		echo '<div class="wrapper-timeline">';
		echo '	<div class="time-years">';
			foreach( $select_history as $history_id ) {
				$year = get_field( 'year', $history_id );
				if( $counter_years == 1 ) {
					$class_years = 'active year-' . $counter_years;
				}
				else {
					$class_years = 'year-' . $counter_years;
				}

				echo '<div class="spinner-year '. $class_years .'">';
				echo '	<div class="year-text">'. $year .'</div>';
				echo '	<div class="year-dot"><div class="outer"><div class="inner"></div></div></div>';
				echo '</div>';

				$counter_years++;
			}
		echo '	</div>'; // .time-years

		echo '	<div class="time-contents">';
			foreach( $select_history as $history_id ) {
				// $year = get_field( 'year', $history_id );
				// $button = Helpers\Templates::to_string( get_field( 'button', $history_id ), 'framework_button' );
				$categories = get_the_category( $history_id );
				$post_content = get_post_field('post_content', $history_id);
				$post_content = apply_filters('the_content', $post_content);
				if( $counter_contents == 1 ) {
					$class_contents = 'active content-' . $counter_contents;
				}
				else {
					$class_contents = 'content-' . $counter_contents;
				}

				echo '<div class="content-wrapper '. $class_contents .'">';
				echo 	$post_content;
				if ($categories) {
					echo '<div class="terms">';
					foreach ($categories as $item) {
						$class_term = 'blue';
						if( $item->name == 'Category A' ) {
							$class_term = 'green';
						}
						if( $item->name == 'Category B' ) {
							$class_term = 'yellow';
						}

						echo '<div class="term '. $class_term .'">';
						echo 	$item->name;
						echo '</div>';
					}
					echo '</div>'; // .terms
				}
				echo '</div>';

				$counter_contents++;
			}
		echo '	</div>'; // .time-years
		echo '</div>'; // .wrapper-timeline
	?>
</section>

<?php } ?>
