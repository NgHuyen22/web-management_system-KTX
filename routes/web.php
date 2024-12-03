<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\approve_request\ApproveRequestController;
use App\Http\Controllers\student\StudentController;
use App\Http\Controllers\admin\StudentManagementController\StudentManagementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\admin\area_management\AreaManagementController;
use App\Http\Controllers\admin\Csvc_management\CSVCManagementController;
use App\Http\Controllers\admin\room_management\RoomManagementController;
use App\Http\Controllers\student\RegisterRepaircsvcController;
use App\Http\Controllers\student\RoomRegistrationController;
use App\Http\Controllers\student\ViewPaymentStatusController;



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

Route::get('/insertUser',[UserController::class,'insert'])->name('insertUser');
Route::post('/insertUser',[UserController::class,'insertCB']);

Route::get('/insertUser/student',[UserController::class,'form_add_sv'])->name('insertUser.student');
Route::post('/insertUser/student',[UserController::class,'insertSV']);

//login_cb 
Route::get('/admin/login', [HomeController::class, 'login']) -> name('admin.login'); // cần login mới vào trang admin nên kh thẩy th này dô group admin
Route::post('/admin/login', [HomeController::class, 'check_login']) ;

//middle của cbql
Route::group(['middleware' => 'auth'], function(){
    //trang_chu
    Route::get('/', [ HomeController::class, 'index']) ;
   
    //quan_ly_khu

    Route::get(' /area_management',[AdminController::class, 'index']) ;

    Route::prefix('area_management')-> name('area_management.')->group(function () {
        Route::get('/add_area', [AreaManagementController::class, 'add_area']) -> name('add_area');
        Route::post('/add_area',[AreaManagementController::class, 'save_area']) -> name('save_area');
        Route::post('/find_area',[AreaManagementController::class, 'find_area']) -> name('find_area');
        Route::get('/form_edit_area/area_code={makhu}',[AreaManagementController::class, 'form_edit_area']) -> name('form_edit_area');
        Route::post('/form_edit_area/update_area',[AreaManagementController::class, 'update_area']) -> name('update_area');
        Route::get('/delete_area/delete_area-code={makhu}',[AreaManagementController::class, 'delete_area']) -> name('delete_area');
    });

    //Xem thông tin cá nhân
    Route::get('/profile_cbql',[AdminController::class,'profile']) -> name('profile');

    // //quan_ly_phong
    Route::get('/room_management',[AdminController::class, 'room'])  -> name('room_management');

    Route::prefix('room_management')-> name('room_management.')->group(function () {
        Route::get('/add_room', [RoomManagementController::class, 'add_room']) -> name('add_room');
        Route::post('/add_room/save_room',[RoomManagementController::class,'save_room']) -> name('save_room');
        Route::post('/form_edit/room_code={maphong}', [RoomManagementController::class, 'form_edit']) -> name('form_edit');
        Route::patch('/form_edit/update_room', [RoomManagementController::class, 'update_room']) -> name('update_room');
        Route::get('/form_edit/delete_room-code={maphong}', [RoomManagementController::class, 'delete_room']) -> name('delete_room');
    });

    //Duyet yeu cầu
    Route::get('/approve_request',[ApproveRequestController::class, 'approve_request'])  -> name('approve_request');
    Route::post('/approve_request/room_registration',[ApproveRequestController::class, 'acp_room_registration'])  -> name('approve_request.room_registration');
    Route::post('/approve_request/room_registration/giveback_form',[ApproveRequestController::class, 'acp_giveback_form'])  -> name('approve_request.room_registration.giveback_form');
    Route::post('/approve_request/room_registration/csvc_repair_form',[ApproveRequestController::class, 'acp_csvc_repair_register'])  -> name('approve_request.acp_csvc_repair_register');
    
    //QL_SV
    Route::get('/student_management',[AdminController::class,'student_management']) ->name('student_management');
    Route::prefix('student_management') ->name('student_management.') ->group(function(){
        Route::post('/student_management/delete_student_ktx',[StudentManagementController::class,'delete_sv']) ->name('delete_sv');
        Route::get('/student_management/delete_checked_student_ktx',[StudentManagementController::class,'checked_delete_sv']) ->name('checked_delete_sv');
       
     
    });
    //QL_HOADON
    Route::get('/bills_management',[AdminController::class,'bills_management']) ->name('bills_management');
    
    //QL_CSVC
    Route::get('/csvc_management',[AdminController::class,'csvc_management']) ->name('csvc_management');
    Route::prefix('csvc_management') ->name('csvc_management.') ->group(function(){
        Route::post('/csvc_management/add_csvc_room',[CSVCManagementController::class,'add_csvc_room']) ->name('add_csvc_room');
        Route::post('/csvc_management/insert_csvc_room',[CSVCManagementController::class,'insert_csvc_room']) -> name('insert');
        Route::post('/csvc_management/edit_csvc_form/id={ma_csvc}',[CSVCManagementController::class,'edit_csvc_room']) ->name('edit_csvc');
        Route::post('/csvc_management/delete_csvc_room',[CSVCManagementController::class,'delete_csvc_room']) ->name('delete_csvc_room');
        Route::post('/csvc_management/update_csvc',[CSVCManagementController::class,'update_csvc']) ->name('update_csvc');
        Route::post('/csvc_management/delete_csvc',[CSVCManagementController::class,'delete_csvc']) ->name('delete_csvc');
    });

    Route::get('/admin/logout',[HomeController::class,'logout'])->name('admin.logout');
});
// });


//sinh_vien
//login_sv
Route::get('/student/login', [HomeController::class, 'login_student'])->name('student.login');
Route::post('/student/login', [HomeController::class, 'check_login_student']);

    //middle cho các route cua sv
// Route::prefix('student')->middleware('student.auth')->group(function () {
    Route::group(['middleware' => 'student.auth'], function(){  

    Route::get('/student_index', [StudentController::class, 'student_index'])->name('student_index');
    Route::get('/adduser', [StudentController::class,'add_user']);

        //Xem thông tin cá nhân
     Route::get('/profile_sv',[StudentController::class,'profile']) -> name('student.profile');
     Route::get('/profile_sv/delete_form',[StudentController::class,'cancle_form']) -> name('student.profile.cancle_form');
     Route::get('/profile_sv/delete_form_changes',[StudentController::class,'cancle_form_changes']) -> name('student.profile.cancle_form_changes');
     
     //dang_ky_phong
     Route::prefix('/student/register') -> name('student.register.') -> group(function(){
         Route::get('/room_registration', [RoomRegistrationController::class, 'room_registration']) -> name('room_registration');
         Route::post('/create_form/id_room={maphong_register}', [RoomRegistrationController::class, 'create_form']) ->name('create_form') ;
         Route::post('/insert_form', [RoomRegistrationController::class, 'insert_form']) ->name('insert_form') ;
         Route::post('/create_form_changes/id_room={maphong_register}', [RoomRegistrationController::class, 'create_form_changes']) ->name('create_form_changes') ;
         Route::post('/changes_room', [RoomRegistrationController::class, 'changes_room']) ->name('changes_room') ;   
         Route::get('/give_back_room', [RoomRegistrationController::class, 'create_give_back_form']) ->name('create_give_back_room') ;   
         Route::get('/profile_sv/delete_form_give_back',[StudentController::class,'cancle_form_giveback']) -> name('student.profile.cancle_form_giveback');
         Route::get('/register_repair_csvc',[RegisterRepairCsvcController::class,'register_repair_csvc']) -> name('register_repair_csvc');
         Route::post('/register_repair_csvc',[RegisterRepairCsvcController::class,'insert_register_repair']);
         Route::post('/register_repair_csvc/cancle_csvc_repair_form',[RegisterRepairCsvcController::class,'cancle_csvc_repair_form']) -> name('cancle_csvc_repair_form');

    });

    //xem_trang_thai_dong phi
    Route::get('/view_payment_status1', [ViewPaymentStatusController::class, 'view_payment_status1']) -> name('view_payment_status1');
    
    //thanh_toan
    Route::get('/pay', [ViewPaymentStatusController::class, 'pay']) -> name('pay');
    Route::prefix('/pay') -> name('pay.') -> group(function(){
        Route::post('/processing', [ViewPaymentStatusController::class, 'processing']) -> name('processing');
    });
    //dang_xuat
    Route::get('/student/logout',[HomeController::class,'logoutSv'])->name('student.logout');
});











