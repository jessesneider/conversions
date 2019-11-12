<?php
/**
 * Template Name: Homepage
 *
 * Template for displaying the homepage.
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<div id="homepage-wrapper" class="wrapper">

  <?php if ( has_post_thumbnail( get_the_ID() ) ) {
    conversions()->template->fullscreen_featured_image();
  } ?>

  <!-- Hero Section -->
	<section class="c-hero d-flex align-items-center">
  	<div class="container-fluid">
  		<div class="row">
        <div class="<?php echo esc_attr( get_theme_mod( 'conversions_hh_content_position') ); ?>">
           			
          <!-- Title -->
    			<h1><?php echo esc_html( get_the_title() ); ?></h1>
    			
          <?php
            if ( !empty( get_theme_mod( 'conversions_hh_desc') ) ) {
              echo '<p class="lead c-hero__description">'.wp_kses_post( get_theme_mod( 'conversions_hh_desc' ) ).'</p>';
            }

            if ( ( get_theme_mod( 'conversions_hh_button', 'no' ) != 'no' ) || ( get_theme_mod( 'conversions_hh_vbtn', 'no' ) != 'no' ) ) :
    			
              // Button links
              echo '<p class="lead">';

                // callout button
                if ( get_theme_mod( 'conversions_hh_button', 'no' ) != 'no' ) {
                  echo sprintf( '<a href="%s" class="btn %s btn-lg c-hero__callout-btn">%s</a>', 
                    esc_url( get_theme_mod( 'conversions_hh_button_url' ) ), 
                    esc_attr( get_theme_mod( 'conversions_hh_button' ) ),
                    esc_html( get_theme_mod( 'conversions_hh_button_text' ) )
                  );
                }

                // video modal
                if ( get_theme_mod( 'conversions_hh_vbtn', 'no' ) != 'no' ) {
                  echo sprintf( '<a data-fancybox="c-hero__fb-video1" href="%1$s" class="c-hero__fb-video"><span class="c-hero__video-btn btn btn-%2$s btn--circle"><i class="fa fa-play"></i></span><span class="c-hero__video-text btn btn-link text-%2$s">%3$s</span></a>', 
                    esc_url( get_theme_mod( 'conversions_hh_vbtn_url' ) ), 
                    esc_attr( get_theme_mod( 'conversions_hh_vbtn' ) ),
                    esc_html( get_theme_mod( 'conversions_hh_vbtn_text' ) )
                  );
                }

              echo '</p>';

            endif; 
          ?>

  			</div>
  		</div>
		</div>
  </section>

	<!-- Clients section -->
	<section class="c-clients border-top border-bottom">
		<div class="container-fluid">
			<div class="row">
  			<div class="col-12">

          <?php 
            $chc_max_slides = get_theme_mod( 'conversions_hc_max', '5' );
            $chc_logo_width = get_theme_mod( 'conversions_hc_logo_width', '100' ) + 60;

            if ( esc_html( get_theme_mod( 'conversions_hc_respond', 'auto' ) == 'auto' ) ) 
            {
              
              $chc_breakpoints = ['768','576','375'];

              foreach ($chc_breakpoints as $s) {
                $n = floor( $s / $chc_logo_width );
                if ( $n > $chc_max_slides ) {
                  $n = $chc_max_slides;
                }
                elseif ( $n < 1 ) {
                  $n = 1;
                }
                $chc_items_to_show[] = $n;
              }

            } 
            else 
            {
              $chc_items_to_show = [
                ''.esc_html( get_theme_mod( 'conversions_hc_lg', '4' ) ).'',
                ''.esc_html( get_theme_mod( 'conversions_hc_md', '3' ) ).'',
                ''.esc_html( get_theme_mod( 'conversions_hc_sm', '2' ) ).'',
              ];
            }
          ?>
          
  				<!-- Client logos -->
					<div class='c-clients__carousel py-4' data-slick='{"arrows":true,"dots":false,"infinite":true,"slidesToShow":<?php echo esc_attr( get_theme_mod( 'conversions_hc_max', '5' ) ); ?>,"slidesToScroll":<?php echo esc_attr( get_theme_mod( 'conversions_hc_max', '5' ) ); ?>,"responsive":[{"breakpoint":992,"settings":{"slidesToShow":<?php echo esc_attr( $chc_items_to_show[0] ); ?>,"slidesToScroll":<?php echo esc_attr( $chc_items_to_show[0] ); ?>}},{"breakpoint":768,"settings":{"slidesToShow":<?php echo esc_attr( $chc_items_to_show[1] ); ?>,"slidesToScroll":<?php echo esc_attr( $chc_items_to_show[1] ); ?>}},{"breakpoint":576,"settings":{"slidesToShow":<?php echo esc_attr( $chc_items_to_show[2] ); ?>,"slidesToScroll":<?php echo esc_attr( $chc_items_to_show[2] ); ?>}}]}'>
  					
            <?php
              $chc_logos = get_theme_mod( 'conversions_hc_logos' );
              $chc_logos_decoded = json_decode( $chc_logos );
      
              if ( !empty( $chc_logos_decoded ) ) {
              
                $chc_count = 0;
              
                foreach( $chc_logos_decoded as $chc_logo ){
                  // Retrieve img id
                  $chc_url = $chc_logo->image_url;
                  $chc_logo_id = conversions()->template->conversions_id_by_url( $chc_url );
                  // Retrieve the correct img size
                  $chc_logo_med = wp_get_attachment_image_src( $chc_logo_id, 'medium' );
                  // Retrieve the alt text
                  $chc_logo_alt = get_post_meta( $chc_logo_id, '_wp_attachment_image_alt', true );

                  echo '<div class="c-clients__item px-3" id="c-clients__'.$chc_count.'">
                    <img class="client" src="'. esc_url( $chc_logo_med[0] ) .'" alt="'. esc_html( $chc_logo_alt ) .'">
                  </div>';

                  ++$chc_count;
                }
              }
            ?>
					</div>

				</div>
			</div>
		</div>
	</section>

	<!-- Features section -->
  <section class="c-features">
    <div class="container-fluid">
      <div class="row justify-content-sm-center">

        <?php if ( !empty( get_theme_mod( 'conversions_features_title') ) || !empty( get_theme_mod( 'conversions_features_desc' ) ) ) { ?>
          
          <div class="col-12">
            <div class="w-md-80 w-lg-60 text-center mb-5 mx-auto">
              <?php 
                if ( !empty( get_theme_mod( 'conversions_features_title' ) ) ) {
                  // Title
                  echo '<h2 class="h3">'.esc_html( get_theme_mod( 'conversions_features_title' ) ).'</h2>';
                }
                if ( !empty( get_theme_mod( 'conversions_features_desc' ) ) ) {
                  // Description
                  echo '<p class="subtitle">'.wp_kses_post( get_theme_mod( 'conversions_features_desc' ) ).'</p>';
                }
              ?>
            </div>
          </div>
        
        <?php } ?>

        <?php
          // Get all feature blocks
          $conversions_fb = get_theme_mod( 'conversions_features_icons' );
          $conversions_fb_decoded = json_decode( $conversions_fb );

          if ( !empty( $conversions_fb_decoded ) ) {
            foreach ( $conversions_fb_decoded as $repeater_item ) {

              // How many to show per row
              $conversions_features_sm = get_theme_mod( 'conversions_features_sm', '1' );
              $conversions_features_md = get_theme_mod( 'conversions_features_md', '2' );
              $conversions_features_lg = get_theme_mod( 'conversions_features_lg', '3' );

              // # per row to bootstrap grid
              $cfri = array(
                '1' => '12', 
                '2' => '6', 
                '3' => '4', 
                '4' => '3',
                '5' => '2',
              );
              ?>

              <!-- Feature block -->
              <div class="col-sm-<?php echo esc_attr( $cfri[$conversions_features_sm] ); ?> col-md-<?php echo esc_attr( $cfri[$conversions_features_md] ); ?> col-lg-<?php echo esc_attr( $cfri[$conversions_features_lg] ); ?> mb-3">
                <div class="card border-0 h-100 text-center">
                  <div class="card-body p-2">
                    
                    <?php 
                      if ( !empty( $repeater_item->icon_value ) ) {
                        if ( !empty( $repeater_item->color ) ) {
                          echo '<span class="c-features__icon"><i class="'.esc_attr( $repeater_item->icon_value ).' mb-3" aria-hidden="true" style="color:'.esc_attr( $repeater_item->color ).';"></i></span>';
                        }
                        else {
                          echo '<span class="c-features__icon"><i class="'.esc_attr( $repeater_item->icon_value ).' mb-3" aria-hidden="true"></i></span>';
                        }
                      }

                      if ( !empty( $repeater_item->title ) ) {
                        echo '<h3 class="h5">'.esc_html( $repeater_item->title ).'</h3>';
                      }

                      if ( !empty( $repeater_item->text ) ) {
                        echo '<p class="c-features__description">'.esc_html( $repeater_item->text ).'</p>';
                      }

                      if ( !empty( $repeater_item->linktext ) ) {
                        echo sprintf( '<a class="btn btn-link" href="%s">%s</a>', 
                          esc_url( $repeater_item->link ), 
                          esc_html( $repeater_item->linktext )
                        );
                      } 
                    ?>

                  </div>
                </div>
              </div>

            <?php }
          }
        ?>

      </div>
    </div>
  </section>


	<!-- Pricing section -->
	<section class="c-pricing">
		<div class="container-fluid">
			<div class="row justify-content-sm-center">

				<?php if ( !empty( get_theme_mod( 'conversions_pricing_title') ) || !empty( get_theme_mod( 'conversions_pricing_desc' ) ) ) { ?>
          
          <div class="col-12">
            <div class="w-md-80 w-lg-60 text-center mb-5 mx-auto">
              <?php 
                if ( !empty( get_theme_mod( 'conversions_pricing_title' ) ) ) {
                  // Title
                  echo '<h2 class="h3">'.esc_html( get_theme_mod( 'conversions_pricing_title' ) ).'</h2>';
                }
                if ( !empty( get_theme_mod( 'conversions_pricing_desc' ) ) ) {
                  // Description
                  echo '<p class="subtitle">'.wp_kses_post( get_theme_mod( 'conversions_pricing_desc' ) ).'</p>';
                }
              ?>
            </div>
          </div>
        
        <?php } ?>

        <?php
          // Get all pricing tables
          $conversions_pr = get_theme_mod( 'conversions_pricing_repeater' );
          $conversions_pr_decoded = json_decode( $conversions_pr );

          if ( !empty( $conversions_pr_decoded ) ) {
            foreach ( $conversions_pr_decoded as $repeater_item ) {

              // How many to show per row
              $conversions_pricing_row = get_theme_mod( 'conversions_pricing_row', '3' );

              // # per row to bootstrap grid
              $cpri = array(
                '1' => '12', 
                '2' => '6', 
                '3' => '4', 
                '4' => '3',
              );
              ?>

              <!-- Pricing table -->
              <div class="col-sm-12 col-lg-<?php echo esc_attr( $cpri[$conversions_pricing_row] ); ?> mb-3">
                <div class="card shadow">
                  <header class="card-header bg-white text-center p-4">
                    <h4 class="h5 text-secondary mb-3">
                      <?php 
                        // Plan title
                        echo esc_html( $repeater_item->title ); 
                      ?>
                    </h4>
                    <span class="d-block">
                      <span class="display-4">
                        <?php
                          // Plan price 
                          echo esc_html( $repeater_item->subtitle ); 
                        ?>
                      </span>
                      <span class="d-block text-secondary">
                        <?php 
                          // Plan duration
                          echo esc_html( $repeater_item->subtitle2 ); 
                        ?>
                      </span>
                    </span>
                  </header>
                  <div class="card-body pt-4 pb-5 px-5">
                    <ul class="list-unstyled mb-4">
                      <?php
                        // Get all plan features
                        $feature_repeater = json_decode( html_entity_decode( $repeater_item->feature_repeater ) );
                        if ( !empty( $feature_repeater ) ) {
                          foreach( $feature_repeater as $value ) {
                            // Output each feature
                            echo sprintf( '<li class="d-flex align-items-center py-2"><span class="fas fa-check mr-3"></span>%1$s</li>', 
                              esc_html( $value->feature )
                            );
                          }
                        } 
                      ?>
                    </ul>
                    <?php
                      // Plan button and link
                      echo sprintf( '<a href="%1$s" class="btn btn-block btn-primary">%2$s</a>', 
                        esc_url( $repeater_item->link ),
                        esc_html( $repeater_item->linktext )
                      );
                    ?>
                  </div>
                </div>
              </div>

            <?php }
          }
        ?>

			</div>
		</div>
	</section>


  <!-- Testimonial Section -->
  <section class="c-testimonials">
    <div class="container-fluid">
      <div class="row">

        <?php if ( !empty( get_theme_mod( 'conversions_testimonials_title') ) || !empty( get_theme_mod( 'conversions_testimonials_desc') ) ) { ?>
          <!-- Title -->
          <div class="col-12">
            <div class="w-md-80 w-lg-60 text-center mb-5 mx-auto">
              <?php 
                if ( !empty( get_theme_mod( 'conversions_testimonials_title') ) ) {
                  // Title
                  echo '<h2 class="h3">'.esc_html( get_theme_mod( 'conversions_testimonials_title' ) ).'</h2>';
                }
                if ( !empty( get_theme_mod( 'conversions_testimonials_desc' ) ) ) {
                  // Description
                  echo '<p class="subtitle">'.wp_kses_post( get_theme_mod( 'conversions_testimonials_desc' ) ).'</p>';
                }
              ?>
            </div>
          </div>
        <?php } ?>

        <!-- Testimonials -->
        <div class="col-12">
          <!-- Slick Carousel -->
          <div class="c-testimonials__carousel">

            <?php
              $conversions_testimonials = get_theme_mod( 'conversions_testimonials_repeater' );
              $conversions_testimonials_decoded = json_decode( $conversions_testimonials );
      
              if ( !empty( $conversions_testimonials_decoded ) ) {
              
                $testimonials_count = 0;
              
                foreach( $conversions_testimonials_decoded as $conversions_testimonial ){ ?>

                  <!-- Testimonial -->
                  <div class="c-testimonials__item" id="c-testimonials__<?php echo $testimonials_count; ?>">
                    <blockquote class="c-testimonials__quote shadow w-md-95 w-lg-90 mx-auto">
                      <p>
                        <?php echo esc_html( $conversions_testimonial->text ); ?>
                      </p>
                      <div class="d-flex flex-column flex-sm-row justify-content-sm-between">
                        <cite>

                          <?php if ( !empty( $conversions_testimonial->title ) ) { ?>
                            <span class="d-block">
                              <?php echo esc_html( $conversions_testimonial->title ); ?>
                            </span>
                          <?php } ?>

                          <?php if ( !empty( $conversions_testimonial->subtitle ) ) { ?>
                            <span class="d-block">
                              <?php echo esc_html( $conversions_testimonial->subtitle ); ?>
                            </span>
                          <?php } ?>

                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                          <i class="fas fa-star"></i>
                        </cite>
                        <div class="c-testimonials__nav align-self-end ml-sm-auto">
                          <i class="fas fa-chevron-left slick-arrow mr-2"></i>
                          <i class="fas fa-chevron-right slick-arrow"></i>
                        </div>
                      </div>
                    </blockquote>
                  </div>

                  <?php ++$testimonials_count;
                }
              }
            ?>
            
          </div> <!-- End Slick Carousel -->
        </div>
      </div>
    </div>
  </section>

	<!-- News Section -->
	<section class="c-news">
		<div class="container-fluid">
			<div class="row justify-content-sm-center">

        <?php if ( !empty( get_theme_mod( 'conversions_news_title') ) || !empty( get_theme_mod( 'conversions_news_desc' ) ) ) { ?>
          
          <!-- Title -->
          <div class="col-12">
				    <div class="w-md-80 w-lg-60 text-center mb-5 mx-auto">
              <?php 
                if ( !empty( get_theme_mod( 'conversions_news_title' ) ) ) {
                  // Title
                  echo '<h2 class="h3">'.esc_html( get_theme_mod( 'conversions_news_title' ) ).'</h2>';
                }
                if ( !empty( get_theme_mod( 'conversions_news_desc' ) ) ) {
                  // Description
                  echo '<p class="subtitle">'.wp_kses_post( get_theme_mod( 'conversions_news_desc' ) ).'</p>';
                }
              ?>
				    </div>
          </div>

        <?php } ?>

        <?php 
          // Get latest posts
          $args=array(
            'post_type' => 'post',
            'post_status' => 'publish',
            'posts_per_page' => 3,
            'orderby' => array( 'comment_count' => 'DESC'),
            'ignore_sticky_posts' => 1,
          );

          $recent_posts = new WP_Query( $args );
          while ($recent_posts -> have_posts()) : $recent_posts -> the_post(); 
        ?>

        <!-- Post item -->
        <div class="col-sm-12 col-lg-4 mb-3 c-news__card-wrapper">
          <article class="card shadow h-100">
            
            <!-- Post image -->
            <a class="c-news__img-link" href="<?php esc_url( the_permalink() ); ?>" title="<?php the_title(); ?>">
              <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'news-image', array( 'class' => 'card-img-top' ) ); ?>
              <?php else : ?>
                <img class="card-img-top" alt="<?php the_title(); ?>" src="<?php echo get_template_directory_uri(); ?>/placeholder.png" />
              <?php endif; ?>
            </a>
            <div class="card-body pb-1">
              <h3 class="h5">
                <a href="<?php esc_url( the_permalink() ); ?>">
                  <?php the_title(); ?>
                </a>
              </h3>
              <p class="text-muted">
                <?php
                  $related_content = strip_shortcodes( get_the_content() );
                  echo wp_trim_words( $related_content, 15, '...' ); 
                ?>
              </p>
            </div>
            <div class="card-footer text-muted d-flex justify-content-between align-items-center small">
              <?php conversions()->template->posted_on(); ?>
              <?php conversions()->template->reading_time(); ?>
            </div>
          </article>
        </div>
        <!-- End Post Item -->

        <?php 
          endwhile;
          wp_reset_postdata();
        ?>

      </div>
		</div>
	</section>

</div><!-- Wrapper end -->

<?php get_footer();