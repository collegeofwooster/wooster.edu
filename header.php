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
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

<link href="<?php bloginfo( "template_url" ) ?>/css/main.css?v=73" rel="stylesheet" type="text/css">

<link href="https://addtocalendar.com/atc/1.5/atc-style-blue.css" rel="stylesheet" type="text/css">

<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#ffc712">
<meta name="msapplication-TileColor" content="#ffc712">
<meta name="theme-color" content="#ffc712">

<!-- Google Tag Manager -->
<script>
(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});
var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';
j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-NBTNRMH');
</script>
<!-- End Google Tag Manager -->

<!-- facebook tracking code -->
<meta name="facebook-domain-verification" content="g3lhfalbuajlht5b5p3d7gp3ic1djl" />
<!-- /facebook tracking code -->

</head>
<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NBTNRMH" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<div class="container">

<?php //the_emergency_bar(); ?>

<header>
	
	<div class="logo">
		<a href="/" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<img src="<?php bloginfo( "template_url" ) ?>/img/logo.png" alt="<?php bloginfo( 'name' ); ?>">
		</a>
	</div>

	<button class="menu-show">Show Menu</button>

	<nav class="header-buttons">
		<?php wp_nav_menu( array( 'theme_location' => 'header-buttons' ) ); ?>
	</nav>

	<div id="google_translate_element"></div>
	<script>
	function googleTranslateElementInit() {
		new google.translate.TranslateElement({
			pageLanguage: 'en'
		}, 'google_translate_element');
	}
	</script>
	<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

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
				<a href="https://inside.wooster.edu" target="_blank">Inside Wooster</a>
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
