<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

/*
| -------------------------------------------------------------------------
| aCMS Dynamic Routing
| -------------------------------------------------------------------------
| Dynamic Routing from Database
|
*/

require_once (BASEPATH .'database/DB.php');
$db =& DB();

$query = $db->where('page_status', 'published');
$query = $db->where('is_homepage', 'false');
$query = $db->get('acms_routes');
$result = $query->result();

foreach ($result as $row) {
	$route[$row->slug] = $row->controller;
}

$route['translate_uri_dashes'] = true;

/*
| -------------------------------------------------------------------------
| aCMS Homepage
| -------------------------------------------------------------------------
| Select homepage in CMS
|
*/
$route['default_controller'] = 'pages/homepage';
$route['translate_uri_dashes'] = false;

/*
| -------------------------------------------------------------------------
| aCMS Admin panel Routing
| -------------------------------------------------------------------------
| Admin panel Routing
|
*/
$route['admin'] = 'admin/dashboard';

$route['admin/pages/new-page'] = 'admin/pages/newPage';
$route['admin/add/page']['post'] = 'admin/pages/newPagePost';
$route['admin/edit/page']['post'] = 'admin/pages/editPagePost';
$route['admin/pages/edit/(:num)'] = 'admin/pages/editPage/$1';

$route['admin/news/new-news'] = 'admin/news/newNews';
$route['admin/add/news']['post'] = 'admin/news/newNewsPost';
$route['admin/edit/news']['post'] = 'admin/news/editNewsPost';
$route['admin/news/edit/(:num)'] = 'admin/news/editNews/$1';

$route['admin/templates/new-template'] = 'admin/templates/newTemplate';
$route['admin/add/template']['post'] = 'admin/templates/newTemplatePost';

$route['admin/settings'] = 'admin/settings/websiteSettings';
$route['admin/settings/cms'] = 'admin/settings/cmsSettings';