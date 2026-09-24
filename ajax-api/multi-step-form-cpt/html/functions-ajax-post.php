<?php
// **************************************************
// Step 1 - Create Post (200, 201)
function create_post_1() {
	if (isset($_POST['action']) && $_POST['action'] === 'create_assessment_1') {
		// Pull Fields
		$last_step = sanitize_text_field($_POST['last_step']);
		$post_id = sanitize_text_field($_POST['post_id']);

		$first_name = sanitize_text_field($_POST['first_name']);
		$last_name = sanitize_text_field($_POST['last_name']);
		$email = sanitize_text_field($_POST['email']);

		// Modify Fields
		$title = $first_name . ' ' . $last_name;

		// Create post if no post_id
		if ($post_id < 1 || !is_numeric($post_id) || $post_id == '') {
			$post_id = wp_insert_post(array(
				'post_title'   => $title,
				'post_status'  => 'publish',
				'post_type'    => 'assessment'
			));

			// Update post acf fields
			if (!is_wp_error($post_id)) {
				update_field('last_step', $last_step, $post_id);
				update_field('first_name', $first_name, $post_id);
				update_field('last_name', $last_name, $post_id);
				update_field('email', $email, $post_id);

				// Success
				wp_send_json_success([
					'status' => 200,
					'post_id' => $post_id,
				]);
			}
		}
		else {
			update_field('last_step', $last_step, $post_id);
			update_field('first_name', $first_name, $post_id);
			update_field('last_name', $last_name, $post_id);
			update_field('email', $email, $post_id);

			// Success
			wp_send_json_success([
				'status' => 201,
				'post_id' => $post_id,
			]);
		}
	}

	wp_send_json_error([
		'status' => 500,
		'message' => 'Error Creating Post'
	]);
}
add_action('wp_ajax_create_assessment_1', 'create_post_1');
add_action('wp_ajax_nopriv_create_assessment_1', 'create_post_1');


// **************************************************
// Step 2 - Modify Post (201)
function modify_post_2() {
	if (isset($_POST['action']) && $_POST['action'] === 'modify_assessment_2') {
		// Pull Fields
		$last_step = sanitize_text_field($_POST['last_step']);
		$post_id = sanitize_text_field($_POST['post_id']);

		// Update post acf fields
		if ($post_id < 1 || !is_numeric($post_id) || $post_id == '') {
			wp_send_json_error([
				'status' => 500,
				'message' => 'Invalid post ID: ' . $post_id
			]);
		}
		else {
			update_field('last_step', $last_step, $post_id);

			// Success
			wp_send_json_success([
				'status' => 201,
				'post_id' => $post_id,
			]);
		}
	}
}
add_action('wp_ajax_modify_assessment_2', 'modify_post_2');
add_action('wp_ajax_nopriv_modify_assessment_2', 'modify_post_2');


// **************************************************
// Step 3 - Modify Post (201)
function modify_post_3() {
	if (isset($_POST['action']) && $_POST['action'] === 'modify_assessment_3') {
		// Pull Fields
		$last_step = sanitize_text_field($_POST['last_step']);
		$post_id = sanitize_text_field($_POST['post_id']);

		$property_type = sanitize_text_field($_POST['property_type']);

		// Update post acf fields
		if ($post_id < 1 || !is_numeric($post_id) || $post_id == '') {
			wp_send_json_error([
				'status' => 500,
				'message' => 'Invalid post ID: ' . $post_id
			]);
		}
		else {
			update_field('last_step', $last_step, $post_id);
			update_field('property_type', $property_type, $post_id);

			// Success
			wp_send_json_success([
				'status' => 201,
				'post_id' => $post_id,
			]);
		}
	}
}
add_action('wp_ajax_modify_assessment_3', 'modify_post_3');
add_action('wp_ajax_nopriv_modify_assessment_3', 'modify_post_3');


// ... property details substeps, comps, payment and resend handlers
