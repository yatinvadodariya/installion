<?php get_header();
$feat_image = get_template_directory_uri() . '/images/anchore_icon.png';
?>


<!-- Inner Banner -->
<div class="inner_banner blog_banner">
  <div class="container">
    <h2>Blog</h2>
  </div>
  <div class="scroll_link"><a href="#NextSec"><span><img src="<?php echo $feat_image; ?>" alt=""></span> </a></div>
</div>

<!-- Blog Sec -->
<div class="blog_sec" id="NextSec">
  <div class="container">
    <div class="row">
      <div class="col-xl-8 col-lg-8 col-md-7 col-sm-12">
        <h2 class="inner_title"><span><strong>Popular Blog</strong></span></h2>

        <?php
        if (have_posts()) :
          while (have_posts()) : the_post();
            get_template_part('template-parts/content', get_post_format());
          endwhile;
        endif;
        $page_for_posts = get_option('page_for_posts');
        ?>

      </div>

      <div class="col-lg-4">
        <?php get_sidebar(); ?>
      </div>
    </div>
  </div>
</div>
</div>

<?php get_footer(); ?>