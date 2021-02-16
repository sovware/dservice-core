<?php

//===========dservice Color Control Customizer Panel=============

function dservice_custom_style()
{

    $primary = get_theme_mod('p_color', '#377dff');
    $primary_g = get_theme_mod('p_g_color', 'rgba(55,125,255,0.9)');
    $secondary = get_theme_mod('s_color', '#23c8b9');
    $secondary_g = get_theme_mod('s_g_color', 'rgba(35,200,185,0.7)');
    $success = get_theme_mod('su_color', '#53ca2e');
    $info = get_theme_mod('in_color', '#2c99ff');
    $danger = get_theme_mod('dn_color', '#f51957');
    $warnning = get_theme_mod('wr_color', '#fa8b0c'); ?>

    <style>
        <?php if('#377dff' != $primary){ ?>

        /*Primary color*/
        .color-primary, .woocommerce ul.products li.product .price,
        .woocommerce .woocommerce-pagination ul.page-numbers li .page-numbers:hover,
        .woocommerce table.shop_table .product-name a:hover,
        .woocommerce .woocommerce-MyAccount-navigation ul li.is-active a,
        .dservice_product-details .product-info .price ins,
        .dservice_product-details .product-info .price .woocommerce-Price-amount,
        .woocommerce div.product .dservice_product-info-tab .woocommerce-tabs ul.tabs li.active a,
        .list-features_one li .list-count span,
        .grid-single .post--card .card-body h6 a:hover,
        .mainmenu__menu .navbar-nav > li:hover > a,
        .mainmenu__menu .navbar-nav > li.menu-item .sub-menu li:hover a,
        .mainmenu__menu .navbar-nav > li.menu-item .sub-menu .menu-item-has-children > ul li a:hover,
        .cart_module .cart__items .items .item_info > a:hover,
        .cart_module .cart__items .items .item_remove span,
        .cart_module .cart__items .cart_info p span,
        #address_result ul li:before,
        #address_result ul li:hover a, .outline-primary, .btn-play .btn-icon,
        .sponser-carousel .owl-nav button:hover span,
        .page-template-default .atbd_generic_header .atbd_listing_action_btn .view-mode a span:hover,
        .atbd_author_info_widget .atbd_widget_contact_info ul li span:first-child,
        .atbdp_parent_category li a:hover span,
        .atbdp-widget-categories .atbdp_parent_category li a:hover,
        .atbdp-widget-categories .atbdp_parent_category li > .cat-trigger:hover,
        .widget_social li a:hover,
        .widget_social li > .cat-trigger:hover,
        .atbd_categorized_listings .listings > li .cate_title h4 a:hover,
        .atbd_categorized_listings .listings > li .directory_tag span a:hover,
        .atbd_categorized_listings .listings > li .directory_tag span .atbd_cat_popup .atbd_cat_popup_wrapper span a:hover,
        .atbd_categorized_listings .listings > li .listing_value span,
        .atbd_contact_information_module .atbd_contact_info ul .atbd_info_title span,
        .atbd_categorized_listings .listings > li .cate_title .atbd_listing_average_pricing,
        .sidebar .widget_product_categories ul li:before,
        .sidebar .widget_archive ul li:before,
        .sidebar .widget_pages ul li:before,
        .sidebar .widget_nav_menu ul li:before,
        .sidebar .widget_categories ul li:before,
        .atbd_sidebar .widget_product_categories ul li:before,
        .atbd_sidebar .widget_archive ul li:before,
        .atbd_sidebar .widget_pages ul li:before,
        .atbd_sidebar .widget_nav_menu ul li:before,
        .atbd_sidebar .widget_categories ul li:before,
        .sidebar .widget_product_categories ul li.menu-item-has-children:before,
        .sidebar .widget_product_categories ul .children:before,
        .sidebar .widget_archive ul li.menu-item-has-children:before,
        .sidebar .widget_archive ul .children:before,
        .sidebar .widget_pages ul li.menu-item-has-children:before,
        .sidebar .widget_pages ul .children:before,
        .sidebar .widget_nav_menu ul li.menu-item-has-children:before,
        .sidebar .widget_nav_menu ul .children:before,
        .sidebar .widget_categories ul li.menu-item-has-children:before,
        .sidebar .widget_categories ul .children:before,
        .atbd_sidebar .widget_product_categories ul li.menu-item-has-children:before,
        .atbd_sidebar .widget_product_categories ul .children:before,
        .atbd_sidebar .widget_archive ul li.menu-item-has-children:before,
        .atbd_sidebar .widget_archive ul .children:before,
        .atbd_sidebar .widget_pages ul li.menu-item-has-children:before,
        .atbd_sidebar .widget_pages ul .children:before,
        .atbd_sidebar .widget_nav_menu ul li.menu-item-has-children:before,
        .atbd_sidebar .widget_nav_menu ul .children:before,
        .atbd_sidebar .widget_categories ul li.menu-item-has-children:before,
        .atbd_sidebar .widget_categories ul .children:before,
        .widget_recent_comments ul li a, .widget_rss ul li span,
        .author-agency .service-delivery_deadline i,
        .service-delivery .service-delivery_deadline i,
        .author-agency .service-delivery_deadline span,
        .service-delivery .service-delivery_deadline span,
        .listing-details-wrapper .auther_agency_main .atbd_listing_meta .atbd_listing_average_right .atbd_service_budget > span,
        .listing-details-wrapper .auther_agency_main .atbd_listing_meta .atbd_listing_average_right .atbd_service_budget .atbd_listing_average_pricing span.atbd_active,
        .listing-details-wrapper .auther_agency_main .atbd_listing_meta .atbd_listing_average_right .listing-details-price > span,
        .atbd_listing_meta .atbd_listing_average_right li span,
        .atbd_listing_meta .atbd_listing_average_right li a:hover,
        .single-at_biz_dir .delivery_all .search-all .search-wrapper .search-categories ul li a:hover,
        .single-at_biz_dir .delivery_all .search-all .search-wrapper .search-categories ul li a:hover span,
        .single-at_biz_dir .delivery_all .search-all .location-wrapper .search-categories ul li a:hover,
        .single-at_biz_dir .delivery_all .search-all .location-wrapper .search-categories ul li a:hover span,
        .tab_main .nav-pills .nav-link.active,
        .tab_main .nav-pills .nav-link.active span,
        .tab-pane .atbdb_content_module_contents ol li:before,
        .delivery_button_link li.delivery_button_inner.dropdown .dropdown-menu ul li > a:hover,
        .author_agency_name .atbd_icon_autor ul li a span,
        .author_agency_name .atbd_icon_autor ul li p span, .video__btn,
        .atbd_add_listing_wrapper .atbdp_make_str_green,
        .atbd_add_listing_wrapper .map_drag_info, .dservice-text-block h3 strong,
        .bdmv_wrapper .default-ad-search .submit_btn .btn-default:hover,
        .bdmv_wrapper .default-ad-search .dlm-action-wrapper .btn-default:hover,
        .bdmv_wrapper .bdmv-map-listing .bdmv-listing #directorist.atbd_wrapper .atbd_generic_header .dlm_action_btns .view-as a:hover,
        .bdmv_wrapper .ajax-search-result .bdmv-listing #directorist.atbd_wrapper .atbd_generic_header .dlm_action_btns .view-as a:hover,
        .bdmv_wrapper .bdmv-map-listing .bdmv-listing #directorist.atbd_wrapper .atbd_generic_header .dlm_action_btns .view-as a.active,
        .bdmv_wrapper .ajax-search-result .bdmv-listing #directorist.atbd_wrapper .atbd_generic_header .dlm_action_btns .view-as a.active,
        .bdmv_wrapper .bdmv-map-listing .bdmv-listing #directorist.atbd_wrapper .atbd_generic_header .dlm_action_btns .dropdown .sort-by a:hover,
        .bdmv_wrapper .ajax-search-result .bdmv-listing #directorist.atbd_wrapper .atbd_generic_header .dlm_action_btns .dropdown .sort-by a:hover,
        .bdmv_wrapper.bdmv-columns-two .bdmv-search .bdmv-listing #directorist.atbd_wrapper .atbd_generic_header .dlm_action_btns .view-as a:hover,
        .bdmv_wrapper.bdmv-columns-two .bdmv-search .bdmv-listing #directorist.atbd_wrapper .atbd_generic_header .dlm_action_btns .dropdown .sort-by a:hover,
        .bdmv_wrapper.bdmv-columns-two .bdmv-search .bdmv-listing #directorist.atbd_wrapper .atbd_generic_header .dlm_action_btns .view-as a.active,
        #map .leaflet-popup-content .media-body h3 a,
        #gmap .leaflet-popup-content .media-body h3 a,
        #map .leaflet-popup-content .media-body .osm-iw-location span,
        #gmap .leaflet-popup-content .media-body .osm-iw-location span,
        #map .leaflet-popup-content .media-body .osm-iw-get-location span,
        #gmap .leaflet-popup-content .media-body .osm-iw-get-location span, .map-icon-label i, .atbd_map_shape > span,
        .error-contents .input-group .fc--rounded:focus, #show-sidebar,
        .sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li .active,
        .sidebar-wrapper .sidebar-menu .sidebar-dropdown .sidebar-submenu li .active:before,
        .dash-wrapper .sidebar-wrapper .sidebar-menu ul li a#v-pills-packages-tab.active,
        .dash-wrapper .sidebar-wrapper .sidebar-menu ul li a#v-pills-history-tab.active,
        .dash-wrapper .sidebar-wrapper .sidebar-menu ul li a .active,
        .dash-wrapper .sidebar-wrapper .sidebar-menu ul li.active a i,
        .dash-wrapper .sidebar-wrapper .sidebar-menu ul li.active a span:not(.badge),
        .page-wrapper.dash-wrapper.toggled #close-sidebar,
        .dash-wrapper .sidebar-wrapper ul li:hover a i,
        .dash-wrapper .sidebar-wrapper ul li:hover a span,
        .dash-wrapper .sidebar-wrapper .sidebar-dropdown .sidebar-submenu li a:hover,
        .dash-wrapper .sidebar-wrapper .sidebar-dropdown .sidebar-submenu li a:hover:before,
        .dash-wrapper .sidebar-wrapper .sidebar-search input.search-menu:focus + span,
        .atbdb_content_module_contents .table-inner .table tbody tr .dservice_plane_name p span .atpp_change_plan,
        .atbdb_content_module_contents .table-inner .table tbody tr td h6 a:hover,
        .atbdb_content_module_contents .table-inner .table tbody tr td .atbd_listing_icon ul li span i,
        .atbdb_content_module_contents .table-inner .table tbody tr td .dropdown-menu .dropdown-item:hover, #login_modal .form-excerpts ul li a:hover,
        #login_modal .form-excerpts .recover-pass-link:hover, #signup_modal .form-excerpts ul li a:hover, .atbd_listing_info .atbd_listing_title a:hover,
        .card-grid__header h6:hover,
        .card-grid__bottom p i,
        .card-list__header h6:hover,
        footer .footer-top .post-single P span a,
        footer .footer-bottom--content p span,
        .footer-top .calendar_wrap table caption,
        .post-details .post-content .post-body ol li:before,
        .post-details .post-header ul a:hover,
        .comment-respond p.logged-in-as a:hover,
        .woocommerce ul.products li.product .price,
        .woocommerce .woocommerce-pagination ul.page-numbers li .page-numbers:hover,
        .woocommerce table.shop_table .product-name a:hover,
        .woocommerce .woocommerce-MyAccount-navigation ul li.is-active a,
        .dservice_product-details .product-info .price ins,
        .dservice_product-details .product-info .price .woocommerce-Price-amount,
        .woocommerce div.product .dservice_product-info-tab .woocommerce-tabs ul.tabs li.active a,
        .list-features_one li .list-count span,
        .grid-single .post--card .card-body h6 a:hover,
        .mainmenu__menu .navbar-nav > li:hover > a,
        .mainmenu__menu .navbar-nav > li.menu-item .sub-menu li:hover a,
        .mainmenu__menu .navbar-nav > li.menu-item .sub-menu .menu-item-has-children > ul li a:hover,
        .cart_module .cart__items .items .item_info > a:hover,
        .cart_module .cart__items .items .item_remove span,
        .cart_module .cart__items .cart_info p span,
        .page .atbd_sidebar .woocommerce ul.product_list_widget li .product-title:hover,
        .post--card2 .card-body h3 a:hover,
        .blog-posts__single__contents h4 a:hover,
        .page .atbd_sidebar .widget-wrapper .post-title:hover,
        .single-post .sidebar .widget ul li a:hover,
        .blog .sidebar .widget ul li a:hover,
        .blog-area .sidebar .widget ul li a:hover,
        .post-author .author-info h5 span,
        .post-pagination .next-post .title:hover,
        .post-pagination .prev-post p a,
        .post-pagination .prev-post .title:hover,
        .related-post .single-post p a:hover,
        .post-pagination .next-post p span a,
        .post-pagination .prev-post p span a,
        .post-pagination .next-post p a,
        .post-pagination .prev-post p a,
        .search-categories ul li a:hover .la,
        .search-categories ul li a:hover .fa,
        .search-categories ul li a:hover h5,
        .single_area .sidebar .woocommerce ul.product_list_widget li a:hover, .tab-content .atbd_listting_category > span,
        .atbd_listting_category .atbd_cat_popup .atbd_cat_popup_wrapper span a:hover, #directorist.atbd_wrapper.directorist-checkout-form .alert-info, .atbd_listing_data_list ul p span.la, .atbd_listing_bottom_content .atbd_content_left .atbd_listting_category a span,
        .atbd_listing_bottom_content .atbd_content_left .atbd_listting_category a:hover, .directory_search_area .directory_home_category_area ul.categories li a:hover span, .directory_search_area .directory_home_category_area ul.categories li a:hover p, .atbd_category_single figure figcaption .icon span, .ads-advanced .more-less, .ads-advanced .more-or-less, .post--card .card-body .post-meta li a:hover, .post--card2 .card-body .post-meta li a:hover, figure figcaption a, #show-sidebar, .app-rated .download-content__head--end, .listing-carousel .owl-nav button:hover, .list-features_two .list-content .icon span, .author__access_area ul li .author-info ul li a:hover,
        .atbd_listting_category .atbd_cat_popup .atbd_cat_popup_wrapper span i,
        .app-rated .download-content__head p strong, .btn-outline-primary, #footer_text_color p a, .woocommerce-info a, .woocommerce-MyAccount-content a, .woocommerce div.product .price .woocommerce-Price-amount, .pricing .pricing__features .price_action .price_action--btn, .atbd_widget .default-ad-search button[type="reset"]:hover, .page-template-default .atbd_generic_header .atbd_listing_action_btn .view-mode a.active span, .section-title h1 span, .section-title h2 span, .section-title h3 span, .section-title h4 span, .section-title h5 span, .section-title h6 span, .current-menu-parent > a, .current-menu-parent .current-menu-item > a, .search-form-wrapper.search-form-wrapper--two .directory_search_area .pyn-search-group .pyn-search-radio input:checked + label, .block-single__icon i, .single-at_biz_dir .widget-wrapper .post-title:hover, .single-post .sidebar .widget-wrapper .post-title:hover, .blog .sidebar .widget-wrapper .post-title:hover, .blog-area .sidebar .widget-wrapper .post-title:hover, .site-title a, .atbd_authors_listing .author-listing-header .atbd-auth-listing-types a.active, .atbdp-res-btns .dlm-res-btn.active span, .atbd_author_info_widget .btn, .single-at_biz_dir .widget ul li a:hover, .single-post .sidebar .widget ul li a:hover, .blog .sidebar .widget ul li a:hover, .blog-area .sidebar .widget ul li a:hover, .post-author .author-info h5 span, .post-pagination .next-post .title:hover, .post-pagination .prev-post p a, .post-pagination .prev-post .title:hover, .related-post .single-post p a:hover, .single-post #directorist.atbd_wrapper .atbd_generic_header .atbd_generic_header_title .more-filter span.la, .atbd_manage_fees_wrapper table .btn.btn-block a{
            color: <?php echo esc_attr($primary); ?> !important;
        }

        /* prrmary background */
        .bg-primary,
        .keep_signed input[type="checkbox"]:checked + label:before,
        .keep_signed label input[type="checkbox"]:checked + span:before,
        .woocommerce ul.products li.product a.button:hover,
        .woocommerce ul.products li.product a.added_to_cart,
        .woocommerce ul.products li.product a.added_to_cart:hover,
        .woocommerce .woocommerce-pagination ul.page-numbers li .page-numbers.current,
        .woocommerce .woocommerce-pagination ul.page-numbers li .page-numbers.current:hover,
        .woocommerce table.shop_table td .button.view,
        .woocommerce table.shop_table td.actions .coupon button.button,
        .woocommerce .cart_totals .wc-proceed-to-checkout a.checkout-button,
        .woocommerce form.checkout .woocommerce-checkout-payment#payment .place-order button.button,
        .woocommerce .woocommerce-MyAccount-content .woocommerce-EditAccountForm .woocommerce-Button,
        .woocommerce .woocommerce-MyAccount-content .woocommerce-address-fields button[name="save_address"],
        .woocommerce .woocommerce-form-login .woocommerce-form-login__submit,
        .dservice_product-details .product-info .cart .single_add_to_cart_button,
        .cart_module .cart__items .items .item_remove:hover span,
        .btn-checkbox label input:checked + span,
        .custom-control .custom-control-input:checked ~ .check--select,
        .sort-rating .custom-control-label span,
        #directorist.atbd_wrapper .atbd_single_listing.atbd_listing_list .atbdp_mark_as_fav.atbdp_fav_isActive,
        .ads-advanced .price-frequency .pf-btn input:checked + span,
        #directorist.atbd_wrapper.directorist-checkout-form #atbdp-checkout-form #atbdp_pay_notpay_btn .btn-primary,
        #directorist.atbd_wrapper .btn.btn-primary,
        .atbd_author_info_widget .btn:hover,
        .atbdp-widget-categories .atbdp_parent_category li a:hover span,
        .widget_social li a:hover span,
        .social.social--small ul li a:hover,
        .social-share ul li a:hover,
        .atbdb_content_module_contents .atbd_big_gallery .slick-arrow:hover,
        .auther_agency_main .listing-info--badges li .atbd_badge_new,
        .delivery_image_left.social-share ul li a:hover,
        .atbd_pricing_options input[type='checkbox']:checked:after,
        .atbd_add_listing_wrapper input[type='checkbox']:checked:after,
        .atbd_add_listing_wrapper .select2-container--default .select2-selection--multiple .select2-selection__choice,
        .bdmv_wrapper .default-ad-search .submit_btn .btn-primary,
        .bdmv_wrapper .default-ad-search .dlm-action-wrapper .btn-primary,
        .marker-cluster-shape,
        .leaflet-pane .marker-cluster-small > div, .leaflet-pane .marker-cluster-medium > div,
        .atbdp-map .gm-style .gm-style-iw .gm-style-iw-d .miw-contents .miwl-rating .atbd_meta,
        .atbd_google_map .gm-style .gm-style-iw .gm-style-iw-d .miw-contents .miwl-rating .atbd_meta,
        .atbd_map_shape,
        .marker-cluster-shape,
        .error-contents .input-group button,
        #show-sidebar .bar,
        .profile-img .choose_btn #upload_pro_pic,
        .image-preview-input,
        .woocommerce form.lost_reset_password button.woocommerce-Button,
        .woocommerce #review_form #respond .form-submit input,
        .woocommerce div.product form.cart .button,
        .pricing.atbd_pricing_special .atbd_popular_badge,
        .atbd_listing_thumbnail_area .atbd_lower_badge .atbd_badge_new,
        .atbd_listing_thumbnail_area .atbd_upper_badge .atbd_badge.atbd_badge_new,
        .customers-testimonials .owl-dots .owl-dot.active span,
        .customers-testimonials .owl-dots .owl-dot span,
        .tags ul li a:hover,
        .widget .tagcloud .tag-cloud-link:hover,
        .atbdp-widget-tags ul li a:hover,
        .widget_product_tag_cloud .tagcloud ul li a:hover,
        footer .footer-bottom .footer-left__parent--son__link:hover,
        footer .footer-bottom .footer-left__parent--son__link .footer-left__parent--son__link__span:hover,
        footer input.search-submit:hover,
        footer input.search-submit,
        .social.social--small ul li a span:hover:before,
        .footer-light .social.social--small ul li a span:hover:before,
        .footer-top #today,
        .footer-top form button:not(.btn-default),
        .comments-area .comment-lists ul .depth-1 .media:first-child .media-body .media_top .reply:hover,
        .comments-area .comment-lists ul .depth-1 .media:first-child .media-body .media_top .comment-edit-link:hover,
        .comments-area .comment-lists ul .depth-1 .children .depth-2 .media .media-body .media_top .reply:hover,
        .comments-area .comment-lists ul .depth-1 .children .depth-2 .media .media-body .media_top .comment-edit-link:hover,
        .page .atbd_sidebar .sort-rating .custom-control-label span,
        .page .atbd_sidebar .social.social--small ul li a,
        .page .atbd_sidebar .widget form button,
        .social.social--small ul li a:hover,
        .blog-area .post-details .post-content .post-body input,
        .blog-area .post-details .post-content .post-body input:hover,
        .cart_module .cart__items .cart_info a.button,
        .cart_module .cart__items .cart_info a.checkout:hover,
        .cart_module .cart_count,
        .sidebar .widget-wrapper .widget-default .search-form input.search-submit,
        .sidebar .widget-wrapper .widget-default .search-form button,
        .sidebar .widget-wrapper .woocommerce-product-search input.search-submit,
        .sidebar .widget-wrapper .woocommerce-product-search button,
        .sidebar .widget_product_search .widget-default .search-form input.search-submit,
        .sidebar .widget_product_search .widget-default .search-form button,
        .sidebar .widget_product_search .woocommerce-product-search input.search-submit,
        .sidebar .widget_product_search .woocommerce-product-search button,
        .atbd_sidebar .widget-wrapper .widget-default .search-form input.search-submit,
        .atbd_sidebar .widget-wrapper .widget-default .search-form button,
        .atbd_sidebar .widget-wrapper .woocommerce-product-search input.search-submit,
        .atbd_sidebar .widget-wrapper .woocommerce-product-search button,
        .atbd_sidebar .widget_product_search .widget-default .search-form input.search-submit,
        .atbd_sidebar .widget_product_search .widget-default .search-form button,
        .atbd_sidebar .widget_product_search .woocommerce-product-search input.search-submit,
        .atbd_sidebar .widget_product_search .woocommerce-product-search button,
        .directory_search_area .atbd_submit_btn button.btn_search,
        .directory_search_area .select2-container--default .select2-results__option--highlighted[aria-selected], .woocommerce div.product .dservice_product-info-tab .woocommerce-tabs .woocommerce-Tabs-panel .woocommerce-Reviews #review_form_wrapper .comment_form_wrapper .form-submit input.btn,
        #atpp-plan-change-modal .atm-contents-inner .atbd_modal-footer .atbd_modal_btn,
        #dwpp-plan-renew-modal .atm-contents-inner .atbd_modal-footer .atbd_modal_btn,
        .atbd_content_active .widget.atbd_widget + #dcl-claim-modal .modal-footer .btn,
        #atpp-plan-change-modal .atm-contents-inner .at-modal-close,
        #dwpp-plan-renew-modal .atm-contents-inner .at-modal-close,
        footer .subscribe-widget form .btn,
        .single_area .sidebar .social.social--small ul li a:hover, .btn-primary, .btn-outline-primary:hover, .more-filter:hover, .atbdp_mark_as_fav.atbdp_fav_isActive, .select2-container--default .select2-results__option--highlighted[aria-selected], .bdmv_wrapper .default-ad-search .dlm-action-wrapper .btn-bordered:hover, .bdmv_wrapper .default-ad-search .submit_btn .btn-bordered:hover, .blog-single.sticky .card .card-body h3:before, .atbd_category_single figure figcaption:before, .atbd_manage_fees_wrapper table .btn:hover, .listing-carousel .owl-dots .owl-dot.active span, .listing-carousel .owl-dots .owl-dot span, .pricing .pricing__features .price_action .price_action--btn:hover, .atbd_category_single figure figcaption:before, .btn-gradient, .more-filter:hover, .ads-advanced .price-frequency .pf-btn input:checked + span, .btn-checkbox label input:checked + span, .listing-carousel .owl-dots .owl-dot.active span, .listing-carousel .owl-dots .owl-dot span, .offcanvas-menu__contents ul li a:hover, .atbd_listing_type_list a.choose-type-btn.ctb--one, .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .dropdown-item.active, .dropdown-item:active,
        .bdb_widget #form-booking .book-now, .bdb_widget #form-booking .login-booking {
            background: <?php echo esc_attr($primary); ?> !important;
        }

        /* primary border */
        .tags ul li a:hover,
        .widget .tagcloud .tag-cloud-link:hover,
        .atbdp-widget-tags ul li a:hover,
        .widget_product_tag_cloud .tagcloud ul li a:hover,
        footer .subscribe-widget form .form-control:focus,
        footer input.search-submit,
        .footer-top form input:focus,
        .post-details .post-body ul li:before,
        .sidebar .widget-wrapper .widget-default .search-form input.search-submit,
        .sidebar .widget-wrapper .widget-default .search-form button,
        .sidebar .widget-wrapper .woocommerce-product-search input.search-submit,
        .sidebar .widget-wrapper .woocommerce-product-search button,
        .sidebar .widget_product_search .widget-default .search-form input.search-submit,
        .sidebar .widget_product_search .widget-default .search-form button,
        .sidebar .widget_product_search .woocommerce-product-search input.search-submit,
        .sidebar .widget_product_search .woocommerce-product-search button,
        .atbd_sidebar .widget-wrapper .widget-default .search-form input.search-submit,
        .atbd_sidebar .widget-wrapper .widget-default .search-form button,
        .atbd_sidebar .widget-wrapper .woocommerce-product-search input.search-submit,
        .atbd_sidebar .widget-wrapper .woocommerce-product-search button,
        .atbd_sidebar .widget_product_search .widget-default .search-form input.search-submit,
        .atbd_sidebar .widget_product_search .widget-default .search-form button,
        .atbd_sidebar .widget_product_search .woocommerce-product-search input.search-submit,
        .atbd_sidebar .widget_product_search .woocommerce-product-search button,
        .sponser-carousel .owl-nav button:hover,
        .page-template-default .atbd_generic_header .atbd_listing_action_btn .view-mode a span:hover,
        .navbar .search-all a button,
        .navbar .search-all .search-wrapper .search_module .search_area form .input-group .form-control:focus,
        .navbar .search-all .search-wrapper .search_module .location_area form .input-group .form-control:focus,
        .navbar .search-all .search-wrapper .location_module .search_area form .input-group .form-control:focus,
        .navbar .search-all .search-wrapper .location_module .location_area form .input-group .form-control:focus,
        .navbar .search-all .location-wrapper .search_module .search_area form .input-group .form-control:focus,
        .navbar .search-all .location-wrapper .search_module .location_area form .input-group .form-control:focus,
        .navbar .search-all .location-wrapper .location_module .search_area form .input-group .form-control:focus,
        .navbar .search-all .location-wrapper .location_module .location_area form .input-group .form-control:focus,
        .navbar .search-all .search-wrapper .search_module.active .search_area form .input-group .form-control,
        .navbar .search-all .search-wrapper .location_module.active .search_area form .input-group .form-control,
        .navbar .search-all .location-wrapper .search_module.active .search_area form .input-group .form-control,
        .navbar .search-all .location-wrapper .location_module.active .search_area form .input-group .form-control,
        .more-filter:hover,
        .widget.atbd_widget .directorist button,
        .atbd_author_info_widget .btn,
        .single-at_biz_dir .delivery_all .search-all .search-wrapper .search_module .search_area form .input-group .form-control:focus,
        .single-at_biz_dir .delivery_all .search-all .search-wrapper .search_module .location_area form .input-group .form-control:focus,
        .single-at_biz_dir .delivery_all .search-all .search-wrapper .location_module .search_area form .input-group .form-control:focus,
        .single-at_biz_dir .delivery_all .search-all .search-wrapper .location_module .location_area form .input-group .form-control:focus,
        .single-at_biz_dir .delivery_all .search-all .location-wrapper .search_module .search_area form .input-group .form-control:focus,
        .single-at_biz_dir .delivery_all .search-all .location-wrapper .search_module .location_area form .input-group .form-control:focus,
        .single-at_biz_dir .delivery_all .search-all .location-wrapper .location_module .search_area form .input-group .form-control:focus,
        .single-at_biz_dir .delivery_all .search-all .location-wrapper .location_module .location_area form .input-group .form-control:focus,
        .single-at_biz_dir .delivery_all .search-all .search-wrapper .search_module.active .search_area form .input-group .form-control,
        .single-at_biz_dir .delivery_all .search-all .search-wrapper .location_module.active .search_area form .input-group .form-control,
        .single-at_biz_dir .delivery_all .search-all .location-wrapper .search_module.active .search_area form .input-group .form-control,
        .single-at_biz_dir .delivery_all .search-all .location-wrapper .location_module.active .search_area form .input-group .form-control,
        .single-at_biz_dir .delivery_all .search-all a button,
        .atbd_add_listing_wrapper .select2-container--default .select2-selection--multiple .select2-selection__choice,
        .atbd_pricing_options input[type='checkbox']:checked:after,
        .atbd_add_listing_wrapper input[type='checkbox']:checked:after,
        .error-contents .input-group button,
        .change-pass .form-group input:focus,
        .woocommerce ul.products li.product a.button:hover,
        .woocommerce ul.products li.product a.added_to_cart,
        .woocommerce ul.products li.product a.added_to_cart:hover,
        #login_modal .modal-body .form-excerpts input,
        #signup_modal .modal-body .form-excerpts input,
        #moda_claim_listing .modal-body .form-excerpts input, .pricing .pricing__features .price_action .price_action--btn, .page-template-default .atbd_generic_header .atbd_listing_action_btn .view-mode a.active span {
            border: 1px solid <?php echo esc_attr($primary); ?> !important;
        }

        .btn-checkbox label input:checked + span,
        .custom-control .custom-control-input:checked ~ .check--select,
        .custom-control .custom-control-input:checked ~ .radio--select,
        .ads-advanced .price-frequency .pf-btn input:checked + span,
        #directorist.atbd_wrapper.directorist-checkout-form #atbdp-checkout-form #atbdp_pay_notpay_btn .btn-primary,
        #directorist.atbd_wrapper .btn.btn-primary,
        .keep_signed input[type="checkbox"]:checked + label:before,
        .keep_signed label input[type="checkbox"]:checked + span:before, .delivery_image_left.social-share ul li a:hover,
        .atbd_add_listing_wrapper .atbd_general_information_module input.form-control:focus,
        .atbd_add_listing_wrapper .atbd_general_information_module select.form-control:focus,
        .atbd_add_listing_wrapper .atbd_general_information_module .select2-selection:focus,
        .atbd_add_listing_wrapper .atbd_contact_information input.form-control:focus,
        .atbd_add_listing_wrapper .atbd_contact_information select.form-control:focus,
        .atbd_add_listing_wrapper .atbd_contact_information .select2-selection:focus,
        .atbd_add_listing_wrapper .atbd_business_hour_module input.form-control:focus,
        .atbd_add_listing_wrapper .atbd_business_hour_module select.form-control:focus,
        .atbd_add_listing_wrapper .atbd_business_hour_module .select2-selection:focus,
        .atbd_add_listing_wrapper .atbdb_content_module_contents input.form-control:focus,
        .atbd_add_listing_wrapper .atbdb_content_module_contents select.form-control:focus,
        .atbd_add_listing_wrapper .atbdb_content_module_contents .select2-selection:focus,
        .atbd_add_listing_wrapper textarea.directory_field:focus,
        .atbd_add_listing_wrapper .selection,
        .bdmv_wrapper .default-ad-search .submit_btn .btn-primary,
        .bdmv_wrapper .default-ad-search .dlm-action-wrapper .btn-primary,
        .bdmv_wrapper .default-ad-search .submit_btn .btn-default:hover,
        .bdmv_wrapper .default-ad-search .dlm-action-wrapper .btn-default:hover,
        .bdmv_wrapper .bdmv-map-listing .bdmv-listing #directorist.atbd_wrapper .atbd_generic_header .dlm_action_btns .view-as a:hover,
        .bdmv_wrapper .ajax-search-result .bdmv-listing #directorist.atbd_wrapper .atbd_generic_header .dlm_action_btns .view-as a:hover,
        .bdmv_wrapper .bdmv-map-listing .bdmv-listing #directorist.atbd_wrapper .atbd_generic_header .dlm_action_btns .view-as a.active,
        .bdmv_wrapper .ajax-search-result .bdmv-listing #directorist.atbd_wrapper .atbd_generic_header .dlm_action_btns .view-as a.active,
        .bdmv_wrapper.bdmv-columns-two .bdmv-search .bdmv-listing #directorist.atbd_wrapper .atbd_generic_header .dlm_action_btns .view-as a:hover,
        .bdmv_wrapper.bdmv-columns-two .bdmv-search .bdmv-listing #directorist.atbd_wrapper .atbd_generic_header .dlm_action_btns .view-as a.active,
        .woocommerce .woocommerce-pagination ul.page-numbers li .page-numbers.current,
        .woocommerce .woocommerce-pagination ul.page-numbers li .page-numbers:hover,
        .woocommerce .woocommerce-MyAccount-navigation ul li.is-active,
        footer input.search-submit:hover,
        .blog-area .post-details .post-content .post-body input,
        .blog-area .post-details .post-content .post-body input:hover, #atpp-plan-change-modal .atm-contents-inner .atbd_modal-footer .atbd_modal_btn,
        #dwpp-plan-renew-modal .atm-contents-inner .atbd_modal-footer .atbd_modal_btn, .atbd_content_active .widget.atbd_widget + #dcl-claim-modal .modal-footer .btn:hover, .btn-primary, .btn-outline-primary:hover, .btn-outline-primary, .atbd_authors_listing .author-listing-header .atbd-auth-listing-types a.active, .atbdp-res-btns .dlm-res-btn.active {
            border-color: <?php echo esc_attr($primary); ?> !important;
        }

        #atpp-plan-change-modal .atm-contents-inner .dcl_pricing_plan input:checked + label:before,
        #dwpp-plan-renew-modal .atm-contents-inner .dcl_pricing_plan input:checked + label:before, .atbd_listing_type_list input[type='radio']:checked:after {
            border: 5px solid <?php echo esc_attr($primary); ?> !important;
        }

        .cart_module .cart__items {
            border-top: 1px solid <?php echo esc_attr($primary); ?> !important;
        }

        .tab_main .nav-pills .nav-link.active, .woocommerce div.product .dservice_product-info-tab .woocommerce-tabs ul.tabs li.active, .woocommerce div.product .woocommerce-tabs ul.tabs li.active a, .search-form-wrapper.search-form-wrapper--two .directory_search_area .pyn-search-group .pyn-search-radio input:checked + label {
            border-bottom: 1px solid <?php echo esc_attr($primary); ?> !important;
        }

        .bdmv-map-listing.loading::after,
        .ajax-search-result.loading::after {
            border-top: 8px solid <?php echo esc_attr($primary); ?> !important;
        }

        .atbd_map_shape:before {
            border-top: 15px solid <?php echo esc_attr($primary); ?> !important;
        }

        <?php }

        if ('rgba(55,125,255,0.9)' != $primary_g) { ?>

        .directory_search_area .directory_home_category_area ul.categories li a:hover span,
        .directory_search_area .directory_home_category_area ul.categories li a:hover p {
            color: <?php echo esc_attr($primary_g); ?> !important;
        }

        .woocommerce div.product form.cart .button:hover, .btn-gradient:hover {
            background: <?php echo esc_attr($primary_g); ?> !important;
        }

        .atbd_location_grid figure figcaption:before, .grid-item:hover:before {
            background: <?php echo esc_attr($primary_g); ?> !important;
        }

        .directory_search_area .atbd_submit_btn button.btn_search:hover {
            background-color: <?php echo esc_attr($primary_g); ?> !important;
        }

        <?php }

        if('#23c8b9' != $secondary || '#377dff' != $primary){ ?>

        .pricing.atbd_pricing_special .atbd_popular_badge {
            background: -webkit-gradient(linear, left top, right top, from(<?php echo esc_attr($primary); ?>), to(<?php echo esc_attr($secondary); ?>));
            background: -webkit-linear-gradient(left, <?php echo esc_attr($primary); ?>, <?php echo esc_attr($secondary); ?>);
            background: -o-linear-gradient(left, <?php echo esc_attr($primary); ?>, <?php echo esc_attr($secondary); ?>);
            background: linear-gradient(to right, <?php echo esc_attr($primary); ?>, <?php echo esc_attr($secondary); ?>);
        }

        .about-wrapper {
            background: linear-gradient(to right, <?php echo esc_attr($secondary); ?>, <?php echo esc_attr($primary); ?>);
        }

        .btn-gradient.btn-gradient-one, blockquote.wp-block-quote, blockquote {
            background: linear-gradient(to right, <?php echo esc_attr($primary); ?>, <?php echo esc_attr($secondary); ?>);
        }

        .btn-gradient.btn-gradient-one:before {
            background: linear-gradient(to right, <?php echo esc_attr($secondary); ?>, <?php echo esc_attr($primary); ?>);
        }

        .listing-gradient {
            background-image: linear-gradient(to right, <?php echo esc_attr($primary); ?>, <?php echo esc_attr($secondary); ?>);
        }

        .breadcrumb-top {
            background-image: linear-gradient(to left, <?php echo esc_attr($primary); ?>, <?php echo esc_attr($secondary); ?>);
        }

        .breadcrumb-top {
            background-image: linear-gradient(to left, <?php echo esc_attr($primary); ?>, <?php echo esc_attr($secondary); ?>);
        }

        <?php }

        if('#23c8b9' != $secondary){ ?>

        /*secondary color*/
        .atbd_listting_category .atbd_cat_popup .atbd_cat_popup_wrapper span,
        #login_modal .modal-body .form-excerpts label,
        #signup_modal .modal-body .form-excerpts label,
        #moda_claim_listing .modal-body .form-excerpts label,
        .blog-posts__single__contents ul li a,
        footer .atbd_categorized_listings .listings > li .cate_title h4 a,
        .footer-top .calendar_wrap table tfoot tr td a,
        footer .atbd_categorized_listings .listings > li .atbd_right_content .cate_title h4 a:hover,
        footer .footer-top ul li a:hover,
        footer .footer-top ul li a span::before,
        .atbd_listing_bottom_content a.dservice-grid-cont-btn,
        .grid-single .post--card .card-body .post-meta li a:hover,
        .widget_social .social-list li .title,
        .atbdpr-range .atbdpr_amount, .service-delivery ul li i,
        .service-delivery ul li.service-delivery_deadline span, .card-grid__content--list span, .delivery_button_link li.delivery_button_inner.save_listing > span > a:hover, .delivery_button_link li.delivery_button_inner.listing_share > div > span:hover, .delivery_button_link .atbd_report a:hover, .delivery_button_link li.delivery_button_inner.listing_share > div > span > span, .delivery_button_link li.delivery_button_inner.listing_share > div > span .atbd_report a span, .delivery_button_link .atbd_report a > span, .delivery_button_link .atbd_report a .atbd_report a span {
            color: <?php echo esc_attr($secondary); ?> !important;
        }

        .atbd_listing_thumbnail_area .atbd_upper_budget .atbd_service_budget,
        .atbdb_content_module_contents .pagination .active a,
        .atbd_listing_bottom_content a.dservice-grid-cont-btn:hover,
        footer .footer-bottom--social a:hover,
        .app-rated .store-btns .store-btns-inline:last-child a,
        .footer-top form button:hover:not(.btn-default),
        .pagination .nav-links .page-numbers.current,
        .pagination .nav-links .page-numbers:hover,
        .page .atbd_sidebar .widget form button:hover,
        .cart_module .cart__items .cart_info a.button:hover,
        .cart_module .cart__items .cart_info a.checkout,
        .atbdb_content_module_contents .pagination .page-item a:hover,
        .woocommerce .woocommerce-pagination .button,
        .woocommerce table.shop_table td.actions button[name="update_cart"],
        .woocommerce .woocommerce-shipping-calculator .shipping-calculator-form p button[name="calc_shipping"],
        .woocommerce form.checkout_coupon .form-row .button,
        .woocommerce .woocommerce-form-login .woocommerce-form-login__submit:hover,
        .woocommerce .return-to-shop a.wc-backward,
        .dservice_product-details .product-info form.variations_form .variations .reset_variations,
        .atbdpr-range .ui-slider-horizontal .ui-slider-range, .page .atbd_sidebar .social.social--small ul li a:hover, .btn-secondary, .atbd_listing_type_list a.choose-type-btn.ctb--two {
            background: <?php echo esc_attr($secondary); ?> !important;
        }


        .atbd_listing_bottom_content a.dservice-grid-cont-btn:hover,
        .pagination .nav-links .page-numbers.current,
        .pagination .nav-links .page-numbers:hover {
            border: 1px solid <?php echo esc_attr($secondary); ?> !important;
        }

        .atbdpr-range .ui-slider-horizontal .ui-slider-handle {
            border: 4px solid <?php echo esc_attr($secondary); ?> !important;
        }

        .atbdb_content_module_contents .pagination .active a {
            border-color: <?php echo esc_attr($secondary); ?> !important;
        }

        <?php }

        if('rgba(35,200,185,0.7)' != $secondary_g){ ?>
        .app-rated .store-btns .store-btns-inline:last-child a:hover, {
            background-color: <?php echo esc_attr($secondary_g); ?> !important;
        }

        <?php }

        if('#53ca2e' != $success){?>

        /* success color */
        .woocommerce ul.products li.product .onsale,
        .dservice_product-details .gallery-image-view .onsale,
        .author-agency .dservice_single_listing_title .dcl_claimed--badge span,
        .author-agency .service-delivery_title .dcl_claimed--badge span,
        .service-delivery .dservice_single_listing_title .dcl_claimed--badge span,
        .service-delivery .service-delivery_title .dcl_claimed--badge span,
        .delivery_title span.icon i,
        .atbd_listing_meta .atbd_listing_rating,
        .pricing .pricing__title h4 .atbd_plan-active {
            background: <?php echo esc_attr($success); ?> !important;
        }

        .woocommerce .woocommerce-message:before,
        .woocommerce ul.products li.product a.button.added,
        .woocommerce .woocommerce-order .woocommerce-thankyou-order-received,
        .sidebar .widget_calendar tr td#prev a,
        .sidebar .widget_calendar tr td#next a,
        .atbd_sidebar .widget_calendar tr td#prev a,
        .atbd_sidebar .widget_calendar tr td#next a,
        .sidebar .widget_calendar tr th,
        .atbd_sidebar .widget_calendar tr th,
        .widget .directory_open_hours .atbd_today .day,
        .widget .directory_open_hours .atbd_today .atbd_open_close_time,
        .widget .directory_open_hours .atbd_today .atbd_open_close_time .time,
        .atbdb_content_module_contents .table-inner .table tbody tr td .active,
        .dservice_plane_name .form-vertical .modal-footer span i,
        .pricing .pricing__features ul li span.fa-check,
        .pricing .pricing__features ul li .atbd_color-success,
        .pricing .pricing__features ul li > span.available:first-child,
        #login_modal .status span.color-success,
        #login_modal .status .woocommerce span.woocommerce-message:before,
        .woocommerce #login_modal .status span.woocommerce-message:before,
        #login_modal .status .woocommerce .woocommerce-order span.woocommerce-thankyou-order-received,
        .woocommerce .woocommerce-order #login_modal .status span.woocommerce-thankyou-order-received, .dservice_plane_name .form-vertical .modal-header p a, .atbd_badge_open {
            color: <?php echo esc_attr($success); ?> !important;
        }

        .woocommerce .woocommerce-message {
            border-top-color: <?php echo esc_attr($success); ?> !important;
        }

        <?php }

        if('#2c99ff' != $info){?>

        /*//info color*/
        .woocommerce .woocommerce-info:before {
            color: <?php echo esc_attr($info); ?> !important;
        }

        .woocommerce .woocommerce-info .button,
        .woocommerce .woocommerce-order .woocommerce-thankyou-order-details + p:before {
            background: <?php echo esc_attr($info); ?> !important;
        }

        .woocommerce .woocommerce-info {
            border-top-color: <?php echo esc_attr($info); ?> !important;

        }

        <?php }


        if('#fa8b0c' != $warnning){?>


        /*//warning color*/
        .br-theme-fontawesome-stars .br-widget a.br-active:after,
        .br-theme-fontawesome-stars .br-widget a.br-selected:after,
        .atbd_categorized_listings .listings > li .atbd_rated_stars ul li span.rate_active:before,
        .atbd_review_module #client_review_list .atbd_single_review .atbd_review_top .atbd_rated_stars ul li,
        .atbdb_content_module_contents .table-inner .table tbody tr td .pending,
        .atbdb_content_module_contents .table-inner .table tbody tr td .rating li span,
        .woocommerce ul.products li.product .star-rating span,
        .dservice_product-details .product-info .woocommerce-product-rating .star-rating,
        .dservice_product-details .product-info .woocommerce-product-rating .star-rating > span:before,
        .woocommerce div.product .dservice_product-info-tab .woocommerce-tabs .woocommerce-Tabs-panel .woocommerce-Reviews .commentlist li .comment-text .star-rating,
        .woocommerce div.product .dservice_product-info-tab .woocommerce-tabs .woocommerce-Tabs-panel .woocommerce-Reviews .commentlist li .comment-text .star-rating > span:before,
        .woocommerce div.product .dservice_product-info-tab .woocommerce-tabs .woocommerce-Tabs-panel .woocommerce-Reviews #review_form_wrapper .comment_form_wrapper .comment-form-rating .stars span a,
        .woocommerce .star-rating span::before,
        blockquote.wp-block-quote code,
        blockquote code,
        .comments-area blockquote code {
            color: <?php echo esc_attr($warnning); ?> !important;
        }

        .dservice-dashboard-no-listing, .atbd_upper_badge .atbd_badge.atbd_badge_featured, .atbd_listing_thumbnail_area .atbd_lower_badge .atbd_badge_featured {
            background: <?php echo esc_attr($warnning); ?> !important;
        }

        <?php }


        if('#f51957' != $danger){ ?>

        /* danger color*/
        .woocommerce .woocommerce-error:before,
        .widget .atbd_widget_title h4 .atbd_badge_close,
        .atbd_add_listing_wrapper .atbdp_make_str_red,
        .atbdb_content_module_contents .table-inner .table tbody tr td .expired,
        .pricing .pricing__features ul li span.fa-times,
        #login_modal .status span.color-danger,
        #login_modal .status .woocommerce span.woocommerce-error:before,
        .woocommerce #login_modal .status span.woocommerce-error:before,
        .blog-posts____single__contents ul li a:hover, .atbd_listing_meta .atbd_badge_close,
        .color-danger,
        .woocommerce .woocommerce-error:before,
        .directory_open_hours ul li.atbd_closed span,
        .pricing .pricing__features ul li > span.unavailable:first-child {
            color: <?php echo esc_attr($danger); ?> !important;
        }

        #v-bookmark-tab .table td .atbdp_add_to_fav_listings .atbdp_mark_as_fav:hover,
        .dservice_plane_name .form-vertical .modal-body .form-group [type="radio"]:checked + label:after,
        .auther_agency_main .listing-info--badges li .atbd_badge_popular,
        .profile-img #remove_pro_pic,
        .dservice_plane_name .form-vertical .modal-body .form-group [type="radio"]:not(:checked) + label:after,
        .atbd_content_active #directorist.atbd_wrapper .atbd_content_module .atbd_badge.atbd_badge_close,
        .atbd_listing_thumbnail_area .atbd_lower_badge .atbd_badge_popular,
        .atbd_listing_thumbnail_area .atbd_upper_badge .atbd_badge.atbd_badge_popular, #directorist.atbd_wrapper.directorist-checkout-form #atbdp-checkout-form #atbdp_pay_notpay_btn .btn-danger, .btn-danger {
            background: <?php echo esc_attr($danger); ?> !important;
        }

        .btn-danger {
            border-color: <?php echo esc_attr($danger); ?> !important;
        }

        <?php } ?>

    </style>

    <?php
}

add_action('wp_head', 'dservice_custom_style');
