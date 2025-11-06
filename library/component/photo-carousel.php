<?php


$photos = get_sub_field( 'photos' );
$color = get_sub_field( 'color' );


if ( have_rows( 'photos' ) ) {
    ?>
    <div class="photo-carousel-container <?php print $color; ?>">
        <?php if ( count( $photos ) > 1 ) { ?>
        <div class="controls">
            <a href="#" class="prev">Previous</a>
            <a href="#" class="next">Next</a>
        </div>
        <?php } ?>
        <div class="photo-carousel">
        <?php 
        while ( have_rows( 'photos' ) ) : the_row();
            $photo_only = get_sub_field( 'photo-only' );
            $image = get_sub_field( 'image' );
            $title = get_sub_field( 'title' );
            $content = get_sub_field( 'content' );

            if ( !empty( $image ) ) { 
                ?>
                <div class="photo<?php print ( get_row_index() == 1 ? ' visible' : '' ) ?>">
                    <?php if ( $photo_only ) { ?>
                        <img src="<?php print $image ?>)" class="preload">
                    <?php } else { ?>
                    <div class="image preload" style="background-image: url(<?php print $image ?>)"></div>
                    <div class="content">
                        <?php if ( !empty( $title ) ) : ?><h3><?php print $title ?></h3><?php endif; 
                        print $content;
                        ?>
                        <p class="photo-buttons"><?php
                        if ( have_rows( 'buttons' ) ) :
                            while ( have_rows( 'buttons' ) ) : the_row();
                                $label = get_sub_field( 'label' );
                                $link = get_sub_field( 'link' );
                                $color = get_sub_field( 'color' );

                                if ( !empty( $label ) && !empty( $link ) ) {
                                    // variable for this button
                                    print '<a href="' . $link . '" class="btn ' . $color . '">' . $label . '</a>';
                                }
                            endwhile;
                        endif;
                        ?></p>
                    </div>
                    <?php } ?>
                </div>
                <?php
            }

        endwhile;
        // output the main cta buttons
        ?>
        </div>
    </div>
    <?php 
}

