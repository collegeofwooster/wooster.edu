<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
$admin_email = get_option( 'admin_email' );
?>
	
	</section>
	
	<?php do_action( 'before_footer' ); ?>

	<footer class="footer">
		<div class="footer-inner">
			<div class="wrap">

				<div class="column first">
					<a href="/research"><img src="<?php bloginfo( 'template_url' ); ?>/img/logo-footer.png" /></a>

					<?php print get_snippet( 'footer-left' ); ?>
				</div>

				<div class="column">
					<h4>Wooster Traditions</h4>
					<div class="traditions">
						<?php print get_snippet( 'footer-traditions', 0 ); ?>
					</div>
				</div>

				<div class="column">
					<h4>Quick Links</h4>
					<?php wp_nav_menu( array( 'theme_location' => 'footer-links' ) ); ?>
				</div>

			</div>

		</div>
	</footer>

</div><!-- #container -->

<?php wp_footer(); ?>

<!-- hubspot -->
<script type="text/javascript" id="hs-script-loader" async defer src="//js.hs-scripts.com/23526806.js"></script>
<!-- /hubspot -->

</body>
</html>