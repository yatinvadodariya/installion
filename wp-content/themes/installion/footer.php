<?php

/**

 * The template for displaying the footer

 * */


$instagram = get_theme_mod('instagram');

$linkedin = get_theme_mod('linkedin');

$facebook = get_theme_mod('facebook');

?>


</section>

<!-- Footer -->
<footer>
	<div class="container">
		<div class="row">
			<div class="col-xl-4 col-lg-4 col-md-12 col-sm-7">
				<!-- Footer Logo -->
				<figure class="footer_logo"><img src="<?php echo get_theme_mod('footer_logo'); ?>" alt=""></figure>

				<!-- Subscribe Info -->
				<div class="subscribe_info">
					<h3>Zum Newsletter anmelden</h3>
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Ihre Email" aria-label="Recipient's username" aria-describedby="basic-addon2">
						<div class="input-group-append">
							<button class="btn btn-outline-secondary" type="button"><i class="fa fa-angle-right"></i></button>
						</div>
					</div>
				</div>

				<!-- Social -->
				<ul class="social_info">
					<?php if (!empty($linkedin)) : ?>
						<li><a href="<?php echo $linkedin; ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
					<?php endif; ?>
					<?php if (!empty($facebook)) : ?>
						<li><a href="<?php echo $facebook; ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
					<?php endif; ?>
					<?php if (!empty($instagram)) : ?>
						<li><a href="<?php echo $instagram; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
					<?php endif; ?>
				</ul>
			</div>
			<div class="col-xl-3 col-lg-2 col-md-4 col-sm-5 col-6">
				<h3>Navigation</h3>
				<?php wp_nav_menu(array(
					'theme_location' => 'footer',
					'items_wrap' => '  <ul class="footer_link">%3$s</ul>',
					'container' => false,
					'menu_class' => ''
				));
				?>
			</div>

			<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6">
				<h3>Leistungen</h3>
				<?php wp_nav_menu(array(
					'theme_location' => 'footer2',
					'items_wrap' => '  <ul class="footer_link">%3$s</ul>',
					'container' => false,
					'menu_class' => ''
				));
				?>
			</div>

			<div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
				<h3>Über Uns</h3>
				<?php wp_nav_menu(array(
					'theme_location' => 'footer3',
					'items_wrap' => '  <ul class="footer_link">%3$s</ul>',
					'container' => false,
					'menu_class' => ''
				));
				?>
			</div>

		</div>

		<!-- Copyright -->
		<div class="copyright"><?php echo get_theme_mod('copyright'); ?></div>
	</div>
</footer>



<?php wp_footer(); ?>

<script>
	jQuery("ul ul a").removeClass("nav-link");



	jQuery("ul.footer_link a").removeClass("nav-link");

	jQuery("li.menu-item-has-children").addClass("dropdown");

	//  jQuery( "li.menu-item-has-children a:first" ).addClass( "dropdown-toggle" );

	// jQuery('li.menu-item-has-children a:first').attr('id', 'navbarDropdown');

	//jQuery("li.menu-item-has-children a:first").attr("data-toggle", "dropdown");



	// jQuery('li.menu-item-has-children a:first-of-type').addClass('dropdown-toggle');

	// jQuery('li.menu-item-has-children a:first-of-type').attr("data-toggle", "dropdown");



	jQuery('li.menu-item-has-children').each(function(i) {



		jQuery(this).find('a:first').addClass('dropdown-toggle');

		jQuery(this).find('a:first').attr("data-toggle", "dropdown");



	});

	// jQuery("ul").find("a").parent('menu-item-has-children').addClass( "dropdown-toggle" );



	/*jQuery( "#menu-item-101.menu-item-has-children a:first" ).addClass( "dropdown-toggle" );

	 jQuery('#menu-item-101.menu-item-has-children a:first').attr('id', 'navbarDropdown');

	 jQuery("#menu-item-101.menu-item-has-children a:first").attr("data-toggle", "dropdown");

	jQuery( "#menu-item-99.menu-item-has-children a:first" ).addClass( "dropdown-toggle" );

	 jQuery('#menu-item-99.menu-item-has-children a:first').attr('id', 'navbarDropdown');

	 jQuery("#menu-item-99.menu-item-has-children a:first").attr("data-toggle", "dropdown");

	 */

	jQuery("ul.dropdown-menu a").addClass("dropdown-item");
</script>

<script>
	var owl = jQuery('.installionslider');

	owl.owlCarousel({

		margin: 0,

		loop: true,

		dots: false,

		nav: true,

		//		animateOut:'fadeOut',

		//		autoplay:true,

		items: 5,

		responsive: {

			0: {

				items: 1,

				dots: true,

				nav: false

			},

			600: {

				items: 1

			},

			767: {

				items: 2

			},

			992: {

				items: 2

			},

			1000: {

				items: 2,

			}

		}

	})



	var owl = jQuery('.testimonialslider');

	owl.owlCarousel({

		margin: 0,

		loop: true,

		dots: false,

		nav: true,

		//		animateOut:'fadeOut',

		//		autoplay:true,

		items: 5,

		responsive: {

			0: {

				items: 1,

				dots: true,

				nav: false

			},

			600: {

				items: 1

			},

			767: {

				items: 2

			},

			992: {

				items: 2

			},

			1000: {

				items: 2,

			}

		}

	})
</script>
</body>

</html>