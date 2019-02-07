<?php 

Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],function ()
    {

        // Dashboard Routes 
        Route::prefix('dashboard')->name('dashboard.')->group(function () {
            Route::get('/index', 'DashboardController@index')->name('index');        
            
            // Admins Routes
            Route::resource('admins', 'AdminController')->except(['show']);

            // Counrties Routes
            Route::resource('countries', 'CountriesController')->except(['show']);
        });


    }
);
