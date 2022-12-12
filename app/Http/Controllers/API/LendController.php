<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\Lendsfiel;
use App\Models\SField;
use App\Models\Ssfield;
use App\Models\Schedule;
use App\Models\Sector;
use App\Models\Activity;


use App\Http\Resources\SfieldResource;
use App\Http\Resources\ListSFieldResource;
use App\Http\Resources\SsfieldResource;
use App\Http\Resources\Id_NameResource;

use Carbon\Carbon;

class LendController extends Controller
{

    public function listSFields()//envia todos las canchas
    {
        return SfieldResource::collection(SField::all());
    }

    public function ByActivity(Request $request){
        if(!Activity::find($request->id_activity)){
            return response()->json([
                'msg'=>'No existe esa actividad'
                ],200);
        }
        return SfieldResource::collection(SField::where('id_activity',$request->id_activity)->get());
    }


    public function schedule(Request $request)//envia todos las canchas por sector
    {
        if(!SField::find($request->id_sfield)){
            return response()->json([
                'msg'=>'No existe esa cancha deportiva'
                ],200);
        }
        $sfield=SField::find($request->id_sfield);
        $ssfield=Ssfield::where('id_sField',$sfield->id)->get();
        return SsfieldResource::collection($ssfield);
    }



   public function lend(Request $request)
   {
        try{
            $request->validate([
                'dateLend'=>['required', 'date']
            ]);
        }catch (ValidationException $exception) {
            return response()->json([
                'status' => 'error',
                'msg'    => 'Error',
                'errors' => $exception->errors(),
            ], 422);
        }

        if(!Ssfield::find($request->id_schedule_sField)){
            return response()->json([
                'msg'=>'No existe horario de prestamo'
                ],200);
        }

        if($this->checkDay($request->dateLend,$request->id_schedule_sField)){
            return response()->json([
                'msg'=>'la fecha y el dia no coincide'
                ],200);
        }

        $user=auth()->user();
        $id_schedule=$request->id_schedule_sField;//id del horario de prestamo de cancha
        $dateLend=$request->dateLend;//id de la fecha de prestamo de cancha
        if($this->checkLend($id_schedule,$dateLend)){
            return response()->json([
                'msg'=>'Esta ocupado'
                ],200);
        }

        $lend=new Lendsfiel();
        $lend->id_user= $user->id;
        $lend->id_scheduleSField=$id_schedule;
        $lend->dateLend=$dateLend;
        $lend->id_state=3;
        $lend->save();

        return response()->json([
            'msg'=>'Prestamo exitoso'
            ],200);
   }


   public function quitLend(Request $request){
    if(!Ssfield::find($request->id_schedule_sField)){
        return response()->json([
            'msg'=>'No existe horario de prestamo'
            ],200);
    }
    $ssfield=Lendsfiel::find($request->id_schedule_sField);
    $ssfield->id_state=4;
    $ssfield->save();
    return response()->json([
        'msg'=>'Eliminado prestamo'
    ], 200);
   }

   public function listDenizen()//lista de los cursos
    {
        $user=auth()->user();
        $lends=Lendsfiel::where('id_user',$user->id)->get();

        foreach($lends as $lend){
            if( $lend->id_status<>3){
                $schedule=Ssfield::where('id',$lend->id_scheduleSField)->first();
                $sfield=SField::where('id',$schedule->id_sField)->first();
                $lendsList[]=[
                    "id"=>$sfield->id,
                    "name_field"=>$sfield->code_s_field,
                    "sector"=>$sfield->getSector(),
                    "activity"=>$sfield->getActivity(),
                    "id_schedule_sField"=>$schedule->id,
                    "day"=>$schedule->getDays(),
                    "time"=>$schedule->getHours(),
                ];
            }else{
                $lendsList[]=[];
            }

        }
        return response()->json($lendsList, 200);

    }

    private function checkLend($id_schedule,$dateLend){
        if(Lendsfiel::where('dateLend',$dateLend)){
            if(Lendsfiel::where('id_scheduleSField',$id_schedule))
            //pregunta si hay prestamos en ese horario
            {
                $lends=Lendsfiel::where('dateLend',$dateLend)->get();
                foreach($lends as $lend){
                    if($lend->id_scheduleSField==$id_schedule){
                        if( $lend->id_state==3){
                            return TRUE;
                        }
                    }
                }
            }
        }
        return FALSE;
    }
    private function checkDay($dateLend,$id_schedule_sField){
        $date = Carbon::parse($dateLend);

        $day = $date->formatLocalized('%A');
        $translate=[
            "Monday"=>"Lunes",
            "Tuesday"=>"Martes",
            "Wednesday"=>"Miercoles",
            "Thursday"=>"Jueves",
            "Friday"=>"Viernes",
            "Saturday"=>"Sabado",
            "Sunday"=>"Domingo",
        ];
        $day=$translate[$day];
        $ssfield=Ssfield::find($id_schedule_sField);
        $schedule=Schedule::find($ssfield->id_schedule);
        if($day<>$schedule->getDayName()){
            return TRUE;
        }
        return FALSE;
    }
}
