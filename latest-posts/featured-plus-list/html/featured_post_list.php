<?php

$header = $row['header'] ? '<h2 class="header h3">'. $row['header'] .'</h2>' : '';
$select_posts = $row['select_posts'];
$query_limit = 4;

if( $select_posts == 'individual' ) {
	if($row['individual']) {
		$featured_posts = new WP_Query([
			'post_status' => 'publish',
			'post_type' => 'post',
			'post__in' => $row['individual'],
			'orderby' => 'post__in'
		]);
	} else {
		$featured_posts = false;
	}
} else if($select_posts == 'category') {
	$featured_posts = new WP_Query( array(
		'post_status' => 'publish',
		'posts_per_page' => $query_limit,
		'post_type' => 'post',
		'orderby' => 'date',
		'order'=>'DESC',
		'tax_query' => array(
			array(
				'taxonomy' => 'category',
				'field'    => 'term_id',
				'terms'    => $row['select_category'],
				),
			),
	)); 
} else if($select_posts == 'tag') {
	$featured_posts = new WP_Query( array(
		'post_status' => 'publish',
		'posts_per_page' => $query_limit,
		'post_type' => 'post',
		'orderby' => 'date',
		'order'=>'DESC',
		'tax_query' => array(
			array(
				'taxonomy' => 'post_tag',
				'field'    => 'term_id',
				'terms'    => $row['select_tag'],
				),
			),
	)); 
} else if($select_posts == 'content-type') {
	$featured_posts = new WP_Query( array(
		'post_status' => 'publish',
		'posts_per_page' => $query_limit,
		'post_type' => 'post',
		'orderby' => 'date',
		'order'=>'DESC',
		'tax_query' => array(
			array(
				'taxonomy' => 'content-type',
				'field'    => 'term_id',
				'terms'    => $row['select_type'],
				),
			),
	)); 
} else {
	$featured_posts = new WP_Query([
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => $query_limit,
		'orderby' => 'date',
		'order' => 'DESC',
	]);
}

if( $featured_posts && $featured_posts->have_posts() ) {
	$left_post = [];
	$right_posts = [];
	$counter_posts = 1;

	while( $featured_posts->have_posts() ) { $featured_posts->the_post();
		$post_id = get_the_id();
		$link = get_the_permalink();
		$title = get_the_title();
		$date = get_the_date();
		$primary_term = '';

		$primary_term_id = yoast_get_primary_term_id( 'content-type', $post_id );

		if( $primary_term_id ) {
			$primary_term = get_term( $primary_term_id );
			$primary_content_type = $primary_term->name;
		} else {
			$content_types = wp_get_object_terms( $post_id, 'content-type', ['fields' => 'names'] );

			if ( !empty($content_types) && !is_wp_error($content_types) ) {
				$primary_content_type = $content_types[0];
			} else {
				$primary_content_type = 'General';
			}
		}

		if( $counter_posts === 1 ) {
			$left_post['id'] = $post_id;
			$left_post['term'] = $primary_content_type;
			$left_post['link'] = $link;
			$left_post['title'] = $title;
			$left_post['date'] = $date;
		}
		else {
			$right_posts[] = [
				'id' => $post_id,
				'term' => $primary_content_type,
				'link' => $link,
				'title' => $title,
				'date' => $date
			];
		}

		$counter_posts++;
	}

	wp_reset_postdata();
?>

<section class="component featured-posts-list">
	<div class="wrapper">
		<?= $header ?>

		<div class="posts-wrapper">
			<a class="post-link left-post" href="<?= $left_post['link'] ?>">
				<?php
					echo acme_post_thumbnail_manual( get_post_thumbnail_id( $left_post['id'] ), 'large' );

					echo '<div class="post-info">';
					echo '	<div class="post-meta">';
					echo '		<div class="term">'. $left_post['term'] .'</div>';
					echo '		<div class="date">'. $left_post['date'] .'</div>';
					echo '	</div>';
					echo '	<div class="title">'. $left_post['title'] .'</div>';
					echo '</div>';
				?>
			</a>

			<div class="right-posts">
				<?php
					foreach( $right_posts as $right_post ) {
						echo '<a class="post-link" href="'. $right_post['link'] .'">';
						echo '	<div class="post-meta">';
						echo '		<div class="term">'. $right_post['term'] .'</div>';
						echo '		<div class="date">'. $right_post['date'] .'</div>';
						echo '	</div>';
						echo '	<div class="title">'. $right_post['title'] .'</div>';
						echo '</a>';
					}
				?>
			</div>
		</div>
	</div>
</section>

<?php } ?>