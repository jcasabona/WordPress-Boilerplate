<!doctype html> 

<html lang="en-US"> 
 
<head> 
<title><?php bloginfo('name'); ?> | <?php wp_title(); ?> </title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<!--[if lt IE 9]> <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> <![endif]-->

<?php wp_head(); ?>


</head>
<body>
	<div id="container" class="group">
	
		<!--Header - Name of Item Here-->
		<header class="group">
			<h1><a href="<?php bloginfo('home'); ?>"><?php bloginfo('name'); ?></h1>
			
			<nav>
				<?php wp_nav_menu( array('menu' => 'Main' )); ?>
			</nav>
		</header>

		
		<!-- End Header -->
		
		<!-- Main Area -->
		
		<div id="content" class="group">