<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\{
    PageController,
    SocialLinkController,
    WebsiteController,
};

Route::group(['middleware'=>['auth']],function(){
//Page Route
Route::resource('page', PageController::class);
Route::get('page/delete/{id}', [PageController::class, 'destroy'])->name('page.delete');

//Social Links Route
Route::resource('social_links', SocialLinkController::class);
Route::get('social_links/delete/{id}', [SocialLinkController::class, 'destroy'])->name('social_links.delete');

//Website Settings Route
Route::resource('settings', WebsiteController::class);
Route::get('settings/delete/{id}', [WebsiteController::class, 'destroy'])->name('settings.delete');
});