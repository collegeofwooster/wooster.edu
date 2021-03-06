<!DOCTYPE html>
<!--[if IE 7]><html class="ie ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="ie ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width,initial-scale=1" />

<title><?php wp_title( '|', true, 'right' ); ?> <?php bloginfo( 'sitename' ) ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>
<link href="<?php bloginfo( "template_url" ) ?>/css/main.css?v=33" rel="stylesheet" type="text/css">

</head>
<body <?php body_class(); ?>>
<div class="container">

<?php //the_emergency_bar(); ?>

<header>
	
	<div class="logo">
		<a href="/" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<img src="<?php bloginfo( "template_url" ) ?>/img/logo.webp" alt="<?php bloginfo( 'name' ); ?>">
		</a>
	</div>

	<button class="menu-show">Show Menu</button>

	<nav class="header-buttons">
		<?php wp_nav_menu( array( 'theme_location' => 'header-buttons' ) ); ?>
	</nav>

	<a href="#" class="language">Select Language</a>
	
</header>

<div class="menu-overlay">
	<a class="close">X</a>

	<div class="columns">
		<div class="column">
			<nav class="main-menu">
				<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
			</nav>
		</div>
		<div class="column">
			<div class="search-form">
				<h3>What can we help you find?</h3>
				<?php include( 'searchform-advanced.php' ); ?>
			</div>

			<div class="my-wooster">
				<a href="#">Inside Wooster</a>
			</div>

			<div class="quick-links helpful">
				<h4>Helpful Links</h4>
				<?php wp_nav_menu( array( 'theme_location' => 'main-menu-helpful' ) ); ?>
			</div>

			<div class="quick-links info-for">
				<h4>Info For</h4>
				<?php wp_nav_menu( array( 'theme_location' => 'main-menu-info-for' ) ); ?>
			</div>

			<div class="quick-links locations">
				<h4>Locations</h4>
				<?php wp_nav_menu( array( 'theme_location' => 'main-menu-locations' ) ); ?>
			</div>

			<div class="guides">
				<h4>Guides</h4>
				<div class="guides-inner">
					<?php print do_shortcode( '[snippet slug="menu-guides" content_filter=0 /]' ); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php do_action( 'after_header' ); ?>

<section class="content">
	<a name="content"></a>

	<?php do_action( 'before_content' ); ?>
