<?php
// WP - Menu - Custom Walker Mega
class acme_custom_mega extends Walker_Nav_Menu
{
	private $mega_type = 'basic';
	private $cur_parent_is_mega = false;
	private $html_mega_parent_cta = '';
	private $html_mega_parent_posts = '';

	// ************************************************************
	// Controls Menu Item element, sets global mega content areas
	// ************************************************************
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
	{
		$title = $item->title;
		$permalink = $item->url;
		$has_permalink = ($permalink && $permalink != '#') ? true : false;
		$item_classes = empty( $item->classes ) ? array() : (array)$item->classes;
		$menu_item_type = get_field( 'menu_item_type', $item );
		$menu_icon = '';

		// ********************
		// Mega Parent
		if( $menu_item_type == 'mega-parent' ) {
			$mega_parent_type = get_field( 'mega_parent_type', $item );
			$mega_parent = get_field( 'mega_parent', $item );
			$item_classes[] = 'mega-parent ' . $mega_parent_type .' mega-lvl-' . $depth;

			$this->mega_type = $mega_parent_type;
			$this->cur_parent_is_mega = true;

			// HTML - Parent content
			if( $this->cur_parent_is_mega ) {
				$header = $mega_parent['header'] ? '<div class="header">'. $mega_parent['header'] .'</div>' : '';
				$description = $mega_parent['description'] ? '<div class="description">'. $mega_parent['description'] .'</div>' : '';
				$mega_cta = Helpers\Templates::to_string( $mega_parent['cta'], 'framework_button', [ 'style' => 'tertiary' ] );

				$this->html_mega_parent_cta .=	'<div class="mega-cta-wrapper">';
				$this->html_mega_parent_cta .=		$header;
				$this->html_mega_parent_cta .=		$description;
				$this->html_mega_parent_cta .=		$mega_cta;
				$this->html_mega_parent_cta .=	'</div>';
			}

			// HTML - Posts (if Mega Posts)
			if( $mega_parent_type === 'mega-posts' ) {
				$is_manual_posts = get_field( 'manual_posts', $item );
				$args = [
					'post_type' => 'post',
					'post_status' => 'publish',
					'posts_per_page' => 2,
					'orderby' => 'date',
					'order' => 'DESC',
				];

				if( $is_manual_posts ) {
					$post_ids = get_field( 'select_posts', $item );

					if( !empty( $post_ids ) ) {
						$args['post__in'] = $post_ids;
						$args['orderby'] = 'post__in';
					}
				}

				$loaded_posts = new WP_Query( $args );
				$posts_header_text = ( $is_manual_posts ) ? 'Featured Insights' : 'Latest Insights' ;

				if( $loaded_posts && $loaded_posts->have_posts() ) {
					$this->html_mega_parent_posts .= '<div class="mega-posts">';
					$this->html_mega_parent_posts .= '	<div class="header">'. $posts_header_text .'</div>';
					
					$this->html_mega_parent_posts .= '	<div class="post-items">';

					while( $loaded_posts->have_posts() ) { $loaded_posts->the_post();
						$post_id = get_the_ID();
						$post_title = get_the_title();
						$post_url = get_the_permalink();
						$post_date = get_the_date('M j, Y');
						$primary_term_id = yoast_get_primary_term_id( 'category', $post_id );
						$post_image = get_the_post_thumbnail_url($post_id, 'large');

						if (!$post_image) {
							$placeholder_image = get_field('image_placeholder', 'option');
							$post_image = $placeholder_image['sizes']['large'];
						}


						if( $primary_term_id ) {
							$primary_term = get_term( $primary_term_id );
							$primary_cat = $primary_term->name;
						}
						else {
							$categories = wp_get_object_terms($post_id, 'category', ['fields' => 'names']);
							if (!empty($categories) && !is_wp_error($categories)) {
								$primary_cat = $categories[0];
							} else {
								$primary_cat = 'Insight';
							}
						}

						$this->html_mega_parent_posts .= '<a class="post-item" href="'. $post_url .'">';
						$this->html_mega_parent_posts .= '	<div class="post-image" style="background-image: url('. $post_image .');"></div>';
						$this->html_mega_parent_posts .= '	<div class="post-meta">';
						$this->html_mega_parent_posts .= '		<div class="post-tax">'. $primary_cat .'</div>';
						$this->html_mega_parent_posts .= '		<div class="post-date">'. $post_date .'</div>';
						$this->html_mega_parent_posts .= '	</div>';
						$this->html_mega_parent_posts .= '	<div class="post-title">'. $post_title .'</div>';
						$this->html_mega_parent_posts .= '</a>';
					}

					$this->html_mega_parent_posts .= '	</div>'; // .post-items

					wp_reset_postdata();

					$this->html_mega_parent_posts .= '</div>'; // .mega-posts;
				}
			}
		}

		// ********************
		// Mega Child
		elseif( $menu_item_type == 'mega-child' ) {
			$mega_icon = get_field( 'mega_icon', $item );
			$item_classes[] = 'mega-child';

			if( $mega_icon['sizes']['thumbnail'] ) {
				$menu_icon .= '<span class="menu-icon" style="background-image: url('. $mega_icon['sizes']['thumbnail'] .')"></span>';
			}
		}

		$output .= '<li class="'. implode( ' ', $item_classes ) .'">';

		// ********************
		// All Items: Mega Parent, Mega Child, Default
		// <a> or <span> depending if permalink set
		if ( $has_permalink ) {
			$item_target = $item->target;

			if( $item_target ) {
				$output .= '<a class="menu-element is-link" href="' . $permalink . '" target="'. $item_target .'">';
			}
			else {
				$output .= '<a class="menu-element is-link" href="' . $permalink . '">';
			}
		}
		else {
			$output .= '<span class="menu-element">';
		}

		$output .= $menu_icon . $title;

		if ( in_array('menu-item-has-children', $item_classes) && ($depth === 0) ) {
			$output .= '<i class="lvl-'. $depth .' icon icon-plus icon-desktop"></i>';
			$output .= '<i class="lvl-'. $depth .' icon icon-arrow-right icon-mobile"></i>';
		}

		$output .= ($has_permalink) ? '</a>' : '</span>';
	}

	// ************************************************************
	// Controls Sub Menu wrapper opening tags, injects mega content before sub-menu items
	// ************************************************************
	function start_lvl(&$output, $depth = 0, $args = array())
	{
		// Lvl0 - Mega Parent
		if( ($depth == 0) && $this->cur_parent_is_mega ) {
			$output .= '<div class="mega-parent-body sub-menu-main">';
			$output .= '	<div class="sub-menu-back"><i class="icon-arrow-left"></i></div>';
			$output .= '	<div class="mega-parent-wrapper wrapper '. $this->mega_type .'">';
			$output .=  		$this->html_mega_parent_cta;
			$output .= '		<ul class="lvl-'. ( $depth + 1 ) .' sub-menu">';

			// Reset globals
			$this->html_mega_parent_cta = '';
		}
		// Standard <ul> sub menu
		else {
			if( $depth == 0 ) {
				$output .= '<ul class="lvl-'. ( $depth + 1 ) .' sub-menu-main">';
			}
			else {
				$output .= '<ul class="lvl-'. ( $depth + 1 ) .' sub-menu">';
			}
		}
	}

	// ************************************************************
	// Controls Sub Menu wrapper closing tags, injects mega content after sub-menu items
	// ************************************************************
	function end_lvl(&$output, $depth = 0, $args = array())
	{
		// Lvl0 - Mega Parent
		if( ($depth == 0) && $this->cur_parent_is_mega ) {
			$output .= '		</ul>'; // .sub-menu
			$output .= 			$this->html_mega_parent_posts; // if .mega-posts
			$output .= '	</div>'; // .mega-parent-wrapper
			$output .= '</div>'; // .mega-parent-body

			// Reset globals
			$this->cur_parent_is_mega = false;
			$this->html_mega_parent_posts = '';
		}
		else {
			$output .= '</ul>';
		}
	}
}
