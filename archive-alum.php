<?php
/**
 * The template for displaying Archive pages
 */

get_header(); 

$base_url = '/classnotes/';

global $alum_categories;

$current_yr = ( isset( $_REQUEST['y'] ) ? $_REQUEST['y'] : 0 );
$current_cat = ( isset( $_REQUEST['c'] ) ? $_REQUEST['c'] : 0 );
$current_search = ( isset( $_REQUEST['t'] ) ? $_REQUEST['t'] : '' );

if ( $current_yr > 0 ) {
	// get year
	$args = array(
		'posts_per_page' => 1,
		'post_type' => 'yr',
		'name' => $current_yr,
	);
	query_posts( $args );
	while ( have_posts() ) : 
		the_post();
		global $post;
		$year_info = array();
		$pres = get_cmb_value( 'year_president' );
		$year_info['president'] = ( !empty( $pres ) ? explode( ',', $pres ) : '' );
		$year_info['president_email'] = explode( ',', get_cmb_value( 'year_president_email' ) );
		$sec = get_cmb_value( 'year_secretary' );
		$year_info['secretary'] = ( !empty( $sec ) ? explode( ',', $sec ) : '' );
		$year_info['secretary_email'] = explode( ',', get_cmb_value( 'year_secretary_email' ) );
		$year_info['grad_date'] = get_cmb_value( 'year_grad_date' );
		$year_info['grad_seniors'] = get_cmb_value( 'year_grad_seniors' );		
		$year_info['facebook'] = get_cmb_value( 'year_facebook' );

		$year_info['photo'] = get_the_post_thumbnail_url( $post, 'full' );
		$year_info['photo_thumb'] = get_the_post_thumbnail_url( $post, array( 400, 400 ) );
	endwhile;
	wp_reset_query();
	// print_r( $year_info );
}



$have_filters = false;

if ( $current_yr != 0 ) {
	$have_filters = true;
	$query_yr = array(
		'key'   => CMB_PREFIX . 'alum_year', 
		'value' => $current_yr,
	);
}

if ( $current_cat ) {
	$have_filters = true;
	$query_cat = array(
		'key'   => CMB_PREFIX . 'alum_category', 
		'value' => $current_cat,
	);
}


if ( $current_search != '' ) {
	$have_filters = true;
	$query_search = array(
		'relation' => 'OR',
		array(
			'key'   => CMB_PREFIX . 'alum_name_first', 
			'value' => $current_search,
			'compare' => 'LIKE'
		),
		array(
			'key'   => CMB_PREFIX . 'alum_name_last', 
			'value' => $current_search,
			'compare' => 'LIKE'
		),
		array(
			'key'   => CMB_PREFIX . 'alum_name_maiden', 
			'value' => $current_search,
			'compare' => 'LIKE'
		)
	);
}

if ( $query_yr || $query_cat || $query_search ) {

	$meta_query = array( 
		'relation' => 'AND',
		$query_yr,
		$query_cat,
		$query_search
	);

}

	
?>
	<div class="page-header" style="background-image: url(<?php bloginfo( 'template_url' ); ?>/img/bg-header-alumni.webp);">
		<div class="page-header-overlay"></div>
        <div class="wrap">
    		<div class="breadcrumbs">
    			<div class="crumbs">
    				<a href="/alumni">Alumni</a> &raquo; 
    			</div>
    			<h1 class="page-title">Class Notes</h1>
    		</div>
        </div>
	</div>

	<div class="content-wide">
		<div class="wrap">

			<?php print get_snippet( 'class-notes-intro', 1 ); ?>

			<div class="alum-info">
				<h1 class="page-title alum-title"><?php print ( $current_yr != 0 ? 'Class of ' . $current_yr : '' ); ?></h1>
				<div class="alum-buttons">
					<button class="alum-back">&laquo; Alumni Home</button>
					<?php if ( $have_filters ) { ?><button class="alum-reset">Reset Search</button><?php } ?>
					<button class="alum-add-story">Add My Note</button>
				</div>
				<?php if ( !empty( $current_yr ) ) { ?>
				<div class="class-information group">
					<div class="third">
						<?php 
						if ( !empty( $year_info['president'] ) ) { ?>
							<p><strong>President:</strong><br>
							<?php 
							$pres_count = 1;
							foreach ( $year_info['president'] as $pres_key=>$pres_name ) {
								print ( $pres_count > 1 ? ', ' : '' );
								print '<a href="mailto:' . $year_info['president_email'][$pres_key] . '">' . $pres_name . '</a>';
								$pres_count++;
							}
							?>
							</p>
						<?php 
						}
						if ( !empty( $year_info['secretary'] ) ) { ?>
							<p><strong>Secretary:</strong><br>
							<?php 
							$sec_count = 1;
							foreach ( $year_info['secretary'] as $sec_key=>$sec_name ) {
								print ( $sec_count > 1 ? ', ' : '' );
								print '<a href="mailto:' . $year_info['secretary_email'][$sec_key] . '">' . $sec_name . '</a>';
								$sec_count++;
							}
							?>
							</p>
						<?php 
						} 
						?>
					</div>
					<div class="third">
						<?php if ( !empty( $year_info['grad_date'] ) ) { ?><p><strong>Graduation Date:</strong><br><?php print $year_info['grad_date'] ?></p><?php } ?>
						<?php if ( !empty( $year_info['grad_seniors'] ) ) { ?><p><strong>Graduating Seniors:</strong><br><?php print $year_info['grad_seniors'] ?></p><?php } ?>
					</div>
					<div class="third year-buttons">
						<?php if ( !empty( $year_info['facebook'] ) ) { ?><div class="class-facebook"><a href="<?php print $year_info['facebook']; ?>">Class Facebook</a></div><?php } ?>
					</div>
				</div>
				<?php } ?>
				<div class="alum-add-story-form">
					<h5>Add My Note</h5>
					<?php print do_shortcode( '[gravityform id="2" title="false" description="false" /]' ); ?>
				</div>
				<div class="alum-filter">
					<form name="alum-filters" action="<?php print $base_url; ?>" method="get">
					Year: <select name="y" class="alum-year">
						<option value="0">- any -</option>
						<?php
						global $years;
						foreach ( $years as $yr ) {
							print "<option value='" . $yr . "'" . ( $yr == $current_yr ? ' selected="selected"' : '' ) . ">" . $yr . "</option>";
						}
						?>
					</select> &nbsp;
					Category: <select name="c" class="alum-category">
						<option value="0">- select category -</option>
						<?php
						foreach ( $alum_categories as $alum_cat_key => $alum_cat_val ) {
							print '<option value="' . $alum_cat_key .'"' . ( $current_cat === $alum_cat_key ? ' selected="selected"' : '' ) . '>' . $alum_cat_val . '</option>';
						}
			            ?>
					</select> &nbsp; 
					Name: <input type="text" name="t" class="alum-search" value="<?php print $current_search; ?>" />
					<input type="submit" value="Filter" />
					</form>
				</div>
			</div>

			<?php 

			global $wp_query;

			$wp_query->query_vars["orderby"] = 'modified';
			$wp_query->query_vars["order"] = 'DESC';
			$wp_query->query_vars["posts_per_page"] = 100;

			if ( !empty( $meta_query ) ) {
				$wp_query->query_vars['meta_query'] = $meta_query;
			}

			$wp_query->get_posts();

			if ( have_posts() ) : 
				?>

			<div class="alum-listing">
			<?php

				// Start the Loop.
				while ( have_posts() ) : the_post(); 
					?>
				<div class="alum">
					<div class="photo">
						<a href="#alum-<?php the_ID(); ?>" class="open-alum-link">
						<?php 
						if ( has_post_thumbnail() ) {
							the_post_thumbnail();
						} else {
							show_alum_category_image( get_cmb_value( 'alum_category' ) );
						}
						?>
						</a>
					</div>
					<div class="info group">
						<h5><a href="#alum-<?php the_ID(); ?>" class="open-alum-link"><?php print substr( get_the_title(), 0, 50 ); print ( strlen( get_the_title() ) > 50 ? '...' : '' ); ?></a></h5>
						<?php if ( get_cmb_value( 'alum_year' ) > 0 ) { ?><div class="alum-year"><?php show_cmb_value( 'alum_year' ) ?></div><?php } ?>
						<div class="alum-location"><?php show_cmb_value( 'alum_city' ); ?>, <?php show_cmb_value( 'alum_state' ) ?></div>
					</div>
					<div class="alum-category alum-category-<?php show_cmb_value( 'alum_category' ) ?>"><?php print get_alum_category_name( get_cmb_value( 'alum_category' ) ); ?></div>
				</div>
				<div class="alum-details mfp-hide" id="alum-<?php the_ID(); ?>">
					<h3><?php show_cmb_value( 'alum_name_first' ); ?> <?php show_cmb_value( 'alum_name_last' ) ?></h3>
					<div class="details">
						<div class="details-photo">
							<?php 
							if ( has_post_thumbnail() ) {
								the_post_thumbnail();
							} else {
								show_alum_category_image( get_cmb_value( 'alum_category' ) );
							}
							?>
						</div>
						<div class="alum-year"><strong>Class of <?php show_cmb_value( 'alum_year' ) ?></strong></div>
						<div class="alum-location"><?php show_cmb_value( 'alum_city' ); ?>, <?php show_cmb_value( 'alum_state' ) ?></div>
						<div class="alum-category alum-category-<?php show_cmb_value( 'alum_category' ) ?>"><?php print get_alum_category_name( get_cmb_value( 'alum_category' ) ); ?></div>
						<div class="details-content">
							<p><?php the_content(); ?></p>
						</div>
					</div>
				</div>
					<?php

				endwhile;
				?>
				<?php
			else : ?>
				<p>No results for that criteria. Try selecting fewer filters or changing your search term.</p>
				<?php

			endif;
			?>
			</div>

			<div class="group pagination">
				<?php pagination(); ?>
			</div>

		</div>

	</div>

<?php

get_footer();

?>