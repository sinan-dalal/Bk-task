<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Dashboard\AuthController;
use App\Http\Controllers\API\Dashboard\SchoolController;
use App\Http\Controllers\API\Dashboard\StudentController;

/*===================================
=            admin login           =
===================================*/
Route::post('login', [AuthController::class, 'login'])->name('login');
/*=====  End of admin login  ======*/


/*=================================
=           schools              =
=================================*/
Route::apiResource('/schools', SchoolController::class);
/*=====  End of schools   ======*/

/*=================================
=           students              =
=================================*/
Route::apiResource('/students', StudentController::class);
/*=====  End of students   ======*/
