<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
class UserControllerApi extends Controller
{
    //Encontrar um user e retornar seus tccs e ele mesmo
    public function findUser(Request $request): JsonResponse
    {
        $request->validate(
            [
                'email' => 'required|email'
            ]
        );

        //Null safety, garantindo que terá alguma coisa na variavel
        $user = User::with(['tccsComoAluno', 'tccsComoOrientador'])
        ->where('email', $request->get('email'))
        ->first();
        if ($user) {
            return response()->json(
                [
                    'status' => 200,
                    'nome' => $user->name,
                    'email' => $user->email,
                    'tipo_user'=> $user->tipo_usuario,
                    'matricula' => $user->matricula ?? "",
                    'userTccs' => $user->tccs,
                ]
            );
        }else{
            return response()->json([
                'status' => 404,
                'user' => "user not found"
            ]);
        }
    }
}
