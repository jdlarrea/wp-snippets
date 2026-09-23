<?php
// Fields
$header = $row['header'] ? '<h2 class="header h1">'. $row['header'] .'</h2>' : '';
$description = $row['description'] ? '<div class="description">'. $row['description'] .'</div>' : '';
$button = Helpers\Templates::to_string( $row['section_button'], 'button', ['style' => 'tertiary'] );
$html_button = $button ? '<div class="button-container">'.$button.'</div>' : '';
$select_mode = $row['select_mode'];

$query_types = [ 'post', 'news', 'case-study' ];
$query_limit = 12;

if( $select_mode == 'individual' ) {
	$featured_posts = new WP_Query([
		'post_type' => $query_types,
		'post_status' => 'publish',
		'posts_per_page' => $query_limit,
		'post__in' => $row['select_posts'],
		'orderby' => 'post__in'
	]);
} else if($select_mode == 'category') {
	$featured_posts = new WP_Query( array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => $query_limit,
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
} else if($select_mode == 'tag') {
	$featured_posts = new WP_Query( array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => $query_limit,
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
} else if($select_mode == 'cat-case-study') {
	$featured_posts = new WP_Query( array(
		'post_type' => 'case-study',
		'post_status' => 'publish',
		'posts_per_page' => $query_limit,
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
} else if($select_mode == 'tag-case-study') {
	$featured_posts = new WP_Query( array(
		'post_type' => 'case-study',
		'post_status' => 'publish',
		'posts_per_page' => $query_limit,
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
} else if($select_mode == 'content-type') {
	$featured_posts = new WP_Query( array(
		'post_type' => 'post',
		'post_status' => 'publish',
		'posts_per_page' => $query_limit,
		'orderby' => 'date',
		'order'=>'DESC',
		'tax_query' => array(
			array(
				'taxonomy' => 'content_type',
				'field'    => 'term_id',
				'terms'    => $row['select_content_type'],
				),
			),
	));
} else {
	$featured_posts = new WP_Query([
		'post_type' => $row['select_mode'],
		'post_status' => 'publish',
		'posts_per_page' => $query_limit,
		'orderby' => 'date',
		'order' => 'DESC',
	]);
}

if( $featured_posts && $featured_posts->have_posts() ) {

?>

<section class="component featured-post-cards">
	<div class="wrapper">
		
		<?php if( $header || $html_button ) { ?>
			<div class="section-header">
				<div class="content-wrapper">
					<?= $header ?>
					<?= $description ?>
				</div>
				<?= $html_button ?>
			</div>
		<?php } ?>
	</div>

	<div class="slider">
		<div class="wrapper">
			<div class="swiper archive-grid">
				<div class="swiper-buttons">
					<div class="swiper-button-prev"></div>
					<div class="swiper-button-next"></div>
				</div>
				<div class="swiper-wrapper">
					<?php while( $featured_posts->have_posts() ) {
					$featured_posts->the_post(); ?>
						<div class="swiper-slide"><?= get_template_part( 'template-parts/content', 'post' ); ?></div>
					<?php } wp_reset_postdata(); ?>
				</div>
				<div class="swiper-pagination"></div>
			</div>
		</div>
	</div>
</section>

<?php } ?>
