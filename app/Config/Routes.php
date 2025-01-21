<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 * 
 */
$routes->setAutoRoute(true);
$routes->add('/', 'User\Login::login');
$routes->get('/blink/checkBlink', 'Blink::checkBlink');
$routes->get('/attendance/success', 'AttendanceController::success');



$routes->add('admin2011/logout', 'Admin2011\Login::logout');
$routes->post('admin2011/absensi/submit', 'Admin2011\absensi::submit');

$routes->group('admin2011', ['filter' => 'noadmin'], function ($routes) {
    $routes->add('/', 'Admin2011\Login::login');
    $routes->add('login', 'Admin2011\Login::login');
    $routes->add('lupapassword', 'Admin2011\Login::lupapassword');
    $routes->add('resetpassword', 'Admin2011\Login::resetpassword');
});

// user routes
$routes->add('user/logout', 'User\Login::logout');
$routes->post('user/absensi/submit', 'User\absensi::submit');

$routes->group('user', ['filter' => 'noadmin'], function ($routes) {
    $routes->add('/', 'User\Login::login');
    $routes->add('login', 'User\Login::login');
    $routes->add('lupapassword', 'User\Login::lupapassword');
    $routes->add('resetpassword', 'User\Login::resetpassword');
});
