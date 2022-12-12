<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vcourse;
use App\Http\Requests\VacationalCourseRequest;

class VacationalCourse extends Controller
{
    public function create(Request $request){
        //$request->validated();
        $vCourse = new Vcourse();
        $vCourse->name = $request->name;
        $vCourse->description =  $request->description;
        $vCourse->capacity =  $request->capacity;
        $vCourse->taken = 0;
        $vCourse->duration_week =$request->duration_week;
        $vCourse->id_instructor =$request->id_instructor;
        $vCourse->id_room =$request->id_room;
        $vCourse->save();
        return response()->json(
            ['msg'=>'Created vacational course',
            'course'=>$vCourse],200
        );
    }
    public function update(Request $request){
        //$request->validated();
        $vCourse= Vcourse::findOrFail( $request->id);
        $vCourse->name = $request->name;
        $vCourse->description =  $request->description;
        $vCourse->capacity =  $request->capacity;
        $vCourse->duration_week =$request->duration_week;
        $vCourse->id_instructor =$request->id_instructor;
        $vCourse->id_room =$request->id_room;
        $vCourse->save();
        return response()->json(
            ['msg'=>'Update vacational course',
            'course'=>$vCourse],200
        );
    }
    public function show(Request $request){
        try{
            $vCourse=Vcourse::findOrFail($request->id);
        }catch (ValidationException $exception) {
            return response()->json(
                ['msg'=>'Not found',
                ], 404
            );
        }
        return response()->json(
            ['course'=>$vCourse],200
        );
    }
    public function delete(Request $request){
        try{
            $vCourse=Vcourse::findOrFail($request->id);
             $vCourse->delete();
            return response()->json(
                ['msg'=>'Deleted vacational course',
                ],200
            );
        }catch (ValidationException $exception) {
            return response()->json(
                ['msg'=>'Not found',
                ], 404
            );
        }
    }

}
