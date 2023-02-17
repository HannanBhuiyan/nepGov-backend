<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CrimeController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\CrimeQuestionController;
use App\Http\Controllers\QuestionOptionController;
use App\Http\Controllers\PollingCategoryController;
use App\Http\Controllers\PollingNormalController;
use App\Http\Controllers\PollingQuestionController;
use App\Http\Controllers\PollingSubCategoryController;

Route::group(['middleware'=>['auth']],function(){
    // crime route
    Route::resource('crime', CrimeController::class);
    Route::get('crimes/delete/{id}', [CrimeController::class, 'delete'])->name('crime.delete');

    // Polling Category (Live) route
    Route::resource('polling_category', PollingCategoryController::class);
    Route::get('polling_category/delete/{id}', [PollingCategoryController::class, 'delete'])->name('polling_category.delete');
    // Polling Category (Normal) route
    Route::resource('polling_normal', PollingNormalController::class);
    Route::get('polling_normal/delete/{id}', [PollingNormalController::class, 'destroy'])->name('polling_normal.delete');

    // Polling Sub Category route
    Route::resource('polling_sub_cat', PollingSubCategoryController::class);
    Route::get('polling_sub_cat/delete/{id}', [PollingSubCategoryController::class, 'delete'])->name('polling_sub_cat.delete');
    
    // Polling Question route
    Route::resource('polling_question', PollingQuestionController::class);
    Route::post('category/dropdown', [PollingQuestionController::class, 'category_dropdown'])->name('category_dropdown');
    Route::get('polling_question/delete/{id}', [PollingQuestionController::class, 'delete'])->name('polling_question.delete');

    // Polling Category route
    Route::resource('question_option', QuestionOptionController::class);
    Route::get('question_option/delete/{id}', [QuestionOptionController::class, 'delete'])->name('question_option.delete');
    Route::get('questionOption/delete/{id}', [QuestionOptionController::class, 'questionOptionDelete'])->name('questionOption.delete');

    // Crime Question route
    Route::resource('crime_question', CrimeQuestionController::class);
    Route::get('crime_question/delete/{id}', [CrimeQuestionController::class, 'delete'])->name('crime_question.delete');

});


    //login route
    Route::get('/adminLogin',[LoginController::class,'showAdminLoginForm'])->name('adminLogin');
    Route::post('/adminLogin',[LoginController::class,'loginUser']);
    Route::post('/adminLogout',function(){
        Auth::guard('admin')->logout();
        return redirect()->action([LoginController::class, 'showAdminLoginForm']);
    })->name('admin.logout');

    // Route::get('/forgot/password/form',[LoginController::class,'forgot_password_form'])->name('forgot_password_link');
    
    




