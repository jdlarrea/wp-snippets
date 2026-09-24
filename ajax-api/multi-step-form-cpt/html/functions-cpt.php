<?php
// ****************************************
// Functions - CPTs - Create
function acme_custom_post_type() {
	register_post_type(
		'assessment',
		array(
			'menu_icon' => 'dashicons-media-document',
			'labels' => array(
				'name' => __('Assessments', ''),
				'singular_name' => __('Assessment', ''),
				'add_new' => __('Add New', ''),
				'add_new_item' => __('Add New Assessment', ''),
				'edit' => __('Edit', ''),
				'edit_item' => __('Edit Assessment', ''),
				'new_item' => __('New Assessment', ''),
				'view' => __('View Assessments', ''),
				'view_item' => __('View Assessment', ''),
				'search_items' => __('Search Assessments', ''),
				'not_found' => __('No Assessments found', ''),
				'not_found_in_trash' => __('No Assessments found in Trash', '')
			),
			'show_ui' => true,
			'public' => false,
			'publicly_queryable' => false,
			'can_export' => true,
			'hierarchical' => false,
			'has_archive' => false,
			'supports' => array(
				'title',
				// 'editor',
				// 'excerpt',
				// 'thumbnail'
			),
			'taxonomies' => array(
				// 'post_tag',
				// 'category'
			),
			'rewrite' => array(
				'with_front' => false,
				'slug' => '/assessments'
			),
		)
	);
}
add_action('init', 'acme_custom_post_type');


// ****************************************
// Functions - CPTs - Modify sorting columns


// Sort by ACF field - last_step
function custom_assessment_column_headers($columns) {
	$columns['last_step'] = 'Last Step';
	return $columns;
}
add_filter('manage_assessment_posts_columns', 'custom_assessment_column_headers');

function custom_assessment_column_values($column, $post_id) {
	if ($column === 'last_step') {
		$last_step = get_field('last_step', $post_id);

		echo $last_step;
	}
}
add_action('manage_assessment_posts_custom_column', 'custom_assessment_column_values', 10, 2);

function custom_assessment_column_sortable($columns) {
	$columns['last_step'] = 'last_step';
	return $columns;
}
add_filter('manage_edit-assessment_sortable_columns', 'custom_assessment_column_sortable');

function custom_assessment_column_sorting($query) {
	if (!is_admin() || !$query->is_main_query()) {
		return;
	}

	$orderby = $query->get('orderby');

	if ($orderby === 'last_step') {
		$query->set('meta_key', 'last_step');
		$query->set('orderby', 'meta_value_num');
	}
}
add_action('pre_get_posts', 'custom_assessment_column_sorting');


// Add the dropdown filter to the admin list page
function custom_cpt_dropdown_filter() {
    global $typenow;
    
    if ($typenow == 'assessment') {
        $last_step_values = array(1, 2, 3, 4, 5, 6); // Replace with your desired dropdown values
        
        // Output the dropdown HTML
        ?>
        <select name="filter_last_step">
            <option value="">Filter by Last Step</option>
            <?php
            foreach ($last_step_values as $value) {
                $selected = (isset($_GET['filter_last_step']) && $_GET['filter_last_step'] == $value) ? 'selected' : '';
                echo "<option value='$value' $selected>$value</option>";
            }
            ?>
        </select>
        <?php
    }
}
add_action('restrict_manage_posts', 'custom_cpt_dropdown_filter');

// Filter the query based on the dropdown selection
function custom_filter_last_step($query) {
    global $pagenow;
    
    if (is_admin() && $pagenow == 'edit.php' && isset($_GET['filter_last_step']) && $_GET['filter_last_step'] != '') {
        $meta_key = 'last_step'; // Replace with the ACF field name 'last_step'
        $meta_value = $_GET['filter_last_step'];
        
        $query->query_vars['meta_key'] = $meta_key;
        $query->query_vars['meta_value'] = $meta_value;
    }
    return $query;
}
add_filter('parse_query', 'custom_filter_last_step');
