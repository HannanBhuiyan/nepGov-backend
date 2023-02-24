<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Api\NewsApiController;
use App\Http\Controllers\Api\PageApiController;
use App\Http\Controllers\Api\CrimeApiController;
use App\Http\Controllers\Api\WebsiteApiController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\backend\ProfileController;
use App\Http\Controllers\Api\SocialLinkApiController;
use App\Http\Controllers\Api\CrimeQuestionApiController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\NormalReviewApiController;
use App\Http\Controllers\Api\PollingReviewApiController;
use App\Http\Controllers\Api\PollingCategoryApiController;
use App\Http\Controllers\Api\PollingQuestionApiController;
use App\Http\Controllers\Api\ProfileApiController;
use App\Http\Controllers\Api\SurvayApiController;
use App\Models\User;

// localhost/post
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//================== api route link

// post method
// http://127.0.0.1:8000/api/login

// post method
// http://127.0.0.1:8000/api/register

// get method with bearer token
// http://127.0.0.1:8000/api/profile

// post method with bearer token
// http://127.0.0.1:8000/api/logout

// post and get method 
// http://127.0.0.1:8000/api/category

// put method 
// http://127.0.0.1:8000/api/category/{id}

// post and get method
// http://127.0.0.1:8000/api/news

// get method
// http://127.0.0.1:8000/api/news/{slug}

// get method for CATEGORY WISE NEWS SEARCH
// http://127.0.0.1:8000/api/category/wise/news/{slug}

// get method for CATEGORY Related NEWS
// http://127.0.0.1:8000/api/related/category/news/{slug}

// get and post method for crime
// http://127.0.0.1:8000/api/crime

// get and post method for crime question
// http://127.0.0.1:8000/api/crime_question


// get and post method for page
// http://127.0.0.1:8000/api/page

// put method
// http://127.0.0.1:8000/api/page/{id}


// get method
// http://127.0.0.1:8000/api/social_links

// put method
// http://127.0.0.1:8000/api/social_links/{id}

// get method
// http://127.0.0.1:8000/api/settings

// put method
// http://127.0.0.1:8000/api/settings/{id}


// get and post method
// http://127.0.0.1:8000/api/polling_category

// get and post method
// http://127.0.0.1:8000/api/polling_question

// put method
// http://127.0.0.1:8000/api/polling_question/{id}

// get and post method
// http://127.0.0.1:8000/api/question_option


// put method
// http://127.0.0.1:8000/api/question_option/{id}

// get and post method
// http://127.0.0.1:8000/api/normal_review


// Polling topics wise questions GET METHOD
// http://127.0.0.1:8000/api/topic/wise/questions/{slug}

// get all topics together GET METHOD
// http://127.0.0.1:8000/api/all/topics

// get the no of votes after voting a question POST METHOD 
// http://127.0.0.1:8000/api/polling_review

// profile update route
// get method  
// http://127.0.0.1:8000/api/user
// get method  
// http://127.0.0.1:8000/api/profile
// post method  
// http://127.0.0.1:8000/api/profile/image
// post method  
// http://127.0.0.1:8000/api/profile/password/change
// post method  
// http://127.0.0.1:8000/api/profile/edit

// post method  
// http://127.0.0.1:8000/api/forgot-password
// (email)

// post method  
// http://127.0.0.1:8000/api/reset-password
// (email, password, password_confirmation, token)




Route::get('/user', function (Request $request) {
    return User::all();
});

Route::post('/register', [LoginController::class, 'createUser']);
Route::post('/login',[LoginController::class,'loginUser']);
Route::post('/email-verification/{email}',[LoginController::class,'EmailVerificationSent']);
Route::middleware('auth:sanctum')->group( function () {
    Route::post('/logout', [LoginController::class, 'logout']);
    
    // profile route
    Route::get('/profile', [ProfileApiController::class, 'profile_index_api']);
    Route::post('/profile/image', [ProfileApiController::class, 'update_image_api']);
    Route::post('/profile/password/change', [ProfileApiController::class, 'profile_password_change_api']);
    Route::post('/profile/edit', [ProfileApiController::class, 'edit_profile_api']);
});

Route::post('forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
Route::post('reset-password', [ForgotPasswordController::class, 'reset']);

//  category route
Route::apiResource('category', CategoryApiController::class);

// news route
Route::apiResource('news', NewsApiController::class);
Route::get('news/show/{slug}', [NewsApiController::class, 'show'])->name('news.show');

// category wise news search 
Route::get('category/wise/news/{slug}', [NewsApiController::class, 'category_wise_news']);

// related category news search 
Route::get('related/category/news/{slug}', [NewsApiController::class, 'related_category_news']);


// crime route
Route::apiResource('crime', CrimeApiController::class);

// crime Extra Question route
Route::apiResource('crime_question', CrimeQuestionApiController::class);


//Page Route
Route::apiResource('page', PageApiController::class);
Route::get('page/delete/{id}', [PageApiController::class, 'destroy'])->name('page.delete');


//Social Links Route
Route::apiResource('social_links', SocialLinkApiController::class);


//General-Website Settings Route
Route::apiResource('settings', WebsiteApiController::class);


//Polling Category Settings Route
Route::apiResource('polling_category', PollingCategoryApiController::class);

//Polling Question Settings Route
Route::apiResource('polling_question', PollingQuestionApiController::class);

// Question Option Settings Route
// Route::apiResource('question_option', PollingQuestionApiController::class);


// Live
//Polling Review Route
Route::post('polling_review', [PollingReviewApiController::class, 'store'])->name('api_polling_review.store');
Route::get('polling_review', [PollingReviewApiController::class, 'index']);
Route::get('polling_options', [PollingReviewApiController::class, 'polling_options']);


// Normal
//Normal Review Route
Route::post('normal_review', [NormalReviewApiController::class, 'store'])->name('api_normal_review.store');
Route::get('normal_review', [NormalReviewApiController::class, 'index']);
Route::get('all/normal_voting', [NormalReviewApiController::class, 'all_normal_voting']);

Route::get('normal_voting/{topic}', [NormalReviewApiController::class, 'single_normal_voting']);

//Polling topics wise questions Route
Route::get('topic/wise/questions/{slug}', [PollingCategoryApiController::class, 'topic_wise_questions']);
// get all topics route 
Route::get('all/topics', [PollingCategoryApiController::class, 'all_topics']);


// normal voting api
Route::get('normal/topic/{slug}', [NormalReviewApiController::class, 'normal_topic']);
Route::post('normal/topic', [NormalReviewApiController::class, 'normalTopicPost']);

// servay questions api
Route::get('survay/questions/', [SurvayApiController::class, 'survay_question_api']);
Route::get('survay/answers/', [SurvayApiController::class, 'survay_answer_api']);
Route::post('survay/answers/store', [SurvayApiController::class, 'survay_answer_store']);


 



