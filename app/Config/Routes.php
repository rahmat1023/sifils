<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
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
$routes->get('/', 'Home::index');
$routes->get('users', 'Users::index');
$routes->get('users/add', 'Users::create');
$routes->get('changepass', 'Users::changepass');
$routes->post('updatepass/(:num)', 'Users::updatepass/$1');
$routes->get('users/edit/(:num)', 'Users::edit/$1');
$routes->get('users/remove/(:num)', 'Users::remove/$1');
$routes->get('users/status/(:num)', 'Users::status/$1');
$routes->post('users', 'Users::store');
$routes->put('users/(:num)', 'Users::update/$1');
$routes->get('availability', 'Room::availability');
$routes->get('login', 'Auth::login');
$routes->get('inputnim', 'Auth::inputnim');
$routes->post('inputnim', 'Auth::inputnimprocess');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::registerprocess');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::loginProcess');
$routes->get('logout', 'Auth::logout');
$routes->get('surat/masuk', 'Surat::masuk');
$routes->get('surat/masuk/add', 'Surat::addmasuk');
$routes->post('surat/insertmasuk', 'Surat::insertmasuk');
$routes->get('surat/masuk/delete/(:num)', 'Surat::deletemasuk/$1');
$routes->get('surat/masuk/edit/(:num)', 'Surat::editmasuk/$1');
$routes->post('surat/masuk/update/(:num)', 'Surat::updatemasuk/$1');
$routes->get('surat/keluar', 'Surat::keluar');
$routes->get('surat/keluar/invoice/(:num)', 'Surat::invoicekeluar/$1');
$routes->get('surat/keluar/edit/(:num)', 'Surat::editkeluar/$1');
$routes->get('surat/keluar/upload/(:num)', 'Surat::uploadkeluar/$1');
$routes->post('surat/keluar/upload/(:num)', 'Surat::processuploadkeluar/$1');
$routes->get('surat/keluar/delete/(:num)', 'Surat::deletekeluar/$1');
$routes->post('surat/insertkeluar', 'Surat::insertkeluar');
$routes->post('surat/updatekeluar/(:num)', 'Surat::updatekeluar/$1');
$routes->post('surat/insertbooking', 'Surat::insertbooking');
$routes->get('surat/keluar/add', 'Surat::addkeluar');
$routes->get('surat/keluar/booking', 'Surat::booking');
$routes->get('pengesah/status/(:num)', 'PengesahSurat::status/$1');
$routes->get('room/index', 'Room::index');
$routes->get('room/edit/(:num)', 'Room::edit/$1');
$routes->get('room/copybooking/(:num)', 'Room::copybooking/$1');
$routes->post('room/insert', 'Room::insert');
$routes->post('room/delete/(:num)', 'Room::delete/$1');
$routes->post('room/update/(:num)', 'Room::update/$1');
$routes->post('room/reject', 'Room::reject');
$routes->get('room/accept/(:num)', 'Room::accept/$1');
$routes->get('room/uploadbalasan/(:num)', 'Room::uploadbalasan/$1');
$routes->post('room/uploadbalasan/(:num)', 'Room::postuploadbalasan/$1');
$routes->post('room/verifikasi', 'Room::verifikasi');
$routes->post('room/verifikasiToken', 'Room::verifikasiToken');
$routes->get('room/booking', 'Room::booking');
$routes->get('room/bookinglist', 'Room::bookinglist');
$routes->get('room/bookingsuccess', 'Room::bookingsuccess');
$routes->get('room/availability', 'Room::availability');
$routes->get('confirmguestbooking', 'Room::confirmguestbooking');
$routes->get('booking', 'Room::guestbooking');
$routes->post('checkroom', 'Room::checkRoomAvailability');
$routes->get('cekstatus', 'Room::cekStatus');
$routes->post('checkstatus', 'Room::checkStatus');
$routes->get('mahasiswa', 'Mahasiswa::index');
$routes->get('mahasiswa/add', 'Mahasiswa::add');
$routes->post('mahasiswa/insert', 'Mahasiswa::insert');
$routes->get('mahasiswa/edit/(:num)', 'Mahasiswa::edit/$1');
$routes->post('mahasiswa/update/(:num)', 'Mahasiswa::update/$1');

$routes->presenter('unit', ['filters' => 'isAdmin']);
$routes->presenter('ruang', ['filters' => 'isAdmin']);
$routes->presenter('jenissurat', ['filters' => 'isAdmin']);
$routes->presenter('perihalsurat', ['filters' => 'isAdmin']);
$routes->presenter('pengesahsurat', ['filters' => 'isAdmin']);

// $routes->get('unit/new', 'Unit::new');
// $routes->post('unit', 'Unit::create');
// $routes->get('unit', 'Unit::index');
// $routes->get('unit/(:segment)', 'Unit::show/$1');
// $routes->get('unit/(:segment)/edit', 'Unit::edit/$1');
// $routes->put('unit/(:segment)', 'Unit::update/$1');
// $routes->patch('unit/(:segment)', 'Unit::update/$1');
// $routes->delete('unit/(:segment)', 'Unit::delete/$1');

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
