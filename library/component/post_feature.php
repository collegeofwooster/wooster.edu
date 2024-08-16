<?php

$category = get_sub_field( 'category' );
$color = get_sub_field( 'color' );

if ( !empty( $category ) ) {
    ?>
    <div class="posts-feature <?php print $color ?>">
        <div class="wrap">
    <?php
    $post_query = new WP_Query( array(
        'posts_per_page' => 3, 
        'post_type' => 'post', 
        'cat' => implode( ',', $category ),
        'orderby' => 'date', 
        'order' => 'DESC',
        'ignore_sticky_posts' => 0,
    ) );
    while ( $post_query->have_posts() ) {
        $post_query->the_post();
        ?>
            <div class="post">
                <div class="post-image" style="background-image: url(<?php print get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>); ?>"></div>
                <div class="post-entry">
                    <div class="post-thumb"><?php the_post_thumbnail(); ?></div>
                    <div class="post-content">
                        <h4><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h4>
                        <div class="post-excerpt"><?php the_excerpt(); ?></div>
                        <div class="post-buttons"><a href="<?php the_permalink(); ?>" class="btn rose">Read More</a></div>
                    </div>
                </div>
            </div>
        <?php
    }
    ?>
        </div>
    </div>
    <?php
    wp_reset_query();

}
