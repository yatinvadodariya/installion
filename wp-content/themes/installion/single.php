<?php get_header(''); ?>
<!--Header End-->
<?php
$feat_image = wp_get_attachment_url(get_post_thumbnail_id());
$postid = $post->ID;
$header_overlay = get_post_meta($postid, 'header-overlay', true);
$page_title = get_post_meta($postid, 'page_title', true);
if ($header_overlay != '') {
	$overlay_value = 'linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),';
} else {
	$overlay_value = '';
}

if (!empty($feat_image)) {
	$feat_image = 'background: ' . $overlay_value . ' url(' . $feat_image . ')no-repeat center center;
    background-size: cover;';
} else {
	$feat_image = '';
}

?>
<!-- Banner Section -->

<div class="inner_banner blog_banner">
	<div class="container">
		<h1><?php if ($page_title != '') {
				echo $page_title;
			} else {
				the_title();
			} ?></h1>
	</div>
</div>
<!-- S Welcome -->

<?php while (have_posts()) : the_post(); ?>
	<!-- News Sec -->

	<section class="career_sec common_sec">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="blog-listing-content">
						<div class="blog-list-box">
							<?php the_post_thumbnail('large');
							?>
							<div class="details">
								<?php the_content(); ?>
								<div style="clear:both">
									<?php
									//	if (comments_open() || get_comments_number()) :
									//	comments_template();
									//endif;
									?>
								</div>
							</div>
						</div>
					</div>
					<?php
					$next_post = get_next_post();
					$prev_post = get_previous_post();

					if ($next_post || $prev_post) {

						$pagination_classes = '';

						if (!$next_post) {
							$pagination_classes = ' only-one only-prev';
						} elseif (!$prev_post) {
							$pagination_classes = ' only-one only-next';
						}

					?>

						<nav class="pagination-single section-inner<?php echo esc_attr($pagination_classes); ?>" aria-label="<?php esc_attr_e('Post', 'twentytwenty'); ?>" role="navigation">

							<hr class="styled-separator is-style-wide" aria-hidden="true" />

							<div class="pagination-single-inner">

								<?php
								if ($prev_post) {
								?>

									<a class="previous-post" href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>">
										<span class="arrow" aria-hidden="true">&larr;</span>
										<span class="title"><span class="title-inner"><?php echo wp_kses_post(get_the_title($prev_post->ID)); ?></span></span>
									</a>

								<?php
								}

								if ($next_post) {
								?>

									<a class="next-post" href="<?php echo esc_url(get_permalink($next_post->ID)); ?>">
										<span class="arrow" aria-hidden="true">&rarr;</span>
										<span class="title"><span class="title-inner"><?php echo wp_kses_post(get_the_title($next_post->ID)); ?></span></span>
									</a>
								<?php
								}
								?>

							</div><!-- .pagination-single-inner -->

							<hr class="styled-separator is-style-wide" aria-hidden="true" />

						</nav><!-- .pagination-single -->

					<?php
					}
					?>


					<?php //liquid_render_post_nav() 
					?>
				</div>

			</div>
		</div>
	</section>
<?php endwhile; ?>
<?php get_footer(); ?>