<?php
// Fields
$index_uid = uniqid('accordion-');
$content_body = $row['content_body'] ? '<div class="content-body">'. $row['content_body'] .'</div>' : '';
$items = $row['items'];

if( isset($items) && is_array($items) && count($items) > 0 ) { ?>

<section class="component accordion">
	<div class="wrapper thin">
		<?= $content_body ?>

		<dl>
			<?php foreach( $items as $index => $item ) { ?>
				<dt tabindex="0" role="button" aria-expanded="false" aria-controls="<?= $index_uid ?>-<?= $index ?>" class="h5">
					<div class="tab-text"><?= $item['tab_header'] ?></div>
					<i class="icon-chevron-right" aria-hidden="true"></i>
				</dt>

				<dd id="<?= $index_uid ?>-<?= $index ?>" role="region" aria-hidden="true"><?= do_shortcode($item['tab_body']) ?></dd>
			<?php } ?>
		</dl>
	</div>
</section>

<?php } ?>
