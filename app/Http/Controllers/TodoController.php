<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Auth;

class TodoController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = Todo::where('userId', $user->id)->get();
        return view('todo.index')->with([
            'data' => $data
        ]);
    }

    public function create()
    {
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$data = $request->except(['_token']);
        Todo::insert($data);
        return redirect('/dashboard');*/
        $user = Auth::user();
        $data = new Todo();
            $data->date = now();
            $data->name = $request->name;
            $data->userId = $user->id;

        //Todo::insert($data);
        $data->save();
        return redirect('/dashboard');
        
    }

    public function show($id)
    {
        $data = Todo::findOrFail($id);
        return view('todo.show')->with([
            'data' => $data
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = Todo::findOrFail($id);
        $data = $request->except(['_token']);
        $item->update($data);
        return redirect('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $item = Todo::findOrFail($id);
        $item->delete();
        return redirect('/dashboard');
    }
}
