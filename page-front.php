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

				<div class="result-box pathways">
					<h3>Featured<br> Pathway</h3>
					<ul>
						<li><a href="#">Public Health Pathway</a></li>
						<li class="all"><a href="#">View All Pathways</a></li>
					</ul>
				</div>

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

			<div class="front-news">
				<h2>News</h2>
				<div class="article">
					<img src="<?php bloginfo('template_url') ?>/img/photo-large.webp" />
					<h4><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit...</a></h4>
	 				<a href="/news">Read more &raquo;</a>
				</div>
				<div class="article">
					<img src="<?php bloginfo('template_url') ?>/img/photo-large.webp" />
					<h4><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit...</a></h4>
	 				<a href="/news">Read more &raquo;</a>
				</div>
				<div class="article">
					<img src="<?php bloginfo('template_url') ?>/img/photo-large.webp" />
					<h4><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit...</a></h4>
	 				<a href="/news">Read more &raquo;</a>
				</div>
				<a href="/news">See more news &raquo;</a>
			</div>

			<div class="front-events">
				<ul class="events-tabs">
					<li class="active"><h2>Events</h2></li>
					<li><h2>Academic Calendar</h2></li>
				</ul>
				<div class="front-events-inner">
					<div class="front-events-list">
						<div class="event">
							<div class="date">Feb <span>20</span> 2020</div>
							<div class="info">
								<h4>The College of Wooster: The Art of Networking</h4>
								<p class="time">12:30 pm EST</p>
							</div>
						</div>
						<div class="event">
							<div class="date">Feb <span>24</span> 2020</div>
							<div class="info">
								<h4>The College of Wooster: The Art of Networking</h4>
								<p class="time">12:30 pm EST</p>
							</div>
						</div>
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
				<h2>Virtual Campus Tour</h2>
				<p>We'd love to have you visit us in person — and hope you will — but if you can’t make it to campus just yet, this tour will give you a good sense of the place.</p>
				<img src="<?php bloginfo('template_url') ?>/img/tour.webp" />
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
		<div class="front-mosaic-inner">
			<img src="<?php bloginfo( 'template_url' ); ?>/img/mosaic.webp" />
		</div>
	</div>

<?php

get_footer();

?>