<?php

// use App\Http\Controllers\AdminAuth\LoginController;

use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\backend\{
    PageController,
    ProfileController,
    CategoryController,
    NewsController
};
use App\Http\Controllers\GroupUserController;
use App\Http\Controllers\NormalVotingController;
use App\Models\GroupUser;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Auth::routes();

Route::group(['middleware'=>['auth']],function(){
    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

    // Users Lists 
    Route::get('/users/list', [HomeController::class, 'users_list'])->name('user.index');
    
    Route::get('user/delete/{id}', [HomeController::class, 'delete'])->name('user.delete');
    Route::post('assign/user/group', [GroupUserController::class, 'assign_users_group'])->name('assign_users_group');
    Route::get('group/users', [GroupUserController::class, 'group_users'])->name('user.group');
    Route::post('create/new/group', [GroupUserController::class, 'create_new_group'])->name('create_new_group');

    Route::post('/group/wise/user', [GroupUserController::class, 'groupwiseuser'])->name('groupwiseuser');
    Route::post('/send/Mail/To/Users', [GroupUserController::class, 'sendMailToUsers'])->name('sendMailToUsers');
    
    // profile route
    Route::get('/profile', [ProfileController::class, 'profile_index'])->name('profile.index');
    Route::post('/profile/image', [ProfileController::class, 'update_image'])->name('profile.image.update');
    Route::post('/profile/password/change', [ProfileController::class, 'profile_password_change'])->name('profile.password.change');
    Route::post('/profile/edit', [ProfileController::class, 'edit_profile'])->name('profile.edit');
    
    //  category route
    Route::resource('category', CategoryController::class);
    Route::get('category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    
    // news route
    Route::resource('news', NewsController::class);
    Route::get('news/delete/{id}', [NewsController::class, 'delete'])->name('news.delete');


    Route::post('/multi_email_offer', [HomeController::class, 'multi_email_offer'])->name('multi_email_offer');

    // Voting Normal route
    Route::resource('normal_voting', NormalVotingController::class);
    Route::get('normal_voting/delete/{id}', [NormalVotingController::class, 'destroy'])->name('normal_voting.delete');

});

Route::post('/category/wise/news', [NewsController::class, 'category_wise_news'])->name('category.wise.news');

Route::get('/normal/voting/by/user', [NormalVotingController::class, 'normalVotingByUser'])->name('normalVotingByUser');

Route::get('/',function(){
    return redirect("/adminLogin");
});
Route::get('/login',function(){
    return redirect("/adminLogin");
});
Route::get('/register',function(){
    return redirect("/adminLogin");
});

// Route::get('/download', function(){
//     return response()->download(resource_path(view('layouts.backend.news.news-index',[
//         'news' => \App\Models\News::all()
//     ])));
// })->name('download');