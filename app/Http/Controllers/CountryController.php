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
