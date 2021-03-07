<?php
/*
Plugin Name: dService Core
Plugin URI: https://demo.directorist.com/theme/dservice/
Description: Core plugin of dservice.
Author: wpWax
Author URI: https://wpwax.com
Domain Path: /languages
Text Domain: dservice-core
Version: 1.7
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function dservice_core_textdomain() {
	$plugin_rel_path = dirname( plugin_basename( __FILE__ ) ) . '/languages';
	load_plugin_textdomain( 'dservice-core', false, $plugin_rel_path );
}

add_action( 'plugins_loaded', 'dservice_core_textdomain' );

require_once plugin_dir_path( __FILE__ ) . 'inc/custom-style.php';
require_once plugin_dir_path( __FILE__ ) . 'inc/custom-widgets.php';
require_once plugin_dir_path( __FILE__ ) . 'inc/directorist-functions.php';
require_once plugin_dir_path( __FILE__ ) . 'inc/demo-importer.php';
require_once plugin_dir_path( __FILE__ ) . 'elementor/dservice-elementor.php';

/*
===========================================================================
	Page header control option
============================================================================*/
function dservice_add_meta_box() {
	add_meta_box( 'dservice_menu', esc_html__( 'Header Options', 'dservice-core' ), 'dservice_meta_box_callback', 'page', 'side', 'default' );
}

add_action( 'add_meta_boxes', 'dservice_add_meta_box' );

function dservice_meta_box_callback( $post ) {
	wp_nonce_field( 'dservice_meta_box', 'dservice_meta_box_nonce' );

	$value  = get_post_meta( $post->ID, 'menu_style', true );
	$search = get_post_meta( $post->ID, 'search_style', true );
	$banner = get_post_meta( $post->ID, 'banner_style', true ); 
	$type           = get_post_meta( $post->ID, 'menu_type', true );
	$type_checked   = empty( $type ) ? 'checked' : ''; ?>

	<p><label for="wdm_new_field"><b><?php _e( 'Menu Type', 'dlist-core' ); ?></b></label></p>
	<input id="wdm_new_field" type="radio" name="type" value="sticky"
	<?php checked( $type, 'sticky' ); echo esc_attr( $type_checked ); ?>>
	<?php _e( 'Sticky Menu', 'dlist-core' ); ?> <br>
	<input id="wdm_new_field" type="radio" name="type" value="fixed" <?php checked( $type, 'fixed' ); ?>>
	<?php _e( 'Fixed Menu', 'dlist-core' ); ?><br><br>

	<div id="menu-option">
		<p><label for="menu"> <b><?php esc_html_e( 'Menu Area', 'dservice-core' ); ?></b> </label></p>
		<input id="menu" type="radio" name="menu_styles" value="bg-white" <?php checked( $value, 'bg-white' ); ?> checked>
		<?php esc_html_e( 'Light Background', 'dservice-core' ); ?> <br />
		<input id="menu" type="radio" name="menu_styles" value="bg-dark" <?php checked( $value, 'bg-dark' ); ?>>
		<?php esc_html_e( 'Dark Background', 'dservice-core' ); ?><br />
	</div>

	<div id="search-option">
		<p><label for="search"> <b><?php esc_html_e( 'Top Search', 'dservice-core' ); ?></b> </label></p>
		<input id="search" type="radio" name="search_options" value="enable" <?php checked( $search, 'enable' ); ?> checked>
		<?php esc_html_e( 'Show', 'dservice-core' ); ?><br>
		<input id="search" type="radio" name="search_options" value="disable" <?php checked( $search, 'disable' ); ?>>
		<?php esc_html_e( 'Hide', 'dservice-core' ); ?>
	</div>

	<div id="breadcrumb-option">
		<p><label for="breadcrumb"> <b><?php esc_html_e( 'Breadcrumb Area', 'dservice-core' ); ?></b> </label></p>
		<input id="breadcrumb" type="radio" name="breadcrumb_options" value="enable" <?php checked( $banner, 'enable' ); ?> checked>
		<?php esc_html_e( 'Show', 'dservice-core' ); ?><br>
		<input id="breadcrumb" type="radio" name="breadcrumb_options" value="disable" <?php checked( $banner, 'disable' ); ?>>
		<?php esc_html_e( 'Hide', 'dservice-core' ); ?>
	</div>
	<?php
}

function dservice_save_meta_box_data( $post_id ) {
	if ( ! isset( $_POST['dservice_meta_box_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['dservice_meta_box_nonce'], 'dservice_meta_box' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$update_menu       = ( isset( $_POST['menu_styles'] ) ? sanitize_html_class( $_POST['menu_styles'] ) : '' );
	$update_search     = ( isset( $_POST['search_options'] ) ? sanitize_html_class( $_POST['search_options'] ) : '' );
	$update_breadcrumb = ( isset( $_POST['breadcrumb_options'] ) ? sanitize_html_class( $_POST['breadcrumb_options'] ) : '' );
	$type              = ( isset( $_POST['type'] ) ? sanitize_html_class( $_POST['type'] ) : '' );

	update_post_meta( $post_id, 'menu_style', $update_menu );
	update_post_meta( $post_id, 'search_style', $update_search );
	update_post_meta( $post_id, 'banner_style', $update_breadcrumb );
	update_post_meta( $post_id, 'menu_type', $type );
}

add_action( 'save_post', 'dservice_save_meta_box_data' );

/*
===========================================================================
	Single listing header control option
============================================================================*/
if ( ! function_exists( 'dservice_single_add_meta_box' ) ) {
	function dservice_single_add_meta_box() {
		add_meta_box( 'dservice_single_menu', esc_html__( 'Header Option', 'dservice-core' ), 'dservice_single_meta_box_callback', array( 'at_biz_dir', 'product', 'post' ), 'side', 'default' );
	}

	add_action( 'add_meta_boxes', 'dservice_single_add_meta_box' );
}

function dservice_single_meta_box_callback( $post ) {
	wp_nonce_field( 'dservice_single_meta_box', 'dservice_single_meta_box_nonce' );

	$post_id = isset( $_GET['post'] ) ? (int) $_GET['post'] : '';
	$value   = get_post_meta( $post_id, 'menu_style', true );
	$type          = get_post_meta( $post->ID, 'menu_type', true );
	$type_checked  = empty( $type ) ? 'checked' : ''; ?>

	<p><label for="wdm_new_field"><b><?php _e( 'Menu Type', 'dlist-core' ); ?></b></label></p>
	<input id="wdm_new_field" type="radio" name="type" value="sticky"
	<?php checked( $type, 'sticky' ); echo esc_attr( $type_checked ); ?>>
	<?php _e( 'Sticky Menu', 'dlist-core' ); ?> <br>
	<input id="wdm_new_field" type="radio" name="type" value="fixed" <?php checked( $type, 'fixed' ); ?>>
	<?php _e( 'Fixed Menu', 'dlist-core' ); ?> <br>

	<p><label for="dservice_new_field"> <b><?php esc_html_e( 'Menu Area', 'dservice-core' ); ?></b> </label></p>
	<input type="radio" name="menu_styles" value="bg-white" <?php checked( $value, 'bg-white' ); ?> checked>
	<?php esc_html_e( 'Light Background', 'dservice-core' ); ?> <br>
	<input type="radio" name="menu_styles" value="bg-dark" <?php checked( $value, 'bg-dark' ); ?>>
	<?php esc_html_e( 'Dark Background', 'dservice-core' ); ?>

	<?php
}

function dservice_single_save_meta_box_data( $post_id ) {
	if ( ! isset( $_POST['dservice_single_meta_box_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['dservice_single_meta_box_nonce'], 'dservice_single_meta_box' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$new_meta_value = ( isset( $_POST['menu_styles'] ) ? sanitize_html_class( $_POST['menu_styles'] ) : '' );
	$type           = ( isset( $_POST['type'] ) ? sanitize_html_class( $_POST['type'] ) : '' );

	update_post_meta( $post_id, 'menu_style', $new_meta_value );
	update_post_meta( $post_id, 'menu_type', $type );
}

add_action( 'save_post', 'dservice_single_save_meta_box_data' );


/*
===========================================================================
	Footer style
============================================================================*/

function dservice_footer_style_callback( $post ) {
	wp_nonce_field( 'dservice_footer_meta_box', 'dservice_footer_meta_box_nonce' );
	$value = get_post_meta( $post->ID, 'footer_style', true );
	?>

	<p><label for="dservice_new_field"> <b><?php esc_html_e( 'Footer Area Background', 'dservice-core' ); ?></b> </label></p>
	<input type="radio" name="footer_styles" value="footer-section" <?php checked( $value, 'footer-section' ); ?> checked>
	<?php esc_html_e( 'Dark Background', 'dservice-core' ); ?> <br>
	<input type="radio" name="footer_styles" value="footer-light" <?php checked( $value, 'footer-light' ); ?>>
	<?php esc_html_e( 'Light Background', 'dservice-core' ); ?>

	<p><label for="dservice_new_field"> <b><?php esc_html_e( 'Widget Area', 'dservice-core' ); ?></b> </label></p>
	<input type="radio" name="widget_area" value="widget_show" <?php checked( $value, 'widget_show' ); ?> checked>
	<?php esc_html_e( 'Show', 'dservice-core' ); ?> <br>
	<input type="radio" name="widget_area" value="widget_hide" <?php checked( $value, 'widget_hide' ); ?>>
	<?php esc_html_e( 'Hide', 'dservice-core' ); ?>

	<?php
}

function dservice_footer_style() {
	add_meta_box( 'dservice_footer_style', esc_html__( 'Footer Options', 'dservice-core' ), 'dservice_footer_style_callback', array( 'at_biz_dir', 'product', 'post', 'page' ), 'side', 'default' );
}

add_action( 'add_meta_boxes', 'dservice_footer_style' );

function dservice_footer_style_control( $post_id ) {
	if ( ! isset( $_POST['dservice_footer_meta_box_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( $_POST['dservice_footer_meta_box_nonce'], 'dservice_footer_meta_box' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$new_meta_value  = ( isset( $_POST['footer_styles'] ) ? sanitize_html_class( $_POST['footer_styles'] ) : '' );
	$new_meta_values = ( isset( $_POST['widget_area'] ) ? sanitize_html_class( $_POST['widget_area'] ) : '' );

	update_post_meta( $post_id, 'footer_style', $new_meta_value );
	update_post_meta( $post_id, 'widget_area', $new_meta_values );
}

add_action( 'save_post', 'dservice_footer_style_control' );


/*
=====================================
		Login Form popup Ajax
=======================================*/
function vb_register_user_scripts() {
	wp_localize_script(
		'vb_reg_script',
		'vb_reg_vars',
		array(
			'vb_ajax_url' => admin_url( 'admin-ajax.php' ),
		)
	);
}

add_action( 'wp_enqueue_scripts', 'vb_register_user_scripts', 100 );

/**
 * New User registration
 */
function vb_reg_new_user() {
	$display_password = get_directorist_option( 'display_password_reg', 1 );
	// Verify nonce
	if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'vb_new_user' ) ) {
		echo __( 'Ooops, something went wrong, please try again later.', 'dservice-core' );
		die();
	}
	// Post values
	$username = $_POST['user'];
	$email    = $_POST['mail'];
	if ( empty( $display_password ) ) {
		$password = wp_generate_password( 12, false );
	} elseif ( empty( $_POST['password'] ) ) {
		$password = wp_generate_password( 12, false );
	} else {
		$password = sanitize_text_field( $_POST['password'] );
	}
	if ( ! empty( $password ) && 5 > strlen( $password ) ) {
		echo __( 'Password length must be greater than 5', 'dservice-core' );
		die();
	}
	/**
	 * IMPORTANT: You should make server side validation here!
	 */
	$userdata = array(
		'user_login' => $username,
		'user_email' => $email,
		'user_pass'  => $password,
	);
	$user_id  = wp_insert_user( $userdata );
	if ( ! is_wp_error( $user_id ) ) {
		update_user_meta( $user_id, '_atbdp_generated_password', $password );
		wp_new_user_notification( $user_id, null, 'admin' ); // send activation to the admin
		ATBDP()->email->custom_wp_new_user_notification_email( $user_id );
		echo '1';
	} else {
		echo $user_id->get_error_message();
	}
	die();
}

add_action( 'wp_ajax_register_user', 'vb_reg_new_user' );
add_action( 'wp_ajax_nopriv_register_user', 'vb_reg_new_user' );

/*
===================================
	Login & Register Configuration
======================================*/
if ( ! function_exists( 'dservice_post_navigation' ) ) {
	function dservice_post_navigation() {
		$categories_list = get_the_category_list( esc_html__( ', ', 'dservice-core' ) );
		?>
		<div class="post-pagination">
			<div class="prev-post">
				<span><?php esc_html_e( 'Next Post:', 'dservice-core' ); ?></span>
				<a href="<?php the_permalink( get_next_post() ); ?>" class="title">
					<?php echo get_the_title( get_next_post() ); ?>
				</a>
				<p>
					<span><?php echo dservice_time_link(); ?></span>
					<?php esc_html_e( '- In', 'dservice-core' ); ?> <?php echo ( ! empty( $categories_list ) ) ? $categories_list : ''; ?>
				</p>
			</div>

			<div class="next-post">
				<span><?php esc_html_e( 'Previous Post:', 'dservice-core' ); ?></span>
				<a href="<?php the_permalink( get_previous_post() ); ?>" class="title"><?php echo get_the_title( get_previous_post() ); ?></a>
				<p>
					<span><?php echo dservice_time_link(); ?></span>
					<?php esc_html_e( '- In', 'dservice-core' ); ?> <?php echo ( ! empty( $categories_list ) ) ? $categories_list : ''; ?>
				</p>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'dservice_related_post' ) ) {
	function dservice_related_post() {
		$categories = array();
		foreach ( get_the_category( get_the_ID() ) as $category ) {
			$categories[] = $category->term_id;
		};
		wp_reset_postdata();

		$args          = array(
			'post__not_in'        => array( get_the_ID() ),
			'posts_per_page'      => 3,
			'ignore_sticky_posts' => 1,
			'tax_query'           => array(
				array(
					'taxonomy' => 'category',
					'field'    => 'term_id',
					'terms'    => $categories,
					'operator' => 'IN',
				),
			),
		);
		$related_posts = new WP_Query( $args );

		if ( count( $related_posts->posts ) != 0 ) {
			?>
			<div class="related-post m-top-60">
				<div class="related-post--title text-center">
					<h3><?php esc_html_e( 'Related Posts', 'dservice-core' ); ?></h3>
				</div>
				<div class="row">
					<?php
					if ( $related_posts->have_posts() ) {
						while ( $related_posts->have_posts() ) {
							$related_posts->the_post();
							?>
							<div class="col-lg-4 col-sm-6">
								<div class="single-post">
									<?php
									the_post_thumbnail( 'dservice-related-blog' );
									the_title( sprintf( '<h6><a href="%s">', get_the_permalink() ), '</a></h6>' );
									?>
									<p>
										<span><?php echo dservice_time_link(); ?></span>
										<?php
										esc_html_e( 'in ', 'dservice-core' );
										echo get_the_category_list( esc_html__( ', ', 'dservice-core' ) );
										?>
									</p>
								</div>
							</div>
							<?php
						}
						wp_reset_query();
					}
					?>
				</div>
			</div>
			<?php
		}
		wp_reset_postdata();
	}
}

if ( ! function_exists( 'dservice_share_post' ) ) {
	function dservice_share_post() {
		?>
		<div class="social-share d-flex align-items-center">
			<span class="m-right-15"> <?php esc_html_e( 'Share Post:', 'dservice-core' ); ?> </span>

			<ul class="social-share list-unstyled">
				<li>
					<a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank" title="<?php esc_html_e( 'Facebook', 'dservice-core' ); ?>">
						<i class="fab fa-facebook"></i>
					</a>
				</li>
				<li>
					<a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php echo htmlspecialchars( urlencode( html_entity_decode( get_the_title(), ENT_COMPAT, 'UTF-8' ) ), ENT_COMPAT, 'UTF-8' ); ?>" target="_blank" title="<?php esc_html_e( 'Tweet', 'dservice-core' ); ?>">
						<i class="fab fa-twitter"></i>
					</a>
				</li>
				<li>
					<a href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>" target="_blank" title="<?php esc_html_e( 'LinkedIn', 'dservice-core' ); ?>">
						<i class="fab fa-linkedin-in"></i>
					</a>
				</li>
			</ul>
		</div>
		<?php
	}
}

/*
=====================================================
	Author Social Profile
=================================================*/

if ( ! function_exists( 'dservice_author_social_icon' ) ) {

	function dservice_author_social_icon( $social ) {
		$social['twitter']     = esc_html__( 'Twitter Username', 'dservice-core' );
		$social['google_plus'] = esc_html__( 'Google plus profile', 'dservice-core' );
		$social['facebook']    = esc_html__( 'Facebook Profile', 'dservice-core' );
		$social['linkedin']    = esc_html__( 'Linkedin Profile', 'dservice-core' );

		return $social;
	}

	add_filter( 'user_contactmethods', 'dservice_author_social_icon' );
}


function dservice_author_social() {
	 global $post;
	$facebook    = get_user_meta( $post->post_author, 'facebook', true );
	$twitter     = get_user_meta( $post->post_author, 'twitter', true );
	$linkedin    = get_user_meta( $post->post_author, 'linkedin', true );
	$google_plus = get_user_meta( $post->post_author, 'google_plus', true );

	if ( ! empty( $facebook || $twitter || $linkedin || $google_plus ) ) {
		?>

		<ul class="list-unstyled social-basic">
			<?php
			if ( $facebook ) {
				?>
				<li>
					<a href="<?php echo esc_url( $facebook ); ?>">
						<i class="fab fa-facebook"></i>
					</a>
				</li>
				<?php
			}
			if ( $twitter ) {
				?>
				<li>
					<a href="<?php echo esc_url( $twitter ); ?>">
						<i class="fab fa-twitter"></i>
					</a>
				</li>
				<?php
			}
			if ( $linkedin ) {
				?>
				<li>
					<a href="<?php echo esc_url( $linkedin ); ?>">
						<i class="fab fa-linkedin-in"></i>
					</a>
				</li>
				<?php
			}
			if ( $google_plus ) {
				?>
				<li>
					<a href="<?php echo esc_url( $google_plus ); ?>">
						<i class="fab fa-google-plus-g"></i>
					</a>
				</li>
				<?php
			}
			?>
		</ul>
		<?php
	}
}


/*
=====================================================
	Blog post Tag and Category
=================================================*/
function dservice_post_cats() {
	 $categories_list = get_the_category_list( esc_html__( ', ', 'dservice-core' ) );
	if ( $categories_list ) {
		echo ( '<li>' . esc_html__( 'in', 'dservice-core' ) . ' ' . $categories_list . '</li>' );
	}
}

function dservice_post_tags() {
	if ( ! empty( get_the_tags() ) ) {
		?>
		<div class="tags">
		   <?php the_tags( '<ul class="list-unstyled"><li>', '</li><li>', '</li></ul>' ); ?>
		</div>
		<?php
	}
}

/*
=====================================================
 Login and Register Button
=================================================*/

function dservice_recovery_password() {
	global $wpdb;
	$error   = '';
	$success = '';
	$email   = trim( $_POST['user_login'] );
	if ( empty( $email ) ) {
		$error = esc_html__( 'Enter valid e-mail address', 'dservice-core' );
	} elseif ( ! is_email( $email ) ) {
		$error = esc_html__( 'Invalid e-mail address.', 'dservice-core' );
	} elseif ( ! email_exists( $email ) ) {
		$error = esc_html__( 'There is no user registered with that email address.', 'dservice-core' );
	} else {
		$random_password = wp_generate_password(12, false);
		$user = get_user_by('email', $email);
		$update_user = update_user_meta($user->ID, '_atbdp_recovery_key', $random_password);

		// if  update user return true then lets send user an email containing the new password
		if ($update_user) {
			$subject = esc_html__('	Password Reset Request', 'dservice-core');
			//$message = esc_html__('Your new password is: ', 'dservice-core') . $random_password;

			$site_name = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
			$message = __('Someone has requested a password reset for the following account:', 'dservice-core') . "<br>";
			/* translators: %s: site name */
			$message .= sprintf(__('Site Name: %s', 'dservice-core'), $site_name) . "<br>";
			/* translators: %s: user login */
			$message .= sprintf(__('User: %s', 'dservice-core'), $user->user_login) . "<br>";
			$message .= __('If this was a mistake, just ignore this email and nothing will happen.', 'dservice-core') . "<br>";
			$message .= __('To reset your password, visit the following address:', 'dservice-core') . "<br>";
			$link = array(
					'key' => $random_password,
					'user' => $email,
			);
			$message .= '<a href="' . esc_url(add_query_arg($link, ATBDP_Permalink::get_login_page_url())) . '">' . esc_url(add_query_arg($link, ATBDP_Permalink::get_login_page_url())).'</a>';

			$message = atbdp_email_html($subject, $message);

			$headers[] = 'Content-Type: text/html; charset=UTF-8';
			$mail = wp_mail($email, $subject, $message, $headers);
			if ($mail) {
				$success = __('A password reset email has been sent to the email address on file for your account, but may take several minutes to show up in your inbox.', 'dservice-core');
			} else {
				$error = __('Password updated! But something went wrong sending email.', 'dservice-core');
			}
		} else {
			$error = esc_html__('Oops something went wrong updaing your account.', 'dservice-core');
		}
	}

	if ( ! empty( $error ) ) {
		echo json_encode(
			array(
				'loggedin' => false,
				'message'  => $error,
			)
		);
	}

	if ( ! empty( $success ) ) {
		echo json_encode(
			array(
				'loggedin' => true,
				'message'  => $success,
			)
		);
	}

	die();
}

function dservice_ajax_login() {
	// First check the nonce, if it fails the function will break
	check_ajax_referer( 'ajax-login-nonce', 'security' );
	$username       = $_POST['username'];
	$user_password  = $_POST['password'];
	$keep_signed_in = ! empty( $_POST['rememberme'] ) ? true : false;
	$user           = wp_authenticate( $username, $user_password );
	if ( is_wp_error( $user ) ) {
		echo json_encode(
			array(
				'loggedin' => false,
				'message'  => __(
					'Wrong username or password.',
					'dservice-core'
				),
			)
		);
	} else {
		wp_set_current_user( $user->ID );
		wp_set_auth_cookie( $user->ID, $keep_signed_in );
		echo json_encode(
			array(
				'loggedin' => true,
				'message'  => __(
					'Login successful',
					'dservice-core'
				),
			)
		);
	}
	exit();
}

function dservice_ajax_login_init() {
	wp_enqueue_script( 'ajax-login-script', get_theme_file_uri( 'theme_assets/js/ajax-login-register-script.js' ), 'jquery', null, true );
	$display_password = ( class_exists( 'Directorist_Base' ) ) ? get_directorist_option( 'display_password_reg', 1 ) : '';
	$confirmation     = empty( $display_password ) ? __( ' Go to your inbox or spam/junk and get your password.', 'dservice-core' ) : __( ' Congratulations! Registration completed.', 'dservice-core' );
	wp_localize_script(
		'ajax-login-script',
		'dservice_ajax_login_object',
		array(
			'ajaxurl'                   => admin_url( 'admin-ajax.php' ),
			'redirecturl'               => ( class_exists( 'Directorist_Base' ) ) ? ATBDP_Permalink::get_login_redirection_page_link() : home_url( '/' ),
			'loadingmessage'            => esc_html__( 'Sending user info, please wait...', 'dservice-core' ),
			'registration_confirmation' => $confirmation,
			'login_failed'              => esc_html__( 'Sorry! Login failed', 'dservice-core' ),
		)
	);

	add_action( 'wp_ajax_nopriv_dservice_ajaxlogin', 'dservice_ajax_login' );
	add_action( 'wp_ajax_nopriv_dservice_recovery_password', 'dservice_recovery_password' );
}


function dservice_dashboard_notification() {
	if ( isset( $_GET['renew'] ) && ( 'token_expired' === $_GET['renew'] ) ) {
		?>
		<div class="alert alert-danger">
			<i class="la la-times-circle"></i>
			<?php _e( 'Link appears to be invalid.', 'dservice-core' ); ?>
		</div>
		<?php
	}
	if ( isset( $_GET['renew'] ) && ( 'success' === $_GET['renew'] ) ) {
		?>
		<div class="alert alert-success">
			<i class="la la-check-circle"></i>
		<?php _e( 'Renewed successfully.', 'dservice-core' ); ?>
		</div>
		<?php
	}
}