<?php

$menu = get_sub_field( 'nav-menu' );
$class = get_sub_field( 'class' );
$classes = implode( ' ', $class );
if ( !empty( $menu ) ):
    if ( !empty( $classes ) ) {
        ?>
    <div class="menu <?php print $classes ?>">
        <?php wp_nav_menu( array( 'menu' => $menu ) ); ?>
    </div>
        <?php
    } else {
        ?>
    <div class="sidebar-menu-toggle">Section Menu</div>
    <div class="sidebar-menu">
        <?php wp_nav_menu( array( 'menu' => $menu ) ); ?>
    </div>
        <?php
    }
endif;


