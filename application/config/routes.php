<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'admin_controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['login'] = 'auth_controller/login';
$route['api/login'] = 'auth_controller/json_login';

# MAIN
$route['dashboard'] = 'admin_controller';

# รับรถเข้าซ่อม
$route['job/add'] = 'Job_controller/add';

#EMPLOYEE
$route['employees'] = 'Employee_controller';
$route['employee/add'] = 'Employee_controller/add';
$route['api/employee/add'] = 'Employee_controller/json_add';
$route['employee/(:num)'] = 'Employee_controller/edit/$1';
$route['api/employee/edit'] = 'Employee_controller/json_edit';
$route['api/employee/del'] = 'Employee_controller/json_del';

#Work
$route['works'] = 'Work_controller';
$route['work/add'] = 'Work_controller/add';
$route['api/work/add'] = 'Work_controller/json_add';
$route['work/(:num)'] = 'Work_controller/edit/$1';
$route['api/work/edit'] = 'Work_controller/json_edit';
$route['api/work/del'] = 'Work_controller/json_del';

#CAR
$route['cars'] = 'Car_controller';
$route['car/add'] = 'Car_controller/add';
$route['car/(:num)'] = 'Car_controller/edit/$1';
$route['car/(:num)/report'] = 'Car_controller/report/$1';
$route['api/car/add'] = 'Car_controller/json_add';
$route['api/car/edit'] = 'Car_controller/json_edit';
$route['api/car/del'] = 'Car_controller/json_del';
$route['api/car/search'] = 'Car_controller/json_search';
