<?php
/**
 * The Template for displaying all single posts
 */

get_header();

$education = get_cmb_value( "person_education" );
$courses = get_cmb_value( "person_courses" );

?>
	<div class="page-header area-header"<?php print ( !empty( $featured_image_url ) ? ' style="background-image: url(' . $featured_image_url . ')"' : '' ); ?>>
		<div class="page-header-overlay"></div>
		<div class="breadcrumbs">
			<div class="crumbs"><a href="/academics">Academics</a> &raquo; <a href="/areas-of-study">Areas of Study</a> &raquo;</div>
			<div class="page-title"><?php the_title(); ?></div>
			<div class="area-categories">
			<?php
			if ( !empty( $categories ) ) {
				?><?php
				$cats = array();
				foreach ( $categories as $cat ) {
		 			switch ( $cat->slug ) {
		 				case "major":
		 					$cats[] = '<span class="ma">MA</span>';
		 				break;
		 				case "minor":
		 					$cats[] = '<span class="mi">MI</span>';
		 				break;
		 				case "pre-professional-advising":
		 					$cats[] = '<span class="pa">PA</span>';
		 				break;
		 				case "teaching-certification":
		 					$cats[] = '<span class="tc">TC</span>';
		 				break;
		 				case "dual-degree":
		 					$cats[] = '<span class="dd">DD</span>';
		 				break;
		 			}
				}
				print implode( ' ', $cats );
				?><?php
			}
			?>
			</div>
		</div>
	</div>
	<div class="two-column area group" role="main">

		<?php 
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				?>
			<!--<button class="back-to-areas">Back to All Areas</button>-->
			<div class="sidebar tab-nav">
				<ul>
					<li class="area-overview active">Overview</li>
					<li class="area-faculty">Faculty</li>
					<?php do_area_tab_nav( "Requirements", "requirements" ) ?>
					<?php do_area_tab_nav( "Career Tracks", "tracks" ) ?>
					<?php do_area_tab_nav( "Unique Opportunities", "opportunities" ) ?>
					<?php do_area_tab_nav( "Ensembles", "ensembles" ) ?>
					<?php do_area_tab_nav( "Events Schedule", "events" ) ?>
					<?php do_area_tab_nav( "Past Productions", "productions" ) ?>
					<?php do_area_tab_nav( "Alumni Profiles", "alumni" ) ?>
					<?php do_area_tab_nav( "Graduate Success", "success" ) ?>
					<?php do_area_tab_nav( "Clinical Supervisors", "supervisors" ) ?>
					<?php do_area_tab_nav( "Be a Teacher", "teacher" ) ?>
					<?php do_area_tabs_nav(); ?>
					<li class="area-advising">Advising</li>
					<li class="area-offcampus">Off-Campus</li>
				</ul>
			</div>
			
			<div class="right-column">

				<!--
				<?php
				if ( has_cmb_value( 'area_facebook' ) ) {
					?><a href="<?php show_cmb_value( 'area_facebook' ); ?>" class="btn sample-schedule">View Sample<br> Course Schedule</a><?php
				}
				?>
				
				<h1 class="area-title"><?php the_title(); ?></h1>
				<h3 class="area-subtitle"><?php 
				$terms = wp_get_post_terms( get_the_ID(), 'area_cat' );
				$terms_array = array();
				foreach ( $terms as $term ) {
					$terms_array[] = str_replace( 'Minors', 'Minor', str_replace( 'Majors', 'Major', $term->name ) );
				}
				// print_r( $terms_array );
				print implode( ', ', $terms_array );
				?></h3>
				-->

				<div class="tab-content active area-overview">
					<h2>Overview</h2>
					<?php the_content(); ?>

					<hr />
					
					<!--
					<?php if ( !empty( $sidebar_video_url ) ) print apply_filters( 'the_content', $sidebar_video_url ); ?>
					<hr />
					-->

					<?php if ( !empty( get_cmb_value( 'area_post_tag' ) ) ) { ?>
					<hr>
					<div class="area-news">
						<h2>Latest News</h2>						  
						<?php
						$args = array(
						    'tag' => get_cmb_value( 'area_post_tag' ),
						    'posts_per_page' => 3
						);
						$query = new WP_Query( $args );


						// Check that we have query results.
						if ( $query->have_posts() ) {
						  
						    // Start looping over the query results.
						    while ( $query->have_posts() ) {
						        $query->the_post(); ?>
						        <div class="entry">
						        	<?php the_post_thumbnail(); ?>
						        	<h3><?php the_title(); ?></h3>
						        	<?php the_excerpt(); ?>
						        </div>
						  		<?php
						    }
						  
						}
						  
						// Restore original post data.
						wp_reset_postdata();
						  
						?>
					</div>
					<?php } ?>

				</div>

				<div class="tab-content area-faculty">
					<h2>Faculty</h2>

					<?php 
					$faculty_query = new WP_Query( array(
						"post__in" => $faculty,
						"post_type" => 'faculty',
						"posts_per_page" => -1,
						"order" => "ASC",
						"orderby" => "title"
					) );

					if ( $faculty_query->have_posts() ) : 
						?>

					<div class="area-faculty">
					<?php

						// Start the Loop.
						while ( $faculty_query->have_posts() ) : $faculty_query->the_post();
							?>
							<div class="faculty-entry">
								<a href="<?php the_permalink(); ?>">
								<div class="photo" style="background-image: url(<?php the_post_thumbnail_url( array( 500, 500 ) ); ?>);"></div>
								<div class="info">
									<h4><?php the_title(); ?></h4>
									<p class="faculty-title"><?php print get_cmb_value( "faculty_title" ); ?></p>
								</div>
								</a>
							</div>
							<?php

						endwhile;

						?>
					</div>
					<?php
					endif;

					wp_reset_query();
					
					?>

				</div>

				<div class="tab-content area-advising">
					<h2>Advising</h2>
					<?php print do_shortcode( '[snippet slug="areas-advising" /]' ); ?>
				</div>

				<div class="tab-content area-offcampus">
					<h2>Off-Campus Study</h2>
					<?php print do_shortcode( '[snippet slug="areas-off-campus" /]' ); ?>
				</div>

				<?php do_area_tab_content( "Requirements", "requirements" ) ?>
				<?php do_area_tab_content( "Career Tracks", "tracks" ) ?>
				<?php do_area_tab_content( "Unique Opportunities", "opportunities" ) ?>
				<?php do_area_tab_content( "Ensembles", "ensembles" ) ?>
				<?php do_area_tab_content( "Events Schedule", "events" ) ?>
				<?php do_area_tab_content( "Past Productions", "productions" ) ?>
				<?php do_area_tab_content( "Alumni Profiles", "alumni" ) ?>
				<?php do_area_tab_content( "Graduate Success", "success" ) ?>
				<?php do_area_tab_content( "Clinical Supervisors", "supervisors" ) ?>
				<?php do_area_tab_content( "Be a Teacher", "teacher" ) ?>
				<?php do_area_tabs_content(); ?>
			<?php
			endwhile;
		endif;
		 ?>
		</div>

	</div>
<?php

get_footer();

?>