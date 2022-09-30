<?php
/**
 * The Template for displaying all single posts
 */

get_header();

?>
		<?php 
		if ( have_posts() ) :
			while ( have_posts() ) : the_post(); 
				global $post;

				the_page_header( get_the_title(), get_bloginfo('template_url') . "/img/bg-header-jobs.webp" );

				?>

	<div class="two-column job-single" role="main">
		<div class="wrap">

			<div class="sidebar">
				<?php wp_nav_menu( array( 'theme_location' => 'jobs-sidebar', 'menu_class' => 'menu' ) ); ?>
			</div>

			<div class="right-column">
				<div class="right-column-inner">
					<div class="job-info">
						<?php

						$job_categories = get_the_terms( get_the_ID(), 'job_cat' );
						if ( !empty( $job_categories ) ) {
							$job_cats = array();
							foreach ( $job_categories as $job_cat ) {
								$job_cats[] = $job_cat->name;
							}
							print "<h5>Job Category:</h5>";
							print "<p>" . implode( ', ', $job_cats ) . "</p>";
						}

						// display job expiration date
						if ( has_cmb_value( 'job_expires' ) ) { ?>
							<h5>Closing:</h5>
							<p><?php print date( "n/j/Y", strtotime( get_cmb_value( 'job_expires' ) ) ) ?></p>
							<?php
						}

						// if we have a link, show that
						if ( has_cmb_value( 'job_apply_link' ) ) { ?>
							<div class="apply-link"><?php print do_shortcode( '[button url="' . get_cmb_value( 'job_apply_link' ) . '" class="rose" target="_blank"]Apply[/button]' ); ?></div>
							<?php
						} else if ( has_cmb_value( 'job_contact_name' ) ) { // if there's no link, show contact information  ?>
							<h5>Apply</h5>
							<p><?php 
							print ( has_cmb_value( 'job_contact_name' ) ? "<strong>Contact:</strong> " . get_cmb_value( 'job_contact_name' ) . '<br>' : '' );
							print ( has_cmb_value( 'job_contact_email' ) ? '<strong>Email:</strong> <a href="mailto:' . get_cmb_value( 'job_contact_email' ) . '" target="_blank">' . get_cmb_value( 'job_contact_email' ) . '</a><br>' : '' );
							print ( has_cmb_value( 'job_contact_phone' ) ? '<strong>Phone:</strong> ' . get_cmb_value( 'job_contact_phone' ) . '<br>' : '' );
							print ( has_cmb_value( 'job_contact_fax' ) ? "<strong>Fax:</strong> " . get_cmb_value( 'job_contact_fax' ) . "<br>" : '' ); 
							?></p>
							<?php
						}

						?>

					</div>
					<p><strong>Job Description:</strong></p>
					<?php the_content(); ?>
					<br>
					<?php
					
					if ( has_cmb_value( 'job_education' ) ) { 
						print "<p><strong>Education/Experience Required:</strong></p>";
						print apply_filters( 'the_content', get_cmb_value( 'job_education' ) ) . "<br>";
					}
					
					if ( has_cmb_value( 'job_instructions' ) ) { 
						print "<p><strong>Application Instructions:</strong></p>";
						print apply_filters( 'the_content', get_cmb_value( 'job_instructions' ) ) . "<br>";
					}

					if ( has_cmb_value( 'job_comments' ) ) { 
						print "<p><strong>Additional Comments:</strong></p>";
						print apply_filters( 'the_content', get_cmb_value( 'job_comments' ) ) . "<br>";
					}
					
					if ( has_cmb_value( 'job_eeo_statement' ) ) { 
						print "<p><strong>Equal Opportunity Employment Statement:</strong></p>";
						print apply_filters( 'the_content', get_cmb_value( 'job_eeo_statement' ) ) . "<br>";
					}

					?>
				</div>
			</div>
				<?php
			endwhile;
		endif;
		?>

		</div>

	</div><!-- #primary -->

<?php

get_footer();

?>