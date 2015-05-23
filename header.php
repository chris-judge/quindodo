<!DOCTYPE html>

<!--[if lt IE 7 ]> <html class="ie ie6 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	
	<?php // Force latest IE rendering engine and chrome fram ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<?php if (is_search()) { ?><meta name="robots" content="noindex, nofollow" /> <?php } ?>
	
	<title><?php bloginfo('name'); ?> <?php wp_title("",true); ?></title>
	
	<?php // Meta SEO Information ?>
	<meta name="title" content="<?php bloginfo('name'); ?> <?php wp_title("",true); ?>">
	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta name="author" content="BIGEYE Agency">
	
	<?php // Mobile Friendly ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	
	<?php // Favicon ?>
	<link rel="shortcut icon" href="<?php bloginfo('template_directory'); ?>/_/img/pro/favicon.ico">
	
	<?php // Pingback URL ?>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php //Google Analytics Code here ?>
	<script>
	</script>
	
	<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>
	<header class="header">
		<nav>
			
		</nav>
	</header>