<?php

use App\Http\Controllers\API\Builder\ProjectController;
use App\Http\Controllers\API\Builder\TeamController;
use App\Http\Controllers\API\Builder\UnitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\BuilderLoginController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// GET ALL PROJECTS
Route::get('all', [\App\Http\Controllers\API\SearchController::class, 'all']);

// GET FILTERED PROJECTS
Route::post('filter', [\App\Http\Controllers\API\SearchController::class, 'filter']);

Route::group(['prefix' => 'projects'], function () {
    Route::get('all-areas', [\App\Http\Controllers\API\AreaController::class, 'all']);
    Route::get('all-types', [\App\Http\Controllers\API\ProjectTypeController::class, 'all']);
    Route::post('type', [\App\Http\Controllers\API\ProjectTypeController::class, 'byId']);
    Route::get('all', [\App\Http\Controllers\API\ProjectController::class, 'all']);
    Route::post('filter', [\App\Http\Controllers\API\ProjectController::class, 'filter']);
    Route::post('show', [\App\Http\Controllers\API\ProjectController::class, 'show']);
    Route::get('all-units', [\App\Http\Controllers\API\UnitController::class, 'all']);
    Route::post('compare', [\App\Http\Controllers\API\ProjectController::class, 'compare']);
    Route::post('area', [\App\Http\Controllers\API\ProjectController::class, 'area']);
    Route::post('unit', [\App\Http\Controllers\API\ProjectController::class, 'unit']);
    Route::post('similar', [\App\Http\Controllers\API\ProjectController::class, 'similar']);

    /* Get Measurement of a unit */
    Route::post('unit-measurement', [\App\Http\Controllers\API\UnitController::class, 'measurements']);
});

/* User Search History*/
Route::post('/search', [\App\Http\Controllers\API\UserSearchHistoryController::class, 'search']);

/* Login API */
Route::post('/login', [\App\Http\Controllers\API\LoginController::class, 'login']);
Route::post('/user-details', [\App\Http\Controllers\API\LoginController::class, 'user']);
Route::post('/update-phone', [\App\Http\Controllers\API\LoginController::class, 'updatePhoneNumber']);
Route::post('/user-exists', [\App\Http\Controllers\API\LoginController::class, 'userExists']);

/* Register API */
Route::post('/register', [\App\Http\Controllers\API\RegisterController::class, 'register']);

/* Zoho Form API*/
Route::post('/zohoForm', [\App\Http\Controllers\API\ZohoFormController::class, 'store']);

// Builder Groups
Route::group(['prefix' => 'admin'], function () {

    // Route::post('all-builders', [\App\Http\Controllers\API\Admin\BuilderController::class, 'all']);

    /* Project Routes */

    /* index, store, update routes */
    Route::resource('project', '\App\Http\Controllers\API\Builder\ProjectController', ['except' => ['create', 'edit', 'show']]);
    /* Show single project by slug */
    Route::get('/project/{project:slug}', [ProjectController::class, 'show'])->name('admin.project.show');


    /* Unit Routes */

    /* Create Unit */
    Route::post('/project/unit/store', [UnitController::class, 'store'])->name('admin.project.unit.create');
    /* Show Unit */
    Route::get('/unit/{unit:id}', [UnitController::class, 'show'])->name('project.unit.show');
    /* Add room to a unit */
    Route::post('/unit/{unit}/room', [UnitController::class, 'add_room'])->name('admin.project.unit.room.create');
    /* Update room of a unit */
    Route::post('/unit/{unit}/room/{room}', [UnitController::class, 'updateRoom'])->name('admin.project.unit.room.update');

    /* Teams Routes */

    /* Get Builder's Own Teams */
    // changed route name from admin.teams to api.admin.teams
    Route::get('/my-teams', [TeamController::class, 'myTeams'])->name('api.admin.teams');
    /* Get Builder's joined Teams */
    Route::get('/joined-teams', [TeamController::class, 'joinedTeams'])->name('admin.joined.teams');
    /* Show data to require to create team */
    Route::get('/team/create', [TeamController::class, 'createTeam'])->name('admin.team.create');
    /* Create Team */
    // changed route name from admin.team.store to api.admin.team.store
    Route::post('/team/store', [TeamController::class, 'storeTeam'])->name('api.admin.team.store');
    /* Show single team data */
    // changed route name from admin.team.show to api.admin.team.show
    Route::get('/team/{team:slug}', [TeamController::class, 'show'])->name('api.admin.team.show');
});

/*
 * FRONT END API's
 */

Route::post('unit-types', [\App\Http\Controllers\FrontEnd\ProjectController::class, 'getUnit']);
