<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Disaster;
use App\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DisasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Disaster::all();
    }

    public function getForAdmin(Request $request){
        $per_page = $request->get('per_page');
        $search = $request->has('search') ? $request->get('search') : '';
        if($per_page != 10 && $per_page != 20 && $per_page != 50){
            $per_page = 10;
        }
        $disaster = Disaster::select('id', 'disaster_name', DB::raw('substr(information, 1, 20) as information'), 'location')->where('disaster_name', 'like', '%'.$search.'%')->orderBy('created_at', 'desc')->paginate($per_page);
        return response()->json($disaster, 200);
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
            'disaster_name' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string',
            'information' => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 500);
        }

        try {
            $getAdmin = Admin::where('token', $request->token)->first();
            $disaster = new Disaster;
            $disaster->admin_id = $getAdmin->id;
            $disaster->disaster_name = $request->disaster_name;
            $disaster->date = $request->date;
            $disaster->location = $request->location;
            $disaster->information = $request->information;
            $disaster->save();
            return response()->json("This disaster has been successfully added!", 201);
        }catch(Exception $e){
            return response()->json($e, 500);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Disaster  $disaster
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Disaster::find($id), 200);
    }

    public function edit($id)
    {
        return Disaster::find($id);
    }

    public function count()
    {
        return Disaster::count();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Disaster  $disaster
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'disaster_name' => 'required|string',
            'date' => 'required|date',
            'location' => 'required|string',
            'information' => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 500);
        }

        try {
            $getAdmin = Admin::where('token', $request->token)->first();
            $disaster = Disaster::find($id);
            $disaster->admin_id = $getAdmin->id;
            $disaster->disaster_name = $request->disaster_name;
            $disaster->date = $request->date;
            $disaster->location = $request->location;
            $disaster->information = $request->information;
            $disaster->save();
            return response()->json("This disaster has been successfully edited!", 200);
        }catch(Exception $e){
            return response()->json($e, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Disaster  $disaster
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check_products = Product::where('disaster_id', $id)->exists();
        if($check_products){
            return response()->json("This disaster has been used by products, so it cannot be deleted!", 500);
        }else{
            $disaster = Disaster::find($id);
            $disaster->delete();
            return response()->json("This disaster has been successfully deleted!", 200);
        }
    }
}
