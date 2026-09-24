<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 */

// Fields
$logo_main = get_field( 'logo_main', 'option' );
$logo_color = get_field( 'logo_color', 'option' );
$header_cta = get_field( 'header_cta', 'option' );
$alert_bar_options = get_field( 'alert_bar_options', 'option' );
$class_body = '';
$class_header = '';

// Cases where header should be color version
if( is_single() ) {
	$class_body .= 'header-color-active';
	$class_header .= 'header-color';
}

?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<!-- ... -->
</head>

<body <?php body_class( $class_body ); ?> >

<div id="page" class="site">
	<?php
		if( $alert_bar_options['display'] ) {
	?>
		<div class="alert-bar">
			<div class="alert-bar-wrapper">
				<div class="alert-bar-body">
					<?php if($alert_bar_options['body']) { ?>
						<div><?= $alert_bar_options['body'] ?></div>
					<?php } ?>
				</div>

				<i class="alert-bar-close icon-close"></i>
			</div>
		</div>
	<?php } ?>

	<header id="masthead" class="site-header <?= $class_header ?>">
		<div class="wrapper">
			<a class="logo-link-home" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img class="logo-img-main" src="<?= (isset($logo_main['sizes']['medium'])?$logo_main['sizes']['medium']:'') ?>" alt="<?= esc_attr( get_bloginfo( 'name' ) ) ?>">
				<img class="logo-img-color" src="<?= (isset($logo_color['sizes']['medium'])?$logo_color['sizes']['medium']:'') ?>" alt="<?= esc_attr( get_bloginfo( 'name' ) ) ?>">
			</a>

			<nav id="site-navigation" class="main-navigation">
				<?php wp_nav_menu([ 'theme_location' => 'header-main', 'menu_class' => 'menu-header-main', 'container' => '', 'walker' => new acme_custom_mega() ]); ?>

				<!-- Header Search -->
				<div class="header-search">
					<button class="search-button" aria-label="Site Search">
						<i class="icon-search show-search"></i>
						<i class="icon-close hide-search"></i>
					</button>
					<div class="form-wrap"><?php get_search_form(); ?></div>
				</div>
				<!-- End Header Search -->

				<?= Helpers\Templates::to_string( $header_cta, 'framework_button', [ 'style' => 'header-cta tertiary alt' ] ); ?>
			</nav>

			<button class="nav-toggle"><i></i></button>
		</div>
	</header>

	<div id="content" class="site-content">
