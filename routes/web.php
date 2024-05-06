<?php

use App\Models\ActivityLog;
//use Spatie\Activitylog\Models\Activity;
use App\Helper\NumberToBanglaWord;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;


use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\LangController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Guest\AjaxController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ThanaController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Site\SiteAllController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UpazilaController;
use App\Http\Controllers\Admin\ApprovalController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\UserTypeController;
use App\Http\Controllers\Guest\LanguageController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\Admin\ConditionController;
use App\Http\Controllers\Admin\BranchUnitController;
use App\Http\Controllers\Admin\BranchUserController;
use App\Http\Controllers\Admin\OfficeTypeController;
use App\Http\Controllers\Admin\ApplicationController;
use App\Http\Controllers\Admin\AssociationController;
use App\Http\Controllers\Admin\ServiceTypeController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\ApplicationreviewController;
use App\Http\Controllers\Admin\ApplicationcompleteController;
use App\Http\Controllers\Admin\ApplicationdeclinedController;

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

//Command Route For Development Server
Route::get('/key', function() {
    Artisan::call('key:generate');
});
Route::get('/cache', function() {
    Artisan::call('cache:clear');
});
Route::get('/optimize', function() {
    Artisan::call('optimize:clear');
});
Route::get('/link', function() {
    Artisan::call('storage:link');
});
Route::get('/view', function() {
    Artisan::call('view:clear');
});
Route::get('/route', function() {
    Artisan::call('route:clear');
});

Route::get('/command', function() {
    Artisan::call('key:generate');
    Artisan::call('cache:clear');
    Artisan::call('optimize:clear');
    //Artisan::call('storage:link');
    // Artisan::call('view:clear');
    // Artisan::call('route:clear');
});




//Guest Route
Route::get('lang/{lang}', ['as' => 'lang.switch',  LanguageController::class, 'switchLang'])->name('lang.switch');

Route::get('/division/{id?}', ['as'=>'get.division',AjaxController::class, 'getDivision'])->name('get.division');
Route::get('/district/{id?}', ['as'=>'get.district',AjaxController::class, 'getDsitrict'])->name('get.district');
Route::get('/area/{id?}', ['as'=>'get.area',AjaxController::class, 'getArea'])->name('get.area');
Route::get('/branch-by-area/{id?}', ['as'=>'get.branch_by_area',AjaxController::class, 'getBranchByArea'])->name('get.branch_by_area');
Route::get('/upazila/{id?}', ['as'=>'get.upazila',AjaxController::class, 'getUpazila'])->name('get.upazila');
Route::get('/thana/{id?}', ['as'=>'get.thana',AjaxController::class, 'getThana'])->name('get.thana');
Route::get('/upazila/self/{id?}', ['as'=>'get.upazila.self',AjaxController::class, 'getUpazilaSelf'])->name('get.upazila.self');
Route::get('/product/{id?}', ['as'=>'get.product',AjaxController::class, 'getProduct'])->name('get.product');
Route::get('/products/{id?}', ['as'=>'get.products',AjaxController::class, 'getProducts'])->name('get.products');
Route::get('/unit/{id?}', ['as'=>'get.unit',AjaxController::class, 'getUnit'])->name('get.unit');
Route::get('/get-users', ['as'=>'get.users',AjaxController::class, 'getUsers'])->name('get.users');
Route::get('/get-branches', ['as'=>'get.branches',AjaxController::class, 'getBranches'])->name('get.branches');

Route::get('/get-users/{contact?}', ['as'=>'get.users.contact',AjaxController::class, 'getUsersContact'])->name('get.users.contact');
Route::get('/get-users-name/{contact?}', ['as'=>'get.users.name',AjaxController::class, 'getUsersName'])->name('get.users.name');

Route::get('/branch/{branch_id?}', ['as'=>'get.branch',AjaxController::class, 'getBranch'])->name('get.branch');
Route::get('/branch-unit/{branch_id?}', ['as'=>'get.branch_unit',AjaxController::class, 'getBranchUnit'])->name('get.branch_unit');
Route::get('/vice-president/{branch_id?}', ['as'=>'get.vice_president',AjaxController::class, 'getVicePresident'])->name('get.vice_president');
Route::get('/caliph/{branch_id?}', ['as'=>'get.caliph',AjaxController::class, 'getCaliph'])->name('get.caliph');
Route::get('/president/{branch_id?}', ['as'=>'get.president',AjaxController::class, 'getpresident'])->name('get.president');

// this route for user panel not needed
Route::get('/test',function(){
    return engToBnHlp(123);
});


//Site Route
Route::get('/', ['as'=>'site.home',SiteAllController::class, 'index'])->name('site.home');

Route::group(['prefix'=>'pages'], function(){
    Route::get('{slug?}', ['as'=>'site.content',SiteAllController::class, 'content'])->name('site.content');
});

// User Auth Part
Auth::routes();
Route::get('/logout', ['middleware'=>'auth:web',LoginController::class, 'logout'])->name('logout');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth', 'prefix'=>'user','as'=>'user.'], function() {
    Route::get('/dashboard', ['as'=>'dashboard',DashboardController::class, 'index'])->name('dashboard');
});


// Admin Auth Part

Route::group(['middleware'=>'guest:admin', 'prefix'=>'admin','as'=>'admin.'], function() {

    Route::get('/',function(){
        return redirect()->route('admin.login');
    });
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', ['as'=>'login',AuthController::class, 'loginStore']);

    Route::get('/password/reset', ['as'=>'password.request',AuthController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/password/reset', ['as'=>'password.email',AuthController::class, 'sendResetLinkEmail'])->name('password.email');
});
Route::group(['prefix'=>'admin','as'=>'admin.'], function() {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/change-password/{id?}', [AuthController::class, 'changePassword'])->name('change.password');
});

Route::group(['middleware'=>'auth:admin', 'prefix'=>'admin','as'=>'admin.'], function() {

    Route::get('/log', function(){

        //return ActivityLog::inLog(['versions','users'])->get();
        //return ActivityLog::inLog('versions')->get();
        //return $result = ActivityLog::get();
        //return $result = ActivityLog::logNames(['services','admins'])->get();


        //return ActivityLog::with('admin')->get();
        //return ActivityLog::with('admin')->get();
        //return ActivityLog::with('causer')->get()->first();
        //return ActivityLog::with('admin')->get()->last();
        //return $result = ActivityLog::with('admin','getCode')->logNames(['services'])->first();
        $result = ActivityLog::with('admin')->logNames(['services'])->first();
        $result->code = $result->subject_type::find($result->subject_id)->code; 
        return $result;
    });

    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix'=>'role-permissions'], function(){
        //Role route
        Route::get('/role', ['as'=>'role',RoleController::class, 'index'])->middleware('can:read,App\Models\Role')->name('role');

        Route::get('/role/create', ['as'=>'role.create',RoleController::class, 'create'])->middleware('can:create,App\Models\Role')->name('role.create');

        Route::post('/role/store', ['as'=>'role.store',RoleController::class, 'store'])->middleware('can:create,App\Models\Role')->name('role.store');

        Route::get('/role/edit/{id?}', ['as'=>'role.edit',RoleController::class, 'edit'])->middleware('can:update,App\Models\Role')->name('role.edit');

        Route::put('/role/update/{id?}', ['as'=>'role.update',RoleController::class, 'update'])->middleware('can:update,App\Models\Role')->name('role.update');

        Route::get('/role/delete/{id?}/{sid?}', ['as'=>'role.delete',RoleController::class, 'delete'])->middleware('can:delete,App\Models\Role')->name('role.delete');
        Route::get('/role/permission/{id?}', ['as'=>'role.permission',RoleController::class, 'permission'])->middleware('can:permission_update,App\Models\Role')->name('role.permission');

        Route::put('/role/permission/update/{id?}', ['as'=>'role.permission.update',RoleController::class, 'permission_update'])->middleware('can:permission_update,App\Models\Role')->name('role.permission.update');

        //UserType route
        Route::get('/user-type', ['as'=>'user_type',UserTypeController::class, 'index'])->middleware('can:read,App\Models\UserType')->name('user_type');

        Route::get('/user-type/create', ['as'=>'user_type.create',UserTypeController::class, 'create'])->middleware('can:create,App\Models\UserType')->name('user_type.create');

        Route::post('/user-type/store', ['as'=>'user_type.store',UserTypeController::class, 'store'])->middleware('can:create,App\Models\UserType')->name('user_type.store');

        Route::get('/user-type/edit/{id?}', ['as'=>'user_type.edit',UserTypeController::class, 'edit'])->middleware('can:update,App\Models\UserType')->name('user_type.edit');

        Route::put('/user-type/update/{id?}', ['as'=>'user_type.update',UserTypeController::class, 'update'])->middleware('can:update,App\Models\UserType')->name('user_type.update');

        Route::get('/user-type/delete/{id?}/{sid?}', ['as'=>'user_type.delete',UserTypeController::class, 'delete'])->middleware('can:delete,App\Models\UserType')->name('user_type.delete');


        //SiteSetting route
        Route::get('/site-setting', ['as'=>'site_setting',SiteSettingController::class, 'index'])->middleware('can:read,App\Models\SiteSetting')->name('site_setting');

        Route::get('/site-setting/create', ['as'=>'site_setting.create',SiteSettingController::class, 'create'])->middleware('can:create,App\Models\SiteSetting')->name('site_setting.create');

        Route::post('/site-setting/store', ['as'=>'site_setting.store',SiteSettingController::class, 'store'])->middleware('can:create,App\Models\SiteSetting')->name('site_setting.store');

        Route::get('/site-setting/edit/{id?}', ['as'=>'site_setting.edit',SiteSettingController::class, 'edit'])->middleware('can:update,App\Models\SiteSetting')->name('site_setting.edit');

        Route::put('/site-setting/update/{id?}', ['as'=>'site_setting.update',SiteSettingController::class, 'update'])->middleware('can:update,App\Models\SiteSetting')->name('site_setting.update');

        Route::get('/site-setting/delete/{id?}/{sid?}', ['as'=>'site_setting.delete',SiteSettingController::class, 'delete'])->middleware('can:delete,App\Models\SiteSetting')->name('site_setting.delete');


        //Lang route
        Route::get('/lang', ['as'=>'lang',LangController::class, 'index'])->middleware('can:read,App\Models\Lang')->name('lang');

        Route::get('/lang/create', ['as'=>'lang.create',LangController::class, 'create'])->middleware('can:create,App\Models\Lang')->name('lang.create');

        Route::post('/lang/store', ['as'=>'lang.store',LangController::class, 'store'])->middleware('can:create,App\Models\Lang')->name('lang.store');

        Route::get('/lang/edit/{id?}', ['as'=>'lang.edit',LangController::class, 'edit'])->middleware('can:update,App\Models\Lang')->name('lang.edit');

        Route::put('/lang/update/{id?}', ['as'=>'lang.update',LangController::class, 'update'])->middleware('can:update,App\Models\Lang')->name('lang.update');

        Route::get('/lang/delete/{id?}/{sid?}', ['as'=>'lang.delete',LangController::class, 'delete'])->middleware('can:delete,App\Models\Lang')->name('lang.delete');


    });

    // Route::group(['prefix'=>'administrative-locations'], function(){
       
    //     //Division route
    //     Route::get('/division', ['as'=>'division',DivisionController::class, 'index'])->middleware('can:read,App\Models\Division')->name('division');

    //     Route::get('/division/create', ['as'=>'division.create',DivisionController::class, 'create'])->middleware('can:create,App\Models\Division')->name('division.create');

    //     Route::post('/division/store', ['as'=>'division.store',DivisionController::class, 'store'])->middleware('can:create,App\Models\Division')->name('division.store');

    //     Route::get('/division/edit/{id?}', ['as'=>'division.edit',DivisionController::class, 'edit'])->middleware('can:update,App\Models\Division')->name('division.edit');

    //     Route::put('/division/update/{id?}', ['as'=>'division.update',DivisionController::class, 'update'])->middleware('can:update,App\Models\Division')->name('division.update');

    //     Route::get('/division/delete/{id?}/{sid?}', ['as'=>'division.delete',DivisionController::class, 'delete'])->middleware('can:delete,App\Models\Division')->name('division.delete');
        
    //     //District route
    //     Route::get('/district', ['as'=>'district',DistrictController::class, 'index'])->middleware('can:read,App\Models\District')->name('district');

    //     Route::get('/district/create', ['as'=>'district.create',DistrictController::class, 'create'])->middleware('can:create,App\Models\District')->name('district.create');

    //     Route::post('/district/store', ['as'=>'district.store',DistrictController::class, 'store'])->middleware('can:create,App\Models\District')->name('district.store');

    //     Route::get('/district/edit/{id?}', ['as'=>'district.edit',DistrictController::class, 'edit'])->middleware('can:update,App\Models\District')->name('district.edit');

    //     Route::put('/district/update/{id?}', ['as'=>'district.update',DistrictController::class, 'update'])->middleware('can:update,App\Models\District')->name('district.update');

    //     Route::get('/district/delete/{id?}/{sid?}', ['as'=>'district.delete',DistrictController::class, 'delete'])->middleware('can:delete,App\Models\District')->name('district.delete');
        
    //     //Upazila route
    //     Route::get('/upazila', ['as'=>'upazila',UpazilaController::class, 'index'])->middleware('can:read,App\Models\Upazila')->name('upazila');

    //     Route::get('/upazila/create', ['as'=>'upazila.create',UpazilaController::class, 'create'])->middleware('can:create,App\Models\Upazila')->name('upazila.create');

    //     Route::post('/upazila/store', ['as'=>'upazila.store',UpazilaController::class, 'store'])->middleware('can:create,App\Models\Upazila')->name('upazila.store');

    //     Route::get('/upazila/edit/{id?}', ['as'=>'upazila.edit',UpazilaController::class, 'edit'])->middleware('can:update,App\Models\Upazila')->name('upazila.edit');

    //     Route::put('/upazila/update/{id?}', ['as'=>'upazila.update',UpazilaController::class, 'update'])->middleware('can:update,App\Models\Upazila')->name('upazila.update');

    //     Route::get('/upazila/delete/{id?}/{sid?}', ['as'=>'upazila.delete',UpazilaController::class, 'delete'])->middleware('can:delete,App\Models\Upazila')->name('upazila.delete');
        
    //     //Thana route
    //     Route::get('/thana', ['as'=>'thana',ThanaController::class, 'index'])->middleware('can:read,App\Models\Thana')->name('thana');

    //     Route::get('/thana/create', ['as'=>'thana.create',ThanaController::class, 'create'])->middleware('can:create,App\Models\Thana')->name('thana.create');

    //     Route::post('/thana/store', ['as'=>'thana.store',ThanaController::class, 'store'])->middleware('can:create,App\Models\Thana')->name('thana.store');

    //     Route::get('/thana/edit/{id?}', ['as'=>'thana.edit',ThanaController::class, 'edit'])->middleware('can:update,App\Models\Thana')->name('thana.edit');

    //     Route::put('/thana/update/{id?}', ['as'=>'thana.update',ThanaController::class, 'update'])->middleware('can:update,App\Models\Thana')->name('thana.update');

    //     Route::get('/thana/delete/{id?}/{sid?}', ['as'=>'thana.delete',ThanaController::class, 'delete'])->middleware('can:delete,App\Models\Thana')->name('thana.delete');
        
    // });

    Route::group(['prefix'=>'locations'], function(){
        
        //Association route
        Route::get('/association', ['as'=>'association',AssociationController::class, 'index'])->middleware('can:read,App\Models\Association')->name('association');

        Route::get('/association/create', ['as'=>'association.create',AssociationController::class, 'create'])->middleware('can:create,App\Models\Association')->name('association.create');

        Route::post('/association/store', ['as'=>'association.store',AssociationController::class, 'store'])->middleware('can:create,App\Models\Association')->name('association.store');

        Route::get('/association/edit/{id?}', ['as'=>'association.edit',AssociationController::class, 'edit'])->middleware('can:update,App\Models\Association')->name('association.edit');

        Route::put('/association/update/{id?}', ['as'=>'association.update',AssociationController::class, 'update'])->middleware('can:update,App\Models\Association')->name('association.update');

        Route::get('/association/delete/{id?}/{sid?}', ['as'=>'association.delete',AssociationController::class, 'delete'])->middleware('can:delete,App\Models\Association')->name('association.delete');

        //Area route
        Route::get('/area', ['as'=>'area',AreaController::class, 'index'])->middleware('can:read,App\Models\Area')->name('area');

        Route::get('/area/create', ['as'=>'area.create',AreaController::class, 'create'])->middleware('can:create,App\Models\Area')->name('area.create');

        Route::post('/area/store', ['as'=>'area.store',AreaController::class, 'store'])->middleware('can:create,App\Models\Area')->name('area.store');

        Route::get('/area/edit/{id?}', ['as'=>'area.edit',AreaController::class, 'edit'])->middleware('can:update,App\Models\Area')->name('area.edit');

        Route::put('/area/update/{id?}', ['as'=>'area.update',AreaController::class, 'update'])->middleware('can:update,App\Models\Area')->name('area.update');

        Route::get('/area/delete/{id?}/{sid?}', ['as'=>'area.delete',AreaController::class, 'delete'])->middleware('can:delete,App\Models\Area')->name('area.delete');

        //Branch route
        Route::get('/branch', ['as'=>'branch',BranchController::class, 'index'])->middleware('can:read,App\Models\Branch')->name('branch');

        Route::get('/branch/create', ['as'=>'branch.create',BranchController::class, 'create'])->middleware('can:create,App\Models\Branch')->name('branch.create');

        Route::post('/branch/store', ['as'=>'branch.store',BranchController::class, 'store'])->middleware('can:create,App\Models\Branch')->name('branch.store');

        Route::get('/branch/edit/{id?}', ['as'=>'branch.edit',BranchController::class, 'edit'])->middleware('can:update,App\Models\Branch')->name('branch.edit');

        Route::put('/branch/update/{id?}', ['as'=>'branch.update',BranchController::class, 'update'])->middleware('can:update,App\Models\Branch')->name('branch.update');

        Route::get('/branch/delete/{id?}/{sid?}', ['as'=>'branch.delete',BranchController::class, 'delete'])->middleware('can:delete,App\Models\Branch')->name('branch.delete');

        //BranchUnit route
        Route::get('/branch-unit', ['as'=>'branch_unit',BranchUnitController::class, 'index'])->middleware('can:read,App\Models\BranchUnit')->name('branch_unit');

        Route::get('/branch-unit/create', ['as'=>'branch_unit.create',BranchUnitController::class, 'create'])->middleware('can:create,App\Models\BranchUnit')->name('branch_unit.create');

        Route::post('/branch-unit/store', ['as'=>'branch_unit.store',BranchUnitController::class, 'store'])->middleware('can:create,App\Models\BranchUnit')->name('branch_unit.store');

        Route::get('/branch-unit/edit/{id?}', ['as'=>'branch_unit.edit',BranchUnitController::class, 'edit'])->middleware('can:update,App\Models\BranchUnit')->name('branch_unit.edit');

        Route::put('/branch-unit/update/{id?}', ['as'=>'branch_unit.update',BranchUnitController::class, 'update'])->middleware('can:update,App\Models\BranchUnit')->name('branch_unit.update');

        Route::get('/branch-unit/delete/{id?}/{sid?}', ['as'=>'branch_unit.delete',BranchUnitController::class, 'delete'])->middleware('can:delete,App\Models\BranchUnit')->name('branch_unit.delete');

    });

    Route::group(['prefix'=>'users'], function(){
        
        //User route
        Route::get('/user', ['as'=>'user',UserController::class, 'index'])->middleware('can:read,App\Models\User')->name('user');
        Route::get('/user-export', ['as'=>'user.export',UserController::class, 'export'])->name('user.export');
        Route::get('/user-pdf', ['as'=>'user.pdf',UserController::class, 'pdf'])->name('user.pdf');

        Route::get('/user/datatable', ['as'=>'user.datatable',UserController::class, 'datatable'])->middleware('can:read,App\Models\User')->name('user.datatable');

        Route::get('/user/view/{id?}', ['as'=>'user.view',UserController::class, 'view'])->middleware('can:view,App\Models\User')->name('user.view');
        
        Route::get('/user/print/{id?}', ['as'=>'user.print',UserController::class, 'print'])->middleware('can:print,App\Models\User')->name('user.print');

        Route::get('/user/create', ['as'=>'user.create',UserController::class, 'create'])->middleware('can:create,App\Models\User')->name('user.create');

        Route::post('/user/store', ['as'=>'user.store',UserController::class, 'store'])->middleware('can:create,App\Models\User')->name('user.store');
        Route::post('/user/search', ['as'=>'user.search',UserController::class, 'search'])->middleware('can:create,App\Models\User')->name('user.search');

        Route::get('/user/edit/{id?}', ['as'=>'user.edit',UserController::class, 'edit'])->middleware('can:update,App\Models\User')->name('user.edit');

        Route::put('/user/update/{id?}', ['as'=>'user.update',UserController::class, 'update'])->middleware('can:update,App\Models\User')->name('user.update');

        Route::get('/user/delete/{id?}/{sid?}', ['as'=>'user.delete',UserController::class, 'delete'])->middleware('can:delete,App\Models\User')->name('user.delete');


        //Admin route
        Route::get('/admin', ['as'=>'admin',AdminController::class, 'index'])->middleware('can:read,App\Models\Admin')->name('admin');
        Route::get('/admin-export', ['as'=>'admin.export',AdminController::class, 'export'])->name('admin.export');
        Route::get('/admin-pdf', ['as'=>'admin.pdf',AdminController::class, 'pdf'])->name('admin.pdf');

        Route::get('/admin/datatable', ['as'=>'admin.datatable',AdminController::class, 'datatable'])->middleware('can:read,App\Models\Admin')->name('admin.datatable');

        Route::get('/admin/create', ['as'=>'admin.create',AdminController::class, 'create'])->middleware('can:create,App\Models\Admin')->name('admin.create');

        Route::post('/admin/store', ['as'=>'admin.store',AdminController::class, 'store'])->middleware('can:create,App\Models\Admin')->name('admin.store');

        Route::get('/admin/edit/{id?}', ['as'=>'admin.edit',AdminController::class, 'edit'])->middleware('can:update,App\Models\Admin')->name('admin.edit');

        Route::put('/admin/update/{id?}', ['as'=>'admin.update',AdminController::class, 'update'])->middleware('can:update,App\Models\Admin')->name('admin.update');

        Route::get('/admin/delete/{id?}/{sid?}', ['as'=>'admin.delete',AdminController::class, 'delete'])->middleware('can:delete,App\Models\Admin')->name('admin.delete');

        //BranchUser route
        Route::get('/branch-user', ['as'=>'branch_user',BranchUserController::class, 'index'])->middleware('can:read,App\Models\BranchUser')->name('branch_user');
        Route::get('/branch-user-export', ['as'=>'branch_user.export',BranchUserController::class, 'export'])->name('branch_user.export');
        Route::get('/branch-user-pdf', ['as'=>'branch_user.pdf',BranchUserController::class, 'pdf'])->name('branch_user.pdf');

        Route::get('/branch-user/datatable', ['as'=>'branch_user.datatable',BranchUserController::class, 'datatable'])->middleware('can:read,App\Models\BranchUser')->name('branch_user.datatable');

        Route::get('/branch-user/create', ['as'=>'branch_user.create',BranchUserController::class, 'create'])->middleware('can:create,App\Models\BranchUser')->name('branch_user.create');

        Route::post('/branch-user/store', ['as'=>'branch_user.store',BranchUserController::class, 'store'])->middleware('can:create,App\Models\BranchUser')->name('branch_user.store');

        Route::get('/branch-user/edit/{id?}', ['as'=>'branch_user.edit',BranchUserController::class, 'edit'])->middleware('can:update,App\Models\BranchUser')->name('branch_user.edit');

        Route::put('/branch-user/update/{id?}', ['as'=>'branch_user.update',BranchUserController::class, 'update'])->middleware('can:update,App\Models\BranchUser')->name('branch_user.update');

        Route::get('/branch-user/delete/{id?}/{sid?}', ['as'=>'branch_user.delete',BranchUserController::class, 'delete'])->middleware('can:delete,App\Models\BranchUser')->name('branch_user.delete');


    });
    
    Route::group(['prefix'=>'master'], function(){
        
        // //Size route
        // Route::get('/size', ['as'=>'size',SizeController::class, 'index'])->middleware('can:read,App\Models\Size')->name('size');

        // Route::get('/size/create', ['as'=>'size.create',SizeController::class, 'create'])->middleware('can:create,App\Models\Size')->name('size.create');

        // Route::post('/size/store', ['as'=>'size.store',SizeController::class, 'store'])->middleware('can:create,App\Models\Size')->name('size.store');

        // Route::get('/size/edit/{id?}', ['as'=>'size.edit',SizeController::class, 'edit'])->middleware('can:update,App\Models\Size')->name('size.edit');

        // Route::put('/size/update/{id?}', ['as'=>'size.update',SizeController::class, 'update'])->middleware('can:update,App\Models\Size')->name('size.update');

        // Route::get('/size/delete/{id?}/{sid?}', ['as'=>'size.delete',SizeController::class, 'delete'])->middleware('can:delete,App\Models\Size')->name('size.delete');

        // //Condition route
        // Route::get('/condition', ['as'=>'condition',ConditionController::class, 'index'])->middleware('can:read,App\Models\Condition')->name('condition');

        // Route::get('/condition/create', ['as'=>'condition.create',ConditionController::class, 'create'])->middleware('can:create,App\Models\Condition')->name('condition.create');

        // Route::post('/condition/store', ['as'=>'condition.store',ConditionController::class, 'store'])->middleware('can:create,App\Models\Condition')->name('condition.store');

        // Route::get('/condition/edit/{id?}', ['as'=>'condition.edit',ConditionController::class, 'edit'])->middleware('can:update,App\Models\Condition')->name('condition.edit');

        // Route::put('/condition/update/{id?}', ['as'=>'condition.update',ConditionController::class, 'update'])->middleware('can:update,App\Models\Condition')->name('condition.update');

        // Route::get('/condition/delete/{id?}/{sid?}', ['as'=>'condition.delete',ConditionController::class, 'delete'])->middleware('can:delete,App\Models\Condition')->name('condition.delete');

        // //Color route
        // Route::get('/color', ['as'=>'color',ColorController::class, 'index'])->middleware('can:read,App\Models\Color')->name('color');

        // Route::get('/color/create', ['as'=>'color.create',ColorController::class, 'create'])->middleware('can:create,App\Models\Color')->name('color.create');

        // Route::post('/color/store', ['as'=>'color.store',ColorController::class, 'store'])->middleware('can:create,App\Models\Color')->name('color.store');

        // Route::get('/color/edit/{id?}', ['as'=>'color.edit',ColorController::class, 'edit'])->middleware('can:update,App\Models\Color')->name('color.edit');

        // Route::put('/color/update/{id?}', ['as'=>'color.update',ColorController::class, 'update'])->middleware('can:update,App\Models\Color')->name('color.update');

        // Route::get('/color/delete/{id?}/{sid?}', ['as'=>'color.delete',ColorController::class, 'delete'])->middleware('can:delete,App\Models\Color')->name('color.delete');


        //OfficeType route
        Route::get('/office-type', ['as'=>'office_type',OfficeTypeController::class, 'index'])->middleware('can:read,App\Models\OfficeType')->name('office_type');

        Route::get('/office-type/create', ['as'=>'office_type.create',OfficeTypeController::class, 'create'])->middleware('can:create,App\Models\OfficeType')->name('office_type.create');

        Route::post('/office-type/store', ['as'=>'office_type.store',OfficeTypeController::class, 'store'])->middleware('can:create,App\Models\OfficeType')->name('office_type.store');

        Route::get('/office-type/edit/{id?}', ['as'=>'office_type.edit',OfficeTypeController::class, 'edit'])->middleware('can:update,App\Models\OfficeType')->name('office_type.edit');

        Route::put('/office-type/update/{id?}', ['as'=>'office_type.update',OfficeTypeController::class, 'update'])->middleware('can:update,App\Models\OfficeType')->name('office_type.update');

        Route::get('/office-type/delete/{id?}/{sid?}', ['as'=>'office_type.delete',OfficeTypeController::class, 'delete'])->middleware('can:delete,App\Models\OfficeType')->name('office_type.delete');
        
        //ServiceType route
        Route::get('/service-type', ['as'=>'service_type',ServiceTypeController::class, 'index'])->middleware('can:read,App\Models\ServiceType')->name('service_type');

        Route::get('/service-type/create', ['as'=>'service_type.create',ServiceTypeController::class, 'create'])->middleware('can:create,App\Models\ServiceType')->name('service_type.create');

        Route::post('/service-type/store', ['as'=>'service_type.store',ServiceTypeController::class, 'store'])->middleware('can:create,App\Models\ServiceType')->name('service_type.store');

        Route::get('/service-type/edit/{id?}', ['as'=>'service_type.edit',ServiceTypeController::class, 'edit'])->middleware('can:update,App\Models\ServiceType')->name('service_type.edit');

        Route::put('/service-type/update/{id?}', ['as'=>'service_type.update',ServiceTypeController::class, 'update'])->middleware('can:update,App\Models\ServiceType')->name('service_type.update');

        Route::get('/service-type/delete/{id?}/{sid?}', ['as'=>'service_type.delete',ServiceTypeController::class, 'delete'])->middleware('can:delete,App\Models\ServiceType')->name('service_type.delete');

        //Service route
        Route::get('/service', ['as'=>'service',ServiceController::class, 'index'])->middleware('can:read,App\Models\Service')->name('service');

        Route::get('/service/create', ['as'=>'service.create',ServiceController::class, 'create'])->middleware('can:create,App\Models\Service')->name('service.create');

        Route::post('/service/store', ['as'=>'service.store',ServiceController::class, 'store'])->middleware('can:create,App\Models\Service')->name('service.store');

        Route::get('/service/edit/{id?}', ['as'=>'service.edit',ServiceController::class, 'edit'])->middleware('can:update,App\Models\Service')->name('service.edit');

        Route::put('/service/update/{id?}', ['as'=>'service.update',ServiceController::class, 'update'])->middleware('can:update,App\Models\Service')->name('service.update');

        Route::get('/service/delete/{id?}/{sid?}', ['as'=>'service.delete',ServiceController::class, 'delete'])->middleware('can:delete,App\Models\Service')->name('service.delete');
    
        //Approval route
        Route::get('/approval', ['as'=>'approval',ApprovalController::class, 'index'])->middleware('can:read,App\Models\Approval')->name('approval');

        Route::get('/approval/create', ['as'=>'approval.create',ApprovalController::class, 'create'])->middleware('can:create,App\Models\Approval')->name('approval.create');

        Route::post('/approval/store', ['as'=>'approval.store',ApprovalController::class, 'store'])->middleware('can:create,App\Models\Approval')->name('approval.store');

        Route::get('/approval/edit/{id?}', ['as'=>'approval.edit',ApprovalController::class, 'edit'])->middleware('can:update,App\Models\Approval')->name('approval.edit');

        Route::put('/approval/update/{id?}', ['as'=>'approval.update',ApprovalController::class, 'update'])->middleware('can:update,App\Models\Approval')->name('approval.update');

        Route::get('/approval/delete/{id?}/{sid?}', ['as'=>'approval.delete',ApprovalController::class, 'delete'])->middleware('can:delete,App\Models\Approval')->name('approval.delete');
    
    });


    Route::group(['prefix'=>'applications'], function(){
        
        //Application route
        Route::get('/application', ['as'=>'application',ApplicationController::class, 'index'])->middleware('can:read,App\Models\Application')->name('application');
    
        Route::get('/application/create', ['as'=>'application.create',ApplicationController::class, 'create'])->middleware('can:create,App\Models\Application')->name('application.create');
    
        Route::post('/application/store', ['as'=>'application.store',ApplicationController::class, 'store'])->middleware('can:create,App\Models\Application')->name('application.store');
    
        Route::get('/application/edit/{id?}', ['as'=>'application.edit',ApplicationController::class, 'edit'])->middleware('can:update,App\Models\Application')->name('application.edit');
    
        Route::put('/application/update/{id?}', ['as'=>'application.update',ApplicationController::class, 'update'])->middleware('can:update,App\Models\Application')->name('application.update');
    
        Route::get('/application/edit-approval/{id?}', ['as'=>'application.edit_approval',ApplicationController::class, 'edit_approval'])->middleware('can:update_approval,App\Models\Application')->name('application.edit_approval');
    
        Route::put('/application/update-approval/{id?}', ['as'=>'application.update_approval',ApplicationController::class, 'update_approval'])->middleware('can:update_approval,App\Models\Application')->name('application.update_approval');
    
        Route::get('/application/delete/{id?}/{sid?}', ['as'=>'application.delete',ApplicationController::class, 'delete'])->middleware('can:delete,App\Models\Application')->name('application.delete');
        Route::get('/application-file/delete/{id?}/{sid?}', ['as'=>'application_file.delete',ApplicationController::class, 'delete_file'])->middleware('can:delete,App\Models\Application')->name('application_file.delete');
        

        //Applicationdeclined route
        Route::get('/applicationdeclined', ['as'=>'applicationdeclined',ApplicationdeclinedController::class, 'index'])->middleware('can:read,App\Models\Applicationdeclined')->name('applicationdeclined');
    
        Route::get('/applicationdeclined/create', ['as'=>'applicationdeclined.create',ApplicationdeclinedController::class, 'create'])->middleware('can:create,App\Models\Applicationdeclined')->name('applicationdeclined.create');
    
        Route::post('/applicationdeclined/store', ['as'=>'applicationdeclined.store',ApplicationdeclinedController::class, 'store'])->middleware('can:create,App\Models\Applicationdeclined')->name('applicationdeclined.store');
    
        Route::get('/applicationdeclined/edit/{id?}', ['as'=>'applicationdeclined.edit',ApplicationdeclinedController::class, 'edit'])->middleware('can:update,App\Models\Applicationdeclined')->name('applicationdeclined.edit');
    
        Route::put('/applicationdeclined/update/{id?}', ['as'=>'applicationdeclined.update',ApplicationdeclinedController::class, 'update'])->middleware('can:update,App\Models\Applicationdeclined')->name('applicationdeclined.update');
    
        Route::get('/applicationdeclined/edit-approval/{id?}', ['as'=>'applicationdeclined.edit_approval',ApplicationdeclinedController::class, 'edit_approval'])->middleware('can:update_approval,App\Models\Applicationdeclined')->name('applicationdeclined.edit_approval');
    
        Route::put('/applicationdeclined/update-approval/{id?}', ['as'=>'applicationdeclined.update_approval',ApplicationdeclinedController::class, 'update_approval'])->middleware('can:update_approval,App\Models\Applicationdeclined')->name('applicationdeclined.update_approval');
    
        Route::get('/applicationdeclined/delete/{id?}/{sid?}', ['as'=>'applicationdeclined.delete',ApplicationdeclinedController::class, 'delete'])->middleware('can:delete,App\Models\Applicationdeclined')->name('applicationdeclined.delete');
        Route::get('/applicationdeclined-file/delete/{id?}/{sid?}', ['as'=>'applicationdeclined_file.delete',ApplicationdeclinedController::class, 'delete_file'])->middleware('can:delete,App\Models\Applicationdeclined')->name('applicationdeclined_file.delete');
   
        //Applicationreview route
        Route::get('/applicationreview', ['as'=>'applicationreview',ApplicationreviewController::class, 'index'])->middleware('can:read,App\Models\Applicationreview')->name('applicationreview');
    
        Route::get('/applicationreview/create', ['as'=>'applicationreview.create',ApplicationreviewController::class, 'create'])->middleware('can:create,App\Models\Applicationreview')->name('applicationreview.create');
    
        Route::post('/applicationreview/store', ['as'=>'applicationreview.store',ApplicationreviewController::class, 'store'])->middleware('can:create,App\Models\Applicationreview')->name('applicationreview.store');
    
        Route::get('/applicationreview/edit/{id?}', ['as'=>'applicationreview.edit',ApplicationreviewController::class, 'edit'])->middleware('can:update,App\Models\Applicationreview')->name('applicationreview.edit');
    
        Route::put('/applicationreview/update/{id?}', ['as'=>'applicationreview.update',ApplicationreviewController::class, 'update'])->middleware('can:update,App\Models\Applicationreview')->name('applicationreview.update');
    
        Route::get('/applicationreview/edit-approval/{id?}', ['as'=>'applicationreview.edit_approval',ApplicationreviewController::class, 'edit_approval'])->middleware('can:update_approval,App\Models\Applicationreview')->name('applicationreview.edit_approval');
    
        Route::put('/applicationreview/update-approval/{id?}', ['as'=>'applicationreview.update_approval',ApplicationreviewController::class, 'update_approval'])->middleware('can:update_approval,App\Models\Applicationreview')->name('applicationreview.update_approval');
    
        Route::get('/applicationreview/delete/{id?}/{sid?}', ['as'=>'applicationreview.delete',ApplicationreviewController::class, 'delete'])->middleware('can:delete,App\Models\Applicationreview')->name('applicationreview.delete');
        Route::get('/applicationreview-file/delete/{id?}/{sid?}', ['as'=>'applicationreview_file.delete',ApplicationreviewController::class, 'delete_file'])->middleware('can:delete,App\Models\Applicationreview')->name('applicationreview_file.delete');
   

        //Applicationcomplete route
        Route::get('/applicationcomplete', ['as'=>'applicationcomplete',ApplicationcompleteController::class, 'index'])->middleware('can:read,App\Models\Applicationcomplete')->name('applicationcomplete');
    
        Route::get('/applicationcomplete/create', ['as'=>'applicationcomplete.create',ApplicationcompleteController::class, 'create'])->middleware('can:create,App\Models\Applicationcomplete')->name('applicationcomplete.create');
    
        Route::post('/applicationcomplete/store', ['as'=>'applicationcomplete.store',ApplicationcompleteController::class, 'store'])->middleware('can:create,App\Models\Applicationcomplete')->name('applicationcomplete.store');
    
        Route::get('/applicationcomplete/edit/{id?}', ['as'=>'applicationcomplete.edit',ApplicationcompleteController::class, 'edit'])->middleware('can:update,App\Models\Applicationcomplete')->name('applicationcomplete.edit');
    
        Route::put('/applicationcomplete/update/{id?}', ['as'=>'applicationcomplete.update',ApplicationcompleteController::class, 'update'])->middleware('can:update,App\Models\Applicationcomplete')->name('applicationcomplete.update');
    
        Route::get('/applicationcomplete/edit-approval/{id?}', ['as'=>'applicationcomplete.edit_approval',ApplicationcompleteController::class, 'edit_approval'])->middleware('can:update_approval,App\Models\Applicationcomplete')->name('applicationcomplete.edit_approval');
    
        Route::put('/applicationcomplete/update-approval/{id?}', ['as'=>'applicationcomplete.update_approval',ApplicationcompleteController::class, 'update_approval'])->middleware('can:update_approval,App\Models\Applicationcomplete')->name('applicationcomplete.update_approval');
    
        Route::get('/applicationcomplete/delete/{id?}/{sid?}', ['as'=>'applicationcomplete.delete',ApplicationcompleteController::class, 'delete'])->middleware('can:delete,App\Models\Applicationcomplete')->name('applicationcomplete.delete');
        Route::get('/applicationcomplete-file/delete/{id?}/{sid?}', ['as'=>'applicationcomplete_file.delete',ApplicationcompleteController::class, 'delete_file'])->middleware('can:delete,App\Models\Applicationcomplete')->name('applicationcomplete_file.delete');
    });

});
