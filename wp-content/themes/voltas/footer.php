<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package voltas
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'voltas' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'voltas' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'voltas' ), 'voltas', '<a href="http://underscores.me/">Underscores.me</a>' );
				?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/mixer.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/wow.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/jquery.appear.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/owl.carousel.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/jquery.themepunch.tools.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/jquery.themepunch.revolution.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/wow.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/theme.js"></script>

</body>
</html>
