<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package acme
 */

$logo = get_field('logo', 'option');

$alert_bar_display = get_field('alert_bar_display', 'option');
$alert_bar_title = get_field('alert_bar_title', 'option');
$alert_bar_body = get_field('alert_bar_body', 'option');
$alert_bar_button_html = Helpers\Templates::to_string(get_field('alert_bar_button', 'option'), 'button', array('style' => 'more'));

$header_button_html = Helpers\Templates::to_string(get_field('header_button', 'option'), 'button');
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<!-- ... -->
</head>

<body <?php body_class(); ?>>

	<?= get_field('body_code', 'option') ?>

	<div id="page" class="site">

		<?php if($alert_bar_display) { ?>
			<div class="alert-bar">
				<div class="alert-bar-wrapper">
					<div class="alert-bar-text">
						<?php if($alert_bar_title) { ?>
							<strong><?= $alert_bar_title ?></strong>
						<?php } ?>
						<?php if($alert_bar_body) { ?>
							<span><?= $alert_bar_body ?></span>
						<?php } ?>
					</div>
					<?= $alert_bar_button_html ? '<div class="button-container">'.$alert_bar_button_html.'</div>' : '' ?>
					<i class="alert-bar-close icon-close"></i>
				</div>
			</div>
		<?php } ?>
		<header id="masthead" class="site-header">
			<div class="wrapper">
				<?php site_logo($logo) ?>

				<nav id="site-navigation" class="main-navigation">
					<?php wp_nav_menu([ 'theme_location' => 'nav', 'menu_class' => 'menu-header-main', 'container' => '', 'walker' => new acme_custom_mega() ]); ?>


					<div class="button-nav-element">
						<!-- Header Search -->
						<div class="header-search">
							<button class="search-button" aria-label="Site Search">
								<i class="icon-search show-search"></i>
								<i class="icon-close-thin hide-search"></i>
							</button>

							<div class="form-wrap">
								<form class="search-form-header" action="/" method="get">
									<fieldset>
										<div class="field">
											<input type="text" name="s" value="<?php echo get_search_query(); ?>" placeholder="Search">
										</div>
										<button type="submit"><i class="icon-search"></i></button>
									</fieldset>
								</form>
							</div>
						</div>

						<!-- End Header Search -->
						<?php if($header_button_html) { ?>
							<?= $header_button_html ?>
						<?php } ?>
					</div>
				</nav>

				<a class="nav-toggle"><i></i></a>
			</div>
		</header>

		<div id="content" class="site-content">