<?php

get_header();

the_showcase();

?>
<div class="content-wide">
	<div class="wrap">
		<div class="page-title">
			<h1><?php the_title(); ?></h1>
		</div>
	<?php the_agenda(); ?>
	</div>
</div>
<?php

get_footer();

