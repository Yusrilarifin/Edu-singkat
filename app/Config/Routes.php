<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// --------------------------------------------------------------------
// Load the system’s routing file first, so that the app and ENV
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

// --------------------------------------------------------------------
// Router Setup
// --------------------------------------------------------------------
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('login');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// Disable auto-routing for security; uncomment if you need it.
// $routes->setAutoRoute(true);

// --------------------------------------------------------------------
// Route Definitions
// --------------------------------------------------------------------


// Di luar group auth/admin
use App\Models\MateriModel;

$routes->get('/', function(){
    $model = new MateriModel();
    $data['materiList'] = $model
        ->orderBy('created_at', 'DESC')
        ->findAll();
    return view('index', $data);
});

// Detail materi (lihat full content)
$routes->get('materi/(:num)', 'Materi::show/$1');


$routes->get('login',           'Auth::login');
$routes->post('login',          'Auth::loginPost');
$routes->get('register',        'Auth::register');
$routes->post('register',       'Auth::registerPost');
$routes->get('logout',          'Auth::logout');

// Routes for authenticated users
$routes->group('', ['filter' => 'auth'], static function($routes){
    // Materi CRUD
    $routes->get('materi',                'Materi::index');
    $routes->get('materi/create',         'Materi::create');
    $routes->post('materi/store',         'Materi::store');
    $routes->get('materi/edit/(:num)',    'Materi::edit/$1');
    $routes->post('materi/update/(:num)', 'Materi::update/$1');
    $routes->get('materi/delete/(:num)',  'Materi::delete/$1');

    // Bisa ditambah edit/update/delete sesuai kebutuhan
});

// Routes for admin-only (gunakan AdminFilter)
$routes->group('admin', ['filter' => 'admin'], static function($routes){
    // Halaman approval
    $routes->get('approval',              'Admin::approval');
    // Proses approve/reject, parameter = ID materi
    $routes->post('approve/(:num)',       'Admin::approve/$1');
    $routes->post('reject/(:num)',        'Admin::reject/$1');
});

// --------------------------------------------------------------------
// Additional Routing
// --------------------------------------------------------------------
// You can load additional route files here (e.g. for environments):
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
