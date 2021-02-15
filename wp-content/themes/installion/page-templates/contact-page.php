<?php

/**
 * Template Name: Contact Page
 */
?>
<?php get_header(); ?>

<!-- Section -->
<section>
    <!-- Inner Banner -->
    <div class="inner_banner contact_banner">
        <div class="container">
            <h2>contact</h2>
        </div>
        <div class="scroll_link"><a href="#NextSec"><span><img src="<?php echo get_template_directory_uri(''); ?>/images/anchore_icon.png" alt=""></span> </a></div>
    </div>

    <!-- Contact Sec -->
    <div class="info_contact" id="NextSec">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                    <div class="c_block">
                        <i>
                            <?php
                            $image = get_field('address_icon');
                            if (!empty($image)) : ?>
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                            <?php endif; ?>
                        </i>
                        <p><?php the_field('address_detail'); ?></p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                    <div class="c_block">
                        <i>
                            <?php
                            $image = get_field('telefon_icon');
                            if (!empty($image)) : ?>
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                            <?php endif; ?>
                        </i>
                        <p><?php the_field('telefon_detail'); ?></p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                    <div class="c_block">
                        <i>
                            <?php
                            $image = get_field('fax_icon');
                            if (!empty($image)) : ?>
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                            <?php endif; ?>
                        </i>
                        <p><?php the_field('fax_detail'); ?></p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
                    <div class="c_block">
                        <i><?php
                            $image = get_field('email_icon');
                            if (!empty($image)) : ?>
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                            <?php endif; ?></i>
                        <p><?php the_field('email_detail'); ?></p>
                    </div>
                </div>
            </div>
            <?php the_field('conpage_info'); ?>
        </div>
    </div>

    <div class="map_info">
        <?php the_field('map_link'); ?>
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