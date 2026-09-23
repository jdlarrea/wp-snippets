<?php
// WP - Menu - Custom Walker Mega
class acme_custom_mega extends Walker_Nav_Menu
{
	private $mega_lvl = 0;
	private $mega_type = 'basic';
	private $cur_parent_is_mega = false;
	private $html_mega_parent_content_mobile = '';
	private $html_mega_parent_content_top = '';
	private $html_mega_parent_content_btn = '';
	private $html_mega_parent_content_second_btn = '';
	private $html_mega_parent_cta = '';
	private $html_child_lvl1_content_top = '';
	private $html_child_lvl1_content_btm = '';
	private $html_child_lvl2_rows_header = '';

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

			// $this->mega_lvl = $depth;
			$this->mega_type = $mega_parent_type;
			$this->cur_parent_is_mega = true;
			$this->html_mega_parent_content_mobile = '<div class="mega-parent-mobile-header">'. $title .'</div>';

			// HTML - Parent content
			$this->html_mega_parent_content_top .= ($mega_parent['header']) ? '<div class="mega-content-header">'. $mega_parent['header'] .'</div>' : '';
			$this->html_mega_parent_content_btn .= Helpers\Templates::to_string( $mega_parent['link'], 'framework_button', ['style' => 'mega-content-btn'] );
			$this->html_mega_parent_content_second_btn .= Helpers\Templates::to_string( $mega_parent['second_link'], 'framework_button', ['style' => 'mega-content-second-btn'] );
			if( $mega_parent_type == 'mega-cta' ) {
				$cta_image = $mega_parent['cta']['image'];
				$cta_title = $mega_parent['cta']['title'];
				$cta_description = $mega_parent['cta']['description'];
				$cta_link = $mega_parent['cta']['link'];

				if( $cta_image ) {
					if( $cta_link['url'] ) {
						$new_tab = $cta_link['new_tab'] ? 'target="_blank"' : '';

						$this->html_mega_parent_cta .= '<a href="'. $cta_link['url'] .'" class="mega-offer-content" '. $new_tab .'  style="background-image: url('. $cta_image['sizes']['large'] .')">';
					}
					else {
						$this->html_mega_parent_cta .= '<div class="mega-offer-content" style="background-image: url('. $cta_image['sizes']['large'] .')">';
					}

					$this->html_mega_parent_cta .= '	<div class="offer-wrapper">';
					$this->html_mega_parent_cta .= 			( $cta_title ) ? '<div class="offer-title">'. $cta_title .'</div>' : '';
					$this->html_mega_parent_cta .= 			( $cta_description ) ? '<div class="offer-description">'. $cta_description .'</div>' : '';
					$this->html_mega_parent_cta .= 			( $cta_link['text'] ) ? '<div class="button mega-offer-link">'. $cta_link['text'] .'<i class="icon-arrow-right"></i></div>' : '';
					$this->html_mega_parent_cta .= 		'</div>';

					if( $cta_link['url'] ) {
						$this->html_mega_parent_cta .= '</a>';
					}
					else {
						$this->html_mega_parent_cta .= '</div>';
					}
				}
			}
		}
		// ********************
		// Mega Child Lvl1-3
		elseif( $menu_item_type == 'mega-child' ) {
			$mega_child_type = get_field( 'mega_child_type', $item );
			$item_classes[] = 'mega-child ' . $mega_child_type;

			if( ($mega_child_type == 'mega-lvl-1') && (in_array('menu-item-has-children', $item_classes)) ) {
				$mega_child_lvl1 = get_field( 'mega_child_lvl1', $item );
				$link_url =  $mega_child_lvl1['link']['url'];
				$link_external = $mega_child_lvl1['link']['new_tab'];
				$this->html_child_lvl1_content_top .= $mega_child_lvl1['header'] ? ($link_url ? '<a href="'. $link_url .'" '.($link_external ? 'target="_blank"' : '').' class="child-lvl1-header">'. $mega_child_lvl1['header']  .'</a>' : '<div class="child-lvl1-header">'. $mega_child_lvl1['header']  .'</div>') : '';
				$this->html_child_lvl1_content_top .= $mega_child_lvl1['text'] ? '<div class="child-lvl1-text">'. $mega_child_lvl1['text'] .'</div>' : '';
				$this->html_child_lvl1_content_btm .= Helpers\Templates::to_string( $mega_child_lvl1['link'], 'framework_button', ['style' => 'btn-mega-child-lvl-1'] );
			}
			else {
				$item_icon = get_field( 'icon', $item );

				if( $item_icon ) {
					$menu_icon .= '<span class="menu-icon" style="background-image: url('. $item_icon['sizes']['thumbnail'] .')"></span>';
				}
			}
		}
		$output .= '<li class="'. implode( ' ', $item_classes ) .'">';

		// ********************
		// All Items: Mega Parent, Mega Child Lvl1-3, Default
		// <a> or <span> depending if permalink set
		if ( $has_permalink ) {
			$item_target = $item->target;

			if( $item_target ) {
				$output .= '<a class="menu-element" href="' . $permalink . '" target="'. $item_target .'">';
			}
			else {
				$output .= '<a class="menu-element" href="' . $permalink . '">';
			}
		}
		else {
			$output .= '<span class="menu-element">';
		}

		$output .= $menu_icon . $title;
		if (in_array('menu-item-has-children', $item_classes)) {
			$output .= '<i class="lvl-'. $depth .' icon icon-chevron-down icon-desktop"></i>';
			$output .= '<i class="lvl-'. $depth .' icon icon-chevron-right icon-mobile"></i>';
		}

		$output .= ($has_permalink) ? '</a>' : '</span>';
	}

	// ************************************************************
	// Controls Menu Item element, sets global mega content areas
	// ************************************************************
	function end_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
	{
		$title = $item->title;
		$permalink = $item->url;
		$has_permalink = ($permalink && $permalink != '#') ? true : false;
		$item_classes = empty( $item->classes ) ? array() : (array)$item->classes;
		$menu_item_type = get_field( 'menu_item_type', $item );

		// ********************
		// Mega Child Lvl1-3 - set mega-child-content at end_el since no children means no start_lvl will fire for sub-menu
		if( $menu_item_type == 'mega-child' && !(in_array('menu-item-has-children', $item_classes)) ) {
			$mega_child_type = get_field( 'mega_child_type', $item );
			$item_classes[] = 'mega-child ' . $mega_child_type;

			if( $mega_child_type == 'mega-lvl-1' ) {
				$mega_child_lvl1 = get_field( 'mega_child_lvl1', $item );
				$header = $mega_child_lvl1['header'];
				$text = $mega_child_lvl1['text'];
				$link = Helpers\Templates::to_string( $mega_child_lvl1['link'], 'framework_button', ['style' => 'btn-mega-child-lvl-1'] );
				$link_url =  $mega_child_lvl1['link']['url'];
				$link_external = $mega_child_lvl1['link']['new_tab'];
				

				if( $header || $text || $link ) {
					$output .= '<div class="lvl-'. ( $depth ) .' mega-child-wrapper">';
					$output .= '	<div class="lvl-'. ( $depth ) .' mega-child-header">';
					$output .=  		$header ? (!empty($link_url) ? '<a href="'. $link_url .'" '.($link_external ? 'target="_blank"' : '').' class="child-lvl1-header">'. $header .'</a>' : '<div class="child-lvl1-header">'. $header .'</div>') : '';
					$output .=  		$text ? '<div class="child-lvl1-text">'. $text .'</div>' : '';
					$output .=  		$link;
					$output .= '	</div>';
					$output .= '</div>';
				}
			}
		}

		$output .= '</li>';
	}

	// ************************************************************
	// Controls Sub Menu wrapper opening tags, injects mega content before sub-menu items
	// ************************************************************
	function start_lvl(&$output, $depth = 0, $args = array())
	{
		// Lvl0 - Mega Parent
		if( ($depth == 0) && $this->cur_parent_is_mega ) {
			$output .= '<div class="mega-parent-body sub-menu-main">';
			$output .= '	<div class="sub-menu-back"><i class="icon-chevron-left"></i></div>';
			$output .= '	<div class="mega-parent-wrapper">';
			$output .= '		<div class="mega-content '. $this->mega_type .'">';
			$output .=  			$this->html_mega_parent_content_mobile;
			$output .=  			$this->html_mega_parent_content_top;
			$output .= '			<ul class="lvl-'. ( $depth + 1 ) .' sub-menu">';

			// Reset globals
			$this->html_mega_parent_content_top = '';
		}
		// Lvl1 - Mega Child
		elseif( ($depth == 1) && $this->cur_parent_is_mega ) {
			if( $this->mega_type == 'mega-rows' ) {
				$output .= '<div class="lvl-'. ( $depth ) .' mega-child-wrapper">';
				$output .= '	<div class="lvl-'. ( $depth ) .' mega-child-header">';
				$output .=  		$this->html_child_lvl1_content_top;
				$output .=  		$this->html_child_lvl1_content_btm;
				$output .= '	</div>';
				$output .= '	<ul class="lvl-'. ( $depth + 1 ) .' sub-menu">';

				// Reset globals
				$this->html_child_lvl1_content_top = '';
			}
			else {
				$output .= '<div class="lvl-'. ( $depth ) .' mega-child-wrapper">';
				$output .= '	<div class="lvl-'. ( $depth ) .' mega-child-header">';
				$output .=  		$this->html_child_lvl1_content_top;
				$output .= '	</div>';
				$output .= '	<ul class="lvl-'. ( $depth + 1 ) .' sub-menu">';

				// Reset globals
				$this->html_child_lvl1_content_top = '';
			}

			// Reset globals
			$this->html_child_lvl1_content_top = '';
		}
		// Standard <ul> sub menu
		else {
			if( $depth == 0 ) {
				$output .= '<ul class="lvl-'. ( $depth + 1 ) .' sub-menu-main">';
			}
			else {
				$output .= '<ul class="lvl-'. ( $depth + 1 ) .' sub-menu">';
			}
			$output .= '<div class="sub-menu-back"><i class="icon-chevron-left"></i></div>';
		}
	}

	// ************************************************************
	// Controls Sub Menu wrapper closing tags, injects mega content after sub-menu items
	// ************************************************************
	function end_lvl(&$output, $depth = 0, $args = array())
	{
		// Lvl0 - Mega Parent
		if( ($depth == 0) && $this->cur_parent_is_mega ) {
			$output .= '			</ul>';
			$output .= '			<div class="mega-content-btns">';
			$output .=  				$this->html_mega_parent_content_btn;
			$output .=  				$this->html_mega_parent_content_second_btn;
			$output .= '			</div>'; 
			$output .= '		</div>';
			$output .= 			$this->html_mega_parent_cta;
			$output .= '	</div>';
			$output .= '</div>';

			// Reset globals
			// $this->mega_lvl = 0;
			$this->cur_parent_is_mega = false;
			$this->html_mega_parent_content_btn = '';
			$this->html_mega_parent_content_second_btn = '';
			$this->html_mega_parent_cta = '';
		}
		// Lvl1 - Mega Child
		elseif( ($depth == 1) && $this->cur_parent_is_mega ) {
			if( $this->mega_type == 'mega-rows' ) {
				$output .= '	</ul>';
				$output .= '	<div class="mega-rows-bottom-content-mobile">';
				$output .= '		<div class="link-wrapper">'. $this->html_child_lvl1_content_btm .'</div>';
				$output .= '		<div class="mega-rows-see-more">See More <i class="icon-chevron-down"></i></div>';
				$output .= '	</div>';
				$output .= '</div>';
			}
			else {
				$output .= '	</ul>';
				$output .=  	$this->html_child_lvl1_content_btm;
				$output .= '</div>';

			}

			// Reset globals
			$this->html_child_lvl1_content_btm = '';
		}
		else {
			$output .= '</ul>';
		}
	}
}
