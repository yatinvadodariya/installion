<?php
/**
 * Template Name: Fullwidth Template
 */
?>
<?php get_header(); ?>
<?php while (have_posts()) : the_post();

	 $feat_image = wp_get_attachment_url(get_post_thumbnail_id());
	 $postid = $post->ID;
		$header_overlay = get_post_meta($postid, 'header-overlay', true);
		$page_title = get_post_meta($postid, 'page_title', true);
		if($header_overlay!=''){
			$overlay_value='linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),';
		}
		else
		{
			$overlay_value='';
		}

    if (!empty($feat_image)){
        $feat_image = 'background: '.$overlay_value.' url('.$feat_image . ')no-repeat center center;
    background-size: cover;';
	}else{
		$feat_image='';
	}
	
 ?>
 <div class="inner_banner assembly_banner" style="<?php echo $feat_image; ?>">
    <div class="container">
        <h1><?php if($page_title!=''){ echo $page_title; }else{ the_title(); } ?></h1>
    </div>
</div>


<?php the_content();?>
<?php endwhile; ?>
<?php get_footer(); ?>