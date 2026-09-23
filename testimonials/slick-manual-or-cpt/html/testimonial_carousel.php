<?php
	$type = $row['type'];
	$items = ($type === 'cpt') ? $row['cpt_items'] : $row['items'];
?>

<section class="testimonial-carousel animate animate__fadeInUp">
	<div class="wrapper">
		<?php if($items) { ?>
			<div class="carousel">
				<?php foreach($items as $index => $item) { 
					if($type === 'cpt') {
						$logo = get_field( 'logo', $item );
						$testimonial = get_field( 'testimonial', $item );
						$author_image = get_field( 'author_image', $item );
						$name = get_field( 'name', $item );
						$company = get_field( 'company', $item );
					} else {
						$logo = $item['logo'];
						$testimonial = $item['testimonial'];
						$author_image = $item['author_image'];
						$name = $item['name'];
						$company = $item['company'];
					}
					?>
					<div class="item">
						<?php if($logo) { ?>
							<figure>
								<?= render_svg($logo) ?: wp_get_attachment_image($logo, 'full') ?>
							</figure>
						<?php } ?>
						<div class="bg">
							<?php if($testimonial) { ?>
								<blockquote><?= $testimonial ?></blockquote>
							<?php } ?>
							<?php if($name || $company) { ?>
								<div class="testimonial-author">
									<?php
									if( $author_image ) {
										echo '<div class="author-image b-lazy" data-src="'. $author_image['sizes']['medium'] .'"></div>';
									}
									?>
									<?= $name ?>
									<?= $company ? '<strong>'.$company.'</strong>' : '' ?>
								</div>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
</section>