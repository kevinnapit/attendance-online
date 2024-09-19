<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 * 
 */
$routes->setAutoRoute(true);
$routes->get('/', 'Admin2011\Login::login');

$routes->add('admin2011/logout', 'Admin2011\Login::logout');

$routes->group('admin2011', ['filter' => 'noadmin'], function ($routes) {
    $routes->add('/', 'Admin2011\Login::login');
    $routes->add('login', 'Admin2011\Login::login');
    $routes->add('lupapassword', 'Admin2011\Login::lupapassword');
    $routes->add('resetpassword', 'Admin2011\Login::resetpassword');
});
