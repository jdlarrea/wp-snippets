<?php
// Fields
$header = $row['header'] ? '<h2 class="h1">'. $row['header'] .'</h2><hr>' : '';
$description = $row['description'];
$button_html = Helpers\Templates::to_string( $row['button'], 'button', ['style' => 'primary'] );
$items = $row['items'];

if( isset($items) && is_array($items) && count($items) > 0 ) {
?>

<section class="component stats">
	<div class="wrapper">
		<div class="content">
			<?= $header ?>
			<?= $description ?>
			<?= $button_html ?>
		</div>
		<div class="stats-wrapper">
			<?php foreach($items as $item) {
				$stat = $item['stat'] ? '<div class="stat">'. $item['stat'] .'</div><hr>' : '';
				$title = $item['description'] ? '<div class="description">'. $item['description'] .'</div>' : '';?>
				<div class="item">
					<?= $stat ?>
					<?= $title ?>
				</div>				
			<?php } ?>
		</div>
	</div>
</section>

<?php } ?>
