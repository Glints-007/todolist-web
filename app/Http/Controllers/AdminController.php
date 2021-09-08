<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Rules\MatchOldPassword;

class AdminController extends Controller
{
    public function index() {
        $data_user = User::all();
        return view ('admin.index-admin', ['data_user' => $data_user]);
    }

    public function update(Request $request, $id)
    {
        $data_user = User::where('id', $id);
        if($request->name == $request->old_name && $request->username == $request->old_username && $request->role == $request->old_role && $request->micro_cluster_user == $request->old_micro_cluster_user && $request->password == ''){
            return response()->json(['nothing' => 'Data Tidak Ada yang Berubah!']);
        }else{
            if($request->password == ''){
                $data_user->update([
                    'name'              => $request->name,
                    'email'             => $request->email,
                    'password'          => $request->old_password
                ]);
            }else{
                $data_user->update([
                    'name'              => $request->name,
                    'email'             => $request->email,
                    'password'          => Hash::make($request->password)
                ]);
            }
        }
    }
    public function changePassword(Request $request, $id)
    {
        $messages = [
            'current_password.required' => 'Current Password Tidak Boleh Kosong!',
            'new_password.required'     => 'New Password Tidak Boleh Kosong!',
            'confirm_password.required' => 'Confirm Password Tidak Boleh Kosong!',
            'confirm_password.same'     => 'Password Yang Dimasukkan Tidak Sama',
            'new_password.different'    => 'Current Password Dan New Password Harus Berbeda',
            ];

        $validator = \Validator::make($request->all(), [
            'confirm_password' => ['required', 'same:new_password'],
            'new_password'     => ['required', 'different:current_password'],
            'current_password' => ['required', new MatchOldPassword],
        ], $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        }else {
            $user = User::where('id', $id);
            $user->update([
                'password'          => Hash::make($request->new_password),
            ]);
        }
    }
    public function destroy($id)
    {
        User::find($id)->delete();
    }
}
