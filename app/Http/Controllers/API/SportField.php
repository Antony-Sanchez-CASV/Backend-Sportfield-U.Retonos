<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SField;

class SportField extends Controller
{
    public function create(Request $request){
        $sField = new SField();
        $sField->name = $request->name;
        $sField->id_activity =$request->id_activity;
        $sField->id_sector =$request->id_sector;
        $sField->save();
        return response()->json(
            ['msg'=>'Created vacational course',
            'course'=>$sField],200
        );
    }
    public function update(Request $request){

        $sField= SField::findOrFail( $request->id);
        $sField->name = $request->name;
        $sField->id_activity =$request->id_activity;
        $sField->id_sector =$request->id_sector;
        $sField->save();
        return response()->json(
            ['msg'=>'Update sportfield',
            'field'=>$sField],200
        );
    }
    public function show(Request $request){
        try{
            $sField=SField::findOrFail($request->id);
            return response()->json(
                ['course'=>$sField],200
            );
        }catch (ValidationException $exception) {
            return response()->json(
                ['msg'=>'Not found'], 404
            );
        }
    }
    public function delete(Request $request){
        try{
            $sField=SField::findOrFail($request->id);
            $sField->delete();
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
