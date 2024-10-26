<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// User registration and sign-in routes
$routes->match(['get', 'post'], '/register', 'UserController::register');
$routes->match(['get', 'post'], '/store', 'UserController::store');
$routes->match(['get', 'post'], '/signin', 'UserController::signin');
$routes->match(['get', 'post'], '/login', 'UserController::login');

// Dashboard routes
$routes->match(['get', 'post'], '/dashboard', 'UserController::dashboard');

// Logout routes
$routes->match(['post'], '/logout', 'UserController::logout');

