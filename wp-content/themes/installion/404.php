<?php get_header(); ?>
<?php
$feat_image = wp_get_attachment_url(get_post_thumbnail_id());
    if (empty($feat_image)) :
        $feat_image = get_template_directory_uri() . '/images/program_benner.png';
		
    endif;
?>
	<!-- banner Sec -->
<div class="inner_banner assembly_banner">
    <div class="container">
         <h1><?php _e( 'Looks like you are lost.', '' ); ?> </h1>
    </div>
</div>


<section class="career_sec" >
  <div class="container">

	<h2>404 Error!</h2>
<p>
          <?php _e( 'We can’t seem to find the page you’re looking for.', '' ); ?>
        </p>
        <?php //get_search_form(); ?>

</div>
</section>
<!-- Section -->
<?php get_footer(); ?>