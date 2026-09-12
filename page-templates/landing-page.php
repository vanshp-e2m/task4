<?php
/**
 * Template Name: Landing Page
 * Description: Full-width landing page with flexible sections
 *
 * @package Vansh_Projects
 */

get_header(); ?>

<main id="primary" class="site-main landing-page">
	<?php
	while ( have_posts() ) :
		the_post();

		// Loop through flexible content sections
		if ( have_rows( 'landing_sections' ) ) :
			while ( have_rows( 'landing_sections' ) ) :
				the_row();

				$layout = get_row_layout();

				// Load template part for each layout
				if ( locate_template( "template-parts/landing-page/{$layout}.php" ) ) {
					get_template_part( "template-parts/landing-page/{$layout}" );
				}

			endwhile;
		endif;

	endwhile; // End of the loop.
	?>
</main><!-- #primary -->

<?php
get_footer();
