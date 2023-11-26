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

$routes->add('/server', 'Server::index');
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

/*
 * --------------------------------------------------------------------
 * Notes
 * --------------------------------------------------------------------
 * 
 * Method post biasa digunakan untuk mengirim data input kedalam controller
 * Method get biasa digunakan untuk mengambil data yang ada didalam controller
 * 
 */


/*
 * --------------------------------------------------------------------
 * c_login Controller
 * --------------------------------------------------------------------
 */


$routes->get('/', 'c_login::index');  // alamat '/' akan mengarahkan ke controller c_login dan masuk ke function index
$routes->post('/login', 'c_login::cekLogin');  // alamat '/login' akan mengarahkan ke controller c_login dan masuk ke function cekLogin dengan method post 
$routes->get('/logout', 'c_login::logout');  // alamat '/logout' akan mengarahkan ke controller c_login dan masuk ke function logout


/*
 * --------------------------------------------------------------------
 * c_dashboard Controller
 * --------------------------------------------------------------------
 */
$routes->get('/dashboard', 'c_dashboard::index'); // alamat '/dashboard' akan mengarahkan ke controller c_dashboard dan masuk ke function index


/*
 * --------------------------------------------------------------------
 * c_kelolauser Controller
 * --------------------------------------------------------------------
 */
$routes->get('/user', 'c_kelolauser::index'); // alamat '/user' akan mengarahkan ke controller c_kelolauser dan masuk ke function index
$routes->get('/user/create', 'c_kelolauser::create'); // alamat '/user/create' akan mengarahkan ke controller c_kelolauser dan masuk ke function create
$routes->post('/user', 'c_kelolauser::save'); // alamat '/user' akan mengarahkan ke controller c_kelolauser dan masuk ke function save dengan method post 
$routes->get('/user/edit/(:any)', 'c_kelolauser::edit/$1'); // alamat '/user/edit/(:any)' akan mengarahkan ke controller c_kelolauser dan masuk ke function edit dengan membawa parameter id user yang di pilih di tabel user
$routes->post('/user/update/(:any)', 'c_kelolauser::update/$1'); // alamat '/user/update/(:any)' akan mengarahkan ke controller c_kelolauser dan masuk ke function update dengan membawa parameter id user yang di pilih di tabel user dan mengirim data inputan untuk di update ke database
$routes->get('/user/delete/(:any)', 'c_kelolauser::delete/$1'); // alamat '/user/delete/(:any)' akan mengarahkan ke controller c_kelolauser dan masuk ke function delete dengan membawa parameter id user yang di pilih di tabel user

/*
 * --------------------------------------------------------------------
 * c_Kelolakategori Controller
 * --------------------------------------------------------------------
 */
$routes->get('/kategori', 'c_Kelolakategori::index'); // alamat '/kategori' akan mengarahkan ke controller c_Kelolakategori dan masuk ke function index
$routes->get('/kategori/create', 'c_Kelolakategori::create'); // alamat '/kategori/create' akan mengarahkan ke controller c_Kelolakategori dan masuk ke function create
$routes->post('/kategori', 'c_Kelolakategori::save'); // alamat '/kategori' akan mengarahkan ke controller c_Kelolakategori dan masuk ke function save dengan method post 
$routes->get('/kategori/edit/(:any)', 'c_Kelolakategori::edit/$1'); // alamat '/kategori/edit/(:any)' akan mengarahkan ke controller c_Kelolakategori dan masuk ke function edit dengan membawa parameter id kategori yang di pilih di tabel kategori
$routes->post('/kategori/update/(:any)', 'c_Kelolakategori::update/$1'); // alamat '/kategori/update/(:any)' akan mengarahkan ke controller c_Kelolakategori dan masuk ke function update dengan membawa parameter id kategori yang di pilih di tabel kategori dan mengirim data inputan untuk di update ke database
$routes->get('/kategori/delete/(:any)', 'c_Kelolakategori::delete/$1'); // alamat '/kategori/delete/(:any)' akan mengarahkan ke controller c_Kelolakategori dan masuk ke function delete dengan membawa parameter id kategori yang di pilih di tabel pengajuan


/*
 * --------------------------------------------------------------------
 * c_livechat Controller
 * --------------------------------------------------------------------
 */

$routes->get('/livechat', 'c_livechat::index'); // alamat '/livechat' akan mengarahkan ke controller c_livechat dan masuk ke function index
$routes->get('/livechat/create', 'c_livechat::create'); // alamat '/livechat/create' akan mengarahkan ke controller c_livechat dan masuk ke function create
$routes->post('/livechat', 'c_livechat::save'); // alamat '/livechat' akan mengarahkan ke controller c_livechat dan masuk ke function save dengan method post 
$routes->get('/livechat/selesai/(:any)', 'c_livechat::selesai/$1'); // alamat '/livechat/selesai/(:any)' akan mengarahkan ke controller c_livechat dan masuk ke function edit dengan membawa parameter id livechat yang di pilih di tabel livechat
$routes->get('/livechat/detail/(:any)', 'c_livechat::detail/$1'); // alamat '/livechat/detail/(:any)' akan mengarahkan ke controller c_livechat dan masuk ke function edit dengan membawa parameter id livechat yang di pilih di tabel livechat
$routes->get('/livechat/edit/(:any)', 'c_livechat::edit/$1'); // alamat '/livechat/edit/(:any)' akan mengarahkan ke controller c_livechat dan masuk ke function edit dengan membawa parameter id livechat yang di pilih di tabel livechat
$routes->post('/livechat/update/(:any)', 'c_livechat::update/$1'); // alamat '/livechat/update/(:any)' akan mengarahkan ke controller c_livechat dan masuk ke function update dengan membawa parameter id livechat yang di pilih di tabel livechat dan mengirim data inputan untuk di update ke database
$routes->get('/livechat/delete/(:any)', 'c_livechat::delete/$1'); // alamat '/livechat/delete/(:any)' akan mengarahkan ke controller c_livechat dan masuk ke function delete dengan membawa parameter id livechat yang di pilih di tabel livechat

/*
 * --------------------------------------------------------------------
 * Server Controller
 * --------------------------------------------------------------------
 */

$routes->get('/server', 'Server::index'); // alamat '/server' akan mengarahkan ke controller Server dan masuk ke function index


/*
 * --------------------------------------------------------------------
 * c_laporan Controller
 * --------------------------------------------------------------------
 */

 $routes->get('/laporan', 'c_laporan::index'); // alamat '/livechat' akan mengarahkan ke controller c_laporan dan masuk ke function index
 

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
