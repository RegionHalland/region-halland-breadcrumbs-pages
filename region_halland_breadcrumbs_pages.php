<?php

	/**
	 * @package Region Halland Breadcrumbs Pages
	*/
	
	/*
	Plugin Name: Region Halland Breadcrumbs Pages
	Description: Front-end-plugin för breadcrumbs (bara för sidor)
	Version: 1.2.0
	Author: Roland Hydén
	License: GPL-3.0
	Text Domain: regionhalland
	*/

	// Returnera en array med breadcrumbs-info
	function get_region_halland_breadcrumbs_pages() {
		
		// Wordpress funktion för aktuell post
		global $post;
		
		// Titel för aktuell sida
		$title = $post->post_title;
		
		// Lägg till första posten i arrayen med breadcrumbs
		$breadcrumbs = addRegionHallandBreadcrumbsPages(array(), get_bloginfo('name'), get_home_url());
		
		// Hämta ID för alla "föräldrar" till aktuell sida
		$ancestors = array_reverse(get_post_ancestors($post->ID));

		// Loopa igenom alla "föräldrar"
		foreach ($ancestors as $ancestor) {

			// Hämta "titel" och "url" för respektive post
			$breadcrumbs = addRegionHallandBreadcrumbsPages($breadcrumbs, get_the_title($ancestor), get_page_link($ancestor));
		
		}
		
		// Lägg till aktuell sidas titel
		$breadcrumbs = addRegionHallandBreadcrumbsPages($breadcrumbs, $title, false);		
		
		// Returnera arrayen
		return $breadcrumbs;

	}

	// Function för bygga array
	function addRegionHallandBreadcrumbsPages($list, $name, $url) {
		
		// Array-element med "namn" och "url"
		$list[] = array(
			'name' => $name,
			'url' => $url
		);

		// Returnera array-element
		return $list;
	}

	// Metod som anropas när pluginen aktiveras
	function region_halland_breadcrumbs_pages_activate() {
		// Ingenting just nu...
	}

	// Metod som anropas när pluginen av-aktiveras
	function region_halland_breadcrumbs_pages_deactivate() {
		// Ingenting just nu...
	}
	
	// Aktivera pluginen och anropa metod
	register_activation_hook( __FILE__, 'region_halland_breadcrumbs_pages_activate');
	
	// Av-aktivera pluginen och anropa metod
	register_deactivation_hook( __FILE__, 'region_halland_breadcrumbs_pages_deactivate');

?>