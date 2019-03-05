<?php
/////////////for forgot password /////////////
Route::get('password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request'); 
Route::get('password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('password.reset'); 
Route::post('password/reset','Auth\ResetPasswordController@reset')->name('password.update'); 
Route::post('password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
///////////////////////////////////////////////

//////////////// Admin ////////////
Route::prefix('admin')->group(function () {
    Route::get('/login','Admin\LoginController@showLoginPage')->name('admin_login_get');
    Route::post('/login','Admin\LoginController@login')->name('admin_login');
    Route::post('/logout','Admin\LoginController@logout')->name('admin_logout');

    Route::middleware(['auth'])->group(function () {

        Route::get('/dashboard','Admin\ProductController@index')->name('admin_dashboard');
        Route::get('/products','Admin\ProductController@showProductsPage');
        Route::get('/products/table','Admin\ProductController@dashboardTable')->name('get_data');
        ////////////////add product/////////////
        Route::get('/add','Admin\ProductController@showAddProductPage');
        Route::post('/add','Admin\ProductController@addProduct')->name('add_product');
        //////add category ////////////
        Route::get('add/category','Admin\CategoryController@showAddCategoryPage');
        Route::post('add/category','Admin\CategoryController@addCategory')->name('add_category');
        /////////edit categories///////
        Route::get('edit/categories','Admin\CategoryController@showCategoriesPage');
        Route::get('edit/categories/table','Admin\CategoryController@categoriesTable');
        Route::get('edit/category/{slug?}/{category_id?}','Admin\CategoryController@showEditCategoriesPage');
        Route::post('edit/category','Admin\CategoryController@editCategory')->name('edit_category');
        ///////delete product//////////
        Route::post('delete','Admin\ProductController@deleteProduct')->name('delete_product');
        //////////edit product/////////////
        Route::get('edit/{slug?}','Admin\ProductController@showEditProductPage');
        Route::post('edit','Admin\ProductController@editProduct')->name('edit_product');
        /////////////////////Edit page content ////////////
        Route::get('/configurations','Admin\IndexController@showConfigurationsPage');
        Route::post('/configurations','Admin\IndexController@editConfigurations')->name('edit_configuration');
    });
});
//////////////////////////

////////////public routes///////////////////////
Route::get('/new','ProductController@index')->name('home');
Route::get('/','ProductController@index')->name('home');
Route::get('/contact','ContactUsController@contactPage');
Route::post('/contact','ContactUsController@sendEmail')->name('send_message');

Route::get('/privacy',function() {
    return view('privacy-policy');
});

Route::get('/about',function() {
    return view('about');
});

Route::post('/search','ProductController@search');
Route::get('/asin/{asin}','ProductController@getProducts');
Route::get('/{slug}','ProductController@getCategory');

//////////////////////////////






