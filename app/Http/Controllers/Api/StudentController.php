<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    //
    public function index(){
        $students = Student::all();

        if($students-> count() > 0 ){
            $data = [
                'status' => 200,
                'students'=> $students,
            ];
            return response()->json($data, 200);
        }else{
            return response()->json([
                'status'=> 404,
                'message'=> 'No Record Found'
            ], 404);
        }

    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name'=> 'required|string|max:191',
            'course'=> 'required|string|max:191',
            'email'=> 'required|string|max:191',
            'phone'=> 'required|digits:11',
        ]);

        if($validator->fails()){
            return response()->json([
                'status'=> 422,
                'errors'=> $validator->messages()
            ], 422);
        }else{
            $students = Student::create([
                'name'=> $request->name,
                'course'=> $request->course,
                'email'=> $request->email,
                'phone'=> $request->phone,
            ]);

            if($students){
                return response()->json([
                    'status'=>200,
                    'message'=> "Student Created Successfully"
                ], 200);
            }else{
                return response()->json([
                    'status'=> 500,
                    'message'=> "Something went wrong"
                ], 500);
            }
        }
    }

    public function show($id){
        $student = Student::find($id);

        if($student){
            return response()->json([
                'status'=>200,
                'student'=> $student
            ], 200);

        }else{
            return response()->json([
                'status'=>404,
                'message'=> "No Such Student Found!"
            ], 500);
        }

    }

    public function edit($id){
        $student = Student::find($id);
        if($student){
            return response()->json([
                'status'=> 200,
                'student'=> $student
            ], 200);
        }else{
            return response()->json([
                'status'=> 404,
                'message'=> 'No such Student Found!'
            ], 404);
        }
    }

    public function update(Request $request, int $id){
        $validator = Validator::make($request->all(), [
            'name'=> 'required|string|max:191',
            'course'=> 'required|string|max:191',
            'email'=> 'required|string|max:191',
            'phone'=> 'required|digits:11',
        ]);

        if($validator->fails()){
            return response()->json([
                'status'=> 422,
                'errors'=> $validator->messages()
            ], 422);
        }else{
            $students = Student::find($id);
            if($students){
                $students->update([
                    'name'=> $request->name,
                    'course'=> $request->course,
                    'email'=> $request->email,
                    'phone'=> $request->phone,
                ]);

                return response()->json([
                    'status'=>200,
                    'message'=> "Student Updated Successfully"
                ], 200);
            }else{
                return response()->json([
                    'status'=> 404,
                    'message'=> "No Such Student Found"
                ], 404);
            }
        }
    }

    public function destroy($id){
        $student = Student::find($id);
        if($student){
            $student->delete();
            return response()->json([
                'status'=> 200,
                'message'=>'Student Deleted Successfully!'
            ], 200);
        }else{
            return response()->json([
                'status'=> 404,
                'message'=>'No Such Student Found!'
            ], 404);
        }

    }
}
