<?php

Route::get('/', function () {
    return view('welcome');
});


Route::get('/tentang-kami', function () {
    return view('tentangKami');
});


Auth::routes();

Route::middleware('auth')->prefix('manage')->group(function () {
    Route::get('/', 'HomeController@index')->name('manage');
    Route::resource('companies', 'CompanyController')->except(['destroy', 'edit']);
    Route::resource('contacts', 'ContactController')->except(['destroy', 'edit']);
    Route::resource('products', 'ProductController')->except(['destroy', 'edit']);
    Route::resource('product-prices', 'ProductPriceController')->except(['destroy', 'edit']);
    Route::resource('projects', 'ProjectController')->except(['destroy', 'edit']);
    Route::resource('quotations', 'QuotationController')->except(['destroy', 'edit']);
    Route::get('/quotations/{id}/pdf', 'QuotationController@createPdf');
    Route::post('/quotations/{id}/pdf', 'QuotationController@generatePdf');
    Route::resource('quotation-products', 'QuotationProductController')->except(['destroy', 'edit']);
    Route::resource('users', 'UserController')->except(['destroy', 'edit']);
});
