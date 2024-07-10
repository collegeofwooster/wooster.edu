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


	<div class="front-comms">
		<div class="front-comms-inner">

			<div class="front-news article-list">
				<h2>News</h2>
				<?php
				$post_query = new WP_Query( array( 
					'posts_per_page' => 3, 
					'post_type' => 'post', 
					'cat' => '-1105,-1106,-1066,-644,-945,-690,-1292,-1328,-1364,-1419,-1474,-1587,-1592,-1599,-1610', 
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
				<div class="front-events-inner">
					<div class="front-events-list">
						<?php 
						// get the upcoming events
						$upcoming = get_upcoming_events( 4, 'homepage-featured' );

						// if we have upcoming events
						if ( !empty( $upcoming ) ) {

							// loop through them
							foreach ( $upcoming as $event ) {
								?>
						<div class="event">
							<div class="date"><?php print date( 'M', $event->_p_event_start ); ?> <span><?php print date( 'j', $event->_p_event_start ); ?></span> <?php print date( 'Y', $event->_p_event_start ); ?></div>
							<div class="info">
								<h4><a href="<?php print get_permalink( $event->ID ); ?>"><?php print $event->post_title ?></a></h4>
								<p class="excerpt"><?php print wp_trim_words( $event->post_content, 20 ) ?></p>
								<p class="time"><?php print date( 'g:i a', $event->_p_event_start ); ?></p>
							</div>
						</div>
								<?php
							}
							
						}
						?>
					</div>
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

<?php 

the_statistics();

get_footer();

