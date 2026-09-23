<?php
// Fields
$theme = $row['theme'] ?? 'light';
$header = $row['header'] ? '<h2 class="header h1 hdr-accent">'. $row['header'] .'</h2>' : '';
$items = $row['items'];

if( isset($items) && is_array($items) && count($items) > 0 ) {
?>

<section class="component stats theme-<?= $theme ?> contained">
	<div class="wrapper">
		<?= $header ?>

		<div class="stats-wrapper">
			<?php foreach($items as $item) {
				$number = isset($item['number']) ? '<div class="stat-value">'. $item['number'] .'</div>' : '';
				$description = $item['description'] ? '<div class="description">'. $item['description'] .'</div>' : '';?>

				<div class="stats-item">
					<?= $number ?>
					<?= $description ?>
				</div>
			<?php } ?>
		</div>
	</div>
</section>

<?php } ?>
