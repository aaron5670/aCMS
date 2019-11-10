<?php defined('BASEPATH') OR exit('No direct script access allowed');
use samdark\sitemap\Sitemap;

/*
 * Regenerate a new sitemap for Search Engines
 * Sitemap url: example.com/sitemap.xml
 */
function sitemap_generator() {
	require_once (BASEPATH .'database/DB.php');
	$db =& DB();

	$db->select('*');
	$routes = $db->get('acms_routes')->result();

	// renew sitemap
	$sitemap = new Sitemap(FCPATH . '/sitemap.xml');

	// add some URLs
	foreach ($routes as $route) {
		if ($route->is_homepage && $route->page_status === 'published'){
			$sitemap->addItem(base_url(), time(), Sitemap::MONTHLY, 1);
		}elseif ($route->is_newspage && $route->page_status === 'published') {
			$sitemap->addItem(base_url($route->slug), time(), Sitemap::WEEKLY, 0.8);
		}elseif ($route->page_status === 'published') {
			$sitemap->addItem(base_url($route->slug), time(), Sitemap::MONTHLY, 0.5);
		}
	}

	// write it
	$sitemap->write();

	// get URLs of sitemaps written
	$sitemap->getSitemapUrls(base_url());
}