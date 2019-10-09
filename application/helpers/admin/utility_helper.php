<?php
/*
 * Debug function
 */
function debug($array) {
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}

/*
 * Returns active if request uri match with parameter
 */
function active_menu($urlArray) {
	if (in_array($_SERVER['REQUEST_URI'], $urlArray)) return 'active';
	return null;
}

/*
 * Returns show or collapsed if parameters match with request uri
 */
function active_submenu($urlArray, $class) {
	if (in_array($_SERVER['REQUEST_URI'], $urlArray) && $class === 'show') {
		return 'show';
	}

	if (!in_array($_SERVER['REQUEST_URI'], $urlArray) && $class === 'collapsed') {
		return 'collapsed';
	}

	return null;
}