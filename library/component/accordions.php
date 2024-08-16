<?php


if ( have_rows( 'accordions' ) ) {
    ?>
    <div class="accordions">
        <?php
        while ( have_rows( 'accordions' ) ) : the_row();

            $title = get_sub_field( 'title' );
            $color = get_sub_field( 'color' );
            $open = get_sub_field( 'open' );
            $content = get_sub_field( 'content' );
            
            // only output this accordion if we have a title and content
            if ( !empty( $title ) && !empty( $content ) ) {

                // put this accordion into our accordion function so we aren't duplicating code
                ?>
                <div class="accordion <?php print ( $open ? 'open' : '' ) ?>">
                    <div class="accordion-handle <?php print $color; ?>">
                        <?php print $title; ?>
                    </div>
                    <div class="accordion-content">
                        <?php print $content; ?>
                    </div>
                </div>
                <?php
            
            }

        endwhile;
        ?>
    </div>
    <?php
}

