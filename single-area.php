<?php
/**
 * The Template for displaying all single posts
 */

get_header();

$education = get_cmb_value( "person_education" );
$courses = get_cmb_value( "person_courses" );
$override_overview = get_field( 'override_overview' );

?>
	<div class="page-header area-header"<?php print ( has_cmb_value( 'page_header_background' ) ? ' style="background-image: url(' . get_cmb_value( 'page_header_background' ) . ')"' : ( !empty( $featured_image_url ) ? ' style="background-image: url(' . $featured_image_url . ')"' : '' ) ); ?>>
		<div class="page-header-overlay"></div>
		<div class="wrap">
			<div class="breadcrumbs">
				<div class="crumbs"><a href="/academics">Academics</a> &raquo; <a href="/areas">Areas of Study</a> &raquo;</div>
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
	</div>

	<div class="two-column area" role="main">
		<div class="wrap">
		<?php 
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				?>
			<div class="sidebar tab-nav">
				<div class="sidebar-menu-toggle">Area of Study Menu</div>
				<div class="sidebar-menu">
					<ul class="menu">
						<?php if ( !$override_overview ) : ?><li class="area-overview">Overview</li><?php endif; ?>
						<?php
						// new dynamic tabs
						if( have_rows('tab') ):
							// loop through the components
							while ( have_rows('tab') ) : the_row();
								// include the specific layout
								$label = get_sub_field( 'label' );
								print '<li class="area-' . sanitize_title( $label ) . '">' . $label . '</li>';
							endwhile;
						endif;
						?>
						<?php do_area_tab_nav( "Major", "major" ) ?>
						<?php do_area_tab_nav( "Minor", "minor" ) ?>
						<?php do_area_tab_nav( "Independent Study", "independent_study" ) ?>
						<?php do_area_tab_nav( "Certifications", "certifications" ) ?>
						<?php do_area_tab_nav( "Licensure", "licensure" ) ?>
						<?php do_area_tab_nav( "Alumni", "alumni" ) ?>
						<?php do_area_tab_nav( "Student Organizations", "student_organizations" ) ?>
						<?php do_area_tab_nav( "Prizes & Scholarships", "scholarships" ) ?>
						<?php do_area_tab_nav( "Lectures", "lectures" ) ?>
						<?php do_area_tab_nav( "Seminar Series", "seminar_series" ) ?>
						<?php do_area_tab_nav( "Lab Facilities", "lab_facilities" ) ?>
						<?php do_area_tab_nav( "Clinics", "clinics" ) ?>
						<?php do_area_tab_nav( "Fern Valley Field Station", "fern_valley" ) ?>
						<?php do_area_tab_nav( "Requirements", "requirements" ) ?>
						<?php do_area_tab_nav( "Title II", "title_ii" ) ?>
						<?php do_area_tab_nav( "State Performance Report", "state_performance" ) ?>
						<?php do_area_tab_nav( "Resources", "resources" ) ?>
						<?php do_area_tab_nav( "Unique Opportunities", "unique_opportunities" ) ?>
						<?php do_area_tab_nav( "Ensembles", "ensembles" ) ?>
						<?php do_area_tab_nav( "Productions/Events", "productions" ) ?>
						<?php do_area_tab_nav( "Student Projects", "student_projects" ) ?>
						<?php do_area_tab_nav( "Faculty Emeriti", "faculty_emeriti" ) ?>
						<?php do_area_tab_nav( "Annual Report", "annual_report" ) ?>
						<?php do_area_tab_nav( "CAEP Annual Reporting Measures", "caep" ) ?>
					</ul>

					<div class="no-mobile">
						<?php wp_nav_menu( array( 'theme_location' => 'area-action-nav', 'menu_class' => 'action-nav' ) ); ?>
					</div>
				</div>
			</div>
			<div class="right-column">
				
				<?php if ( !$override_overview ) : ?>
				<div class="tab-content active area-overview">
					<h2>Overview</h2>
					<div class="content-area">
						<?php if ( has_cmb_value( 'area_video' ) ) { ?>
						<div class="area-video">
							<?php print apply_filters( 'the_content', get_cmb_value( 'area_video' ) ); ?>
						</div>
						<?php } ?>
						<?php the_content(); ?>
						<hr class="space" />

						<?php if ( has_cmb_value( 'area_faculty_list' ) ) { ?>
						<h2>Faculty &amp; Staff</h2>
						<div class="area-faculty">
							<?php print do_shortcode( '[people category="' . get_cmb_value( 'area_faculty_list' ) . '" /]' ); ?>
						</div>

						<hr class="space" />
						<?php } ?>

						<?php 
						$area_tag = get_cmb_value( 'area_post_tag' );
						$tag_info = get_term_by( 'slug', $area_tag, 'post_tag' );
						if ( !empty( $area_tag ) ) { 

							?>
						<div class="area-news">
							<h2>Latest <?php print $tag_info->name ?> News</h2>

							<div class="article-cards">						  
							<?php
							$args = array(
								'tag' => $area_tag,
								/*'category__not_in' => 793,*/
								'posts_per_page' => 4
							);
							$query = new WP_Query( $args );


							// Check that we have query results.
							if ( $query->have_posts() ) {
							
								// Start looping over the query results.
								while ( $query->have_posts() ) {
									$query->the_post(); ?>
									<div class="entry">
										<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
										<div class="entry-inner">
											<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
											<?php the_excerpt(); ?>
										</div>
									</div>
									<?php
								}
							
							}
							
							// Restore original post data.
							wp_reset_postdata();
							
							?>
							</div>
							<a href="/tag/<?php print $area_tag; ?>" class="btn gold">More <?php print $tag_info->name ?> Articles</a>
						</div>
						<?php } ?>

					</div>
				</div>
				<?php
				endif;

				// new dynamic tabs
				if( have_rows('tab') ):
					// loop through the components
					while ( have_rows('tab') ) : the_row();
						// include the specific layout
						$label = get_sub_field( 'label' );
						?>
					<div class="tab-content area-<?php print sanitize_title( $label ); ?>">
						<h2><?php print $label ?></h2>
						<?php 
						if ( have_rows( 'basic_components' ) ) : 
							while ( have_rows( 'basic_components' ) ) : the_row();
								get_template_part( 'library/component/' . get_row_layout() );
							endwhile;
						endif; 
						?>
					</div>
						<?php
					endwhile;
				endif;
				?>

				<?php do_area_tab_content( "Major", "major" ); ?>
				<?php do_area_tab_content( "Minor", "minor" ); ?>
				<?php do_area_tab_content( "Independent Study", "independent_study" ); ?>
				<?php do_area_tab_content( "Certifications", "certifications" ); ?>
				<?php do_area_tab_content( "Licensure", "licensure" ); ?>
				<?php do_area_tab_content( "Alumni", "alumni" ); ?>
				<?php do_area_tab_content( "Student Organizations", "student_organizations" ); ?>
				<?php do_area_tab_content( "Prizes & Scholarships", "scholarships" ); ?>
				<?php do_area_tab_content( "Lectures", "lectures" ); ?>
				<?php do_area_tab_content( "Seminar Series", "seminar_series" ); ?>
				<?php do_area_tab_content( "Lab Facilities", "lab_facilities" ); ?>
				<?php do_area_tab_content( "Clinics", "clinics" ); ?>
				<?php do_area_tab_content( "Fern Valley Field Station", "fern_valley" ); ?>
				<?php do_area_tab_content( "Requirements", "requirements" ) ?>
				<?php do_area_tab_content( "Title II", "title_ii" ) ?>
				<?php do_area_tab_content( "State Performance Report", "state_performance" ) ?>
				<?php do_area_tab_content( "Resources", "resources" ) ?>
				<?php do_area_tab_content( "Unique Opportunities", "unique_opportunities" ) ?>
				<?php do_area_tab_content( "Ensembles", "ensembles" ) ?>
				<?php do_area_tab_content( "Productions/Events", "productions" ) ?>
				<?php do_area_tab_content( "Student Projects", "student_projects" ) ?>
				<?php do_area_tab_content( "Faculty Emeriti", "faculty_emeriti" ) ?>
				<?php do_area_tab_content( "Annual Report", "annual_report" ) ?>
				<?php do_area_tab_content( "CAEP Annual Reporting Measures", "caep" ) ?>

			<?php
			endwhile;
		endif;
		 ?>
			</div>
			<div class="sidebar mobile-only">
				<?php wp_nav_menu( array( 'theme_location' => 'area-action-nav', 'menu_class' => 'action-nav' ) ); ?>
			</div>
		</div>
	</div>
<?php

get_footer();

?>