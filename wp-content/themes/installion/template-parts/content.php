<article class="blog">
  <figure><?php the_post_thumbnail('large'); ?></figure>
  <div class="detail">
    <div class="align-self-center">
      <div class="date">
        <span><i class="fa fa-calendar-o"></i><?php the_time('j M Y'); ?></span> <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><i class="fa fa-user-o"></i> <?php echo get_the_author(); ?></a>
      </div>
      <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
      <p><?php the_excerpt(); ?></p>
      <a href="<?php the_permalink(); ?>" class="learn_link">Learn More</a>
    </div>
  </div>
</article>