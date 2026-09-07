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

		// Check if the flexible content field has rows of data
		if ( have_rows( 'page_sections' ) ) :

			// Loop through the rows
			while ( have_rows( 'page_sections' ) ) : the_row();

				// Get the layout name
				$layout = get_row_layout();

				// Load the appropriate template part based on layout
				switch ( $layout ) {
					case 'hero':
						get_template_part( 'template-parts/sections/hero' );
						break;
					case 'text_block':
						get_template_part( 'template-parts/sections/text-block' );
						break;
					case 'gallery':
						get_template_part( 'template-parts/sections/gallery' );
						break;
					case 'cta':
						get_template_part( 'template-parts/sections/cta' );
						break;
					case 'stats':
						get_template_part( 'template-parts/sections/stats' );
						break;
					case 'two_column':
						get_template_part( 'template-parts/sections/two-column' );
						break;
				}

			endwhile;

		else :

			// No layouts found
			echo '<p>No page sections found.</p>';

		endif;

	endwhile; // End of the loop.
	?>
</main><!-- #main -->

<?php
get_footer();