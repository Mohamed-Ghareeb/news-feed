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
                // Counrties Routes
                Route::resource('countries', 'CountriesController')->except(['show']);
                // Cities Routes    
                Route::resource('cities', 'CitiesController')->except(['show']);
                // Categories Routes    
                Route::resource('categories', 'CategoriesController')->except(['show']);
                // Posts Routes    
                Route::resource('posts', 'PostsController')->except(['show']);
                Route::get('/posts/single-post/{id}', 'PostsController@single')->name('posts.single');
                // Plans Routes    
                Route::resource('plans', 'PlansController')->except(['show']);
            });
            
        });
        


    }
);
