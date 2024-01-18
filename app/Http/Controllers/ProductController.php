<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('created_at','DESC')->get();
        if (count($products) == 0) {
            return response()->json([
                'success'=>false,
                'message'=>"No products found",
                'data'=>null,
            ],404);
        }
        return response()->json([
                'success'=>true,
                'message'=>"",
                'data'=>$products,
        ],200);
        
         
    }

    
    public function create()
    {
        $categories = Category::all();
        if (count($categories) == 0) {
            return response()->json([
                'success'=>false,
                'message'=>"Category doesnot exist",
                'data'=>null,
            ],404);
        }
        return response()->json([
            'success'=>true,
            'message'=>"",
            'data'=>$categories,
        ],200);
    }

   
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
             'name' => ['required','max:255'], 
             'description' => ['required','max:1000'], 
             'price'=>['required','numeric','min:0'],
             'stock'=>['required','integer','min:0'],
             'category_id'=>['required'],  
            ]);

         if ($validator->fails()) {
            return response()->json([
                'success'=>false,
                'message'=>"There exist one or more errors",
                'data'=>$validator->messages(),
            ],400);
        }

        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;
        $product->save();

        return response()->json([
            'success'=>true,
            'message'=>"Product added successfully",
            'data'=>$product,
        ],201);

    }

   
    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'success'=>false,
                'message'=>"No product found",
                'data'=>null,
            ],404);
        }
        $category_name = $product->category->name;
        return response()->json([
            'success'=>true,
            'message'=>"",
            'data'=>['product'=>[
                'id'=>$product->id,
                'category_id' => $product->category_id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'stock' => $product->stock,
                'created_at' => $product->created_at->toDateTimeString(),
                'updated_at' => $product->updated_at->toDateTimeString(),
           ] ,'category'=>$category_name],
        ],200);
    }

  
    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::find($id);
        if (empty($categories) || !$product) {
            return response()->json([
                'success'=>false,
                'message'=>"Category or Product doesnot exist",
                'data'=>null,
            ],404);
        }
        $category_name = $product->category->name;
        return response()->json([
            'success'=>true,
            'message'=>"",
            'data'=>['categories'=>$categories , 'product'=>$product , 'category'=>$category_name],
        ],200);
    }

  
    public function update(Request $request, $id)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => ['required','max:255'], 
            'description' => ['required','max:1000'], 
            'price'=>['required','numeric','min:0'],
            'stock'=>['required','integer','min:0'],
            'category_id'=>['required'],  
           ]);

        if ($validator->fails()) {
           return response()->json([
               'success'=>false,
               'message'=>"There exist one or more errors",
               'data'=>$validator->messages(),
           ],400);
       }

       $product = Product::find($id);
       $product->name = $request->name;
       $product->description = $request->description;
       $product->price = $request->price;
       $product->stock = $request->stock;
       $product->category_id = $request->category_id;
    //    $product->updated_at = now();
       $product->save();

       return response()->json([
           'success'=>true,
           'message'=>"Product Updated successfully",
           'data'=>[
                'id'=>$product->id,
                'category_id' => $product->category_id,
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'stock' => $product->stock,
                'created_at' => $product->created_at->toDateTimeString(),
                'updated_at' => $product->updated_at->toDateTimeString(),
           ],
       ],200);

    }


    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json([
                'success'=>false,
                'message'=>"No product found",
                'data'=>null,
            ],404);
        }
        $product->delete();
        return response()->json([
            'success'=>true,
            'message'=>"Product Deleted successfully",
            'data'=>null,
        ],200);
    }
}
