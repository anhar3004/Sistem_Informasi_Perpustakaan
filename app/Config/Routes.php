<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Dashboard::index');
$routes->get('/','\App\Controllers\Dashboard\Dashboard::index');

// Data Buku
$routes->get('/data_buku','\App\Controllers\Referensi\Buku\Buku::index');
$routes->post('/data_buku/lists','\App\Controllers\Referensi\Buku\Buku::lists');
$routes->get('/data_buku/add', '\App\Controllers\Referensi\Buku\Buku::form');
$routes->post('/data_buku/add', '\App\Controllers\Referensi\Buku\Buku::form');
$routes->get('/data_buku/edit/(:any)', '\App\Controllers\Referensi\Buku\Buku::form/$1');
$routes->post('/data_buku/edit/(:any)', '\App\Controllers\Referensi\Buku\Buku::form/$1');
$routes->get('/data_buku/delete/(:any)', '\App\Controllers\Referensi\Buku\Buku::delete/$1');

// Data Anggota
$routes->get('/data_anggota','\App\Controllers\Referensi\Anggota\Anggota::index');
$routes->post('/data_anggota/lists','\App\Controllers\Referensi\Anggota\Anggota::lists');
$routes->get('/data_anggota/add', '\App\Controllers\Referensi\Anggota\Anggota::form');
$routes->post('/data_anggota/add', '\App\Controllers\Referensi\Anggota\Anggota::form');
$routes->get('/data_anggota/edit/(:any)', '\App\Controllers\Referensi\Anggota\Anggota::form/$1');
$routes->post('/data_anggota/edit/(:any)', '\App\Controllers\Referensi\Anggota\Anggota::form/$1');
$routes->get('/data_anggota/delete/(:any)', '\App\Controllers\Referensi\Anggota\Anggota::delete/$1');

// Data Transaksi
$routes->get('/transaksi','\App\Controllers\Transaksi\DataTransaksi::index');
$routes->post('/transaksi/lists','\App\Controllers\Transaksi\DataTransaksi::lists');
$routes->get('/transaksi/add', '\App\Controllers\Transaksi\DataTransaksi::form');
$routes->post('/transaksi/add', '\App\Controllers\Transaksi\DataTransaksi::form');
$routes->get('/transaksi/edit/(:any)', '\App\Controllers\Transaksi\DataTransaksi::form/$1');
$routes->post('/transaksi/edit/(:any)', '\App\Controllers\Transaksi\DataTransaksi::form/$1');
$routes->get('/transaksi/delete/(:any)', '\App\Controllers\Transaksi\DataTransaksi::delete/$1');
$routes->get('/transaksi/update-status/(:any)/(:any)', '\App\Controllers\Transaksi\DataTransaksi::upateStatus/$1/$2');

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
