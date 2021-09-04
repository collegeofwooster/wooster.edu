<?php

/*
Template Name: Library
*/

get_header();

the_page_header();

?>
<div class="two-column">
	<div class="wrap">
		<div class="sidebar">
			<?php 
			the_sidebar_menu();
			the_action_nav(); 
			?>
		</div>
		<div class="right-column library">

			<div class="library-search">

				<div class="consort">
					<h4>CONSORT Catalog:</h4>
					<?php print get_snippet( 'library-consort', 0 ); ?>
				</div>
		
				<div class="summon">
					<h4>Summon:</h4>
					<?php print get_snippet( 'library-summon', 0 ) ?>
				</div>

				<div class="databases">
					<h4>Databases:</h4>
					<?php quick_nav_menu( 'library-databases', 'Select a Database' ); ?>
					<?php print get_snippet( 'library-databases', 0 ) ?>
				</div>

				<div class="guides">
					<h4>Research Guides:</h4>
					<?php quick_nav_menu( 'library-guides', 'Select a Research Guide' ); ?>
				</div>

			</div>

			<div class="entry-content">
			<?php
			while ( have_posts() ) : 
				the_post(); 
				the_content();
				the_boxes();
				the_accordions();
			endwhile; 
			?>
			</div>

		</div>
	</div>
</div>
<?php

the_phototiles();

get_footer();

