<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Routes for User Registration and Sign-In - paul
$routes->match(['get', 'post'], '/register', 'UserController::register');
$routes->match(['get', 'post'], '/store', 'UserController::store');
$routes->match(['get', 'post'], '/', 'UserController::signin');
$routes->match(['get', 'post'], '/login', 'UserController::login');

// Route for Logout - paul
$routes->match(['post'], '/logout', 'UserController::logout');

// Routes for Dashboard of Specific Roles - paul at gabe
$routes->match(['get', 'post'], '/workers', 'WorkerController::workerDashboard');
$routes->match(['get', 'post'], '/user', 'CustomerController::userDashboard');

// Routes for Head Admin Dashboard - gabe
$routes->match(['get', 'post'], '/head_admin', 'HeadAdminController::index');
$routes->match(['get', 'post'], '/head_admin/add_worker', 'HeadAdminController::add_worker');
$routes->match(['get', 'post'], '/head_admin/delete/(:num)', 'HeadAdminController::delete/$1');
$routes->match(['get', 'post'], '/head_admin/edit/(:num)', 'HeadAdminController::edit/$1');
$routes->match(['get', 'post'], '/head_admin/update/(:num)', 'HeadAdminController::update/$1');

// Route for Calendar - eiryk 
$routes->match(['post'],'/calendar', 'CustomerController::calendar');

// Route for Receipts - eiryk
$routes->match(['post'], '/receipts', 'CustomerController::receipts');

//Routes for Worker Dashboard
$routes->match(['get', 'post'], '/workers/delete/(:num)', 'WorkerController::delete/$1');


//Routes for Customer
$routes->match(['get', 'post'], '/customers/update/', 'CustomerController::update');
$routes->post('/customer/updateProfile', 'CustomerController::updateProfile');

