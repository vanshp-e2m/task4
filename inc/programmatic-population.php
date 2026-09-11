<?php
/**
 * Programmatic population of a Project + its Flexible Content field.
 *
 * TASK 7. This is the muscle reused for AI-driven flows: if you cannot build
 * a page from code, you cannot debug a page a machine built.
 *
 * @package Vansh_Projects
 */

/**
 * Create a `project` post and fill page_sections with 3 layouts.
 *
 * @param array $overrides Optional. title / project_type / image_id.
 * @return int|WP_Error Post ID on success.
 */
function vansh_projects_create_project( $overrides = array() ) {

	$args = wp_parse_args(
		$overrides,
		array(
			'title'        => 'Programmatically Created Project',
			'project_type' => 'web-design',
			'image_id'     => 0,
		)
	);

	// 1. Create the post itself.
	$post_id = wp_insert_post(
		array(
			'post_title'   => $args['title'],
			'post_content' => '',
			'post_status'  => 'publish',
			'post_type'    => 'project',
		),
		true // Return WP_Error instead of 0 on failure.
	);

	if ( is_wp_error( $post_id ) ) {
		return $post_id;
	}

	// 2. Assign the taxonomy term, creating it if it does not exist yet.
	if ( ! empty( $args['project_type'] ) ) {
		wp_set_object_terms( $post_id, $args['project_type'], 'project_type', false );
	}

	// 3. Build the Flexible Content value.
	//
	// Each row is an array whose 'acf_fc_layout' key names the layout. The
	// remaining keys are the layout's sub_field NAMES exactly as defined in
	// acf-json/group_page_sections.json. A repeater sub_field is just an
	// array of rows, nested the same way.
	$sections = array(

		// --- Layout 1: hero ---
		array(	
			'acf_fc_layout'   => 'hero',
			'hero_title'      => 'Built Entirely From Code',
			'hero_subtitle'   => 'This project post and every section below were created by a PHP function, not by a human clicking in wp-admin.',
			'hero_background' => $args['image_id'], // Attachment ID, or 0 for none.
		),

		// --- Layout 2: text_block ---
		array(
			'acf_fc_layout' => 'text_block',
			'text_heading'  => 'Why This Matters',
			'text_content'  => '<p>Anything an editor can assemble in the admin can be assembled in code, because both write the same rows to <code>wp_postmeta</code>.</p>',
		),

		// --- Layout 3: stats (contains a REPEATER) ---
		array(
			'acf_fc_layout' => 'stats',
			'stats_items'   => array(
				array(
					'stat_name'  => 'Layouts available',
					'stat_value' => '6',
				),
				array(
					'stat_name'  => 'Sections created here',
					'stat_value' => '3',
				),
				array(
					'stat_name'  => 'Clicks required',
					'stat_value' => '0',
				),
			),
		),
	);

	// 4. Write it.
	//
	// Use the field KEY, not the name. ACF resolves a name by looking at which
	// field groups apply to this post; on a freshly created post that lookup is
	// unreliable, and a failed lookup writes the raw array to postmeta with no
	// _fieldkey reference rows - which then renders as nothing in the admin.
	// The key never has to be resolved.
	update_field( 'field_page_sections', $sections, $post_id );

	return $post_id;
}

/**
 * Admin-only trigger: /wp-admin/?vansh_create_project=1
 *
 * Guarded by a capability check AND a nonce, because this changes state.
 */
function vansh_projects_maybe_create_project() {

	if ( ! isset( $_GET['vansh_create_project'] ) ) {
		return;
	}

	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'You are not allowed to do this.', 'vansh-projects' ) );
	}

	check_admin_referer( 'vansh_create_project' );

	$post_id = vansh_projects_create_project();

	if ( is_wp_error( $post_id ) ) {
		wp_die( esc_html( $post_id->get_error_message() ) );
	}

	wp_safe_redirect( admin_url( 'post.php?post=' . $post_id . '&action=edit' ) );
	exit;
}
add_action( 'admin_init', 'vansh_projects_maybe_create_project' );

/**
 * Put a button on the Projects list table so the trigger is discoverable
 * and the nonce is generated for us.
 */
function vansh_projects_create_button() {
	$screen = get_current_screen();

	if ( ! $screen || 'edit-project' !== $screen->id ) {
		return;
	}

	$url = wp_nonce_url(
		admin_url( '?vansh_create_project=1' ),
		'vansh_create_project'
	);

	printf(
		'<div class="notice notice-info"><p><a href="%s" class="button button-primary">%s</a></p></div>',
		esc_url( $url ),
		esc_html__( 'Create a project programmatically (Task 7)', 'vansh-projects' )
	);
}
add_action( 'admin_notices', 'vansh_projects_create_button' );
