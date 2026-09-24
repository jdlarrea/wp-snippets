<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package acme
 */

$page_options = get_field( 'page_options' );
$site_logo = get_field('site_logo', 'option');
$footer_blurb = get_field('footer_blurb', 'option');
$social_media = get_field('social_media', 'option');

$html_social = '';
if( $social_media ) {
	$html_social .= '<div class="footer-social-links">';

	foreach( $social_media as $social ) {
		$html_social .= '<a class="footer-social-link link-'. $social['icon_class'] .'" href="'. esc_url( $social['url'] ) .'" target="_blank"><i class="icon-'. $social['icon_class'] .'"></i></a>';
	}

	$html_social .= '</div>';
}

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
	<?php if( !$page_options['is_landing_page'] ) { ?>
		<div class="top">
			<div class="top-wrapper wrapper">
				<div class="footer-col footer-col-1 branding">
					<a aria-label="<?= esc_attr( get_bloginfo('name') ) ?>" href="<?= esc_url( get_bloginfo( 'url' ) ) ?>" rel="home" class="logo-footer">
						<img src="<?= $site_logo['sizes']['large'] ?>" alt="<?= esc_attr( get_bloginfo('name') ) ?>">
					</a>

					<?= ( $footer_blurb ) ? '<div class="blurb">'. $footer_blurb .'</div>' : '' ?>

					<?= $html_social ?>
				</div>

				<?php wp_nav_menu([ 'theme_location' => 'footer-col-1', 'container' => false, 'menu_class' => 'footer-col footer-col-2 footer-menu-1' ]); ?>

				<?php wp_nav_menu([ 'theme_location' => 'footer-col-2', 'container' => false, 'menu_class' => 'footer-col footer-col-3 footer-menu-2' ]); ?>
			</div>
		</div>
	<?php } ?>

		<div class="bottom">
			<div class="bottom-wrapper wrapper">
				<div class="copyright-wrapper">
					<?= str_replace('%year%', date('Y'), get_field('copyright', 'option')) ?>
				</div>

				<?php wp_nav_menu([ 'theme_location' => 'footer-copyright', 'container' => false, 'menu_class' => 'footer-menu-copyright' ]); ?>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<?= get_field('footer_analytics', 'option') ?>

</body>
</html>
