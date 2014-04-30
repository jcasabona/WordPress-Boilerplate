<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php bloginfo('name'); ?> | <?php wp_title(); ?> </title>
		 <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />		<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet' type='text/css'>
	
		<?php wp_head(); ?>
	
	</head>
	
	<body>
		<div id="wrapper">
			<!--Header - Name of Item Here-->
		<header class="group">
			<h1><a href="<?php bloginfo('home'); ?>"><?php bloginfo('name'); ?></h1>
			
			<nav class="nav-collapse">
				<?php wp_nav_menu( array('menu' => 'Main' )); ?>
			</nav>
		</header>
		
		<div class="main group">