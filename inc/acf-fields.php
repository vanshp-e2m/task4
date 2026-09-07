<?php
/**
 * ACF Fields for Page Sections
 *
 * @package Vansh_Projects
 */

/**
 * Register Page Sections Field Group
 */
function vansh_projects_register_acf_fields() {
	acf_add_local_field_group( array(
			'key'                   => 'group_page_sections',
			'title'                 => 'Page Sections',
			'fields'                => array(
				// Hero Section
				array(
					'key'          => 'field_hero_section',
					'label'        => 'Hero Section',
					'name'         => 'hero_section',
					'type'         => 'group',
					'instructions' => 'Hero section with title, subtitle and background image',
					'sub_fields'   => array(
						array(
							'key'           => 'field_hero_title',
							'label'         => 'Title',
							'name'          => 'hero_title',
							'type'          => 'text',
							'required'      => 1,
						),
						array(
							'key'           => 'field_hero_subtitle',
							'label'         => 'Subtitle',
							'name'          => 'hero_subtitle',
							'type'          => 'textarea',
							'required'      => 0,
						),
						array(
							'key'           => 'field_hero_background',
							'label'         => 'Background Image',
							'name'          => 'hero_background',
							'type'          => 'image',
							'required'      => 0,
							'return_format' => 'url',
						),
					),
				),
				// Text Block
				array(
					'key'          => 'field_text_block',
					'label'        => 'Text Block',
					'name'         => 'text_block',
					'type'         => 'group',
					'instructions' => 'Text content block with heading and content',
					'sub_fields'   => array(
						array(
							'key'           => 'field_text_heading',
							'label'         => 'Heading',
							'name'          => 'text_heading',
							'type'          => 'text',
							'required'      => 1,
						),
						array(
							'key'           => 'field_text_content',
							'label'         => 'Content',
							'name'          => 'text_content',
							'type'          => 'wysiwyg',
							'required'      => 0,
							'toolbar'       => 'basic',
						),
					),
				),
				// Gallery - Repeater with images
				array(
					'key'          => 'field_gallery',
					'label'        => 'Gallery',
					'name'         => 'gallery',
					'type'         => 'repeater',
					'instructions' => 'Gallery section with multiple images',
					'required'     => 0,
					'layout'       => 'table',
					'button_label' => 'Add Image',
					'sub_fields'   => array(
						array(
							'key'           => 'field_gallery_image',
							'label'         => 'Image',
							'name'          => 'gallery_image',
							'type'          => 'image',
							'required'      => 1,
							'return_format' => 'url',
						),
						array(
							'key'           => 'field_gallery_caption',
							'label'         => 'Caption',
							'name'          => 'gallery_caption',
							'type'          => 'text',
							'required'      => 0,
						),
					),
				),
				// CTA Section
				array(
					'key'          => 'field_cta_section',
					'label'        => 'CTA Section',
					'name'         => 'cta_section',
					'type'         => 'group',
					'instructions' => 'Call to action section',
					'sub_fields'   => array(
						array(
							'key'           => 'field_cta_title',
							'label'         => 'Title',
							'name'          => 'cta_title',
							'type'          => 'text',
							'required'      => 1,
						),
						array(
							'key'           => 'field_cta_description',
							'label'         => 'Description',
							'name'          => 'cta_description',
							'type'          => 'textarea',
							'required'      => 0,
						),
						array(
							'key'           => 'field_cta_button_text',
							'label'         => 'Button Text',
							'name'          => 'cta_button_text',
							'type'          => 'text',
							'required'      => 1,
						),
						array(
							'key'           => 'field_cta_button_link',
							'label'         => 'Button Link',
							'name'          => 'cta_button_link',
							'type'          => 'url',
							'required'      => 1,
						),
					),
				),
				// Stats - Repeater with name and value
				array(
					'key'          => 'field_stats',
					'label'        => 'Statistics',
					'name'         => 'stats',
					'type'         => 'repeater',
					'instructions' => 'Statistics section with name and value',
					'required'     => 0,
					'layout'       => 'table',
					'button_label' => 'Add Stat',
					'sub_fields'   => array(
						array(
							'key'           => 'field_stat_name',
							'label'         => 'Stat Name',
							'name'          => 'stat_name',
							'type'          => 'text',
							'required'      => 1,
						),
						array(
							'key'           => 'field_stat_value',
							'label'         => 'Stat Value',
							'name'          => 'stat_value',
							'type'          => 'text',
							'required'      => 1,
						),
					),
				),
				// Two Column Section
				array(
					'key'          => 'field_two_column',
					'label'        => 'Two Column Section',
					'name'         => 'two_column',
					'type'         => 'group',
					'instructions' => 'Two column content section',
					'sub_fields'   => array(
						array(
							'key'           => 'field_column_left',
							'label'         => 'Left Column',
							'name'          => 'column_left',
							'type'          => 'wysiwyg',
							'required'      => 0,
							'toolbar'       => 'basic',
						),
						array(
							'key'           => 'field_column_right',
							'label'         => 'Right Column',
							'name'          => 'column_right',
							'type'          => 'wysiwyg',
							'required'      => 0,
							'toolbar'       => 'basic',
						),
					),
				),
			),
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'page',
					),
				),
			),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen'        => array(),
			'active'                => true,
			'description'           => 'Page sections with hero, text, gallery, CTA, stats, and two-column layouts',
			'show_in_rest'          => true,
		) );
}
add_action( 'acf/init', 'vansh_projects_register_acf_fields' );