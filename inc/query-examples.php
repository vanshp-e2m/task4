<?php
/**
 * Query Examples for Projects
 *
 * @package Vansh_Projects
 */

/**
 * Example WP_Query for projects with specific taxonomy
 */
function vansh_projects_query_example() {
	$args = array(
		'post_type'      => 'project',
		'posts_per_page' => 10,
		'tax_query'      => array(
			array(
				'taxonomy' => 'project_type',
				'field'    => 'slug',
				'terms'    => 'web-design', // Change this to your actual term
			),
		),
	);

	$projects = new WP_Query( $args );

	if ( $projects->have_posts() ) {
		while ( $projects->have_posts() ) {
			$projects->the_post();
			// Display project content
			the_title( '<h2>', '</h2>' );
		}
		wp_reset_postdata();
	}
}

/**
 * Example WP_Query for projects with specific ACF field value
 */
function vansh_projects_meta_query_example() {
	$args = array(
		'post_type'      => 'project',
		'posts_per_page' => 10,
		'meta_query'     => array(
			array(
				'key'     => 'hero_section_hero_title', // ACF field name
				'value'   => 'welcome',
				'compare' => 'LIKE',
			),
		),
	);

	$projects = new WP_Query( $args );

	if ( $projects->have_posts() ) {
		while ( $projects->have_posts() ) {
			$projects->the_post();
			// Display project content
			the_title( '<h2>', '</h2>' );
		}
		wp_reset_postdata();
	}
}