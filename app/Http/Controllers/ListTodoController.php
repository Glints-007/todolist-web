<?php

namespace App\Http\Controllers;

use App\Models\ListTodo;
use Illuminate\Http\Request;
use Auth;

class ListTodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index($todoId)
    {
        $user = Auth::user();
        $data = ListTodo::where('todoId', $todoId)->get();
        return view('listtodo.index')->with([
            'data' => $data, 'todoId' => $todoId
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($todoId)
    {
        return view('listtodo.create')->with([
            'todoId' => $todoId
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $todoId)
    {
        $validate = \Validator::make($request->all(), [
            'name' => 'required|string',
            'content' => 'required|string',
            'image' => 'required|mimes:jpg,jpeg,png,bmp',
        ]);    

        $response = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();

        ListTodo::create([
            'todoId' => $todoId,
            'name' => $request->name,
            'content' => $request->content,
            'image' => $response,
        ]);

        return redirect($todoId.'/todolist');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ListTodo  $listTodo
     * @return \Illuminate\Http\Response
     */
    public function show($todoId)
    {
        $data = ListTodo::findOrFail($todoId);
        return view('listtodo.show')->with([
            'data' => $data, 'todoId' => $todoId
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ListTodo  $listTodo
     * @return \Illuminate\Http\Response
     */
    public function edit(ListTodo $listTodo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ListTodo  $listTodo
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $todoId)
    {
        $validate = \Validator::make($request->all(), [
            'name' => 'required|string',
            'content' => 'required|string',
            'image' => 'mimes:jpg,jpeg,png,bmp',
        ]);

        $todolist = ListTodo::find($todoId);
        $todolist->name = $request->name;
        $todolist->content = $request->content;
        if($request->image){
            $old = ListTodo::find($todoId)->first()->image;
            preg_match("/upload\/(?:v\d+\/)?([^\.]+)/", $old, $public);
            cloudinary()->uploadApi()->destroy($public[1]);
            $response = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
            $todolist->image = $response;
        }
        $todolist->save();
        return redirect($todoId.'/todolist');     
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ListTodo  $listTodo
     * @return \Illuminate\Http\Response
     */
    public function delete($todoId)
    {
        $item = ListTodo::findOrFail($todoId);
        $item->delete();
        return redirect($todoId.'/todolist');
    }
}
