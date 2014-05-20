<!DOCTYPE html>
<html>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title><?php wp_title(' - ', true, 'left'); ?></title>
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="stylesheet" type="text/css" media="all" href="http://fonts.googleapis.com/css?family=Lato:300,300italic" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('template_directory') ?>/ionicons.min.css" />
		<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo('stylesheet_url'); ?>" />
		<link rel="pingback" href="<?php bloginfo('pingback_url');?>" />
		<link rel="alternate" type="application/rss+xml" title="Subscribe to <?php bloginfo('name'); ?>" href="<?php bloginfo('rss2_url'); ?>" />
		<link rel="Shortcut Icon" type="image/x-icon" href="<?php echo get_option('intro_favicon'); ?>" />
		<style>
		<?php if(get_option('intro_banner') != ''){ ?>
		#banner {
			background: url(<?php echo get_option('intro_banner'); ?>) center center !important;
		}
		<?php } ?>
		<?php echo get_option('intro_custom_css'); ?>
		</style>
		<script>var IntroThemeSettings = <?php echo json_encode(array(
			'ajax_navigation' => (bool)get_option('intro_ajax'),
			'scrollbars' => (bool)get_option('intro_scrollbars')
		)); ?>;</script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="<?php bloginfo('template_directory') ?>/functions/js/flexcroll.js"></script>
		<script src="<?php bloginfo('template_directory') ?>/functions/js/theme.js"></script>
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<?php
			wp_enqueue_script('comment-reply');
			wp_head();
		?>
	</head>
	<body>
		<div id="container">
			<div id="ajax-loader"></div>