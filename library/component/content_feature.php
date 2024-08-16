<?php

$color = get_sub_field( 'color' );
$photo = get_sub_field( 'photo' );
$content = get_sub_field( 'content' );

if ( !empty( $content ) ) {
    ?>
    <div class="content-feature <?php print $color ?>">
        <div class="wrap">
            <div class="content-feature-inner">
                <?php print $content; ?>
            </div>
            <div class="content-feature-photo">
                <img src="<?php print $photo ?>" />
            </div>
        </div>
    </div>
    <?php
}

