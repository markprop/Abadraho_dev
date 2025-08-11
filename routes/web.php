<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Helpers\AppHelper;
use App\Http\Controllers\FaceBookController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\InterestController;

Route::get('/areas', function () {
    return DB::select("select * from areas");
});

Route::get('/config-cache', function() {
    $exitCode = \Artisan::call('config:cache');
    // return what you want
});
Route::get('/clear-cache', function() {
    $exitCode = \Artisan::call('cache:clear');
    // return what you want
});
Route::get('/config-clear', function() {
    $exitCode = \Artisan::call('config:clear');
    // return what you want
});
Route::get('/route-clear', function() {
    $exitCode = \Artisan::call('route:clear');
    // return what you want
});

Route::get('/run', function () {
    Artisan::call('migrate', ['--force' => true ]);
});

Route::post('/create/custom-activity-log', function (Request $request) {
    AppHelper::insertActivityLog($request);
});



// Route::get('/interest-form', [InterestController::class, 'showForm'])->name('interest.form');
Route::post('/submit-interest', [InterestController::class, 'store'])->name('submit.interest');

// Facebook Login URL
Route::get('facebook/login', 'FaceBookController@provider')->name('facebook.login');
Route::get('facebook/callback', 'FaceBookController@handleCallback')->name('facebook.callback');

// Auth::routes();

Route::get('/login', 'FrontEnd\LoginController@login');
Route::post('/register-web-user', 'Auth\RegisterController@RegisterNewWebsiteUser')->name('web.register-user');
Route::post('/submit-web-user-phone-no', 'Auth\RegisterController@SubmitWebUserPhoneNo')->name('web.submit-phoneNo');

// Route::get('/google-login', 'Auth\SocialController@googleLogin')->name('google.login');
// Route::get('/google-redirect', 'Auth\SocialController@googleRedirect')->name('google.redirect');

Route::get('auth/google', [SocialController::class,'googleLogin'])->name('google-auth');
Route::get('auth/google/call-back', [SocialController::class, 'googleRedirect']);

Route::get('auth/facebook', [SocialController::class,'facebookLogin'])->name('facebook-auth');
Route::get('auth/facebook/call-back', [SocialController::class, 'facebookRedirect']);

// Route::get('/facebook-login', 'Auth\SocialController@facebookLogin')->name('facebook.login');
// Route::get('/facebook-redirect', 'Auth\SocialController@facebookRedirect')->name('facebook.redirect');
Route::post('add-rating', 'ReviewController@add');


Route::post('/user/phone_number', 'Auth\LoginController@save_phone');
Route::post('/requested-session-url', 'Auth\LoginController@requested_session_url');

Route::get('/email/verify', 'Auth\EmailVerificationController@email_verify')
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', 'Auth\EmailVerificationController@email_verification_request')
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

Route::get('/admin/cutomers','Admin\DashboardController@Customers');
Route::get('/admin/favorites','Admin\DashboardController@Favorites');

// Admin Login
Route::get('/admin/dashboard', 'Admin\DashboardController@index')->name('admin.dashboard');
Route::get('/admin/login', 'Auth\AdminController@adminLoginForm')->name('admin.login');
Route::get('/admin/register', 'Auth\AdminController@adminRegisterForm')->name('admin.register');
Route::post('/admin/login', 'Auth\AdminController@AttemptAdminLogin')->name('attempt.admin.login');
Route::post('/admin/register', 'Auth\AdminController@adminRegister')->name('admin.register.submit');
Route::get('/admin/logout', 'Auth\LoginController@logout')->name('admin.logout');

//Admin Profile
Route::get('/admin/admin-profile', 'Admin\AdminProfileController@index')->name('panel.admin.admin-profile');
Route::post('/my-admin-profile-update', 'Admin\AdminProfileController@adminprofileupdate');
Route::get('/admin/admin-change-password', 'Admin\AdminChangePasswordController@index')->name('panel.admin.admin-change-password');
Route::post('/update-admin-password', 'Admin\AdminChangePasswordController@UpdateAdminPassword');

Route::get('/admin/activity-log', 'Admin\ActivityLogController@index');

// Error Route
Route::get('/admin-forbidden', 'Auth\AdminController@AdminForbidden')->name('admin.forbidden');

// Admin Projects
Route::prefix('admin')->name('admin_panel.')->group(function() {
    Route::resource('project', 'Admin\ProjectController');
    Route::get('pending/project', 'Admin\ProjectController@pending');
    Route::get('active/project', 'Admin\ProjectController@active');
    Route::post('project/update/amenities', 'Admin\ProjectController@AddUpdateAmenities');
    Route::post('project/update/utilities', 'Admin\ProjectController@AddUpdateUtilities');
});

// Admin Units
Route::resource('admin/unit', 'Admin\UnitController', ['except' => ['destroy']]);
Route::post('admin/unit/{unit}/delete', 'Admin\UnitController@destroy');

// Admin Unit Rooms
Route::post('/admin/unit/{id}/room', 'Admin\UnitController@createUnitRoom')->name('create.unit.room');
Route::post('/admin/unit/{id}/edit/room', 'Admin\UnitController@updateRoom')->name('update.unit.room');

// commented because of duplicate route name and method name
//Route::put('/admin/unit_room/edit/{id}', 'Admin\UnitController@updateRoom')->name('update.unit.room');
Route::post('/admin/unit_room/delete/trash', 'Admin\UnitController@isArchiveUnitRoom')->name('delete.unit.room');

Route::get('admin/reviews', 'Admin\ReviewController@index');
Route::post('add-rating', 'ReviewController@add');

// Admin Areas
Route::resource('admin/area', 'Admin\AreaController', ['except' => ['destroy']]);
Route::post('admin/area/delete', 'Admin\AreaController@destroy');

// Admin Project Type
Route::resource('admin/project_type', 'Admin\ProjectTypeController', ['except' => ['destroy']]);
Route::post('admin/project_type/delete', 'Admin\ProjectTypeController@destroy');

// User Management
Route::get('admin/manage_users/{admin}/edit', 'Admin\UserManagementController@edit');
Route::post('admin/manage_users/{admin}/edit', 'Admin\UserManagementController@update')->name("admin.user.update");
Route::get('admin/manage_users/{admin}', 'Admin\UserManagementController@show')->name('admin.users.show');
Route::resource('admin/manage_users', 'Admin\UserManagementController', ['except' => ['destroy']]);
Route::post('admin/manage_users', 'Admin\UserManagementController@index');
Route::get('admin/create_user', 'Admin\UserManagementController@create_user');
Route::post('admin/add-new-user', 'Admin\UserManagementController@AddNewUser')->name("user.add");
Route::post('admin/manage_users/delete', 'Admin\UserManagementController@destroy')->name("user.delete");


// Admin Zoho Forms
Route::get('admin/listing', 'Admin\InquiryController@index')->name('admin.zoho.index');

// commented because of duplicate route name
//Route::post('admin/listing', 'Admin\InquiryController@index')->name('admin.zoho.index');
Route::get('admin/listing/{inquiry}', 'Admin\InquiryController@show')->name('admin.zoho.show');
Route::get('/admin/export/listing', 'Admin\InquiryController@export')->name('admin.listing.excel');
Route::get('admin/inquiry/{inquiry}/delete', 'Admin\InquiryController@destroy');
Route::post('web/project-detail/inquiry', 'API\ZohoFormController@store');

// Admin User Search History
Route::get('admin/search-history', 'Admin\UserSearchHistoryController@index')->name('admin.user_history.index');
Route::post('admin/search-history', 'Admin\UserSearchHistoryController@adminUserSearchFilter');
Route::get('admin/search-history/{userHistory}', 'Admin\UserSearchHistoryController@show')->name('panel.admin.search_history.show');
Route::get('admin/housing-calc-search-history', 'Admin\UserSearchHistoryController@housingSearch')->name('admin.housing_calc_search');
Route::post('admin/housing-calc-search-history', 'Admin\UserSearchHistoryController@housingSearch');
Route::get('admin/searchHistory/export', 'Admin\UserSearchHistoryController@export')->name('admin.search_history.excel');
Route::get('admin/calSearchHistory/export', 'Admin\UserSearchHistoryController@export2')->name('admin.cal_search_history.excel');
Route::get('admin/advance-search-history', 'Admin\UserSearchHistoryController@advance_search_index');

// Admin Builder Management
Route::resource('admin/builder', 'Admin\BuilderController', ['except' => ['destroy']]);
Route::post('/admin/builder/delete', 'Admin\BuilderController@destroy');

//Admin Vouchers
Route::resource('admin/voucher', 'Admin\VoucherController', ['except' => ['destroy', 'show']]);
Route::post('admin/voucher/store', 'Admin\VoucherController@store');
Route::delete('admin/voucher/delete/{id}', 'Admin\VoucherController@destroy');
Route::get('admin/downloaded-voucher', 'Admin\VoucherController@downloadedVoucherList');

Route::get('getprojectunits/{id}', 'Admin\VoucherController@getprojectunits');


// Admin Blog Category
Route::resource('admin/blog_category', 'Admin\BlogCategoryController', ['except' => ['destroy', 'show']]);
Route::post('admin/blog_category/delete', 'Admin\BlogCategoryController@destroy');

// Admin Blog
Route::resource('admin/blog', 'Admin\BlogController', ['except' => ['destroy', 'show']]);
Route::post('/admin/blog/delete', 'Admin\BlogController@destroy');

// User Payment Schedules
Route::any('admin/payment-schedules', 'Admin\PaymentScheduleController@index')->name('admin.payment_schedule.index');
Route::get('admin/payment-schedules/export', 'Admin\PaymentScheduleController@export')->name('admin.payment_schedule.excel');
Route::get('admin/payment-schedules/{paymentSchedule}', 'Admin\PaymentScheduleController@show')->name('admin.payment_schedule.show');

// Admin Tags
Route::resource('admin/tag', 'Admin\TagController', ['except' => ['destroy', 'show']]);
Route::post('/admin/tag/delete', 'Admin\TagController@destroy')->name('admin.tag.destroy');

// Admin Progress
Route::resource('admin/progress', 'Admin\ProgressController', ['except' => ['destroy', 'show']]);

// changed following route name because of duplicate
Route::get('admin/progress/{progress_data}/delete', 'Admin\ProgressController@destroy')->name('admin.progress_data.destroy');

// Admin Room Type
Route::resource('admin/room_type', 'Admin\RoomTypeController', ['except' => ['destroy', 'show']]);
// changed route name from admin.tag.destroy to admin.room_type.destroy because of duplicate route name
Route::post('admin/room_type/delete', 'Admin\RoomTypeController@destroy')->name('admin.room_type.destroy');

// Admin Amenities
Route::resource('admin/amenities', 'Admin\AmenitiesController', ['except' => ['destroy', 'show']]);
Route::post('admin/amenities/delete', 'Admin\AmenitiesController@destroy')->name('admin.amenity.destroy');

// Admin Utilities
Route::resource('admin/utilities', 'Admin\UtilitiesController', ['except' => ['destroy', 'show']]);
Route::post('admin/utilities/delete', 'Admin\UtilitiesController@destroy')->name('admin.utility.destroy');


Route::get('/admin/my-teams', 'Admin\TeamController@myTeams')->name('admin.my-teams');
Route::get('/admin/joined-teams', 'Admin\TeamController@joinedTeams')->name('admin.joined-teams');
Route::get('/admin/my-team/{team:slug}', 'Admin\TeamController@myTeamShow')->name('admin.myteam.show');
Route::get('/admin/team/create', 'Admin\TeamController@create');
Route::get('/admin/teams', 'Admin\TeamController@index')->name('admin.teams');
Route::post('/admin/team/create', 'Admin\TeamController@store')->name('admin.team.store');
Route::get('/admin/team/{team:slug}', 'Admin\TeamController@show')->name('admin.team.show');

// front end

Route::get('import-areas', 'HomeController@import_areas');
Route::post('import-areas', 'HomeController@importCsv');

Route::get('import-projects', 'HomeController@import_projects');
Route::post('/admin/project/import', 'HomeController@importCsvProjects');

Route::get('import-units', 'HomeController@import_units');
Route::post('import-units', 'HomeController@importCsvUnits');

Route::get('import-types', 'HomeController@import_types');
Route::post('import-types', 'HomeController@importCsvTypes');

/* Contact Us Routes */

Route::get('/contact-us', 'ContactUSController@contactUS');
Route::post('/contact', 'ContactUSController@contactUSPost');
Route::get('admin/contact/{contact}', 'Admin\ContactUSController@show')->name('admin.contact.show');
Route::get('/admin/export/contact', 'Admin\ContactUSController@export')->name('admin.contact.excel');

/* Contact Us Admin Routes */

Route::any('admin/contact/', 'Admin\ContactUSController@index')->name('admin.contact.index');

Auth::routes(['login' => false, 'register' => false]);
Route::get('/web/logout', 'API\LoginController@webLogout')->name('web.logout');
Route::post('/web/login', 'API\LoginController@webLogin')->name('web.login');

Route::get('/', 'FrontEnd\HomeController@index')->name('home');
Route::get('/project/{project:slug}', 'FrontEnd\ProjectController@detail')->name('web.project.details');

//Wishlist Route
Route::get('/add-wishlist/{id}', 'FrontEnd\WishlistController@storewishlist')->middleware('auth');
Route::get('user/wishlist', 'FrontEnd\WishlistController@index')->middleware('auth');
Route::get('/user/wishlist/{item}/delete', 'FrontEnd\WishlistController@destroy')->name('wishlist');

// created by Shahbaz Raza for new fiter work
Route::get('/projects/getlistings', 'FrontEnd\ProjectController@filter')->name('getlistings');

Route::post('/projects/generate-voucher', 'FrontEnd\ProjectController@generate_voucher');

Route::get('/projects/listings', 'FrontEnd\ProjectListingController@index')->name("project.listing");

Route::get('/projects', 'FrontEnd\ProjectListingController@index')->name("project.listing");
Route::get('/projects/{slug}', 'FrontEnd\ProjectListingController@index')->name("slug.listing");

// /{areas}&{location}



Route::post('/projects/listings', 'FrontEnd\ProjectListingController@search')->name("project.listing_search");

// changed route name from home to new.project.listings
Route::post('/projects/listings', 'FrontEnd\ProjectController@filter')->name('new.project.listings');


Route::get('/blogs', 'FrontEnd\BlogController@index')->name('blogs');
// Route::get('/{category}/{slug}', 'FrontEnd\BlogController@show')->name('blog.show');
Route::get('/{category}/{slug}', 'FrontEnd\BlogController@show')->name('blog.show');


Route::post('/projects/payment-schedule', 'FrontEnd\ProjectController@payment_schedule');

// this route (name("project.compare")) route name is case sensitive please dont change route name
Route::get('/compare/{id?}', 'CompareController@index')->name("project.compare");

// compare 2 page routes
Route::get('/compare-2/{id?}', 'CompareNewController@comparenew')->name("project.compare2");
Route::get('/gettypes/{id?}', 'CompareNewController@gettypes')->name("project.compare2.types");
Route::post('/get_project_compare', 'CompareNewController@get_project_compare')->name("project.compare2.get_project_compare");

Route::post('/filter-compare-projects', 'CompareController@FilterCompareProjects');
Route::post('/compare', 'CompareController@compare_list');
Route::get('/profilepage', 'FrontEnd\UserController@profile')->name("web.user.profile");
Route::post('/my-profile-update', 'FrontEnd\UserController@profileupdate');
// Route::post('/my-profile-update-password', 'FrontEnd\UserController@changePassword');
Route::post('/my-profile-update-password', 'FrontEnd\UserController@checkPassword')->name("my-profile-update-password");
Route::get('/reset-password', 'FrontEnd\ResetPasswordController@resetpassword');
Route::post('/reset-password', 'FrontEnd\ResetPasswordController@postEmail');
Route::get('/change-password/{token}', 'FrontEnd\ChangePasswordController@getPassword');
Route::post('/change-password', 'FrontEnd\ChangePasswordController@updatePassword');
Route::post('/change-admin-password', 'FrontEnd\UserController@changeAdminPassword');


// Pages routes
Route::get('/about-us', 'FrontEnd\PageController@aboutUs');
Route::get('/terms-conditions', 'FrontEnd\PageController@termsAndConditions');
Route::get('/profile', 'FrontEnd\PageController@userProfile');

// SiteMap
Route::get('sitemap.xml', 'SitemapController@index');

// Mail
Route::get('sendbasicemail', 'MailController@basic_email');
Route::get('sendhtmlemail', 'MailController@html_email');
Route::get('sendattachmentemail', 'MailController@attachment_email');

Route::get('/getunits', 'UnitCotnroller@get_unit_by_project_id');

Route::post('/resend-phone-no-otp', 'Auth\RegisterController@ResendPhoneNoOtp');
Route::post('/verify-phone-no-otp', 'Auth\RegisterController@VerifyPhoneNoOtp');


