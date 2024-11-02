<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// User registration and sign-in routes - pol
$routes->match(['get', 'post'], '/register', 'UserController::register');
$routes->match(['get', 'post'], '/store', 'UserController::store');
$routes->match(['get', 'post'], '/', 'UserController::signin');
$routes->match(['get', 'post'], '/login', 'UserController::login');

// Logout routes - paul
$routes->match(['post'], '/logout', 'UserController::logout');

// Dashboard routes for specific roles (tinaggal ko yung sa admin dito btw) - pol at geb
$routes->match(['get', 'post'], '/workers', 'WorkerController::workerDashboard');
$routes->match(['get', 'post'], '/user', 'CustomerController::userDashboard');

// Routes for head admin dashboard - geb
$routes->match(['get', 'post'], '/head_admin', 'HeadAdminController::index');
$routes->match(['get', 'post'], '/head_admin/add_worker', 'HeadAdminController::add_worker');
$routes->match(['get', 'post'], '/head_admin/delete/(:num)', 'HeadAdminController::delete/$1');
$routes->match(['get', 'post'], '/head_admin/edit/(:num)', 'HeadAdminController::edit/$1');
$routes->match(['get', 'post'], '/head_admin/update/(:num)', 'HeadAdminController::update/$1');

// New route for calendar - ryk 
$routes->get('customers/calendar', 'CustomerController::calendar');

// Route for receipts - ryk
$routes->match(['get', 'post'], 'customers/receipts', 'CustomerController::receipts');
