<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::get('students', 'Api\Student\StudentController@student');  // Вывод всех студентов
Route::get('students/{id}/get', 'Api\Student\StudentController@studentById'); // Получаем определенного студента по id

Route::post('students/add', 'Api\Student\StudentController@studentSave'); // Добавляем студента
Route::post('login', 'Api\Auth\LoginController@login'); // Аутентификация


Route::put('students/{id}/edit', 'Api\Student\StudentController@studentEdit'); // Изменяем данные у определенного студента
Route::delete('students/{id}/delete', 'Api\Student\StudentController@studentDelete'); // Удаляем определенного студлента из базы
