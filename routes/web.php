<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WidgetController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\UserForgotPasswordController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/clear', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('view:clear');
    return 'DONE'; //Return anything
});

Route::get('forget-password', [UserForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [UserForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [UserForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [UserForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
Route::middleware(['guest'])->group(function () {
    Route::get('login', [AuthController::class, 'index'])->name('login');
    Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
    Route::get('register', [AuthController::class, 'registration'])->name('register');
    Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
});

Route::middleware(['auth'])->group(function () {
    Route::get('logoutuser', [AuthController::class, 'logoutuser'])->name('logoutuser');
    Route::get('profile', [AuthController::class, 'profile'])->name('profile');
    Route::put('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::get('change-password', [ChangePasswordController::class, 'index']);
   Route::post('change-password', [ChangePasswordController::class, 'changePassword']);

});

    //  GoogleController
    Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('back.google');



Route::get('/home', function () {
    return view('Homepage');
});
Route::get('/bilal', function () {
    return view('calculators.height-comparing');
});

Route::get('/blogs', function () {
    return view('tawingcss.blogs');
});

Route::get('/blogs-detail', function () {
    return view('tawingcss.blogs-details');
});


    Route::prefix('admin')->group(function () {
        Route::get('/',[AdminController::class,'index']);
        Route::match(['get', 'post'],'/login',[AdminController::class,'login']);
        Route::match(['get', 'post'],'/logout',[AdminController::class,'logout']);
        Route::match(['get', 'post'],'/add-calculator',[AdminController::class,'addCalculator']);
        Route::match(['get', 'post'],'/edit-calculator/{id}',[AdminController::class,'editCalculator']);
        
        Route::post('/keys',[AdminController::class,'keys']);
        Route::get('/calculators',[AdminController::class,'calculators']);
        Route::get('/converters',[AdminController::class,'calculators']);
        Route::get('/sub-converters',[AdminController::class,'subCalculators']);
        Route::get('/pending-calculators',[AdminController::class,'pendingCalculators']);
        Route::get('/pending-converters',[AdminController::class,'pendingCalculators']);
        Route::get('/pending-sub-converters',[AdminController::class,'pendingCalculators']);
        Route::get('/approve/{id}',[AdminController::class,'approve']);
        Route::match(['get', 'post'],'/add-converter',[AdminController::class,'addConverter']);
        Route::match(['get', 'post'],'/edit-converter/{id}',[AdminController::class,'editConverter']);
        Route::match(['get', 'post'],'/add-sub-converter',[AdminController::class,'addSubConverter']);
        Route::match(['get', 'post'],'/edit-sub-converter/{id}',[AdminController::class,'editSubConverter']);
        
        Route::match(['get', 'post'],'/media',[AdminController::class,'media']);

        Route::get('/posts',[PostController::class,'posts']);
        Route::get('/pending-posts',[PostController::class,'pending']);
        Route::match(['get', 'post'],'/add-post',[PostController::class,'addPost']);
        Route::match(['get', 'post'],'/edit-post/{id}',[PostController::class,'editPost']);
        Route::match(['get', 'post'],'/delete-post/{id}',[PostController::class,'deletePost']);

        Route::get('/users',[UserController::class,'index']);
        Route::match(['get', 'post'],'/add-user',[UserController::class,'addUser']);
        Route::match(['get', 'post'],'/edit-user/{id}',[UserController::class,'editUser']);

        // for categories
        Route::match(['get', 'post'],'/categories',[AdminController::class,'categories']);
        Route::match(['get', 'post'],'/add-category',[AdminController::class,'addCategory']);
        Route::match(['get', 'post'],'/edit-category/{id}',[AdminController::class,'editCategory']);
        Route::match(['get', 'post'],'/delete-category/{id}',[AdminController::class,'deleteCategory']);
        Route::match(['get', 'post'],'/sub-categories',[AdminController::class,'subCategories']);
        Route::match(['get', 'post'],'/add-sub-category',[AdminController::class,'addsubCategories']);
        Route::match(['get', 'post'],'/delete-sub-category/{id}',[AdminController::class,'deleteSubCategory']);
        Route::match(['get', 'post'],'/edit-sub-category/{id}',[AdminController::class,'editSubCategory']);
        Route::match(['get', 'post'],'/search-subcategory',[AdminController::class,'searchsubcategory']);
});





Route::middleware([App\Http\Middleware\RedirectIfIndexPhp::class])->group(function () {
    Route::post('/calculate', [HomeController::class, 'calculate'])->name('calculate_calculator');
    Route::post('/search_unit',[HomeController::class,'search_unit']);
    Route::get('/{category}',[HomeController::class,'category'])
    ->where('category', 'health|finance|math|physics|chemistry|statistics|everyday-life|construction|pets|timedate');
    Route::get('/blog',[BlogController::class,'index']);
    Route::get('blog/{category}',[BlogController::class,'category'])
    ->where('category', 'health|finance|math|physics|chemistry|statistics|everyday-life|construction|pets|timedate|Informative');
    Route::get('blog/{url}',[BlogController::class,'post']);
    Route::match(['get', 'post'],'preview/{url}',[WidgetController::class,'preview']);
    Route::match(['get', 'post'],'preview/{category}/{url}',[WidgetController::class,'subConverter']);
    Route::get('/unit-converter',[HomeController::class,'converter']);
    Route::post('/search',[HomeController::class,'search']);
    Route::get('/about-us',[HomeController::class,'about']);
    
    Route::get('/privacy-policy',[HomeController::class,'policy']);
    Route::get('/all-category',[HomeController::class,'allcategory']);
    Route::get('/all-calculators',[HomeController::class,'allcalculators']);
    Route::get('/faq',[HomeController::class,'faq']);
    Route::get('/editorial-Policies',[HomeController::class,'editorial_Policies']);
    Route::get('/terms-of-service',[HomeController::class,'terms']);
    Route::get('/content-disclaimer',[HomeController::class,'disclaimer']);
    Route::get('/sitemap.xml',[HomeController::class,'sitemap']);
    Route::get('/sitemap', [HomeController::class, 'sitemapPage'])->name('sitemapPage');
    // Route::get('/sitemap-two', [HomeController::class, 'sitemaptwo'])->name('sitemaptwo');
    Route::match(['get', 'post'],'/contact-us',[HomeController::class,'contact']);
    Route::match(['get', 'post'],'/feedback',[HomeController::class,'feedback_email']);
    Route::match(['get', 'post'],'/login',[HomeController::class,'login']);


    

   // Route::get('/our-team',[HomeController::class,'team']);
        // Tire Size Calculator API
    // Route::post('peechy-to-dekho',[ToolController::class,'chukeyaTire']);
    // Route::post('/contact/submit', [MailController::class, 'feedback'])->name('feedback');
    // Route::post('/contact/submit', [MailController::class, 'feedback'])->name('feedback');
    // Weight Loss Meals
    // Route::post('weight-loss-calculator-meals/', [HomeController::class, 'weightlossMeals'])->name('weightlossMeals');
    // Meal Planner Calculator
    Route::post('meal-planner-calculator/', [HomeController::class, 'mealPlanner'])->name('mealPlanner');
    // AI Math solver
    // Route::post('ai-math/', [HomeController::class, 'mathSolver'])->name('mathSolver');
    // Route::post('image-crop/', [HomeController::class, 'imageCrop'])->name('imageCrop');
    // Delet all source files for mathsolver
    // Route::get('delete-source-files/', [HomeController::class, 'cron'])->name('cron');
    
    // Route::get('/knowledge',[BlogController::class,'knowledge']);
    // Route::get('health/{url}',[BlogController::class,'knowPost']);
    // Route::get('math/{url}',[BlogController::class,'knowPost']);
    // Route::get('finance/{url}',[BlogController::class,'knowPost']);
    // Route::get('informative/{url}',[BlogController::class,'knowPost']);
    // Route::get('physics/{url}',[BlogController::class,'knowPost']);
    // Route::get('statistics/{url}',[BlogController::class,'knowPost']);
    // Route::get('math/{url}',[BlogController::class,'knowPost']);
    // Route::get('contraction/{url}',[BlogController::class,'knowPost']);
    // Route::get('ecology/{url}',[BlogController::class,'knowPost']);
    // Route::get('everyday/{url}',[BlogController::class,'knowPost']);
    // Route::get('food/{url}',[BlogController::class,'knowPost']);
    // Route::get('Sports/{url}',[BlogController::class,'knowPost']);
    // Route::get('others/{url}',[BlogController::class,'knowPost']);
    // Route::get('conversion/{url}',[BlogController::class,'knowPost']);
  
    
    // Route::match(['get', 'post'],'/register',[HomeController::class,'register']);
    // Route::get('/Register',[HomeController::class,'register'])->name('register');
    // Route::get('/Login',[HomeController::class,'login'])->name('login');
    // Route::get('/store',[HomeController::class,'store']);
    // Route::get('/authenticate',[HomeController::class,'authenticate'])->name('authenticate');
    // Route::controller(LoginRegisterController::class)->group(function() {
    //     Route::get('/register', 'register')->name('register');
    //     Route::post('/store', 'store')->name('store');
    //     Route::get('/login', 'login')->name('login');
    //     Route::post('/authenticate', 'authenticate')->name('authenticate');
       
    //     Route::post('/logout', 'logout')->name('logout');
    // });

    // Route::get('/testimonials',[HomeController::class,'testimonials']);
    // Route::get('/advertise',[HomeController::class,'advertise']);

    // Route::get('/feedback',[HomeController::class,'feedback']);
    // Route::get('/hire-us',[HomeController::class,'hire']);
  
    // Route::match(['get', 'post'],'/forget-password',[HomeController::class,'submitForgetPasswordForm']);
    // Route::match(['get', 'post'],'//reset-password/{token}',[HomeController::class,'showResetPasswordForm']);
    // Route::get('/logout',[HomeController::class,'logout'])->name('logout');

    // Route::get('/reset-password',[HomeController::class,'submitResetPasswordForm'])->name('reset.password.post');
    // Route::get('/reset-password/{token}',[HomeController::class,'showResetPasswordForm'])->name('reset.password.get');
    // Route::get('/forget-password',[HomeController::class,'submitForgetPasswordForm'])->name('forget.password.post');
    // Route::get('/forget-password',[HomeController::class,'showForgetPasswordForm'])->name('forget.password.get');

    
    Route::get('/{lang?}',[HomeController::class,'index'])->where('lang', '[a-z]{2}');
    Route::match(['get', 'post'],'/{url}',[HomeController::class,'showPageEN']);
    Route::match(['get', 'post'],'{lang}/{url}',[HomeController::class,'showPage'])->where('lang', '[a-z]{2}');
    
    Route::match(['get', 'post'],'{category}/{url}',[HomeController::class,'subConverterEN']);
    Route::match(['get', 'post'],'{lang}/{category}/{url}',[HomeController::class,'subConverter'])->where('lang', '[a-z]{2}');


});
// Route::get('/', function () {
//     return view('welcome');
// });



// Route::get('/', function () {
//     return view('welcome');
// });





