<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['check-installer']], function () {
    //logout
    Route::get('/landing', 'User\HomeController@home')->name('home');
    //userSignUp
    Route::get('/signup/{code?}', 'AuthController@userSignUp')->name('userSignUp')->middleware('registration');
    Route::post('/save', 'AuthController@userSave')->name('userSave');

    //userLogin
    Route::get('/signin', 'AuthController@userSignIn')->name('login');
    Route::post('/postsignin', 'AuthController@loginProcess')->name('loginProcess');
    Route::get('verify-{verification_code}', 'AuthController@verifyEmail')->name('verifyEmail');

    //forgot password
    Route::get('forget-password', 'AuthController@forgetPassword')->name('forgetPassword');
    Route::post('forget-password-process', 'AuthController@forgetPasswordProcess')->name('forgetPasswordProcess');
    Route::get('forget-password-change/{reset_code}',
        'AuthController@forgetPasswordChange')->name('forgetPasswordChange');
    Route::get('forget-password-reset', 'AuthController@forgetPasswordReset')->name('forgetPasswordReset');
    Route::post('forget-password-reset-process/{reset_code}',
        'AuthController@forgetPasswordResetProcess')->name('forgetPasswordResetProcess');
    Route::get('privacy-and-policy', 'AuthController@privacyPolicy')->name('privacyPolicy');
    Route::get('terms-and-conditions', 'AuthController@termsCondition')->name('termsCondition');

    require base_path('routes/link/admin.php');
    require base_path('routes/link/user.php');

    Route::group(['middleware' => ['auth']], function () {
        //logout
        Route::get('/logout', 'AuthController@logout')->name('logOut');
    });
});
Route::group(['namespace' => 'Web'], function () {

    Route::get('/', 'IndexController@index')->name('web.home');

    Route::get('/about', function () {
        return view('web.about');
    })->name('web.about');

    Route::get('/courses', function () {
        return view('web.courses');
    })->name('web.courses');

    Route::get('/blog', function () {
        return view('web.blog');
    })->name('web.blog');

    Route::get('/contact', function () {
        return view('web.contact');
    })->name('web.contact');
});


Route::get('generator_builder',
    '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('io_generator_builder');

Route::get('field_template',
    '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate')->name('io_field_template');

Route::get('relation_field_template',
    '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate')->name('io_relation_field_template');

Route::post('generator_builder/generate',
    '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate')->name('io_generator_builder_generate');

Route::post('generator_builder/rollback',
    '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback')->name('io_generator_builder_rollback');

Route::post(
    'generator_builder/generate-from-file',
    '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile'
)->name('io_generator_builder_generate_from_file');

Route::get('generator_builder',
    '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('io_generator_builder');

Route::get('field_template',
    '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate')->name('io_field_template');

Route::get('relation_field_template',
    '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate')->name('io_relation_field_template');

Route::post('generator_builder/generate',
    '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate')->name('io_generator_builder_generate');

Route::post('generator_builder/rollback',
    '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback')->name('io_generator_builder_rollback');

Route::post(
    'generator_builder/generate-from-file',
    '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile'
)->name('io_generator_builder_generate_from_file');
