<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Todo;
use App\Models\ListTodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return User::where('is_admin', '0')->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        return User::where('id', $id)->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validate = \Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'confirm_password' => 'required|string|min:8',
        ]);

        if($request->new_password){
            $newpass =  \Validator::make($request->all(), [
                'new_password' => 'required|string|min:8',
            ]);

            if ($newpass->fails()) {
                $respon = [
                    'status' => 'error',
                    'msg' => 'Validator error',
                    'errors' => $newpass->errors(),
                    'content' => null,
                ];
                return response()->json($respon, 200);
            }
        }

        if ($validate->fails()) {
            $respon = [
                'status' => 'error',
                'msg' => 'Validator error',
                'errors' => $validate->errors(),
                'content' => null,
            ];
            return response()->json($respon, 200);
        } else {
            $user = User::find($request->user()->id);
            if(! \Hash::check($request->confirm_password, $user->password, [])){
                $respon = [
                    'status' => 'error',
                    'msg' => 'Validator error',
                    'errors' => 'Password confirm doesnt match',
                    'content' => null,
                ];
                return response()->json($respon, 200);
            }
            if($request->name){
                $user->name = $request->name;
            }
            $user->email = $request->email;
            if($request->new_password){
                $user->password = Hash::make($request->new_password);
            }
            $user->save();
            return response()->json([
                'status' => 'success',
                'msg' => 'Record updated',
                'errors' => null,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Record deleted',
            'errors' => null,
        ]);
    }
}
