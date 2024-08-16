<?php

$title = get_sub_field( 'title' );
$photo = get_sub_field( 'photo' );
$floating = get_sub_field( 'floating' );

if ( have_rows( 'buttons' ) ) {
    ?>
    <div class="cta" style="background-image: url(<?php print $photo; ?>);">
        <div class="cta-overlay"></div>
        <div class="cta-inner">
        <?php 
        if ( !empty( $title ) ) {
            print '<h2 class="large">' . $title . '</h2>';    
        }

        while ( have_rows( 'buttons' ) ) : the_row();
            $label = get_sub_field( 'label' );
            $link = get_sub_field( 'link' );
            $color = get_sub_field( 'color' );

            if ( !empty( $label ) && !empty( $link ) ) {
                // variable for this button
                print '<a href="' . $link . '" class="btn ' . $color . '">' . $label . '</a>';
            }
        endwhile;

        // output the main cta buttons
        ?>
        </div>
    </div>
    <?php 
}

