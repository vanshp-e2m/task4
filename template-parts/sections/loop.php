<?php
/**
 * The Flexible Content loop.
 *
 * TASK 8. One template part per layout, pulled from template-parts/sections/.
 * Kept in its own file so the page template and single-project.php share it
 * instead of duplicating the loop.
 *
 * @package Vansh_Projects
 */

if ( ! have_rows( 'page_sections' ) ) {
	return;
}

while ( have_rows( 'page_sections' ) ) :
	the_row();

	// Layout names use underscores (two_column); filenames use hyphens
	// (two-column.php). Convert rather than maintaining a switch.
	$vansh_layout = get_row_layout();
	$vansh_slug   = str_replace( '_', '-', $vansh_layout );

	/**
	 * get_template_part() is safe inside the loop: the_row() sets ACF's
	 * global row context, so get_sub_field() works inside the included file.
	 */
	if ( locate_template( 'template-parts/sections/' . $vansh_slug . '.php' ) ) {
		get_template_part( 'template-parts/sections/' . $vansh_slug );
	} elseif ( current_user_can( 'manage_options' ) ) {
		printf(
			'<p style="padding:1em;background:#fee;border:1px solid #c00;">Missing template part for layout: <code>%s</code> (expected <code>template-parts/sections/%s.php</code>)</p>',
			esc_html( $vansh_layout ),
			esc_html( $vansh_slug )
		);
	}

endwhile;
