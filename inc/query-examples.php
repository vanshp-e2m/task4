<?php
/**
 * WP_Query examples for Projects.
 *
 * TASK 6. These are exposed as shortcodes so they actually RUN on a front-end
 * request - a function that is only ever defined generates no SQL, and so
 * shows up nowhere in Query Monitor.
 *
 * Drop [vansh_projects_by_type] or [vansh_projects_with_hero] on any page,
 * then open Query Monitor -> Queries and filter by the wp_posts table.
 *
 * @package Vansh_Projects
 */

/**
 * Shared renderer so both shortcodes stay short.
 *
 * @param WP_Query $query   The query to render.
 * @param string   $heading Heading shown above the list.
 * @return string
 */
function vansh_projects_render_results( WP_Query $query, $heading ) {

	ob_start();

	echo '<div class="project-query-results">';
	echo '<h2>' . esc_html( $heading ) . '</h2>';

	if ( $query->have_posts() ) {

		echo '<p><em>' . esc_html( sprintf( '%d project(s) found.', $query->found_posts ) ) . '</em></p>';
		echo '<ul>';

		while ( $query->have_posts() ) {
			$query->the_post();
			printf(
				'<li><a href="%s">%s</a></li>',
				esc_url( get_permalink() ),
				esc_html( get_the_title() )
			);
		}

		echo '</ul>';

		// Always reset - the loop above overwrote the global $post.
		wp_reset_postdata();

	} else {
		echo '<p>No projects matched.</p>';
	}

	echo '</div>';

	return ob_get_clean();
}

/**
 * TAX_QUERY - projects in a given project_type term.
 *
 * Usage: [vansh_projects_by_type type="web-design"]
 *
 * In SQL this becomes an INNER JOIN across wp_term_relationships and
 * wp_term_taxonomy, filtered on term_taxonomy_id.
 */
function vansh_projects_by_type_shortcode( $atts ) {

	$atts = shortcode_atts(
		array(
			'type'  => 'web-design',
			'limit' => 10,
		),
		$atts,
		'vansh_projects_by_type'
	);

	$query = new WP_Query(
		array(
			'post_type'      => 'project',
			'post_status'    => 'publish',
			'posts_per_page' => (int) $atts['limit'],
			'tax_query'      => array(
				array(
					'taxonomy' => 'project_type',
					'field'    => 'slug',
					'terms'    => sanitize_title( $atts['type'] ),
				),
			),
		)
	);

	return vansh_projects_render_results(
		$query,
		sprintf( 'Projects of type: %s', $atts['type'] )
	);
}
add_shortcode( 'vansh_projects_by_type', 'vansh_projects_by_type_shortcode' );

/**
 * META_QUERY - projects whose page_sections contains a hero layout.
 *
 * Usage: [vansh_projects_with_hero layout="hero"]
 *
 * Why this key works: the PARENT row of a Flexible Content field stores a
 * serialised array of the layout names in order, e.g.
 *
 *   meta_key   = page_sections
 *   meta_value = a:3:{i:0;s:4:"hero";i:1;s:10:"text_block";i:2;s:5:"stats";}
 *
 * so a LIKE against that one row tells us which layouts a post uses without
 * touching the individual sub-field rows. In SQL this is an INNER JOIN on
 * wp_postmeta with a LIKE in the WHERE clause.
 */
function vansh_projects_with_hero_shortcode( $atts ) {

	$atts = shortcode_atts(
		array(
			'layout' => 'hero',
			'limit'  => 10,
		),
		$atts,
		'vansh_projects_with_hero'
	);

	$query = new WP_Query(
		array(
			'post_type'      => 'project',
			'post_status'    => 'publish',
			'posts_per_page' => (int) $atts['limit'],
			'meta_query'     => array(
				array(
					'key'     => 'page_sections',
					// Match the serialised string fragment: s:4:"hero"
					'value'   => sprintf( 's:%d:"%s"', strlen( $atts['layout'] ), $atts['layout'] ),
					'compare' => 'LIKE',
				),
			),
		)
	);

	return vansh_projects_render_results(
		$query,
		sprintf( 'Projects containing a "%s" section', $atts['layout'] )
	);
}
add_shortcode( 'vansh_projects_with_hero', 'vansh_projects_with_hero_shortcode' );
