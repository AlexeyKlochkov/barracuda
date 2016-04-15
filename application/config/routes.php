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
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['logout_partner'] = 'utils/logout/logout_partner';
$route['logout_employee'] = 'utils/logout/logout_employee';


$route['login/partnerLogin'] = 'login/partnerLogin';
$route['add_partner'] = 'partner_portal/add_partner';
$route['add_partner/submit'] = 'partner_portal/add_partner/submit';
$route['partner_page'] = 'partner_portal/partner_page';
$route['partner_page/addRewardsCourse'] = 'partner_portal/partner_page/addRewardsCourse';
$route['partner_page/addRewardsProduct'] = 'partner_portal/partner_page/addRewardsProduct';
$route['partner_page/getProductsByReward/(:any)'] = 'partner_portal/partner_page/getProductsByRewardProgram/$1';
$route['partner_page/getCoursesByRewardProgram/(:any)'] = 'partner_portal/partner_page/getCoursesByRewardProgram/$1';
$route['partner_page/getPartnerRewardRequest/(:any)'] = 'partner_portal/partner_page/getPartnerRewardRequest/$1';

$route['employee'] = 'employee';
$route['employee/login'] = 'employee/employeeLogin';
$route['add_employee'] = 'employee_portal/add_employee';
$route['add_employee/submit'] = 'employee_portal/add_employee/submit';
$route['employee_page'] = 'employee_portal/employee_page';

$route['review_request/getPartnerRquest'] = 'employee_portal/review_request/reviewPartnerRequest';
$route['review_request'] = 'employee_portal/review_request';
$route['add_product'] = 'employee_portal/add_product';
$route['add_product/add'] = 'employee_portal/add_product/add';

$route['add_course'] = 'employee_portal/add_course';
$route['add_course/add'] = 'employee_portal/add_course/add';

$route['add_rewards_program'] = 'employee_portal/add_rewards_program';
$route['add_rewards_program/addCourses'] = 'employee_portal/add_rewards_program/addCourses';
$route['add_rewards_program/addProducts'] = 'employee_portal/add_rewards_program/addProducts';

