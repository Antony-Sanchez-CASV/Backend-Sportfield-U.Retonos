<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subsvcourse;
use App\Models\Vcourse;
use Illuminate\Http\Request;
use App\Http\Resources\SubscribeResource;
use App\Http\Resources\VcourseResource;
class SubscribeController extends Controller
{
    public function listcourse()//lista de los cursos
    {
        return VcourseResource::collection(Vcourse::all());
    }
    public function ByActivity(Request $request){
        if(!Activity::find($request->id_activity)){
            return response()->json([
                'msg'=>'No existe esa actividad'
                ],200);
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
        return VcourseResource::collection(Vcourse::where('id_sector',$request->id_sector)->get());
    }

    public function inscription(Request $request){

        if(!Vcourse::find($request->id_vcourse)){
            return response()->json([
                'msg'=>'No existe el curso'
                ],200);
        }
        $vcourse=Vcourse::find($request->id_vcourse);
        if(!$vcourse->avalible()){
            return response()->json([
                'msg'=>'No hay cupo'
                ],200);
        }

        $user=auth()->user();
        if($this->checkSubscribe($user->id,$vcourse->id)){
            return response()->json([
                'msg'=>'Ya esta inscrito'
                ],200);
        }
        $subcribe=new Subsvcourse();
        $subcribe->id_state=1;
        $subcribe->id_vcourse= $request->id_vcourse;
        $subcribe->id_user=$user->id;
        $subcribe->save();
        $vcourse->addMember();
        return response()->json([
            'res'=>true,
            'msg'=>'Inscripcion realizada',
        ], 200);
    }

    public function desubscribe(Request $request){
        if(!Vcourse::find($request->id_vcourse)){
            return response()->json([
                'msg'=>'No existe el curso'
                ],200);
        }
        $vcourse=Vcourse::find($request->id_vcourse);
        $user=auth()->user();
        if(!$this->checkSubscribe($user->id,$vcourse->id)){
            return response()->json([
                'msg'=>'No esta inscrito'
                ],200);
        }
        $subscriptions=Subsvcourse::where('id_user',$user->id)->get();
        foreach($subscriptions as $subscription){
            if( $subscription->id_vcourse==$vcourse->id){
                $subscription->id_state=2;
                $subscription->save();
                $vcourse->lessMember();
                return response()->json([
                    'res'=>true,
                    'msg'=>'Inscripcion desechada',
                ], 200);
            }
        }
    }

    public function listDenizen()//lista de los cursos
    {
        $user=auth()->user();
        $subcriptions=Subsvcourse::where('id_user',$user->id)->get();

        foreach($subcriptions as $subscription){
            $courses[]=Vcourse::where('id',$subscription->id_vcourse)->first();
        }
        return VcourseResource::collection($courses);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SubscribeResource::collection(Subsvcourse::latest()->paginate());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subsvcourse  $subsvcourse
     * @return \Illuminate\Http\Response
     */
    public function show(Subsvcourse $subsvcourse)
    {
        return new SubscribeResource($subsvcourse);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subsvcourse  $subsvcourse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subsvcourse $subsvcourse)
    {
        if($subsvcourse->delete()){
            return response()->json([
                'msg'=>"Eliminado"
            ],204);
        }

    }
    private function checkSubscribe($id_user,$id_vcourse){
        if(!$id_vcourse){
            if(Subsvcourse::where('id_user',$id_user)){
                $subscriptions=Subsvcourse::where('id_user',$id_user)->get();
                foreach($subscriptions as $subscription){
                    if( $subscription->id_vcourse==$id_vcourse){
                        return TRUE;
                    }
                }
            }
        }
        return FALSE;
    }
}
