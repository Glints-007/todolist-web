<?php

namespace App\Http\Controllers;

use App\Models\ListTodo;
use App\Models\Todo;
use Illuminate\Http\Request;
use Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Http;


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
        $data = ListTodo::with('todo')->where('todoId', $todoId)->get();
        $todo = Todo::where('id', $todoId)->first();
        return view('listtodo.new.index')->with([
            'data' => $data, 'todoId' => $todoId, 'todo' => $todo
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

        return redirect($todoId . '/todolist');
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
        return response()->json($data);
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
    public function update(Request $request, $todoListId)
    {
        $validate = \Validator::make($request->all(), [
            'name' => 'required|string',
            'content' => 'required|string',
            'image' => 'mimes:jpg,jpeg,png,bmp',
        ]);

        $todolist = ListTodo::find($todoListId);

        $todolist->name = $request->name;
        $todolist->content = $request->content;
        if ($request->image) {
            $old = ListTodo::find($todoListId)->first()->image;
            preg_match("/upload\/(?:v\d+\/)?([^\.]+)/", $old, $public);
            cloudinary()->uploadApi()->destroy($public[1]);
            $response = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
            $todolist->image = $response;
        }
        $todolist->save();
        return redirect($todolist->todoId . '/todolist');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ListTodo  $listTodo
     * @return \Illuminate\Http\Response
     */
    public function delete($todoListId)

    {
        $item = ListTodo::findOrFail($todoListId);
        $todoId = $item->todoId;
        $item->delete();
        return redirect($todoId . '/todolist');
    }
}
