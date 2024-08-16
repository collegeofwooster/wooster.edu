<?php

if ( have_rows('stats') ): 
    ?>
<div class="stats-container">
    <div class="stats">
    <?php
    // loop through the rows of data
    $num = 1;
    while ( have_rows( 'stats' ) ) : the_row();

        $number = get_sub_field('title');
        $title = get_sub_field('label');
        $description = get_sub_field('description');
        $button_text = get_sub_field('button-text');
        $button_link = get_sub_field('button-link');
        ?>
        <div class="stat">
            <div class="stat-inner">
                <h3><?php print $number ?></h3>
                <p class="subtitle"><?php print $title ?></p>
                <p class="description"><?php print $description ?></p>
                <?php if ( !empty( $button_link ) ) { ?>
                <p class="button"><a href="<?php print $button_link ?>" class="btn blue"><?php print $button_text ?></a></p>
                <?php } ?>
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

