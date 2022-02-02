<?php
defined('BASEPATH') or exit('No direct script access allowed');

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


$route['admin/department'] = 'department/department';
$route['admin/add_department'] = 'department/add_department';
$route['admin/save_department'] = 'department/save_department';
$route['admin/hapus_department/(:num)'] = 'department/hapus_department/$1';
$route['admin/edit_department/(:num)'] = 'department/edit_department/$1';
$route['admin/save_edit_department'] = 'department/save_edit_department';


$route['admin/add_section/(:num)'] = 'department/add_section/$1';
$route['admin/save_section'] = 'department/save_section';
$route['admin/list_section/(:num)'] = 'department/list_section/$1';
$route['admin/hapus_section/(:num)'] = 'department/hapus_section/$1';
$route['admin/edit_section/(:num)'] = 'department/edit_section/$1';
$route['admin/save_edit_section'] = 'department/save_edit_section';

$route['admin/list_room'] = 'room/list_room';
$route['admin/add_room'] = 'room/add_room';
$route['admin/save_room'] = 'room/save_room';
$route['admin/hapus_room/(:num)'] = 'room/hapus_room/$1';
$route['admin/edit_room/(:num)'] = 'room/edit_room/$1';
$route['admin/save_edit_room'] = 'room/save_edit_room';
$route['admin/uploadimg_room/(:num)'] = 'room/uploadimg_room/$1';
$route['admin/save_upload_room'] = 'room/save_upload_room';

$route['admin/list_karyawan'] = 'subadmin/list_karyawan';
$route['admin/add_karyawan'] = 'subadmin/add_karyawan';
$route['admin/save_karyawan'] = 'subadmin/save_karyawan';
$route['admin/hapus_karyawan/(:num)'] = 'subadmin/hapus_karyawan/$1';
$route['admin/list_room_dep'] = 'subadmin/list_room_dep';
$route['admin/edit_karyawan/(:num)'] = 'subadmin/edit_karyawan/$1';
$route['admin/save_edit_karyawan'] = 'subadmin/save_edit_karyawan';
$route['admin/set_access/(:num)'] = 'subadmin/set_access/$1';
$route['admin/save_set_access'] = 'subadmin/save_set_access';
$route['admin/menu_access/(:num)'] = 'subadmin/menu_access/$1';
$route['admin/menu_access_update/(:num)'] = 'subadmin/menu_access_update/$1';

$route['admin/control'] = 'control/control';
$route['admin/monitoring'] = 'control/monitoring';
$route['admin/monitoringdep'] = 'control/monitoringdep';
$route['admin/positionswitch'] = 'control/positionswitch';
$route['admin/control_relay'] = 'control/control_relay';

$route['admin/notif'] = 'notif/index';
$route['admin/notif/create'] = 'notif/create';
$route['admin/notif/store'] = 'notif/store';
$route['admin/notif/edit/(:num)'] = 'notif/edit/$1';
$route['admin/notif/update/(:num)'] = 'notif/update/$1';
$route['admin/notif/delete/(:num)'] = 'notif/delete/$1';
$route['admin/notif/enable'] = 'notif/enable';


$route['karyawan/monitoringdep'] = 'karyawan/monitoringdep';
$route['karyawan/positionswitch'] = 'control/positionswitch';
$route['karyawan/control_relay'] = 'control/control_relay';
