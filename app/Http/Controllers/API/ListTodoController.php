<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ListTodo;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ListTodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return ListTodo::where('todoId', $id)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $validate = \Validator::make($request->all(), [
            'name' => 'required|string',
            'content' => 'required|string',
            'image' => 'required|mimes:jpg,jpeg,png,bmp',
        ]);

        if ($validate->fails()) {
            $respon = [
                'status' => 'error',
                'msg' => 'Validator error',
                'errors' => $validate->errors(),
                'content' => null,
            ];
            return response()->json($respon, 200);
        } else {
            $response = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();

            ListTodo::create([
                'todoId' => $id,
                'name' => $request->name,
                'content' => $request->content,
                'image' => $response,
            ]);

            return response()->json([
                'status' => 'success',
                'msg' => 'Record stored',
                'errors' => null,
                'todoId' => $id,
                'name' => $request->name,
                'content' => $request->content,
                'image' => $response,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ListTodo  $listTodo
     * @return \Illuminate\Http\Response
     */
    public function show($todoId, $id)
    {
        return ListTodo::where([
            ['id', $id],
            ['todoId', $todoId],
        ])->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ListTodo  $listTodo
     * @return \Illuminate\Http\Response
     */
    public function edit(ListTodo $listTodo, $todoId, $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ListTodo  $listTodo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $todoId, $id)
    {
        $validate = \Validator::make($request->all(), [
            'name' => 'required|string',
            'content' => 'required|string',
            'image' => 'mimes:jpg,jpeg,png,bmp',
        ]);

        if ($validate->fails()) {
            $respon = [
                'status' => 'error',
                'msg' => 'Validator error',
                'errors' => $validate->errors(),
                'content' => null,
            ];
            return response()->json($respon, 200);
        } else {
            $todolist = ListTodo::find($id);
            $todolist->name = $request->name;
            $todolist->content = $request->content;
            if($request->image){
                $old = ListTodo::find($id)->first()->image;
                preg_match("/upload\/(?:v\d+\/)?([^\.]+)/", $old, $public);
                cloudinary()->uploadApi()->destroy($public[1]);
                $response = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
                $todolist->image = $response;
            }
            $todolist->save();
            
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
     * @param  \App\Models\ListTodo  $listTodo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $todoId, $id)
    {
        $old = ListTodo::where([
            ['id', $id],
            ['todoId', $todoId],
        ])->first()->image;
        preg_match("/upload\/(?:v\d+\/)?([^\.]+)/", $old, $public);
        cloudinary()->uploadApi()->destroy($public[1]);
        ListTodo::destroy($id);
        
        return response()->json([
            'status' => 'success',
            'msg' => 'Record deleted',
            'errors' => null,
        ]);
    }
}
