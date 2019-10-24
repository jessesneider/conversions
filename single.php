<?php
/**
 * The default template for displaying single posts.
 *
 * @package conversions
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="wrapper" id="single-wrapper">

	<div class="container-fluid" id="content" tabindex="-1">

		<div class="row">

			<?php 
				if ( has_post_thumbnail( get_the_ID() ) ) {
					
					// Inline featured image styles
					conversions()->template->fullscreen_featured_image();
					
					// HTML for background image and title
    				echo '<div class="col-sm-12"><div class="conversions-hero-cover"><div class="conversions-hero-cover__inner-container"><h1 class="entry-title text-center">'.esc_html( get_the_title() ).'</h1></div></div></div>';
				} 
			?>

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'partials/left-sidebar-check' ); ?>

			<main class="site-main" id="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'partials/content', 'single' ); ?>

					<?php conversions()->template->post_nav(); ?>

					<?php conversions()->template->related_posts(); ?>

					<?php
					// If comments are open or we have at least one comment, load comments.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					?>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->

		<!-- Do the right sidebar check -->
		<?php get_template_part( 'partials/right-sidebar-check' ); ?>

	</div><!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer();