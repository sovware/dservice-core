<?php
use \Directorist\Directorist_Listing_Search_Form;
use Directorist\Helper;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes;
use Elementor\Repeater;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}

//Heading Pro
class dservice_Heading extends Widget_Base
{

    public function get_name()
    {
        return 'heading_pro section-title';
    }

    public function get_title()
    {
        return __('Heading Pro', 'dservice-core');
    }

    public function get_icon()
    {
        return 'eicon-t-letter';
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    public function get_keywords()
    {
        return ['heading', 'pro', 'Heading Pro'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'heading_pro',
            [
                'label' => __('Title & Subtitle', 'dservice-core'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'dservice-core'),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __('Enter your title', 'dservice-core'),
                'default' => __('Add Your Heading Text Here', 'dservice-core'),
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __('Link', 'dservice-core'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'header_size',
            [
                'label' => __('HTML Tag', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h3',
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => __('Subtitle', 'dservice-core'),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __('Enter your subtitle', 'dservice-core'),
                'default' => __('Add Your subtitle Text Here', 'dservice-core'),
            ]
        );

        $this->add_control(
            'align',
            [
                'label' => __('Alignment', 'dservice-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'dservice-core'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'dservice-core'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'dservice-core'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justified', 'dservice-core'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __('Styling', 'dservice-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Title  Color', 'dservice-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_2,
                ],
                'selectors' => [
                    '{{WRAPPER}} h1, {{WRAPPER}} h2, {{WRAPPER}} h3, {{WRAPPER}} h4, {{WRAPPER}} h5, {{WRAPPER}} h6' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => __('Subtitle  Color', 'dservice-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_3,
                ],
                'selectors' => [
                    '{{WRAPPER}} p' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $title = $settings['title'];
        $subtitle = $settings['subtitle'] ? '<p>' . $settings['subtitle'] . '</p>' : '';
        $header = $settings['header_size'];
        $link = $settings['link']['url'];
        $target = $settings['link']['is_external'] ? ' target="_blank"' : '';
        $nofollow = $settings['link']['nofollow'] ? 'rel="nofollow"' : '';
        $title_attr = $settings['link']['custom_attributes'];

        if ($link) {
            $title = sprintf('<a href="%s" %s %s title="%s" >%s</a>', $link, $target, $nofollow, $title_attr, $title);
        }

        echo sprintf('<%1$s> %2$s </%1$s> %3$s', $header, $title, $subtitle);
    }
}

//Accordion
class dservice_Accordion extends Widget_Base
{

    public function get_name()
    {
        return 'accordion';
    }

    public function get_title()
    {
        return __('Faq', 'dservice-core');
    }

    public function get_icon()
    {
        return 'eicon-accordion';
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    public function get_keywords()
    {
        return ['accordion', 'tabs', 'faq'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_title',
            [
                'label' => __('Faq', 'dservice-core'),
            ]
        );

        $this->add_control(
            'element_title',
            [
                'label' => __('Element title', 'dservice-core'),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __('Enter element title', 'dservice-core'),
                'default' => __("Listing FAQ's", 'dservice-core'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tab_title',
            [
                'label' => __('Title & Content', 'dservice-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Accordion Title', 'dservice-core'),
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tab_content',
            [
                'label' => __('Content', 'dservice-core'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Accordion Content', 'dservice-core'),
                'show_label' => false,
            ]
        );

        $this->add_control(
            'tabs',
            [
                'label' => __('Accordion Items', 'dservice-core'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tab_title' => __('How to open an account?', 'dservice-core'),
                        'tab_content' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'dservice-core'),
                    ],
                    [
                        'tab_title' => __('How to add listing?', 'dservice-core'),
                        'tab_content' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'dservice-core'),
                    ],
                ],
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_toggle_style_title',
            [
                'label' => __('Title', 'dservice-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Color', 'dservice-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '.atbdp-accordion .dacc_single h3 a' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_2,
                ],
            ]
        );

        $this->add_control(
            'tab_active_color',
            [
                'label' => __('Active Color', 'dservice-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '.atbdp-accordion .dacc_single h3 a.active' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_2,
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_toggle_style_content',
            [
                'label' => __('Content', 'dservice-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => __('Color', 'dservice-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '.atbdp-accordion .dacc_single .dac_body' => 'color: {{VALUE}};',
                ],
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_3,
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $accordions = $settings['tabs'];
        $section_title = $settings['element_title']; ?>
        <div class="faq-contents">
            <div class="atbd_content_module atbd_faqs_module">
                <?php if ($section_title) { ?>
                    <div class="atbd_content_module__tittle_area">
                        <div class="atbd_area_title">
                            <h4>
                                <span class="la la-question-circle"></span>
                                <?php echo esc_attr($section_title); ?>
                            </h4>
                        </div>
                    </div>
                <?php
                } ?>
                <div class="atbdb_content_module_contents">
                    <div class="atbdp-accordion dservice_accordion">
                        <?php
                        if ($accordions) {
                            foreach ($accordions as $accordion) {
                                $title = $accordion['tab_title'];
                                $desc = $accordion['tab_content']; ?>
                                <div class="dacc_single">
                                    <h3 class="faq-title">
                                        <a href="#"><?php echo esc_attr($title); ?></a>
                                    </h3>
                                    <p class="dac_body"><?php echo esc_attr($desc); ?></p>
                                </div>
                        <?php
                            }
                            wp_reset_postdata();
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
}

//Add listing form
class dservice_AddListing_Form extends Widget_Base
{
    public function get_name()
    {
        return 'add_listing_form';
    }

    public function get_title()
    {
        return __('Add Listing Form', 'dservice-core');
    }

    public function get_icon()
    {
        return 'eicon-post-excerpt';
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    public function get_keywords()
    {
        return ['Listing form', 'form', 'add listing'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'add_listing_form',
            [
                'label' => __('Styling', 'dservice-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'form_margin',
            [
                'label' => __('margin', 'dservice-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'form_padding',
            [
                'label' => __('Padding', 'dservice-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        echo do_shortcode('[directorist_add_listing]');
    }
}

//Author Profile
class dservice_Profile extends Widget_Base
{
    public function get_name()
    {
        return 'author_profile';
    }

    public function get_title()
    {
        return __('Author Profile', 'dservice-core');
    }

    public function get_icon()
    {
        return 'eicon-site-identity';
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    public function get_keywords()
    {
        return ['profile', 'author', 'author profile'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'author_profile',
            [
                'label' => __('Styling', 'dservice-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'profile_margin',
            [
                'label' => __('margin', 'dservice-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'profile_padding',
            [
                'label' => __('Padding', 'dservice-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    { ?>
        <div class="author-area">
            <?php echo do_shortcode('[directorist_author_profile]'); ?>
        </div>
        <?php
    }
}

//Blog Posts
class dservice_Blogs extends Widget_Base
{
    public function get_name()
    {
        return 'blog_posts';
    }

    public function get_title()
    {
        return __('Blogs', 'dservice-core');
    }

    public function get_icon()
    {
        return '  eicon-post';
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    public function get_keywords()
    {
        return ['blog', 'post', 'blog post'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'blog_posts',
            [
                'label' => __('Blog Posts', 'dservice-core'),
            ]
        );

        $this->add_control(
            'post_count',
            [
                'label' => __('Number of Posts to Show:', 'dservice-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'step' => 1,
                'default' => 3,
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label' => __('Order by', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'ID' => esc_html__(' Post ID', 'dservice-core'),
                    'author' => esc_html__(' Author', 'dservice-core'),
                    'title' => esc_html__(' Title', 'dservice-core'),
                    'name' => esc_html__(' Post name (post slug)', 'dservice-core'),
                    'type' => esc_html__(' Post type (available since Version 4.0)', 'dservice-core'),
                    'date' => esc_html__(' Date', 'dservice-core'),
                    'modified' => esc_html__(' Last modified date', 'dservice-core'),
                    'rand' => esc_html__(' Random order', 'dservice-core'),
                    'comment_count' => esc_html__(' Number of comments', 'dservice-core')
                ],
            ]
        );

        $this->add_control(
            'order_list',
            [
                'label' => __('Order post', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'ASC' => esc_html__(' ASC', 'dservice-core'),
                    'DESC' => esc_html__(' DESC', 'dservice-core'),
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $post_count = $settings['post_count'];
        $order_by = $settings['order_by'];
        $order_list = $settings['order_list'];

        $args = array(
            'post_type' => 'post',
            'posts_per_page' => esc_attr($post_count),
            'order' => esc_attr($order_list),
            'orderby ' => esc_attr($order_by)
        );

        $posts = new WP_Query($args); ?>
        <div class="blog-posts row" data-uk-grid>
            <?php while ($posts->have_posts()) {
                $posts->the_post(); ?>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog-posts__single">
                        <?php the_post_thumbnail('dservice_blog_grid'); ?>
                        <div class="blog-posts__single__contents">
                            <?php the_title(sprintf('<h4><a href="%s">', get_the_permalink()), '</a></h4>'); ?>
                            <ul>
                                <li><?php echo dservice_time_link(); ?></li>
                                <?php if (function_exists('dservice_post_cats')) {
                                    dservice_post_cats();
                                } ?>
                            </ul>
                            <?php the_excerpt(); ?>
                        </div>
                    </div>
                </div>
            <?php
            }
            wp_reset_postdata(); ?>
        </div>
        <?php
    }
}

//Categories
class dservice_Categories extends Widget_Base
{
    public function get_name()
    {
        return 'popular_categories';
    }

    public function get_title()
    {
        return __('All Categories', 'dservice-core');
    }

    public function get_icon()
    {
        return ' eicon-theme-builder';
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    public function get_keywords()
    {
        return ['popular categories', 'popular'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'categories',
            [
                'label' => __('Popular Listing categories', 'dservice-core'),
            ]
        );

        $this->add_control(
            'types',
            [
                'label'    => __('Specify Listing Types', 'dservice-core'),
                'type'     => Controls_Manager::SELECT2,
                'multiple' => true,
                'options'  => function_exists('directorist_listing_types') ? directorist_listing_types() : [],
                'default'  => ['general'],
                'condition' => [
                    'cat_type!' => ['style3'],
                ]
            ]
        );

        $this->add_control(
            'default_types',
            [
                'label'    => __('Set Default Listing Type', 'dservice-core'),
                'type'     => Controls_Manager::SELECT,
                'multiple' => true,
                'options'  => function_exists('directorist_listing_types') ? directorist_listing_types() : [],
                'default'  => 'general',
                'condition' => [
                    'cat_type!' => ['style3'],
                ]
            ]
        );

        $this->add_control(
            'cat_type',
            [
                'label' => __('Categories Type', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__('Default', 'dservice'),
                    'popular' => esc_html__('Popular', 'dservice'),
                ],
            ]
        );

        $this->add_control(
            'cat_style',
            [
                'label' => __('Categories Style', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'masonry',
                'options' => [
                    'masonry' => esc_html__('Masonry', 'dservice'),
                    'grid' => esc_html__('Grid', 'dservice'),
                ],
            ]
        );

        $this->add_control(
            'row',
            [
                'label' => __('Categories Per Row', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => '4',
                'options' => [
                    '6' => esc_html__('6 Items / Row', 'dlist-core'),
                    '5' => esc_html__('5 Items / Row', 'dlist-core'),
                    '4' => esc_html__('4 Items / Row', 'dlist-core'),
                    '3' => esc_html__('3 Items / Row', 'dlist-core'),
                    '2' => esc_html__('2 Items / Row', 'dlist-core'),
                ],
                'condition' => [
                    'cat_style' => 'grid',
                ],
            ]
        );

        $this->add_control(
            'number_cat',
            [
                'label' => __('Number of categories to Show:', 'dservice-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000,
                'step' => 1,
                'default' => 3,
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label'   => esc_html__('Order by', 'dservice-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'id',
                'options' => [
                    'id'    => esc_html__(' Cat ID', 'dservice-core'),
                    'count' => esc_html__('Listing Count', 'dservice-core'),
                    'name'  => esc_html__('Category name (A-Z)', 'dservice-core'),
                    'slug'  => esc_html__('Select Category', 'dservice-core'),
                ],
            ]
        );

        $this->add_control(
            'slug',
            [
                'label'     => esc_html__('Select Categories', 'dservice-core'),
                'type'      => Controls_Manager::SELECT2,
                'multiple'  => true,
                'options'   => function_exists('dservice_listing_category') ? dservice_listing_category() : [],
                'condition' => [
                    'order_by' => 'slug'
                ]
            ]
        );

        $this->add_control(
            'order_list',
            [
                'label'   => esc_html__('Categories Order', 'dservice-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => array(
                    'asc'  => esc_html__(' ASC', 'dservice-core'),
                    'desc' => esc_html__(' DESC', 'dservice-core'),
                ),
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {

        $settings = $this->get_settings_for_display();
        $order_by   = $settings['order_by'];
        $order_list = $settings['order_list'];
        $row = $settings['row'];
        $slug       = $settings['slug'] ? implode( ',', $settings['slug'] ) : '';
        $number_cat = $settings['number_cat'];
        $cat_style = $settings['cat_style'];
        $cat_type = $settings['cat_type'];
        $default_types = $settings['default_types'];
        $types = $settings['types'] ? implode( ',', $settings['types'] ) : '';

        $args = array(
            'type' => ATBDP_POST_TYPE,
            'parent' => 0,
            'hide_empty' => 1,
            'number' => $number_cat,
            'taxonomy' => ATBDP_CATEGORY,
            'no_found_rows' => true,
        );

        if ('default' == $cat_type) {

            $popular_cat = get_categories($args);
        } else {
            $popular_cat = get_categories(apply_filters('atbdp_top_category_argument', $args));
        }

        if ('masonry' == $cat_style) { ?>
            <div class="grid">
                <div class="grid-sizer"></div>
                <?php
                if ($popular_cat) {
                    foreach ($popular_cat as $key => $cat) {
                        $class = 0 == $key || 5 == $key || 6 == $key || 11 == $key || 12 == $key || 17 == $key || 18 == $key || 23 == $key || 24 == $key || 30 == $key || 31 == $key || 32 == $key || 28 == $key || 29 == $key || 35 == $key || 36 === $key ? 4 : 2;
                        $image_id = get_term_meta($cat->term_id, 'image', true);
                        $image = '';
                        if ($image_id) {
                            $image = (4 == $class) ? wp_get_attachment_image_src($image_id, 'dservice-popular-cat')[0] : wp_get_attachment_image_src($image_id, 'dservice-popular-cat-2')[0];
                        }
                        $link = class_exists('Directorist_Base') ? ATBDP_Permalink::atbdp_get_category_page((object)$cat) : ''; ?>
                        <a href="<?php echo esc_url($link); ?>">
                            <div class="grid-item grid-item--width<?php echo esc_html($class) ?>">
                                <img src="<?php echo esc_url($image); ?>" alt="<?php echo function_exists('dservice_get_image_alt') ? dservice_get_image_alt($image_id) : ''; ?>" />
                                <div class="grid-item-content">
                                    <?php echo sprintf('<h5>%s</h5>', esc_attr($cat->name)); ?>
                                </div>
                            </div>
                        </a>
                        <?php
                    }
                    wp_reset_postdata();
                } else {
                    echo sprintf('<h4>%s</h4>', esc_html__('No categories are found!', 'dservice'));
                } ?>
            </div>
            <?php
        }
        else {
            echo do_shortcode( '[directorist_all_categories view="grid" orderby="' . esc_attr( $order_by ) . '" order="' . esc_attr( $order_list ) . '" cat_per_page="' . esc_attr( $number_cat ) . '" columns="' . esc_attr( $row ) . '" slug="' . esc_attr( $slug ) . '" directory_type="' . $types . '" default_directory_type="' . $default_types . '"]' );
        }
    }
}


//Locations
class dservice_Locations extends Widget_Base
{
    public function get_name()
    {
        return 'locations';
    }

    public function get_title()
    {
        return __('Listing Locations', 'dservice-core');
    }

    public function get_icon()
    {
        return ' eicon-map-pin';
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    public function get_keywords()
    {
        return ['locations', 'all location', 'listing locations'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'locations',
            [
                'label' => __('Listing Locations', 'dservice-core'),
            ]
        );

        $this->add_control(
            'types',
            [
                'label'    => __('Specify Listing Types', 'dservice-core'),
                'type'     => Controls_Manager::SELECT2,
                'multiple' => true,
                'options'  => function_exists('directorist_listing_types') ? directorist_listing_types() : [],
                'default'  => ['general'],
                'condition' => [
                    'layout' => ['grid','list'],
                ]
            ]
        );

        $this->add_control(
            'default_types',
            [
                'label'    => __('Set Default Listing Type', 'dservice-core'),
                'type'     => Controls_Manager::SELECT,
                'multiple' => true,
                'options'  => function_exists('directorist_listing_types') ? directorist_listing_types() : [],
                'default'  => 'general',
                'condition' => [
                    'layout' => ['grid','list'],
                ]
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => __('Locations Style', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid' => esc_html__('Grid View', 'dservice-core'),
                    'list' => esc_html__('List View', 'dservice-core'),
                ],
            ]
        );

        $this->add_control(
            'row',
            [
                'label' => __('Locations Per Row', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => '2',
                'options' => [
                    '5' => esc_html__('5 Items / Row', 'dservice-core'),
                    '4' => esc_html__('4 Items / Row', 'dservice-core'),
                    '3' => esc_html__('3 Items / Row', 'dservice-core'),
                    '2' => esc_html__('2 Items / Row', 'dservice-core'),
                ],
            ]
        );

        $this->add_control(
            'number_loc',
            [
                'label' => __('Number of Locations to Show:', 'dservice-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000,
                'step' => 1,
                'default' => 4,
            ]
        );

        $this->add_control(
            'slug',
            [
                'label' => __('Specify Locations', 'dservice-core'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => function_exists('dservice_listing_locations') ? dservice_listing_locations() : []
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label' => __('Order by', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'id',
                'options' => [
                    'id' => esc_html__('Location ID', 'dservice-core'),
                    'count' => esc_html__('Listing Count', 'dservice-core'),
                    'name' => esc_html__(' Location name (A-Z)', 'dservice-core'),
                    'slug' => esc_html__(' Location Slug', 'dservice-core'),
                ],
            ]
        );

        $this->add_control(
            'order_list',
            [
                'label' => __('Locations Order', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc' => esc_html__(' ASC', 'dservice-core'),
                    'desc' => esc_html__(' DESC', 'dservice-core'),
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $default_types = $settings['default_types'];
        $types = $settings['types'] ? implode( ',', $settings['types'] ) : '';
        $layout = $settings['layout'];
        $number_loc = $settings['number_loc'];
        $order_by = $settings['order_by'];
        $order_list = $settings['order_list'];
        $row = $settings['row'];
        $slug = $settings['slug'] ? implode($settings['slug'], []) : '';

        echo do_shortcode('[directorist_all_locations view="' . esc_attr($layout) . '" orderby="' . esc_attr($order_by) . '" order="' . esc_attr($order_list) . '" loc_per_page="' . $number_loc . '" columns="' . esc_attr($row) . '" slug="' . esc_attr($slug) . '" directory_type="' . $types . '" default_directory_type="' . $default_types . '"]');
    }
}

//Checkout
class dservice_Checkout extends Widget_Base
{
    public function get_name()
    {
        return 'checkout';
    }

    public function get_title()
    {
        return __('Checkout', 'dservice-core');
    }

    public function get_icon()
    {
        return ' eicon-product-price';
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    public function get_keywords()
    {
        return ['checkout', 'payment', 'checkout payment'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'checkout',
            [
                'label' => __('Styling', 'dservice-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'checkout_margin',
            [
                'label' => __('margin', 'dservice-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'checkout_padding',
            [
                'label' => __('Padding', 'dservice-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    { ?>
        <div class="dservice-directorist_checkout">
            <?php echo do_shortcode('[directorist_checkout]'); ?>
        </div>
        <?php
    }
}

//Contact form 7
class dservice_ContactForm extends Widget_Base
{
    public function get_name()
    {
        return 'contact_form';
    }

    public function get_title()
    {
        return __('Contact Form', 'dservice-core');
    }

    public function get_icon()
    {
        return ' eicon-form-horizontal';
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    public function get_keywords()
    {
        return ['contact', 'form', 'contact form'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'contact_form',
            [
                'label' => __('Contact Form', 'dservice-core'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Form Title', 'dservice-core'),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __('Enter form title', 'dservice-core'),
            ]
        );

        $this->add_control(
            'contact_form_id',
            [
                'label' => __('Select Contact Form', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'options' => function_exists('mp_get_cf7_names') ? mp_get_cf7_names() : '',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $title = $settings['title'];
        $contact_form_id = $settings['contact_form_id'];

        if ($contact_form_id) { ?>
            <div class="contact-wrapper">
                <?php if ($title) { ?>
                    <div class="contact-wrapper__title">
                        <h4><?php echo esc_attr($title); ?></h4>
                    </div>
                <?php } ?>
                <div class="contact-wrapper__fields">
                    <?php echo do_shortcode('[contact-form-7 id="' . intval(esc_attr($contact_form_id)) . '" ]'); ?>
                </div>
            </div>
            <?php
        }
    }
}

//Contact items
class dservice_ContactItems extends Widget_Base
{
    public function get_name()
    {
        return 'contact_items';
    }

    public function get_title()
    {
        return __('Contact Items', 'dservice-core');
    }

    public function get_icon()
    {
        return ' eicon-bullet-list';
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    public function get_keywords()
    {
        return ['address', 'list', 'item', 'contact items'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'contact_items',
            [
                'label' => __('Contact Items', 'dservice-core'),
            ]
        );


        $repeater = new Repeater();

        $repeater->add_control(
            'fontawesome',
            [
                'label' => __('Font-Awesome', 'dservice-core'),
                'type' => Controls_Manager::ICON,
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => __('Content', 'dservice-core'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Enter your address', 'dservice-core'),
                'show_label' => false,
            ]
        );

        $this->add_control(
            'tabs',
            [
                'label' => __('Add New Items', 'dservice-core'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'fontawesome' => 'fa fa-map',
                        'title' => __('Enter your address', 'dservice-core'),
                    ]
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $addresses = $settings['tabs']; ?>
        <div class="contact_info_list_wrapper">
            <?php if ($addresses) { ?>
                <div class="contact_info_list">
                    <ul>
                        <?php
                        foreach ($addresses as $address) {
                            $title = $address['title'];
                            $icon = $address['fontawesome'];
                            if ($title) { ?>
                                <li>
                                    <p><span class="<?php echo esc_attr($icon); ?>"></span></p>
                                    <p class="contact-details">
                                        <span class="contact-details__title"><?php echo esc_attr($title); ?></span>
                                    </p>
                                </li>
                        <?php
                            }
                        }
                        wp_reset_postdata(); ?>
                    </ul>
                </div>
            <?php
            } ?>
        </div>
    <?php
    }
}

//Counter
class dservice_Counter extends Widget_Base
{
    public function get_name()
    {
        return 'counter';
    }

    public function get_title()
    {
        return __('Counter', 'dservice-core');
    }

    public function get_icon()
    {
        return ' eicon-counter';
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    public function get_keywords()
    {
        return ['count', 'counter', 'count down'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'section_counter',
            [
                'label' => __('Counter', 'dservice-core'),
            ]
        );

        $this->add_control(
            'number',
            [
                'label' => __('Number', 'dservice-core'),
                'type' => Controls_Manager::NUMBER,
                'default' => 0,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'suffix',
            [
                'label' => __('Number Suffix', 'dservice-core'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'label',
            [
                'label' => __('Title', 'dservice-core'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );


        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $number = $settings['number'];
        $suffix = $settings['suffix'];
        $title = $settings['label']; ?>
        <div class="list-unstyled counter-items">
            <div>
                <p>
                    <span class="count_up"><?php echo esc_attr($number); ?></span>
                    <?php echo esc_attr($suffix); ?>
                </p>
                <span><?php echo esc_attr($title); ?></span>
            </div>
        </div>
    <?php
    }
}

//Call To Action
class dservice_CTA extends Widget_Base
{

    public function get_name()
    {
        return 'call_to_action';
    }

    public function get_title()
    {
        return __('Call To Action', 'dservice-core');
    }

    public function get_icon()
    {
        return ' eicon-call-to-action';
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    public function get_keywords()
    {
        return ['cta', 'call to action', 'action'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'call_to_action',
            [
                'label' => __('Call To Action', 'dservice-core'),
            ]
        );

        $this->add_control(
            'title_1',
            [
                'label' => __('Title 1', 'dservice-core'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Download our Top Rated App'
            ]
        );

        $this->add_control(
            'title_2',
            [
                'label' => __('Title 2', 'dservice-core'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Made Just for you!'
            ]
        );

        $this->add_control(
            'title_3',
            [
                'label' => __('Title 3', 'dservice-core'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'It’s Free,'
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'icon',
            [
                'label' => __('Button Icon', 'dservice-core'),
                'type' => Controls_Manager::ICON,
            ]
        );

        $repeater->add_control(
            'btn_label',
            [
                'label' => __('Button Label', 'dservice-core'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Available now on the'
            ]
        );

        $repeater->add_control(
            'btn_additional_label',
            [
                'label' => __('Button Additional Label', 'dservice-core'),
                'type' => Controls_Manager::TEXT,
                'default' => 'App Store'
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => __('Button Link', 'dservice-core'),
                'type' => Controls_Manager::URL,
            ]
        );
        $this->add_control(
            'color',
            [
                'label' => __('Button Background Color', 'dservice-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .app-rated .store-btns a' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'buttons',
            [
                'label' => __('Add Button', 'dservice-core'),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ btn_label }}}',
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __('Choose Image', 'dservice-core'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $title_1 = $settings['title_1'];
        $title_2 = $settings['title_2'];
        $title_3 = $settings['title_3'];
        $buttons = $settings['buttons'];
        $image = $settings['image'] ? $settings['image']['url'] : ''; ?>

        <div class="app-rated">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="download-content">
                        <div class="download-content__head">
                            <h3><?php echo esc_attr($title_1); ?></h3>
                            <p><?php echo esc_attr($title_2); ?><strong><?php echo esc_attr($title_3); ?></strong></p>
                        </div>
                        <ul class="list-unstyled store-btns">
                            <?php
                            if ($buttons) {
                                foreach ($buttons as $btn) {
                                    $icon = $btn['icon'];
                                    $btn_label = $btn['btn_label'];
                                    $btn_add_label = $btn['btn_additional_label'];
                                    $link = $btn['link'] ? $btn['link']['url'] : ''; ?>
                                    <li class=store-btns-inline>
                                        <a href="<?php echo esc_url($link); ?>" class="download-content__button--start">
                                            <i class="fab <?php echo esc_attr($icon); ?> download-content_icon"></i>
                                            <span class="download-content-span">
                                                <p>
                                                    <?php echo esc_attr($btn_label); ?><br>
                                                    <strong><?php echo esc_attr($btn_add_label); ?></strong>
                                                </p>
                                            </span>
                                        </a>
                                    </li>
                            <?php
                                }
                                wp_reset_postdata();
                            } ?>
                        </ul>

                    </div>
                </div>
                <?php if ($image) { ?>
                    <div class="col-lg-5 ml-auto col-md-6">
                        <div class="download-content-right">
                            <img class="rounded-sm  download-content-right__image" src="<?php echo esc_url($image); ?>" />
                        </div>
                    </div>
                <?php
                } ?>
            </div>
        </div>

    <?php
    }
}

//Dashboard
class dservice_Dashboard extends Widget_Base
{
    public function get_name()
    {
        return 'dashboard';
    }

    public function get_title()
    {
        return __('Dashboard', 'dservice-core');
    }

    public function get_icon()
    {
        return ' eicon-dashboard';
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    public function get_keywords()
    {
        return ['dashboard', 'author dashboard'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'dashboard',
            [
                'label' => __('Styling', 'dservice-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'dashboard_margin',
            [
                'label' => __('margin', 'dservice-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dashboard_padding',
            [
                'label' => __('Padding', 'dservice-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    { ?>
        <div class="dservice-directorist_user_dashboard">
            <?php echo do_shortcode('[directorist_user_dashboard]'); ?>
        </div>
    <?php
    }
}

//Feature Box
class dservice_FeatureBox extends Widget_Base
{
    public function get_name()
    {
        return 'feature_box';
    }

    public function get_title()
    {
        return __('Feature Box', 'dservice-core');
    }

    public function get_icon()
    {
        return ' eicon-post-list';
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    public function get_keywords()
    {
        return ['feature', 'feature box', 'all features'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'feature_box',
            [
                'label' => __('Feature Box', 'dservice-core'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'dservice-core'),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
            'desc',
            [
                'label' => __('Description', 'dservice-core'),
                'type' => Controls_Manager::TEXTAREA,
            ]
        );

        $this->add_control(
            'type',
            [
                'label' => __('Style', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'image',
                'options' => [
                    'image' => esc_html__('Image Type', 'dservice-core'),
                    'icon' => esc_html__('Icon Type', 'dservice-core'),
                ],
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => __('Font-Awesome', 'dservice-core'),
                'type' => Controls_Manager::ICON,
                'condition' => [
                    'type' => 'icon'
                ]
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => __('Choose Image', 'dservice-core'),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'type' => 'image'
                ]
            ]
        );

        $this->add_control(
            'align',
            [
                'label' => __('Alignment', 'dservice-core'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'dservice-core'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'dservice-core'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'dservice-core'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .block-single' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __('Icon Color', 'dservice-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .block-single__icon i' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'type' => 'icon'
                ]
            ]
        );

        $this->add_control(
            'icon_bg',
            [
                'label' => __('Icon Background Color', 'dservice-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .block-single__icon' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'type' => 'icon'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $title = $settings['title'];
        $desc = $settings['desc'];
        $type = $settings['type'];
        $image = $settings['image'] ? $settings['image']['url'] : '';
        $id = $settings['image'] ? $settings['image']['id'] : '';
        $icon = $settings['icon']; ?>

        <div class="block-single">
            <?php
            if ('icon' == $type) { ?>
                <div class="block-single__icon">
                    <i class="<?php echo esc_attr($icon); ?>"></i>
                </div>
            <?php
            } else { ?>
                <div class="block-single__image">
                    <img src="<?php echo esc_url($image); ?>" alt="<?php echo function_exists('dservice_get_image_alt') ? esc_attr(dservice_get_image_alt($id)) : ''; ?>">
                </div>
            <?php
            } ?>
            <h4 class="block-single__title"><?php echo esc_attr($title) ?></h4>
            <p class="block-single__text"><?php echo esc_attr($desc) ?></p>
        </div>
    <?php
    }
}

//Feature section
class dservice_VideoPopup extends Widget_Base
{
    public function get_name()
    {
        return 'video_popup';
    }

    public function get_title()
    {
        return __('Popup Video', 'dservice-core');
    }

    public function get_icon()
    {
        return 'eicon-instagram-video';
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    public function get_keywords()
    {
        return ['video', 'video popup'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'video_popup',
            [
                'label' => __('Video Popup', 'dservice-core'),
            ]
        );
        $this->add_control(
            'btn',
            [
                'label' => __('Video Button Label', 'dservice-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Play Video', 'dservice-core'),
            ]
        );
        $this->add_control(
            'url',
            [
                'label' => __('Video Link', 'dservice-core'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('https://your-link.com', 'dservice-core'),
            ]
        );

        $this->add_control(
            'img',
            [
                'label' => __('Video Thumbnail', 'dservice-core'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $url = $settings['url']['url'];
        $img = $settings['img'];
        $btn = $settings['btn']; ?>

        <div class="video_wrapper bgimage">
            <?php if ($img) { ?>
                <div class="bg_image_holder">
                    <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo function_exists('dservice_get_image_alt') ? dservice_get_image_alt($img['id']) : ''; ?>">
                </div>
            <?php
            }
            if ($url) { ?>
                <div class="content_above">
                    <a href="<?php echo esc_url($url); ?>" class="video-iframe btn-play">
                        <span class="btn-icon"><i class="la la-youtube-play"></i></span>
                        <span><?php echo esc_attr($btn); ?></span>
                    </a>
                </div>
            <?php
            } ?>
        </div>

    <?php
    }
}

//Listings
class Dservice_Listings extends Widget_Base
{
    public function get_name()
    {
        return 'listings';
    }

    public function get_title()
    {
        return __('All Listings', 'dservice-core');
    }

    public function get_icon()
    {
        return ' eicon-posts-grid';
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    public function get_keywords()
    {
        return ['listings', 'all listings'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'listings',
            [
                'label' => __('Listings', 'dservice-core'),
            ]
        );

        $this->add_control(
            'types',
            [
                'label'    => __('Specify Listing Types', 'dservice-core'),
                'type'     => Controls_Manager::SELECT2,
                'multiple' => true,
                'options'  => function_exists('directorist_listing_types') ? directorist_listing_types() : [],
                'default'  => ['general'],
            ]
        );

        $this->add_control(
            'default_types',
            [
                'label'    => __('Set Default Listing Type', 'dservice-core'),
                'type'     => Controls_Manager::SELECT,
                'multiple' => true,
                'options'  => function_exists('directorist_listing_types') ? directorist_listing_types() : [],
                'default'  => 'general',
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => __('View As', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid' => esc_html__('Grid View', 'dservice-core'),
                    'list' => esc_html__('List View', 'dservice-core'),
                    'map' => esc_html__('Map View', 'dservice-core'),
                ],
            ]
        );

        $this->add_control(
            'zoom_level',
            [
                'label'   => __('Map Zoom Level', 'dservice-core'),
                'type'    => Controls_Manager::SLIDER ,
                'range' => [
					'px' => [
						'min' => 1,
						'max' => 18,
						'step' => 1,
					],
                ],
                'default' => [
					'unit' => 'px',
					'size' => 10,
				],
                'condition' => [
                    'layout' => 'map'
                ]
            ]
        );

        $this->add_control(
            'header',
            [
                'label' => __('Show Header?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'filter',
            [
                'label'     => __('Show Filter Button?', 'direo-core'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'no',
                'condition' => [
                    'header' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Listings Found Text', 'dservice-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Listings Found', 'dservice-core'),
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => true,
                'condition' => [
                    'header' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'user',
            [
                'label' => __('Only For Logged In User?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'redirect',
            [
                'label' => __('Redirect User?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __('Redirect Link', 'dservice-core'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '',
                ],
                'separator' => 'before',
                'condition' => [
                    'redirect' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'row',
            [
                'label' => __('Listings Per Row', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '5' => esc_html__('5 Items / Row', 'dservice-core'),
                    '4' => esc_html__('4 Items / Row', 'dservice-core'),
                    '3' => esc_html__('3 Items / Row', 'dservice-core'),
                    '2' => esc_html__('2 Items / Row', 'dservice-core'),
                ],
                'condition' => [
                    'layout' => 'grid'
                ]
            ]
        );

        $this->add_control(
            'map_height',
            [
                'label' => __('Map Height', 'dservice-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 300,
                'max' => 1980,
                'default' => 500,
                'condition' => [
                    'layout' => 'map'
                ]
            ]

        );

        $this->add_control(
            'number_cat',
            [
                'label' => __('Number of Listings to Show:', 'dservice-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'default' => 3,
            ]
        );

        $this->add_control(
            'cat',
            [
                'label' => __('Specify Categories', 'dservice-core'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => function_exists('dservice_listing_category') ? dservice_listing_category() : []
            ]
        );

        $this->add_control(
            'tag',
            [
                'label' => __('Specify Tags', 'dservice-core'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => function_exists('dservice_listing_tags') ? dservice_listing_tags() : []
            ]
        );

        $this->add_control(
            'location',
            [
                'label' => __('Specify Locations', 'dservice-core'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => function_exists('dservice_listing_locations') ? dservice_listing_locations() : []
            ]
        );

        $this->add_control(
            'featured',
            [
                'label' => __('Show Featured Only?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'popular',
            [
                'label' => __('Show Popular Only?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label' => __('Order by', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'title' => esc_html__(' Title', 'dservice-core'),
                    'date' => esc_html__(' Date', 'dservice-core'),
                    'price' => esc_html__(' Price', 'dservice-core'),
                ],
                'condition' => [
                    'layout!' => 'map'
                ]
            ]
        );

        $this->add_control(
            'order_list',
            [
                'label' => __('Listings Order', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc' => esc_html__(' ASC', 'dservice-core'),
                    'desc' => esc_html__(' DESC', 'dservice-core'),
                ],
                'condition' => [
                    'layout!' => 'map'
                ]
            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label' => __('Show Pagination?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $default_types = $settings['default_types'];
        $types = $settings['types'] ? implode( ',', $settings['types'] ) : '';
        $header = $settings['header'];
        $filter          = 'yes' == $settings['filter'] ? $settings['filter'] : 'no';
        $show_pagination = $settings['show_pagination'];
        $title = $settings['title'];
        $layout = $settings['layout'];
        $number_cat = $settings['number_cat'];
        $row = $settings['row'];
        $cat = $settings['cat'] ? implode($settings['cat'], []) : '';
        $location = $settings['location'] ? implode($settings['location'], []) : '';
        $tag = $settings['tag'] ? implode($settings['tag'], []) : '';
        $featured = $settings['featured'];
        $popular = $settings['popular'];
        $order_by = $settings['order_by'];
        $order_list = $settings['order_list'];
        $map_height = $settings['map_height'];
        $zoom_level      = $settings['zoom_level'] ? $settings['zoom_level']['size'] : '';
        $user = $settings['user'];
        $web = 'yes' == $user ? $settings['link']['url'] : '';
        ?>

        <div id='listing-<?php echo esc_attr($layout); ?>'>
            <?php echo do_shortcode('[directorist_all_listing map_zoom_level="' . esc_attr( $zoom_level ) . '" view="' . esc_attr($layout) . '" orderby="' . esc_attr($order_by) . '" order="' . esc_attr($order_list) . '" listings_per_page="' . esc_attr($number_cat) . '" category="' . esc_attr($cat) . '" tag="' . esc_attr($tag) . '" location="' . esc_attr($location) . '" featured_only="' . esc_attr($featured) . '" popular_only="' . esc_attr($popular) . '" header="' . esc_attr($header) . '" header_title ="' . esc_attr($title) . '" columns="' . esc_attr($row) . '" show_pagination="' . esc_attr($show_pagination) . '" advanced_filter="'.esc_attr( $filter ) .'" map_height="' . $map_height . '" display_preview_image="yes" logged_in_user_only="' . esc_attr($user) . '" redirect_page_url="' . esc_attr($web) . '" directory_type="' . $types . '" default_directory_type="' . $default_types . '"]'); ?>
        </div>

        <?php
    }
}

//Listings Carousel
class dservice_ListingsCarousel extends Widget_Base
{
    public function get_name()
    {
        return 'listings_carousel';
    }

    public function get_title()
    {
        return __('Listings Carousel', 'dservice-core');
    }

    public function get_icon()
    {
        return ' eicon-posts-carousel';
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    public function get_keywords()
    {
        return ['carousel', 'listing carousel'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'listings_carousel',
            [
                'label' => __('Listings Carousel', 'dservice-core'),
            ]
        );

        $this->add_control(
            'featured',
            [
                'label' => __('Show Featured Listing Only?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'listing_count',
            [
                'label' => __('Number of Listings to Show:', 'dservice-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'default' => 3,
            ]
        );

        $this->add_control(
            'contact',
            [
                'label' => __('Show Address?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'phone',
            [
                'label' => __('Show Phone?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'date',
            [
                'label' => __('Show Listing Publish Date?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $featured = $settings['featured'];
        $listing_count = $settings['listing_count'];
        $contact = $settings['contact'];
        $phone = $settings['phone'];
        $date = $settings['date'];

        $has_featured = get_directorist_option('enable_featured_listing');
        if ($has_featured || is_fee_manager_active()) {
            $has_featured = true;
        }
        $args = array(
            'post_type' => ATBDP_POST_TYPE,
            'post_status' => 'publish',
            'posts_per_page' => $listing_count,
        );
        $meta_queries = array();

        if ($has_featured) {
            $args['meta_key'] = '_featured';
            $args['orderby'] = array(
                'meta_value_num' => 'DESC',
                'date' => 'DESC',
            );
        }
        if ('yes' == $featured) {
            $meta_queries['_featured'] = array(
                'key' => '_featured',
                'value' => 1,
                'type' => 'NUMERIC',
                'compare' => 'EXISTS',
            );
            $meta_queries['need_post'] = array(
                array(
                    'relation' => 'OR',
                    array(
                        'key' => '_need_post',
                        'value' => 'no',
                        'compare' => '=',
                    ),
                    array(
                        'key' => '_need_post',
                        'compare' => 'NOT EXISTS',
                    )
                )
            );
        } else {
            $meta_queries['need_post'] = array(
                array(
                    'relation' => 'OR',
                    array(
                        'key' => '_need_post',
                        'value' => 'no',
                        'compare' => '=',
                    ),
                    array(
                        'key' => '_need_post',
                        'compare' => 'NOT EXISTS',
                    )
                )
            );
        }

        $count_meta_queries = count($meta_queries);
        if ($count_meta_queries) {
            $args['meta_query'] = ($count_meta_queries > 1) ? array_merge(array('relation' => 'AND'), $meta_queries) : $meta_queries;
        }

        $all_listings = new WP_Query($args); ?>


        <div id="directorist" class="listing-carousel-wrapper atbd_wrapper">
            <div class="listing-carousel owl-carousel">
                <?php
                if ($all_listings->have_posts()) {
                    while ($all_listings->have_posts()) {
                        $all_listings->the_post();

                        $locs = get_the_terms(get_the_ID(), ATBDP_LOCATION);
                        $featured = get_post_meta(get_the_ID(), '_featured', true);
                        $listing_img = get_post_meta(get_the_ID(), '_listing_img', true);
                        $listing_prv_img = get_post_meta(get_the_ID(), '_listing_prv_img', true);
                        $address = get_post_meta(get_the_ID(), '_address', true);
                        $phone_number = get_post_meta(get_the_Id(), '_phone', true);
                        $display_title = get_directorist_option('display_title', 1);
                        $display_review = get_directorist_option('enable_review', 1);
                        $display_price = get_directorist_option('display_price', 1);
                        $display_mark_as_fav = get_directorist_option('display_mark_as_fav', 1);
                        $display_author_image = get_directorist_option('display_author_image', 1);
                        $display_publish_date = get_directorist_option('display_publish_date', 1);
                        $display_contact_info = get_directorist_option('display_contact_info', 1);
                        $display_feature_badge_cart = get_directorist_option('display_feature_badge_cart', 1);
                        $popular_badge_text = get_directorist_option('popular_badge_text', 'Popular');
                        $feature_badge_text = get_directorist_option('feature_badge_text', 'Featured');
                        $address_location = get_directorist_option('address_location', 'location');
                        /*Code for Business Hour Extensions*/
                        $author_id = get_the_author_meta('ID');
                        $u_pro_pic_id = get_user_meta($author_id, 'pro_pic', true);
                        $u_pro_pic = wp_get_attachment_image_src($u_pro_pic_id, 'thumbnail');
                        $thumbnail_cropping = get_directorist_option('thumbnail_cropping', 1);
                        $crop_width = get_directorist_option('crop_width', 360);
                        $crop_height = get_directorist_option('crop_height', 300);
                        $display_address_field = get_directorist_option('display_address_field', 1);
                        $display_phone_field = get_directorist_option('display_phone_field', 1);
                        $default_image = get_directorist_option('default_preview_image', ATBDP_PUBLIC_ASSETS . 'images/grid.jpg');
                        $prv_image = $gallery_img = '';
                        if ($listing_prv_img) {

                            if ($thumbnail_cropping) {
                                $prv_image = atbdp_image_cropping($listing_prv_img, $crop_width, $crop_height, true, 100)['url'];
                            } else {
                                $prv_image = wp_get_attachment_image_src($listing_prv_img, 'large')[0];
                            }
                        }

                        if ($listing_img) {
                            if ($thumbnail_cropping) {
                                $gallery_img = atbdp_image_cropping($listing_img[0], $crop_width, $crop_height, true, 100)['url'];
                            } else {
                                $gallery_img = wp_get_attachment_image_src($listing_img[0], 'medium')[0];
                            }
                        } ?>
                        <div class="atbdp_column_carousel">
                            <div class="atbd_single_listing atbd_listing_card ">
                                <article class="atbd_single_listing_wrapper <?php echo !empty($featured) ? esc_html('directorist-featured-listings') : ''; ?>">
                                    <figure class="atbd_listing_thumbnail_area">

                                        <div class="atbd_listing_image">
                                            <?php
                                            $disable_single_listing = get_directorist_option('disable_single_listing');

                                            echo empty($disable_single_listing) ? sprintf('<a href="%s">', esc_url(get_post_permalink(get_the_ID()))) : '';
                                            $image_alt = function_exists('dservice_get_image_alt') ? dservice_get_image_alt($listing_prv_img) : '';
                                            if ($listing_prv_img) {
                                                echo sprintf('<img src="%s" alt="%s">', esc_url($prv_image), $image_alt);
                                            }
                                            if ($listing_img && !$listing_prv_img) {
                                                echo sprintf('<img src="%s" alt="%s">', esc_url($gallery_img), $image_alt);
                                            }
                                            if (!$listing_img && !$listing_prv_img) {
                                                echo sprintf('<img src="%s" alt="%s">', esc_url($default_image), $image_alt);
                                            }

                                            echo empty($disable_single_listing) ? wp_kses_post('</a>') : '';

                                            if ($display_author_image) {
                                                $image_alt = function_exists('dservice_get_image_alt') ? dservice_get_image_alt($u_pro_pic_id) : '';
                                                $author = get_userdata($author_id);
                                                $author_link = class_exists('Directorist_Base') ? ATBDP_Permalink::get_user_profile_page_link($author_id) : '';
                                                $author_avatar = $u_pro_pic ? sprintf('<img src="%s" alt="%s">', esc_url($u_pro_pic[0]), $image_alt) : get_avatar($author_id, 32);

                                                echo sprintf('<div class="atbd_author"> <a href="%s" aria-label="%s" class="atbd_tooltip">%s</a> </div>', esc_url($author_link), esc_attr($author->first_name . ' ' . $author->last_name), $author_avatar);
                                            } ?>
                                        </div>

                                        <span class="atbd_lower_badge">
                                            <?php
                                            if ($featured && $display_feature_badge_cart) {
                                                echo sprintf('<span class="atbd_badge atbd_badge_featured">%s</span>', esc_attr($feature_badge_text));
                                            }

                                            $popular_listing_id = atbdp_popular_listings(get_the_ID());

                                            if ($popular_listing_id === get_the_ID()) {
                                                echo sprintf('<span class="atbd_badge atbd_badge_popular">%s</span>', esc_attr($popular_badge_text));
                                            }

                                            echo new_badge(); ?>
                                        </span>

                                        <?php echo listings_budget(); ?>

                                        <?php echo !empty($display_mark_as_fav) ? atbdp_listings_mark_as_favourite(get_the_ID()) : ''; ?>

                                    </figure>

                                    <div class="atbd_listing_info">
                                        <?php if ($display_title || $display_review || $display_price) { ?>
                                            <div class="atbd_content_upper">
                                                <?php
                                                $listing_title = $disable_single_listing ? stripslashes(get_the_title()) : sprintf('<a href="%s">%s</a>', esc_url(get_post_permalink(get_the_ID())), stripslashes(get_the_title()));
                                                echo !empty($display_title) ? sprintf('<h4 class="atbd_listing_title">%s</h4>', wp_kses_post($listing_title)) : '';

                                                function_exists('dservice_listings_review_price') ? dservice_listings_review_price() : '';

                                                if ($display_contact_info || $display_publish_date || $display_phone_field) { ?>
                                                    <div class="atbd_listing_data_list">
                                                        <ul>
                                                            <?php
                                                            if ($display_contact_info) {
                                                                if ($address && ('contact' == $address_location) && $display_address_field && $contact) {
                                                                    echo sprintf('<li> <p> <span class="%s-map-marker"></span>%s</p> </li>', atbdp_icon_type(false), stripslashes($address));
                                                                } elseif ($locs && ('location' == $address_location) && $contact) {
                                                                    $output = $link = [];
                                                                    foreach ($locs as $loc) {
                                                                        $link = class_exists('Directorist_Base') ? ATBDP_Permalink::atbdp_get_location_page($loc) : '';
                                                                        $space = str_repeat(' ', 1);
                                                                        $output[] = sprintf('%s<a href=%s>%s</a>', esc_attr($space), esc_url($link), esc_attr($loc->name));
                                                                    }
                                                                    wp_reset_postdata();

                                                                    echo sprintf('<li><p><span class="%s-map-marker"></span>%s</span></p></li>', atbdp_icon_type(), join(',', $output));
                                                                }
                                                                if ($phone_number && $display_phone_field && $phone) {
                                                                    echo sprintf('<li> <p> <span class="%s-phone"></span> <a href="tel:%s">%s</a> </p> </li>', atbdp_icon_type(), stripslashes($phone_number), stripslashes($phone_number));
                                                                }
                                                            }

                                                            if ($display_publish_date && $date) { ?>
                                                                <li>
                                                                    <p>
                                                                        <span class="<?php atbdp_icon_type(true); ?>-clock-o"></span>
                                                                        <?php
                                                                        $publish_date_format = get_directorist_option('publish_date_format', 'time_ago');
                                                                        if ('time_ago' === $publish_date_format) {
                                                                            printf(esc_html__('Posted %s ago', 'dservice-core'), human_time_diff(get_the_time('U'), current_time('timestamp')));
                                                                        } else {
                                                                            echo get_the_date();
                                                                        } ?>
                                                                    </p>
                                                                </li>
                                                            <?php
                                                            } ?>
                                                        </ul>
                                                    </div>
                                                <?php
                                                } ?>
                                            </div>
                                        <?php
                                        }

                                        function_exists('dservice_listings_grid_view_footer_content') ? dservice_listings_grid_view_footer_content() : ''; ?>

                                </article>
                            </div>
                        </div>
                    <?php
                    }
                    wp_reset_postdata();
                } else { ?>
                    <p class="atbdp_nlf">
                        <?php esc_html_e('No listing found.', 'dservice-core'); ?>
                    </p>
                <?php
                } ?>
            </div>
        </div>
        <?php
    }
}

//Listings with map
class dservice_ListingsMap extends Widget_Base
{
    public function get_name()
    {
        return 'listings_map';
    }

    public function get_title()
    {
        return __('All Listings With Map', 'dservice-core');
    }

    public function get_icon()
    {
        return ' eicon-google-maps';
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    public function get_keywords()
    {
        return ['map', 'listings map', 'listing map'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'listings_map',
            [
                'label' => __('Listings With Map', 'dservice-core'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Listings Found Text', 'dservice-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Listings Found', 'dservice-core'),
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => __('View As', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '3' => esc_html__('3 Column', 'dservice-core'),
                    '2' => esc_html__('2 Column', 'dservice-core'),
                ],
            ]
        );

        $this->add_control(
            'user',
            [
                'label' => __('Only For Logged In User?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'redirect',
            [
                'label' => __('Redirect User?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __('Redirect Link', 'dservice-core'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '',
                ],
                'separator' => 'before',
                'condition' => [
                    'redirect' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'number_cat',
            [
                'label' => __('Number of Listings to Show:', 'dservice-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'default' => 4,
            ]
        );

        $this->add_control(
            'cat',
            [
                'label' => __('Specify Categories', 'dservice-core'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => function_exists('dservice_listing_category') ? dservice_listing_category() : []
            ]
        );

        $this->add_control(
            'tag',
            [
                'label' => __('Specify Tags', 'dservice-core'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => function_exists('dservice_listing_tags') ? dservice_listing_tags() : []
            ]
        );

        $this->add_control(
            'location',
            [
                'label' => __('Specify Locations', 'dservice-core'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => function_exists('dservice_listing_locations') ? dservice_listing_locations() : []
            ]
        );

        $this->add_control(
            'featured',
            [
                'label' => __('Show Featured Only?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'popular',
            [
                'label' => __('Show Popular Only?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label' => __('Order by', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'title' => esc_html__(' Title', 'dservice-core'),
                    'date' => esc_html__(' Date', 'dservice-core'),
                    'price' => esc_html__(' Price', 'dservice-core'),
                ],
                'condition' => [
                    'layout!' => 'map'
                ]
            ]
        );

        $this->add_control(
            'order_list',
            [
                'label' => __('Listings Order', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc' => esc_html__(' ASC', 'dservice-core'),
                    'desc' => esc_html__(' DESC', 'dservice-core'),
                ],
                'condition' => [
                    'layout!' => 'map'
                ]
            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label' => __('Show Pagination?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $show_pagination = $settings['show_pagination'];
        $title = $settings['title'];
        $layout = $settings['layout'];
        $number_cat = $settings['number_cat'];
        $cat = $settings['cat'] ? implode($settings['cat'], []) : '';
        $location = $settings['location'] ? implode($settings['location'], []) : '';
        $tag = $settings['tag'] ? implode($settings['tag'], []) : '';
        $featured = $settings['featured'];
        $popular = $settings['popular'];
        $order_by = $settings['order_by'];
        $order_list = $settings['order_list'];
        $user = $settings['user'];
        $web = 'yes' == $user ? $settings['link']['url'] : ''; ?>

        <input type="hidden" id="listing-listings_with_map">

    <?php echo do_shortcode('[directorist_all_listing view="listings_with_map" orderby="' . esc_attr($order_by) . '" order="' . esc_attr($order_list) . '" listings_per_page="' . esc_attr($number_cat) . '" category="' . esc_attr($cat) . '" tag="' . esc_attr($tag) . '" location="' . esc_attr($location) . '" featured_only="' . esc_attr($featured) . '" action_before_after_loop="no" popular_only="' . esc_attr($popular) . '" header="yes" header_title ="' . esc_attr($title) . '" show_pagination="' . esc_attr($show_pagination) . '" display_preview_image="yes" logged_in_user_only="' . esc_attr($user) . '" redirect_page_url="' . esc_attr($web) . '" listings_with_map_columns="' . esc_attr($layout) . '"]');
    }
}

//Registration
class dservice_Registration extends Widget_Base
{
    public function get_name()
    {
        return 'registration';
    }

    public function get_title()
    {
        return __('Registration Form', 'dservice-core');
    }

    public function get_icon()
    {
        return ' fas fa-user-plus';
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'Registration',
            [
                'label' => __('Styling', 'dservice-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'Registration_margin',
            [
                'label' => __('margin', 'dservice-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'Registration_padding',
            [
                'label' => __('Padding', 'dservice-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    { ?>
        <div class="dservice-directorist_custom_registration">
            <?php echo do_shortcode('[directorist_custom_registration]'); ?>
        </div>
    <?php
    }
}

//Login
class dservice_Login extends Widget_Base
{
    public function get_name()
    {
        return 'login';
    }

    public function get_title()
    {
        return __('Login Form', 'dservice-core');
    }

    public function get_icon()
    {
        return ' eicon-lock-user';
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'login',
            [
                'label' => __('Styling', 'dservice-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'login_margin',
            [
                'label' => __('margin', 'dservice-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'login_padding',
            [
                'label' => __('Padding', 'dservice-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    { ?>
        <div class="dservice-directorist_user_login">
            <?php echo do_shortcode('[directorist_user_login]'); ?>
        </div>
    <?php
    }
}

//Transaction
class dservice_Transaction extends Widget_Base
{
    public function get_name()
    {
        return 'transaction';
    }

    public function get_title()
    {
        return __('Transaction', 'dservice-core');
    }

    public function get_icon()
    {
        return ' eicon-sync';
    }

    public function get_keywords()
    {
        return ['transaction'];
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }


    protected function _register_controls()
    {
        $this->start_controls_section(
            'transaction',
            [
                'label' => __('Styling', 'dservice-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'transaction_margin',
            [
                'label' => __('margin', 'dservice-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'transaction_padding',
            [
                'label' => __('Padding', 'dservice-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    { ?>
        <div class="dservice-directorist_transaction_failure">
            <?php echo do_shortcode('[directorist_transaction_failure]'); ?>
        </div>
    <?php
    }
}

//Logos
class dservice_Logos extends Widget_Base
{
    public function get_name()
    {
        return 'logos';
    }

    public function get_title()
    {
        return __('Logos Carousel', 'dservice-core');
    }

    public function get_icon()
    {
        return ' eicon-carousel';
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    public function get_keywords()
    {
        return ['logo', 'logos', 'carousel',];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'logos',
            [
                'label' => __('Logos', 'dservice-core'),
            ]
        );
        $this->add_control(
            'clients_logo',
            [
                'label' => __('Add Logos', 'dservice-core'),
                'type' => Controls_Manager::GALLERY,
                'default' => [],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $logos = $settings['clients_logo']; ?>
        <div class="logo-carousel owl-carousel">
            <?php
            if ($logos) {
                foreach ($logos as $logo) { ?>
                    <div class="carousel-single">
                        <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo function_exists('dservice_get_image_alt') ? dservice_get_image_alt($logo['id']) : ''; ?>">
                    </div>
            <?php
                }
                wp_reset_postdata();
            } ?>
        </div>
    <?php
    }
}

//Need categories
class dservice_NeedCategories extends Widget_Base
{
    public function get_name()
    {
        return 'need_categories';
    }

    public function get_title()
    {
        return __('Need Categories', 'dservice-core');
    }

    public function get_icon()
    {
        return ' far fa-question-circle';
    }

    public function get_keywords()
    {
        return ['need', 'categories', 'need categories',];
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'need_categories',
            [
                'label' => __('Need Categories', 'dservice-core'),
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => __('Category Layout', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid' => esc_html__('Grid View', 'dservice-core'),
                    'list' => esc_html__('List View', 'dservice-core'),
                ],
            ]
        );

        $this->add_control(
            'cat_style',
            [
                'label' => __('Category Style', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'category-style1',
                'options' => [
                    'category-style1' => esc_html__('Style 1', 'dservice-core'),
                    'category-style-two' => esc_html__('Style 2', 'dservice-core'),
                ],
                'condition' => [
                    'layout' => 'grid',
                ],
            ]
        );

        $this->add_control(
            'row',
            [
                'label' => __('Categories Per Row', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '5' => esc_html__('5 Items / Row', 'dservice-core'),
                    '4' => esc_html__('4 Items / Row', 'dservice-core'),
                    '3' => esc_html__('3 Items / Row', 'dservice-core'),
                    '2' => esc_html__('2 Items / Row', 'dservice-core'),
                ],
            ]
        );

        $this->add_control(
            'number_cat',
            [
                'label' => __('Number of categories to Show:', 'dservice-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000,
                'step' => 1,
                'default' => 6,
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label' => __('Order by', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'id',
                'options' => [
                    'id' => esc_html__(' Cat ID', 'dservice-core'),
                    'count' => esc_html__('Needs Count', 'dservice-core'),
                    'name' => esc_html__(' Category name (A-Z)', 'dservice-core'),
                    'slug' => esc_html__('Select Category', 'dservice-core'),
                ],
            ]
        );

        $this->add_control(
            'slug',
            [
                'label' => __('Specify Locations', 'dservice-core'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => function_exists('dservice_listing_category') ? dservice_listing_category() : []
            ]
        );

        $this->add_control(
            'order_list',
            [
                'label' => __('Locations Order', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc' => esc_html__(' ASC', 'dservice-core'),
                    'desc' => esc_html__(' DESC', 'dservice-core'),
                ],
            ]
        );

        $this->add_control(
            'user',
            [
                'label' => __('Only For Logged In User?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'redirect',
            [
                'label' => __('Redirect User?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __('Redirect Link', 'dservice-core'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '',
                ],
                'separator' => 'before',
                'condition' => [
                    'redirect' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $number_cat = $settings['number_cat'];
        $order_by = $settings['order_by'];
        $order_list = $settings['order_list'];
        $row = $settings['row'];
        $slug = $settings['slug'] ? implode($settings['slug'], []) : '';
        $cat_style = $settings['cat_style'];
        $layout = $settings['layout'];
        $user = $settings['user'];
        $web = 'yes' == $user ? $settings['link']['url'] : ''; ?>

        <div id="<?php echo esc_attr($cat_style); ?>">
            <?php echo do_shortcode('[directorist_need_categories view="' . esc_attr($layout) . '" orderby="' . esc_attr($order_by) . '" order="' . esc_attr($order_list) . '" cat_per_page="' . esc_attr($number_cat) . '" columns="' . esc_attr($row) . '" slug="' . esc_attr($slug) . '" logged_in_user_only="' . esc_attr($user) . '" redirect_page_url="' . esc_attr($web) . '"]'); ?>
        </div>
    <?php
    }
}

//Need locations
class dservice_NeedLocations extends Widget_Base
{
    public function get_name()
    {
        return 'need_locations';
    }

    public function get_title()
    {
        return __('Need Locations', 'dservice-core');
    }

    public function get_icon()
    {
        return ' far fa-question-circle';
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    public function get_keywords()
    {
        return ['locations', 'need locations',];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'need_locations',
            [
                'label' => __('Need Locations', 'dservice-core'),
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => __('Locations Layout', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid' => esc_html__('Grid View', 'dservice-core'),
                    'list' => esc_html__('List View', 'dservice-core'),
                ],
            ]
        );

        $this->add_control(
            'row',
            [
                'label' => __('Location Per Row', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '5' => esc_html__('5 Items / Row', 'dservice-core'),
                    '4' => esc_html__('4 Items / Row', 'dservice-core'),
                    '3' => esc_html__('3 Items / Row', 'dservice-core'),
                    '2' => esc_html__('2 Items / Row', 'dservice-core'),
                ],
            ]
        );

        $this->add_control(
            'number_loc',
            [
                'label' => __('Number of locations to Show:', 'dservice-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 1000,
                'step' => 1,
                'default' => 4,
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label' => __('Order by', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'id',
                'options' => [
                    'id' => esc_html__(' Cat ID', 'dservice-core'),
                    'count' => esc_html__('Needs Count', 'dservice-core'),
                    'name' => esc_html__(' Category name (A-Z)', 'dservice-core'),
                    'slug' => esc_html__('Select Category', 'dservice-core'),
                ],
            ]
        );

        $this->add_control(
            'slug',
            [
                'label' => __('Specify Locations', 'dservice-core'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => function_exists('dservice_listing_locations') ? dservice_listing_locations() : []
            ]
        );

        $this->add_control(
            'order_list',
            [
                'label' => __('Locations Order', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc' => esc_html__(' ASC', 'dservice-core'),
                    'desc' => esc_html__(' DESC', 'dservice-core'),
                ],
            ]
        );

        $this->add_control(
            'user',
            [
                'label' => __('Only For Logged In User?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'redirect',
            [
                'label' => __('Redirect User?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __('Redirect Link', 'dservice-core'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '',
                ],
                'separator' => 'before',
                'condition' => [
                    'redirect' => 'yes'
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $number_loc = $settings['number_loc'];
        $order_by = $settings['order_by'];
        $order_list = $settings['order_list'];
        $row = $settings['row'];
        $slug = $settings['slug'] ? implode($settings['slug'], []) : '';
        $layout = $settings['layout'];
        $user = $settings['user'];
        $web = 'yes' == $user ? $settings['link']['url'] : '';

        echo do_shortcode('[directorist_need_locations view="' . esc_attr($layout) . '" orderby="' . esc_attr($order_by) . '" order="' . esc_attr($order_list) . '" loc_per_page="' . esc_attr($number_loc) . '" columns="' . esc_attr($row) . '" slug="' . esc_attr($slug) . '" logged_in_user_only="' . esc_attr($user) . '" redirect_page_url="' . esc_attr($web) . '"]');
    }
}

//Need single category
class dservice_NeedSingleCat extends Widget_Base
{
    public function get_name()
    {
        return 'need_single_category';
    }

    public function get_title()
    {
        return __('Need Single Category', 'dservice-core');
    }

    public function get_icon()
    {
        return ' far fa-question-circle';
    }

    public function get_keywords()
    {
        return ['single category', 'need category', 'category',];
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'need_single_category',
            [
                'label' => __('Need Single Category', 'dservice-core'),
            ]
        );

        $this->add_control(
            'number',
            [
                'label' => __('Number of Needs to Show:', 'dservice-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'default' => 3,
            ]
        );

        $this->add_control(
            'pagination',
            [
                'label' => __('Show Pagination?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $number = $settings['number'];
        $pagination = $settings['pagination'];

        echo do_shortcode('[directorist_need_category listings_per_page="' . $number . '" show_pagination="' . $pagination . '"]');
    }
}

//Need single location
class dservice_NeedSingleLoc extends Widget_Base
{
    public function get_name()
    {
        return 'need_single_location';
    }

    public function get_title()
    {
        return __('Need Single Location', 'dservice-core');
    }

    public function get_icon()
    {
        return ' far fa-question-circle';
    }

    public function get_keywords()
    {
        return ['single location', 'need location', 'location',];
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'need_single_location',
            [
                'label' => __('Need Single Location', 'dservice-core'),
            ]
        );

        $this->add_control(
            'number',
            [
                'label' => __('Number of Needs to Show:', 'dservice-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'default' => 3,
            ]
        );

        $this->add_control(
            'pagination',
            [
                'label' => __('Show Pagination?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $number = $settings['number'];
        $pagination = $settings['pagination'];

        echo do_shortcode('[directorist_need_location listings_per_page="' . $number . '" show_pagination="' . $pagination . '"]');
    }
}

//Needs
class dservice_Needs extends Widget_Base
{
    public function get_name()
    {
        return 'needs';
    }

    public function get_title()
    {
        return __('All Needs', 'dservice-core');
    }

    public function get_icon()
    {
        return ' far fa-question-circle';
    }

    public function get_keywords()
    {
        return ['need',];
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'needs',
            [
                'label' => __('All Needs', 'dservice-core'),
            ]
        );

        $this->add_control(
            'avatar',
            [
                'label' => __('Show Author Avatar?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'category',
            [
                'label' => __('Show Category?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'budget',
            [
                'label' => __('Show Budget Amount?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'columns',
            [
                'label' => __('Needs Per Row', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '5' => esc_html__('5 Items / Row', 'dservice-core'),
                    '4' => esc_html__('4 Items / Row', 'dservice-core'),
                    '3' => esc_html__('3 Items / Row', 'dservice-core'),
                    '2' => esc_html__('2 Items / Row', 'dservice-core'),
                ],
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label' => __('Order by', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'ID' => esc_html__(' Post ID', 'dservice-core'),
                    'author' => esc_html__(' Author', 'dservice-core'),
                    'title' => esc_html__(' Title', 'dservice-core'),
                    'name' => esc_html__(' Post name (post slug)', 'dservice-core'),
                    'type' => esc_html__(' Post type (available since Version 4.0)', 'dservice-core'),
                    'date' => esc_html__(' Date', 'dservice-core'),
                    'modified' => esc_html__(' Last modified date', 'dservice-core'),
                    'rand' => esc_html__(' Random order', 'dservice-core'),
                    'comment_count' => esc_html__(' Number of comments', 'dservice-core')
                ],
            ]
        );

        $this->add_control(
            'order_list',
            [
                'label' => __('Order post', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'ASC' => esc_html__(' ASC', 'dservice-core'),
                    'DESC' => esc_html__(' DESC', 'dservice-core'),
                ],
            ]
        );

        $this->add_control(
            'number',
            [
                'label' => __('Number of Needs to Show:', 'dservice-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'default' => 3,
            ]
        );

        $this->add_control(
            'pagination',
            [
                'label' => __('Show Pagination?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $avatar = $settings['avatar'];
        $budget = $settings['budget'];
        $columns = $settings['columns'];
        $number = $settings['number'];
        $order = $settings['order_by'];
        $order_list = $settings['order_list'];
        $pagination = $settings['pagination'];

        echo do_shortcode('[directorist_all_needs display_author="' . esc_attr($avatar) . '" display_category="' . esc_attr($avatar) . '" display_budget="' . esc_attr($budget) . '" columns="' . esc_attr($columns) . '" show_pagination="' . esc_attr($pagination) . '" posts_per_page="' . esc_attr($number) . '" order_by="' . esc_attr($order) . '" sort_by="' . esc_attr($order_list) . '"]');
    }
}

//Payment
class dservice_Payment extends Widget_Base
{
    public function get_name()
    {
        return 'payment';
    }

    public function get_title()
    {
        return __('Payment', 'dservice-core');
    }

    public function get_icon()
    {
        return ' eicon-product-breadcrumbs';
    }

    public function get_keywords()
    {
        return ['payment',];
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'payment',
            [
                'label' => __('Styling', 'dservice-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'payment_margin',
            [
                'label' => __('margin', 'dservice-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'payment_padding',
            [
                'label' => __('Padding', 'dservice-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    { ?>
        <div class="dservice-payment-receipt">
            <?php echo do_shortcode('[directorist_payment_receipt]'); ?>
        </div>
    <?php
    }
}

//Pricing plan
class dservice_PricingPlan extends Widget_Base
{
    public function get_name()
    {
        return 'pricing_plan';
    }

    public function get_title()
    {
        return __('Pricing Plan', 'dservice-core');
    }

    public function get_icon()
    {
        return ' fas fa-dollar-sign';
    }

    public function get_keywords()
    {
        return ['pricing', 'price',];
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'pricing_plan',
            [
                'label' => __('Styling', 'dservice-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'pp_margin',
            [
                'label' => __('margin', 'dservice-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'pp_padding',
            [
                'label' => __('Padding', 'dservice-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        echo do_shortcode('[directorist_pricing_plans]');
    }
}

//Hero area
class dservice_SearchForm extends Widget_Base
{

    public function get_name()
    {
        return 'search_form section-padding';
    }

    public function get_title()
    {
        return __('Hero Area', 'dservice-core');
    }

    public function get_icon()
    {
        return 'eicon-device-desktop';
    }

    public function get_keywords()
    {
        return ['search', 'form', 'hero area'];
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'hero_area',
            [
                'label' => __('Hero Area', 'dservice-core'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'dservice-core'),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => __('Enter your title', 'dservice-core'),
                'default' => __('Find The Trusted Business', 'dservice-core'),
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => __('Subtitle', 'dservice-core'),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => __('Enter your subtitle', 'dservice-core'),
                'default' => __('Get notified about services that match your requirement', 'dservice-core'),
            ]
        );

        $this->add_control(
            'popular',
            [
                'label' => __('Show Popular Category?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => __('Form Style', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'search-form-wrapper--one',
                'options' => [
                    'search-form-wrapper--one' => esc_html__('Style 1', 'dservice'),
                    'search-form-wrapper--two' => esc_html__('Style 2', 'dservice'),
                ],
            ]
        );

        $this->add_control(
            'image',
            [
                'label' => esc_html__('Profile picture', 'dservice-core'),
                'type' => Controls_Manager::MEDIA,
                'condition' => [
                    'style' => 'search-form-wrapper--two',
                ],
            ]
        );

        $this->end_controls_section();
        

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __('Styling', 'dservice-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Title  Color', 'dservice-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_2,
                ],
                'selectors' => [
                    '{{WRAPPER}} .search-form-wrapper h1' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => __('Subtitle Color', 'dservice-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .search-form-wrapper span.subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tab_text_color',
            [
                'label' => __('Tab Text Color', 'dservice-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_3,
                ],
                'selectors' => [
                    '{{WRAPPER}} .search-form-wrapper .pyn-search-group .pyn-search-radio label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'active_tab_text_color',
            [
                'label' => __('Active Tab Text Color', 'dservice-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .search-form-wrapper .pyn-search-group .pyn-search-radio input:checked + label' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .search-form-wrapper.search-form-wrapper--one .directory_search_area .pyn-search-group .pyn-search-radio input:checked + label' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'popular_cat_color',
            [
                'label' => __('Popular Category Color', 'dservice-core'),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Schemes\Color::get_type(),
                    'value' => Schemes\Color::COLOR_4,
                ],
                'selectors' => [
                    '{{WRAPPER}} .search-form-wrapper .directory_search_area .directory_home_category_area ul.categories li a' => 'color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_section();
    }

    protected function render()
    {
        $searchform = new Directorist_Listing_Search_Form( 'search_form', directorist_default_directory() );
        $settings = $this->get_settings_for_display();
        $title = $settings['title'];
        $subtitle = $settings['subtitle'];
        $popular = $settings['popular'];
        $style = $settings['style'];
        $image = $settings['image'] ? $settings['image']['url'] : '';
        $id = $settings['image'] ? $settings['image']['id'] : '';
        wp_enqueue_script( 'directorist-search-form-listing' );
		wp_enqueue_script( 'directorist-range-slider' );
        wp_enqueue_script( 'directorist-search-listing' );
        ?>
            <div class="search-form-wrapper <?php echo esc_attr($style); ?>">
                <div class="row align-items-center">
                    <div class="col-lg-<?php echo 'search-form-wrapper--one' == $style ? esc_html('12') : esc_html('9'); ?>">
                        <div class="directorist-search-contents atbd_wrapper directory_search_area ads-advaced--wrapper">
                            <div class="search-form-title">
                                <?php
                                echo !empty($title) ? sprintf('<h1>%s</h1>', wp_kses($title, array('span' => ''))) : '';
                                echo !empty($subtitle) ? sprintf('<span class="subtitle">%s</span>', esc_attr($subtitle)) : ''; ?>
                            </div>
                            <form action="<?php echo esc_url( ATBDP_Permalink::get_search_result_page_link() ); ?>" class="directorist-search-form">
                                <div class="directorist-search-form-wrap directorist-with-search-border">
                                    <?php $searchform->directory_type_nav_template(); ?>

                                    <input type="hidden" name="directory_type" id="listing_type" value="<?php echo esc_attr( $searchform->listing_type_slug() ); ?>">

                                    <div class="directorist-search-form-box">
                                        <div class="directorist-search-form-top directorist-flex directorist-align-center directorist-search-form-inline">

                                            <?php
                                            foreach ( $searchform->form_data[0]['fields'] as $field ){
                                                $searchform->field_template( $field );
                                            }
                                            if ( $searchform->more_filters_display !== 'always_open' ){
                                                $searchform->more_buttons_template();
                                            }
                                            ?>

                                        </div>
                                    </div>
                                </div>
                                <?php
                                if ( $searchform->more_filters_display == 'always_open' ){
                                    $searchform->advanced_search_form_fields_template();
                                }
                                else {
                                    if ($searchform->has_more_filters_button) { ?>
                                        <div class="<?php Helper::search_filter_class( $searchform->more_filters_display ); ?>">
                                            <?php $searchform->advanced_search_form_fields_template();?>
                                        </div>
                                        <?php
                                    }
                                }
                                ?>
                            </form>
                            <?php if ('yes' == $popular) : $searchform->top_categories_template(); endif; ?>
                        </div>
                    </div>
                    <?php
                    if ('search-form-wrapper--two' == $style) {
                        $image_alt = function_exists('dservice_get_image_alt') ? dservice_get_image_alt($id) : ''; ?>
                        <div class="col-lg-3 search-img-wrapper">
                            <div class="search-form-img">
                                <?php echo sprintf('<img src="%s" alt="%s">', esc_url($image), $image_alt); ?>
                            </div>
                        </div>
                        <?php
                    } ?>
                </div>
            </div>
        <?php
    }
}

//Search result
class Dservice_SearchResult extends Widget_Base
{
    public function get_name()
    {
        return 'search_result';
    }

    public function get_title()
    {
        return __('Search Result', 'dservice-core');
    }

    public function get_icon()
    {
        return ' eicon-search-results';
    }

    public function get_keywords()
    {
        return ['result', 'search'];
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'search_result',
            [
                'label' => __('Search Result', 'dservice-core'),
            ]
        );

        $this->add_control(
            'types',
            [
                'label'    => __('Specify Listing Types', 'dservice-core'),
                'type'     => Controls_Manager::SELECT2,
                'multiple' => true,
                'options'  => function_exists('directorist_listing_types') ? directorist_listing_types() : [],
                'default'  => ['general'],
            ]
        );
        
        $this->add_control(
            'default_types',
            [
                'label'    => __('Set Default Listing Type', 'dservice-core'),
                'type'     => Controls_Manager::SELECT,
                'multiple' => true,
                'options'  => function_exists('directorist_listing_types') ? directorist_listing_types() : [],
                'default'  => 'general',
            ]
        );

        $this->add_control(
            'header',
            [
                'label'   => __('Show Header?', 'dservice-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'user',
            [
                'label'   => __('Only For Logged In User?', 'dservice-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'redirect',
            [
                'label'   => __('Redirect User?', 'dservice-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'link',
            [
                'label'     => __('Redirect Link', 'dservice-core'),
                'type'      => Controls_Manager::URL,
                'condition' => [
                    'redirect' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'layout',
            [
                'label'   => __('View As', 'dservice-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid' => esc_html__('Grid View', 'dservice-core'),
                    'list' => esc_html__('List View', 'dservice-core'),
                    'map'  => esc_html__('Map View', 'dservice-core'),
                ],
            ]
        );

        $this->add_control(
            'row',
            [
                'label'   => __('Listings Per Row', 'dservice-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '5' => esc_html__('5 Items / Row', 'dservice-core'),
                    '4' => esc_html__('4 Items / Row', 'dservice-core'),
                    '3' => esc_html__('3 Items / Row', 'dservice-core'),
                    '2' => esc_html__('2 Items / Row', 'dservice-core'),
                ],
                'condition' => [
                    'layout' => 'grid'
                ]
            ]
        );

        $this->add_control(
            'map_height',
            [
                'label'     => __('Map Height', 'dservice-core'),
                'type'      => Controls_Manager::NUMBER,
                'min'       => 300,
                'max'       => 1980,
                'default'   => 500,
                'condition' => [
                    'layout' => 'map'
                ]
            ]
        );

        $this->add_control(
            'number_cat',
            [
                'label'   => __('Number of Listings to Show:', 'dservice-core'),
                'type'    => Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 100,
                'default' => 3,
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label'   => __('Order by', 'dservice-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'title' => esc_html__(' Title', 'dservice-core'),
                    'date'  => esc_html__(' Date', 'dservice-core'),
                    'price' => esc_html__(' Price', 'dservice-core'),
                ],
                'condition' => [
                    'layout!' => 'map'
                ]
            ]
        );

        $this->add_control(
            'order_list',
            [
                'label'   => __('Listings Order', 'dservice-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc'  => esc_html__(' ASC', 'dservice-core'),
                    'desc' => esc_html__(' DESC', 'dservice-core'),
                ],
                'condition' => [
                    'layout!' => 'map'
                ]
            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label'   => __('Show Pagination?', 'dservice-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings        = $this->get_settings_for_display();
        $default_types = $settings['default_types'];
        $types = $settings['types'] ? implode( ',', $settings['types'] ) : '';
        $default_types = $settings['default_types'];
        $types = $settings['types'] ? implode( ',', $settings['types'] ) : '';
        $header          = $settings['header'];
        $show_pagination = $settings['show_pagination'];
        $layout          = $settings['layout'];
        $number_cat      = $settings['number_cat'];
        $row             = $settings['row'];
        $order_by        = $settings['order_by'];
        $order_list      = $settings['order_list'];
        $map_height      = $settings['map_height'];
        $user            = $settings['user'];
        $web             = 'yes' == $user ? $settings['link']['url'] : '';

        echo do_shortcode('[directorist_search_result view="' . esc_attr($layout) . '" orderby="' . esc_attr($order_by) . '" order="' . esc_attr($order_list) . '" listings_per_page="' . esc_attr($number_cat) . '" header="' . esc_attr($header) . '" columns="' . esc_attr($row) . '" show_pagination="' . esc_attr($show_pagination) . '" map_height="' . $map_height . '" logged_in_user_only="' . esc_attr($user) . '" redirect_page_url="' . esc_attr($web) . '" directory_type="' . $types . '" default_directory_type="' . $default_types . '" directory_type="' . $types . '" default_directory_type="' . $default_types . '"]');
    }
}

//Single category
class Dservice_SingleCat extends Widget_Base
{
    public function get_name()
    {
        return 'single_cat';
    }

    public function get_title()
    {
        return __('Single Category', 'dservice-core');
    }

    public function get_icon()
    {
        return 'eicon-theme-builder';
    }

    public function get_keywords()
    {
        return ['single category', 'single listing category', 'category',];
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'single_cat',
            [
                'label' => __('Single Listing Category', 'dservice-core'),
            ]
        );

        $this->add_control(
            'types',
            [
                'label'    => __('Specify Listing Types', 'dservice-core'),
                'type'     => Controls_Manager::SELECT2,
                'multiple' => true,
                'options'  => function_exists('directorist_listing_types') ? directorist_listing_types() : [],
                'default'  => ['general'],
            ]
        );
        
        $this->add_control(
            'default_types',
            [
                'label'    => __('Set Default Listing Type', 'dservice-core'),
                'type'     => Controls_Manager::SELECT,
                'multiple' => true,
                'options'  => function_exists('directorist_listing_types') ? directorist_listing_types() : [],
                'default'  => 'general',
            ]
        );

        $this->add_control(
            'header',
            [
                'label'   => __('Show Header?', 'dservice-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => __('Listings Found Text', 'dservice-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Listings Found', 'dservice-core'),
                'label_block' => true,
                'condition'   => [
                    'header' => 'yes'
                ]

            ]
        );

        $this->add_control(
            'filter',
            [
                'label'   => __('Show More Filter?', 'dservice-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'layout',
            [
                'label'   => __('View As', 'dservice-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid' => esc_html__('Grid View', 'dservice-core'),
                    'list' => esc_html__('List View', 'dservice-core'),
                    'map'  => esc_html__('Map View', 'dservice-core'),
                ],
            ]
        );

        $this->add_control(
            'sidebar',
            [
                'label'     => __('Show sidebar?', 'dservice-core'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'condition' => [
                    'layout!' => 'map'
                ]
            ]
        );

        $this->add_control(
            'user',
            [
                'label'   => __('Only For Logged In User?', 'dservice-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'redirect',
            [
                'label'   => __('Redirect User?', 'dservice-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'link',
            [
                'label'     => __('Redirect Link', 'dservice-core'),
                'type'      => Controls_Manager::URL,
                'condition' => [
                    'redirect' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'row',
            [
                'label'   => __('Listings Per Row', 'dservice-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '5' => esc_html__('5 Items / Row', 'dservice-core'),
                    '4' => esc_html__('4 Items / Row', 'dservice-core'),
                    '3' => esc_html__('3 Items / Row', 'dservice-core'),
                    '2' => esc_html__('2 Items / Row', 'dservice-core'),
                ],
                'condition' => [
                    'layout' => 'grid'
                ]
            ]
        );

        $this->add_control(
            'map_height',
            [
                'label'     => __('Map Height', 'dservice-core'),
                'type'      => Controls_Manager::NUMBER,
                'min'       => 300,
                'max'       => 1980,
                'default'   => 500,
                'condition' => [
                    'layout' => 'map'
                ]
            ]
        );

        $this->add_control(
            'number_cat',
            [
                'label'   => __('Number of Listings to Show:', 'dservice-core'),
                'type'    => Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 100,
                'default' => 3,
            ]
        );

        $this->add_control(
            'cat',
            [
                'label'    => __('Specify Categories', 'dservice-core'),
                'type'     => Controls_Manager::SELECT2,
                'multiple' => true,
                'options'  => function_exists('dservice_listing_category') ? dservice_listing_category() : [],
            ]
        );

        $this->add_control(
            'tag',
            [
                'label'    => __('Specify Tags', 'dservice-core'),
                'type'     => Controls_Manager::SELECT2,
                'multiple' => true,
                'options'  => function_exists('dservice_listing_tags') ? dservice_listing_tags() : []
            ]
        );

        $this->add_control(
            'location',
            [
                'label'    => __('Specify Locations', 'dservice-core'),
                'type'     => Controls_Manager::SELECT2,
                'multiple' => true,
                'options'  => function_exists('dservice_listing_locations') ? dservice_listing_locations() : []
            ]
        );

        $this->add_control(
            'featured',
            [
                'label'   => __('Show Featured Only?', 'dservice-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'popular',
            [
                'label'   => __('Show Popular Only?', 'dservice-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label'   => __('Order by', 'dservice-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'title' => esc_html__(' Title', 'dservice-core'),
                    'date'  => esc_html__(' Date', 'dservice-core'),
                    'price' => esc_html__(' Price', 'dservice-core'),
                ],
                'condition' => [
                    'layout!' => 'map'
                ]
            ]
        );

        $this->add_control(
            'order_list',
            [
                'label'   => __('Listings Order', 'dservice-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc'  => esc_html__(' ASC', 'dservice-core'),
                    'desc' => esc_html__(' DESC', 'dservice-core'),
                ],
                'condition' => [
                    'layout!' => 'map'
                ]
            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label'   => __('Show Pagination?', 'dservice-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings        = $this->get_settings_for_display();
        $default_types = $settings['default_types'];
        $types = $settings['types'] ? implode( ',', $settings['types'] ) : '';
        $default_types = $settings['default_types'];
        $types = $settings['types'] ? implode( ',', $settings['types'] ) : '';
        $header          = $settings['header'];
        $filter          = 'yes' == $settings['filter'] ? $settings['filter'] : 'no';
        $sidebar         = $settings['sidebar'];
        $show_pagination = $settings['show_pagination'];
        $title           = $settings['title'];
        $layout          = $settings['layout'];
        $number_cat      = $settings['number_cat'];
        $row             = $settings['row'];
        $cat             = $settings['cat'] ? implode(',', $settings['cat']) : '';
        $location        = $settings['location'] ? implode(',', $settings['location']) : '';
        $tag             = $settings['tag'] ? implode(',', $settings['tag']) : '';
        $featured        = $settings['featured'];
        $popular         = $settings['popular'];
        $order_by        = $settings['order_by'];
        $order_list      = $settings['order_list'];
        $map_height      = $settings['map_height'];
        $user            = $settings['user'];
        $web             = 'yes' == $user ? $settings['link']['url'] : '';

        echo do_shortcode('[directorist_category view="' . esc_attr($layout) . '" orderby="' . esc_attr($order_by) . '" order="' . esc_attr($order_list) . '" listings_per_page="' . esc_attr($number_cat) . '" category="' . esc_attr($cat) . '" tag="' . esc_attr($tag) . '" location="' . esc_attr($location) . '" featured_only="' . esc_attr($featured) . '" popular_only="' . esc_attr($popular) . '" header="' . esc_attr($header) . '" header_title ="' . esc_attr($title) . '" columns="' . esc_attr($row) . '" action_before_after_loop="' . esc_attr($sidebar) . '" show_pagination="' . esc_attr($show_pagination) . '" advanced_filter="' . esc_attr($filter) . '" map_height="' . $map_height . '" display_preview_image="yes" logged_in_user_only="' . esc_attr($user) . '" redirect_page_url="' . esc_attr($web) . '" directory_type="' . $types . '" default_directory_type="' . $default_types . '" directory_type="' . $types . '" default_directory_type="' . $default_types . '"]');
    }
}

//Single category map
class dservice_SingleCatMap extends Widget_Base
{
    public function get_name()
    {
        return 'single_cat_map';
    }

    public function get_title()
    {
        return __('Single Category Map View', 'dservice-core');
    }

    public function get_icon()
    {
        return ' eicon-google-maps';
    }

    public function get_keywords()
    {
        return ['map', 'single category'];
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'single_cat',
            [
                'label' => __('Single Category Map View', 'dservice-core'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Listings Found Text', 'dservice-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Listings Found', 'dservice-core'),
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => __('View As', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '2' => esc_html__('2 Column', 'dservice-core'),
                    '3' => esc_html__('3 Column', 'dservice-core'),
                ],
            ]
        );

        $this->add_control(
            'user',
            [
                'label' => __('Only For Logged In User?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'redirect',
            [
                'label' => __('Redirect User?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __('Redirect Link', 'dservice-core'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '',
                ],
                'separator' => 'before',
                'condition' => [
                    'redirect' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'number_cat',
            [
                'label' => __('Number of Listings to Show:', 'dservice-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'default' => 3,
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label' => __('Order by', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'title' => esc_html__(' Title', 'dservice-core'),
                    'date' => esc_html__(' Date', 'dservice-core'),
                    'price' => esc_html__(' Price', 'dservice-core'),
                ],
            ]
        );

        $this->add_control(
            'order_list',
            [
                'label' => __('Listings Order', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc' => esc_html__(' ASC', 'dservice-core'),
                    'desc' => esc_html__(' DESC', 'dservice-core'),
                ],
            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label' => __('Show Pagination?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $show_pagination = $settings['show_pagination'];
        $title = $settings['title'];
        $layout = $settings['layout'];
        $number_cat = $settings['number_cat'];
        $order_by = $settings['order_by'];
        $order_list = $settings['order_list'];
        $user = $settings['user'];
        $web = 'yes' == $user ? $settings['link']['url'] : ''; ?>

        <input type="hidden" id="listing-listings_with_map">

    <?php echo do_shortcode('[directorist_category view="listings_with_map" orderby="' . esc_attr($order_by) . '" order="' . esc_attr($order_list) . '" listings_per_page="' . esc_attr($number_cat) . '" header="yes" header_title ="' . esc_attr($title) . '" show_pagination="' . esc_attr($show_pagination) . '" logged_in_user_only="' . esc_attr($user) . '" redirect_page_url="' . esc_attr($web) . '" listings_with_map_columns="' . esc_attr($layout) . '"]');
    }
}

//Single location
class Dservice_SingleLoc extends Widget_Base
{
    public function get_name()
    {
        return 'single_loc';
    }

    public function get_title()
    {
        return __('Single Location', 'dservice-core');
    }

    public function get_icon()
    {
        return ' eicon-map-pin';
    }

    public function get_keywords()
    {
        return ['single location', 'need location', 'location',];
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'single_loc',
            [
                'label' => __('Single Listing Location', 'dservice-core'),
            ]
        );

        $this->add_control(
            'types',
            [
                'label'    => __('Specify Listing Types', 'dservice-core'),
                'type'     => Controls_Manager::SELECT2,
                'multiple' => true,
                'options'  => function_exists('directorist_listing_types') ? directorist_listing_types() : [],
                'default'  => ['general'],
            ]
        );
        
        $this->add_control(
            'default_types',
            [
                'label'    => __('Set Default Listing Type', 'dservice-core'),
                'type'     => Controls_Manager::SELECT,
                'multiple' => true,
                'options'  => function_exists('directorist_listing_types') ? directorist_listing_types() : [],
                'default'  => 'general',
            ]
        );

        $this->add_control(
            'header',
            [
                'label'   => __('Show Header?', 'dservice-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => __('Listings Found Text', 'dservice-core'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Listings Found', 'dservice-core'),
                'label_block' => true,
                'condition'   => [
                    'header' => 'yes'
                ]

            ]
        );

        $this->add_control(
            'filter',
            [
                'label'   => __('Show More Filter?', 'dservice-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'layout',
            [
                'label'   => __('View As', 'dservice-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid' => esc_html__('Grid View', 'dservice-core'),
                    'list' => esc_html__('List View', 'dservice-core'),
                    'map'  => esc_html__('Map View', 'dservice-core'),
                ],
            ]
        );

        $this->add_control(
            'sidebar',
            [
                'label'     => __('Show sidebar?', 'dservice-core'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'no',
                'condition' => [
                    'layout!' => 'map'
                ]
            ]
        );

        $this->add_control(
            'user',
            [
                'label'   => __('Only For Logged In User?', 'dservice-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'redirect',
            [
                'label'   => __('Redirect User?', 'dservice-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'link',
            [
                'label'     => __('Redirect Link', 'dservice-core'),
                'type'      => Controls_Manager::URL,
                'condition' => [
                    'redirect' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'row',
            [
                'label'   => __('Listings Per Row', 'dservice-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '5' => esc_html__('5 Items / Row', 'dservice-core'),
                    '4' => esc_html__('4 Items / Row', 'dservice-core'),
                    '3' => esc_html__('3 Items / Row', 'dservice-core'),
                    '2' => esc_html__('2 Items / Row', 'dservice-core'),
                ],
                'condition' => [
                    'layout' => 'grid'
                ]
            ]
        );

        $this->add_control(
            'map_height',
            [
                'label'     => __('Map Height', 'dservice-core'),
                'type'      => Controls_Manager::NUMBER,
                'min'       => 300,
                'max'       => 1980,
                'default'   => 500,
                'condition' => [
                    'layout' => 'map'
                ]
            ]

        );

        $this->add_control(
            'number_cat',
            [
                'label'   => __('Number of Listings to Show:', 'dservice-core'),
                'type'    => Controls_Manager::NUMBER,
                'min'     => 1,
                'max'     => 100,
                'default' => 3,
            ]
        );

        $this->add_control(
            'cat',
            [
                'label'    => __('Specify Categories', 'dservice-core'),
                'type'     => Controls_Manager::SELECT2,
                'multiple' => true,
                'options'  => function_exists('dservice_listing_category') ? dservice_listing_category() : [],
            ]
        );

        $this->add_control(
            'tag',
            [
                'label'    => __('Specify Tags', 'dservice-core'),
                'type'     => Controls_Manager::SELECT2,
                'multiple' => true,
                'options'  => function_exists('dservice_listing_tags') ? dservice_listing_tags() : []
            ]
        );

        $this->add_control(
            'location',
            [
                'label'    => __('Specify Locations', 'dservice-core'),
                'type'     => Controls_Manager::SELECT2,
                'multiple' => true,
                'options'  => function_exists('dservice_listing_locations') ? dservice_listing_locations() : []
            ]
        );

        $this->add_control(
            'featured',
            [
                'label'   => __('Show Featured Only?', 'dservice-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'popular',
            [
                'label'   => __('Show Popular Only?', 'dservice-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label'   => __('Order by', 'dservice-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'title' => esc_html__(' Title', 'dservice-core'),
                    'date'  => esc_html__(' Date', 'dservice-core'),
                    'price' => esc_html__(' Price', 'dservice-core'),
                ],
                'condition' => [
                    'layout!' => 'map'
                ]
            ]
        );

        $this->add_control(
            'order_list',
            [
                'label'   => __('Listings Order', 'dservice-core'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc'  => esc_html__(' ASC', 'dservice-core'),
                    'desc' => esc_html__(' DESC', 'dservice-core'),
                ],
                'condition' => [
                    'layout!' => 'map'
                ]
            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label'   => __('Show Pagination?', 'dservice-core'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings        = $this->get_settings_for_display();
        $default_types = $settings['default_types'];
        $types = $settings['types'] ? implode( ',', $settings['types'] ) : '';
        $header          = $settings['header'];
        $default_types = $settings['default_types'];
        $types = $settings['types'] ? implode( ',', $settings['types'] ) : '';
        $filter          = 'yes' == $settings['filter'] ? $settings['filter'] : 'no';
        $sidebar         = $settings['sidebar'];
        $show_pagination = $settings['show_pagination'];
        $title           = $settings['title'];
        $layout          = $settings['layout'];
        $number_cat      = $settings['number_cat'];
        $row             = $settings['row'];
        $cat             = $settings['cat'] ? implode(',', $settings['cat']) : '';
        $location        = $settings['location'] ? implode(',', $settings['location']) : '';
        $tag             = $settings['tag'] ? implode(',', $settings['tag']) : '';
        $featured        = $settings['featured'];
        $popular         = $settings['popular'];
        $order_by        = $settings['order_by'];
        $order_list      = $settings['order_list'];
        $map_height      = $settings['map_height'];
        $user            = $settings['user'];
        $web             = 'yes' == $user ? $settings['link']['url'] : '';

        echo do_shortcode('[directorist_location view="' . esc_attr($layout) . '" orderby="' . esc_attr($order_by) . '" order="' . esc_attr($order_list) . '" listings_per_page="' . esc_attr($number_cat) . '" category="' . esc_attr($cat) . '" tag="' . esc_attr($tag) . '" location="' . esc_attr($location) . '" featured_only="' . esc_attr($featured) . '" popular_only="' . esc_attr($popular) . '" header="' . esc_attr($header) . '" header_title ="' . esc_attr($title) . '" columns="' . esc_attr($row) . '" action_before_after_loop="' . esc_attr($sidebar) . '" show_pagination="' . esc_attr($show_pagination) . '" advanced_filter="' . esc_attr($filter) . '" map_height="' . $map_height . '" display_preview_image="yes" logged_in_user_only="' . esc_attr($user) . '" redirect_page_url="' . esc_attr($web) . '" directory_type="' . $types . '" default_directory_type="' . $default_types . '" directory_type="' . $types . '" default_directory_type="' . $default_types . '"]');
    }
}

//Single category map
class dservice_SingleLocMap extends Widget_Base
{
    public function get_name()
    {
        return 'single_loc_map';
    }

    public function get_title()
    {
        return __('Single Location Map View', 'dservice-core');
    }

    public function get_icon()
    {
        return ' eicon-google-maps';
    }

    public function get_keywords()
    {
        return ['single location', 'need location', 'location',];
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'single_loc_map',
            [
                'label' => __('Single Location Map View', 'dservice-core'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Listings Found Text', 'dservice-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Listings Found', 'dservice-core'),
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => __('View As', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '2' => esc_html__('2 Column', 'dservice-core'),
                    '3' => esc_html__('3 Column', 'dservice-core'),
                ],
            ]
        );

        $this->add_control(
            'user',
            [
                'label' => __('Only For Logged In User?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'redirect',
            [
                'label' => __('Redirect User?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __('Redirect Link', 'dservice-core'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '',
                ],
                'separator' => 'before',
                'condition' => [
                    'redirect' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'number_cat',
            [
                'label' => __('Number of Listings to Show:', 'dservice-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'default' => 3,
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label' => __('Order by', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'title' => esc_html__(' Title', 'dservice-core'),
                    'date' => esc_html__(' Date', 'dservice-core'),
                    'price' => esc_html__(' Price', 'dservice-core'),
                ],
            ]
        );

        $this->add_control(
            'order_list',
            [
                'label' => __('Listings Order', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc' => esc_html__(' ASC', 'dservice-core'),
                    'desc' => esc_html__(' DESC', 'dservice-core'),
                ],
            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label' => __('Show Pagination?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $show_pagination = $settings['show_pagination'];
        $title = $settings['title'];
        $layout = $settings['layout'];
        $number_cat = $settings['number_cat'];
        $order_by = $settings['order_by'];
        $order_list = $settings['order_list'];
        $user = $settings['user'];
        $web = 'yes' == $user ? $settings['link']['url'] : ''; ?>

        <input type="hidden" id="listing-listings_with_map">

    <?php echo do_shortcode('[directorist_location view="listings_with_map" orderby="' . esc_attr($order_by) . '" order="' . esc_attr($order_list) . '" listings_per_page="' . esc_attr($number_cat) . '" header="yes" header_title ="' . esc_attr($title) . '" show_pagination="' . esc_attr($show_pagination) . '" logged_in_user_only="' . esc_attr($user) . '" redirect_page_url="' . esc_attr($web) . '" listings_with_map_columns="' . esc_attr($layout) . '"]');
    }
}

//Single tag
class dservice_SingleTag extends Widget_Base
{
    public function get_name()
    {
        return 'single_tag';
    }

    public function get_title()
    {
        return __('Single Tag', 'dservice-core');
    }

    public function get_icon()
    {
        return ' eicon-tags';
    }

    public function get_keywords()
    {
        return ['single tag', 'need tag', 'tag',];
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'single_tag',
            [
                'label' => __('Single Listing Tag', 'dservice-core'),
            ]
        );

        $this->add_control(
            'types',
            [
                'label'    => __('Specify Listing Types', 'direo-core'),
                'type'     => Controls_Manager::SELECT2,
                'multiple' => true,
                'options'  => function_exists('directorist_listing_types') ? directorist_listing_types() : [],
                'default'  => ['general'],
            ]
        );
        
        $this->add_control(
            'default_types',
            [
                'label'    => __('Set Default Listing Type', 'direo-core'),
                'type'     => Controls_Manager::SELECT,
                'multiple' => true,
                'options'  => function_exists('directorist_listing_types') ? directorist_listing_types() : [],
                'default'  => 'general',
            ]
        );

        $this->add_control(
            'header',
            [
                'label' => __('Show Header?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Listings Found Text', 'dservice-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Listings Found', 'dservice-core'),
                'dynamic' => [
                    'active' => true,
                ],
                'label_block' => true,
                'condition' => [
                    'header' => 'yes'
                ]

            ]
        );
        $this->add_control(
            'filter',
            [
                'label' => __('Show More Filter?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );
        $this->add_control(
            'user',
            [
                'label' => __('Only For Logged In User?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'redirect',
            [
                'label' => __('Redirect User?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __('Redirect Link', 'dservice-core'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '',
                ],
                'separator' => 'before',
                'condition' => [
                    'redirect' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => __('View As', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'grid' => esc_html__('Grid View', 'dservice-core'),
                    'list' => esc_html__('List View', 'dservice-core'),
                    'map' => esc_html__('Map View', 'dservice-core'),
                ],
            ]
        );

        $this->add_control(
            'row',
            [
                'label' => __('Listings Per Row', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '5' => esc_html__('5 Items / Row', 'dservice-core'),
                    '4' => esc_html__('4 Items / Row', 'dservice-core'),
                    '3' => esc_html__('3 Items / Row', 'dservice-core'),
                    '2' => esc_html__('2 Items / Row', 'dservice-core'),
                ],
                'condition' => [
                    'layout' => 'grid'
                ]
            ]
        );

        $this->add_control(
            'map_height',
            [
                'label' => __('Map Height', 'dservice-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 300,
                'max' => 1980,
                'default' => 500,
                'condition' => [
                    'layout' => 'map'
                ]
            ]

        );

        $this->add_control(
            'number_cat',
            [
                'label' => __('Number of Listings to Show:', 'dservice-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'default' => 3,
            ]
        );

        $this->add_control(
            'cat',
            [
                'label' => __('Specify Categories', 'dservice-core'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => function_exists('dservice_listing_category') ? dservice_listing_category() : []
            ]
        );

        $this->add_control(
            'tag',
            [
                'label' => __('Specify Tags', 'dservice-core'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => function_exists('dservice_listing_tags') ? dservice_listing_tags() : []
            ]
        );

        $this->add_control(
            'location',
            [
                'label' => __('Specify Locations', 'dservice-core'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => function_exists('dservice_listing_locations') ? dservice_listing_locations() : []
            ]
        );

        $this->add_control(
            'featured',
            [
                'label' => __('Show Featured Only?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'popular',
            [
                'label' => __('Show Popular Only?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label' => __('Order by', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'title' => esc_html__(' Title', 'dservice-core'),
                    'date' => esc_html__(' Date', 'dservice-core'),
                    'price' => esc_html__(' Price', 'dservice-core'),
                ],
                'condition' => [
                    'layout!' => 'map'
                ]
            ]
        );

        $this->add_control(
            'order_list',
            [
                'label' => __('Listings Order', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc' => esc_html__(' ASC', 'dservice-core'),
                    'desc' => esc_html__(' DESC', 'dservice-core'),
                ],
                'condition' => [
                    'layout!' => 'map'
                ]
            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label' => __('Show Pagination?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $default_types = $settings['default_types'];
        $types = $settings['types'] ? implode( ',', $settings['types'] ) : '';
        $header = $settings['header'];
        $filter = 'yes' == $settings['filter'] ? $settings['filter'] : 'no';
        $show_pagination = $settings['show_pagination'];
        $title = $settings['title'];
        $layout = $settings['layout'];
        $number_cat = $settings['number_cat'];
        $row = $settings['row'];
        $cat = $settings['cat'] ? implode($settings['cat'], []) : '';
        $location = $settings['location'] ? implode($settings['location'], []) : '';
        $tag = $settings['tag'] ? implode($settings['tag'], []) : '';
        $featured = $settings['featured'];
        $popular = $settings['popular'];
        $order_by = $settings['order_by'];
        $order_list = $settings['order_list'];
        $map_height = $settings['map_height'];
        $user = $settings['user'];
        $web = 'yes' == $user ? $settings['link']['url'] : '';

        echo do_shortcode('[directorist_tag view="' . esc_attr($layout) . '" orderby="' . esc_attr($order_by) . '" order="' . esc_attr($order_list) . '" listings_per_page="' . esc_attr($number_cat) . '" category="' . esc_attr($cat) . '" tag="' . esc_attr($tag) . '" location="' . esc_attr($location) . '" featured_only="' . esc_attr($featured) . '" popular_only="' . esc_attr($popular) . '" header="' . esc_attr($header) . '" header_title ="' . esc_attr($title) . '" columns="' . esc_attr($row) . '" show_pagination="' . esc_attr($show_pagination) . '" advanced_filter="' . esc_attr($filter) . '" map_height="' . $map_height . '" display_preview_image="yes" logged_in_user_only="' . esc_attr($user) . '" redirect_page_url="' . esc_attr($web) . '" directory_type="' . $types . '" default_directory_type="' . $default_types . '"]');
    }
}

//Single category tag
class dservice_SingleTagMap extends Widget_Base
{
    public function get_name()
    {
        return 'single_tag_map';
    }

    public function get_title()
    {
        return __('Single Tag Map View', 'dservice-core');
    }

    public function get_icon()
    {
        return ' eicon-google-maps';
    }

    public function get_keywords()
    {
        return ['single tag', 'need tag', 'tag',];
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'single_tag_map',
            [
                'label' => __('Single Tag Map View', 'dservice-core'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Listings Found Text', 'dservice-core'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Listings Found', 'dservice-core'),
            ]
        );

        $this->add_control(
            'layout',
            [
                'label' => __('View As', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '2' => esc_html__('2 Column', 'dservice-core'),
                    '3' => esc_html__('3 Column', 'dservice-core'),
                ],
            ]
        );

        $this->add_control(
            'user',
            [
                'label' => __('Only For Logged In User?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'redirect',
            [
                'label' => __('Redirect User?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => __('Redirect Link', 'dservice-core'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => '',
                ],
                'separator' => 'before',
                'condition' => [
                    'redirect' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'number_cat',
            [
                'label' => __('Number of Listings to Show:', 'dservice-core'),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 100,
                'default' => 3,
            ]
        );

        $this->add_control(
            'order_by',
            [
                'label' => __('Order by', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => [
                    'title' => esc_html__(' Title', 'dservice-core'),
                    'date' => esc_html__(' Date', 'dservice-core'),
                    'price' => esc_html__(' Price', 'dservice-core'),
                ],
            ]
        );

        $this->add_control(
            'order_list',
            [
                'label' => __('Listings Order', 'dservice-core'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => [
                    'asc' => esc_html__(' ASC', 'dservice-core'),
                    'desc' => esc_html__(' DESC', 'dservice-core'),
                ],
            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label' => __('Show Pagination?', 'dservice-core'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $show_pagination = $settings['show_pagination'];
        $title = $settings['title'];
        $layout = $settings['layout'];
        $number_cat = $settings['number_cat'];
        $order_by = $settings['order_by'];
        $order_list = $settings['order_list'];
        $user = $settings['user'];
        $web = 'yes' == $user ? $settings['link']['url'] : ''; ?>

        <input type="hidden" id="listing-listings_with_map">

    <?php echo do_shortcode('[directorist_tag view="listings_with_map" orderby="' . esc_attr($order_by) . '" order="' . esc_attr($order_list) . '" listings_per_page="' . esc_attr($number_cat) . '" header="yes" header_title ="' . esc_attr($title) . '" show_pagination="' . esc_attr($show_pagination) . '" logged_in_user_only="' . esc_attr($user) . '" redirect_page_url="' . esc_attr($web) . '" listings_with_map_columns="' . esc_attr($layout) . '"]');
    }
}

//Team
class dservice_Team extends Widget_Base
{

    public function get_name()
    {
        return 'team';
    }

    public function get_title()
    {
        return __('Team Members', 'dservice-core');
    }

    public function get_icon()
    {
        return ' eicon-person';
    }

    public function get_keywords()
    {
        return ['team', 'member'];
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'team',
            [
                'label' => __('Team Members Info', 'dservice-core'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Member Name', 'dservice-core'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Tom Modie',
                'label_block' => true
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Profile picture', 'dservice-core'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'designation',
            [
                'label' => esc_html__('Designation', 'dservice-core'),
                'type' => Controls_Manager::TEXT,
                'default' => 'CTO @ DroitLab',
                'label_block' => true
            ]
        );

        $this->add_control(
            'teams',
            [
                'label' => __('Team Member', 'dservice-core'),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ name }}}',
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $teams = $settings['teams']; ?>

        <div class="row team-wrapper">
            <?php
            foreach ($teams as $team) {
                $image_alt = function_exists('dservice_get_image_alt') ? dservice_get_image_alt($team['image']['id']) : ''; ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="team-single">
                        <figure>
                            <img src="<?php echo esc_url($team['image']['url']) ?>" alt="<?php echo esc_attr($image_alt); ?>">
                            <figcaption>
                                <h5><?php echo esc_attr($team['name']); ?></h5>
                                <p><?php echo esc_attr($team['designation']); ?></p>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            <?php
            }
            wp_reset_postdata(); ?>
        </div>

    <?php
    }
}

//Testimonial
class dservice_Testimonial extends Widget_Base
{
    public function get_name()
    {
        return 'testimonials';
    }

    public function get_title()
    {
        return __('Testimonials', 'dservice-core');
    }

    public function get_icon()
    {
        return 'eicon-testimonial-carousel';
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    public function get_keywords()
    {
        return ['testimonial', 'client', 'testi'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'Testimonials',
            [
                'label' => __('Testimonials', 'dservice-core'),
            ]
        );

        $this->add_control(
            'testimonials',
            [
                'label' => __('Testimonials', 'dservice-core'),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ name }}}',
                'fields' => [
                    [
                        'name' => 'logo',
                        'label' => __('Client Logo', 'dservice-core'),
                        'type' => Controls_Manager::MEDIA,
                    ],
                    [
                        'name' => 'name',
                        'label' => __('Name', 'dservice-core'),
                        'type' => Controls_Manager::TEXT,
                        'label_block' => true,
                        'default' => 'Mark Tony'
                    ],
                    [
                        'name' => 'desc',
                        'label' => __('Testimonial Text', 'dservice-core'),
                        'type' => Controls_Manager::TEXTAREA,
                    ],
                    [
                        'name' => 'image',
                        'label' => __('Author Image', 'dservice-core'),
                        'type' => Controls_Manager::MEDIA,
                    ],
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $testimonials = $settings['testimonials']; ?>

        <div class="customers-testimonials owl-carousel">
            <?php
            if ($testimonials) {
                foreach ($testimonials as $test) {
                    $name = $test['name'];
                    $logo = $test['logo'];
                    $desc = $test['desc'];
                    $image = $test['image'];
                    $image_alt = function_exists('dservice_get_image_alt') ? dservice_get_image_alt($logo['id']) : ''; ?>
                    <div class="item">
                        <div class="card text-center border-0">
                            <div class="d-flex justify-content-center  card_inner">
                                <a href="#">
                                    <img src="<?php echo esc_url($logo['url']); ?>" class="w-100" alt="<?php echo esc_attr($image_alt); ?>">
                                </a>
                            </div>
                            <div class="card-body">
                                <p class="card-text text-capitalize"> <?php echo esc_attr($desc); ?> </p>
                                <a class="" href="#">
                                    <div class="info-client">
                                        <span class="info-client__icon">
                                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image_alt); ?>">
                                        </span>
                                        <span class="info-client__name"><?php echo esc_attr($name); ?></span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
            <?php
                }
                wp_reset_postdata();
            } ?>
        </div>

    <?php
    }
}

//Booking Confirmation
class dservice_Booking extends Widget_Base
{
    public function get_name()
    {
        return 'booking';
    }

    public function get_title()
    {
        return __('Booking Confirmation', 'dservice-core');
    }

    public function get_icon()
    {
        return 'eicon-check-circle-o';
    }

    public function get_categories()
    {
        return ['dservice_category'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'booking',
            [
                'label' => __('Styling', 'dservice-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'booking_margin',
            [
                'label' => __('margin', 'dservice-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'booking_padding',
            [
                'label' => __('Padding', 'dservice-core'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}}' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    { ?>
        <div class="dservice-directorist_booking_confirmation">
            <?php echo do_shortcode('[directorist_booking_confirmation]'); ?>
        </div>
<?php
    }
}
