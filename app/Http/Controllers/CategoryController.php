<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
  
    public function store(Request $request)
    {
       
           $validator = Validator::make($request->all(), [
            'name' => ['required','max:100'],  
           ]);

           if ($validator->fails()) {
           return response()->json([
               'success'=>false,
               'message'=>"There exist one or more errors",
               'data'=>$validator->messages(),
           ],400);
       }

       $category = new Category;
       $category->name = $request->name;
       
       $category->save();

       return response()->json([
           'success'=>true,
           'message'=>"Category added successfully",
           'data'=>$category,
       ],200);

    }

   
}
