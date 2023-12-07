<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(true);

$routes->get('/', 'Home::index');
$routes->get('/komik/create', 'Komik::create');
$routes->get('/orang/create', 'Orang::create');
$routes->get('/komik/edit/(:segment)', 'Komik::edit/$1');
$routes->get('/orang/edit/(:segment)', 'Orang::edit/$1');
$routes->delete('/komik/(:num)', 'Komik::delete/$1');
$routes->delete('/orang/(:num)', 'Orang::delete/$1');
$routes->get('/komik/(:any)', 'Komik::detail/$1');
$routes->get('/orang/(:any)', 'Orang::detail/$1');
