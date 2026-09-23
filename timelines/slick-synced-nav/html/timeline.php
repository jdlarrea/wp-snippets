<?php
	$title = $row['title'];
	
	$items = $row['items'];
?>

<section class="timeline">
	<div class="wrapper">
		<?php if($title) { ?>
			<div class="h2"><?= $title ?></div>
		<?php } ?>	

		<?php if($items) { ?>
			<div class="timeline-nav-container">
				<div class="timeline-nav">
					<?php foreach($items as $item) { 
						$timeline_title = $item['title']; ?>
						<div class="item"><?= $timeline_title ?></div>
					<?php } ?>
				</div>
			</div>
			<div class="timeline-carousel">
				<?php foreach($items as $item) { 
					$slides = $item['slides'];
					$content = $item['content'];
					?>
					<div class="item">
						<?php if($slides) { ?>
							<div class="slides-container">
								<div class="slides">
									<?php foreach($slides as $slide) { ?>
										<div class="slide">
											<figure class="image">
												<div class="display">
													<?= wp_get_attachment_image($slide['image'], 'extra_large'); ?>
												</div>
												<figcaption>
													<div class="text">
														<?php if($slide['title']) { ?>
															<div class="title"><?= $slide['title'] ?></div>
														<?php } ?>
														<?php if($slide['description']) { ?>
															<div><?= $slide['description'] ?></div>
														<?php } ?>
													</div>
													<div class="arrows">
														<i class="icon-chevron-left slick-prev"></i>
														<i class="icon-chevron-right slick-next"></i>
													</div>
												</figcaption>
											</figure>
										</div>
									<?php } ?>
								</div>
							</div>
						<?php } ?>
						<aside><?= $content ?></aside>
					</div>
				<?php } ?>
			</div>
		<?php } ?>

	</div>
</section>