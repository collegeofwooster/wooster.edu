<?php

$title = get_sub_field( 'title' );
$photo = get_sub_field( 'photo' );
$color = get_sub_field( 'color' );
$cta = '';

if ( have_rows( 'buttons' ) ) :

    // build the cta button code so we can output in multiple places;
    while ( have_rows( 'buttons' ) ) : the_row();
        $cta .= '<a href="' . get_sub_field( 'link' ) . '" class="btn ' . get_sub_field( 'color' ) . '">' . get_sub_field( 'label' ) . '</a>';
    endwhile;

    // display the floating cta div
    print '<div class="cta-float">' . $cta . '</div>';

endif;

// if we have both a background and a title, output the thing.
if ( !empty( $photo ) && !empty( $title ) ) {
    ?>
<div class="page-header <?php print $color ?>" style="background-image: url(<?php print $photo; ?>);">
    <div class="page-header-overlay"></div>
    <div class="wrap">
        <div class="breadcrumbs">
            <div class="crumbs">
                <?php get_template_part( 'library/component/breadcrumbs' ); ?>
            </div>
            <h1 class="page-title"><?php print $title; ?></h1>
        </div>
        <div class="header-cta"><?php print $cta ?></div>
    </div>
</div>
<div class="page-header-bottom"></div>
    <?php
}

