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

// Log in
$router->get('/signin', 'LoginController@getUser');
$router->post('/signup', 'LoginController@store');

// Inventory
$router->get('/getInventory', 'InventoryController@all');
$router->get('/send', 'InventoryController@send');

// Company
$router->get('/getCompanies', 'CompanyController@all');
$router->post('/createCompany', 'CompanyController@store');
$router->put('/deleteCompany', 'CompanyController@delete');

// Product
$router->get('/getProducts', 'ProductController@all');
$router->post('/createProduct', 'ProductController@store');
$router->put('/deleteProduct', 'ProductController@delete');

// Country
$router->get('/getCountries', 'CountryController@all');


// Category
$router->get('/getCategories', 'CategoryController@all');

// Order
