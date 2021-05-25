<?php
/**
 * Description.
 *
 * @package WordPress
 * @author  AazzTech
 * @since   1.0
 * @version 1.0
 */

use \Directorist\Directorist_Listing_Search_Form;
use \Directorist\Helper;
//Listings view as .
function dservice_listings_view_as(){
?>
    <div class="view-mode">
        <a class="action-btn ab-grid" href="<?php echo add_query_arg('view', 'grid'); ?>">
            <span class="la la-th-large"></span>
        </a>
        <a class="action-btn ab-list" href="<?php echo add_query_arg('view', 'list'); ?>">
            <span class="la la-th-list"></span>
        </a>
        <a class="action-btn ab-map" href="<?php echo add_query_arg('view', 'map'); ?>">
            <span class="la la-map"></span>
        </a>
    </div>
    <?php
}

add_filter('atbdp_listings_header_sort_by_button', 'dservice_listings_view_as', 10, 3);

//View as of "listing with map view" .
function dservice_listings_map_view_as()
{
    $listing_map_view = get_directorist_option('listing_map_view', 'grid');
    $view_as          = isset($_POST['view_as']) ? $_POST['view_as'] : $listing_map_view;
?>
    <div class="view-mode-2 view-as">
        <a data-view="grid" class="action-btn-2 ab-grid map-view-grid <?php echo 'grid' == $view_as ? esc_html('active') : ''; ?>">
            <span class="la la-th-large"></span>
        </a>
        <a data-view="list" class="action-btn-2 ab-list map-view-list <?php echo 'list' == $view_as ? esc_html('active') : ''; ?>">
            <span class="la la-list"></span>
        </a>
    </div>
<?php
}

add_filter('atbdp_listings_with_map_header_sort_by_button', 'dservice_listings_map_view_as');

//All listing header short by naming.
function dservice_get_listings_orderby_options($sort_by_items)
{
    $options = array(
        'title-asc'  => esc_html__('A to Z Order', 'dservice-core'),
        'title-desc' => esc_html__('Z to A Order', 'dservice-core'),
        'date-desc'  => esc_html__('Latest Order', 'dservice-core'),
        'date-asc'   => esc_html__('Oldest Order', 'dservice-core'),
        'views-desc' => esc_html__('Popular Order', 'dservice-core'),
        'price-asc' => esc_html__('Price (low to high)', 'dservice-core'),
        'price-desc' => esc_html__('Price (high to low)', 'dservice-core'),
        'rand'       => esc_html__('Random Order', 'dservice-core'),
    );

    if (!in_array('a_z', $sort_by_items)) {
        unset($options['title-asc']);
    }
    if (!in_array('z_a', $sort_by_items)) {
        unset($options['title-desc']);
    }
    if (!in_array('latest', $sort_by_items)) {
        unset($options['date-desc']);
    }
    if (!in_array('oldest', $sort_by_items)) {
        unset($options['date-asc']);
    }
    if (!in_array('popular', $sort_by_items)) {
        unset($options['views-desc']);
    }
    if (!in_array('price_low_high', $sort_by_items)) {
        unset($options['price-asc']);
    }
    if (!in_array('price_high_low', $sort_by_items)) {
        unset($options['price-desc']);
    }
    if (!in_array('random', $sort_by_items)) {
        unset($options['rand']);
    }

    return $options;
}

//All listing header short by Config .
function dservice_after_filter_button_in_listings_header()
{
    $sort_by_items = get_directorist_option('listings_sort_by_items', array('a_z', 'z_a', 'latest', 'oldest', 'popular', 'price_low_high', 'price_high_low', 'random'));
    $options = dservice_get_listings_orderby_options($sort_by_items);
    if( !empty( $options ) ){ 
        $current_order = atbdp_get_listings_current_order('date' . '-' . 'desc');
        $current_order = !empty($current_order) ? $current_order : '';
        $default = array();
        foreach ($options as $value => $label) {
            if ($value == $current_order) {
                $default[] = $label;
            }
        }
        ?>
        <h5><?php echo esc_html__('Sort by:', 'dservice-core'); ?></h5>
        <div class="dropdown">
            <a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo $default[0]; ?>
                <span class="caret"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink2">
                <?php
                foreach ($options as $value => $label) {
                    $active_class = ($value == $current_order) ? ' active' : '';
                    echo sprintf('<a class="dropdown-item %s" href="%s">%s</a>', $active_class, add_query_arg('sort', $value), $label);
                }
                ?>
            </div>
        </div>
        <?php
    }
}

$display_sortby_dropdown = class_exists('Directorist_Base') ? get_directorist_option('display_sort_by', 1) : '';

if ( $display_sortby_dropdown ) {
    add_filter('bdmv_view_as', 'dservice_after_filter_button_in_listings_header', 10, 3);
    add_filter('atbdp_listings_view_as', 'dservice_after_filter_button_in_listings_header', 10, 3);
}

//Author avatar URL .
function dservice_get_avatar_url($author_id, $size)
{
    $match     = '';
    $get_avatar = get_avatar($author_id, $size);
    preg_match("/src='(.*?)'/i", $get_avatar, $matches);
    if ($matches) {
        if (array_key_exists('1', $matches)) {
            $match = ($matches[1]);
        }
    }
    return $match;
}

//Listing Home Search Button Add .
function dservice_search_form_fields($text = 'yes', $cat = 'yes', $loc = 'yes')
{
    if (!class_exists('Directorist_Base')) {
        return;
    }

    $require_text = get_directorist_option('require_search_text') ? 'required' : '';
    $require_cat  = get_directorist_option('require_search_category') ? 'required' : '';
    $require_loc  = get_directorist_option('require_search_location') ? 'required' : '';

    $search_location_address     = get_directorist_option('search_location_address', 'address');
    $search_fields               = get_directorist_option('search_tsc_fields', array('search_text', 'search_category', 'search_location'));
    $search_placeholder          = get_directorist_option('search_placeholder', esc_attr_x('What are you looking for?', 'placeholder', 'dservice-core'));
    $search_category_placeholder = get_directorist_option('search_category_placeholder', esc_html__('Select a category', 'dservice-core'));
    $search_location_placeholder = get_directorist_option('search_location_placeholder', esc_html__('Select a location', 'dservice-core'));
    $search_listing_text         = get_directorist_option('search_listing_text', esc_html__('Search', 'dservice-core'));

    $query_args = array(
        'parent'             => 0,
        'term_id'            => 0,
        'hide_empty'         => 0,
        'orderby'            => 'name',
        'order'              => 'asc',
        'show_count'         => 0,
        'single_only'        => 0,
        'pad_counts'         => true,
        'immediate_category' => 0,
        'active_term_id'     => 0,
        'ancestors'          => array(),
    );

    if ($text && in_array('search_text', $search_fields)) {
        $cat_off = !$cat ? 'dservice_' : '';
    ?>
        <div class="single_search_field <?php echo $cat_off; ?>search_query">
            <input class="form-control search_fields" type="text" name="q" <?php echo esc_attr($require_text); ?> autocomplete="off" placeholder="<?php echo esc_html($search_placeholder); ?>">
        </div>
    <?php
    }

    if ($cat && in_array('search_category', $search_fields)) {
    ?>
        <div class="single_search_field search_category" id="search_listing_category">
            <select <?php echo esc_attr($require_cat); ?> name="in_cat" class="search_fields form-control" id="at_biz_dir-category">
                <option value=""><?php echo esc_html($search_category_placeholder); ?></option>
                <?php echo search_category_location_filter($query_args, ATBDP_CATEGORY); ?>
            </select>
        </div>
        <?php
        do_action('atbdp_search_listing_after_category_field');
    }

    if ($loc && in_array('search_location', $search_fields)) {
        if ('listing_location' == $search_location_address) {
        ?>
            <div class="single_search_field search_location">
                <select <?php echo esc_attr($require_loc); ?> name="in_loc" class="search_fields form-control" id="at_biz_dir-location">
                    <option value=""><?php echo esc_html($search_location_placeholder); ?></option>
                    <?php echo search_category_location_filter($query_args, ATBDP_LOCATION); ?>
                </select>
            </div>
        <?php
        } else {
            wp_enqueue_script('atbdp-geolocation');
            $address = !empty($_GET['address']) ? $_GET['address'] : '';
        ?>
            <div class="single_search_field atbdp_map_address_field">
                <div class="atbdp_get_address_field">
                    <input type="text" id="address" name="address" autocomplete="off" value="<?php echo esc_attr($address); ?>" placeholder="<?php echo esc_html($search_location_placeholder); ?>" <?php echo esc_attr($require_loc); ?> class="form-control location-name">
                    <span class="atbd_get_loc la la-crosshairs"></span>
                </div>
                <?php
                $select_listing_map = get_directorist_option('select_listing_map', 'google');
                if ('google' != $select_listing_map) {
                    echo '<div class="address_result"></div>';
                }
                ?>
                <input type="hidden" id="cityLat" name="cityLat" value="" />
                <input type="hidden" id="cityLng" name="cityLng" value="" />
            </div>
    <?php
        }
    }
    ?>
    <div class="atbd_submit_btn">
        <button type="submit" class="btn_search">
            <i class="la la-search"></i><?php echo esc_attr($search_listing_text); ?>
        </button>
    </div>
    <?php
}

add_action('atbdp_search_form_fields', 'dservice_search_form_fields');

//Top search.
function dservice_popular_categories()
{
    $args = array(
        'type'          => ATBDP_POST_TYPE,
        'parent'        => 0,
        'orderby'       => 'count',
        'order'         => 'desc',
        'hide_empty'    => 1,
        'number'        => 5,
        'taxonomy'      => ATBDP_CATEGORY,
        'no_found_rows' => true,

    );
    $popular_cat = get_categories($args);
    if (!$popular_cat) {
    ?>
        <div class="search-categories">
            <ul class="list-unstyled">
                <?php
                foreach ($popular_cat as $key => $cat) {
                    $icon      = get_cat_icon($cat->term_id);
                    $icon_type = substr($icon, 0, 2);
                    $icon_name = ('la' === $icon_type) ? $icon_type . ' ' . $icon : 'fa ' . $icon;
                    $link      = ATBDP_Permalink::atbdp_get_category_page($cat);
                    echo sprintf('<li><a href="%s"><span class="bg-danger %s"></span><h5>%s</h5></a> </li>', esc_url($link), esc_attr($icon_name), esc_attr($cat->name));
                }
                ?>
            </ul>
        </div>
    <?php
    }
}

function dservice_quick_search()
{
    ob_start();
    $searchform = new Directorist_Listing_Search_Form( 'search_form', directory_listing_type() );
    $fields = $searchform->form_data[0]['fields'];
    $text_field = $fields && ! empty( $fields['title'] ) ? $fields['title'] : '';
    $location_field = $fields && ! empty( $fields['location'] ) ? $fields['location'] : '';
    if ( empty( $text_field ) && empty( $location_field ) ) return;
    ?>
    <div class="atbd_wrapper ads-advaced--wrapper">
        <div class="row">
            <div class="col-lg-12">
                <form action="<?php echo ATBDP_Permalink::get_search_result_page_link(); ?>" role="form" class="breadcrumb_quick_search">
                    <div class="atbd_seach_fields_wrapper">
                        <div class="atbdp-search-form">
                            <?php
                            $text_field ? $searchform->field_template( $text_field ) : '';
                            $location_field ? $searchform->field_template( $location_field ) : '';
                            ?>
                            <div class="quick_search_btn_wrapper">
                                <div class="atbd_submit_btn_wrapper">
                                    <div class="atbd_submit_btn">
                                        <button type="submit" class="btn btn-primary btn_search">
                                            <i class="la la-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
        <?php
    return ob_get_clean();
}

add_shortcode('dservice_quick_search_form', 'dservice_quick_search');

//Listing Business Hour badge Move .
function dservice_listings_review_price()
{
    $post_id                 = get_the_ID();
    $display_review          = get_directorist_option('enable_review', 1);
    $bdbh                    = get_post_meta($post_id, '_bdbh', true);
    $enable247hour           = get_post_meta($post_id, '_enable247hour', true);
    $disable_bz_hour_listing = get_post_meta($post_id, '_disable_bz_hour_listing', true);
    $business_hours          = $bdbh ? atbdp_sanitize_array($bdbh) : array();
    $reviews_count           = ATBDP()->review->db->count(array('post_id' => $post_id));
    $average                 = ATBDP()->review->get_average(get_the_ID());
    $average_int_float       = !strchr($average, '.') ? $average . '.0' : $average;
    ?>

    <div class="atbd_listing_meta">
        <?php if ($display_review) { ?>
            <div class="atbd_rated_stars">
                <ul>
                    <?php
                    $review_title = '';
                    if ( $reviews_count ) {
                        $review_title = 1 == $reviews_count ? $reviews_count . esc_html__(' Review', 'dservice-core') : $reviews_count . esc_html__(' Reviews', 'dservice-core');
                    }
                    $star      = '<i class="la la-star rate_active"></i>';
                    $half_star = '<i class="la la-star-half-o rate_active"></i>';
                    $none_star = '<i class="la la-star-o"></i>';

                    if (!strchr($average, '.')) {
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $average) {
                                echo wp_kses_post($star);
                            } else {
                                echo wp_kses_post($none_star);
                            }
                        }
                    } elseif (strchr($average, '.')) {
                        $exp       = explode('.', $average);
                        $float_num = $exp[0];

                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $average) {
                                echo wp_kses_post($star);
                            } elseif (!empty($average) && $i > $average && $i <= $float_num + 1) {
                                echo wp_kses_post($half_star);
                            } else {
                                echo wp_kses_post($none_star);
                            }
                        }
                    }
                    echo sprintf('<span class="atbd_count"><span>%s</span> %s </span>', esc_attr($average_int_float), esc_attr($review_title));
                    ?>
                </ul>
            </div>
            <?php
        }

        $plan_hours = true;
        if (is_fee_manager_active()) {
            $plan_hours = is_plan_allowed_business_hours(get_post_meta($post_id, '_fm_plans', true));
        }
        if (is_business_hour_active() && $plan_hours && !$disable_bz_hour_listing) {
            $open = get_directorist_option('open_badge_text', esc_html__('Open Now', 'dservice-core'));
            if ($enable247hour) {
                echo sprintf('<span class="atbd_upper_badge"><span class="atbd_badge atbd_badge_open">%s</span></span>', esc_attr($open));
            } else {
                echo sprintf('<span class="atbd_upper_badge">%s</span>', BD_Business_Hour()->show_business_open_close($business_hours));
            }
        }
        ?>
    </div>

    <?php
}

add_filter('atbdp_listings_review_price', 'dservice_listings_review_price');
add_filter('atbdp_listings_list_review_price', 'dservice_listings_review_price');

//Listing Business Featured badge Move .
function dservice_upper_badge($content)
{
    $featured                  = get_post_meta(get_the_ID(), '_featured', true);
    $display_feature_badge_cart = get_directorist_option('display_feature_badge_cart', 1);
    $feature_badge_text         = get_directorist_option('feature_badge_text', 'Featured');
    $display_popular_badge_cart = get_directorist_option('display_popular_badge_cart', 1);
    $popular_badge_text         = get_directorist_option('popular_badge_text', 'Popular');
    $popular_listing_id         = atbdp_popular_listings(get_the_ID());
    ?>

    <span class="atbd_upper_badge">
        <?php
        echo new_badge();
        if ($featured && !empty($display_feature_badge_cart)) {
            $featured = sprintf('<span class="atbd_badge atbd_badge_featured">%s</span>', esc_attr($feature_badge_text));
            echo apply_filters('atbdp_featured_badge', $featured);
        }
        if ($display_popular_badge_cart && ($popular_listing_id === get_the_ID())) {
            echo sprintf('<span class="atbd_badge atbd_badge_popular">%s</span>', esc_attr($popular_badge_text));
        }
        ?>
    </span>
    <?php
}

add_filter('atbdp_upper_badges', 'dservice_upper_badge', 20, 1);

//Directorist single listing details title .
function dservice_single_listings_settings_fields($settings)
{
    $new_setting = array(
        'type'    => 'textbox',
        'name'    => 'dservice_details_text',
        'label'   => esc_html__('Section Title of Listing Gallery', 'dservice-core'),
        'default' => esc_html__('Gallery', 'dservice-core'),
    );
    array_push($settings, $new_setting);
    return $settings;
}

add_filter('atbdp_single_listings_settings_fields', 'dservice_single_listings_settings_fields');


function dservice_all_need_categories_after_category_name($html, $term)
{
    $count = atbdp_listings_count_by_category($term->term_id);

    $expired_listings  = atbdp_get_expired_listings(ATBDP_CATEGORY, $term->term_id);
    $number_of_expired = $expired_listings->post_count;
    $number_of_expired = !empty($number_of_expired) ? $number_of_expired : '0';
    $total             = ($count) ? ($count - $number_of_expired) : $count;

    return 1 < $total ? sprintf('<p>%s</p>', $total . esc_html__(' Listings', 'dservice-core')) : sprintf('<p>%s</p>', $total . esc_html__(' Listing', 'dservice-core'));
}

add_filter('atbdp_all_need_categories_after_category_name', 'dservice_all_need_categories_after_category_name', 10, 2);

/*========================================================
   Directorist atbdp_search_listing dependency maintain
========================================================= */
function dservice_search_listing_jquery_dependency($search_dependency)
{
    $dependency = array('bootstrap');
    array_push($search_dependency, $dependency);

    return $dependency;
}

add_filter('atbdp_search_listing_jquery_dependency', 'dservice_search_listing_jquery_dependency');

/*========================================================
   Directorist atbdp_search_listing dependency maintain
========================================================= */
function my_login_fail()
{
    $referrer = $_SERVER['HTTP_REFERER'];
    if ($referrer && !strstr($referrer, 'wp-login') && !strstr($referrer, 'wp-admin')) {
        wp_redirect($referrer . '?login=failed');
        exit;
    }
}

add_action('wp_login_failed', 'my_login_fail');

/*========================================================
    Login and Register popup
========================================================*/
$quick_log_reg = get_theme_mod('quick_log_reg', true);
if ($quick_log_reg) {

    function login_for_booking() {
		$login_url = get_theme_mod( 'login_btn_url', false );
		if ( $login_url ) {
			return sprintf( '<a href="%s" class="login-booking">%s</a>', esc_url( $login_url ), __( 'Logins for Booking', 'dservice-core' ) );
		} else {
			return sprintf( '<a href="#" class="login-booking" data-toggle="modal" data-target="#login_modal">%s</a>', __( 'Logins for Booking', 'dservice-core' ) );
		}
	}
    add_filter( 'login_for_booking', 'login_for_booking' );

    function dservice_listing_form_login_link()
    {
        $login_url = get_theme_mod('login_btn_url', false);
        $login     = get_theme_mod('login_btn', 'Sign in');
        if ($login_url) {
            return sprintf('<a href="%s" class="access-link">%s</a>', esc_url($login_url), esc_attr($login));
        } else {
            return sprintf('<a href="#" class="access-link" data-toggle="modal" data-target="#login_modal">%s</a>', esc_attr($login));
        }
    }

    add_filter('atbdp_listing_form_login_link', 'dservice_listing_form_login_link');
    add_filter('atbdp_user_dashboard_login_link', 'dservice_listing_form_login_link');
    add_filter('atbdp_review_login_link', 'dservice_listing_form_login_link');
    add_filter('atbdp_claim_now_login_link', 'dservice_listing_form_login_link');
    add_filter('atbdp_login_page_link', 'dservice_listing_form_login_link');

    function dservice_listing_form_signup_link()
    {
        $register_url = get_theme_mod('register_btn_url', false);
        $register     = get_theme_mod('register_btn', 'Sign Up');

        if ($register_url) {
            return sprintf('<a href="%s" class="access-link">%s</a>', esc_url($register_url), esc_attr($register));
        } else {
            return sprintf('<a href="#" class="access-link" data-toggle="modal"  data-target="#signup_modal">%s</a>', esc_attr($register));
        }
    }

    add_filter('atbdp_listing_form_signup_link', 'dservice_listing_form_signup_link');
    add_filter('atbdp_user_dashboard_signup_link', 'dservice_listing_form_signup_link');
    add_filter('atbdp_review_signup_link', 'dservice_listing_form_signup_link');
    add_filter('atbdp_claim_now_registration_link', 'dservice_listing_form_signup_link');
    add_filter('atbdp_signup_page_link', 'dservice_listing_form_signup_link');
}


/*========================================================
    All Listing Location and Category image size
========================================================*/
function dservice_location_image_size()
{
    return array(540, 270);
}

add_filter('atbdp_location_image_size', 'dservice_location_image_size');

function dservice_category_image_size()
{
    return array(350, 250);
}

add_filter('atbdp_category_image_size', 'dservice_category_image_size');

/*========================================================
    replace list view container class
========================================================*/
function dservice_list_view_container()
{
    return esc_html('list_view_container');
}

add_filter('list_view_container', 'dservice_list_view_container');

/*========================================================
    removed all section container-fluid
========================================================*/
function dservice_cat_container_fluid()
{
    return esc_html('row');
}

add_filter('atbdp_cat_container_fluid', 'dservice_cat_container_fluid');

/*========================================================
    removed all section container-fluid
========================================================*/
function dservice_remove_unnecessary_hook_for_need()
{
    $is_need = get_post_meta(get_the_ID(), '_need_post', true);
    if ('yes' === $is_need) {
        return;
    }
}

add_filter('atbdp_listing_map_info_window', 'dservice_remove_unnecessary_hook_for_need');

add_filter('atbdp_search_home_container_fluid', '__return_false');
add_filter('atbdp_public_profile_container_fluid', '__return_false');
add_filter('atbdp_payment_receipt_container_fluid', '__return_false');
add_filter('atbdp_login_message_container_fluid', '__return_false');
add_filter('atbdp_add_listing_container_fluid', '__return_false');
add_filter('atbdp_listings_header_container_fluid', '__return_false');
add_filter('atbdp_registration_container_fluid', '__return_false');
add_filter('atbdp_single_loc_grid_container_fluid', '__return_false');
add_filter('atbdp_deshboard_container_fluid', '__return_false');
add_filter('atbdp_listings_grid_container_fluid', '__return_false');
add_filter('atbdp_single_cat_header_container_fluid', '__return_false');
add_filter('atbdp_single_cat_grid_container_fluid', '__return_false');
add_filter('atbdp_single_cat_grid_container_fluid', '__return_false');
add_filter('atbdp_single_loc_header_container_fluid', '__return_false');
add_filter('atbdp_single_tag_header_container_fluid', '__return_false');
add_filter('atbdp_single_tag_header_container_fluid', '__return_false');
add_filter('atbdp_single_tag_grid_container_fluid', '__return_false');
add_filter('atbdp_search_result_header_container_fluid', '__return_false');
add_filter('atbdp_search_result_grid_container_fluid', '__return_false');
add_filter('atbdp_map_container', '__return_false');
add_filter('atbdp_single_lower_badges', '__return_false', 10, 1);
add_filter('atbdp_listing_title', '__return_false');
add_filter('atbdp_listing_tagline', '__return_false');
add_filter('atbdp_before_listing_title', '__return_false');
add_filter('atbdp_header_before_image_slider', '__return_false');
add_filter('atbdp_single_listing_gallery_section', '__return_false');
add_filter('include_style_settings', '__return_false');
add_filter('atbdp_mark_as_fav_for_list_view', '__return_false');
add_filter('atbdp_listing_form_view_count_field', '__return_false');
add_filter('atbdp_show_gallery_image_in_plan', '__return_false');
add_filter('atbdp_plan_gallery_compare', '__return_true');

add_action('atbdp_user_dashboard_booking_header_area', '__return_false');
//Removed extensions licence key's
add_filter('atbdp_licence_menu_for_booking', '__return_false');
add_filter('atbdp_licence_menu_for_business_hours', '__return_false');
add_filter('atbdp_licence_menu_for_claim_listing', '__return_false');
add_filter('atbdp_licence_menu_for_faqs', '__return_false');
add_filter('atbdp_licence_menu_for_recaptcha', '__return_false');
add_filter('atbdp_licence_menu_for_listings_map', '__return_false');
add_filter('atbdp_licence_menu_for_live_chat', '__return_false');
add_filter('atbdp_licence_menu_for_paypal', '__return_false');
add_filter('atbdp_licence_menu_for_post_your_need', '__return_false');
add_filter('atbdp_licence_menu_for_pricing_plan', '__return_false');
add_filter('atbdp_licence_menu_for_social_login', '__return_false');
add_filter('atbdp_licence_menu_for_stripe', '__return_false');
add_filter('atbdp_licence_menu_for_woo_pricing_plans', '__return_false');

/*========================================================
    removed all unnecessary options
========================================================*/
function dservice_remove_gateway_settings($settings)
{
    unset($settings['gateway_promotion']);
    return $settings;
}

add_filter('atbdp_gateway_settings_fields', 'dservice_remove_gateway_settings');

function dservice_remove_extension_promotion_settings($settings)
{
    unset($settings['extension_promotion_set']);
    return $settings;
}

add_filter('atbdp_extension_settings_fields', 'dservice_remove_extension_promotion_settings');


function dservice_search_result_settings_fields($settings)
{
    unset($settings['search_view_as']);
    unset($settings['search_view_as_items']);
    unset($settings['search_sort_by']);
    return $settings;
}

add_filter('atbdp_search_result_settings_fields', 'dservice_search_result_settings_fields');

function dservice_settings_menus($settings)
{
    unset($settings['categories_menu']);
    return $settings;
}

add_filter('atbdp_settings_menus', 'dservice_settings_menus');

function dservice_pages_settings_fields($settings)
{
    unset($settings['single_listing_page']);
    return $settings;
}

add_filter('atbdp_pages_settings_fields', 'dservice_pages_settings_fields');

function dservice_create_custom_pages($settings)
{
    unset($settings['single_listing_page']);
    return $settings;
}

add_filter('atbdp_create_custom_pages', 'dservice_create_custom_pages');

function dservice_remove_custom_pages($settings)
{
    unset($settings['single_listing_page']);
    return $settings;
}

add_filter('atbdp_pages_settings_fields', 'dservice_remove_custom_pages');

function dservice_general_listings_submenus($settings)
{
    unset($settings['style_setting']);
    return $settings;
}

add_filter('atbdp_general_listings_submenus', 'dservice_general_listings_submenus');

function dservice_search_settings_fields($settings)
{
    unset($settings['search_home_background']);
    return $settings;
}

add_filter('atbdp_search_settings_fields', 'dservice_search_settings_fields');

function dservice_atbdp_settings_menus($settings)
{
    unset($settings['style_settings_menu']);
    return $settings;
}

add_filter('atbdp_settings_menus', 'dservice_atbdp_settings_menus');

function single_listing_template($settings)
{
    unset($settings['single_listing_template']);
    unset($settings['enable_single_location_taxonomy']);
    return $settings;
}

add_filter('atbdp_single_listings_settings_fields', 'single_listing_template');

/*Listing list view price */
function listings_budget()
{
    $is_disable_price = get_directorist_option('disable_list_price');
    $pyn_budget = get_post_meta(get_the_ID(), '_price', true);
    $price_range = get_post_meta(get_the_ID(), '_price_range', true);
    $atbd_listing_pricing = get_post_meta(get_the_ID(), '_atbd_listing_pricing', true);
    $atbd_listing_pricing = !empty($atbd_listing_pricing) ? $atbd_listing_pricing : '';
    $is_hourly = get_post_meta(get_the_ID(), '_pyn_is_hourly', true);
    $hourly = $is_hourly ? sprintf('<span class="budget-hr">%s</span>', esc_html__('/hr', 'dservice-core')) : '';

    if ($pyn_budget || $price_range) { ?>
        <span class="atbd_upper_budget">
            <p class="atbd_service_budget">
                <?php
                esc_html_e('Budget:', 'dservice-core'); ?>
                <span>
                    <?php
                    if ($price_range && ('range' === $atbd_listing_pricing)) {
                        echo atbdp_display_price_range($price_range) . $hourly;
                    } else {
                        echo atbdp_display_price($pyn_budget, $is_disable_price, $currency = null, $symbol = null, $c_position = null, $echo = false) . $hourly;
                    } ?>
                </span>
            </p>
        </span>
        <?php
    }
}

add_filter('atbdp_grid_lower_badges', 'listings_budget', 50, 1);

/* add author section before listing list view title */
function dservice_list_view_before_title()
{
    $display_author_image = get_directorist_option('display_author_image', 1);

    if ($display_author_image) {
        $author_id    = get_the_author_meta('ID');
        $author       = get_userdata($author_id);
        $u_pro_pic_id = get_user_meta($author_id, 'pro_pic', true);
        $u_pro_pic    = wp_get_attachment_image_src($u_pro_pic_id, 'thumbnail');
        $avatar_img   = get_avatar($author_id, 50);

        printf('<a href="%s" class="atbd_tooltip" aria-label="%s">', ATBDP_Permalink::get_user_profile_page_link($author_id), $author->first_name . ' ' . $author->last_name);


        if ($u_pro_pic_id) {
            $image_alt = function_exists('dservice_get_image_alt') ? dservice_get_image_alt($u_pro_pic_id) : '';
            echo sprintf('<img class="c_tooltip" src="%s" alt="%s">', esc_url($u_pro_pic[0]), $image_alt);
        } else {
            echo wp_kses_post($avatar_img);
        }

        echo wp_kses_post('</a> <div class="card-title-wrapper">');

        echo listings_budget();
    }
}

add_action('atbdp_list_view_before_title', 'dservice_list_view_before_title');

function dservice_list_view_after_title()
{
    echo wp_kses_post('</div>');
}
add_action('atbdp_list_view_after_title', 'dservice_list_view_after_title');

/*=============================================
    Listing bottom area
=================================================*/
function dservice_listing_footer_catViewCount()
{
    $cats             = get_the_terms(get_the_ID(), ATBDP_CATEGORY);
    $display_category = get_directorist_option('display_category', 1);
    if ($display_category) {
        if ($cats) { ?>
            <div class="atbd_content_left">
                <div class="atbd_listting_category">
                    <?php
                    $cat_icon      = '';
                    $category_icon = !empty($cats) ? get_cat_icon($cats[0]->term_id) : atbdp_icon_type() . '-tags';
                    $icon_type     = substr($category_icon, 0, 2);
                    $icon          = 'la' === $icon_type ? $icon_type . ' ' . $category_icon : 'fa ' . $category_icon;
                    if ('no' != $icon_type) {
                        $cat_icon = sprintf('<span class="%s"></span>', esc_attr($icon));
                    }
                    echo sprintf('<a href="%s">%s %s</a>', ATBDP_Permalink::atbdp_get_category_page($cats[0]), $cat_icon, $cats[0]->name);

                    $totalTerm = count($cats);
                    if ($totalTerm > 1) { ?>
                        <div class="atbd_cat_popup">
                            <?php echo sprintf('<span>%s%s</span>', esc_html('+'), esc_attr($totalTerm - 1)) ?>
                            <div class="atbd_cat_popup_wrapper">
                                <?php
                                $output = array();
                                foreach (array_slice($cats, 1) as $cat) {
                                    $link  = ATBDP_Permalink::atbdp_get_category_page($cat);
                                    $space = str_repeat(' ', 1);

                                    $category_icon = !empty($cats) ? get_cat_icon($cat->term_id) : atbdp_icon_type() . '-tags';
                                    $icon_type     = substr($category_icon, 0, 2);
                                    $icon          = 'la' === $icon_type ? $icon_type . ' ' . $category_icon : 'fa ' . $category_icon;

                                    $output[] = sprintf("%s<span><i class='%s'></i><a href='%s'>%s<span>,</span></a></span>", esc_attr($space), esc_attr($icon), esc_url($link), esc_attr($cat->name));
                                }
                                echo join($output); ?>
                            </div>
                        </div>
                    <?php
                    } ?>
                </div>
            </div>
            <?php
        } else { ?>
            <div class="atbd_content_left">
                <div class="atbd_listting_category">
                    <?php echo sprintf('<a href="#"> <span class="%s-tags"></span>%s</a>', atbdp_icon_type(false), esc_html__('Uncategorized', 'dservice-core')) ?>
                </div>
            </div>
            <?php
        }
    }
}

add_filter('atbdp_grid_footer_catViewCount', 'dservice_listing_footer_catViewCount');

/*         Grid view bottom area */
function dservice_listings_grid_view_footer_content()
{ ?>
    <div class="atbd_listing_bottom_content">
        <?php dservice_listing_footer_catViewCount(); ?>
        <a href="" class="dservice-grid-cont-btn" data-toggle="modal" data-listing_id="<?php echo get_the_ID(); ?>" data-target="#contact_modal"><?php echo esc_html__('Contact', 'dservice-core') ?></a>
    </div>
<?php
}

add_filter('atbdp_listings_grid_cat_view_count', 'dservice_listings_grid_view_footer_content');

/*         List view bottom area */
function dservice_listings_list_view_footer_content()
{
    $display_mark_as_fav = get_directorist_option('display_mark_as_fav', 1); ?>
    <div class="atbd_listing_bottom_content">
        <?php dservice_listing_footer_catViewCount(); ?>
        <div class="atbdp_content_right">
            <?php
            if ($display_mark_as_fav) {
                echo atbdp_listings_mark_as_favourite(get_the_ID());
            } ?>
            <a href="" class="dservice-grid-cont-btn" data-toggle="modal" data-listing_id="<?php echo get_the_ID(); ?>" data-target="#contact_modal"><?php echo esc_html__('Contact', 'dservice-core') ?></a>
        </div>
    </div>
    <?php
}

add_filter('atbdp_listings_list_cat_view_count_author', 'dservice_listings_list_view_footer_content');

/*         listing with map view copyright section */
function dservice_footer_listing_with_map()
{
    $footer_style = get_post_meta(get_the_ID(), 'footer_style', true);
    $default      = '©' . date('Y') . ' dservice. Made with <span class="la la-heart-o"></span> by <a href="#">AazzTech</a>';
    $copy_right   = get_theme_mod('copy_right', $default);

    echo sprintf('<div class="listing_map_footer bg-%s">%s</div>', esc_attr($footer_style), apply_filters('get_the_content', $copy_right));
}

add_action('bdmv-after-listing', 'dservice_footer_listing_with_map');

/*         Remove  listing detail claim badge */
remove_action('atbdp_single_listing_after_title', 'verified_bedge_in_single_listing');


function dservice_remove_sort_by_select($settings)
{
    unset($settings['listings_sort_by_items']);
    unset($settings['display_view_as']);
    unset($settings['default_listing_view']);
    unset($settings['all_listing_columns']);
    unset($settings['order_listing_by']);
    unset($settings['sort_listing_by']);
    return $settings;
}

add_filter('atbdp_listings_settings_fields', 'dservice_remove_sort_by_select');

/*========================================================
    Single listing service offer option
========================================================*/

function dservice_save_services_offer_from_user($metas)
{
    $metas['_service_offer']  = !empty($_POST['service_offer']) ? $_POST['service_offer'] : array();
    $metas['_dservice_video'] = !empty($_POST['dservice_video']) ? atbdp_sanitize_array($_POST['dservice_video']) : array();
    return $metas;
}

add_filter('atbdp_listing_meta_user_submission', 'dservice_save_services_offer_from_user');

function dservice_save_services_offer_from_admin($metas)
{
    $metas['_service_offer']  = !empty($_POST['service_offer']) ? $_POST['service_offer'] : array();
    $metas['_dservice_video'] = !empty($_POST['dservice_video']) ? atbdp_sanitize_array($_POST['dservice_video']) : array();
    return $metas;
}

add_filter('atbdp_listing_meta_admin_submission', 'dservice_save_services_offer_from_admin');

/*========================================================
    add tinymce for services offer
========================================================*/
function dservice_added_services_offer_for_admin()
{
    $services_offer_label  = get_directorist_option('service_offer_label', 'Services Offer');
    $listing_service_offer = get_directorist_option('listing_service_offer', 1);
    if (!empty($listing_service_offer)) {
        add_meta_box('dservice_services_offer', '<span class="dservice-offered-service">' . esc_html__($services_offer_label, 'dservice-core') . '</span>', 'dservice_services_offer', ATBDP_POST_TYPE, 'normal', 'high');
    }
}

add_action('atbdp_before_video_gallery_backend', 'dservice_added_services_offer_for_admin');

function dservice_services_offer($post)
{
    $service_offer = get_post_meta($post->ID, '_service_offer', true);
    $service_offer = $service_offer ? wp_kses($service_offer, wp_kses_allowed_html('post')) : '';
    wp_editor($service_offer, 'service_offer', array('media_buttons' => false, 'quicktags' => true, 'editor_height' => 200));
}

function dservice_added_service_offer_for_user($listing_id)
{
    $listing_service_offer    = get_directorist_option('listing_service_offer', 1);
    $service_offer_only_admin = get_directorist_option('service_offer_only_admin', 0);
    $service_offer_label      = get_directorist_option('service_offer_label', 'Services Offer');
    if (!empty($listing_service_offer) && empty($service_offer_only_admin)) {
    ?>
        <div class="form-group" id="atbdp_listing_content dservice-service-offered">
            <label for="listing_content" class="dservice-offered-service">
                <?php esc_html_e($service_offer_label, 'dservice-core'); ?>
            </label>
            <?php dservice_services_offer(get_post($listing_id)); ?>
        </div>
    <?php
    }
}

add_action('atbdp_after_general_information', 'dservice_added_service_offer_for_user');

/*========================================================
    Service offer on/off option for admin
========================================================*/
function dservice_admin_service_offer_control($settings)
{
    $new_settings = array(
        'type'   => 'section',
        'title'  => __('Services Offer', 'dservice-core'),
        'fields' => get_service_offer_settings(),
    );

    array_push($settings, $new_settings);
    return $settings;
}

add_filter('atbdp_form_fields_controls', 'dservice_admin_service_offer_control');

/*========================================================
    Service offer on/off option for admin
========================================================*/
function dservice_need_listing_settings_field($settings)
{
    $new_settings = array(
        'type'    => 'textbox',
        'name'    => 'requirements_label',
        'label'   => __('Requirements Label', 'dservice-core'),
        'default' => __('Requirements', 'dservice-core'),
    );

    array_push($settings, $new_settings);
    return $settings;
}

add_filter('atbdp_need_listing_settings_field', 'dservice_need_listing_settings_field');

function get_service_offer_settings()
{
    return apply_filters('atbdp_service_offer_field_setting', array(
        array(
            'type'    => 'toggle',
            'name'    => 'listing_service_offer',
            'label'   => __('Enable', 'dservice-core'),
            'default' => 1,
        ),
        array(
            'type'        => 'textbox',
            'name'        => 'service_offer_label',
            'label'       => __('Label', 'dservice-core'),
            'default'     => __('Services Offer', 'dservice-core'),
            'description' => __('Leave it empty for hiding the label', 'dservice-core')
        ),
        array(
            'type'    => 'toggle',
            'name'    => 'service_offer_only_admin',
            'label'   => __('Only For Admin Use', 'dservice-core'),
            'default' => 0,
        ),
    ));
}

/*========================================================
                Display service offer on single listing
========================================================*/
function dservice_display_service_offer()
{
    global $post;
    $service_offer = get_post_meta($post->ID, '_service_offer', true);
    $is_need       = get_post_meta($post->ID, '_need_post', true);
    if ('yes' === $is_need) {
        $label = get_directorist_option('requirements_label', __('Requirements', 'dservice-core'));
    } else {
        $label = get_directorist_option('service_offer_label', __('Service Offered', 'dservice-core'));
    }
    if ($service_offer) { ?>
        <div class="atbd_content_module atbd_custom_fields_contents post-details">
            <div class="atbd_content_module__tittle_area">
                <div class="atbd_area_title">
                    <h4>
                        <span class="<?php atbdp_icon_type(true); ?>-list-alt atbd_area_icon"></span>
                        <?php esc_html_e($label) ?>
                    </h4>
                </div>
            </div>
            <div class="atbdb_content_module_contents post-body">
                <?php echo apply_filters('the_content', $service_offer); ?>
            </div>
        </div>
    <?php
    }
}

add_shortcode('dservice_service_offered', 'dservice_display_service_offer');

/*========================================================
                Single listing multiple video option
========================================================*/
function customize_video_field($id)
{
    $video_placeholder   = get_directorist_option('video_placeholder', esc_html__('Only YouTube & Vimeo URLs.', 'dservice-core'));
    $dservice_video_urls = get_post_meta($id, '_dservice_video', true);
    $video_field         = '';
    if ($dservice_video_urls) {
        foreach ($dservice_video_urls as $index => $video_link) {
            $video_field .= '<div class="atbdp_more_video-' . $index . ' form-group">';
            $video_field .= '<input type="text" id="dservice_video-' . $index . '"  name="dservice_video[' . $index . '][id]" value="' . $video_link['id'] . '" class="form-control dservice_video directory_field" placeholder="' . $video_placeholder . '"/>';
            $video_field .= '<span data-id="' . $index . '" class="removeVideoField dashicons dashicons-trash" title="' . esc_html__('Remove this item', 'dservice-core') . '"></span>';
            $video_field .= '</div>';
        }
    }
    $video_field .= '<button type="button" class="btn btn-secondary btn-sm" id="atbdp_more_video"> <span class="plus-sign">+</span>
                        ' . esc_html__("Add Video", "dservice-core") . '
                    </button>';

    echo $video_field;
}

add_action('atbdp_video_field', 'customize_video_field');

function dservice_add_more_video()
{
    $id                = isset($_POST['id']) ? absint($_POST['id']) : 0;
    $video_placeholder = get_directorist_option('video_placeholder', esc_html__('Only YouTube & Vimeo URLs.', 'dservice-core')); ?>
    <div class="atbdp_more_video-<?php echo esc_attr($id); ?>">
        <input type="text" id="dservice_video-<?php echo esc_attr($id); ?>" name="dservice_video[<?php echo esc_attr($id); ?>][id]" value="" class="form-control dservice_video directory_field" placeholder="<?php echo esc_attr($video_placeholder); ?>" />
        <span data-id="<?php echo esc_attr($id); ?>" class="removeVideoField dashicons dashicons-trash" title="<?php echo esc_html__('Remove this item', 'dservice-core'); ?>"></span>
    </div>
    <?php
    die();
}

add_action('wp_ajax_dservice_add_more_video', 'dservice_add_more_video');

/*Listing Video shortcode*/
if (!function_exists('dservice_file_get_contents')) {
    function dservice_file_get_contents($url)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }
}
function dservice_listing_video()
{
    global $post;
    $videourl            = $plan_video = '';
    $listing_id          = $post->ID;
    $video_label         = get_directorist_option('atbd_video_title', esc_html__('Video', 'dservice-core'));
    $dservice_video_urls = get_post_meta($listing_id, '_dservice_video', true);
    $listing_info['videourl']          = get_post_meta($post->ID, '_videourl', true);

    extract($listing_info);
    if (strpos($videourl, 'youtube') !== false) {
        $json = dservice_file_get_contents('https://www.youtube.com/oembed?url=' . urlencode($videourl));
    }
    $json      = !empty($json) ? $json : '';
    $video     = json_decode($json);
    $thumbnail = $video ? $video->thumbnail_url : '';

    if ($videourl) { ?>
        <div class="atbd_content_module atbd_custom_fields_contents atbd_content_module_video">
            <?php if ($video_label) { ?>
                <h4><span class="<?php atbdp_icon_type(true); ?>-video-camera atbd_area_icon"></span>
                    <?php echo esc_attr($video_label); ?>
                </h4>
            <?php
            } ?>
            <div class="atbdb-video--content">
                <div class="row">
                    <?php
                    if ($videourl) { ?>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="video-content">
                                <div class="video">
                                    <a class="video__wrapper atbdb-video" href="<?php echo esc_attr(ATBDP()->atbdp_parse_videos($videourl)) ?>">
                                        <img class="img-fluid" src="<?php echo $thumbnail ? esc_url($thumbnail) : ''; ?>" />
                                        <i class="la la-youtube-play video__btn"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }

                    if ($dservice_video_urls) {
                        foreach ($dservice_video_urls as $video) {
                            $videourl = $video['id'];
                            if (strpos($videourl, 'youtube') !== false) {
                                $video_img = dservice_file_get_contents('https://www.youtube.com/oembed?url=' . urlencode($videourl));
                            }
                            $video         = $video_img ? json_decode($video_img) : '';
                            $thumbnail_url = $video ? $video->thumbnail_url : ''; ?>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <div class="video-content">
                                    <div class="video">
                                        <a class="video__wrapper atbdb-video" href="<?php echo esc_attr(ATBDP()->atbdp_parse_videos($videourl)) ?>">
                                            <img class="img-fluid" src="<?php echo $thumbnail_url ? esc_url($thumbnail_url) : ''; ?>" />
                                            <i class="la la-youtube-play video__btn"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        wp_reset_query();
                    } ?>
                </div>
            </div>
        </div>
    <?php
    }
}

add_shortcode('dservice_listing_video', 'dservice_listing_video');

/*========================================================
                Single listing gallery option
========================================================*/
function dservice_listing_gallery()
{
    global $post;
    // Get the preview images
    $listing_img        = [];
    $listing_id         = $post->ID;
    $preview_img_id     = get_post_meta( $listing_id, '_listing_prv_img', true);
    $preview_image_view = wp_get_attachment_image_src($preview_img_id, 'dservice-listing-gallery', false);
    $preview_image_full = wp_get_attachment_image_src($preview_img_id, 'full', false);
    $gallery_title      = get_directorist_option('dservice_details_text', esc_html__('Gallery', 'dservice-core'));
    $listing_info['listing_img'] = get_post_meta($listing_id, '_listing_img', true);
    extract($listing_info);
    ?>
    <div class="atbd_content_module atbd_listing_details">
        <?php
        if ($gallery_title) { ?>
            <div class="atbd_content_module__tittle_area">
                <div class="atbd_area_title">
                    <h4>
                        <span class="la la-image atbd_area_icon"></span>
                        <?php echo esc_attr($gallery_title); ?>
                    </h4>
                </div>
            </div>
        <?php
        }

        if ( $listing_img ) { ?>
            <div class="atbdb_content_module_contents">
                <div class="atbd_directry_gallery_wrapper">
                    <ul class="single-listing-gallery popup-gallery">
                        <?php if( $preview_image_view ){ ?>
                            <li>
                                <figure>
                                    <img src="<?php echo $preview_image_view ? esc_url($preview_image_view[0]) : ''; ?>" alt="<?php echo function_exists('dservice_get_image_alt') ?  esc_attr(dservice_get_image_alt($preview_img_id)) : ''; ?>">
                                    <figcaption>
                                        <a href="<?php echo $preview_image_full ? esc_url( $preview_image_full[0] ) : ''; ?>" class="hoverZoomLink">
                                            <span class="la la-search-plus"></span>
                                        </a>
                                    </figcaption>
                                </figure>
                            </li>
                            <?php 
                        }

                        foreach ($listing_img as $ids) {
                            $image_view = wp_get_attachment_image_src($ids, 'dservice-listing-gallery', false);
                            $image_full = wp_get_attachment_image_src($ids, 'full', false); ?>
                            <li>
                                <figure>
                                    <img src="<?php echo $image_view ? esc_url($image_view[0]) : ''; ?>" alt="<?php echo function_exists('dservice_get_image_alt') ?  esc_attr(dservice_get_image_alt($ids)) : ''; ?>">
                                    <figcaption>
                                        <a href="<?php echo $image_full ? esc_url($image_full[0]) : ''; ?>" class="hoverZoomLink">
                                            <span class="la la-search-plus"></span>
                                        </a>
                                    </figcaption>
                                </figure>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <?php
        } ?>
    </div>
    <?php
}

add_shortcode('dservice_listing_gallery', 'dservice_listing_gallery');

/*========================================================
 Single listing description option
========================================================*/
function dservice_listing_description()
{
    $is_need     = get_post_meta(get_the_ID(), '_need_post', true);
    $post_object = get_post(get_the_ID());
    $content     = apply_filters('get_the_content', $post_object->post_content);
    if ('no' != $is_need) {
        $title = get_directorist_option('need_details_text', esc_html__('Enquire Detail', 'dservice-core'));
    } else {
        $title = get_directorist_option('listing_details_text', esc_html__('Listing Detail', 'dservice-core'));
    }
    ?>

    <div class="atbd_content_module atbd_listing_details atbdp_listing_ShortCode">

        <?php if ( $title ) { ?>
            <div class="atbd_content_module__tittle_area">
                <div class="atbd_area_title">
                    <h4>
                        <span class="<?php atbdp_icon_type(true); ?>-file-text atbd_area_icon"></span>
                        <?php echo esc_attr($title); ?>
                    </h4>
                </div>
            </div>
        <?php
        }

        if ($content) { ?>
            <div class="atbdb_content_module_contents">
                <div class="atbd_listing_detail">
                    <div class="about_detail">
                        <?php echo do_shortcode(wpautop($content)); ?>
                    </div>
                </div>
            </div>
        <?php
        } ?>

    </div>
<?php
}

add_shortcode('dservice_listing_description', 'dservice_listing_description');

/*========================================================
            Directorist page id check
======================================================*/
function dservice_directorist_pages($page_id)
{
    $page_id = '';
    if (is_page() && get_the_ID() == get_directorist_option($page_id)) {
        $page_id = true;
    }
    return $page_id;
}

/*====================================================
contact listing owner form
================================================= */
function dservice_email_listing_owner_listing_contact()
{
    /* I fires sending processing the submitted contact information   @since 1.0.0  */

    do_action('atbdp_before_processing_contact_to_owner');
    if (!in_array('listing_contact_form', get_directorist_option('notify_user', array()))) return false;
    // sanitize form values
    $post_id       = (int) $_POST["post_id"];
    $name          = sanitize_text_field($_POST["name"]);
    $email         = sanitize_email($_POST["email"]);
    $listing_email = sanitize_email($_POST["listing_email"]);
    $message       = stripslashes(esc_textarea($_POST["message"]));

    // vars
    $post_author_id        = get_post_field('post_author', $post_id);
    $user                  = get_userdata($post_author_id);
    $site_name             = get_bloginfo('name');
    $site_url              = get_bloginfo('url');
    $site_email            = get_bloginfo('admin_email');
    $listing_title         = get_the_title($post_id);
    $listing_url           = get_permalink($post_id);
    $date_format           = get_option('date_format');
    $time_format           = get_option('time_format');
    $current_time          = current_time('timestamp');
    $contact_email_subject = get_directorist_option('email_sub_listing_contact_email');
    $contact_email_body    = get_directorist_option('email_tmpl_listing_contact_email');
    $user_email            = get_directorist_option('user_email', 'author');

    $placeholders = array(
        '==NAME=='          => $user->display_name,
        '==USERNAME=='      => $user->user_login,
        '==SITE_NAME=='     => $site_name,
        '==SITE_LINK=='     => sprintf('<a href="%s">%s</a>', $site_url, $site_name),
        '==SITE_URL=='      => sprintf('<a href="%s">%s</a>', $site_url, $site_url),
        '==LISTING_TITLE==' => $listing_title,
        '==LISTING_LINK=='  => sprintf('<a href="%s">%s</a>', $listing_url, $listing_title),
        '==LISTING_URL=='   => sprintf('<a href="%s">%s</a>', $listing_url, $listing_url),
        '==SENDER_NAME=='   => $name,
        '==SENDER_EMAIL=='  => $email,
        '==MESSAGE=='       => $message,
        '==TODAY=='         => date_i18n($date_format, $current_time),
        '==NOW=='           => date_i18n($date_format . ' ' . $time_format, $current_time)
    );
    if ('listing_email' == $user_email) {
        $to = $listing_email;
    } else {
        $to = $user->user_email;
    }


    $subject = strtr($contact_email_subject, $placeholders);

    $message = strtr($contact_email_body, $placeholders);
    $message = nl2br($message);

    $headers = "From: {$name} <{$site_email}>\r\n";
    $headers .= "Reply-To: {$email}\r\n";

    // return true or false, based on the result
    return ATBDP()->email->send_mail($to, $subject, $message, $headers) ? true : false;
}

function dservice_email_admin_listing_contact()
{
    if (get_directorist_option('disable_email_notification')) return false;

    if (!in_array('listing_contact_form', get_directorist_option('notify_admin', array()))) return false; // vail if order created notification to admin off

    // sanitize form values
    $post_id = (int) $_POST["post_id"];
    $name    = sanitize_text_field($_POST["name"]);
    $email   = sanitize_email($_POST["email"]);
    $message = esc_textarea($_POST["message"]);

    // vars
    $site_name     = get_bloginfo('name');
    $site_url      = get_bloginfo('url');
    $listing_title = get_the_title($post_id);
    $listing_url   = get_permalink($post_id);
    $date_format   = get_option('date_format');
    $time_format   = get_option('time_format');
    $current_time  = current_time('timestamp');

    $placeholders = array(
        '{site_name}'     => $site_name,
        '{site_link}'     => sprintf('<a href="%s">%s</a>', $site_url, $site_name),
        '{site_url}'      => sprintf('<a href="%s">%s</a>', $site_url, $site_url),
        '{listing_title}' => $listing_title,
        '{listing_link}'  => sprintf('<a href="%s">%s</a>', $listing_url, $listing_title),
        '{listing_url}'   => sprintf('<a href="%s">%s</a>', $listing_url, $listing_url),
        '{sender_name}'   => $name,
        '{sender_email}'  => $email,
        '{message}'       => $message,
        '{today}'         => date_i18n($date_format, $current_time),
        '{now}'           => date_i18n($date_format . ' ' . $time_format, $current_time)
    );
    $send_emails = ATBDP()->email->get_admin_email_list();
    $to          = !empty($send_emails) ? $send_emails : get_bloginfo('admin_email');

    $subject = esc_html__('[{site_name}] Contact via "{listing_title}"', 'dservice-core');
    $subject = strtr($subject, $placeholders);

    $message = esc_html__("Dear Administrator,<br /><br />A listing on your website {site_name} received a message.<br /><br />Listing URL: {listing_url}<br /><br />Name: {sender_name}<br />Email: {sender_email}<br />Message: {message}<br />Time: {now}<br /><br />This is just a copy of the original email and was already sent to the listing owner. You don't have to reply this unless necessary.", 'dservice-core');
    $message = strtr($message, $placeholders);

    $headers = "From: {$name} <{$email}>\r\n";
    $headers .= "Reply-To: {$email}\r\n";

    return ATBDP()->email->send_mail($to, $subject, $message, $headers) ? true : false;
}

function dservice_ajax_callback_send_contact_email()
{

    $data = array('error' => 0);

    if (dservice_email_listing_owner_listing_contact()) {

        // Send a copy to admin( only if applicable ).
        dservice_email_admin_listing_contact();

        $data['message'] = esc_html__('Your message sent successfully.', 'dservice-core');
    } else {

        $data['error']   = 1;
        $data['message'] = esc_html__('Sorry! Please try again.', 'dservice-core');
    }
    echo wp_json_encode($data);
    wp_die();
}

add_action('wp_ajax_dservice_public_send_contact_email', 'dservice_ajax_callback_send_contact_email');
add_action('wp_ajax_nopriv_dservice_public_send_contact_email', 'dservice_ajax_callback_send_contact_email');


// add listing is hourly field
function dservice_add_listing_before_price_field($listing_id)
{
    $is_hourly            = get_post_meta($listing_id, '_pyn_is_hourly', true);
    $hourly_label         = get_directorist_option('hourly_label', esc_html__('Is hourly?', 'dservice-core'));
    $display_hourly_field = get_directorist_option('display_hourly_field', 1);
    if (!empty($display_hourly_field)) { ?>
        <input type="checkbox" name="is_hourly" id="isHourly" <?php echo !empty($is_hourly) ? 'checked' : '' ?>>
        <label for="isHourly"><?php echo $hourly_label; ?></label>
    <?php
    }
}

add_action('atbdp_add_listing_before_price_field', 'dservice_add_listing_before_price_field');


/*====================================================
Search Listing found title
======================================================== */
function dservice_listing_search_title($result_title)
{
    $title    = '';
    $query    = (isset($_GET['q']) && ('' !== $_GET['q'])) ? ucfirst($_GET['q']) : '';
    $category = (isset($_GET['in_cat']) && ('' !== $_GET['in_cat'])) ? ucfirst($_GET['in_cat']) : '';
    $location = (isset($_GET['in_loc']) && ('' !== $_GET['in_loc'])) ? ucfirst($_GET['in_loc']) : '';
    $category = get_term_by('id', $category, ATBDP_CATEGORY);
    $location = get_term_by('id', $location, ATBDP_LOCATION);

    $in_s_string_text = !empty($query) ? sprintf(esc_html__('%s', 'dservice-core'), $query) : '';
    $in_cat_text      = !empty($category) ? sprintf(esc_html__(' %s %s ', 'dservice-core'), !empty($query) ? '<span>' . esc_html__('from', 'dservice-core') . '</span>' : '', $category->name) : '';
    $in_loc_text      = !empty($location) ? sprintf(esc_html__('%s %s', 'dservice-core'), !empty($query) ? '<span>' . esc_html__('in', 'dservice-core') . '</span>' : '', $location->name) : '';

    if ($query || $category || $location) {
        $title = $in_s_string_text . $in_cat_text . $in_loc_text;
    }

    return sprintf(esc_html__($result_title, 'dservice-core') . '%s', wp_kses_post($title));
}

/*====================================================
Listing header title
======================================================== */
function dservice_bdmv_after_filter_button_in_listings_header($ex_title)
{
    if (dservice_directorist_pages('search_result_page')) {
        echo sprintf('<div class="listing-header"><h4>%s</h4>%s</div>', dservice_listing_search_title(false), $ex_title);
    } else {
        echo sprintf('<div class="listing-header"><h4>%s</h4>%s</div>', esc_html__('All Items', 'dservice-core'), $ex_title);
    }
}

add_action('bdmv_after_filter_button_in_listings_header', 'dservice_bdmv_after_filter_button_in_listings_header', 10, 2);


function dservice_contact_form($listing_id)
{ ?>

    <div class="atbdp-widget-listing-contact contact-form">
        <div class="atbd_contdservice_public_send_contact_emailent_module atbd_contact_information_module">
            <form id="dservice-contact-owner-form" class="form-vertical contact_listing_owner" role="form">
                <div class="form-group">
                    <input type="text" class="form-control" id="atbdp-contact-name" placeholder="<?php esc_html_e('Name', 'dservice-core'); ?>" required />
                </div>

                <div class="form-group">
                    <input type="email" class="form-control" id="atbdp-contact-email" placeholder="<?php esc_html_e('Email', 'dservice-core'); ?>" required />
                </div>

                <div class="form-group">
                    <textarea class="form-control" id="atbdp-contact-message" rows="3" placeholder="<?php esc_html_e('Message', 'dservice-core'); ?>..." required></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <?php esc_html_e('Submit', 'dservice-core'); ?>
                    </button>
                </div>

                <p id="atbdp-contact-message-display"></p>
            </form>
        </div>
        <input type="hidden" id="atbdp-post-id" value=" <?php echo esc_attr($listing_id); ?>" />
        <input type="hidden" id="atbdp-listing-email" value="<?php echo !empty($email) ? sanitize_email($email) : ''; ?>" />
    </div>
    <?php
}

function dservice_avatar_size()
{
    return 50;
}

add_filter('atbdp_avatar_size', 'dservice_avatar_size');

function dservice_new_plan_slider_image_limit_label()
{
    return __('Listing Gallery Image Limit', 'dservice-core');
}

add_filter('atbdp_new_plan_slider_image_limit_label', 'dservice_new_plan_slider_image_limit_label');

function dservice_add_listing_slider_image_button_text()
{
    return __('Upload Gallery Images', 'dservice-core');
}

add_filter('atbdp_add_listing_slider_image_button_default_text', 'dservice_add_listing_slider_image_button_text');

function dservice_set_user_dashboard_page($page_template)
{
    $dashboardPageId = class_exists('Directorist_Base') ? get_directorist_option('user_dashboard') : '';
    $authorPageId    = class_exists('Directorist_Base') ? get_directorist_option('author_profile_page') : '';
    global $post;
    $page_id = $post ? $post->ID : '';
    switch ($page_id) {
        case $dashboardPageId:
            $args = array(
                'ID'           => $page_id,
                'post_content' => '',
            );
            update_post_meta($page_id, '_wp_page_template', 'template-parts/dashboard-wp.php');
            wp_update_post($args);
            $page_template = get_template_directory() . '/template-parts/dashboard-wp.php';
            break;

        case $authorPageId:
            $args = array(
                'ID'           => $page_id,
                'post_content' => '',
            );
            update_post_meta($page_id, '_wp_page_template', 'template-parts/author.php');
            wp_update_post($args);
            $page_template = get_template_directory() . '/template-parts/author.php';
    }
    return $page_template;
}

add_action('page_template', 'dservice_set_user_dashboard_page');

/*====================================================
Demo notification
======================================================== */
function dservice_page_creation()
{
    if (isset($_GET['dservice_create_page'])) {
        atbdp_create_required_pages();
        update_user_meta(get_current_user_id(), '_atbdp_shortcode_regenerate_notice', 'false');
        if (class_exists('ATBDP_Pricing_Plans')) {
            atpp_create_required_pages();
        }
        if (class_exists('DWPP_Pricing_Plans')) {
            dwpp_create_required_pages();
        }
        set_transient('dservice-page-creation-notice', true, 2);
    }
    if (isset($_GET['dservice_demo_import'])) {
        update_option('dservice_demo_import', 1);
    }

    //remove fav icon for listing list
    remove_action('directorist_list_view_top_content_end',  array('Directorist_Listings', 'mark_as_favourite_button'), 15);
}

add_action('init', 'dservice_page_creation', 100);

function dservice_page_creation_notice()
{
    if ( ( get_option('atbdp_pages_version') < 1 ) && ( get_option('dservice_demo_import') < 1 ) ) {
        $link  = add_query_arg('dservice_demo_import', 'true', admin_url() . '/tools.php?page=fw-backups-demo-content');
        $link2 = add_query_arg('dservice_create_page', 'true', $_SERVER["REQUEST_URI"]);
        echo '<div class="notice notice-warning is-dismissible dservice_importer_notice"><p><a href="' . esc_url($link) . '">' . __('Import Demo', 'dservice-core') . '</a> or <a href="' . esc_url($link2) . '">' . __('Generate', 'dservice-core') . '</a>' . __(' Required Pages') . '</p></div>';
    }
    if (get_transient('dservice-page-creation-notice')) { ?>
        <div class="updated notice is-dismissible">
            <p><?php _e('Page created successfully!', 'dservice-core') ?></p>
        </div>
        <?php
        delete_transient('dservice-page-creation-notice');
    }
}

add_action('admin_notices', 'dservice_page_creation_notice');

function atbdp_single_template($template)
{
    $template = 'current_theme_template';
    return $template;
}
add_filter('atbdp_single_template', 'atbdp_single_template');

/*============added class before listing for wrapper*/
function dservice_added_class_before_listing_form()
{
    echo sprintf('<div class="%s">', 'col-lg-8 offset-lg-2');
}
//add_action('atbdb_before_add_listing_from_wrapper', 'dservice_added_class_before_listing_form');

/*============added class before listing for wrapper*/
function dservice_added_class_after_listing_form()
{
    echo '</div>';
}
//add_action('atbdb_after_add_listing_from_wrapper', 'dservice_added_class_after_listing_form');

//Remove directorist elementor widgets
add_filter('atbdp_elementor_widgets_activated', '__return_false');


//added single listing tag icon
function dservice_single_listing_tag_icon()
{
    return atbdp_icon_type() . '-list-alt';
}

add_filter('atbdp_single_listing_tag_icon', 'dservice_single_listing_tag_icon');

//added single listing tags icon
function dservice_single_listing_tags_icon()
{
    return atbdp_icon_type() . '-check-square';
}

add_filter('atbdp_single_listing_tags_icon', 'dservice_single_listing_tags_icon');

// Add review & category in dashboard table.
function directorist_dashboard_listing_th_2(){
	echo '<th class="directorist-table-review">' . __( 'Review', 'dservice-core' ) . '</th>';
	echo '<th class="directorist-table-review">' . __( 'Category', 'dservice-core' ) . '</th>';
}
add_action( 'directorist_dashboard_listing_th_2', 'directorist_dashboard_listing_th_2' );

function directorist_dashboard_listing_td_2() {
	$review = get_directorist_option( 'enable_review', 1 );
	if ( ! $review ) return;
	$reviews_count = ATBDP()->review->db->count( array( 'post_id' => get_the_ID() ) );
	$cats          = get_the_terms( get_the_ID(), ATBDP_CATEGORY );
	$cats          = $cats ? $cats : array();
	?>
	<td class="directorist_dashboard_rating">
		<ul class="rating">
			<?php
			$average   = ATBDP()->review->get_average( get_the_ID() );
			$star      = '<li><span class="la la-star rate_active"></span></li>';
			$half_star = '<li><span class="la la-star-half-o rate_active"></span></li>';
			$none_star = '<li><span class="la la-star-o"></span></li>';

			if ( is_int( $average ) ) {
				for ( $i = 1; $i <= 5; $i++ ) {

					if ( $i <= $average ) {
						echo wp_kses_post( $star );
					} else {
						echo wp_kses_post( $none_star );
					}
				}
			} elseif ( ! is_int( $average ) ) {
				$exp       = explode( '.', $average );
				$float_num = $exp[0];

				for ( $i = 1; $i <= 5; $i++ ) {
					if ( $i <= $average ) {
						echo wp_kses_post( $star );
					} elseif ( ! empty( $average ) && $i > $average && $i <= $float_num + 1 ) {
						echo wp_kses_post( $half_star );
					} else {
						echo wp_kses_post( $none_star );
					}
				}
			}

			$review_title = '';
			if ( $reviews_count ) {
				if ( 1 < $reviews_count ) {
					$review_title = $reviews_count . esc_html__( ' Reviews', 'dservice-core' );
				} else {
					$review_title = $reviews_count . esc_html__( ' Review', 'dservice-core' );
				}
			}
			?>

			<li class="reviews">
				<span class="atbd_count">
					<?php echo sprintf( '(<b>%s</b> %s )', esc_attr( $average . '/5' ), esc_attr( $review_title ) ); ?>
				</span>
			</li>
		</ul>
	</td>

	<td class="directorist_dashboard_category">
		<ul>
			<li>
				<?php
				if ( $cats ) {
					foreach ( $cats as $cat ) {
						$link          = ATBDP_Permalink::atbdp_get_category_page( $cat );
						$space         = str_repeat( ' ', 1 );
						$category_icon = $cats ? get_cat_icon( $cat->term_id ) : atbdp_icon_type() . '-tags';
						$icon_type     = substr( $category_icon, 0, 2 );
						$icon          = 'la' === $icon_type ? $icon_type . ' ' . $category_icon : 'fa ' . $category_icon;
						echo sprintf( '%s<span><i class="%s"></i><a href="%s">%s</a></span>', esc_attr( $space ), esc_attr( $icon ), esc_url( $link ), esc_attr( $cat->name ) );
					}
				}
				?>
			</li>
		</ul>
	</td>
	<?php
}
add_action( 'directorist_dashboard_listing_td_2', 'directorist_dashboard_listing_td_2' );

function atbdp_all_listings_meta_count( $html, $term ) {
	$total = $term->count;
	$str = ( 1 == $total ) ? __( ' Listing', 'dservice-core' ) : __( ' Listings', 'dservice-core' );
	return '<span class="listing-count"> ' . $total . '<span class="listing-label">' . $str . '</span>' . '</span>';
}
add_filter( 'atbdp_all_locations_after_location_name', 'atbdp_all_listings_meta_count', 10, 2 );

function atbdp_all_listings_cat_meta_count( $html, $term ) {
	$total = $term->count;
	return '<span class="listing-count">' . $total . '</span>';
}
add_filter( 'atbdp_all_categories_after_category_name', 'atbdp_all_listings_cat_meta_count', 10, 2 );

function directorist_listing_types() {
	$all_types = directory_types();
	$types = [];
	foreach( $all_types as $type) {
		$types[ $type->slug ] = $type->name;
	}
	return $types;
}

function directory_listing_type() {
    $listing_type = ! empty($_GET['directory_type']) ? $_GET['directory_type'] : directorist_default_directory();
    $term = get_term_by( is_numeric( $listing_type ) ? 'id' : 'slug' , $listing_type, ATBDP_TYPE );
    return $term->term_id;
}

function all_listings_wrapper() {
	echo ' all-listings-carousel owl-carousel ';
}
