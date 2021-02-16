<?php
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Plugin as Plugin;

if (!class_exists('dserviceWidgets')) {
    final class dserviceWidgets
    {
        const VERSION = '1.0.0';
        const MINIMUM_ELEMENTOR_VERSION = '2.0.0';
        const MINIMUM_PHP_VERSION = '5.6';

        private static $_instance = null;

        public static function instance()
        {
            if (is_null(self::$_instance)) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        public function __construct()
        {
            add_action('plugins_loaded', [$this, 'init']);
        }

        public function init()
        {
            // Add Plugin actions
            add_action('elementor/widgets/widgets_registered', [$this, 'init_widgets']);
            add_action('elementor/elements/categories_registered', [$this, 'dservice_widget_category']);
        }

        public function init_widgets()
        {
            require_once(__DIR__ . '/widgets.php');

            Plugin::instance()->widgets_manager->register_widget_type(new dservice_Heading());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_Accordion());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_AddListing_Form());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_Profile());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_Blogs());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_Categories());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_Checkout());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_ContactForm());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_ContactItems());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_Counter());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_CTA());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_Dashboard());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_FeatureBox());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_VideoPopup());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_Listings());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_ListingsCarousel());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_ListingsMap());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_Locations());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_Login());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_Transaction());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_Registration());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_Logos());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_NeedCategories());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_NeedLocations());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_NeedSingleCat());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_NeedSingleLoc());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_Needs());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_Payment());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_PricingPlan());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_SearchForm());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_SearchResult());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_SingleCat());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_SingleCatMap());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_SingleLoc());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_SingleLocMap());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_SingleTag());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_SingleTagMap());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_Team());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_Testimonial());
            Plugin::instance()->widgets_manager->register_widget_type(new dservice_Booking());
        }

        public function dservice_widget_category($manager)
        {
            $manager->add_category(
                'dservice_category',
                [
                    'title' => __('dservice', 'dservice-core'),
                ]
            );
        }
    }

    dserviceWidgets::instance();
}