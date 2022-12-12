<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\GeneralController;

use App\Http\Controllers\API\LendController;
use App\Http\Controllers\API\SubscribeController;

use App\Http\Controllers\API\VacationalCourse;
use App\Http\Controllers\API\SportField;

//pruebas



//sin login
Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::post('sector',[GeneralController::class,'sectors']);//muestra los sectores
Route::post('activity',[GeneralController::class,'activities']);//muestra las actividades

//search

Route::prefix('search')->group(function(){
    Route::post('byActivity', [GeneralController::class,'ByActivity']);//lista por actividad
    Route::post('bySector', [GeneralController::class,'BySector']);//lista por sector

    Route::prefix('byHour')->group(function(){
        Route::post('', [GeneralController::class,'byTime']);//lista por tiempo/*
        /*Route::post('start', [GeneralController::class,'byHour']);//lista por hora de inicio
        Route::post('end', [GeneralController::class,'byEnd']);//lista por hora de finalizacion
        Route::post('between', [GeneralController::class,'byBetween']);//lista por un rango de tiempo */
    });
});

//cursos
Route::prefix('course')->group(function () {
    Route::post('',[SubscribeController::class,'listcourse']);
    Route::prefix('search')->group(function(){
        Route::post('byActivity', [SubscribeController::class,'ByActivity']);
        Route::post('bySector',[SubscribeController::class,'BySector']);
    });
    //Route::post('scheduleByCourse?={id}',[LendController::class,'schedule']);//lista el horario de las canchas

});


//canchas
Route::prefix('field')->group(function () {
    Route::post('',[LendController::class,'listSFields']);//lista todas las canchas existentes
    Route::prefix('search')->group(function(){
        Route::post('byActivity', [LendController::class,'ByActivity']);
        Route::post('bySector',[LendController::class,'BySector']);
    });

    Route::post('scheduleByField',[LendController::class,'schedule']);//lista el horario de las canchas
});

//iniciado sesion

Route::group(['middleware'=>['auth:sanctum']], function () {
    Route::post('logout',[AuthController::class,'logout']);
    Route::prefix('denizen')->group(function () {
        Route::post('', [GeneralController::class,'profile']);
        Route::post('lend', [LendController::class,'lend']);
        Route::post('quitLend', [LendController::class,'quitLend']);
        Route::post('subscribe', [SubscribeController::class,'inscription']);
        Route::post('desubscribe', [SubscribeController::class,'desubscribe']);
        Route::post('myCourses', [SubscribeController::class,'listDenizen']);
        Route::post('mySFields', [LendController::class,'listDenizen']);
     });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('admin')->group(function () {
    Route::post('', [GeneralController::class,'profile']);
    Route::prefix('sportField')->group(function () {
        Route::post('', [LendController::class,'listSFields']);
        Route::post('modify', [SportField::class,'update']);
        Route::post('delete', [SportField::class,'delete']);
        Route::post('create', [SportField::class,'create']);
        Route::post('show', [SportField::class,'show']);
    });
    Route::prefix('vacationalCourse')->group(function () {
        Route::post('', [SubscribeController::class,'listcourse']);
        Route::post('modify', [VacationalCourse::class,'update']);
        Route::post('delete', [VacationalCourse::class,'delete']);
        Route::post('create', [VacationalCourse::class,'create']);
        Route::post('show', [VacationalCourse::class,'show']);
    });

    Route::prefix('schedule')->group(function () {
        Route::post('', [SubscribeController::class,'listcourse']);//canchas en general
        Route::post('modify', [VacationalCourse::class,'update']);//cambiar una cancha
        Route::post('delete', [VacationalCourse::class,'delete']);
        Route::post('create', [VacationalCourse::class,'create']);
        Route::post('show', [VacationalCourse::class,'show']);
    });

    Route::prefix('scheduleVacationalCourse')->group(function () {
        Route::post('', [SubscribeController::class,'listcourse']);//canchas en general
        Route::post('modify', [VacationalCourse::class,'update']);//cambiar una cancha
        Route::post('delete', [VacationalCourse::class,'delete']);
        Route::post('create', [VacationalCourse::class,'create']);
        Route::post('show', [VacationalCourse::class,'show']);
    });

    Route::prefix('scheduleSportfield')->group(function () {
        Route::post('', [SubscribeController::class,'listcourse']);//canchas en general
        Route::post('modify', [VacationalCourse::class,'update']);//cambiar una cancha
        Route::post('delete', [VacationalCourse::class,'delete']);
        Route::post('create', [VacationalCourse::class,'create']);
        Route::post('show', [VacationalCourse::class,'show']);
    });


 });
