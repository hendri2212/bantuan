<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Disaster;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 500);
        }
        $check_login = Admin::where('username', $request->username)->first();
        if($check_login){
            $check_token = Hash::check($request->password, $check_login->password);
            if($check_token){
                $token = Str::random(32);
                $check_login->token = $token;
                $check_login->save();
                return response()->json($check_login->token, 200);
            }
        }
        return response()->json('Failed to login!', 500);
    }

    public function index(Request $request)
    {
        $per_page = $request->get('per_page');
        $search = $request->has('search') ? $request->get('search') : '';
        if($per_page != 10 && $per_page != 20 && $per_page != 50){
            $per_page = 10;
        }
        $admin = Admin::where('name', 'like', '%'.$search.'%')->orderBy('created_at', 'desc')->paginate($per_page);
        return response()->json($admin, 200);
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
            'name' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:admin,operator',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 500);
        }

        try {
            $admin = new Admin;
            $admin->name = $request->name;
            $admin->username = $request->username;
            $admin->password = Hash::make($request->password);
            $admin->role = $request->role;
            $admin->save();
            return response()->json("This account has been successfully added!", 201);
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
        $admin = Admin::select('name', 'username', 'role')->find($id);
        return response()->json($admin, 200);
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
            'name' => 'required|string',
            'username' => 'required|string',
            'password' => 'sometimes|string|min:8',
            'role' => 'required|string|in:admin,operator',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 500);
        }

        try {
            $admin = Admin::find($id);
            $admin->name = $request->name;
            $admin->username = $request->username;
            if($request->has('password')){
                $admin->password = Hash::make($request->password);
            }
            $admin->role = $request->role;
            $admin->save();
            return response()->json("This account has been successfully edited!", 201);
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
        $check_disaster = Disaster::where('admin_id', $id)->exists();
        if($check_disaster){
            return response()->json("This account has been used by disaster, so it cannot be deleted!", 500);
        }
        $admin = Admin::find($id);
        $admin->delete();
        return response()->json("This account has been successfully deleted!", 200);
    }
}
