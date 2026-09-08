<?php
/**
 * Single Project.
 *
 * WordPress picks this automatically for post_type=project because of the
 * template hierarchy: single-{post_type}.php beats single.php.
 *
 * @package Vansh_Projects
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php
	while ( have_posts() ) :
		the_post();
		?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

				<?php
				$vansh_terms = get_the_term_list( get_the_ID(), 'project_type', '<p class="project-types">Type: ', ', ', '</p>' );
				if ( ! is_wp_error( $vansh_terms ) && $vansh_terms ) {
					echo wp_kses_post( $vansh_terms );
				}
				?>
			</header>

			<div class="entry-content">
				<?php
				// The Flexible Content sections.
				get_template_part( 'template-parts/sections/loop' );

				// Anything typed into the normal editor, after the sections.
				the_content();
				?>
			</div>

		</article>

		<?php
	endwhile;
	?>

</main><!-- #main -->

<?php
get_footer();
