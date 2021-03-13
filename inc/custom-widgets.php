<?php
/**
 * Description.
 *
 * @package WordPress
 * @author  AazzTech
 * @since   1.0
 * @version 1.0
 */

function dservice_mail_desc() {
	 $html = '<strong>Login <a href="https://mailchimp.com" target="_blank">Mailchimp</a> > Profile > Audience > Create  Audience / select existing audience</strong><br> Then go to <strong>Signup forms > Embedded forms </strong> and scroll down then you will found <strong>Copy/paste onto your site</strong> textarea including some text. Copy the form action URL and paste it here. <b style="color: green;">[For more details follow theme docs: <a href="http://directorist.com/docs/page-builder/" target="_blank">Page Builder</a>]</b>';
	echo wp_kses_post( $html );
}

// Subscribe for blog.
class dservice_subscribe_widget extends WP_Widget {
	public function __construct() {
		 $widget_details = array(
			 'classname'   => 'dservice_subscribe_widget',
			 'description' => esc_html__( 'You can use it to display Subscribe form.', 'dservice_core' ),
		 );
		 parent::__construct( 'dservice_subscribe_widget', esc_html__( '-[Subscribe]', 'dservice_core' ), $widget_details );
	}

	public function widget( $args, $instance ) {
		$form = ! empty( $instance['form'] ) ? $instance['form'] : ''; ?>

		<div class="widget-wrapper">
			<div class="widget-default">
				<div class="widget-content">
					<div class="subscribe-widget">
						<form action="<?php echo esc_url( $form ); ?>" method="get">
							<input type="email" class="form-control m-bottom-20" placeholder="<?php echo esc_attr_x( 'Enter email', 'placeholder', 'dservice_core' ); ?>">
							<button class="btn btn-sm btn-primary shadow-none" type="submit"><i class="la la-send"></i>
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	public function form( $instance ) {
		$form = ! empty( $instance['form'] ) ? $instance['form'] : '';
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'form' ) ); ?>">
				<b><?php esc_html_e( 'Mailchimp Action Url', 'dservice-core' ); ?></b>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'form' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'form' ) ); ?>" type="text" value="<?php echo esc_attr( $form ); ?>" />
		</p>

		<p class="help">
			<?php dservice_mail_desc(); ?>
		</p>

		<?php
	}

	public function update( $new_instance, $old_instance ) {
		if ( ! empty( $new_instance['title'] ) ) {
			$new_instance['title'] = sanitize_text_field( $new_instance['title'] );
		}
		if ( ! empty( $new_instance['form'] ) ) {
			$new_instance['form'] = sanitize_text_field( $new_instance['form'] );
		}
		return $new_instance;
	}
}


// **************************************************************************************
// Popular post
// **************************************************************************************


class dservice_popular_post_widget extends WP_Widget {

	public function __construct() {
		 $widget_details = array(
			 'classname'   => 'dservice_popular_post_widget',
			 'description' => esc_html__( 'You can use it to display popular post.', 'dservice_core' ),
		 );
		 parent::__construct( 'dservice_popular_post_widget', esc_html__( '-[Popular Blog]', 'dservice_core' ), $widget_details );
	}

	public function widget( $args, $instance ) {
		$title      = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$post_count = ! empty( $instance['post_count'] ) ? $instance['post_count'] : '';

		// Popular posts
		query_posts(
			array(
				'posts_per_page' => $post_count,
				'post_type'      => 'post',
				'meta_key'       => 'post_views_count',
				'orderby'        => 'meta_value_num',
				'post__not_in'   => get_option( 'sticky_posts' ),
				'order'          => 'DESC',
			)
		);
		?>

		<div class="widget-wrapper">
			<div class="widget-default">
				<?php
				if ( ! empty( $title ) ) {
					?>
					<div class="widget-header">
						<h6 class="widget-title"><?php echo esc_html( $title ); ?></h6>
					</div>
					<?php
				}
				if ( have_posts() ) {
					?>
					<div class="widget-content">
						<div class="sidebar-post">
							<?php
							while ( have_posts() ) {
								the_post();
								?>
								<div class="post-single">
									<div class="d-flex align-items-center">
										<?php the_post_thumbnail( array( 60, 60 ), array( 'class' => 'rounded' ) ); ?>
										<p>
											<a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
											<span><?php echo function_exists( 'dservice_time_link' ) ? dservice_time_link() : ''; ?></span>
										</p>
									</div>
								</div>
								<?php
							}
							wp_reset_postdata();
							?>
						</div>
					</div>
					<?php
				} else {
					?>
					<div class="widget-content">
						<div class="sidebar-post">
							<h4> <?php esc_html_e( 'No Post Found.', 'dservice_core' ); ?> </h4>
						</div>
					</div>
					<?php
				}
				wp_reset_query();
				?>
			</div>
		</div>
		<?php
	}

	public function form( $instance ) {
		 $title     = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$post_count = ! empty( $instance['post_count'] ) ? $instance['post_count'] : '';
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<b><?php esc_html_e( 'Title', 'dservice-core' ); ?></b>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'post_count' ) ); ?>">
				<b><?php esc_html_e( 'How many posts you want to show ?', 'dservice-core' ); ?></b>
			</label>

			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_count' ) ); ?>" type="text" value="<?php echo esc_attr( $post_count ); ?> " />
		</p>

		<?php
	}

	public function update( $new_instance, $old_instance ) {
		if ( ! empty( $new_instance['title'] ) ) {
			$new_instance['title'] = sanitize_text_field( $new_instance['title'] );
		}
		if ( ! empty( $new_instance['post_count'] ) ) {
			$new_instance['post_count'] = sanitize_text_field( $new_instance['post_count'] );
		}
		return $new_instance;
	}
}


// **************************************************************************************
// Latest post
// **************************************************************************************


class dservice_latest_post_widget extends WP_Widget {


	public function __construct() {
		 $widget_details = array(
			 'classname'   => 'dservice_latest_post_widget',
			 'description' => esc_html__( 'You can use it to display latest post.', 'dservice_core' ),
		 );
		 parent::__construct( 'dservice_latest_post_widget', esc_html__( '-[Latest Blog]', 'dservice_core' ), $widget_details );
	}

	public function widget( $args, $instance ) {
		$title      = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$post_count = ! empty( $instance['post_count'] ) ? $instance['post_count'] : '';

		// Popular posts
		query_posts(
			array(
				'posts_per_page' => $post_count,
				'post_type'      => 'post',
				'post__not_in'   => get_option( 'sticky_posts' ),
				'order'          => 'DESC',
			)
		);
		?>

		<div class="widget-wrapper">
			<div class="widget-default">
				<?php if ( ! empty( $title ) ) { ?>
					<div class="widget-header">
						<h6 class="widget-title"><?php echo esc_html( $title ); ?></h6>
					</div>
					<?php
				}
				if ( have_posts() ) {
					?>
					<div class="widget-content">
						<div class="sidebar-post">
							<?php
							while ( have_posts() ) {
								the_post();
								?>
								<div class="post-single">
									<div class="d-flex align-items-center">
										<?php the_post_thumbnail( array( 60, 60 ), array( 'class' => 'rounded' ) ); ?>
										<p>
											<a href="<?php the_permalink(); ?>" class="post-title"><?php the_title(); ?></a>
											<span><?php echo function_exists( 'dservice_time_link' ) ? dservice_time_link() : ''; ?></span>

										</p>
									</div>
								</div><!-- ends: .post-single -->
								<?php
							}
							wp_reset_postdata();
							?>
						</div>
					</div>
					<?php
				} else {
					?>
					<div class="widget-content">
						<div class="sidebar-post">
							<h4> <?php esc_html_e( 'No Post Found.', 'dservice_core' ); ?> </h4>
						</div>
					</div>
					<?php
				}
				wp_reset_query();
				?>
			</div>
		</div>
		<?php
	}

	public function form( $instance ) {
		$title      = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$post_count = ! empty( $instance['post_count'] ) ? $instance['post_count'] : '';
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<b><?php esc_html_e( 'Title', 'dservice-core' ); ?></b>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'post_count' ) ); ?>">
				<b><?php esc_html_e( 'How many posts you want to show ?', 'dservice-core' ); ?></b>
			</label>

			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'post_count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'post_count' ) ); ?>" type="text" value="<?php echo esc_attr( $post_count ); ?> " />
		</p>

		<?php
	}

	public function update( $new_instance, $old_instance ) {
		if ( ! empty( $new_instance['title'] ) ) {
			$new_instance['title'] = sanitize_text_field( $new_instance['title'] );
		}
		if ( ! empty( $new_instance['post_count'] ) ) {
			$new_instance['post_count'] = sanitize_text_field( $new_instance['post_count'] );
		}
		return $new_instance;
	}
}


// **************************************************************************************
// Social
// **************************************************************************************

class dservice_connect_follow_widget extends WP_Widget {


	public function __construct() {
		 $widget_details = array(
			 'classname'   => 'dservice_connect_follow_widget',
			 'description' => esc_html__( 'You can use it to display social profile with icon.', 'dservice_core' ),
		 );
		 parent::__construct( 'dservice_connect_follow_widget', esc_html__( '-[Social Icon]', 'dservice_core' ), $widget_details );
	}

	public function widget( $args, $instance ) {
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		?>
		<div class="widget-wrapper">
			<div class="widget-default">
				<?php if ( ! empty( $title ) ) { ?>
					<div class="widget-header">
						<h6 class="widget-title"><?php echo esc_attr( $title ); ?></h6>
					</div>
					<?php
				}
				?>
				<div class="widget-content">
					<div class="social social--small social--gray ">
						<ul class="d-flex flex-wrap">
							<?php
							for ( $i = 1; $i <= $instance['social']; $i++ ) {

								$link_text = ! empty( $instance[ "link_text$i" ] ) ? $instance[ "link_text$i" ] : '';
								$link_url  = ! empty( $instance[ "link_url$i" ] ) ? $instance[ "link_url$i" ] : '';
								if ( $link_text ) :
									?>
									<li>
										<a href="<?php echo esc_url( $link_url ); ?>" class="<?php echo esc_attr( $link_text ); ?>">
											<span class="fab fa-<?php echo esc_attr( $link_text ); ?>"></span>
										</a>
									</li>
									<?php
							endif;
							}
							wp_reset_postdata();
							?>

						</ul>
					</div>

				</div>
			</div>
		</div>

		<?php
	}

	public function form( $instance ) {
		 $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$social = ! empty( $instance['social'] ) ? $instance['social'] : '';
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<b><?php esc_html_e( 'Title', 'dservice-core' ); ?></b>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social' ) ); ?>">
				<b><?php esc_html_e( 'How many social field would you want? & hit save.', 'dservice-core' ); ?></b>
			</label>
		</p>

		<p><input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'social' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'social' ) ); ?>" type="text" value="<?php echo esc_attr( $social ); ?>" />
		</p>

		<?php
		if ( ! empty( $social ) ) {
			printf( "<p style='font-size: 12px; color: #9d9d9d; font-style: italic'>%s | <a href='https://fontawesome.com/icons?d=listing&m=free' target='_blank'>%s</a></p>", esc_html__( 'Please Note: Social Icon Names are just Fonts Awesome Icon Name in lower case(eg. facebook-f or twitter etc)', 'dservice_core' ), esc_html__( 'Font Awesome Icons List', 'dservice_core' ) );
			for ( $i = 1; $i <= $social; $i++ ) {

				$link_text = ! empty( $instance[ "link_text$i" ] ) ? $instance[ "link_text$i" ] : '';
				$link_url  = ! empty( $instance[ "link_url$i" ] ) ? $instance[ "link_url$i" ] : '';
				?>

				<p style="border: 1px solid #f5548e; padding: 10px; ">
					<label for="<?php echo esc_attr( $this->get_field_id( "link_text$i" ) ); ?>">
						<?php echo "#$i : Social Icon Name"; ?>
						<a href='https://fontawesome.com/icons?d=listing&m=free' target='_blank'>Font Awesome Icons
							List</a>
					</label>
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( "link_text$i" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "link_text$i" ) ); ?>" type="text" value="<?php echo esc_attr( $link_text ); ?>" />

					<label for="<?php echo esc_attr( $this->get_field_id( "link_url$i" ) ); ?>"><?php echo "#$i : Social url"; ?></label>
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( "link_url$i" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "link_url$i" ) ); ?>" type="text" value="<?php echo esc_attr( $link_url ); ?>" />
				</p>

				<?php
			}
			wp_reset_postdata();
		}
		?>

		<?php
	}

	public function update( $new_instance, $old_instance ) {
		if ( ! empty( $new_instance['title'] ) ) {
			$new_instance['title'] = sanitize_text_field( $new_instance['title'] );
		}
		if ( ! empty( $new_instance['social'] ) ) {
			$new_instance['social'] = sanitize_text_field( $new_instance['social'] );
		}

		return $new_instance;
	}
}


// **************************************************************************************
// search
// **************************************************************************************

class dservice_search_widget extends WP_Widget {


	public function __construct() {
		 $widget_details = array(
			 'classname'   => 'dservice_search_widget',
			 'description' => esc_html__( 'You can use it to display a search form.', 'dservice_core' ),
		 );
		 parent::__construct( 'dservice_search_widget', esc_html__( '-[Search]', 'dservice_core' ), $widget_details );
	}

	public function widget( $args, $instance ) {
		?>
		<div class="widget-wrapper">
			<div class="search-widget">
				<form role="search" method="get" action="<?php echo esc_url( home_url() ); ?>">
					<div class="input-group">
						<input type="search" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" class="fc--rounded" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder', 'dservice_core' ); ?>">
						<button value="search" type="submit"><i class="la la-search"></i></button>
					</div>
				</form>
			</div>
		</div>
		<?php
	}

	public function form( $instance ) {
		?>
		<p><b><?php echo esc_html__( 'dservice theme default search widget.', 'dservice_core' ); ?></b></p>

		<?php
	}
}


// **************************************************************************************
// Sponsor
// **************************************************************************************

class dservice_sponsor_widget extends WP_Widget {


	public function __construct() {
		 $widget_details = array(
			 'classname'   => 'dservice_sponsor_widget',
			 'description' => esc_html__( 'You can use it to display featured service listings.', 'dservice_core' ),
		 );
		 parent::__construct( 'dservice_sponsor_widget', esc_html__( '-[Featured Listing Carousel]', 'dservice_core' ), $widget_details );
	}

	public function widget( $args, $instance ) {
		$title     = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$posts_per = ( ! empty( $instance['posts_per'] ) ) ? $instance['posts_per'] : '';

		if ( class_exists( 'Directorist_Base' ) ) {
			$args = array(
				'post_type'      => ATBDP_POST_TYPE,
				'post_status'    => 'publish',
				'posts_per_page' => $posts_per,
				'meta_query'     => array(
					'relation' => 'AND',
					array(
						'relation' => 'OR',

						array(
							'key'     => '_need_post',
							'value'   => 'no',
							'compare' => '=',
						),
						array(
							'key'     => '_need_post',
							'compare' => 'NOT EXISTS',
						),
					),
					array(
						'key'     => '_featured',
						'value'   => 1,
						'compare' => '==',
					),
				),
				'orderby'        => 'desc',
			);

			$all_listings = new WP_Query( $args );
			?>


			<div class="widget-wrapper sponsored-listing-widget">
				<?php if ( ! empty( $title ) ) { ?>
					<div class="widget-header">
						<h6 class="widget-title"><?php echo esc_attr( $title ); ?></h6>
					</div>
					<?php
				}
				?>
				<div class="sponser-carousel owl-carousel">
					<?php
					if ( $all_listings->have_posts() ) {
						while ( $all_listings->have_posts() ) {
							$all_listings->the_post();

							$locs                       = get_the_terms( get_the_ID(), ATBDP_LOCATION );
							$featured                   = get_post_meta( get_the_ID(), '_featured', true );
							$listing_img                = get_post_meta( get_the_ID(), '_listing_img', true );
							$listing_prv_img            = get_post_meta( get_the_ID(), '_listing_prv_img', true );
							$address                    = get_post_meta( get_the_ID(), '_address', true );
							$phone_number               = get_post_meta( get_the_Id(), '_phone', true );
							$display_title              = get_directorist_option( 'display_title', 1 );
							$display_review             = get_directorist_option( 'enable_review', 1 );
							$display_price              = get_directorist_option( 'display_price', 1 );
							$display_author_image       = get_directorist_option( 'display_author_image', 1 );
							$display_publish_date       = get_directorist_option( 'display_publish_date', 1 );
							$display_contact_info       = get_directorist_option( 'display_contact_info', 1 );
							$display_feature_badge_cart = get_directorist_option( 'display_feature_badge_cart', 1 );
							$popular_badge_text         = get_directorist_option( 'popular_badge_text', 'Popular' );
							$feature_badge_text         = get_directorist_option( 'feature_badge_text', 'Featured' );
							$address_location           = get_directorist_option( 'address_location', 'location' );
							$display_mark_as_fav        = get_directorist_option( 'display_mark_as_fav', 1 );
							$display_popular_badge_cart = get_directorist_option( 'display_popular_badge_cart', 1 );
							$popular_listing_id         = atbdp_popular_listings( get_the_ID() );
							/*Code for Business Hour Extensions*/
							$author_id             = get_the_author_meta( 'ID' );
							$u_pro_pic_id          = get_user_meta( $author_id, 'pro_pic', true );
							$u_pro_pic             = wp_get_attachment_image_src( $u_pro_pic_id, 'thumbnail' );
							$thumbnail_cropping    = get_directorist_option( 'thumbnail_cropping', 1 );
							$crop_width            = get_directorist_option( 'crop_width', 360 );
							$crop_height           = get_directorist_option( 'crop_height', 300 );
							$display_address_field = get_directorist_option( 'display_address_field', 1 );
							$display_phone_field   = get_directorist_option( 'display_phone_field', 1 );
							$default_image         = get_directorist_option( 'default_preview_image', ATBDP_PUBLIC_ASSETS . 'images/grid.jpg' );

							$prv_image = $gallery_img = '';
							if ( $listing_prv_img ) {

								if ( $thumbnail_cropping ) {
									$prv_image = atbdp_image_cropping( $listing_prv_img, $crop_width, $crop_height, true, 100 )['url'];
								} else {
									$prv_image = wp_get_attachment_image_src( $listing_prv_img, 'large' )[0];
								}
							}

							if ( $listing_img ) {
								if ( $thumbnail_cropping ) {
									$gallery_img = atbdp_image_cropping( $listing_img[0], $crop_width, $crop_height, true, 100 )['url'];
								} else {
									$gallery_img = wp_get_attachment_image_src( $listing_img[0], 'medium' )[0];
								}
							}
							?>

							<div class="atbdp_column_carousel">
								<div class="atbd_single_listing atbd_listing_card ">
									<article class="atbd_single_listing_wrapper <?php echo $featured ? esc_html( 'directorist-featured-listings' ) : ''; ?>">
										<figure class="atbd_listing_thumbnail_area">

											<div class="atbd_listing_image">
												<?php
												$disable_single_listing = get_directorist_option( 'disable_single_listing' );

												echo empty( $disable_single_listing ) ? sprintf( '<a href="%s">', esc_url( get_post_permalink( get_the_ID() ) ) ) : '';
												if ( $listing_prv_img ) {
													echo sprintf( '<img src="%s" alt="%s">', esc_url( $prv_image ), dservice_get_image_alt( $listing_prv_img ) );
												}
												if ( $listing_img && ! $listing_prv_img ) {
													echo sprintf( '<img src="%s" alt="%s">', esc_url( $gallery_img ), dservice_get_image_alt( $listing_prv_img ) );
												}
												if ( ! $listing_img && ! $listing_prv_img ) {
													echo sprintf( '<img src="%s" alt="%s">', esc_url( $default_image ), dservice_get_image_alt( $listing_prv_img ) );
												}

												echo empty( $disable_single_listing ) ? wp_kses_post( '</a>' ) : '';

												if ( $display_author_image ) {
													$author        = get_userdata( $author_id );
													$author_avatar = $u_pro_pic ? sprintf( '<img src="%s" alt="%s">', esc_url( $u_pro_pic[0] ), dservice_get_image_alt( $u_pro_pic_id ) ) : get_avatar( $author_id, 32 );

													echo sprintf( '<div class="atbd_author"> <a href="%s" aria-label="%s" class="atbd_tooltip">%s</a> </div>', esc_url( ATBDP_Permalink::get_user_profile_page_link( $author_id ) ), esc_attr( $author->first_name . ' ' . $author->last_name ), $author_avatar );
												}
												?>
											</div>

											<span class="atbd_upper_badge">
												<?php
												echo new_badge();
												if ( $featured && ! empty( $display_feature_badge_cart ) ) {
													$featured = sprintf( '<span class="atbd_badge atbd_badge_featured">%s</span>', esc_attr( $feature_badge_text ) );
													echo apply_filters( 'atbdp_featured_badge', $featured );
												}
												if ( $display_popular_badge_cart && ( $popular_listing_id === get_the_ID() ) ) {
													echo sprintf( '<span class="atbd_badge atbd_badge_popular">%s</span>', esc_attr( $popular_badge_text ) );
												}
												?>
											</span>

											<?php echo listings_budget(); ?>

											<?php echo ! empty( $display_mark_as_fav ) ? atbdp_listings_mark_as_favourite( get_the_ID() ) : ''; ?>

										</figure>

										<div class="atbd_listing_info">
											<?php if ( $display_title || $display_review || $display_price ) { ?>
												<div class="atbd_content_upper">

													<?php
													$listing_title = $disable_single_listing ? stripslashes( get_the_title() ) : sprintf( '<a href="%s">%s</a>', esc_url( get_post_permalink( get_the_ID() ) ), stripslashes( get_the_title() ) );
													echo ! empty( $display_title ) ? sprintf( '<h4 class="atbd_listing_title">%s</h4>', wp_kses_post( $listing_title ) ) : '';

													function_exists( 'dservice_listings_review_price' ) ? dservice_listings_review_price() : '';

													if ( $display_contact_info || $display_publish_date || $display_phone_field ) {
														?>
														<div class="atbd_listing_data_list">
															<ul>
																<?php
																if ( $display_contact_info ) {
																	if ( $address && ( 'contact' == $address_location ) && $display_address_field ) {
																		echo sprintf( '<li> <p> <span class="%s-map-marker"></span>%s</p> </li>', atbdp_icon_type( false ), stripslashes( $address ) );
																	} elseif ( $locs && ( 'location' == $address_location ) ) {
																		$output = $link = array();
																		foreach ( $locs as $loc ) {
																			$link     = ATBDP_Permalink::atbdp_get_location_page( $loc );
																			$space    = str_repeat( ' ', 1 );
																			$output[] = sprintf( '%s<a href=%s>%s</a>', esc_attr( $space ), esc_url( $link ), esc_attr( $loc->name ) );
																		}
																		wp_reset_postdata();

																		echo sprintf( '<li><p><span class="%s-map-marker"></span>%s</span></p></li>', atbdp_icon_type(), join( ',', $output ) );
																	}
																	if ( $phone_number && $display_phone_field ) {
																		echo sprintf( '<li> <p> <span class="%s-phone"></span> <a href="tel:%s">%s</a> </p> </li>', atbdp_icon_type(), stripslashes( $phone_number ), stripslashes( $phone_number ) );
																	}
																}

																if ( $display_publish_date ) {
																	?>
																	<li>
																		<p>
																			<span class="<?php atbdp_icon_type( true ); ?>-clock-o"></span>
																			<?php
																			$publish_date_format = get_directorist_option( 'publish_date_format', 'time_ago' );
																			if ( 'time_ago' === $publish_date_format ) {
																				printf( esc_html__( 'Posted %s ago', 'dservice-core' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) );
																			} else {
																				echo get_the_date();
																			}
																			?>
																		</p>
																	</li>
																	<?php
																}
																?>
															</ul>
														</div>
														<?php
													}
													?>
												</div>
												<?php
											}

											function_exists( 'dservice_listings_grid_view_footer_content' ) ? dservice_listings_grid_view_footer_content() : '';
											?>

									</article>
								</div>
							</div>
							<?php
						}
						wp_reset_postdata();
					} else {
						?>
						<p class="atbdp_nlf">
							<?php esc_html_e( 'No listing found.', 'dservice-core' ); ?>
						</p>
						<?php
					}
					?>
				</div>
			</div>
			<?php
		}
	}

	public function form( $instance ) {
		 $title    = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';
		$posts_per = ( ! empty( $instance['posts_per'] ) ) ? $instance['posts_per'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<b><?php esc_html_e( 'Title', 'dservice-core' ); ?></b>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'posts_per' ) ); ?>">
				<b><?php esc_html_e( 'How many listing you want to show ?', 'dservice-core' ); ?></b>
			</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'posts_per' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'posts_per' ) ); ?>" type="text" value="<?php echo esc_attr( $posts_per ); ?>" />
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {
		if ( ! empty( $new_instance['title'] ) ) {
			$new_instance['title'] = sanitize_text_field( $new_instance['title'] );
		}
		if ( ! empty( $new_instance['posts_per'] ) ) {
			$new_instance['posts_per'] = sanitize_text_field( $new_instance['posts_per'] );
		}

		return $new_instance;
	}
}


// **************************************************************************************
// Contact Info
// **************************************************************************************
class dservice_icon_title_widget extends WP_Widget {


	public function __construct() {
		 $widget_details = array(
			 'classname'   => 'dservice_icon_title_widget',
			 'description' => esc_html__( 'You can use it to display social profile with icon.', 'dservice_core' ),
		 );
		 parent::__construct( 'dservice_icon_title_widget', esc_html__( '-[Icon With Title]', 'dservice_core' ), $widget_details );
	}

	public function widget( $args, $instance ) {
		?>

		<div class="widget atbd_widget widget_social">
			<ul class="list-unstyled social-list">
				<?php
				for ( $i = 1; $i <= $instance['social']; $i++ ) {

					$s_title  = ! empty( $instance[ "s_title$i" ] ) ? $instance[ "s_title$i" ] : '';
					$sb_title = ! empty( $instance[ "sb_title$i" ] ) ? $instance[ "sb_title$i" ] : '';
					$icon     = ! empty( $instance[ "icon$i" ] ) ? $instance[ "icon$i" ] : '';

					if ( $icon || $s_title || $sb_title ) {
						?>
						<li>
							<i class="la la-<?php echo esc_attr( $icon ); ?>"></i>
							<h6 class="title"><?php echo esc_html( $s_title ); ?></h6>
							<p class="sub-title"><?php echo esc_html( $sb_title ); ?></p>
						</li>
						<?php
					}
				}
				wp_reset_postdata();
				?>

			</ul>
		</div>

		<?php

	}

	public function form( $instance ) {
		$social = ! empty( $instance['social'] ) ? $instance['social'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'social' ) ); ?>">
				<b><?php esc_html_e( 'How many social field would you want? & hit save.', 'dservice-core' ); ?></b>
			</label>
		</p>

		<p>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'social' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'social' ) ); ?>" type="text" value="<?php echo esc_attr( $social ); ?>" />
		</p>

		<?php
		if ( ! empty( $social ) ) {
			printf( "<p style='font-size: 12px; color: #9d9d9d; font-style: italic'>%s | <a href='https://icons8.com/line-awesome' target='_blank'>%s</a></p>", esc_html__( 'Please Note: Social Icon Names are just Line Awesome Icon Name in lower case(eg. facebook-f or twitter etc)', 'dservice_core' ), esc_html__( 'Line Awesome Icons List', 'dservice_core' ) );
			for ( $i = 1; $i <= $social; $i++ ) {

				$s_title  = ! empty( $instance[ "s_title$i" ] ) ? $instance[ "s_title$i" ] : '';
				$sb_title = ! empty( $instance[ "sb_title$i" ] ) ? $instance[ "sb_title$i" ] : '';
				$icon     = ! empty( $instance[ "icon$i" ] ) ? $instance[ "icon$i" ] : '';
				?>

				<p style="border: 1px solid #f5548e; padding: 10px; ">

					<label for="<?php echo esc_attr( $this->get_field_id( "s_title$i" ) ); ?>"><?php echo "#$i : Title"; ?></label>
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( "s_title$i" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "s_title$i" ) ); ?>" type="text" value="<?php echo esc_attr( $s_title ); ?>" />

					<label for="<?php echo esc_attr( $this->get_field_id( "sb_title$i" ) ); ?>"><?php echo "#$i : Subtitle"; ?></label>
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( "sb_title$i" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "sb_title$i" ) ); ?>" type="text" value="<?php echo esc_attr( $sb_title ); ?>" />

					<label for="<?php echo esc_attr( $this->get_field_id( "icon$i" ) ); ?>">
						<?php echo "#$i : Icon Name"; ?>
						<a href='https://icons8.com/line-awesome' target='_blank'>Line Awesome Icons
							List</a>
					</label>
					<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( "icon$i" ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( "icon$i" ) ); ?>" type="text" value="<?php echo esc_attr( $icon ); ?>" />
				</p>

				<?php
			}
			wp_reset_postdata();
		}
	}

	public function update( $new_instance, $old_instance ) {
		if ( ! empty( $new_instance['social'] ) ) {
			$new_instance['social'] = sanitize_text_field( $new_instance['social'] );
		}

		return $new_instance;
	}
}


function dservice_widgets_register() {
	register_widget( 'dservice_subscribe_widget' );
	register_widget( 'dservice_popular_post_widget' );
	register_widget( 'dservice_latest_post_widget' );
	register_widget( 'dservice_connect_follow_widget' );
	register_widget( 'dservice_search_widget' );
	register_widget( 'dservice_sponsor_widget' );
	register_widget( 'dservice_icon_title_widget' );
}

add_action( 'widgets_init', 'dservice_widgets_register' );
