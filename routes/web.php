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
Route::get('/','WebController@homepage');

if(env('APP_ENV') == 'live') {
    Route::get('{anyExceptRoot}', function() {
        return redirect('/');
    })->where('anyExceptRoot', '[^/]*');
}

if(env('APP_ENV') != 'live') {
    Route::get('/test-page','WebController@testPage');
    Route::get('/ajax-form','WebController@ajaxForm');
}

Route::get('/landing','WebController@landingPage');

Route::get('/results-page','WebController@resultsPage');

Route::get('/about-us','WebController@aboutUs');

Route::get('/your-rights','WebController@yourRightsPage');

Route::get('/blogs','WebController@blogs');

Route::get('/how-to-use','WebController@howToUsePage');

Route::get('/faqs','WebController@faqsPage');

Route::get('/blogs/category/{categoryId}','WebController@blogCategory');

Route::get('/blog/{id}','WebController@blogItem');

Route::get('/terms-of-use','WebController@termsAndConditionsPage');

Route::get('/privacy-policy','WebController@privacyPage');

Route::get('/cookie-policy','WebController@cookiePage');

Route::get('/attributions','WebController@attributionsPage');

Route::get('/covid','WebController@covidPage');

// Link to download PDFs or other docs
Route::get('/downloads/{file}','WebController@download');

//Route::get('/{slug}', 'WebController@contentPage'); //This replaces all the individual routes
//
//Route::get('/{slug}', function ($slug) {
//
//    // slug other url, subfolders also
//    return view('pages.contentpage')->with(['slug' => $slug]);
//
//})->where('slug', '.*');
