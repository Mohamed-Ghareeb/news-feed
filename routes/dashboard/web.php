<?php 

Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],function ()
    {

        // Dashboard Routes 
        Config::set('auth.defines', 'admin');
        Route::prefix('dashboard')->name('dashboard.')->group(function () {

            Route::get('login', 'DashboardController@login')->name('login');        
            Route::post('login', 'DashboardController@do_login')->name('do_login');        
            
            Route::middleware(['admin:admin'])->group(function () {
            
                Route::get('/index', 'DashboardController@index')->name('index');        
                
                // Admins Routes
                Route::resource('admins', 'AdminController')->except(['show']);
                Route::get('/admins/all_trashed', 'AdminController@all_trashed')->name('admins.all_trashed');
                Route::get('/admins/restore/{id}', 'AdminController@restore')->name('admins.restore');
                Route::delete('/admins/delete/{id}', 'AdminController@delete')->name('admins.delete');

                // Counrties Routes
                Route::resource('countries', 'CountriesController')->except(['show']);
                Route::get('/countries/all_trashed', 'CountriesController@all_trashed')->name('countries.all_trashed');
                Route::get('/countries/restore/{id}', 'CountriesController@restore')->name('countries.restore');
                Route::delete('/countries/delete/{id}', 'CountriesController@delete')->name('countries.delete');
                // Cities Routes    
                Route::resource('cities', 'CitiesController')->except(['show']);
                Route::get('/cities/all_trashed', 'CitiesController@all_trashed')->name('cities.all_trashed');
                Route::get('/cities/restore/{id}', 'CitiesController@restore')->name('cities.restore');
                Route::delete('/cities/delete/{id}', 'CitiesController@delete')->name('cities.delete');
                // Categories Routes    
                Route::resource('categories', 'CategoriesController')->except(['show']);
                Route::get('/categories/all_trashed', 'CategoriesController@all_trashed')->name('categories.all_trashed');
                Route::get('/categories/restore/{id}', 'CategoriesController@restore')->name('categories.restore');
                Route::delete('/categories/delete/{id}', 'CategoriesController@delete')->name('categories.delete');
                // Posts Routes    
                Route::resource('posts', 'PostsController')->except(['show']);
                Route::get('/posts/single-post/{id}', 'PostsController@single')->name('posts.single');
                // Plans Routes    
                Route::resource('plans', 'PlansController')->except(['show']);
                Route::get('/plans/all_trashed', 'PlansController@all_trashed')->name('plans.all_trashed');
                Route::get('/plans/restore/{id}', 'PlansController@restore')->name('plans.restore');
                Route::delete('/plans/delete/{id}', 'PlansController@delete')->name('plans.delete');
            });
            
        });
        


    }
);
