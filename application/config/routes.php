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
$route['default_controller'] 			= 'home';
$route['404_override'] 					= 'Error404';
$route['translate_uri_dashes'] 			= TRUE;
$route['backend']						= 'backend/dashboard';
$route['backend/(:any)']				= 'backend/$1';

$route['beranda|home'] 					= 'home';
$route['infografis'] 					= 'infografis';
$route['author'] 						= 'author';
$route['author/(:any)'] 				= 'author/index/$1';
$route['tag'] 							= 'tag';
$route['tag/(:any)'] 					= 'tag/index/$1';
$route['kupas-tv'] 						= 'kupas-tv';
$route['kupas-tv/:num'] 				= 'kupas-tv/index/$1';
$route['redaksi'] 						= 'redaksi';
$route['kontak-kami'] 					= 'kontak-kami';
$route['berita-foto'] 					= 'berita-foto';
$route['e-paper'] 						= 'e-paper';
$route['indeks'] 						= 'indeks';
$route['indeks/(:any)'] 				= 'indeks/index/$1';
$route['page/(:any)'] 					= 'page/index/$1';

$route['single'] 						= 'single';
$route['post-count'] 					= 'post-count';

$route['captcha'] 						= 'captcha';
$route['captcha/(:any)'] 				= 'captcha/$1';
$route['kontak-kami/(:any)'] 			= 'kontak-kami/$1';
$route['penulis/(:any)'] 				= 'penulis/index/$1';
$route['search'] 						= 'search';

$route['berita-ajax/(:any)/:num'] 		= 'berita/loadmore/$1/$2';
$route['berita-foto-ajax/:num'] 		= 'berita-foto/loadmore/$1';
$route['infografis-ajax/:num'] 			= 'infografis/loadmore/$1';
$route['kupas-tv-ajax/:num'] 			= 'kupas-tv/loadmore/$1';
$route['penulis-ajax/(:any)/:num'] 		= 'penulis/loadmore/$1/$2';
$route['e-paper-ajax/:num'] 			= 'e-paper/loadmore/$1';
$route['indeks-ajax/:num'] 				= 'indeks/loadmore/$1'; 
$route['author-ajax/(:any)/:num'] 		= 'author/loadmore/$1';
$route['tag-ajax/(:any)/:num'] 			= 'tag/loadmore/$1';
$route['rss|feed'] = 'feed/index';

$route['(:any)'] 						= 'berita/category/$1';

$route['(:any)/:num'] 					= 'berita/category/$2';
$route['(:any)/(:any)'] 				= 'berita/sub-category/$2';

$route['(:any)/(:any)/:num'] 			= 'berita/sub-category/$3';
// $route['indeks/(:any)']					= 'indeks/index/$1';

$route['(:num)/(:num)/(:num)/(:any)'] 	= 'single/index/$4';
$route['(:num)/(:num)/(:num)/(:any)/(:any)'] 	= 'single/index/$4/$5';





