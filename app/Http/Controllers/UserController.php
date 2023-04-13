<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all()->toJson(); //é como se fizermos select * 

        return $users;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            //vai gravar dados
            $user = new User();

            $user->name = $request ->name;
            $user->email = $request ->email;
            $user->password = $request ->password;

            $user->save();

        }catch (\Exception $e){

            return response()->json([
                'success' => false,
                'message' => 'Erro ao gravar registo',
                'data'    => [$e->getMessage()]
            ], 500); //500 é uma convençao para informar que é erro operacional (do lado do server)
        }
        

        return response()->json([
            'success' => true,
            'message' => 'Registo gravado com sucesso',
            'data'    => []
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
