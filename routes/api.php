<?php
  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\NurseController;
use App\Http\Controllers\API\PatientController;
use App\Http\Controllers\API\BookingController;
  
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
  
Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
     
Route::middleware('auth:api')->group( function () {

    Route::group(['prefix' => 'patient'], function () {
        Route::post('update_personal_info', [PatientController::class, 'update_personal_information_of_patient']);
        Route::post('patient_medical_information', [PatientController::class,'patient_medical_information']);
        Route::post('patient_insurance_information', [PatientController::class,'patient_insurance_information']);
        Route::post('patient_emergency_contact', [PatientController::class,'patient_emergency_contact']);
        Route::post('patient_preferences', [PatientController::class,'patient_preferences']);
        Route::get('info/{id}', [PatientController::class,'get_patient_info']);
    });

    Route::group(['prefix' => 'nurse'], function () {
        Route::post('update_personal_info_nurse', [NurseController::class, 'update_personal_information_of_nurse']);
        Route::post('nurse_professional_information', [NurseController::class,'nurse_professional_information']);
        Route::post('nurse_professional_references', [NurseController::class,'nurse_professional_references']);
        Route::post('nurse_professional_background_check', [NurseController::class,'nurse_professional_background_check']);
        Route::post('nurse_education', [NurseController::class,'nurse_education']);
        Route::post('nurse_certifications', [NurseController::class,'nurse_certifications']);
        Route::post('nurse_reviews', [NurseController::class,'nurse_reviews']);
        Route::post('nurse_upload_documents', [NurseController::class,'nurse_upload_documents']);
        Route::post('set_weekly_schedule', [NurseController::class,'set_weekly_schedule']);
        Route::post('set_availability', [NurseController::class,'set_availability']);
        Route::get('info/{id}', [NurseController::class,'get_nurse_info']);
        Route::get('list', [NurseController::class,'get_all_nurse']);
    });

    Route::group(['prefix' => 'booking'], function () {
        Route::get('getAvailableTimeSlot', [BookingController::class, 'get_available_booking_slot']);
        Route::get('confirm', [BookingController::class, 'book_appointment']);
    });
    
});
