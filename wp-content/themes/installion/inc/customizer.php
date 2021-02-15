<?php

require_once(ABSPATH . WPINC . '/class-wp-customize-control.php');

class Example_Customize_Textarea_Control extends WP_Customize_Control
{

    public $type = 'textarea';

    public function render_content()
    {

?>

        <label>

            <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>

            <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea($this->value()); ?></textarea>

        </label>

<?php

    }
}

function installion_customize_register($wp_customize)
{

    $wp_customize->remove_section('static_front_page');

    $wp_customize->remove_panel('nav_menus');

    $wp_customize->remove_panel('widgets');

    //here social media settings



    //here genearal settings






    $wp_customize->add_section('footer_setting', array(

        'title' => __('Footer Settings', 'installion'),

    ));


    $wp_customize->add_setting('footer_logo');

    $wp_customize->add_control(

        new WP_Customize_Image_Control(

            $wp_customize,
            'footer_logo',
            array(

                'label' => __('Footer Logo Image', 'installion'),

                'section' => 'footer_setting',

                'settings' => 'footer_logo',

            )
        )
    );



    $wp_customize->add_setting('copyright');

    $wp_customize->add_control(

        new WP_Customize_Control(

            $wp_customize,
            'copyright',
            array(

                'label' => __('Copyright', 'installion'),

                'section' => 'footer_setting',

                'settings' => 'copyright',

            )

        )

    );

    $wp_customize->add_section('social_media', array(

        'title' => __('Social Media', 'breedenlaw'),

    ));

    $wp_customize->add_setting('linkedin');

    $wp_customize->add_control(

        new WP_Customize_Control(

            $wp_customize,
            'linkedin',
            array(

                'label' => 'Linkedin Url',

                'section' => 'social_media',

                'settings' => 'linkedin',

            )

        )

    );

    $wp_customize->add_setting('facebook');

    $wp_customize->add_control(

        new WP_Customize_Control(

            $wp_customize,
            'facebook',
            array(

                'label' => 'Facebook Url',

                'section' => 'social_media',

                'settings' => 'facebook',

            )

        )

    );

    $wp_customize->add_setting('instagram');

    $wp_customize->add_control(

        new WP_Customize_Control(

            $wp_customize,
            'instagram',
            array(

                'label' => 'Instagram Url',

                'section' => 'social_media',

                'settings' => 'instagram',

            )

        )

    );
}
add_action('customize_register', 'installion_customize_register', 20);
