<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Api\Controller;
use Illuminate\Http\Request;

use App\Models\StudentModel;

use Validator;

class StudentController extends Controller
{
    public function student() {

        try {
            $user = auth()->UserOrFail();

        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return response()->json(['error' => true, 'message' => $e->getMessage()], 401);
        }
        return response()->json(StudentModel::get(), 200); // Получаем всех студентов
    }
    
    public function studentById($id) {
        $student = StudentModel::find($id);
        if (is_null($student)) {
            return response()->json(['error'=>true, 'message' => 'not found'], 404);
        } 
        return response()->json($student, 200);  // Получаем определенного студента с ID
    }

    public function studentSave(Request $req) {
        $rules = [ // Правила валидации
            'name' => 'required|min:2|max:10',
            'age' => 'required|max:3',
            'teacher' => 'required|min:3',
            'grade' => 'required|min:1',
            'birthday' => 'required|min:3'
          

        ]; 
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $student = StudentModel::create($req->all());
        return response()->json($student, 201);  // Добавляем определенного студента с помощью /add 
    }

    public function studentEdit(Request $req, $id) {
        $rules = [ // Правила валидации
            'name' => 'required|min:2|max:10',
            'age' => 'required|max:3',
            'teacher' => 'required|min:3',
            'grade' => 'required|max:1',
            'birthday' => 'required|min:3'

        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $student = StudentModel::find($id);
        if (is_null($student)) {
            return response()->json(['error'=>true, 'message' => 'not found'], 404);
        } 
        $student->update($req->all());
        return response()->json($student, 200);  // Изменяем данные с помощью PUT запроса
    }


    public function studentDelete(Request $req, $id) {
        $student = StudentModel::find($id);
        if (is_null($student)) {
            return response()->json(['error'=>true, 'message' => 'not found'], 404);
        } 
        $student->delete();
        return response()->json('', 204);  // Удаляем данные с помощью delete запроса
    }


}
