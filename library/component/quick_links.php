<?php

if ( have_rows( 'links' ) ) :
    ?>
<div class="quick-links-container">
    <?php while ( have_rows( 'links' ) ) : the_row();
        $title = get_sub_field( 'title' );
        $subtitle = get_sub_field( 'subtitle' );
        $link = get_sub_field( 'link' );
        $color = get_sub_field( 'color' );

        if ( !empty( $link ) ) :
            ?>
    <a href="<?php print $link ?>" class="<?php print $color ?>"><div class="inner">
        <strong><?php print $title ?></strong><br>
        <?php print $subtitle ?>
    </div></a>
            <?php
        endif; 
    endwhile; ?>
</div>
    <?php
endif;

