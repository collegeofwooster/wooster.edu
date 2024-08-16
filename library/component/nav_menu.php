<?php

$menu = get_sub_field( 'nav-menu' );
if ( !empty( $menu ) ): 
    ?>
<div class="sidebar-menu-toggle">Section Menu</div>
<div class="sidebar-menu">
    <?php wp_nav_menu( array( 'menu' => $menu ) ); ?>
</div>
    <?php
endif;


