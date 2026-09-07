<?php
/**
 * Programmatic Population Function
 *
 * @package Vansh_Projects
 */

/**
 * Create a page and populate its ACF Flexible Content fields programmatically
 */
function vansh_projects_create_programmatic_project() {
	// Create a page post (since flexible content is assigned to pages)
	$post_data = array(
		'post_title'    => 'AI Generated Page',
		'post_content'  => 'This page was created programmatically with flexible content.',
		'post_status'   => 'publish',
		'post_type'     => 'page',
	);

	$post_id = wp_insert_post( $post_data );

	if ( ! is_wp_error( $post_id ) ) {
		// Populate ACF Flexible Content field with 3 layouts
		$flexible_content = array(
			// Layout 1: Hero
			array(
				'acf_fc_layout' => 'hero',
				'hero_title'    => 'Welcome to Our Page',
				'hero_subtitle' => 'An amazing page built with modern technology',
				'hero_background' => 0, // Set to image ID if available
			),
			// Layout 2: Text Block
			array(
				'acf_fc_layout' => 'text_block',
				'text_heading' => 'About This Page',
				'text_content' => 'This is a comprehensive page that showcases our capabilities in web development and design.',
			),
			// Layout 3: CTA
			array(
				'acf_fc_layout' => 'cta',
				'cta_title'       => 'Get Started Today',
				'cta_description' => 'Ready to begin your journey? Contact us now.',
				'cta_button_text' => 'Contact Us',
				'cta_button_link' => 'https://example.com/contact',
			),
		);

		// Update the flexible content field
		update_field( 'page_sections', $flexible_content, $post_id );

		// Apply the page template
		update_post_meta( $post_id, '_wp_page_template', 'page-templates/page-sections.php' );

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
 * Admin action to create test page
 * Visit: /wp-admin/?create_test_page=1
 */
add_action( 'admin_init', 'vansh_projects_create_test_page' );
function vansh_projects_create_test_page() {
	if ( isset( $_GET['create_test_page'] ) && current_user_can( 'manage_options' ) ) {
		$page_id = vansh_projects_create_programmatic_project();
		if ( $page_id ) {
			wp_redirect( admin_url( 'post.php?post=' . $page_id . '&action=edit' ) );
			exit;
		}
	}
}