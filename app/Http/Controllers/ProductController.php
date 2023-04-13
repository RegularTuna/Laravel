<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all()->toJson(); //é como se fizermos select * 

        return $products;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //vai gravar dados
        try {
            $product = new Product();

            $product->name = $request -> name;
            $product->category_id = $request -> category_id;
            $product->description = $request -> description;
            $product->price = $request -> price;
            $product->stock = $request -> stock;
            $product->image = $request -> image;
            $product->sku = $request -> sku;

            $product->save();
        } catch (\Exception $e) {
            
            return response()->json([
                'success' => false,
                'message' => 'Erro ao gravar registo',
                'data'    => [$e->getMessage()]
            ], 500); 
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
        //vai mostrar 1 registo
        if (Product::where('id', $id)->exists()){

            $product = Product::where('id', $id)->get()->toJson();
            return response($product,200);

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
            if (Product::where('id', $id)->exists()) {

            

                $product = Product::find($id);
                
                $product->name = $request -> name;
                $product->category_id = $request->category_id;
                $product->description = $request -> description;
                $product->price = $request -> price;
                $product->stock = $request -> stock;
                $product->image = $request -> image;
                $product->sku = $request -> sku;
                $product->save();
                
                
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
            if (Product::where('id', $id)->exists()) {

                $product = Product::find($id);
                $product->delete();
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
