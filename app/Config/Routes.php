<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Public routes (no auth required)
$routes->get('/', 'AuthController::loginForm');
$routes->get('login', 'AuthController::loginForm');
$routes->post('login', 'AuthController::login');

// Protected routes (auth filter applied)
$routes->group('', ['filter' => 'auth'], function ($routes) {
    // Dashboard
    $routes->get('dashboard', 'DashboardController::index');

    // User CRUD
    $routes->get('users', 'UserController::index');
    $routes->get('users/create', 'UserController::create');
    $routes->post('users/store', 'UserController::store');
    $routes->get('users/edit/(:num)', 'UserController::edit/$1');
    $routes->post('users/update/(:num)', 'UserController::update/$1');
    $routes->post('users/delete/(:num)', 'UserController::delete/$1');

    // Logout
    $routes->get('logout', 'AuthController::logout');
});

