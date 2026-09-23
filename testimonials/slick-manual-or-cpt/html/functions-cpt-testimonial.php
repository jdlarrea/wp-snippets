<?php
//Register new custom types here - Uncomment "add_action" call at bottom when ready
function acme_custom_post_type() {

	register_post_type(
		'testimonial',
		array(
			'menu_icon' => 'dashicons-admin-comments',
			'labels' => array(
				'name' => __('Testimonials', ''),
				'singular_name' => __('Testimonial', ''),
				'add_new' => __('Add New', ''),
				'add_new_item' => __('Add New Testimonial', ''),
				'edit' => __('Edit', ''),
				'edit_item' => __('Edit Testimonial', ''),
				'new_item' => __('New Testimonial', ''),
				'view' => __('View Testimonials', ''),
				'view_item' => __('View Testimonial', ''),
				'search_items' => __('Search Testimonials', ''),
				'not_found' => __('No Testimonials found', ''),
				'not_found_in_trash' => __('No Testimonials found in Trash', '')
			),
			'public' => true,
			'hierarchical' => false,
			'has_archive' => false,
			'supports' => array(
				'title',
			),
			'can_export' => true,
			'taxonomies' => array(
				//'post_tag',
				//'category'
			),
			'rewrite' => array(
				'with_front' => false,
				'slug' => 'testimonial'
			),
			'publicly_queryable' => true,
			'exclude_from_search' => true,
		)
	);
}
add_action('init', 'acme_custom_post_type');
