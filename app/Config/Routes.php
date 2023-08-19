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
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

//autentifikasi
$routes->get('/Login', 'Auth\Login::index');
$routes->get('/Logout', 'Auth\Login::logout');
$routes->get('/Reg-User', 'Auth\Register::user');
$routes->post('/Create_user', 'Auth\Register::reg_user');
$routes->get('/Reg-Pemilik', 'Auth\Register::pemilik');
$routes->post('/Create_pemilik', 'Auth\Register::reg_pemilik');
$routes->post('/Ceklogin', 'Auth\Login::cek_login');

// end autentifikasi

//kelola kosan
$routes->get('/Kelola-Kos', 'Page\Kelola_kosan::index');
$routes->get('/datatabel_kelolakos', 'Page\Kelola_kosan::ambildata');
$routes->post('/datatabel_getdatakos', 'Page\Kelola_kosan::listdata');
$routes->post('/Tambah_Kosan', 'Page\Kelola_kosan::insert_kosan');
$routes->get('/Detail/(:any)', 'Page\Kosan::detail/$1');
$routes->post('/Search_kosan', 'Page\Kelola_kosan::search');
$routes->get('/Lihat_Kosan', 'Page\Kelola_kosan::lihat');
$routes->post('/Hapus', 'Page\Kelola_kosan::hapus');
//end kelola kosan

//star pesanan
$routes->post('/Create_pesanan', 'Page\Kelola_pesanan::insert_pesanan');
//end pesanan

//pesanan kosan user

$routes->get('/Pesanan_kosan', 'Page\Kelola_pesanan::index');
$routes->get('/datatabel_kelolapesanan', 'Page\Kelola_pesanan::ambildata');
$routes->post('/datatabel_getdatapesanan', 'Page\Kelola_pesanan::listdata');
//end pesanan kosan user

//datatable pesanan
$routes->get('/Pesanan', 'Page\Pesanan::index');
$routes->get('/datatabel_pesanan', 'Page\Pesanan::ambildata');
$routes->post('/datatabel_getpesanan', 'Page\Pesanan::listdata');
$routes->post('/Update_pesanan', 'Page\Pesanan::update');
$routes->post('/Update_status_pesanan', 'Page\Pesanan::update');
//edn datatabel pesanan


//datatable pemilik
$routes->get('/Pemilik', 'Page\Pemilik::index');
$routes->get('/datatabel_pemilik', 'Page\Pemilik::ambildata');
$routes->post('/datatabel_getdatapemilik', 'Page\Pemilik::listdata');
$routes->post('/Update_status_akun', 'Page\Pemilik::update');

// end datatablepemilik

//datatable user
$routes->get('/User', 'Page\User::index');
$routes->get('/datatabel_user', 'Page\User::ambildata');
$routes->post('/datatabel_getdatauser', 'Page\User::listdata');

// end datatableuser
//datatable admin
$routes->get('/Admin', 'Page\Admin::index');
$routes->get('/datatabel_admin', 'Page\Admin::ambildata');
$routes->post('/datatabel_getdataadmin', 'Page\Admin::listdata');
$routes->post('/Create_admin', 'Page\Admin::create_admin');

// end datatableadmin
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
