<?php 

$categories = get_sub_field( 'categories' );
$tags = get_sub_field( 'tags' );
$posts_per_page = get_sub_field( 'posts_per_page' );

print do_shortcode( '[articles' . 
    ( !empty( $categories ) ? ' cats="' . implode( ',', $categories ) . '"' : ''  ) . 
    ( !empty( $tags ) ? ' tags="' . implode( ',', $tags ) . '"' : ''  ) . 
    ' posts_per_page=' . $posts_per_page . ']' );

