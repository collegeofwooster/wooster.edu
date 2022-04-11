<?php
/**
 * The Template for displaying all single posts
 */

get_header();

	if ( have_posts() ) :
		while ( have_posts() ) : the_post(); 
			?>

		<div class="event two-column" role="main">
			<div class="wrap">
				<div class="left-column">
					<h2><?php the_title(); ?></h2>
					<?php the_content(); ?>
				</div>
				<div class="aside">
					<div class="event-thumbnail">
						<?php the_post_thumbnail(); ?>
					</div>
					<div class="event-info">
						<?php 
						// display times/dates
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

						// display the event duration.
						if ( has_cmb_value( 'event_location_text' ) ) {
							print "<p><strong>Location:</strong><br>" . get_cmb_value( 'event_location_text' ) . "</p>";
						}

						?>
						<br>
						<script type="text/javascript">(function () {
						if (window.addtocalendar)if(typeof window.addtocalendar.start == "function")return;
						if (window.ifaddtocalendar == undefined) { window.ifaddtocalendar = 1;
							var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
							s.type = 'text/javascript';s.charset = 'UTF-8';s.async = true;
							s.src = 'https://addtocalendar.com/atc/1.5/atc.min.js';
							var h = d[g]('body')[0];h.appendChild(s); }})();
						</script>

						<!-- 3. Place event data -->
						<span class="addtocalendar atc-style-blue">
							<var class="atc_event">
								<var class="atc_date_start"><?php print date( 'Y-m-d g:i', $start ) ?>:00</var>
								<var class="atc_date_end"><?php print date( 'Y-m-d g:i', $end ) ?>:00</var>
								<var class="atc_timezone">America/New_York</var>
								<var class="atc_title"><?php the_title() ?></var>
								<var class="atc_description"><?php the_content(); ?></var>
								<var class="atc_location"><?php show_cmb_value( 'event_location_text' ) ?></var>
							</var>
						</span>
					</div>
				</div>
			</div>
		</div>

			<?php
		endwhile;
	endif;
	?>
<?php

get_footer();

?>