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

// segment 1: id beasiswa, segment 2: id_kriteria
$routes->get('/kriteria/(:segment)', 'AdminController::viewAllKriteria/$1');
$routes->get('/kriteria/createKriteria/(:segment)', 'AdminController::createKriteria/$1');
$routes->post('/kriteria/insertKriteria/(:segment)', 'AdminController::insertKriteria/$1');
$routes->get('/kriteria/editKriteria/(:segment)/(:segment)', 'AdminController::editKriteria/$1/$2');
$routes->put('/kriteria/updateKriteria/(:segment)/(:segment)', 'AdminController::updateKriteria/$1/$2');
$routes->delete('/kriteria/deleteKriteria/(:segment)/(:segment)', 'AdminController::deleteKriteria/$1/$2');

//segment 1: id_beasiswa , segment 2: id_kriteria, segment 3: id_bobot
$routes->get('/bobot/(:segment)/(:segment)', 'AdminController::viewAllBobot/$1/$2');
$routes->get('/bobot/createBobot/(:segment)/(:segment)', 'AdminController::createBobot/$1/$2');
$routes->post('/bobot/insertBobot/(:segment)/(:segment)', 'AdminController::insertBobot/$1/$2');
$routes->get('/bobot/editBobot/(:segment)/(:segment)/(:segment)', 'AdminController::editBobot/$1/$2/$3');
$routes->put('/bobot/updateBobot/(:segment)/(:segment)/(:segment)', 'AdminController::updateBobot/$1/$2/$3');
$routes->delete('/bobot/deleteBobot/(:segment)/(:segment)/(:segment)', 'AdminController::deleteBobot/$1/$2/$3');

//segment 1: id_beasiswa , segment 2: id_mahasiswa
$routes->get('/kecocokan/beasiswa', 'AdminController::viewBeasiswaPadaKecocokan');
$routes->get('/kecocokan/mahasiswa/(:segment)', 'AdminController::viewMahasiswaPadaKecocokan/$1');
$routes->get('/kecocokan/pencocokan/(:segment)/(:segment)', 'AdminController::viewMahasiswaPadaKecocokan/$1/$2');
$routes->get('/kecocokan/createKecocokan', 'AdminController::createKecocokan');
$routes->post('/kecocokan/insertKecocokan', 'AdminController::insertBobot');
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