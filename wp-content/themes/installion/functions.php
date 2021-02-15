<?php

require get_template_directory() . '/inc/customizer.php';

require get_template_directory() . '/inc/custom_post_type.php';

//add_theme_support( 'woocommerce' );

function installion_setup()
{

	add_theme_support('automatic-feed-links');

	add_theme_support('title-tag');

	add_theme_support('post-thumbnails');

	add_theme_support('custom-logo');

	register_nav_menus(array('primary1' => __('Top Menu', 'installion'), 'footer' => __('Footer Navigation', 'installion'), 'footer2' => __('Footer Navigation 2', 'installion'), 'footer3' => __('Footer Navigation 3', 'installion')));
}

add_action('after_setup_theme', 'installion_setup');

function installion_theme_scripts()
{

	wp_enqueue_style('installion-bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), null);
	wp_enqueue_style('installion-main-style', get_template_directory_uri() . '/css/style.css', array(), null);
	wp_enqueue_style('installion-responsive', get_template_directory_uri() . '/css/responsive.css', array(), null);
	wp_enqueue_style('installion-style', get_stylesheet_uri());
	wp_enqueue_style('installion-fontawesome', get_template_directory_uri() . '/css/font-awesome.css', array(), null);
	wp_enqueue_style('installion-carousel', get_template_directory_uri() . '/css/owl.carousel.min.css', array(), null);



	// wp_enqueue_script('installion-jquery', get_template_directory_uri() . '/js/jquery-3.1.0.min.js', array('jquery'),'', true);

	wp_enqueue_script('installion-custom', get_template_directory_uri() . '/js/popper.min.js', array('jquery'), '', true);
	wp_enqueue_script('installion-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true);
	wp_enqueue_script('installion-carousel-js', get_template_directory_uri() . '/js/owl.carousel.js', array('jquery'), '', true);
}

add_action('wp_enqueue_scripts', 'installion_theme_scripts');


function installion_widgets_init()
{

	register_sidebar(array(

		'name' => __('Blog Sidebar', 'installion'),

		'id' => 'blog-sidebar',

		'description' => __('Add widgets here to appear in blog page.', 'installion'),

		'before_widget' => '<aside id="%1$s" class="widget %2$s mb-5">',

		'after_widget' => '</aside>',

		'before_title' => '<h2>',

		'after_title' => '</h2>',

	));
}

add_action('widgets_init', 'installion_widgets_init');



function remove_empty_p($content)
{

	$content = force_balance_tags($content);

	return preg_replace('#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content);
}



add_filter('the_content', 'remove_empty_p', 20, 1);



function theme_paging_nav()
{



	// Don't print empty markup if there's only one page.

	if (empty($max_num_pages)) {

		$max_num_pages = $GLOBALS['wp_query']->max_num_pages;
	}

	if ($max_num_pages < 2) {

		return;
	}

	$paged = get_query_var('paged') ? intval(get_query_var('paged')) : 1;

	$pagenum_link = html_entity_decode(get_pagenum_link());

	$query_args = array();

	$url_parts = explode('?', $pagenum_link);

	if (isset($url_parts[1])) {

		wp_parse_str($url_parts[1], $query_args);
	}

	$pagenum_link = remove_query_arg(array_keys($query_args), $pagenum_link);

	$pagenum_link = trailingslashit($pagenum_link) . '%_%';

	$format = $GLOBALS['wp_rewrite']->using_index_permalinks() && !strpos($pagenum_link, 'index.php') ? 'index.php/' : '';

	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit('page/%#%', 'paged') : '?paged=%#%';



	// Set up paginated links.

	$links = paginate_links(array(

		'base' => $pagenum_link,

		'format' => $format,

		'total' => $max_num_pages,

		'current' => $paged,

		'mid_size' => 3,

		'add_args' => array_map('urlencode', $query_args),

		'prev_text' => '<i class="fa fa-angle-left"></i>',

		'next_text' => '<i class="fa fa-angle-right"></i>',

		'type' => 'list',

	));

	if ($links) :

?>

		<div class="pagination_center">

			<?php echo $links; ?>

		</div>

<?php

	endif;
}

add_filter('get_the_archive_title', 'custom_title_archive_title');



function custom_title_archive_title($title)
{

	if (is_category()) {

		$title = single_cat_title('', false);
	} elseif (is_tag()) {

		$title = single_tag_title('', false);
	}

	return $title;
}


add_filter('nav_menu_submenu_css_class', 'some_function', 10, 3);

function some_function($classes, $args, $depth)
{

	foreach ($classes as $key => $class) {

		if ($class == 'sub-menu') {

			$classes[$key] = 'dropdown-menu';
		}
	}

	return $classes;
}

function add_classes_on_li($classes, $item, $args)
{

	$classes[] = 'nav-item';

	return $classes;
}

add_filter('nav_menu_css_class', 'add_classes_on_li', 1, 3);



function add_menuclass($ulclass)
{

	return preg_replace('/<a /', '<a class="nav-link"', $ulclass);
}

add_filter('wp_nav_menu', 'add_menuclass');



/*============================ Home Banner Section ========================== */

add_action('vc_before_init', 'pv_hbs_integrateWithVC');

function pv_hbs_integrateWithVC()
{

	add_shortcode('pv_hbs', 'pv_hbs_func');

	function pv_hbs_func($atts, $content = null)

	{

		extract(shortcode_atts(array(

			'banner_img' => '',
			'banner_title' => '',
			'banner_content' => '',
			'installer_link' => '',
			'assistant_link' => '',
			'appointment_link' => '',
			'appointment_img' => '',

		), $atts));

		$banner_img = wp_get_attachment_image_src($banner_img, 'full');
		$appointment_img = wp_get_attachment_image_src($appointment_img, 'full');

		if ($banner_img[0] != "") {
			$bannerUrl = $banner_img[0];
		} else {
			$bannerUrl = get_template_directory_uri() . '/images/home_benner.png';
		}
		if ($appointment_img[0] != "") {
			$appointmentUrl = $appointment_img[0];
		} else {
			$appointmentUrl = get_template_directory_uri() . '/images/top_arrow.png';
		}

		$installer_link = vc_build_link($installer_link);
		$assistant_link = vc_build_link($assistant_link);
		$appointment_link = vc_build_link($appointment_link);

		$pg_content .= '<div class="hero_sec">
    <div class="container">
        <h1>' . $banner_title . '</h1>
       <div>' . $banner_content . '</div>
        <div class="btn-block">
            <a href="' . $installer_link['url'] . '" class="btn_links">' . $installer_link['title'] . '</a>
            <a href="' . $assistant_link['url'] . '" class="btn_links btn_links2">' . $assistant_link['title'] . '</a>
        </div>
    </div>
</div>
<div class="arr_app">
	<a href="' . $appointment_link['url'] . '" class="btn_links">' . $appointment_link['title'] . '<i><img src="' . $appointmentUrl . '" alt=""></i></a>
</div>
';

		return $pg_content;
	}



	vc_map(array(
		'name' => esc_html__('Home Banner Section', 'installion'),
		'base' => 'pv_hbs',
		'category' => esc_html__('installion Elements', 'installion'),
		'params' => array(
			array(
				'type' => 'attach_image',
				'heading' => esc_html__('Banner Image', 'installion'),
				'param_name' => 'banner_img',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Banner Title', 'installion'),
				'param_name' => 'banner_title',
				'admin_label' => true
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__('Banner Content', 'installion'),
				'param_name' => 'banner_content',
				'admin_label' => true
			),
			array(
				'type' => 'vc_link',
				'heading' => esc_html__('Installer Link', 'installion'),
				'param_name' => 'installer_link',
			),
			array(
				'type' => 'vc_link',
				'heading' => esc_html__('Assistant Link', 'installion'),
				'param_name' => 'assistant_link',
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__('Appointment Image', 'installion'),
				'param_name' => 'appointment_img',
			),
			array(
				'type' => 'vc_link',
				'heading' => esc_html__('Appointment Link', 'installion'),
				'param_name' => 'appointment_link',
			),
		)
	));
}



/*============================ Home Find Installer Section ========================== */

add_action('vc_before_init', 'hfis_sec_integrateWithVC');

function hfis_sec_integrateWithVC()
{
	add_shortcode('hfis_sec', 'hfis_sec_func');

	function hfis_sec_func($atts, $content = null)
	{

		extract(shortcode_atts(array(
			'section_title' => '',
			'section_content' => '',
			'count_img1' => '',
			'register_img' => '',
			'register_title' => '',
			'register_content' => '',
			'count_img2' => '',
			'contact_img' => '',
			'contact_title' => '',
			'contact_content' => '',
			'count_img3' => '',
			'installation_img' => '',
			'installation_title' => '',
			'installation_content' => '',
			'find_link' => '',

		), $atts));

		$count_img1 = wp_get_attachment_image_src($count_img1, 'full');
		$register_img = wp_get_attachment_image_src($register_img, 'full');
		$count_img2 = wp_get_attachment_image_src($count_img2, 'full');
		$contact_img = wp_get_attachment_image_src($contact_img, 'full');
		$count_img3 = wp_get_attachment_image_src($count_img3, 'full');
		$installation_img = wp_get_attachment_image_src($installation_img, 'full');


		if ($count_img1[0] != "") {
			$countUrl1 = $count_img1[0];
		} else {
			$countUrl1 = get_template_directory_uri() . '/images/easy_icon_1.png';
		}
		if ($register_img[0] != "") {
			$registerUrl = $register_img[0];
		} else {
			$registerUrl = get_template_directory_uri() . '/images/easy_icon_1.png';
		}
		if ($count_img2[0] != "") {
			$countUrl2 = $count_img2[0];
		} else {
			$countUrl2 = get_template_directory_uri() . '/images/easy_icon_1.png';
		}
		if ($contact_img[0] != "") {
			$contactUrl = $contact_img[0];
		} else {
			$contactUrl = get_template_directory_uri() . '/images/easy_icon_2.png';
		}
		if ($count_img3[0] != "") {
			$countUrl3 = $count_img3[0];
		} else {
			$countUrl3 = get_template_directory_uri() . '/images/easy_icon_1.png';
		}
		if ($installation_img[0] != "") {
			$installationUrl = $installation_img[0];
		} else {
			$installationUrl = get_template_directory_uri() . '/images/easy_icon_3.png';
		}

		$find_link = vc_build_link($find_link);

		$pg_content .= '<div class="easy_sec">
	<div class="container">
    	<h2 class="global_title center">' . $section_title . '</h2>
        <div class="info">' . $section_content . '</div>
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="easy_block">
                    <figure><span><img src="' . $count_img1[0] . '" alt=""></span><img src="' . $register_img[0] . '" alt=""></figure>
                    <h3>' . $register_title . '</h3>
                    <p>' . $register_content . '</p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="easy_block">
                    <figure><span><img src="' . $count_img2[0] . '" alt=""></span><img src="' . $contact_img[0] . '" alt=""></figure>
                    <h3>' . $contact_title . '</h3>
                    <p>' . $contact_content . '</p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="easy_block easy_block3">
                    <figure><span><img src="' . $count_img3[0] . '" alt=""></span><img src="' . $installation_img[0] . '" alt=""></figure>
                    <h3>' . $installation_title . '</h3>
                    <p>' . $installation_content . '</p>
                </div>
            </div>
            <div class="col-12">
            	<a href="' . $find_link['url'] . '" class="btn_links">' . $find_link['title'] . '</a>
            </div>
        </div>
    </div>
</div>
        
        ';



		return $pg_content;
	}



	vc_map(array(

		'name' => esc_html__('Find Installer Section', 'installion'),
		'base' => 'hfis_sec',
		'category' => esc_html__('installion Elements', 'installion'),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Section Title', 'installion'),
				'param_name' => 'section_title',
				'admin_label' => true
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__('Section Content', 'installion'),
				'param_name' => 'section_content',
				'admin_label' => true
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__('Count Image 1', 'installion'),
				'param_name' => 'count_img1',
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__('Register Image', 'installion'),
				'param_name' => 'register_img',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Register Title', 'installion'),
				'param_name' => 'register_title',
				'admin_label' => true
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__('Register Content', 'installion'),
				'param_name' => 'register_content',
				'admin_label' => true
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__('Count Image 2', 'installion'),
				'param_name' => 'count_img2',
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__('Contact Image', 'installion'),
				'param_name' => 'contact_img',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Contact Title', 'installion'),
				'param_name' => 'contact_title',
				'admin_label' => true
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__('Contact Content', 'installion'),
				'param_name' => 'contact_content',
				'admin_label' => true
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__('Count Image 3', 'installion'),
				'param_name' => 'count_img3',
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__('Installation Image', 'installion'),
				'param_name' => 'installation_img',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Installation Title', 'installion'),
				'param_name' => 'installation_title',
				'admin_label' => true
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__('Installation Content', 'installion'),
				'param_name' => 'installation_content',
				'admin_label' => true
			),
			array(
				'type' => 'vc_link',
				'heading' => esc_html__('Find Link', 'installion'),
				'param_name' => 'find_link',
			),
		)
	));
}




/*============================ Home Our Vision Section ========================== */

add_action('vc_before_init', 'hovs_sec_integrateWithVC');

function hovs_sec_integrateWithVC()
{
	add_shortcode('hovs_sec', 'hovs_sec_func');

	function hovs_sec_func($atts, $content = null)
	{

		extract(shortcode_atts(array(
			'section_title' => '',
			'section_content' => '',
			'learn_more_link' => '',
			'background_img' => '',

		), $atts));

		$background_img = wp_get_attachment_image_src($background_img, 'full');


		if ($background_img[0] != "") {

			$back_img = 'background: url(' . $background_img[0] . ') no-repeat center center;background-size: cover;';
		} else {
			$back_img = '';
		}
		$learn_more_link = vc_build_link($learn_more_link);

		$pg_content .= '<div class="vision_sec">
	<div class="container">
    	<div class="inner" style="' . $back_img . '">
        	<div class="v_caption">
            	<h2 class="global_title">' . $section_title . '</h2>
                <p>' . $section_content . '</p>';
		if ($learn_more_link['url'] != '') {
			$pg_content .= '<a href="' . $learn_more_link['url'] . '" class="more_link">' . $learn_more_link['title'] . '</a>';;
		}
		$pg_content .= '
            </div>
        </div>
    </div>
</div>';



		return $pg_content;
	}



	vc_map(array(

		'name' => esc_html__('Our Vision Section', 'installion'),
		'base' => 'hovs_sec',
		'category' => esc_html__('installion Elements', 'installion'),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Section Title', 'installion'),
				'param_name' => 'section_title',
				'admin_label' => true
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__('Section Content', 'installion'),
				'param_name' => 'section_content',
				'admin_label' => true
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__('Background Image', 'installion'),
				'param_name' => 'background_img',
			),
			array(
				'type' => 'vc_link',
				'heading' => esc_html__('Learn More Link', 'installion'),
				'param_name' => 'learn_more_link',
			),
		)
	));
}


/*============================ Home Partner Section ========================== */

add_action('vc_before_init', 'hps_sec_integrateWithVC');

function hps_sec_integrateWithVC()
{
	add_shortcode('hps_sec', 'hps_sec_func');

	function hps_sec_func($atts, $content = null)
	{

		extract(shortcode_atts(array(
			'section_title' => '',
			'partner_block' => '',

		), $atts));

		$partner_block = (array) vc_param_group_parse_atts($partner_block);


		$pg_content .= '
		<div class="partner_sec">
	<div class="container">
    	<ul>
        	<li><h3>' . $section_title . '<i><img src="' . get_template_directory_uri() . '/images/partner_arrow.png" alt=""></i></h3></li>
            ';

		foreach ($partner_block as $key => $val) {
			$page_link = vc_build_link($val['page_link']);
			$logo_img = wp_get_attachment_image_src($val['logo_img'], 'full');


			$pg_content .= '<li><figure><a href="' . $page_link['url'] . '" target="' . $page_link['target'] . '"><img src="' . $logo_img[0] . '" alt=""></a></figure></li>
 ';
		}

		$pg_content .= '
			
            
        </ul>
    </div>
</div>
		';



		return $pg_content;
	}



	vc_map(array(

		'name' => esc_html__('Home Partner Section', 'installion'),
		'base' => 'hps_sec',
		'category' => esc_html__('installion Elements', 'installion'),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Section Title', 'installion'),
				'param_name' => 'section_title',
				'admin_label' => true
			),
			array(
				'type' => 'param_group',
				'heading' => esc_html__('Partner Blocks', 'installion'),
				'param_name' => 'partner_block',
				'params' => array(
					array(
						'type' => 'attach_image',
						'heading' => esc_html__('Logo Image', 'installion'),
						'param_name' => 'logo_img',
					),
					array(
						'type' => 'vc_link',
						'heading' => esc_html__('Page Link', 'installion'),
						'param_name' => 'page_link',
					),
				),
			),
		)
	));
}



/*============================ Home More About Section ========================== */

add_action('vc_before_init', 'hmas_sec_integrateWithVC');

function hmas_sec_integrateWithVC()
{
	add_shortcode('hmas_sec', 'hmas_sec_func');

	function hmas_sec_func($atts, $content = null)
	{

		extract(shortcode_atts(array(
			'section_title' => '',
			'section_content' => '',
			'time_img' => '',
			'time_content' => '',
			'network_img' => '',
			'network_content' => '',
			'graph_img' => '',
			'graph_content' => '',

		), $atts));

		$time_img = wp_get_attachment_image_src($time_img, 'full');
		$network_img = wp_get_attachment_image_src($network_img, 'full');
		$graph_img = wp_get_attachment_image_src($graph_img, 'full');

		if ($time_img[0] != "") {
			$timeUrl = $time_img[0];
		} else {
			$timeUrl = get_template_directory_uri() . '/images/disting_image_1.png';
		}
		if ($network_img[0] != "") {
			$networkUrl = $network_img[0];
		} else {
			$networkUrl = get_template_directory_uri() . '/images/disting_image_2.png';
		}
		if ($graph_img[0] != "") {
			$graphUrl = $graph_img[0];
		} else {
			$graphUrl = get_template_directory_uri() . '/images/disting_image_3.png';
		}



		$pg_content .= '<div class="disting_sec">
	<div class="container">
    	<h2 class="global_title white">' . $section_title . '</h2>
        <div class="info">' . $section_content . '</div>
        <div class="row">
        	<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
            	<div class="disting_block">
                	<figure><img src="' . $time_img[0] . '" alt=""></figure>
                    <p>' . $time_content . '</p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
            	<div class="disting_block">
                	<figure><img src="' . $network_img[0] . '" alt=""></figure>
                    <p>' . $network_content . '</p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
            	<div class="disting_block">
                	<figure><img src="' . $graph_img[0] . '" alt=""></figure>
                    <p>' . $graph_content . '</p>
                </div>
            </div>
        </div>
    </div>
</div>

        ';



		return $pg_content;
	}



	vc_map(array(

		'name' => esc_html__('More About Section', 'installion'),
		'base' => 'hmas_sec',
		'category' => esc_html__('installion Elements', 'installion'),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Section Title', 'installion'),
				'param_name' => 'section_title',
				'admin_label' => true
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__('Section Content', 'installion'),
				'param_name' => 'section_content',
				'admin_label' => true
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__('Time Image', 'installion'),
				'param_name' => 'time_img',
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__('Time Content', 'installion'),
				'param_name' => 'time_content',
				'admin_label' => true
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__('Network Image', 'installion'),
				'param_name' => 'network_img',
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__('Network Content', 'installion'),
				'param_name' => 'network_content',
				'admin_label' => true
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__('Graph Image', 'installion'),
				'param_name' => 'graph_img',
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__('Graph Content', 'installion'),
				'param_name' => 'graph_content',
				'admin_label' => true
			),
		)
	));
}




/*============================ Home Information about installion Section ========================== */

add_action('vc_before_init', 'hiais_sec_integrateWithVC');

function hiais_sec_integrateWithVC()
{
	add_shortcode('hiais_sec', 'hiais_sec_func');

	function hiais_sec_func($atts, $content = null)
	{

		extract(shortcode_atts(array(
			'section_title' => '',
			'information_block' => '',
			'learn_more_link' => '',

		), $atts));

		$information_block = (array) vc_param_group_parse_atts($information_block);
		$learn_more_link = vc_build_link($learn_more_link);

		$pg_content .= '<div class="installion_sec">
	<div class="container">
    	<h2 class="global_title center">' . $section_title . '</h2>
    	<div class="install_slider">
		
        	<div class="owl-carousel installionslider">
			';

		foreach ($information_block as $key => $val) {
			$info_link = vc_build_link($val['info_link']);
			$back_img = wp_get_attachment_image_src($val['back_img'], 'full');


			$pg_content .= '
			   <div class="item">
                	<div class="block">
                    	<figure><img src="' . $back_img[0] . '" alt=""></figure>
                        <div class="inst_cap">
                        	<h3><a href="' . $info_link['url'] . '">' . $val['info_title'] . '</a></h3>
                            <p>' . $val['info_subtitle'] . '</p>
                            <a href="' . $info_link['url'] . '" class="arrow_link"><i class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
 ';
		}

		$pg_content .= '
            </div>
        </div>
        <div class="w-100 text-center">
        	<a href="' . $learn_more_link['url'] . '" class="btn_links">' . $learn_more_link['title'] . '</a>
        </div>
    </div>
</div>



		';



		return $pg_content;
	}



	vc_map(array(
		'name' => esc_html__('Home Information about installion Section', 'installion'),
		'base' => 'hiais_sec',
		'category' => esc_html__('installion Elements', 'installion'),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Section Title', 'installion'),
				'param_name' => 'section_title',
				'admin_label' => true
			),
			array(
				'type' => 'param_group',
				'heading' => esc_html__('Information Blocks', 'installion'),
				'param_name' => 'information_block',
				'params' => array(
					array(
						'type' => 'attach_image',
						'heading' => esc_html__('Background Image', 'installion'),
						'param_name' => 'back_img',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__('Title', 'installion'),
						'param_name' => 'info_title',
						'admin_label' => true
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__('Sub Title', 'installion'),
						'param_name' => 'info_subtitle',
						'admin_label' => true
					),
					array(
						'type' => 'vc_link',
						'heading' => esc_html__('Info Link', 'installion'),
						'param_name' => 'info_link',
					),
				),
			),
			array(
				'type' => 'vc_link',
				'heading' => esc_html__('Learn More Link', 'installion'),
				'param_name' => 'learn_more_link',
			),
		)
	));
}



/*============================ Home Installer Opinion Section ========================== */

add_action('vc_before_init', 'hios_sec_integrateWithVC');

function hios_sec_integrateWithVC()
{
	add_shortcode('hios_sec', 'hios_sec_func');

	function hios_sec_func($atts, $content = null)
	{

		extract(shortcode_atts(array(
			'section_title' => '',
			'opinion_block' => '',


		), $atts));

		$opinion_block = (array) vc_param_group_parse_atts($opinion_block);

		$pg_content .= '<div class="opinion_sec">
	<div class="container">
    	<h2 class="global_title center">' . $section_title . '</h2>
        <div class="testimonial_slider">
        	<div class="owl-carousel testimonialslider">
			';
		$storyCount = 1;
		foreach ($opinion_block as $key => $val) {

			if ($storyCount % 2 == 0) {
				$opinin2 = 'opinin2';
			} else {
				$opinin2 = '';
			}


			$pg_content .= '<div class="item">
                	<div class="opinin ' . $opinin2 . '">
	                	<i><img src="' . get_template_directory_uri() . '/images/quote_icon.png" alt=""></i>
                        <p>' . $val['client_opinion'] . '</p>
                        <h3>' . $val['client_name'] . '</h3>
                        <span>' . $val['about_client'] . '</span>
                    </div>
                </div>
 ';

			$storyCount++;
		}

		$pg_content .= '
		   
            	
            </div>
        </div>
    </div>
</div>';

		return $pg_content;
	}



	vc_map(array(
		'name' => esc_html__('Installer Opinion Section', 'installion'),
		'base' => 'hios_sec',
		'category' => esc_html__('installion Elements', 'installion'),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Section Title', 'installion'),
				'param_name' => 'section_title',
				'admin_label' => true
			),

			array(
				'type' => 'param_group',
				'heading' => esc_html__('Opinion Block', 'installion'),
				'param_name' => 'opinion_block',
				'params' => array(
					array(

						'type' => 'textfield',
						'heading' => esc_html__('Client Name', 'installion'),
						'param_name' => 'client_name',
						'admin_label' => true
					),
					array(

						'type' => 'textfield',
						'heading' => esc_html__('About Client', 'installion'),
						'param_name' => 'about_client',
						'admin_label' => true
					),
					array(
						'type' => 'textarea',
						'heading' => esc_html__('Client Opinion', 'installion'),
						'param_name' => 'client_opinion',
						'admin_label' => true
					),
				),
			),
		)
	));
}



/*============================ Map with Contact Form Section ========================== */

add_action('vc_before_init', 'mwcfs_sec_integrateWithVC');

function mwcfs_sec_integrateWithVC()
{
	add_shortcode('mwcfs_sec', 'mwcfs_sec_func');

	function mwcfs_sec_func($atts, $content = null)
	{
		extract(shortcode_atts(array(
			'contact_title' => '',
			'contact_subtitle' => '',
			'contact_code' => '',
			'google_map' => '',
			'contact_address' => '',
			'telephone' => '',
			'contact_email' => '',
			'top_content' => '',

		), $atts));


		$pg_content .= '<div class="map_info">
	<div><iframe src="' . $google_map . '" width="100%" height="680" frameborder="0" style="border:0;"  aria-hidden="false" tabindex="0"></iframe><div>
    <div class="map_cap">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
				
                    <div class="add_info">
					<p>' . $top_content . '</p>
                       ';
		if ($contact_address != '') {
			$pg_content .= '<div class="add_block"><img src="' . get_template_directory_uri() . '/images/add_icon_1.png" alt="">' . $contact_address . '</div>';
		}
		if ($telephone != '') {
			$pg_content .= '<div class="add_block"><img src="' . get_template_directory_uri() . '/images/add_icon_2.png" alt="">Telefon<br><a href="tel:' . $telephone . '">' . $telephone . '</a></div>';
		}
		if ($contact_email != '') {
			$pg_content .= '<div class="add_block"><img src="' . get_template_directory_uri() . '/images/add_icon_3.png" alt="">Email <br><a href="mailto:' . $contact_email . '">' . $contact_email . '</a></div>';
		}
		$pg_content .= '      
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                	<div class="ques_form">
                    	<h2 class="global_title">' . $contact_title . '</h2>
                        <h3>' . $contact_subtitle . '</h3>
                        ' . do_shortcode('[contact-form-7 id="' . $contact_code . '" title="Contact Form"]') . '
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>';
		return $pg_content;
	}

	vc_map(array(
		'name' => esc_html__('Map With Contact Form Section', 'installion'),
		'base' => 'mwcfs_sec',
		'category' => esc_html__('installion Elements', 'installion'),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Contact Form Title', 'installion'),
				'param_name' => 'contact_title',
				'admin_label' => true
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Contact Form SubTitle', 'installion'),
				'param_name' => 'contact_subtitle',
				'admin_label' => true
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Contact Form ID', 'installion'),
				'param_name' => 'contact_code',
				'admin_label' => true
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__('Map Iframe Source', 'installion'),
				'param_name' => 'google_map',
				'admin_label' => true
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__('Contact Address', 'installion'),
				'param_name' => 'contact_address',
				'admin_label' => true
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Telephone', 'installion'),
				'param_name' => 'telephone',
				'admin_label' => true
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Contact Email', 'installion'),
				'param_name' => 'contact_email',
				'admin_label' => true
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__('Additional Top Content', 'installion'),
				'param_name' => 'top_content',
				'admin_label' => true
			),

		)
	));
}



/*============================ Career Banner Section ========================== */

add_action('vc_before_init', 'pv_cbs_integrateWithVC');

function pv_cbs_integrateWithVC()
{

	add_shortcode('pv_cbs', 'pv_cbs_func');

	function pv_cbs_func($atts, $content = null)

	{

		extract(shortcode_atts(array(

			'banner_img' => '',
			'banner_title' => '',

		), $atts));

		$back_img = wp_get_attachment_image_src($back_img, 'full');

		if ($background_img[0] != "") {

			$back_img = 'background: url(' . $background_img[0] . ') no-repeat center center;background-size: cover;';
		} else {
			$back_img = '';
		}

		$pg_content .= '
        <div class="inner_banner">
    <div class="container">
        <h1>' . $banner_title . '</h1>
    </div>
</div>

';

		return $pg_content;
	}



	vc_map(array(
		'name' => esc_html__('Career Banner Section', 'installion'),
		'base' => 'pv_cbs',
		'category' => esc_html__('installion Elements', 'installion'),
		'params' => array(
			array(
				'type' => 'attach_image',
				'heading' => esc_html__('Banner Image', 'installion'),
				'param_name' => 'banner_img',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Banner Title', 'installion'),
				'param_name' => 'banner_title',
				'admin_label' => true
			),
		)
	));
}



/*============================ Box with Right Side Image ========================== */

add_action('vc_before_init', 'bwrsi_sec_integrateWithVC');

function bwrsi_sec_integrateWithVC()
{
	add_shortcode('bwrsi_sec', 'bwrsi_sec_func');

	function bwrsi_sec_func($atts, $content = null)
	{

		extract(shortcode_atts(array(
			'section_title' => '',
			'section_content' => '',
			'button_link' => '',
			'right_img' => '',

		), $atts));

		$right_img = wp_get_attachment_image_src($right_img, 'full');



		$button_link = vc_build_link($button_link);

		$pg_content .= '<div class="career_sec">
	<div class="container">
    	<div class="row">
        	<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 align-self-center">
            	<div class="detail">
                	<h2 class="global_title">' . $section_title . '</h2>
                    <p>' . $section_content . '</p>
                    ';
		if ($button_link['url'] != '') {
			$pg_content .= '<a href="' . $button_link['url'] . '" class="btn_links">' . $button_link['title'] . '</a>';;
		}
		$pg_content .= '
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 align-self-center">
            	<figure><img src="' . $right_img[0] . '" alt=""></figure>
            </div>
        </div>
    </div>
</div>';



		return $pg_content;
	}



	vc_map(array(
		'name' => esc_html__('Box With Right side Image', 'installion'),
		'base' => 'bwrsi_sec',
		'category' => esc_html__('installion Elements', 'installion'),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Section Title', 'installion'),
				'param_name' => 'section_title',
				'admin_label' => true
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__('Section Content', 'installion'),
				'param_name' => 'section_content',
				'admin_label' => true
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__('Right Image', 'installion'),
				'param_name' => 'right_img',
			),
			array(
				'type' => 'vc_link',
				'heading' => esc_html__('Button Link', 'installion'),
				'param_name' => 'button_link',
			),
		)
	));
}



/*============================ Vacancies FAQ Section ========================== */

add_action('vc_before_init', 'vfs_sec_integrateWithVC');

function vfs_sec_integrateWithVC()
{
	add_shortcode('vfs_sec', 'vfs_sec_func');

	function vfs_sec_func($atts, $content = null)
	{

		extract(shortcode_atts(array(
			'section_title' => '',
			'faq_block' => '',


		), $atts));

		$faq_block = (array) vc_param_group_parse_atts($faq_block);

		$pg_content .= '<div class="vacancies_sec" id="vacancies_sec">
	<div class="container">
    	<h2 class="global_title center mb-5">' . $section_title . '</h2>
        <div class="accordion" id="accordionExample">
		';
		$faqCount = 1;
		foreach ($faq_block as $key => $val) {
			$button_link = vc_build_link($val['button_link']);
			if ($faqCount == 1) {
				$show = 'show';
				$collapsed = '';
				$expanded = 'true';
			} else {
				$show = '';
				$collapsed = 'collapsed';
				$expanded = '';
			}

			if ($button_link['url'] != '') {
				$btnurl = '<a href="' . $button_link['url'] . '" class="btn_links">' . $button_link['title'] . '</a>';
			} else {
				$btnurl = '';
			}
			$pg_content .= ' <div class="card">
            <div class="card-header" id="heading' . $faqCount . '">
              <h2 class="mb-0">
                <button class="btn btn-link ' . $collapsed . '" type="button" data-toggle="collapse" data-target="#collapse' . $faqCount . '" aria-expanded="' . $expanded . '" aria-controls="collapse' . $faqCount . '">' . $val['faq_title'] . '</button>
              </h2>
            </div>
            <div id="collapse' . $faqCount . '" class="collapse ' . $show . '" aria-labelledby="heading' . $faqCount . '" data-parent="#accordionExample">
              <div class="card-body">
                <div class="row">
                	<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    	<h3>' . $val['offer_title'] . '</h3>
                       ' . $val['offer_content'] . '
                        
                        <h3>' . $val['task_title'] . '</h3>
                        ' . $val['task_content'] . '
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                    	<h3>' . $val['profile_title'] . '</h3>
                        ' . $val['profile_content'] . '
                    </div>
                </div>
                ' . $btnurl . '
              </div>
            </div>
          </div>
 ';

			$faqCount++;
		}

		$pg_content .= '
        </div>
    </div>
</div>';



		return $pg_content;
	}



	vc_map(array(
		'name' => esc_html__('Vacancies FAQ Section', 'installion'),
		'base' => 'vfs_sec',
		'category' => esc_html__('installion Elements', 'installion'),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Section Title', 'installion'),
				'param_name' => 'section_title',
				'admin_label' => true
			),

			array(
				'type' => 'param_group',
				'heading' => esc_html__('Vacancy faq Block', 'installion'),
				'param_name' => 'faq_block',
				'params' => array(
					array(

						'type' => 'textfield',
						'heading' => esc_html__('Title', 'installion'),
						'param_name' => 'faq_title',
						'admin_label' => true
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__('We Offer you title', 'installion'),
						'param_name' => 'offer_title',
						'admin_label' => true
					),
					array(
						'type' => 'textarea',
						'heading' => esc_html__('We Offer you Content', 'installion'),
						'param_name' => 'offer_content',
						'admin_label' => true
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__('Tasks and Activities title', 'installion'),
						'param_name' => 'task_title',
						'admin_label' => true
					),
					array(
						'type' => 'textarea',
						'heading' => esc_html__('Tasks and Activities Content', 'installion'),
						'param_name' => 'task_content',
						'admin_label' => true
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__('Your profile title', 'installion'),
						'param_name' => 'profile_title',
						'admin_label' => true
					),
					array(
						'type' => 'textarea',
						'heading' => esc_html__('Your profile Content', 'installion'),
						'param_name' => 'profile_content',
						'admin_label' => true
					),
					array(
						'type' => 'vc_link',
						'heading' => esc_html__('Button Link', 'installion'),
						'param_name' => 'button_link',
					),

				),
			),

		)
	));
}


/*============================ Assembly Assistant Banner Section ========================== */

add_action('vc_before_init', 'pv_aabs_integrateWithVC');

function pv_aabs_integrateWithVC()
{

	add_shortcode('pv_aabs', 'pv_aabs_func');

	function pv_aabs_func($atts, $content = null)

	{

		extract(shortcode_atts(array(

			'banner_img' => '',
			'banner_title' => '',

		), $atts));

		$back_img = wp_get_attachment_image_src($back_img, 'full');

		if ($background_img[0] != "") {

			$back_img = 'background: url(' . $background_img[0] . ') no-repeat center center;background-size: cover;';
		} else {
			$back_img = '';
		}

		$pg_content .= '
        <div class="inner_banner assembly_banner">
    <div class="container">
        <h1>' . $banner_title . '</h1>
    </div>
</div>

';

		return $pg_content;
	}



	vc_map(array(
		'name' => esc_html__('Assembly Assistant Banner Section', 'installion'),
		'base' => 'pv_aabs',
		'category' => esc_html__('installion Elements', 'installion'),
		'params' => array(
			array(
				'type' => 'attach_image',
				'heading' => esc_html__('Banner Image', 'installion'),
				'param_name' => 'banner_img',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Banner Title', 'installion'),
				'param_name' => 'banner_title',
				'admin_label' => true
			),
		)
	));
}


/*============================  Become Assembly Assistant Section ========================== */

add_action('vc_before_init', 'baas_sec_integrateWithVC');

function baas_sec_integrateWithVC()
{
	add_shortcode('baas_sec', 'baas_sec_func');

	function baas_sec_func($atts, $content = null)
	{

		extract(shortcode_atts(array(
			'skill_img' => '',
			'skill_title' => '',
			'skill_content' => '',
			'place_img' => '',
			'place_title' => '',
			'place_content' => '',
			'employment_img' => '',
			'employment_title' => '',
			'employment_content' => '',
			'assistant_link' => '',

		), $atts));

		$skill_img = wp_get_attachment_image_src($skill_img, 'full');
		$place_img = wp_get_attachment_image_src($place_img, 'full');
		$employment_img = wp_get_attachment_image_src($employment_img, 'full');


		if ($skill_img[0] != "") {
			$skillUrl = $skill_img[0];
		} else {
			$skillUrl = get_template_directory_uri() . '/images/advantage_icon_1.png';
		}
		if ($place_img[0] != "") {
			$placeUrl = $place_img[0];
		} else {
			$placeUrl = get_template_directory_uri() . '/images/advantage_icon_2.png';
		}
		if ($employment_img[0] != "") {
			$employmentUrl = $employment_img[0];
		} else {
			$employmentUrl = get_template_directory_uri() . '/images/advantage_icon_3.png';
		}

		$assistant_link = vc_build_link($assistant_link);

		$pg_content .= '<div class="easy_sec advntg_sec">
	<div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="easy_block">
                    <i><img src="' . $skill_img[0] . '" alt=""></i>
                    <h3>' . $skill_title . '</h3>
                    <p>' . $skill_content . '</p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="easy_block">
                    <i><img src="' . $place_img[0] . '" alt=""></i>
                    <h3>' . $place_title . '</h3>
                    <p>' . $place_content . '</p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                <div class="easy_block">
                    <i><img src="' . $employment_img[0] . '" alt=""></i>
                    <h3>' . $employment_title . '</h3>
                    <p>' . $employment_content . '</p>
                </div>
            </div>
            <div class="col-12">
            	<a href="' . $assistant_link['url'] . '" class="btn_links">' . $assistant_link['title'] . '</a>
            </div>
        </div>
    </div>
</div>
        
        ';



		return $pg_content;
	}



	vc_map(array(

		'name' => esc_html__('Become Assembly Assistant Section', 'installion'),
		'base' => 'baas_sec',
		'category' => esc_html__('installion Elements', 'installion'),
		'params' => array(
			array(
				'type' => 'attach_image',
				'heading' => esc_html__('Skill Image', 'installion'),
				'param_name' => 'skill_img',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Skill Title', 'installion'),
				'param_name' => 'skill_title',
				'admin_label' => true
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__('Skill Content', 'installion'),
				'param_name' => 'skill_content',
				'admin_label' => true
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__('Place Image', 'installion'),
				'param_name' => 'place_img',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Place Title', 'installion'),
				'param_name' => 'place_title',
				'admin_label' => true
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__('Place Content', 'installion'),
				'param_name' => 'place_content',
				'admin_label' => true
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__('Employment Image', 'installion'),
				'param_name' => 'employment_img',
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Employment Title', 'installion'),
				'param_name' => 'employment_title',
				'admin_label' => true
			),
			array(
				'type' => 'textarea',
				'heading' => esc_html__('Employment Content', 'installion'),
				'param_name' => 'employment_content',
				'admin_label' => true
			),
			array(
				'type' => 'vc_link',
				'heading' => esc_html__('Assistant Link', 'installion'),
				'param_name' => 'assistant_link',
			),
		)
	));
}

/*============================ For You Section ========================== */

add_action('vc_before_init', 'pv_fys_integrateWithVC');

function pv_fys_integrateWithVC()
{

	add_shortcode('pv_fys', 'pv_fys_func');

	function pv_fys_func($atts, $content = null)

	{

		extract(shortcode_atts(array(

			'section_title' => '',
			'development_title' => '',
			'development_content' => '',
			'notice_title' => '',
			'notice_content' => '',
			'support_title' => '',
			'support_content' => '',

		), $atts));


		$pg_content .= '
        <div class="das_sec">
	<div class="container">
    	<h2 class="global_title center mb-5">' . $section_title . '</h2>
    	<div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
            	<div class="das das1">
                	<h3>' . $development_title . '</h3>
                    <p>' . $development_content . '</p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
            	<div class="das das2">
                	<h3>' . $notice_title . '</h3>
                    <p>' . $notice_content . '</p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
            	<div class="das das3">
                	<h3>' . $support_title . '</h3>
                    <p>' . $support_content . '</p>
                </div>
            </div>
        </div>
    </div>
</div>


';

		return $pg_content;
	}



	vc_map(array(
		'name' => esc_html__('For You Section', 'installion'),
		'base' => 'pv_fys',
		'category' => esc_html__('installion Elements', 'installion'),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Section Title', 'installion'),
				'param_name' => 'section_title',
				'admin_label' => true
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Development Title', 'installion'),
				'param_name' => 'development_title',
				'admin_label' => true
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Development Content', 'installion'),
				'param_name' => 'development_content',
				'admin_label' => true
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Notice Title', 'installion'),
				'param_name' => 'notice_title',
				'admin_label' => true
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Notice Content', 'installion'),
				'param_name' => 'notice_content',
				'admin_label' => true
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Support Title', 'installion'),
				'param_name' => 'support_title',
				'admin_label' => true
			),
			array(
				'type' => 'textfield',
				'heading' => esc_html__('Support Content', 'installion'),
				'param_name' => 'support_content',
				'admin_label' => true
			),
		)
	));
}


// Prevent TinyMCE from stripping out html
function schema_TinyMCE_init($in)
{
	/**
	 *   Edit extended_valid_elements as needed. For syntax, see
	 *   http://www.tinymce.com/wiki.php/Configuration:valid_elements
	 *
	 *   NOTE: Adding an element to extended_valid_elements will cause TinyMCE to ignore
	 *   default attributes for that element.
	 *   Eg. a[title] would remove href unless included in new rule: a[title|href]
	 */
	if (!empty($in['extended_valid_elements']))
		$in['extended_valid_elements'] .= ',';

	$in['extended_valid_elements'] .= '@[id|class|style|title|itemscope|itemtype|itemprop|datetime|rel],div,dl,ul,ol,dt,dd,li,span,a|rev|charset|href|lang|tabindex|accesskey|type|name|href|target|title|class|onfocus|onblur]';

	return $in;
}
add_filter('tiny_mce_before_init', 'schema_TinyMCE_init');




// stop wp removing div tags
function uncoverwp_tiny_mce_fix($init)
{
	// html elements being stripped
	$init['extended_valid_elements'] = 'div[*], article[*]';

	// don't remove line breaks
	$init['remove_linebreaks'] = false;

	// convert newline characters to BR
	$init['convert_newlines_to_brs'] = true;

	// don't remove redundant BR
	$init['remove_redundant_brs'] = false;

	// pass back to wordpress
	return $init;
}
add_filter('tiny_mce_before_init', 'uncoverwp_tiny_mce_fix');



function override_mce_options($initArray)
{
	$opts = '*[*]';
	$initArray['valid_elements'] = $opts;
	$initArray['extended_valid_elements'] = $opts;
	return $initArray;
}
add_filter('tiny_mce_before_init', 'override_mce_options');

function wpse15850_body_class($wp_classes, $extra_classes)
{

	// List of the only WP generated classes that are not allowed
	$blacklist = array('blog');

	// Filter the body classes
	// Whitelist result: (comment if you want to blacklist classes)
	// $wp_classes = array_intersect($wp_classes, $whitelist);
	// Blacklist result: (uncomment if you want to blacklist classes)
	$wp_classes = array_diff($wp_classes, $blacklist);

	// Add the extra classes back untouched
	return array_merge($wp_classes, (array) $extra_classes);
}
add_filter('body_class', 'wpse15850_body_class', 10, 2);


/*Custom Post type start*/
// function installion_post_type()
// {
//     $labels = array(
//         'name' => 'Installion',
//         'singular_name' => 'Installion',
//         'add_new' => 'Add Ins_Item',
//         'add_new_item' => 'Add Ins_Item',
//         'new_item' => 'New Ins_Item',
//         'edit_item' => 'Edit Ins_Item',
//         'view_item' => 'View Ins_Item',
//         'all_items' => 'All Ins_Items',
//         'search_items' => 'Search Ins_Item',
//         'not_found' => 'No Ins_Items found',
//         'not_found_in_trash' => 'No Ins_Items found in trash',
//         'parent_item_colon' => 'Parent Ins_Item'
//     );
//     $args = array(
//         'labels' => $labels,
//         'public' => true,
//         'has_archive' => true,
//         'query_var' => true,
//         'rewrite' => true,
//         'capability_type' => 'post',
//         'hierarchical' => false,
//         'supports' => array(
//             'title',
//             'editor',
//             'excerpt',
//             'thumbnail',
//             'revisions',
//         ),
//         'taxonomies' => array('category', 'post_tag'),
//         'menu_position' => 4,
//         'exclude_from_search' => false
//     );
//     register_post_type('installion', $args);
// }
// add_action('init', 'installion_post_type');
// /*Custom Post type end*/