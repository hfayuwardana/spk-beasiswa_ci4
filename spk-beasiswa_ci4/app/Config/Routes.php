<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('AdminController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');
$routes->get('/', 'AdminController::index');
$routes->get('/authenticate', 'AdminController::authenticate');
// $routes->get('/home', 'AdminController::index');
$routes->get('/home', 'AdminController::home');
$routes->post('/login', 'AdminController::login');

$routes->get('/admin', 'AdminController::viewAllAkun');
$routes->get('/admin/createAkun', 'AdminController::createAkun');
$routes->post('/admin/insertAkun', 'AdminController::insertAkun');
$routes->get('/admin/editAkun/(:segment)', 'AdminController::editAkun/$1');
$routes->put('/admin/updateAkun/(:segment)', 'AdminController::updateAkun/$1');
$routes->delete('/admin/deleteAkun/(:segment)', 'AdminController::deleteAkun/$1');

$routes->get('/mahasiswa', 'AdminController::viewAllMahasiswa');
$routes->get('/mahasiswa/createMahasiswa', 'AdminController::createMahasiswa');
$routes->post('/mahasiswa/insertMahasiswa', 'AdminController::insertMahasiswa');
$routes->get('/mahasiswa/editMahasiswa/(:segment)', 'AdminController::editMahasiswa/$1');
$routes->put('/mahasiswa/updateMahasiswa/(:segment)', 'AdminController::updateMahasiswa/$1');
$routes->delete('/mahasiswa/deleteMahasiswa/(:segment)', 'AdminController::deleteMahasiswa/$1');
$routes->get('/mahasiswa/detailMahasiswa/(:segment)', 'AdminController::viewMahasiswa/$1');

$routes->get('/beasiswa', 'AdminController::viewAllBeasiswa');
$routes->get('/beasiswa/createBeasiswa', 'AdminController::createBeasiswa');
$routes->post('/beasiswa/insertBeasiswa', 'AdminController::insertBeasiswa');
$routes->get('/beasiswa/editBeasiswa/(:segment)', 'AdminController::editBeasiswa/$1');
$routes->put('/beasiswa/updateBeasiswa/(:segment)', 'AdminController::updateBeasiswa/$1');
$routes->delete('/beasiswa/deleteBeasiswa/(:segment)', 'AdminController::deleteBeasiswa/$1');
$routes->get('/beasiswa/detailBeasiswa/(:segment)', 'AdminController::viewBeasiswa/$1');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}