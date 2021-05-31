<?php


function do_accordion( $title, $content, $color = 'grey-light', $open = 0 ) {
	?>
	<div class="accordion">
		<div class="accordion-handle <?php print $color; ?><?php print ( $open ? 'open' : '' ) ?>">
			<?php print $title; ?>
		</div>
		<div class="accordion-content">
			<?php print apply_filters( 'the_content', $content ); ?>
		</div>
	</div>
	<?php
}

