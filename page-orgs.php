<?php

/*
Template Name: Page (Organizations)
*/

get_header();

the_page_header();

if ( has_showcase() ) { ?>
	<div class="showcase-container">
		<?php the_showcase(); ?>
	</div>
	<a name="content-start"></a>
	<?php 
}

?>

<div class="content-wide" role="main">
	<div class="wrap">
	<?php 
	
	if ( have_posts() ) :
		while ( have_posts() ) : the_post(); 
			the_post_showcase();
			the_content();
			
			$organizations = file_get_contents( "https://api.presence.io/wooster/v1/organizations" );
			$orgs = json_decode( $organizations );

			// if we have some organizations from the api
			if ( !empty( $orgs ) ) { ?>
		<div class="org-listing">
				<?php

				// loop through the orgs
				$org_count = 0;
				foreach ( $orgs as $org ) {
					?>
			<div class="org <?php print ( is_int( $org_count / 2 ) ? 'even' : 'odd' ); ?>">
				<div class="column">
					<h4><a href="https://wooster.presence.io/organization/<?php print $org->uri; ?>"><?php print $org->name ?></a></h4>
				</div>
				<div class="column">
					Categories: <?php if ( !empty( $org->categories ) ) { print implode( ', ', $org->categories ); } ?>
				</div>
			</div>
					<?php
					$org_count++;
				}
			?>
		</div>
			<?php

			}

		endwhile;
	endif;

	?>
	</div>
</div><!-- #content -->

<?php

the_statistics();

the_phototiles();

get_footer();

?>