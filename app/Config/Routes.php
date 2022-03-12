<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('DashboardController');
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

// routes admin dashboard
$routes->get('/', 'Admin\DashboardController::index');
$routes->get('dashboard', 'Admin\DashboardController::index');

// routes admin poli
$routes->get('poli', 'Admin\PoliController::index');
$routes->post('poli/tambah', 'Admin\PoliController::insert');
$routes->post('poli/ubah/(:num)', 'Admin\PoliController::update/$1');
$routes->post('poli/hapus/(:num)', 'Admin\PoliController::delete/$1');

// routes admin pasien
$routes->get('pasien', 'Admin\PasienController::index');
$routes->get('pasien/detail/(:num)', 'Admin\PasienController::detail/$1');
$routes->get('pasien/tambah', 'Admin\PasienController::view_insert'); // tampil form tambah
$routes->post('pasien/tambah', 'Admin\PasienController::insert'); // simpan hasil form
$routes->post('pasien/hapus', 'Admin\PasienController::delete'); // gerbang hapus pasien
$routes->get('pasien/ubah/(:num)', 'Admin\PasienController::view_update/$1');
$routes->post('pasien/ubah/(:num)', 'Admin\PasienController::update/$1'); //simpan form ubah


// routes obat
$routes->get('obat', 'Admin\ObatController::index');
$routes->get('obat/detail/(:num)', 'Admin\ObatController::detail/$1');
$routes->get('obat/tambah', 'Admin\ObatController::view_insert'); // tampil form tambah
$routes->post('obat/tambah', 'Admin\ObatController::insert'); // simpan input form tambah
$routes->post('obat/hapus', 'Admin\ObatController::delete'); // gerbang hapus obat
$routes->get('obat/ubah/(:num)', 'Admin\ObatController::view_update/$1'); // form ubah obat
$routes->post('obat/ubah/(:num)', 'Admin\ObatController::update/$1'); // simpan form ubah obat


// routes dokter
$routes->get('dokter', 'Admin\DokterController::index'); // pakai modal
$routes->get('dokter/detail/(:num)', 'Admin\DokterController::detail/$1'); //tampil detail
$routes->post('dokter/tambah', 'Admin\DokterController::insert'); // simpan input form
$routes->post('dokter/hapus', 'Admin\DokterController::delete'); // hapus data dokter
$routes->post('dokter/ubah/(:num)', 'Admin\DokterController::update/$1');


// routes admin laporan
$routes->get('laporan', 'Admin\LaporanController::index');
$routes->post('laporan/download-seluruh', 'Admin\LaporanController::download_all');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
