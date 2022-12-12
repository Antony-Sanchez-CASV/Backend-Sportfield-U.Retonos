<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){//registrar un usuario
        try{
            $validate=$request->validate([
                'firstName' => ['required', 'string', 'max:50'],
                'lastName' => ['required', 'string', 'max:50'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'nickname' => ['required', 'string', 'min:5',  'max:20', 'unique:users'],
                'password' => ['required', 'string', 'min:8'],
                'batch' => ['required', 'integer'],
            ]);
        }catch (ValidationException $exception) {
            return response()->json(['status' => 'error', 'msg' => 'Error',
            'errors' => $exception->errors(),], 422);
        }
        $user=new User();
        $user->id_rol=2;
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->nickname = $request->nickname;
        $user->batch =$request->batch;
        $user->save();
        return response()->json(['res'=>true,'msg'=>'User register'], 200);

    }
    public function login(Request $request){
        try{
            $validate=$request->validate([
                'email' => ['required', 'string', 'email', 'max:255'],
                'password' => ['required', 'string', 'min:8'],

            ]);
            $user = User::where('email', $request['email'])->firstOrFail();
            if(!$user || !Hash::check($request->password, $user->password)){
                throw ValidationException::withMessages([
                    'msg'=>['Email or password incorrect'],
                ]);
            }
        }catch (ValidationException $exception) {
            return response()->json([
                'status' => 'error',
                'msg'    => 'Error',
                'errors' => $exception->errors(),
            ], 422);
        }
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function logout(Request $request){
        try{
            auth()->user()->tokens()->delete();
            return [
                'message' => 'Sign off'
            ];
        }catch (ValidationException $exception) {
            return response()->json([
                'status' => 'error',
                'msg'    => 'Error',
                'errors' => $exception->errors(),
            ], 422);
        }
    }
}
