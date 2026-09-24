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

$logo_alt = function_exists( 'get_field' ) ? get_field('logo_alt', 'option') : null;
$social_media_profiles = function_exists( 'get_field' ) ? get_field('social_media_profiles', 'option') : null;

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="wrapper">
			<a class="logo-link-home-footer" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img class="logo-img-footer" src="<?= (isset($logo_alt['sizes']['medium'])?$logo_alt['sizes']['medium']:'') ?>" alt="<?= esc_attr( get_bloginfo( 'name' ) ) ?>">
			</a>

			<div class="content-wrapper">
				<div class="top">
					<?php wp_nav_menu([ 'theme_location' => 'footer-main', 'menu_class' => 'menu-footer-main footer-menu', 'container' => '' ]); ?>

					<?php if( isset($social_media_profiles) && is_array($social_media_profiles) && count($social_media_profiles) > 0 ) {
						echo '<div class="social-profiles">';

						foreach( $social_media_profiles as $social ) {
							$platform = $social['platform'];
							$url = $social['url'];

							if( $url ) {
								echo '<a href="'. esc_url( $url ) .'" class="icon-'. $platform .'" target="_blank"></a>';
							}
						}

						echo '</div>';
					} ?>
				</div>

				<div class="copyright">
					<?php if ( function_exists( 'get_field' ) ) { ?>
						<?= str_replace('%year%', date('Y'), get_field('copyright', 'option')) ?>
					<?php } else { ?>
						<!-- Fallback content if ACF is disabled -->
						<p>&copy; <?= date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
					<?php } ?>
				</div>

				<?php wp_nav_menu([ 'theme_location' => 'footer-copyright', 'menu_class' => 'menu-footer-copyright footer-menu', 'container' => '' ]); ?>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<?php if ( function_exists( 'get_field' ) ) { ?>
	<?= get_field('footer_scripts', 'option') ?>
<?php } ?>

</body>
</html>
