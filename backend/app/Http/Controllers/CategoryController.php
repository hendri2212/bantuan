<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Category::all();
    }
    public function getForAdmin(Request $request)
    {
        $per_page = $request->get('per_page');
        $search = $request->has('search') ? $request->get('search') : '';
        if($per_page != 10 && $per_page != 20 && $per_page != 50){
            $per_page = 10;
        }
        $category = Category::where('category', 'like', '%'.$search.'%')->orderBy('created_at', 'desc')->paginate($per_page);
        return response()->json($category, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'category' => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 500);
        }

        try {
            $category = new Category($request->only('category'));
            $category->save();
            return response()->json("This category has been successfully added!", 201);
        }catch(Exception $e){
            return response()->json($e, 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return response()->json($category, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'category' => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 500);
        }

        try {
            $category = Category::find($id);
            $category->category = $request->category;
            $category->save();
            return response()->json("This category has been successfully edited!", 201);
        }catch(Exception $e){
            return response()->json($e, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check_products = Product::where('category_id', $id)->exists();
        if($check_products){
            return response()->json("This category has been used by products, so it cannot be deleted!", 500);
        }
        $category = Category::find($id);
        $category->delete();
        return response()->json("This category has been successfully deleted!", 200);
    }
}
