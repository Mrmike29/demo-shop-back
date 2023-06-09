<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// Category
$router->get('/getCategories', 'CategoryController@all');

// Company
$router->get('/getCompanies', 'CompanyController@all');
$router->post('/createCompany', 'CompanyController@store');
$router->put('/deleteCompany', 'CompanyController@delete');

// Country
$router->get('/getCountries', 'CountryController@all');

// Inventory
$router->get('/getInventory', 'InventoryController@all');
$router->post('/send', 'InventoryController@send');

// Log in
$router->get('/signin', 'LoginController@getUser');
$router->post('/signup', 'LoginController@store');

// Inventory
$router->get('/getInventory', 'InventoryController@all');
$router->post('/send', 'InventoryController@send');

// Order
$router->get('/getOrders', 'OrderController@all');
$router->post('/createOrder', 'OrderController@store');

// Product
$router->get('/getProducts', 'ProductController@all');
$router->post('/createProduct', 'ProductController@store');
$router->put('/deleteProduct', 'ProductController@delete');
