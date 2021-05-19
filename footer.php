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

			<div class="column first">
				<img src="<?php bloginfo( 'template_url' ); ?>/img/logo-dark.webp" />
				<p class="copyright">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut mattis lacus nibh, sed tempor quam congue a. Integer quis neque eleifend, ultricies augue ut, gravida mi. Praesent sit amet ante turpis.</p>
				<div class="social-icons">
					<h4>Follow Us</h4>
					<img src="<?php bloginfo( 'template_url' ); ?>/img/icons-social.webp">
				</div>
			</div>

			<div class="column">
				<h4>Wooster Traditions</h4>
				<img src="<?php bloginfo( 'template_url' ); ?>/img/footer-feed.webp">
			</div>

			<div class="column">
				<h4>Quick Links</h4>
				<?php wp_nav_menu( array( 'theme_location' => 'footer-links' ) ); ?>
			</div>

		</div>
	</footer>

</div><!-- #container -->

<?php wp_footer(); ?>
</body>
</html>