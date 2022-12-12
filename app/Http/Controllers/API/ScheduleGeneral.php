<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schedule;


class ScheduleGeneral extends Controller
{
    public function create(Request $request){
        $schedule = new Schedule();
        $schedule->name = $request->name;
        $schedule->id_activity =$request->id_activity;
        $schedule->id_sector =$request->id_sector;
        $schedule->save();
        return response()->json(
            ['msg'=>'Created vacational course',
            'course'=>$schedule],200
        );
    }
    public function update(Request $request){

        $schedule= Schedule::findOrFail( $request->id);
        $schedule->name = $request->name;
        $schedule->id_activity =$request->id_activity;
        $schedule->id_sector =$request->id_sector;
        $schedule->save();
        return response()->json(
            ['msg'=>'Update sportfield',
            'field'=>$schedule],200
        );
    }
    public function show(Request $request){
        try{
            $schedule=Schedule::findOrFail($request->id);
            return response()->json(
                ['course'=>$schedule],200
            );
        }catch (ValidationException $exception) {
            return response()->json(
                ['msg'=>'Not found'], 404
            );
        }
    }
    public function delete(Request $request){
        try{
            $schedule=Schedule::findOrFail($request->id);
            $schedule->delete();
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
