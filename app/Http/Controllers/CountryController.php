<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;


class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::all()->toJson();

        return $countries;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
        
            $country = new Country();
            $country->id = $request -> id;
            $country->name = $request -> name;
            $country->save();

        } catch (\Exception $e) {
            
            return response()->json([
                'success' => false,
                'messsage' => 'Erro ao gravar registo',
                'data' => [$e->getMessage()]
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Registo gravado com sucesso',
            'data' => []
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //vai mostrar 1 registo
        if (Country::where('id', $id)->exists()){

            $country = Country::where('id', $id)->get()->toJson();
            return response($country,200);

        } else {

            return response()->json([
                'success' => false,
                'message' => 'Erro ao obter registo.',
                'data'    => ['Marisco  não encontrado.']
            ], 404); 
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            //update de 1 registo
            if (Country::where('id', $id)->exists()) {

            

                $country = Country::find($id);
                $country->name = $request->name;
                $country->save();
                
                
            }else {

                return response()->json([
                    'success' => false,
                    'message' => 'Erro ao obter registo.',
                    'data'    => ['Registo não encontrado.']
                ], 404); 
            }
                    
        } catch ( \Exception $e ) {

            return response()->json([
                'success' => false,
                'message' => 'Erro ao gravar',
                'data'    => [$e->getMessage()]
            ], 500); 

        }

        return response()->json([
            'success' => true,
            'message' => 'Registo alterado com sucesso',
            'data'    => []
        ], 201); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            //delete de 1 registo
            if (Country::where('id', $id)->exists()) {

                $country = Country::find($id);
                $country->delete();
            } else {

                return response()->json([
                    'success' => false,
                    'message' => 'Erro ao obter registo.',
                    'data'    => ['Registo não encontrado.']
                ], 404); 
            }

        } catch (\Exception $e){

            return response()->json([
                'success' => false,
                'message' => 'Erro ao eliminar',
                'data'    => [$e->getMessage()]
            ], 500); 

        }
        

        return response()->json([
            'success' => true,
            'message' => 'Registo eliminado com sucesso.',
            'data'    => []
        ], 201); 
    }
    
}
