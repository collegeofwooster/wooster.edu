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

				<div class="bars">

					<div class="result-bar news">
						<div class="title">
							<h3>News</h3>
						</div>
						<div class="content">
							<a href="#">Biology Alumna Honored for Clean Energy Work</a>
						</div>
						<div class="image"></div>
					</div>

					<div class="result-bar profile">
						<div class="title">
							<h3>Profiles</h3>
						</div>
						<div class="content">
							<a href="#">Biology Alumna Honored for Clean Energy Work</a>
						</div>
						<div class="image"></div>
					</div>
					
				</div>

			</div>

		</div>
	</div>


	<div class="front-comms">
		<div class="front-comms-inner">

			<div class="front-news article-list">
				<h2>News</h2>
				<?php
				$post_query = new WP_Query( array( 
					'posts_per_page' => 3, 
					'post_type' => 'post', 
					'cat' => '-1105,-1106,-1066', 
					'orderby' => 'date', 
					'order' => 'DESC',
					'ignore_sticky_posts' => 1,
				) );
				while ( $post_query->have_posts() ) {
					$post_query->the_post();
					?>
				<div class="entry">
					<?php the_post_thumbnail( 'thumbnail' ); ?>
					<h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
				</div>
					<?php
				}
				wp_reset_query();
				?>
				<p style="padding-top: 0;"><a href="/news">See more news &raquo;</a></p>
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
						$upcoming = get_upcoming_events( 4 );

						// if we have upcoming events
						if ( !empty( $upcoming ) ) {

							// loop through them
							foreach ( $upcoming as $event ) {
								?>
						<div class="event">
							<div class="date"><?php print date( 'M', $event->_p_event_start ); ?> <span><?php print date( 'j', $event->_p_event_start ); ?></span> <?php print date( 'Y', $event->_p_event_start ); ?></div>
							<div class="info">
								<h4><a href="<?php print get_permalink( $event->ID ); ?>"><?php print $event->post_title ?></a></h4>
								<p class="time"><?php print date( 'g:i a', $event->_p_event_start ); ?></p>
							</div>
						</div>
								<?php
							}
							
						}
						?>
					</div>
					<!--
					<div class="events-nav">
						<a class="prev">&larr;</a>
						<a class="next">&rarr;</a>
					</div>
					-->
				</div>
				<p><a href="/events">See more events &raquo;</a></p>
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
					<?php
					$person = get_posts( array(
						'post_type' => 'people',
						'people_cat' => 'faculty',
						'orderby' => 'rand',
						'order' => 'ASC',
					) );
					$person = $person[0];
					// print_r( $person );
					?>
					<div class="faculty-slide">
						<?php print get_the_post_thumbnail( $person->ID, 'thumbnail' ) ?>
						<p class="description"><?php print $person->post_excerpt ?></p>
						<h4 class="name"><?php print $person->post_title ?></h4>
						<p class="title"><?php print get_cmb_value( 'person_title', $person->ID ) ?></p>
					</div>
				</div>
				<!--
				<div class="faculty-slider-nav">
					<a class="prev">&larr;</a>
					<a class="next">&rarr;</a>
				</div>
				-->
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
				<?php print get_snippet( 'home-admissions-events', 1 ); ?>
			</div>

			<div class="front-admissions-tour">
				<?php print get_snippet( 'home-tour', 1 ); ?>
			</div>

		</div>
	</div>

	<?php the_statistics(); ?>

	<div class="front-mosaic">
		<?php the_phototiles(); ?>
	</div>

<?php

get_footer();

?>