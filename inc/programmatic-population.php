<?php
/**
 * Programmatic Population Function
 *
 * @package Vansh_Projects
 */

/**
 * Create a project post and populate its ACF fields programmatically
 */
function vansh_projects_create_programmatic_project() {
	// Create the project post
	$post_data = array(
		'post_title'    => 'AI Generated Project',
		'post_content'  => 'This project was created programmatically.',
		'post_status'   => 'publish',
		'post_type'     => 'project',
	);

	$post_id = wp_insert_post( $post_data );

	if ( ! is_wp_error( $post_id ) ) {
		// Populate ACF fields with 3 layouts
		$acf_data = array(
			// Layout 1: Hero Section
			'hero_section' => array(
				'hero_title'       => 'Welcome to Our Project',
				'hero_subtitle'    => 'An amazing project built with modern technology',
				'hero_background'  => 0, // Set to image ID if available
			),
			// Layout 2: Text Block
			'text_block' => array(
				'text_heading' => 'About This Project',
				'text_content' => 'This is a comprehensive project that showcases our capabilities in web development and design.',
			),
			// Layout 3: CTA Section
			'cta_section' => array(
				'cta_title'         => 'Get Started Today',
				'cta_description'   => 'Ready to begin your journey? Contact us now.',
				'cta_button_text'   => 'Contact Us',
				'cta_button_link'   => 'https://example.com/contact',
			),
		);

		// Update each ACF field
		foreach ( $acf_data as $field_key => $field_value ) {
			update_field( $field_key, $field_value, $post_id );
		}

		// Assign taxonomy term
		wp_set_object_terms( $post_id, 'web-design', 'project_type', true );

		return $post_id;
	}

	return false;
}

/**
 * Execute the programmatic creation (call this function when needed)
 */
// Uncomment the line below to run this function
// $created_project_id = vansh_projects_create_programmatic_project();

/**
 * Admin action to create test project
 * Visit: /wp-admin/?create_test_project=1
 */
add_action( 'admin_init', 'vansh_projects_create_test_project' );
function vansh_projects_create_test_project() {
	if ( isset( $_GET['create_test_project'] ) && current_user_can( 'manage_options' ) ) {
		$project_id = vansh_projects_create_programmatic_project();
		if ( $project_id ) {
			wp_redirect( admin_url( 'post.php?post=' . $project_id . '&action=edit' ) );
			exit;
		}
	}
}