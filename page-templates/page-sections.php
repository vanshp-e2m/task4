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

		// Render each section using template parts
		get_template_part( 'template-parts/sections/hero' );
		get_template_part( 'template-parts/sections/text-block' );
		get_template_part( 'template-parts/sections/gallery' );
		get_template_part( 'template-parts/sections/cta' );
		get_template_part( 'template-parts/sections/stats' );
		get_template_part( 'template-parts/sections/two-column' );

	endwhile; // End of the loop.
	?>
</main><!-- #main -->

<?php
get_footer();