<?php

$size = get_sub_field( 'size' );
$reverse = get_sub_field( 'reverse' );
$color = get_sub_field( 'color' );
$valign = get_sub_field( 'valign' );

if ( have_rows( 'left_components' ) || have_rows( 'right_components' ) ):
    ?>
    <div class="two-column-container <?php print $size; ?> <?php print $color; ?> <?php print $valign; ?>">
        <div class="wrap">
            <div class="two-column-inner">
            <?php if ( have_rows( 'left_components' ) ) { ?>
                <div class="left">
                    <?php while ( have_rows( 'left_components' ) ) : the_row();
                        // include the specific layout
                        get_template_part( 'library/component/' . get_row_layout() );
                    endwhile; ?>
                </div>
            <?php } ?>
            <?php if ( have_rows( 'right_components' ) ) { ?>
                <div class="right">
                    <?php while ( have_rows( 'right_components' ) ) : the_row();
                        // include the specific layout
                        get_template_part( 'library/component/' . get_row_layout() );
                    endwhile; ?>
                </div>
            <?php } ?>
            </div>
        </div>
    </div>
    <?php 
endif;

