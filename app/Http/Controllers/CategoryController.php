<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all()->toJson(); //é como se fizermos select * 

        return $categories;
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {

            //vai gravar dados
            $category = new Category();

            $category->name = $request ->name;

            $category->save();

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
        ], 201); //201 é uma convençao para informar que a request teve sucesso
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //vai mostrar 1 registo
        if (Category::where('id', $id)->exists()){

            $category = Category::where('id', $id)->get()->toJson();
            return response($category,200);

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
            if (Category::where('id', $id)->exists()) {

            

                $category = Category::find($id);
                $category->name = $request->name;
                $category->save();
                
                
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
            if (Category::where('id', $id)->exists()) {

                $category = Category::find($id);
                $category->delete();
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
