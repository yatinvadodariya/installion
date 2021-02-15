<?php
//if ( is_active_sidebar( 'blog-sidebar' ) ) : 
//   dynamic_sidebar( 'blog-sidebar' );
//endif;
?>


<aside>
  <!-- Recent Blogs -->
  <h2 class="small_title"><span><strong>Recent Blog</strong></span></h2>
  <div class="recent_sec">
    <?php $the_query = new WP_Query('showposts=5'); ?>
    <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
      <div class="recent">
        <figure><?php the_post_thumbnail(array(80, 80)); ?></figure>
        <div class="detail">

          <span class="date"><i class="fa fa-calendar-o"></i><?php the_time('d M Y'); ?></span>
          <h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
        </div>
      </div>
    <?php endwhile; ?>
  </div>

  <!-- Archive -->
  <h2 class="small_title"><span><strong>Archive</strong></span></h2>
  <ul class="archive_links">
    <li><a href="#"><?php echo get_the_date('F Y'); ?></a></li>
  </ul>

  <!-- Tags -->
  <h2 class="small_title"><span><strong>Tags</strong></span></h2>
  <div class="tags">
    <?php
    $tags = get_tags(array(
      'hide_empty' => true
    ));
    echo '<ul>';
    foreach ($tags as $tag) {
      $tag_link = get_tag_link($tag->term_id);
      echo "<a href='{$tag_link}'>" . $tag->name . "</a>";
    }
    echo '</ul>';
    ?>
  </div>

</aside>