<?php

/*
 * Get base url of the assets directory
 */
function asset_url() {
	return base_url() . 'assets/';
}

/*
 * Check if string is JSON
 */
function isJson($string) {
	json_decode($string);
	return (json_last_error() == JSON_ERROR_NONE);
}