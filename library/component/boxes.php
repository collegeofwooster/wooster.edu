<?php

$columns = get_sub_field( 'columns' );

if ( have_rows('box') ): 
    ?>
<div class="boxes-container">
    <div class="boxes col<?php print $columns; ?>">
    <?php
    // loop through the rows of data
    $num = 1;
    while ( have_rows( 'box' ) ) : the_row();

        $title = get_sub_field('title');
        $color = get_sub_field('color');
        $content = get_sub_field('content');
        ?>
        <div class="box <?php print $color; print ( empty($title) ? ' no-title' : '' ) ?>">
            <?php if ( !empty( $title ) ) { ?>
            <div class="box-title">
                <h3><?php print $title ?></h3>
            </div>
            <?php } ?>
            <div class="box-content">
                <?php print $content ?>
            </div>
        </div>
        <?php
        $num++;

    endwhile;
    ?>
    </div>
</div>
<?php
endif;

