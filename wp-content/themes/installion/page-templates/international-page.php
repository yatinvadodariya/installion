<?php

/**
 * Template Name: International Page
 */
?>
<?php get_header(); ?>

<!-- Section -->
<section>
    <!-- Inner Banner -->
    <div class="inner_banner international_banner">
        <div class="container">
            <h2>International</h2>
        </div>
        <div class="scroll_link"><a href="#NextSec"><span><img src="<?php echo get_template_directory_uri(''); ?>/images/anchore_icon.png" alt=""></span> </a></div>
    </div>

    <!-- International Sec -->
    <div class="international_sec" id="NextSec">
        <div class="container">
            <h2 class="global_title text-center"><?php the_field('inter_title'); ?></h2>
            <p><?php the_field('inter_description'); ?></p>
            <figure>
                <?php
                $image = get_field('inter_image');
                if (!empty($image)) : ?>
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                <?php endif; ?>
            </figure>
        </div>
    </div>

    <div class="help_sec">
        <div class="container">
            <h2 class="global_title white"><span><?php the_field('help_title'); ?></span></h2>
            <div class="info"><?php the_field('help_description'); ?></div>
            <a href="<?php echo get_field('help_link'); ?>" class="btn_link white_h">contact</a>
        </div>
    </div>
</section>

<?php get_footer(); ?>