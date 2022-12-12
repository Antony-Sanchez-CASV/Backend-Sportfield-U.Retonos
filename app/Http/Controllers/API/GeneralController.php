<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Activity;
use App\Models\Sector;
use App\Models\Schedule;
use App\Models\Vcourse;
use App\Models\SField;
use App\Models\Ssfield;
use App\Models\Svcourse;

use App\Http\Resources\Id_NameResource;
use App\Http\Resources\SfieldResource;
use App\Http\Resources\VcourseResource;


class GeneralController extends Controller
{
    public function sectors(){
        return Id_NameResource::collection( Sector::all());
    }
    public function activities(){
        return Id_NameResource::collection( Activity::all());
    }

    public function ByActivity(Request $request){
        if(!Activity::find($request->id_activity)){
            return response()->json([
                'msg'=>'No existe esa actividad'
                ],200);
        }
        if($request->category=="sfield"){
            return SfieldResource::collection(SField::where('id_activity',$request->id_activity)->get());
        }
        return VcourseResource::collection(Vcourse::where('id_activity',$request->id_activity)->get());
    }

    public function BySector(Request $request)//envia todos las canchas por sector
    {
        if(!Sector::find($request->id_sector)){
            return response()->json([
                'msg'=>'No existe ese sector'
                ],200);
        }
        if(!$request->category=="Course"){
            return SfieldResource::collection(SField::where('id_sector',$request->id_sector)->get());
        }
        return VcourseResource::collection(Vcourse::where('id_sector',$request->id_sector)->get());
    }

    public function profile(Request $request){
        return auth()->user();
    }


    public function byTime(Request $request){
        if(!Schedule::find($request->hours)){
            return response()->json([
                "msg"=>"no se tiene registros"
            ], 200);
        }
        $schedules=Schedule::where('hours',$request->hours)->get();//recoge todos los horarios que tngan ese periodo de tiempo
        $aux=$schedules[0];
        //$sfieldSchedules[]=Ssfield::where('id_schedule', $schedules[0]->id)->get();
        foreach($schedules as $schedule){
            $svcourses[]=Svcourse::where('id_schedule', $schedule->id)->get();// recoge todos los horarios de cursos que tengan la clausula
        }
        //$idscourses[]=Vcourse::where('id',$svcourses[0][0]->id_course)->first();
        $idscourses[]=$svcourses[0][0]->id_vcourse;
        foreach($svcourses as $svcourse){//arreglo
            foreach($svcourse as $schedule){
                $aux=Vcourse::where('id',$schedule->id_course)->first();
                if(array_search($idscourses, $aux->id)){

                }
            }
        }
        return response()->json($sfield,200);

    }
    /*
    public function ByStart(Request $request){
        if(!){
            return response()->json([
                "msg"="no se tiene registros"
            ], 200);
        }
    }
    public function ByEnd(Request $request){
        if(!){
            return response()->json([
                "msg"="no se tiene registros"
            ], 200);
        }
    }
    public function ByBetween(Request $request){
        if(!){
            return response()->json([
                "msg"="no se tiene registros"
            ], 200);
        }
    }
*/
}
