<?php
/**
 * The Template for displaying all single posts
 */

get_header();

	if ( have_posts() ) :
		while ( have_posts() ) : the_post(); 
			?>

		<div class="event group" role="main">
			<div class="event-header third right">
				<div class="event-thumbnail">
					<?php the_post_thumbnail(); ?>
				</div>
				<div class="event-info">
					<?php 
					// display credit union name
					if ( has_cmb_value( 'event_start' ) && has_cmb_value( 'event_end' ) ) {
						$start = get_cmb_value( 'event_start' );
						$end = get_cmb_value( 'event_end' );
						if ( date( 'Ymd', $start ) != date( 'Ymd', $end ) ) {
							print "<p>" . date( "F jS g:i a", $start ) . " -";
							print date( "F jS g:i a", $end ) . "</p>";
						} else {
							print "<h4>" . date( "F jS", $start ) . "</h4>";
							print "<p>" . date( "g:i a", $start );
							print " - " . date( "g:i a", $end ) . "</p>";
						}
					}

					// display the event duration.
					if ( has_cmb_value( 'event_start' ) && has_cmb_value( 'event_end' ) ) {
						print "<p><strong>Duration:</strong> " . duration( get_cmb_value( 'event_start' ), get_cmb_value( 'event_end' ) ) . "</p>";
					}

					?>
				</div>
			</div>
			<div class="two-third right">
				<h2><?php the_title(); ?></h2>
				<?php the_content(); ?>
			</div>
		</div>

			<?php
		endwhile;
	endif;
	?>
<?php

get_footer();

?>