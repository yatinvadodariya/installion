<?php get_header();
$feat_image = get_template_directory_uri() . '/images/anchore_icon.png';
?>
<section class="inner_banner blog_banner">
	<!-- <div class="home_img"><img src="<?php echo $feat_image; ?>" alt="#" class="img-fluid ofi" /></div> -->
	<div class="caption_info content_middle">
		<div class="container">
			<div class="cation_detials">
				<h2>Blog</h2>
			</div>
			<div class="scroll_link"><a href="#NextSec"><span><img src="<?php echo $feat_image; ?>" alt=""></span> </a></div>
		</div>
	</div>
</section>
<!-- News Sec -->
<section class="succes_story_sec blog_sec" id="NextSec" style="background: url(<?php echo get_template_directory_uri(); ?>/images/servies_benner.png) no-repeat;">
	<div class="container">
		<div class="row">
			<div class="col-lg-8">
				<div class="blog-listing-content">
					<?php
					if (have_posts()) :
						while (have_posts()) : the_post();
							get_template_part('template-parts/content', get_post_format());
						endwhile;
						theme_paging_nav();
					endif;
					?>
				</div>
			</div>
			<div class="col-lg-4">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>