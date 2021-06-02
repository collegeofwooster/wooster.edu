<?php

/*
Template Name: Homepage
*/

get_header();

?>

	<?php the_showcase(); ?>

	<div class="front-showcase-overlay">

		<?php the_featured_article(); ?>

		<div class="front-notice">
			<?php print do_shortcode( '[snippet slug="home-announce" /]') ?>
		</div>

	</div>


	<div class="connected-learning">
		<div class="connected-learning-inner">

			<div class="connected-learning-header">
				<div class="connected-learning-logo">
					<img src="<?php bloginfo('template_url') ?>/img/logo-connected-learning.webp">
				</div>
				<div class="connected-learning-search">
					<h2>What can I do at Woo?</h2>
					<form class="connected-learning-search-form">
						<input type="text" value="" name="s" class="connected-learning-search-term" placeholder="Search" title="Search your interest.">
						<input type="submit" class="connected-learning-search-submit" value="Search">
					</form>
				</div>
			</div>

			<div class="connected-learning-results">
				<div class="result-box areas">
					<h3>Areas of<br> Study</h3>
					<ul>
						<li><a href="#">Biology</a></li>
						<li><a href="#">Biochemistry & Molecular Biology</a></li>
						<li class="all"><a href="/areas">All Areas of Study</a></li>
					</ul>
				</div>

				<div class="result-box independent">
					<h3>Independent<br> Study</h3>
					<ul>
						<li><a href="#">Anna James Explores Ecologically Relevant Cooling on Zebra Finch Chicks</a></li>
					</ul>
				</div>

				<div class="result-box experiential">
					<h3>Experiential<br> Learning</h3>
					<ul>
						<li><a href="#">Kayla Bertholf's Research Assistantship at Arnosti Molecular Genetics Lab</a></li>
					</ul>
				</div>

				<?php print do_shortcode( '[snippet slug="connected-learning-pathways" /]' ); ?>

				<div class="result-bar news">
					<img src="<?php bloginfo('template_url') ?>/img/photo-square.webp" />
					<div class="result-bar-inner">
						<h3>News</h3>
						<ul>
							<li><a href="#">Recognition Rolling In for Wooster’s STEM Programs</a></li>
						</ul>
					</div>
					<div class="group"></div>
				</div>

				<div class="result-bar profile">
					<img src="<?php bloginfo('template_url') ?>/img/photo-square-gold.webp" />
					<div class="result-bar-inner">
						<h3>Profiles</h3>
						<ul>
							<li><a href="#">Biology Alumna Honored for Clean Energy Work</a></li>
						</ul>
					</div>
					<div class="group"></div>
				</div>
			</div>

		</div>
	</div>


	<div class="front-comms">
		<div class="front-comms-inner">

			<div class="front-news articles list">
				<h2>News</h2>
				<?php
				$post_query = new WP_Query( array( 'posts_per_page' => 3, 'post_type' => 'post' ) );
				while ( $post_query->have_posts() ) {
					$post_query->the_post();
					?>
				<div class="article">
					<?php the_post_thumbnail( 'thumbnail' ); ?>
					<h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
				</div>
					<?php
				}
				wp_reset_query();
				?>
				<a href="/news">See more news &raquo;</a>
			</div>

			<div class="front-events">
				<h2>Events</h2>
				<!--
				<ul class="events-tabs">
					<li class="active"></li>
					<li><h2>Academic Calendar</h2></li>
				</ul>
				-->
				<div class="front-events-inner">
					<div class="front-events-list">
						<?php 
						// get the upcoming events
						$upcoming = get_upcoming_events( 2 );

						// if we have upcoming events
						if ( !empty( $upcoming ) ) {

							// loop through them
							foreach ( $upcoming as $event ) {
								?>
						<div class="event">
							<div class="date"><?php print date( 'M', $event->_p_event_start ); ?> <span><?php print date( 'j', $event->_p_event_start ); ?></span> <?php print date( 'Y', $event->_p_event_start ); ?></div>
							<div class="info">
								<h4><?php print $event->post_title ?></h4>
								<p class="time"><?php print date( 'g:i a e', $event->_p_event_start ); ?></p>
							</div>
						</div>
								<?php
							}
							
						}
						?>
					</div>
					<div class="events-nav">
						<a class="prev">&larr;</a>
						<a class="next">&rarr;</a>
					</div>
				</div>
			</div>

		</div>
	</div>


	<div class="faculty-showcase">
		<div class="faculty-showcase-inner">

			<div class="faculty-slider">
				<div class="faculty-slider-header">
					<p>World Class</p>
					<h2>Educators</h2>
				</div>
				<div class="faculty-slider-inner">
					<div class="faculty-slide">
						<img src="<?php bloginfo( 'template_url' ); ?>/img/photo-staff.webp" />
						<p class="description">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
						<h4 class="name">John Doe</h4>
						<p class="title">Remote and Robotic Initiatives</p>
					</div>
				</div>
				<div class="faculty-slider-nav">
					<a class="prev">&larr;</a>
					<a class="next">&rarr;</a>
				</div>
			</div>

			<div class="faculty-link">
				<img src="<?php bloginfo('template_url') ?>/img/photo-faculty.webp" />
				<?php print do_shortcode( '[button url="/faculty" class="foam"]Learn more about our faculty[/button]' ); ?>
			</div>

		</div>
	</div>


	<div class="front-admissions">
		<div class="front-admissions-inner">

			<div class="front-admissions-events">
				<h2>Coming Up</h2>
				<div class="event first">
					<?php print do_shortcode( '[button url="#" class="blue"]Register[/button]') ?>
					<h4>Admissions Event 1</h4>
					<p>October 8, 2021  | 9AM - 5PM</p>
				</div>

				<div class="event">
					<?php print do_shortcode( '[button url="#" class="blue"]Register[/button]') ?>
					<h4>Admissions Event 1</h4>
					<p>November 28, 2021  | 9AM - 5PM</p>
				</div>

				<div class="event">
					<?php print do_shortcode( '[button url="#" class="blue"]Register[/button]') ?>
					<h4>Admissions Event 1</h4>
					<p>December 12, 2021  | 9AM - 5PM</p>
				</div>
			</div>

			<div class="front-admissions-tour">
				<?php print get_snippet( 'home-tour', 0 ); ?>
			</div>

		</div>
	</div>

	<div class="front-statistics">
		<div class="front-statistics-inner">

			<div class="stat states">
				<img src="<?php bloginfo('template_url') ?>/img/icon-stat-states.webp" />
				<h4>45</h4>
				<p>States</p>
			</div>

			<div class="stat countries">
				<img src="<?php bloginfo('template_url') ?>/img/icon-stat-countries.webp" />
				<h4>62</h4>
				<p>Nations</p>
			</div>

			<div class="stat states">
				<img src="<?php bloginfo('template_url') ?>/img/icon-stat-globe.webp" />
				<h4>16%</h4>
				<p>International Students</p>
			</div>

			<div class="stat states">
				<img src="<?php bloginfo('template_url') ?>/img/icon-stat-people.webp" />
				<h4>22%</h4>
				<p>U.S. Students of Color</p>
			</div>

		</div>
	</div>


	<div class="front-mosaic">
		<?php the_phototiles(); ?>
	</div>

<?php

get_footer();

?>