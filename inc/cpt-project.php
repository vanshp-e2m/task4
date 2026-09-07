<?php
/**
 * Project CPT and Project Type Taxonomy
 *
 * @package Vansh_Projects
 */

/**
 * Register Project CPT
 */
function vansh_projects_register_cpt() {
	$labels = array(
		'name'                  => _x( 'Projects', 'Post type general name', 'vansh-projects' ),
		'singular_name'         => _x( 'Project', 'Post type singular name', 'vansh-projects' ),
		'menu_name'             => _x( 'Projects', 'Admin Menu text', 'vansh-projects' ),
		'name_admin_bar'        => _x( 'Project', 'Add New on Toolbar', 'vansh-projects' ),
		'add_new'               => __( 'Add New', 'vansh-projects' ),
		'add_new_item'          => __( 'Add New Project', 'vansh-projects' ),
		'new_item'              => __( 'New Project', 'vansh-projects' ),
		'edit_item'             => __( 'Edit Project', 'vansh-projects' ),
		'view_item'             => __( 'View Project', 'vansh-projects' ),
		'all_items'             => __( 'All Projects', 'vansh-projects' ),
		'search_items'          => __( 'Search Projects', 'vansh-projects' ),
		'parent_item_colon'     => __( 'Parent Projects:', 'vansh-projects' ),
		'not_found'             => __( 'No projects found.', 'vansh-projects' ),
		'not_found_in_trash'    => __( 'No projects found in Trash.', 'vansh-projects' ),
		'featured_image'        => _x( 'Project Cover Image', 'Overrides the "Featured Image" phrase', 'vansh-projects' ),
		'set_featured_image'    => _x( 'Set cover image', 'Overrides the "Set featured image" phrase', 'vansh-projects' ),
		'remove_featured_image' => _x( 'Remove cover image', 'Overrides the "Remove featured image" phrase', 'vansh-projects' ),
		'use_featured_image'    => _x( 'Use as cover image', 'Overrides the "Use as featured image" phrase', 'vansh-projects' ),
		'archives'              => _x( 'Project archives', 'The post type archive label', 'vansh-projects' ),
		'insert_into_item'      => _x( 'Insert into project', 'Overrides the "Insert into post" phrase', 'vansh-projects' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this project', 'Overrides the "Uploaded to this post" phrase', 'vansh-projects' ),
		'filter_items_list'     => _x( 'Filter projects list', 'Screen reader text for the filter links', 'vansh-projects' ),
		'items_list_navigation' => _x( 'Projects list navigation', 'Screen reader text for the pagination', 'vansh-projects' ),
		'items_list'            => _x( 'Projects list', 'Screen reader text for the items list', 'vansh-projects' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'project' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-portfolio',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'project', $args );
}
add_action( 'init', 'vansh_projects_register_cpt' );

/**
 * Register Project Type Taxonomy
 */
function vansh_projects_register_taxonomy() {
	$labels = array(
		'name'              => _x( 'Project Types', 'taxonomy general name', 'vansh-projects' ),
		'singular_name'     => _x( 'Project Type', 'taxonomy singular name', 'vansh-projects' ),
		'search_items'      => __( 'Search Project Types', 'vansh-projects' ),
		'all_items'         => __( 'All Project Types', 'vansh-projects' ),
		'parent_item'       => __( 'Parent Project Type', 'vansh-projects' ),
		'parent_item_colon' => __( 'Parent Project Type:', 'vansh-projects' ),
		'edit_item'         => __( 'Edit Project Type', 'vansh-projects' ),
		'view_item'         => __( 'View Project Type', 'vansh-projects' ),
		'update_item'       => __( 'Update Project Type', 'vansh-projects' ),
		'add_new_item'      => __( 'Add New Project Type', 'vansh-projects' ),
		'new_item_name'     => __( 'New Project Type Name', 'vansh-projects' ),
		'menu_name'         => __( 'Project Type', 'vansh-projects' ),
	);

	$args = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'project-type' ),
		'show_in_rest'      => true,
	);

	register_taxonomy( 'project_type', array( 'project' ), $args );
}
add_action( 'init', 'vansh_projects_register_taxonomy' );

