<?php get_header(); ?>
<?php
$feat_image = wp_get_attachment_url(get_post_thumbnail_id());
if (empty($feat_image)) :
	$feat_image = get_template_directory_uri() . '/images/residencial_banner.jpg';

endif;
?>

<!-- Section -->
<section>
	<!-- Hero Sec -->
	<div class="hero_sec">
		<img src="<?php echo $feat_image; ?>" alt="" class="bg">
		<div class="hero_curve"><img src="<?php echo get_template_directory_uri(); ?>/images/inner_banner_curve.png" alt=""></div>
		<?php if (get_field('banner_badge_logo')) { ?><div class="fs_logo"><img src="<?php echo get_field('banner_badge_logo'); ?>" alt=""></div> <?php } ?>
	</div>
	<div class="project_sec">
		<div class="container">
			<h1><?php printf(__('Search Results for: %s', ''), get_search_query()); ?></h1>
			<?php

			if (have_posts()) :

				while (have_posts()) : the_post();

			?>
					<div class="block">
						<div class="row">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

								<p><?php the_excerpt(); ?></p>
								<a href="<?php the_permalink(); ?>" class="read_more">Ver más</a>
							</div>
						</div>
					</div>
				<?php

				endwhile;

				theme_paging_nav();
			else : ?>
				<p>
					<?php _e('It looks like nothing was found at this location.Try with different keyword.', ''); ?>
				</p>
				<?php get_search_form(); ?>
				<div style="height:40px;">&nbsp;</div>
			<?php
			endif;
			?>
		</div>
	</div>
</section>
<?php get_footer(); ?>