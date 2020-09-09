<?php

namespace Config;

/**
 * --------------------------------------------------------------------
 * URI Routing
 * --------------------------------------------------------------------
 * This file lets you re-map URI requests to specific controller functions.
 *
 * Typically there is a one-to-one relationship between a URL string
 * and its corresponding controller class/method. The segments in a
 * URL normally follow this pattern:
 *
 *    example.com/class/method/id
 *
 * In some instances, however, you may want to remap this relationship
 * so that a different class/function is called than the one
 * corresponding to the URL.
 */

// Create a new instance of our RouteCollection class.
$routes = Services::routes(true);

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 * The RouteCollection object allows you to modify the way that the
 * Router works, by acting as a holder for it's configuration settings.
 * The following methods can be called on the object to modify
 * the default operations.
 *
 *    $routes->defaultNamespace()
 *
 * Modifies the namespace that is added to a controller if it doesn't
 * already have one. By default this is the global namespace (\).
 *
 *    $routes->defaultController()
 *
 * Changes the name of the class used as a controller when the route
 * points to a folder instead of a class.
 *
 *    $routes->defaultMethod()
 *
 * Assigns the method inside the controller that is ran when the
 * Router is unable to determine the appropriate method to run.
 *
 *    $routes->setAutoRoute()
 *
 * Determines whether the Router will attempt to match URIs to
 * Controllers when no specific route has been defined. If false,
 * only routes that have been defined here will be available.
 */
// $routes->setDefaultNamespace( 'App\Controllers\Main');
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('BaseController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override('\App\Controllers\BaseController::error404');
$routes->setAutoRoute(false);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */
$routes->get('/', 'basecontroller::default');

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// LOGIN
$routes->get('/login', 'Auth::index', ['namespace' => 'App\Controllers\Main']);
$routes->post('auth/login', 'Auth::index', ['namespace' => 'App\Controllers\AJAX']);
$routes->get('/auth/logout', 'Auth::logout', ['namespace' => 'App\Controllers\AJAX']);

// USERT MANAGEMENT

// USER
$routes->get('/home/admin', 'User::admin', ['namespace' => 'App\Controllers\Main', 'role' => 3, 'ajax' => false]);
$routes->get('/home/pegawai', 'User::pegawai', ['namespace' => 'App\Controllers\Main', 'role' => 1, 'ajax' => false]);
$routes->get('/user', 'User::index', ['namespace' => 'App\Controllers\Main', 'role' => 3, 'ajax' => false]);
$routes->get('/user/tambah', 'User::tambah', ['namespace' => 'App\Controllers\Main', 'role' => 3, 'ajax' => false]);
$routes->get('/user/getUser', 'User::index', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/user/insertData', 'User::insertData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/user/getDetail/(:num)', 'User::getDetail/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1, 2, 3], 'ajax' => true]);
$routes->post('/user/updateData/(:num)', 'User::updateData/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1, 2, 3], 'ajax' => true]);

// PEGAWAI
$routes->get('/pegawai', 'Pegawai::index', ['namespace' => 'App\Controllers\Main', 'role' => 3, 'ajax' => false]);
$routes->get('/pegawai/tambah', 'Pegawai::tambah', ['namespace' => 'App\Controllers\Main', 'role' => 3, 'ajax' => false]);
$routes->get('/pegawai/lastInsert', 'Pegawai::lastInsert', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/pegawai/deleteLastInsert', 'Pegawai::deleteLastInsert', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/pegawai/getPegawai/(:num)', 'Pegawai::index/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/pegawai/insertData', 'Pegawai::insertData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/pegawai/lastInsertRole', 'Pegawai::lastInsertRole', ['namespace' => 'App\Controllers\AJAX', 'role' => [1, 2, 3], 'ajax' => true]);
$routes->get('/pegawai/getDetail/(:num)', 'Pegawai::getDetail/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1, 2, 3], 'ajax' => true]);
$routes->post('/pegawai/updateData/(:num)', 'Pegawai::updateData/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1, 2, 3], 'ajax' => true]);
$routes->get('/pegawai/detailMutasi/(:num)', 'Pegawai::detailMutasi/$1', ['namespace' => 'App\Controllers\Main', 'role' => [1, 3], 'ajax' => false]);
$routes->get('/pegawai/detailSKP/(:num)', 'Pegawai::detailSKP/$1', ['namespace' => 'App\Controllers\Main', 'role' => [1, 3], 'ajax' => false]);
$routes->get('/pegawai/pensiun', 'Pegawai::pensiun', ['namespace' => 'App\Controllers\Main', 'role' => 3, 'ajax' => true]);
$routes->get('/pegawai/getdataPensiun', 'Pegawai::getdataPensiun', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);

// PANGKAT
$routes->get('/pangkat', 'Pangkat::index', ['namespace' => 'App\Controllers\Main', 'role' => 3, 'ajax' => false]);
$routes->get('/pangkat/getPangkat', 'Pangkat::index', ['namespace' => 'App\Controllers\AJAX', 'role' => [1, 3], 'ajax' => true]);
$routes->get('/pangkat/getDataPangkat', 'Pangkat::getDataPangkat', ['namespace' => 'App\Controllers\AJAX', 'role' => [1, 3], 'ajax' => true]);
$routes->get('/pangkat/tambah', 'Pangkat::tambah', ['namespace' => 'App\Controllers\Main', 'role' => 3, 'ajax' => false]);
$routes->post('/pangkat/insertData', 'Pangkat::insertData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/pangkat/getDetailPangkat/(:num)', 'Pangkat::getDetailPangkat/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/pangkat/updateData/(:num)', 'Pangkat::updateData/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/pangkat/deletePangkat', 'Pangkat::deletePangkat/', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);

// JABATAN
$routes->get('/jabatan', 'Jabatan::index', ['namespace' => 'App\Controllers\Main', 'role' => 3, 'ajax' => false]);
$routes->get('/jabatan/tambah', 'Jabatan::tambah', ['namespace' => 'App\Controllers\Main', 'role' => 3, 'ajax' => false]);
$routes->post('/jabatan/insertData', 'Jabatan::insertData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/jabatan/updateData/(:num)', 'Jabatan::updateData/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/jabatan/deleteJabatan', 'Jabatan::deleteJabatan', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/jabatan/getJabatan', 'Jabatan::index', ['namespace' => 'App\Controllers\AJAX', 'role' => [1, 3], 'ajax' => true]);
$routes->get('/jabatan/getDetailJabatan/(:num)', 'Jabatan::getDetailJabatan/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);


// MUTASI
$routes->get('/mutasi', 'Mutasi::index', ['namespace' => 'App\Controllers\Main', 'role' => 3, 'ajax' => false]);
$routes->get('/mutasi/tambahMutasi/(:num)/pegawai', 'Mutasi::tambahMutasi/$1', ['namespace' => 'App\Controllers\Main', 'role' => 3, 'ajax' => false]);
$routes->get('/mutasi/tambahMutasi/(:num)/mutasi', 'Mutasi::tambahMutasi/$1', ['namespace' => 'App\Controllers\Main', 'role' => 3, 'ajax' => false]);
$routes->get('/mutasi/tambahMutasi', 'Mutasi::tambahMutasi', ['namespace' => 'App\Controllers\Main', 'role' => 3, 'ajax' => false]);
$routes->get('/mutasi/getSKMutasi', 'Mutasi::index', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/mutasi/(:num)', 'Mutasi::detail/$1', ['namespace' => 'App\Controllers\Main', 'role' => 3, 'ajax' => false]);
$routes->get('/mutasi/tambahSKMutasi', 'Mutasi::tambahSKMutasi', ['namespace' => 'App\Controllers\Main', 'role' => 3, 'ajax' => false]);
$routes->post('/mutasi/insertDataMutasi', 'Mutasi::insertDataMutasi', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/mutasi/deleteMutasi', 'Mutasi::deleteMutasi', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/mutasi/updateDataMutasi/(:num)', 'Mutasi::updateDataMutasi/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/mutasi/getDetailMutasi/(:num)', 'Mutasi::getDetailMutasi/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1, 3], 'ajax' => true]);
$routes->get('/mutasi/getDetailSKMutasi/(:num)', 'Mutasi::getDetailSKMutasi/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/mutasi/getDataMutasi/(:num)', 'Mutasi::getDataMutasi/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/mutasi/getMutasi', 'Mutasi::index', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/mutasi/getDetailSKMutasi/(:num)', 'Mutasi::getDetailSKMutasi/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/mutasi/updateSKMutasi/(:num)', 'Mutasi::updateSKMutasi/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/mutasi/deleteSKMutasi', 'Mutasi::deleteSKMutasi', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/mutasi/insertDataSKMutasi', 'Mutasi::insertDataSKMutasi', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/mutasi/getRiwayatMutasi/(:num)', 'Mutasi::getRiwayatMutasi/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1, 3], 'ajax' => true]);
$routes->get('/mutasi/toExel/(:num)', 'Mutasi::toExel/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1, 3], 'ajax' => true]);

// SKP
$routes->get('/skp/getNameNipPeg', 'Skp::getNameNipPeg', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/skp', 'Skp::index', ['namespace' => 'App\Controllers\Main', 'role' => 3, 'ajax' => false]);
$routes->get('/skp/getTahunSkp', 'Skp::index', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/skp/getSkp/(:num)', 'Skp::getSkp/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/skp/tambah', 'Skp::tambah', ['namespace' => 'App\Controllers\Main', 'role' => 3, 'ajax' => false]);
$routes->post('/skp/insertDataSkp/(:num)', 'Skp::insertDataSkp/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1, 3], 'ajax' => true]);
$routes->get('/skp/getDetail/(:num)', 'Skp::getDetail/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1, 3], 'ajax' => true]);
$routes->get('/skp/getRiwayatSKP/(:num)', 'Skp::getRiwayatSKP/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1, 3], 'ajax' => true]);
$routes->get('/skp/tambah/(:num)', 'Skp::tambah/$1', ['namespace' => 'App\Controllers\Main', 'role' => [1, 3], 'ajax' => true]);
$routes->post('/skp/updateSkp/(:num)', 'Skp::updateSkp/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1, 3], 'ajax' => true]);
$routes->post('/skp/deleteSkp', 'Skp::deleteSkp', ['namespace' => 'App\Controllers\AJAX', 'role' => [1, 3], 'ajax' => true]);
$routes->get('/skp/toExel/(:num)', 'Skp::toExel/$1', ['namespace' => 'App\Controllers\AJAX', 'role' => [1, 3], 'ajax' => true]);



// PENSIUN
// $routes->get('/pensiun/pensiunpegawai', 'Pensiun::insertData', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/pensiun/', 'Pegawai::pensiun', ['namespace' => 'App\Controllers\Main', 'role' => 3, 'ajax' => false]);

//PESAN
$routes->get('/pesan', 'Pesan::index', ['namespace' => 'App\Controllers\Main', 'role' => 3, 'ajax' => false]);
$routes->get('/pesan/getDataPesan', 'Pesan::getDataPesan', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/pesan/sendMessageMutasi', 'Pesan::pesanMutasi', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/pesan/reSend', 'Pesan::reSend', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->post('/pesan/deletePesan', 'Pesan::deletePesan', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/pesan/pensiunpegawai', 'Pesan::pesanPensiun', ['namespace' => 'App\Controllers\AJAX', 'role' => [1, 3], 'ajax' => true]);

//Dashboard
$routes->get('/pegawai/getLengthPeg', 'Pegawai::getLengthPeg', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/pegawai/getLengthPesan', 'Pegawai::getLengthPesan', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/pegawai/getChartPensiun', 'Pegawai::getChartPensiun', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);
$routes->get('/pegawai/getChartSkp', 'Pegawai::getChartSkp', ['namespace' => 'App\Controllers\AJAX', 'role' => 3, 'ajax' => true]);


$routes->get('/autoSend', 'AutoSend::index', ['namespace' => 'App\Controllers\AJAX']);
/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}