<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// User registration and sign-in routes - pol
$routes->match(['get', 'post'], '/register', 'UserController::register');
$routes->match(['get', 'post'], '/store', 'UserController::store');
$routes->match(['get', 'post'], '/signin', 'UserController::signin');
//$routes->match(['post'], '/dashboard', 'UserController::dashboard');
$routes->match(['get', 'post'], '/login', 'UserController::login');
 
// Dashboard routes
//$routes->match(['get', 'post'], '/dashboard', 'UserController::dashboard');
//$routes->match(['get', 'post'], '/dashboard', 'UserController::dashboard'); <-chuchu


// Logout routes - paul
$routes->match(['post'], '/logout', 'UserController::logout');

// Dashboard routes for specific roles (tinaggal ko yung sa admin dito btw) - pol at geb
$routes->match(['get', 'post'], '/workers', 'UserController::workerDashboard');
$routes->match(['get', 'post'], '/user', 'UserController::userDashboard');

//Routes for head admin dashboard - geb
$routes->get('/head_admin', 'HeadAdminController::index');
$routes->post('/head_admin/add_worker', 'HeadAdminController::add_worker');
$routes->post('/head_admin/delete/(:num)', 'HeadAdminController::delete/$1');
//head admin edit and delete page routes - geb
$routes->get('head_admin/edit/(:num)', 'HeadAdminController::edit/$1');
$routes->post('head_admin/update/(:num)', 'HeadAdminController::update/$1');


// New route for calendar - ryk 
$routes->get('roleDashboard/calendar', 'UserController::calendar');

// route for receipts - ryk
$routes->match(['get', 'post'], 'roleDashboard/receipts', 'UserController::receipts');


