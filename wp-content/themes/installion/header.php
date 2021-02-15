<?php

/**
 * The template for displaying the header
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=0;">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php
	$custom_logo_id = get_theme_mod('custom_logo');
	$image = wp_get_attachment_image_src($custom_logo_id, 'full');
	?>

	<!-- Header -->
	<header>
		<div class="container">
			<nav class="navbar navbar-expand-lg navbar-light">
				<a class="navbar-brand" href="<?php echo get_site_url(); ?>"><img src="<?php echo $image[0]; ?>" alt="logo"></a>
				<a href="#" class="login_link d-inline-block d-sm-inline-block d-md-inline-block d-lg-none d-xl-none ml-auto"><i><img src="<?php echo get_template_directory_uri(); ?>/images/login_icon.png" alt=""></i> <span class="d-none d-sm-none d-md-inline-block d-lg-inline-block d-xl-inline-block">Anmelden</span></a>
				<button class="navbar-toggler navbar-toggler-right collapsed" type="button" data-toggle="collapse" data-target="#Navigation" aria-controls="Navigation" aria-expanded="false" aria-label="Toggle navigation"><span></span><span></span><span></span></button>

				<div class="collapse navbar-collapse" id="Navigation">
					<?php
					wp_nav_menu(array(
						'theme_location' => 'primary1',
						'items_wrap' => '  <ul class="navbar-nav mx-auto">%3$s</ul>',
						'container' => false,
						'menu_class' => ''
					));

					?>
					<ul class="navbar-nav">
						<li class="nav-item log_link d-none d-sm-none d-md-none d-lg-inline-block d-xl-inline-block"><a class="nav-link" href="#"><i><img src="<?php echo get_template_directory_uri(); ?>/images/login_icon.png" alt=""></i> Anmelden</a></li>
						<li class="nav-item reg_btn"><a class="nav-link" href="<?php echo get_permalink(); ?>">Registrieren</a></li>
					</ul>
				</div>
			</nav>
		</div>
	</header>

	<!-- Section -->
	<section>