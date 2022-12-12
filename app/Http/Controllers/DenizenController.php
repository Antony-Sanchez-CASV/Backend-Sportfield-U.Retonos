<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;
use App\Models\User;

class DenizenController extends Controller
{
    public function index()
    {

        $denizens=User::where('id_rol',2);
        
        if (request('search')){
            $denizen=$denizen->where('firstName', 'like', '%'.request('search').'%');
        }
        $users= $denizens->orderBy('lastName','asc')
            ->orderBy('firstName','asc')
            ->paginate(5);
        return view('layouts.denizen.index',compact('users'))->render();
    }
    public function create ()
    {
        $user=User::new();
        $user->id_rol=2;
        $user->Hash::make(this->generatePassword());
        return view('layouts.denizen.create',compact('user'));
    }
    //verifica los datos para guardar en la BD
    public function store(Request $request)
    {
        //validacion de datos
        $request->validate(
            [
                'firstName'=>['required','string','min:2','max:35'],
                'lastName'=>['required','string','min:2','max:35'],
                'email'=>['required','string','email', 'max:255', 'unique:users'],
                'nickname'=>['required', 'string', 'min:5', 'max:20', 'unique:users'],
                'batch'=>['required','integer'],
            ]
        );
        $password_generated = $this->generatePassword();
        $denizen=Denizen::class->users();
        $denizen->create([
            'firstName'=>$request['firstName'],
            'lastName'=>$request['lastName'],
            'email'=>$request['email'],
            'nickname'=>$request['nickname'],
            'password'=>Hash::make($password_generated),
            'batch'=>$request['batch'],
        ]);
        return back()->with('status', 'Morador Creado');
    }
    public function show(User $user)
    {
        return view('layouts.denizen.show', ['user' => $user]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('layouts.denizen.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {

        // Obtener el model del usuario
        $userRequest = $request->user;

        // Validación de datos respectivos
        $request->validate([
            'firstName' => ['required', 'string', 'min:3', 'max:35'],
            'lastName' => ['required', 'string', 'min:3', 'max:35'],

            'nickname' => ['required', 'string', 'min:5', 'max:20',
               
            ],


            'email' => ['required', 'string', 'email', 'max:255',
               
            ],
            'batch' => ['required', 'numeric', ],
        ]);

        // Se obtiene el email antiguo del usuario
        $old_email = $user->email;
        // Se obtiene el modelo del usuario
        $denizen = $user;


        $denizen->update([
        'firstName' => $request['firstName'],
        'lastName' => $request['lastName'],
        'nickname' => $request['nickname'],
        'email' => $request['email'],
        'batch' => $request['batch'],
        ]);

        // Se procede con la actualización del avatar del usuario
        //$director->updateUIAvatar($director->generateAvatarUrl());

        // Función para verificar si el usuario cambio el email
        $this->verifyEmailChange($denizen, $old_email);
        // Se imprime el mensaje de exito
        return back()->with('status', 'Administrador modificado');
    }
    public function destroy(User $user)
    {
        // Tomar el modelo del usuario
        $admin = $user;
        // Tomar el estado del director
        $state = $denizen->state;
        // Almacenar un mensaje para el estado
        $message = $state ? 'inactivo' : 'activato';
        // Cambiar el estado del usuario
        $denizen->state = !$state;
        // Guardar los cambios
        $denizen->save();
        // Se imprime el mensaje de exito
        return back()->with('status', "Morador $message ");
    }
// Función para generar una contraseña
    public function generatePassword()
    {
        $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*?";
        $length = 8;
        $count = mb_strlen($characters);
        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($characters, $index, 1);
        }
        return $result;
    }
}
