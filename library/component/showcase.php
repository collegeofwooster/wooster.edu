

<?php if ( get_sub_field( 'show_cta' ) ) : ?>
<div class="showcase-cta">
    <?php 
    if ( have_rows( 'cta' ) ) : 
        while ( have_rows( 'cta' ) ) : the_row();
            $text = get_sub_field( 'text' );
            $link = get_sub_field( 'link' );
            $color = get_sub_field( 'color' );
            if ( !empty( $text ) && !empty( $link ) ) :
                print '<a href="' . $link . '" class="btn ' . $color . '">' . $text . '</a>';
            endif;
        endwhile;
    endif;
    ?>
</div>
<?php endif; ?>


<div class="showcase-container">
    <?php
    if ( have_rows( 'slides' ) ) : 
    ?>
    <div class="showcase">
    <?php
    $count = 0;

    while ( have_rows( 'slides' ) ) : the_row();
        $title = get_sub_field( 'title' );
        $link = get_sub_field( 'link' );
        $image = get_sub_field( 'image' );
        $video = get_sub_field( 'video' );
        $content = get_sub_field( 'content' );

        if ( !empty( $image ) ) :
            ?>
        <div class="slide <?php 
            print ( get_row_index() == 1 ? 'visible' : '' ); 
            print ( !empty( $link ) ? ' has-link' : '' ) ?>"<?php
            print 'style="background-image: url(' . $image . ');"';
            print ( !empty( $link ) ? 'data-href="' . $link . '"' : '' ) ?>>

            <?php if ( !empty( $video ) ) : ?>
            <video class="slide-video" autoplay muted loop><source src="<?php print $video; ?>" type="video/webm"></video>
            <?php endif; ?>

            <?php if ( !empty( $content ) ) { ?>
            <div class="showcase-overlay"></div>
            <div class="slide-content">
                <div class="wrap">
                <?php if ( !empty( $content ) ) : print $content; endif; ?>
                </div>
            </div>
            <?php } else if ( !empty( $title ) ) { ?>
                <h1 class="slide-title"><?php print $title; ?></h1>
            <?php } ?>

        </div>
            <?php

            $count++;
        endif;
    endwhile;

    if ( $count > 1 ) : ?>
        <div class="showcase-nav">
            <a class="previous">Previous</a>
            <a class="next">Next</a>
        </div>
        <?php
    endif;
    ?>
        <a href="#content-start" class="scroll-to-content"></a>
    </div>
    <?php
    endif;
    
    if ( get_sub_field( 'show_featured_article' ) || get_sub_field( 'show_notice_box' ) ) :
    ?>
    <div class="front-showcase-overlay">
        
        <?php if ( get_sub_field( 'show_featured_article' ) ) : 
            $featured_article = get_sub_field( 'featured_article' ); ?>
        <div class="featured-article">
            <div class="featured-article-image">
                <img src="<?php print get_the_post_thumbnail_url( $featured_article->ID, 'thumbnail' ); ?>" />
            </div>
            <div class="featured-article-content">
                <h4>Featured</h4>
                <h3><a href="<?php print get_permalink( $featured_article->ID ) ?>"><?php print $featured_article->post_title; ?></a></h3>
                <?php print do_shortcode('[button url="' . get_permalink( $featured_article->ID ) . '" class="black"]Read more[/button]') ?>
            </div>
        </div>
        <?php endif; ?>
       
        <?php if ( get_sub_field( 'show_notice_box' ) ) : ?>
        <div class="front-notice">
            <?php the_sub_field( 'notice_box' ) ?>
        </div>
        <?php endif; ?>

    </div>
    <?php endif; ?>
</div>
<a name="content-start"></a>

