<?php
/**
 * Template Name: Page with Sections
 *
 * @package Vansh_Projects
 */

get_header(); ?>

<main id="primary" class="site-main">
	<?php
	while ( have_posts() ) :
		the_post();

		if ( have_rows( 'page_sections' ) ) :

			// Shared with single-project.php - one loop, one place to fix.
			get_template_part( 'template-parts/sections/loop' );

		else :

			echo '<p>No page sections found.</p>';

		endif;

	endwhile; // End of the loop.
	?>
</main><!-- #main -->

<?php
get_footer();