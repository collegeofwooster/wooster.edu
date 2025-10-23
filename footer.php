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
					<?php print get_snippet( 'footer-left' ); ?>
				</div>

				<div class="column">
					<h4>Quick Links</h4>
					<ul class="menu">
					<?php 

					// get the menu items to manually display (in two columns)
					$menu_items = get_nav_menu_items_by_location( 'footer-links' );
					if ( !empty( $menu_items ) ) {

						// count for when we need to split columns
						$half = ceil( count( $menu_items ) / 2 );

						// loop through the menu items
						$count = 1;
						foreach ( $menu_items as $item ) {
							// display the menu item
							print '<li><a href="' . $item->url . '">' . $item->title . '</a></li>';

							if ( $count == $half ) {
								print '</ul></div><div class="column last"><ul class="menu">';
							}

							// increment count
							$count++;
						}

					}

					?>
				

				</div>

			</div>

		</div>
	</footer>

</div><!-- #container -->

<?php wp_footer(); ?>

<?php print get_snippet( 'footer-scripts', false ); ?>

</body>
</html>