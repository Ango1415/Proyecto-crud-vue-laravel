<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id){
        return User::find($id);
    }

    public function index(){
        return User::all();
    }

    public function store(Request $request){
        $userFields = $request->validate([ //Proceso de validación de datos
            'name' => 'required',
            'id_card_number' => 'required',
            'age' => 'required',
            'genre' => 'required',
            'email' => ['required', 'email'],
        ]);
        User::create($userFields);
        //tambien se puede sin validar
        //User::create($request->input()):
        return response()->json([
            'data' => $userFields,
            'message' => 'Registro creado satisfactoriamente:',
        ]);
    }

    public function update(Request $request, $id){

        $user = User::find($id);
        if(isset($user)){
            $user['name'] = $request['name'];
            $user['id_card_number'] = $request['id_card_number'];
            $user['age'] = $request['age'];
            $user['genre'] = $request['genre'];
            $user['email'] = $request['email'];

            $user->save();
            return response()->json([
                'data' => $user,
                'message' => 'El usuario se editó con éxito',
            ]);
        } else{
            return response()->json([
                'error' => true,
                'message' => 'No se encontró ningún usuario con ese id',
            ]);
        }
    }

    public function destroy($id){
        $user = User::find($id);
        if(isset($user)){
            $response = User::destroy($id);
            return response()->json([
                'data' => $user,
                'message' => 'El usuario se eliminó con éxito',
            ]);
        }
    }
}
