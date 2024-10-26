<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// User registration and sign-in routes
$routes->match(['get', 'post'], '/register', 'UserController::register');
$routes->match(['get', 'post'], '/store', 'UserController::store');
$routes->match(['get', 'post'], '/signin', 'UserController::signin');
//$routes->match(['post'], '/dashboard', 'UserController::dashboard');
$routes->match(['get', 'post'], '/login', 'UserController::login');
 
// Dashboard routes
//$routes->match(['get', 'post'], '/dashboard', 'UserController::dashboard');
//$routes->match(['get', 'post'], '/dashboard', 'UserController::dashboard'); <-chuchu


// Logout routes
$routes->match(['post'], '/logout', 'UserController::logout');

// Dashboard routes for specific roles
$routes->match(['get', 'post'], '/head_admin', 'UserController::headAdminDashboard');
$routes->match(['get', 'post'], '/workers', 'UserController::workerDashboard');
$routes->match(['get', 'post'], '/user', 'UserController::userDashboard');
