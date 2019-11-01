<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:api'])->group(function () {
    /**
     * Companies
     */
    Route::get('/companies', 'CompanyController@list');
    Route::delete('/companies/{id}', 'CompanyController@destroy');

    /**
     * Contacts
     */
    Route::get('/contacts', 'ContactController@list');
    Route::post('/contacts', 'ContactController@store');
    Route::put('/contacts/{contact}', 'ContactController@update');
    Route::delete('/contacts/{contact}', 'ContactController@destroy');

    /**
     * Products
     */
    Route::get('/products', 'ProductController@list');
    Route::get('/products/{id}/price', 'ProductController@getPriceById');
    Route::post('/products', 'ProductController@store');
    Route::put('/products/{product}', 'ProductController@update');
    Route::delete('/products/{product}', 'ProductController@destroy');

    /**
     * Projects
     */
    Route::get('/projects', 'ProjectController@list');
    Route::delete('/projects/{id}', 'ProjectController@destroy');

    /**
     * Quotations
     */
    Route::get('/quotations', 'QuotationController@list');
    Route::delete('/quotations/{id}', 'QuotationController@destroy');

    /**
     * Quotation Product
     */
    Route::get('/quotation-products', 'QuotationProductController@list');
    Route::post('/quotation-products', 'QuotationProductController@store');
    Route::put('/quotation-products/{id}', 'QuotationProductController@update');
    Route::delete('/quotation-products/{id}', 'QuotationProductController@destroy');

    /**
     * Picture
     */
    Route::get('/pictures', 'PictureController@list');
    Route::post('/pictures', 'PictureController@store');
    Route::put('/pictures/{id}', 'PictureController@update');
    Route::delete('/pictures/{id}', 'PictureController@destroy');

    /**
     * Users
     */
    Route::get('/users', 'UserController@list');
    Route::delete('/users/{id}', 'UserController@destroy');
});
