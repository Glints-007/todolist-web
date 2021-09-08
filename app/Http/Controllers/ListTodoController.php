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
    public function show($id)
    {
        $data = ListTodo::findOrFail($id);
        return view('listtodo.show')->with([
            'data' => $data
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
    public function update(Request $request, $listTodo)
    {
        $item = ListTodo::findOrFail($id);
        $data = $request->except(['_token']);
        $item->update($data);
        return redirect('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ListTodo  $listTodo
     * @return \Illuminate\Http\Response
     */
    public function destroy($todoId)
    {
        $item = ListTodo::findOrFail($id);
        $item->delete();
        return redirect('/dashboard');
    }
}
