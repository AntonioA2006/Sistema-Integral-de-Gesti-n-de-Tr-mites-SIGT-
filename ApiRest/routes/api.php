<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormalitieController;
use App\Http\Controllers\RequirementsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\TypeOfProcedures;
use App\Http\Controllers\UserManagementController;

use App\Http\Middleware\CheckUserRole;

use Illuminate\Support\Facades\Route;


Route::post("/login", [AuthController::class, 'login']);


Route::middleware(['auth:sanctum', CheckUserRole::class . ':admin'])->group(function () {
    Route::post('/create', [UserManagementController::class, 'create_user']);
    Route::delete('/delete/user/{id}/{curp}', [UserManagementController::class, 'delete']);
    Route::put('/update/{id}', [UserManagementController::class, 'updated_user']);
    Route::put('/disable/user/{id}', [UserManagementController::class, 'disabled_state']);
        //TODO  VAMOS ALA PARTE DIFIL DEL PROYECTO DERIVAR TRRAMITES A OTRO SECCIONES
    Route::group(['prefix' => 'procedures'], function () {





        // Crear tipos de trámites
        Route::post('/create/type', [TypeOfProcedures::class, 'create']);
        Route::put('/updated/type/{id}',[TypeOfProcedures::class, 'update']);
        Route::delete('/delete/type/{id}',[TypeOfProcedures::class, 'delete']);

        // Crear el trámite
        Route::post('/create/formalities', [FormalitieController::class, 'create']);
        // Asignar requisitos específicos a cada trámite

        Route::post('/create/requirements', [RequirementsController::class, 'create']);
        Route::put('/update/requirements/{id}', [RequirementsController::class, 'update']);
        Route::delete('/delete/requirements/{id}', [RequirementsController::class, 'delete']);
        //aqui puedes un requistos solo si este no pertece a un tramite
    });
});









Route::group(['prefix' => 'user-module'],function(){



    Route::get('/show', [UserManagementController::class, 'show'])->middleware('auth:sanctum');


    //para mostrar usuarios
    //to show users

    Route::get('/show/user/{id}',[UserManagementController::class, 'show_only'])->name('show_only');


    //crear o actualizar
    //create or update

    //delete or desactived

    //este end ppoint cumple las dos acciones desactiar alos usuarios y activarlos dependiendo el caso

    //el eliminar no venia definido en el sitema pero lo agrege de todos modos jejejejej

});



//buenop antes de hcaer los mddilewares de acceso tenderemos que hacer endpoints para crar roles y
//despues crear sections para utilizar esos mismos modelos para los roles

Route::group(['prefix' => 'permissions'],function(){
    Route::post('/create/role', [RoleController::class, 'create']);

    Route::post('/create/section',[SectionController::class, 'create']);
});
