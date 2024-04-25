<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/List', 'Home::user');
$routes->get('/ListAfter', 'Home::after');
$routes->post('/ListAfter', 'Home::after');

$routes->post('/Tri', 'Home::tri');
$routes->get('/Create_account', 'Home::create_account');
$routes->post('/Login', 'Home::login');
$routes->post('/Sign_up','Home::signup');
$routes->post('/Modif','Home::modif');
$routes->get('/Modif','Home::modif');



